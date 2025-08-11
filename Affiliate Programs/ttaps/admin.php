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

if (isset($_POST['action'])) {
	$action = cleanvalue($_POST['action']);
} elseif (isset($_GET['action'])) {
	$action = cleanvalue($_GET['action']);
} else {
	$action = "login";
}

switch ($action) {
	case "menu":
		showmenu();
		break;
	case "login":
		loginprocess();
		break;
	case "logsales":
		logsales();
		break;
	case "list":
		listsalers();
		break;
	case "erase":
		erase();
		break;
	case "seedata":
		seedata();
		break;
	case "logref":
		logref();
		break;
	case "cleanlogref":
		cleanlogref();
		break;
	case "cleanlogsales":
		cleanlogsales();
		break;
	case "search":
		search();
		break;
	case "composemail":
		writemsg();
		break;
	case "sendmail":
		sendmail();
		break;
	case "pay":
		pay();
		break;
	case "payall":
		payall();
		break;
	default:
		showlogin();
}

function loginprocess() { // process the login data
	if ((!isset($_POST['username'])) && (!isset($_POST['password']))) {
		showlogin();
	} else {
		$username = cleanvalue($_POST['username']);
		$userpass = cleanvalue($_POST['password']);
		if (($username != admin_name) && ($userpass != admin_pass)) { // if login is wrong show error message
			$errormsg = user_pass_wrong;
			error("Admin login", $errormsg);
		} else { // if it´s admin then show main menu
			showmenu();
		}
	}
}

function showlogin() { // show the login form
	$admin_enter = template(admin_enter_template);
	$admin_enter = str_replace("[title_affiliates]", title_affiliates, $admin_enter);
	echo $admin_enter;
}

function showmenu() { // show the main menu
	$varstoparse = array("title_affiliates", "money_unit");
	$totalaffiliates = 0;
	$waiting = 0;
	$total_sold = 0;
	if ($handle = opendir(affiliates_db_folder)) {
	    while (false !== ($file = readdir($handle))) { 
	        if ($file != "." && $file != ".." && $file != ".htaccess") {
				$usersold = fileread(affiliates_db_folder."/".$file);
				$total_sold = $total_sold + $usersold;
				$totalaffiliates++;
				if ($usersold > amount_paid) $waiting++;
	        } 
	    }
	    closedir($handle); 
	}
	$total_sold = number_format($total_sold / 100, 2);
	$payment_threshold = number_format(amount_paid / 100, 2);
	$adminmenu = template(admin_menu_template);
	$adminmenu = str_replace("[payment_threshold]", $payment_threshold, $adminmenu);
	$adminmenu = str_replace("[totalaffiliates]", $totalaffiliates, $adminmenu);
	$adminmenu = str_replace("[waiting]", $waiting, $adminmenu);
	$adminmenu = str_replace("[total_sold]", $total_sold, $adminmenu);
	for ($i = 0; $i < count($varstoparse); $i++) {
		$tosearch = "[".$varstoparse[$i]."]";
		$adminmenu = str_replace($tosearch, constant($varstoparse[$i]), $adminmenu);
	}
	echo $adminmenu;
}

