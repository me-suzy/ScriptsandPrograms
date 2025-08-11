<?PHP /* $Id$ */
# This file is part of Chatty :)
# Copyright (C) 2003, 2004, 2005 Marco Olivo
#
# Chatty :) is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

include("config.inc.php");

header("Content-Type: text/css");

echo "body { BACKGROUND-COLOR: $lightblue; FONT-FAMILY: tahoma, verdana, arial, helvetica, sans-serif; FONT-SIZE: 10pt; }\r\n";

echo ".talk { BACKGROUND-COLOR: $darkblue; }\r\n";
echo ".chat { BACKGROUND-COLOR: $lightblue; }\r\n";

echo "form, tr, td, ul, ol, p, h1, h2, h3, h4 { COLOR: $black; FONT-FAMILY: tahoma, verdana, arial, helvetica, sans-serif; FONT-SIZE: 10pt; }\r\n";

echo ".bigwhite { COLOR: $white; FONT-SIZE: 10pt; FONT-WEIGHT: bold; }\r\n";
echo ".smallwhite { FONT-SIZE: 8pt; COLOR: $white; }\r\n";

echo ".white { FONT-SIZE: 11pt; FONT-WEIGHT: normal; COLOR: $white; }\r\n";
echo ".notes { FONT-SIZE: 11pt; FONT-WEIGHT: normal; COLOR: $darkyellow; }\r\n";

echo ".highlight { COLOR: $blue; }\r\n";

echo "a.chat:link { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:visited { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:active { COLOR: $white; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";
echo "a.chat:hover { COLOR: $darkyellow; TEXT-DECORATION: underline; FONT-WEIGHT: bold; }\r\n";

echo ".left { TEXT-ALIGN: left; }\r\n";
echo ".center { TEXT-ALIGN: center; }\r\n";
echo ".right { TEXT-ALIGN: right; }\r\n";
?>
