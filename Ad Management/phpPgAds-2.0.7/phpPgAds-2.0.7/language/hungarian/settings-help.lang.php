<?php // $Revision: 1.1.2.4 $

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



// Settings help translation strings
$GLOBALS['phpAds_hlp_dbhost'] = "
        Írja be annak a ".$phpAds_dbmsname." adatbázis kiszolgálónak az állomásnevét, melyhez kapcsolódni kíván.
		";
		
$GLOBALS['phpAds_hlp_dbport'] = "
        Írja be a ".$phpAds_dbmsname." adatbázis kiszolgáló portját, melyhez kapcsolódni 
		kíván. A ".$phpAds_dbmsname." adatbázis alapértelmezett port száma <i>".
		($phpAds_productname == 'phpAdsNew' ? '3306' : '5432')."</i>.
		";
		
$GLOBALS['phpAds_hlp_dbuser'] = "
        Írja be azt a felhasználónevet, mellyel a ".$phpAds_productname." hozzá tud férni a ".$phpAds_dbmsname." adatbázis kiszolgálóhoz.
		";
		
$GLOBALS['phpAds_hlp_dbpassword'] = "
        Írja be azt a jelszót, amivel a ".$phpAds_productname." hozzá tud férni a ".$phpAds_dbmsname." adatbázis kiszolgálóhoz.
		";
		
$GLOBALS['phpAds_hlp_dbname'] = "
        Írja be az adatbázis kiszolgálón lévõ annak az adatbáisnak a nevét, ahol a ".$phpAds_productname." tárolni fogja az adatokat. 
		Fontos, hogy elõtte hozza létre az adatbázist az adatbázis kiszolgálón. A ".$phpAds_productname." <b>nem</b> hozza létre
		ezt az adatbázist, ha még nem létezik.
		";
		
$GLOBALS['phpAds_hlp_persistent_connections'] = "
        Az állandó kapcsolat használata jelentõsen felgyorsíthatja a ".$phpAds_productname." 
		futását, sõt, a kiszolgáló terhelését is csökkentheti. Van azonban egy hátránya, olyan
		helyen, melynek sok a látogatója, a kiszolgáló terhelése növekedhet, és nagyobb lesz,
		mint normál kapcsolatok használatakor. A hagyományos vagy az állandó kapcsolat használata
		függ a látogatók számától és a használt hardvertõl. Ha a ".$phpAds_productname." túl sok
		erõforrást köt le, akkor elõbb vessen egy pillantást erre a beállításra.
		";
		
$GLOBALS['phpAds_hlp_insert_delayed'] = "
        Adatok beszúrásakor a ".$phpAds_dbmsname." zárolja a táblát. Ha magas a hely látogatottsága, 
		akkor lehet, hogy új sor beszúrása elõtt a ".$phpAds_productname." várni fog, mert az adatbázis
		még le van zárva. Késleltetett beszúrás esetén nem kell várakoznia, és a sor beszúrására
		egy késõbbi idõpontban kerül sor, amikor a más szálak nem veszik igénybe a táblát. 
		";
		
$GLOBALS['phpAds_hlp_compatibility_mode'] = "
				Ha problémák merülnek fel a ".$phpAds_productname." egy harmadik fél által készített termékbe
		integrálásakor, akkor segíthet az adatbázis kompatibilitás mód bekapcsolása. Ha helyi módú hívásokat
		használ, és az adatbázis kompatibilitás módot bekapcsolta, akkor a ".$phpAds_productname." az
		adatbázis kapcsolat állapotát pontosan ugyanúgy hagyja, ahogy a ".$phpAds_productname." futása
		elõtt volt. Ez a tulajdonság egy kicsit lassú (csak némileg), és ezért alapértelmezés szerint
		kikapcsolt.
		";
		
$GLOBALS['phpAds_hlp_table_prefix'] = "
        Ha a ".$phpAds_productname." adatbázis használata több szoftvertermék által megosztott, akkor
		bölcs döntés a táblák nevéhez elõtagot hozzáfûzni. Ha ön a ".$phpAds_productname." több telepítését
		használja ugyanabban az adatbázisban, akkor gyõzõdjön meg arról, hogy ez az elõtag valamennyi
		telepítés számára egyedi.
		";
		
$GLOBALS['phpAds_hlp_table_type'] = "
        A ".$phpAds_dbmsname." lehetõvé teszi többféle táblatípus használatát. Mindegyik táblatípus
		egyedi tulajdonságokkal rendelkezik, és némelyik jelentõsen felgyorsíthatja a ".$phpAds_productname."
		futását. A MyISAM az alapértelmezett táblatípus, és a ".$phpAds_productname." valamennyi telepítésében
		elérhetõ. Lehet, hogy más táblatípusok nem használhatók a kiszolgálón.
		";
		
