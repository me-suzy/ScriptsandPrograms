<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2005  Ondrej Brablc <http://brablc.com/mailto?o>            *
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

$SB_writer_title['mobile'] = 'SiteBar for Mobile Devices';

require_once('./inc/writers/sitebar.inc.php');

/******************************************************************************/

class SB_Writer_mobile extends SB_Writer_sitebar
{
    function SB_Writer_mobile()
    {
        $this->SB_Writer_sitebar();
    }

    function writeMenuItem($index, $id, $command, $link, &$functions, &$allowedACL)
    {
        $div = "\t<div id='$id' class='".
            ($command?'off':'separator')."'".
            ' onmouseover="SB_itemOn(this)"'.
            ' onmouseout="SB_itemOff(this)"';

        if ($command && !$link)
        {
            $div .=
                ' x_acl="'.$allowedACL[$index].'" '.
                ' x_cmd="'.$command.'" ';
        }

        echo $div . '>';

        if ($link)
        {
            $target = SB_Page::target();
            echo '<a class="menuLink" href="'. $link .'"'. $target .'>';
        }

        if (!$link)
        {
            echo '<a href="javascript:SB_itemDoAlt(\'' . $id . '\'' . ($functions[$index]?',\''.$functions[$index].'\'':''). ')">';
        }

        echo SB_T($command);

        echo '</a>';
        echo "</div>\r";
    }

    function run()
    {
        $this->loadOpenNodesOnly = false;;
        $this->um->setParam('user','menu_icon', true);
        parent::run();
    }

    function showChildren(&$node)
    {
        return true;
    }

    function wantLoadChildren(&$node)
    {
        return true;
    }
}
?>
