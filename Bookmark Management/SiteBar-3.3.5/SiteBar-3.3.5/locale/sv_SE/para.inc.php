<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Välkommer till SiteBar integrationssida. Denna sida hjälper dig få ut det mesta ur SiteBar. På <a href="http://sitebar.org/">SiteBars hemsida</a> kan du lära dig mer om funktionerna i SiteBar.
_P;

$para['integrator::header'] = <<<_P
SiteBar är utvecklat för att fungera med webbläsare som följer den uppsatta standarden och ska fungera på de flesta webbläsare med javascript och cookies påslagna. Följande tabell visar vilka webbläsare SiteBar har testats på.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar-användare högerklickar för att visa innehållsmenyerna för länkar och mappar.
Som Operaanvändare måste du slå på den så kallade "Menyikonen" i "Användarinställningar" och klicka på ikonen bredvid länken eller mappikonen istället. Opera stöder inte <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Du rekommenderas slå av XSLT-funktionerna i "Användarinställningar".
_P;

$para['integrator::hint'] = <<<_P
Klicka ovanför namnet på din webbläsare för att få integrationsinstruktioner. Var god <a href="http://brablc.com/mailto?o">rapportera</a> andra testade webbläsare/plattformer.
_P;

$para['integrator::hint_window'] = <<<_P
Detta är en vanlig länk som öppnar SiteBar i det detta fönster.
SiteBar är utvecklad för en vertikal, smal spalt layout. Om du öppnar det i detta fönster kommer mycket fönsterutrymme att vara outnyttjat.
_P;

$para['integrator::hint_dir'] = <<<_P
Förutom det trädlika utseendet kan SiteBar visas som en traditionell katalog.
Detta utseende visar en katalog åt gången och visar detaljer för länkarna.
Webbläsaren måste stödja <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Om din webbläsare inte har sidopanelfunktionen kan du använda denna bookmarklet* istället.
Den öppnar SiteBar i ett pop-up fönster liknande en sidopanel. Var god observera det faktum att din webbläsare kan vara inställd att blockera pop-ups.
_P;

