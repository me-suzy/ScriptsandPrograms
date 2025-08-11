<?php // $Revision: 2.0.2.5 $

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



if ($phpAds_config['auto_clean_tables_vacuum'])
{
	include ('../admin/lib-install-db.inc.php');
	
	// Read database structure
	$dbstructure = phpAds_prepareDatabaseStructure();

	$report = '';	
	while (list($k,) = each($dbstructure))
	{
		phpAds_dbQuery("VACUUM ANALYZE $k");
		
		$report .= "Table $k vacuumed and analyzed\n";
	}
	
	if ($report != '' && $phpAds_config['userlog_autoclean'])
		phpAds_userlogAdd (phpAds_actionAutoClean, 0, $report);
}

?>
