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

define( 'MIN_VERSION',  '4.1.0');
define( 'CHARSET',      'charset=UTF-8');
define( 'CONTENT_TYPE', 'text/html; '.CHARSET);
define( 'STATIC_VERSION',   '3.3.5' );

if (!function_exists('version_compare') || version_compare(phpversion(), MIN_VERSION, '<'))
{
    die("Please use at least PHP $min_version, ".
        "or download SiteBar release 3.0.2!");
}

/******************************************************************************/

function SB_reqVal($name, $mandatory=false, $default='')
{
    $is = SB_reqChk($name);
    if ($mandatory && !$is)
    {
        die('Expected field "'. $name .'" was not filled!');
    }
    return $is?$_REQUEST[$name]:$default;
}

function SB_setVal($name, $value)
{
    $_REQUEST[$name]=$value;
}

function SB_unsetVal($name)
{
    unset($_REQUEST[$name]);
}

function SB_reqChk($name)
{
    return isset($_REQUEST[$name]);
}

function SB_safePath($include)
{
    // We only allow letters, numbers and space for file paths to be included
    if (!preg_match("/^[a-z0-9_ ]+$/i", $include))
    {
        die('Unsafe path for inclusion: You should not ever get here!');
    }
}

function SB_handleRootCookie($page='index.php')
{
    if (isset($_GET['root']) && $_GET['root'] == 'cookie')
    {
        $_GET['root'] = $_COOKIE['SB3CTXROOT'];
        $params = array();
        foreach ($_GET as $key => $value)
        {
            $params[] = $key . "=" . $value;
        }
        header('Location: ' . SB_Page::baseurl() . '/' . $page . '?' . implode('&',$params));
        exit;
    }
}

/******************************************************************************/

class SB_HookInterface extends SB_ErrorHandler
{
    function head()
    {
        // We must have it on one line for MS IE
?>
<div id='logo'><a href="integrator.php" <?php echo SB_Page::target()?> title='SiteBar Integrator'><?php echo SB_Skin::img('logo')?></a></div>
<?php
    }

    function poweredBy($version)
    {
?>
    <div id='poweredBy'>
        <?php echo SB_T('Powered by %s ver. %s', array("<strong><a href='http://sitebar.org/' ".SB_Page::target().">SiteBar</a></strong>",$version))?>

    </div>
<?php
    }

    function designedBy()
    {
        $this->error('Please override deignedBy for your custom skins!');
    }

    function statistics($statistics)
    {
?>
    <div id='stat'>
        <?php echo SB_A('hook::statistics', $statistics) ?>
    </div>
<?php
    }

    function foot($version, $statistics)
    {
?>
<div id="tail">
    <div class="poweredBy">
<?php
        $this->poweredBy($version);
?>
    </div>
    <div class="designedBy">
<?php
        $this->designedBy();
?>
    </div>
</div>
<?php

        if ($statistics)
        {
            $this->statistics($statistics);
        }
    }

    function getStyle($styleID)
    {
        return '';
    }
}

/******************************************************************************/

class SB_SponsorInterface
{
    var $hook = null;

    function SB_SponsorInterface(&$hook)
    {
        $this->hook =& $hook;
    }

    function integratorVerticalRight()
    {
    }

    function buildAddLink()
    {
        return '';
    }

    function sitebarBottom()
    {
    }
}

/******************************************************************************/

class SB_Skin extends SB_ErrorHandler
{
    var $current = 'Modern';

    function & instance()
    {
        static $skin = null;
        if (!$skin)
        {
            $skin = new SB_Skin();
        }

        return $skin;
    }

    function get()
    {
        $i =& SB_Skin::instance();
        return $i->current;
    }

    function set($skin)
    {
        if ($skin)
        {
            static $i = null;
            if (!$i) $i =& SB_Skin::instance();

            SB_safePath($skin);

            $dirName = SB_Page::basedir() . 'skins/' . $skin;

            if (is_dir($dirName) && is_file($dirName.'/hook.inc.php'))
            {
                $i->current = $skin;
            }
        }
    }

    function img($filename, $prefix='', $id='', $class=null)
    {
        $imgid = '';

        if ($prefix)
        {
            $imgid = ' id="i' . $prefix . $id . '" ';
        }

        return '<img'.($class?' class="'.$class.'"':'') . $imgid .
               ' src="'. SB_Skin::imgsrc($filename) .'" alt="" />';
    }

    function imgsrc($filename)
    {
        return SB_Skin::path() . '/' . $filename . '.png';
    }

    function src($filename='')
    {
        return SB_Skin::path() . ($filename?'/':'') . $filename;
    }

    function path()
    {
        return SB_Page::basedir() . 'skins/'. SB_Skin::get();
    }
}

class SB_Page extends SB_ErrorHandler
{
    function title()
    {
        return 'SiteBar';
    }

