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

$SB_writer_title['firefox'] = 'Firefox Live Bookmarks';

require_once('./inc/writers/netscape.inc.php');

class SB_Writer_firefox extends SB_Writer_netscape
{
    function SB_Writer_firefox()
    {
        $this->SB_Writer_netscape();
    }

    function drawNodeOpen(&$node)
    {
        $filler = str_repeat("\t", $node->level);

        $added = ($node->added?strtotime($node->added):mktime());
        $feedname = $node->name;

        // If we have subfolders
        if ($node->nodeCount())
        {
            echo $filler . '<DT><H3 ADD_DATE="' . $added . '">' . $node->name . "</H3>\r";
            if ($node->comment)
            {
                echo $filler. '<DD>' . $node->comment . "\r";
            }
            echo $filler . "<DL><p>\r";
            $filler = str_repeat("\t", $node->level+1);
            $feedname = '@'. SB_T('Content');
        }

        // Do we have some content
        if ($node->linkCount())
        {
            $url = SB_Page::baseurl() . '/index.php?w=rss&sd=0&root='.$node->id;

            if ($this->switches['hits'])
            {
                $url .= '&hits=1';
            }

            echo $filler . '<DT><A HREF="'. SB_Page::baseurl() .'/index.php"'.
                                 ' ADD_DATE="' . $added . '"'.
                                 ' FEEDURL="'. $url .'">'. $feedname ."</A>\r";
        }
    }

    function drawLink(&$node, &$link)
    {
    }

    function drawNodeClose(&$node)
    {
        if ( $node->nodeCount() )
        {
            $filler = str_repeat("\t", $node->level);
            echo $filler . "</DL><p>\r";
        }
    }
}
?>
