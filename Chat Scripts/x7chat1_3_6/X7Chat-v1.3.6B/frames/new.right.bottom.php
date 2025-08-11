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
	@include("javascript.php");
?>
</head>
<body bgcolor="<? echo $CS['WIN_BG_1']; ?>">
<div align="left">
<table border="0" cellspacing="0" cellpadding="0" bgcolor="<?=$CS[2]?>">
	<tr valign="top">
		<td bgcolor="<? echo $CS['WIN_BG_1']; ?>" colspan="2" height="5"><img height="5" src="./images/spacer.gif"></td>
	</tr>
	<tr valign="top">
		<td bgcolor="<? echo $CS['WIN_BG_1']; ?>" width="5"><img width="5" src="./images/spacer.gif"></td>
		<td width="196" height="79" bgcolor="<? echo $CS['2']; ?>" style="border: 1px solid <?=$CS[3]?>;"><?
			$smstart = 0;
			$tsmilies = 0;
			$smilies = "";
			$q = DoQuery("SELECT * FROM $SERVER[TBL_PREFIX]filter WHERE type='1' LIMIT $smstart,52");
			while($row = Do_Fetch_Row($q)){
				$row[3] = eregi_replace("^../","./",$row[3]);
				$smilies .= "<img src=\"$row[3]\" onclick=\"javascript: smclick('$row[2]')\" height=\"15\" width=\"15\">";
				$tsmilies++;
			}
			print("<font color=\"$CS[FONTLT]\">$smilies");
		?></td>
	</tr>
</table>
</body>
</html>
