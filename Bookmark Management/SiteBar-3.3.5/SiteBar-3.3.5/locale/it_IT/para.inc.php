<?php

$para = array();

$para['index::tip'] = <<<_P
Questa pagina serve per installare o aprire nel proprio browser
un'istanza di SiteBar Bookmark Server. Si raccomanda, di creare un
bookmark per i collegamenti segnati con un asterisco invece di crearne uno a
questa pagina. Potete raggiungere questa pagina cliccando sul logo "SiteBar"
nella finestra principale di SiteBar.
_P;

$para['index::any_browser'] = <<<_P
Apri <a title="SiteBar" href="%s/sitebar.php">SiteBar</a>* in questa finestra - oppure apri <a title="SiteBar" href="%s">SiteBar</a> in una nuova finestra.
_P;

$para['index::ie_install'] = <<<_P
<a href="?install=1">Installa</a> nella barra di Explorer e nel menu contestuale o <a href="?install=0">Disinstalla</a> - richiede modifiche al registro di Windows e il riavviamento del sistema per tutte le funzionalità. A seconda dei diritti dell'utente di Windows solo alcune funzionalità potrebbero essere installate.
<p class="comment">Apri la barra di esplorazione di SiteBar dal menu Mostra/Barra di esplorazione oppure usa la funzione
 <b>Personalizza...</b> barre degli strumenti, per mostrare il bottone di SiteBar Panel nella barra degli strumenti. Clicca il tasto destro in qualunque punto della pagina, oppure sopra un collegamento per aggiungere la pagina o il collegamento a SiteBar.</p>

_P;

$para['index::ie_search'] = <<<_P
Aggiungi temporaneamente <a title="SiteBar" href="javascript:void(_search=open('%s/sitebar.php','_search'))"> SiteBar</a>* 
alla Barra di Ricerca di Explorer. <p class="comment">Da usare quando non si hanno diritti sufficienti ad usare l'installer di cui sopra.</p>
_P;

$para['index::mozilla'] = <<<_P
Aggiungi <a title="SiteBar" href="javascript:sidebar.addPanel('SiteBar','%s/sitebar.php','')">
barra laterale</a> ad un browser Mozilla/Netscape compatibile - usare F9 per cambiare.
<p class='comment'>Gli utenti di Mozilla Firebird dovrebbero utilizzare il collegamento
soprastante per creare un bookmark che apra SiteBar. 
<a href="http://forums.mozillazine.org/viewtopic.php?t=36166">Mozillazine</a> descrive come usare <a href="http://sitebar.org/plugin/firefox/SiteBar.xpi?url=%s">SiteBar</a> l'estensione della barra laterale e <a href="http://sitebar.org/plugin/firefox/WebLinks_for_SiteBar.xpi?url=%s">WebLinks</a> l'estensione del menu con SiteBar. </p>

_P;

$para['index::opera'] = <<<_P
Aggiungi a Opera <a title="SiteBar" rel="sidebar" href="%s/sitebar.php">Hotlist</a>
come barra laterale.
<p class='comment'>Usa Ctrl+click invece di Right+click per visualizzare il menu contestuale.</p>
_P;

$para['index::myie2_install'] = <<<_P
Scarica la
<a href="http://sitebar.org/plugin/myie2/?sidebar=%s">barra laterale</a>
su misura e/o
<a href="http://sitebar.org/plugin/myie2/?toolbar=%s">aggiungi barra corrente a SiteBar</a>
toolbar plugin.
_P;

$para['index::bookmarklet'] = <<<_P
<a href="javascript:%s">Aggiungi Pagina a SiteBar</a>* - clicca il tasto destro su questo collegamento e aggiungi alla tua barra degli strumenti dei preferiti/bookmark. Ti consentirà successivamente di aggiungere a SiteBar un collegamento alla pagina attualmente visualizzata nel browser. Gli utenti di MS IE possono usare l'installatore e il menu contestuale.
_P;

$para['index::copyright2'] = <<<_P
Copyright &copy; 2003-2005 <a href='http://brablc.com/'>Ondřej Brablc</a> e il <a href='http://sitebar.org/team.php'>Team SiteBar</a>.  <a href='http://sourceforge.net/forum/forum.php?forum_id=261003'>Forum</a> di supporto.
_P;

$para['command::contact'] = <<<_P
Messaggio:

%s


--
Istallazione Sitebar a %s.
_P;

$para['command::contact_group'] = <<<_P
Gruppo: %s
Messaggio:

%s


--
Installazione SiteBar a %s.
_P;

$para['command::delete_account'] = <<<_P
<h3>Vuoi veramente eliminare il tuo account?</h3>
Questa opzione &#232; irreversibile !<p>
Tutti i tuoi link verrano affidati all'amministratore di sistema.
_P;

$para['command::email_link_href'] = <<<_P
<p>Spedisci un'e-mail tramite <a href="mailto:?subject=Sito web: %s&body=Ho trovato un sito web che ti potrebbe interessare. Dai un'occhiata a: %s -- Spedito tramite SiteBar a %s Open Source Bookmark Server http://sitebar.org ">il tuo programma e-mail predefinito</a>
_P;

$para['command::email_link'] = <<<_P
Ho trovato un sito web che potrebbe interessarti.
Dai un'occhiata a:

    "%s" %s

%s

--
Spedito via SiteBar a %s
Open Source Bookmark Server http://sitebar.org

_P;

$para['command::verify_email'] = <<<_P
Hai chiesto la verifica dell'e-mail che consente di accedere ai gruppi con espressioni regolari di auto unione e consente di usare le funzionalità e-mail di SiteBar.

Per favore clicca sul collegamento seguente per verificare la tua e-mail:
   %s

_P;

$para['command::export_bk_ie_hint'] = <<<_P
Internet Explorer può importare/esportare i bookmark nel formato Netscape Bookmark. Nel caso, il file deve usare la codifica Windows nativa,  quella UTF-8 predefinita non funzionerà.<br>
_P;

$para['command::noiconv'] = <<<_P
<br>
Il convertitore di Codepage non &#232; installato in questo SiteBar server.
<br>
_P;

$para['command::security_legend'] = <<<_P
Diritti:
<strong>R</strong>ead(Lettura),
<strong>A</strong>dd(Aggiunta),
<strong>M</strong>odify(Modifica),
<strong>D</strong>elete(Eliminazione),
<strong>P</strong>urge(Pulizia),
<strong>G</strong>rant(Assegnazione)
_P;

$para['command::purge_cache'] = <<<_P
<h3>Vuoi davvero rimuovere tutte le facicon dalla cache?</h3>
_P;

$para['usermanager::auto_verify_email'] = <<<_P
Il tuo indirizzo e-mail rientra nelle regole per l'iscrizione automatica ai seguenti gruppi chiusi:
   %s.

Per approvare la tua iscrizione, il tuo indirizzo email deve essere verificato. Per favore clicca sul collegamento seguente per verificarlo:
   %s

_P;

$para['usermanager::signup_info'] = <<<_P
L'utente "%s" <%s> si è registrato presso la tua installazione di SiteBar a %s.
_P;

$para['hook::statistics'] = <<<_P
Radici {roots_total}.
Cartelle {nodes_shown}/{nodes_total}.
Collegamenti {links_shown}/{links_total}.
Utenti {users}.
Gruppi {groups}.
Query SQL {queries}.
Tempo DB/Totale {time_db}/{time_total} sec ({time_pct}%).
_P;

?>
