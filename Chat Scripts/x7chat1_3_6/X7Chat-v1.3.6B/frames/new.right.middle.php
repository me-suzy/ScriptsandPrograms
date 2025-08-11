<?
/////////////////////////////////////////////////////////////// 
//							 							     //
//		X7 Chat Version 1.3.4 Beta		   				     //          
//		Released March 24, 2004		     				 //
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
include("./javascript.php");
if($SERVER['ENABLE_SOUNDS'] != 1){
?>
<bgsound src="../Sounds/snd2.wav" loop="1">
<?
}
?>
</head>
<body bgcolor="<? echo $CS['WIN_BG_1']; ?>">
<?
//Take care of requested business if any
if(!isset($umaction)){
	$umaction = "";
}

if(!isset($doto)){
	$umaction = "";
}

function redirect(){
echo "<script language=\"javascript\" type=\"text/javascript\">
				window.location='frame.php?page=right.middle';
			  </script>";
}

if($umaction == "ban"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/ban $doto");
		redirect();
	}
	
}elseif($umaction == "gvoice"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/voice $doto");
		redirect();
	}
	
}elseif($umaction == "tvoice"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/devoice $doto");
		redirect();
	}

}elseif($umaction == "ignore"){

		irc("/ignore $doto");
		redirect();

}elseif($umaction == "unignore"){

		irc("/unignore $doto");
		redirect();

}elseif($umaction == "kick"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/kick $doto");
		redirect();
	}

}elseif($umaction == "gadmin"){

	if($PERMISSIONS['Make_Admins'] == 1){
		irc("/admin $doto");
		redirect();
	}

}elseif($umaction == "tadmin"){

	if($PERMISSIONS['Make_Admins'] == 1){
		irc("/deadmin $doto");
		redirect();
	}

}elseif($umaction == "gop"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/op $doto");
		redirect();
	}
	
}elseif($umaction == "startlog"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET encrypted='1' WHERE name='$ROOMS[IN_ROOM_NAME]'");
		redirect();
	}
	
}elseif($umaction == "stoplog"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		DoQuery("UPDATE $SERVER[TBL_PREFIX]rooms SET encrypted='0' WHERE name='$ROOMS[IN_ROOM_NAME]'");
		redirect();
	}
	
}elseif($umaction == "clearlog"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		clearLog($ROOMS['IN_ROOM_NAME']);
		redirect();
	}
	
}elseif($umaction == "top"){

	if($XUSER['LEVEL'] == 3 || $XUSER['LEVEL'] == 4 || $XUSER['LEVEL'] == 5){
		irc("/deop $doto");
		redirect();
	}

}elseif($umaction == "invite"){

	echo "inviting $doto";
	?>
		<script language="javascript" type="text/javascript">
			alert("Inviting");
		</script>
	<?

}

// Begin the online list
$RV = printinroom();
$usersonline = $RV[0];
$number = $RV[1]; $fakenumber = $number;
while($fakenumber < 11){
$ins = "";
if($fakenumber == "10"){
	$ins = " border-bottom: 1px solid $CS[3]";
}
$usersonline .= "<tr valign=\"top\">
	<td width=\"5\">&nbsp;</td>
	<td width=\"20\" style=\"border-left: 1px solid $CS[3];$ins\" bgcolor=\"$CS[1]\">&nbsp;</td>
	<td width=\"175\" style=\"border-right: 1px solid $CS[3];$ins\" bgcolor=\"$CS[1]\">&nbsp;</td>
</tr>";
$fakenumber++;
}

?>
<script language="javascript" type="text/javascript">
numonline = <? print("$number"); ?>;
</script>
<?
$temp = eregi_replace("\\\\'","'",$ROOMS['IN_ROOM_NAME']);
?>
<table border="0" height="100%" cellspacing="0" cellpadding="0" width="100%">
	<tr valign="top">
		<td>
			<table border="0" cellspacing="0" cellpadding="0"">
				<tr valign="top">
					<td width="5">&nbsp;</td>
					<td width="195" bgcolor="<?=$CS[1]?>" colspan="2" style="border: 1px solid <?=$CS[3]?>">&nbsp;<font size="4"><img src="./images/person_2.gif" width="20" height="20" onClick="javascript:popUserMenu(event,'droom')" onMouseOut="javascript: this.src='./images/person_2.gif'" onMouseOver="javascript: this.src='./images/person.gif';" style="cursor:pointer"><?=$temp?> (<?=$number?>)</font></td>
				</tr>
				<?=$usersonline?>
			</table>
		</td>
	</tr>
</table>
<?
print("<div class=\"tt\" id=\"droom\">");

if($XUSER['LEVEL'] >= 3){
	echo doRollover("roomcontrol.php?action=ban\" target=\"_parent","ban");
	echo doRollover("roomcontrol.php?action=roomset\" target=\"_parent","settings");
	if($ROOMS['LOG'] == 1){
		echo doRollover("roomcontrol.php?action=viewlog\" target=\"_parent","viewlog");
		echo doRollover("frame.php?page=right.middle&umaction=stoplog&doto=null","stoplog");
		echo doRollover("frame.php?page=right.middle&umaction=clearlog&doto=null","clearlog");
	}else{
		echo doRollover("frame.php?page=right.middle&umaction=startlog&doto=null","startlog");
	}
}
echo doRollover("index.php?doinvite=1\" target=\"_parent","invite");


print("<a onClick=\"javascript: sinkUserMenu(event,'droom')\"><img src=\"./images/menu_close_1.gif\" border=\"0\" name=\"closeroom\" onMouseOver=\"javascript: this.src='./images/menu_close_2.gif'\" onMouseOut=\"javascript: this.src='./images/menu_close_1.gif'\"></a><Br></div>");
print("</div>");
?>

</body>
</html>
