<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Vítejte na integrační stránce SiteBar serveru. Tato stránka vám pomůže využít maximálně všech možností SiteBaru. O tom co SiteBar je se můžete dočíst na <a href="http://sitebar.org/">SiteBar homepage</a>.
_P;

$para['integrator::header'] = <<<_P
SiteBar je vyvíjen v souladu se standardy a funguje s většinou prohlížečů se zapnutým javascriptem a cookies. Následující tabulka ukazuje, ve kterých prohlížečích byl testován.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar používá klik pravým tlačítkem k vyvolání kontextových menu pro operace s odkazy a složkami. Uživatelé Opery musí místo toho zapnout zobrazení menu ikony v "Nastavení" a použít tuto ikonu místo pravého tlačítka myši. Opera nepodporuje <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>. Z tohoto důvodu je uživatelům Opery doporučeno vypnout přístup k XSLT vlastnostem v "Nastavení".
_P;

$para['integrator::hint'] = <<<_P
Klikněte na jméno vybraného prohlížeče pro zobrazení návodu pro integraci SiteBaru. Prosíme <a href="http://brablc.com/mailto?o">o sdělení</a> dalších ověřených prohlížečů/platforem.
_P;

$para['integrator::hint_window'] = <<<_P
Toto je bežný odkaz, který otevře SiteBar v aktuálním okně. SiteBar je ovšem navržen pro vertikální úzký pruh. Tento způsob tedy plýtvá místem.
_P;

$para['integrator::hint_dir'] = <<<_P
Kromě možnosti zobrazení v podobě stromu, umožňuje SiteBar zobrazení tradičního adresáře. Tento náhled ukazuje v jednom okamžiku pouze jeden adresář a zobrazuje podrobnosti odkazů. Podpora <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a> ze strany prohlížeče je vyžadována.
_P;

$para['integrator::hint_popup'] = <<<_P
Pokud váš prohlížeč nepodporuje postranní lištu (sidebar), použijte bookmarklet*. Ten otevře SiteBar v novém vyskakovacím okně podobném postranní liště. Prosím věnujte pozornost tomu, že váš prohlížeč může blokovat tato okna.
_P;

$para['integrator::hint_addpage'] = <<<_P
Tento bookmarklet* může být použit pro přidávání odkazů do SiteBaru. Při jeho spuštění dojde k otevření nového vyskakovacího okna s předvyplněnými údaji o právě prohlížené stránce.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> je záložka/oblíbený odkaz který obsahuje JavaScript kód. Můžete na něj kliknout pravým tlačítkem a přidat jej do své lišty oblíbených záložek. Následným klikem na takovýto odkaz dojde ke spuštění JavaScript kódu.
_P;

