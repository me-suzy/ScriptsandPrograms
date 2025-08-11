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

/******************************************************************************
 Download PHP Layers Menu from http://phplayersmenu.sf.net
 ******************************************************************************/

$SB_writer_title['phplm'] = 'PHP Layers Menu';

require_once('./inc/writer.inc.php');

class SB_Writer_phplm extends SB_WriterInterface
{
    var $path = '';

    function SB_Writer_phplm()
    {
        $this->SB_WriterInterface();
    }

    function fatal($text)
    {
        die(".|".$text);
    }

    function drawNodeOpen(&$node)
    {
        if ($node->level==1 && $this->switches['root'])
        {
            return;
        }

        $this->path = implode('/', $this->nodes);

        $this->write(array
        (
            str_repeat('.',$node->level-1),
            $node->name,
            null,
            $node->comment
        ));
    }

    function drawLink(&$node, &$link)
    {
        $this->path = implode('/', $this->nodes);
        $comment = preg_replace("/[\n\r]/m",' ',$link->comment);

        if ($link->favicon
        &&  $this->um->getParam('user','use_favicons')
        &&  $this->um->getParam('config','use_favicon_cache'))
        {
            $link->favicon = SB_Page::baseurl(). '/favicon.php?' . md5($link->favicon) . '=' . $link->id;
        }

        $this->write(array
        (
            str_repeat('.',$node->level),
            $link->name,
            SB_Page::quoteValue($link->url),
            $comment,
            $link->favicon,
        ));
    }

    function write($arr)
    {
        $str = implode('|', $arr);
        echo $str . "\r";
    }
}

?>