$GLOBALS['phpAds_hlp_url_prefix'] = "
        A ".$phpAds_productname." megfelelõ mûködése szempontjából fontos információ a számára, 
				hogy hol helyezkedik el a webkiszolgálón. Meg kell adnia annak a könyvtárnak a hivatkozását, melybe a ".$phpAds_productname." 
				telepítése történt. Például: <i>http://www.az-on-hivatkozasa.com/".$phpAds_productname."</i>.
		";
		
$GLOBALS['phpAds_hlp_my_header'] =
$GLOBALS['phpAds_hlp_my_footer'] = "
        Itt adhatja meg a fejléc fájlok útvonalát (pl.: /home/login/www/header.htm),
				hogy legyen fejléc és lábjegyzet az adminisztrátori kezelõfelület mindegyik
				oldalán. Szöveget vagy HTML-kódot egyaránt írhat ezekben a fájlokban (ha az 
				egyik vagy mindkét fájlban HTML-kódot akar használni, akkor ne használjon
				olyan elemeket, mint a &lt;body> vagy a &lt;html>).
		";
		
$GLOBALS['phpAds_hlp_content_gzip_compression'] = "
		A GZIP tartalomtönörítés engedélyezésével az adminisztrátor kezelõfelület egy oldalának 
		minden alkalommal történõ megnyitásakor nagyon csökkenhetnek a böngészõhöz küldött 
		adatok méretei. A funkció engedélyezéséhez legalább PHP 4.0.5 és a GZIP bõvítmény
		telepítése szükséges.
		";
		
$GLOBALS['phpAds_hlp_language'] = "
        Itt választhatja ki a ".$phpAds_productname." által használt alapértelmezett
				nyelvet. Ez a nyelv alapértelmezettként kerül felhasználásra az adminisztrátor 
				és a hirdetõ kezelõfelület számára. Ne feledje: az egyes hirdetõknek eltérõ 
				nyelvet állíthat be az adminisztrátor kezelõfelületbõl, és engedélyezhetzi a 
				hirdetõknek, hogy saját maguk váltsák át a nyelvet..
		";
		
$GLOBALS['phpAds_hlp_name'] = "
        Írja be az ehhez az alkalmazáshoz használni kívánt nevet. Ez a szöveg lesz
				látható az adminisztrátor és a hirdetû kezelõfelület valamennyi oldalán.
				Ha üresen (alapértelmezés) hagyja ezt a beállítást, akkor a	".$phpAds_productname." 
				jelenik meg helyette.
		";
		
$GLOBALS['phpAds_hlp_company_name'] = "
        Ez a név kerül felhasználásra a ".$phpAds_productname." által küldött e-mailben.
		";
		
$GLOBALS['phpAds_hlp_override_gd_imageformat'] = "
        A ".$phpAds_productname." általában felismeri, hogy a GD könyvtár telepítve
				van-e, és a GD telepített változata mely képformátumot támogatja. Azonban
				lehet, hogy ez a megállapítás pontatlan vagy hamis, a PHP némely verziója
				nem teszi lehetõvé a támogatott képformátumok felismerését. Ha a ".$phpAds_productname."
				nem tudja automatikusan megállapítani a megfelelõ képformátumot, akkor ön is
				megadhatja azt. A lehetséges értékek: nincs, png, jpeg, gif.
		";
		
$GLOBALS['phpAds_hlp_p3p_policies'] = "
        Ha akarja engedélyezni a ".$phpAds_productname." P3P Adatvédelmi Nyilatkozatát,
				akkor jelölje be ezt a tulajdonságot. 
		";
		
$GLOBALS['phpAds_hlp_p3p_compact_policy'] = "
        A cookie-kkal együtt küldött tömör nyilatkozat. Az alapértelmezett beállítás:
				'CUR ADM OUR NOR STA NID', ami lehetõvé teszi az Internet Explorer 6 számára,
				hogy elfogadja a ".$phpAds_productname." által használt cookie-kat. Változtathat
				ezeken a beállításokon, ha akar, hogy megfeleljenek a saját bizalmi 
				nyilatkozatának.
		";
		
$GLOBALS['phpAds_hlp_p3p_policy_location'] = "
        Ha teljes adatvédelmi nyilatkozatot akar használni, akkor megadhatja
				a nyilatkozat helyét.
		";
		
$GLOBALS['phpAds_hlp_log_beacon'] = "
		A jelzõképek kis méretûek és láthatatlanok, azon az oldalon vannak elhelyezve,
		melyen a reklám is megjelenik. Ha engedélyezi ezt a funkciót, akkor a 
		".$phpAds_productname." ezt a jelzõképet fogja felhasználni a letöltések
		számolására, amit a reklám kapott. Ha letiltja ezt a tulajdonságot, akkor a
		letöltés továbbítás közben kerül számolásra, azonban ez nem teljesen pontos,
		mert a továbbított reklámot nem kell mindig megjelenítenie a képernyõn.
		";
		
