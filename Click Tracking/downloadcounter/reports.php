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

$con = db_connect();

print "<img src='graph.php'>";


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