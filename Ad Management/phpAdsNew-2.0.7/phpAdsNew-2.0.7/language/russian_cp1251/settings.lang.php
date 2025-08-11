<?php // $Revision: 2.1.2.2 $

/************************************************************************/
/* phpAdsNew 2                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2000-2005 by the phpAdsNew developers                  */
/* http://sourceforge.net/projects/phpadsnew                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



// Installer translation strings
$GLOBALS['strInstall']					= "Óñòàíîâêà";
$GLOBALS['strChooseInstallLanguage']	= "Âûáåðèòå ÿçûê äëÿ ïðîöåäóðû óñòàíîâêè";
$GLOBALS['strLanguageSelection']		= "Âûáîð ßçûêà";
$GLOBALS['strDatabaseSettings']			= "Íàñòðîéêè Áàçû Äàííûõ";
$GLOBALS['strAdminSettings']			= "Íàñòðîéêè Àäìèíèñòðàòîðà";
$GLOBALS['strAdvancedSettings']			= "Ðàñøèðåííûå Íàñòðîéêè";
$GLOBALS['strOtherSettings']			= "Äðóãèå Íàñòðîéêè";

$GLOBALS['strWarning']					= "Ïðåäóïðåæäåíèå";
$GLOBALS['strFatalError']				= "Ïðîèçîøëà ôàòàëüíàÿ îøèáêà";
$GLOBALS['strAlreadyInstalled']			= "phpAdsNew óæå óñòàíîâëåíà íà ýòîé ñèñòåìå. Åñëè âû õîòèòå åå íàñòðîèòü, ïåðåõîäèòå ê <a href='settings-index.php'>èíòåðôåéñó íàñòðîåê</a>";
$GLOBALS['strCouldNotConnectToDB']		= "Íå óäàëîñü ñâÿçàòüñÿ ñ áàçîé äàííîé, ïåðåïðîâåðüòå óêàçàííûå âàìè ïàðàìåòðû";
$GLOBALS['strCreateTableTestFailed']	= "Óêàçàííûé âàìè ïîëüçîâàòåëü íå èìååò ïðàâ ñîçäàâàòü èëè èçìåíÿòü ñòðóêòóðó áàçû äàííûõ, ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì ÁÄ.";
$GLOBALS['strUpdateTableTestFailed']	= "Óêàçàííûé âàìè ïîëüçîâàòåëü íå èìååò ïðàâ íà èçìåíåíèå ñòðóêòóðû áàçû äàííûõ, ïîæàëóéñòà, ñâÿæèòåñü ñ àäìèíèñòðàòîðîì ÁÄ.";
$GLOBALS['strTablePrefixInvalid']		= "Ïðèñòàâêà ê èìåíè òàáëèöû ñîäåðæèò çàïðåùåííûå ñèìâîëû";
$GLOBALS['strTableInUse']				= "Óêàçàííàÿ âàìè áàçà äàíûõ óæå èñïîëüçóåòñÿ äëÿ phpAdsNew, ïîæàëóéñòà, óêàæèòå äðóãóþ ïðèñòàâêó ê èìåíàì òàáëèö, èëè ïðî÷òèòå â ðóêîâîäñòâå èíñòðóêöèè ïî àïãðåéäó.";
$GLOBALS['strMayNotFunction']			= "Ïåðåä òåì êàê ïðîîëæèòü, ïîæàëóéòà, èñïðàâüòå ýòè âîçìîæíûå ïðîáëåìû:";
$GLOBALS['strIgnoreWarnings']			= "Èãíîðèðîâàòü ïðåäóïðåæäåíèÿ";
$GLOBALS['strWarningPHPversion']		= "phpAdsNew äëÿ êîððåêòíîé ðàáîòû íåîáõîäèì PHP 3.0.8 èëè âûøå. Âû ñåé÷àñ èñïîëüçóåòå {php_version}.";
$GLOBALS['strWarningRegisterGlobals']	= "Êîíôèãóðàöèîííàÿ ïåðåìåííàÿ PHP register_globals äîëæíà áûòü âêëþ÷åíà (on).";
$GLOBALS['strWarningMagicQuotesGPC']	= "Êîíôèãóðàöèîííàÿ ïåðåìåííàÿ PHP magic_quotes_gpc äîëæíà áûòü âêëþ÷åíà (on).";
$GLOBALS['strWarningMagicQuotesRuntime']= "Êîíôèãóðàöèîííàÿ ïåðåìåííàÿ PHP magic_quotes_runtime äîëæíà áûòü âêëþ÷åíà (on).";
$GLOBALS['strConfigLockedDetected']		= "phpAdsNew îïðåäåëèëà, ÷òî âàø ôàéë <b>config.inc.php</b> íå ìîæåò áûòü çàïèñàí ñåðâåðîì.<br> Âû íå ìîæåòå ïðîäîëæèòü, ïðåæäå ÷åì ïîìåíÿåòå ïðàâà äîñòóïà ê ýòîìó ôàéëó. <br>Ïðî÷èòàéòå ïðèëàãàåìóþ äîêóìåíòàöèþ, åñëè âû íå çíàåòå, êàê ýòî ñäåëàòü.";
$GLOBALS['strCantUpdateDB']  			= "Íå ïðåäñòàâëÿåòñÿ âîçìîæíûì îáíîâèòü áàçó äàííûõ. Åñëè âû ðåøèòå ïðîäîëæèòü, âñå ñóùåñòâóþùèå áàííåðû, ñòàòèñòèêà è äàííûå î êëèåíòàõ áóäóò ñòåðòû.";
$GLOBALS['strTableNames']				= "Èìåíà òàáëèö";
$GLOBALS['strTablesPrefix']				= "Ïðèñòàâêà ê èìåíàì òàáëèö";
$GLOBALS['strTablesType']				= "Òèï òàáëèö";

$GLOBALS['strInstallWelcome']			= "Äîáðî ïîæàëîâàòü â phpAdsNew";
$GLOBALS['strInstallMessage']			= "Ïðåæäå ÷åì âû ñìîæåòå íà÷àòü èñïîëüçîâàòü phpAdsNew, íåîáõîäèìî ïðîèçâåñòè êîíôèãóðàöèþ è <br>ñîçäàòü áàçó äàííûõ. Ù¸ëêíèòå <b>Äàëüøå</b> äëÿ ïðîäîëæåíèÿ.";
$GLOBALS['strInstallSuccess']			= "<b>Óñòàíîâêà phpAdsNew çàâåðøåíà..</b><br><br>Äëÿ êîððåêòíîãî ôóíêöèîíèðîâàíèÿ phpAdsNew âû òàêæå äîëæíû
										   óáåäèòüñÿ, ÷òî ôàéë îáñëóæèâàíèÿ çàïóñêàåòñÿ êàæäûé äåíü. Äîïîëíèòåëüíàÿ èíôîðìàöèÿ ïî ýòîìó ïîâîäó ìîæåò áûòü íàéäåíà â äîêóìåíòàöèè.
										   <br><br>Ù¸ëêíèòå <b>Äàëüøå</b> äëÿ ïåðåõîäà íà ñòðàíèöó êîíôèãóðàöèè, ãäå âû ìîæåòå 
										   ñêîíôèãóðèðîâàòü äîïîëíèòåëüíûå íàñòðîéêè. Ïîæàëóéñòà, íå çàáóäüòå çàáëîêèðîâàòü ôàéë config.inc.php, êîãäà âû çàêîí÷èòå ñ íàñòðîéêàìè - ýòî ïðåäîòâðàòèò âîçìîæíûé âçëîì ñèñòåìû.";
$GLOBALS['strInstallNotSuccessful']		= "<b>Óñòàíîâêà phpAdsNew íå ïðîèçîøëà</b><br><br>Íåêîòîðûå ÷àñòè ïðîöåññà óñòàíîâêè íå ìîãëè áûòü çàâåðøåíû.
										   Âîçìîæíî, ýòè ïðîáëåìû èñêëþ÷èòåëüíî âðåìåííûå, â òàêîì ñëó÷àå âû ìîæåòå ïðîñòî ù¸ëêíóòü <b>Äàëüøå</b> è âåðíóòüñÿ ê
										   ïåðâîìó øàãó ïðîöåññà óñòàíîâêè. Åñëè âû õîòèòå óçíàòü áîëüøå î çíà÷åíèè íèæåñëåäóþùåãî ñîîáùåíèÿ îá îøèáêå è êàê å¸ óñòðàíèòü, 
										   îáðàòèòåñü ê ïîñòàâëÿåìîé äîêóìåíòàöèè.";
$GLOBALS['strErrorOccured']				= "Ïðîèçîøëà ñëåäóþùàÿ îøèáêà:";
$GLOBALS['strErrorInstallDatabase']		= "Ñòðóêòóðà áàçû äàííûõ íå ìîãëà áûòü ñîçäàíà.";
$GLOBALS['strErrorInstallConfig']		= "Ôàéë êîíôèãóðàöèè èëè áàçà äàííûõ íå ìîãóò áûòü îáíîâëåíû.";
$GLOBALS['strErrorInstallDbConnect']	= "Íå ïîëó÷èëîñü îòêðûòü ñîåäèíåíèå ñ áàçîé äàííûõ.";

$GLOBALS['strUrlPrefix']				= "Ïðåôèêñ URL";

$GLOBALS['strProceed']					= "Äàëüøå &gt;";
$GLOBALS['strRepeatPassword']			= "Ïîâòîðèòå ïàðîëü";
$GLOBALS['strNotSamePasswords']			= "Ïàðîëè íå ñîâïàëè";
$GLOBALS['strInvalidUserPwd']			= "Íåâåðíîå èìÿ ïîëüçîâàòåëÿ èëè ïàðîëü";

$GLOBALS['strUpgrade']					= "Îáíîâèòü";
$GLOBALS['strSystemUpToDate']			= "Âàøà ñèñòåìà íå òðåáóåò îáíîâëåíèÿ. <br>Ù¸ëêíèòå ïî <b>Äàëüøå</b> äëÿ ïåðåõîäà íà äîìàøíþþ ñòðàíèöó.";
$GLOBALS['strSystemNeedsUpgrade']		= "Ñðóêòóðà áàçû äàííûõ è ôàéë êîíôèãóðàöèè äîëæíû áûòü îáíîâëåíû äëÿ êîððåêòíîãî ôóíêöèîíèðîâàíèÿ ñèñòåìû. Ù¸ëêíèòå <b>Äàëüøå</b>, ÷òîáû çàïóñòèòü ïðîöåññ îáíîâëåíèÿ. <br>Áóäüòå òåðïåëèâû? îáíîâëåíèå ìîæåò çàíÿòü ïàðó ìèíóò.";
$GLOBALS['strSystemUpgradeBusy']		= "Ïðîèñõîäèò îáíîâëåíèå ñèñòåìû? ïîæàëóéñòà? ïîäîæäèòå...";
$GLOBALS['strServiceUnavalable']		= "Îáñëóæèâàíèå âðåìåííî íåäîñòóïíî. Ïðîèñõîäèò îáíîâëåíèå ñèñòåìû";

$GLOBALS['strConfigNotWritable']		= "Âàø ôàéë config.inc.php íå èìååò ïðàâ íà çàïèñü â íåãî";





/*********************************************************/
/* Configuration translations                            */
/*********************************************************/

