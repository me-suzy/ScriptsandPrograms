<?
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: index.html");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Fast Click SQL <?=$CFG['SERIES']?> v<?=$CFG[VERSION]?> Administration</title>
</head>
<frameset cols="140,*">
  <frame name="left" src="admin.php?page=home_left" scrolling="no" noresize frameborder="0" target="main">
  <frame name="content" src="admin.php?page=stat_gen" frameborder="0">
  <noframes>
  <body bgcolor="#FFFFFF">
  <p>Fast Click SQL requires you to use a frames enabled browser..</p>
  </body>
  </noframes>
</frameset>
</html>
