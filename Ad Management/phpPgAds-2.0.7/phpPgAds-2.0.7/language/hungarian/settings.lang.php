<?php // $Revision: 1.1.4.3 $

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
$GLOBALS['strInstall']				= "Telepítés";
$GLOBALS['strChooseInstallLanguage']		= "Válassza ki a telepítési folyamat nyelvét";
$GLOBALS['strLanguageSelection']		= "Nyelv átváltása";
$GLOBALS['strDatabaseSettings']			= "Adatbázis beállításai";
$GLOBALS['strAdminSettings']			= "Adminisztrátor beállításai";
$GLOBALS['strAdvancedSettings']			= "Speciális beállítások";
$GLOBALS['strOtherSettings']			= "Egyéb beállítások";

$GLOBALS['strWarning']				= "Figyelmeztetés";
$GLOBALS['strFatalError']			= "Végzetes hiba történt";
$GLOBALS['strUpdateError']			= "Hiba történt frissítés közben";
$GLOBALS['strUpdateDatabaseError']	= "Ismeretlen okból kifolyólag az adatbázis szerkezet frissítése nem sikerült. Végrehajtásának javasolt módja a <b>Frissítés újrapróbálására</b> kattintás, amivel megpróbálhatja kijavítani e lehetséges problémákat. Ha ön biztos abban, hogy ezek a hibák nincsenek kihatással a ".$phpAds_productname." mûködésére, akkor a <b>Hibák kihagyása</b> választásával folytathatja. Ezeknek a hibáknak a figyelmen kívül hagyása komoly problémákat okozhat, és nem ajánlott!";
$GLOBALS['strAlreadyInstalled']			= "Már telepítette a ".$phpAds_productname."-t erre a rendszerre. Ha be szeretné állítani, akkor váltson át a <a href='settings-index.php'>beállítások kezelõfelületre</a>";
$GLOBALS['strCouldNotConnectToDB']		= "Nem lehet kapcsolódni az adatbázishoz, ellenõrizze ismét az ön által megadott beállításokat";
$GLOBALS['strCreateTableTestFailed']		= "Az ön által megadott felhasználónak nincs joga létrehozni vagy frissíteni az adatbázis szerkezetet. Vegye fel a kapcsolatot az adatbázis adminisztrátorával.";
$GLOBALS['strUpdateTableTestFailed']		= "Az ön által megadott felhasználónak nincs joga frissíteni az adatbázis szerkezetet. Vegye fel a kapcsolatot az adatbázis adminisztrátorával.";
$GLOBALS['strTablePrefixInvalid']		= "A tábla elõtag érvénytelen karaktert tartalmaz";
$GLOBALS['strTableInUse']			= "Az ön által megadott adatbázis már létezik a ".$phpAds_productname." számára. Használjon másik tábla elõtagot, vagy olvassa el a kézikönyvben a frissítésre vonatkozó utasításokat.";
$GLOBALS['strTableWrongType']		= "A ".$phpAds_dbmsname." telepítés nem támogatja az ön által kiválasztott táblatípust.";
$GLOBALS['strMayNotFunction']			= "Folytatás elõtt javítsa ki ezeket a lehetséges hibákat:";
$GLOBALS['strFixProblemsBefore']		= "Javítsa ki a következõ objektumo(ka)t a ".$phpAds_productname." telepítése elõtt. Ha kérdése van ezzel a hibaüzenettel kapcsolatban, akkor tanulmányozza az <i>Administrator guide</i> kézikönyvet, mely része az ön által letöltött csomagnak.";
$GLOBALS['strFixProblemsAfter']			= "Ha nem tudja kijavítani a fenti problémákat, akkor vegye fel a kapcsolatot annak a kiszolgálónak az adminisztrátorával, melyre a ".$phpAds_productname."-t próbálja telepíteni. A kiszolgáló adminisztrátora biztosan tud segíteni önnek.";
$GLOBALS['strIgnoreWarnings']			= "Figyelmeztetések mellõzése";
$GLOBALS['strWarningDBavailable']		= "Az ön által használt PHP-változat nem támogatja a kapcsolódást a ".$phpAds_dbmsname." adatbázis kiszolgálóhoz. Engedélyezze a PHP ".$phpAds_dbmsname." bõvítményt, mielõtt folytatná.";
$GLOBALS['strWarningPHPversion']		= "A ".$phpAds_productname." megfelelõ mûködéséhez PHP 4.0 vagy újabb szükséges. Ön jelenleg a {php_version}-s verziót használja.";
$GLOBALS['strWarningRegisterGlobals']		= "A register_globals PHP konfigurációs változónak engedélyezettnek kell lennie.";
$GLOBALS['strWarningMagicQuotesGPC']		= "A magic_quotes_gpc PHP konfigurációs változónak engedélyezettnek kell lennie.";
$GLOBALS['strWarningMagicQuotesRuntime']	= "A magic_quotes_runtime PHP konfigurációs változónak letiltottnak kell lennie.";
$GLOBALS['strWarningFileUploads']		= "A file_uploads  PHP konfigurációs változónak engedélyezettnek kell lennie.";
$GLOBALS['strWarningTrackVars']			= "A track_vars PHP konfigurációs változónak engedélyezettnek kell lennie.";
$GLOBALS['strWarningPREG']				= "Az ön által használt PHP-verzió nem rendelkezik PERL kompatibilis reguláris kifejezés támogatással. Engedélyezze a PREG kiterjesztést, mielõtt folytatná.";
$GLOBALS['strConfigLockedDetected']		="A ".$phpAds_productname." megállapította, hogy a kiszolgáló nem tud írni a <b>config.inc.php</b> fájlba. Csak a fájl engedélyeinek módosítása után folytathatja. Olvassa el a hozzá adott dokumentációban, ha nem tudja, hogyan kell.";
$GLOBALS['strCantUpdateDB']  			= "Az adatbázis jelenleg nem frissíthetõ. Ha a folytatás mellett dönt, akkor valamennyi reklám, statisztika és hirdetõ törlésre kerül.";
$GLOBALS['strIgnoreErrors']			= "Hibák kihagyása";
$GLOBALS['strRetryUpdate']			= "Frissítés ismétlése";
$GLOBALS['strTableNames']			= "Táblanevek";
$GLOBALS['strTablesPrefix']			= "Táblanevek elõtag";
$GLOBALS['strTablesType']			= "Tábla típusa";

