<?php
// Network configuration File August 2004
// Configuration is very easy simply enter true for the functions you would like to be turned on.
// For UNIX or Windows
// Uncomment one of the following only
//
// See www.OOAPPS.com for details.  Copyright 2004.
$UNIX="true";
//$UNIX="false";

// To disable a function simply remove the on value and leave blank
// $DNS_lookup=""; will disable the function. To enable $DNS_lookup="on"

// Resolve DNS
$DNS_lookup="on";
// Query DNS service
$DNS_query="on";
// Whois www database
$WHOis="on";
// Whois IP database
$WHOisIP="on";
// Ping command. Both ping and trace will greatly slow page loading
$PING="off";
// Ping options -c5 will ping 5 times for example
$PING_OPTION="- c2";
// Trace route command recommended disabled as it can be very slow
$TRACE="off";
// Set the options for trace route here note: h is the hop count
$Topt="-h 2";
// Disable the ability to search all
$ALL="off";

// For ip and query logging configuration
// Name of capture file. You can include a path here also
// Capture on or off
$CAPTURE="off";
$filename = 'capturedata.txt';
?>