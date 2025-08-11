<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Willkommen auf der SiteBar Integrationsseite. Diese Seite hilft Ihnen das meiste aus SiteBar herauszuholen. Auf der <a href="http://sitebar.org/">SiteBar Homepage</a> können Sie mehr über die SiteBar Features lernen.
_P;

$para['integrator::header'] = <<<_P
SiteBar wurde konform zu etablierten Standards entwickelt und sollte in den meisten Browsern mit eingeschaltetem Javascript und Cookies ohne Probleme funktionieren. Die folgende Tabelle zeigt welche Browser getestet wurden. Einfach den eigenen Browser anklicken um spezifische Hinweise für die bessere 
Integration der SiteBar mit dem Browser zu erhalten.
_P;

$para['integrator::usage_opera'] = <<<_P
SiteBar benutzt einen Klick der rechten Maustaste um Kontextmenüs für Verzeichnisse und Links zu öffnen. Als Opera Nutzer müssen Sie die sogenannten "Menü Icons" in den "Benutzereinstellungen" anschalten und auf das Symbol links des Verzeichnis- bzw. des Linkeintrages klicken. Opera unterstützt <a href="http://en.wikipedia.org/wiki/XSLT">XSLT</a> nicht. Es wird empfohlen die Nutzung der XSLT Features in den "Benutzereinstellungen" abzuschalten.
_P;

$para['integrator::hint'] = <<<_P
Klicken Sie oben auf den Namen des Browsers Ihrer Wahl um die Integrationsanweisungen hierfür zu erhalten. Bitte <a href="http://brablc.com/mailto?o">berichten</a> Sie von weiteren erfolgreich getesteten Browsern und Plattformen.
_P;

$para['integrator::hint_window'] = <<<_P
Dies ist ein gewöhnlicher Link der SiteBar im derzeitigen Fenster öffnen wird. SiteBar wurde für ein schmales, senkrechtes Fenster entworfen. Auf diese Art und Weise geht viel wertvoller Platz verloren.
_P;

$para['integrator::hint_dir'] = <<<_P
Abgesehen von der normalen SiteBar-Darstellung als Baum, können die Lesezeichen auch 
als Verzeichnis angezeigt werden. Diese Ansicht zeigt zu jeder Zeit die Lesezeichen 
nur eines Verzeichnisses. Der Browser muss dafür <a href="http://de.wikipedia.org/wiki/XSLT">XSLT</a> unterstützen.
_P;

$para['integrator::hint_popup'] = <<<_P
Falls Ihr Browser keine Seitenleisten unterstützt, können Sie dieses Bookmarklet* verwenden. Das Bookmarklet öffnet SiteBar in einem Popup Fenster ähnlich einer Seitenleiste. Es kann sein, dass Ihr Browser Popup Fenster blockiert!
_P;

$para['integrator::hint_addpage'] = <<<_P
Dieses Bookmarklet* kann dazu benuzt werden Links zu Ihrem SiteBar hinzuzufügen. Beim Klickenb wird ein neues Pop-Up Fenster geöffnet das schon die Details der Seite enthalten wird.
_P;

$para['integrator::hint_bookmarklet'] = <<<_P
* <a href="http://en.wikipedia.org/wiki/Bookmarklet">Bookmarklet</a> ist ein Lesezeichen/Favorit der JavaScript Code enthält. Sie können das Bookmark über einen Klick mit der rechten Maustaste ihren Lesezeichen/Favoriten hinzufügen.
Später wird ein Klick auf das Lesezeichen den JavaScript Befehl ausführen.</i>
_P;

$para['integrator::hint_search_engine'] = <<<_P
Fügt die Suche in den SiteBar Lesezeichen dem Web-Suche-Feld hinzu. Erlaubt die SiteBar Lesezeichen zu durchsuchen, ohne dass Sitebar geöffnet sein muss.
_P;