$GLOBALS['strInstallWelcome']			= "Üdvözli a ".$phpAds_productname."";
$GLOBALS['strInstallMessage']			= "Mielõtt használatba venné, végezze el a ".$phpAds_productname." beállítását, és <br>hozza létre az adatbázist. A <b>Tovább</b> gombbal folytathatja.";
$GLOBALS['strInstallSuccess']			= "<b>A ".$phpAds_productname." telepítése ezzel befejezõdött.</b><br><br>A ".$phpAds_productname." megfelelõ mûködéséhez ellenõrizze
               a karbantartás fájl óránkénti futtatásának végrehajtását. A dokumentációban több információt talál errõl a témáról.
						   <br><br>A <b>Tovább</b> gomb megnyomásával töltheti be Beállítások lapot, ahol elvégezheti
							 a testreszabást. Miután elkészült, ne feledje el lezárni a config.inc.php fájlt, mert így
							 megelõzheti a biztonsági sértéseket.";
$GLOBALS['strUpdateSuccess']			= "<b>A ".$phpAds_productname." frissítése sikerült.</b><br><br>A ".$phpAds_productname." megfelelõ mûködése céljából ellenõrizze
               azt is, hogy fut-e óránként a karbantartás fájl (elõtte ez napontára volt állítva). A dokumentációban több információt talál errõl a témáról.
						   <br><br>A <b>Tovább</b> megnyomásával válthat át az adminisztrátor kezelõfelületre. Ne feledje el lezárni a config.inc.php fájlt, mert így
							 megelõzheti a biztonsági sértéseket.";
