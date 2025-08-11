<?php // $Revision: 1.1.2.10 $

/************************************************************************/
/* phpPgAds                                                             */
/* ========                                                             */
/*                                                                      */
/* Copyright (c) 2001-2005 by the phpPgAds developers                   */
/* For more information visit: http://phppgads.sourceforge.net          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



// Set time limit
if (!get_cfg_var ('safe_mode')) 
	@set_time_limit(0);


// Include required files
require ("config.php");
require ("lib-maintenance.inc.php");
require ("lib-statistics.inc.php");
require ("lib-zones.inc.php");
require ("lib-storage.inc.php");
require ("lib-banner.inc.php");
require ("../libraries/lib-priority.inc.php");


// Register input variables
phpAds_registerGlobal ('step', 'retain_ids');


// Security check
phpAds_checkAccess(phpAds_Admin);


// Disable GZIP compression
$phpAds_config['content_gzip_compression'] = false;



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

// Setup busy indicator
phpAds_PageHeader("5.3");
phpAds_ShowSections(array("5.1", "5.3", "5.4", "5.2"));
//phpAds_MaintenanceSelection("mysqlimport");



/*********************************************************/
/* Main code                                             */
/*********************************************************/


if (isset($HTTP_POST_FILES['altconfig']) &&
	is_array($HTTP_POST_FILES['altconfig']) && 
	@is_uploaded_file($HTTP_POST_FILES['altconfig']['tmp_name']))
{
	unset($Session['mysqlimport']);
	phpAds_SessionDataStore();
	
	if (isset($retain_ids))
		$retain_ids = true;
	else
		$retain_ids = false;

	// Great!
	if ($HTTP_POST_FILES['altconfig']['name'] != 'config.inc.php')
		phpAds_die('Import error', 'Wrong file!');
	
	// Load file
	$altconfig = join('', file($HTTP_POST_FILES['altconfig']['tmp_name']));
	
	if (strpos($altconfig, "define('phpAds_installed', true);") === false ||
		strpos($altconfig, "phpAdsNew self configuration") === false)
		phpAds_die('Import error', 'It doesn\'t seem a phpAdsNew configuration file, or it\' from a unsupported version');
	
	// Strip useless configuration data
	$altconfig = str_replace("\r", '', $altconfig);
	$altconfig = ereg_replace("^.*Database configuration +\\*/\n", '', $altconfig);
	$altconfig = ereg_replace("/\\* phpAdsNew self configuration code - don't change +\\*/\n.*$", '', $altconfig);
	//$altconfig = ereg_replace("/\\*[^\n]+\\*/", '', $altconfig);
	//$altconfig = ereg_replace("\n//[^\n]+\n", "\n", $altconfig);
	//$altconfig = ereg_replace("\n+", "\n", $altconfig);
	
	// Load settings into phpAds_import array
	eval(str_replace('$phpAds_config[', '$phpAds_import[', $altconfig));
	
	// Connect
	if (!phpAds_importConnect())
		phpAds_die('Import error', 'Can\'t connect to db');
	
	// Read config version
	$import_version = phpAds_importResult(phpAds_importQuery("SELECT config_version FROM ".$phpAds_import['tbl_config']), 0, 0);
	
	if ($import_version != $phpAds_config['config_version'])
		 phpAds_die('Import error',
		 	'Import works only if both products have the same version number<br>'.
			'Expecting: '.$phpAds_config['config_version'].', found: '.$import_version);
	
	echo "<br><br><img src='images/install-busy.gif' align='absmiddle'>&nbsp;";
	echo "<span class='install' id='installString' name='installString'>". 'Importing advertisers' ."</span>";
	phpAds_PageFooter();
	
	// Send the output to the browser
	flush();

	$report = '';
	
	// Load advertisers
	$report .= "\nCLIENTS\n";
	$report .= "=======\n";
	$client_mapping = array();
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_clients']." WHERE parent = 0");
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_clients']);
	
	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Client '.phpAds_buildClientName($row['clientid'], $row['clientname']).'... ';
		
		$clientid = $row['clientid'];

		if (!$retain_ids)
		{
			// Do not store the ID and remap
			unset($row['clientid']);
		}
		
		// Remove campaign-only fields
		unset($row['views']);
		unset($row['clicks']);
		unset($row['expire']);
		unset($row['activate']);
		unset($row['weight']);
		unset($row['target']);
		unset($row['parent']);
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_clients'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			);
		
		$client_mapping[$clientid] = $retain_ids ? $clientid : phpAds_dbInsertId($phpAds_config['tbl_clients'].'_clientid_seq');
		
		$report .= 'successfully imported to id'.$client_mapping[$clientid]."\n";
	}
	
	phpAds_importFreeResult($res);
	
	
	
	// Load campaigns
	phpAds_showInstallText('Importing campaigns');
	$report .= "\nCAMPAIGNS\n";
	$report .= "==========\n";
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_clients']." WHERE parent > 0");
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_clients']);

	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Campaign '.phpAds_buildClientName($row['clientid'], $row['clientname']).'... ';
		
		if (!isset($client_mapping[$row['parent']]) || !$client_mapping[$row['parent']])
		{
			$report .= 'skipped'."\n";
			continue;
		}
		
		$clientid = $row['clientid'];

		if (!$retain_ids)
		{
			// Do not store the ID and remap
			unset($row['clientid']);
		}
		

		// Remap parent id
		$row['parent'] = $client_mapping[$row['parent']];
		
		// Remove advertiser-only fields
		unset($row['contact']);
		unset($row['email']);
		unset($row['clientusername']);
		unset($row['clientpassword']);
		unset($row['permissions']);
		unset($row['language']);
		unset($row['report']);
		unset($row['reportinterval']);
		unset($row['reportlastdate']);
		unset($row['reportdeactivate']);
		if ($row['expire'] == '0000-00-00') unset($row['expire']);
		if ($row['activate'] == '0000-00-00') unset($row['activate']);
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_clients'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			);
		
		$client_mapping[$clientid] = $retain_ids ? $clientid : phpAds_dbInsertId($phpAds_config['tbl_clients'].'_clientid_seq');
		
		$report .= ' successfully imported to id'.$client_mapping[$clientid]."\n";
	}
	
	phpAds_importFreeResult($res);
	
	
	
	// Load images
	phpAds_showInstallText('Importing SQL stored images');
	$report .= "\nIMAGES\n";
	$report .= "======\n";
	$image_mapping = array();
	$res = phpAds_importQuery("SELECT filename, contents FROM ".$phpAds_import['tbl_images']);

	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Image '.$row['filename'].'... ';
		
		$filename = phpAds_ImageStore('sql', $row['filename'], $row['contents']);
		
		if (!$filename)
		{
			$report .= 'skipped'."\n";
			continue;
		}
		
		$image_mapping[$row['filename']] = $filename;
		
		$report .= 'saved as '.$filename."\n";
	}
	
	phpAds_importFreeResult($res);



	// Load banners
	phpAds_showInstallText('Importing banners');
	$report .= "\nBANNERS\n";
	$report .= "=======\n";
	$banner_mapping = array();
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_banners']);
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_banners']);

	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Banner '.phpAds_buildBannerName($row['bannerid'], $row['description'], $row['alt']).'... ';
		
		if (!isset($client_mapping[$row['clientid']]) || !$client_mapping[$row['clientid']])
		{
			$report .= 'skipped'."\n";
			continue;
		}
		
		$bannerid = $row['bannerid'];

		if (!$retain_ids)
		{
			// Do not store the ID and remap
			unset($row['bannerid']);
		}

		// Remap clientid
		$row['clientid'] = $client_mapping[$row['clientid']];
		
		// Remap image id, if any
		if ($row['storagetype'] == 'web' && $row['filename'] && $row['imageurl'])
		{
			$report .= "\n".'  - Storage type: web'."\n";

			phpAds_showInstallText('Fetching banner: '.phpAds_buildBannerName($bannerid, $row['description'], $row['alt']));
			ob_start();
			@readfile($row['imageurl']);
			$contents = ob_get_contents();
			ob_end_clean();
			phpAds_showInstallText('Importing banners');
			
			if ($contents)
			{
				if (!($fname = phpAds_ImageStore('web', $row['filename'], $contents)))
				{
					$report .= '  - Couldn\'t save image on the web server'."\n";
					$report .= '    trying database storage... ';
					
					if ($fname = phpAds_ImageStore('sql', $row['filename'], $contents))
					{
						$row['storagetype'] = 'sql';
						$row['filename'] = $fname;
						
						$report .= 'successfuly saved to '.$row['filename']."\n";
					}
					else
						$report .= 'failed'."\n";
				}
				else
				{
					$row['filename'] = $fname;
					
					$report .= '    Succesfully saved as: '.$fname."\n";
				}
			}
			else
				$report .= '  - Couldn\'t open image file: '.$row['imageurl']."\n";
		}
		elseif ($row['storagetype'] == 'sql')
		{
			$report .= "\n".'  - Storage type: sql'."\n";
			
			if (isset($image_mapping[$row['filename']]))
			{
				$row['filename'] = $image_mapping[$row['filename']];
				$report .= '  - Filename remapped to: '.$row['filename']."\n";
			}
			else
				$report .= '  - Couldn\'t remap filename'."\n";				
		}
		else
			$report .= "\n";
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_banners'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			) or phpAds_sqlDie();
		
		$banner_mapping[$bannerid] = $retain_ids ? $bannerid : phpAds_dbInsertId($phpAds_config['tbl_banners'].'_bannerid_seq');
		
		$report .= 'Successfully imported to id'.$banner_mapping[$bannerid]."\n\n";
	}
	
	phpAds_importFreeResult($res);



	// Load acls
	phpAds_showInstallText('Importing delivery limitations');
	$report .= "\nACLS\n";
	$report .= "====\n";
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_acls']);
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_acls']);

	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		if (!isset($banner_mapping[$row['bannerid']]) || !$banner_mapping[$row['bannerid']])
			continue;
		
		// Remap bannerid
		$row['bannerid'] = $banner_mapping[$row['bannerid']];
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_acls'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			) or phpAds_sqlDie();
		
		$report .= 'Added ACL to banner '.phpAds_getBannerName($row['bannerid'])."\n";
	}
	
	phpAds_importFreeResult($res);



	// Load publishers
	phpAds_showInstallText('Importing publishers');
	$report .= "\nAFFILIATES\n";
	$report .= "==========\n";
	$affiliate_mapping = array();
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_affiliates']);
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_affiliates']);

	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Affiliate '.phpAds_buildAffiliateName($row['affiliateid'], $row['name']).'... ';
		
		$affiliateid = $row['affiliateid'];

		if (!$retain_ids)
		{
			// Do not store the ID and remap
			unset($row['affiliateid']);
		}
		
		if ($row['publiczones'] == '') unset($row['publiczones']);
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_affiliates'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			) or phpAds_sqlDie();
		
		$affiliate_mapping[$affiliateid] = $retain_ids ? $affiliateid : phpAds_dbInsertId($phpAds_config['tbl_affiliates'].'_affiliateid_seq');

		$report .= 'successfully imported to id'.$affiliate_mapping[$affiliateid]."\n";
	}
	
	phpAds_importFreeResult($res);



	// Load zones
	phpAds_showInstallText('Importing zones');
	$report .= "\nZONES\n";
	$report .= "=====\n";
	$zone_mapping = array();
	$zone_chains = array();
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_zones']);
	$cfields = phpAds_dbGetTableFields($phpAds_config['tbl_zones']);

	$fields_ok = false; 
	while ($row = phpAds_importFetchArray($res))
	{
		$report .= 'Zone '.phpAds_buildZoneName($row['zoneid'], $row['zonename']).'... ';
		
		if (!isset($affiliate_mapping[$row['affiliateid']]) || !$affiliate_mapping[$row['affiliateid']])
		{
			$report .= 'skipped'."\n";
			continue;
		}
		
		$zoneid = $row['zoneid'];

		if (!$retain_ids)
		{
			// Do not store the ID and remap
			unset($row['zoneid']);
		}

		// Remap publisher ID
		$row['affiliateid'] = $affiliate_mapping[$row['affiliateid']];
		
		// Remap client/banner id
		while (ereg('(client|banner)id:([0-9]+)', $row['what'], $matches))
		{
			if ($matches[1] == 'client')
				$row['what'] = str_replace($matches[0], $matches[1].':'.$client_mapping[$matches[2]], $row['what']);
			else
				$row['what'] = str_replace($matches[0], $matches[1].':'.$banner_mapping[$matches[2]], $row['what']);
		}
		$row['what'] = str_replace('client:', 'clientid:', $row['what']);
		$row['what'] = str_replace('banner:', 'bannerid:', $row['what']);
		
		if (!$fields_ok) $fields = array();
		$values = array();
		
		foreach ($row as $k => $v)
		{
			if (!isset($cfields[$k])) continue;
			
			if (!$fields_ok) $fields[] = $k;
			$values[] = "'".addslashes($v)."'";
		}
		
		$fields_ok = true;
		
		phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_zones'].
			" (".join(', ', $fields).") VALUES (".join(', ', $values).")"
			) or phpAds_sqlDie();
		
		$zone_mapping[$zoneid] = $retain_ids ? $zoneid : phpAds_dbInsertId($phpAds_config['tbl_zones'].'_zoneid_seq');

		// Check zone chain
		if (ereg('^zone:([0-9]+)$', $zone['chain'], $match))
			$zone_chains[$zoneid] = $match[1];
		
		$report .= 'successfully imported to id'.$zone_mapping[$zoneid]."\n";
	}
	
	// Change zone chains
	foreach ($zone_chains as $k => $v)
	{
		if (isset($zone_mapping[$v]))
			phpAds_dbQuery("UPDATE
					".$phpAds_config['tbl_zones']."
				SET
					chain = 'zone:".$zone_mapping[$v]."'
				WHERE
					zoneid = ".$k."
			");
	}
	
	phpAds_importFreeResult($res);
	
	if ($retain_ids)
	{
		phpAds_showInstallText('Initializing sequences');
		$report .= "\nSEQUENCES\n";
		$report .= "=========\n";

		if (count($client_mapping))
		{
			$res = phpAds_dbQuery("
				SELECT
					setval('".substr($phpAds_config['tbl_clients'].'_clientid_seq', 0, 31)."', clientid)
				FROM
					".$phpAds_config['tbl_clients']."
				ORDER BY
					clientid DESC
				LIMIT 1
			");
	
			$report .= 'Clients/Campaigns sequence set to: '.(phpAds_dbResult($res, 0, 0) + 1)."\n";
		}

		if (count($banner_mapping))
		{
			$res = phpAds_dbQuery("
				SELECT
					setval('".substr($phpAds_config['tbl_banners'].'_bannerid_seq', 0, 31)."', bannerid)
				FROM
					".$phpAds_config['tbl_banners']."
				ORDER BY
					bannerid DESC
				LIMIT 1
			");
	
			$report .= 'Banners sequence set to: '.(phpAds_dbResult($res, 0, 0) + 1)."\n";
		}

		if (count($affiliate_mapping))
		{
			$res = phpAds_dbQuery("
				SELECT
					setval('".substr($phpAds_config['tbl_affiliates'].'_affiliateid_seq', 0, 31)."', affiliateid)
				FROM
					".$phpAds_config['tbl_affiliates']."
				ORDER BY
					affiliateid DESC
				LIMIT 1
			");
	
			$report .= 'Affiliates sequence set to: '.(phpAds_dbResult($res, 0, 0) + 1)."\n";
		}

		if (count($zone_mapping))
		{
			$res = phpAds_dbQuery("
				SELECT
					setval('".substr($phpAds_config['tbl_zones'].'_zoneid_seq', 0, 31)."', zoneid)
				FROM
					".$phpAds_config['tbl_zones']."
				ORDER BY
					zoneid DESC
				LIMIT 1
			");
	
			$report .= 'Zones sequence set to: '.(phpAds_dbResult($res, 0, 0) + 1)."\n";
		}
	}
	
	// Save session data and reload page
	$Session['mysqlimport'] = array(
		'phpAds_import'		=> $phpAds_import,
		'client_mapping'	=> $client_mapping,
		'banner_mapping'	=> $banner_mapping,
		'affiliate_mapping'	=> $affiliate_mapping,
		'zone_mapping'		=> $zone_mapping,
		'report'			=> $report
	);

	phpAds_SessionDataStore();

	// Go to the next step
	echo "<meta http-equiv='refresh' content='0;URL=maintenance-mysqlimport-execute.php?step=1'>";
	exit;
}
elseif (isset($Session['mysqlimport']) && isset($step) && $step == 1)
{
	echo "<br><br><img src='images/install-busy.gif' align='absmiddle'>&nbsp;";
	echo "<span class='install' id='installString' name='installString'>". 'Importing advertisers' ."</span>";
	phpAds_PageFooter();
	
	// Send the output to the browser
	flush();

	$phpAds_import = $Session['mysqlimport']['phpAds_import'];
	$client_mapping = $Session['mysqlimport']['client_mapping'];
	$banner_mapping = $Session['mysqlimport']['banner_mapping'];
	$affiliate_mapping = $Session['mysqlimport']['affiliate_mapping'];
	$zone_mapping = $Session['mysqlimport']['zone_mapping'];
	$report = $Session['mysqlimport']['report'];

	
	// Connect
	if (!phpAds_importConnect())
		phpAds_die('Import error', 'Can\'t connect to db');
	
	// Load adstats
	phpAds_showInstallText('Importing compact stats (Loading data)');
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_adstats']." ORDER BY day");
	
	if ($rows = phpAds_importNumRows($res))
	{
		$perc = round($rows / 100);
		$x = -1;
		
		phpAds_dbQuery("BEGIN");
		while ($row = phpAds_importFetchArray($res))
		{
			if (!(++$x % $perc))
				phpAds_showInstallText('Importing compact stats ('.round($x*100/$rows).'% completed)');
			
			phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_adstats']." VALUES (".
				$row['views'].", ".
				$row['clicks'].", '".
				$row['day']."', ".
				$row['hour'].", ".
				$banner_mapping[$row['bannerid']].", ".
				($row['zoneid'] ?  $zone_mapping[$row['zoneid']] : $row['zoneid']).", '".
				$row['source']."')"
			);
		}
		phpAds_showInstallText('Importing compact stats (100% completed)');
		phpAds_dbQuery("COMMIT");
		phpAds_showInstallText('Importing compact stats (vacuuming table)');
		phpAds_dbQuery("VACUUM ANALYZE ".$phpAds_config['tbl_adstats']);
	}
	
	phpAds_importFreeResult($res);
	


	// Load adviews
	phpAds_showInstallText('Importing verbose adviews (Loading data)');
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_adviews']." ORDER BY t_stamp");

	if ($rows = phpAds_importNumRows($res))
	{
		$perc = round($rows / 100);
		$x = -1;
		
		phpAds_dbQuery("BEGIN");
		while ($row = phpAds_importFetchArray($res))
		{
			if (!(++$x % $perc))
				phpAds_showInstallText('Importing verbose adviews ('.round($x*100/$rows).'% completed)');
			
			phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_adviews']." VALUES (".
				$banner_mapping[$row['bannerid']].", ".
				($row['zoneid'] ?  $zone_mapping[$row['zoneid']] : $row['zoneid']).", '".
				substr($row['t_stamp'], 0, 4).'-'.
				substr($row['t_stamp'], 4, 2).'-'.
				substr($row['t_stamp'], 6, 2).' '.
				substr($row['t_stamp'], 8, 2).':'.
				substr($row['t_stamp'], 10, 2).':'.
				substr($row['t_stamp'], 12, 2)."', '".
				$row['host']."', '".
				$row['source']."', '".
				$row['country']."')"
			);
		}
		phpAds_showInstallText('Importing verbose adviews (100% completed)');
		phpAds_dbQuery("COMMIT");
		phpAds_showInstallText('Importing verbose adviews (vacuuming table)');
		phpAds_dbQuery("VACUUM ANALYZE ".$phpAds_config['tbl_adviews']);
	}
	
	phpAds_importFreeResult($res);



	// Load adclicks
	phpAds_showInstallText('Importing verbose adclicks (Loading data)');
	$res = phpAds_importQuery("SELECT * FROM ".$phpAds_import['tbl_adclicks']." ORDER BY t_stamp");

	if (phpAds_importNumRows($res))
	{
		$perc = round($rows / 100);
		$x = -1;
		
		phpAds_dbQuery("BEGIN");
		while ($row = phpAds_importFetchArray($res))
		{
			if (!(++$x % $perc))
				phpAds_showInstallText('Importing verbose adclicks ('.round($x*100/$rows).'% completed)');
			
			phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_adclicks']." VALUES (".
				$banner_mapping[$row['bannerid']].", ".
				($row['zoneid'] ?  $zone_mapping[$row['zoneid']] : $row['zoneid']).", '".
				substr($row['t_stamp'], 0, 4).'-'.
				substr($row['t_stamp'], 4, 2).'-'.
				substr($row['t_stamp'], 6, 2).' '.
				substr($row['t_stamp'], 8, 2).':'.
				substr($row['t_stamp'], 10, 2).':'.
				substr($row['t_stamp'], 12, 2)."', '".
				$row['host']."', '".
				$row['source']."', '".
				$row['country']."')"
			);
			
		}
		phpAds_showInstallText('Importing verbose adclicks (100% completed)');
		phpAds_dbQuery("COMMIT");
		phpAds_showInstallText('Importing verbose adclicks (vacuuming table)');
		phpAds_dbQuery("VACUUM ANALYZE ".$phpAds_config['tbl_adclicks']);
	}
	
	phpAds_importFreeResult($res);


	// Rebuild priority
	phpAds_showInstallText('Recalculating priority');
	phpAds_PriorityCalculate();


	// Rebuild cache
	if (!defined('LIBVIEWCACHE_INCLUDED')) 
		include (phpAds_path.'/libraries/deliverycache/cache-'.$phpAds_config['delivery_caching'].'.inc.php');
	
	phpAds_showInstallText('Cleaning delivery cache');
	phpAds_cacheDelete();

	
	// Rebuild banner cache
	if (count($banner_mapping))
	{
		phpAds_showInstallText('Recreating banner cache');
		$res = phpAds_dbQuery("
			SELECT
				*
			FROM
				".$phpAds_config['tbl_banners']."
			WHERE
				bannerid IN (".join(', ', $banner_mapping).")
		");
		
		while ($current = phpAds_dbFetchArray($res))
		{
			// Rebuild filename
			if ($current['storagetype'] == 'sql')
				$current['imageurl'] = "{url_prefix}/adimage.php?filename=".$current['filename']."&amp;contenttype=".$current['contenttype'];
			
			if ($current['storagetype'] == 'web')
				$current['imageurl'] = $phpAds_config['type_web_url'].'/'.$current['filename'];
			
			
			// Add slashes to status to prevent javascript errors
			// NOTE: not needed in banner-edit because of magic_quotes_gpc
			$current['status'] = addslashes($current['status']);
			
			
			// Rebuild cache
			$current['htmltemplate'] = stripslashes($current['htmltemplate']);
			$current['htmlcache']    = addslashes(phpAds_getBannerCache($current));
			
			phpAds_dbQuery("
				UPDATE
					".$phpAds_config['tbl_banners']."
				SET
					htmlcache = '".$current['htmlcache']."',
					imageurl  = '".$current['imageurl']."'
				WHERE
					bannerid = ".$current['bannerid']."
			");
		}
	}
	
	// Go to the next step
	echo "<meta http-equiv='refresh' content='0;URL=maintenance-mysqlimport-execute.php?step=2'>";
	exit;
}
elseif (isset($Session['mysqlimport']) && isset($step) && $step == 2)
{
	$phpAds_import = $Session['mysqlimport']['phpAds_import'];
	$client_mapping = $Session['mysqlimport']['client_mapping'];
	$banner_mapping = $Session['mysqlimport']['banner_mapping'];
	$affiliate_mapping = $Session['mysqlimport']['affiliate_mapping'];
	$zone_mapping = $Session['mysqlimport']['zone_mapping'];
	$report = $Session['mysqlimport']['report'];

	echo "Import complete!";
	phpAds_ShowBreak();

	echo "<pre sytle='font-family: Courer New, courier, fixed-width; font-size: 9px'>";
	echo htmlentities(strip_tags($report));
	echo '</pre>';
	phpAds_ShowBreak();
	phpAds_pageFooter();
}
else
	phpAds_die('Import error', 'No file uploaded');



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

function phpAds_showInstallText($str)
{	
	echo "<script language='JavaScript'>\n";
	echo "installString.innerHTML = '".str_replace("'", "\\'", $str)."'\n";
	echo "</script>\n";
	flush();
}


	
/********************************************************/
/* Postgres utility function                             */
/*********************************************************/

function phpAds_dbGetTableFields($table)
{
	$fields = array();
	$res = phpAds_dbQuery("SELECT * FROM ".$table." WHERE 1 = 0");
	
	for ($x = 0; $x < pg_numfields($res); $x++)
		$fields[pg_fieldname($res, $x)] = true;
	
	return $fields;
}

/*********************************************************/
/* MySQL abstraction layer                               */
/*********************************************************/

function phpAds_importConnect()
{
	global $phpAds_import;
	global $phpAds_import_link;
	
	// Add port to connect, if needed
	if (!isset($phpAds_import['dbport'])) $phpAds_import['dbport'] = 3306;
	$host = $phpAds_import['dbport'] != 3306 ? $phpAds_import['dbhost'].':'.$phpAds_import['dbport'] : $phpAds_import['dbhost'];

    $phpAds_import_link = @mysql_connect ($host, $phpAds_import['dbuser'], $phpAds_import['dbpassword']);
	
	if (@mysql_select_db ($phpAds_import['dbname'], $phpAds_import_link))
		return $phpAds_import_link;
}



/*********************************************************/
/* Close the connection to the database			         */
/*********************************************************/

function phpAds_importClose()
{
	// Never close the database connection, because
	// it may interfere with other scripts which
	// share the same connection.
}



/*********************************************************/
/* Execute a query								         */
/*********************************************************/

function phpAds_importQuery($query)
{
    global $phpAds_import_query;
	global $phpAds_import_link;
	
    $phpAds_import_query = $query;
    return @mysql_query ($query, $phpAds_import_link);
}



/*********************************************************/
/* Get the number of rows returned                       */
/*********************************************************/

function phpAds_importNumRows($res)
{
	return @mysql_num_rows($res);
}



/*********************************************************/
/* Get next row as an array with keys                    */
/*********************************************************/

function phpAds_importFetchArray($res)
{
	return @mysql_fetch_array($res, MYSQL_ASSOC);
}



/*********************************************************/
/* Get next row as an array                              */
/*********************************************************/

function phpAds_importFetchRow($res)
{
	return @mysql_fetch_row($res);
}



/*********************************************************/
/* Get a specific row and column                         */
/*********************************************************/

function phpAds_importResult($res, $row, $column)
{
	return @mysql_result($res, $row, $column);
}



/*********************************************************/
/* Free the result from memory                           */
/*********************************************************/

function phpAds_importFreeResult($res)
{
	return @mysql_free_result($res);
}



/*********************************************************/
/* Return the number of affected rows                    */
/*********************************************************/

function phpAds_importAffectedRows()
{
	global $phpAds_import_link;
	
	return @mysql_affected_rows($phpAds_import_link);
}



/*********************************************************/
/* Go to the specified row                               */
/*********************************************************/

function phpAds_importSeekRow($res, $row)
{
	return @mysql_data_seek($res, $row);
}



/*********************************************************/
/* Get the ID of the last inserted row                   */
/*********************************************************/

function phpAds_importInsertID()
{
	global $phpAds_import_link;
	
	return @mysql_insert_id($phpAds_import_link);
}



/*********************************************************/
/* Get the error message if something went wrong         */
/*********************************************************/

function phpAds_importError ()
{
	global $phpAds_import_link;
	
	return @mysql_error($phpAds_import_link);
}

function phpAds_importErrorNo ()
{
	global $phpAds_import_link;
	
	return @mysql_errno($phpAds_import_link);
}

?>