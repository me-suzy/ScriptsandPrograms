<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
 *                                                                            *
 *  This program is free software; you can redistribute it and/or modify      *
 *  it under the terms of the GNU General Public License as published by      *
 *  the Free Software Foundation; either version 2 of the License, or         *
 *  (at your option) any later version.                                       *
 *                                                                            *
 *  This program is distributed in the hope that it will be useful,           *
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of            *
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the             *
 *  GNU General Public License for more details.                              *
 *                                                                            *
 *  You should have received a copy of the GNU General Public License         *
 *  along with this program; if not, write to the Free Software               *
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA *
 ******************************************************************************/

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');
require_once('./inc/usermanager.inc.php');

$um = SB_UserManager::staticInstance();

// If we are called the first time, without params and without cookies
if (!isset($_GET['url']) && !isset($_GET['lang']) )
{
    SB_Skin::set($um->getParam('user','skin'));

    $url = $um->getParamB64('config','integrator_url');
    $url .= '?lang=' . $um->getParam('user','lang');
    $url .= '&skin=' . SB_Skin::get();
    $url .= '&version='. SB_CURRENT_RELEASE;
    $url .= '&url='. SB_Page::baseurl();

    // Redirect to the central URL, or to the own URL with the information
    header('Location: ' . $url);
    exit;
}

// Now we have the information, we are on the right page and we will use cookies
// We will redirect using META tag later on to support all browsers
if (isset($_GET['url']))
{
    foreach (array('skin','version','url') as $key)
    {
        $cookieKey = 'sbi_'.$key;
        $_COOKIE[$cookieKey] = $_REQUEST[$key];
        setcookie($cookieKey, $_REQUEST[$key]);
    }
}

SB_Page::baseurl($_COOKIE['sbi_url']);
SB_Skin::set($_COOKIE['sbi_skin']);
SB_SetLanguage($_GET['lang']);

if (isset($_REQUEST['install']))
{
    IEInstall();
    exit;
}

if (isset($_REQUEST['search_engine']))
{
    SearchEngine();
    exit;
}

// Redirect and keep cookies
$meta = null;
if (isset($_GET['url']))
{
    $meta = '<meta http-equiv="refresh" content="0;url=integrator.php?lang='.SB_GetLanguage().'">';
}

SB_Page::head('Integrator', 'index', null, null, $meta);

if (isset($_GET['url']))
{
    exit;
}

// Include skin hook file
include_once(SB_Skin::path().'/hook.inc.php');
$hook = new SB_Hook();

$sponsor = new SB_SponsorInterface($hook);
$file = './inc/sponsor.inc.php';
if (is_file($file))
{
    include_once($file);
    $sponsor = new SB_Sponsor($hook);
}

$browser = SB_reqVal('browser');

$browsers = array
(
    'firefox' => array
    (
        'label'    =>'Mozilla Firefox',
        'homepage' =>'http://www.mozilla.org/products/firefox/',
        'platforms'=>'1.0/WinXP,Linux',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('sitebar','sidebar','livebookmarks','mozlinker','booksync','search_engine'),
    ),
    'mozilla' => array
    (
        'label'    =>'Mozilla',
        'homepage' =>'http://www.mozilla.org/products/mozilla1.x/',
        'platforms'=>'1.7.5/WinXP',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('sidebar_mozilla','mozlinker'),
    ),
    'opera' => array
    (
        'label'    =>'Opera Web Browser',
        'homepage' =>'http://www.opera.com/',
        'platforms'=>'7.5,8.0/WinXP',
        'usage' => SB_P('integrator::usage_opera'),
        'exclude'  =>array('dir'),
        'extra'  =>array('hotlist'),
    ),
    'msie' => array
    (
        'label'    =>'Microsoft Internet Explorer',
        'homepage' =>'http://www.microsoft.com/windows/ie/default.mspx',
        'platforms'=>'6.0/WinXP',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('install', 'uninstall', 'searchbar'),
    ),
    'maxthon' => array
    (
        'label'    =>'Maxthon Tabbed Browser',
        'homepage' =>'http://www.maxthon.com/',
        'platforms'=>'1.1.120/WinXP',
        'usage' => '',
        'exclude'  =>array(),
        'extra'  =>array('maxthon_sidebar','maxthon_toolbar'),
    ),
    'other' => array
    (
        'label'    =>'Linux Distro/Other Tools',
        'homepage' =>'',
        'platforms'=>'Gentoo,Debian/PHP Layers Menu',
        'usage' => '',
        'exclude'  =>array('dir','window','popup','addpage'),
        'extra'  =>array('gentoo','debian','phplm'),
    ),
);

