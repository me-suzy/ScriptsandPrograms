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

$SB_loader_title['rss'] = 'RSS 2.0';

class SB_Loader_rss extends SB_LoaderInterface
{
    function SB_Loader_rss($useEngine=true, $charSet=null)
    {
        $this->SB_LoaderInterface($useEngine, $charSet);
    }

    function getNodeTag()
    {
        return 'channel';
    }

    function getLinkTag()
    {
        return 'item';
    }

    function createNode($xmlTag)
    {
        $attributes = array();

        foreach ($xmlTag['children'] as $index => $value)
        {
            switch ($value['tag'])
            {
                case 'title':
                    $attributes['name'] = $value['value'];
                    break;
            }
        }

        return new SB_Tree_Node($attributes);
    }

    function createLink($xmlTag)
    {
        $attributes = array();

        foreach ($xmlTag['children'] as $index => $value)
        {
            switch ($value['tag'])
            {
                case 'title':
                    $attributes['name'] = $value['value'];
                    break;

                case 'link':
                    $attributes['url'] = $value['value'];
                    break;
            }
        }

        return new SB_Tree_Link($attributes);
    }
}
