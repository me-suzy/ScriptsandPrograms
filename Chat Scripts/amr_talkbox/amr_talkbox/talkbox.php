<?php

//------------------------------------------------------------------------------------------------------//
//																										//
//--->									   Talkbox Beta Version										<---//
//--->								 Created By AMR Graphics Dec. 2004								<---//
//--->						All Rights Reserved By AMR GraphicsÆ 1998 - 2005©						<---//
//--->			This is a freeware script and may be redistributed and/or edited as needed			<---//
//--->		     Please remember to give credit where credit is due. Thanks for using AMR. 			<---//
//																										//
//------------------------------------------------------------------------------------------------------//
//                                 							                                            //
//                       Multilanguage revision added by Bigh72 4 UltrasPice 04 - 2005     		        //
//                          www.ultraspice.it or www.casagrandeweb.altervista.org                       //
//                                                                                                      //
//------------------------------------------------------------------------------------------------------//

//--->	This is where the variables start, edit them to match your needs.
//--->	These are the CSS linking areas, place info as needed.

$link_css = "text.css";									//--->	Direct URL to your cascading style sheet.
$font_class = "sml-10reg";								//--->	Name of main font style you want to use.
$font_header = "lrg-11reg";								//--->	Name of main font style for headings in script pages.
$lang = "eng";											//--->	This is where you choose your language of preference.

//--->	Adjust Time (enter -12 to 12 to alter the time displayed under the posters name).

$adjust_time = "3";										//--->	If your not sure about time adjustments, just set it to "0".

//--->	Language and control area, creat a new language kit and email us. "info@amrgraphics.com"

$direct = "languages";									//--->	The folder/directory that contain the language kits.

if ($lang == "eng") {
  include ("$direct/lang_eng.txt");
} elseif ($lang =="ita") {
  include ("$direct/lang_ita.txt");
}

//--->	Should a scollbar be presented on any of the talkbox pages? (Yes or No)

$scrollbar_1 = "No";									//--->	This is the scrollbar for the main talkbox page.
$scrollbar_2 = "Yes";									//--->	This is the scrollbar for post/help pages.

//--->	Below are the text and page backgrounds in image or hex coloring.

$col_text = "#FFFFFF";									//--->	Standard text posting colour.
$back_col = "images/backgrounds/bckgrd_darkgry.gif";	//--->	Set your background for the pop-up windows.
$back_img = "images/backgrounds/bckgrd_talkbox.jpg";	//--->	Set your background with a hex color or an image.

//--->	These color settings are for setting colors of backgrounds, scrollbars, etc.

$colcode_1 = "#000000";									//--->	Border color of table used on the Help Code page.
$colcode_2 = "#768392";									//--->	Used to change the background color of the table behind the image icon in help area.
$colcode_3 = "#000000";									//--->	not available yet.

//--->	These are the text field colours.

$colcode_4 = "#000000";									//--->	Form text and post border color.
$colcode_5 = "#6E7B8B";									//--->	Form background color for the text fields.
$colcode_6 = "#6E7B8B";									//--->	Form background color for the post button.

//--->	Link colors displayed on the screen.

$collink_1 = "#A7D7E1";									//--->	not available yet.
$collink_2 = "#A7D7E1";									//--->	not available yet.
$collink_3 = "#A7D7E1";									//--->	Standard text link and name.

//--->	These are the colours for the table backgrounds and/or borders.

$coltabl_1 = "#768392";									//--->	First, Forth, Seventh, talkbox window etc.
$coltabl_2 = "#6E7B8B";									//--->	Second, Fifth, Eighth, talkbox window etc.
$coltabl_3 = "#596A7C";  								//--->	Third, Sixth, Ninth, talkbox and information window.

//--->	This is the table border color adjustment section.

$coltablbdr_1 = "#000000";								//--->	Used to change the colour of certain borders on select tables, such as the postings page.
$coltablbdr_2 = "#000000";								//--->	not available yet.
$coltablbdr_3 = "#000000";								//--->	not available yet.

//--->	Maximum amount of characters allowed per posting fields in submit form.

$max_char_sbox = 45;									//--->	Max length of your input text boxes.
$max_char_name = 15;									//--->	Max amount of characters allowed in name field.
$max_char_web = 50;										//--->	Max amount of characters allowed in website field.
$max_char_mess = 250;									//--->	Max amount of characters allowed in message field.
$char_max =30;											//--->	Max word length, this will chop your word up if to long.

