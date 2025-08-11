<?php

$para = array();

$para['index::tip'] = <<<_P
Gebruik deze pagina om de SiteBar Favorieten Server te starten of te installeren. Het wordt aangeraden om één van de favorieten met een "*" als link op te slaan in plaats van deze pagina. Deze pagina kan worden geopend vanaf het SiteBar venster door op het logo te klikken.
_P;

$para['index::any_browser'] = <<<_P
Gebruik <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>*
in dit venster - of open het in een pop-up <a title="SiteBar" href="%s">SiteBar</a>* venster.
_P;

$para['index::ie_install'] = <<<_P
<a href="?install=1">Installeer</a> / <a href="?install=0">Verwijder</a>
in de Explorer Balk en context menu - vereist een Windows registry aanpassing en een herstart
om alle toepassingen te kunnen gebruiken. Afhankelijk van uw rechten worden wellicht niet alle
toepassingen geinstalleerd.
<p class='comment'>Open de SiteBar Explorer Balk via menu Beeld/Explorer-Balk of
gebruik de <b>Aanpassen...</b> werkbalk' functie om het SiteBar Paneel aan en uit te zetten.
Klik met uw rechter muistoets overal op de pagina of op een link om deze pagina of link toe te
voegen aan de SiteBar.
_P;

$para['index::ie_search'] = <<<_P
Voeg <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))">
SiteBar</a>* tijdelijk aan de 'Zoeken' Explorer Balk toe.
<p class='comment'>Gebruik dit als u niet voldoende rechten heeft om bovenstaande installatie te gebruiken.</p>
_P;

$para['index::mozilla'] = <<<_P
Voeg een<a title="SiteBar"
href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
sidebar</a> toe aan een Mozilla/Netscape compatibele browser - zet deze aan en uit met F9.
<p class='comment'>Mozilla Firefox gebruikers dienen de link hierboven te gebruiken
om een bookmark te maken die in de sidebar geopend wordt. Dit Mozillazine
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">topic</a> beschrijft hoe een <a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> sidebar extensie en <a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">WebLinks</a> menu uitbreiding
met SiteBar te gebruiken.
</p>
_P;

$para['index::opera'] = <<<_P
Voeg aan Opera's <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a> toe.
<p class='comment'>Gebruik Ctrl+click in plaats van rechts klikken om de map weer te geven of voor het context menu links.</p>
_P;

$para['index::myie2_install'] = <<<_P
Download een aangepaste
<a href="http://sitebar.org/plugin/myie2/?sidebar=%s">sidebar</a>
en/of
<a href="http://sitebar.org/plugin/myie2/?toolbar=%s">Voeg de huidige tab aan de SiteBar</a>
werkbalk plugin toe.
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">Voeg pagina toe aan SiteBar</a>* - klik met de rechter muis toets op de link en voeg deze toe aan de favorieten/link werkbalk. Hierdoor kunt u later een link naar de pagina te maken welke u op dit moment bekijkt in de browser. MS Internet Explorer gebruikers kunnen hiervoor ook de installer en het context menu gebruiken.
_P;

$para['index::copyright2'] = <<<_P
Copyright � 2003,2004 <a href='http://brablc.com/'>Ondřej Brablc</a> en het <a href='http://sitebar.org/team.php'>SiteBar Team</a>.
Ondersteuning in het <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>forum</a>.
_P;

$para['command::contact'] = <<<_P
Bericht:

%s

--
SiteBar installatie op %s.
_P;

$para['command::contact_group'] = <<<_P
Groep: %s
Bericht:

%s


--
SiteBar installatie op %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Weet u zeker dat u uw account wilt verwijderen?</h3>
Er is geen manier om dit te herstellen!<p>
Alle overgebleven structuren worden aan de beheerder van het systeem gegeven.
_P;

$para['command::email_link_href'] = <<<_P
<p>Verstuur e-mail via uw standaard
<a href='mailto:?subject=Website: %s&body=Ik heb een website gevonden waar je wellicht in geinteresseerd in bent.
 Kijk op: %s
--
Verstuurd via SiteBar op %s
Open Source Favorieten Server http://sitebar.org
'>e-mail programma.</a>
_P;

$para['command::email_link'] = <<<_P
Ik heb een website gevonden waar je wellicht in geinteresseerd in bent.
Kijk op:

    "%s" %s

%s

--
Verstuurd via SiteBar op %s
Open Source Favorieten Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
U heeft e-mailverificatie aangevraagd, waarmee u zich automatisch kunt aanmelden bij
groepen met reguliere expressies en waarmee u SiteBar's e-mail toepassingen kunt gebruiken.

Klik alstublieft op de volgende link om uw e-mail te bevestigen:
  %s
_P;

$para['command::import_bk'] = <<<_P
<br>
Lokale favorieten kunnen geexporteerd worden naar een bestand met deze javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>functie</a>.
_P;

$para['command::export_bk'] = <<<_P
<br>
Geexporteerde favorieten kunnen geimporteerd worden naar lokale favorieten met deze javascript <a href='javascript:window.external.ImportExportFavorites(true,"")'>functie</a>.
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer kan favorieten in het 'Netscape Bookmark File Format' im- en exporteren.
Deze moeten echter wel in de Windows eigen taal-codering zijn, want de standaard UTF-8 zal niet werken.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Codepage conversie is niet geinstalleerd op de SiteBar server.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rechten:
<strong>R</strong>ead (lees),
<strong>A</strong>dd (toevoegen),
<strong>M</strong>odify (aanpassen),
<strong>D</strong>elete (niet tonen),
<strong>P</strong>urge (verwijderen),
<strong>G</strong>rant (toekennen)
_P;

$para['command::purge_cache'] = <<<_P
<h3>Wilt u echt alle favicons uit de cache verwijderen?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Uw e-mailadres komt overeen met de regels om uzelf automatisch aan te melden bij de volgende gesloten groep(en):
    %s.

Om uw lidmaatschap goed te keuren, moet uw e-mailadres worden geverifieerd. Klik alstublieft op de volgende link om deze te verifieren:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Gebruiker "%s" <%s> heeft zich aangemeld bij uw SiteBar installatie op %s.
_P;

$para['hook::statistics'] = <<<_P
Bronnen {roots_total}.
Mappen {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Gebruikers {users}.
Groepen {groups}.
SQL queries {queries}.
DB/Totale tijd {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
