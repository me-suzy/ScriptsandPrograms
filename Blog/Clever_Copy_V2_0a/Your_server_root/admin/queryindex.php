<?
// This code based on original coding by ooapp web hosting services - http://www.ooapp.com
session_start();
ob_start();
global $Topt;
include "queryindexsettings.php";
if(phpversion() >= "4.2.0"){
   extract($_POST);
   extract($_GET);
   extract($_SERVER);
   extract($_ENV);
}
include "connect.inc";
include "languages/default.php";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
?>
<html>
<head>
<title><?php echo $network_info_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'>";
?>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script>
function m(el) {
if (el.defaultValue==el.value) el.value = ""
}
</script>
</head>
<?php
include "index.php";
echo "<div align='center'>";
echo "<form method='post' action=' $PHP_SELF'>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<TD colspan='2' bgcolor=$getprefs3[block_heading_background_color]><font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]>$network_query_label</TD></TR>";
echo "<tr bgcolor=$getprefs3[block_background_color]>";
echo "<td width='50%' bgcolor=$getprefs3[block_background_color]><b> $host_info_label</b></font><br></td>";
echo "<td bgcolor=$getprefs3[block_background_color]><b> $connect_info_label</b></td></tr>";
echo "<tr valign='top' bgcolor=$getprefs3[block_background_color]><td>";
if($DNS_lookup=="on"){
echo " <input type='radio' name='queryType' value='lookup' class = 'radio'>$ip_resolve_lookup_label<br>";
}
if($DNS_query=="on") {
echo " <input type='radio' name='queryType' value='dig'class = 'radio'>$ww_get_dns_label<br>";}
if($WHOis=="on") {
echo " <input type='radio' name='queryType' value='wwwhois'class = 'radio'>$ww_whois_label<br>";}
if($WHOisIP=="on") {
echo " <input type='radio' name='queryType' value='arin'class = 'radio'>$ip_whois_label</p>";}
echo "</td><td>";
if($PORT="on") {
echo " <input type='radio' name='queryType' value='checkp'class = 'radio'>$port_check_label ";
echo " <input type='text' name='portNum' size='5' maxlength='5' value='80'><br>";
}
if($PING=='on'){
echo "<input type='radio' name='queryType' value='p 'class = 'radio'> $ping_host_label<br> ";}
if($TRACE=="on") {
echo "<input type='radio' name='queryType' value='tr'>$traceroute_host_label<br>";}
if($ALL=="on") {
echo "<input type='radio' name='queryType' value='all' checked>Do it all";}
echo "</td></tr></table><table width='100%' border='0' cellspacing='0' cellpadding='1'>";
echo "<tr bgcolor=$getprefs3[block_background_color]><td colspan='2'>";
echo "<div align='center'> $enter_ipwww_label&nbsp;";
echo "<input type='text' name='target' value='$query' onFocus='m(this)'>&nbsp;";
echo "<input type='submit' name='Submit' value='$query_network_button_label' class = 'buttons'>";
echo "</div></td></tr></table></form></div>";
$ntarget = "";

function log_ip_query(){
}

function message($msg){
include "connect.inc";
echo "$msg</b>";
flush();
}

function lookup($target){
include "languages/default.php";
global $ntarget;
$msg = "$target $resolved_to_label ";
if( eregi("[a-zA-Z]", $target) )
    $ntarget = gethostbyname($target);
else
  $ntarget = gethostbyaddr($target);
$msg .= $ntarget;
message($msg);
}