//--->	Image and all it's adjustments, editing is optional and mainly for astetics for submitting of form.

$image_location = "images/misc/transparent.gif";		//--->	Location of image on server.
$image_alt_name = "transparent pixels";					//--->	Alternate name of this image.
$image_height = 5;										//--->	Image height in pixels or percentage.
$image_heightsec = 1;									//--->	Image height in pixels or percentage.
$image_width = 100;										//--->	Image width in pixels or percentage.

//--->	This controls the opening of the new windows when the posting and code links are pressed.

$title_post = "Talkbox | $allpost";						//--->	Title of the posting page.
$target_post = "_blank";								//--->	All postings will be posted in the targeted area.
$wid_post = 375;										//--->	The height of the window that will be opened for the postings.
$hid_post = 535;										//--->	The width of the window that will be opened for the postings.

$title_help = "Talkbox | $hlpcod";						//--->	Title of the code page.
$target_help = "_blank";								//--->	All help will be posted.
$wid_help = 375;										//--->	The height of the window that will be opened for the codes.
$hid_help = 535;										//--->	The width of the window that will be opened for the codes.

//---> TalkBox Title, Version, Etc... These variables are for informational use only do not edit, PLEASE.

$main_title = "Talkbox";										//--->	Title to this TalkBox and page postings.
$version = "v2.44b";											//--->	Version to this TalkBox and page postings.
$url = "http://www.amrgraphics.com/";							//--->	Url link to creators website.
$copy = "<a href=\"$url\" target=\"_blank\">AMR®</a>";			//--->	Creators name poster.
$powered = "Powered By $copy $main_title $version";				//--->	Power information.

//--->	Do not edit below this line unless you know PHP scripting.
//--->	End of variables