// Global
$GLOBALS['strChooseSection']			= "Âûáåðèòå ðàçäåë";
$GLOBALS['strDayFullNames'] 			= array("Âîñêðåñåíüå","Ïîíåäåëüíèê","Âòîðíèê","Ñðåäà","×åòâåðã","Ïÿòíèöà","Ñóááîòà");
$GLOBALS['strEditConfigNotPossible']    = "Îòðåäàêòèðîâàòü äàííûå íàñòðîéêè íåâîçìîæíî, òàê êàê ôàéë êîíôèãóðàöèè çàïåðò èç ñîîáðàæåíèé áåçîïàñíîñòè. ".
										  "Åñëè âû õîòèòå ïðîèçâåñòè èçìåíåíèÿ, âàì íóæíî ñíà÷àëà îòïåðåòü ôàéë ñonfig.inc.php.";
$GLOBALS['strEditConfigPossible']		= "Ìîæíî ðåäàêòèðîâàòü âñå íàñòðîéêè, òàê êàê ôàéë êîíôèãóðàöèè íå çàïåðò, íî ýòî ìîæåò ïðèâåñòè ê ïðîáëåìàì ñ áåçîïàñíîñòüþ ñèñòåìû. ".
										  "Åñëè âû õîòèòå îáåçîïàñèòü âàøó ñèñòåìó, âàì íåîáõîäèìî çàïåðåòü ôàéë config.inc.php.";



