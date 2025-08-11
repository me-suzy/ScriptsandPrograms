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

	require("../config.php");
	
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<html>
<head>
<title>Private Message - <?=$user?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="Author" content="The X7 Group">
<meta http-equiv="content-language" content="en">
<META NAME="copyright" content="2003 By The X7 Group">
<META NAME="rating" content="general">

<?
if(!isset($page)){
	$page = "frames";
}

if($page == "frames"){
?>
 </head>
 <frameset rows="200,100,0,0" border="0">
  <frame src="privatemessage.php?page=window" name="pm_mw" frameborder="0" scrolling="yes" marginwidth="0" marginheight="0" noresize="true">
  <frame src="privatemessage.php?page=chatbox&user=<?=$user?>" name="pm_chatbox" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
  <frame src="privatemessage.php?page=send" name="pm_send" frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
  <frame src="privatemessage.php?page=update&user=<?=$user?>" name="pm_update frameborder="0" scrolling="no" marginwidth="0" marginheight="0" noresize="true">
 </frameset>
 <NOFRAMES>
<?=$txt[18]?>
</NOFRAMES> 
<?
}elseif($page == "send"){

	if($sentmsg != ""){
		if($txtcolor == ""){
			$txtcolor = "$CS[FONTDT]";
		}else{
			if(!eregi("#",$txtcolor)){
				$txtcolor = "#".$txtcolor;
			}
		}

		if($txtsize == ""){
			$txtsize = "3";
		}
		
		if($fontface == "")
			$fontface = "default";
		
		$tampon = $sentmsg;
		$sentmsg = eregi_replace("'","\\'",$sentmsg);
		$sentmsg = "[color=$txtcolor]".$sentmsg."[/color]";
		$sentmsg = "[size=$txtsize]".$sentmsg."[/size]";
		$sentmsg = "[font=$fontface]".$sentmsg."[/font]";
			if($txtitalic=="1")
				$sentmsg = "[i]".$sentmsg."[/i]";
			if($txtbold=="1")
				$sentmsg = "[b]".$sentmsg."[/b]";
			if($txtunderline=="1")
				$sentmsg = "[u]".$sentmsg."[/u]";

				
		$floodcount = 1;
		$time = time();
		$oldtime = time() - 1;
		$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]messages WHERE user='$XUSER[NAME]'");
		while($row = Do_Fetch_Row($q)){
			if($row[3] == $time || $row[3] == $oldtime)
				$floodcount++;
		}

		if($floodcount > $SERVER['MAX_MPS']){
			$to2 = "$XUSER[NAME]:PRIV";
			$temp = $SERVER['MAX_MPS']/2;
			$msg2 = "$txt[309] $temp $txt[310]";
			sendsysmsgto($msg2,$to2);
		}else{
				sendprivatemsg($sentmsg,$to);
				$submsg = $sentmsg;
				$submsg = codeparse($submsg);
				$submsg = eregi_replace('\\\\\'',"'",$submsg);
				$submsg = eregi_replace('"','\"',$submsg);
				$submsg .= "<Br>";
				if($XUSER['TIMESTAMP'] == 0){
					$timestamp = "[";
					$timestamp .= date("g:i:s");
					$timestamp .= "]";
				}
				$submsg = "<b><font color=\\\"$CS[YOURNAME]\\\">$XUSER[NAME]$timestamp</b>:</font> &nbsp; ".$submsg;
				?>
				<script language="javascript" type="text/javascript">
				with(window.parent.frames['pm_mw'].document){
					write("<?=$submsg?>");
				}
				if(typeof(scrollBy) != "undefined"){
					window.parent.frames['pm_mw'].window.scrollBy(0, 65000);
				}else{
					window.parent.frames['pm_mw'].window.scroll(0, 65000);
				}
				
				</script>
				<body bgcolor="<? echo $CS['WIN_BG_2']; ?>">
				&nbsp;
				</body>
				</html>
				<?
		}
	}