$para['integrator::hint_addpage'] = <<<_P
Denna bookmarklet* kan användas för att lägga till länkar till SiteBar. När den körs visas ett nytt pop-up fönster som kommer att fyllas med detaljer från den nuvarande sidan.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
<i>* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> är ett bokmärke/favorit som innehåller JavaScript-kod. Du kan högerklicka på den och lägga till det till ditt bokmärke/favorit verktygsfält. Efterföljande klick på detta bokmärke kommer att köra JavaScript-koden</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Lägger till SiteBar bokmärkessökning till webbsökningsfältet. Tillåter sökning bland bokmärkena i SiteBar utan att ha SiteBar öppnad.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Tillägg utvecklat speciellt för SiteBar.
Tillåter dig att öppna alla länkar från en mapp i flikarna och andra funktioner.
Använd menyn "View/Toolbar/Customize" för att lägga till SiteBar-ikoner i ditt verktygsfält.
[<a href="http://sitebarsidebar.mozdev.org/">Projektsidan</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Skapar ett bokmärke som senare kan klickas på för att öppna SiteBar i en sidopanel.
_P;

$para['integrator::hint_booksync'] = <<<_P
Ladda ner bokmärkessynkroniseringstillägget. Starta om Firefox, öppna tilläggshanteraren och ställ in fjärrfilinställningsprotokollet <strong>HTTP</strong>, värd <strong>%s</strong> och sökvägen <strong>%s</strong>. För tillfället fungerar bara SiteBar->Firefox synkronisering.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Ladda ner mappstrukturen för hela SiteBar till en fil. Importera denna fil till dina bokmärken.
Varje mapp representeras av en "Live Bookmark". På detta sätt kommer dina bokmärken att integreras med dina andra bokmärken, men mappinnehållet kommer att laddas ner från SiteBar.
Om en mapp har undermappar kommer innehållet i mappen att visas i mappen @Content.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Ladda ner och installera <a href="http://sourceforge.net/projects/mozlinker/">tillägget</a> (OBS! Det är inte möjligt att avinstallera det). En ny meny "MozLinker" visas i webbläsarens meny. Använd "Config..." undermenyn och lägg till antingen ny meny eller nytt verktygsfält. Som resurs-URL kan du använda URLen från "MozLinker Extension"-länken på vänster sida.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Lägger till SiteBar till din sidopanel. Denna sidopanel kan visas/gömmas med F9. Om SiteBar laddas i sidopanelen och tidsgränsen överskrids under laddningen kommer Mozilla att misslyckas med att visa den. Du rekommenderas öppna SiteBar i huvudfönstret och tillåta länkbilder (favicons) att cachas i webbläsaren eller slå av favicon-visningen i "Användarinställningar".
_P;

$para['integrator::hint_hotlist'] = <<<_P
En länk till siteBar kommer att visas i Hotlistpanelen. Ett klick på denna kommer att öppna SiteBar i Operas sidopanel.
_P;

$para['integrator::hint_install'] = <<<_P
Installerar SiteBar till Explorer och högerklicksmenyn - kräver registerändring i Windows och omstart av dator för all funktionalitet. Beroende på dina rättigheter kan viss funktionalitet utebli.
<br>
Öppna SiteBar i Explorer sidopanelen från menyn Visa/Explorer-fält eller använd verktygsfältet (vanligtvis en stjärna likt favoriter-ikonen) för att växla mellan att visa/inte visa sidopanelen. Högerklicka var som helst på en hemsida eller länk för att lägga till sidan eller länken till SiteBar.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Avinstallerar Explorers verktygsfält (se ovan).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Att använda denna bookmarklet* rekommenderas ifall användaren inte har tillräckligt med privilegier för att installera Explorer sidopanelen. Denna öppnar SiteBar temporärt i Explorers sökfält.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Laddar ner en plugin (med förinställd URL). Arkivet måste packas upp till katalogen "C:\Program Files\Maxthon\Plugin". Efter omstart kommer en ny Explorer verktygsfältikon att läggas till.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Laddar ner en plugin (med förinställd URL). Arkivet måste packas upp till katalogen "C:\Program Files\Maxthon\Plugin". Efter omstart kommer en ny ikon att visas i Plugin verktygsfältet. Denna ikon tillåter sida i den aktiva fliken att läggas till i SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Kör kommandot <strong>emerge sitebar</strong> för att installera SiteBar-paketet.
_P;

$para['integrator::hint_debian'] = <<<_P
Kör kommandot <strong>apt-get install sitebar</strong> för att installera SiteBar-paketet.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu är ett hierarkiskt menysystem för att förbereda dynamiska HTML (DHTML) menyer som använder sig av PHP-motorn för att processa data.
SiteBar fungerar som server för att leverera bokmärken i en korrekt struktur. Ifall fopen tillåts för att fjärröppna filer kan följande kod ladda filer med rätt struktur:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright ? 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
och <a href='http://sitebar.org/team.php'>SiteBar Teamet</a>.
<a href='http://sitebar.org/forum.php'>Supportforum</a> och <a href='http://sitebar.org/bugs.php'>bugglista</a>.
_P;

$para['command::welcome'] = <<<_P
%s, välkommen till SiteBar!
%s
<p>
SiteBar styrs via innehållsmenyer som nås genom att högerklicka på en mapp eller länk.
Om din plattform/webbläsare inte stöder högerklick kan du trycka Ctrl och sedan klicka eller slå på "Visa Menyikon"-valet i "Användarinställningar" och klicka på ikonen.
<p>
För att läsa mer information om SiteBar, var god klicka på "Hjälp" i menyn längst ner.
<p>
Du har redan loggats in.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Denna SiteBar-installation kräver att din epostadress är korrekt och bekräftad innan du kan använda SiteBar-funktionerna.
<p>
Förutsatt att du angivit korrekt epostadress borde du få ett epostmeddelande inom kort. Var god klicka på länken i det meddelandet.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Denna SiteBar-installation kräver att konton godkänns av en administratör innan du kan använda SiteBar-funktionerna.
<p>
Var god vänta på godkännande av en administratör - du kommer att informeras via epost.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Denna SiteBar-installation kräver att din epostadress är korrekt och bekräftad och att en administratör godkänner ditt konto innan du kan använda SiteBar-funktionerna.
<p>
Förutsatt att du angivit korrekt epostadress borde du få ett epostmeddelande inom kort. Var god klicka på länken i epostmeddelandet och vänta på att en administratör godkänner ditt konto - du kommer att bli informerad via epost.
_P;

$para['command::account_approved'] = <<<_P
Administratören har godkänt ditt konto.
Du kan logga in med din epostadress %s.

--
SiteBar-installation på %s.
_P;

$para['command::account_rejected'] = <<<_P
Administratören har avslagit ditt konto med epostadress %s.

--
SiteBar-installation på %s.
_P;

$para['command::account_deleted'] = <<<_P
Administratören har tagit bort ditt inaktiva konto med e-postadress %s.

--
SiteBar installation vid %s.
_P;

$para['command::reset_password'] = <<<_P
En lösenordsåterställning för SiteBar-konto har begärts för "%s" epostadress.

Om du verkligen vill återställa lösenordet för detta konto, var god klicka på följande länk:
  %s

--
SiteBar-installation på %s.
_P;

$para['command::contact'] = <<<_P
Meddelande:

%s


--
SiteBarinstallation på %s.
_P;

$para['command::contact_group'] = <<<_P
Grupp: %s
Meddelande:

%s


--
SiteBarinstallation på %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Vill du verkligen ta bort ditt konto?</h3>
Det finns inget sätt att ångra sig!<p>
Alla dina kvarvarande träd kommer att överlåtas till systemadministratören.
_P;

$para['command::email_link_href'] = <<<_P
<p>Sänd epost via ditt <a href='mailto:?subject=Webbsida: %s&body=Jag har hittat en webbsida som jag tror du kan vara intresserad av.
 Kolla in: %s
 --
 Skickat via %s driven av bookmarkservern SiteBar (http://sitebar.org/)
'>standardepostprogram</a>
_P;

$para['command::email_link'] = <<<_P
Jag har hittat en hemsida du kan vara intresserad av.
Kolla in denna:

    "%s" %s

%s

--
Skickat via %s driven av bomärkesservern SiteBar (http://sitebar.org/)
_P;

$para['command::verify_email'] = <<<_P
Du har begärt epostverifiering. Var god klicka på följande länk för att verifiera din epostadress:
%s
_P;

$para['command::verify_email_must'] = <<<_P
Du har registrerat ett SiteBar-konto på en SiteBar-installation som kräver epostbekräftelse före du kan använda SiteBar.

Var god klicka på följande länk för att bekräfta din epostadress:
  %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer kan importera/exportera bokmärken i Netscape Bookmark format. De måste dock vara i standard Windows teckenuppsättning, UTF-8 kommer inte att fungera.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer kan exportera bokmärken i Netscape Bookmark filformat från menyn "Arkiv/Importera och exportera...".
Den exporterade filen är i sitt ursprungliga format Windowskodat - var god välj teckenuppsättningskod när du importerar filen, standard UTF-8 kommer inte att fungera.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Codepagekonvertering är inte installerat på denna SiteBar-server. Endast utf-8 och iso-8859-1 stöds.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rättigheter:
<strong>L</strong>äs,
<strong>A</strong>ddera,
<strong>M</strong>odifiera,
<strong>T</strong>a Bort,
<strong>R</strong>ensa,
<strong>B</strong>evilja
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vill du verkligen ta bort alla faviconer från cachen?</h3>
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL utan / på slutet pekande på denna installation.
_P;

$para['command::tooltip_default_domain'] = <<<_P
När domänen är satt behöver inte användare, som använder sin epostadress vid login, ange denna.
_P;

$para['command::tooltip_respect'] = <<<_P
Skicka epost endast om användaren tillåtit det.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Skicka epost enbart till konfirmerade epostadresser.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Tillåt att administratören kontaktas av anonyma användare.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Om ej tillåtet, tillåts användarna bara använda den sökmotor som angetts i detta formulär.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Tillåt besökare att komma åt registreringsformuläret för att registrera sig till SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Visa kommandon för import och export av länkbeskrivning.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Möjliggör SiteBar-läge för enanvändarinstallation.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Tillåt användare att skapa ytterligare träd.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Tillåt användare att ta bort deras existerande träd.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Tillåt användare att skapa deras egna grupper. Annars har bara administratörerna denna möjlighet.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Använd konverteringsmotorn (vanligtvis tillägg till PHP) för att konvertera sidor med olika teckenkodning - viktigt för import och export av bokmärken. Kan medföra blanka sidor i vissa implementationer.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Sidor byggda av SiteBar kan komprimeras för att spara bandbredd. Komprimering används endast om det stöds på webbläsarsidan.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Om denna PHP-installation tillåter att epostfunktionen används kan epostfunktioner slås på.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Vissa funktioner (favicon cache) kräver access till andra adresser från din server.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Användare måste godkännas av en administratör innan de kan använda SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Användare måste konfirmera sin epostadress innan de kan använda SiteBar.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Visa logotypen upptill - bör vara avslaget för SiteBar-installationer på långsamma webbhotell, kan annars användas för reklam.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Visa statisk statistik och prestandastatistik på SiteBars huvudpanel.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Möjliggör direkt bokmärkesnedladdning eller matning för anonyma användare. Kan förbigås om användaren vet hur han ska konstruera URLen!
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Favicon-ikoner kommer laddas ner av servern till databas-cachen och vid klientförfrågningar som sänts. Ökar trafiken och snabbar upp favicon-cachen genom att reducera antalet inkopplade servrar.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
FIFO-stack. De äldsta ikonerna kommer att kastas bort från systemet - används för att kontrollera storleken på cachen.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maximalt tillåten storlek på ikoner i bytes.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Hur länge en favicon behålls i cachen innan den uppdateras från servern.
_P;

$para['command::tooltip_verified'] = <<<_P
Markera denna för att konfirmera epostadressen.
_P;

$para['command::tooltip_demo'] = <<<_P
Gör detta konto till ett demokonto med begränsad funktionalitet och utan möjlighet att ändra lösenord.
_P;

$para['command::tooltip_approved'] = <<<_P
Kontot är godkänt och kan användas fullt ut.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Mappar föregår länkar i SiteBar-trädet och vice versa.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Tillåt moderatorer att lägga till mig i deras grupper.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Tillåt administratörer och moderatorer av den grupp jag tillhör att sända mig information via epost.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Hämta favicon automatiskt när den saknas och en länk läggs till.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Dekorera mappar med säkerhetsspecifikation.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Exekvera kommandon genom ett externt fönster - utan omladdning för varje kommando.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Göm tjänster som behöver XSLT-webbläsarsupport.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Laddar endast innehåll i öppna mappar.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Privata länkar kommer endast att laddas om SiteBar används över en SSL-uppkoppling.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Rotmappen kommer inte visas om möjligt.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Vissa webbläsare/plattformar hanterar inte högerklick. Detta val visar en ikon som istället kan användas för att visa innehållsmeny via vänsterklick.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Visa inte kommandoexekveringsstatus om allt går bra.
_P;

$para['command::tooltip_show_public'] = <<<_P
Visa bokmärken publicerade av andra användare.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Användande av faviconer gör SiteBar snyggare men långsammare. När favicon-cachen används av denna installation kommer visning av faviconer bli mycket snabbare.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Tillåt kommando för att gömma mappar. Gömmande av mappar används för mappar publicerade av andra användare.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Visa SiteBar verktygstips i stället för webbläsarens inbyggda. Tillåter längre tips och support för fler webbläsare.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Markera borttagna mappar och länkar så de kan tas tillbaka eller rensas bort.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Tillåt sökningar att omdirigeras till eller utökas med resultat från din favoritwebbsökmotor.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Resultaten från din webbsökmotor kommer att inkluderas i SiteBars sökresultatsida genom en inbäddad frame (iframe).
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Tillåt användare att lägga till sig själva i gruppen.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Tillåt gruppmoderatorer att kontaktas av icke medlemmar.
_P;

$para['command::tooltip_publish'] = <<<_P
Publicera denna mapp så att alla kan se den.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Ta endast bort innehållet i mappen, ej själva mappen.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Låt operationen ske på innehållet i mappen och inte på själva mappen.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Nästa gång du använder bookmarklet kommer denna mapp sättas som standard.
_P;

$para['command::tooltip_private'] = <<<_P
Markera länk som privat. Endast trädägaren kan se en sådan länk, även när mappen är publicerad.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Kontrollera inte denna länk - används för intranätlänkar eller för länkar som har problem med validering.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Denna länk klarade inte kontrollen. Du kanske ändå vill behålla den som aktiv.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Kontrollera denna mapp rekursivt med alla undermappar.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Testa inte länkar som nyligen har testats - används för upprepad kontroll när föregående kontroll inte avslutades.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Försök analysera sidan och finna faviconer (genvägsikoner) som saknas.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Ta bort favicon-URLen från länken om faviconen är ogiltig - används med försiktighet.
_P;

$para['command::tooltip_rename'] = <<<_P
Byt namn på länkar som är duplikat vid import för att ladda alla länkar.
_P;

$para['command::tooltip_hits'] = <<<_P
Dirigera alla klick på länkar genom SiteBar-servern för att generera användarstatistik.
_P;

$para['command::tooltip_subdir'] = <<<_P
Exportera alla länkar och mappar rekursivt.
_P;

$para['command::tooltip_flat'] = <<<_P
Exportera länkarna som om dom var i en enda mapp.
_P;

$para['command::tooltip_cmd'] = <<<_P
Lägg till de viktigaste SiteBar-kommandona för att möjliggöra enkel login till SiteBar.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Denna SiteBar-installation kräver epostbekräftelse. Var god bekräfta din epostadress. I annat fall kan ditt konto komma att tas bort.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Din epostadress matchar regler för automatiskt deltagande i följande stängda
grupp(er):
    %s.

För att godkänna ditt medlemsskap måste din epostadress verifieras. Var god
klicka på följande länk för att verifiera den:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Användare "%s" <%s> registrerade sig nyligen på din SiteBarinstallation vid %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Användare "%s" <%s> registrerade sig på din SiteBar-installation på %s.
Användaren har redan bekräftat sin epostadress.
_P;

$para['usermanager::signup_approval'] = <<<_P
Användare "%s" <%s> registrerade sig på din SiteBar-installation på %s.

Godkänn konto:
  %s

Avslå konto:
  %s

Se avvaktande användare:
  %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Användare "%s" <%s> registrerade sig på din SiteBar-installation på %s.
Användaren har redan bekräftat sin epostadress.

Godkänn konto:
  %s

Avslå konto:
  %s

Se avvaktande användare:
  %s
_P;

$para['hook::statistics'] = <<<_P
Rötter: {roots_total}.
Mappar: {nodes_shown}/{nodes_total}.
Länkar: {links_shown}/{links_total}. 
Användare: {users}. 
Grupper: {groups}. 
SQL-förfrågningar: {queries}. 
Databastid/Total tid: {time_db}/{time_total} sekunder ({time_pct}%).

_P;

?>
