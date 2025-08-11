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







// Installer translation strings

$GLOBALS['strInstall']				= "¼³Ä¡";

$GLOBALS['strChooseInstallLanguage']		= "¼³Ä¡¿¡ »ç¿ëÇÒ ¾ð¾î¸¦ ¼±ÅÃÇÏ¼¼¿ä.";

$GLOBALS['strLanguageSelection']		= "¾ð¾î ¼±ÅÃ";

$GLOBALS['strDatabaseSettings']			= "µ¥ÀÌÅÍº£ÀÌ½º ¼³Á¤";

$GLOBALS['strAdminSettings']			= "°ü¸®ÀÚ ¼³Á¤";

$GLOBALS['strAdvancedSettings']			= "°í±Þ ¼³Á¤";

$GLOBALS['strOtherSettings']			= "±âÅ¸ ¼³Á¤";



$GLOBALS['strWarning']				= "°æ°í";

$GLOBALS['strFatalError']			= "Ä¡¸íÀûÀÎ ¿À·ù°¡ ¹ß»ýÇß½À´Ï´Ù.";

$GLOBALS['strAlreadyInstalled']			= $phpAds_productname."ÀÌ ÀÌ¹Ì ½Ã½ºÅÛ¿¡ ¼³Ä¡µÇ¾î ÀÖ½À´Ï´Ù. ¼³Á¤À» ÇÏ·Á¸é <a href='settings-index.php'>¼³Á¤ ÀÎÅÍÆäÀÌ½º</a>¸¦ »ç¿ëÇÏ½Ê½Ã¿À.";

$GLOBALS['strCouldNotConnectToDB']		= "µ¥ÀÌÅÍº£ÀÌ½º¿¡ ¿¬°áÇÒ ¼ö ¾ø½À´Ï´Ù. ÀÔ·ÂÇÑ ¼³Á¤ÀÌ ¸Â´ÂÁö ´Ù½Ã È®ÀÎÇÏ½Ê½Ã¿À.";

$GLOBALS['strCreateTableTestFailed']		= "ÀÔ·ÂµÈ »ç¿ëÀÚ´Â µ¥ÀÌÅÍº£ÀÌ½º ±¸Á¶¸¦ »ý¼ºÇÏ°Å³ª ¾÷µ¥ÀÌÆ®ÇÒ ¼ö ÀÖ´Â ±ÇÇÑÀÌ ¾ø½À´Ï´Ù. µ¥ÀÌÅÍº£ÀÌ½º °ü¸®ÀÚ¿¡°Ô ¹®ÀÇÇÏ½Ê½Ã¿À.";

$GLOBALS['strUpdateTableTestFailed']		= "ÀÔ·ÂµÈ »ç¿ëÀÚ´Â µ¥ÀÌÅÍº£ÀÌ½º ±¸Á¶¸¦ ¾÷µ¥ÀÌÆ®ÇÒ ¼ö ÀÖ´Â ±ÇÇÑÀÌ ¾ø½À´Ï´Ù. µ¥ÀÌÅÍº£ÀÌ½º °ü¸®ÀÚ¿¡°Ô ¹®ÀÇÇÏ½Ê½Ã¿À..";

$GLOBALS['strTablePrefixInvalid']		= "Å×ÀÌºí Á¢µÎ¾î·Î »ç¿ëÇÒ ¼ö ¾ø´Â ¹®ÀÚ°¡ ÀÖ½À´Ï´Ù.";

$GLOBALS['strTableInUse']			= "ÁöÁ¤µÈ µ¥ÀÌÅÍº£ÀÌ½º´Â ÀÌ¹Ì".$phpAds_productname."¿¡¼­ »ç¿ëÇÏ°í ÀÖ½À´Ï´Ù. ´Ù¸¥ Å×ÀÌºí Á¢µÎ¾î¸¦ »ç¿ëÇÏ°Å³ª ¾÷±×·¹ÀÌµå ÁöÄ§¼­¸¦ Âü°íÇÏ½Ê½Ã¿À.";

$GLOBALS['strMayNotFunction']			= "°è¼Ó ÁøÇàÇÏ±â Àü¿¡ ¹®Á¦¸¦ ¼öÁ¤ÇÏ½Ê½Ã¿À. ¹®Á¦¸¦ ¼öÁ¤ÇÏÁö ¾Ê°í ÁøÇàÇÏ¸é ¹®Á¦°¡ ¹ß»ýÇÒ ¼ö ÀÖ½À´Ï´Ù:";

$GLOBALS['strIgnoreWarnings']			= "°æ°í ¹«½Ã";

