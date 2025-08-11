<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.0 Beta		   				     //          
//		Released February 2, 2004		     				 //
//		Copyright (c) 2004 By the X7 Group	    			 //
//		Website: http://www.x7chat.com		     			 //
//							   							     //
//		This program is free software.  You may	     		 //
//		modify and/or redistribute it under the	    		 //
//		terms of the included license as written    		 //
//		and published by the X7 Group.		    			 //
//							   							     //
//		By using this software you agree to the	    		 //
//		terms and conditions set forth in the	    		 //
//		enclosed file "license.txt".  If you did     		 //
//		not recieve the file "license.txt" please    	     //
//		visist our website and obtain an official    		 // 
//		copy of X7 Chat.		           				     //
//							    							 //
//		Removing this copyright and/or any other    		 //
//		X7 Group or X7 chat copyright from any	    		 //
//		of the files included in this distribution  		 //
//		is forbidden and doing so will terminate    		 //
//		your right to use this software.	     			 //
//							     							 //
///////////////////////////////////////////////////////////////

?>
<?
$isbase = "set";
require("config.php");
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>X7 Chat - Admin Panel</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="The X7 Group">
<meta http-equiv="content-language" content="en">
<META NAME="copyright" content="2003 By The X7 Group">
<META NAME="rating" content="general">
</head>
<body bgcolor="<?=$CS['WIN_BG1']?>" text="<?=$CS['FONTLT']?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>">
<?
$accessd = 1;
if(!isset($action)){
$action = "";
}
if(($action == "settings1" || $action == "settings2") && $PERMISSIONS['Edit_Settings'] == 0)
	$accessd = 0;

if(($action == "styles1" || $action == "styles2") && $PERMISSIONS['Edit_Styles'] == 0)
	$accessd = 0;

if(($action == "permissions" || $action == "editpermissions") && $PERMISSIONS['Edit_Permissions'] == 0)
	$accessd = 0;
	
if(($action == "manageusers" || $action == "editusers") && $PERMISSIONS['Edit_Users'] == 0)
	$accessd = 0;
	
if(($action == "managerooms" || $action == "editrooms") && $PERMISSIONS['Edit_Room'] == 0)
	$accessd = 0;
	
if(($action == "ban" || $action == "doban") && $PERMISSIONS['Server_Ban'] == 0)
	$accessd = 0;
	
if($action == "editusers" && $subaction == "ban" && ($PERMISSIONS['Edit_Users'] == 0 || $PERMISSIONS['Server_Ban'] == 0))
	$accessd = 0;
	
if(($action == "smilies" || $action == "editsmilies") && $PERMISSIONS['Edit_Smilies'] == 0)
	$accessd = 0;
	
if(($action == "filter" || $action == "editfilter") && $PERMISSIONS['Edit_Filter'] == 0)
	$accessd = 0;
	
if(($action == "bandwidth" || $action == "editbandwidth") && $PERMISSIONS['Edit_Bandwidth'] == 0)
	$accessd = 0;

$temp = $PERMISSIONS['Edit_Settings']+$PERMISSIONS['Edit_Styles']+$PERMISSIONS['Edit_Permissions']+$PERMISSIONS['Edit_Users']+$PERMISSIONS['Edit_Room']+$PERMISSIONS['Server_Ban']+$PERMISSIONS['Edit_Filter']+$PERMISSIONS['Edit_Smilies']+$PERMISSIONS['Edit_Bandwidth'];
if($temp == 0)
	$accessd = 0;

