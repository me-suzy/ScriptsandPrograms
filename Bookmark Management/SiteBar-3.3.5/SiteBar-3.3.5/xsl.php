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

require_once('./inc/errorhandler.inc.php');
require_once('./inc/page.inc.php');

// Handle ; as parameter separator
$params = explode(';',$_GET['p']);

foreach ($params as $param)
{
    list($key, $value) = explode('=',$param);
    $_GET[$key] = $value;
}

SB_safePath($_GET['file']);
$file = $_GET['file'] . '.xsl.php';
$skin = $_GET['skin'];
SB_safePath($skin);

$path = 'skins/'.$skin.'/'.$file;

if (!is_file($path))
{
    $path = 'skins/'.$file;
}

require_once($path);

?>