$GLOBALS['strWarningDBavailable']		= "ÇöÀç »ç¿ëÁßÀÎ PHP´Â ".$phpAds_dbmsname." ¿¬°áÀ» Áö¿øÇÏÁö ¾Ê½À´Ï´Ù. PHP ".$phpAds_dbmsname." È®ÀåÀ» ¼³Ä¡ÇÑ ´ÙÀ½¿¡ °è¼Ó ÁøÇàÇÏ½Ê½Ã¿À.";

$GLOBALS['strWarningPHPversion']		= $phpAds_productname." requires PHP 4.0 or higher to function correctly. You are currently using {php_version}.";

$GLOBALS['strWarningRegisterGlobals']		= "PHP ¼³Á¤ º¯¼ö register_globals¸¦ ¼³Á¤ÇØ¾ß ÇÕ´Ï´Ù.";

$GLOBALS['strWarningMagicQuotesGPC']		= "PHP ¼³Á¤ º¯¼ö magic_quotes_gpc¸¦ ¼³Á¤ÇØ¾ß ÇÕ´Ï´Ù.";

$GLOBALS['strWarningMagicQuotesRuntime']	= "PHP ¼³Á¤ º¯¼ö magic_quotes_runtimeÀ» Á¦°ÅÇØ¾ßÇÕ´Ï´Ù.";

$GLOBALS['strWarningFileUploads']		= "PHP ¼³Á¤ º¯¼ö file_uploads¸¦ ¼³Á¤ÇØ¾ß ÇÕ´Ï´Ù.";

$GLOBALS['strConfigLockedDetected']		= $phpAds_productname." has detected that your <b>config.inc.php</b> file is not writeable by the server.<br> You can't proceed until you change permissions on the file. <br>Read the supplied documentation if you don't know how to do that.";

$GLOBALS['strCantUpdateDB']  			= "ÇöÀç µ¥ÀÌÅÍº£ÀÌ½º¸¦ °»½ÅÇÒ ¼ö ¾ø½À´Ï´Ù. °è¼Ó ÁøÇàÇÏ¸é ±âÁ¸¿¡ ¼³Á¤ÇÑ ¹è³Ê, Åë°è, ±¤°íÁÖ°¡ ¸ðµÎ »èÁ¦µË´Ï´Ù.";

$GLOBALS['strTableNames']			= "Å×ÀÌºí ÀÌ¸§";

$GLOBALS['strTablesPrefix']			= "Å×ÀÌºí Á¢µÎ¾î";

$GLOBALS['strTablesType']			= "Å×ÀÌºí Á¾·ù";



$GLOBALS['strInstallWelcome']			= "È¯¿µÇÕ´Ï´Ù. ".$phpAds_productname;

$GLOBALS['strInstallMessage']			= "Before you can use ".$phpAds_productname." it needs to be configured and <br> the database needs to be created. Click <b>Proceed</b> to continue.";

$GLOBALS['strInstallSuccess']			= "<b>The installation of ".$phpAds_productname." is now complete.</b><br><br>In order for ".$phpAds_productname." to function correctly you also need

						   to make sure the maintenance file is run every hour. More information about this subject can be found in the documentation.

						   <br><br>Click <b>Proceed</b> to go the configuration page, where you can 

						   set up more settings. Please do not forget to lock the config.inc.php file when you are finished to prevent security

						   breaches.";

$GLOBALS['strUpdateSuccess']			= "<b>The upgrade of ".$phpAds_productname." was succesfull.</b><br><br>In order for ".$phpAds_productname." to function correctly you also need

						   to make sure the maintenance file is run every hour (previously this was every day). More information about this subject can be found in the documentation.

						   <br><br>Click <b>Proceed</b> to go to the administration interface. Please do not forget to lock the config.inc.php file 

						   to prevent security breaches.";

$GLOBALS['strInstallNotSuccessful']		= "<b>The installation of ".$phpAds_productname." was not succesful</b><br><br>Some portions of the install process could not be completed.

						   It is possible these problems are only temporarily, in that case you can simply click <b>Proceed</b> and return to the

						   first step of the install process. If you want to know more on what the error message below means, and how to solve it, 

						   please consult the supplied documentation.";

$GLOBALS['strErrorOccured']			= "´ÙÀ½ ¿À·ù°¡ ¹ß»ýÇß½À´Ï´Ù:";

$GLOBALS['strErrorInstallDatabase']		= "µ¥ÀÌÅÍº£ÀÌ½º ±¸Á¶°¡ »ý¼ºµÇÁö ¾Ê¾Ò½À´Ï´Ù.";

$GLOBALS['strErrorInstallConfig']		= "¼³Á¤ ÆÄÀÏ ¶Ç´Â µ¥ÀÌÅÍº£ÀÌ½º¸¦ ¾÷µ¥ÀÌÆ®ÇÒ ¼ö ¾ø½À´Ï´Ù.";

