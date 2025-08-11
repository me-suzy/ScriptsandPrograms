<?php // $Revision: 2.0 $



/************************************************************************/

/* phpAdsNew 2                                                          */

/* ===========                                                          */

/*                                                                      */

/* Copyright (c) 2000-2005 by the phpAdsNew developers                  */

/* For more information visit: http://www.phpadsnew.com                 */

/*                                                                      */

/* This program is free software. You can redistribute it and/or modify */

/* it under the terms of the GNU General Public License as published by */

/* the Free Software Foundation; either version 2 of the License.       */

/************************************************************************/





// Main strings

$GLOBALS['strChooseSection']			= "¿µ¿ª ¼±ÅÃ";





// Priority

$GLOBALS['strRecalculatePriority']		= "¿ì¼±¼øÀ§ ´Ù½Ã °è»ê";

$GLOBALS['strHighPriorityCampaigns']		= "³ôÀº ¿ì¼±¼øÀ§ Ä·ÆäÀÎ";

$GLOBALS['strAdViewsAssigned']			= "ÇÒ´çµÈ AdViews";

$GLOBALS['strLowPriorityCampaigns']		= "³·Àº ¿ì¼±¼øÀ§ Ä·ÆäÀÎ";

$GLOBALS['strPredictedAdViews']			= "¿¹»ó AdViews";

$GLOBALS['strPriorityDaysRunning']		= "ÀÏÀÏ ¿¹»óÄ¡¸¦ ±âÁØÀ¸·Î {days}ÀÏ Á¤µµ ³²¾ÆÀÖ½À´Ï´Ù.";

$GLOBALS['strPriorityBasedLastWeek']		= "Áö³­ÁÖ¿Í ±ÝÁÖÀÇ µ¥ÀÌÅÍ¸¦ Åä´ë·Î ¿¹»ó ³ëÃâ¼ö °è»ê. ";

$GLOBALS['strPriorityBasedLastDays']		= "ÃÖ±Ù ¸çÄ¥°£ÀÇ µ¥ÀÌÅÍ¸¦ Åä´ë·Î ¿¹»ó ³ëÃâ¼ö °è»ê. ";

$GLOBALS['strPriorityBasedYesterday']		= "¾îÁ¦ µ¥ÀÌÅÍ¸¦ ±âÁØÀ¸·Î ¿¹»ó ³ëÃâ¼ö °è»ê. ";

$GLOBALS['strPriorityNoData']			= "There isn't enough data available to make a reliable prediction about the number of impressions this adserver will generate today. Priority assignments will be based on real time statistics only. ";

$GLOBALS['strPriorityEnoughAdViews']		= "There should be enough AdViews to fully satisfy the target all high priority campaigns. ";

$GLOBALS['strPriorityNotEnoughAdViews']		= "It isn't clear wether there will be enough AdViews served today to satisfy the target all high priority campaigns. ";





// Banner cache

$GLOBALS['strRebuildBannerCache']		= "¹è³Ê Ä³½Ã ´Ù½Ã ºôµå";

$GLOBALS['strBannerCacheExplaination']		= "

	The banner cache contains a copy of the HTML code which is used to display the banner. By using a banner cache it is possible to speed

	up the delivery of banners because the HTML code doesn't need to be generated every time a banner is being delivered. Because the

	banner cache contains hard coded URLs to the location of ".$phpAds_productname." and its banners, the cache needs to be updated

	everytime ".$phpAds_productname." is moved to another location on the webserver.

";





// Cache

$GLOBALS['strCache']			= "Àü´ÞÀ¯Áö Ä³½Ã";

$GLOBALS['strAge']				= "Age";

$GLOBALS['strRebuildDeliveryCache']			= "Àü´ÞÀ¯Áö Ä³½Ã ´Ù½Ã ºôµå";