$GLOBALS['phpAds_hlp_compact_stats'] = "
        A ".$phpAds_productname." eredetileg eléggé terjedelmes naplózást használt,
				ami nagyon részletes volt, viszont nagyon függött az adatbázis kiszolgálótól
				is. Ez a magas látogatottságú helyeken nagy probléma lehetett. Ennek a
		proglémának a leküzdésére a ".$phpAds_productname." újfajta statisztikát is
		támogat, az adatbázis kiszolgálótól kevésbé függõ, de kevésbé részletes tömör 
		statisztikát.
		A tömör statisztika óránként gyûjti a letöltéseket és a kattintásokat, de ha
		szüksége van a részletekre, a tömör statisztikát kikapcsolhatja.
		";
		
$GLOBALS['phpAds_hlp_log_adviews'] = "
        Normál esetben minden letöltés naplózásra kerül, viszont ha ön nem akar
				statisztikát gyûjteni a letöltésekrõl, kikapcsolhatja ezt.
		";
		
$GLOBALS['phpAds_hlp_block_adviews'] = "
		Ha egy látogató frissít egy oldalt, a ".$phpAds_productname." minden alkalommal 
		egy letöltést fog naplózni. Ezzel a funkcióval gyõzõdhetünk meg arról, hogy
		csak egyetlen letöltés lett naplózva minden egyes reklámhoz az ön által megadott
		másodpercek száma esetén. Például: ha 300 másodpercre állítja ezt az értéket,
		akkor a ".$phpAds_productname." csak akkor fogja naplózni a kattintásokat, ha
		ugyanazt a reklámot még nem látta ugyanaz a felhasználó az utóbbi 5 percben.
		Ez a funkció csak akkor mûködik, ha a böngészõ fogadja a cookie-kat.
		";
		
$GLOBALS['phpAds_hlp_log_adclicks'] = "
        Normál esetben minden kattintás naplózásra kerül, viszont ha ön nem akarja
				gyûjteni a kattintások statisztikáját, akkor kikapcsolhatja.
		";
		
$GLOBALS['phpAds_hlp_block_adclicks'] = "
		Ha egy látogató többször kattint egy reklámra, a ".$phpAds_productname." minden 
		alkalommal naplóz	egy kattintást. Ezzel a funkcióval gyõzõdhetünk meg arról,
		hogy csak egy kattintás lett naplózva minden egyes reklámhoz az ön által megadott
		másodpercek száma esetén. Például: ha 300 másodpercre állítja ezt az értéket,
		akkor a ".$phpAds_productname." csak akkor fogja naplózni a kattintásokat, ha
		ugyanazt a reklámot még nem látta ugyanaz a felhasználó az utóbbi 5 percben.
		Ez a funkció csak akkor mûködik, ha a böngészõ fogadja a cookie-kat.
		";
		
$GLOBALS['phpAds_hlp_log_source'] = "
		Ha a forrásparamétert használja a híváskódban, akkor ezt az információt az adatbázisban
		is tárolhatja, így mindig láthatja a statisztikát arról, hogy hogyan teljesülnek
		a különféle forrásparaméterek. Ha nem használja a forrásparamétert, vagy nem akarja
		ennek a paraméternek ez információját tárolni, akkor nyugodtan letilthatja ezt a
		tulajdonságot.
		";
		
$GLOBALS['phpAds_hlp_geotracking_stats'] = "
		If you are using a geotargeting database you can also store the geographical information
		in the database. If you have enabled this option you will be able to see statistics about the
		location of your visitors and how each banner is performing in the different countries.
		This option will only be available to you if you are using verbose statistics.
		";
		
$GLOBALS['phpAds_hlp_log_hostname'] = "
		Ha a statisztikában tárolni kívánja a látogatók állomásnevét vagy IP-címét, akkor
		engedélyezheti ezt a funkciót. Ennek az információnak a tárolásával tudhatjuk meg,
		hogy mely állomások nyerik vissza a legtöbb reklámot. Ez a tulajdonság csak
		részletes statisztika esetén mûködik.
		";
		
$GLOBALS['phpAds_hlp_log_iponly'] = "
		A látogató állomásnevének tárolása sok helyet foglal el az adatbázisban. Ha
		engedélyezi ezt a funkciót, a ".$phpAds_productname." még mindig fogja tárolni
		az állomást információját, de csak a kevesebb helyet foglaló IP-címet fogja
		tárolni. Ez a tulajdonság nem mûködik, ha a kiszolgáló vagy a ".$phpAds_productname." 
		nem adja meg ezt az információt, mert abban az esetben mindig az IP-cím kerül
		tárolásra. 
		";
		