function dig($target){
global $ntarget;
include "languages/default.php";
message($dns_results_label);
#$target = gethostbyaddr($target);
#if (! eregi("[a-zA-Z]", ($target = gethostbyaddr($target))) )
if( (!eregi("[a-zA-Z]", $target) && (!eregi("[a-zA-Z]", $ntarget))))
  $msg .= $dns_query_error;
else{
  if(!eregi("[a-zA-Z]", $target)) $target = $ntarget;
  if (! $msg .= trim(nl2br(`dig any '$target'`))) #bugfix
    $msg .= $dig_command_error;
  }
$msg .= "</blockquote></p>";

message($msg);
}
function wwwhois($target){
include "languages/default.php";
global $ntarget;
$server = "whois.crsnic.net";
message($ww_whois_results_label);
#Determine which WHOIS server to use for the supplied TLD
if((eregi("\.com\$|\.net\$|\.edu\$", $target)) || (eregi("\.com\$|\.net\$|\.edu\$", $ntarget)))
  $server = "whois.crsnic.net";
else if((eregi("\.info\$", $target)) || (eregi("\.info\$", $ntarget)))
  $server = "whois.afilias.net";
else if((eregi("\.org\$", $target)) || (eregi("\.org\$", $ntarget)))
  $server = "whois.corenic.net";
else if((eregi("\.name\$", $target)) || (eregi("\.name\$", $ntarget)))
  $server = "whois.nic.name";
else if((eregi("\.biz\$", $target)) || (eregi("\.biz\$", $ntarget)))
  $server = "whois.nic.biz";
else if((eregi("\.us\$", $target)) || (eregi("\.us\$", $ntarget)))
  $server = "whois.nic.us";
else if((eregi("\.cc\$", $target)) || (eregi("\.cc\$", $ntarget)))
  $server = "whois.enicregistrar.com";
else if((eregi("\.ws\$", $target)) || (eregi("\.ws\$", $ntarget)))
  $server = "whois.nic.ws";
else{
  $msg .= "$only_support_error .com, .net, .org, .edu, .info, .name, .us, .cc, .ws, .biz.</blockquote>";
  message($msg);
  return;
}

message("$connecting_to_label $server...<br><br>");
if (! $sock = fsockopen($server, 43, $num, $error, 10)){
  unset($sock);
  $msg .= "$time_out_error $server (port 43)";
}
else{
  fputs($sock, "$target\n");
  while (!feof($sock))
    $buffer .= fgets($sock, 10240);
}
 fclose($sock);
 if(! eregi("Whois Server:", $buffer)){
   if(eregi($no_match_error, $buffer))
     message("$not_found_match_error $target<br>");
   else
     message("$multi_matches_error $target:<br>");
 }
 else{
   $buffer = split("\n", $buffer);
   for ($i=0; $i<sizeof($buffer); $i++){
     if (eregi("Whois Server:", $buffer[$i]))
       $buffer = $buffer[$i];
   }
   $nextServer = substr($buffer, 17, (strlen($buffer)-17));
   $nextServer = str_replace("1:Whois Server:", "", trim(rtrim($nextServer)));
   $buffer = "";
      message("$deferred_to_label $nextServer...<br><br>");
   if(! $sock = fsockopen($nextServer, 43, $num, $error, 10)){
     unset($sock);
     $msg .= "$time_out_error $nextServer (port 43)";
   }
   else{
     fputs($sock, "$target\n");
     while (!feof($sock))
       $buffer .= fgets($sock, 10240);
     fclose($sock);
   }
}
$msg .= nl2br($buffer);
$msg .= "";
message($msg);
}

