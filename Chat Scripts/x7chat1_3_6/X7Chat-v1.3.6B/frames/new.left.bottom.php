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
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>X7 Chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="The X7 Group">
<meta http-equiv="content-language" content="en">
<META NAME="copyright" content="2003 By The X7 Group">
<META NAME="rating" content="general">
<?
require("./javascript.php");
?>
<style type="text/css">
.chatbox{
 background: <? echo $CS['CHATBG']; ?>;
 color: <? echo $CS['FONTDT']; ?>;
}
.tlcd{
 background: black;
 color: black;
 border: 1px solid black;
}
</style>
<script language="javascript" type="text/javascript">
function dosndmsg(){
document.cbform.msg.value=''
document.cbform.msg.focus()
}

function italicClicked(){
	if(document.cbform.italic.value == 0){
		document.cbform.italic.value = "on";
		document.italicb.src='./images/pm_italic_2.gif';
	}else{
		document.cbform.italic.value = 0;
		document.italicb.src='./images/pm_italic_3.gif';
	}
}

function boldClicked(){
	if(document.cbform.bold.value == 0){
		document.cbform.bold.value = "on";
		document.boldb.src='./images/pm_bold_2.gif';
	}else{
		document.cbform.bold.value = 0;
		document.boldb.src='./images/pm_bold_3.gif';
	}
}

function underlineClicked(){
	if(document.cbform.underline.value == 0){
		document.cbform.underline.value = "on";
		document.underlineb.src='./images/pm_underline_2.gif';
	}else{
		document.cbform.underline.value = 0;
		document.underlineb.src='./images/pm_underline_3.gif';
	}
}

</script>
</head>
<?
$printcolors = "";
$r = 240; $g = 0; $b = 0; $k = 1; $last = false;
while($k != 0){
if($r == 240 && $b == 0){
$g = $g+20;
}
if($g == 240 && $b == 0){
$r = $r-20;
}
if($r == 0 && $g == 240){
$b= $b+20;
}
if($b == 240 && $r == 0){
$g=$g-20;
}
if($g == 0 && $b == 240){
$r = $r+20;
}
if($r == 240 && $g == 0){
$b=$b-20;
$last = true;
}
if($r == 240 && $g==0 && $b==0 && $last==true){
$k =0;
}

$rh = dechex($r);
if(strlen($rh) < 2){
$rh = "0".$rh;
}
$gh = dechex($g);
if(strlen($gh) < 2){
$gh = "0".$gh;
}
$bh = dechex($b);
if(strlen($bh) < 2){
$bh = "0".$bh;
}
$value = $rh.$gh.$bh;
$printcolors .= "<td bgcolor=\"#$value\" width=\"3\" height=\"19\" onclick=\"javascript: smclick2('$value')\"><img src=\"./images/spacer.gif\" height=\"1\" width=\"3\">";
}
$printcolors = "<td bgcolor=\"#EEEEEE\" width=\"5\" height=\"19\" onclick=\"javascript: smclick2('EEEEEE')\"><img src=\"./images/spacer.gif\" height=\"1\" width=\"5\">".$printcolors;
$printcolors = "<td bgcolor=\"#000000\" width=\"5\" height=\"19\" onclick=\"javascript: smclick2('000000')\"><img src=\"./images/spacer.gif\" height=\"1\" width=\"5\">".$printcolors;

if(isset($privto)){
$chatmsg = "<a href=\"frame.php?page=left.bottom\">[x]</a> $txt[30]";
$privatemsgtext = "<input type=\"hidden\" name=\"to\" value=\"$privto\">";
}else{
$chatmsg = $txt[286];
$privatemsgtext = "";
}


?>
<body bgcolor="<? echo $CS['WIN_BG_1']; ?>" link="<?=$CS['FONTLT']?>" vlink="<?=$CS['FONTLT']?>" alink="<?=$CS['FONTLT']?>" onLoad="javascript: document.cbform.msg.focus()">
<div align="Center">
<?
	$borderlr = "border-left: 1px solid $CS[3];border-right: 1px solid $CS[3];"
