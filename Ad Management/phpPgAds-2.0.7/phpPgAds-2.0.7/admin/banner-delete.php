<?php // $Revision: 2.0.2.4 $

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
require ("lib-storage.inc.php");
require ("lib-zones.inc.php");
require ("lib-statistics.inc.php");
require ("../libraries/lib-priority.inc.php");


// Register input variables
phpAds_registerGlobal ('returnurl');


// Security check
phpAds_checkAccess(phpAds_Admin);



/*********************************************************/
/* Main code                                             */
/*********************************************************/

if (isset($bannerid) && $bannerid != '')
{
	// Cleanup webserver and PostgreSQL stored image
	$res = phpAds_dbQuery("
		SELECT
			storagetype, filename
		FROM
			".$phpAds_config['tbl_banners']."
		WHERE
			bannerid = '$bannerid'
	") or phpAds_sqlDie();

	if ($row = phpAds_dbFetchArray($res))
	{
		if (($row['storagetype'] == 'web' || $row['storagetype'] == 'sql') && $row['filename'] != '')
			phpAds_ImageDelete ($row['storagetype'], $row['filename']);
	}
	
	// Delete banner
	$res = phpAds_dbQuery("
		DELETE FROM
			".$phpAds_config['tbl_banners']."
		WHERE
			bannerid = '$bannerid'
		") or phpAds_sqlDie();

	// Delete statistics for this banner
	phpAds_deleteStats($bannerid);
}

// Rebuild priorities
phpAds_PriorityCalculate ();


// Rebuild cache
if (!defined('LIBVIEWCACHE_INCLUDED')) 
	include (phpAds_path.'/libraries/deliverycache/cache-'.$phpAds_config['delivery_caching'].'.inc.php');

phpAds_cacheDelete();


if (!isset($returnurl) && $returnurl == '')
	$returnurl = 'campaign-banners.php';

// Prevent HTTP response splitting
if (strpos($returnurl, "\r\n") === false)
{
	$url = stripslashes($returnurl);

	header("Location: ".$returnurl."?clientid=".$clientid."&campaignid=".$campaignid);
}

?>