$GLOBALS['strErrorInstallDbConnect']		= "µ¥ÀÌÅÍº£ÀÌ½º¿Í ¿¬°áÇÒ ¼ö ¾ø½À´Ï´Ù.";



$GLOBALS['strUrlPrefix']			= "URL Á¢µÎ¾î";



$GLOBALS['strProceed']				= "°è¼Ó &gt;";

$GLOBALS['strRepeatPassword']			= "ºñ¹Ð¹øÈ£ È®ÀÎ";

$GLOBALS['strNotSamePasswords']			= "ºñ¹Ð¹øÈ£°¡ ÀÏÄ¡ÇÏÁö ¾Ê½À´Ï´Ù.";

$GLOBALS['strInvalidUserPwd']			= "Àß¸øµÈ »ç¿ëÀÚ ID ¶Ç´Â ºñ¹Ð¹øÈ£ÀÔ´Ï´Ù.";



$GLOBALS['strUpgrade']				= "¾÷±×·¹ÀÌµå";

$GLOBALS['strSystemUpToDate']			= "½Ã½ºÅÛÀÇ ±¸¼º¿ä¼Ò°¡ ÀÌ¹Ì ÃÖ½Å ¹öÀüÀÔ´Ï´Ù. Áö±Ý ¾÷±×·¹ÀÌµåÇÒ ¼ö ¾ø½À´Ï´Ù.<br> È¨ÆäÀÌÁö·Î ÀÌµ¿ÇÏ·Á¸é <b>°è¼Ó</b>À» Å¬¸¯ÇÏ¼¼¿ä.";

$GLOBALS['strSystemNeedsUpgrade']		= "½Ã½ºÅÛÀÌ ¿Ã¹Ù¸£°Ô µ¿ÀÛÇÏ·Á¸é µ¥ÀÌÅÍº£ÀÌ½º ±¸Á¶¿Í ¼³Á¤ ÆÄÀÏÀ» ¾÷±×·¹ÀÌµåÇØ¾ß ÇÕ´Ï´Ù. ½Ã½ºÅÛÀ» ¾÷±×·¹ÀÌµåÇÏ±â À§ÇØ <b>°è¼Ó</b>À» Å¬¸¯ÇÏ½Ê½Ã¿À.<br>½Ã½ºÅÛÀ» ¾÷±×·¹ÀÌµåÇÏ´Â µ¥ ¸î ºÐ Á¤µµ °É¸± ¼ö ÀÖ½À´Ï´Ù.";

$GLOBALS['strSystemUpgradeBusy']		= "½Ã½ºÅÛÀ» ¾÷±×·¹ÀÌµåÁßÀÔ´Ï´Ù. Àá½Ã ±â´Ù·ÁÁÖ½Ê½Ã¿À...";

$GLOBALS['strSystemRebuildingCache']		= "Ä³½Ã¸¦ Àç±¸ÃàÁßÀÔ´Ï´Ù. Àá½Ã ±â´Ù·ÁÁÖ½Ê½Ã¿À...";

$GLOBALS['strServiceUnavalable']		= "½Ã½ºÅÛÀ» ¾÷±×·¹ÀÌµå ÁßÀÌ¹Ç·Î ¼­ºñ½º¸¦ Àá½Ãµ¿¾È ÀÌ¿ëÇÒ ¼ö ¾ø½À´Ï´Ù.";



$GLOBALS['strConfigNotWritable']		= "config.inc.php ÆÄÀÏ¿¡ ¾²±â¸¦ ÇÒ ¼ö ¾ø½À´Ï´Ù.";











/*********************************************************/

/* Configuration translations                            */

/*********************************************************/



// Global

$GLOBALS['strChooseSection']			= "¿µ¿ª ¼±ÅÃ";

$GLOBALS['strDayFullNames'] 			= array("ÀÏ¿äÀÏ","¿ù¿äÀÏ","È­¿äÀÏ","¼ö¿äÀÏ","¸ñ¿äÀÏ","±Ý¿äÀÏ","Åä¿äÀÏ");

$GLOBALS['strEditConfigNotPossible']   		= "º¸¾È»ó ¼³Á¤ ÆÄÀÏÀÌ Àá°ÜÀÖ±â ¶§¹®ÀÌ ¼³Á¤À» º¯°æÇÒ ¼ö ¾ø½À´Ï´Ù. ".

										  "¼³Á¤À» º¯°æÇÏ·Á¸é config.inc.php ÆÄÀÏÀÇ Àá±ÝÀ» ÇØÁ¦ÇÏ½Ê½Ã¿À.";

