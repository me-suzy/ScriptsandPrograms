<?php
//DEFINE dbPath in any way you choose, but it must be the absolute path.
//Set dbUsername and dbPassword to what you set the database settings to. Leave blank if unspecified.
$wPath =$_SERVER['PATH_TRANSLATED'];
$pathLen = strlen( $wPath );
$dbPath = substr($wPath, 0, $pathLen - strlen( $_SERVER['PATH_INFO'] ) - 2) . '/webscripts/php/comment/comment.mdb';
$dbUsername = 'Admin';
$dbPassword = 'test';
$version = 'v0.301';
$imgDir = '/webscripts/php/comment/img/'; //Define path to smileys

$conn=odbc_connect('DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=' . $dbPath, $dbUsername, $dbPassword);

?> 