$info = wordwrap($info, $char_max, " ", 1);
if ($act==add) {

//--->	Start adding postings

$name = strip_tags($name,"");

if ($site == "http://") {
$name_link = "$name";
} elseif ($site == "") {
$name_link = "$name";
} else {
$name_link = "<a href=\"$site\" target=\"_blank\">$name</a>";

}

if ($name == "$def_name") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php?message=Enter+Name&info2=$info&site2=$site\">";						//--->	Change content=\0;
} elseif ($name == "") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php?message=Enter+Name&info2=$info&site2=$site\">";						//--->	Change content=\0;
} elseif ($info == "") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php?message=Enter+Message&name2=$name&site2=$site\">";						//--->	Change content=\0;
} elseif ($info == "$def_msg") {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php?message=Enter+Message&name2=$name&site2=$site\">";						//--->	Change content=\0;
} elseif (strlen($info)>$max_char_mess) {
	print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php?message=Max+Characters+($max_char_mess)&name2=$name&site2=$site\">";	//--->	Change content=\0;
} else {

$file = "talkbox.txt";

//--->	Start TalkBox coding Faces/Swear/etc...

	$info = strip_tags($info,"");
	$info = str_replace(":D","<img src='images/faces/big_grin.gif' align='absmiddle'>",$info);
	$info = str_replace(":P","<img src='images/faces/big_razz.gif' align='absmiddle'>",$info);
	$info = str_replace(":?","<img src='images/faces/confused.gif' align='absmiddle'>",$info);
	$info = str_replace("8)","<img src='images/faces/cool_dude.gif' align='absmiddle'>",$info);
	$info = str_replace(":[","<img src='images/faces/cry_baby.gif' align='absmiddle'>",$info);
	$info = str_replace("8/","<img src='images/faces/eecky.gif' align='absmiddle'>",$info);
	$info = str_replace(":>","<img src='images/faces/evil_happy.gif' align='absmiddle'>",$info);
	$info = str_replace(":<","<img src='images/faces/evil_mad.gif' align='absmiddle'>",$info);
	$info = str_replace(":l","<img src='images/faces/frowner.gif' align='absmiddle'>",$info);
	$info = str_replace(":g","<img src='images/faces/greeny.gif' align='absmiddle'>",$info);
	$info = str_replace(":@","<img src='images/faces/mad.gif' align='absmiddle'>",$info);	
	$info = str_replace(":|","<img src='images/faces/neutral.gif' align='absmiddle'>",$info);
	$info = str_replace(":o","<img src='images/faces/redface.gif' align='absmiddle'>",$info);
	$info = str_replace("8]","<img src='images/faces/rolleyes.gif' align='absmiddle'>",$info);
	$info = str_replace("8D","<img src='images/faces/rotf.gif' align='absmiddle'>",$info);
	$info = str_replace(":(","<img src='images/faces/sad.gif' align='absmiddle'>",$info);
	$info = str_replace(":)","<img src='images/faces/smile.gif' align='absmiddle'>",$info);
	$info = str_replace("')","<img src='images/faces/surprised.gif' align='absmiddle'>",$info);
	$info = str_replace(";)","<img src='images/faces/wink.gif' align='absmiddle'>",$info);
	$info = str_replace(";x","<img src='images/faces/z_gunner.gif' align='absmiddle'>",$info);
	$info = str_replace("[url]","<a href=\"",$info);
	$info = str_replace("[/url]","\" target=\"_blank\">[ website ]</a>",$info);
	$info = str_replace("[mail]","<a href=\"mailto:",$info);
	$info = str_replace("[/mail]","\">[ email ]</a>",$info);
	$info = str_replace("$cenword_1","$censored_1",$info);
	$info = str_replace("$cenword_2","$censored_2",$info);
	$info = str_replace("$cenword_3","$censored_3",$info);
	$info = str_replace("$cenword_4","$censored_4",$info);
	$info = str_replace("$cenword_5","$censored_5",$info);
	$info = str_replace("$cenword_6","$censored_6",$info);
	$info = str_replace("$cenword_7","$censored_7",$info);
	$info = str_replace("$cenword_8","$censored_8",$info);
	$info = str_replace("$cenword_9","$censored_9",$info);
	$info = str_replace("$cenword_10","$censored_10",$info);
	$info = str_replace("$cenword_11","$censored_11",$info);
	$info = str_replace("$cenword_12","$censored_12",$info);
	$info = str_replace("$cenword_13","$censored_13",$info);
	$info = str_replace("$cenword_14","$censored_14",$info);
	$info = str_replace("$cenword_15","$censored_15",$info);
	$info = stripslashes($info);
	$name = stripslashes($name);
	$name_link = stripslashes($name_link);

//--->	End TalkBox coding

//--->	Start to add content to Talkbox

$date = date("G:i", time());

$date_array = explode("-", $date);

$new = $date_array[0] + $adjust_time;									//--->	Time of server to adjust, use variable adjust_time un set up area. 

$daten = date("l, dS of F Y @ $new:i", time());							//--->	Date will display as follows: "Saturday, 27th of November 2004 @ 16:30"

print "<meta http-equiv=\"refresh\" content=\"0; URL=talkbox.php\">";

$fp = fopen ($file, "r+") or die ("error when opening $file");
flock($fp,2);
$old=fread($fp, filesize($file));
rewind($fp);
fwrite ($fp, "<b>$name_link</b>: $info<br>$daten<br>\n".$old);
flock($fp,3);
fclose ($fp);

//--->	Stop adding content to TalkBox

}

