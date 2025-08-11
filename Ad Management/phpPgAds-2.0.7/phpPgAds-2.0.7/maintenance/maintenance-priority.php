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



// Prevent full path disclosure
if (!defined('phpAds_path')) die();



// Include required files
require	(phpAds_path."/libraries/lib-priority.inc.php"); 


$report = phpAds_PriorityCalculate();

if ($report != '' && $phpAds_config['userlog_priority'])
	phpAds_userlogAdd (phpAds_actionPriorityCalculation, 0, $report);

?>