// Database
$GLOBALS['strDatabaseSettings']			= "Íàñòðîéêè áàçû äàííûõ";
$GLOBALS['strDatabaseServer']			= "Ñåðâåð áàç äàííûõ";
$GLOBALS['strDbHost']					= "Èìÿ õîñòà";
$GLOBALS['strDbUser']					= "Èìÿ ïîëüçîâàòåëÿ";
$GLOBALS['strDbPassword']				= "Ïàðîëü";
$GLOBALS['strDbName']					= "Èìÿ áàçû äàííûõ";

$GLOBALS['strDatabaseOptimalisations']	= "Îïòèìèçàöèÿ áàçû äàííûõ";
$GLOBALS['strPersistentConnections']	= "Èñïîëüçîâàòü ïîñòîÿííûå ñîåäèíåíèÿ";
$GLOBALS['strInsertDelayed']			= "Èñïîëüçîâàòü îòëîæåííûå âñòàâêè";
$GLOBALS['strCompatibilityMode']		= "Èñïîëüçîâàòü ðåæèì ñîâìåñòèìîñòè ïî áàçå äàííûõ";
$GLOBALS['strCantConnectToDb']			= "Íå ìîãó ñâÿçàòüñÿ ñ áàçîé äàííûõ";



// Invocation and Delivery
$GLOBALS['strInvocationAndDelivery']	= "Íàñòðîéêè âûçîâà è äîñòàâêè";

