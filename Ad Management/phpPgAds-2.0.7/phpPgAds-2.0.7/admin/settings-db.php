<?php // $Revision: 2.1.2.5 $

/************************************************************************/
/* phpPgAds                                                             */
/* ========                                                             */
/*                                                                      */
/* Copyright (c) 2001 by the phpPgAds developers                        */
/* http://www.greatbridge.org/project/phppgads/                         */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



// Include required files
include ("lib-settings.inc.php");


// Register input variables
phpAds_registerGlobal ('save_settings', 'dblocal', 'dbhost', 'dbport', 'dbuser', 'dbpassword', 'dbname', 
					   'persistent_connections', 'insert_delayed', 
					   'compatibility_mode', 'auto_clean_tables_vacuum');


// Security check
phpAds_checkAccess(phpAds_Admin);


$errormessage = array();
$sql = array();

if (isset($save_settings) && $save_settings != '')
{
	if (isset($dbpassword) && ereg('^\*+$', $dbpassword))
		$dbpassword = $phpAds_config['dbpassword'];
	
	if ((isset($dblocal) || (isset($dbhost) && isset($dbport))) && isset($dbuser) && isset($dbpassword) && isset($dbname))
	{
		phpAds_dbClose();
		
		unset($phpAds_db_link);
		
		$phpAds_config['dblocal'] = isset($dblocal) ? true : false;
		$phpAds_config['dbhost'] = $phpAds_config['dblocal'] ? 'localhost' : $dbhost;
		$phpAds_config['dbport'] = $phpAds_config['dblocal'] ? 5432 : $dbport;
		$phpAds_config['dbuser'] = $dbuser;
		$phpAds_config['dbpassword'] = $dbpassword;
		$phpAds_config['dbname'] = $dbname;
		$phpAds_config['persistent_connections'] = isset($persistent_connections) ? true : false;
		$phpAds_config['auto_clean_tables_vacuum'] = isset($auto_clean_tables_vacuum) ? true : false;
		
		if (!phpAds_dbConnect(true))
			$errormessage[0][] = $strCantConnectToDb;
		else
		{
			phpAds_SettingsWriteAdd('dblocal', isset($dblocal));
			phpAds_SettingsWriteAdd('dbhost', $phpAds_config['dbhost']);
			phpAds_SettingsWriteAdd('dbport', $phpAds_config['dbport']);
			phpAds_SettingsWriteAdd('dbuser', $dbuser);
			phpAds_SettingsWriteAdd('dbpassword', $dbpassword);
			phpAds_SettingsWriteAdd('dbname', $dbname);
			
			phpAds_SettingsWriteAdd('persistent_connections', isset($persistent_connections));
		}
	}
	
	//phpAds_SettingsWriteAdd('insert_delayed', isset($insert_delayed));
	//phpAds_SettingsWriteAdd('compatibility_mode', isset($compatibility_mode));
	phpAds_SettingsWriteAdd('auto_clean_tables_vacuum', isset($auto_clean_tables_vacuum));
	
	
	if (!count($errormessage))
	{
		if (phpAds_SettingsWriteFlush())
		{
			header("Location: settings-invocation.php");
			exit;
		}
	}
}



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PrepareHelp();
phpAds_PageHeader("5.1");
phpAds_ShowSections(array("5.1", "5.3", "5.4", "5.2"));
phpAds_SettingsSelection("db");



// Fix dblocal settings
if (!$phpAds_config['dblocal'] && !$phpAds_config['dbhost'])
{
	$phpAds_config['dblocal'] = true;
	$phpAds_config['dbhost'] = 'localhost';
}



/*********************************************************/
/* Cache settings fields and get help HTML Code          */
/*********************************************************/

$settings = array (

array (
	'text' 	  => $strDatabaseServer,
	'items'	  => array (
		array (
			'type' 	  => 'checkbox', 
			'name' 	  => 'dblocal',
			'text' 	  => $strDbLocal,
			'req'	  => true
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'text', 
			'name' 	  => 'dbhost',
			'text' 	  => $strDbHost,
			'req'     => false,
			'depends' => 'dblocal==false'
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'text', 
			'name' 	  => 'dbport',
			'text' 	  => $strDbPort,
			'req'     => false,
			'depends' => 'dblocal==false'
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'text', 
			'name' 	  => 'dbuser',
			'text' 	  => $strDbUser,
			'req'	  => true
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'password', 
			'name' 	  => 'dbpassword',
			'text' 	  => $strDbPassword,
			'req'	  => true
		),
		array (
			'type'    => 'break'
		),
		array (
			'type' 	  => 'text', 
			'name' 	  => 'dbname',
			'text' 	  => $strDbName,
			'req'	  => $phpAds_productname == 'phpAdsNew'
		)
	)
),
array (
	'text' 	  => $strDatabaseOptimalisations,
	'items'	  => array (
		array (
			'type'    => 'checkbox',
			'name'    => 'persistent_connections',
			'text'	  => $strPersistentConnections
		),
		array (
			'type'    => 'checkbox',
			'name'    => 'insert_delayed',
			'text'	  => $strInsertDelayed,
			'visible' => $phpAds_productname == 'phpAdsNew'
		),
		array (
			'type'    => 'checkbox',
			'name'    => 'compatibility_mode',
			'text'	  => $strCompatibilityMode,
			'visible' => $phpAds_productname == 'phpAdsNew'
		),
		array (
			'type'    => 'checkbox',
			'name'    => 'auto_clean_tables_vacuum',
			'text'	  => $strAutoCleanVacuum,
			'visible' => $phpAds_productname == 'phpPgAds'
		)
	)
));



/*********************************************************/
/* Main code                                             */
/*********************************************************/

phpAds_ShowSettings($settings, $errormessage);



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageFooter();

?>
