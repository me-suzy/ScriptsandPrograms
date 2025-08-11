<?php
/******************************************************************************
 *  SiteBar 3 - The Bookmark Server for Personal and Team Use.                *
 *  Copyright (C) 2003-2005  Ondrej Brablc <http://brablc.com/mailto?o>       *
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
 This file is called when selecting "Add Link to SiteBar" or
 "Add Page to SiteBar" menu item in context menu of Internet Explorer.

 SB_Page code by Alexis ISAAC <moi@alexisisaac.net>, link code by Ondrej Brablc
 ******************************************************************************/

?>
<SCRIPT LANGUAGE="JavaScript" defer>
<?php



if ($_GET['add'] == 'page') :
?>
    var tit = external.menuArguments.document.title;
    var url = external.menuArguments.location.href;
<?php
else :
?>
    var obj = external.menuArguments.event.srcElement;
    var tit = obj.innerHTML;
    var url = obj.getAttribute('href');
<?php
endif;
?>
    var cp  = external.menuArguments.document.charset;

    window.open('command.php?command=Add%20Link'+
        '&amp;url='+escape(url)+
        '&amp;name='+escape(tit)+
        '&amp;cp='+cp,
        'sitebar_gCmdWin',
        'resizable=yes,dependent=yes,width=210,height=360,top=200,left=300,titlebar=yes,scrollbars=yes');
    close();
</SCRIPT>
