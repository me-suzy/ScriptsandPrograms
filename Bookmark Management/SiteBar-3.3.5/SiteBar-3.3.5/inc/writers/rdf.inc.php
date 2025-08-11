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
* Validated using W3C RDF Validation Service
* http://www.w3.org/RDF/SB_Validator/
* Gives warning for ID without namespace.
*/

/******************************************************************************
 RDF specific code Kam Chiu LEUNG <mxeon@users.sourceforge.net>
 Download Mozilla/Firefox extension from http://mozlinker.sourceforge.net
 ******************************************************************************/

$SB_writer_title['rdf'] = 'RDF/RSS';

require_once('./inc/writer.inc.php');

class SB_Writer_rdf extends SB_WriterInterface
{
    function SB_Writer_rdf()
    {
        $this->SB_WriterInterface();
    }

    function getExtension()
    {
        return ".xml";
    }

    function drawContentType()
    {
        header('Content-Type: text/rdf');
    }

    function drawHead()
    {
        $this->drawXMLPI();
        $this->drawTagOpen('rdf:RDF', array
        (
            'xmlns:rdf' => 'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
            'xmlns:rss' => 'http://purl.org/rss/1.0/',
            'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
        ));

        $this->drawTagOpen('rdf:Description', array
        (
            'rdf:about' => $this->settingsValue('feed_link'),
        ));

        $this->drawTag("dc:title", null, $this->qv($this->getTitle()));

        $this->drawTagClose('rdf:Description');

        if (!$this->switches['root'])
        {
            $this->drawTagOpen('rdf:Seq', array
            (
                'ID' => 'n0',
                'rss:title' => $this->qv($this->getTitle()),
            ));
        }
    }

    function drawNodeOpen(&$node)
    {
        $this->drawTagOpen('rdf:li');
        $this->drawTagOpen('rdf:Seq', array
        (
            'ID' => 'n'.$node->id,
            'rss:title' => $this->qv($node->name),
        ));
    }

    function drawNodeClose(&$node)
    {
        $this->drawTagClose('rdf:Seq');
        $this->drawTagClose('rdf:li');
    }

    function drawLink(&$node, &$link)
    {
        $this->drawTagOpen('rdf:li');
        $this->drawTag('rss:item', array
        (
            'rss:title' => $this->qv($link->name),
            'rss:link' => $this->qv($link->url),
        ));
        $this->drawTagClose('rdf:li');
    }

    function drawFoot()
    {
        if (!$this->switches['root'])
        {
            $this->drawTagClose('rdf:Seq');
        }
        $this->drawTagClose('rdf:RDF');
    }
}
?>