//--->	Stop adding to TalkBox

} elseif ($act==all) {

//--->	 Start to display the HTML (TalkBox) to the screen

print "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<meta name=\"robots\" content=\"noindex, nofollow\">
<title>$title_post</title>
<link rel='stylesheet' href='$link_css' type='text/css'>
</head><body background=\"$back_col\" bgproperties=\"fixed\" scroll=\"$scrollbar_2\" leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\" topmargin=\"0\">";

		$file = "talkbox.txt";
		$fp = fopen ($file, "r") or die ("error when reading $file");
		while ( !feof ($fp) ) {
		$all_posts = fgets ($fp, 9997);

print "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"2\" bgcolor=\"$colcode_1\" bordercolor=\"$coltablbdr_1\">
        <tr> 
          <td bgcolor=\"$coltabl_3\"><p class=\"$font_class\">$all_posts</p></td>
        </tr>
   	</table>";
}

print "<p class=\"$font_class\" align=\"center\" valign=\"middle\">| <a href=\"javascript:self.close()\">$clo_wdw</a> |</p></body></html>";

//--->	 Stop displaying the HTML (TalkBox) to the screen

} elseif ($act == "help") {

//--->	Start to display the HTML (TalkBox Help Area) to the screen

print "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<meta name=\"robots\" content=\"noindex, nofollow\">
<title>$title_help</title>
<link rel='stylesheet' href='$link_css' type='text/css'>
</head><body background=\"$back_col\" bgproperties=\"fixed\" scroll=\"$scrollbar_2\" leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\" topmargin=\"0\">
			<p class=\"$font_class\">
			<table bgcolor=\"$colcode_2\" align=\"center\" width=\"100%\" height=\"\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"border: 1px solid #000000\">
			<tr bgcolor=\"$coltabl_3\">
				<td align=\"center\" valign=\"middle\"><p class=\"$font_header\">AMR TalkBox Help Codes</p></td>
			</tr>
			<tr bgcolor=\"$coltabl_3\">
				<td align=\"center\" valign=\"middle\"><p class=\"$font_class\">$line_01</p></td>
			</tr>
			</table>
		<br>
			<table bgcolor=\"$colcode_2\" align=\"center\" width=\"100%\" height=\"\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"border: 1px solid #000000\">
			<tr bgcolor=\"$coltabl_3\">
				<td align=\"center\" valign=\"middle\"><p class=\"$font_class\">$line_02</p></td>
			</tr>
			<tr bgcolor=\"$coltabl_3\">
				<td align=\"center\" valign=\"middle\"><p class=\"$font_class\">$line_03</p></td>
			</tr>
			</table>
		<br>
			<table bgcolor=\"$colcode_2\" align=\"center\" width=\"100%\" height=\"300\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"border: 1px solid #000000\">
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_header\">$tabhead</p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_header\">Smiley</p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_header\">$tabhead</p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_header\">Smiley</p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :D </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/big_grin.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :p </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/big_razz.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :? </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/confused.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis 8) </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/cool_dude.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		    <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :[ </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/cry_baby.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis 8/ </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/eecky.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :> </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/evil_happy.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :< </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/evil_mad.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :l </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/frowner.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :g </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/greeny.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :@ </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/mad.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :| </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/neutral.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :o </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/redface.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis 8] </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/rolleyes.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		    <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis 8D </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/rotf.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :( </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/sad.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis :) </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/smile.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis ') </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/surprised.gif\" align=\"absmiddle\"></p></td>
       		 </tr>
       		 <tr bgcolor=\"$coltabl_3\">
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis ;) </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/wink.gif\" align=\"absmiddle\"></p></td>
				<td width=\"2%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"10\" width=\"10\"></p></td>
				<td width=\"34%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\">$usthis ;x </p></td>
				<td width=\"15%\" align=\"center\" valign=\"middle\"><p class=\"$font_class\"><img src=\"images/faces/z_gunner.gif\" align=\"absmiddle\"></p></td>
       		 </tr> 
			</table>
		<br>
			<table bgcolor=\"$colcode_2\" align=\"center\" width=\"100%\" height=\"\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"border: 1px solid #000000\">
			<tr bgcolor=\"$coltabl_3\"> 
		  		<td align=\"center\" valign=\"middle\"><p class=\"$font_header\">$line_04<br></p></td>
			</tr>
			<tr bgcolor=\"$coltabl_3\">
				<td align=\"center\" valign=\"middle\"><p class=\"$font_class\">$line_05 $main_title $line_06 $version.</p></td>
			</tr>
			</table>
		<br>
			<table bgcolor=\"$colcode_2\" align=\"center\" width=\"100%\" height=\"\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\" style=\"border: 1px solid #000000\">
			<tr bgcolor=\"$coltabl_3\">
				<td><p class=\"$font_class\" align=\"center\" valign=\"middle\">| <a href=\"javascript:self.close()\">$clo_wdw</a> |</p></td>
			</td>
			</table></p></body></html>";

