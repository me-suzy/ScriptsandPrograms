<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004  Ondrej Brablc <http://brablc.com/mailto?o>            *
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

require_once('./inc/tree.inc.php');
require_once('./inc/usermanager.inc.php');

$tree = SB_Tree::staticInstance();
$link = $tree->getLink(isset($_GET['sblid'])?$_GET['sblid']:$_GET['id']);

if ($link)
{
    $node = $tree->getNode($link->id_parent);
    $acl =& $node->getACL();

    // Count anyway
    $tree->countVisit($link);

    $url = $_GET['url'];

    if ($acl && $acl['allow_select'])
    {
        $url = $link->url;
    }

    $url = str_replace('%SEARCH%', SB_safeVal($_COOKIE,'SB3SEARCH'), $url);
    header('Location: '. $url );
}
else
{
    print 'Link not found!';
}
?>
