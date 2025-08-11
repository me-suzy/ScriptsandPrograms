<?php // $Revision: 2.3.2.20 $

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



// Define
define ('phpAds_databaseUpgradeSupported', true);
define ('phpAds_databaseCreateSupported', true);
define ('phpAds_databaseCheckSupported', true);
define ('phpAds_tableTypesSupported', false);




/*********************************************************/
/* Check if the database already exists                  */
/*********************************************************/

function phpAds_checkDatabaseExists ()
{
	// Get the database structure
	$dbstructure	 = phpAds_prepareDatabaseStructure();
	$availabletables = array();
	
	// Get table names
	$res = phpAds_dbQuery(phpAds_pgShowTables);
	while ($row = phpAds_dbFetchRow($res))
		$availabletables[] = $row[0];
	
	$result = false;
	
	foreach (array_keys($dbstructure) as $key)
	{
		if (is_array($availabletables) && in_array ($key, $availabletables))
		{
			// Table exists
			$result = true;
		}
	}
	
	return $result;
}



/*********************************************************/
/* Check if the database is valid                        */
/*********************************************************/

function phpAds_checkDatabaseValid ()
{
	// Get the database structure
	$dbstructure = phpAds_prepareDatabaseStructure();
	$result      = true;
	
	// Get table names
	$res = phpAds_dbQuery(phpAds_pgShowTables);
	while ($row = phpAds_dbFetchRow($res))
		$availabletables[] = $row[0];
	
	foreach (array_keys($dbstructure) as $key)
	{
		if (!is_array($availabletables) || !in_array ($key, $availabletables))
			$result = false;
	}
		
	return ($result);
}



/*********************************************************/
/* Upgrade the database to the latest structure          */
/*********************************************************/

function phpAds_upgradeDatabase ($tabletype = '')
{	
	// Prepare data for banners table splitting
	phpAds_upgradeSplitBannersPrepare();
	
	// Prepare data for upgrade to acls table
	phpAds_upgradeDisplayLimitationsPrepare();

	// Call create function to get the upgrade
	return phpAds_createDatabase($tabletype, true);
}



/*********************************************************/
/* Upgrade the data to the latest structure              */
/*********************************************************/

function phpAds_upgradeData ()
{
	// Get the database structure
	$dbstructure	 = phpAds_prepareDatabaseStructure();
	$availabletables = array();
	
	// Get table names
	$res = phpAds_dbQuery(phpAds_pgShowTables);
	while ($row = phpAds_dbFetchRow($res))
		$availabletables[] = $row[0];

	// Turn off autocommit to improve performance
	phpAds_dbQuery("BEGIN");
	// Turn off DEFERRABLE constraints to avoid referencial integrity violations
	phpAds_dbQuery("SET CONSTRAINTS ALL DEFERRED");


	// If upgrading restore data
	foreach (array_keys($dbstructure) as $key)
	{
		$tmp_name = substr('tmp_'.$key, 0, 31);
		
		if (is_array($availabletables) && in_array ($tmp_name, $availabletables))
		{
			// Table exists, restore
			phpAds_restoreTable ($key, $dbstructure[$key]);
		}
	}

	// If upgrading drop temp tables
	foreach (array_keys($dbstructure) as $key)
	{
		$tmp_name = substr('tmp_'.$key, 0, 31);
		
		if (is_array($availabletables) && in_array ($tmp_name, $availabletables))
		{
			// Table exists, drop
			phpAds_dropTable ($tmp_name);
		}
	}

	// Commit changes
	phpAds_dbQuery("COMMIT");
	
	
	// Split banners into two tables and
	// generate banner html cache
	phpAds_upgradeSplitBanners();
	
	// Detect version of needed plugins
	phpAds_upgradeDetectPluginVersion();
	
	// Update banner cache off all banners
	phpAds_upgradeHTMLCache();

	// Upgrade append type to zones when possible
	phpAds_upgradeAppendZones();
	
	// Upgrade append type to zones when possible
	phpAds_upgradeDisplayLimitations();

	// Create target stats form userlog
	phpAds_upgradeTargetStats();
	
	// Update the password to MD5 hashes
	phpAds_upgradePasswordMD5();
	
	// Update template of SWF banners
	phpAds_upgradeTransparentSWF();

	return true;
}



/*********************************************************/
/* Create the database                                   */
/*********************************************************/

