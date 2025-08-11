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

$SB_loader_title['opera'] = 'Opera Hotlist 2.0';

class SB_Loader_opera extends SB_LoaderInterface
{
    var $lines;

    function SB_Loader_opera($useEngine=true, $charSet=null)
    {
        $this->SB_LoaderInterface($useEngine, $charSet);
    }

    function load(&$lines, &$root)
    {
        $this->lines =& $lines;
        return $this->loadOpera($root);
    }

    function stripBinaryData(&$value)
    {
        return preg_replace('/\x02\x02/',"\n", $value);
    }

    function loadOpera(&$parent)
    {
        while (($line = array_shift($this->lines))!==null)
        {
            $line = $this->toUTF8($line);
            // Open node
            if ($line == "#FOLDER")
            {
                $rec = array();
                while ($line != "")
                {
                    $line = trim(array_shift($this->lines));
                    $parts = explode('=',$line,2);

                    if (count($parts)>1)
                    {
                        list($name,$value) = $parts;
                        if ($name=='NAME')
                        {
                            $rec['name'] = $value;
                        }
                        if ($name=='DESCRIPTION')
                        {
                            $rec['comment'] = $this->stripBinaryData($value);
                        }
                    }
                    else
                    {
                        break;
                    }
                }
                $node = new SB_Tree_Node($rec);

                // Yes recursive!
                $this->loadOpera($node);
                $parent->addNode($node);
                $this->importedFolders++;
                continue;
            }

            // Add link to current node
            if ($line == "#URL")
            {
                $rec = array();
                while ($line != "")
                {
                    $line = trim(array_shift($this->lines));
                    $parts = explode('=',$line,2);

                    if (count($parts)>1)
                    {
                        list($name,$value) = $parts;

                        if ($name=='NAME')
                        {
                            $rec['name'] = $value;
                        }
                        if ($name=='URL')
                        {
                            $rec['url'] = $value;
                        }
                        if ($name=='DESCRIPTION')
                        {
                            $rec['comment'] = $this->stripBinaryData($value);
                        }
                    }
                    else
                    {
                        break;
                    }
                }
                if (isset($rec['url']))
                {
                    $parent->addLink(new SB_Tree_Link($rec));
                    $this->importedLinks++;
                }
                continue;
            }

            // Close node - break recursion
            if ($line == "-")
            {
                return true;
            }
        }
        return true;
    }
}
?>