//--->	Stop displaying the HTML (TalkBox Help Area) to the screen

} else {

//--->	Start to display the TalkBox postings on screen

$file = "talkbox.txt";
$fp = fopen ($file, "r+") or die ("error when reading $file");
$mess = file($file);

if ($name2 == "$name" ) { $name2 = "$def_name"; }		//--->	Change "NAME" and it'll be changed on the screen in your TalkBox.

if ($site2 == "$site" ) { $site2 = "http://"; }		//--->	Change "HTTP://" and it'll be changed on the screen in your TalkBox.

if ($info2 == "$info" ) { $info2 = "$def_msg"; }		//--->	Change "MESSAGE" and it'll be changed on the screen in your TalkBox.


print "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<meta name=\"robots\" content=\"noindex, nofollow\">
<title>$main_title $version</title>
<link rel=\"stylesheet\" href=\"$link_css\" type=\"text/css\">
</head>
<body background=\"$back_img\" bgproperties=\"fixed\" scroll=\"$scrollbar_1\" leftmargin=\"0\" marginheight=\"0\" marginwidth=\"0\" topmargin=\"0\">";

print "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bordercolor=\"$colcode_1\">
  <tr>
    <td> 
      <table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" bgcolor=\"$colcode_1\" bordercolor=\"$coltablbdr_1\">
        <tr> 
          <td bgcolor=\"$coltabl_1\"><p class=\"$font_class\" color=\"$col_text\">$mess[0]</p></td>
        </tr>
        <tr>
          <td bgcolor=\"$coltabl_2\"><p class=\"$font_class\" color=\"$col_text\">$mess[1]</p></td>
        </tr>
        <tr>
          <td bgcolor=\"$coltabl_3\"><p class=\"$font_class\" color=\"$col_text\">$mess[2]</p></td>
        </tr>
        <tr>
          <td bgcolor=\"$coltabl_1\"><p class=\"$font_class\" color=\"$col_text\">$mess[3]</p></td>
        </tr>
        <tr>
          <td bgcolor=\"$coltabl_2\"><p class=\"$font_class\" color=\"$col_text\">$mess[4]</p></td>
        </tr>
        <tr>
          <td bgcolor=\"$coltabl_3\"><p class=\"$font_class\" color=\"$col_text\">$mess[5]</p></td>
		</tr>
      </table>
    </td>
  </tr>
</table>";	

print "<table>
			<form name=\"input\" method=\"post\" action=\"talkbox.php?act=add\">
				<table class=\"$font_class\" width=\"0\" height=\"0\" border=\"0\" bordercolor=\"$colcode_4\" cellspacing=\"0\" cellpadding=\"0\">
					<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_height\" width=\"$image_width\"></p>
					<tr><td>
						<input class=\"$font_class\" type=\"text\" name=\"name\" value=\"$name2\" onfocus=\"this.value=''\" class=\"text\" style=\"border:1px solid $colcode_4; border-style: solid; background-color:$colcode_5;\" size=\"$max_char_sbox\" maxlength=\"$max_char_name\">	
					</td></tr>
					<tr><td>
						<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_heightsec\" width=\"$image_width\"></p>
					</td></tr>
					<tr><td>
						<input class=\"$font_class\" type=\"text\" name=\"site\" value=\"$site2\" class=\"text\" style=\"border:1px solid $colcode_4; border-style: solid; background-color:$colcode_5;\" size=\"$max_char_sbox\" maxlength=\"$max_char_web\">
					</td></tr>
					<tr><td>
						<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_heightsec\" width=\"$image_width\"></p>
					</td></tr>
					<tr><td>
						<input class=\"$font_class\" type=\"text\" name=\"info\" value=\"$info2\" onfocus=\"this.value=''\" class=\"text\" style=\"border:1px solid $colcode_4; border-style: solid; background-color:$colcode_5;\" size=\"$max_char_sbox\" maxlength=\"$max_char_mess\">
					</td></tr>
					<tr><td>
						<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_height\" width=\"$image_width\"></p>
					</td></tr>
					<tr>
					<td>
					<table width=\"250\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						<tr>
							<td align=\"left\" valign=\"middle\" width=\"40\"><input class=\"$font_class\" type=\"submit\" name=\"submit\" value=\"submit\" class=\"text\" style=\"border:1px solid $colcode_4; border-style: solid; background-color:$colcode_6;\"></td>
							<td align=\"left\" valign=\"middle\" width=\"5\"></td>
							<td align=\"left\" valign=\"middle\" width=\"205\"><p class=\"$font_class\">| <a href=\"#\" target=\"$target_post\" onclick=\"window.open('?act=all',this.target,'width=$wid_post,height=$hid_post'); return false;\" title=\"$title_post\">$allpost</a> | - | <a href=\"#\" target=\"$target_help\" onclick=\"window.open('?act=help',this.target,'width=$wid_help,height=$hid_help'); return false;\" title=\"$title_help\">$hlpcod</a> |</p></td>
						</tr>
					</table>
					</td</tr>
					<tr><td>
						<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_height\" width=\"$image_width\"></p>
					</td></tr>
					<tr><td>
						<p class=\"$font_class\">$message</b></p>
					</td></tr>
					<tr><td>
						<p class=\"$font_class\"><img src=\"$image_location\" alt=\"$image_alt_name\" height=\"$image_height\" width=\"$image_width\"></p>
					</td></tr>
					<tr><td>
						<p class=\"$font_class\">$powered</p>
					</td></tr>
				</table>
			</form>
		</table>
	</body>
</html>";

//--->	Stop displaying the TalkBox and posting it on screen

}

?>
					