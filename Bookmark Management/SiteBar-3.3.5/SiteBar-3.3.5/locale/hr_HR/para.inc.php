<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Dobrodošli na stranicu za integriranje SiteBara. Ova će vam stranica
pomoći da u potpunosti iskoristite SiteBar. Više informacija o mogućnostima
SiteBara možete naći <a href="http://sitebar.org/">ovdje</a>.
_P;

$para['integrator::header'] = <<<_P
SiteBar je dizajniran imajući u vidu poštivanje standarda i trebao bi
raditi sa većinom browsera s uključenom podrškom za javascript i cookie.
Sljedeća tablica prikazuje na kojim je sve browserima SiteBar testiran.
_P;

$para['integrator::usage_opera'] = <<<_P
Za otvaranje kontekstnih izbornika na linkovima i folderima koristi se
ctrl+shift+klik, ili se u opcijama uključi prikazivanje ikone izbornika.
Opera ne podržava <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
Preporučeno je da se u korisničkim postavkama isključe opcije vezane za XSLT.
_P;

$para['integrator::hint'] = <<<_P
Kliknite na naziv browsera za prikaz mogućnosti integracije.
_P;

$para['integrator::hint_window'] = <<<_P
Ovo je obični link koji će otvoriti SiteBar u postojećem prozoru.
SiteBar je dizajniran za okomiti prikaz tako da se ovim načinom
gubi dosta na prostoru.
_P;

$para['integrator::hint_dir'] = <<<_P
SiteBar je moguće prikazivati i na tradicionalni način; kao direktorije.
Ovaj pogled prikazuje jedan po jedan direktorij i detalje o linkovima.
Browser mora podržavati <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a>.
_P;

$para['integrator::hint_popup'] = <<<_P
Ovaj bookmarklet* služi za otvaranje SiteBara u pop-up prozoru.
Imajte u vidu da neki browseri mogu blokirati pop-up prozore.
_P;

$para['integrator::hint_addpage'] = <<<_P
S ovim bookmarkletom* dodajete linkove u SiteBar. Prilikom aktiviranja, otvara se
novi pop-up prozor u kojemu se nalaze već ispunjeni detalji o odabranoj stranici.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> je bookmark/favorites stavka
koja sadrži JavaScript kod. Desnim klikom možete ga dodati u svoj bookmark/favorites toolbar i
pokretati ga odande. Prilikom pokretanja aktivira se JavaScript kod.
_P;

