<?php

$para = array();

$para['index::tip'] = <<<_P
Brug denne side til at starte eller installere SiteBar i din browser
fra den server du læser dette. Det anbefales at huske bogmærket
fra en af henvisningerne mærket med "*" i stedet for bogmærket hertil.
Denne side kan åbnes fra SiteBar winduet ved at klikke på SiteBar logoet.
_P;

$para['index::any_browser'] = <<<_P
Brug <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>*
i dette vindue - eller åben det i en pop-up
<a title="SiteBar" href="%s">SiteBar</a>-lignende* vindue.
_P;

$para['index::ie_install'] = <<<_P
<a href="?install=1">Installér</a> / <a href="?install=0">AfInstallér</a>
til Internet Explorer Bar og højre-klik menu - kræver ret til at ændre
registreringsdatabasen og genstart af systemet. Afhængig af dine rettigheder
er det måske kun nogle faciliteter der installeres.
<p class='comment'>Åbn SiteBar Explorer Bar fra menuen View/Explorer Bar eller
anvend <b>Tilpas...</b> værktøjslinie' funktionen til at få SiteBar Panel knappen
vist på værktøjslinien. Højre klik hvorsomhelst på siden
over et link for at tilføje referencen til SiteBar.
</p>

_P;

$para['index::ie_search'] = <<<_P
Tilføj <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))">
SiteBar</a>* midlertidigt til søge panelet i browseren.
<p class='comment'>Kan bruges når du ikke har rettigheder
til at installere eller opdatere Windows registrerings databasen.</p>
_P;

$para['index::mozilla'] = <<<_P
Add to a Mozilla/Netscape compatible
<a title="SiteBar"
href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
sidebar</a> - skift visning ved at bruge F9.
<p class='comment'>Mozilla Firefox brugere skal bruge ovenstående henvisning for at oprette et bogmærke som åbnet SideBAr når der klikkes. Mozillazine
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">topic</a> beskriver hvorledes man kan bruge <a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> sidebar
udvidelser og <a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">WebLinks</a> menu udvidelse
med SiteBar.
</p>
_P;

$para['index::opera'] = <<<_P
Tilføj til Opera's <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a>
as sidebar.
<p class='comment'>Use Ctrl+click instead of Right+click to display folder or link context menu.</p>
_P;

$para['index::myie2_install'] = <<<_P
Download tilpasset
<a href="http://sitebar.org/plugin/myie2/?sidebar=%s">sidebar</a>
og/eller
<a href="http://sitebar.org/plugin/myie2/?toolbar=%s">Tilføj nuværnde tab til SiteBar</a>
toolbar plugin.
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">Tilføj side til SiteBar</a>* - højre klik på link og tilføj til din favorit/bogmærke værktøjslinie. Det vil tillade dig senere at tilføje et link til den side du aktuelt ser i browseren hvor SiteBar er vist. MS IE users can use installer and context menu instead.
_P;

$para['index::copyright2'] = <<<_P
Copyright &copy; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
and the <a href='http://sitebar.org/team.php'>SiteBar Team</a>.
Support <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>forum</a>.
_P;

$para['command::contact'] = <<<_P
Meddelelse:

%s


--
SiteBar installation hos %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppe: %s
Meddelelse:

%s


--
SiteBar installation hos %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Ønsker du virkelig at slette din konto?</h3>
Du vil ikke kunne fortryde det senere !<p>
Alle de resterende hierakier vil blive overgivet til administratoren af systemet.
_P;

$para['command::email_link_href'] = <<<_P
<p>Send e-post vha. din almindelige e-post klient program
<a href='mailto:?subject=Web site: %s&body=Jeg har fundet en hjemmeside du måske er interesseret i.
 Prøv at kigge på: %s
 --
 Sendt via SiteBar hos %s
 Open Source Bookmark Server http://sitebar.org
'>e-mail client</a>
_P;

$para['command::email_link'] = <<<_P
Jeg har fundet en hjemmeside du måske er interesseret i.
Prøv at kigge på:

    "%s" %s

%s

--
Sendt via SiteBar hos %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Du har ønsket e-post verifikation som tillader tilmelding af/til grupper med automatisk tilmelding vha. søgekriterier (re) og tillader dig at gøre brug af SiteBar's e-post faciliteter.

Klik venligt på den følgende henvisning for at validere din e-post adresse:
  %s
_P;

$para['command::import_bk'] = <<<_P
<br>
Local favorites can be exported to a local file using javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>function</a>.
_P;

$para['command::export_bk'] = <<<_P
<br>
Eksporterede bogmærker kan blive importeret til lokale favoritter ved at bruge javascript.
<a href='javascript:window.external.ImportExportFavorites(true,"")'>function</a>.
_P;

$para['command::noiconv'] = <<<_P
<br>
Tegnsæts konvertering er ikke installeret på denne SiteBar server.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rettigheder:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete,
<strong>P</strong>urge,
<strong>G</strong>rant
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vil du virkelig slette alle favorit ikoner fra mellem lageret (cachen) ?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Di e-post adresse matches rules for auto join to following
closed group(s):
    %s.

For at godkende dit medlemsskab skal din e-post adresse verificeres.
 Klik venligst på den følgende henvisning for at gøre det:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Brugeren "%s" <%s> tilmeldte sig til din SiteBar installation %s.
_P;

$para['hook::statistics'] = <<<_P
Rødder {roots_total}.
Mapper {nodes_shown}/{nodes_total}.
Henvisninger {links_shown}/{links_total}.
Brugere {users}.
Grupper {groups}.
SQL forespørgsler {queries}.
DB/Sammenlagt tid {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
