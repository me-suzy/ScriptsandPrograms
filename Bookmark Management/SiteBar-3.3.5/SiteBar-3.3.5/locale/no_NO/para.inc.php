<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Velkommen til SiteBar Integrering. Her kan du legge inn SiteBars Online Bokmerker som panel i din nettleser, og fÃ¥ mest mulig ut av SiteBar. Du finne bla. ogsÃ¥ bookmarklet for kjapt Ã¥ legge inn nye bokmerker - mens du surfer.
_P;

$para['integrator::header'] = <<<_P
SiteBar er utviklet for Ã¥ fungere med de fleste standard nettlesere som stÃ¸tter javascript og cookies. Tabellen nedenfor viser nettlesere som er testet og som virker med SiteBar. Velg din nettleser, og fÃ¸lg instruksjonene nedenfor.
_P;

$para['integrator::usage_opera'] = <<<_P
OBS! Husk Ã¥ krysse av for "Vis Menyikon" i dine brukerinnstillinger. I nettleseren Opera mÃ¥ du venstre+klikker pÃ¥ menyikonet for Ã¥ fÃ¥ opp menyene. Etter at du har lagt inn SiteBars som panel i Opera og bokmerkeprogrammet vises i panelet i Opera: Logg inn, gÃ¥ inn i dine brukerinnstillinger, og krysse av for "Vis Menyikon". Ellers vil du ikke fÃ¥ opp de konteksmenyene som du hÃ¥ndtere dine bokmerker med.  Ãrsaken er at Opera ikke stÃ¸tter <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Operabrukere anbefales ogsÃ¥ Ã¥ skru av XSLT i SiteBars brukerinnstillinger.
_P;

$para['integrator::hint'] = <<<_P
Klikk over pÃ¥ navnet pÃ¥ din nettleser for Ã¥ fÃ¥ veiledningen i hvordan du integrerer SiteBar i din nettleser. <a href="http://brablc.com/mailto?o">Meld fra</a> hvis du har verifisert andre nettlesere/platformer.
_P;

$para['integrator::hint_window'] = <<<_P
Vanlig lenke. Klikk pÃ¥ denne for Ã¥ Ã¥pner SiteBar i nettleserens vindu. MERK! Siden SiteBar
er laget for Ã¥ vises i et panel er dette en lÃ¸sning bare for brukere som bruker
eldre nettlesere som ikke har panel.
_P;

$para['integrator::hint_dir'] = <<<_P
SiteBar kan nÃ¥ ogsÃ¥ vises som en tradisjonell emnekatalog, ved siden av Ã¥
kunne vises som et filtre. I denne visningen vises en og en mappe samt
beskrivelsen for hver lenke i mappa. For Ã¥ kunne bruke denne visningen
mÃ¥ nettleseren din stÃ¸tte <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Bruke denne bookmarkletten* hvis du har en gammel nettleser uten sidepanel.
Den vil Ã¥pne SiteBar i et sprettopp-vindu, pÃ¥ lignende mÃ¥te som i et panel.
OBS! Virker ikke hvis nettleseren din blokkere sprettoppvinduer.
_P;

