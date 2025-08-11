<?
/*************************************************************************************
 *	KMB - KwentMailBlogger
 *	V 0.1; 2004-10-30; (c) ACW (tony@kwent.com)
 *  V 0.2; 2004-11-03; (c) ACW (tony@kwent.com)
 *  V 0.3; 2004-11-07; (c) ACW (tony@kwent.com)
 *  V 0.4; 2004-12-11; (c) ACW (tony@kwent.com)
 *	V 0.45;2005-01-11; (c) ACW (tony@kwent.com)
 *************************************************************************************/
/* Rev. History
 * V 0.4:	arbitrary order of mime parts, escape single quotes, catch invalid jpegs
 *			before trying to resize them, handle mails with empty message-id
 * V 0.45:  added stripfoot(see below); enable inline images
 *************************************************************************************/

/*************************************************************************************
 *	Disclaimer/License:
 *	Did this for my personal fun. Don't blame me for anything.
 *	Licensed under MLL (My Little License):
 *		MLL:	Use it for free if you like it.
 *				Modify it, get rich with it if you've got a chance to.
 *				Acknowledge me visual if you think it's worth it.
 *				Keep this disclaimer in the source.
 *	Feedback:
 *	- welcome at tony@kwent.com
 *************************************************************************************/

/*************************************************************************************
 *	Purpose:
 *	Having a mobile phone with a built in cam and email capability?
 *	Want to publish your thoughts and images from the top of the mountain you just
 *  climbed instantly to your website?
 *	Try KMB, my little MailBlogger Utility.
 *	It connects to a certain mailaccount, grabs Emails with a certain Subject, by
 *  which it identifies regular entries.
 *	It extracts the text and attached images of a certain kind (see below) and saves
 *	the text and the original images to a database and the filesystem respectively.
 *	It resizes the images to a standard size chosen.
 *	It also rotates the images if necessary.
 *	It keeps the original(rotated) one as well as the resized to allow a preview 
 *	and a full view.
 *	Have fun
 *************************************************************************************/

/*************************************************************************************
 *	Requirements:
 *	- PHP 4.something I suppose
 *	- compiled with IMAP & GD support
 *  - a POP3 or IMAP capable mailaccount
 *************************************************************************************/

/*************************************************************************************
 *	Usage:
 *	- Create a mailaccount fulfilling the requirements stated above
 *	- Create a database table using the sql script found below
 *	- Create a directory for the images accessible by php
 *	- Choose if you want the script to be run standalone or included into your portal
 *	- Run it or include it wherever
 *	Posting:
 *	- Send an email to the Blog Account having the appropriate subject defined below
 *  - Attach images to your mail (preferrably jpgs, since they're known to work)
 *	- If you need your images to be rotated, add >90, >-90, or >180 to the subject
 *	  all(!!) images of that mail will then be rotated(90 is in degrees and clockwise)
 *	- mails having a subject other than the one defined are being deleted!!!
 *************************************************************************************/

/*************************************************************************************
 *	Limitations:
 *	- a lot ;-)
 *	- images other than jpg-likes are not resized and rotated
 *	- I suppose there are decoding issues with 'strange' encodings
 *	- Deletion of processed mails is not guaranteed (POP3 non-support of Mailflags?!)
 *	- (so have a look at your mail account from time to time)
 *	- no editing of posts other than via db-client tool
 *************************************************************************************/


/*************************************************************************************
 *	Configuration:
 *	set the following parameters to your needs; xxxx needs to be replaced
 *************************************************************************************/
 
// run this script standalone? (or include it elsewhere)
   $blogstandalone = false;		//true|false
// consider emails having a certain Subject only; simple security measure
   $SubjectCode = "xxxx";

// define a directory where attached images are stored; php should have read and 
// write access to it
   $imgDir = "./xxx/xxx/";

// set the timezone of your blog   
   $blogtimezone = +1;

