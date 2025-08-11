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
* Validated using Feed SB_Validator
* http://feedvalidator.org/
*/

$SB_writer_title['rss'] = 'RSS 2.0';

/******************************************************************************
 Original RSS specific code Markus Kniebes <mk@kniebes.net>
 ******************************************************************************/

require_once('./inc/writer.inc.php');

class SB_Writer_rss extends SB_WriterInterface
{
    function SB_Writer_rss()
    {
        $this->SB_WriterInterface();
    }

    function run()
    {
        $this->switches['flat'] = true;
        SB_WriterInterface::run();
    }

    function getExtension()
    {
        return ".xml";
    }

    function drawContentType()
    {
        header('Content-Type: application/xml');
    }

    function drawHead()
    {
        $this->drawXMLPI();

        $this->drawTagOpen('rss', array
        (
            'version' => '2.0',
            'xmlns' => 'http://purl.org/rss/2.0/',
            //'xmlns:dc' => 'http://purl.org/dc/elements/1.1/',
            //'xmlns:content' => 'http://purl.org/rss/1.0/modules/content/',
        ));
        $this->drawTagOpen('channel');
        $this->drawTag('title', null, $this->qv($this->getTitle()));

        $desc = $this->settingsValue('feed_desc').' '.SB_Page::baseurl().'/';
        $this->drawTag('description', null, $this->qv($desc));
        $this->drawTagOpen('image');
        $this->drawTag('title', null, $this->qv($this->getTitle()));
        $this->drawTag('url', null, SB_Page::baseurl() . '/' . SB_Skin::imgsrc('root_transparent'));
        $this->drawTag('link', null, $this->settingsValue('feed_link'));
        $this->drawTagClose('image');

        $this->drawTag('link', null, $this->settingsValue('feed_link'));
        $this->drawTag('managingEditor', null, $this->qv($this->settingsValue('feed_managing_editor')));
        $this->drawTag('webMaster', null, $this->qv($this->settingsValue('feed_webmaster')));
        $this->drawTag('copyright', null, $this->qv($this->settingsValue('feed_copyright')));
        $this->drawTag('language', null, str_replace('_','-',$this->um->getParam('user','lang')));
        $this->drawTag('generator', null, 'SiteBar ' . SB_CURRENT_RELEASE . ' (Bookmark Server; http://sitebar.org)');

        // Time to live in minutes
        $this->drawTag('ttl', null, null, '60');
    }

    function drawLink(&$node, &$link)
    {
        $this->drawTagOpen('item');

        // Show number of hits in name - we want this info!
        if ($this->tree->sortMode == 'hits')
        {
            $link->name = sprintf('%05d - %s', $link->hits, $link->name);
        }

        $this->drawTag('title', null, $this->qv($link->name));
        // $this->drawTag('author', null, null);
        $this->drawTag('link', null, $this->qv($link->url));

        $this->drawTag('description', null, $this->qv($link->comment));
        $date = '';
        $append = '';
        switch ($this->tree->sortMode)
        {
            case 'changed':
                $date = $link->changed;
                $append = '#' . $date;
                break;
            case 'tested':
                $date = $link->tested;
                $append = '#' . $date;
                break;
            case 'hits':
                $append = '#' . $link->hits;
                $date = $link->visited;
                break;
            case 'visited':
                $date = $link->visited;
                $append = '#' . $date;
                break;
            case 'added':
                $date = $link->added;
                break;
            default:
                $date = ($link->added>$link->changed?$link->added:$link->changed);
        }

        $this->drawTag('pubDate', null, $this->getDateRFC822($date));
        $this->drawTag('guid', null, $this->qv($link->origURL) . $append);
        $this->drawTagClose('item');
    }

    function drawFoot()
    {
        $this->drawTagClose('channel');
        $this->drawTagClose('rss');
    }
}
?>