function phpAds_createDatabase ($tabletype = '', $upgrade = false)
{
	global $phpAds_pgVersion;

	// Get the database structure
	$dbstructure	 = phpAds_prepareDatabaseStructure();
	$availabletables = array();
	$error = false;
	
	// Get table names
	$res = phpAds_dbQuery(phpAds_pgShowTables);
	while ($row = phpAds_dbFetchRow($res))
		$availabletables[] = $row[0];
	
	
	// Backup and drop only if upgrading
	if ($upgrade)
	{
		phpAds_dbQuery("BEGIN");
		phpAds_dbQuery("SET CONSTRAINTS ALL DEFERRED");
		
		// Backup existing tables
		foreach (array_keys($dbstructure) as $key)
		{
			if (is_array($availabletables) && in_array ($key, $availabletables))
			{
				// Table exists, backup
				$error = $error || !phpAds_backupTable ($key);
			}
		}
		
		
		// Drop existing tables
		foreach (array_keys($dbstructure) as $key)
		{
			if (is_array($availabletables) && in_array ($key, $availabletables))
			{
				// Table exists, drop it
				$error = $error || !phpAds_dropTable ($key);
			}
		}
		
		if ($error)
		{
			phpAds_dbQuery("ROLLBACK");
			return false;
		}
		else
			phpAds_dbQuery("COMMIT");
	}
	
	
	phpAds_dbQuery("BEGIN");
	phpAds_dbQuery("SET CONSTRAINTS ALL DEFERRED");
	
	// Create database structure
	foreach (array_keys($dbstructure) as $key)
	{
		// Table doesn't exists, create
		$error = $error || !phpAds_createTable ($key, $dbstructure[$key], $tabletype);
	}
	
	if ($error)
	{
		// Error creating new tables, restore temp tables
		
		phpAds_dbQuery("ROLLBACK");
		
		$availabletables = array();
		$res = phpAds_dbQuery(phpAds_pgShowTables);
		while ($row = phpAds_dbFetchRow($res))
			$availabletables[] = $row[0];
		
		foreach (array_keys($dbstructure) as $key)
		{
			$tmp_name = substr('tmp_'.$key, 0, 31);
			
			if (is_array($availabletables) && in_array ($key, $availabletables))
				phpAds_dbQuery("DROP TABLE $key".($phpAds_pgVersion >= 70300 ? ' CASCADE' : ''));
			if (is_array($availabletables) && in_array ($tmp_name, $availabletables))
				phpAds_dbQuery("ALTER TABLE $tmp_name RENAME TO $key");
		}
		
		return false;
	}
	else
		phpAds_dbQuery("COMMIT");


	// Drop and create SQL functions or recreate using CREATE OR REPLACE FUNCTION if available
	if ($phpAds_pgVersion < 70200)
		// Explicitly DROP existing functions on PgSQL < 7.2
		$sqlfunctions = phpAds_readDatabaseStructure('functions_drop.sql');
	else
		$sqlfunctions = array();

	$sqlfunctions = array_merge($sqlfunctions, phpAds_readDatabaseStructure('functions.sql'));
	while (list(, $v) = each($sqlfunctions))
	{
		if ($phpAds_pgVersion >= 70200 && ereg('CREATE FUNCTION ', $v))
			// Use CREATE OR REPLACE syntax on PgSQL 7.2+
			$v = str_replace('CREATE FUNCTION', 'CREATE OR REPLACE FUNCTION', $v);
		
		if ($phpAds_pgVersion >= 70300)
			// Use timestamptz in function parameters on PgSQL 7.3+
			$v = ereg_replace('timestamp([,)])', 'timestamptz\1', $v);

		phpAds_dbQuery($v);
	}

	return true;
}




/*********************************************************/
/* Backup a table                                        */
/*********************************************************/

function phpAds_backupTable ($name)
{
	$tmp_name = substr('tmp_'.$name, 0, 31);

	return phpAds_dbQuery("SELECT * INTO $tmp_name FROM $name");
}



/*********************************************************/
/* Restore a table                                       */
/*********************************************************/

function phpAds_restoreTable ($name, $structure)
{
	global $phpAds_config;
	
	$tmp_name = substr('tmp_'.$name, 0, 31);

	$src = $tmp_name;
	$dst = $name;
	
	// If source table is empty do nothing
	if (!phpAds_dbNumRows(phpAds_dbQuery("SELECT * FROM $src LIMIT 1")))
		return true;
	
	// Lock and empty destination table, to be sure there won't be duplicate key errors
	phpAds_dbQuery("LOCK $dst IN ACCESS EXCLUSIVE MODE");
	phpAds_dbQuery("DELETE FROM $dst");
	
	$rsrc = phpAds_dbQuery("SELECT * FROM $src WHERE 1 = 0") or phpAds_sqlDie();
	$rdst = phpAds_dbQuery("SELECT * FROM $dst WHERE 1 = 0") or phpAds_sqlDie();
	
	for ($x = 0; $x < pg_numfields($rsrc); $x++)
		$fsrc[pg_fieldname($rsrc, $x)] = pg_fieldtype($rsrc, $x);
		
	for ($x = 0; $x < pg_numfields($rdst); $x++)
		$fdst[pg_fieldname($rdst, $x)] = pg_fieldtype($rdst, $x);
		
	$fields = array();
	$values = array();
	
	while (list($k, $v) = each($fdst))
	{
		if (isset($fsrc[$k]))
		{
			// Pg cannot cast int2 to int8 directly
			if ($fsrc[$k] == 'int2' && $v == 'int8')
				$v =  'int4';

			$fields[] = $k;
			
			if ($dst == $phpAds_config['tbl_banners'] &&
				($k == 'status' || $k == 'autohtml'))
				$values[] = "CASE WHEN $k IS NULL THEN ".($v == 'bool' ? "'f'" : "''")." ELSE $k::$v END";
			elseif ($dst == $phpAds_config['tbl_acls'] &&
				$k == 'acl_ad' && $fsrc[$k] == 'bool')
				$values[] = "CASE WHEN $k THEN 'allow'::$v ELSE 'deny'::$v END";
			elseif ($dst == $phpAds_config['tbl_zones'] &&
				$k == 'cachetimestamp' && $fsrc[$k] == 'timestamp')
				$values[] = "0";
			elseif ($dst == $phpAds_config['tbl_zones'] &&
				$k == 'cachecontents' && $fsrc['cachetimestamp'] == 'timestamp')
				$values[] = "NULL";
			elseif ($dst == $phpAds_config['tbl_clients'] && $k == 'parent')
				$values[] = "CASE WHEN $k = 0 THEN null ELSE $k::$v END";
			elseif (($fsrc[$k] == 'bpchar' || $fsrc[$k] == 'char') && $v == 'varchar')
				$values[] = "TRIM($k)";
			elseif ($dst == $phpAds_config['tbl_config'] && preg_match('/^(int|float)/', $v))
				$values[] = "COALESCE($k, 0)::$v";
			elseif ($dst == $phpAds_config['tbl_config'] && $v == 'bool')
				$values[] = "COALESCE($k, 'f')::$v";
			elseif ($dst == $phpAds_config['tbl_config'])
				$values[] = "COALESCE($k, '')::$v";
			else
				$values[] = "$k::$v";
		}
	}
	
	phpAds_dbQuery("INSERT INTO $dst (".join(', ', $fields).") SELECT ".
		join(', ', $values)." FROM $src") or phpAds_sqlDie();

	if (isset($structure['sequence']))
	{
		for (reset($structure['sequence']); list($k, $v) = each($structure['sequence']); )
		{
			if (($max = phpAds_dbResult(phpAds_dbQuery("SELECT MAX($v) FROM $dst"), 0, 0)) > 0)
			{
				// Set max-id as sequence current value
				phpAds_dbQuery("SELECT setval('$k', $max)");
			}
			else
			{
				// No value, reset sequence
				if (!phpAds_dbQuery("SELECT setval('$k', 1, 't')"))
					// Pre 7.1 - no 3 args setval
					phpAds_dbQuery("UPDATE $k SET last_value = 1, is_called = 'f'");
			}
		}
	}

	return true;
}



