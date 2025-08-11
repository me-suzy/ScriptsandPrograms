<? 
/*
TigerTom's Affiliate Program Software (TTAPS)
http://www.tigertom.com
http://www.ttfreeware.com

Copyright (c) 2005 T. O' Donnell

Released under the GNU General Public License, with the
following proviso: 

That the HTML of hyperlinks to the authors' websites
this software generates shall remain intact and unaltered, 
in any version of this software you make.
  
If this is not strictly adhered to, your licence shall be 
rendered null, void and invalid.
*/

require("functions.php");

$nick = "";
if ($_GET) $nick = (isset($_GET['affil'])) ? cleanvalue($_GET['affil']) : "";
if ($_POST) $nick = (isset($_POST['affil'])) ? cleanvalue($_POST['affil']) : "";

// if i´m passing the affiliates nickname then...
if ($nick!="") {
	
	$userdatafile = affiliates_db_folder."/".$nick.".dat";
	
	if (file_exists($userdatafile)) { // check to see if he´s a registered affiliate
		
		$getcodefile = template(affiliate_getcode_template); // get the html template
		$linksfile = template(redirect_links_file); // get all the redirect links
		$arrlinks = explode("\n", $linksfile);
		$affiliate_codes = "";
		for ($i = 0; $i < count($arrlinks); $i++) { // generate the code for each link
			if (trim($arrlinks[$i])!="") {
				list($param, $title, $link) = explode("|", $arrlinks[$i]);
				$alink = main_url.'affil.php?affil='.$nick;
				if ($param!="") $alink .= '&site='.$param;
				$affiliate_codes .= '<br><table align="center" border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse"><tr><th>'.$title.'</th></tr><tr align="center"><td><input type="text" size="70" value="'.$alink.'"><br>Test link: <a href="'.$alink.'" target="_blank">'.$title.'</a></td></tr></table>';
			}
		}
		$getcodefile = str_replace("[affiliate_codes]", $affiliate_codes, $getcodefile);
		echo $getcodefile;
		
	} else { // if he´s not a registered affiliate display an error
		
		$message = not_user_msg;
		error("Get code", $message);
		
	}
	
} else { // and if i´m not passing the affiliates nickname then display an error too
	
	$getcodeform = template(affiliate_getcodeenter_template);
	$getcodeform = str_replace("[title_affiliates]", title_affiliates, $getcodeform);
	echo $getcodeform;
	
}
?>