// list affiliates with more than sold_query amount earned, paging by maximumpage records per page
function listsalers() { 
	$varstoparse = array("title_affiliates", "money_unit");
	$minsold = $_POST['sold_query'] * 100; // convert the dollar amount to cents
	$resultstemplate = template(admin_earnedlist_template);
	$affiliateslist = "";
	$paging_links = "";
	$affiliatestolist = array();
	if ($handle = opendir(affiliates_db_folder)) {
		// loop for all the affiliates and see if they have more than $minsold earned, if they do then add them to the list of affiliates to show
	    while (false !== ($file = readdir($handle))) { 
	        if ($file != "." && $file != "..") {
				$usersold = fileread(affiliates_db_folder."/".$file);
				if ($usersold > $minsold) {
					$usersold = number_format($usersold / 100, 2);
					$username = str_replace(".dat", "", $file);
					$affiliatestolist[] = "$username|$usersold";
				}
	        } 
	    }
	    closedir($handle); 
	}
	$page = (isset($_POST['page'])) ? $_POST['page'] : 1; // page to display
	$display = $_POST['maximumpage']; // affiliates per page to display
	$start = ($page * $display) - $display;
	$finish = $start + $display;
	$total = count($affiliatestolist);
	$totalpag = floor($total / $display);
	if (($total % $display) > 0) ++$totalpag;
	$arraffiliateslist = array_slice($affiliatestolist, $start, $display);
	for ($i = 0; $i < count($arraffiliateslist); $i++) { // show the list of affiliates in the current page
		$arrdata = explode("|", $arraffiliateslist[$i]);
		$username = $arrdata[0];
		$usersold = $arrdata[1];
		$affiliateslist .= '<tr><td>'.$username.'</td><td align="right">'.$usersold.'</td>
	<td><form method="post" action="admin.php" style="display: inline"><input type="submit" value="Delete"><input type="hidden" name="action" value="erase"><input type="hidden" name="affil" value="'.$username.'"></form></td>
	<td><form method="post" action="admin.php" style="display: inline"><input type="submit" value="Show details"><input type="hidden" name="action" value="seedata"><input type="hidden" name="affil" value="'.$username.'"></form></td></tr>';
	}
	if ($totalpag > 1) { // if there is more than one page
		$paging_links .= '<table align="center" border="0" cellpadding="0" cellspacing="10"><tr>';
		// if current page isn´t the first one then show the previous and first page buttons
		if ($page > 1) $paging_links .= '<td><form action="admin.php" method="post"><input type="hidden" name="action" value="list"><input type="hidden" name="sold_query" value="'.$minsold.'"><input type="hidden" name="maximumpage" value="'.$display.'"><input type="hidden" name="page" value="1"><input type="submit" value="FIRST"></form></td><td><form action="admin.php" method="post"><input type="hidden" name="action" value="list"><input type="hidden" name="sold_query" value="'.$minsold.'"><input type="hidden" name="maximumpage" value="'.$display.'"><input type="hidden" name="page" value="'.($page - 1).'"><input type="submit" value="PREVIOUS"></form></td>';
		// if current page is lower than the total of pages then show next and last page buttons
		if ($page < $totalpag) $paging_links .= '<td><form action="admin.php" method="post"><input type="hidden" name="action" value="list"><input type="hidden" name="sold_query" value="'.$minsold.'"><input type="hidden" name="maximumpage" value="'.$display.'"><input type="hidden" name="page" value="'.($page + 1).'"><input type="submit" value="NEXT"></form></td><td><form action="admin.php" method="post"><input type="hidden" name="action" value="list"><input type="hidden" name="sold_query" value="'.$minsold.'"><input type="hidden" name="maximumpage" value="'.$display.'"><input type="hidden" name="page" value="'.$totalpag.'"><input type="submit" value="LAST"></form></td>';
	}
	$paging_links .= '</tr></table>Page <b>'.$page.'</b> of <b>'.$totalpag.'</b> for a total of <b>'.$total.'</b> affiliates';
	for ($i = 0; $i < count($varstoparse); $i++) {
		$tosearch = "[".$varstoparse[$i]."]";
		$resultstemplate = str_replace($tosearch, constant($varstoparse[$i]), $resultstemplate);
	}
	$resultstemplate = str_replace("[affiliate_list]", $affiliateslist, $resultstemplate);
	$resultstemplate = str_replace("[sold_query]", $_POST['sold_query'], $resultstemplate);
	$resultstemplate = str_replace("[paging_links]", $paging_links, $resultstemplate);
	echo $resultstemplate; // show the results
}

function erase() { // delete an affiliate account
	$usertokill = $_POST['affil'];
	$userfile = affiliates_db_folder."/".$usertokill.".dat";
	if (file_exists($userfile)) unlink($userfile); // if the user exists then delete his sales log
	$oldaffiliateslist = explode("\n", fileread(main_db_folder."/".affiliates_data_file)); // open the affiliates data file
	$newaffiliateslist = "";
	// loop for all it´s records until we find the user to delete and delete him from the list
	for ($i = 0; $i < count($oldaffiliateslist); $i++) {
		if (trim($oldaffiliateslist[$i])!="") {
			list($f_nickname, $f_name, $f_email, $f_address, $f_zipcode, $f_city, $f_state, $f_country, $f_tel, $f_siteurl, $f_pass, $f_payments) = explode("|", trim($oldaffiliateslist[$i]));
			if ($usertokill != $f_nickname) $newaffiliateslist .= $oldaffiliateslist[$i]."\n";
		}
	}
	writetofile(main_db_folder."/".affiliates_data_file, $newaffiliateslist); // update the affiliates data file with the new affiliates data
	showmenu();
}

