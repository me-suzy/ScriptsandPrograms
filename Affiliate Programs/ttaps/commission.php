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

// get the affiliate nickname from the cookie
$nickname = (isset($_COOKIE[cookie_name_refer])) ? $_COOKIE[cookie_name_refer] : "";
$realcommission = 0;

// if the nickname is assigned then...
if ($nickname != "") {
	
	$userdatafile = affiliates_db_folder."/".$nickname.".dat";
	if (file_exists($userdatafile)) { // check to see if the affiliate exists
		$oldsales = fileread($userdatafile); // get his previous sold amount
		if ((isset($_GET['price'])) && (isset($_GET['percent']))) { // calculate the new commission
			$realcommission = ($_GET['price'] / 100) * $_GET['percent'];
		} elseif (isset($_GET['comm'])) {
			$realcommission = $_GET['comm'];
		}
		$newsales = $oldsales + $realcommission; // add the new commission to the already earned amount
		$salemade = $nickname."|".date("D F j H:i:s Y")."|sale\n";
		writetofile($userdatafile, $newsales); // update this datafile
		writetofile(main_db_folder."/".sales_data_file, $salemade, 'a'); // update the sales log
		$referredby = "";
		if (file_exists(main_db_folder."/".paired_data_file)) { // check to see if there is a referer to add commission too
			$pairedfile = explode("\n", fileread(main_db_folder."/".paired_data_file));
			for ($i = 0; $i < count($pairedfile); $i++) {
				if (trim($pairedfile[$i]) != "") {
					$paired_data = explode("|", trim($pairedfile[$i]));
					if ($nickname == $paired_data[0]) $referredby = $paired_data[1];
				}
			}
		}
		if ($referredby != "") { // and if there is then...
			$refererfile = affiliates_db_folder."/".$referredby.".dat"; // open the referer data file
			if (file_exists($refererfile)) {
				$referer_oldsales = fileread($refererfile); // get his earned amount
				$referer_newsales = $referer_oldsales + upline_comm; // add the referer commission
				$refermade = $referredby."|".date("D F j H:i:s Y")."|upline credit\n";
				writetofile($refererfile, $referer_newsales); // update his data file with the new amount
				writetofile(main_db_folder."/".sales_data_file, $refermade, 'a'); // update the sales log
			}
		}
	}
}

// redirect the user to the thank you url
header("Location: ".thanks_comm_url); ?>