// POP3 data of the account where blogmails are sent to; 110 is the POP3 port number
// to change this to imap, see the php documentation for "imap_open(...)"
   $ServerName = "{mysite.com/pop3:110}INBOX";   
   $UserName = "xxxxxxxxx";
   $PassWord = "xxxxxxxxx";
   
// define allowed attachment types; Case sensitive!!
// NOTE: if you define for example php here, someone can mail you a php-script and
// execute it; this may be very useful, but it may be extremly harmful too.
   $atttypes = "jpeg|jpg|png|gif|JPG|JPEG";

// some providers attach annoying footers; if they start with a certain string, we
// can strip them
   $stripfoot = "----";
   
// images received will be resized (needs PHP with GD support)
// !! so far only jpg, jpeg, JPG & JPEG!!
   $forcedwidth  = "300"; //width
   $forcedheight = "200"; //height
   $imgcomp      = "0";   // 0...best quality, 100...most compressed


// database connection
   $DatabaseName = "xxxxxxxx";
   $DbHostName   = "xxxxxxxx";
   $DbUserName   = "xxxxxxxx";
   $DbPassWord   = "xxxxxxxx";
   $DbBlogTab    = "xxxxxxxx";
   
// sql-script to create the table 'blogtab'; run it in your db-client, e.g. mysqladmin
/*
#
# Table structure for table 'XXXXXXXXXX'
#

CREATE TABLE `XXXXXXXXXX` (
  `blid` int(8) unsigned zerofill NOT NULL auto_increment,
  `origuid` varchar(64) default NULL,
  `bldate` datetime default '0000-00-00 00:00:00',
  `bltxt` text,
  `blimg` varchar(30) default NULL,
  PRIMARY KEY  (`blid`)
) TYPE=MyISAM;
*/

/*	END OF CONFIGURATION ***************************************************************/