$bookmarklet = "javascript:w=window;if(w.content){w=w.content};d=w.document;cp=d.characterSet?d.characterSet:d.charset;".
    "w.open('" . SB_Page::baseurl() . "/command.php?command=Add%20Link".
    "&amp;url='+escape(w.location.href)+'".
    "&amp;name='+escape(d.title)+".
    "(cp?'&amp;cp='+cp:''),'sbBmkWin',".
    "'resizable=yes,dependent=yes,width=240,height=480,top=200,left=300,titlebar=yes,scrollbars=yes');void(0)";

$popup = "javascript:void(window.open('".SB_Page::baseurl()."/index.php" .
    "?target=_blank','sbPopWin',".
    "'directories=no,width=220,height=600,left=0,top=0,scrollbars=yes,location=no,menubar=no, status=no, toolbar=no'))";

$urlParts = parse_url(SB_Page::baseurl());
$uniqName = preg_replace("/[^\w]*/", "", $urlParts['host']);

$extra = array
(
    'search_engine' => array
    (
        'label' => 'Add Search Engine',
        'url' => sprintf("javascript:void(window.sidebar.addSearchEngine('%s', '%s', '%s', '%s'))",
                    SB_Page::baseurl().'/integrator.php?lang='.SB_GetLanguage() . '&search_engine=/sitebar'.$uniqName.'.src',
                    SB_Page::baseurl().'/'.SB_Skin::imgsrc('root_transparent').'?rename=/sitebar'.$uniqName.'.png',
                    strlen($um->getParamB64('config','feed_root_name'))?$um->getParamB64('config','feed_root_name'):'SiteBar',
                    SB_T("Bookmarks")),
        'desc' => SB_P('integrator::hint_search_engine'),
    ),

    'sitebar' => array
    (
        'label' => 'SiteBar Sidebar Extension',
        'url' => 'http://ftp.mozilla.org/pub/mozilla.org/extensions/sitebar_sidebar/sitebar_sidebar-1.02-fx.xpi',
//        'url' => 'http://sitebar.org/plugin/firefox/SiteBar.xpi?url='.SB_Page::baseurl(),
        'desc' => SB_P('integrator::hint_sitebar'),
    ),

    'booksync' => array
    (
        'label' => 'Bookmarks Synchronizer Extension',
        'url' => 'https://addons.update.mozilla.org/extensions/moreinfo.php?id=14',
        'desc' => SB_P('integrator::hint_booksync',array($urlParts['host'], $urlParts['path'].'/index.php?w=xbel_std')),
    ),

    'livebookmarks' => array
    (
        'label' => 'Live Bookmarks',
        'url' => sprintf('%s/index.php?w=firefox&mode=download', SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_livebookmarks'),
    ),

    'mozlinker' => array
    (
        'label' => 'MozLinker Extension',
        'url' => sprintf('%s/index.php?w=rdf', SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_mozlinker'),
    ),

    'sidebar' => array
    (
        'label' => 'Sidebar',
        'url' => sprintf("javascript:sidebar.addPanel('SiteBar','%s/index.php','')",SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_sidebar'),
    ),

    'sidebar_mozilla' => array
    (
        'label' => 'Sidebar',
        'url' => sprintf("javascript:sidebar.addPanel('SiteBar','%s/index.php','')",SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_sidebar_mozilla'),
    ),

    'hotlist' => array
    (
        'label' => 'Add to Hotlist',
        'url' => SB_Page::baseurl().'/index.php',
        'params' => array('title'=>'SiteBar', 'rel'=>'sidebar'),
        'desc' => SB_P('integrator::hint_hotlist'),
    ),

    'install' => array
    (
        'label' => 'Install',
        'url' => '?lang='.SB_GetLanguage() . '&amp;install=1',
        'desc' => SB_P('integrator::hint_install'),
    ),

    'uninstall' => array
    (
        'label' => 'Uninstall',
        'url' => '?lang='.SB_GetLanguage() . '&amp;install=0',
        'desc' => SB_P('integrator::hint_uninstall'),
    ),

    'searchbar' => array
    (
        'label' => 'Show in Search Bar',
        'url' => sprintf("javascript:void(_search=open('%s/index.php','_search'))", SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_searchbar'),
    ),

    'maxthon_sidebar' => array
    (
        'label' => 'Sidebar Plugin',
        'url' => sprintf("http://sitebar.org/plugin/maxthon/?sidebar=%s", SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_maxthon_sidebar'),
    ),

    'maxthon_toolbar' => array
    (
        'label' => 'Toolbar Plugin',
        'url' => sprintf("http://sitebar.org/plugin/maxthon/?toolbar=%s", SB_Page::baseurl()),
        'desc' => SB_P('integrator::hint_maxthon_toolbar'),
    ),

    'gentoo' => array
    (
        'label' => 'Gentoo Ebuild',
        'url' => 'http://www.gentoo-portage.com/www-apps/sitebar',
        'desc' => SB_P('integrator::hint_gentoo'),
    ),

    'debian' => array
    (
        'label' => 'Debian',
        'url' => 'http://packages.debian.org/unstable/web/sitebar',
        'desc' => SB_P('integrator::hint_debian'),
    ),

    'phplm' => array
    (
        'label' => 'PHP Layers Menu',
        'url' => 'http://phplayersmenu.sourceforge.net/',
        'desc' => SB_P('integrator::hint_phplm', sprintf('%s/index.php?w=phplm', SB_Page::baseurl())),
    ),

);

$general = array
(
    'window' => array
    (
        'label' => 'SiteBar',
        'url' => SB_Page::baseurl().'/index.php',
        'desc' => SB_P('integrator::hint_window'),
    ),
    'dir' => array
    (
        'label' => 'SiteBar Directory',
        'url' => SB_Page::baseurl().'/index.php?w=dir',
        'desc' => SB_P('integrator::hint_dir'),
    ),
    'popup' => array
    (
        'label' => 'SiteBar Pop-up',
        'url' => $popup,
        'desc' => SB_P('integrator::hint_popup'),
    ),
    'addpage' => array
    (
        'label' => 'Add Page to SiteBar',
        'url' => $bookmarklet,
        'desc' => SB_P('integrator::hint_addpage'),
    ),
);

?>

<div id="main">
<div id="launcher">

  <div>
    <div id="home">
      <a href="http://sitebar.org/"><img alt="<?php echo SB_T('SiteBar Homepage')?>" src="<?php echo SB_Skin::imgsrc('logo')?>"></a>
      <br>
      [<a href="http://sitebar.org/"><?php echo SB_T('SiteBar Homepage')?></a>]
    </div>

    <div id="tip"><?php echo SB_P('integrator::welcome')?></div>
  </div>

  <div>

    <h2><?php echo SB_T('SiteBar Integrator')?></h2>
    <p>
<?php

        echo SB_P('integrator::header');
?>
    </p>
    <table>
        <tr>
            <th><?php echo SB_T('Browser/Category')?></th>
            <th colspan="2"><?php echo SB_T('Version/Platform')?></th>
        </tr>
<?php
    $lang = SB_GetLanguage();

    foreach ($browsers as $id => $param)
    {
        echo "<tr>\n";
            echo "<td><a".($browser == $id?" class='selected'":"")." href='?lang=$lang&browser=$id' title='".SB_T('Integration Instructions')."'>".SB_T($param['label'])."</a></td>\n";
            echo "<td>${param['platforms']}</td>\n";
            echo "<td>";
            if (isset($param['homepage']) && $param['homepage']!='')
            {
                echo "[<a href='${param['homepage']}'>Homepage</a>]";
            }
            else
            {
                echo "&nbsp;";
            }
            echo "</td>\n";
        echo "</tr>\n";
    }

?>
    </table>

    <p class='comment'>
<?php
        if ($browser == '')
        {
            echo SB_P('integrator::hint');
        }
        else
        {
            echo '<a href="integrator.php?lang='.SB_GetLanguage().'">'.SB_T('Usage Tips for All Browsers').'</a>';
        }
?>
    </p>

    <h2>
<?php
        if ($browser == '')
        {
            echo SB_T('Usage Tips for All Browsers');
        }
        else
        {
            echo SB_T('Usage/Integration Tips for %s', array($browsers[$browser]['label']));
        }
?>
    </h2>
<?php

        if ($browser != '')
        {
            if ( $browsers[$browser]['usage'] != '')
            {
                echo "<p class='browsertip'>\n";
                echo $browsers[$browser]['usage'];
                echo "</p>\n";
            }
        }

?>

    <table id='tips'>
        <tr>
            <th class='tip'>Tip</th>
            <th class='desc'>Description</th>
        </tr>
<?php

    foreach ($extra as $id => $params)
    {
        if (!in_array($id, $browsers[$browser]['extra']))
        {
            continue;
        }

        $urlparams = '';
        if (isset($params['params']))
        {
            foreach ($params['params'] as $att => $val)
            {
                $urlparams .= " $att='" . $val . "'";
            }
        }

        echo "<tr>\n";
            echo "<td class='extra'><a $urlparams href=\"${params['url']}\">".SB_T($params['label'])."</a></td>\n";
            echo "<td class='desc'>${params['desc']}</td>\n";
        echo "</tr>\n";
    }

    foreach ($general as $id => $params)
    {
        if (in_array($id, $browsers[$browser]['exclude']))
        {
            continue;
        }

        echo "<tr>\n";
            echo "<td class='general'><a href=\"${params['url']}\">".SB_T($params['label'])."</a></td>\n";
            echo "<td class='desc'>${params['desc']}</td>\n";
        echo "</tr>\n";
    }

?>
    </table>
    <p class='comment'>
<?php

        echo SB_P('integrator::hint_bookmarklet');
?>
    </p>
  </div>
</div>
<div id="trailer">
    <?php echo SB_P('integrator::copyright3') ?>
</div>
</div>
<div id="sponsorIntegratorVerticalRight"><?php $sponsor->integratorVerticalRight(); ?></div>

<?php
SB_Page::foot();

function IEInstall()
{
    $install = $_REQUEST['install'];

    $code     = '{3F218DFB-00FF-297C-4D54-57696C4A6F6F}';
    $title    = 'SiteBar';
    $url      = SB_Page::baseurl().'/index.php';
    $reg      = '';
    $filename = '';
    $ctxUrl   = SB_Page::baseurl() . "/ctxmenu.php";

    require_once('./inc/converter.inc.php');

    $charsetKey = 'Charset in MS Windows';
    $c = new SB_Converter(!$um || $um->getParam('config','use_conv_engine'),
        (SB_T($charsetKey)==$charsetKey?null:SB_T($charsetKey)));

    $addLink = $c->fromUTF8(SB_T('Add Link to SiteBar'));
    $addPage = $c->fromUTF8(SB_T('Add Page to SiteBar'));

    if ($install)
    {
        $filename = "InstallSiteBar.reg";

        $reg = <<<__INSTALL
REGEDIT4

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code]
@="$title"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Implemented Categories]

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Implemented Categories\\{00021493-0000-0000-C000-000000000046}]

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\InProcServer32]
@="Shdocvw.dll"
"ThreadingModel"="Apartment"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Instance]
"CLSID"="{4D5C8C2A-D075-11d0-B416-00C04FB90376}"

[HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code\\Instance\\InitPropertyBag]
"Url"="$url"

[-HKEY_CURRENT_USER\\Software\\Classes\\Component Categories\\{00021493-0000-0000-C000-000000000046}\\Enum]

[-HKEY_CURRENT_USER\\Software\\Classes\\Component Categories\\{00021494-0000-0000-C000-000000000046}\\Enum]

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\Explorer Bars\\$code]
"BarSize"=hex:B4
"Name"="$title"

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addLink]
"Contexts"=hex:22
"Flags"=hex:01
@="$ctxUrl?add=link"

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addPage]
"Contexts"=hex:01
"Flags"=hex:01
@="$ctxUrl?add=page"

[HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\Extensions\\{23F5C49C-74DF-42BA-A194-FF92A3B59FED}]
"ButtonText" = "SiteBar"
"MenuText" = "SiteBar Panel"
"MenuStatusBar"="Display SiteBar Panel"
"Icon" = "%SystemRoot%\\\\system32\\\\SHELL32.dll,173"
"HotIcon" = "%SystemRoot%\\\\system32\\\\SHELL32.dll,173"
"CLSID" = "{E0DD6CAB-2D10-11D2-8F1A-0000F87ABD16}"
"BandCLSID" = "$code"
"Default Visible"="Yes"
__INSTALL;
    }
    else
    {
        $filename = 'UnInstallSiteBar.reg';
        $reg = <<<__UNINSTALL
REGEDIT4

[-HKEY_CURRENT_USER\\Software\\Classes\\CLSID\\$code]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\Explorer Bars\\$code]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\Extensions\\{23F5C49C-74DF-42BA-A194-FF92A3B59FED}]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\Add Link to SiteBar]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\Add Page to SiteBar]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addLink]
[-HKEY_CURRENT_USER\\Software\\Microsoft\\Internet Explorer\\MenuExt\\$addPage]
__UNINSTALL;
    }

    header("Content-type: application/octet-stream\n");
    header("Content-disposition: attachment; filename=\"$filename\"\n");
    header("Content-transfer-encoding: binary\n");
    header('Content-length: ' . strlen($reg));
    echo $reg;

    exit;
}

function SearchEngine()
{
    $um = SB_UserManager::staticInstance();

    $name = $um->getParamB64('config','feed_root_name');

    if (!strlen($name))
    {
        $name = 'SiteBar';
    }

?>
# SiteBar plug-in

<search
   name="<?php echo $name ?>"
   description="<?php echo SB_T('Search in SiteBar Bookmarks') ?>"
   method="GET"
   action="<?php echo SB_Page::baseurl() ?>/search.php"
   searchForm="<?php echo SB_Page::baseurl() ?>/index.php"
>

<input name="q" user />
<input name="sourceid" value="sitebar-search" />

</search>
<?php
    exit;
}

?>