$GLOBALS['strKeywordRetrieval']			= "Èçâëå÷åíèå ïî êëþ÷åâûì ñëîâàì";
$GLOBALS['strBannerRetrieval']			= "Ìåòîä èçâëå÷åíèÿ áàííåðîâ";
$GLOBALS['strRetrieveRandom']			= "Ñëó÷àéíîå èçâëå÷åíèå (ïî óìîë÷àíèþ)";
$GLOBALS['strRetrieveNormalSeq']		= "Îáû÷íîå ïîñëåäîâàòåëüíîå èçâëå÷åíèå";
$GLOBALS['strWeightSeq']				= "Ïîñëåäîâàòåëüíîå èçâëå÷åíèå ñ ó÷¸òîì âåñîâ";
$GLOBALS['strFullSeq']					= "Ïîëíîå ïîñëåäîâàòåëüíîå èçâëå÷åíèå";
$GLOBALS['strUseConditionalKeys']		= "Ðàçðåøèòü ëîãè÷åñêèå îïåðàòîðû ïðè ïðÿìîé âûáîðêå";
$GLOBALS['strUseMultipleKeys']			= "Ðàçðåøèòü ìíîæåñòâåííûå êëþ÷åâûå ñëîâà ïðè ïðÿìîé âûáîðêå";
$GLOBALS['strUseAcl']					= "Îöåíèâàòü îãðàíè÷åíèÿ ïî äîñòàâêå â ïðîöåññå ïîêàçîâ";