$para['integrator::hint_sitebar'] = <<<_P
Spezielle Erweiterung für die SiteBar.
Erlaubt das Öffnen aller Lesezeichen eines Verzeichnisses als Tabs
und andere nützliche Features. Um die Funktionen über die Toolbar
verwenden zu können, lassen sich die SiteBar Icons über das Menü 
"View/Toolbar/Customize" zur Toolbar hinzufügen.
[<a href="http://sitebarsidebar.mozdev.org/">Project-Seite</a>]
_P;

$para['integrator::hint_sidebar'] = <<<_P
Erstellt ein Lesezeichen das später angeklickt werden kann um SiteBar in einem Seitenpanel zu öffnen.
_P;

$para['integrator::hint_booksync'] = <<<_P
Die Lesezeichen-Synchronisierung kann verwendet werden um die Lesezeichen des Browsers 
mit der SiteBar-Datenbank abzugleichen. Nachdem das Plugin im FireFox installiert wurde,
müssen im "Extension-Manager" die Optionen für das Plugin folgendermaßen gesetzt werden:
"Protocol" -> "<strong>HTTP</strong>", "Host" -> "<strong>%s</strong>" und "Path" -> "<strong>%s</strong>".
_P;

$para['integrator::hint_livebookmarks'] = <<<_P
Die komplette SiteBar-Verzeichnis-Struktur (nicht die Lesezeichen selbst) kann hier als Datei heruntergeladen werden.
Diese Datei lässt sich dann in den FireFox-Browser laden. Jedes Verzeichnis der SiteBar wird als "LiveBookmark" abgebildet.
Der Inhalt dieser speziellen Verzeichnisse wird automatisch von dem SiteBar-Server geholt, so daß der Inhalt ständig auf
dem neuesten Stand bleibt. Die Lesezeichen von Verzeichnissen mit Unterordnern werden in einem @Content-Ordner angezeigt.
_P;

$para['integrator::hint_mozlinker'] = <<<_P
Mit der <a href="http://sourceforge.net/projects/mozlinker/"><strong>MozLinker</strong></a> Erweiterung läßt sich ebenfalls ein 
dynamisches SiteBar-Menü für den FireFox installieren. Sobald die Erweiterung installiert wurde (<strong>Achtung:</strong> MozLinker kann nicht deinstalliert 
werden!) muss die URL des nebenstehenden Links ("MozLinker Erweiterung") als Ressource in der MozLinker-Konfiguration (Menü: "MozLinker"->"Config...")
eingetragen werden.
_P;

$para['integrator::hint_sidebar_mozilla'] = <<<_P
Fügt die SiteBar in die Sidebar-Leiste des Browsers ein. Die Leiste kann mit F9 angezeigt bzw. versteckt werden. Sollte das Laden der 
SiteBar ein bestimmtes Zeitlimit überschreiten kann der Mozilla-Browser sie nicht anzeigen. Um die SiteBar-Anzeige zu beschleunigen könne
die Icons der Lesezeichen (favicons) in den Browser-Cache geladen werden indem man die SiteBar im Hauptfenster des Browsers öffnet. Alternativ
lassen sich die Icons in den "Benutzereinstellungen" des SiteBar komplett ausstellen.
_P;

$para['integrator::hint_hotlist'] = <<<_P
Eine Verknüpfung zu SiteBar wird im Hotlist Panel gezeigt. Ein Klick hierauf wird SiteBar im Opera Seitenpanel öffnen.
_P;

$para['integrator::hint_install'] = <<<_P
Installiert die SiteBar in die Explorer-Leiste und das Kontext-Menü. Dies erfordert Veränderungen in der Windows-Registry und damit
einen Neustart des Systems. Abhängig von den Benutzer-Rechten auf dem Windows-System können evtl. nicht alle Features installiert werden.
<br>
Die SiteBar-Explorer-Leiste kann über das Menü "Ansicht/Explorer-Leiste" geöffnet werden oder über einen Schalter auf der Toolbar. Dieser kann über die "Benutzerdefiniert..."-Funktion der Toolbar hinzugefügt werden. Lesezeichen können über einen Rechts-Klick auf einen Link zur SiteBar hinzugefügt werden.