$GLOBALS['phpAds_hlp_reverse_lookup'] = "
		Általában a webkiszolgáló állapítja meg az állomás nevét, de lehet, hogy bizonyos
		esetekben ki kell kapcsolni. Ha használni kívánja a felhasználók állomásnevét a továbbítási 
		korlátozásokban, és/vagy statisztikát kíván errõl vezetni, a kiszolgáló viszont nem
		szolgáltat ilyen információt, akkor kapcsolja be ezt a tulajdonságot. A látogató 
		állomásnevének megállapítása némi idõt vesz igénybe: lassítja a reklámok továbbítását. 
		";
		
$GLOBALS['phpAds_hlp_proxy_lookup'] = "
		Vannak olyan látogatók, akik proxy kiszolgálón keresztül kapcsolódnak az Internethez.
		Ebben az esetben a ".$phpAds_productname." megkísérli naplózni a proxy kiszolgáló IP-címét 
		vagy állomásnevét, a felhasználóé helyett. Ha engedélyezi ezt a funkciót, akkor a
		".$phpAds_productname." megpróbálja a proxy kiszolgáló mögött tartózkodó felhasználó
		számítógépének IP-címét vagy állomásnevét. Ha nem lehet a látogató pontos címét
		megkeresni, akkor a proxy kiszolgáló címét használja. Ez a funkció alapértelmezésként
		nem engedélyezett, mert jelentõsen lelassítja a reklámok továbbítását.
		";
		
