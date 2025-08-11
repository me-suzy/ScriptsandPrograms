<?php
// This is the header of the script.
function template_header(){
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Ready chatbox - Administration</title>
<style type="text/css">
<!--
.header {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 16px;
	font-weight: bold;
	color: #333333;
	background-color: #F8750B;
	padding-top: 2px;
	padding-bottom: 2px;
	padding-left: 10px;
	border-bottom-width: 1px;
	border-bottom-style: dashed;
	border-bottom-color: #333333;
}
.box {
	border: 1px solid #333333;
	background-color: #FBA762;
 font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	color: #222222;
}
a.link_a {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:none;
	padding-left: 10px;
}
a.link_a:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:underline;
	padding-left: 11px;
}
a.link_b {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:none;
}
a.link_b:hover {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 13px;
	font-weight:bold;
	color: #333333;
	text-decoration:underline;
}
body {
	background-color: #333333;
}
-->
</style>

<script language="JavaScript" type="text/javascript">
<!--
	function ClearField(field){
		if ( field.defaultValue==field.value ) {
			field.value = ""
		}
	}
	
	
	function PopUp(url,width,height){
		window.open(url, 'popup', 'width=' + width + ',height=' + height + ',toolbar=0,scrollbars=no,location=0,statusbar=1,menubar=0,resizable=1');
	}
-->
</script>

</head>

<body>
<table width="750" border="0" cellspacing="3" cellpadding="0">
  <tr>
    <td width="150">&nbsp;</td>
    <td width="600">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">
      <table class="box" width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td class="header">Places to go...</td>
        </tr>
		<tr>
          <td height="5"></td>
        </tr>
        <tr>
          <td><a href="http://www.websiteready.net/support" class="link_a">Help</a></td>
        </tr>
        <tr>
          <td><a href="http://www.websiteready.net/donate.htm" class="link_a">Donate</a></td>
        </tr>
        <tr>
          <td><a href="about.php" class="link_a">About</a></td>
        </tr>
		<tr>
          <td height="5"></td>
        </tr>
		<tr>
          <td><a href="index.php" class="link_a">Home</a></td>
        </tr>
        <tr>
          <td><a href="edit.php" class="link_a">Edit Messages</a></td>
        </tr>
        <tr>
          <td><a href="logout.php" class="link_a">Log Out</a></td>
        </tr>
		<tr>
          <td height="20"></td>
        </tr>
        <tr>
          <td><a href="http://www.hotscripts.com/Detailed/49369.html?RID=N367804" class="link_a">Check for updates</a></td>
        </tr>
        <tr>
          <td align="center" style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333333;">
            <form action="http://www.hotscripts.com/cgi-bin/rate.cgi" method="POST" target="_blank">
           <b>Rate This Script</b>
            <input type="hidden" name="ID" value="49369">
            <input type="hidden" name="external" value="1">
            <select name="rate" size="1">

            <option value="5">Excellent!</option>
            <option value="4">Very Good</option>
            <option value="3">Good</option>
            <option value="2">Fair</option>
            <option value="1">Poor</option>
            </select> <input type="submit" value="Rate It!" name="submit">
            </form>
          </td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </table>
    </td>
    <td valign="top">
      <table width="100%" class="box" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td class="header">...Things to do</td>
        </tr>
        <tr>
          <td style="padding: 5px;">
<!-- / header -->		  
<?
} // End template header

// This is the footer
function template_footer(){
?>
<!-- footer -->	
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>

<?
} // End template footer
?>