if($accessd != 1){
$prebody = "";
$body = $txt[387];
$head = $txt[2];
}else{
$prebody = "<a href=\"index.php\">$txt[313]</a> ";

if($PERMISSIONS['Edit_Settings'] == 1)
 	$prebody .= "| <a href=\"admin.php?action=settings1\">$txt[296]</a> ";
if($PERMISSIONS['Edit_Styles'] == 1)	
	$prebody .= "| <a href=\"admin.php?action=styles1\">$txt[288]</a> ";
 if($PERMISSIONS['Edit_Smilies'] == 1)
	$prebody .= "| <a href=\"admin.php?action=smilies\">$txt[314]</a> ";
 if($PERMISSIONS['Edit_Filter'] == 1)
	$prebody .= "| <a href=\"admin.php?action=filter\">$txt[328]</a> ";
if($PERMISSIONS['Edit_Permissions'] == 1)
	$prebody .= "| <a href=\"admin.php?action=permissions\">$txt[315]</a> ";
if($PERMISSIONS['Edit_Users'] == 1)
	$prebody .= "| <a href=\"admin.php?action=manageusers\">$txt[316]</a> ";
if($PERMISSIONS['Edit_Room'] == 1)
	$prebody .= "| <a href=\"admin.php?action=managerooms\">$txt[317]</a> ";
if($PERMISSIONS['Server_Ban'] == 1)
	$prebody .= "| <a href=\"admin.php?action=ban\">$txt[99]</a> ";
if($PERMISSIONS['Edit_Bandwidth'] == 1)
	$prebody .= "| <a href=\"admin.php?action=bandwidth\">$txt[428]</a>";
		
	$prebody .= "<Br><Br>";
if($action == ""){
$head = "Admin Panel";

// News From Us getter section, to disable see file: x7cread.php
include("./x7cread.php");
$special = get_news();

if(!is_array($special)){
	$special = $txt[318];
}else{
	$rspecial = "";
	foreach($special as $key=>$val){
		$rspecial .= "
				<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
					<tr>
						<td width=\"50\" height=\"50\" rowspan=\"2\"><img src=\"$val[icon]\" width=\"50\" height=\"50\"></td>
						<td width=\"300\" height=\"25\"><font size=\"4\"><b>$val[title]</b></font></td>
					</tr>
					<Tr>
						<td width=\"300\" height=\"25\">By $val[author] on $val[date]</td>
					</tr>
					<tr>
						<td width=\"350\" colspan=\"2\">$val[body]</td>
					</tr>
				</table>
				<Br><Br>
			";
	}
}

$special = $rspecial;

$body = "<font size=6>$txt[107]</font><br>$special";
}elseif($action == "settings1"){
$head = $txt[296];
if($SERVER['ENABLE_CHAT'] == 1){
$ENABLE_CHAT = "CHECKED";
}else{
$ENABLE_CHAT = "";
}
if($SERVER['ENABLE_REG'] == 1){
$ENABLE_REG = "CHECKED";
}else{
$ENABLE_REG = "";
}
if($SERVER['ENABLE_NEWROOM'] == 1){
$ENABLE_NR = "CHECKED";
}else{
$ENABLE_NR = "";
}
if($SERVER['ENABLE_PRIVATENR'] == 1){
$ENABLE_PRIVATENR = "CHECKED";
}else{
$ENABLE_PRIVATENR = "";
}
if($SERVER['ENABLE_AVAS'] == 1){
$ENABLE_AVAS = "CHECKED";
}else{
$ENABLE_AVAS = "";
}
if($SERVER['ENABLE_SOUNDS'] == 1){
$ENABLE_SOUNDS = "CHECKED";
}else{
$ENABLE_SOUNDS = "";
}
$EXP_ROOM = "value=\"$SERVER[EXP_ROOMS]\"";
$EXP_USER = "value=\"$SERVER[EXP_USER]\"";
$EXP_MSG = "value=\"$SERVER[EXP_MSG]\"";
$MAX_USERS_ROOM = "value=\"$SERVER[MAX_IN_ROOM]\"";
$MAX_USERS_TOTAL = "value=\"$SERVER[MAX_USERS]\"";
$MAX_ROOMS = "value=\"$SERVER[MAX_ROOMS]\"";
$EXP_ONLINE = "value=\"$SERVER[MAX_IDLE]\"";
$FLOOD = "value=\"$SERVER[MAX_MPS]\"";
if($SERVER['NEWS'] != "")
	$news = " value=\"$SERVER[NEWS]\"";
else
	$news = " value=\"\"";
$MAXLOG = $SERVER['MAXLOG']/1024;
$DEFBAND = $SERVER['DEFAULT_BAND_LIMIT']/1024/1024;
$body = "
<form action=\"admin.php?action=settings2\" method=\"post\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[108]<Br>
<font size=\"2\">$txt[109]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disablechat\" value=\"1\" $ENABLE_CHAT></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[110]<Br>
<font size=\"2\">$txt[111]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disablereg\" value=\"1\" $ENABLE_REG></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[116]<Br>
<font size=\"2\">$txt[117]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disableavas\" value=\"1\" $ENABLE_AVAS></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[118]<Br>
<font size=\"2\">$txt[119]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"roomexpires\" $EXP_ROOM></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[120]<Br>
<font size=\"2\">$txt[121]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"userexpires\" $EXP_USER></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[122]<Br>
<font size=\"2\">$txt[123]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"messageexpires\" $EXP_MSG></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[124]<Br>
<font size=\"2\">$txt[125]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxinroom\" $MAX_USERS_ROOM></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[126]<Br>
<font size=\"2\">$txt[127]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxtotal\" $MAX_USERS_TOTAL></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[128]<Br>
<font size=\"2\">$txt[129]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxrooms\" $MAX_ROOMS></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[130]<Br>
<font size=\"2\">$txt[131]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"onlinetime\" $EXP_ONLINE></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[132]<Br>
<font size=\"2\">$txt[133]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"pps\" $FLOOD></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[343]<Br>
<font size=\"2\">$txt[344]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"sounds\" value=\"1\" $ENABLE_SOUNDS></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[415]<Br>
<font size=\"2\">$txt[416]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"news\"$news></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[421]<Br>
<font size=\"2\">$txt[422]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"maxlog\" value=\"$MAXLOG\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[425]<Br>
<font size=\"2\">$txt[426]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"defband\" value=\"$DEFBAND\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[449]<Br>
<font size=\"2\">$txt[450]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"offset\" value=\"$SERVER[SERVER_OFFSET]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\"><div align=\"right\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></div></td>
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
</tr>
</table>
</tr>
</td>
</table>";
}elseif($action == "settings2"){

// Preparser
$maxlog = $maxlog*1024;		// We need to store this answer as bytes no kilobytes
$defband = $defband*1024*1024;

if(!isset($sounds)){
$sounds = "";
}
if(!isset($disablechat)){
$disablechat = "";
}
if(!isset($disablereg)){
$disablereg = "";
}
if(!isset($disableavas)){
$disableavas = "";
}

DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$sounds' WHERE name='ed_sounds'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disablechat' WHERE name='ed_chat'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disablereg' WHERE name='ed_registration'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disableavas' WHERE name='ed_avatars'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$roomexpires' WHERE name='exp_room'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$userexpires' WHERE name='exp_user'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$messageexpires' WHERE name='exp_msg'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$maxinroom' WHERE name='max_inrooms'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$maxrooms' WHERE name='max_rooms'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$maxtotal' WHERE name='max_total'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$onlinetime' WHERE name='max_idletime'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$pps' WHERE name='max_mps'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$news' WHERE name='news'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$maxlog' WHERE name='maxlog'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$defband' WHERE name='defband'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$offset' WHERE name='serveroffset'");
$head = $txt[296];
$body = $txt[62];

}elseif($action == "styles1"){
$head = $txt[288];
$WINBG1 = "value=\"$GOT[style_winbg1]\"";
$WINBG2 = "value=\"$GOT[style_winbg2]\"";
$CS1 = "value=\"$CS[1]\"";
$CS2 = "value=\"$CS[2]\"";
$CS3 = "value=\"$CS[3]\"";
$CHATBG = "value=\"$CS[CHATBG]\"";
$LFONT = "value=\"$CS[FONTLT]\"";
$DFONT = "value=\"$CS[FONTDK]\"";
$DEFFONT = "value=\"$CS[FONTDT]\"";
$bgimage = $CS['BGIMAGE'];
if($STYLE['ENABLE_LINK'] == 1){
$ENABLE_LINKS = "CHECKED";
}else{
$ENABLE_LINKS = "";
}
if($STYLE['ENABLE_STYLE'] == 1){
$ENABLE_STYLES = "CHECKED";
}else{
$ENABLE_STYLES = "";
}
if($STYLE['ENABLE_SMILE'] == 1){
$ENABLE_SMILES = "CHECKED";
}else{
$ENABLE_SMILES = "";
}
$body = "<form action=\"admin.php?action=styles2\" method=\"post\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[135]<Br>
<font size=\"2\">$txt[136]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"winbg1\" $WINBG1></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[137]<Br>
<font size=\"2\">$txt[138]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"winbg2\" $WINBG2></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[139]<Br>
<font size=\"2\">$txt[140]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"cs1\" $CS1></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[141]<Br>
<font size=\"2\">$txt[142]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"cs2\" $CS2></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[143]<Br>
<font size=\"2\">$txt[144]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"cs3\" $CS3></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[145]<Br>
<font size=\"2\">$txt[146]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"chatbg\" $CHATBG></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[147]<Br>
<font size=\"2\">$txt[148]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"lfont\" $LFONT></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[149]<Br>
<font size=\"2\">$txt[150]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"dfont\" $DFONT></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[151]<Br>
<font size=\"2\">$txt[152]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"deffont\" $DEFFONT></td>
</tr>

<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[443]<Br>
<font size=\"2\">$txt[444]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"sysmsg\" value=\"$CS[SYSMSG]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[445]<Br>
<font size=\"2\">$txt[446]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"yourname\" value=\"$CS[YOURNAME]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[447]<Br>
<font size=\"2\">$txt[448]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"othernames\" value=\"$CS[OTHERNAME]\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[153]<Br>
<font size=\"2\">$txt[154]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disablelinks\" value=\"1\" $ENABLE_LINKS></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[155]<Br>
<font size=\"2\">$txt[156]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disablestyle\" value=\"1\" $ENABLE_STYLES></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[157]<Br>
<font size=\"2\">$txt[158]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"disablesmile\" value=\"1\" $ENABLE_SMILES></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[413]<Br>
<font size=\"2\">$txt[414]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"text\" name=\"bgimage\" value=\"$bgimage\"></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\"><div align=\"right\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></div></td>
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
</tr>
</table>
</tr>
</td>
</table>";

}elseif($action == "styles2"){
$head = $txt[288];
$body = $txt[319];

if(!isset($disablelinks)){
$disablelinks = "";
}
if(!isset($disablestyle)){
$disablestyle = "";
}
if(!isset($disablesmile)){
$disablesmile = "";
}

DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$winbg1' WHERE name='style_winbg1'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$winbg2' WHERE name='style_winbg2'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$cs1' WHERE name='style_cs1'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$cs2' WHERE name='style_cs3'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$cs3' WHERE name='style_cs2'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$chatbg' WHERE name='style_msgboxbg'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$lfont' WHERE name='style_ltfont'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$dfont' WHERE name='style_dkfont'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$deffont' WHERE name='style_deffont'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disablelinks' WHERE name='ed_links'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disablestyle' WHERE name='ed_style'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$disablesmile' WHERE name='ed_smile'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$bgimage' WHERE name='bgimage'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$sysmsg' WHERE name='style_sysmsg'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$othernames' WHERE name='style_otherusers'");
DoQuery("UPDATE $SERVER[TBL_PREFIX]settings SET value='$yourname' WHERE name='style_youruser'");

}elseif($action == "smilies"){
$head = $txt[314];
$body = "$txt[321]<Br><Br>";
$body .= "<div align=\"center\"><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<Tr>
<td width=\"100\"><b>$txt[322]</b></td>
<td width=\"100\"><b>$txt[314]</b></td>
<td width=\"300\"><b>$txt[323]</b></td>
</tr>";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]filter WHERE type=1");
while($row = Do_Fetch_Row($q)){
$row[3] = eregi_replace("\.\./","./",$row[3]);

$row[2] = eregi_replace('\\\\',"",$row[2]);

$body .= "
<Tr>
<td width=\"100\"><b>$row[2]</b></td>
<td width=\"100\"><b><img src=\"$row[3]\" alt=\"$row[3]\"></b></td>
<td width=\"300\"><b><a href=\"admin.php?action=editsmilies&subaction=delete&smilie=$row[0]\">$txt[327]</a></b></td>
</tr>";
}

$body .= "</table></div>
<Br><Br>
<b>$txt[324]</b> <form action=\"admin.php?action=editsmilies&subaction=add\" method=\"post\">
$txt[322]:<input type=\"text\" name=\"code\"> 
<Br>$txt[325]:<input type=\"text\" name=\"url\"> 
<Br><input type=\"Submit\" value=\"$txt[324]\">
</form>
";

}elseif($action == "editsmilies"){
if(!isset($subaction)){
$head = $txt[2];
$body = $txt[320];
}elseif($subaction == "add"){

$code = eregi_replace("\^","\\\^",$code);
$code = eregi_replace("\.","\\\.",$code);
$code = eregi_replace("\[","\\\[",$code);
$code = eregi_replace("\]","\\\]",$code);
$code = eregi_replace('\$','\\\$',$code);
$code = eregi_replace("\(","\\\(",$code);
$code = eregi_replace("\)","\\\)",$code);
$code = eregi_replace("\|","\\\|",$code);
$code = eregi_replace("\*","\\\*",$code);
$code = eregi_replace("\?","\\\?",$code);
$code = eregi_replace("\{","\\\{",$code);
$code = eregi_replace("\}","\\\}",$code);

DoQuery("INSERT INTO $SERVER[TBL_PREFIX]filter VALUES('0','1','$code','$url')");
$head = $txt[324];
$body = $txt[326];
}elseif($subaction == "delete"){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]filter WHERE id=$smilie");
$head = $txt[327];
$body = $txt[326];
}
}elseif($action == "filter"){
$head = $txt[328];
$body = "$txt[329]<Br><Br>";
$body .= "<div align=\"center\"><table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<Tr>
<td width=\"100\"><b>$txt[332]</b></td>
<td width=\"100\"><b>$txt[328]</b></td>
<td width=\"300\"><b>$txt[323]</b></td>
</tr>";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]filter WHERE type=2");
while($row = Do_Fetch_Row($q)){
$body .= "
<Tr>
<td width=\"100\"><b>$row[2]</b></td>
<td width=\"100\"><b>$row[3]</b></td>
<td width=\"300\"><b><a href=\"admin.php?action=editfilter&subaction=delete&smilie=$row[0]\">$txt[327]</a></b></td>
</tr>";
}

