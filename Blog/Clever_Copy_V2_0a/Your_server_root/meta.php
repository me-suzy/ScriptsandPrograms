<?php
include "admin/connect.inc";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_slogan_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getslogan="SELECT * from CC_slogan";
$getslogan2=mysql_query($getslogan) or die($no_slogan_error);
$getslogan3=mysql_fetch_array($getslogan2);
$slogan = $getslogan3[slogan];
$sitename = $getprefs3[title];
echo "<META HTTP-EQUIV=\"EXPIRES\" CONTENT=\"0\">\n";
echo "<META NAME=\"RESOURCE-TYPE\" CONTENT=\"DOCUMENT\">\n";
echo "<META NAME=\"DISTRIBUTION\" CONTENT=\"GLOBAL\">\n";
echo "<META NAME=\"AUTHOR\" CONTENT=\"$sitename\">\n";
echo "<META NAME=\"COPYRIGHT\" CONTENT=\"Copyright (c) 2005 $sitename\">\n";
echo "<META NAME=\"KEYWORDS\" CONTENT=\"Post, post, Posting, posting, RSS, rss, Rss, News, news, New, new, Headlines, headlines, Clever Copy, clever copy, Clever copy, clever-copy, script, scripts, Download, download, Downloads, downloads, Free, FREE, free, Community, community, Bulletin, bulletin, Board, board, Boards, boards, PHP, php, Survey, survey, Portal, portal, Unix, UNIX, *nix, unix, MySQL, mysql, SQL, sql, Database, DataBase, Blogs, blogs, Blog, blog, database, Weblog, WebLog, weblog\">\n";
echo "<META NAME=\"DESCRIPTION\" CONTENT=\"$slogan\">\n";
echo "<META NAME=\"ROBOTS\" CONTENT=\"INDEX, FOLLOW\">\n";
echo "<META NAME=\"REVISIT-AFTER\" CONTENT=\"3 DAYS\">\n";
echo "<META NAME=\"RATING\" CONTENT=\"GENERAL\">\n";
// Do NOT remove the copyright line below!
echo "<META NAME=\"GENERATOR\" CONTENT=\"Clever Copy - Copyright 2005 http://clevercopy.bestdirectbuy.com\">\n";
?>