<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
$path = "../../";
$admincheck = 1;
$page = "General Settings";
include("../../inc/adminheader.inc.php");
if(isset($_POST['import'])){
eval(stripslashes($_POST['import']));
$sql = "INSERT INTO theme SET `name` = '".$exportedtheme['name']."', `subhead_text-color` = '".$exportedtheme['subhead_text-color']."', `subhead_background-image` = '".$exportedtheme['subhead_background-image']."', `subhead_font-family` = '".$exportedtheme['subhead_font-family']."', `subhead_font-size` = '".$exportedtheme['subhead_font-size']."', `header_text-color` = '".$exportedtheme['header_text-color']."', `header_background-image` = '".$exportedtheme['header_background-image']."', `header_font-family` = '".$exportedtheme['header_font-family']."', `header_font-size` = '".$exportedtheme['header_font-size']."', `postcontent_text-color` = '".$exportedtheme['postcontent_text-color']."', `postcontent_background-color` = '".$exportedtheme['postcontent_background-color']."', `postcontent_font-family` = '".$exportedtheme['postcontent_font-family']."', `postcontent_font-size` = '".$exportedtheme['postcontent_font-size']."', `content_text-color` = '".$exportedtheme['content_text-color']."', `content_background-color` = '".$exportedtheme['content_background-color']."', `content_font-family` = '".$exportedtheme['content_font-family']."', `content_font-size` = '".$exportedtheme['content_font-size']."', `topbar_text-color` = '".$exportedtheme['topbar_text-color']."', `topbar_background-color` = '".$exportedtheme['topbar_background-color']."', `topbar_font-family` = '".$exportedtheme['topbar_font-family']."', `topbar_font-size` = '".$exportedtheme['topbar_font-size']."', `topbar_link-color` = '".$exportedtheme['topbar_link-color']."', `topbar_linkhover-color` = '".$exportedtheme['topbar_linkhover-color']."', `body_background-color` = '".$exportedtheme['body_background-color']."', `logo` = '".$exportedtheme['logo']."', `content_width` = '".$exportedtheme['content_width']."'";
$database->query($sql);
echo "All has been imported successfully. If you want to use you theme now please go and view your themes and select the one you want to use now.";
} else {
?>
Please paste the file contents that contains the exported theme below and press Import.<BR><BR>
<form action="import.php" method="post">
<textarea rows="10" cols="30" name="import">

</textarea>
<BR>
<input type="submit" value="Import">
</form>
<?
}
include("../../inc/footer.inc.php");
?>