$body .= "</table></div>
<Br><Br>
<b>$txt[331]</b> <form action=\"admin.php?action=editfilter&subaction=add\" method=\"post\">
$txt[332]:<input type=\"text\" name=\"code\"> 
<Br>$txt[328]:<input type=\"text\" name=\"url\"> 
<Br><input type=\"Submit\" value=\"$txt[331]\">
</form>
";

}elseif($action == "editfilter"){
if(!isset($subaction)){
$head = $txt[2];
$body = $txt[320];
}elseif($subaction == "add"){
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]filter VALUES('0','2','$code','$url')");
$head = $txt[328];
$body = $txt[330];
}elseif($subaction == "delete"){
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]filter WHERE id=$smilie");
$head = $txt[328];
$body = $txt[330];
}
}elseif($action == "manageusers"){
$head = $txt[316];
$body = $txt[334];
$body .= "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"200\"><b>Username</b></td>
<td width=\"100\"><b>Expires in..</b></td>
<td width=\"250\"><b>Action</b></td>
</tr>";

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users");
while($row = Do_Fetch_row($q)){
if($row[12] == "0" || $SERVER['EXP_USER'] == 0){
$exptime = "Never";
}else{
$exptime = $row[12]-$SERVER['TIMEXP_USER'];
$minutes = 0;
$minutes = floor($exptime/60);
$second = $exptime-(60*$minutes);
if(strlen($second) < 2)
	$second = "0".$second;
$exptime = $minutes.":".$second;
}
$body .= "<tr>
<td width=\"200\">$row[1]</td>
<td width=\"100\"><div align=\"center\">$exptime</div></td>
<td width=\"250\">
<a href=\"admin.php?action=editusers&subaction=delete&id=$row[0]\">[Delete]</a> </a>
<a href=\"admin.php?action=permissions&workon=$row[1]\">[Permissions]</a> ";
if($row[4] == 5 || $row[4] == 4){
$body .= "<a href=\"admin.php?action=editusers&subaction=deadmin&id=$row[0]\">[Un-Admin]";
}else{
$body .= "<a href=\"admin.php?action=editusers&subaction=admin&id=$row[0]\">[Make Admin]";
}
$body .="</a> ";
if($row[12] == 0){
$body .= "<a href=\"admin.php?action=editusers&subaction=expire&id=$row[0]\">[Expire]";
}else{
$body .= "<a href=\"admin.php?action=editusers&subaction=nexpire&id=$row[0]\">[Never Expire]";
}
$body .= "</a> ";
$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]bans WHERE room='*' AND name='$row[1]'");
$row2 = Do_Fetch_row($q2);
if($row2[0] == ""){
$body .= "<a href=\"admin.php?action=editusers&subaction=ban&user=$row[1]\">[Ban]";
}else{
$body .= "<a href=\"admin.php?action=editusers&subaction=unban&user=$row[1]\">[Unban]";
}
$body .="</a></td>
</tr>";
}
$body .= "</table>";

}elseif($action == "editusers"){
if(!isset($subaction)){
$head = $txt[2];
$body = $txt[320];
}elseif($subaction == "delete"){
$head = $txt[316];
$body = $txt[335];
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]users WHERE id='$id'");
}elseif($subaction == "admin"){
$head = $txt[316];
$body = $txt[184];
$q = DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level=4,time=0 WHERE id='$id'");
}elseif($subaction == "deadmin"){
$head = $txt[316];
$body = $txt[182];
$time = time();
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET level=1,time=$time WHERE id='$id'");
}elseif($subaction == "neverexpire"){
$head = $txt[316];

}elseif($subaction == "ban"){
$head = $txt[316];
$body = "$user $txt[278]";
DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','*','$user','','$time','0')");
}elseif($subaction == "unban"){
$head = $txt[316];
$body = "$user $txt[279]";
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='*' && name='$user'");
}elseif($subaction == "expire"){
$head = $txt[316];
$body = $txt[337];
$time = time();
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET time=$time WHERE id='$id'");
}elseif($subaction == "nexpire"){
$head = $txt[316];
$body = $txt[336];
DoQuery("UPDATE $SERVER[TBL_PREFIX]users SET time=0 WHERE id='$id'");
}


}elseif($action == "managerooms"){
$head = $txt[317];
$body = $txt[338];
$body .= "<table border=\"1\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
<td width=\"200\"><b>Name</b></td>
<td width=\"100\"><b>Expires in..</b></td>
<td width=\"100\"><b>Type</b></td>
<td width=\"100\"><b>Password</b></td>
<td width=\"150\"><b>Action</b></td>
</tr>";

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]rooms");
while($row = Do_Fetch_row($q)){
if($row[9] == "0" || $SERVER['EXP_USER'] == 0){
$exptime = "Never";
}else{
$exptime = $row[9]-$SERVER['TIMEEXP_ROOMS'];
$minutes = 0;
$minutes = floor($exptime/60);
$second = $exptime-(60*$minutes);
if(strlen($second) < 2)
	$second = "0".$second;
$exptime = $minutes.":".$second;
}
$body .= "<tr>
<td width=\"200\">$row[1]</td>
<td width=\"100\"><div align=\"center\">$exptime</div></td>
<td width=\"100\">";
if($row[2] == 1){
$body .= "Public";
}else{
$body .= "Private";
}
$body .="</td>
<td width=\"100\">";
if($row[7] != "")
	$body .= $row[7];
else
	$body .= "(none)";
$body .= "</td>
<td width=\"150\">
<a href=\"admin.php?action=editrooms&subaction=delete&id=$row[0]\">[Delete]</a> ";
if($row[9] == 0){
$body .= "<a href=\"admin.php?action=editrooms&subaction=expire&id=$row[0]\">[Expire]";
}else{
$body .= "<a href=\"admin.php?action=editrooms&subaction=nexpire&id=$row[0]\">[Never Expire]";
}
$body .= "</a> </td>
</tr>";
}
$body .= "</table><Br><Br>
<a href=\"index.php?croom1=yes\">$txt[25]</a>";

}elseif($action == "editrooms"){
if(!isset($subaction)){
$head = $txt[2];
$body = $txt[320];
}elseif($subaction == "delete"){
$head = $txt[317];
$body = $txt[339];
DoQuery("DELETE FROM $SERVER[TBL_PREFIX]rooms WHERE id='$id'");
}elseif($subaction == "expire"){
$head = $txt[317];
$body = $txt[340];
$time = time();
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET time=$time WHERE id='$id'");
}elseif($subaction == "nexpire"){
$head = $txt[317];
$body = $txt[341];
DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET time=0 WHERE id='$id'");
}

}elseif($action == "permissions"){
if(!isset($workon)){
$head = $txt[315];
$body = "$txt[345]<Br>$txt[380]<Br><br>";
$body .= "<a href=\"admin.php?action=permissions&workon=DEFAULT_1\">$txt[379]</a><Br>";
$body .= "<a href=\"admin.php?action=permissions&workon=DEFAULT_4\">$txt[381]</a><Br><Br>";
$q = DoQuery("SELECT username FROM $SERVER[TBL_PREFIX]users");
while($row = Do_Fetch_Row($q)){
	$body .= "<a href=\"admin.php?action=permissions&workon=$row[0]\">$row[0]</a>";
	$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='$row[0]'");
	$row2 = Do_Fetch_row($q2);
	if($row2[0] != ""){
		$body .= " <a href=\"admin.php?action=resetpermissions&workon=$row[0]\">[$txt[383]]</a><Br>";
	}else{
		$body .= "<Br>";
	}
}
}else{
if($workon == "DEFAULT_1"){
$head = "$txt[315] - $txt[379]";
}elseif($workon == "DEFAULT_4"){
$head = "$txt[315] - $txt[381]";
}else{
$head = "$txt[315] - $workon";
}

$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='$workon'");
$row = Do_Fetch_row($q);
if($row[0] == ""){
	$q = DoQuery("SELECT level FROM $SERVER[TBL_PREFIX]users WHERE username='$workon'");
	$row = Do_Fetch_row($q);
	if($row[0] == 1 || $row[0] == 2 || $row[0] > 5){
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='DEFAULT_1'");
	$row = Do_Fetch_row($q);
	}elseif($row[0] == 4){
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='DEFAULT_4'");
	$row = Do_Fetch_row($q);
	}elseif($row[0] == 5){
	$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='DEFAULT_5'");
	$row = Do_Fetch_row($q);
	}
}

if($row[2] == 1)
	$createrooms = "CHECKED";
else
	$createrooms = "";
if($row[3] == 1)
	$neverexpirerooms = "CHECKED";
else
	$neverexpirerooms = "";
if($row[4] == 1)
	$privaterooms = "CHECKED";
else
	$privaterooms = "";
if($row[5] == 1)
	$moderated = "CHECKED";
else
	$moderated = "";
if($row[6] == 1)
	$adminpowers = "CHECKED";
else
	$adminpowers = "";
if($row[7] == 1)
	$oppowersown = "CHECKED";
else
	$oppowersown = "";
if($row[8] == 1)
	$oppowersany = "CHECKED";
else
	$oppowersany  = "";
if($row[9] == 1)
	$iplookup = "CHECKED";
else
	$iplookup = "";
if($row[10] == 1)
	$kick = "CHECKED";
else
	$kick = "";
if($row[11] == 1)
	$ban = "CHECKED";
else
	$ban = "";
if($row[12] == 1)
	$banserver = "CHECKED";
else
	$banserver = "";
if($row[13] == 1)
	$sysmessage = "CHECKED";
else
	$sysmessage = "";
if($row[14] == 1)
	$edit_settings = "CHECKED";
else
	$edit_settings = "";
if($row[15] == 1)
	$edit_styles = "CHECKED";
else
	$edit_styles = "";
if($row[16] == 1)
	$edit_permissions = "CHECKED";
else
	$edit_permissions = "";
if($row[17] == 1)
	$edit_users = "CHECKED";
else
	$edit_users = "";
if($row[18] == 1)
	$edit_rooms = "CHECKED";
else
	$edit_rooms = "";
if($row[19] == 1)
	$edit_smilies = "CHECKED";
else
	$edit_smilies = "";
if($row[20] == 1)
	$edit_filter = "CHECKED";
else
	$edit_filter = "";
if($row[21] == 1)
	$edit_bandwidth = "CHECKED";
else
	$edit_bandwidth = "";

$body = "<form action=\"admin.php?action=editpermissions&workon=$workon\" method=\"post\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$CS[3]\">
<Tr><td><div align=\"center\">
<table border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$CS[3]\">
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[112]<Br>
<font size=\"2\">$txt[346]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"createrooms\" value=\"1\" $createrooms></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[348]<Br>
<font size=\"2\">$txt[347]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"neverexpirerooms\" value=\"1\" $neverexpirerooms></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[114]<Br>
<font size=\"2\">$txt[349]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"privaterooms\" value=\"1\" $privaterooms></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[350]<Br>
<font size=\"2\">$txt[351]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"moderated\" value=\"1\" $moderated></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[353]<Br>
<font size=\"2\">$txt[352]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"adminpowers\" value=\"1\" $adminpowers></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[354]<Br>
<font size=\"2\">$txt[356]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"oppowersown\" value=\"1\" $oppowersown></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[355]<Br>
<font size=\"2\">$txt[357]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"oppowersany\" value=\"1\" $oppowersany></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[358]<Br>
<font size=\"2\">$txt[359]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"iplookup\" value=\"1\" $iplookup></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[360]<Br>
<font size=\"2\">$txt[361]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"kick\" value=\"1\" $kick></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[362]<Br>
<font size=\"2\">$txt[363]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"ban\" value=\"1\" $ban></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[364]<Br>
<font size=\"2\">$txt[365]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"banserver\" value=\"1\" $banserver></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[366]<Br>
<font size=\"2\">$txt[367]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"sysmessage\" value=\"1\" $sysmessage></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[368]<Br>
<font size=\"2\">$txt[369]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_settings\" value=\"1\" $edit_settings></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[370]<Br>
<font size=\"2\">$txt[371]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_styles\" value=\"1\" $edit_styles></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[372]<Br>
<font size=\"2\">$txt[373]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_permissions\" value=\"1\" $edit_permissions></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[374]<Br>
<font size=\"2\">$txt[375]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_users\" value=\"1\" $edit_users></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[376]<Br>
<font size=\"2\">$txt[377]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_rooms\" value=\"1\" $edit_rooms></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[390]<Br>
<font size=\"2\">$txt[391]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_smilies\" value=\"1\" $edit_smilies></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[392]<Br>
<font size=\"2\">$txt[393]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_filter\" value=\"1\" $edit_filter></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\">$txt[429]<Br>
<font size=\"2\">$txt[430]</font></td>
<td width=\"150\" bgcolor=\"$CS[2]\"><input type=\"checkbox\" name=\"edit_bandwidth\" value=\"1\" $edit_bandwidth></td>
</tr>
<tr valign=\"top\">
<td width=\"350\" bgcolor=\"$CS[2]\"><div align=\"right\"><input type=\"submit\" value=\"$txt[35]\"> <input type=\"reset\" value=\"$txt[36]\"></div></td>
<td width=\"150\" bgcolor=\"$CS[2]\">&nbsp;</td>
</tr>

</table>
</tr>
</td>
</table>";

}
}elseif($action == "editpermissions"){
$head = $txt[315];
$body = $txt[378];
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]permissions WHERE user='$workon'");
$row = Do_Fetch_Row($q);
if($row[0] == "")
	@DoQuery("INSERT INTO $SERVER[TBL_PREFIX]permissions VALUES('0','$workon','$createrooms','$neverexpirerooms','$privaterooms','$moderated','$adminpowers','$oppowersown','$oppowersany','$iplookup','$kick','$ban','$banserver','$sysmessage','$edit_settings','$edit_styles','$edit_permissions','$edit_users','$edit_rooms','$edit_smilies','$edit_filter','$edit_bandwidth')");
