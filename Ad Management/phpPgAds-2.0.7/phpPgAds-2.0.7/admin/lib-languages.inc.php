<?php // $Revision: 2.0.2.2 $

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



/*********************************************************/
/* Returns available languages as array                  */
/*********************************************************/

function phpAds_AvailableLanguages()
{
	$languages = array();
	
	$langdir = opendir(phpAds_path.'/language/');
	while ($langfile = readdir($langdir))
	{
		if ($langfile{0} == '.')
				continue;
		
		if (is_dir(phpAds_path.'/language/'.$langfile) &&
			file_exists(phpAds_path.'/language/'.$langfile.'/index.lang.php'))
		{
			@include(phpAds_path.'/language/'.$langfile.'/index.lang.php');
			$languages[$langfile] = $translation_readable;
		}
	}
	closedir($langdir);
	asort($languages, SORT_STRING);
	
	return $languages;
}



/*********************************************************/
/* Returns available timezones                           */
/*********************************************************/

function phpAds_AvailableTZ()
{
	global $strDefault;
	
	$tz = array("" => $strDefault);
	
	if (file_exists('/usr/share/zoneinfo') && is_dir('/usr/share/zoneinfo'))
		$basedir = '/usr/share/zoneinfo/';
	else
		return $tz;
	
	$tzdir = opendir($basedir);
	while ($tzfile = readdir($tzdir))
	{
		if (is_dir($basedir.$tzfile))
		{
			if ($tzfile[0] == '.')
				continue;
			$tzdir2 = opendir($basedir.$tzfile);			
			while ($tzfile2 = readdir($tzdir2))
			{
				if ($tzfile2[0] == '.')
					continue;
				$tz[] = "$tzfile/$tzfile2";
			}				
			closedir($tzdir2);
		}
		else
			$tz[] = $tzfile;
	}	
	closedir($tzdir);

	asort($tz, SORT_STRING);
	
	return $tz;
}

?>