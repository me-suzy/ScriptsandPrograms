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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['sitebar'] = 'SiteBar Tree Default';

require_once('./inc/writer.inc.php');
require_once('./inc/page.inc.php');

/******************************************************************************/

class SB_Writer_sitebar extends SB_WriterInterface
{
    var $linkMenu;
    var $nodeMenu;
    var $userMenu;
    var $um;
    var $tree;
    var $hook;
    var $expandedNodes;
    var $treearr = array();

    var $iconnect;
    var $iempty;
    var $ijoin;
    var $ijoinl;
    var $ilink;
    var $ilinkp;
    var $nmenu = null;
    var $lmenu = null;

    var $sortMode;
    var $useHitCounter = false;
    var $useToolTips = false;
    var $showACL;

    var $linkCount = 0;
    var $nodeCount = 0;
    var $loadOpenNodesOnly = false;

    function SB_Writer_sitebar()
    {
        $this->SB_WriterInterface();
    }

    function setOutputHandler()
    {
        // If we want to use compression and it is not used yet
        if ($this->um->getParam('config','use_compression')
        &&  !@ini_get('zlib.output_compression'))
        {
            ob_start('ob_gzhandler');
        }
    }

    function allowAnonymous()
    {
        return true;
    }

    function run()
    {
        $this->loadOpenNodesOnly = $this->um->getParam('user','load_open_nodes_only');

        $this->expandedNodes = $this->getExpandedNodes('SB3NODES');

        if (SB_safeVal($_REQUEST,'reload') == 'all')
        {
            // Temporarily disable hiding of folders
            $this->um->hiddenFolders = array();
            $this->loadOpenNodesOnly = false;
        }
        else
        {
            // Collapsed nodes will not load child nodes
            if ($this->loadOpenNodesOnly)
            {
                $this->tree->expandedNodes =& $this->expandedNodes;
            }
        }

        $this->nodeMenu = array
        (
            'Add Link:*i',
            'Add Folder:*i',
            'Browse Folder:*::index.php?w=dir&root=cookie',
            'Show All Links:*::index.php?w=dir&flat=1&root=cookie',
            'Show Link News:*::news.php?root=cookie',
            '',
            'Hide Folder:*:SB_nodeHide',
            'Unhide Subfolders:*',
            'Folder Properties:*u',
            'Delete Folder:*d',
            'Purge Folder:p',
            'Undelete:pi',
            '',
            'Copy:*:SB_nodeCopy',
            'Paste:*i_c',
            '',
            'Import Bookmarks:*i',
            'Export Bookmarks:*',
            'Security:*',
        );

        $this->linkMenu = array
        (
            'Email Link',
            'Copy Link::SB_linkCopy',
            'Delete Link:d',
            '',
            'Properties:u',
        );

        if ($this->um->setupDone)
        {
            $this->userMenu = array
            (
                'Log In',
                'Sign Up',
                'User Settings',
                'Session Settings',
                'Verify Email',
                'Membership',
                '',
                'SiteBar Settings',
                'Maintain Trees',
                'Maintain Users',
                'Maintain Groups',
                '',
                'Open Integrator:::integrator.php',
                'Show Link News:::news.php',
                '',
                'Contact Admin',
                'Help',
                'Log Out',
            );
        }
        else
        {
            $this->userMenu = array
            (
                'Set Up',
                'Help',
            );
        }

        // Check if we have additional commands
        foreach ($this->um->plugins as $plugin)
        {
            if (isset($plugin['context']) && $plugin['context'])
            {
                $execute = $plugin['prefix'] . 'Context';
                $execute($this->nodeMenu, $this->linkMenu, $this->userMenu);
            }
        }

        $this->iconnect = SB_Skin::img('connect');
        $this->iempty   = SB_Skin::img('empty');
        $this->ijoin    = SB_Skin::img('join');
        $this->ijoinl   = SB_Skin::img('join_last');
        $this->ilink    = SB_Skin::img('link');
        $this->ilinkp   = SB_Skin::img('link_private');

        if ($this->um->getParam('user','menu_icon'))
        {
            $this->lmenu = '<span class="menu" onclick="return SB_menuOn(event,this.parentNode);">' .
                SB_Skin::img('menu') . '</span>';
            $this->nmenu = '<span class="menu" onclick="return SB_menuOn(event,this.parentNode.parentNode.parentNode);">' .
                SB_Skin::img('menu') . '</span>';
        }

        $this->sortMode = $this->um->getParam('user','link_sort_mode');
        $this->useHitCounter = $this->um->getParam('config','use_hit_counter');
        $this->useToolTips = $this->um->getParam('user','use_tooltips');
        $this->showACL = $this->um->getParam('user','show_acl');

        if (!$this->useHitCounter)
        {
            if (!in_array($this->sortMode,array('abc','changed')))
            {
                $this->sortMode = 'abc';
            }
        }

        $this->setOutputHandler();
        parent::run();
    }

