<?php
##########################################################################
#  Please refer to the README file for licensing and contact information.
# 
#  This file has been updated for version 0.6.20050131 
# 
#  If you like this application, do support me in its development 
#  by sending any contributions at www.calendarix.com.
#
#
#  Copyright © 2002-2005 Vincent Hor
##########################################################################

############################################################################
#
# database connection 

$db = 'calendarix';
$dbuser = 'webcalendar';
$dbpass = 'webcalendar';
$dbhost = 'localhost';

mysql_connect($dbhost,$dbuser,$dbpass) or die("could not connect");
mysql_select_db("$db") or die("could not open database");

############################################################################
#
# Table definitions

$EVENTS_TB = 'calendar_events' ;
$USER_TB = 'calendar_users' ;
$CAT_TB = 'calendar_cat' ;
$PARAM_TB = 'calendar_param' ;

?>