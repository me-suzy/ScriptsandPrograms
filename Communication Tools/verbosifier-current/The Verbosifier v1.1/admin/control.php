<?php
# Verbosifier v1.1: http://www.desiquintans.com/verbosifier
# The Verbosifier is free under version 2 or later of the GPL.
# This program is distributed with cursory support, but without
# warranty or guarantee of any sort.

## How many shouts should the Verbosifier display?
define('SHOUT_QTY', 10);

## In what format should the time and date be displayed? Consult documentation/date.txt for codes.
define('SHOUT_DATE', 'Y-m-d');

## Do you want the Verbosifier to keep all entries (enter 'yes'), or keep only as many entries as it displays (enter 'no')?
define('SHOUTS_RETAINED', 'no');

## What name should be given to anonymous shouters?
define('ANONYMOUS', 'Anonymous');

## Set your mySQL details:
$DB_USER = 'username';          // Username
$DB_PASS = 'password';          // Password
$DB_HOST = 'localhost';         // mySQL hostname (usually 'localhost')
$DB_NAME = 'databasename';      // Name of database to store information in

## Name the mySQL table the Verbosifier will create and use for storing entries (change only the second quoted value):
define('VERBOSE_TBL', 'verbosifier_entries');

## Remove the double slashes from the start of the line below to disable all non-fatal error reporting. Recommended for security.
//error_reporting(1);


## This marks the end of what you need to edit. Don't edit below this line.
mysql_connect ($DB_HOST, $DB_USER, $DB_PASS) or die ('Couldn\'t connect to mySQL: '.mysql_error());
mysql_select_db ($DB_NAME) or die ('Couldn\'t select the database: '.mysql_error());
unset($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
?>