$GLOBALS['strInstallNotSuccessful']		= "<b>A ".$phpAds_productname." telepítése nem sikerült.</b><br><br>A telepítési folyamat részét nem lehetett befejezni.
						   Ezek a problémák valószínûleg csak ideiglenesek, ebben az esetben nyugodtan nyomja meg a <b>Tovább</b>t, 
							 és térjen vissza a telepítési folyamat elsõ lépéséhez. Ha többet szeretni tudni arról, hogy mit jelent az alábbi
							 hibaüzenet, és hogyan háríthatja el, akkor nézzen utána a dokumentációban.";
$GLOBALS['strErrorOccured']			= "A következõ hiba történt:";
$GLOBALS['strErrorInstallDatabase']		= "Nem lehet létrehozni az adatbázis szerkezetet.";
$GLOBALS['strErrorInstallConfig']		= "Nem lehet frissíteni a konfigurációs fájlt vagy az adatbázist.";
$GLOBALS['strErrorInstallDbConnect']		= "Nem lehet kapcsolatot létesíteni az adatbázissal.";

$GLOBALS['strUrlPrefix']			= "Hivatkozás elõtag";

$GLOBALS['strProceed']				= "Tovább &gt;";
$GLOBALS['strInvalidUserPwd']			= "A felhasználónév vagy a jelszó érvénytelen";

$GLOBALS['strUpgrade']				= "Frissítés";
$GLOBALS['strSystemUpToDate']			= "A rendszer frissítése már megtörtént, jelenleg nincs szükség az aktualizálására. <br>A <b>Tovább</b> megnyomásával ugorjon a kezdõlapra.";
$GLOBALS['strSystemNeedsUpgrade']		= "A megfelelõ mûködés céljából frissíteni kell az adatbázis szerkezetet és a konfigurációs fájlt. A <b>Tovább</b> megnyomásával indíthatja a frissítési folyamatot. <br><br>Attól függõen, hogy melyik verzióról frissít, és mennyi statisztikát tárol már az adatbázisban, ez a folyamat az adatbázis kiszolgálót nagyon leterhelheti. Legyen türelemmel, a frissítés eltarthat néhány percig.";
$GLOBALS['strSystemUpgradeBusy']		= "A rendszer frissítése folyamatban. Kis türelmet...";
$GLOBALS['strSystemRebuildingCache']		= "A gyorsítótár újraépítése. Kis türelmet...";
$GLOBALS['strServiceUnavalable']		= "A szolgáltatás átmenetileg nem elérhetõ. A rendszer frissítése folyamatban";

$GLOBALS['strConfigNotWritable']		= "A config.inc.php fájl nem írható";





/*********************************************************/
/* Configuration translations                            */
/*********************************************************/

// Global
$GLOBALS['strChooseSection']			= "Válasszon szekciót";
$GLOBALS['strDayFullNames'] 			= array("Vasárnap","Hétfõ","Kedd","Szerda","Csütörtök","Péntek","Szombat");
$GLOBALS['strEditConfigNotPossible']   		= "Ezek a beállítások nem módosíthatók, mert a konfigurációs fájl biztonsági okokból zárolva van. ".
										  "Ha szeretné módosítani, akkor elõbb oldja fel a config.inc.php fájlt.";
$GLOBALS['strEditConfigPossible']		= "A beállítások módosíthatók, mert nem zárta le a konfigurációs fájlt, ez viszont így biztonsági rést jelent. ".
										  "Ha szeretné biztonságossá tenni a rendszert, akkor zárja le a config.inc.php fájlt.";



// Database
$GLOBALS['strDatabaseSettings']			= "Adatbázis beállításai";
$GLOBALS['strDatabaseServer']			= "Adatbázis kiszolgáló";
$GLOBALS['strDbLocal']				= "Kapcsolódás helyi kiszolgálóhoz szoftvercsatornával"; // Pg only
$GLOBALS['strDbHost']				= "Adatbázis állomásneve";
$GLOBALS['strDbPort']				= "Adatbázis port száma";
$GLOBALS['strDbUser']				= "Adatbázis felhasználóneve";
$GLOBALS['strDbPassword']			= "Adatbázis jelszava";
$GLOBALS['strDbName']				= "Adatbázis neve";

