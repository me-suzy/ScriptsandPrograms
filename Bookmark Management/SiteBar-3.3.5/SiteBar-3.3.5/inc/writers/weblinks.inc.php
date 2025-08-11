<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003,2004  Ondrej Brablc <http://brablc.com/mailto?o>       *
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

/******************************************************************************
 Download WebLinks extension from your SiteBar index page
 ******************************************************************************/

$SB_writer_title['weblinks'] = 'WebLinks';

require_once('./inc/writer.inc.php');

class SB_Writer_weblinks extends SB_WriterInterface
{
    var $path = '';

    function SB_Writer_weblinks()
    {
        $this->SB_WriterInterface();
    }

    function fatal($msg, $arg=null)
    {
        die("**05" . parent::fatal($msg, $arg) . "\r");
    }

    function drawHead()
    {
        echo "++00Sucess\r";
    }

    function drawNodeOpen(&$node)
    {
        $this->path = implode('/', $this->nodes);

        $this->write(array
        (
            $this->path,
            'flags',
            $node->name,
        ));
    }

    function drawLink(&$node, &$link)
    {
        $this->path = implode('/', $this->nodes);
        $url = $link->url;

        if (!($url{0}=='j' && strpos($url,'javascript:')!==false) && $this->useHitCounter)
        {
            $url = SB_Page::baseurl().'/go.php?id='.$link->id.'&url='.$link->url;
        }

        $this->write(array
        (
            $this->path.'/'.$link->id,
            'flags',
            $link->name,
            '',
            SB_Page::quoteValue($url),
        ));
    }

    function write($arr)
    {
        $str = implode('|', $arr);
        echo html_entity_decode($str) . "\r";
    }
}

?>