// some functions  -------------------------------------------
   function get_mime_type(&$structure) {
   	$primary_mime_type = array("TEXT", "MULTIPART","MESSAGE", "APPLICATION", "AUDIO","IMAGE", "VIDEO", "OTHER");
   	if($structure->subtype) {
   	return $primary_mime_type[(int) $structure->type] . '/' .$structure->subtype;
   	}
   	return "TEXT/PLAIN";
   }
   function get_part($stream, $msg_number, $mime_type, $structure = false,$part_number    = false) {
   
   	if(!$structure) {
   		$structure = imap_fetchstructure($stream, $msg_number);
   	}
   	if($structure) {
   		if($mime_type == get_mime_type($structure)) {
   			if(!$part_number) {
   				$part_number = "1";
   			}
   			$text = imap_fetchbody($stream, $msg_number, $part_number);
   			if($structure->encoding == 3) {
   				return imap_base64($text);
   			} else if($structure->encoding == 4) {
   				return imap_qprint($text);
   			} else {
   			return $text;
   			}
   		}
   
		if($structure->type == 1) /* multipart */ {
   			while(list($index, $sub_structure) = each($structure->parts)) {
   				if($part_number) {
   					$prefix = $part_number . '.';
   				}
   				$data = get_part($stream, $msg_number, $mime_type, $sub_structure,$prefix .    ($index + 1));
   				if($data) {
   					return $data;
   				}
   			}
   		}
   	}
   	return false;
   }
   
   function write_to_fs($fileContent, $fileName, $imgDir, $angle) {
    global $forcedwidth, $forcedheight, $imgcomp; 

//	create unique filename
	$ext = explode(".", $fileName);
    $nfn = "i" . substr(md5(uniqid(rand())),0, 15) . '.' . $ext[1];
//	save file to file system   	    
    $ih = fopen($imgDir . $nfn, "w");
//    $fileContent = imap_base64($fileContent);
    $fileContent = base64_decode($fileContent);

//	fputs($ih, imap_base64($fileContent), strlen(imap_base64($fileContent)));
	fputs($ih, $fileContent, strlen($fileContent));
	fclose($ih);
	$rfn = $nfn;
	
	$sourcefile   = $imgDir . $nfn;
//	rotate file
	$nnfn = $nfn;
	if($angle == "90" || $angle == "-90" || $angle == "180") {
		$xfn = ereg_replace("^i", "x", $nfn);
		$rotfile = $imgDir . $xfn;		
		if ($rot = rotateimage($sourcefile, $rotfile, $angle)) {
			$nnfn	 = $xfn;
			$sourcefile = $rotfile;
			$rfn = $xfn;
		}
	}
//	resize file (either the original oder the rotated one)
	$dfn 		  = ereg_replace("^(x|i)", "r", $nnfn);
	$destfile	  = $imgDir . $dfn;
	if($ext[1]=="jpg" || $ext[1]=="jpeg" || $ext[1]=="JPG" || $ext[1]=="JPEG") {
		if($res = resampimagejpg ($forcedwidth, $forcedheight, $sourcefile, $destfile, $imgcomp)){
			$rfn = $dfn;
		}
	}
   	return $rfn;
   }

   function write_to_db($msgBody, $fn, $date, $origuid) {
		global $blogtimezone, $DbBlogTab;

//      convert date
		$tdate = strtotime($date); //convert to timestamp
		$ndate = gmdate("Y-m-d H:i", $tdate + 3600*($blogtimezone)); //format date from timestamp
//      save entry to db
    	$blog_ins = "INSERT INTO " . $DbBlogTab . "(blid, origuid, bldate, bltxt, blimg) VALUES ('', '$origuid', '$ndate', '$msgBody', '$fn')";
        $bl_res   = mysql_query($blog_ins);
        if ($bl_res) {
        	return true;
        }
		return false;
   }
   
   function resampimagejpg($forcedwidth, $forcedheight, $sourcefile, $destfile, $imgcomp) {
   
   $g_imgcomp=100-$imgcomp;
   $g_srcfile=$sourcefile;
   $g_dstfile=$destfile;
   $g_fw=$forcedwidth;
   $g_fh=$forcedheight;

   if(file_exists($g_srcfile)) {
       $g_is=getimagesize($g_srcfile);
       if($g_is[0] > $g_fw || $g_is[1] > $g_fh) {
       		if(($g_is[0]-$g_fw)>=($g_is[1]-$g_fh)) {
       		    $g_iw=$g_fw;
       		    $g_ih=($g_fw/$g_is[0])*$g_is[1];
       		}
       		else {
       		    $g_ih=$g_fh;
       		    $g_iw=($g_ih/$g_is[1])*$g_is[0];    
       		}
       		if ($img_src=@imagecreatefromjpeg($g_srcfile))
       		{
       			$img_dst=imagecreatetruecolor($g_iw,$g_ih);
       			imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, $g_iw, $g_ih, $g_is[0], $g_is[1]);
       			imagejpeg($img_dst, $g_dstfile, $g_imgcomp);
       			imagedestroy($img_dst);
       			return true;
       		} else { return false; }
       }
       else
       		return false;
   }
   else
   		return false;

   }
   
   function rotateimage($sourcefile, $destfile, $angle) {
//	rotation is clockwise!!
   	$img_src = imagecreatefromjpeg($sourcefile);
    $g_is=getimagesize($sourcefile);
    if ($angle == 90 || $angle == -90) {
	    $img_dst=imagecreatetruecolor($g_is[1],$g_is[0]);
	    $nw = $g_is[1];
	    $nh = $g_is[0];
	}
	else {	// its 180 or 360
		$img_dst=imagecreatetruecolor($g_is[0],$g_is[1]);
		$nw = $g_is[0];
		$nh = $g_is[1];
	}

   	$rotate = imagerotate($img_src, 360-$angle, 0);
    imagecopyresampled($img_dst, $rotate, 0, 0, 0, 0, $nw, $nh, $nw, $nh);
   	imagejpeg($img_dst, $destfile);
    imagedestroy($img_dst);
   	return true;

   }

   
   function check_msgid_new($msgid) {
   		global $DbBlogTab;
   		$mquery = "SELECT COUNT(*) AS moid FROM " . $DbBlogTab . " WHERE origuid = '$msgid'";
   		$mres   = mysql_query($mquery);
   		$moid = true;
		if($tmoid = mysql_result($mres, "0", "moid")) {
				$moid = false;
    	}
    	return $moid;
   }