$GLOBALS['strDeliverySettings']                 = "Íàñòðîéêè äîñòàâêè";
$GLOBALS['strCacheType']                                = "Òèï êýøà äîñòàâêè";
$GLOBALS['strCacheFiles']                               = "Ôàéëû";
$GLOBALS['strCacheDatabase']                    = "Áàçà äàííûõ";
$GLOBALS['strCacheShmop']                               = "Ðàçäåëÿåìàÿ ïàìÿòü (shmop)";

$GLOBALS['strZonesSettings']			= "Èçâëå÷åíèå çîí";
$GLOBALS['strZoneCache']				= "Êýøèðîâàòü çîíû (ýòî äîëæíî óñêîðÿòü ðàáîòó ïðè èñïîëüçîâàíèè çîí)";
$GLOBALS['strZoneCacheLimit']			= "Âðåìÿ ìåæäó îáíîâëåíèÿìè êýøà (â ñåêóíäàõ)";
$GLOBALS['strZoneCacheLimitErr']		= "Âðåìÿ ìåæäó îáíîâëåíèÿìè êýøà äîëæíî áûòü ïîëîæèòåëüíûì öåëûì ÷èñëîì";

$GLOBALS['strP3PSettings']				= "Íàñòðîéêè P3P (ïîëèòèêà îáðàùåíèÿ ñ ÷àñòíîé èíôîðìàöèåé) ";
$GLOBALS['strUseP3P']					= "Èñïîëüçîâàòü P3P-ïîëèòèêè";
$GLOBALS['strP3PCompactPolicy']			= "Êîìïàêíòàÿ ïîëèòèêà P3P";
$GLOBALS['strP3PPolicyLocation']		= "Ìåñòî ðàçìåùåíèÿ P3P-ïîëèòèêè";



// Banner Settings
$GLOBALS['strBannerSettings']			= "Íàñòðîéêè áàííåðîâ";

$GLOBALS['strTypeHtmlSettings']			= "Îïöèè HTML-áàííåðîâ";
$GLOBALS['strTypeHtmlAuto']				= "Àâòîìàòè÷åñêè èçìåíÿòü HTML-áàííåðû äëÿ ðåãèñòðàöèè êëèêîâ";
$GLOBALS['strTypeHtmlPhp']				= "Ðàçðåøèòü âûïîëíåíèå PHP-âûðàæåíèé èç HTML-áàííåðà";

$GLOBALS['strTypeWebSettings']			= "Êîíôèãóðàöèÿ âåá-áàííåðîâ";
$GLOBALS['strTypeWebMode']				= "Ìåòîä õðàíåíèÿ";
$GLOBALS['strTypeWebModeLocal']			= "Ëîêàëüíûé ðåæèì (õðàíÿòñÿ â ëîêàëüíîì êàòàëîãå)";
$GLOBALS['strTypeWebModeFtp']			= "FTP-ðåæèì (õðàíÿòñÿ íà âíåøíåì FTP-ñåðâåðå)";
$GLOBALS['strTypeWebDir']				= "Êàòàëîã äëÿ ëîêàëüíîãî ðåæèìà õðàíåíèÿ âåá-áàííåðîâ";
$GLOBALS['strTypeWebFtp']				= "Ñåðâåð äëÿ FTP-ðåæèìà õðàíåíèÿ âåá-áàííåðîâ";
$GLOBALS['strTypeWebUrl']				= "Ïóáëè÷íî äîñòóïíûé URL ëîêàëüíîãî êàòàëîãà èëè FTP-ñåðâåðà";

$GLOBALS['strDefaultBanners']			= "Áàííåðû ïî óìîë÷àíèþ";
$GLOBALS['strDefaultBannerUrl']			= "URL áàííåðà ïî óìîë÷àíèþ";
$GLOBALS['strDefaultBannerTarget']		= "Íàçíà÷åíèå áàííåðà ïî óìîë÷àíèþ";



// Statistics Settings
$GLOBALS['strStatisticsSettings']		= "Íàñòðîéêè ñòàòèñòèêè";

