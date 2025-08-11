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

/**
* Validated using dom.Counter of Xerces-J
* http://xml.apache.org/xerces2-j/index.html
*/

$SB_writer_title['opml_link'] = 'OPML Link Type';

require_once('./inc/writer.inc.php');

class SB_Writer_opml_link extends SB_WriterInterface
{
    function SB_Writer_opml_link()
    {
        $this->SB_WriterInterface();
    }

    function getNodeAtt(&$node)
    {
        $att = array
        (
            'text' => $this->qv($node->name),
        );
        return $att;
    }

    function getLinkAtt(&$node, &$link)
    {
        $att = array
        (
            'type' => 'link',
            'text' => $this->qv($link->name),
            'url'  => $this->qv($link->url),
        );

        return $att;
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE opml [
    <!ENTITY % oplm_plain SYSTEM "http://static.userland.com/gems/radiodiscuss/opmlDtd.txt">
    <!ENTITY % OtherAttributes  "url CDATA #IMPLIED">
    %oplm_plain;
]>
<?php
    }

    /* Common functions for OPML */

    function getExtension()
    {
        return ".opml";
    }

    function drawContentType()
    {
        header('Content-Type: text/xml');
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawDOCTYPE();
        $this->drawTagOpen('opml',array('version'=>'1.0'));

        $this->drawTagOpen('head');
        $this->drawTag('title', null, $this->qv($this->getTitle()));

        if ($this->settingsValue('feed_owner_name'))
        {
            $this->drawTag('ownerName', null, $this->qv($this->settingsValue('feed_owner_name')));
        }

        if ($this->settingsValue('feed_owner_email'))
        {
            $this->drawTag('ownerEmail', null, $this->qv($this->settingsValue('feed_owner_email')));
        }
        $this->drawTagClose('head');
        $this->drawTagOpen('body');
    }

    function drawNodeOpen(&$node)
    {
        $this->drawTagOpen('outline', $this->getNodeAtt($node));
    }

    function drawNodeClose(&$node)
    {
        $this->drawTagClose('outline');
    }

    function drawLink(&$node, &$link)
    {
        $this->drawTag('outline', $this->getLinkAtt($node, $link));
    }

    function drawFoot()
    {
        $this->drawTagClose('body');
        $this->drawTagClose('opml');
    }
}
?>