$GLOBALS['strDeliveryCacheExplaination']		= "

	Àü´ÞÀ¯Áö Ä³½Ã(delivery cache)´Â ¹è³Ê¸¦ ºü¸£°Ô Àü´ÞÇÏ±â À§ÇØ »ç¿ëÇÏ´Â ¹æ¹ýÀÌ´Ù.

	The cache contains a copy of all the banners

	which are linked to the zone which saves a number of database queries when the banners are actually delivered to the user. The cache

	is usually rebuild everytime a change is made to the zone or one of it's banners, it is possible the cache will become outdated. Because

	of this the cache will automatically rebuild every hour, but it is also possible to rebuild the cache manually.

";

$GLOBALS['strDeliveryCacheSharedMem']		= "

	ÇöÀç Àü´ÞÀ¯Áö Ä³½Ã¸¦ ÀúÀåÇÏ±â À§ÇØ °øÀ¯ ¸Þ¸ð¸®¸¦ »ç¿ëÇÏ°í ÀÖ½À´Ï´Ù. ";

$GLOBALS['strDeliveryCacheDatabase']		= "

  ÇöÀç Àü´ÞÀ¯Áö Ä³½Ã¸¦ ÀúÀåÇÏ±â À§ÇØ µ¥ÀÌÅÍº£ÀÌ½º¸¦ »ç¿ëÇÏ°í ÀÖ½À´Ï´Ù. ";





// Storage

$GLOBALS['strStorage']				= "ÀúÀå¿µ¿ª";

$GLOBALS['strMoveToDirectory']			= "µ¥ÀÌÅÍº£ÀÌ½º¿¡ ÀúÀåµÈ ÀÌ¹ÌÁö¸¦ µð·ºÅÍ¸®·Î ¿Å±â±â";

$GLOBALS['strStorageExplaination']		= "

	·ÎÄÃ ¹è³Ê·Î »ç¿ëÇÏ´Â ÀÌ¹ÌÁö´Â µ¥ÀÌÅÍº£ÀÌ½º ¶Ç´Â µð·ºÅÍ¸®¿¡ ÀúÀåµÇ¾î ÀÖ½À´Ï´Ù. ÀÌ¹ÌÁö¸¦ µð·ºÅÍ¸®¿¡ ÀúÀåÇÑ °æ¿ì¿¡´Â µ¥ÀÌÅÍº£ÀÌ½º¿¡ ´ëÇÑ ºÎÇÏ¸¦ ÁÙÀÓÀ¸·Î½á ¼Óµµ¸¦ Çâ»ó½ÃÅ³ ¼ö ÀÖ½À´Ï´Ù.";





// Storage

$GLOBALS['strStatisticsExplaination']		= "

	You have enabled the <i>compact statistics</i>, but your old statistics are still in verbose format. 

	Do you want to convert your verbose statistics to the new compact format?

";





// Product Updates

$GLOBALS['strSearchingUpdates']			= "¾÷µ¥ÀÌÆ®¸¦ °Ï»öÁßÀÔ´Ï´Ù. Àá½Ã ±â´Ù·ÁÁÖ½Ê½Ã¿À...";

$GLOBALS['strAvailableUpdates']			= "ÀÌ¿ëÇÒ ¼ö ÀÖ´Â ¾÷µ¥ÀÌÆ®";

$GLOBALS['strDownloadZip']			= "´Ù¿î·Îµå(.zip)";

$GLOBALS['strDownloadGZip']			= "´Ù¿î·Îµå(.tar.gz)";



$GLOBALS['strUpdateAlert']			= $phpAds_productname."ÀÇ »õ ¹öÀüÀ» ÀÌ¿ëÇÒ ¼ö ÀÖ½À´Ï´Ù.\\n\\n»õ ¾÷µ¥ÀÌÆ®¿¡ ´ëÇÑ ÀÚ¼¼ÇÑ Á¤º¸¸¦ º¸°Ú½À´Ï±î?";