// no more functions ----------------------------------------


   $attregexp = "(.(" . $atttypes . "))$";

   mysql_connect("$DbHostName", "$DbUserName", "$DbPassWord");
   mysql_select_db("$DatabaseName") or die ("Unable to connect to SQL Server");
   
   if ( $mbox = imap_open($ServerName, $UserName,$PassWord, CL_EXPUNGE) ){  
     if ($hdr = imap_check($mbox)) { 
	   	$msgCount = $hdr->Nmsgs;
	   	if ($msgCount > 0) { 
   			$MN=$msgCount;
   			$overview=imap_fetch_overview($mbox,"1:$MN",FT_UID);   			   			
   			$size=sizeof($overview);
      
   			for($i=0;$i<=$size-1;$i++){ 
   				$val=$overview[$i];
				$msgno=$val->msgno;
				$from=$val->from;
  				$date=$val->date;
  	$msgid = substr(md5($from . $date . $val->message_id),0, 15);		

				$subj=$val->subject; 
				$subj1 = imap_mime_header_decode($subj);  //decode 8859 subject
				$subj2 = explode(">", $subj1[0]->text);	  // see if we need to rotate
				$angle = '';
				if (isset($subj2[1])) {
					$angle = $subj2[1];
				}
				$recent = $val->recent;
				$flagged = $val->flagged;
   				$seen=$val->seen;
   				
	   			$from = ereg_replace("\"","",$from);
      			$uid = $val->uid;
      			
				if ($subj2[0] == $SubjectCode && check_msgid_new($msgid)) {
//					consider $seen??				
// 					get text body
   					$dataTxt = get_part($mbox, $msgno, "TEXT/PLAIN");
   					$msgBody = ereg_replace("\n","<br>",$dataTxt);
//                   
   					$msgBody = ereg_replace("(<br>[^a-zA-Z0-9]*)+$", '', $msgBody); 
					//multiple <br>'s at the end into one

					// replace footers
					if ($stripfoot != "") {
						$msgBody = ereg_replace($stripfoot . ".*", '', $msgBody);
					}

					$msgBody = ereg_replace("'", "&#039;", $msgBody); // replace single quotes

					$mailformat = "text";

//					enter the textpart into the database   					
   					$db = write_to_db($msgBody, '', $date, $msgid);

//					get attachments if any
   					$struct = imap_fetchstructure($mbox,$msgno);
   					$structpart = $struct->parts;		
   					$contentParts = count($struct->parts);
   
   					if ($contentParts >= 2) { 
						for ($j=1;$j<=$contentParts;$j++) {
   							$att[$j-1] = imap_bodystruct($mbox,$msgno,$j);
   						}
   						for ($k=0;$k<sizeof($att);$k++) {
   							if ($att[$k]->parameters[0]->value == "us-ascii" || $att[$k]->parameters[0]->value    == "US-ASCII") {
 //								accept only certain image types (Case sensitive!!)------  								
  								if (ereg($attregexp, $att[$k]->parameters[1]->value) || ereg($attregexp, 'x' . $structpart[$k]->subtype)) {
   									$fileContent = imap_fetchbody($mbox,$msgno,$k+1);
 									$fileName	 = $att[$k]->parameters[1]->value;
 									 //	if filename is empty set it to a temporary using the mime subtype as fileext 									
									 if ($fileName == "") { $fileName = "temp." . $structpart[$k]->subtype; }
 //									write file to file system & record to db
 									$new_fileName = write_to_fs($fileContent, $fileName, $imgDir, $angle);
 									$db = write_to_db($msgBody, $new_fileName, $date, $msgid);
 									if ($db) {
 										$status = imap_clearflag_full ($mbox, imap_uid($mbox,$msgno), "\\SEEN", SE_UID);
 									}
   								}
   							} 
   							elseif ($att[$k]->parameters[0]->value != "iso-8859-1" &&    $att[$k]->parameters[0]->value != "ISO-8859-1") {
 //								accept only certain image types (Case sensitive!!)------  								
 								if (ereg($attregexp, $att[$k]->parameters[1]->value) || ereg($attregexp, 'x' . $structpart[$k]->subtype)) {
   									$fileContent = imap_fetchbody($mbox,$msgno,$k+1);
									$fileName	 = $att[$k]->parameters[1]->value;
 //									if filename is empty set it to a temporary using the mime subtype as fileext 									
  									if ($fileName == "") { $fileName = "temp." . $structpart[$k]->subtype; }
 //									write file to file system & record to db
							 		$new_fileName = write_to_fs($fileContent, $fileName, $imgDir, $angle);
 									$db = write_to_db($msgBody, $new_fileName, $date, $msgid);
 									if ($db) {
 										$status = imap_clearflag_full ($mbox, imap_uid($mbox,$msgno), "\\SEEN", SE_UID);
 									}
   								}
   							}
   						}
   					}
   					else {
   						if ($db) {
							$status = imap_clearflag_full ($mbox, imap_uid($mbox,$msgno), "\\SEEN", SE_UID);
						}
					}
				}   
   				else {
  					$status = imap_setflag_full ($mbox, $msgno, "\\Deleted");
   				}
			}
		}
	 }
   	 imap_close($mbox);
   }