    function baseurl($override=null)
    {
        static $baseurl = null;

        if ($override!==null)
        {
            $baseurl = $override;
        }

        if ($baseurl === null)
        {
            $hostvar = isset($_SERVER['HTTP_HOST'])?'HTTP_HOST':'SERVER_NAME';
            $scripturl = isset($_SERVER['SCRIPT_URL'])?$_SERVER['SCRIPT_URL']:$_SERVER['SCRIPT_NAME'];
            $basedir = dirname($_SERVER[$hostvar].$scripturl);
            $https = $_SERVER['SERVER_PORT']!=80
                  && isset($_SERVER['HTTPS'])
                  && strtolower($_SERVER['HTTPS']) == 'on';
            $baseurl = 'http' . ($https?'s':'') . '://' . $basedir;
        }

        // If you have problems with automated base url recognition, you can hardcode it here.
        // The function should return something like
        // $baseurl = "http://localhost/sitebar";

        if ($baseurl{strlen($baseurl)-1} == '/')
        {
            $baseurl = substr($baseurl,0,strlen($baseurl)-1);
        }

        return $baseurl;
    }

    function basedir($override=null)
    {
        static $basedir = null;

        if ($override!==null)
        {
            $basedir = $override;
        }

        if ($basedir === null)
        {
            $basedir = '';
        }

        return $basedir;
    }

    function isMSIE()
    {
        static $isMSIE = null;

        if ($isMSIE === null)
        {
            $isMSIE = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'MSIE');
        }

        return $isMSIE;
    }

    // Exclude Opera
    function isOPERA()
    {
        static $isOPERA = null;

        if ($isOPERA === null)
        {
            $isOPERA = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'Opera');
        }

        return $isOPERA;
    }

    function isGECKO()
    {
        static $isGECKO= null;

        if ($isGECKO=== null)
        {
            $isGECKO = strstr(SB_safeVal($_SERVER,'HTTP_USER_AGENT'), 'Gecko');
        }

        return $isGECKO;
    }

    function dragDropNode($nid)
    {
        if (SB_Page::isOPERA())
        {
            return '';
        }

        return ' '.
            (SB_Page::isMSIE()?'ondragstart':'onmousedown').
            '="return SB_nodeDrag(event,'. $nid .')"'.
            ' onmouseup="return SB_nodeDrop(event,'. $nid .')"';
    }

    function dragDropLink($nid, $lid)
    {
        if (SB_Page::isOPERA())
        {
            return '';
        }

        return ' '.
            (SB_Page::isMSIE()?'ondragstart':'onmousedown').
            '="return SB_linkDrag(event,'. $lid .')"'.
            ' onmouseup="return SB_nodeDrop(event,'. $nid .','. $lid . ')"';
    }

    function toolTip()
    {
        return ' onmouseover="SB_toolTip(this,event)" onmouseout="SB_toolTip(this)" ';
    }

    function target()
    {
        static $trg = null;

        if ($trg === null)
        {
            $target = (SB_Page::isMSIE()||SB_Page::isOPERA()?'_main':'_content');
            if (isset($_REQUEST['target'])) $target = $_REQUEST['target'];
            $trg = ' target="'.$target.'"';
        }
        return $trg;
    }

    function head($title, $bodyClass=null, $script=null, $onLoad=null, $meta=null)
    {
        // Do not change document type!
        // Any newer version would require changes of JavaScript library.
        // media="All" is used to hide the styles from Netscape 4.x

        header('Content-Type: ' . CONTENT_TYPE);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"
    "http://www.w3.org/TR/REC-html40/loose.dtd">

<html>
<head>
    <title>:: <?php echo SB_Page::title()?> :: <?php echo SB_T($title)?></title>
    <meta http-equiv="Content-Type" content="<?php echo CONTENT_TYPE?>">
<?php echo $meta?>
    <link rel="Shortcut Icon" href="<?php echo SB_Skin::path()?>/root_transparent.png">
    <link rel="StyleSheet"    href="<?php echo SB_Skin::path()?>/sitebar.css?version=<?php echo STATIC_VERSION ?>" type="text/css" media="all">
    <link rel="Author"        href="http://brablc.com/">
<?php

    $sortModes = array
    (
        'added'   => 'Recently Added',
        'changed' => 'Recently Modified',
        'visited' => 'Recently Visited',
        'hits'    => 'Most Popular',
        'waiting' => 'Waiting for Visit',
    );

    foreach( $sortModes as $mode => $label)
    {
?>
    <link rel="Alternate"     type="application/rss+xml"
          title="SiteBar Bookmarks [<?php echo $label?>]"
          href="<?php echo SB_Page::baseurl()?>/index.php?w=rss&sort=<?php echo $mode?>&max=20" />
<?php
    }
?>

    <script type="text/javascript" src="<?php echo SB_Page::basedir()?>inc/sitebar.js?version=<?php echo STATIC_VERSION ?>"></script>
    <script type="text/javascript">
        SB_setSkinDir('<?php echo SB_Skin::path()?>');
        <?php echo $script?>
    </script>
</head>
<body class="cmnBaseFont cmnPageBackground <?php echo $bodyClass?>" <?php echo ($onLoad?' onLoad="'.$onLoad.'"':'')?> onmouseup="SB_cancelDragging()">
<?php
    }

    function foot()
    {
?>
</body>
</html>
<?php
    }

    /* static */ function quoteValue($value)
    {
        $q = htmlspecialchars($value);
        return str_replace("\r\n",' ',str_replace("&amp;","&",$q));
    }
}
?>