?>
<table border="0" cellspacing="0" cellpadding="0" width="550" bgcolor="<?=$CS[2]?>" style="border-bottom: 1px solid <?=$CS[3]?>;">
	<tr valign="top">
		<td width="550" bgcolor="<? echo $CS['WIN_BG_1']; ?>" colspan="2" height="5"><img height="5" src="./images/spacer.gif"></td>
	</tr>
	<tr valign="top">
		<td width="550" style="<?=$borderlr?>border-top: 1px solid <?=$CS[3]?>">
		<?
			print("<div align=\"left\">
			<table border=\"0\" cellspacing=\"0\" height=\"25\" cellpadding=\"0\" name=\"colortable\">
				<tr valign=\"center\">
					<td width=\"3\" height=\"30\"><img width=\"3\" height=\"30\" src=\"./images/spacer.gif\">
					</td>
					<td width=\"140\">
						<form action=\"frame.php?page=send\" method=\"post\" name=\"cbform\" target=\"hidden_one\">
						<select name=\"fontface\" size=\"1\">
							<option value=\"default\">Serif</option>
							<option value=\"arial\">Arial</option>
							<option value=\"courier\">Courier</option>
							<option value=\"geneva\">Geneva</option>
							<option value=\"helvetica\">Helvetica &nbsp;</option>
							<option value=\"impact\">Impact</option>
							<option value=\"tahoma\">Tahoma</option>
							<option value=\"verdana\">Verdana</option>
						</select>
						&nbsp;<select name=\"txtsize\" size=\"1\">
						<option value=\"1\">1</option>
						<option value=\"2\">2</option>
						<option value=\"3\" SELECTED>3</option>
						<option value=\"4\">4</option>
						<option value=\"5\">5</option>
						<option value=\"6\">6</option>
						<option value=\"7\">7</option>
						</select>
						<input type=\"hidden\" name=\"italic\" value=\"0\">
						<input type=\"hidden\" name=\"underline\" value=\"0\">
						<input type=\"hidden\" name=\"bold\" value=\"0\">
						<font color=\"$CS[FONTLT]\">
						<input type=\"hidden\" name=\"sent\" value=\"1\">
						<input type=\"hidden\" name=\"txtcolor\" value=\"$CS[FONTDT]\">
						$privatemsgtext
					</td>
					<td width=\"23\">
					<img src=\"./images/pm_italic_3.gif\" name=\"italicb\" onClick=\"javascript: italicClicked()\">
					</td>
					<td width=\"23\">
					<img src=\"./images/pm_bold_3.gif\" name=\"boldb\" onClick=\"javascript: boldClicked()\">
					</td>
					<td width=\"23\">
					<img src=\"./images/pm_underline_3.gif\" name=\"underlineb\" onClick=\"javascript: underlineClicked()\">
					</td>
					<td width=\"7\">
					&nbsp;
					</td>
					<td width=\"25\" name=\"ctd\"><input type=\"text\" name=\"tlcd\" class=\"tlcd\" size=\"1\" READONLY=\"true\"></td>

					<td width=\"260\" name=\"dispc\">
					<div align=\"left\">
					<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"100\" style=\"border: 1px solid $CS[3];\">
					<tr valign=\"top\">
					$printcolors
					</tr>
					</table>
					</div>
				</td>
			</tr>
		</table></div>");
		
		?></td>
	</tr>
	<tr valign="top">
		<td width="550" style="<?=$borderlr?>">
		<?
		print("
		<div align=\"left\">&nbsp;$chatmsg: <input type=\"text\" name=\"msg\" class=\"chatbox\" size=\"55\"> <input type=\"submit\" value=\"$txt[85]\" onClick=\"javascript: setTimeout('dosndmsg()',500)\"></font></div>"
		);
		?>
		</td>
	</tr>
	<tr>
		<td width="500" style="<?=$borderlr?>">&nbsp;</td>
	</tr>
	<!--
	<tr>
		<td width="300" height="20">
			<?
			$a1 = "&nbsp;";
			$a2 = "&nbsp;";
			if($XUSER['LEVEL'] >= 3){
			if($PERMISSIONS['Send_Sys_Message'] == 1){
			$a1 = "<A href=\"./roomcontrol.php?action=sysmessage\" target=\"_parent\">$txt[294]</a>";
			}
			$temp = $PERMISSIONS['Edit_Settings']+$PERMISSIONS['Edit_Styles']+$PERMISSIONS['Edit_Permissions']+$PERMISSIONS['Edit_Users']+$PERMISSIONS['Edit_Room']+$PERMISSIONS['Server_Ban']+$PERMISSIONS['Edit_Smilies']+$PERMISSIONS['Edit_Filter'];
			if($temp > 0){
			$a2 = "<a href=\"./admin.php\" target=\"_parent\">$txt[386]</a>";
			}

			$roomcontrol = "
			<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
			<tr valign=\"top\">
			<td width=\"100\"><font color=\"$CS[FONTLT]\"><a href=\"./roomcontrol.php?action=roomset\" target=\"_parent\">$txt[296]</a></font></td>
			<td width=\"100\"><font color=\"$CS[FONTLT]\"><a href=\"./roomcontrol.php?action=ban\" target=\"_parent\">$txt[297]</a></font></td>
			<td width=\"100\"><font color=\"$CS[FONTLT]\">$a1</font></td>
			</tr>
			<tr valign=\"top\">
			<td width=\"100\"><font color=\"$CS[FONTLT]\"><a href=\"./roomcontrol.php?action=iplookup\" target=\"_parent\">$txt[298]</a></font></td>
			<td width=\"100\"><font color=\"$CS[FONTLT]\"><a href=\"./roomcontrol.php?action=ban\" target=\"_parent\">$txt[299]</a></font></td>
			<td width=\"100\"><font color=\"$CS[FONTLT]\">$a2</font></td
			</tr></table>
			";


			}else{
			$roomcontrol = "$txt[300]";
			}

			print("<font color=\"$CS[FONTLT]\">
			<div align=\"center\">
			<font size=\"4\" color=\"$CS[FONTLT]\">$txt[301]</font>
			</div>
			$roomcontrol
			</font>");
			?>
		</td>
		<td width="250" height="20" bgcolor="<?=$CS[2]?>">
			<?
			$h1 = 15;
			$w1 = 15;
			$smstart = 0;
			$smilies = "";
			$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]filter WHERE type='1' LIMIT $smstart,48");
			while($row = Do_Fetch_Row($q)){
				$smilies .= "<img src=\"$row[3]\" onclick=\"javascript: smclick('$row[2]')\" height=\"$h1\" width=\"$w1\">";
			}
			
			print("<font color=\"$CS[FONTLT]\">$smilies");
			?>
		</td>
	</tr>
	-->
</table>

</div>
</body>
</html>
