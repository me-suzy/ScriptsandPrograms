<?php // $Revision: 1.12 $

/************************************************************************/
/* phpAdsNew 2                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2001 by the phpAdsNew developers                       */
/* http://sourceforge.net/projects/phpadsnew                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


// Set text direction and characterset
$GLOBALS['phpAds_TextDirection']  = "ltr";
$GLOBALS['phpAds_TextAlignRight'] = "right";
$GLOBALS['phpAds_TextAlignLeft']  = "left";


// Set translation strings
$GLOBALS['strHome'] = "Hoofdpagina";
$GLOBALS['date_format'] = "%d-%m-%Y";
$GLOBALS['time_format'] = "%H:%i:%S";
$GLOBALS['strMySQLError'] = "MySQL-Fout:";
$GLOBALS['strAdminstration'] = "Administratie";
$GLOBALS['strAddClient'] = "Voeg een klant toe";
$GLOBALS['strModifyClient'] = "Wijzig klant";
$GLOBALS['strDeleteClient'] = "Verwijder klant";
$GLOBALS['strViewClientStats'] = "Bekijk statistieken klant";
$GLOBALS['strClientName'] = "Klant";
$GLOBALS['strContact'] = "Contact";
$GLOBALS['strEMail'] = "E-mail";
$GLOBALS['strViews'] = "AdViews";
$GLOBALS['strClicks'] = "AdClicks";
$GLOBALS['strTotalViews'] = "Totaal AdViews";
$GLOBALS['strTotalClicks'] = "Totaal AdClicks";
$GLOBALS['strCTR'] = "Click-Through Ratio";
$GLOBALS['strTotalClients'] = "Totaal aantal klanten";
$GLOBALS['strActiveClients'] = "Actieve klanten";
$GLOBALS['strActiveBanners'] = "Actieve banners";
$GLOBALS['strLogout'] = "Uitloggen";
$GLOBALS['strCreditStats'] = "Kredietstatistieken";
$GLOBALS['strViewCredits'] = "Adview krediet";
$GLOBALS['strClickCredits'] = "Adclick krediet";
$GLOBALS['strPrevious'] = "Vorige";
$GLOBALS['strNext'] = "Volgende";
$GLOBALS['strNone'] = "Geen";
$GLOBALS['strViewsPurchased'] = "Gekochte AdViews";
$GLOBALS['strClicksPurchased'] = "Gekochte AdClicks";
$GLOBALS['strDaysPurchased'] = "Gekochte advertentiedagen";
$GLOBALS['strHTML'] = "HTML";
$GLOBALS['strAddSep'] = "Vul OF een van beide bovenstaande velden OF onderstaand veld in!";
$GLOBALS['strTextBelow'] = "Tekst onder banner";
$GLOBALS['strSubmit'] = "Banner opslaan";
$GLOBALS['strUsername'] = "Gebruikersnaam";
$GLOBALS['strPassword'] = "Wachtwoord";
$GLOBALS['strBannerAdmin'] = "Banneradministratie voor";
$GLOBALS['strNoBanners'] = "Geen banners gevonden";
$GLOBALS['strBanner'] = "Banner";
$GLOBALS['strCurrentBanner'] = "Huidige banner";
$GLOBALS['strDelete'] = "Verwijder";
$GLOBALS['strAddBanner'] = "Voeg banner toe";
$GLOBALS['strModifyBanner'] = "Wijzig banner";
$GLOBALS['strURL'] = "Gelinked aan URL (incl. http://)";
$GLOBALS['strKeyword'] = "Sleutelwoord";
$GLOBALS['strWeight'] = "Gewicht";
$GLOBALS['strAlt'] = "Alt-Text";
$GLOBALS['strAccessDenied'] = "Toegang geweigerd";
$GLOBALS['strPasswordWrong'] = "Het wachtwoord is niet correct";
$GLOBALS['strNotAdmin'] = "U heeft waarschijnlijk niet genoeg privileges";
$GLOBALS['strClientAdded'] = "De klant is toegevoegd.";
$GLOBALS['strClientModified'] = "De klant is gewijzigd.";
$GLOBALS['strClientDeleted'] = "De klant is verwijderd.";
$GLOBALS['strBannerAdmin'] = "Banneradminstratie";
$GLOBALS['strBannerAdded'] = "De banner is toegevoegd.";
$GLOBALS['strBannerModified'] = "De banner is gewijzigd.";
$GLOBALS['strBannerDeleted'] = "De banner is verwijderd";
$GLOBALS['strBannerChanged'] = "De banner is gewijzigd";
$GLOBALS['strStats'] = "Statistieken";
$GLOBALS['strDailyStats'] = "Dagelijkse statistieken";
$GLOBALS['strDetailStats'] = "Gedetailleerde statistieken";
$GLOBALS['strCreditStats'] = "Kredietstatistieken";
$GLOBALS['strActive'] = "actief";
$GLOBALS['strActivate'] = "Activeer";
$GLOBALS['strDeActivate'] = "Deactiveer";
$GLOBALS['strAuthentification'] = "Authenticatie";
$GLOBALS['strGo'] = "Start";
$GLOBALS['strLinkedTo'] = "gelinked aan";
$GLOBALS['strBannerID'] = "Banner-ID";
$GLOBALS['strClientID'] = "Klant-ID";
$GLOBALS['strMailSubject'] = "Advertentierapport";
$GLOBALS['strMailSubjectDeleted'] = "Gedeactiveerde banners";
$GLOBALS['strMailHeader'] = "Geachte {contact},\n";
$GLOBALS['strMailBannerStats'] = "Bijgevoegd vind u de banner-statistieken van {clientname}:";
$GLOBALS['strMailFooter'] = "Met vriendelijke groet,\n    {adminfullname}";
$GLOBALS['strLogMailSent'] = "[phpAdsNew] Statistieken successvol verzonden.";
$GLOBALS['strLogErrorClients'] = "[phpAdsNew] Er is een fout opgetreden. De klanten konden niet worden opgevraagd vanuit de database.";
$GLOBALS['strLogErrorBanners'] = "[phpAdsNew] Er is een fout opgetreden. De banners konden niet worden opgevraagd vanuit de database.";
$GLOBALS['strLogErrorViews'] = "[phpAdsNew] Er is een fout opgetreden. De AdViews konden niet worden opgevraagd vanuit de database.";
$GLOBALS['strLogErrorClicks'] = "[phpAdsNew] Er is een fout opgetreden. De AdClicks konden niet worden opgevraagd vanuit de database.";
$GLOBALS['strLogErrorDisactivate'] = "[phpAdsNew] Er is een fout opgetreden. De banner kon niet gedeactiveerd worden.";
$GLOBALS['strRatio'] = "Click-Through Ratio";
$GLOBALS['strChooseBanner'] = "Gelieve het type banner te kiezen.";
$GLOBALS['strMySQLBanner'] = "Banner opgeslagen in SQL";
$GLOBALS['strWebBanner'] = "Banner opgeslagen op de Webserver";
$GLOBALS['strURLBanner'] = "Banner waarnaar verwezen wordt d.m.v. een URL";
$GLOBALS['strHTMLBanner'] = "HTML-banner";
$GLOBALS['strNewBannerFile'] = "Nieuw banner-bestand";
$GLOBALS['strNewBannerURL'] = "Nieuwe banner-URL (incl. http://)";
$GLOBALS['strWidth'] = "Breedte";
$GLOBALS['strHeight'] = "Hoogte";
$GLOBALS['strTotalViews7Days'] = "Totaal AdViews afgelopen 7 dagen";
$GLOBALS['strTotalClicks7Days'] = "Totaal AdClicks afgelopen 7 dagen";
$GLOBALS['strAvgViews7Days'] = "Gemiddelde AdViews afgelopen 7 dagen";
$GLOBALS['strAvgClicks7Days'] = "Gemiddelde AdClicks afgelopen 7 dagen";
$GLOBALS['strTopTenHosts'] = "Top tien hosts";
$GLOBALS['strClientIP'] = "IP adres bezoeker";
$GLOBALS['strUserAgent'] = "User agent regexp";
$GLOBALS['strWeekDay'] = "Weekdag (0 - 6)";
$GLOBALS['strDomain'] = "Domein (zonder punt)";
$GLOBALS['strSource'] = "Bronpagina";
$GLOBALS['strTime'] = "Tijd";
$GLOBALS['strAllow'] = "Toestaan";
$GLOBALS['strDeny'] = "Weigeren";
$GLOBALS['strResetStats'] = "Wis Statistieken";
$GLOBALS['strExpiration'] = "Vervaldatum";
$GLOBALS['strNoExpiration'] = "Geen vervaldatum ingesteld";
$GLOBALS['strDaysLeft'] = "Dagen te gaan";
$GLOBALS['strEstimated'] = "Geschatte vervaldag";
$GLOBALS['strConfirm'] = "Weet u zeker ?";
$GLOBALS['strBannerNoStats'] = "Geen statistieken voor deze banner!";
$GLOBALS['strWeek'] = "Week";
$GLOBALS['strWeeklyStats'] = "Wekelijkse statistieken";
$GLOBALS['strWeekDay'] = "Weekdag";
$GLOBALS['strDate'] = "Datum";
$GLOBALS['strCTRShort'] = "CTR";
$GLOBALS['strDayShortCuts'] = array("zo","ma","di","wo","do","vr","za");
$GLOBALS['strShowWeeks'] = "Max. aantal getoonde weken";
$GLOBALS['strAll'] = "alle";
$GLOBALS['strAvg'] = "Gem.";
$GLOBALS['strHourly'] = "Views/Clicks per uur";
$GLOBALS['strTotal'] = "Totaal";
$GLOBALS['strUnlimited'] = "Onbegrensd";
$GLOBALS['strSave'] = "Bewaren";
$GLOBALS['strUp'] = "Omhoog";
$GLOBALS['strDown'] = "Omloog";
$GLOBALS['strSaved'] = "is bewaard !";
$GLOBALS['strDeleted'] = "is verwijderd !";  
$GLOBALS['strMovedUp'] = "is omhoog geplaatst";
$GLOBALS['strMovedDown'] = "is omlaag geplaatst";
$GLOBALS['strUpdated'] = "is gewijzigd";
$GLOBALS['strLogin'] = "Inloggen";
$GLOBALS['strPreferences'] = "Instellingen";
$GLOBALS['strAllowClientModifyInfo'] = "Deze klant kan zijn eigen instelling(en) wijzigen";
$GLOBALS['strAllowClientModifyBanner'] = "Deze gebruiker kan zijn eigen banner wijzigen";
$GLOBALS['strAllowClientAddBanner'] = "Deze gebruiker kan zijn eigen banners toevoegen";
$GLOBALS['strLanguage'] = "Taal";
$GLOBALS['strDefault'] = "Standaard";
$GLOBALS['strErrorViews'] = "U moet het aantal AdViews invullen of het vakje 'Onbegrensd' aankruisen!";
$GLOBALS['strErrorNegViews'] = "Negatieve AdViews zijn niet toegestaan";
$GLOBALS['strErrorClicks'] =  "U moet het aantal AdClicks invullen of het vakje 'Onbegrensd' aankruisen!";
$GLOBALS['strErrorNegClicks'] = "Negatieve AdClicks zijn niet toegestaan";
$GLOBALS['strErrorDays'] = "U moet het aantal advertentiedagen invullen of het vakje 'Onbegrensd' aankruisen!";
$GLOBALS['strErrorNegDays'] = "Negatieve dagen zijn niet toegestaan";
$GLOBALS['strTrackerImage'] = "Tracker image:";

// New strings for version 2
$GLOBALS['strNavigation'] 				= "Navigatie";
$GLOBALS['strShortcuts'] 				= "Directe links";
$GLOBALS['strDescription'] 				= "Beschrijving";
$GLOBALS['strClients'] 					= "Klanten";
$GLOBALS['strID']				 		= "ID";
$GLOBALS['strOverall'] 					= "Overall";
$GLOBALS['strTotalBanners'] 			= "Totaal banners";
$GLOBALS['strToday'] 					= "Vandaag";
$GLOBALS['strThisWeek'] 				= "Deze week";
$GLOBALS['strThisMonth'] 				= "Deze maand";
$GLOBALS['strBasicInformation'] 		= "Standaard informatie";
$GLOBALS['strContractInformation'] 		= "Contract informatie";
$GLOBALS['strLoginInformation'] 		= "Inlog gegevens";
$GLOBALS['strPermissions'] 				= "Permissies";
$GLOBALS['strGeneralSettings']			= "Standaard instellingen";
$GLOBALS['strSaveChanges']		 		= "Bewaar veranderingen";
$GLOBALS['strCompact']					= "Compact";
$GLOBALS['strVerbose']					= "Uitgebreid";
$GLOBALS['strOrderBy']					= "gesorteerd op";
$GLOBALS['strShowAllBanners']	 		= "Toon alle banners";
$GLOBALS['strShowBannersNoAdClicks']	= "Toon banners zonder AdClicks";
$GLOBALS['strShowBannersNoAdViews']		= "Toon banners zonder AdViews";
$GLOBALS['strShowAllClients'] 			= "Toon alle klanten";
$GLOBALS['strShowClientsActive'] 		= "Toon klanten met actieve banners";
$GLOBALS['strShowClientsInactive']		= "Toon klanten zonder actieve banners";
$GLOBALS['strSize']						= "Afmetingen";

$GLOBALS['strMonth'] 					= array("januari","februari","maart","april","mei","juni","juli","augustus","september","oktober","november","december");
$GLOBALS['strDontExpire']				= "Deze campagne niet laten vervallen op een specifieke datum";
$GLOBALS['strActivateNow'] 				= "Deze campagne direct activeren";
$GLOBALS['strExpirationDate']			= "Vervaldatum";
$GLOBALS['strActivationDate']			= "Activeringsdatum";

$GLOBALS['strMailClientDeactivated'] 	= "Uw banner zijn gedeactiveerd omdat";
$GLOBALS['strMailNothingLeft'] 			= "Indien u verder wilt adverteren op onze website, neem dan gerust contact met ons op. We horen graag van u.";
$GLOBALS['strClientDeactivated']		= "Deze campagne is momenteel niet actief omdat";
$GLOBALS['strBeforeActivate']			= "de activeringsdatum bereikt is";
$GLOBALS['strAfterExpire']				= "de vervaldatum bereikt is";
$GLOBALS['strNoMoreClicks']				= "de gekochte AdClicks gebruikt zijn";
$GLOBALS['strNoMoreViews']				= "de gekochte AdViews gebruikt zijn";

$GLOBALS['strBanners'] 					= "Banners";
$GLOBALS['strCampaigns']				= "Campagnes";
$GLOBALS['strCampaign']					= "Campagne";
$GLOBALS['strModifyCampaign']			= "Wijzig campagne";
$GLOBALS['strName']						= "Naam";
$GLOBALS['strBannersWithoutCampaign']	= "Banners zonder campagne";
$GLOBALS['strMoveToNewCampaign']		= "Verplaats naar een nieuwe campagne";
$GLOBALS['strCreateNewCampaign']		= "Maak nieuwe campagne";
$GLOBALS['strEditCampaign']				= "Wijzig campagne";
$GLOBALS['strEdit']						= "Wijzig";
$GLOBALS['strCreate']					= "Maak";
$GLOBALS['strUntitled']					= "Naamloos";

$GLOBALS['strTotalCampaigns'] 			= "Totaal campagnes";
$GLOBALS['strActiveCampaigns'] 			= "Actieve campagnes";

$GLOBALS['strLinkedTo']					= "gelinked naar";
$GLOBALS['strSendAdvertisingReport']	= "Stuur een advertentierapport per e-mail";
$GLOBALS['strNoDaysBetweenReports']		= "Aantal dagen tussen rapporten";
$GLOBALS['strSendDeactivationWarning']  = "Stuur een waarschuwing wanneer de campagne gedeactiveerd wordt";

$GLOBALS['strWarnClientTxt']			= "Er zijn minder dan {limit} AdClicks of AdViews over voor uw banners. ";
$GLOBALS['strViewsClicksLow']			= "Uw AdViews/AdClicks zijn bijna volledig gebruikt";

$GLOBALS['strDays']						= "Dagen";
$GLOBALS['strHistory']					= "Geschiedenis";
$GLOBALS['strAverage']					= "Gemiddelde";
$GLOBALS['strDuplicateClientName']		= "De gebruikersnaam die u gekozen heeft bestaat al, kies een andere gebruikersnaam.";
$GLOBALS['strAllowClientDisableBanner'] = "Deze gebruiker kan zijn eigen banners deactiveren";
$GLOBALS['strAllowClientActivateBanner'] = "Deze gebruiker kan zijn eigen banners activeren";

$GLOBALS['strGenerateBannercode']		= "Genereer Bannercode";
$GLOBALS['strChooseInvocationType']		= "Kies het type banner invocatie";
$GLOBALS['strGenerate']					= "Genereer";
$GLOBALS['strParameters']				= "Parameters";
$GLOBALS['strUniqueidentifier']			= "Unieke identificatie";
$GLOBALS['strFrameSize']				= "Frame grootte";
$GLOBALS['strBannercode']				= "Bannercode";

$GLOBALS['strSearch']					= "Zoeken";
$GLOBALS['strNoMatchesFound']			= "Geen objecten gevonden";

$GLOBALS['strNoViewLoggedInInterval']   = "Er zijn geen AdViews gelogd gedurende de dagen van dit rapport";
$GLOBALS['strNoClickLoggedInInterval']  = "Er zijn geen AdClicks gelogd gedurende de dagen van dit rapport";
$GLOBALS['strMailReportPeriod']			= "Dit rapport bevat de statistieken van {startdate} tot en met {enddate}.";
$GLOBALS['strMailReportPeriodAll']		= "Dit rapport bevat alle statistieken tot en met {enddate}.";
$GLOBALS['strNoStatsForCampaign'] 		= "Er zijn geen statistieken beschikbaar voor deze campagne";
$GLOBALS['strFrom']						= "Van";
$GLOBALS['strTo']						= "tot";
$GLOBALS['strMaintenance']				= "Onderhoud";
$GLOBALS['strCampaignStats']			= "Campagne statistieken";
$GLOBALS['strClientStats']				= "Klant statistieken";
$GLOBALS['strErrorOccurred']			= "Er is een fout opgetreden";
$GLOBALS['strAdReportSent']				= "Advertentierapport verzonden";

$GLOBALS['strAutoChangeHTML']			= "Verander HTML om AdClicks te loggen";

$GLOBALS['strZones']					= "Zones";
$GLOBALS['strAddZone']					= "Maak zone";
$GLOBALS['strModifyZone']				= "Wijzig zone";
$GLOBALS['strAddNewZone']				= "Voeg een zone toe";

$GLOBALS['strOverview']					= "Overzicht";
$GLOBALS['strEqualTo']					= "is gelijk aan";
$GLOBALS['strDifferentFrom']			= "is verschillend van";
$GLOBALS['strAND']						= "EN";  // logical operator
$GLOBALS['strOR']						= "OF"; // logical operator
$GLOBALS['strOnlyDisplayWhen']			= "Toon deze banner alleen wanneer:";

$GLOBALS['strStatusText']				= "Status Tekst";

$GLOBALS['strConfirmDeleteClient'] 		= "Weet u zeker dat u deze klant wilt verwijderen?";
$GLOBALS['strConfirmDeleteCampaign']	= "Weet u zeker dat u deze campagne wilt verwijderen?";
$GLOBALS['strConfirmDeleteBanner']		= "Weet u zeker dat u deze banner wilt verwijderen?";
$GLOBALS['strConfirmResetStats']		= "Weet u zeker dat u alle statistieken wilt wissen?";
$GLOBALS['strConfirmDeleteZone']		= "Weet u zeker dat u deze zone wilt wissen?";
$GLOBALS['strConfirmDeleteAffiliate']	= "Weet u zeker dat u deze affiliate wilt wissen?";

$GLOBALS['strConfirmResetCampaignStats']= "Weet u zeker dat u de statistieken wilt wissen voor deze campagne?";
$GLOBALS['strConfirmResetClientStats']	= "Weet u zeker dat u de statistieken wilt wissen voor deze klant?";
$GLOBALS['strConfirmResetBannerStats']	= "Weet u zeker dat u de statistieken wilt wissen voor deze banner?";

$GLOBALS['strClientsAndCampaigns']		= "Klanten & Campagnes";
$GLOBALS['strCampaignOverview']			= "Campagnes overzicht";
$GLOBALS['strReports']					= "Rapportage";
$GLOBALS['strShowBanner']				= "Toon banner";

$GLOBALS['strIncludedBanners']			= "Gekoppelde banners";
$GLOBALS['strProbability']				= "Waarschijnlijkheid";
$GLOBALS['strInvocationcode']			= "Invocatiecode";
$GLOBALS['strSelectZoneType']			= "Kies de manier van banners koppelen";
$GLOBALS['strBannerSelection']			= "Banner selectie";
$GLOBALS['strInteractive']				= "Interactief";
$GLOBALS['strRawQueryString']			= "Ruwe gegevens";

$GLOBALS['strBannerWeight']				= "Banner gewicht";
$GLOBALS['strCampaignWeight']			= "Campagne gewicht";

$GLOBALS['strZoneCacheOn']				= "Zone cache staat aan";
$GLOBALS['strZoneCacheOff']				= "Zone cache staat uit";
$GLOBALS['strCachedZones']				= "Gecachede zones";
$GLOBALS['strSizeOfCache']				= "Cache grootte";
$GLOBALS['strAverageAge']				= "Gemiddelde leeftijd";
$GLOBALS['strRebuildZoneCache']			= "Zone cache opnieuw aanmaken";
$GLOBALS['strKiloByte']					= "KB";
$GLOBALS['strSeconds']					= "seconden";
$GLOBALS['strExpired']					= "Vervallen";

$GLOBALS['strModifyBannerAcl'] 			= "Beperkingen";
$GLOBALS['strACL'] 						= "Beperk";
$GLOBALS['strNoMoveUp'] 				= "Kan de eerste rij niet omhoog plaatsen";
$GLOBALS['strACLAdd'] 					= "Voeg nieuwe beperking toe";
$GLOBALS['strNoLimitations']			= "Geen beperkingen";

$GLOBALS['strLinkedZones']				= "Gekoppelde Zones";
$GLOBALS['strNoZonesToLink']			= "Er zijn geen zones aanwezig waar deze banner aan gekoppeld kan worden";
$GLOBALS['strNoZones']					= "Er zijn momenteel geen zones gedefinieerd";
$GLOBALS['strNoClients']				= "Er zijn momenteel geen klanten gedefinieerd";
$GLOBALS['strNoStats']					= "Er zijn momenteel geen statistieken beschikbaar";
$GLOBALS['strNoAffiliates']				= "Er zijn momenteel geen affiliates gedefinieerd";

$GLOBALS['strCustom']					= "Anders";

$GLOBALS['strSettings'] 				= "Instellingen";

$GLOBALS['strAffiliates']				= "Affiliates";
$GLOBALS['strAffiliatesAndZones']		= "Affiliates & Zones";
$GLOBALS['strAddAffiliate']				= "Maak affiliate";
$GLOBALS['strModifyAffiliate']			= "Wijzig affiliate";
$GLOBALS['strAddNewAffiliate']			= "Voeg een affiliate toe";

$GLOBALS['strCheckAllNone']				= "Selecteer alle / geen";

$GLOBALS['strAllowAffiliateModifyInfo'] = "Deze gebruiker kan zijn eigen affiliate informatie wijzigen";
$GLOBALS['strAllowAffiliateModifyZones'] = "Deze gebruiker kan zijn eigen zones wijzigen";
$GLOBALS['strAllowAffiliateLinkBanners'] = "Deze gebruiker kan banners koppelen aan zijn eigen zones";
$GLOBALS['strAllowAffiliateAddZone'] = "Deze gebruiker kan nieuwe zones definieeren";
$GLOBALS['strAllowAffiliateDeleteZone'] = "Deze gebruiker kan bestaande zones verwijderen";

$GLOBALS['strPriority']					= "Prioriteit";
$GLOBALS['strHighPriority']				= "Toon de banners in deze campagne met hoge prioriteit.<br>
										   Indien u deze optie gebruikt zal phpAdsNew proberen om het 
										   aantal AdViews gelijkmatig over de dag de verspreiden.";
$GLOBALS['strLowPriority']				= "Toon de banners in deze campagne met lage prioriteit.<br>
										   Deze campagne wordt gebruikt om de overgebleven AdViews te tonen, 
										   welke niet gebruikt worden door hoge prioriteit campagnes.";
$GLOBALS['strTargetLimitAdviews']		= "Limiteer het aantal AdViews tot";
$GLOBALS['strTargetPerDay']				= "per dag.";
$GLOBALS['strRecalculatePriority']		= "Prioriteit opnieuw berekenen";

$GLOBALS['strProperties']				= "Eigenschappen";
$GLOBALS['strAffiliateProperties']		= "Affiliate eigenschappen";
$GLOBALS['strBannerOverview']			= "Banner overzicht";
$GLOBALS['strBannerProperties']			= "Banner eigenschappen";
$GLOBALS['strCampaignProperties']		= "Campagne eigenschappen";
$GLOBALS['strClientProperties']			= "Klant eigenschappen";
$GLOBALS['strZoneOverview']				= "Zone overzicht";
$GLOBALS['strZoneProperties']			= "Zone eigenschappen";
$GLOBALS['strAffiliateOverview']		= "Affiliate overzicht";
$GLOBALS['strLinkedBannersOverview']	= "Gekoppelde banners overzicht";

$GLOBALS['strGlobalHistory']			= "Globale geschiedenis";
$GLOBALS['strBannerHistory']			= "Banner geschiedenis";
$GLOBALS['strCampaignHistory']			= "Campagne geschiedenis";
$GLOBALS['strClientHistory']			= "Klant geschiedenis";
$GLOBALS['strAffiliateHistory']			= "Affiliate geschiendenis";
$GLOBALS['strZoneHistory']				= "Zone geschiendenis";
$GLOBALS['strLinkedBannerHistory']		= "Gekoppelde banner geschiedenis";

$GLOBALS['strMoveTo']					= "Verplaats naar";
$GLOBALS['strDuplicate']				= "Dupliceer";

$GLOBALS['strMainSettings']				= "Hoofd instellingen";
$GLOBALS['strAdminSettings']			= "Administratie instellingen";

$GLOBALS['strApplyLimitationsTo']		= "Pas limitaties toe op";
$GLOBALS['strWholeCampaign']			= "Hele campagne";
$GLOBALS['strZonesWithoutAffiliate']	= "Zones zonder affiliate";
$GLOBALS['strMoveToNewAffiliate']		= "Verplaats naar een nieuwe affiliate";

$GLOBALS['strNoBannersToLink']			= "Er zijn momenteel geen banners beschikbaar welke gekoppeld kunnen worden aan deze zone";
$GLOBALS['strNoLinkedBanners']			= "Er zijn banners beschikbaar welke gekoppeld zijn aan deze zone";

$GLOBALS['strAdviewsLimit']				= "AdViews limiet";

$GLOBALS['strTotalThisPeriod']			= "Totaal deze periode";
$GLOBALS['strAverageThisPeriod']		= "Gemiddelde deze periode";
$GLOBALS['strLast7Days']				= "Laatste 7 dagen";
$GLOBALS['strDistribution']				= "Verdeling";
$GLOBALS['strOther']					= "Andere";
$GLOBALS['strUnknown']					= "Onbekend";

$GLOBALS['strWelcomeTo']				= "Welcome to";
$GLOBALS['strEnterUsername']			= "Enter your username and password to log in";

$GLOBALS['strBannerNetwork']			= "Banner network";
$GLOBALS['strMoreInformation']			= "More information...";
$GLOBALS['strChooseNetwork']			= "Choose the banner network you want to use";
$GLOBALS['strRichMedia']				= "Richmedia";
$GLOBALS['strTrackAdClicks']			= "Track AdClicks";
$GLOBALS['strYes']						= "Yes";
$GLOBALS['strNo']						= "No";
$GLOBALS['strUploadOrKeep']				= "Do you wish to keep your <br>existing image, or do you <br>want to upload another?";
$GLOBALS['strCheckSWF']					= "Check for hard-coded links inside the Flash file";
$GLOBALS['strURL2']						= "URL";
$GLOBALS['strTarget']					= "Target";
$GLOBALS['strConvert']					= "Convert";
$GLOBALS['strCancel']					= "Cancel";

$GLOBALS['strConvertSWFLinks']			= "Convert Flash links";
$GLOBALS['strConvertSWF']				= "<br>The Flash file you just uploaded contains hard-coded urls. phpAdsNew won't be ".
										  "able to track the number of AdClicks for this banner unless you convert these ".
										  "hard-coded urls. Below you will find a list of all urls inside the Flash file. ".
										  "If you want to convert the urls, simply click <b>Convert</b>, otherwise click ".
										  "<b>Cancel</b>.<br><br>".
										  "Please note: if you click <b>Convert</b> the Flash file ".
									  	  "you just uploaded will be physically altered. <br>Please keep a backup of the ".
										  "original file. Regardless of in which version this banner was created, the resulting ".
										  "file will need the Flash 4 player (or higher) to display correctly.<br><br>";

$GLOBALS['strSourceStats']				= "Source Stats";
$GLOBALS['strSelectSource']				= "Select the source you want to view:";

?>