$GLOBALS['strEditConfigPossible']		= "¼³Á¤ ÆÄÀÏÀÌ Àá°ÜÀÖÁö ¾Ê±â ¶§¹®¿¡ ¸ðµç ¼³Á¤À» ÆíÁýÇÏ´Â °ÍÀÌ °¡´ÉÇÏÁö¸¸, ÀÌ·ÎÀÎÇØ º¸¾È ¹®Á¦°¡ ¹ß»ýÇÒ ¼ö ÀÖ½À´Ï´Ù.".

										  "½Ã½ºÅÛÀ» ¾ÈÀüÇÏ°Ô ÇÏ·Á¸é config.inc.php ÆÄÀÏ¿¡ Àá±ÝÀ» ¼³Á¤ÇØ¾ß ÇÕ´Ï´Ù.";







// Database

$GLOBALS['strDatabaseSettings']			= "µ¥ÀÌÅÍº£ÀÌ½º ¼³Á¤";

$GLOBALS['strDatabaseServer']			= "µ¥ÀÌÅÍº£ÀÌ½º ¼­¹ö";

$GLOBALS['strDbHost']				= "µ¥ÀÌÅÍº£ÀÌ½º È£½ºÆ®¸í";

$GLOBALS['strDbUser']				= "µ¥ÀÌÅÍº£ÀÌ½º »ç¿ëÀÚÀÌ¸§";

$GLOBALS['strDbPassword']			= "µ¥ÀÌÅÍº£ÀÌ½º ºñ¹Ð¹øÈ£";

$GLOBALS['strDbName']				= "µ¥ÀÌÅÍº£ÀÌ½º ÀÌ¸§";



$GLOBALS['strDatabaseOptimalisations']		= "µ¥ÀÌÅÍº£ÀÌ½º ÃÖÀûÈ­";

$GLOBALS['strPersistentConnections']		= "¿¬°á À¯Áö(persistent connection) »ç¿ë";

$GLOBALS['strInsertDelayed']			= "Áö¿¬µÈ »ðÀÔ »ç¿ë";

$GLOBALS['strCompatibilityMode']		= "µ¥ÀÌÅÍº£ÀÌ½º È£È¯ ¸ðµå »ç¿ë";

$GLOBALS['strCantConnectToDb']			= "µ¥ÀÌÅÍº£ÀÌ½º¿¡ ¿¬°áÇÒ ¼ö ¾ø½À´Ï´Ù.";







// Invocation and Delivery

$GLOBALS['strInvocationAndDelivery']		= "¹è³Ê È£Ãâ ¹× Àü´ÞÀ¯Áö ¼³Á¤";



$GLOBALS['strAllowedInvocationTypes']		= "Çã¿ëµÈ ¹è³Ê È£Ãâ Á¾·ù";

$GLOBALS['strAllowRemoteInvocation']		= "¿ø°Ý ¹è³Ê È£Ãâ Çã¿ë";

$GLOBALS['strAllowRemoteJavascript']		= "¿ø°Ý ¹è³Ê È£Ãâ Çã¿ë(Javascript)";

$GLOBALS['strAllowRemoteFrames']		= "¿ø°Ý ¹è³Ê È£Ãâ Çã¿ë(ÇÁ·¹ÀÓ)";

$GLOBALS['strAllowRemoteXMLRPC']		= "¹è³Ê È£Ãâ Çã¿ë(XML-RPC)";

$GLOBALS['strAllowLocalmode']			= "·ÎÄÃ ¸ðµå Çã¿ë";

$GLOBALS['strAllowInterstitial']		= "°ÝÀÚÇü(Interstitial) Çã¿ë";

$GLOBALS['strAllowPopups']			= "ÆË¾÷ Çã¿ë";



$GLOBALS['strUseAcl']				= "¹è³Ê Àü¼ÛÁß¿¡ Àü´Þ À¯Áö Á¦ÇÑ Æò°¡";



$GLOBALS['strDeliverySettings']			= "Àü´Þ À¯Áö ¼³Á¤";

$GLOBALS['strCacheType']				= "Àü´Þ À¯Áö Ä³½Ã Á¾·ù";

$GLOBALS['strCacheFiles']				= "ÆÄÀÏ";

$GLOBALS['strCacheDatabase']			= "µ¥ÀÌÅÍº£ÀÌ½º";

$GLOBALS['strCacheShmop']				= "°øÀ¯ ¸Þ¸ð¸®(shmop)";

$GLOBALS['strKeywordRetrieval']			= "Å°¿öµå °Ë»ö";

$GLOBALS['strBannerRetrieval']			= "¹è³Ê °Ë»ö ¹æ¹ý";

$GLOBALS['strRetrieveRandom']			= "·£´ý ¹è³Ê °Ë»ö(±âº»)";

$GLOBALS['strRetrieveNormalSeq']		= "¹è³Ê °Ë»ö(ÀÏ¹Ý)";

