<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005  Ondrej Brablc <http://brablc.com/mailto?o>            *
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

require_once('./inc/usermanager.inc.php');
require_once('./inc/tree.inc.php');
require_once('./inc/faviconcache.inc.php');

class SB_SanityCheck
{
    var $um;
    var $tree;
    var $db;
    var $checked = array();

    function SB_SanityCheck()
    {
        $this->um =& SB_UserManager::staticInstance();
        $this->tree =& SB_Tree::staticInstance();
        $this->db =& SB_Database::staticInstance();

        if (!$this->um->isLogged() || !$this->um->isAdmin())
        {
//            die ("Access denied!");
        }
    }

    function run()
    {
        $doall = isset($_GET['do_all']) || !count($_GET);

        if ($doall || isset($_GET['do_orphans']))
        {
            $this->orphans();
        }
        if ($doall || isset($_GET['do_aclorphans']))
        {
            $this->aclorphans();
        }
        if ($doall || isset($_GET['do_icons']))
        {
            $this->convertBinaryIcons();
        }
    }

    function orphans()
    {
        echo "Fetch ids of all links in database ...<br>";

        $rset = $this->db->select('DISTINCT nid', 'sitebar_link');

        echo "Traverse recursive all nodes and check<br>";
        echo "  - whether the parent node exists,<br>";
        echo "  - whether the node without parent is the root,<br>";
        echo "  - whether there is a user for the node.<br>";

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $this->checkNode($rec['nid']);
        }
    }

    function aclorphans()
    {
        echo "Fetch ids of all acl nodes in database ...<br>";

        $rset = $this->db->select('DISTINCT nid', 'sitebar_acl');

        echo "Traverse recursive all nodes and check<br>";
        echo "  - whether the parent node exists,<br>";
        echo "  - whether the node without parent is the root,<br>";
        echo "  - whether there is a user for the node.<br>";

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            $this->checkNodeACL($rec['nid']);
        }
    }

    function convertBinaryIcons()
    {
        echo "Convert binary icons ...<br>";

        $rset = $this->db->select('*', 'sitebar_link', "favicon LIKE 'data:image%'");

        $fc = & SB_FaviconCache::staticInstance();

        $converted = 0;

        foreach ($this->db->fetchRecords($rset) as $rec)
        {
            if (preg_match("/^data:image\/(.*?);base64,(.*)$/", $rec['favicon'], $reg))
            {
                $update = array
                (
                    'favicon'=>$fc->saveFaviconBase64($reg[2]),
                );

                $this->tree->updateLink($rec['lid'], $update);
                $converted++;
            }
        }

        echo "Converted $converted favicons.<br>";
    }

    function checkNode($nid)
    {
        if (isset($this->checked[$nid]))
        {
            return true;
        }

        $this->checked[$nid]++;

        $rset = $this->db->select('*', 'sitebar_node', array('nid'=>$nid));
        $rec = $this->db->fetchRecord($rset);

        if (is_array($rec))
        {
            if ($rec['nid_parent']==0)
            {
                echo "Root: " . $rec['name'] . "<br>";
                $rset = $this->db->select('*', 'sitebar_root', array('nid'=>$nid));
                $root = $this->db->fetchRecord($rset);

                if (is_array($root))
                {
                    $rset = $this->db->select('*', 'sitebar_user', array('uid'=>$root['uid']));
                    $user = $this->db->fetchRecord($rset);

                    if (is_array($user))
                    {
                        echo "User: " . $user['name'] . '[' . $user['email'] . ']<br>';
                    }
                    else
                    {
                        echo "!!! Orfan<br>";
                    }
                }
                else
                {
                    echo "!!! Invisible<br>";
                }
                return true;
            }

            if ($rec['nid'] == $rec['nid_parent'])
            {
                echo "!!! Recursive parent!<br>";
            }

            return $this->checkNode($rec['nid_parent']);
        }

        echo "!!! Missing parent<br>";
        return false;
    }

    function checkNodeACL($nid)
    {
        $rset = $this->db->select('*', 'sitebar_node', array('nid'=>$nid));
        $rec = $this->db->fetchRecord($rset);

        if (!is_array($rec))
        {
            echo "!!! Missing node: " . $nid . "<br>";
        }
    }
}

$sc = new SB_SanityCheck();
$sc->run()

?>