_P;

$para['integrator::hint_uninstall'] = <<<_P
Deinstalliert die Explorerleiste (siehe oben)
_P;

$para['integrator::hint_searchbar'] = <<<_P
Die Nutze deses Bookmarklets * wird empfohlen falls der Nutzer nicht berechtigt ist eine Explorerleiste zu installieren. SiteBar wird vorübergehend in die Suchleiste des Browsers.
_P;

$para['integrator::hint_maxthon_sidebar'] = <<<_P
Lädt ein Plugin (mit voreingestellter URL) herunter. Das Archiv muss in das "C:\Program Files\Maxthon\Plugin" Verzeichnis entpackt werden. Nach dem Neustart wird eine neue Explorerleiste angezeigt.
_P;

$para['integrator::hint_maxthon_toolbar'] = <<<_P
Dieser Link lädt ein Plugin mit einer voreingestellten URL. Das Archiv muß in den Ordner "C:\Programme\Maxthon\Plugin" entpackt werden. Nach dem Neustart des Browsers findet sich ein neues Icon auf der Plugin-Toolbar. Dieses Icon ermöglicht es die derzeit angezeigte Seite zur SiteBar hinzuzufügen.
_P;

$para['integrator::hint_gentoo'] = <<<_P
Befehl <strong>emerge sitebar</strong> ausführen um SiteBar zu installieren.
_P;

$para['integrator::hint_debian'] = <<<_P
Befehl <strong>apt-get install sitebar</strong> ausführen um SiteBar zu installieren.
_P;

$para['integrator::hint_phplm'] = <<<_P
Das PHP-Layer-Menü ist ein hierarchisches Menü-Sytem das ein DHTML-Menü für Webseiten bereitstellen kann. SiteBar kann mit
Hilfe dieses PHP-Tools verwendet werden um ein dynamisches Menü in jede beliebige Webseite einzubinden. Wenn die "fopen"-Funktion
bei PHP gestattet ist, dann lädt folgende Zeile das dynamische Menü: 
<tt> 
LayersMenu::setMenuStructureFile('%s') 
</tt>
_P;

$para['integrator::copyright3'] = <<<_P
Copyright � 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> und das <a href='http://sitebar.org/team.php'>SiteBar Team</a>. Hilfe <a href='http://sitebar.org/forum.php'>forum</a> und <a href='http://sitebar.org/bugs.php'>Fehlersuche</a>.
_P;

$para['command::welcome'] = <<<_P
%s, Willkommen bei SiteBar!
%s
<p>
SiteBar wird über Kontextmenüs gesteuert die durch einen Klick mit der rechten Maustaste auf ein Verzeichnis oder einen Link geöffnet werden.
Wenn Ihr Browser/Ihre Plattform keinen rechts-Klick unterstützt, versuchen Sie es mit STRG-Klick oder schalten Sie die Einstellung "Zeige Menü Symbol"  in den "Benutzereinstellungen" an.
<p>
Um weitere Informationen über SiteBar zu erhalten, klicken Sie bitte im Menü unten auf "Hilfe".
<p>
Sie sind schon eingeloggt.
_P;

$para['command::signup_verify'] = <<<_P
<p>
Diese SiteBar Installation setzt voraus, dass Ihre E-Mail Adresse gültig ist und überprüft wurde bevor Sie SiteBar verwenden können.
<p>
Vorausgesetzt Sie haben Ihre E-Mail Adresse korrekt angegeben, sollten Sie in kürze E-Mail erhalten. Bitte klicken Sie auf den Link in der E-Mail.
_P;

$para['command::signup_approve'] = <<<_P
<p>
Diese SiteBar Installation setzt voraus, dass neue Accounts vom Administrator angenommen werden müssen bevor Sie SiteBar verwenden können.
<p>
Bitte erwarten Sie die Freischaltung durch den Administrator - Sie werden hierüber per E-Mail informiert.
_P;