function arin($target){
include "languages/default.php";
$server = "whois.arin.net";
message($ip_whois_results_label);
if (!$target = gethostbyname($target))
  $msg .= $no_ip_for_whois_error;
else{
  message("$connecting_to_label $server...<br><br>");
  if (! $sock = fsockopen($server, 43, $num, $error, 20)){
    unset($sock);
    $msg .= "$time_out_error $server (port 43)";
    }
  else{
    fputs($sock, "$target\n");
    while (!feof($sock))
      $buffer .= fgets($sock, 10240);
    fclose($sock);
    }
   if (eregi("RIPE.NET", $buffer))
     $nextServer = "whois.ripe.net";
   else if (eregi("whois.apnic.net", $buffer))
     $nextServer = "whois.apnic.net";
   else if (eregi("nic.ad.jp", $buffer)){
     $nextServer = "whois.nic.ad.jp";
     #/e suppresses Japanese character output from JPNIC
     $extra = "/e";
     }
   else if (eregi("whois.registro.br", $buffer))
     $nextServer = "whois.registro.br";
   if($nextServer){
     $buffer = "";
     message("$deferred_to_label $nextServer...<br><br>");
     if(! $sock = fsockopen($nextServer, 43, $num, $error, 10)){
       unset($sock);
       $msg .= "$time_out_error $nextServer (port 43)";
       }
     else{
       fputs($sock, "$target$extra\n");
       while (!feof($sock))
         $buffer .= fgets($sock, 10240);
       fclose($sock);
       }
     }
  $buffer = str_replace(" ", "&nbsp;", $buffer);
  $msg .= nl2br($buffer);
  }
$msg .= "";
message($msg);
}

function checkp($target,$portNum){
include "languages/default.php";
message("$checking_port_label $portNum");
if (! $sock = fsockopen($target, $portNum, $num, $error, 5))
  $msg .= "$portNum $port_closed_label";

else{


  $msg .= "$portNum $port_open_label";
  fclose($sock);
  }
$msg .= "";
message($msg);
}

function p($target){
include "languages/default.php";
message($ping_results_label);
$PN="ping ".$PING_OPTION." ".$target;
exec($PN, $result, $rval);
for ($i = 0; $i < count($result); $i++) {
        $png.=$result[$i]."<BR>";
}
if (! $msg .= trim(nl2br($png)))
  $msg .= $ping_fail_error;
$msg .= "";
message($msg);
}

function tr($target,$Topt){
include "languages/default.php";
message($traceroute_results_label);
if ($UNIX="true"){$TR="/usr/sbin/traceroute ".$Topt." ".$target;}
if ($UNIX="false"){$TR="tracert ".$Topt." ".$target;}

exec($TR, $result, $rval);
for ($i = 0; $i < count($result); $i++) {
        $rt.=$result[$i]."<BR>";
}
if (! $msg .= trim(nl2br($rt)))
  $msg .= $traceroute_fail_error;
$msg .= "";
message($msg);
}

if(!$queryType)
  exit;
if( (!$target) || (!preg_match("/^[\w\d\.\-]+\.[\w\d]{1,4}$/i",$target)) ){ #bugfix
  message($target_not_valid_error);
  exit;
  }

if( ($queryType=="all") || ($queryType=="lookup") ){
  if($DNS_lookup=="on")lookup($target);
};
if( ($queryType=="all") || ($queryType=="dig") ){
  if($DNS_query=="on")dig($target);
};
if( ($queryType=="all") || ($queryType=="wwwhois") ){
  if($WHOis=="on")wwwhois($target);
};
if( ($queryType=="all") || ($queryType=="arin") ){
  if($WHOisIP=="on")arin($target);
};
if( ($queryType=="all") || ($queryType=="checkp") ){
 if($PORT=="on")checkp($target,$portNum);
};
if( ($queryType=="all") || ($queryType=="p") ){
        if($PING=="on")p($target);
};
if( ($queryType=="all") || ($queryType=="tr") ){
        if($TRACE=="on")tr($target,$Topt);
};

if ($CAPTURE=="on"){
$filename = 'capturedata.txt';
$fp = fopen($filename, "a");
$string ="Network Query: ".$target."   User IP: ".$_SERVER[REMOTE_ADDR]."\n";
$write = fputs($fp, $string);
fclose($fp);
};
echo "<p align='center'>Copyright 2004 <a href='http://www.ooapp.com'>ooapp</a> web hosting services. Code modification by <a href='http://www.liquidfrog.com'>Liquid Frog</a> for Clever Copy</p>";
}else{
  echo $no_login_error;
  include "index.php";
}
?>