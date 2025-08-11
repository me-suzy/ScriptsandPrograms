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

$SB_writer_title['netscape'] = 'Netscape Bookmark File';

require_once('./inc/writer.inc.php');

class SB_Writer_netscape extends SB_WriterInterface
{
    function SB_Writer_netscape()
    {
        $this->SB_WriterInterface();
    }

    function getExtension()
    {
        return ".html";
    }

    function drawContentType()
    {
        header('Content-Type: text/html; charset=' . $this->charSet);
    }

    function drawHead()
    {
?>
<!DOCTYPE NETSCAPE-Bookmark-file-1>
<!-- This is an automatically generated file.
     It will be read and overwritten.
     DO NOT EDIT! -->
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=<?php echo strtoupper($this->charSet)?>">
<TITLE>Bookmarks</TITLE>
<H1>Bookmarks</H1>

<DL><p>
<?php
    }

    function drawNodeOpen(&$node)
    {
        $filler = str_repeat("\t", $node->level);

        $added = ($node->added?strtotime($node->added):mktime());

        echo $filler . '<DT><H3 ADD_DATE="' . $added . '">' . $node->name . "</H3>\r";

        if ($node->comment)
        {
            echo $filler. '<DD>' . $node->comment . "\r";
        }
        echo $filler . "<DL><p>\r";
    }

    function drawNodeClose(&$node)
    {
        $filler = str_repeat("\t", $node->level);
        echo $filler . "</DL><p>\r";
    }

    function drawLink(&$node, &$link)
    {
        $filler = str_repeat("\t", $node->level);

        echo $filler . '<DT><A'.
             ' HREF="' . $link->url . '"'.
             ' ADD_DATE="' . strtotime($link->added) . '"' .
             ' LAST_VISIT="' . strtotime($link->visited) . '"' .
             ' LAST_MODIFIED="' . strtotime($link->changed) . '"' .
             ($link->favicon?' ICON="'. $link->favicon . '"':'') .
             '>' . $link->name . "</A>\r";

        if ($link->comment)
        {
           echo $filler.'<DD>'.$link->comment."\r";
        }
    }
}
?>