else
	@DoQuery("UPDATE $SERVER[TBL_PREFIX]permissions SET CreateRoom='$createrooms',CR_NeverExpire='$neverexpirerooms',CR_Private='$privaterooms',CR_Moderated='$moderated',Make_Admins='$adminpowers',Give_Ops_Own='$oppowersown',Give_Ops_All='$oppowersany',Lookup_Ips='$iplookup',Kick='$kick',Ban='$ban',Server_Ban='$banserver',Send_Sys_Message='$sysmessage',Edit_Settings='$edit_settings',Edit_Styles='$edit_styles',Edit_Permissions='$edit_permissions',Edit_Users='$edit_users',Edit_Room='$edit_rooms' ,Edit_Smilies='$edit_smilies',Edit_Filter='$edit_filter',Edit_Bandwidth='$edit_bandwidth' WHERE user='$workon'");
	
}elseif($action == "resetpermissions"){
	DoQuery("DELETE FROM $SERVER[TBL_PREFIX]permissions WHERE user='$workon'");
	$head = $txt[315];
	$body = $txt[382];
}elseif($action == "ban"){
$swideunban = "";
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]bans WHERE room='*'");
while($row = Do_Fetch_Row($q)){
if($row[2] != ""){
$swideunban .= "<a href=\"admin.php?action=doban&user=$row[2]&unban=1\">$row[2]</a><Br>";
}else{
$swideunban.= "<a href=\"admin.php?action=doban&user=$row[3]&isip=true&unban=1\">$row[3]</a><Br>";
}
}