$GLOBALS['strDatabaseOptimalisations']		= "Adatbázis optimalizálása";
$GLOBALS['strPersistentConnections']		= "Állandó kapcsolatok használata";
$GLOBALS['strInsertDelayed']			= "Késleltetett beszúrások használata";
$GLOBALS['strCompatibilityMode']		= "Adatbázis kompatibilitás mód használata";
$GLOBALS['strCantConnectToDb']			= "Nem lehet kapcsolódni az adatbázishoz";



// Invocation and Delivery
$GLOBALS['strInvocationAndDelivery']		= "Hívás és továbbítás beállításai";

$GLOBALS['strAllowedInvocationTypes']		= "Engedélyezett hívástípusok";
$GLOBALS['strAllowRemoteInvocation']		= "Távhívás engedélyezése";
$GLOBALS['strAllowRemoteJavascript']		= "Távhívás JavaScripthez engedélyezése";
$GLOBALS['strAllowRemoteFrames']		= "Távhívás keretekhez engedélyezése";
$GLOBALS['strAllowRemoteXMLRPC']		= "Távhívás XML-RPC használatával engedélyezése";
$GLOBALS['strAllowLocalmode']			= "Helyi mód engedélyezése";
$GLOBALS['strAllowInterstitial']		= "Interstíciós ablakok engedélyezése";
$GLOBALS['strAllowPopups']			= "Felbukkanó ablakok engedélyezése";

$GLOBALS['strUseAcl']				= "A továbbítási korlátozások kiértékelése továbbítás közben";

$GLOBALS['strDeliverySettings']			= "Továbbítás beállításai";
$GLOBALS['strCacheType']				= "Továbbítás gyorsítótár típusa";
$GLOBALS['strCacheFiles']				= "Fájlok";
$GLOBALS['strCacheDatabase']			= "Adatbázis";
$GLOBALS['strCacheShmop']				= "Osztott memória/Shmop";
$GLOBALS['strCacheSysvshm']				= "Osztott memória/Sysvshm";
$GLOBALS['strExperimental']				= "Kísérleti";
$GLOBALS['strKeywordRetrieval']			= "Kulcsszó visszakeresés";
$GLOBALS['strBannerRetrieval']			= "Reklám visszakeresési mód";
$GLOBALS['strRetrieveRandom']			= "Véletlenszerû reklám visszakeresés (alapértelmezett)";
$GLOBALS['strRetrieveNormalSeq']		= "Normál soros reklám viszakeresés";
$GLOBALS['strWeightSeq']			= "Fontosságon alapuló soros reklám visszakeresés";
$GLOBALS['strFullSeq']				= "Teljes soros reklám visszakeresés";
$GLOBALS['strUseConditionalKeys']		= "Logikai mûveleti jelek engedélyezése a közvetlen kiválasztás használatakor";
$GLOBALS['strUseMultipleKeys']			= "Több kulcsszó engedélyezése a közvetlen kiválasztás használatakor";

$GLOBALS['strZonesSettings']			= "Zóna visszakeresése";
$GLOBALS['strZoneCache']			= "Zónák gyorsítótárazása, ez felgyorsíthat dolgokat a zónák használatakor";
$GLOBALS['strZoneCacheLimit']			= "A gyorsítótár két frissítése közti idõ (másodpercben)";
$GLOBALS['strZoneCacheLimitErr']		= "A gyorsítótár két frissítése közti idõ pozitív egész szám legyen";

$GLOBALS['strP3PSettings']			= "P3P Adatvédelmi Nyilatkozatok";
$GLOBALS['strUseP3P']				= "P3P Nyilatkozatok használata";
$GLOBALS['strP3PCompactPolicy']			= "P3P Tömör Nyilatkozat";
$GLOBALS['strP3PPolicyLocation']		= "P3P Nyilatkozat helye"; 



// Banner Settings
$GLOBALS['strBannerSettings']			= "Reklám beállításai";

$GLOBALS['strAllowedBannerTypes']		= "Engedélyezett reklámtípusok";
$GLOBALS['strTypeSqlAllow']			= "Helyi reklámok engedélyezése (SQL)";
$GLOBALS['strTypeWebAllow']			= "Helyi reklámok engedélyezése (Webkiszolgáló)";
$GLOBALS['strTypeUrlAllow']			= "Külsõ reklámok engedélyezése";
$GLOBALS['strTypeHtmlAllow']			= "HTML-reklámok engedélyezése";
$GLOBALS['strTypeTxtAllow']			= "Szöveges hirdetések engedélyezése";

