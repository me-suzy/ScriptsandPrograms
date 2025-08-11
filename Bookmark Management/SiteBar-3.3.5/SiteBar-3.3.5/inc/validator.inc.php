<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003  Ondrej Brablc <http://brablc.com/mailto?o>            *
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
require_once('./inc/tree.inc.php');
require_once('./inc/usermanager.inc.php');
require_once('./inc/pageparser.inc.php');
require_once('./inc/faviconcache.inc.php');

class SB_Validator extends SB_ErrorHandler
{
    var $discoverMissingFavicons;
    var $deleteInvalidFavicons;

    var $fields;
    var $counter = 0;
    var $linkCount = 0;

    var $um;
    var $tree;
    var $db;
    var $fc;

    function SB_Validator()
    {
        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();
        $this->db =& SB_Database::staticInstance();
        $this->fc =& SB_FaviconCache::staticInstance();

        if (!$this->um->setupDone || !$this->um->isLogged())
        {
            echo 'Access denied!';
            die;
        }
    }

    function buildValidate(&$base, &$fields,
        $discoverMissingFavicons,
        $deleteInvalidFavicons)
    {
        $this->fields =& $fields;

        $this->discoverMissingFavicons = $discoverMissingFavicons;
        $this->deleteInvalidFavicons = $deleteInvalidFavicons;
        $this->buildValidateChildren( $base, 0);
    }

    function buildValidateChildren(&$base, $level=0)
    {
        foreach ($base->getChildren() as $child)
        {
            if ($child->type_flag=='n')
            {
                $this->buildValidateNode($child, $level+1);
            }
            else
            {
                $this->buildValidateLink($child, $level+1);
            }
        }
    }

    function buildValidateNode($node, $level)
    {
        $this->fields['-raw'.$this->counter++] =
            '<table><tr><th>'.$node->name.'</th></tr></table>';
        $this->buildValidateChildren($node, $level);
    }

    function buildValidateLink($link, $level)
    {
        if ( substr($link->url,0,4)!='http' || !$link->validate)
        {
            return;
        }

        $validationIconSrc = 'validate.php?id=' . $link->id . '&amp;uniq=' . SB_StopWatch::getMicroTime();

        if (strlen($link->favicon)
        &&  $this->deleteInvalidFavicons
        &&  !$this->fc->isFaviconCached($link->favicon))
        {
            $this->tree->updateLink($link->id, array('favicon'=>''), false);
        }

        if ($this->discoverMissingFavicons)
        {
            $validationIconSrc .= '&amp;get_favicon=1';
        }

        $url = SB_Page::quoteValue($link->url);
        $name = SB_Page::quoteValue($link->name);

        $this->linkCount++;

        $this->fields["-raw".$this->counter++] = <<<__LINK
<div class="link">
    <img class="favicon" src="$validationIconSrc" alt="">
    <a href="$url">$name</a>
</div>
__LINK;

    }

    function validate($lid, $getFavicon)
    {
        if (!$this->um->isAuthorized('Validation', false, null, null, $lid))
        {
            echo 'Access denied!';
            die;
        }

        $link = $this->tree->getLink($lid);

        // Mark as dead
        $set = array ('tested'=> array('now'=>''), 'is_dead' => 1);
        $this->tree->updateLink($link->id, $set, false);

        $page = new SB_PageParser( $link->url);
        $page->getInformation( $getFavicon?array('FAVURL'):null);

        // Unmark early if not dead
        $set['is_dead'] = intval($page->isDead);
        $this->tree->updateLink($link->id, $set, false);

        $location = SB_Skin::imgsrc('link');

        if ($page->isDead)
        {
            $location = SB_Skin::imgsrc('link_wrong_favicon');
        }
        else
        {
            $set = array();

            if (isset($page->info['FAVURL']))
            {
                $favicon = $page->info['FAVURL'];
                $set['favicon'] = $favicon;

                if ($this->um->getParam('config','use_favicon_cache'))
                {
                    $location = 'favicon.php?' . md5($favicon) . '=' . $link->id;
                }
                else
                {
                    $location = $favicon;
                }
            }
            else if ($getFavicon)
            {
                $set['favicon'] = '';
            }

            if (isset($set['favicon']))
            {
                $this->tree->updateLink($link->id, $set, false);
            }
        }

        header('Location: ' . $location);
        exit;
    }
}