function seedata() { // shows the affiliate data
	$varstoparse = array("title_affiliates", "money_unit");
	$usertosee = $_POST['affil'];
	$userfile = affiliates_db_folder."/".$usertosee.".dat";
	if (file_exists($userfile)) {
		$amount_earned = number_format(fileread($userfile) / 100, 2);
		$arrtouse = array("nickname", "name", "email", "address", "zipcode", "city", "state", "country", "tel", "siteurl", "password", "payments");
		$affiliateslist = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
		$affiliatetemplate = template(admin_affiliatedata_template);
		for ($i = 0; $i < count($affiliateslist); $i++) {
			if ($affiliateslist[$i]!="") {
				$arrtoreplace = explode("|", $affiliateslist[$i]);
				if ($usertosee == $arrtoreplace[0]) {
					for ($j = 0; $j < count($arrtouse); $j++) {
						$affiliatetemplate = ($arrtouse[$j]=="payments") ? str_replace("[".$arrtouse[$j]."]", number_format($arrtoreplace[$j] / 100, 2), $affiliatetemplate) : str_replace("[".$arrtouse[$j]."]", $arrtoreplace[$j], $affiliatetemplate);
					}
					for ($x = 0; $x < count($varstoparse); $x++) {
						$tosearch = "[".$varstoparse[$x]."]";
						$affiliatetemplate = str_replace($tosearch, constant($varstoparse[$x]), $affiliatetemplate);
					}
					$affiliatetemplate = str_replace("[amount_earned]", $amount_earned, $affiliatetemplate);
					break;
				}
			}
		}
		echo $affiliatetemplate;
	}
}

function search() { // search for a affiliate
	$keyword = $_POST['keyword'];
	$affiliateslist = "";
	$resultstemplate = template(admin_searchresults_template);
	if (file_exists(main_db_folder."/".affiliates_data_file)) {
		$affiliatesdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
		for ($i = 0; $i < count($affiliatesdb); $i++) {
			if (stristr($affiliatesdb[$i], $keyword)) {
				$arrdata = explode("|", $affiliatesdb[$i]);
				$username = $arrdata[0];
				$userfile = affiliates_db_folder."/".$username.".dat";
				$usersold = number_format(fileread($userfile) / 100, 2);
				$affiliateslist .= '<tr valign="middle"><td>'.$username.'</td><td align="right">'.$usersold.'</td>
			<td><form method="post" action="admin.php" style="display: inline"><input type="submit" value="Delete"><input type="hidden" name="action" value="erase"><input type="hidden" name="affil" value="'.$username.'"></form></td>
			<td><form method="post" action="admin.php" style="display: inline"><input type="submit" value="Show details"><input type="hidden" name="action" value="seedata"><input type="hidden" name="affil" value="'.$username.'"></form></td></tr>';
			}
		}
	}
	$resultstemplate = str_replace("[title_affiliates]", title_affiliates, $resultstemplate);
	$resultstemplate = str_replace("[search_results]", $affiliateslist, $resultstemplate);
	$resultstemplate = str_replace("[keyword]", $keyword, $resultstemplate);
	echo $resultstemplate;
}

function writemsg() { // shows the email form
	$mailtemplate = template(admin_email_template);
	$mailtemplate = str_replace("[title_affiliates]", title_affiliates, $mailtemplate);
	echo $mailtemplate;
}

function sendmail() { // sends the email message to all the affiliates
	$errormsg = "";
	$msg_subject = (isset($_POST['subject'])) ? $_POST['subject'] : "";
	$msg_body = (isset($_POST['body'])) ? $_POST['body'] : "";
	$msg_from = from_name." <".from_email.">";
	$affiliatesdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
	for ($i = 0; $i < count($affiliatesdb); $i++) {
		if ($affiliatesdb[$i]!="") {
			$arruserdata = explode("|", $affiliatesdb[$i]);
			$usermail = $arruserdata[2];
			sendmsg($usermail, $msg_subject, $msg_body, $msg_from);
		}
	}
	showmenu();
}

function pay() { // pays the commission to a affiliate
	$usertopay = (isset($_POST['affil'])) ? $_POST['affil'] : "";
	$errormsg = "";
	$earnedsofar = 0;
	$newaffiliatedata = "";
	if ($usertopay!="") {
		$userfile = affiliates_db_folder."/".$usertopay.".dat";
		if (!file_exists($userfile)) {
			$errormsg = not_user_msg;
		} else {
			$earnedsofar = fileread($userfile);
			if ($earnedsofar < amount_paid) $errormsg = not_enough_earned;
		}
		if ($errormsg!="") {
			error("Pay affiliate", $errormsg);
		} else {
			$affiliatesdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
			for ($i = 0; $i < count($affiliatesdb); $i++) {
				$userdata = $affiliatesdb[$i];
				$arruserdata = explode("|", $userdata);
				if ($arruserdata[0] == $usertopay) {
					$arruserdata[11] += $earnedsofar;
				}
				$newaffiliatedata .= implode("|", $arruserdata)."\n";
			}
			writetofile(main_db_folder."/".affiliates_data_file, $newaffiliatedata);
			writetofile($userfile, '0');
			showmenu();
		}
	} else {
		$errormsg = not_user_msg;
		error("Pay affiliate", $errormsg);
	}
}

