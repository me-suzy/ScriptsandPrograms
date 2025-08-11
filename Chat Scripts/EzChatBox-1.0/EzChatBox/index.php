<?php require("config.php"); ?>
<?php if($EZChat_html == "Yes")
{
	?>
	<html>
	<head>
	<title><?php echo $EZChat_title; ?></title>
	<?php 
	if($EZChat_refresh = "Yes")
	{
	?>
	<meta http-equiv="refresh" content="<?php echo $EZChat_time; ?>">
	<?php
	}
	?>
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
	<link href="<?php echo $EZChat_location; ?>/ez.css" rel="stylesheet" type="text/css">
	</head>
	<body>
	<?php
}
?>
<script language="javascript">
<!--
function openwindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
-->
</script>
<div id="chatbox" align="center">
<table vspace="5" width="178">
  <tr> 
    <td height="70" width="100%" align="center" ><img src="<?php echo $EZChat_location; ?>/Images/<?php echo $EZChat_image; ?>"><?php if($EZChat_inc_tagline == "Yes") { print ("<br><span class=\"style1\">$EZChat_tagline</span>"); } ?></td>
  </tr>
  <tr> 
    <td width="100%" align="left" valign="top">
	<?php 
		include("$EZChat_location/dsp_chat_content.php"); 
	?>
	</td>
  </tr>
  <tr>
  	<td width="100%" valign="top">
	<?php 
			include("$EZChat_location/qry_chat.php"); 
	?>
	</td>
  </tr>
</table>
<span id="small-print"><a href="http://ezchatbox.sourceforge.net">EZChatbox v1.0</a> &copy; CW Enterprises</span>
</div>
<?php if($EZChat_html == "Yes")
{
	?>
	</body>
	</html>
	<?php
}
?>