$head = $txt[99];
$body = "$txt[384]<Br><Br>
<form action=\"admin.php?action=doban\" method=\"post\">
<input type=\"hidden\" name=\"action\" value=\"doban\">
$txt[95]<input type=\"text\" name=\"ip\"><Br>$txt[96]<Br>
$txt[12]&nbsp; <input type=\"text\" name=\"username\"><br><Br>
<input type=\"submit\" value=\"$txt[99]\">
</form><Br>
$txt[385]<Br><Br>
$swideunban
";
}elseif($action == "doban"){
if(isset($unban)){
	$user = strip($user);
	$head = $txt[100];
	$body = $txt[101];
	if(isset($isip)){
			DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='*' && ip='$user'");
	}else{
			DoQuery("DELETE FROM $SERVER[TBL_PREFIX]bans WHERE room='*' && name='$user'");
	}
}else{
	$head = $txt[99];
	$body = "$txt[105]";
	$time = time();
	if($ip == ""){
		$username = strip($username);
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','*','$username','','$time','0')");
	}else{
		$ip = strip($ip);
		DoQuery("INSERT INTO $SERVER[TBL_PREFIX]bans VALUES('0','*','','$ip','$time','0')");
	}
}
}elseif($action == "bandwidth"){
$head = $txt[428];

$body = '<table border="1" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100"><b>'.$txt[12].'</b></td>
				<td width="150"><b>'.$txt[431].'</b></td>
				<td width="150"><b>'.$txt[432].'</b></td>
				<td width="200"><b>'.$txt[433].'</b></td>
			</tr>';
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]users");
$total = 0;
while($row = Do_Fetch_Row($q)){
	$q2 = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]bandwidth WHERE user='$row[1]'");
	$row2 = Do_Fetch_Row($q2);
	$ext = "";
	$total = $total+$row2[3];
	if($row2[3] >= 1024){
		$row2[3] = $row2[3]/1024;
		if($row2[3] >= 1024){
			$row2[3] = $row2[3]/1024;
			$ext = " MB";
		}else{
			$ext = " KB";
		}
	}elseif($row2[3] > 1024){
		$ext = " B";
	}
	
	if(eregi("[0-9]*\...","$row2[3]",$match)){
		$row2[3] = $match[0].$ext;
	}else{
		$row2[3] = $row2[3].$ext;
	}
	
	if($row2[4] == "d"){
		$temp = $SERVER['DEFAULT_BAND_LIMIT']/1024/1024;
		$row2[4] = "$txt[442] ($temp MB)";
	}elseif($row2[4] == "0"){
		$row2[4] = "$txt[441]";
	}else{
		$row2[4] = $row2[4]/1024/1024;
		$row2[4] .= " MB";
	}
			
	$body .= '
			<tr>
				<td width="100">'.$row[1].'</td>
				<td width="150">'.$row2[3].'</td>
				<td width="150">'.$row2[4].'</td>
				<td width="200"><form action="admin.php?action=editbandwidth&user='.$row[1].'" method="post"><input type="text" name="newband" size="5"> <input type="submit" value="'.$txt[436].'"> ('.$txt[437].')</form></td>
			</tr>';
}


	$total = $total/1024;
	if($total >= 1024){
		$total = $total/1024;
		$ext = " MB";
	}else{
			$ext = " KB";
	}
	if(eregi("[0-9]*\...","$total",$match)){
		$total = $match[0].$ext;
	}else{
		$total = $total.$ext;
	}