    function getExpandedNodes($cookieName)
    {
        $states = null;
        $nodes = array();

        if (isset($_COOKIE[$cookieName]))
        {
            $states = explode(':', $_COOKIE[$cookieName]);

            // Remove last element that is either marker ! or possibly incomplete
            array_pop($states);

            while ($node = array_pop($states))
            {
                $nodes[substr($node,1)] = $node{0};
            }
        }

        if ($this->switches['root'])
        {
            $nodes[$this->switches['root']] = 'Y';
        }

        $states = '';
        foreach ($nodes as $node => $val)
        {
            if ($val == 'Y')
            {
                $states .= $val.$node.':';
            }
        }

        $this->um->setCookie($cookieName, $states.'!');

        return $nodes;
    }

    function writeMenu($type, $items)
    {
        $prev = '';
        $allowedItems = array();
        $allowedACL = array();
        $functions = array();
        $links = array();

        foreach ($items as $command)
        {
            $parts = explode(':', $command);
            $command = array_shift($parts);
            $acl = array_shift($parts);
            $function = array_shift($parts);
            $link = array_shift($parts);

            if (($command && !$this->um->isAuthorized($command))
            ||  (!$command && !$prev))
            {
                continue;
            }
            $allowedItems[]=$command;
            $allowedACL[]=$acl;
            $functions[]=$function;
            $links[]=$link;
            $prev = $command;
        }

?>
    <div id='<?php echo $type?>CtxMenu' class='menu'>
<?php
        for ($i=0; $i<count($allowedItems); $i++)
        {
            $command = $allowedItems[$i];
            $link = $links[$i];

            if (!$command && $i==count($allowedItems)-1)
            {
                continue;
            }

            $this->writeMenuItem(
                $i,
                $type . "Item$i",
                $command,
                $link,
                $functions,
                $allowedACL);


            $prev = $command;
        }
?>
    </div>
<?php
    }

    function writeMenuItem($index, $id, $command, $link, &$functions, &$allowedACL)
    {
        $div = "\t<div id='$id' class='".
            ($command?'off':'separator')."'".
            ' onmouseover="SB_itemOn(this)"'.
            ' onmouseout="SB_itemOff(this)"';

        if ($command && !$link)
        {
            $div .=
                ' onclick="SB_itemDo(this'.($functions[$index]?',\''.$functions[$index].'\'':''). ')"'.
                ' x_acl="'.$allowedACL[$index].'" '.
                ' x_cmd="'.$command.'" ';
        }

        echo $div . '>';

        if ($link)
        {
            $target = SB_Page::target();
            echo '<a class="menuLink" href="'. $link .'"'. $target .'>';
        }

        echo SB_T($command);

        if ($link)
        {
            echo '</a>';
        }

        echo "</div>\r";
    }

    function getExtension()
    {
        return ".html";
    }

    function showChildren(&$node)
    {
        return SB_safeVal($this->expandedNodes,$node->id) == 'Y';
    }

    function wantLoadChildren(&$node)
    {
        return !$this->loadOpenNodesOnly || $this->showChildren($node);
    }

    function drawContentType()
    {
        header('Content-Type: ' . CONTENT_TYPE);
    }

    function drawHeadPage()
    {
        $extern = $this->um->getParam('user','extern_commander')?'0':'1';
        $defaultSearch = $this->um->getParam('user','default_search');
        $inPlaceCmds = implode("','", $this->um->inPlaceCommands());

        SB_Page::head(
            null,
            null,
            "SB_initPage($extern,'$defaultSearch', new Array('$inPlaceCmds'))",
            "SB_onLoad()");
    }