$GLOBALS['strStatisticsFormat']			= "Ôîðìàò ñòàòèñòèêè";
$GLOBALS['strLogBeacon']				= "Èñïîëüçîâàòü ìàÿ÷êè äëÿ ðåãèñòðàöèè ïðîñìîòðîâ";
$GLOBALS['strCompactStats']				= "Èñïîëüçîâàòü êîìïàêòíóþ ñòàòèñòèêó";
$GLOBALS['strLogAdviews']				= "Ðåãèñòðèðîâàòü ïðîñìîòðû";
$GLOBALS['strLogAdclicks']				= "Ðåãèñòðèðîâàòü êëèêè";

$GLOBALS['strGeotrackingType']                  = "Òèï áàçû äàííûõ äëÿ ãåîòàðãåòèíãà";
$GLOBALS['strGeotrackingLocation']              = "Ðàñïîëîæåíèå áàçû äàííûõ äëÿ ãåîòàðãåòèíãà";
$GLOBALS['strGeotargeting']                     = "Ãåîòàðãåòèíã";
$GLOBALS['strGeoLogStats']                      = "Ðåãèñòðèðîâàòü ñòðàíó ïîñåòèòåëÿ â ñòàòèñòèêå";
$GLOBALS['strGeoStoreCookie']           = "Ñîõðàíÿòü ðåçóëüòàò â êóêå äëÿ èñïîëüçîâàíèÿ âïîñëåäñòâèè";


$GLOBALS['strEmailWarnings']			= "Ïðåäóïðåæäåíèÿ ïî åìýéëó";
$GLOBALS['strAdminEmailHeaders']		= "Ïî÷òîâûå çàãîëîâêè äëÿ îáîçíà÷åíèÿ àâòîðà åæåäíåâíûõ îò÷¸òîâ î ðåêëàìå";
$GLOBALS['strWarnLimit']				= "Ïðåäóïðåæäåíèå î ëèìèòå";
$GLOBALS['strWarnLimitErr']				= "Ïðåäóïðåæäåíèå î ëèìèòå äîëæíî áûòü ïîëîæèòåëüíûì öåëûì ÷èñëîì";
$GLOBALS['strWarnAdmin']				= "Ïðåäóïðåæäàòü àäìèíèñòðàòîðà";
$GLOBALS['strWarnClient']				= "Ïðåäóïðåæäàòü êëèåíòà";

$GLOBALS['strRemoteHosts']				= "Óäàë¸ííûå õîñòû";
$GLOBALS['strIgnoreHosts']				= "Èãíîðèðîâàòü õîñòû";
$GLOBALS['strReverseLookup']			= "Ïðîâåðêà îáðàòíîãî DNS";
$GLOBALS['strProxyLookup']				= "Ïðîâåðêà ïðîêñè";



// Administrator settings
$GLOBALS['strAdministratorSettings']	= "Íàñòðîéêè àäìèíèñòðàòîðà";

$GLOBALS['strLoginCredentials']			= "Äàííûå äëÿ âõîäà â ñèñòåìó";
$GLOBALS['strAdminUsername']			= "Èìÿ ïîëüçîâàòåëÿ-àäìèíèñòðàòîðà";
$GLOBALS['strOldPassword']				= "Ñòàðûé ïàðîëü";
$GLOBALS['strNewPassword']				= "Íîâûé ïàðîëü";
$GLOBALS['strInvalidUsername']			= "Íåâåðíîå èìÿ ïîëüçîâàòåëÿ";
$GLOBALS['strInvalidPassword']			= "Íåâåðíûé ïàðîëü";

$GLOBALS['strBasicInformation']			= "Îñíîâíàÿ èíôîðìàöèÿ";
$GLOBALS['strAdminFullName']			= "Ïîëíîå èìÿ àäìèíèñòðàòîðà";
$GLOBALS['strAdminEmail']				= "Àäðåñ ýëåêòðîííîé ïî÷òû àäìèíèñòðàòîðà";
$GLOBALS['strCompanyName']				= "Íàçâàíèå êîìïàíèè";

