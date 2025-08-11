<?php

$para = array();

$para['integrator::welcome'] = <<<_P
Benvingut a la pàgina d'integració de SiteBar. Aquesta pàgina t'ajudarà a treure el màxim profit de Sitebar.
En la <a href="http://sitebar.org>Pàgina de SiteBar</a> pots aprendre més sobre les característiques de SiteBar.
_P;

$para['integrator::header'] = <<<_P
Sitebar ha estat dissenyat per complir amb els estàndards i hauria de funcionar en la majoria de navegadors amb
javasript i galetes actius. La següent taula mostra en quins navegadors ha estat provat.
_P;

$para['command::contact'] = <<<_P
Missatge:

%s


--
Instalació de SiteBar a %s.
_P;

$para['command::contact_group'] = <<<_P
Grup: %s
Missatge:

%s


--
Instalació de SiteBar a %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Vols esborrar de veritat el teu compte?</h3>
No hi ha manera de desfer aquest canvi!<p>
Tots els teus arbres restant seran donats a l'administrador del sistema.
_P;

$para['command::email_link_href'] = <<<_P
<p>Envia correu a través del teu
<a href='mailto:?subject=Pàgina web: %s&body=He trobat una pàgina web que et pot interesar. Fés un cop d'ull a: %s -- Enviat via SiteBar a %s Open Source Bookmark Server http://sitebar.org '>client de correu</a> per defecte.
_P;

$para['command::email_link'] = <<<_P
He trobat una pàgina web que et pot interesar.
Fés un cop d'ull a:

 "%s" %s

%s

--
Enviat via SiteBar a %s
Open Source Bookmark Server http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Has demanat una validació de l'adreça de correu que et permetrà afegir-te als grups amb expresions regulars d'auto-afegit i et permetrà fer us de les caracteristiques de correu de SiteBar.

Sisplau clica al següent enllaç per verificar la teva adreça de correu:
 %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
L'Internet Explorer pot importar/exportar bookmarks en el format de fitxer de bookmarks de netscape.
De totes formes, ha de ser en la codificació nativa de Windows, el UTF-8 usat per defecte no funcionarà.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Conversió de pàgina de codis no instalada en aquest servidor de SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Dreta:
<strong>R</strong>ead (llegeix),
<strong>A</strong>dd (afegeix),
<strong>M</strong>odify (modifica),
<strong>D</strong>elete (esborra),
<strong>P</strong>urge (purga),
<strong>G</strong>rant (garanteix)
_P;

$para['command::purge_cache'] = <<<_P
<h3>Realment vols eliminar tots els favicons de la caché?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
La teva adreça de correu concorda amb les regles d'auto afiliació als següents grups tancats:
 %s.

Per tal d'aprovar la teva afiliació, la teva adreça de correu ha de ser verificada. Sisplau, clica en l'enllaç següent per verificar-la:
 %s
_P;

$para['usermanager::signup_info'] = <<<_P
L'usuari "%s" s'ha registrat a la teva instalació de Sitebar a %s.
_P;

$para['hook::statistics'] = <<<_P
Arrels {roots_total}.
Carpetes {nodes_shown}/{nodes_total}.
Enllaços {links_shown}/{links_total}.
Usuaris {users}.
Grups {groups}.
Queris SQL {queries}.
Base de dades/Temps total {time_db}/{time total} sec ({time_pct}%).
_P;

?>
