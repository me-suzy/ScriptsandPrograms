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

$doset = 1;
$donotincluebase = 1;
require("../config.php");
/*
if(!isset($_COOKIE['COOKIESND'])){
	@setcookie("COOKIESND","lookyiamset",time()+14000000,"$SERVER[PATH]");
	$sndmain = 1;
}
*/
if(!isset($_COOKIE['XLU'])){
	@setcookie("XLU",0,time()+14000000,"$SERVER[PATH]");
	$update = 0;
}else{
	$update = $_COOKIE['XLU'];
	@setcookie("XLU",time(),time()+14000000,"$SERVER[PATH]");
}

unset($donotincluebase);
require("../config.php");

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
<script language="javascript" type="text/javascript">

<?
if(!isset($update)){
	$update = 0;
}

if($CS['BGIMAGE'] != ""){
	$background = " style=\"background-attachment: fixed;background-image: url($CS[BGIMAGE]);\"";
}else{
	$background = "";
}

	?>
if(window.parent.frames['left_mid'].hasrecieved == 1){
	with(window.parent.frames['left_mid'].document){
	write('<!doctype html public "-//w3c//dtd html 4.0 transitional//en">')
	write('<html>')
	write('<head>')
	write('<title>X7 Chat</title>')
	write('<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">')
	write('<meta name="Author" content="The X7 Group">')
	write('<meta http-equiv="content-language" content="en">')
	write('<META NAME="copyright" content="2003 By The X7 Group">')
	write('<META NAME="rating" content="general">')
	write('</head>')
	write('<body bgcolor="<? echo $CS['WIN_BG_2']; ?>"<?=$background?>>')
	write('<?getmessages(1);?>');
}
}
<?


	if(!isset($pincorrect) && $update > 0){
		?>
		with(window.parent.frames['left_mid'].document){
		write('<?@getmessages($update);?>');
	}

	if(typeof(scrollBy) != "undefined"){
		window.parent.frames['left_mid'].window.scrollBy(0, 65000);
	}else{
		window.parent.frames['left_mid'].window.scroll(0, 65000);
	}


	window.parent.frames['left_top'].document.showon.users.value='<? echo $ONLINE['USERS']+$ONLINE['ADMIN'];?>';
	window.parent.frames['left_top'].document.showon.rooms.value='<? echo $ROOMS['TOTAL_ROOMS'];?>';

	<?
	if($XUSER['POPUPPM'] == 1){
		$q = DoQuery("SELECT fromuser,id FROM $SERVER[TBL_PREFIX]pmsessions WHERE user='$XUSER[NAME]' AND isopen='0'");
		while($row = Do_Fetch_Row($q)){
			if($row[0] != ""){
				$session = time().strlen($row[0]);
				print("window.open('privatemessage.php?user=$row[0]','PM$session','width=600,height=300');");
				DoQuery("UPDATE $SERVER[TBL_PREFIX]pmsessions SET isopen='1' WHERE id='$row[1]'");
			}
		}
	}
	
}else{
	if(isset($pincorrect)){
		print("This chat room requires a password.  <a href=\"../index.php\" target=\"_parent\">Click Here</a> to enter it.");
	}
}
	cleanmsgs();

$RV = printinroom();
$usersonline = $RV[0];
$number = $RV[1];


// Check to see if update of online list is needed
?>
if(window.parent.frames['right_mid'].numonline != <?=$number?>){
	if(window.parent.frames['right_mid'].numonline > 0){
		window.parent.frames['right_mid'].location.reload()
		
	}
}
<?
if(@$ban == 1){
print('window.parent.location.reload()');
forceexit("$XUSER[ROOM]","$XUSER[NAME]");
}
?>

</script>
<?
if(@$messages != 0 && $SERVER['ENABLE_SOUNDS'] != 1){
	echo '<bgsound src="../Sounds/snd1.wav" loop="1">';
}

$extra = "";
$size = "1730";
$bused = logBandwidth($size);
if($bused == 0){
	$extra = ";window.parent.location='../index.php?bandwidtherror=1'";
}
?>

</head>
<?
	if($XUSER['REFRESH'] < 1000 || $XUSER['REFRESH'] == "")
		$XUSER['REFRESH'] = 1000;
?>
<body onLoad="javascript:setTimeout('location.reload()',<? echo $XUSER['REFRESH'];?>)<?=$extra?>">
</body>
</html>
