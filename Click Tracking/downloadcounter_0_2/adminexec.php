<?php
#===========================================================================
#= Script : Download Counter
#= File   : adminexec.php
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
$con = db_connect();
$url = "admin.php";

if(isset($_GET['action'])) { $action = $_GET['action'];}
if(isset($_GET['download'])) { $download = $_GET['download'];}
if(isset($_GET['file'])) { $file = $_GET['file'];}
if(isset($_POST['description'])) { $description = mysql_escape_string($_POST['description']);}
if(isset($_POST['filename'])) { $filename = mysql_escape_string($_POST['filename']);}
if(isset($_POST['filesize'])) { $filesize = mysql_escape_string($_POST['filesize']);}

switch ($_GET["action"]) {
	case "logout":
		$_SESSION = array();
		session_destroy(); 
		$url = "admin.php";
		$result = true;
	break;

	case "change_password":
		$sql = "UPDATE users SET password = ".sql_quote(md5($description))." WHERE userID = ".sql_quote('admin');
		$result = mysql_query($sql,$con);
		$url = "admin.php?action=list_downloads";
		$result = true;
	break;

	case "add_download":
		if($description==!"") { //stops blank entries being added
			$sql = "INSERT INTO downloads (cDescription) VALUES (".sql_quote($description).")";
			$result = mysql_query($sql,$con);
			$url = "admin.php?action=list_downloads";
		} else {
			$result = true;
		}
		break;

	case "add_file":
		if($filename==!"" AND $filesize==!"") { //stops blank entries being added
			$sql = "INSERT INTO files (nDownloadID,cFilename,nSize,nCount) VALUES (".$download.",".sql_quote($filename).",".$filesize.",0)";
			$result = mysql_query($sql,$con);
			$url = "admin.php?action=list_files&download=".$download;
		} else {
			$result = true;
		}
		break;

	case "delete_download":
		$result = mysql_query("SELECT * FROM files WHERE nDownloadID = ".$download,$con);
		$numrows = mysql_num_rows($result);
		if(!$numrows==0) {
			while ($data=mysql_fetch_array($result)) {
				$sql = "DELETE FROM history WHERE nFileID = " . $data['nFileID'] . "\n";
				$result1 = mysql_query($sql,$con);
			}
		}
		$sql = "DELETE FROM files WHERE nDownloadID = " . $download . "\n";
		$result = mysql_query($sql,$con);
		$sql = "DELETE FROM downloads WHERE nDownloadID = " . $download . "\n";
		$result = mysql_query($sql,$con);
		break;

	case "delete_file":
		$sql = "DELETE FROM files WHERE nFileID = ".$file;
		$result = mysql_query($sql,$con);
		$sql = "DELETE FROM history WHERE nFileID = ".$file;
		$result = mysql_query($sql,$con);
		$url = "admin.php?action=list_files&download=".$download;
		break;

	case "edit_download":
		$sql = "UPDATE downloads SET cDescription = ".sql_quote($description)." WHERE nDownloadID = ".$download;
		$result = mysql_query($sql,$con);
		break;

	case "edit_file":
		$sql = "UPDATE files SET cFilename = ".sql_quote($filename).", nSize = ".$filesize." WHERE nFileID = ".$file;
		$result = mysql_query($sql,$con);
		$url = "admin.php?action=list_files&download=".$download;
		break;

	case "set_default_file":
		$sql = "UPDATE files SET bDefault = 0 WHERE nDownloadID = ".$download;
		$result = mysql_query($sql,$con);
		$sql = "UPDATE files SET bDefault = 1 WHERE nFileID = ".$file;
		$result = mysql_query($sql,$con);
		$url = "admin.php?action=list_files&download=".$download;
		break;
}

if ($result==false) {
	print "Problem Processing SQL [".$sql."]";
} else {
	// redirect to admin page
	header("Location: ".$url);
}
?>