$GLOBALS['strTypeWebSettings']			= "Helyi reklám (Webkiszolgáló) beállításai";
$GLOBALS['strTypeWebMode']			= "Tárolási mód";
$GLOBALS['strTypeWebModeLocal']			= "Helyi könyvtár";
$GLOBALS['strTypeWebModeFtp']			= "Külsõ FTP-kiszolgáló";
$GLOBALS['strTypeWebDir']			= "Helyi mappa";
$GLOBALS['strTypeWebFtp']			= "FTP-módú webreklámkiszolgáló";
$GLOBALS['strTypeWebUrl']			= "Nyilvános hivatkozás";
$GLOBALS['strTypeFTPHost']			= "FTP-állomás";
$GLOBALS['strTypeFTPDirectory']			= "Állomás könyvtára";
$GLOBALS['strTypeFTPUsername']			= "Felhasználónév";
$GLOBALS['strTypeFTPPassword']			= "Jelszó";
$GLOBALS['strTypeFTPErrorDir']			= "A könyvtár nem létezik az állomáson";
$GLOBALS['strTypeFTPErrorConnect']		= "Nem sikerült kapcsolódni az FTP-kiszolgálóhoz, a felhasználónév vagy a jelszó hibás";
$GLOBALS['strTypeFTPErrorHost']			= "Az FTP-kiszolgáló állomásneve pontatlan";
$GLOBALS['strTypeDirError']				= "A helyi könyvtár nem létezik";



$GLOBALS['strDefaultBanners']			= "Alapértelmezett reklámok";
$GLOBALS['strDefaultBannerUrl']			= "Alapértelmezett kép hivatkozás";
$GLOBALS['strDefaultBannerTarget']		= "Alapértelmezett cél hivatkozás";

$GLOBALS['strTypeHtmlSettings']			= "HTML-reklám tulajdonságai";
$GLOBALS['strTypeHtmlAuto']			= "A HTML-reklámok automatikus módosítása a kattintás-nyomkövetés utasítása céljából";
$GLOBALS['strTypeHtmlPhp']			= "A PHP-leírások HTML-reklámból történõ végrehajtásának engedélyezése";



// Host information and Geotargeting
$GLOBALS['strHostAndGeo']				= "Állomás információja és geotargeting";

$GLOBALS['strRemoteHost']				= "Távoli állomás";
$GLOBALS['strReverseLookup']			= "A látogató állomásnevének megállapítása, ha a kiszolgáló nem továbbítja";
$GLOBALS['strProxyLookup']				= "A látogató valódi IP-címének megállapítása, ha proxy kiszolgálót használ";

$GLOBALS['strGeotargeting']				= "Geotargeting";
$GLOBALS['strGeotrackingType']			= "A geotargeting adatbázis típusa";
$GLOBALS['strGeotrackingLocation'] 		= "A geotargeting adatbázis helye";
$GLOBALS['strGeotrackingLocationError'] = "A geotargeting adatbázis nem létezik az ön által megadott helyen";
$GLOBALS['strGeoStoreCookie']			= "Az eredmény tárolása cookie-ban a késõbbi hivatkozás céljára";



// Statistics Settings
$GLOBALS['strStatisticsSettings']		= "Statisztika beállításai";

$GLOBALS['strStatisticsFormat']			= "Statisztika formátuma";
$GLOBALS['strCompactStats']				= "Statisztika formátuma";
$GLOBALS['strLogAdviews']				= "Letöltés naplózása a reklám minden továbbításakor";
$GLOBALS['strLogAdclicks']				= "Kattintás naplózása a felhasználó a reklámra történõ minden kattintásakor";
$GLOBALS['strLogSource']				= "A hívás közben megadott forrás paraméter naplózása";
$GLOBALS['strGeoLogStats']				= "A látogató országának naplózása a statisztikában";
$GLOBALS['strLogHostnameOrIP']			= "A látogató állomásnevének vagy IP-címének naplózása";
$GLOBALS['strLogIPOnly']				= "Csak a látogató IP-címének naplózása, még ha az állomásnév ismert is";
$GLOBALS['strLogIP']					= "A látogató IP-címének naplózása";
$GLOBALS['strLogBeacon']				= "Kis jelzõkép használata a letöltések naplózásához a csak a továbbított reklámok naplózásának ellenõrzéséhez";

