<?php
session_start();
header("Last-Modified: ".gmdate('D, d M Y H:i:s') . ' GMT');
header("Cache-control: private");
header("Pragma: no-cache");
header("Expires: 0");
require_once "browser_detector.php";
require_once "lang_list.php";
include "../admin/connect.inc";
if( !isset($_SERVER['HTTP_REFERER']) || $_SERVER['HTTP_REFERER'] == "")
    exit();
$resolution = "";
if(!isset($_GET['javascript']))
{
   $_GET['javascript'] = "false";
   $_GET['referrer'] = "Unknown";
   $resolution = "Unknown";
}else{
   if( $_GET['screenwidth'] == "" || $_GET['screenheight'] == "" || $_GET['pixeldepth'] == "" )
       $resolution = "Unknown";
   else
       $resolution = $_GET['screenwidth'] . "x" . $_GET['screenheight'] . ", " . $_GET['pixeldepth'] . "bit";
       if( trim( $_GET['referrer'] ) == "" )
                $_GET['referrer'] = "Direct Hit";
}
$error = "";
$language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$country_flag = "-";
if(strpos($language, ','))
   $language = substr($language, 0, strpos($language, ','));
if(strpos($language, ';'))
   $language = substr($language, 0, strpos($language, ';'));
if(!isset($lang_cty[strtolower($language)]))
{
   $country_flag = "-";
   $cty_name = "Unknown";
}else{
   $country_flag = $lang_cty[strtolower($language)];
   $cty_name = $lang_cty_name[strtolower($language)];
}
$remote_addr = "";
if( getenv("HTTP_X_FORWARDED_FOR"))
    $remote_addr = getenv("HTTP_X_FORWARDED_FOR");
else
    $remote_addr = getenv("REMOTE_ADDR");
    if( $is_search == true)
    {
       $search = '"true";"'.addslashes($search_site).'";"'.addslashes($search_q).'"';
    }else{
       $search = '"false";"";""';
    }
    $remotead = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $thedate = mktime();
    $useragent = addslashes( $_SERVER['HTTP_USER_AGENT']);
    $referrer = addslashes($_GET['referrer']);
    $referrer2= addslashes( $_SERVER['HTTP_REFERER']);
    $jav = $_GET['javascript'];
    @mysql_query( "INSERT INTO CC_stats(resolution,jav,referrer2,referrer,operating_system,web_browser,useragent,remote_addr, remotead, thedate, cty_name, country_flag ) VALUES('$resolution','$jav','$referrer2','$referrer','$operating_system','$web_browser','$useragent','$remote_addr','$remotead', '$thedate', '$cty_name', '$country_flag')" );
    $error_msg .= mysql_error();
    if( isset( $_GET[ 'image' ] ) && $_GET['image'] == 1 )
    {
        header("Content-type: image/gif");
        readfile( 'transparent.gif' );
    }else{
        header("Content-type: text/javascript");
        if( $error != "" )
        {
           ?>
           alert('Avanti Web Stats Error: <?=$error?>');
           <?php
        }
}
?>