?>
<?
}elseif($page == "window"){
?>
<script language="javascript" type="text/javascript">
issent = 1;

</script>

</head>
<body bgcolor="<? echo $CS['WIN_BG_2']; ?>">

<?
}elseif($page == "chatbox"){
?>
<script language="javascript" type="text/javascript">

function italicClicked(){
	if(document.cbform.txtitalic.value == 0){
		document.cbform.txtitalic.value = 1;
		document.italicb.src='../images/pm_italic_2.gif';
	}else{
		document.cbform.txtitalic.value = 0;
		document.italicb.src='../images/pm_italic.gif';
	}
}

function boldClicked(){
	if(document.cbform.txtbold.value == 0){
		document.cbform.txtbold.value = 1;
		document.boldb.src='../images/pm_bold_2.gif';
	}else{
		document.cbform.txtbold.value = 0;
		document.boldb.src='../images/pm_bold.gif';
	}
}

function underlineClicked(){
	if(document.cbform.txtunderline.value == 0){
		document.cbform.txtunderline.value = 1;
		document.underlineb.src='../images/pm_underline_2.gif';
	}else{
		document.cbform.txtunderline.value = 0;
		document.underlineb.src='../images/pm_underline.gif';
	}
}

function dosndmsg(){
document.cbform.sentmsg.value=''
document.cbform.sentmsg.focus()
}

function smclick2(smileyCode){
document.cbform.sentmsg.style.color=smileyCode
document.cbform.txtcolor.value=smileyCode
document.cbform.tlcd.style.background="#"+smileyCode
}

</script>
</head>
<body bgcolor="<? echo $CS['WIN_BG_2']; ?>">
<div align="Center">

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


	$borderlr = "border-left: 1px solid $CS[3];border-right: 1px solid $CS[3];"
?>
<table border="0" cellspacing="0" cellpadding="0" width="550" bgcolor="<?=$CS[2]?>" style="border-bottom: 1px solid <?=$CS[3]?>;">
	<tr valign="top">
		<td width="550" bgcolor="<? echo $CS['WIN_BG_2']; ?>" colspan="2" height="5"><img height="5" src="./images/spacer.gif"></td>
	</tr>
	<tr valign="top">
		<td width="550" style="<?=$borderlr?>border-top: 1px solid <?=$CS[3]?>">

<?
$chatmsg =  $txt[286];
$privatemsgtext = "<input type=\"hidden\" name=\"to\" value=\"$user\">";

print("<div align=\"left\">
			<table border=\"0\" cellspacing=\"0\" height=\"25\" cellpadding=\"0\" name=\"colortable\">
				<tr valign=\"center\">
					<td width=\"3\" height=\"30\"><img width=\"3\" height=\"30\" src=\"./images/spacer.gif\">
					</td>
					<td width=\"140\">
					<form action=\"privatemessage.php?page=send\" method=\"post\" name=\"cbform\" target=\"pm_send\" onSubmit=\"javascript: setTimeout('dosndmsg()',500)\">
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
						<input type=\"hidden\" name=\"txtitalic\" value=\"0\">
						<input type=\"hidden\" name=\"txtunderline\" value=\"0\">
						<input type=\"hidden\" name=\"txtbold\" value=\"0\">
						<font color=\"$CS[FONTLT]\">
						<input type=\"hidden\" name=\"sent\" value=\"1\">
						<input type=\"hidden\" name=\"txtcolor\" value=\"$CS[FONTDT]\">
						$privatemsgtext
					</td>
					<td width=\"23\">
					<img src=\"../images/pm_italic_3.gif\" name=\"italicb\" onClick=\"javascript: italicClicked()\">
					</td>
					<td width=\"23\">
					<img src=\"../images/pm_bold_3.gif\" name=\"boldb\" onClick=\"javascript: boldClicked()\">
					</td>
					<td width=\"23\">
					<img src=\"../images/pm_underline_3.gif\" name=\"underlineb\" onClick=\"javascript: underlineClicked()\">
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
		<div align=\"left\">&nbsp;$chatmsg: <input type=\"text\" name=\"sentmsg\" class=\"chatbox\" size=\"55\"> <input type=\"submit\" value=\"$txt[85]\" onClick=\"javascript: setTimeout('dosndmsg()',500)\"></font></div>"
		);
		?>
		</td>
	</tr>
	<tr>
		<td width="500" style="<?=$borderlr?>">&nbsp;</td>
	</tr>
</table>

</div>
<?
}elseif($page == "update"){

// We don't need 1000000 popups coming up do we? no, lets change that
$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]pmsessions WHERE user='$XUSER[NAME]' AND fromuser='$user'");
$row = Do_Fetch_Row($q);
$time = time();
if($row[0] == ""){
	$update = 0;
	DoQuery("INSERT INTO $SERVER[TBL_PREFIX]pmsessions VALUES('0','$XUSER[NAME]','$user','$time','1')");
}else{
	$update = $row[3];
	DoQuery("UPDATE $SERVER[TBL_PREFIX]pmsessions SET time='$time' WHERE id='$row[0]'");
}

?>
<script language="javascript" type="text/javascript">
<?
?>
if(window.parent.frames['pm_mw'].issent == 1){
	window.parent.frames['pm_mw'].document.write('<html><head></head><body bgcolor="<? echo $CS['WIN_BG_2']; ?>"><?$returned = getprivatemessages($update-1000);echo $returned[$user];?>');
}else{
	window.parent.frames['pm_mw'].document.write('<?$returned = getprivatemessages($update);echo $returned[$user];?>');
	if(typeof(scrollBy) != "undefined"){
			window.parent.frames['pm_mw'].window.scrollBy(0, 65000);
	}else{
			window.parent.frames['pm_mw'].window.scroll(0, 65000);
	}

}

</script>
<?
if(@$returned[$user] != "" && $SERVER['ENABLE_SOUNDS'] != 1){
	echo '<bgsound src="../Sounds/snd1.wav" loop="1">';
}

$extra = "";
$size = "980";
$bused = logBandwidth($size);
if($bused == 0){
	$extra = ";window.parent.location='../index.php?bandwidtherror=1'";
}
?>
</head>
<body bgcolor="<? echo $CS['WIN_BG_2']; ?>" onLoad="javascript:setTimeout('location.reload()',1000)<?=$extra?>">
<?
}

?>

</body>
</html>