$GLOBALS['strWeightSeq']			= "°¡ÁßÄ¡·Î ¹è³Ê °Ë»ö";

$GLOBALS['strFullSeq']				= "ÀüÃ¼ ¹è³Ê °Ë»ö";

$GLOBALS['strUseConditionalKeys']		= "Á÷Á¢ ¼±ÅÃÀ» »ç¿ëÇÒ ¶§ ³í¸® ¿¬»êÀÚ¸¦ Çã¿ëÇÕ´Ï´Ù.";

$GLOBALS['strUseMultipleKeys']			= "Á÷Á¢ ¼±ÅÃÀ» »ç¿ëÇÒ ¶§ ´Ù¼öÀÇ Å°¿öµå¸¦ Çã¿ëÇÕ´Ï´Ù.";



$GLOBALS['strZonesSettings']			= "¿µ¿ª °Ë»ö";

$GLOBALS['strZoneCache']			= "Ä³½Ã ¿µ¿ª, Ä³½Ã ¿µ¿ªÀ» »ç¿ëÇÏ¸é ¿µ¿ªÀ» »ç¿ëÇÒ ¶§ ¼Óµµ¸¦ ºü¸£°Ô ÇÕ´Ï´Ù.";

$GLOBALS['strZoneCacheLimit']			= "Ä³½Ã ¾÷µ¥ÀÌÆ® °£°Ý(ÃÊ ´ÜÀ§)";

$GLOBALS['strZoneCacheLimitErr']		= "¾÷µ¥ÀÌÆ® °£°Ý¿¡´Â À½¼ö¸¦ »ç¿ëÇÒ ¼ö ¾ø½À´Ï´Ù.";



$GLOBALS['strP3PSettings']			= "P3P °³ÀÎ º¸È£ Á¤Ã¥";

$GLOBALS['strUseP3P']				= "P3P Á¤Ã¥ »ç¿ë";

$GLOBALS['strP3PCompactPolicy']			= "P3P Compact Á¤Ã¥";

$GLOBALS['strP3PPolicyLocation']		= "P3P Á¤Ã¥ À§Ä¡"; 







// Banner Settings

$GLOBALS['strBannerSettings']			= "¹è³Ê ¼³Á¤";



$GLOBALS['strAllowedBannerTypes']		= "¹è³Ê Çü½Ä";

$GLOBALS['strTypeSqlAllow']			= "·ÎÄÃ ¹è³Ê(SQL) - DB ÀúÀå ¹æ½Ä";

$GLOBALS['strTypeWebAllow']			= "·ÎÄÃ ¹è³Ê(À¥¼­¹ö) - À¥ ÀúÀå ¹æ½Ä";

$GLOBALS['strTypeUrlAllow']			= "¿ÜºÎ ¹è³Ê";

$GLOBALS['strTypeHtmlAllow']			= "HTML ¹è³Ê";

$GLOBALS['strTypeTxtAllow']			= "ÅØ½ºÆ® ±¤°í";



$GLOBALS['strTypeWebSettings']			= "·ÎÄÃ ¹è³Ê(À¥¼­¹ö) ¼³Á¤";

$GLOBALS['strTypeWebMode']			= "ÀúÀå ¹æ¹ý";

$GLOBALS['strTypeWebModeLocal']			= "·ÎÄÃ µð·ºÅÍ¸®";

$GLOBALS['strTypeWebModeFtp']			= "¿ÜºÎ FTP ¼­¹ö";

$GLOBALS['strTypeWebDir']			= "·ÎÄÃ µð·ºÅÍ¸®";

$GLOBALS['strTypeWebFtp']			= "FTP ¸ðµå À¥ ¹è³Ê ¼­¹ö";

$GLOBALS['strTypeWebUrl']			= "¹è³Ê URL";

$GLOBALS['strTypeFTPHost']			= "FTP È£½ºÆ®";

$GLOBALS['strTypeFTPDirectory']			= "È£½ºÆ® µð·ºÅÍ¸®";

$GLOBALS['strTypeFTPUsername']			= "·Î±×ÀÎID";

$GLOBALS['strTypeFTPPassword']			= "ºñ¹Ð¹øÈ£";



$GLOBALS['strDefaultBanners']			= "±âº» ¹è³Ê";

$GLOBALS['strDefaultBannerUrl']			= "±âº» ÀÌ¹ÌÁö URL";

$GLOBALS['strDefaultBannerTarget']		= "±âº» ´ë»ó URL";



$GLOBALS['strTypeHtmlSettings']			= "HTML ¹è³Ê ¿É¼Ç";

$GLOBALS['strTypeHtmlAuto']			= "Å¬¸¯ Æ®·¡Å·À» °­Á¦ ¼öÇàÇÏ±â À§ÇØ HTML ¹è³Ê¸¦ ÀÚµ¿À¸·Î º¯°æÇÕ´Ï´Ù.";

