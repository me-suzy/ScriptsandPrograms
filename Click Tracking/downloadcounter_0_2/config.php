<?php
#===========================================================================
#= Script : Download Counter
#= File   : config.php
#= Version: 0.2
#= Author : Mike Leigh
#= Email  : mike@mikeleigh.com
#= Website: http://www.mikeleigh.com/dev/downloadcounter
#= Support: http://www.mikeleigh.com/forum
#===========================================================================
#= Copyright (c) 2003 Mike Leigh
#= You are free to use and modify this script as long as this header
#= section stays intact
#= This file is part of DownloadCounter.
#=
#= This program is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= This program is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with DownloadCounter; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================

//database variables
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "download_0_2";

//download path
$dl_path = "./download/";
$dl_absolute_path = "http://www.mikeleigh.com/download.php";
//database limits (admin script)
$limit=20; // rows to return
$offset=0; //default offset

//error array
$error = array(0 => "the requested file does not exist on this server",
			   1 => "the file requested is not valid",
			   2 => "a file or download has not been requested",
			   3 => "the download requested is not valid",
			   4 => "a default file does not exist for this download");

//colours
$page_background = "a9a9a9";
$table_background = "f5f5f5";
$table_th_colour = "b0c4de";
$table_td_colour = "dcdcdc";

function db_connect() {
	global $db_host;
	global $db_user;
	global $db_pass;
	global $db_name;
	$con = mysql_connect($db_host,$db_user,$db_pass);
	if (!(mysql_select_db($db_name,$con))) {
		show_error();
	}
	return $con;
}

function db_disconnect($con) {
	close($con);
}

function show_error() {
	die("Error " . mysql_errno() . " : " . mysql_error());
}

function sql_quote($var) {
	return "'" . $var . "'";
}

function is_valid_user() {
	$status = false;
	if(isset($_POST['username'])) {$_SESSION['username'] = $_POST['username'];}
	if(isset($_POST['password'])) {$_SESSION['password'] = $_POST['password'];}
	if(isset($_SESSION['username'])) {$session_username = $_SESSION['username'];}
	if(isset($_SESSION['password'])) {$session_password = $_SESSION['password'];}
	
	if(($session_username <> '') and ($session_password <> '')) {
		//validate username and password against db
		print "<p></p>";
		$con = db_connect();
		$result = mysql_query("select password from users where userID ='".$session_username."'");
		$numrows = mysql_num_rows($result);
		if(!$numrows == 0) {
			while ($data=mysql_fetch_array($result)) {
				if($data['password'] == md5($session_password)) {
					$status = true;
				}
			}
		}
	}
	return $status;
}

function print_error($value) {
	global $error;
	global $page_background;
	global $table_background;
	global $table_th_colour;
	$html  = html_page_header("DownloadCounter::Error",$page_background);
	$html .= "<table border='0' width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	$html .= "  <tr>\n";
	$html .= "    <td>\n";
	$html .= "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	$html .= "        <tr bgcolor='$table_th_colour'>\n";
	$html .= "          <td>Error\n";
	$html .= "        </tr>\n";
	$html .= "        <tr>\n";
	$html .= "          <td width='100%'>" . $error[$value] . "</td>\n";
	$html .= "        </tr>\n";
	$html .= "      </table>\n";
	$html .= "    </td>\n";
	$html .= "  </tr>\n";
	$html .= "</table>\n";
	$html .= html_page_footer();
	return $html;
}

function html_page_header($title,$bgcolour) {
	$html  = "<html>\n";
	$html .= "<head>\n";
	$html .= "<title>" . $title . "</title>\n";
	$html .= "</head>\n";
	$html .= "<body bgcolor='$bgcolour'>\n";
	return $html;
}

function html_page_footer() {
	$html  = "</body>\n";
	$html .= "</html>\n";
	return $html;
}

?>