$para['integrator::hint_search_engine'] = <<<_P
Přidává vyhkledýváni v SiteBar záložkách do Web Search políčka. Umožňuje prohledávání SiteBar záložek bez nutnosti otevírání SiteBaru.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Rozšíření vyvinuté speciálně pro SiteBar. Umožňuje otevřít všechny odkazy z jedné složky v tabech (záložkách prohlížeče) a další funkce. Použijte menu View/Toolbar/Customize pro umístění ikony SiteBaru na vaši lištu nástrojů. [<a href="http://sitebarsidebar.mozdev.org/">Stránka projektu</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Vytváří záložku, na kterou lze posléze kliknout a tím otevřít SiteBar v postranní liště.
_P;

$para['integrator::hint_booksync'] = <<<_P
Stáhněte si rozšíření Bookmark Synchronizer. Restartujte prohlížeč, otevřete Extension manager a v nastavení nastavte v remote file settings protokol <strong>HTTP</strong>, host <strong>%s</strong> a path <strong>%s</strong>. V tomto okamžiku je možné synchronizovat pouze ve směru SiteBar->Firefox.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Stáhněte celou adresářovou strukturu SiteBaru do souboru. Naimportujte tento soubor mezi své odkazy. Každá složka je reprezentována živým odkazem (Live Bookmark). Tímto způsobem budou vaše odkazy integrované mezi ostatní odkazy, ale obsah složek bude stahován online ze SiteBaru. V případě, že složka má podsložky, obsah aktuální složky bude umístěn do složky s názvem @Content.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Stáhněte a nainstalujte <a href="http://sourceforge.net/projects/mozlinker/">rozšížení</a> (pozor není možné jej odinstalovat). V menu se objeví nová položka "MozLinker". Použijtr "Config..." submenu a přidejte buď nové menu nebo nástrojovou lištu. Jako "Resource URL" použijte URL z "MozLinker Extension" na levé straně.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Přidá SiteBar do postranního panelu. Tento panel může být schován/zobrazen pomocí F9. V případě, že doba natahování SiteBar překročí interní časový limit, Mozilla nezobrazí panel vůbec. Je doporučené otevřít SiteBar v hlavním okně aby se zobrazené obrázky (favicons) uložily do vyrovnávací paměti prohlížeče nebo přímo vypnout zobrazení ikon odkazů v "Nastavení".
_P;

$para['integrator::hint_hotlist'] = <<<_P
Odkaz na SiteBar buze zobrazen v Hotlist panelu. Kliknutím na něj se SiteBat otevře v postranní liště Opery.
_P;

$para['integrator::hint_install'] = <<<_P
Nainstaluje SiteBar do "panelu aplikace explorer" a do kontextového menu. Vyžaduje změnu registrů a restart systému pro plnou funkčnost. Podle rozsahu práv uživatele je možné, že pouze některé vlastnosti budou nainstalované.
<br>
SiteBar lze otevřít z panelů aplikace explorer v menu Zobrazit nebo jej pomocí funkce pro úpravu panelů přidat mezi ostatní tlačítka. Pravým kliknutím kdekoliv na stránce nebo na na odkazu lze vyvolat kontextové menu a z něj přidat stránku či odkaz do SiteBaru.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Odinstalovat z panelů aplikace explorer (viz výše).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Použití bookmarkletu* je doporučené v případě, že uživatel nemá dostatek privilegií pro instalaci do "panelu aplikace explorer". Zobrazí SiteBar dočasně ve vyhledávacím panelu vašeho prohlížeče.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Stáhněte plugin s (s přednastaveným URL). Archív musí být rozbalen do složky "C:Program FilesMaxthonPlugin". Po restartu bude přidán nová položka panelu aplikace explorer.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Stáhněte plugin s (s přednastaveným URL). Archív musí být rozbalen do složky "C:Program FilesMaxthonPlugin". Po restartu se objeví nový ikona v Plugin nástrojové liště. Pomocí této ikony může být přidán odkaz na stránku v auktuálním tabu do SiteBaru.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Spusťte příkaz <strong>emerge sitebar</strong> k nainstalování SiteBar balíčku.
_P;

$para['integrator::hint_debian'] = <<<_P
Spusťte příkaz <strong>apt-get install sitebar</strong> k nainstalování SiteBar balíčku.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu je systém pro tvorbu hierarchických DHTML menu s přípravou položek menu pomocí PHP jazyka. SiteBar může sloužit jako zdroj dat v požadované struktuře. V případě, že fopen má povoleno otevírat vzdálené soubory, následující kód natáhne strukturu menu v požadovaném formátu: <tt> LayersMenu::setMenuStructureFile('%s') </tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> a <a href='http://sitebar.org/team.php'>SiteBar Team</a>. <a href='http://sitebar.org/forum.php'>Forum</a> podpory a sledování <a href='http://sitebar.org/bugs.php'>chyb</a>.

_P;

$para['command::welcome'] = <<<_P
%s, vítejte v SiteBaru!
%s
<p>
SiteBar se ovládá pomocí kontextových menu, která jsou vyvolána pomocí pravého tlačítka myši nad složkou či odkazem. Pokud vaše platforma/prohlížeč nepodporuje pravé tlačítko myši, můžete zkusit použít kliknutí se stisknutou klávesou Ctrl nebo zapnout "Zobrazit Menu Ikonu" v "Nastavení" a kliknout na tuto ikonu.
<p>
Více informací se dozvíte kliknutím na položku "Nápověda" v menu zobrazeném pod odkazy.
<p>
Přihlášení do systému již proběhlo.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Tato instalace SiteBaru vyžaduje, aby emailová adresa uživatelů byla ověřena před použitím SiteBar funkcí.
<p>
Pokud jste zadali správnou emailovou adresu, tak na ni brzy obdržíte email. Prosím klikněte na odkaz v tomto emailu pro ověření vaší adresy.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Tato instalace SiteBaru vyžaduje, aby vytvořený účet byl schválen administrátorem před použitím SiteBar funkcí.
<p>
Prosím vyčkejte schválení administrátorem - budete informování emailem.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Tato instalace SiteBaru vyžaduje, aby emailová adresa uživatelů byla ověřena a vytvořený účet schválen administrátorem před použitím SiteBar funkcí.
<p>
Pokud jste zadali správnou emailovou adresu, tak na ni brzy obdržíte email. Prosím klikněte na odkaz v tomto emailu pro ověření vaší adresy a vyčkejte schválení administrátorem - budete informování emailem.
_P;

$para['command::account_approved'] = <<<_P
Administrátor schválil vaši žádost o účet.
Můžete se přihlásit emailem %s.

--
SiteBar instalace na adrese %s.
_P;

$para['command::account_rejected'] = <<<_P
Administrátor zamítnul vaši žádost o účet pod 
emailem %s.

--
SiteBar instalace na adrese %s.
_P;

$para['command::account_deleted'] = <<<_P
Administrátor smazal váš neaktivní účet pod 
emailem %s.

--
SiteBar instalace na adrese %s.
_P;

$para['command::reset_password'] = <<<_P
Změna zapomenutého hesla  v SiteBaru byla vyžádána pro účet "%s".

V případě, že skutečně vyžadujete tuto změnu, klikněte prosím
na následující odkaz:
   %s

--
SiteBar instalace na adrese %s.
_P;

$para['command::contact'] = <<<_P
%s


--
SiteBar instalace na adrese %s.
_P;

$para['command::contact_group'] = <<<_P
Skupina: %s

%s


--
SiteBar instalace na adrese %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Skutečně smazat účet?</h3>

Neexistuje možnost jeho obnovení!<p>
Všechny nesmazané stromy budou převedeny na administrátora.
_P;

$para['command::email_link_href'] = <<<_P
<p>Poslat e-mail lokálním
<a href='mailto:?subject=Webova stranka: %s&body=Tato webova stranka stoji za shlednuti.
 Adresa: %s
 --
 Odeslano z aplikace SiteBar na adrese %s
 Open Source Bookmark Server http://sitebar.org
'>poštovním programem</a>
_P;

$para['command::email_link'] = <<<_P
Tato webova stranka stoji za shlédnutí.
Adresa:

    "%s" %s

%s

--
Odesláno z aplikace SiteBar na adrese %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Bylo vyžádáno ověření e-mailové adresy na kterou byl zaslán tento dopis.
Ověčení umožňuje získání členství v některých skupinách na základě regularního
výrazu. Dále ověření umožňuje uživateli využívat funkce spojené se
zasíláním e-mailů.

Kliknutím na následující odkaz dojde k ověření e-mailové adresy:

    %s
_P;

$para['command::verify_email_must'] = <<<_P
Zažádali jste o účet v SiteBar instalaci, která vyžaduje ověření
emailu před prvním použití SiteBaru.

Prosím klikněte na následující odkaz k ověření vaší e-mailové adresy:
    %s

_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer umožňuje importovat a exportovat odkazy ve Netscape Bookmark File formátu. Nicméně tento soubor musí být v nativním kódování národních Windows. Defaultní formát UTF-8 nebude fungovat správně.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer může exportovat odkazy v Netscape Bookmark File formátu z menu "Soubor/Import a export ...".
Vyexportovaný soubor je v nativním kódovaní Windows - prosím vyberte správnou kódovou stránku při importu tohoto souboru.
Defaultní kódová stránka UTF-8 nebude pracovat správně.
_P;

$para['command::noiconv'] = <<<_P
<br>
Konverze znakových stránek mimo utf-8 a iso-8859-1 není na této instalaci SiteBaru dostupná.
<br>
_P;

$para['command::security_legend'] = <<<_P
Práva:
<strong>Č</strong>íst,
<strong>P</strong>řidat,
<strong>Z</strong>měnit,
<strong>S</strong>mazat,
<strong>V</strong>ysypat,
<strong>G</strong>arantovat
_P;

$para['command::purge_cache'] = <<<_P
<h3>Skutečně vymazat mezipaměť ikon odkazů?</h3>
_P;

$para['command::tooltip_baseurl'] = <<<_P
URL adresa této instalace bez koncového /.
_P;

$para['command::tooltip_default_domain'] = <<<_P
Pokud je doména nastavena, nemusí uživatelé používající email jako přihlašovací jméno tuto doménu uvádět.
_P;

$para['command::tooltip_respect'] = <<<_P
Poslat email pouze pokud je uživatelem povoleno.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Poslat email pouze na ověřené adresy.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Povilit anonymním uživatelům kontaktovat aministrátora.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Pokud není povoleno, tak uživatelé nebudou mocí nastavit svůj vlastní vyhledávač a budou používat vyhledávač nastavený zde.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Povolit návštěvníkům přistup k přihlašovacímu formuláři a k registraci v SiteBaru.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Zobrazit příkazy pro import a export popisu odkazu.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Zapnout SiteBar v módu určeném pro použití jednotlivci.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Povolit uživatelům vytváření dalších stromů.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Povolit uživatelům mazání existujících vlastních stromů.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Uživatelé mohou vytvářet vlastní skupiny. V opačném případě má toto privilegium pouze administrátor.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Používat konverzní modul (obvykle rozšíření PHP) ke konverzi stránek s různým kódováním - důležité pro import a export odkazů. Může způsobit prazdnou obrazovku na některých implementacích.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Stránky generované SiteBarem mohou být kompresované pro ušetření přenosového pásma. Komprese je použitá pouze v případě, kdy je podporovaná prohlížečem.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
V případě, že tato PHP instalace umožňuje použít funkci "mail" - lze povolit vlastnosti používající odesílání emailu.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Některé funkce (mezipaměť ikon odkazů) vyžadují přístup ke vzdáleným adresám z tohoto serveru.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Uživatelé musí být schválení adminstrátorem předtím, než mohou použít SiteBar.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Uživatelé musí ověřit svůj email předtím, než mohou použít SiteBar.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Zobrazit logo na horní straně SiteBaru - mělo by být zakázáno pro pomalé hostingy. V opačném případě lze použít pro reklamu.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Zobrazit statické a výkonnostní statistiky na hlavním SiteBar panelu.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Povolit přímý download nebo feed odkazů pro anonymní uživatele. Může být obejito, pokud uživatel ví jak vytvořit správné URL!
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Ikony odkazů budou stáhnuty serverem do databázového meziskladiště a zaslány na žadost klientovi. Zvyšuje objem přenesených dat a zrychluje načátání SiteBaru snížením počtu kontaktovaných serverů.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
První dovnitř první ven. Nejstarší ikony budou vymazány ze systému - používané pro kontrolu velikosti meziskladu ikon.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maxumální povolená velkost ikony v bajtech.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Maximální stráří ikony odkazu v meziskladišti před jejím obnovením ze vzdáleného serveru.
_P;

$para['command::tooltip_verified'] = <<<_P
Zaškrtnutím bude email označen jako ověřený.
_P;

$para['command::tooltip_demo'] = <<<_P
Demo účet má omezenou funkcionalitu a nedovoluje změnu hesla.
_P;

$para['command::tooltip_approved'] = <<<_P
Účet byl schválen a může být plně použit.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Složky nebo odkazy jsou zobrazované první v SiteBar stromu.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Povolit moderátorům mé přidání do jejich skupin.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Povolit administrátorům a moderátorům skupin do kterých patřím zasílání emailů pro mě.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Získat ikonu automaticky pokud není zadaná a odkaz je přidán.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Označit graficky složky se specifikací práv.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Vykonávat příkazy v externím okně - bez obnovování po každém příkazu.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Skryje ty vlastnosti SiteBaru, které vyžadují podporu XSLT na straně prohlížeče.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Natáhne obsah pouze otevřených složek.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Privátní odkazy budou nataženy pouze pokud bude SiteBar použit přes SSL spojení.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Kořenová složka nebude zobrazena ve výstupu - pokud to je možné.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Některé prohlížeče/platformy neumožňují zpracovat stisknutí pravého tlačítka myši.
Tento přepínač zobrazí ikonu která může být použita pro zobrazení kontextového menu.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Nezobrazovat status vykonání příkazu v případě úspěchu.
_P;

$para['command::tooltip_show_public'] = <<<_P
Zobrazit odkazy publikované ostatními uživateli.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Použité ikon odkazů činí SiteBar hezčím a pomalejším. Pokud je použití meziskladiště ikon povolené pro tuto instalaci, zobrazení ikon odkazů bude významně rychlejší.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Povoluje příkaz pro skrytí složky. Skrývání se používá pro publikované složky jiných uživatelů.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Používat SiteBar tipy místo zobrazování tipů browserem. Umožňuje delší tipy a podporu pro více prohlížečů.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Označit smazané složky a odkazy tak, aby je bylo možné obnovit nebo navždy vysypat.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Povolit vyhledávání v SiteBaru bude přesměrováno nebo rozšířeno o výsledky poskytnuné internetovým vyhledávačem.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Výsledky hledání internetového vyhledávače budou zobrazeny spolu s výsledky vyhledávání v SiteBaru.
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Povolit uživatelům přidat se do skupiny.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Povoit moderátorům skupiny být kontaktován nečleny skupiny.
_P;

$para['command::tooltip_publish'] = <<<_P
Zveřejnit složku tak, aby ji mohl vidět kdokoliv.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Smazat pouze obsah složky, místo smazání celé složky.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Aplikovat operaci pouze na obsah složky a ne na složku samotnou.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Při příštím použití tohoto bookmarkletu bude tato složka označena jako defaultní.
_P;

$para['command::tooltip_private'] = <<<_P
Označ odkaz jako soukromý. Pouze vlastník stromu má právo vidět odkaz, i když je složka zveřejněná.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Neověžovat tento odkaz - použít pro intranetové odkazy nebo pro odkazy, které mají problémy s validací.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Tento link neprošel validací. Můžete jej ovšem chtít označit jako aktivní.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Ověřit odkazy v této složce rekurzivně pro všechny podsložky.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Netestovat odkazy, které byly testovány nedávno - používá se pro opakovanou validaci složky, které  nebyla úspěšně dokončena.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Pokusit se o analýzu stánky a vyhledání ikon odkazů které chybějí.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Smazat adresu ikony odkazu pokud je ikona odkazu neplatná - používejte s rozmyslem.
_P;

$para['command::tooltip_rename'] = <<<_P
Při importu přejmenovat duplikátní odkazy tak, aby se naimportovalo cvo nejvíce odkazů.
_P;

$para['command::tooltip_hits'] = <<<_P
Směřovat všechna kliknutí na odkazy přes SiteBar sevrer pro generování statistiky použití.
_P;

$para['command::tooltip_subdir'] = <<<_P
Rekurzivně exportovat všechny odkazy a složky.
_P;

$para['command::tooltip_flat'] = <<<_P
Exportovat odkazy jako kdyby byly v jedné složce.
_P;

$para['command::tooltip_cmd'] = <<<_P
Přidat nejdůležitějsí SiteBar příkazy pro snazší přihlášení do SiteBaru.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Tato instalace SiteBaru vyžaduje ověření emailu. Prosím ověřte svůj email, jinak může Váš účet být smazán.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
E-mailová adresa na kterou přišel tento dopis splňuje pravidla
pro automaticke členství v následujících uzaveřených skupinách:
    %s.

Pro potvrzení členství v těchto (této) skupině je nutné ověřit
e-mailovou adresu. Kliknutím na následující odkaz dojde k ověření
e-mailove adresy:

    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Uživatel "%s" <%s> si vytvořil účet v SiteBar instalaci na adrese %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Uživatel "%s" <%s> si vytvořil účet v SiteBar instalaci na adrese %s.
Uživatel již ověřil svůji emailovou adresu.
_P;

$para['usermanager::signup_approval'] = <<<_P
Uživatel "%s" <%s> zažádal o účet v SiteBar instalaci na adrese %s.

Schválat účet:
  %s

Zamítnout žádost:
  %s

Zobrazit čekající uživatele:
  %s

_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Uživatel "%s" <%s> zažádal o účet v SiteBar instalaci na adrese %s.
Uživatel již ověřil svůji emailovou adresu.

Schválat účet:
  %s

Zamítnout žádost:
  %s

Zobrazit čekající uživatele:
  %s

_P;

$para['hook::statistics'] = <<<_P
Stromů {roots_total}. Složek {nodes_shown}/{nodes_total}. Odkazů {links_shown}/{links_total}. Uživatelů {users}. Skupin {groups}. SQL dotazů {queries}. DB/Celkový čas {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