$GLOBALS['strTypeHtmlPhp']			= "HTML ¹è³Ê¾È¿¡¼­ PHP ÄÚµå¸¦ ½ÇÇàÇÕ´Ï´Ù.";







// Statistics Settings

$GLOBALS['strStatisticsSettings']		= "Åë°è ¼³Á¤";



$GLOBALS['strStatisticsFormat']			= "Åë°è Çü½Ä";

$GLOBALS['strLogBeacon']			= "AdViews¸¦ ±â·ÏÇÏ±â À§ÇØ Åõ¸í ÀÌ¹ÌÁö¸¦ »ç¿ëÇÕ´Ï´Ù.";

$GLOBALS['strCompactStats']			= "°£´ÜÇÑ Åë°è¸¦ »ç¿ëÇÕ´Ï´Ù.";

$GLOBALS['strLogAdviews']			= "AdViews ·Î±×";

$GLOBALS['strBlockAdviews']			= "º¹¼ö ·Î±× ±ÝÁö(ÃÊ)";

$GLOBALS['strLogAdclicks']			= "AdClicks ·Î±×";

$GLOBALS['strBlockAdclicks']			= "º¹¼ö ·Î±× ±ÝÁö(ÃÊ)";



$GLOBALS['strGeotargeting']			= "Áö¿ª Á¤º¸ Áß½É(Geotargeting)";

$GLOBALS['strGeotrackingType']			= "Áö¿ª Á¤º¸ µ¥ÀÌÅÍº£ÀÌ½º Á¾·ù";

$GLOBALS['strGeotrackingLocation'] 		= "Áö¿ª Á¤º¸ µ¥ÀÌÅÍº£ÀÌ½º À§Ä¡";

$GLOBALS['strGeoLogStats']			= "¹æ¹®ÀÚ ±¹ÀûÀ» Åë°è¿¡ ±â·ÏÇÕ´Ï´Ù.";

$GLOBALS['strGeoStoreCookie']		= "³ªÁß¿¡ ÂüÁ¶ÇÏ±â À§ÇØ ÄíÅ°¿¡ °á°ú¸¦ ÀúÀåÇÕ´Ï´Ù.";



$GLOBALS['strEmailWarnings']			= "ÀÌ¸ÞÀÏ °æ°í";

$GLOBALS['strAdminEmailHeaders']		= "ÀÏÀÏ ±¤°í º¸°í¼­ÀÇ ¹ß¼ÛÀÚ¿¡ ´ëÇÑ Á¤º¸¸¦ ¸ÞÀÏ Çì´õ¿¡ Æ÷ÇÔÇÕ´Ï´Ù.";

$GLOBALS['strWarnLimit']			= "°æ°íÈ½¼ö Á¦ÇÑ(Warn Limit)";

$GLOBALS['strWarnLimitErr']			= "°æ°íÈ½¼ö Á¦ÇÑ(Warn Limit)Àº À½¼ö¸¦ »ç¿ëÇÒ ¼ö ¾ø½À´Ï´Ù.";

$GLOBALS['strWarnAdmin']			= "°ü¸®ÀÚ¿¡°Ô °æ°í¸¦ ¾Ë¸³´Ï´Ù.";

$GLOBALS['strWarnClient']			= "±¤°íÁÖ¿¡°Ô °æ°í¸¦ ¾Ë¸³´Ï´Ù.";

$GLOBALS['strQmailPatch']			= "qmail ÆÐÄ¡¸¦ »ç¿ëÇÕ´Ï´Ù.(qmailÀ» »ç¿ëÇÏ´Â °æ¿ì)";



$GLOBALS['strRemoteHosts']			= "¿ø°Ý È£½ºÆ®";

$GLOBALS['strIgnoreHosts']			= "¹«½ÃÇÒ È£½ºÆ®";

$GLOBALS['strReverseLookup']			= "DNS ¿ªÂüÁ¶";

$GLOBALS['strProxyLookup']			= "ÇÁ·Ï½Ã ÂüÁ¶";



$GLOBALS['strAutoCleanTables']			= "µ¥ÀÌÅÍº£ÀÌ½º Á¤¸®";

$GLOBALS['strAutoCleanStats']			= "Åë°è Á¤¸®";

$GLOBALS['strAutoCleanUserlog']			= "»ç¿ëÀÚ ·Î±× Á¤¸®";

$GLOBALS['strAutoCleanStatsWeeks']		= "´ÙÀ½º¸´Ù ¿À·¡µÈ Åë°è µ¤¾î¾²±â<br>(ÃÖ¼Ò 3ÁÖ)";