/*********************************************************/
/* Create a table                                        */
/*********************************************************/

function phpAds_createTable ($name, $structure, $tabletype = '')
{
	global $phpAds_config;
	
	$columns = $structure['columns'];
	if (isset($structure['primary'])) $primary = $structure['primary'];
	if (isset($structure['index']))   $index   = $structure['index'];
	if (isset($structure['unique']))  $unique  = $structure['unique'];
	if (isset($structure['foreign'])) $foreign = $structure['foreign'];
	if (isset($structure['sequence'])) $sequence = $structure['sequence'];
	
	// Create empty array
	$createdefinitions = array();
	
	// Get sequences names
	$availablesequences = array();
	$res = phpAds_dbQuery(phpAds_pgShowSequences);
	while ($row = phpAds_dbFetchRow($res))
		$availablesequences[] = $row[0];
	
	// Add sequences
	if (isset($sequence) && is_array($sequence) && sizeof($sequence) > 0)
	{
		foreach (array_keys($sequence) as $key)
		{
			if (!in_array($key, $availablesequences))
			{
				if (!phpAds_dbQuery("CREATE SEQUENCE ".$key))
					return false;
			}
			
			// Set sequence ACL
			phpPgAds_setTablePermissions($key);
		}
	}

	// Add columns
	foreach (array_keys($columns) as $key)
		$createdefinitions[] = $key." ".$columns[$key];
	
	if (isset($primary) && is_array($primary) && sizeof($primary) > 0)
		$createdefinitions[] = "CONSTRAINT ".$name."_pkey PRIMARY KEY (".implode(",", $primary).")";

	if (isset($foreign) && is_array($foreign) && sizeof($foreign) > 0)
	{
		for (reset($foreign);$key=key($foreign);next($foreign))
			$createdefinitions[] = "CONSTRAINT $key ".
				"FOREIGN KEY (".implode("_", $foreign[$key]['keys']).") ".
				"REFERENCES ".$foreign[$key]['references']." (".implode(",", $foreign[$key]['refkeys']).") ".
				$foreign[$key]['extra'];
	}	

	if (is_array($createdefinitions) &&
		sizeof($createdefinitions) > 0)
	{
		$query  = "CREATE TABLE $name (";
		$query .= implode (", ", $createdefinitions);
		$query .= ")";
		
		// Tabletype
		if ($tabletype != '')
			$query .= " TYPE=".$tabletype;
		
		if (!phpAds_dbQuery($query))
			return false;

		// Set table ACL
		phpPgAds_setTablePermissions($name);
	}

	// Add indexes
	if (isset($index) && is_array($index) && sizeof($index) > 0)
	{
		for (reset($index);$key=key($index);next($index))
		{
			if (!phpAds_dbQuery("CREATE INDEX $key ON ".$name." ".$index[$key]['using']." (".implode(",", $index[$key]['columns']).")"))
				return false;
		}
	}

	// Add unique indexes
	if (isset($unique) && is_array($unique) && sizeof($unique) > 0)
	{
		for (reset($unique);$key=key($unique);next($unique))
		{
			if (!phpAds_dbQuery("CREATE UNIQUE INDEX $key ON ".$name." (".implode(",", $unique[$key]['columns']).")"))
				return false;
		}
	}

	return true;
}



/*********************************************************/
/* Drop an existing table                                */
/*********************************************************/

function phpAds_dropTable ($name)
{
	global $phpAds_pgVersion;
	
	return phpAds_dbQuery("DROP TABLE ".$name.($phpAds_pgVersion >= 70300 ? ' CASCADE' : ''));
}



/*********************************************************/
/* Get table types                                       */
/*********************************************************/

function phpAds_getTableTypes ()
{
	return array();
}

/*********************************************************/
/* Read the database structure from a sql file           */
/*********************************************************/

