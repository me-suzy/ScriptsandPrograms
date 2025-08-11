<?php // $Revision: 1.1.2.8 $

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



// Include required files
require ("config.php");
require ("lib-maintenance.inc.php");
require ("lib-statistics.inc.php");
require ("lib-zones.inc.php");


// Security check
phpAds_checkAccess(phpAds_Admin);



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageHeader("5.3");
phpAds_ShowSections(array("5.1", "5.3", "5.4", "5.2"));
phpAds_MaintenanceSelection("mysqlimport");


/*********************************************************/
/* Main code                                             */
/*********************************************************/

echo "<br>";
echo '
Using this tool you will be able to import inventory and stats from a running phpAdsNew.
You will need to supply the config.inc.php file of the source phpAdsNew install.<br>
You can choose whether to retain current phpAdsNew entity IDs or remap and append them to your current '.$phpAds_productname.'
inventory.<br><br>
The phpAdsNew database will remain untouched.<br><br>
<b>This feature is currently EXPERIMENTAL.</b>
';
echo "<br><br>";

if (get_cfg_var ('safe_mode'))
{
	echo "<b>It seems you currenlty have PHP running in safe mode. You could not be able to run the
		import correctly!</b>";
	echo "<br><br>";
}

phpAds_ShowBreak();

echo "<form action='maintenance-mysqlimport-execute.php' method='post' enctype='multipart/form-data'>";
echo 'phpAdsNew config.inc.php file'.' ';
echo "<input name='altconfig' type='file'>";
phpAds_ShowBreak();
echo "<input name='retain_ids' type='checkbox' value='1'> Retain entity IDs<br>";

echo "<br><input type='submit' name='submit' value='Invia'></form>";



/*********************************************************/
/* HTML framework                                        */
/*********************************************************/

phpAds_PageFooter();

?>