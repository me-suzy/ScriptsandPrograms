<?php
#===========================================================================
#= Script : Download Counter
#= File   : admin.php
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
session_start();
header("Cache-control: private");
include "config.php";
$PAGE_VAR = $_SERVER['PHP_SELF'];
$con = db_connect();

if(isset($_GET['action'])) {$action = $_GET['action'];}
if(isset($_GET['offset'])) {$offset = $_GET['offset'];}
if(isset($_GET['file'])) {$file = $_GET['file'];}
if(isset($_GET['download'])) {$download = $_GET['download'];}

//standard html header
print html_page_header("DownloadCounter::Admin",$page_background);

$validuser = is_valid_user();
if($validuser == true) {
	//user is ok to proceed
	if(!isset($action)) {
		$action = 'list_downloads';
	}
} else {
	$action = 'login';
}

if ($action == 'logout') {
	$_SESSION = array();
	session_destroy(); 
	//session_unregister("username");
	//session_unregister("password");
	$action = 'login';
}

if($action=='login') {
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print "          Login";
	print "        </td></tr></td></tr>\n";
	print "  <tr><td style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "        <form name='login 'method='POST' action=''>\n";
	print "            <tr>\n";
	print "              <td>Username</td>\n";
	print "              <td width='100%'><input type='text' name='username' size='50'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td>Password</td>\n";
	print "              <td width='100%'><input type='text' name='password' size='50'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td></td>\n";
	print "              <td><input type='submit' name='submit' value='Login'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='list_downloads'){
	$numresults = mysql_query("select * from downloads");
	$numrows = mysql_num_rows($numresults);
	$result = mysql_query("select * from downloads order by nDownloadID limit $offset,$limit ");
	print "<table border='0' width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("list");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td>ID</td>\n";
	print "          <td>Description</td>\n";
	print "          <td>Files</td>\n";
	print "          <td>Downloads</td>\n";
	print "          <td>Functions</td>\n";
	print "        </tr>\n";
	if(!$numrows==0) {
		while ($data=mysql_fetch_array($result)) {
			print "        <tr bgcolor='$table_td_colour'>\n";
			print "          <td>" . $data['nDownloadID'] . "</td>\n";
			print "          <td>" . $data['cDescription'] . "</td>\n";
			print "          <td>" . FilesCount($data['nDownloadID']) . "</td>\n";
			print "          <td>" . DownloadCount($data['nDownloadID']) . "</td>\n";
			print "          <td><a href='$PAGE_VAR?action=list_files&download=" . $data['nDownloadID'] ."'>List</a> | <a href='$PAGE_VAR?action=add_file&download=" . $data['nDownloadID'] ."'>Add</a> | <a href='$PAGE_VAR?action=edit_download&download=" . $data['nDownloadID'] ."'>Edit</a> | <a href='adminexec.php?action=delete_download&download=" . $data['nDownloadID'] . "'>Delete</a></td>\n";
			print "        </tr>\n";
		}
		print "        <tr>\n";
		print "          <td colspan='5' align='center'>";
		// calculate number of pages needing links
		$pages=intval($numrows/$limit);
		if(!$numrows==0) {
			//include previous page link if not on last page
			if(!$offset==0) {
				$prevoffset=$offset - $limit;
				print "<a href=\"$PAGE_VAR?action=list_downloads&offset=$prevoffset\">&lt;&lt;</a> ";
			}
			// $pages now contains int of pages needed unless there is a remainder from division
			if($numrows%$limit) {
				// has remainder so add one page
				$pages++;
			}
			//include page links
			for($i=1;$i<=$pages;$i++) {
				$newoffset=$limit*($i-1);
				if ($newoffset==$offset) {
					print "[$i] ";
					$page = $i;
				} else {
					print "<a href=\"$PAGE_VAR?action=list_downloads&offset=$newoffset\">[$i]</a> ";
				}
			}
			//include next page link if not on last page
			if(!(($offset/$limit)==($pages-1))) {
				$newoffset=$offset+$limit;
				print "<a href=\"$PAGE_VAR?action=list_downloads&offset=$newoffset\">&gt;&gt;</a> ";
			}
		}
		print "<br>(page $page of $pages)</td>\n";
		print "        </tr>\n";
	} else {
		print "        <tr>\n";
		print "          <td colspan='5'>No records have been returned</td>\n";
		print "        </tr>\n";
	}
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='add_download') {
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("add_download");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td colspan='2'>Add entry\n";
	print "            <tr>\n";
	print "              <form method='POST' action='adminexec.php?action=add_download'>\n";
	print "              <td>Description</td>\n";
	print "              <td width='100%'><input type='text' name='description' size='50'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td></td>\n";
	print "              <td><input type='submit' name='submit' value='add'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "          </td>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='edit_download') {
	$result=mysql_query("select * from downloads where nDownloadID=" . $download);
	$data=mysql_fetch_array($result);
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td colspan='2'>Edit entry\n";
	print "            <tr>\n";
	print "              <form method='POST' action='adminexec.php?action=edit_download&download=".$download."'>\n";
	print "              <td>Download</td>\n";
	print "              <td><input type='text' name='description' size='50' value='" . $data['cDescription'] . "'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td></td>\n";
	print "              <td><input type='Submit' name='submit' value='Update'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "          </td>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='list_files') {
	$numresults = mysql_query("select * from files where nDownloadID=".$download);
	$numrows = mysql_num_rows($numresults);
	$result = mysql_query("select * from files where nDownloadID=" . $download . " order by nDownloadID limit $offset,$limit ");
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("");
	print "<br>\n";
	print html_file_menu("list_files");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td>File ID</td>\n";
	print "          <td>Download ID</td>\n";
	print "          <td>Filename</td>\n";
	print "          <td>Default</td>\n";
	print "          <td>Size</td>\n";
	print "          <td>Count</td>\n";
	print "          <td>Functions</td>\n";
	print "        </tr>\n";
	if(!$numrows==0) {
		while ($data=mysql_fetch_array($result)) {
			if($data['bDefault'] == 0) {
				$default = " | <a href='adminexec.php?action=set_default_file&download=".$data['nDownloadID']."&file=".$data['nFileID']."'>Set Default</a>";
			} else {
				$default = "";
			}
			print "        <tr bgcolor='$table_td_colour'>\n";
			print "          <td><a href='download.php?file=".$data['nFileID']."'>".$data['nFileID']."</a></td>\n";
			print "          <td>" . $data['nDownloadID'] . "</td>\n";
			print "          <td>" . $data['cFilename'] . "</td>\n";
			
			$default_image = "<img src='./false.gif'>";
			if($data['bDefault'] == 1) { 
				$default_image = "<img src='./true.gif'>";
			}
			
			print "          <td>" . $default_image . "</td>\n";
			print "          <td>" . $data['nSize'] . "</td>\n";
			print "          <td>" . $data['nCount'] . "</td>\n";
			print "          <td><a href='$PAGE_VAR?action=edit_file&file=".$data['nFileID']."&download=".$data['nDownloadID']."'>Edit</a> | <a href='adminexec.php?action=delete_file&download=".$data['nDownloadID']."&file=".$data['nFileID']."'>Delete</a>".$default."</td>\n";
			print "        </tr>\n";
		}
		print "        <tr>\n";
		print "          <td colspan='7' align='center'>";
		// calculate number of pages needing links
		$pages=intval($numrows/$limit);
		if(!$numrows==0) {
			//include previous page link if not on last page
			if(!$offset==0) {
				$prevoffset=$offset - $limit;
				print "<a href=\"$PAGE_VAR?action=list_files&offset=$prevoffset\">&lt;&lt;</a> ";
			}
			// $pages now contains int of pages needed unless there is a remainder from division
			if($numrows%$limit) {
				// has remainder so add one page
				$pages++;
			}
			//include page links
			for($i=1;$i<=$pages;$i++) {
				$newoffset=$limit*($i-1);
				if ($newoffset==$offset) {
					print "[$i] ";
					$page = $i;
				} else {
					print "<a href=\"$PAGE_VAR?action=list_files&offset=$newoffset\">[$i]</a> ";
				}
			}
			//include next page link if not on last page
			if(!(($offset/$limit)==($pages-1))) {
				$newoffset=$offset+$limit;
				print "<a href=\"$PAGE_VAR?action=list_files&offset=$newoffset\">&gt;&gt;</a> ";
			}
		}
		print "<br>(page $page of $pages)</td>\n";
		print "        </tr>\n";
	} else {
		print "        <tr>\n";
		print "          <td colspan='5'>No records have been returned</td>\n";
		print "        </tr>\n";
	}
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='add_file') {
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("");
	print "<br>\n";
	print html_file_menu("add_file");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td colspan='2'>Add File\n";
	print "            <tr>\n";
	print "              <form method='POST' action='adminexec.php?action=add_file&download=".$download."'>\n";
	print "              <td>Filename</td>\n";
	print "              <td width='100%'><input type='text' name='filename' size='50'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td>Filesize</td>\n";
	print "              <td width='100%'><input type='text' name='filesize' size='10'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td></td>\n";
	print "              <td><input type='submit' name='submit' value='add'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "          </td>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='edit_file') {
	$result=mysql_query("select * from files where nFileID=" . $file);
	$data=mysql_fetch_array($result);
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("");
	print "<br>\n";
	print html_file_menu("edit_file");
	print "        </td><td align='right'><a href='admin.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "<table border='0' width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td colspan='2'>Edit entry\n";
	print "            <tr>\n";
	print "              <form method='POST' action='adminexec.php?action=edit_file&file=".$file."&download=".$data['nDownloadID']."'>\n";
	print "              <td width='10%'>Filename</td>\n";
	print "              <td width='90%'><input type='text' name='filename' size='50' value='" . $data['cFilename'] . "'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td width='10%'>Filesize</td>\n";
	print "              <td width='90%'><input type='text' name='filesize' size='10' value='" . $data['nSize'] . "'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td></td>\n";
	print "              <td><input type='Submit' name='submit' value='Update'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "          </td>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

if($action=='change_password') {
	print "<table width='800' bgcolor='$table_background' cellpadding='0' cellspacing='0' valign='top' align='center' style='border-top:1px solid black;border-right:1px solid black;border-bottom:1px solid black;border-left:1px solid black;'>\n";
	print "  <tr>\n";
	print "    <td>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'><td>\n";
	print html_download_menu("");
	print "        </td><td align='right'><a href='adminexec.php?action=change_password'>Change Password</a> : <a href='adminexec.php?action=logout'>logout</a></td></tr></td></tr>\n";
	print "  <tr><td colspan='2' style='border-top:1px dashed black;'><br>\n";
	print "      <table width='100%' border='0' cellpadding='2' cellspacing='1' align='center'>\n";
	print "        <tr bgcolor='$table_th_colour'>\n";
	print "          <td colspan='2'>Change Password\n";
	print "            <tr>\n";
	print "              <form method='POST' action='adminexec.php?action=change_password'>\n";
	print "              <td width='20%'>New Password</td>\n";
	print "              <td width='80%'><input type='text' name='description' size='50'></td>\n";
	print "            </tr>\n";
	print "            <tr>\n";
	print "              <td>&nbsp;</td>\n";
	print "              <td><input type='submit' name='submit' value='Update'></td>\n";
	print "              </form>\n";
	print "            </tr>\n";
	print "          </td>\n";
	print "        </tr>\n";
	print "      </table>\n";
	print "    </td>\n";
	print "  </tr>\n";
	print "</table>\n";
}

//standard html footer
print html_page_footer();

function html_download_menu($hidden) {
	if($hidden!=='list_downloads') {$html .= "<a href='admin.php?action=list_downloads'>List Downloads</a>";} else {$html .= "List Downloads";}
	$html .= " : ";
	if($hidden!=='add_download') {$html .= "<a href='admin.php?action=add_download'>Add Download</a>";} else {$html .= "Add Download";}
	return $html;
}

function html_file_menu($hidden) {
	global $download;
	if($hidden!=='list_files') {$html .= "<a href='admin.php?action=list_files&download=".$download."'>List Files</a>";} else {$html .= "List Files";}
	$html .= " : ";
	if($hidden!=='add_file') {$html .= "<a href='admin.php?action=add_file&download=".$download."'>Add File</a>";} else {$html .= "Add File";}
	return $html;
}

function CountRecords($sql) {
//return a record count based on $sql
	$con = db_connect();
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	$val = 0;
	if (!$numrows == 0) {
		$data=mysql_fetch_array($result);
		if ($data['nCount'] >=1) {
			$val = $data['nCount'];
		}
	}
	return $val;
}

function DownloadCount($downloadID) {
//return the sum of nCount for a given downloadID
	$val = CountRecords("SELECT Sum(nCount) AS nCount FROM files WHERE nDownloadID = " . $downloadID);
	return $val;
}

function FilesCount($downloadID) {
//return the sum of nCount for a given downloadID
	$val = CountRecords("SELECT Count(nCount) AS nCount FROM files WHERE nDownloadID = " . $downloadID);
	return $val;
}
?>