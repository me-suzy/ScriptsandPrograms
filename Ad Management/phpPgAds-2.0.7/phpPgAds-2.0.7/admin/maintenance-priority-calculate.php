<?php // $Revision: 2.0.2.3 $

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
require ("lib-statistics.inc.php");
require ("../libraries/lib-priority.inc.php");


// Security check
phpAds_checkAccess(phpAds_Admin);



/*********************************************************/
/* Main code                                             */
/*********************************************************/

$report = phpAds_PriorityCalculate();

if ($report != '' && $phpAds_config['userlog_priority'])
	phpAds_userlogAdd (phpAds_actionPriorityCalculation, 0, $report);


// Rebuild cache
if (!defined('LIBVIEWCACHE_INCLUDED')) 
	include (phpAds_path.'/libraries/deliverycache/cache-'.$phpAds_config['delivery_caching'].'.inc.php');

phpAds_cacheDelete();


Header("Location: maintenance-priority.php");

?>