function phpAds_readDatabaseStructure ($filename = 'all.sql')
{
	global $phpAds_config;
	
	$sql = join("", file(phpAds_path."/libraries/defaults/".$filename));
	
	// Stripping comments
	$sql = ereg_replace("-- [^\n]*\n", "\n", $sql);
	$sql = ereg_replace("$#[^\n]*\n", "\n", $sql);
	
	// Stripping (CR)LFs
	//$sql = str_replace("\r?\n\r?", "", $sql);
	$sql = str_replace("\r", " ", $sql);
	$sql = str_replace("\n", " ", $sql);
	
	
	// Unifying duplicate blanks
	$sql = ereg_replace("[[:blank:]]+", " ", $sql);
	
	$sql = explode(";", $sql);
	
	// Replacing table names to match config.inc.php
	for ($i=0;$i<sizeof($sql);$i++)
	{
		if (ereg ("CREATE TABLE (phpads_[^ ]*) \(", $sql[$i], $regs))
		{
			$tablename = str_replace ("phpads_", "tbl_", $regs[1]);
			
			if (isset($phpAds_config[$tablename]))
				$sql[$i] = str_replace ($regs[1], $phpAds_config[$tablename], $sql[$i]);
		}
		
		if (ereg ("CREATE INDEX [A-Za-z0-9_]+ ON (phpads_[^ ]+)", $sql[$i], $regs))
		{
			$tablename = str_replace ("phpads_", "tbl_", $regs[1]);
			
			if (isset($phpAds_config[$tablename]))
				$sql[$i] = str_replace ($regs[1], $phpAds_config[$tablename], $sql[$i]);
		}

		if (ereg ("REFERENCES (phpads_[^ ]+)", $sql[$i], $regs))
		{
			$tablename = str_replace ("phpads_", "tbl_", $regs[1]);
			
			if (isset($phpAds_config[$tablename]))
				$sql[$i] = str_replace ('REFERENCES '.$regs[1], 'REFERENCES '.$phpAds_config[$tablename], $sql[$i]);
		}
	}
	
	// Create an array with an element for each query
	return $sql;
}



/*********************************************************/
/* Parse the an sql file and return all queries          */
/*********************************************************/

function phpAds_prepareDatabaseStructure()
{
	global $phpAds_config;
	global $phpAds_pgVersion;
	
	// Get Postgres version
	if (ereg("^PostgreSQL ([0-9]+)\.([0-9]+)(\.[0-9]+)?",
		phpAds_dbResult(phpAds_dbQuery('SELECT version()'), 0, 0), $regs))
	{
		$phpAds_pgVersion = $regs[1]*10000+$regs[2]*100+$regs[3]*1;
	}
	else
		$phpAds_pgVersion = 0;

	$dbstructure = array();

	// Read the all.sql file
	$queries = phpAds_readDatabaseStructure ();
	
	
	for ($i=0;$i<sizeof($queries)-1;$i++)
	{
		if (ereg ("CREATE TABLE ([^\(]*) \((.*)\)", $queries[$i], $regs))
		{
			$tablename   = $regs[1];
			$definitions = $regs[2];
			
			$definitions = explode (", ", $definitions);
			
			for ($j=0;$j<sizeof($definitions);$j++)
			{
				$definition = trim($definitions[$j]);
				
				if (ereg("^PRIMARY KEY \((.*)\)$", $definition, $regs))
				{
					$items = explode(",", $regs[1]);
					for ($k=0;$k<sizeof($items);$k++)
						$dbstructure[$tablename]['primary'][] = $items[$k];
				}
				elseif (ereg("^UNIQUE \((.*)\)$", $definition, $regs))
				{
					$items = explode(",", $regs[1]);
					$idxname = substr($tablename.'_'.join('_', $items).'_udx', 0, 31);
					for ($k=0;$k<sizeof($items);$k++)
						$dbstructure[$tablename]['unique'][$idxname]['columns'][] = $items[$k];
				}
				elseif (ereg("^FOREIGN KEY \(([^ ]*)\) REFERENCES ([^ ]*) \(([^)]*)\) (.*)$", $definition, $regs))
				{
					// Add foreign keys and index
					$items = explode(",", $regs[1]);
					$idxname = substr($tablename.'_'.join('_', $items), 0, 28);
					for ($k=0;$k<sizeof($items);$k++)
						$dbstructure[$tablename]['foreign'][$idxname.'_fk']['keys'][] = $items[$k];

					// Add referenced table
					$dbstructure[$tablename]['foreign'][$idxname.'_fk']['references'] = $regs[2];

					// Add referenced table fields
					$items = explode(",", $regs[3]);
					for ($k=0;$k<sizeof($items);$k++)
						$dbstructure[$tablename]['foreign'][$idxname.'_fk']['refkeys'][] = $items[$k];

					// Add extra
					$dbstructure[$tablename]['foreign'][$idxname.'_fk']['extra'] = $regs[4];
				}
				elseif (ereg("^([^ ]*) (.*)$", $definition, $regs))
				{
					if (ereg("^serial ", $regs[2]))
					{
						$seqname = substr($tablename.'_'.$regs[1].'_seq', 0, 31);
						$regs[2] = "int4 NOT NULL DEFAULT nextval('".$seqname."')";
						$dbstructure[$tablename]['sequence'][$seqname] = $regs[1];
					}
					elseif ($phpAds_pgVersion >= 70300)
					{
						$regs[2] = str_replace('\1', '', ereg_replace('^timestamp( |$)', 'timestamp(0) with time zone\1', $regs[2]));
					}
					elseif ($phpAds_pgVersion >= 70200)
					{
						$regs[2] = str_replace('\1', '', ereg_replace('^timestamp( |$)', 'timestamp(0)\1', $regs[2]));
					}

					$dbstructure[$tablename]['columns'][$regs[1]] = $regs[2];
				}
			}
		}
		elseif (ereg ("CREATE( UNIQUE)? INDEX ([^ ]*) ON ([^ ]+) (USING [A-Zaz-]+ )?\((.*)\)", $queries[$i], $regs))
		{
			$index = empty($regs[1]) ? 'index' : 'unique';
			$idxname = substr($regs[2], 0, 31);
			$dbstructure[$regs[3]][$index][$idxname]['using'] = $regs[4];
			$items = explode(",", $regs[5]);
			for ($k=0;$k<sizeof($items);$k++)
				$dbstructure[$regs[3]][$index][$idxname]['columns'][] = $items[$k];
		}
	}
	
	return $dbstructure;
}


