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

$SB_writer_title['opml_rss'] = 'OPML RSS Type';

require_once('./inc/writers/opml_link.inc.php');

class SB_Writer_opml_rss extends SB_Writer_opml_link
{
    function SB_Writer_opml_rss()
    {
        $this->SB_Writer_opml_link();
    }

    function getNodeAtt(&$node)
    {
        $att = array
        (
            'type' => 'rss',
            'text' => $this->qv($node->name),
            'title' => $this->qv($node->name),
            'description' => $this->qv($node->comment),
        );
        return $att;
    }

    function getLinkAtt(&$node, &$link)
    {
        $att = array
        (
            'type' => 'rss',
            'text' => $this->qv($link->name),
            'title' => $this->qv($link->name),
            'htmlURL' => $this->qv($link->url),
            'description' => $this->qv($link->comment),
        );

        return $att;
    }

    function drawDOCTYPE()
    {
?>
<!DOCTYPE opml [
    <!ENTITY % oplm_plain SYSTEM "http://static.userland.com/gems/radiodiscuss/opmlDtd.txt">
    <!ENTITY % OtherAttributes  "
        title       CDATA #REQUIRED
        htmlURL     CDATA #IMPLIED
        description CDATA #IMPLIED
    ">
    %oplm_plain;
]>
<?php
    }
}
?>
