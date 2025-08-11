<?php
#===========================================================================
#= Script : Download Counter
#= File   : upgrade.php
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
$con = db_connect();

$sql = "CREATE TABLE `downloads`
	(`nFileID` INT NOT NULL AUTO_INCREMENT,
	`cDescription` VARCHAR( 255 ) NOT NULL ,
	`cFilename` VARCHAR( 255 ) NOT NULL ,
	PRIMARY KEY ( `nFileID` ))
	TYPE = MYISAM COMMENT = 'downloads'";
$result = mysql_query($sql,$con);

$sql = "CREATE TABLE `files`
	(`nFileID` INT NOT NULL AUTO_INCREMENT,
	`nDownloadID` INT NOT NULL,
	`cFilename` VARCHAR( 255 ) NOT NULL,
	`bDefault` TINYINT,
	`nSize` INT,
	`nCount` INT,
	PRIMARY KEY ( `nFileID` ))
	TYPE = MYISAM COMMENT = 'files'";
$result = mysql_query($sql,$con);

$sql = "CREATE TABLE `users`
	(`userID` VARCHAR(20) NOT NULL,
	`password` VARCHAR(32),
	PRIMARY KEY ( `userID`))
	TYPE = MYISAM COMMENT = 'users'";
$result = mysql_query($sql,$con);

$sql = "INSERT INTO users (userID, password) VALUES ('admin','".md5('1234')."')";
$result = mysql_query($sql,$con);

$sql = "select * from downloads";
$result = mysql_query($sql,$con);
$numrows = mysql_num_rows($result);
if(!$numrows == 0) {
	while ($data = mysql_fetch_array($result)) {
		$sql_insert = "INSERT INTO files (nDownloadID, cFilename, bDefault, nSize, nCount) VALUES ('".$data['nFileID']."','".$data['cFilename']."','1','0','".sum_downloads($data['nFileID'])."')";
		$result2 = mysql_query($sql_insert,$con);
		print "<p><font face='verdana' size='1'>".$sql_insert."</font></p>";
	}
}

$sql = "ALTER TABLE downloads DROP cFilename";
$result = mysql_query($sql,$con);

$sql = "ALTER TABLE downloads CHANGE nFileID nDownloadID INT(11) NOT NULL AUTO_INCREMENT";
$result = mysql_query($sql,$con);

function sum_downloads($fileID) {
	$con = db_connect();
	$sql = "select sum(nCount) as sum_count from history where nFileID = '".$fileID."'";
	print "<p><font face='verdana' size='1'>".$sql."</font></p>";
	$result = mysql_query($sql,$con);
	$numrows = mysql_num_rows($result);
	print "<p><font face='verdana' size='1'>numrows".$numrows."</font></p>";
	$val = 0;
	if (!$numrows == 0) {
		while ($data = mysql_fetch_array($result)) {
			$val = $val + $data['sum_count'];
		}
	}
	return $val;
}
?>