$GLOBALS['strRemoteHosts']				= "Távoli állomások";
$GLOBALS['strIgnoreHosts']				= "Nincs statisztika készítés a következõ IP-címek vagy állomásnevek valamelyikét használó látogatókról";
$GLOBALS['strBlockAdviews']				= "Nincs letöltés naplózás, ha a látogató már látta ugyanazt a reklámot a megadott másodperceken belül";
$GLOBALS['strBlockAdclicks']			= "Nincs kattintás naplózás, ha a látogató már rákattintott ugyanarra a reklámra a megadott másodperceken belül";


$GLOBALS['strPreventLogging']			= "Naplózás korlátozása";
$GLOBALS['strEmailWarnings']			= "Figyelmeztetések e-mailben";
$GLOBALS['strAdminEmailHeaders']		= "A következõ fejlécek hozzáadása a ".$phpAds_productname." által küldött elektronikus üzenethez";
$GLOBALS['strWarnLimit']				= "Figyelmeztetés küldése, ha a maradék letöltések száma kevesebb az itt megadottnál";
$GLOBALS['strWarnLimitErr']				= "A figyelmeztetési korlátozás pozitív szám legyen";
$GLOBALS['strWarnAdmin']				= "Figyelmeztetés küldése az adminisztrátornak, ha egy kampány lejárata közeledik";
$GLOBALS['strWarnClient']				= "Figyelmeztetés küldése a hirdetõnek, ha közeledik a kampánya lejárata";
$GLOBALS['strQmailPatch']				= "A qmail folt engedélyezése";

$GLOBALS['strAutoCleanTables']			= "Adatbázis karbantartása";
$GLOBALS['strAutoCleanStats']			= "Statisztika kiürítése";
$GLOBALS['strAutoCleanUserlog']			= "Felhasználói napló kiürítése";
$GLOBALS['strAutoCleanStatsWeeks']		= "A statisztika maximális kora <br>(minimum 3 hét)";
$GLOBALS['strAutoCleanUserlogWeeks']	= "A felhasználói napló maximális <br>kora (minimum 3 hét)";
$GLOBALS['strAutoCleanErr']				= "A maximális kor legalább 3 hét legyen";
$GLOBALS['strAutoCleanVacuum']			= "A táblák VÁKUMOS ELEMZÉSE minden éjjel"; // only Pg


// Administrator settings
$GLOBALS['strAdministratorSettings']		= "Adminisztrátor beállításai";

$GLOBALS['strLoginCredentials']			= "Belépési igazolvány";
$GLOBALS['strAdminUsername']			= "Adminisztrátor felhasználóneve";
$GLOBALS['strInvalidUsername']			= "A felhasználónév érvénytelen";

$GLOBALS['strBasicInformation']			= "Alapinformáció";
$GLOBALS['strAdminFullName']			= "Adminisztrátor teljes neve";
$GLOBALS['strAdminEmail']			= "Adminisztrátor e-mail címe";
$GLOBALS['strCompanyName']			= "Cég";

$GLOBALS['strAdminCheckUpdates']		= "Frissítés keresése";
$GLOBALS['strAdminCheckEveryLogin']		= "Minden belépéskor";
$GLOBALS['strAdminCheckDaily']			= "Naponta";
$GLOBALS['strAdminCheckWeekly']			= "Hetente";
$GLOBALS['strAdminCheckMonthly']		= "Havonta";
$GLOBALS['strAdminCheckNever']			= "Soha";

$GLOBALS['strAdminNovice']			= "Biztonsági célból megerõsítés szükséges az adminisztrátor törléseihez";
$GLOBALS['strUserlogEmail']			= "Minden kimenõ e-mail naplózása";
$GLOBALS['strUserlogPriority']			= "Óránkénti prioritás számítások naplózása";
$GLOBALS['strUserlogAutoClean']			= "Az adatbázis automatikus karbantartásának naplózása";