/*********************************************************/
/* Version specific updates                              */
/*********************************************************/

function phpAds_upgradeSplitBannersPrepare ()
{
	global $phpAds_config;

	// Check if splitting is needed
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.041)
	{
		// Backup needed data into a temporary table
		phpAds_dbQuery ("DROP TABLE phppgads_splitbanners");
		phpAds_dbQuery ("SELECT bannerid, banner, format INTO phppgads_splitbanners FROM ".$phpAds_config['tbl_banners']) or phpAds_sqlDie();
	}
}

function phpAds_upgradeSplitBanners ()
{
	global $phpAds_config;
	
	// Check if splitting is needed
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.041)
	{
		$banners = array();

		// Fetch all banners
		$res = phpAds_dbQuery ("SELECT * FROM ".$phpAds_config['tbl_banners']." JOIN phppgads_splitbanners USING (bannerid)");
		
		while ($row = phpAds_dbFetchArray($res))
		{
			$banners[] = $row;
		}

		for ($i=0; $i < count($banners); $i++)
		{
			// Requote fields
			$banners[$i]['alt'] 		= phpAds_htmlQuotes(stripslashes($banners[$i]['alt']));
			$banners[$i]['bannertext'] 	= phpAds_htmlQuotes(stripslashes($banners[$i]['bannertext']));
			
			// Resplit keywords
			if (isset($banners[$i]['keyword']) && $banners[$i]['keyword'] != '')
			{
				$keywordArray = split('[ ,]+', trim($banners[$i]['keyword']));
				$banners[$i]['keyword'] = implode(' ', $keywordArray);
			}
			
			// Determine storagetype
			switch ($banners[$i]['format'])
			{
				case 'url':		$banners[$i]['storagetype'] = 'url';	break;
				case 'html':	$banners[$i]['storagetype'] = 'html';	break;
				case 'web':		$banners[$i]['storagetype'] = 'web';	break;
				default:		$banners[$i]['storagetype'] = 'sql';	break;
			}
			
			switch ($banners[$i]['storagetype'])
			{
				case 'sql':
					
					// Determine contenttype
					$banners[$i]['contenttype']  = $banners[$i]['format'];
					
					// Load and delete old Postgres large object
					if (ereg("^oid:([0-9]+)$", $banners[$i]['banner'], $match))
					{
						$banners[$i]['banner'] = phpPgAds_lo_read($match[1]);
						phpAds_dbQuery("BEGIN");
						@pg_lounlink($GLOBALS['phpAds_db_link'], $match[1]);
						phpAds_dbQuery("COMMIT");
					}

					// Store the file
					$banners[$i]['filename']	 = 'banner_'.$banners[$i]['bannerid'].'.'.$banners[$i]['contenttype'];
					$banners[$i]['filename'] 	 = phpAds_ImageStore($banners[$i]['storagetype'], $banners[$i]['filename'], $banners[$i]['banner']);
					$banners[$i]['imageurl']	 = $phpAds_config['url_prefix'].'/adimage.php?filename='.$banners[$i]['filename']."&amp;contenttype=".$banners[$i]['contenttype'];

					$banners[$i]['htmltemplate'] = phpAds_getBannerTemplate($banners[$i]['contenttype']);
					$banners[$i]['htmlcache']    = addslashes(phpAds_getBannerCache($banners[$i]));
					$banners[$i]['htmltemplate'] = addslashes($banners[$i]['htmltemplate']);
					
					$banners[$i]['banner']		 = '';
					break;
				
				case 'web':
					// Get the contenttype
					$ext = substr($banners[$i]['banner'], strrpos($banners[$i]['banner'], ".") + 1);
					switch (strtolower($ext)) 
					{
						case 'jpeg': $banners[$i]['contenttype'] = 'jpeg';  break;
						case 'jpg':	 $banners[$i]['contenttype'] = 'jpeg';  break;
						case 'html': $banners[$i]['contenttype'] = 'html';  break;
						case 'png':  $banners[$i]['contenttype'] = 'png';   break;
						case 'gif':  $banners[$i]['contenttype'] = 'gif';   break;
						case 'swf':  $banners[$i]['contenttype'] = 'swf';   break;
					}
					
					// Store the file
					$banners[$i]['filename']	 = basename($banners[$i]['banner']);
					$banners[$i]['imageurl']	 = $banners[$i]['banner'];
					
					$banners[$i]['htmltemplate'] = phpAds_getBannerTemplate($banners[$i]['contenttype']);
					$banners[$i]['htmlcache']    = addslashes(phpAds_getBannerCache($banners[$i]));
					$banners[$i]['htmltemplate'] = addslashes($banners[$i]['htmltemplate']);

					$banners[$i]['banner']		 = '';
					break;
				
				case 'url':
					// Get the contenttype
					$ext = parse_url($banners[$i]['banner']);
					$ext = $ext['path'];
					$ext = substr($ext, strrpos($ext, ".") + 1);
					switch (strtolower($ext)) 
					{
						case 'jpeg': $banners[$i]['contenttype'] = 'jpeg';  break;
						case 'jpg':	 $banners[$i]['contenttype'] = 'jpeg';  break;
						case 'html': $banners[$i]['contenttype'] = 'html';  break;
						case 'png':  $banners[$i]['contenttype'] = 'png';   break;
						case 'gif':  $banners[$i]['contenttype'] = 'gif';   break;
						case 'swf':  $banners[$i]['contenttype'] = 'swf';   break;
					}
					
					$banners[$i]['imageurl']	 = $banners[$i]['banner'];
					
					$banners[$i]['htmltemplate'] = phpAds_getBannerTemplate($banners[$i]['contenttype']);
					$banners[$i]['htmlcache']    = addslashes(phpAds_getBannerCache($banners[$i]));
					$banners[$i]['htmltemplate'] = addslashes($banners[$i]['htmltemplate']);

					$banners[$i]['filename']	 = '';
					$banners[$i]['banner']		 = '';
					break;
				
				case 'html':
					// Get the contenttype
					$banners[$i]['contenttype']  = 'html';
					
					$banners[$i]['htmltemplate'] = stripslashes($banners[$i]['banner']);
					$banners[$i]['htmlcache']    = addslashes(phpAds_getBannerCache($banners[$i]));
					$banners[$i]['htmltemplate'] = addslashes($banners[$i]['htmltemplate']);

					$banners[$i]['imageurl']	 = '';
					$banners[$i]['filename']	 = '';
					$banners[$i]['banner']		 = '';
					break;
			}
			
			// Update the banner
			$res = phpAds_dbQuery ("
				UPDATE
					".$phpAds_config['tbl_banners']."
				SET
					storagetype = '".$banners[$i]['storagetype']."',
					contenttype = '".$banners[$i]['contenttype']."',
					filename = '".$banners[$i]['filename']."',
					imageurl = '".$banners[$i]['imageurl']."',
					htmltemplate = '".$banners[$i]['htmltemplate']."',
					htmlcache = '".$banners[$i]['htmlcache']."',
					alt = '".$banners[$i]['alt']."',
					status = '".$banners[$i]['status']."',
					bannertext = '".$banners[$i]['bannertext']."',
					keyword = '".$banners[$i]['keyword']."'
				WHERE
					bannerid = ".$banners[$i]['bannerid']."
			") or phpAds_sqlDie();
		}
		
		// Drop temporary table
		$res = phpAds_dbQuery ("DROP TABLE phppgads_splitbanners");
	}
}