$body .= '<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="100">&nbsp;&nbsp; <b>'.$txt[435].'</b> </td>
				<td width="150">'.$total.'</td>
				<td width="150">&nbsp;</td>
				<td width="200">&nbsp;</td>
			</tr>';
$body .= "</table><Br>$txt[434]<Br><Br>";


}elseif($action == "editbandwidth"){
$head = $txt[428];
if(isset($user) && isset($newband)){
	$body = "<Br>$txt[438]<Br><Br>";
	if($newband != "d")
		$newband = $newband*1024*1024;
	DoQuery("UPDATE $SERVER[TBL_PREFIX]bandwidth SET allowed='$newband' WHERE user='$user'");
}else{
	$body = "<Br>$txt[439]<Br><Br>";
}
}

}
?>
<?
printct(700,700,"<font size=\"6\"><div align=\"center\">$head</div></font>","<div align=\"center\">$prebody$body<Br><Br></div>","$CS[1]","$CS[2]","$CS[3]");
?>
<Br><Br><Br>
<div align="center"><font size="2">Powered By <a href="http://www.x7chat.com/" target="_blank">X7 Chat</a> 1.3.6B<Br>&copy; 2004 By The <a href="http://www.x7chat.com/" target="_blank">X7 Group</a></font></div>
</body>
</html>