$GLOBALS['strAutoCleanUserlogWeeks']		= "´ÙÀ½º¸´Ù ¿À·¡µÈ »ç¿ëÀÚ ·Î±× µ¤¾î¾²±â<br>(ÃÖ¼Ò 3ÁÖ)";

$GLOBALS['strAutoCleanErr']			= "ÃÖ´ë º¸Á¸ ±â°£Àº 3ÁÖ ÀÌ»óÀÌ¾î¾ßÇÕ´Ï´Ù.";

$GLOBALS['strAutoCleanVacuum']			= "VACUUM ANALYZE tables every night"; // only Pg





// Administrator settings

$GLOBALS['strAdministratorSettings']		= "°ü¸®ÀÚ ¼³Á¤";



$GLOBALS['strLoginCredentials']			= "·Î±×ÀÎ Á¤º¸";

$GLOBALS['strAdminUsername']			= "°ü¸®ÀÚ ID"; 

$GLOBALS['strOldPassword']			= "±âÁ¸ ºñ¹Ð¹øÈ£";

$GLOBALS['strNewPassword']			= "»õ ºñ¹Ð¹øÈ£";

$GLOBALS['strInvalidUsername']			= "Àß¸øµÈ ID"; 

$GLOBALS['strInvalidPassword']			= "Àß¸øµÈ ºñ¹Ð¹øÈ£";



$GLOBALS['strBasicInformation']			= "±âº» Á¤º¸";

$GLOBALS['strAdminFullName']			= "°ü¸®ÀÚ ÀüÃ¼ ÀÌ¸§";

$GLOBALS['strAdminEmail']			= "°ü¸®ÀÚ ÀÌ¸ÞÀÏ";

$GLOBALS['strCompanyName']			= "È¸»ç ÀÌ¸§";



$GLOBALS['strAdminCheckUpdates']		= "¾÷µ¥ÀÌÆ® °Ë»ö";

$GLOBALS['strAdminCheckEveryLogin']		= "·Î±ä¸¶´Ù";

$GLOBALS['strAdminCheckDaily']			= "ÀÏÀÏ";

$GLOBALS['strAdminCheckWeekly']			= "ÁÖ°£";

$GLOBALS['strAdminCheckMonthly']		= "¿ù°£";

$GLOBALS['strAdminCheckNever']			= "¾ÈÇÔ";



$GLOBALS['strAdminNovice']			= "¾ÈÀüÀ» À§ÇØ °ü¸®ÀÚ°¡ »èÁ¦ÇÏ±â Àü¿¡ È®ÀÎÇÕ´Ï´Ù.";

$GLOBALS['strUserlogEmail']			= "¸ðµç ¿ÜºÎ ¹ß¼Û ÀÌ¸ÞÀÏ ¸Þ½ÃÁö¸¦ ±â·ÏÇÕ´Ï´Ù.";

$GLOBALS['strUserlogPriority']			= "¸Å½Ã°£¸¶´Ù ¿ì¼±¼øÀ§ °è»êÀ» ±â·ÏÇÕ´Ï´Ù.";

$GLOBALS['strUserlogAutoClean']			= "µ¥ÀÌÅÍº£ÀÌ½º ÀÚµ¿ Á¤¸®¸¦ ±â·ÏÇÕ´Ï´Ù.";





// User interface settings

$GLOBALS['strGuiSettings']			= "»ç¿ëÀÚ ÀÎÅÍÆäÀÌ½º ¼³Á¤";



$GLOBALS['strGeneralSettings']			= "ÀÏ¹Ý ¼³Á¤";

$GLOBALS['strAppName']				= "ÀÀ¿ë ÇÁ·Î±×·¥ ÀÌ¸§";

$GLOBALS['strMyHeader']				= "³» ¸Ó¸®±Û";

$GLOBALS['strMyFooter']				= "³» ¹Ù´Ú±Û";

$GLOBALS['strGzipContentCompression']		= "ÄÁÅÙÆ® GZIP ¾ÐÃà »ç¿ë";



$GLOBALS['strClientInterface']			= "±¤°íÁÖ ÀÎÅÍÆäÀÌ½º";

$GLOBALS['strClientWelcomeEnabled']		= "±¤°íÁÖ È¯¿µ ¸Þ½ÃÁö¸¦ »ç¿ëÇÕ´Ï´Ù.";

$GLOBALS['strClientWelcomeText']		= "È¯¿µ ¸Þ½ÃÁö<br>(HTML ÅÂ±× °¡´É)";







// Interface defaults

$GLOBALS['strInterfaceDefaults']		= "±âº» ÀÎÅÍÆäÀÌ½º ¼³Á¤";



$GLOBALS['strInventory']			= "¸ñ·Ï";