$para['command::signup_verify_approve'] = <<<_P
<p>Diese SiteBar Installation verlangt eine gültige E-Mail Adresse die überprüft und vom Administrator freigeschaltet werden muss bevor Sie die SiteBar Funktionen nutzen können.
<p>Vorausgesetzt Sie haben eine gültige E-Mail Adresse angegeben, werden Sie in kürze eine Email erhalten. Bitte klicken Sie auf den Link in der E-Mail Adresse und warten Sie auf die Freischaltung durch den Administrator. Sie werden hierüber per E-Mail benachrichtigt.
_P;

$para['command::account_approved'] = <<<_P
Der Administrator hat den Account der mit der E-Mail Adresse %s beantragt wurde angenommen.

--
SiteBar Installation auf %s.
_P;

$para['command::account_rejected'] = <<<_P
Der Administrator hat den Account der mit der E-Mail Adresse %s beantragt wurde abgelehnt.

--
SiteBar Installation auf %s.
_P;

$para['command::account_deleted'] = <<<_P
Der Administrator hat Ihr inaktives Konto mit der E-Mail Adresse %s gelöscht.


--
SiteBar Installation auf %s.
_P;

$para['command::reset_password'] = <<<_P
Ein Passwort Reset für den SiteBar Account mit der E-Mail Adresse "%s" wurde verlangt.

Falls Sie wirklich das Passwort für diesen Account zurücksetzten wollen, klicken Sie bitte auf den folgenden Link:
    %s

--
SiteBar Installation auf dem Server %s.
_P;

$para['command::contact'] = <<<_P
Nachricht:

%s

--
SiteBar Installation auf dem Server %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppe: %s
Nachricht:

%s


--
SiteBar Installation auf dem Server %s.

_P;

$para['command::delete_account'] = <<<_P
<h3>Wollen Sie Ihr Konto wirklich löschen?</h3>
Es gibt keine Möglichkeit diesen Schritt rückgängig zu machen!<p>
Alle von Ihnen angelegten Bäume werden dem Administrator des Systems übertragen.
_P;