$para['integrator::hint_search_engine'] = <<<_P
Dodaje mogućnost pretraživanja SiteBar linkova u Web Search polje. Omogućuje pretraživanje
linkova bez otvorenog SiteBara.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Ekstenzija razvijena specijalno za SiteBar.
Omogućuje otvaranje svih linkova iz jednog foldera u tabovima itd.
Za postavljanje SiteBar ikona na toolbar koristite izbornik
View/Toolbar/Customize. [<a href="http://sitebarsidebar.mozdev.org/">Project page</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Kreiranje linka koji se kasnije koristi za otvaranje SiteBara u sidebar panelu.
_P;

$para['integrator::hint_booksync'] = <<<_P
Download Bookmark Synchronizer ekstenzije. Ponovo pokrenite Firefox, otvorite Extension manager
i u opcijama podesite remote file settings protocol na <strong>HTTP</strong>, host na <strong>%s</strong>
i path na <strong>%s</strong>. U ovom trenutku radi samo SiteBar->Firefox sinkronizacija.
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Izvezite strukturu foldera cijelog SiteBara u dokument. Uvezite taj dokument u vaše bookmarke.
Svaki folder će biti prezentiran kao Live Bookmark. Na ovaj će način linkovi iz SiteBara biti
integrirani među ostalim bookmarkima, ali sadržaj foldera će ostati online; odnosno uvezen iz
SiteBara. U slučaju da folder sadrži subfoldere, sadržaj aktualnog foldera bit će prikazan u
@Content folderu.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Preuzmite i instalirajte <a href="http://sourceforge.net/projects/mozlinker/">MozLinker</a> ekstenziju
(pažnja - nije ju moguće deinstalirati). U browseru će se pojaviti novi izbornik "MozLinker".
Odite na "Config..." podizbornik i dodajte ili novi izbornik ili novi toolbar. Kao Resource URL
koristite URL iz "MozLinker Extension" linka na lijevoj strani.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Dodaje SiteBar u sidebar panel. Panel se može prikazati/sakriti pritiskom
na tipku F9. U slučaju da učitavanje SiteBara u sidebar panelu traje duže
od određenog vremenskog ograničenja, Mozilla ga neće moći prikazati. U tom
slučaju preporučuje se prvo otvoriti SiteBar u glavnom prozoru kako bi se 
učitale sve slike ili isključiti prikaz favicona u "Korisničkim postavkama".
_P;

$para['integrator::hint_hotlist'] = <<<_P
Dodavanje linka za otvaranje SiteBara u Hotlist panel. Klikom na link otvara se SiteBar u Operinom sidebaru.
_P;

$para['integrator::hint_install'] = <<<_P
Instaliranje SiteBara u Explorer Bar i kontekstni izbornik - zahtjeva promjenu Windows
registrya i restart sistema za aktiviranje svih opcija. Ovisno o vašim pravima moguće je
da budu instalirane samo neke opcije.
<br>
Nakon instalacije otvorite SiteBar Explorer Bar preko izbornika View/Explorer Bar ili
iskoristite mogućnost prilagođavanja toolbara za dodavanje dugmeta, koji otvara SiteBar
Explorer Bar, na toolbar. Dodavanje stranice u SiteBar sada možete obaviti desnim klikom
iznad linka ili bilo gdje na stranici.
_P;

$para['integrator::hint_uninstall'] = <<<_P
Deinstalira Explorer Bar (pogledajte gore).
_P;

$para['integrator::hint_searchbar'] = <<<_P
Korištenje ovog bookmarkleta* preporučuje se u slučaju kada korisnik nema dovoljno
prava za instalaciju SiteBara u Explorer Bar. Klikom na njega SiteBar se privremeno
otvara u Search Explorer Baru vašeg browsera.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Download plugina (s predefiniranim URL-om). Arhiva se mora dekompresirati u "C:\Program Files\Maxthon\Plugin"
folder. Nakon restarta novi bit će dodana nova Explorer Bar stavka.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Download plugina (s predefiniranim URL-om). Arhiva se mora dekompresirati u "C:\Program Files\Maxthon\Plugin"
folder. Nakon restarta nova ikona bit će dodana na Plugin toolbar. Ovom ikonom dodavati stranice u SiteBar.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Izvršite komandu <strong>emerge sitebar</strong> za instaliranje SiteBar paketa.
_P;

$para['integrator::hint_debian'] = <<<_P
Izvršite komandu <strong>apt-get install sitebar</strong> za instaliranje SiteBar paketa.
_P;

$para['integrator::hint_phplm'] = <<<_P
PHP Layers Menu je hijerarhijski sustav izbornika za izradu DHTML izbornika "u letu".
Baziran je na PHP-u. SiteBar je u mogućnosti posluživati bookmark feed odgovarajuće
strukture. U slučaju da je omogućena naredba fopen za udaljene dokumente, sljedeći će
kod učitati dokument odgovarajuće strukture:
<tt>
LayersMenu::setMenuStructureFile('%s')
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> i <a href='http://sitebar.org/team.php'>SiteBar tim</a>.
Podrška: <a href='http://sitebar.org/forum.php'>forum</a> i <a href='http://sitebar.org/bugs.php'>bug</a> tracking.
_P;

$para['command::welcome'] = <<<_P
%s, dobrodošli u SiteBar!
%s
<p>
SiteBarom se upravlja preko konteksnih izbornika koristeći desni klik na folder ili link.
Ako vaš browser ne podržava desni klik, možete pokušati Ctrl klik ili uključite opciju "Prikazuj ikonu izbornika" u "Korisničkim postavkama" i koristite ikonu.
<p>
Više informacija o SiteBaru možete pročitati u donjem izborniku pod opcijom "Pomoć".
<p>
Već ste ulogirani.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Za korištenje SiteBar funkcija potrebno je imati
ispravnu i proverenu e-mail adresu.
<p>
Ukoliko ste upisali ispravnu e-mail adresu, uskoro ćete
primiti e-mail. Molimo kliknite na link u toj e-mail poruci.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Svi kreirani accounti moraju biti odobreni od strane
administratora prije korištenja SiteBara.
<p>
Molimo pričekajte odobrenje administratora koje će vam
stići e-mailom.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>
Za korištenje SiteBar funkcija potrebno je imati
ispravnu i proverenu e-mail adresu i odobrenje administratora.
<p>
Ukoliko ste upisali ispravnu e-mail adresu, uskoro ćete
primiti e-mail. Molimo kliknite na link u toj e-mail poruci
i pričekajte odobrenje administratora koje će vam
stići e-mailom.
_P;

$para['command::account_approved'] = <<<_P
Administrator je odobrio vaš zahtjev za otvaranjem accounta.
Možete se logirati koristeći %s e-mail adresu.

--
SiteBar instalacija na %s.
_P;

$para['command::account_rejected'] = <<<_P
Administrator je odbio vaš zahtjev za otvaranje accounta
s e-mail adresom %s.

--
SiteBar instalacija na %s.
_P;

$para['command::account_deleted'] = <<<_P
Administrato je obrisao vaš neaktivni korisnički račun
pod e-mail adresom %s.

--
SiteBar instalacija na %s.
_P;

$para['command::reset_password'] = <<<_P
Zatraženo je poništenje lozinke za SiteBar account s "%s" e-mail adresom.

U slučaju da i dalje želite poništiti lozinku za ovaj account, molimo kliknite
na sljedeći link:
    %s

--
SiteBar instalacija na %s.
_P;

$para['command::contact'] = <<<_P
Poruka:

%s


--
SiteBar instalacija na %s.
_P;

$para['command::contact_group'] = <<<_P
Grupa: %s
Poruka:

%s


--
SiteBar instalacija na %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Da li zaista želite obrisati svoj korisnički račun?</h3>
Više neće biti načina da se poništi ova izmjena!<p>
Sva vaša preostala stabla bit će dana administratoru sustava.<br><br>
_P;

$para['command::email_link_href'] = <<<_P
<p>Pošaljite e-mail preko svog zadanog
 <a href='mailto:?subject=Web site: %s&body=Mozda ce te interesirati ovaj web site.
 Pogledaj: %s
 -- 
 Poslano preko SiteBara na %s
 Open Source Bookmark Server http://sitebar.org
'>e-mail programa</a>
_P;

$para['command::email_link'] = <<<_P
Možda će te interesirati ovaj web site.
Pogledaj:

%s
%s

--
Poslano preko SiteBara na %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Zatražili ste potvrdu e-mail adrese koja vam omogućava pristup
grupama s regularnim izrazima za automatska učlanjenja i dozvoljava
vam korištenje SiteBar e-mail mogućnosti.

Kliknite na sljedeći link kako biste potvrdili vašu e-mail adresu:
%s
_P;

$para['command::verify_email_must'] = <<<_P
Potvrda ispravnosti e-mail adrese potrebna je prije prvog korištenja SiteBara.

Kliknite na sljedeći link kako biste potvrdili ispravnost vaše e-mail adrese:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer može uvesti linkove u Netscape Bookmark File formatu preko "File/Import and Export ..." izbornika.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Internet Explorer može izvesti linkove u Netscape Bookmark File format preko "File/Import and Export ..." izbornika.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Konverzija kodne stranice nije instalirana na ovaj SiteBar server.
Podržane su samo UTF-8 i ISO-8859-1 kodne stranice.
<br>
_P;

$para['command::security_legend'] = <<<_P
<div align=left>
Prava:<br>
<strong>R</strong> Čitanje (read),<br>
<strong>A</strong> Dodavanje (add),<br>
<strong>M</strong> Mijenjanje (modify),<br>
<strong>D</strong> Brisanje (delete),<br>
<strong>P</strong> Čišćenje (purge),<br>
<strong>G</strong> Odobravanje (grant)
</div>
_P;

$para['command::purge_cache'] = <<<_P
<h3>Da li zaista želite ukloniti sve favicone iz cachea?</h3>
_P;

$para['command::tooltip_respect'] = <<<_P
Slanje e-maila samo u slučaju da je to korisnik dozvolio.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Slanje e-maila samo na potvrđene adrese.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Dozvoljava kontaktiranje administratora od strane anonimnih korisnika.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Ako nije dozvoljeno, svi korisnici će koristiti tražilicu definiranu na ovoj stranici i neće je moći promijeniti.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Dozvoljava posjetiteljima pristup na formular za prijavu i ragistraciju na SiteBar.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Prikazuje zadatke za uvoz i izvoz opisa linka.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
Omogućava prilagodbu za upotrebu SiteBara od strane samo jednog korisnika.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Dozvoljava korisnicima kreiranje dodatnih stabala.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Dozvoljava brisanje stabala kreiranih od strane korisnika.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Korisnicima je omogućeno kreirati grupe. U drugom slučaju samo administratori imaju ovu privilegiju.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Korištenje sustava za konverziju (obično ekstenzija za PHP) za konvertiranje stranica s različitim encodingom - važno za uvoz i izvoz linkova.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Kompresija se koristi samo ako je podržana od strane browsera.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Uključuje korištenje PHP "mail" funkcije - omogućava korištenje e-mail opcija.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Neke funkcije zahtijevaju pristup vanjskim adresama s vašeg servera.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Korisnici moraju biti odobreni od strane administratora prije korištenja SiteBara.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Korisnici moraju potvrditi svoje e-mail adrese prije korištenja SiteBara.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Prikazivanje loga na vrhu. Može se upotrebljavati za oglašavanje.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Prikaz nekih statistika u glavnom SiteBar prozoru.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Omogućuje izvoz linkova ili feedova od strane anonimnih korisnika.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Favicone će biti downloadane sa servera u privremeni spremnik (cache) baze podataka.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
Ako je veličina privremenog spremnika (cachea) veća od ovdje upisane, najstarije ikone bit će izbačene iz sistema.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Upisati maksimalnu dozvoljenu veličinu ikona u byteima.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Koliko dugo ikone ostaju u cacheu prije nego se osvježe s vanjskog servera.
_P;

$para['command::tooltip_verified'] = <<<_P
Ako je označeno, e-mail adresa će se voditi kao potvrđena.
_P;

$para['command::tooltip_demo'] = <<<_P
Account sa ograničenom funkcionalnošću i bez mogućnosti promjene lozinke.
_P;

$para['command::tooltip_approved'] = <<<_P
Account je odobren i dozvoljeno je korištenje svih funkcija.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Pikazivanje foldera prije linkova ili obratno.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Dozvoljava moderatorima da vas učlanjuju u njihove grupe.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Dozvoljava administratorima i moderatorima grupe kojoj pripadate da vam šalju info e-mailove.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Automatsko dohvaćanje favicone u slučaju da nedostaje i prilikom dodavanja linka.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Posebno označavanje foldere sa sigurnosnim postavkama.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Pokreće zadatke koristeći vanjski pop-up prozor - bez ponovnog učitavanja nakon svakog zadatka.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Sakriva opcije koje zahtijevaju rad s browserom koji podržava XSLT.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Učitavanje sadržaj samo otvorenih foldera.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Privatni linkovi će se učitavati samo u slučaju da je SiteBar korišten preko sigurne SSL konekcije.
_P;

$para['command::tooltip_exclude_root'] = <<<_P
Ukoliko je to moguće, root folder neće biti uključen.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Neki browseri ili operativni sustavi ne omogućavaju desni klik. Ovom opcijom, pokraj svakog foldera ili linka, prikazuje se ikona kojom se otvara kontektsni izbornik.
_P;

$para['command::tooltip_auto_close'] = <<<_P
U slučaju da je zadatak izvršen bez greške, status izvršenja zadaka se posebno ne prikazuje.
_P;

$para['command::tooltip_show_public'] = <<<_P
Prikazivanje linkova objavljenih od strane drugih korisnika.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Korištenje favicona uljepšava ali i usporava SiteBar. Puno brži rad omogućit će upotreba privremenog spremnika (cachea) za favicone.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Dozvoljava izvršavanje zadatka za sakrivanje foldera.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Korištenje SiteBar tooltipsa umjesto onih ugrađenih u browser. Omogućava duži tekst i podršku za više browsera.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Označavanje obrisanih foldera i linkova kako bi se mogli vratiti ili zauvijek očistiti.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Omogućava redirekciju ili dopunjavanje internih rezultata pretrage rezultatima odabrane web tražilice.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Rezultati vaše web pretrage bit će prikazani u istom prozoru pomoću inline framea.
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Omogućava korisnicima da sami sebe dodaju u ovu grupu.
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Dozvoljava korisnicima da mogu kontaktirati moderatore bez obzira što nisu korisnici njihove grupe.
_P;

$para['command::tooltip_publish'] = <<<_P
Objavljuje folder tako da je vidljiv svima.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Briše samo sadržaj foldera, ali ne i folder.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Operacija se odnosi samo na sadržaj foldera, ne i na folder.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Prilikom sljedećeg korištenja ovog bookmarkleta, odabrani folder će biti automatski upisan.
_P;

$para['command::tooltip_private'] = <<<_P
Označava link kao privatni. Privatne linkove može vidjeti samo vlasnik stabla čak i ako je folder objavljen.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Ne provjeravaj ovaj link - koristi se kod intranet linkova ili linkova koji imaju problema sa provjerom.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Označava link kao aktivni, iako nije prošao provjeru.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Provjera foldera zajedno sa svim subfolderima.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Linkovi koji su nedavno bili testirani bit će isključeni iz provjere.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Pokušava analizirati stranicu i pronaći favicone koje nedostaju.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Briše adresu favicone, ako je favicona neispravna - upotrebljavati s oprezom.
_P;

$para['command::tooltip_rename'] = <<<_P
Preimenovanje linkova s istim nazivom prilikom uvoza.
_P;

$para['command::tooltip_hits'] = <<<_P
Usmjeravanje svih klikova na linkove preko SiteBar servera tako da se može pratiti statistika posjeta.
_P;

$para['command::tooltip_subdir'] = <<<_P
Izvoz svih linkova i svih foldera.
_P;

$para['command::tooltip_flat'] = <<<_P
Izvoz linkova kao da su svi u jednom folderu.
_P;

$para['command::tooltip_cmd'] = <<<_P
Dodaje najvažnije SiteBar zadatke koji omogućuju laganu prijavu na SiteBar.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Ova SiteBar instalacija zahtijeva potvrđivanje e-mail adrese.
Molimo potvrdite svoj e-mail, inače će vaš račun biti obrisan.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Vaša e-mail adresa odgovara pravilima za automatsko pristupanje na 
sljedeću grupu/grupe:
    %s.

Da bismo dozvolili vaše članstvo, vaša e-mail adresa mora
biti potvrđena. Kliknite na sljedeći link za potvrdu iste.
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Korisnik "%s" <%s> prijavio se
na tvoju SiteBar instalaciju na %s.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Korisnik "%s" <%s> se prijavio na tvoju SiteBar instalaciju na %s.
Korisnik je već potvrdio svoju e-mail adresu.
_P;

$para['usermanager::signup_approval'] = <<<_P
Korisnik "%s" <%s> se prijavio na tvoju SiteBar instalaciju na %s.

Odobri account:
    %s

Odbij account:
    %s

Pogledaj korisnike na čekanju:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Korisnik "%s" <%s> se prijavio na tvoju SiteBar instalaciju na %s.
Korisnik je već potvrdio svoju e-mail adresu.

Odobri account:
    %s

Odbij account:
    %s

Pogledaj korisnike na čekanju:
    %s
_P;

$para['hook::statistics'] = <<<_P
<div style="padding: 5px;">
<b>Statistika:</b><br>
- Stabala: {roots_total}<br>
- Foldera: {nodes_shown} / {nodes_total}<br>
- Linkova: {links_shown} / {links_total}<br>
- Korisnika: {users}<br>
- Grupa: {groups}<br>
- SQL upita: {queries}<br>
- Vrijeme: {time_db}/{time_total} sek ({time_pct}%)
</div>
_P;

?>
