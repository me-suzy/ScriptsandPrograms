<?php
ob_start();
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
if(isset($_POST['pid'])){
$path = "../";
$modcheck = 1;
include("../inc/global.php");
include("../inc/checks.php");
$database->query("UPDATE blog SET content = '".$_POST['content']."', title = '".$_POST['subject']."', edit_uid = '".$_SESSION['uid']."', edit_date = now(), image = '".$_POST['image']."', `float` = '".$_POST['float']."' WHERE pid = '".$_POST['pid']."'");
header("Location: home.php");
ob_end_flush();
}
if(isset($_REQUEST['id'])){
$path = "../";
$modcheck = 1;
$page = "Edit a post";
include("../inc/adminheader.inc.php");
$query = $database->query("SELECT * FROM blog WHERE pid = '".$_REQUEST['id']."'");
$post = $database->fetch_array($query);
?>
<table>
<tr>
<td>


<script src="editor.js" language="javascript" type="text/javascript"></script>
<form action="edit.php" method="post" name="editform">
<input type="hidden" name="pid" value="<? echo $_REQUEST['id']; ?>">
Subject : <input type="text" name="subject" value="<? echo $post['title'] ?>"><BR>
<input type="button" accesskey="b" value=" BOLD  " name="bold" onclick="javascript:tag('b', '[b]', ' BOLD*', '[/b]', ' BOLD  ', 'bold');" style="font-family:Verdana; font-size:10px; font-weight:bold; margin:2px;">
<input type="button" accesskey="i" value=" ITALICS  " name="italics" onclick="javascript:tag('c', '[i]', ' ITALICS*', '[/i]', ' ITALICS  ', 'italics');" style="font-family:Verdana; font-size:10px; margin:2px;">
<input type="button" accesskey="u" value=" UNDERLINE  " name="underline" onclick="javascript:tag('f', '[u]', ' UNDERLINE*', '[/u]', ' UNDERLINE  ', 'underline');" style="font-family:Verdana; font-size:10px; margin:2px;">
<input type="button" accesskey="i" value=" CENTER  " name="center" onclick="javascript:tag('g', '[center]', ' CENTER*', '[/center]', ' CENTER  ', 'center');" style="font-family:Verdana; font-size:10px; margin:2px;">
<input type="button" accesskey="l" value=" http://  " name="http" onclick="javascript:tag('d', '[url]', ' http://*', '[/url]', ' http://  ', 'http');" style="font-family:Verdana; font-size:10px; margin:2px;">
<input type="button" value=" IMG  " name="img" onclick="javascript:tag('e', '[img]', ' IMG*', '[/img]', ' IMG  ', 'img');" style="font-family:Verdana; font-size:10px; margin:2px;">
<BR>
<textarea rows="15" cols="45" name="content">
<?
echo $post['content'];
?>
</textarea>
</td>
<td>
Post Image : <select name="image">
<option>None</option>
<?
$query = $database->query("SELECT * FROM images");
while($image = $database->fetch_array($query)){
if($image['gid'] == $post['image']){
echo "<option value=\"".$image['gid']."\" selected>".$image['alt']."</option>";
} else {
echo "<option value=\"".$image['gid']."\">".$image['alt']."</option>";
}
}
?>
</select><BR><BR>
<select name="float">
<?
if($post['float'] == "left"){
?>
<option value="right">Right</option>
<option value="left" selected>Left</option>
<?
} else {
?>
<option value="right" selected>Right</option>
<option value="left">Left</option>
<?
}
?>
</select>
<?

?>
</td>

</tr></table>
<input type="submit" value="Edit">
</form>
<?
include("../inc/footer.inc.php");
ob_end_flush();
}
?>