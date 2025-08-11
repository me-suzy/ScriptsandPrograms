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

$SB_loader_title['opml_link'] = 'OPML Link Type';

class SB_Loader_opml_link extends SB_LoaderInterface
{
    function SB_Loader_opml_link($useEngine=true, $charSet=null)
    {
        $this->SB_LoaderInterface($useEngine, $charSet);
    }

    function getAttributeMap()
    {
        static $map = array
        (
            'node' => array
            (
                'text' => 'name',
            ),
            'link' => array
            (
                'text' => 'name',
                'url'  => 'url',
            ),
        );

        return $map;
    }

    function createNode($xmlTag)
    {
        if (isset($xmlTag['attributes']['type']))
        {
            return null;
        }

        return parent::createNode(array('tag'=>'node', 'attributes'=>$xmlTag['attributes']));
    }

    function createLink($xmlTag)
    {
        return parent::createLink(array('tag'=>'link', 'attributes'=>$xmlTag['attributes']));
    }

    function getNodeTag()
    {
        return 'outline';
    }

    function getLinkTag()
    {
        return 'outline';
    }
}
