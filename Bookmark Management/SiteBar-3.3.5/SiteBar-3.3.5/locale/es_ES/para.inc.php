<?php

$para = array();

$para['index::tip'] = <<<_P
Usar esta página para instalar en tu navegador SiteBar. Se recomienda añadir a tus favoritos uno de los enlaces marcados con "*" en lugar de añadir esta página. A esta página puedes llegar desde la ventana SiteBar haciendo clic en el logo superior.
_P;

$para['index::any_browser'] = <<<_P
Usar <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>*
en esta ventana- o abrir un pop-up
<a title="SiteBar" href="%s">SiteBar</a>-*.
_P;

$para['index::ie_install'] = <<<_P
<a href="?install=1">Instalar</a> / <a href="?install=0">Desinstalar</a>
a la barra del Explorador y al menú contextual- necesita realiar cambios
 en el registro de windows y que el sitema se reinicie para disponer de todas
las características. Dependiendo de tus permisos se instalarán más o menos características.
<p class='comment'>Para poner la barra lateral de SiteBar hay que seleccionarla en Ver/Barra del Explorador
Para añadir la página que estemos visitando a SiteBar tenemos que pulsar el botón derecho
del ratón y en el menú contextual seleccionar Añadir enlace a SiteBar.
</p>
_P;

$para['index::ie_search'] = <<<_P
Añadir <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))">A
SiteBar</a>* de forma temporal a la barra de Exploración Lateral.
<p class='comment'>Usar esto cuando no tengamos los suficientes derechos para ejecutar la instalación anterior.</p>
_P;

$para['index::mozilla'] = <<<_P
Añadir a navegador compatible con Mozilla/Netscape
<a title="SiteBar"
href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
sidebar</a> - cambiar con F9.
<p class='comment'>Los usuarios de Mozilla Firefox deberían usar el link anterior para crear favoritos
que abran en sidebar al ser pulsados. Mozillazine
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">topic</a> describe cómo usar<a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> la extensión SiteBar<a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">EnlacesWebs</a> Extensiones del menú con SiteBar.
</p>
_P;

$para['index::opera'] = <<<_P
Añadir a Opera <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a>
como barra de Exploración Lateral.
<p class='comment'>Usar Ctrl+click en lugar de  botón derecho+click para mostrar el menú contextual.</p>
_P;

$para['index::myie2_install'] = <<<_P
Personalizar Download
<a href="http://sitebar.org/plugin/myie2/?sidebar=%s">sidebar</a>
y/o
<a href="http://sitebar.org/plugin/myie2/?toolbar=%s">Añadir la pestaña actual a SiteBar</a>
Plugin para la barra de herramientas.
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">Añade esta página a SiteBar</a>* - Pulsa con el botón derecho del ratón para añadir esta página a tus favoritos. Este enlace te permitirá mas tarde  añadir la página que estés visitando a SiteBar. Los usuarios de Microsoft Internet explorer pueden usar el instalador y el menú contextual en su lugar.
_P;

$para['index::copyright2'] = <<<_P
Copyright &copia; 2003,2004 <a href='http://brablc.com/'>Ondřej Brablc</a>
y <a href='http://sitebar.org/team.php'> el equipo SiteBar</a>.
Apoyo <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>forum</a>.
_P;

$para['command::contact'] = <<<_P
Mensaje:

%s


--
La instalación de SiteBar en %s.
_P;

$para['command::contact_group'] = <<<_P
Grupo: %s
Mensaje:

%s


--
La instalación de SiteBar en %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>¿Quieres realmente borrar tu cuenta?</h3>
¡No habrá manera deshacer ese cambio! <p> Los restos de tus árboles serán dados al administrador del sistema.
_P;

$para['command::email_link_href'] = <<<_P
<p>Enviar e-maila través de tu correo predeterminado
<a href='mailto:?subject=Págia WEb: %s&amp;body=He encontrado una web que te puede interesar.
 Miralá en: %s
 --
 Enviado a través de  SiteBar at %s
 Servidor de Favoritos de Código abierto http://sitebar.org
'>e-mail del cliente</a>
_P;

$para['command::email_link'] = <<<_P
He encontrado una web que te puede interesar.
Miralá en:

    "%s" %s

%s

--
Enviado a través de SiteBar en %s
Servidor de Favoritos de Código abierto http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Tu has pedido validación por e-mail que te permita unirte
a los grupos y usar las características de e-mail de SiteBar.

Por favor clic en el siguiente enlace para verificar tu correo:
    %s
_P;

$para['command::import_bk'] = <<<_P
<br>
Los favoritos locales pueden ser exportados a un archivo local usando javascript
<a href='javascript:window.external.ImportExportFavorites(false,"")'>function</a>.
_P;

$para['command::export_bk'] = <<<_P
<br>
Los favoritos exportados pueden ser importados a los favoritos locales usando javascript<a href='javascript:window.external.ImportExportFavorites(true,"")'>function</a>.
_P;

$para['command::noiconv'] = <<<_P
<br>
Conversión para el código de página no está instalado en este servidor de SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Derechos:
<strong>R</strong>ead,
<strong>A</strong>dd,
<strong>M</strong>odify,
<strong>D</strong>elete,
<strong>P</strong>urge,
<strong>G</strong>rant


_P;

$para['command::purge_cache'] = <<<_P
<h3>¿Quieres realmente quitar los favoritos de la cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Tu dirección de email cumple las reglas para unirse a los siguientes
grupos privado(s):
    %s.

Para que se te apruebe tu membresíá, tu dirección de email
debe ser verificada. Por favor pulsa sobre el siguiente enlace para verificarla:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
El usuario "%s" <%s> se ha dado de alta en tu servicio de SiteBar ubicado en %s.
_P;

?>