$para['integrator::hint_addpage'] = <<<_P
Bruk denne bookmarkleten* for Ã¥ ta bokmerke av den siden du viser i nettleseren
din direkte. NÃ¥r du legge den opp pÃ¥ verktÃ¸ylinja di. Klikker du pÃ¥ den nÃ¥r
du vil legge inn en lenke til den i dine SiteBar bokmerkesamling. Du fÃ¥r
da opp et sprettoppvindu som automatisk er fyllt med URL og detaljene
fra den viste siden.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
<i>* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> (ogsÃ¥ kalt favlet) er et bokmerke / favoritt med et spesiell kode. Den fungerer som en snarvei for raskere Ã¥ legge inn nye bokmerker i SiteBar. Klikk og dra Bookmarkleten - den du finner i tabellen overfor - opp pÃ¥ vertÃ¸yfeltet under menylinja i nettleseren din. (Du mÃ¥ vise Lenker (MSIE), Bookmarks toolbar (FireFox), eller personlig verktÃ¸ylinje (Opera) for Ã¥ lenka.). NÃ¥r du vil legge til en nettside, klikker du bare pÃ¥ dette bokmerket, sÃ¥ vil den spesielle koden hente opp lenkeinformasjon, slik at det for deg bare er Ã¥ velge mappe, normal, og klikke ok.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Legger til SiteBar BokmerkesÃ¸k i ditt websÃ¸kefelt. Tillater sÃ¸king i SiteBar-bokmerker uten Ã¥ mÃ¥tte Ã¥pne SiteBar fÃ¸rst.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Tillegg utviklet spesielt for SiteBar. Tillater deg Ã¥ Ã¥pne alla lenkene i en mappe i hver sin arkfane, og andre nyttige funksjoner. Bruk menyen "View/Toolbar/Customize" for Ã¥ legge SiteBar-ikoner inn pÃ¥ verktÃ¸ylinja.
[<a href="http://sitebarsidebar.mozdev.org/">Projektsidan</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Oppretter et bokmerke som senere kan klikkes pÃ¥ for Ã¥ Ã¥pen SiteBar-panelet.
_P;

$para['integrator::hint_booksync'] = <<<_P
Last ned tillegg for synkronisering av bokmerker. Start Firefox pÃ¥ nytt, Ã¥pne FireFox TilleggshÃ¥ndtering (Extension manager) og sett protokollen (remote file settings protocol) til <strong>HTTP</strong>, vert <strong>%s</strong> og sÃ¸kebanen <strong>%s</strong>. For tiden fungerer kun synkronisering fra SiteBar til Firefox synkronisering.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Last ned hele mappestrukturen i dine SiteBar online bokmerker, til en fil. Importer denne filen til dine bokmerker. Hver av mappene funker nÃ¥ som Live Bookmark. Det vil si at pÃ¥ denne mÃ¥ten vil dine bokmerker bli integrert blandt dine andre bokmerker, mens mappeinnholdet vil funke online - nedlastet fra SiteBar. Om en mappe har undermapper, vil innholdet i mappa vises i mappa @Content.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Last ned og installer <a href="http://sourceforge.net/projects/mozlinker/">tillegget</a> (OBS! Det tillegget kan ikke deinstalleres). En ny meny kalt "MozLinker" vil vises i din nettlesers meny. Bruk undermenyen "Config..." og legg til enten en ny meny eller en ny verktÃ¸ylinje (toolbar). Som ressurs-URL kan du bruke URL-en fra lenka "MozLinker Extension" pÃ¥ venstre side.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Legger inn SiteBar som sidepanel [sidebar]. Dette panelet kan vises/skjules med [F9]. OBS! Hvis SiteBar ikke lastes ned i panelet innen for en gitt tidsramme, vil Mozilla ikke kunne vise den. Du anbefales Ã¥ Ã¥pne SiteBar i hovedvinduet i nettleseren din og Ã¥ mellomlagre lenkeikoner (favicons) i webleseren, eller rett og slett Ã¥ slÃ¥ av visning av lenkeikoner i dine "Brukerinnstillinger".
_P;

$para['integrator::hint_hotlist'] = <<<_P
En lenke til SiteBar vil vises i bokmerkepanelet [Hotlistpanel]. Ett klikk pÃ¥ den vil Ã¥pne SiteBar i Operas sidepanel.
_P;

$para['integrator::hint_install'] = <<<_P
Installerer SiteBar til IE's Explorer-felt og kontekstmeny. Siden dette krever endring i registeret mÃ¥ du starte maskinen pÃ¥ nytt for Ã¥ se alle funksjonene. Hvis du ikke har fulle rettigherer kan noen av funksjonene ikke bli installert.<br> Du Ã¥pner SiteBars i Explorer-feltet fra menylinja. Velg Vis/Explorer-felt (View/Explorer Bar). Eller legg til SiteBar som en knapp pÃ¥ verktÃ¸ylinja slik: PÃ¥ menylinja, velg <b>VerktÃ¸ylinjer</b> pÃ¥ <b>Vis</b>-menyen. Velg deretter <b>Tilpass</b>. Finn fram til SiteBar i hÃ¸yre felt og velg legg til.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Avinstallerer SiteBar fra verkttÃ¸yfeltet (se over).
_P;

$para['integrator::hint_searchbar'] = <<<_P
For deg som mangler privilegier for Ã¥ fÃ¥ installert SiteBar i Explorer-feltet. Bruk denne bookmarklett*. Den Ã¥pner SiteBar midlertidig i MSIEs Explorer-felt.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Last ned en plugin (med forhÃ¥ndsinnstilt URL). Arkivet mÃ¥ pakkes ut til mappa "C:\Program Files\Maxthon\Plugin". Etter at du starter opp pÃ¥ nytt, har du et nytt valg i Explorer-feltet.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Last ned en plugin (med forhÃ¥ndsinnstilt URL). Arkivet mÃ¥ pakkes ut til mappa "C:\Program Files\Maxthon\Plugin". Etter ommstart vil et nytt ikon vises i verktÃ¸yfeltet Plugin. Klikk pÃ¥ dette ikonet sÃ¥ blir aktiv nettside lagt til SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
KjÃ¸r kommandoen <strong>emerge sitebar</strong> for Ã¥ installere SiteBar-pakka.
_P;

$para['integrator::hint_debian'] = <<<_P
KjÃ¸r kommandoen <strong>apt-get install sitebar</strong> for Ã¥ installere SiteBar-pakka.
_P;

$para['integrator::hint_phplm'] = <<<_P
"PHP Layers Menu" er et meget effektivt hierarkisk menysystem for dynamiska nettsider (DHTML) som sparer bÃ¥ndbredde ved Ã¥ behandle data pÃ¥ tjeneren, og ikke hos klienten (PHP). SiteBar kan mate den med bokmerker i en korrekt struktur. Hvis det pÃ¥ din tjener er tillatt for fopen Ã¥ Ã¥pne eksterne filer, vil fÃ¸lgende kode laste fil med korrekt struktur:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright © 2003-2005 <a href='http://brablc.com/'>OndÅej Brablc</a> og <a href='http://sitebar.org/team.php'>SiteBar-teamet</a>. Support <a href='http://sitebar.org/forum.php'>forum</a> og <a href='http://sitebar.org/bugs.php'>bug</a>-sporing.
_P;

$para['command::welcome'] = <<<_P
%s, velkommen til SiteBar!
%s
<p>
SiteBar betjenes via kontekstmenyer som vises ved Ã¥ hÃ¸yreklikke pÃ¥ en mappe eller lenke.
Hvis din nettleser ikke stÃ¸tter hÃ¸yreklikk, prÃ¸v Ã¥ Ctrl-klikke eller slÃ¥ pÃ¥ "Vis menyikon"
i dine Brukerinstillinger. DÃ¥ vises et menyikon foran alle mapper og lenker, og du kan da Ã¥pne kontekstmenyene ved Ã¥ klikke pÃ¥ dette ikonet.
<p>
For mer info om SiteBar, klikk "Hjelp" pÃ¥ bunn av SiteBar.
<p>
Du har allerede blitt logget inn.
_P;

$para['command::signup_verify'] = <<<_P
<p>
For Ã¥ aktivere din SiteBar-konto mÃ¥ du verifisere
at epostadressen du oppga er din.
<p>
Du motta straks en epost med en lenke. Klikk
pÃ¥ den for Ã¥ verifisere.
_P;

$para['command::signup_approve'] = <<<_P
<p>
FÃ¸r du kan bruke din SiteBar-konto mÃ¥ en administrator
godkjenne den.
<p>
NÃ¥r den er godkjent, vil du motta en epostmelding om det.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
For Ã¥ aktivere din konto mÃ¥ du verifisere at
epostadressen du oppga er din. Dernest mÃ¥ en
administrator godkjenne den.
<p>
Du motta straks en epost med en lenke for Ã¥
verifisere epostadressen. Klikk pÃ¥ den for Ã¥
verifisere. Din konto blir sÃ¥ aktivert sÃ¥snart
en administrator godkjenner den. NÃ¥r det skjer
blir du varslet pr epost.
_P;

$para['command::account_approved'] = <<<_P
Din SiteBar-konto er godkjent. Du logger deg
inn ved bruk av epostadressen %s.

--
SiteBar-installasjonen finner du her %s.
_P;

$para['command::account_rejected'] = <<<_P
Din SiteBar-konto med epostadressen er avvist
--
SiteBar-installasjonen finner du her %s.
_P;

$para['command::account_deleted'] = <<<_P
Administrator har slettet din inaktive konto 
med epostadressen %s.

-- 
SiteBar-installasjonen ved %s.
_P;

$para['command::reset_password'] = <<<_P
Det er bedt om en fornyelse av passordet for din SiteBar-konto med epostadressen "%s".

Hvis det er du som har bedt om dette, og du virkelig Ã¸nsker Ã¥ fornyet passordet,
klikk pÃ¥ fÃ¸lgende lenke:
    %s


--
SiteBar-installasjonen finner du her %s.
_P;

$para['command::contact'] = <<<_P
Melding:

%s


--
SiteBar-installasjon %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppe: %s
Melding:

%s


--
SiteBar-installasjon %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Vil du virkelig slette din konto?</h3>
Det finnes ikke noen mÃ¥te Ã¥ gjÃ¸re om pÃ¥ denne endringen!<p>
Alle dine trÃ¦r vil bli overfÃ¸rt til systemets administrator.
_P;

$para['command::email_link_href'] = <<<_P
<p>Send epost via din standard
<a href='mailto:?subject=Websted: %s&body=Jeg har funnet et websted som du kan vÃ¦re interessert i.
 Ta en kikk pÃ¥: %s
 --
 Sendt deg via SiteBar %s
 Ãpen kildekode bokmerketjener http://sitebar.org'>epostklient</a>
_P;

$para['command::email_link'] = <<<_P
Jeg har funnet et websted som du kansje er interessert i.
Ta en kikk pÃ¥:

    "%s" %s

%s

--
Sendt deg via SiteBar %s
Bokmerketjener i Ã¥pen kildekode http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Du har forespurt om epost-validering som tillater deg Ã¥ delta i
grupper med automatisk deltakelse med "regular expressions" og
som tillater deg Ã¥ bruke SiteBars epostfunksjoner.

Vennligst klikk pÃ¥ fÃ¸lgende lenke for Ã¥ verifisere din epost:
    %s
_P;

$para['command::verify_email_must'] = <<<_P
Du har tegnet deg for en SiteBar-konto. Du mÃ¥ verifisere
den oppgitte epostadressen fÃ¸r du kan bruke kontoen.

Klikk pÃ¥ fÃ¸lgende lenke for Ã¥ verifisere din epostadresse:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer har stÃ¸tte for Ã¥ importere og eksportere bokmerker i filformatet for Netscapes bokmerker. Men fila mÃ¥ vÃ¦re i Windows standard tegnkoding. UTF-8 fungerer ikke.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Bokmerker i Internet Explorer kan eksportere til filformatet for Netscapes bokmerker fra menylinja
i menyen "Fil/Importer og Eksporter ...".
Den eksporterte fila har imidlertid den tegnkode som du har pÃ¥ din Windows-innstallasjon - vennligst
velg denne tegnkoden (encoding), nÃ¥r du importerer fila, Standardverdien UTF-8 fungerer ikke.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Tegnkode-konvertering er ikke installert pÃ¥ denne SiteBar-tjeneren. Kun UTF-8 og ISO-8859-1 er stÃ¸ttet.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rights:
L<strong>e</strong>s,
<strong>L</strong>egg til,
<strong>M</strong>odifiser
<strong>S</strong>lett,
<strong>R</strong>ens,
<strong>T</strong>illat
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vil du virkelig fjerne alle favikoner fra mellomlageret?</h3>
_P;

$para['command::tooltip_respect'] = <<<_P
Send epost kun hvis bruker har tillatt det.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Sen epost bare til verifiserte adresser.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Tillat admin Ã¥ bli kontaktet av anonym bruker.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Hvis dette ikke tillates, vil alle brukere bruke sÃ¸kemaskinen som er satt i dette skjemaet, og vil ikke kunne modifisere den.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Tillat brukere tilgang til registreringsskjemaet i SiteBar
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Vis kommandoer for import og eksport av lenkebeskrivelser.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Skru pÃ¥ en SiteBar-modus for installasjon for enkeltbruker.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
La brukere opprette ekstra trÃ¦r.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
La brukerne slette deres eksisterende trÃ¦re.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
La brukere opprette sine egne grupper. I motsatt fall vil bare admin ha dette privilegiet.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Bruk konverteringsmotor (vanligvis en PHP-ekstensjon) for Ã¥ konvertere sider med forskjellige koding - viktig for import og eksport av bokmerker.  Kan fÃ¸re til blank skjerm pÃ¥ noen installasjoner dog.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Sider sendt med SiteBar kan komprimeres for Ã¥ spare bÃ¥ndbredde. Komprimering blir bare brukt mot nettlesere som stÃ¸tter det.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
I tilfelle denne PHP-installasjonen tillater bruk av "mail"-funksjonen - sÃ¥ kan epost-egenskaper settes pÃ¥.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Noen funksjoner (favicon cache) krever tilgang til fjernadresser fra din tjener.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Brukere mÃ¥ godkjennes av admin fÃ¸r de kan bruke SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Brukere mÃ¥ verifisere epostadressen fÃ¸r de kan bruke SiteBar
_P;

$para['command::tooltip_show_logo'] = <<<_P
Vis logo Ã¸verst - kan slÃ¥s av for trege verter, eller kan brukes for avertering.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Vis noe statistikk (ytelse) i panelet.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Skru pÃ¥ direkte nedlastng av bokmerke eller feed for anonym bruker. Kan omgÃ¥s hvis bruker vet hvordan URL-er dannes!
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Favikoner lastes ned til tjeneren til databasecacheen og sendes pÃ¥ forespÃ¸rsel fra klienter. Ãker trafikken og setter fart i favikon-cacheen ved Ã¥ redusere antallet tjenere du har tilkobling til.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO-stack. De eldste ikoner kasseres fra systemet - brukes for Ã¥ kontrollere stÃ¸rrelsen pÃ¥ cacheen.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maks tillatt stÃ¸rrelse pÃ¥ ikon i byte.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Neste gang du bruker bookmarklet vil denne mappa vÃ¦re satt som standard.
_P;

$para['command::tooltip_private'] = <<<_P
Ignorer private lenker ved eksport. Private lenker blir altid ignorert for andre brukere enn eieren.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ikke valider denne lenka - til bruk pÃ¥ intranet-lenker eller lenker som har problemer med validering.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Denne lenka bestod ikke validering. Du vil kanskje fortsatt beholde den som aktiv.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Valider denne mappa rekursivt med alle undermapper.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Ikke test lenker som nylig er testet - brukes for gjentatt validering nÃ¥r en tidligere ikke ble avsluttet.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Analyser siden og finn favikoner (snarveisikoner) som mangler.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Slett favikon-URL-er fra lenker hvis faviko er ugyldig - bruk dette med forsiktighet.
_P;

$para['command::tooltip_rename'] = <<<_P
Ved import, gi nytt navn til alle duplikatlenker slik at alt lastes.
_P;

$para['command::tooltip_hits'] = <<<_P
Rut alle klikk og lenker via SiteBar-tjeneren for Ã¥ generere brukerstatistikk.
_P;

$para['command::tooltip_subdir'] = <<<_P
Eksporter alle lenker og mapper rekursivt.
_P;

$para['command::tooltip_flat'] = <<<_P
Eksporter lenkene som om de var i en mappe.
_P;

$para['command::tooltip_cmd'] = <<<_P
Legg til de viktigste kommandoene i Sitebar for gjÃ¸re det lettere Ã¥ logge inn.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Denne SiteBar-installasjonen krever epost-verifikasjon.
Hvis du ikke verifiserer din epost, blir kontoen du opprettet slettet.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Din epostadresse passer med regler for automatisk deltakelse i
fÃ¸lgede lukkede gruppe(r):
    %s.

For Ã¥ godkjenne ditt medlemsskap, mÃ¥ din epostadresse verifiseres.
Vennligst klikk pÃ¥ fÃ¸lgende lenke for Ã¥ verifisere den:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Bruker "%s" <%s> har registrert seg pÃ¥ din SiteBar-installasjon %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Brukeren "%s" <%s> tegnet seg for konto pÃ¥ din SiteBar-installasjon ved %s.
Brukeren har allerede verifisert sin epostadresse.
_P;

$para['usermanager::signup_approval'] = <<<_P
Bruker "%s" <%s> tegnet seg pÃ¥ din SiteBar-installation ved %s.

Godkjenn konto:
    %s

Avvis konto:
    %s

Se ventende brukere:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Brukeren "%s" <%s> tegnet seg for konto pÃ¥ din SiteBar-installasjon ved %s.
Brukeren har allerede verifisert sin epostadresse.

Godkjenn konto:
    %s

Avvis konto:
    %s

Se ventende brukere:
    %s
_P;

$para['hook::statistics'] = <<<_P
RÃ¸tter {roots_total}.
Mapper {nodes_shown}/{nodes_total}.
Lenker {links_shown}/{links_total}.
Brukere {users}.
Grupper {groups}.
SQL-spÃ¸rringer {queries}.
DB/Total tid {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