function phpAds_upgradeDetectPluginVersion ()
{
	global $phpAds_config;
	
	// Include swf library
	include ("lib-swf.inc.php");
	
	// Check if plugin detection is needed
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.055)
	{
		$banners = array();

		// Fetch all banners
		$res = phpAds_dbQuery ("SELECT * FROM ".$phpAds_config['tbl_banners']);
		
		while ($row = phpAds_dbFetchArray($res))
			$banners[] = $row;
		
		for ($i=0; $i < count($banners); $i++)
		{
			if ($banners[$i]['storagetype'] == 'sql' ||
				$banners[$i]['storagetype'] == 'web')
			{
				$pluginversion = 0;
				$htmltemplate = $banners[$i]['htmltemplate'];
				
				
				if ($banners[$i]['contenttype'] == 'swf')
				{
					// Determine version
					$swf_file = phpAds_ImageRetrieve ($banners[$i]['storagetype'], $banners[$i]['filename']);
					$pluginversion = phpAds_SWFVersion($swf_file);
					
					// Update template
					$htmltemplate = ereg_replace ("#version=[^\']*'", "#version={pluginversion:4,0,0,0}'", $htmltemplate);
				}
				elseif ($banners[$i]['contenttype'] == 'dcr')
				{
					// Update template
					$htmltemplate = ereg_replace ("#version=[^\']*'", "#version={pluginversion:8,5,0,321}'", $htmltemplate);
				}
				
				
				$htmltemplate = addslashes ($htmltemplate);
				
				// Update the banner
				$res = phpAds_dbQuery ("
					UPDATE
						".$phpAds_config['tbl_banners']."
					SET
						pluginversion = '".$pluginversion."',
						htmltemplate = '".$htmltemplate."'
					WHERE
						bannerid = ".$banners[$i]['bannerid']."
				");
			}
		}
	}
}