// now we output the whole stuff

$show_query = "SELECT * FROM " . $DbBlogTab . " order by blid desc";
$show_res   = mysql_query($show_query);
$oldoid = '';

if ($standalone) {
?>
	<HTML><HEAD><TITLE>MailBlogger by ACW</TITLE>
				<script type="text/javascript">
			function popitup(url, name, width, height)
			{
				var scrstr='';
				if(width>=800 || height >=600) { width=800; height=600; scrstr=',scrollbars=yes,resizable=yes'; } 
				var popsize = 'height=' + height + ',width='+width+scrstr;
				window.open(url,name,popsize);
				return false;
		}
	
		</HEAD>
		<BODY>
<?
}

echo '<CENTER><I><B>My Moblog</B></I></CENTER><BR><BR>';

while ($drec = mysql_fetch_array ($show_res)) {
	$sep = "<BR>";
	if ($drec["origuid"] !=  $oldoid ) {
		echo '<B>' . date("Y/m/d H:i", strtotime($drec["bldate"])) . '</B>' . '<BR>';
		echo '<I>' . $drec["bltxt"] . '</I>';
		$oldoid = $drec["origuid"];
		$sep = "<BR><BR>";
	}
	if (strlen($drec["blimg"]) > 0) {
		$oimg = ereg_replace("r", "x", $drec["blimg"]);
	    if(!file_exists($imgDir . $oimg)) {
	    	$oimg = ereg_replace("x", "i", $oimg);
	    }
		$isiz = getimagesize($imgDir . $oimg);
		$wiwi = $isiz[0];
		$wihe = $isiz[1];	
		echo '<BR><A HREF="#" onclick="popitup(\'xxxx.php?img='.$oimg.'\', \'Details\', \''.$wiwi.'\', \''.$wihe.'\'); ">';
// create xxx.php to show the full image!!!
	   	echo '<IMG SRC="' . $imgDir . $drec["blimg"] . '" border="0"></A>';
	}
	echo $sep;
}
if ($standalone) {
	echo '</BODY></HTML>';
}
?>
