$GLOBALS['strShowCampaignInfo']			= "<i>Ä·ÆäÀÎ ¸ñ·Ï</i> ÆäÀÌÁö¿¡ Ä·ÆäÀÎ Á¤º¸¸¦ ÀÚ¼¼È÷ º¸¿©ÁÝ´Ï´Ù.";

$GLOBALS['strShowBannerInfo']			= "<i>¹è³Ê ¸ñ·Ï</i> ÆäÀÌÁö¿¡ ¹è³Ê Á¤º¸¸¦ ÀÚ¼¼È÷ º¸¿©ÁÝ´Ï´Ù.";

$GLOBALS['strShowCampaignPreview']		= "<i>¹è³Ê ¸ñ·Ï</i> ÆäÀÌÁö¿¡ ¹è³ÊÀÇ ¹Ì¸®º¸±â¸¦ ¸ðµÎ Ç¥½ÃÇÕ´Ï´Ù.";

$GLOBALS['strShowBannerHTML']			= "HTML ÄÚµå ´ë½Å¿¡ ½ÇÁ¦ ¹è³Ê¸¦ Ç¥½ÃÇÕ´Ï´Ù.";

$GLOBALS['strShowBannerPreview']		= "¹è³Ê Ã³¸® È­¸é¿¡¼­ ÆäÀÌÁö »ó´Ü¿¡ ¹è³Ê ¹Ì¸®º¸±â¸¦ Ç¥½ÃÇÕ´Ï´Ù.";

$GLOBALS['strHideInactive']			= "»ç¿ëÇÏÁö ¾Ê´Â Ç×¸ñÀ» ¸ðµç ¸ñ·Ï ÆäÀÌÁö¿¡¼­ ¼û±é´Ï´Ù.";

$GLOBALS['strGUIShowMatchingBanners']		= "<i>¿¬°áµÈ ¹è³Ê</i> ÆäÀÌÁö¿¡ ÇØ´ç ¹è³Ê¸¦ Ç¥½ÃÇÕ´Ï´Ù.";

$GLOBALS['strGUIShowParentCampaigns']		= "<i>¿¬°áµÈ ¹è³Ê</i> ÆäÀÌÁö¿¡ ÇØ´çÇÏ´Â »óÀ§ ÄÍÆäÀÎÀ» Ç¥½ÃÇÕ´Ï´Ù.";

$GLOBALS['strGUILinkCompactLimit']		= "<i>Ç×¸ñÀÌ ¸¹Àº °æ¿ì¿¡´Â <i>¿¬°áµÈ ¹è³Ê</i> ÆäÀÌÁö¿¡ ¿¬°áµÈ Ä·ÆäÀÎÀÌ ¾ø´Â ¹è³Ê´Â ¼û±é´Ï´Ù.";



$GLOBALS['strStatisticsDefaults'] 		= "Åë°è";

$GLOBALS['strBeginOfWeek']			= "ÇÑ ÁÖÀÇ ½ÃÀÛÀÏ";

$GLOBALS['strPercentageDecimals']		= "¹éºÐÀ² ¼Ò¼öÁ¡";



$GLOBALS['strWeightDefaults']			= "°¡ÁßÄ¡ ±âº»¼³Á¤";

$GLOBALS['strDefaultBannerWeight']		= "¹è³Ê °¡ÁßÄ¡ ±âº»°ª";

$GLOBALS['strDefaultCampaignWeight']		= "Ä·ÆäÀÎ °¡ÁßÄ¡ ±âº»°ª";

$GLOBALS['strDefaultBannerWErr']		= "¹è³Ê °¡ÁßÄ¡ÀÇ ±âº»°ªÀº Á¤¼ö¸¦ ÀÔ·ÂÇØ¾ßÇÕ´Ï´Ù.";

$GLOBALS['strDefaultCampaignWErr']		= "Ä·ÆäÀÎ °¡ÁßÄ¡ÀÇ ±âº»°ªÀº Á¤¼ö¸¦ ÀÔ·ÂÇØ¾ßÇÕ´Ï´Ù.";







// Not used at the moment

$GLOBALS['strTableBorderColor']			= "Å×ÀÌºí Å×µÎ¸® »ö»ó";

$GLOBALS['strTableBackColor']			= "Å×ÀÌºí ¹è°æ »ö»ó";

$GLOBALS['strTableBackColorAlt']		= "Å×ÀÌºí ¹è°æ »ö»ó(Alternative)";

$GLOBALS['strMainBackColor']			= "ÁÖ ¹è°æ »ö»ó";

$GLOBALS['strOverrideGD']			= "GD ÀÌ¹ÌÁö Æ÷¸ËÀ» ¹«½ÃÇÕ´Ï´Ù.";

$GLOBALS['strTimeZone']				= "½Ã°£ ¿µ¿ª";



?>