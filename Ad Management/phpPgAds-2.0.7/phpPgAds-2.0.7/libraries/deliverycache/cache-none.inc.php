<?php // $Revision: 1.1.2.4 $

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


// Set define to prevent duplicate include
define ('LIBVIEWCACHE_INCLUDED', true);


function phpAds_cacheFetch ($name)
{
	return false;
}

function phpAds_cacheStore ($name, $cache)
{
	return false;
}

function phpAds_cacheDelete ($name = '')
{
	return true;
}

function phpAds_cacheInfo ()
{
	return false;
}


?>