    function drawHeadLogo()
    {
        require_once(SB_Skin::path().'/hook.inc.php');
        $this->hook = new SB_Hook();

        if ($this->um->getParam('config','show_logo'))
        {
            // Include skin hook file
            $this->hook->head();
        }
    }

    function drawToolBar()
    {
        // There must not be any place between the images, therefore
        // those funny tag endings.

        $coloring = 'onmousedown="SB_buttonDown(this)" ' .
                    'onmouseup="SB_buttonUp(this)" ' .
                    'onmouseover="SB_buttonOver(this)'.($this->useToolTips?';SB_toolTip(this,event)':'').'" '.
                    'onmouseout="SB_buttonOut(this)'.($this->useToolTips?';SB_toolTip(this)':'').'"';

        $title = ($this->useToolTips?'x_title':'title')
?>
<div id="toolbar" class="cmnSubTitle">
    <div id="tlbSearch">
        <input id="fldSearch" class="cmnPageBackground" type="text"
               onkeyup="SB_storeSearch(this); if (event && event.keyCode==13) SB_filter();"
               value="<?php echo SB_safeVal($_COOKIE, 'SB3SEARCH') ?>"
       ><img id="btnFilter" src="<?php echo SB_Skin::imgsrc('filter')?>"
             <?php echo $title ?>="<?php echo SB_T('Filter Loaded Bookmarks')?>"
             onclick="SB_filter(true)" <?php echo $coloring?> alt="F"
       <?php if (!$this->um->getParam('user','hide_xslt') || $this->um->getParam('user','use_search_engine')) :?>><a href="search.php" <?php echo SB_Page::target(); ?>
            ><img id="btnSearch" src="<?php echo SB_Skin::imgsrc('search')?>"
             <?php echo $title ?>="<?php echo SB_T('Backend Bookmark Search')?>"
             <?php echo $coloring?> alt="S"></a
       <?php endif;?>
       <?php if ($this->um->getParam('user','use_search_engine')) :?>><a href="search.php?web=1" <?php echo SB_Page::target(); ?>
            ><img id="btnSearchWeb" src="<?php echo $this->um->getParamB64('user','search_engine_ico') ?>"
             <?php echo $title ?>="<?php echo SB_T('Search Web')?>"
             <?php echo $coloring?> alt="SW"></a
       <?php endif;?>
       >
    </div>
    <div id="tlbOther">
        <img id="btnCollapse" src="<?php echo SB_Skin::imgsrc('collapse')?>"
             <?php echo $title ?>="<?php echo SB_T('Collapse/Expand All')?>"
             onclick="SB_collapseAll()" <?php echo $coloring?> alt="-"
       ><?php if ($this->um->getParam('user','use_hiding')) : ?><img id="btnReloadAll" src="<?php echo SB_Skin::imgsrc('reload_all')?>"
             <?php echo $title ?>="<?php echo SB_T('Reload with Hidden Folders')?>"
             onclick="SB_reloadAll()" <?php echo $coloring?> alt="R+"
       ><?php endif;?><img id="btnReload" src="<?php echo SB_Skin::imgsrc('reload')?>"
             <?php echo $title ?>="<?php echo SB_T('Reload')?>"
             onclick="SB_reloadPage()" <?php echo $coloring?> alt="R"
       >
    </div>
</div>
<?php
        $msgFile = "./inc/message.inc.php";
        if (is_file($msgFile))
        {
            include($msgFile);
        }
    }

    function drawWarning()
    {
        $show = 0;
        $message = '';

        if ($this->um->getParam('config', 'users_must_verify_email')
        &&  !$this->um->isAnonymous()
        &&  !$this->um->demo
        &&  !$this->um->verified
        )
        {
            if ($show)
            {
                $message .= "<p>";
            }

            $show++;

            $message = SB_P("sitebar::users_must_verify_email");
        }

        if ($show)
        {
?>
    <div id="warning">
        <?php echo $message ?>
    </div>
<?php
        }
    }

