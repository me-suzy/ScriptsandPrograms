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

$SB_writer_title['opera'] = 'Opera Hotlist 2.0';

require_once('./inc/writer.inc.php');

class SB_Writer_opera extends SB_WriterInterface
{
    function SB_Writer_opera()
    {
        $this->SB_WriterInterface();
    }

    function getExtension()
    {
        return ".adr";
    }

    function drawHead()
    {
        echo "Opera Hotlist version 2.0\r";
        echo "Options: encoding = " . $this->charSet . ", version=3\r\r";
    }

    function drawNodeOpen(&$node)
    {
        echo "#FOLDER\r";
        echo "\tNAME=".$node->name."\r";
        if ($node->comment)
        {
            echo "\tDESCRIPTION=".$node->comment."\r";
        }
        echo "\r";
    }

    function drawNodeClose(&$node)
    {
        echo "-\r\r";
    }

    function drawLink(&$node, &$link)
    {
        echo "#URL\r";
        echo "\tNAME=".$link->name."\r";
        echo "\tURL=".$link->url."\r";
        if ($link->comment)
        {
            echo "\tDESCRIPTION=".$link->comment."\r";
        }
        echo "\r";
    }
}
?>
