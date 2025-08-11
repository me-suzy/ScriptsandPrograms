<?php

# StarClix 1.0
# Copyright 2003-2004 Tara, http://gurukitty.com/star. All rights reserved.
# Released August 5, 2004

# StarClix 1.0 is linkware and can be used and modified as long all notes on the StarClix 1.0 files remain intact, unaltered, and a link is placed on all pages used by the StarClix 1.0 script to http://gurukitty.com/star so others can find out about this script as well. You may modify this script to suit your wishes, so long as you do not distribute or sell it.

# All I ask of you is the above and to not sell, distribute, or install for a fee StarClix 1.0 without my permission.
# All risks of using StarClix 1.0 are the user's responsibility, not the creator of the script.
# For further information and updates, visit the StarClix 1.0 site at http://gurukitty.com/star.
# Thank you for downloading StarClix 1.0!

// Absolute path, with trailing slash
$ABS_PATH = "/home/yourdomain/public_html/";

// Relative path and name of tracking data file (no extension)
$DAT_FILE = "clix";

// Extension of tracking data file
$DAT_EXT = ".dat";

// Relative path and name of admin name/pass file
$CFG_FILE = "clix_cfg.dat";

// URL of your site, with trailing slash
$SITE_URL = "http://www.yourdomain.com";

/******************************************************************************/
/* DO NOT EDIT BELOW THIS LINE */
/******************************************************************************/

/*********CONFIG*********/
if (file_exists($ABS_PATH.$CFG_FILE))
{
  $admin = file($ABS_PATH.$CFG_FILE);
  $admin = implode('', $admin);
  $data = explode("||", $admin);
  if ($SELF == 'clix_admin.php')
  {
    $user = $data[0];                   // username
    $pass = $data[1];                   // password
  }
  $num_files = $data[2];              // number of data files
  $def_file = $data[3];               // ID # of default file
  $full_urls = $data[4];              // whether to show full or short urls in admin panel
}

/*********FILE*********/
$file_id = $_REQUEST['id'];
if (empty($def_file))
  $def_file = 1;
if (empty($file_id))
  $file_id = $def_file;

$d_file = $DAT_FILE.$file_id.$DAT_EXT;

/*********DATA*********/
$file_id = $_GET['id'];
if (empty($file_id))
  $file_id = $def_file;

if ($SELF == 'clix_admin.php' && file_exists($ABS_PATH.$d_file))
{
  $clix = file($ABS_PATH.$d_file);
  $total[$file_id] = 0;
  while (list ($n, $line) = each ($clix))
  {
    $clixE = explode("||", $line);
    $clix_urls[$n] = $clixE[0];
    $clix_clix[$n] = $clixE[1];
    $total[$file_id]++;
  }
}

/******************************************************************************/

/*********FUNCTIONS*********/

// Displays the login form
function displayLogin($correct)     # If the user/pass combo is correct
{
  global $SELF;
  
  top();
  if (!$correct)
    echo '<p>That username/password combination is incorrect. Please try again.</p>';
  echo '<form method="post" action="'.$SELF.'">';
  echo '<input type="hidden" name="sendform" value="Y">';
  echo '<p><b>Username:</b><br><input type="text" name="formuser" size="20"></p>';
  echo '<p><b>Password:</b><br><input type="password" name="formpass" size="20"></p>';
  echo '<p><input type="submit" value="Login"></p>';
  echo '</form>';
}

/******************************************************************************/

// Outputs the footer
function footer()
{ ?>
</td></tr></table>
</td></tr></table>
</p>
</body>
</html>
  <?php
}

/******************************************************************************/

// Outputs the menu
function menu()
{
  global $SELF; ?>
<p align="center"><a href="<?=$SELF?>?do=main">Main</a> // <a href="<?=$SELF?>?do=files">Manage Data Files</a> // <a href="<?=$SELF?>?do=editlogin">Edit Login Info</a> // <a href="clix_readme.html" target="_blank">Readme</a> // <a href="<?=$SELF?>?do=logout">Logout</a></p>
  <?php
}

/******************************************************************************/

// Returns the number of links in a data file
function numLinks($fid)    # ID number of the data file
{
  global $ABS_PATH, $DAT_FILE, $DAT_EXT;
  
  $file = file($ABS_PATH.$DAT_FILE.$fid.$DAT_EXT);
  $num = 0;
  while (list ($n, $line) = each ($file))
    $num++;
  
  return $num;
}

/******************************************************************************/

// Saves a data file
function saveFile($body,$file)   # string to save to file
{
  global $ABS_PATH;

  $fileh = fopen($ABS_PATH.$file, "w");
  flock($fileh, LOCK_EX);
  fwrite($fileh, $body);
#  if (fwrite($fileh, $body) === FALSE)
#    $result = false;
#  else
#    $result = true;
  flock($fileh, LOCK_UN);
  fclose($fileh);
  
#  return $result;
}

/******************************************************************************/

// Sets the body for $CFG_FILE
function setCFG($cuser,$cpass,$cnum_files,$cdef_file,$cfull_urls)
{
  $body = $cuser.'||'.$cpass.'||'.$cnum_files.'||'.$cdef_file.'||'.$cfull_urls;
  
  return $body;
}

/******************************************************************************/

// Outputs a title
function title($text)    # the text
{
  echo '<p align="center"><u>'.$text.'</u></p>'."\n";
}

/******************************************************************************/

// Outputs the header
function top()
{ ?>
<html>
<head>
<title>StarClix 1.0</title>
<script language="JavaScript">
<!--
function check_boxes(cbname, state)
{
 for (i = 0; i < document.IDs.elements.length; i++)
 {
   if (document.IDlinks.elements[i].name == cbname)
   {
     document.IDlinks.elements[i].checked = state;
   }
 }
}
-->
</script>
<link href="clix_style.css" rel="stylesheet" type="text/css">
</head>
<body>
<br>
<br>
<p align="center"><font size="+2" style="font-family: courier new, verdana, Helvetica, sans-serif;">STAR CLIX 1.0</font></p>
<p align="center"> <table bgcolor="#000000" cellpadding="0" cellspacing="1" width="500">
<tr>
 <td> <table bgcolor="#ffffff" cellpadding="10" cellspacing="0" width="100%">
  <tr>
   <td>
  <?php
}

/******************************************************************************/

// Updates login info in file
function updateLogin($nuser,$npass)  # new username # new password
{
  global $ABS_PATH, $CFG_FILE, $SELF, $num_files, $def_file, $full_urls;

  $body = setCFG($nuser,$npass,$num_files,$def_file,$full_urls);
  saveFile($body,$CFG_FILE);
  echo '<p>Success! Your login information has been updated.<br>You must <a href="'.$SELF.'">re-login</a> with your new password.</p>';
}

?>