    function drawHead()
    {
        $this->drawHeadPage();
        if ($this->useToolTips)
        {
?>
<div id="toolTip"></div>
<?php
        }
        $this->writeMenu('node', $this->nodeMenu);
        $this->writeMenu('link', $this->linkMenu);
        $this->drawHeadLogo();

        // Optimization for MSIE to keep images in the cache
        if (SB_Page::isMSIE())
        {
            $images = array
            (
                'collapse',
                'connect',
                'empty',
                'filter',
                'join',
                'join_last',
                'link',
                'link_private',
                'menu',
                'minus',
                'minus_last',
                'node',
                'node_open',
                'plus',
                'plus_last',
                'reload',
                'reload_all',
                'root',
                'root_deleted',
                'root_plus'
            );

            echo "<div style='display: none'>";

            foreach ($images as $image)
            {
                echo SB_Skin::img($image);
            }

            echo "</div>";
        }

        $this->drawToolBar();
        $this->drawWarning();
    }

    function drawNodeOpen(&$node, $last=false)
    {
        $showChildren = $this->showChildren($node);

        foreach ($node->getACL() as $right => $value)
        {
            if (!$value) continue;
            list($pulp, $name) = explode('_',$right);
            $node->aclstr .= $name{0};
        }

        if ($node->isRoot)
        {
            echo '<div class="tree">'."\r";
        }

        $nodename = 'n' . $node->id;

        /* Init images */
        $inode      = SB_Skin::img('node', 'n', $nodename);
        $inodeo     = SB_Skin::img('node_open', 'n', $nodename);
        $iplus      = SB_Skin::img('plus', 's', $nodename);
        $iplusl     = SB_Skin::img('plus_last', 's', $nodename);
        $iminus     = SB_Skin::img('minus', 's', $nodename);
        $iminusl    = SB_Skin::img('minus_last', 's', $nodename);

        $onclick = 'SB_node(event,this.parentNode)';

        if ($this->loadOpenNodesOnly)
        {
            $onclick = 'SB_nodeReload(event,this.parentNode)';
        }

        echo '<div id="' . $nodename . '"'.
             ' class="node"'.
             ' x_level="' . $node->level . '"'.
             ' x_acl="'. $node->aclstr . ($node->deleted_by?'':'*') .'"'.
             '><span'.
             ' onclick="'.$onclick.'"'.
             ' oncontextmenu="return SB_menuOn(event,this.parentNode)">';

        $this->nodeCount++;

        $hasChildren = $node->childrenCount() || (!$showChildren && $this->loadOpenNodesOnly);

        if (!$node->isRoot)
        {
            if ($hasChildren==0)
            {
                $iplus   = $this->ijoin;
                $iplusl  = $this->ijoinl;
                $iminus  = $this->ijoin;
                $iminusl = $this->ijoinl;
            }
            echo implode('',$this->treearr) .
                ($last?($showChildren?$iminusl:$iplusl)
                      :($showChildren?$iminus :$iplus));

            array_push($this->treearr,($last?$this->iempty:$this->iconnect));
        }
        else
        {
            if ($node->deleted_by==null)
            {
                $inodeo = SB_Skin::img('root', 'n', $nodename, 'root');
                if ($hasChildren==0)
                {
                    $inode  = $inodeo;
                }
                else
                {
                    $inode  = SB_Skin::img('root_plus', 'n', $nodename, 'root');
                }
            }
            else
            {
                $inode  = SB_Skin::img('root_deleted', 'n', $nodename, 'root');
                $inodeo = $inode;
            }
        }

        echo '<a id="a'.$nodename.'" href="javascript:void('.$node->id.')"'.
             ($this->showACL && $node->hasACL()?' class="acl"':'') .
             ($this->useToolTips?SB_Page::toolTip():'').
             ($node->comment?' '.($this->useToolTips?'x_':'').'title="'. SB_Page::quoteValue($node->comment) . '"':'') .
             ($this->um->getParam('user','menu_icon')?'':SB_Page::dragDropNode($node->id)).
             '>'.
             ($showChildren?$inodeo:$inode) .
             $this->nmenu .
             SB_Page::quoteValue($node->name) .
             "</a></span>\r".

             '<div id="c'. $nodename.'" '.
             ' class="children'. ($showChildren?'Expanded':'Collapsed') .'">'."\r";
    }

    function drawNodeClose(&$node)
    {
        echo "</div>\r";
        echo "</div>\r";

        if ($node->isRoot)
        {
            echo "</div>\r";
        }
        else
        {
            array_pop($this->treearr);
        }
    }

    function drawChildren(&$node)
    {
        if ($this->switches['flat'])
        {
            echo '<div class="root tree">'."\r";
        }

        $ret = parent::drawChildren($node);

        if ($this->switches['flat'])
        {
            echo "</div>\r";
        }

        return $ret;
    }