function payall() { // pays the commission to all affiliates that have enough money earned
	$paidusers = false;
	$userstopay = "";
	$newaffiliatesdata = "";
	if (file_exists(main_db_folder."/".affiliates_data_file)) {
		$affiliatesdb = explode("\n", fileread(main_db_folder."/".affiliates_data_file));
		for ($i = 0; $i < count($affiliatesdb); $i++) {
			if (trim($affiliatesdb[$i]!="")) {
				$arruserdata = explode("|", $affiliatesdb[$i]);
				$usertocheck =$arruserdata[0];
				$userpayments = $arruserdata[11];
				$userearned = 0;
				$newearned = 0;
				$userfile = affiliates_db_folder."/".$usertocheck.".dat";
				if (file_exists($userfile)) $userearned = fileread($userfile);
				if ($userearned > amount_paid) {
					$userstopay .= "<tr><td>".$arruserdata[1]."</td><td>".$arruserdata[3]."</td><td>".$arruserdata[5]."</td><td>".$arruserdata[4]."</td><td>".$arruserdata[7]."</td><td align=\"right\">".money_unit." ".number_format($userearned / 100, 2)."</td></tr>";
					$arruserdata[11] += $userearned;
					writetofile($userfile, '0');
					$paidusers = true;
				}
				$newaffiliatesdata .= implode("|", $arruserdata)."\n";
			}
		}
	}
	if (!$paidusers) {
		error("Pay all affiliates", no_affiliates_topay);
	} else {
		writetofile(main_db_folder."/".affiliates_data_file, $newaffiliatesdata);
		$affiliateslist = template(admin_payusers_template);
		$affiliateslist = str_replace("[title_affiliates]", title_affiliates, $affiliateslist);
		$affiliateslist = str_replace("[money_unit]", money_unit, $affiliateslist);
		$affiliateslist = str_replace("[amount_paid]", number_format(amount_paid / 100, 2), $affiliateslist);
		$affiliateslist = str_replace("[affiliates_to_pay]", $userstopay, $affiliateslist);
		echo $affiliateslist;
	}
}

function logref() { // shows all referred new affiliates
	$toreplace = '';
	if (file_exists(main_db_folder."/".referred_data_file)) {
		$referredfile = fileread(main_db_folder."/".referred_data_file);
		$arrtoreplace = explode("\n", $referredfile);
		for ($i = 0; $i < count($arrtoreplace); $i++) {
			$referredlog = trim($arrtoreplace[$i]);
			if ($referredlog != "") {
				$logdata = explode("|", $referredlog);
				$toreplace .= '<tr><td>'.$logdata[0].'</td><td>'.$logdata[1].'</td><td>'.$logdata[2].'</td></tr>';
			}
		}
	}
	$referredtemplate = template(admin_referredlist_template);
	$referredtemplate = str_replace("[title_affiliates]", title_affiliates, $referredtemplate);
	$referredtemplate = str_replace("[referred_log]", $toreplace, $referredtemplate);
	echo $referredtemplate;
}

function logsales() { // shows all sales made by affiliates
	$salestemplate = template(admin_saleslist_template);
	$salesfile = (file_exists(main_db_folder."/".sales_data_file)) ? fileread(main_db_folder."/".sales_data_file) : "";
	$toreplace = "";
	if ($salesfile != "") {
		$arrtoreplace = explode("\n", $salesfile);
		$toreplace = '';
		for ($i = 0; $i < count($arrtoreplace); $i++) {
			$saleslog = trim($arrtoreplace[$i]);
			if ($saleslog != "") {
				$saledata = explode("|", $saleslog);
				$toreplace .= '<tr><td>'.$saledata[0].'</td><td>'.$saledata[1].'</td><td>'.$saledata[2].'</td></tr>';
			}
		}
	}
	$salestemplate = str_replace("[title_affiliates]", title_affiliates, $salestemplate);
	$salestemplate = str_replace("[sales_log]", $toreplace, $salestemplate);
	echo $salestemplate;
}

function cleanlogref() { // cleans the referer log file
	writetofile(main_db_folder."/".referred_data_file, '');
	showmenu();
}

function cleanlogsales() { // cleans the sales log file
	writetofile(main_db_folder."/".sales_data_file, '');
	showmenu();
}

?>