$para['command::email_link_href'] = <<<_P
<p>E-Mail über lokales Programm versenden
<a href='mailto:?subject=Webseite: %s&body=Ich habe eine neue Webseite gefunden, die interessant
 sein könnte.
 Hier ist der entsprechende Link: %s
 --
 Diese automatische Mail wurde über die SiteBar Installation des Servers %s versendet.
 SiteBar ist ein Open-Source-Lesezeichen-Server (http://sitebar.org)
'>E-Mail Programm</a>
_P;

$para['command::email_link'] = <<<_P
Ich habe eine neue Webseite gefunden, die interessant sein könnte.
Hier ist der entsprechende Link:

    "%s" %s

%s

--
Diese automatische Mail wurde über die SiteBar Installation des Servers %s versendet.
SiteBar ist ein Open-Source-Lesezeichen-Server (http://sitebar.org)
_P;

$para['command::verify_email'] = <<<_P
Diese E-Mail wurde ausgesandt um diese E-mail-Adresse für den
Zugriff auf Auto-Join Gruppen des Sitebar Servers zu ermöglichen.
Nach der Validierung können auch die E-mail-Features des Servers
verwendet werden.

Bitte auf diesen Link klicken um diese E-mail-Adresse zu validieren:
    %s
_P;

$para['command::verify_email_must'] = <<<_P
Sie haben sich für einen SiteBar Account einer SiteBar Installation angemeldet die vor der ersten Nutzung eine Verifikation der E-Mail Adresse benötigt.

Bitte auf diesen Link klicken um diese E-mail-Adresse zu validieren:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Der Internet Explorer kann Lesezeichen im Netscape Lesezeichen Format über das Menü "Datei/Importieren und Exportieren ..." importieren. 
In jedem Falle muss es sich bei der Datei um eine standard Windows-Kodierte Datei handeln, UTF-8 wird nicht funktionieren.<br>
_P;

$para['command::import_bk_ie_hint'] = <<<_P
Der Internet Explorer kann Lesezeichen in das Netscape Lesezeichen Format über das Menü "Datei/Importieren und Exportieren ..." exportieren. 
Die exportierte Datei besitzt dann eine standard Windows Kodierung - bitte wählen Sie die Codepage beim importieren, UTF-8 wird nicht funktionieren.<br>
_P;

$para['command::noiconv'] = <<<_P
<@><br>
Die Codepage-Umwandlung ist auf diesem Sitebar-Server nicht verfügbar. Nur utf-8 und iso-8859-1 werden unterstützt.
<br>
_P;

$para['command::security_legend'] = <<<_P
Rechte:
<strong>A</strong>nsehen,
<strong>H</strong>inzufügen,
<strong>M</strong>odifizieren,
<strong>L</strong>öschen,
<strong>E</strong>ntfernen,
<strong>G</strong>ewähren
_P;

$para['command::purge_cache'] = <<<_P
<h3>Sollen wirklich alle FavIcons aus dem Cache entfernt werden</h3>
_P;

$para['command::tooltip_respect'] = <<<_P
Sende E-Mail nur wenn der Benutzer es erlaubt hat.
_P;

$para['command::tooltip_to_verified'] = <<<_P
Sende E-Mails nur zu überprüften Adressen.
_P;

$para['command::tooltip_allow_contact'] = <<<_P
Erlaube anonymen Nutzern den Administrator zu kontaktieren.
_P;

$para['command::tooltip_allow_custom_search_engine'] = <<<_P
Erlaubt den Benutzern in Ihren Einstellungen eine eigene Suchmaschine auszuwählen. Wird dies nicht gestattet, wird immer die auf dieser Seite angegebene Suchmaschine verwendet.
_P;

$para['command::tooltip_allow_sign_up'] = <<<_P
Erlaube Besuchern das Aufnahmeformular aufzurufen und sich bei SiteBar anzumelden.
_P;

$para['command::tooltip_comment_impex'] = <<<_P
Zeige Befehle für Import und Export von Verweisbeschreibungen.
_P;

$para['command::tooltip_personal_mode'] = <<<_P
SiteBar Modus für Einzelnutzer-Installation anstellen.
_P;

$para['command::tooltip_allow_user_trees'] = <<<_P
Erlaube Benutzern zusätzliche Bäume zu erstellen.
_P;

$para['command::tooltip_allow_user_tree_deletion'] = <<<_P
Erlaube Nutzern ihre existierenden Bäume zu löschen.
_P;

$para['command::tooltip_allow_user_groups'] = <<<_P
Es ist Benutzern erlaubt ihre eigenen Gruppen zu erstellen. Andernfalls haben nur Administratoren dieses Recht.
_P;

$para['command::tooltip_use_conv_engine'] = <<<_P
Die Zeichensatz-Konvertierung ist notwendig um verschiedene Sprachsysteme in einander zu konvertieren. Dies ist vor allem beim Im- und Export von Lesezeichen
wichtig. Allerdings ist dazu eine PHP-interne Erweiterung (iconv) notwendig, die nicht immer aktiviert ist. Dies kann auf manchen Systemen dazu führen, dass die SiteBar nicht funktioniert.
_P;

$para['command::tooltip_use_compression'] = <<<_P
Die Seiten der SiteBar können komprimiert werden um Bandbreite zu sparen. Allerdings setzt dies die Unterstützung des Features durch den Browser vorraus.
_P;

$para['command::tooltip_use_mail_features'] = <<<_P
Aktiviert die Mailing-Funktion der SiteBar. Diese Funktionalität steht nur zur Verfügung wenn PHP die Verwendung der "mail"-Funktion erlaubt.
_P;

$para['command::tooltip_use_outbound_connection'] = <<<_P
Einige Funktionen (Icon Cache) benötigen den Zugriff auf externe Seiten. Eigenständige Verbindungen durch die SiteBar können mit dieser Option jedoch unterbunden werden.
_P;

$para['command::tooltip_users_must_be_approved'] = <<<_P
Benutzer müssen vom Administrator freigeschaltet werden bevor sie SiteBar verwenden können.
_P;

$para['command::tooltip_users_must_verify_email'] = <<<_P
Benutzer müssen ihre E-Mail Adresse bestätigen bevor sie SiteBar benutzen können.
_P;

$para['command::tooltip_show_logo'] = <<<_P
Aktiviert das SiteBar-Logo am oberen Bildschirm-Rand. Bei einem langsamen Host macht es Sinn das Logo abzuschalten.
_P;

$para['command::tooltip_show_statistics'] = <<<_P
Zeige einige statische und Performance Statistiken in der Haupt-SiteBar Leiste.
_P;

$para['command::tooltip_allow_anonymous_export'] = <<<_P
Ermöglicht es auch anonymen Benutzern die Lesezeichen herunterzuladen oder den Feed zu verwenden. Diese Sperre kann umgangen werden wenn der Benutzer weiss, wie die entsprechende URL lauten muss.
_P;

$para['command::tooltip_use_favicon_cache'] = <<<_P
Aktiviert den Cache für die Icons. Der Server wird die Icons für Lesezeichen herunterladen und in der Datenbank zwischenspeichern. Ist der Cache aktiviert, wird die SiteBar schneller aufgebaut, da alle Bilder vom SiteBar-Server geliefert werden, aber dafür ist der Traffic über den Server höher. Wird der Cache deaktiviert werden die Icons durch Links auf die Original-Position ersetzt. In dem Fall holt der Browser alle Icons selbst, muss aber dafuer entsprechend viele Server kontaktieren.
_P;

$para['command::tooltip_max_icon_cache'] = <<<_P
Maximal Anzahl Icons im Cache. Die ältesten Icons werden aus dem System entfernt.
_P;

$para['command::tooltip_max_icon_size'] = <<<_P
Maximal erlaubte Größe eines Bildes (in Bytes), um in den Cache aufgenommen zu werden.
_P;

$para['command::tooltip_max_icon_age'] = <<<_P
Maximales Alter der Icons. Bestimmt wie häufig ein Icon vom ursprünglichen Server erneuert wird.
_P;

$para['command::tooltip_verified'] = <<<_P
Hiermit wird die E-Mail Adresse auch ohne Überprüfung als korrekt markiert.
_P;

$para['command::tooltip_demo'] = <<<_P
Verwandelt das erstellte Konto in einen Demo-Zugang. Die Rechte für den Demo-Nutzer sind eingeschränkt und das Passwort kann nicht geändert werden.
_P;

$para['command::tooltip_approved'] = <<<_P
Konto als "akzeptiert" markieren und damit den Zugriff für diesen Nutzer freischalten.
_P;

$para['command::tooltip_mix_mode'] = <<<_P
Ordner werden ober- bzw. unterhalb der Lesezeichen angezeigt.
_P;

$para['command::tooltip_allow_given_membership'] = <<<_P
Erlaube Moderatoren mich zu ihren Gruppen hinzuzufügen.
_P;

$para['command::tooltip_allow_info_mails'] = <<<_P
Erlaube Administratoren und Moderatoren zu deren Gruppen ich gehöre mit Informations E-Mails zu senden.
_P;

$para['command::tooltip_auto_retrieve_favicon'] = <<<_P
Empfange Favicon automatisch wenn es fehlt und ein Link hinzugefühgt wird.
_P;

$para['command::tooltip_show_acl'] = <<<_P
Schmücke Verzeichnisse mit Sicherheitsspezifikationen.
_P;

$para['command::tooltip_extern_commander'] = <<<_P
Ist diese Option aktiviert, dann öffnet die SiteBar für jedes Kommando ein externes Fenster. Die SiteBar muss so nach ausführen des Befehls nicht neu geladen werden. So kann man zwar schneller arbeiten, allerdings werden Veränderungen erst angezeigt, wenn man die SiteBar manuell neu lädt.
_P;

$para['command::tooltip_hide_xslt'] = <<<_P
Deaktiviert Features der SiteBar die eine XSLT-Unterstützung des Browsers benötigen.
_P;

$para['command::tooltip_load_open_nodes_only'] = <<<_P
Lädt nur den Inhalt offener Verzeichnisse.
_P;

$para['command::tooltip_private_over_ssl_only'] = <<<_P
Private Lesezeichen werden nur angezeigt, wenn eine sichere Verbindung zur SiteBar aufgebaut wurde.
_P;

$para['command::tooltip_menu_icon'] = <<<_P
Einige Browser bzw. Plattformen ermöglichen keinen Rechtsklick auf die Lesezeichen der SiteBar. Um die SiteBar trotzdem verwenden zu können aktiviert diese Option ein kleines Icon neben jedem Ordner oder Lesezeichen, der das Kontext-Menü aufruft.
_P;

$para['command::tooltip_auto_close'] = <<<_P
Zeige im Erfolgsfall nicht den Befehls-Ausführungs-Status.
_P;

$para['command::tooltip_show_public'] = <<<_P
Zeige Lesezeichen die von anderen Nutzern veröffentlich wurden.
_P;

$para['command::tooltip_use_favicons'] = <<<_P
Die Verwendung der Icons von Lesezeichen ist zwar grafisch ansprechend, verlangsamt die SiteBar jedoch merklich. Werden die Icons angezeigt, sollte man den Icon Cache aktivieren, um den Geschwindigkeitsverlust zu reduzieren.
_P;

$para['command::tooltip_use_hiding'] = <<<_P
Erlaubt das Verstecken einzelner Ordner. Diese Funktion ist nützlich, um die veröffentlichten Ordner anderer Benutzer aus dem eigenen Baum auszublenden.
_P;

$para['command::tooltip_use_tooltips'] = <<<_P
Aktiviert die SiteBar eigene Tooltip-Funktion (anstatt die des Browsers). Das erlaubt zum einen längere Tooltips und funktioniert zum anderen auf mehr Browsern.
_P;

$para['command::tooltip_use_trash'] = <<<_P
Aktiviert den Papierkorb. Gelöschte Lesezeichnen und Ordner werden so anfänglich nur als gelöscht markiert und können dann entweder endgültig gelöscht oder wieder hergestellt werden.
_P;

$para['command::tooltip_use_search_engine'] = <<<_P
Erlaubt die Verwendung externer Suchmaschinen.
_P;

$para['command::tooltip_use_search_engine_iframe'] = <<<_P
Die Ergebnisse der Suchmaschine werden an das SiteBar-Suchergebnis angehängt.
_P;

$para['command::tooltip_allow_addself'] = <<<_P
Erlaube Benutzern sich selbst zur Gruppe hinzuzufügen
_P;

$para['command::tooltip_allow_contact_moderator'] = <<<_P
Erlaube dass der Gruppenmoderator von Nicht-Gruppenmitgliedern kontaktiert werden kann.
_P;

$para['command::tooltip_publish'] = <<<_P
Veröffentliche dieses Verzeichnis, so dass jeder es sehen kann.
_P;

$para['command::tooltip_delete_content'] = <<<_P
Lösche den Inhalt des Verzeichnisses , nicht jedoch das Verzeichnis selbst.
_P;

$para['command::tooltip_paste_content'] = <<<_P
Die Operation nur auf den Inhalt des Ordners anwenden, nicht auf den Ordner selbst.
_P;

$para['command::tooltip_default_folder'] = <<<_P
Diese Ordner wird als der Standard-Ordner gesetzt, wenn das Bookmarklet das nächste Mal verwendet wird.
_P;

$para['command::tooltip_private'] = <<<_P
Lesezeichen als privat markieren. Nur der Eigner des Baumes kann diesen Link sehen, auch wenn der Ordner selbst freigegeben ist.
_P;

$para['command::tooltip_novalidate'] = <<<_P
Dieses Lesezeichnen nicht in die Validierung mit einbeziehen. Diese Funktion ist sinnvoll für Links ins Intranet, die vom externen Server nicht validiert werden können.
_P;

$para['command::tooltip_is_dead_check'] = <<<_P
Dieser Link konnte nicht validiert werden. Er kann entweder entfernt oder wieder als aktiv markiert werden.
_P;

$para['command::tooltip_subfolders'] = <<<_P
Die Lesezeichen dieses Ordner und aller Unterordner validieren.
_P;

$para['command::tooltip_ignore_recently'] = <<<_P
Lesezeichen die vor kurzem validiert wurden nicht in die Validierung mit einbeziehen. Diese Funktion ist nützlich wenn die vorige Validierung abgebrochen wurde und nun fortgesetzt werden soll.
_P;

$para['command::tooltip_discover_favicons'] = <<<_P
Analysiert die angegebene URL und sucht nach fehlenden Icons.
_P;

$para['command::tooltip_delete_favicons'] = <<<_P
Entfernt die Icon-URL vom Lesezeichen wenn sie ungültig ist. Diese Funktion ist mit Vorsicht zu verwenden.
_P;

$para['command::tooltip_rename'] = <<<_P
Lesezeichen mit gleichen Namen werden beim Import umbenannt, so dass alles Lesezeichen importiert werden.
_P;

$para['command::tooltip_hits'] = <<<_P
Aktivieren dieser Funktion leitet jeden Klick durch den SiteBar-Server, so dass eine Statistik über die Verwendung der Links erstellt werden kann.
_P;

$para['command::tooltip_subdir'] = <<<_P
Exportiert rekursiv alle Ordner und Lesezeichen
_P;

$para['command::tooltip_flat'] = <<<_P
Exportiert die Lesezeichen als wären sie in einem Ordner.
_P;

$para['command::tooltip_cmd'] = <<<_P
Die wichtigsten SiteBar-Befehle hinzufügen um möglichst einfach in die SiteBar einloggen zu können.
_P;

$para['sitebar::users_must_verify_email'] = <<<_P
Dieser SiteBar-Server erfordert eine verifizierte E-Mail. Bitte Geben verifizieren Sie Ihre E-Mail-Adresse, da der Account ansonsten vielleicht gelöscht wird.
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Ihre E-Mail-Adresse passt zu der Regel für eine Mitgliedschaft in
der/den privaten Gruppe(n) aufgestellt wurde:
    %s.

Um die Mitgliedschaft zu bestätigen, muss die E-Mail-Adresse
verifiziert werden. Hierfür bitte auf den folgenden Link klicken:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Benutzer "%s" <%s> hat sich bei dem Sitebar-Server %s angemeldet.
_P;

$para['usermanager::signup_info_verified'] = <<<_P
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation um %s angemeldet.
Der Nutzer hat seine E-Mail Adresse schon verifiziert.
_P;

$para['usermanager::signup_approval'] = <<<_P
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation um %s angemeldet.
Der Nutzer hat seine E-Mail Adresse schon verifiziert.

Account annehmen:
    %s

Account ablehnen:
    %s

Ausstehende Benutzer sehen:
    %s
_P;

$para['usermanager::signup_approval_verified'] = <<<_P
Benutzer "%s" <%s> hat sich bei Ihrer SiteBar Installation um %s angemeldet.
Der Nutzer hat seine E-Mail Adresse schon verifiziert.

Account annehmen:
    %s

Account ablehnen:
    %s

Ausstehende Benutzer sehen:
    %s
_P;

$para['hook::statistics'] = <<<_P
Roots {roots_total}.
Verzeichnisse {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
User {users}.
Gruppen {groups}.
SQL Abfragen {queries}.
DB/Total Zeit {time_db}/{time_total} Sek ({time_pct}%).
_P;

?>