function phpAds_upgradeHTMLCache ()
{
	global $phpAds_config;
	
	$res = phpAds_dbQuery("
		SELECT
			*
		FROM
			".$phpAds_config['tbl_banners']."
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

function phpAds_upgradeAppendZones ()
{
	global $phpAds_config;
	
	// Check if md5 adding is needed
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.072)
	{
		$res = phpAds_dbQuery("
				SELECT
					zoneid,
					append
				FROM
					".$phpAds_config['tbl_zones']."
				WHERE
					appendtype = ".phpAds_ZoneAppendRaw."
			");

		while ($row = phpAds_dbFetchArray($res))
		{
			$append = phpAds_ZoneParseAppendCode($row['append']);

			if ($append[0]['zoneid'])
			{
				phpAds_dbQuery("
						UPDATE
							".$phpAds_config['tbl_zones']."
						SET
							appendtype = ".phpAds_ZoneAppendZone."
						WHERE
							zoneid = '".$row['zoneid']."'
					");
			}
		}
	}
}

function phpAds_upgradeDisplayLimitationsPrepare ()
{
	global $phpAds_config;

	// Check if splitting is needed
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.125)
	{
		// Backup needed data into a temporary table
		phpAds_dbQuery ("DROP TABLE phppgads_upgrade_acls");
		phpAds_dbQuery ("SELECT * INTO phppgads_upgrade_acls FROM ".$phpAds_config['tbl_acls']) or phpAds_sqlDie();
	}
}

function phpAds_upgradeDisplayLimitations()
{
	global $phpAds_config;
	
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.125)
	{
		$res = phpAds_dbQuery("
				SELECT
					*
				FROM
					phppgads_upgrade_acls
		");
		
		
		while ($row = phpAds_dbFetchArray($res))
		{
			$data['logical'] 		= $row['acl_con'];
			$data['type']	 		= $row['acl_type'];
			$data['executionorder'] = $row['acl_order'];
			$data['data']			= addslashes($row['acl_data']);
			$data['comparison']		= $row['acl_ad'] == 'allow' ? '==' : '!=';
			
			phpAds_dbQuery("
				INSERT INTO
					".$phpAds_config['tbl_acls']." (
						bannerid,
						logical,
						type,
						executionorder,
						data,
						comparison
					) VALUES (
						'".$row['bannerid']."',
						'".$row['acl_con']."',
						'".$row['acl_type']."',
						'".$row['acl_order']."',
						'".addslashes($row['acl_data'])."',
						'".($row['acl_ad'] == 'allow' ? '==' : '!=')."'
					)
			");
		}
		

		// Drop temporary table
		phpAds_dbQuery("
			DROP TABLE 
				phppgads_upgrade_acls
		");
	}
}

function phpAds_upgradeTargetStats ()
{
	global $phpAds_config;

	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.117)
	{
		$res = phpAds_dbQuery("
			SELECT
				timestamp,
				details
			FROM
				".$phpAds_config['tbl_userlog']."
			WHERE
				action = 11
			ORDER BY
				timestamp
			");

		while ($row = phpAds_dbFetchArray($res))
		{
			while (ereg('\[id([0-9]+)\]: ([0-9]+)', $row['details'], $match))
			{
				$day = date('Y-m-d', $row['timestamp']);
				if (!isset($start))
					$start = $row['timestamp'];
				
				$autotargets[$day][$match[1]]['target'] = $match[2];
			
				$row['details'] = str_replace($match[0], '', $row['details']);
			}
		}

		if (!isset($start))
			// No autotargeting logs, exit
			return;
		
		phpAds_dbQuery("BEGIN");
		
		$t_stamp = mktime(0, 0, 0, date('m', $start), date('d', $start), date('Y', $start));
		$t_stamp_now = mktime(0, 0, 0, date('m'), date('d'), date('Y'));

		while ($t_stamp < $t_stamp_now)
		{
			$day = date('Y-m-d', $t_stamp);

			$campaigns = array();

			if (isset($autotargets[$day]))
			{
				while (list($campaignid, ) = each($autotargets[$day]))
				{
					$campaigns[] = $campaignid;

					if ($phpAds_config['compact_stats'])
					{
						$res_views = phpAds_dbQuery("
							SELECT
								SUM(views) AS sum_views
							FROM
								".$phpAds_config['tbl_adstats']." AS v,
								".$phpAds_config['tbl_banners']." AS b
							WHERE
								v.day = '".$day."' AND
								b.bannerid = v.bannerid AND
								b.clientid = ".$campaignid."
							");
					}
					else
					{
						$res_views = phpAds_dbQuery("
							SELECT
								COUNT(*) AS sum_views
							FROM
								".$phpAds_config['tbl_adviews']." AS v,
								".$phpAds_config['tbl_banners']." AS b
							WHERE
								v.t_stamp >= '".$day." 00:00:00' AND
								v.t_stamp <= '".$day." 23:59:59' AND
								b.bannerid = v.bannerid AND
								b.clientid = ".$campaignid."
							");
					}
					
					if ($views = phpAds_dbResult($res_views, 0, 0))
						$autotargets[$day][$campaignid]['views'] = $views;
				}
			}
			
			if (count($campaigns))
			{
				if ($phpAds_config['compact_stats'])
				{
					$res_views = phpAds_dbQuery("
						SELECT
							SUM(views) AS sum_views
						FROM
							".$phpAds_config['tbl_adstats']." AS v,
							".$phpAds_config['tbl_banners']." AS b
						WHERE
							v.day = '".$day."' AND
							b.bannerid = v.bannerid AND
							b.clientid NOT IN (".join(', ', $campaigns).")
						");
				}
				else
				{
					$res_views = phpAds_dbQuery("
						SELECT
							COUNT(*) AS sum_views
						FROM
							".$phpAds_config['tbl_adviews']." AS v,
							".$phpAds_config['tbl_banners']." AS b
						WHERE
							v.t_stamp >= '".$day." 00:00:00' AND
							v.t_stamp <= '".$day." 23:59:59' AND
							b.bannerid = v.bannerid AND
							b.clientid NOT IN (".join(', ', $campaigns).")
						");
				}
			}
			else
			{
				if ($phpAds_config['compact_stats'])
				{
					$res_views = phpAds_dbQuery("
						SELECT
							SUM(views) AS sum_views
						FROM
							".$phpAds_config['tbl_adstats']." AS v
						WHERE
							v.day = '".$day."'
						");
				}
				else
				{
					$res_views = phpAds_dbQuery("
						SELECT
							COUNT(*) AS sum_views
						FROM
							".$phpAds_config['tbl_adviews']." AS v
						WHERE
							v.t_stamp >= '".$day." 00:00:00' AND
							v.t_stamp <= '".$day." 23:59:59'
						");
				}
			}
			
			$views = phpAds_dbResult($res_views, 0, 0);
			$autotargets[$day][0]['views'] = $views ? $views : 0;

			$t_stamp = phpAds_makeTimestamp($t_stamp, 60*60*24);
		}
		
		foreach (array_keys($autotargets) as $day)
		{
			reset($autotargets[$day]);
			while (list($campaignid, $value) = each($autotargets[$day]))
			{
				phpAds_dbQuery("
					INSERT INTO
						".$phpAds_config['tbl_targetstats']." (
							day,
							clientid,
							target,
							views
						) VALUES (
							'".$day."',
							".$campaignid.",
							".(isset($value['target']) ? (int)$value['target'] : 0).",
							".(isset($value['views']) ? (int)$value['views'] : 0)."
						)
					");
			}
		}

		phpAds_dbQuery("COMMIT");
	}
}

function phpAds_upgradePasswordMD5 ()
{
	global $phpAds_config;
	
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.152)
	{
		// Update the advertisers
		$res = phpAds_dbQuery("
			SELECT
				clientid,
				clientpassword
			FROM
				".$phpAds_config['tbl_clients']."
			WHERE
				parent IS NULL
			");
		
		while ($row = phpAds_dbFetchArray($res))
		{
			if (strlen($row['clientpassword']))
				phpAds_dbQuery("
					UPDATE
						".$phpAds_config['tbl_clients']."
					SET
						clientpassword = '".addslashes(md5($row['clientpassword']))."'
					WHERE
						clientid = ".$row['clientid']."
				");
		}

		// Update the publishers
		$res = phpAds_dbQuery("
			SELECT
				affiliateid,
				password
			FROM
				".$phpAds_config['tbl_affiliates']."
			");
		
		while ($row = phpAds_dbFetchArray($res))
		{
			if (strlen($row['password']))
				phpAds_dbQuery("
					UPDATE
						".$phpAds_config['tbl_affiliates']."
					SET
						password = '".addslashes(md5($row['password']))."'
					WHERE
						affiliateid = ".$row['affiliateid']."
				");
		}

		// Update the administrator
		$res = phpAds_dbQuery ("
			UPDATE
				".$phpAds_config['tbl_config']."
			SET
				admin_pw = '".addslashes(md5($phpAds_config['admin_pw']))."'
		");
	}
}

function phpAds_upgradeTransparentSWF()
{
	global $phpAds_config;
	
	if (!isset($phpAds_config['config_version']) ||	$phpAds_config['config_version'] < 200.248)
	{
		// Update custom SWF templates which have wmode=transparent
		phpAds_dbQuery("UPDATE ".$phpAds_config['tbl_banners']." SET transparent = 't' WHERE contenttype = 'swf' AND htmltemplate LIKE '%wmode%'");
		
		// Update HTML tenplate for SWF banners
		phpAds_dbQuery("UPDATE ".$phpAds_config['tbl_banners']." SET htmltemplate = '".
			addslashes(phpAds_getBannerTemplate('swf'))."' WHERE contenttype = 'swf'");
	}
}

function phpPgAds_setTablePermissions ($name)
{
	global $phpAds_config;

	phpAds_dbQuery('REVOKE ALL ON '.$name.' FROM PUBLIC');
	phpAds_dbQuery('GRANT ALL ON '.$name.' TO "'.$phpAds_config['dbuser'].'"');
}

// PostgreSQL queries
define ('phpAds_pgShowTables', "
SELECT c.relname as \"name\", 'table'::text as \"type\", u.usename as \"owner\"
FROM pg_class c, pg_user u
WHERE c.relowner = u.usesysid AND c.relkind = 'r'
  AND c.relname !~ '^pg_'
UNION
SELECT c.relname as \"name\", 'table'::text as \"type\", NULL as \"owner\"
FROM pg_class c
WHERE c.relkind = 'r'
  AND not exists (select 1 from pg_user where usesysid = c.relowner)
  AND c.relname !~ '^pg_'
");

define ('phpAds_pgShowViews', "
SELECT c.relname as \"name\", 'view'::text as \"type\", u.usename as \"owner\"
FROM pg_class c, pg_user u
WHERE c.relowner = u.usesysid AND c.relkind = 'v'
  AND c.relname !~ '^pg_'
UNION
SELECT c.relname as \"name\", 'view'::text as \"type\", NULL as \"owner\"
FROM pg_class c
WHERE c.relkind = 'v'
  AND not exists (select 1 from pg_user where usesysid = c.relowner)
  AND c.relname !~ '^pg_'
");

define ('phpAds_pgShowSequences', "
SELECT c.relname as \"name\",
  (CASE WHEN relkind = 'S' THEN 'sequence'::text ELSE 'index'::text END) as \"type\",
  u.usename as \"owner\"
FROM pg_class c, pg_user u
WHERE c.relowner = u.usesysid AND relkind in ('S')
  AND c.relname !~ '^pg_'
UNION
SELECT c.relname as \"name\",
  (CASE WHEN relkind = 'S' THEN 'sequence'::text ELSE 'index'::text END) as \"type\",
  NULL as \"owner\"
FROM pg_class c
WHERE not exists (select 1 from pg_user where usesysid = c.relowner) AND relkind
 in ('S')
  AND c.relname !~ '^pg_'
");

?>
