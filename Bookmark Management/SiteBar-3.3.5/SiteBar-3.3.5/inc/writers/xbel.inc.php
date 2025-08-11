<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
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
* java dom.Counter uri
*/

$SB_writer_title['xbel'] = 'XBEL Extended';
$SB_writer_default['xbel'] = true;

require_once('./inc/writer.inc.php');

class SB_Writer_xbel extends SB_WriterInterface
{
    function SB_Writer_xbel()
    {
        $this->SB_WriterInterface();
    }

    function getExtension()
    {
        return ".xml";
    }

    function getMetaDataAtt()
    {
        return array('owner' => SB_Page::baseurl());
    }

    function getSkinsPath($file)
    {
        $path = 'skins/'. $file;

        if (is_file(SB_Skin::path().'/'.$file))
        {
            $path = SB_Skin::path().'/'.$file;
        }

        return $path;
    }

    function getXSLPath($file)
    {
        /**
        * The path to URL should use &amp;
        * IE - handles OK
        * Firefox - https://bugzilla.mozilla.org/show_bug.cgi?id=286132
        * Safari - omits parameters after the first
        *
        * Workaround, use ; as parameter delimiter.
        */

        return 'xsl.php?p=;file='.$file.';skin='.SB_Skin::get();
    }

    function drawContentType()
    {
        header('Content-Type: text/xml');
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE xbel PUBLIC
    "+//IDN sitebar.org//DTD XML Bookmark Exchange Language for SiteBar 1.0//EN//XML"
    "http://sitebar.org/xml/xbel-sitebar-1.0.dtd">
<?php
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawDOCTYPE();
        $this->drawTagOpen('xbel',array('version'=>'1.0'));

        $this->drawTag('title', null, $this->qv($this->getTitle()));

        $this->drawTagOpen('info');
        $this->drawTag('metadata', $this->getMetaDataAtt());
        $this->drawTagClose('info');

        if ($this->root)
        {
            $this->drawTag('desc', null, $this->root->comment);
        }
    }

    function getNodeAttMap(&$nodeAtt, &$node)
    {
        $nodeAtt['id'] = 'n' . $node->id;
        $nodeAtt['id_parent'] = 'n' . $node->id_parent;
        $nodeAtt['custom_order'] = $node->custom_order;
        $nodeAtt['order'] = $node->order;
        $nodeAtt['sort_mode'] = $node->sort_mode;

        if ($node->added)
        {
            $nodeAtt['added'] = $this->getDateISO8601($node->added);
            $nodeAtt['visited'] = $this->getDateISO8601($node->visited);
            $nodeAtt['modified'] = $this->getDateISO8601($node->changed);
        }
    }

    function drawNodeOpen(&$node)
    {
        $nodeAtt = array();
        $this->getNodeAttMap($nodeAtt, $node);

        $this->drawTagOpen('folder', $nodeAtt);

        $this->drawTag('title', null, $this->qv($node->name));
        if ($node->comment)
        {
            $this->drawTag('desc',null,$this->qv($node->comment));
        }
    }

    function drawNodeClose(&$node)
    {
        $this->drawTagClose('folder');
    }

    function getLinkAttMap(&$bmkAtt, &$node, &$link)
    {
        $bmkAtt['href'] = $this->qv($link->url);
        $bmkAtt['modified'] = $this->getDateISO8601($link->changed);
        $bmkAtt['visited'] = $this->getDateISO8601($link->visited);
        $bmkAtt['id'] = 'l' . $link->id;
        $bmkAtt['private'] = $link->private;
        $bmkAtt['target'] = $link->target;
        $bmkAtt['added'] = $this->getDateISO8601($link->added);
        $bmkAtt['tested'] = $this->getDateISO8601($link->tested);
        $bmkAtt['hits'] = $link->hits;
        $bmkAtt['is_dead'] = $link->is_dead;
        $bmkAtt['favicon'] = $link->favicon;
        $bmkAtt['validate'] = $link->validate;
        $bmkAtt['order'] = $link->order;

        if ($link->origURL != $link->url)
        {
            $bmkAtt['origin'] = $this->qv($link->origURL);
        }
    }

    function drawLink(&$node, &$link)
    {
        $bmkAtt = array();
        $this->getLinkAttMap($bmkAtt, $node, $link);

        $this->drawTagOpen('bookmark', $bmkAtt);

        $this->drawTag('title',null,$this->qv($link->name));
        if ($link->comment)
        {
            $this->drawTag('desc',null,$this->qv($link->comment));
        }

        $this->drawTagClose('bookmark');
    }

    function drawFoot()
    {
        $this->drawTagClose('xbel');
    }
}
?>