// User interface settings
$GLOBALS['strGuiSettings']			= "Felhasználói kezelõfelület beállításai";

$GLOBALS['strGeneralSettings']			= "Általános beállítások";
$GLOBALS['strAppName']				= "Alkalmazás neve";
$GLOBALS['strMyHeader']				= "Fejlécfájl helye";
$GLOBALS['strMyHeaderError']		= "Nem található a fejlécfájl az ön által megadott helyen";
$GLOBALS['strMyFooter']				= "Lábjegyzetfájl helye";
$GLOBALS['strMyFooterError']		= "Nem található a lábjegyzetfájl az ön által megadott helyen";
$GLOBALS['strGzipContentCompression']		= "GZIP tartalomtömörítés használata";

$GLOBALS['strClientInterface']			= "Hirdetõi kezelõfelület";
$GLOBALS['strClientWelcomeEnabled']		= "A hirdetõ üdvözlésének engedélyezése";
$GLOBALS['strClientWelcomeText']		= "Üdvözlõszöveg<br>(a HTML-elemek engedélyezettek)";



// Interface defaults
$GLOBALS['strInterfaceDefaults']		= "Kezelõfelület alapbeállításai";

$GLOBALS['strInventory']			= "Nyilvántartó";
$GLOBALS['strShowCampaignInfo']			= "Kiegészítõ kampány-információ megjelenítése a <i>Kampány áttekintése</i> oldalon";
$GLOBALS['strShowBannerInfo']			= "Kiegészítõ reklám-információ megjelenítése a <i>Reklám áttekintése</i> oldalon";
$GLOBALS['strShowCampaignPreview']		= "A reklámok megtekintése elõnézetben a <i>Reklám áttekintése</i> oldalon";
$GLOBALS['strShowBannerHTML']			= "HTML-reklám elõnézet esetén az aktuális reklám megjelenítése a HTML-kód helyett";
$GLOBALS['strShowBannerPreview']		= "A reklám elõnézetének megjelenítése a reklámokkal foglalkozó oldalak tetején";
$GLOBALS['strHideInactive']			= "Az inaktív objektumok elrejtése az áttekintéses oldalakról";
$GLOBALS['strGUIShowMatchingBanners']		= "Az egyezõ reklámok megjelenítése a <i>Kapcsolt reklám</i> oldalakon";
$GLOBALS['strGUIShowParentCampaigns']		= "A szülõ kampányok megjelenítése a <i>Kapcsolt reklám</i> oldalakon";
$GLOBALS['strGUILinkCompactLimit']		= "A nem kapcsolt kampányok vagy reklámok elrejtése a <i>Kapcsolt reklám</i> oldalakon, ha nincs több, mint";

$GLOBALS['strStatisticsDefaults'] 		= "Statisztika";
$GLOBALS['strBeginOfWeek']			= "A hét kezdete";
$GLOBALS['strPercentageDecimals']		= "Százalékos arány tizedesjegyei";

$GLOBALS['strWeightDefaults']			= "Alapértelmezett fontosság";
$GLOBALS['strDefaultBannerWeight']		= "Alapértelmezett reklám fontosság";
$GLOBALS['strDefaultCampaignWeight']		= "Alapértelmezett kampány fontosság";
$GLOBALS['strDefaultBannerWErr']		= "Az alapértelmezett reklám fontosság pozitív egész szám legyen";
$GLOBALS['strDefaultCampaignWErr']		= "Az alapértelmezett kampány fontosság pozitív egész szám legyen";



// Not used at the moment
$GLOBALS['strTableBorderColor']			= "Táblázatszegély színe";
$GLOBALS['strTableBackColor']			= "Táblázatháttér színer";
$GLOBALS['strTableBackColorAlt']		= "Táblázatháttér színe (választható)";
$GLOBALS['strMainBackColor']			= "Fõ háttérszín";
$GLOBALS['strOverrideGD']			= "A GD képformátum hatálytalanítása";
$GLOBALS['strTimeZone']				= "Idõzóna";

?>