$GLOBALS['strAdminNovice']				= "Äåéñòâèÿ àäìèíèñòðàòîðà ïî óäàëåíèþ òðåáóþò ïîäòâåðæäåíèÿ äëÿ ïîäñòðàõîâêè";



// User interface settings
$GLOBALS['strGuiSettings']				= "Íàñòðîéêà èíòåðôåéñà ïîëüçîâàòåëÿ";

$GLOBALS['strGeneralSettings']			= "Îáùèå íàñòðîéêè";
$GLOBALS['strAppName']					= "Èìÿ ïðèëîæåíèÿ";
$GLOBALS['strMyHeader']					= "Ìîé çàãîëîâîê";
$GLOBALS['strMyFooter']					= "Ìîé ïîäâàë";

$GLOBALS['strClientInterface']			= "Êëèåíòñêèé èíòåðôåéñ";
$GLOBALS['strClientWelcomeEnabled']		= "Âêëþ÷èòü ïðèâåòñòâåííîå ñîîáùåíèå äëÿ êëèåíòîâ";
$GLOBALS['strClientWelcomeText']		= "Òåêñò ïðèâåòñòâåííîãî ñîîáùåíèÿ äëÿ êëèåíòîâ<br>(ðàçðåøåíû òýãè HTML)";



// Interface defaults
$GLOBALS['strInterfaceDefaults']		= "Íàñòðîéêè èíòåðôåéñà ïî óìîë÷àíèþ";

$GLOBALS['strStatisticsDefaults'] 		= "Ñòàòèñòèêà";
$GLOBALS['strBeginOfWeek']				= "Íà÷àëî íåäåëè";
$GLOBALS['strPercentageDecimals']		= "Äåñÿòè÷íûå äðîáè";

$GLOBALS['strWeightDefaults']			= "Âåñ ïî óìîë÷àíèþ";
$GLOBALS['strDefaultBannerWeight']		= "Âåñ áàííåðà ïî óìîë÷àíèþ";
$GLOBALS['strDefaultCampaignWeight']	= "Âåñ êàìïàíèè ïî óìîë÷àíèþ";
$GLOBALS['strDefaultBannerWErr']		= "Âåñ áàííåðà ïî óìîë÷àíèþ äîëæåí áûòü ïîëîæèòåëüíûì öåëûì ÷èñëîì";
$GLOBALS['strDefaultCampaignWErr']		= "Âåñ êàìïàíèè ïî óìîë÷àíèþ äîëæåí áûòü ïîëîæèòåëüíûì öåëûì ÷èñëîì";

$GLOBALS['strAllowedBannerTypes']		= "Ðàçðåø¸ííûå òèïû áàííåðîâ";
$GLOBALS['strTypeSqlAllow']				= "Ðàçðåøèòü áàííåðû, õðàíÿùèåñÿ â SQL";
$GLOBALS['strTypeWebAllow']				= "Ðàçðåøèòü áàííåðû, õðàíÿùèåñÿ íà âåáñåðâåðå";
$GLOBALS['strTypeUrlAllow']				= "Ðàçðåøèòü URL-áàííåðû";
$GLOBALS['strTypeHtmlAllow']			= "Ðàçðåøèòü HTML-áàííåðû";



// Not used at the moment
$GLOBALS['strTableBorderColor']			= "Öâåò ðàìêè òàáëèöû";
$GLOBALS['strTableBackColor']			= "Öâåò ôîíà òàáëèöû";
$GLOBALS['strTableBackColorAlt']		= "Àëüòåðíàòèâíûé öâåò ôîíà òàáëèöû";
$GLOBALS['strMainBackColor']			= "Îñíîâíîé öâåò ôîíà";
$GLOBALS['strOverrideGD']				= "Èãíîðèðîâàòü àâòîïðåäåëåíèå ôîðìàòà êàðòèíîê â GD";
$GLOBALS['strTimeZone']					= "Âðåìåííàÿ çîíà";

?>