    function drawLink(&$node, &$link, $last=false)
    {
        $linkname = 'l' . $link->id;

        echo '<div class="link" id="' . $linkname . '"'.
             ' onclick="return SB_lnk(event,this)"'.
             ' oncontextmenu="return SB_menuOn(event,this)"'.
             ' x_acl="'.$node->aclstr.'"'.
             '>'."\r";

        $ifavicon = '';

        if ($link->favicon && $this->um->getParam('user','use_favicons'))
        {
            if ($link->favicon && $this->um->getParam('config','use_favicon_cache'))
            {
                $favurl = SB_Page::basedir() . 'favicon.php?';

                if (substr($link->favicon,0,7) == 'binary:')
                {
                    $favurl .= $link->favicon;
                }
                else
                {
                    $favurl .= md5($link->favicon) . '=' . $link->id;
                }

                $link->favicon = $favurl;
            }

            $ifavicon ='<img class="favicon" alt="" src="'.$link->favicon.'"'.
                   ' onerror="this.src=\''.SB_Skin::imgsrc("link_wrong_favicon").'\'">';
        }
        else
        {
            $ifavicon = $link->private?$this->ilinkp:$this->ilink;
        }

        if (!$this->switches['flat'])
        {
            echo implode("",$this->treearr) . ($last?$this->ijoinl:$this->ijoin);
        }

        $target = '';

        if ($link->target)
        {
            $target = ' target="'.$link->target.'"';
        }
        else
        {
            if (!$link->ignoreHits)
            {
                $target = ($link->target?$link->target:SB_Page::target());
            }
        }

        $sort_info = '';

        if (strlen($link->sort_info))
        {
            $sort_info = '<span class="sort_info">' . $link->sort_info . '&nbsp;</span>';
        }

        $class = '';

        if ($link->private)
        {
            $class .= ' private';
        }
        if ($link->is_dead)
        {
            $class .= ' dead';
        }

        $toolTip = ($link->comment?substr($link->comment,0,255).(strlen($link->comment)>255?'...':''):$link->origURL);

        echo ($this->lmenu?$ifavicon.$this->lmenu.$sort_info:'') .
             '<a id="a'. $linkname .'" '. ($this->useToolTips?'x_':'').'title="'. SB_Page::quoteValue($toolTip) . '" '.
             ($class?" class=\"$class\"":'') .
             ' href="' . SB_Page::quoteValue($link->url) . '"'.
             ($this->useToolTips?SB_Page::toolTip():'').
             $target.
             (!$this->switches['flat']?SB_Page::dragDropLink($link->id_parent,$link->id):'').
             '>'.
             ($this->lmenu?'':$ifavicon.$sort_info). SB_Page::quoteValue($link->name) . '</a></div>'."\r";

        $this->linkCount++;
    }

    function drawFoot()
    {
        $this->writeMenu('user', $this->userMenu);

        $this->sw->stop();

        $stat = array();

        if ($this->um->getParam('config','show_statistics')
        && (!$this->um->isAnonymous() || $this->um->getParam('config','allow_sign_up')))
        {
            $stat = array
            (
                'links_shown' => $this->linkCount,
                'nodes_shown' => $this->nodeCount,
                'queries' => $this->um->db->count,
                'time_db' => number_format($this->um->db->sw->elapsed,2),
                'time_total' => number_format($this->sw->elapsed,2),
                'time_pct' => intval($this->um->db->sw->elapsed/$this->sw->elapsed*100),
            );

            $this->um->statistics($stat);
            $this->tree->statistics($stat);
        }

        $this->hook->foot($this->um->config['release'],$stat);

        $sponsor = new SB_SponsorInterface($this->hook);
        $file = './inc/sponsor.inc.php';
        if (is_file($file))
        {
            include_once($file);
            $sponsor = new SB_Sponsor($this->hook);
        }

?>
    <div id="sponsorSitebarBottom"><?php $sponsor->sitebarBottom(); ?></div>
<?php


        if ($this->hasErrors())
        {
            // Cannot be defined by skin
            echo "<div style='margin-top: 50px; color:yellow; background: red;'>";
            $this->writeErrors();
            echo "</div>";
        }

        SB_Page::foot();
    }
}
?>