$GLOBALS['phpAds_hlp_auto_clean_tables'] = 
$GLOBALS['phpAds_hlp_auto_clean_tables_interval'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor az összegyûjtött statisztika az alábbi
		jelölõnégyzetben megadott idõtartam leteltével automatikusan törlésre kerül. Például,
		ha 5 hétre állítja ezt a jelölõnégyzetet, akkor az 5 hétnél régebbi statisztika
		automatikusan törlésre kerül.
		";
		
$GLOBALS['phpAds_hlp_auto_clean_userlog'] = 
$GLOBALS['phpAds_hlp_auto_clean_userlog_interval'] = "
		Ez a tulajdonság automatikusan törli azokat a bejegyzéseket a felashználói naplóból,
		melyek régebbiek az alábbi jelölõnégyzetben megadott hetek számánál.
		";
		
$GLOBALS['phpAds_hlp_geotracking_type'] = "
		A geotargeting lehetõvé teszi, hogy a ".$phpAds_productname." földrajzi információvá 
		alakítsa a látogató IP-címét. Ezeknek az információknak az alapján szabályozhatja a
		továbbítás korlátozását, vagy eltárolhatja ezt az információt, így megtekintheti, hogy
		mely ország generálja a legtöbb letöltést vagy kattintást. Ha engedélyezni akarja a
		geotargetinget, akkor ki kell választania, hogy mely adatbázis típusokkal rendelkezik.
		A ".$phpAds_productname." jelenleg az IP2Country
		és a <a href='http://www.maxmind.com/?rId=phpadsnew2' target='_blank'>GeoIP</a> adatbázisokat
		támogatja.
		";
		
$GLOBALS['phpAds_hlp_geotracking_location'] = "
		Amikor nem ön a GeoIP Apache modul, akkor meg kell adnia a ".$phpAds_productname." számára
		a geotargeting adatbázis helyét. Az adatbázist érdemes mindig a webkiszolgálók
		dokumentumgyökerén kívül elhelyezni, mert különben le lehet tölteni az adatbázist.
		";
		
$GLOBALS['phpAds_hlp_geotracking_cookie'] = "
		Az IP-cím földrajzi adatokká alakítása idõigényes feladat. A ".$phpAds_productname."
		a reklám minden alkalommal történõ továbbításának megakadályozására az eredményt egy
		cookie-ban tudja tárolni. Ha ez a cookie létezik, akkor a ".$phpAds_productname."
		ezt az információt használja fel az IP-cím átalakítása helyett.
		";
		
$GLOBALS['phpAds_hlp_ignore_hosts'] = "
        Ha nem akarja számolni valamely számítógéprõl érkezõ kattintásokat és letöltéseket,
				akkor ezeket felveheti erre a listára. A fordított keresés engedélyezése esetén
				tartományneveket és IP-címeket egyaránt felvehet, egyéb esetben csak az IP-címeket
				használhatja. Karakterhelyettesítõket is használhat (pl. '*.altavista.com' vagy 
				'192.168.*').
		";
		
$GLOBALS['phpAds_hlp_begin_of_week'] = "
        A legtöbb ember számára a hét elsõ napja a hétfõ, de ha a vasárnappal akarja
				kezdeni a hetet, megteheti.
		";
		
$GLOBALS['phpAds_hlp_percentage_decimals'] = "
        Azt szabja meg, hogy hány tizes hely legyen látható a statisztikai oldalakon.
		";
		
$GLOBALS['phpAds_hlp_warn_admin'] = "
        A ".$phpAds_productname." e-mailt tud önnek küldeni, ha egy kampányban már csak
				korlátozott számú kattintás vagy letöltés van hátra. Alapértelmezésként ez
				engedélyezett.
		";
		
$GLOBALS['phpAds_hlp_warn_client'] = "
        A ".$phpAds_productname." e-mailt tud küldeni a hirdetõnek, ha valamelyik kampányában
		csak korlátozott számú kattintás vagy letöltés van hátra. Alapértelmezésként ez
		engedélyezett.
		";
		
$GLOBALS['phpAds_hlp_qmail_patch'] = "
		A qmail némely verziójára egy hiba van hatással, ami a ".$phpAds_productname." által
		küldött e-mailben a fejlécnek az e-mail törzsében lévõ megjelenítését okozza. Ha
		engedélyezi ezt a beállítást, akkor a ".$phpAds_productname." qmail kompatibilis
		formátumban fogja küldeni az e-mailt.
		";
		
$GLOBALS['phpAds_hlp_warn_limit'] = "
        A határ, melynek elérésekor a ".$phpAds_productname." figyelmeztetõ e-maileket
				kezd küldeni. Ez az érték 100 alapértelmezésként.
		";
		
$GLOBALS['phpAds_hlp_allow_invocation_plain'] = 
$GLOBALS['phpAds_hlp_allow_invocation_js'] = 
$GLOBALS['phpAds_hlp_allow_invocation_frame'] = 
$GLOBALS['phpAds_hlp_allow_invocation_xmlrpc'] = 
$GLOBALS['phpAds_hlp_allow_invocation_local'] = 
$GLOBALS['phpAds_hlp_allow_invocation_interstitial'] = 
$GLOBALS['phpAds_hlp_allow_invocation_popup'] = "
		Ezekkel a beállításokkal szabályozhatja az engedélyezett hívástípusokat.
		Ha az egyik hívástípus letiltott, akkor a híváskód / reklámkód generátor
		számára nem hozzáférhetõ. Fontos: a hívásmódszerek még mindig mûködni fognak,
		ha letiltottak, viszont a generálás számára nem elérhetõek.
		";
		
$GLOBALS['phpAds_hlp_con_key'] = "
        A ".$phpAds_productname." közvetlen választást használó hatékony visszakeresõ 
		rendszert tartalmaz. Részleteket a felhasználói kézikönyvben olvashat errõl. Ezzel
		a tulajdonsággal aktiválhatja a feltételes kulcsszavakat. Alapértelmezésként
		engedélyezve.
		";
		
$GLOBALS['phpAds_hlp_mult_key'] = "
        Ha a közvetlen kiválasztást használja a reklámok megjelenítésére, akkor mindegyikhez
		megadhat kulcsszavakat. Engedélyeznie kell ezt a tulajdonságot, ha egynél több
		kulcsszót akar megadni. Alapértelmezésként engedélyezve.
		";
		
$GLOBALS['phpAds_hlp_acl'] = "
        Ha nem használja a továbbítási korlátozásokat, akkor ezzel a tulajdonsággal letilthatja
				ezt a paramétert. Ez egy kicsit felgyorsítja a ".$phpAds_productname." mûködését.
		";
		
$GLOBALS['phpAds_hlp_default_banner_url'] = 
$GLOBALS['phpAds_hlp_default_banner_target'] = "
        Ha a ".$phpAds_productname." nem tud kapcsolódni az adatbázis kiszolgálóhoz, vagy
				egyáltalán nem talál egyezõ reklámokat, például amikor összeomlik vagy törlésre
				kerül az adatbázis, akkor nem jelenít meg semmit. Lehet, hogy lesz olyan felhasználó,
				aki ilyen esetben megjelenítésre kerülõ alapértelmezett reklámot akar megadni.
				Az itt megadott alapértelmezett reklám nem kerül naplózásra, és nem kerül felhasználásra,
				ha maradnak még aktív reklámok az adatbázisban. Alapértelmezésként tiltva.
		";
		
$GLOBALS['phpAds_hlp_delivery_caching'] = "
		A továbbítás felgyorsításának elõmozdítására a ".$phpAds_productname." gyorsítótárat
		használ, ami tartalmazza a webhely látogatója számára megjelenõ reklám továbbításához 
		szükséges információkat. A továbbítás gyorsítótár alapértelmezésként az adatbázisban
		található, de a sebesség további növeléséhez lehetõség van a gyorsítótár fájlban
		vagy osztott memóriában történõ tárolására. Az osztott memória a leggyorsabb, a fájl
		is gyors. A továbbítás gyorsítótár kikapcsolása nem ajánlott, mert ez komoly hatást
		gyakorol a rendszerre.
		";
		
$GLOBALS['phpAds_hlp_type_sql_allow'] = 
$GLOBALS['phpAds_hlp_type_web_allow'] = 
$GLOBALS['phpAds_hlp_type_url_allow'] = 
$GLOBALS['phpAds_hlp_type_html_allow'] = 
$GLOBALS['phpAds_hlp_type_txt_allow'] = "
        A ".$phpAds_productname." különféle típusú reklámokat tud felhasználni, ezeket
				különféle módon tudja tárolni. Az elsõ két tulajdonság a reklámok helyi tárolására
				használható. Az adminisztrátor kezelõfelületen töltheti fel a reklámot, amit a
				".$phpAds_productname." az SQL adatbázisban vagy a webkiszolgálón fog tárolni.
		Külsõ webkiszolgálón tárolt reklámot is használhat, ill. használhat HTML-t vagy
		egyszerû szöveget a reklám generálásához.
		";
		
$GLOBALS['phpAds_hlp_type_web_mode'] = "
        Ha a webkiszolgálón tárolt reklámokat akar használni, akkor konfigurálnia
				kell ezt a beállítást. Ha helyi mappában kívánja tárolni a reklámokat, akkor
				a <i>Helyi könyvtár</i> elemet jelölje ki. Ha külsõ FTP-kiszolgálón akarja
		tárolni a reklámokat, akkor a <i>Külsõ FTP-kiszolgáló</i> elemet jelölje ki.
		Lehet, hogy némely webkiszolgálón, sõt, akár a helyi webkiszolgálón is az 
		FTP-opciót kívánja használni.
		";
		
$GLOBALS['phpAds_hlp_type_web_dir'] = "
        Adja meg a mappát, melybe a ".$phpAds_productname." a feltöltött reklámokat
				fogja másolni. A PHP számára ennek a mappának írhatónak kell lennie, ami
				azt jelenti, hogy önnek módosítania kell a könyvtár UNIX engedélyeit (chmod).
				Az ön által itt megadott könyvtárnak a webkiszolgáló dokumentumgyökerében
				kell lennie, a webkiszolgálónak közvetlenül kell tudnia szolgálnia a fájlokat.
				Ne írjon be per jelet (/). Csak akkor kell ezt a beállítást elvégeznie, ha
				tárolási módként a <i>Helyi könyvtár</i> elemet jelölte ki.
		";
		
$GLOBALS['phpAds_hlp_type_web_ftp_host'] = "
		Ha a <i>Külsõ FTP-kiszolgáló</i> tárolási módot választotta, akkor meg
		kell adnia annak az FTP-kiszolgálónak az IP-címét vagy tartománynevét, melyre a
		".$phpAds_productname." a feltöltött reklámokat másolni fogja.
		";
      
$GLOBALS['phpAds_hlp_type_web_ftp_path'] = "
		Ha a <i>Külsõ FTP-kiszolgáló</i> tárolási módot választotta, akkor meg
		kell adnia az FTP-kiszolgálón azt a könyvtárat, melybe a ".$phpAds_productname." 
		a feltöltött reklámokat másolni fogja.
		";
      
$GLOBALS['phpAds_hlp_type_web_ftp_user'] = "
		Ha a <i>Külsõ FTP-kiszolgáló</i> tárolási módot választotta, akkor meg
		kell adnia azt a felhasználónevet, melyet a ".$phpAds_productname." használni
		fog a külsõ FTP-kiszolgálóhoz történõ csatlakozáskor. 
		";
      
$GLOBALS['phpAds_hlp_type_web_ftp_password'] = "
		Ha a <i>Külsõ FTP-kiszolgáló</i> tárolási módot választotta, akkor meg
		kell adnia azt a jelszót, melyet a ".$phpAds_productname." használni
		fog a külsõ FTP-kiszolgálóhoz történõ csatlakozáskor. 
		";
      
$GLOBALS['phpAds_hlp_type_web_url'] = "
        Ha webkiszolgálón tárol reklámokat, akkor a ".$phpAds_productname." számára
				meg kell adnia, hogy melyik nyilvános hivatkozás tartozik az alább megadott
				könyvtárhoz. Ne írjon be per jelet (/).
		";
		
$GLOBALS['phpAds_hlp_type_html_auto'] = "
        Ha engedélyezi ezt a tulajdonságot, akkor a ".$phpAds_productname." automatikusan
				váltogatja a HTML reklámokat, hogy engedélyezze a kattintások naplózását. Viszont
				még ennek atulajdonságnak az engedélyezése esetén is lehetõség van ennek a tulajdonságnak
				a reklám alapú letiltására. 
		";
		
$GLOBALS['phpAds_hlp_type_html_php'] = "
        Lehetõség van arra, hogy a ".$phpAds_productname." a HTML-reklámokba ágyazott
				PHP-kódot hajtson végre. A funkció alapértelmezésként tiltva.
		";
		
$GLOBALS['phpAds_hlp_admin'] = "
        Írja be az adminisztrátor felhasználónevét. Ezzel a felhasználónévvel
				jelentkezhet be ön az adminisztrátor kezelõfelületre.
		";
		
$GLOBALS['phpAds_hlp_admin_pw'] =
$GLOBALS['phpAds_hlp_admin_pw2'] = "
        Írja be az adminisztrátor kezelõfelületre történõ bejelentkezéshez szükséges
				jelszót. A gépelési hibák megelõzése céljából kétszer kell beírnia.
		";
		
$GLOBALS['phpAds_hlp_pwold'] = 
$GLOBALS['phpAds_hlp_pw'] = 
$GLOBALS['phpAds_hlp_pw2'] = "
        Az adminisztrátor jelszavának megváltoztatásához meg kell adnia a
				fentiekben a régi jelszót. Továbbá, a gépelési hibák elkerülése végett 
				kétszer meg kell adnia az új jelszót.
		";
		
$GLOBALS['phpAds_hlp_admin_fullname'] = "
        Adja meg az adminisztrátor teljes nevét. Ez a név kerül felhasználásra
				a statisztika e-mailben történõ küldésekor.
		";
		
$GLOBALS['phpAds_hlp_admin_email'] = "
        Az adminisztrátor e-mail címe. Ez kerül felhasználásra a Feladó mezõben 
				a statisztika	e-mailben történõ küldésekor.
		";
		
$GLOBALS['phpAds_hlp_admin_email_headers'] = "
        Módosíthatja a ".$phpAds_productname." által küldött e-mailekben használt fejléceket.
		";
		
$GLOBALS['phpAds_hlp_admin_novice'] = "
        Ha szeretne figyelmeztetést kapni a hirdetõk, kampányok, reklámok, kiadók és zónák 
				törlése elõtt, akkor válassza az igaz tulajdonságot.
		";
		
$GLOBALS['phpAds_hlp_client_welcome'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a hirdetõ bejelentkezése utáni elsõ
		oldalon egy üdvözlet fog megjelenni. Az admin/templates mappában lévõ welcome.html 
		fájlban a saját üdvözletét írhatja le. Néhány dolog, amit érdemes tartalmaznia:
		az ön cégének a neve, elérhetõsége, a cég logója, a hirdetési árak oldalára
		mutató hivatkozás, stb.
		";

$GLOBALS['phpAds_hlp_client_welcome_msg'] = "
		A welcome.html fájl átszerkesztése helyett itt adhat meg egy rövid szöveget. Ha ide
		szöveget ír be, akkor a welcome.html fájl kihagyásra kerül. Használhat HTML elemeket is.
		";
		
$GLOBALS['phpAds_hlp_updates_frequency'] = "
		Ha szeretné ellenõrizni a ".$phpAds_productname." új verzióit, akkor érdemes engedélyezni
		ezt a tulajdonságot. Meghatározhatja azt is, hogy a ".$phpAds_productname." milyen 
		idõközönként kapcsolódjon a termékfrissítési kiszolgálóhoz. Ha jelent meg új verzió,
		akkor megjelenik a frissítésrõl további információt tartalmazó párbeszédablak.
		";
		
$GLOBALS['phpAds_hlp_userlog_email'] = "
		Ha szeretné a ".$phpAds_productname." által küldött elektronikus üzenetek másolatait
		megtartani, akkor engedélyezze ezt a funkciót. Az elküldött üzenetek a felhasználói naplóban
		kerülnek tárolásra. 
		";
		
$GLOBALS['phpAds_hlp_userlog_priority'] = "
		Ha meg akar gyõzõdni arról, hogy a prioritás kiszámítása megfelelõ volt, akkor
		mentést készíthet az óránkénti számolásról. Ez a jelentés tartalmazza a megjósolt
		profilt, és hogy mekkora prioritás lett hozzárendelve az összes reklámhoz. Ez
		az információ akkor lehet hasznos, ha ön hibabejelentést kíván küldeni a
		prioritás kiszámításáról. A jelentések tárolása a felhasználói naplóban történik. 
		";
		
$GLOBALS['phpAds_hlp_userlog_autoclean'] = "
		Ha meg akar gyõzõdni arról, hogy az adatbázis tisztítása megfelelõ volt, akkor
		mentheti a jelentést arról, hogy valójában mi is történt tisztítás közben.
		Ennek az információnak a tárolása a felhasználói naplóban történik.
		";
		
$GLOBALS['phpAds_hlp_default_banner_weight'] = "
		Ha magasabbra kívánja állítani az alapértelmezett reklám fontosságot, akkor itt
		adhatja meg az óhajtott fontossági értéket. Ez az érték 1 alapértelmezésként.
		";
		
$GLOBALS['phpAds_hlp_default_campaign_weight'] = "
		Ha magasabbra kívánja állítani az alapértelmezett kampány fontosságot, akkor itt
		adhatja meg az óhajtott fontossági értéket. Ez az érték 1 alapértelmezésként.
		";
		
$GLOBALS['phpAds_hlp_gui_show_campaign_info'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor <i>Kampány áttekintése</i> oldalon további 
		információ jelenik meg az egyes kampányokról. Ez a további információ tartalmazza
		a hátralévõ letöltések és a hátralévõ kattintások számát, az aktiválás dátumát,
		a lejárat dátumát és a beállított prioritást. 
		";
		
$GLOBALS['phpAds_hlp_gui_show_banner_info'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a <i>Reklám áttekintése</i> oldalon további
		információ jelenik meg az egyes reklámokról. A kiegészítõ információ tartalmazza a
		cél hivatkozást, a kulcsszavakat, a méretet és a reklám fontosságát.
		";
		
$GLOBALS['phpAds_hlp_gui_show_campaign_preview'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a <i>Reklám áttekintése</i> oldalon látható lesz
		a reklámok képe. A tulajdonság letiltása esetén még mindig lehetõség van a reklámok 
		megtekintésére, ha a <i>Reklám áttekintése</i> oldalon a reklám melletti háromszögre
		kattint.
		";
		
$GLOBALS['phpAds_hlp_gui_show_banner_html'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a tényleges HTML-reklám fog megjelenni a HTML-kód
		helyett. Ez a tulajdonság alapértelmezésként letiltott, mert lehet, hogy a HTML-reklámok
		ütköznek a felhasználói kezelõfelülettel. Ha ez a tulajdonság letiltott, még mindig lehetséges
		az aktuális HTML-reklám megtekintése, a HTML-kód melletti <i>Reklám megjelenítése</i> 
		gombra kattintással.
		";
		
$GLOBALS['phpAds_hlp_gui_show_banner_preview'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a <i>Reklám tulajdonságai</i>,
		a <i>Továbbítás tulajdonságai</i> és a <i>Zónák kapcsolása</i> oldalak tetején megtekinthetõ
		elõnézetben. A rulajdonság letiltása esetén még mindig lehetõség van a reklám
		megtekintésére az oldalak tetején lévõ <i>Reklám megjelenítése</i> gombra
		kattintással. 
		";
		
$GLOBALS['phpAds_hlp_gui_hide_inactive'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a <i>Hirdetõk és kampányok</i>, ill. a 
		<i>Kampány áttekintése</i> oldalon elrejti az inaktív reklámokat, kampányokat és 
		hirdetõket. A tulajdonság engedélyezése esetén még mindig lehetõség van a rejtett
		elemek megjelenítésére, ha a <i>Mind megjelenítése</i> gombra kattint az oldal 
		alján.
		";
		
$GLOBALS['phpAds_hlp_gui_show_matching'] = "
		Ha engedélyezi a tulajdonságot, akkor a megfelelõ reklám fog megjelenni a 
		<i>Kapcsolt reklámok</i> oldalon, a <i>Kampány kiválasztása</i> módszer kiválasztása
		esetén. Ez teszi lehetõvé, hogy ön megtekinthesse, pontosan mely reklámokat is vegye
		figyelembe továbbítás céljából kapcsolt kampány esetén. Lehetõség van az egyezõ
		reklámok megtekintésére is. 
		";
		
$GLOBALS['phpAds_hlp_gui_show_parents'] = "
		Ha engedélyezi ezt a tulajdonságot, akkor a reklámok szülõ kampányai láthatók lesznek
		a <i>Kapcsolt reklámok</i> oldalon a <i>Reklám kiválasztása</i> mód választása esetén.
		Így válik lehetõvé az ön számára, hogy a reklám kapcsolása elõtt megtekinthesse, melyik 
		reklám melyik kampányhoz is tartozik. Ez azt is jelenti, hogy a reklámok csoportosítása
		a szülõ kampányok alapján történik, és tovább már nem betûrendbe soroltak.
		";
		
$GLOBALS['phpAds_hlp_gui_link_compact_limit'] = "
		Alapértelmezésként valamennyi létezõ reklám vagy kampány látható a <i>Kapcsolt reklámok</i>
		oldalon. Emiatt ez az oldal nagyon hosszú lehet, sokféle reklám található a Nyilvántartóban.
		Ez a tulajdonság teszi lehetõvé oldalon megjelenõ objektumok maximális számát. Ha több
		objektum van, és a reklám kapcsolása különbözõképpen történik, akkor az jelenik meg,
		amelyik sokkal kevesebb helyet foglal el.
		";
		
?>