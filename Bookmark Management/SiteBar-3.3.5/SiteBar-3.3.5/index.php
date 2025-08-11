<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2004-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
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

SB_handleRootCookie();

if (@!include_once('./inc/config.inc.php'))
{
    header('Location: config.php');
    exit;
}

require_once('./inc/writer.inc.php');

$writer = SB_reqChk('w')?SB_reqVal('w'):'sitebar';

if (strstr($writer,'xbel2'))
{
    $writer = 'dir';
}

if ($writer && !strstr($writer,'.'))
{
    $writerFile = './inc/writers/'.$writer.'.inc.php';
    if (is_file($writerFile))
    {
        require_once($writerFile);
        eval('$writerObj = new SB_Writer_'. $writer .'();');

        if (SB_reqChk('sort'))
        {
            $sortMode = SB_reqVal('sort');

            if ( !($sortMode == 'custom' || $sortMode==''))
            {
                if ($sortMode == 'user')
                {
                    $um =& SB_UserManager::staticInstance();
                    $sortMode = $um->getParam('user', 'link_sort_mode');
                }

                $writerObj->tree->sortMode = $sortMode;
            }
        }

        if (SB_reqChk('mix'))
        {
            $writerObj->um->setParam('user','mix_mode',SB_reqVal('mix'));
        }

        if (SB_reqChk('sd') && SB_reqVal('sd')==0)
        {
            $writerObj->tree->maxLevel = 0;
        }

        foreach ($writerObj->switches as $key => $value)
        {
            if (SB_reqChk($key) && strlen(SB_reqVal($key)))
            {
                $writerObj->switches[$key] = SB_reqVal($key);
            }
        }

        if (SB_reqChk('cp'))
        {
            $writerObj->setCharset(SB_reqVal('cp'));
        }

        $writerObj->run();
        exit;
    }
}

header("Content-type: text/html");
echo "Unknown SiteBar writer was selected!";

if (SB_ErrorHandler::hasErrors())
{
    SB_ErrorHandler::writeErrors();
}

?>
