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
require	("config.inc.php");

// Redirect to the admin interface
if (defined('phpAds_installed') && phpAds_installed)
	Header("Location: ".$phpAds_config['url_prefix']."/admin/index.php");
else
	Header("Location: admin/index.php");

?>