$GLOBALS['strUpdateAlertSecurity']		= $phpAds_productname."ÀÇ »õ ¹öÀüÀ» ÀÌ¿ëÇÒ ¼ö ÀÖ½À´Ï´Ù.\\n\\n»õ ¹öÀüÀº ÇÏ³ª ¶Ç´Â ±× ÀÌ»óÀÇ º¸¾È ¼öÁ¤À» Æ÷ÇÔÇÏ°í ÀÖÀ¸¹Ç·Î °¡´ÉÇÑÇÑ »¡¸® ¾÷±×·¹ÀÌµåÇÒ °ÍÀ» ±ÇÇÕ´Ï´Ù.";



$GLOBALS['strUpdateServerDown']			= "

    Due to an unknown reason it isn't possible to retrieve <br>

	information about possible updates. Please try again later.

";



$GLOBALS['strNoNewVersionAvailable']		= "

	ÇöÀç »ç¿ëÁßÀÎ ".$phpAds_productname."ÀÇ ¹öÀüÀº ÃÖ½ÅÀÔ´Ï´Ù. ÇöÀç ÀÌ¿ëÇÒ ¼ö ÀÖ´Â ¾÷µ¥ÀÌÆ®°¡ ¾ø½À´Ï´Ù.

";



$GLOBALS['strNewVersionAvailable']		= "

	<b>A new version of ".$phpAds_productname." is available.</b><br> It is recommended to install this update,

	because it may fix some currently existing problems and will add new features. For more information

	about upgrading please read the documentation which is included in the files below.

";



$GLOBALS['strSecurityUpdate']			= "

	<b>It is highly recommended to install this update as soon as possible, because it contains a number

	of security fixes.</b> The version of ".$phpAds_productname." which you are currently using might 

	be vulnerable to certain attacks and is probably not secure. For more information

	about upgrading please read the documentation which is included in the files below.

";



$GLOBALS['strNotAbleToCheck']			= "

	<b>Because the XML extention isn't available on your server, ".$phpAds_productname." is not

    able to check if a newer version is available.</b>

";



$GLOBALS['strForUpdatesLookOnWebsite']	= "

	You are currently running ".$phpAds_productname." ".$phpAds_version_readable.". 

	If you want to know if there is a newer version available, please take a look at our website.

";



$GLOBALS['strClickToVisitWebsite']		= "

	Click here to visit our website

";





// Stats conversion

$GLOBALS['strConverting']			= "º¯È¯Áß";

$GLOBALS['strConvertingStats']			= "Åë°è¸¦ º¯È¯ÁßÀÔ´Ï´Ù...";

$GLOBALS['strConvertStats']			= "Åë°è º¯È¯";

$GLOBALS['strConvertAdViews']			= "AdViews º¯È¯,";

$GLOBALS['strConvertAdClicks']			= "AdClicks º¯È¯...";

$GLOBALS['strConvertNothing']			= "º¯È¯ÇÒ °ÍÀÌ ¾ø½À´Ï´Ù...";

$GLOBALS['strConvertFinished']			= "¿Ï·á...";



$GLOBALS['strConvertExplaination']		= "

	You are currently using the compact format to store your statistics, but there are <br>

	still some statistics in verbose format. As long as the verbose statistics aren't  <br>

	converted to compact format they will not be used while viewing these pages.  <br>

	Before converting your statistics, make a backup of the database!  <br>

	Do you want to convert your verbose statistics to the new compact format? <br>

";



$GLOBALS['strConvertingExplaination']		= "

	All remaining verbose statistics are now being converted to the compact format. <br>

	Depending on how many impressions are stored in verbose format this may take a  <br>

	couple of minutes. Please wait until the conversion is finished before you visit other <br>

	pages. Below you will see a log of all modification made to the database. <br>

";



$GLOBALS['strConvertFinishedExplaination']  	= "

	The conversion of the remaining verbose statistics was succesful and the data <br>

	should now be usable again. Below you will see a log of all modification made <br>

	to the database.<br>

";





?>