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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['news'] = 'SiteBar Link News [XBEL]';
$SB_writer_hidden['news'] = true;

require_once('./inc/writers/dir.inc.php');

class SB_Writer_news extends SB_Writer_dir
{
    var $wantLoad = true;

    function SB_Writer_news()
    {
        $this->SB_Writer_dir();
        $this->switches['flat'] = 1;
    }

    function drawXMLPI()
    {
        SB_Writer_xbel::drawXMLPI();

        echo '<?xml-stylesheet'.
             ' href="'. $this->getXSLPath('xbel2news') .'"'.
             ' type="text/xsl"?>' . "\r";
    }

    function getShortTitle()
    {
        $name = '';

        if ($this->switches['root'])
        {
            // We have only one root in this case but placed in a fake root
            $node = $this->tree->getNode($this->switches['root']);
            $name = $node->name;
        }
        else
        {
            $name = 'SiteBar';
        }

        return sprintf(SB_T('%s Link News'), $name);
    }

    function load()
    {
        SB_WriterInterface::load();
        $this->wantLoad = false;

        $newroot = new SB_Tree_Node(array());
        $this->addSorted($newroot, 'hits');
        $this->addSorted($newroot, 'visited');
        $this->addSorted($newroot, 'added');
        $this->addSorted($newroot, 'changed');
        $this->root = $newroot;
    }

    function addSorted(&$root, $sortMode)
    {
        $this->sortLinks($sortMode);
        $sub = new SB_Tree_Node(array
        (
            'name'=>SB_T($this->tree->sortModeLabel[$sortMode]),
            'nid'=>$sortMode,
        ));
        foreach ($this->root->getLinksSlice(10) as $link)
        {
            $sub->addLink($link);
        }
        $root->addNode($sub);
    }

    function wantLoadChildren(&$node)
    {
        return $this->wantLoad;
    }

    function getMetaDataAtt()
    {
        $att = parent::getMetaDataAtt();
        $att['style'] = $this->getSkinsPath('news.css');
        return $att;
    }
}
?>
