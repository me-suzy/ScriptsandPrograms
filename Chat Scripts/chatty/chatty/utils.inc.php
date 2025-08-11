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

function do_the_query($db, $query)
{
	$result = mysql_db_query($db, $query) or print("$query<BR>" . "<B>" . mysql_errno() . ": " . mysql_error() . "</B><BR>\r\n<BR>\r\n");
	return $result;
}

/* funzione frontend per generare numeri pseudo-casuali */
function random($max)
{
	srand((double)microtime() * 1000000);
	return rand(1, $max);
}
?>
