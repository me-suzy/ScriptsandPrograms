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

if(isset($sent)){
	if($msg != ""){
		if($txtcolor == ""){
			$txtcolor = "$CS[FONTDT]";
		}else{
			if(!eregi("#",$txtcolor)){
				$txtcolor = "#".$txtcolor;
			}
		}
		
		if($fontface == "")
			$fontface = "default";
		
		if($txtsize == "")
			$txtsize = "3";
		
		$tampon = $msg;
		$msg = "[color=$txtcolor]".$msg."[/color]";
		$msg = "[size=$txtsize]".$msg."[/size]";
		$msg = "[font=$fontface]".$msg."[/font]";
		if($normal!="on"){
			if($italic=="on")
				$msg = "[i]".$msg."[/i]";
			if($bold=="on")
				$msg = "[b]".$msg."[/b]";
			if(@$underline=="on")
				$msg = "[u]".$msg."[/u]";
			}
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
			if(isset($to)){
				$tmsg = eregi_replace("'","\\'",$msg);
				sendprivatemsg($tmsg,$to);
				$submsg = codeparse($msg);
				$submsg = eregi_replace('"','\"',$submsg);
				$submsg .= "<Br>";
				if($XUSER['TIMESTAMP'] == 0){
					$timestamp = "[";
					$timestamp .= date("g:i:s");
					$timestamp .= "]";
				}
				$submsg = "<b><font color=\\\"$CS[YOURNAME]\\\">$XUSER[NAME][To: $to]{$timestamp}</b>:</font> &nbsp; ".$submsg;
				
				if($CS['BGIMAGE'] != ""){
					$background = " style=\"background: url($CS[BGIMAGE]);\"";
				}else{
					$background = "";
				}
				?>
				<html>
				<head>
				<script language="javascript" type="text/javascript">
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
				with(window.parent.frames['left_mid'].document){
					write("<?=$submsg?>");
				}
				if(typeof(scrollBy) != "undefined"){
					window.parent.frames['left_mid'].window.scrollBy(0, 65000);
				}else{
					window.parent.frames['left_mid'].window.scroll(0, 65000);
				}
				</script>
				</head>
				<body>
				&nbsp;
				</body>
				</html>
				<?
			}else{
				if(eregi("^/.*",$tampon) && !eregi("^//.*",$tampon)){
				$rez = irc($tampon);
					if(eregi("^Error.*",$rez)){
						$to2 = "$XUSER[NAME]:PRIV";
						sendsysmsgto($rez,$to2);
					}
				}else{
					$msg = eregi_replace("//","/",$msg);
					sendmsg($msg);
					$submsg = codeparse($msg);
					$submsg = eregi_replace('"','\"',$submsg);
					$submsg .= "<Br>";
					if($XUSER['TIMESTAMP'] == 0){
						$timestamp = "[";
						$temp_timestamp = date("g")+$XUSER['OFFSET'];
						$timestamp .= $temp_timestamp;	
						$timestamp .= date(":i:s");
						$timestamp .= "]";
					}
					$submsg = "<font color=\\\"$CS[YOURNAME]\\\"><b>$XUSER[NAME]$timestamp</b>:</font> &nbsp; ".$submsg;
					?>
					<html>
					<head>
					<script language="javascript" type="text/javascript">
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
						write('<body bgcolor="<? echo $CS['WIN_BG_2']; ?>">')
						write('<?getmessages(1);?>');
					}
					}
					with(window.parent.frames['left_mid'].document){
						write("<?=$submsg?>");
					}
					if(typeof(scrollBy) != "undefined"){
						window.parent.frames['left_mid'].window.scrollBy(0, 65000);
					}else{
						window.parent.frames['left_mid'].window.scroll(0, 65000);
					}
					</script>
					</head>
					<body>
					&nbsp;
					</body>
					</html>
					<?
				}
			}
		}
	}
}

?>
