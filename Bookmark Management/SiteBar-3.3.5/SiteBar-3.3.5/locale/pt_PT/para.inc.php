<?php

$para = array();

$para['index::tip'] = <<<_P
Use esta página para executar ou instalar no seu browser esta instância do SiteBar Servidor de Bookmark. É recomendável fazer bookmark dos link com "*" em vez de fazer bookmark desta página. Esta página pode ser aberta apartir da janela do SiteBar clicando no logotipo superior.
_P;

$para['index::any_browser'] = <<<_P
Use o <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>*
nesta janela - ou abra numa janela pop-up
<a title="SiteBar" href="%s">SiteBar</a>*.
_P;

$para['index::ie_install'] = <<<_P
<a href="?install=1">Instalar</a> / <a href="?install=0">Desinstalar</a>
da Barra do Explorador e menu de contexto - requere mudanças no registo do Windows e o reiniciar do sistema para todas as características. Dependendo dos seus direitos, somente
 algumas características serão instaladas.
<p class='comment'>Abrir Explorador SiteBar do menu Ver/Barra Explorar ou
usar função <b>Personalizar...</b> da Barra de Ferramentas para adquirir o Painel SiteBar
clicando no botão mostrado na Barra de Ferramentas.
Clique direito em qualquer lugar na página ou em cima de um link para adicionar a página ou o link ao SiteBar.
</p>
_P;

$para['index::ie_search'] = <<<_P
Adicionar o <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))">
SiteBar</a>* temporáriamente à Barra Exploradora<p class='comment'>Use quando não tiver direitos suficientes para usar o Instalar em cima descrito.</p>
_P;

$para['index::mozilla'] = <<<_P
Adicionar ao Mozilla/Netscape ou compativel 
<a title="SiteBar"
href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
barra lateral</a> - use F9 para mostrar.
<p class='comment'>Os utilizadores do Mozilla Firefox devem usar o link em cima para criar
o bookmark que abre na Barra Lateral quando clicado. O Mozillazine
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">tópico</a> dp Forum Mozillazine descreve como usar a extensão da barra lateral <a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> e extensão de menu <a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">WebLinks</a> com o SiteBar.
</p>
_P;

$para['index::opera'] = <<<_P
Adicionar ao Opera <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a>
como barra lateral.
<p class='comment'>Use Ctrl+clique em vez de clique direito para mostrar o menu de contexto da pasta ou link.</p>
_P;

$para['index::myie2_install'] = <<<_P
Transferência personalizada do plugin da
<a href="http://sitebar.org/plugin/myie2/?sidebar=%s">barra lateral</a>
e/ou plugin
<a href="http://sitebar.org/plugin/myie2/?toolbar=%s">Add Current Tab to SiteBar</a>
da barra de ferramentas.
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">Adicionar Página ao SiteBar</a>* - clique direito neste link e adicione
para a sua barra de favoritos/bookmarks. Permitirá mais tarde adicionar o link da página actual do browser ao SiteBar. Utilizadores do Microsoft Internet Explorer podem instalar no menú de contexto.
_P;

$para['index::copyright2'] = <<<_P
Copyright &copy; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a>
e a <a href='http://sitebar.org/team.php'>Equipa SiteBar</a>.
Suporte <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>fórum</a>.
_P;

$para['command::contact'] = <<<_P
Mensagem:

%s


--
SiteBar instalado em %s.
_P;

$para['command::contact_group'] = <<<_P
Grupo: %s
Mensagem:

%s


--
SiteBar instalado em %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Quer realmente apagar esta conta?</h3>
Não haverá nenhuma de voltar atrás na mudança!<p>
Todas as suas restantes árvores serão dadas ao administrador do sistema.
_P;

$para['command::email_link_href'] = <<<_P
<p>Enviar e-mail através do seu
<a href='mailto:?subject=Website: %s&body=Eu encontrei um site que tu poderás estar interessado.
 Dá um vista de olhos em: %s
 --
 Enviado através do SiteBar em %s
 Servidor Bookmark Open Source http://sitebar.org
'>cliente de e-mail predefinido</a>
_P;

$para['command::email_link'] = <<<_P
Eu encontrei um site que tu poderás estar interessado.
Dá um vista de olhos em:

    "%s" %s

%s

--
Enviado através do SiteBar em %s
Servidor Bookmark Open Source http://sitebar.org
_P;

$para['command::verify_email'] = <<<_P
Voçê requereu a validação de e-mail que permite juntar-se automáticamente a grupos
com expressões regulares e permite-lhe usar as características de e-mail do SiteBar.

Por favor, clique no link seguinte para verificar o seu e-mail:
    %s
_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer pode importar/exportar bookmarks no formato Netscape Bookmark.
Entretanto, tem de ser na codificação nativa do Windows, a predefinida UTF-8 não funcionará.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
A conversão do código da página não está instalado neste servidor do SiteBar.
<br>
_P;

$para['command::security_legend'] = <<<_P
Direitos:
<strong>L</strong>eitura,
<strong>A</strong>dicionar,
<strong>M</strong>odificar,
Apa<strong>g</strong>ar,
Lim<strong>p</strong>ar,
<strong>C</strong>onceder
_P;

$para['command::purge_cache'] = <<<_P
<h3>Quer realmente remover todos os ícones de favoritos da cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
O seu endereço de e-mail está para auto juntar para o(s) seguinte(s) grupo(s) fechado(s):
    %s.

Para aprovar a sua sociedade, o seu endereço de e-mail tem de ser verificado. Por favor, clique no link seguinte para o verificar:
    %s
_P;

$para['usermanager::signup_info'] = <<<_P
Utilizador "%s" <%s> registou-se na sua instalação do SiteBar em %s.
_P;

$para['hook::statistics'] = <<<_P
Raizes {roots_total}.
Pastas {nodes_shown}/{nodes_total}.
Links {links_shown}/{links_total}.
Utilizadores {users}.
Grupos {groups}.
SQL pedidos {queries}.
BD/Tempo total {time_db}/{time_total} seg ({time_pct}%). 
   

_P;

?>
