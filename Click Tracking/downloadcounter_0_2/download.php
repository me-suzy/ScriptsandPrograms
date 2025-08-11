<?php
#===========================================================================
#= Script : Download Counter
#= File   : download.php
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
include "config.php";
$proceed = true;

//the code block below may be removed if you are not upgrading from 0.1
//check for depracted usage (fileID)
if(isset($_GET['fileID'])) {
	$file = $_GET['fileID'];
	if(is_valid_file($file)) {
		if(!filename_exists($file)) {
			$proceed = false;
			print print_error(0);
		}
	} else {
		$proceed = false;
		print print_error(1);
	}
}
//the code block above may be removed if you are not upgrading from 0.1

//if either file or download is not set proceed = false
if(!isset($_GET['fileID']) and !isset($_GET['file']) and !isset($_GET['download'])) {
//if(!isset($_GET['file']) and !isset($_GET['download'])) {
	$proceed = false;
	print print_error(2);
}

//if download is set get the default file id
if(isset($_GET['download'])) {
	$download = $_GET['download'];
	if(is_valid_download($download)) {
		$file = default_file($download);
		if($file == 0) {
			$proceed = false;
			print print_error(4);
		} else {
			if(!filename_exists($file)) {
				$proceed = false;
				print print_error(0);
			}
		}
	} else {
		$proceed = false;
		print print_error(3);
	}
}

//if file is set get the default file id
if(isset($_GET['file'])) {
	$file = $_GET['file'];
	if(is_valid_file($file)) {
		if(!filename_exists($file)) {
			$proceed = false;
			print print_error(0);
		}
	} else {
		$proceed = false;
		print print_error(1);
	}
}

//a file must exist and be valid to download
if($proceed == true) {
	start_download($file);
}

function is_valid_download($download) {
	if(is_numeric($download)) {
		$con = db_connect();
		$sql = "SELECT * FROM downloads WHERE nDownloadID = " . $download;
		$result = mysql_query($sql,$con);
		$numrows = mysql_num_rows($result);
		if (!$numrows == 0) {
			return true;
		}
	}
}

function is_valid_file($file) {
	if(is_numeric($file)) {
		$con = db_connect();
		$sql = "SELECT * FROM files WHERE nFileID = " . $file;
		$result = mysql_query($sql,$con);
		$numrows = mysql_num_rows($result);
		if (!$numrows == 0) {
			return true;
		}
	}
}

function default_file($download) {
	$con = db_connect();
	$sql = "SELECT nFileID FROM files WHERE bDefault = 1 AND nDownloadID = " . $download;
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	if (!$numrows == 0) {
		$data = mysql_fetch_assoc($result);
		return $data['nFileID'];
	} else {
		return 0;
	}
}

function filename_exists($file) {
	$con = db_connect();
	$sql = "SELECT cFilename FROM files where nFileID = " . $file;
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	if (!$numrows == 0) {
		$data = mysql_fetch_assoc($result);
		global $dl_path;
		$filename = $dl_path . $data['cFilename'];
		if (file_exists($filename)) {
			return true;
		}
	}
}

function start_download($file) {
	$con = db_connect();
	$sql = "SELECT cFilename FROM files WHERE nFileID = " . $file;
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	if (!$numrows == 0) {
		$data = mysql_fetch_assoc($result);
		global $dl_path;
		$filename = $dl_path . $data['cFilename'];
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$date = todays_date();
		increment_history($file, $date);
		increment_download_count($file);
		if (detect_browser($browser) == "ie") {
			Header("Content-type: application/force-download");
		} else {
			Header("Content-Type: application/octet-stream");
		}
			Header("Content-Length: " . filesize($filename));
			Header("Content-Disposition: attachment; filename=" . $data['cFilename']);
			readfile($filename);
	}
}

function increment_download_count($file) {
	$con = db_connect();
	$sql = "UPDATE files SET nCount=(nCount + 1) WHERE nFileID = ".$file;
	$result = mysql_query($sql,$con);
}

function increment_history($file, $date) {
	if (history_exists($file, $date)) {
		increment_history_count($file, $date);
	} else {
		insert_history($file, $date);
	}
}

function history_exists($file,$date) {
	$con = db_connect();
	$sql = "SELECT * FROM history WHERE nFileID = ".$file." AND dDate = ".sql_quote($date);
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	if (!$numrows == 0) {
		return true;
	}
}

function insert_history($file, $date) {
	$con = db_connect();
	$sql = "INSERT INTO history (nFileID, dDate, nCount) VALUES (".$file.",".sql_quote($date).",1)";
	$result = mysql_query($sql,$con);
}

function increment_history_count($file, $date) {
	$con = db_connect();
	$sql = "UPDATE history SET nCount=(nCount + 1) WHERE nFileID = ".$file." AND dDate = ".sql_quote($date);
	$result = mysql_query($sql,$con);
}

function detect_browser($var) {
		if(eregi("(msie) ([0-9]{1,2}.[0-9]{1,3})", $var)) {
			$str = "ie";
		} else {
			$str = "nn";
		}
	return $str;
}

function todays_date() {
	return date("Ymd");
}
?>