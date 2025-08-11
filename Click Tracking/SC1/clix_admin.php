<?php

# StarClix 1.0
# Copyright 2003-2004 Tara, http://gurukitty.com/star. All rights reserved.
# Released August 5, 2004

# StarClix 1.0 is linkware and can be used and modified as long all notes on the StarClix 1.0 files remain intact, unaltered, and a link is placed on all pages used by the StarClix 1.0 script to http://gurukitty.com/star so others can find out about this script as well. You may modify this script to suit your wishes, so long as you do not distribute or sell it.

# All I ask of you is the above and to not sell, distribute, or install for a fee StarClix 1.0 without my permission.
# All risks of using StarClix 1.0 are the user's responsibility, not the creator of the script.
# For further information and updates, visit the StarClix 1.0 site at http://gurukitty.com/star.
# Thank you for downloading StarClix 1.0!

/*********INITIALIZE*********/
$SELF = 'clix_admin.php';
require_once('clix_common.inc.php');
$DO = $_GET['do'];

// If config file doesn't exist (if username/pass not yet set)
if (!file_exists($ABS_PATH.$CFG_FILE) && $DO != 'setup')
{ 
  top(); ?>
  <form method="POST" action="<?=$SELF?>?do=setup">
  <p>Since you have not yet logged in to StarClix, you need to set-up the inital configuration below.</p>
  <p><b>Username:</b><br><input type="text" name="user" size="30"></p>
  <p><b>Password:</b><br><input type="password" name="pass" size="30"></p>
  <p>Show full URLs in admin panel?<br><?php
  if ($full_urls == 0)
  {
    echo '<input type="radio" name="full" value="0" checked> No, don\'t show the $SITE_URL part of the URL.<br>';
    echo ' <input type="radio" name="full" value="1"> Yes, show the $SITE_URL part of the URL.';
  }
  else
  {
    echo '<input type="radio" name="full" value="0"> No, don\'t show the $SITE_URL part of the URL<br>';
    echo ' <input type="radio" name="full" value="1" checked> Yes, show the $SITE_URL part of the URL.';
  }
  ?></p>
  <p><input type="submit" value="Submit"></p>
  </form>
  <?php
  footer();
  exit;
}

/*************LOGIN*************/
// If $DO != 'setup'...then login
if ($DO != 'setup')
{
  if (isset($_COOKIE['scuser']) && isset($_COOKIE['scpass']))
  {
    if ($_COOKIE['scuser'] == $user && $_COOKIE['scpass'] == $pass)
      $logged = true;
    else
    {
      $logged = false;
      // Unset cookies
      setcookie("scuser", '', time()-5200);
      setcookie("scpass", '', time()-5200);
      // Display login form
      displayLogin(1);
    }
  }
  else
  {
    // Escape password && username
    $formuser = addslashes($_POST['formuser']);
    $formpass = $_POST['formpass'];

    // Check username && password with config options
    if ($formuser == $user && $formpass == $pass)
    {
      $logged = true;
      setcookie("scuser", $formuser, time()+5200);
      setcookie("scpass", $formpass, time()+5200);
    }
    else
      $logged = false;
  
    // Display form if necessary
    if (!$logged)
    {
      if (($formuser != $user || $formpass != $pass) && (!empty($formuser) && !empty($formpass)))
        displayLogin(0);
      else
        displayLogin(1);
    }
  }

  // If not logged in
  if (!$logged)
    exit;
}

// Include header if not logout screen
if ($DO != 'logout')
{
  top();
  if ($DO != 'setup')
    menu();
}

/******************************************************************************/

/* Main page */
/* Displays welcome message and clicks tracking data */
if (empty($DO) || $DO == 'main')
{ ?>
  <!-- <p>Welcome to your StarClix administrative panel. The clicks tracking data is displayed below. You may edit the number of visits for each link and/or delete link(s) by checking the corresponding checkbox(es). To add new links manually click on the link below.</p> -->
 
  <?php title('Data File #'.$file_id); ?>
  
  <form method="post" action="<?=$SELF?>?do=addlinks">
  <input type="hidden" name="id" value="<?=$file_id?>">
  <p><input type="submit" value="Add A Link"></p>
  </form>
  
  <!-- if there are links in the data file -->
  <?php if ($total[$file_id] > 0 && file_exists($d_file)) { ?>
  <form name="IDs" method="post" action="<?=$SELF?>?do=modlinks">
  <input type="hidden" name="id" value="<?=$file_id?>">
  
  <p><input type="button" value="Clear All" onClick="check_boxes('delIDs[]',0)"> <input type="button" value="Select All" onClick="check_boxes('delIDs[]',1)"></p>
  
  <p><table cellspacing="1" cellpadding="5" bgcolor="#000000" width="100%">
  <tr>
  <td width="5%">&nbsp;</td>
  <td align="center"><b>Link</b></td>
  <td width="5%" align="center"><b>Visits</b></td>
  </tr> <?php
  for ($i = 0; $i < $total[$file_id]; $i++)
  {
    $site = preg_replace("/\//", "\/", $SITE_URL);
    if (preg_match("/".$site."/", $clix_urls[$i]) && !$full_urls)
      $clix_nurls[$i] = preg_replace("/".$site."/", "", $clix_urls[$i]);
    else
      $clix_nurls[$i] = $clix_urls[$i];
    ?>
    <tr>
    <td><input type="checkbox" name="delIDs[]" value="<?=$i?>"></td>
    <td><a href="<?=$clix_urls[$i]?>" target="_blank"><?=$clix_nurls[$i]?></a></td>
    <td align="center"><input type="text" name="visits[<?=$i?>]" size="5" value="<?=$clix_clix[$i]?>"></td>
    </tr>
    <?php
  }
  echo '</table>';
  echo '</p>';
  echo '<input type="submit" value="Submit">';
  echo '</form>';
  }
  // if there are no links in the data file
  else
  {
    if (!file_exists($d_file))
      echo '<p>Error! This data file does not exist.</p>';
    elseif ($total[$file_id] == 0)
      echo '<p>There are no links in this data file.</p>';
  }
}

/******************************************************************************/

/* Add a link */
/* Displays simple form to add a link to a data file */
if ($DO == 'addlinks')
{
  $sent = $_POST['sent'];
  
  // If no form sent, display form
  if (!$sent)
  {
    title('Add A Link');  ?>
    <p>To add a link to <b>data file #<?=$_REQUEST['id']?></b>, fill out the form below.</p>
  
    <form method="post" action="<?=$SELF?>?do=addlinks">
    <input type="hidden" name="sent" value="1">
    <input type="hidden" name="id" value="<?=$_REQUEST['id']?>">
  
    <p>Link URL:<br><input type="text" name="url" size="30"></p>
    <p>Initial Visits:<br><input type="text" name="visits" size="30" value="0"></p>
    <p><input type="submit" value="Submit"></p>
    
    <p><a href="<?=$SELF?>?do=main&id=<?=$_REQUEST['id']?>">Back to the data file</a></p>
    <?php
  }
  // If form sent, add to db
  else
  {
    $n_url = $_POST['url'];
    // Check to see if visits is blank
    if (empty($_POST['visits']))
      $_POST['visits'] = 0;
    // Check to see if URL is blank
    if (empty($n_url))
      echo '<p>Error! You must enter a URL. Go <a href="'.$SELF.'?do=addlinks">back</a> and try again.</p>';
    // If all is well, proceed
    else
    {
      // Check to see if URL is set
      if (!preg_match("/http:/", $n_url))
        $n_url = $SITE_URL.$_POST['url'];
      // Get file prepped
      $db_a = file($ABS_PATH.$d_file);
      $db = join("", $db_a);
      // Write to file
      $db .= $n_url.'||'.$_POST['visits']."||\n";
      saveFile($db, $d_file);
      echo '<p>Success! The link has been added to data file #'.$_REQUEST['id'].'.</p>';
      echo '<p><a href="'.$SELF.'?do=addlinks&id='.$_REQUEST['id'].'">Add another link?</a>';
      echo '<br><a href="'.$SELF.'?do=main&id='.$_REQUEST['id'].'">Back to the data file</a></p>';
    }
  }
}

/******************************************************************************/

/* Edit login info */
/* Displays form to allow user to edit their username and/or password */
if ($DO == 'editlogin')
{
  title('Edit Login Info'); ?>
  <form method="post" action="<?=$SELF?>?do=updatelogin">

  <p>Please note that after changing this information, you will have to re-login.</p>

  <p><b>Username:</b><br><i>The name you would like the script to call you. This will also be your username.</i><br>
  <input type="text" name="user" size="25" value="<?=$user?>"></p>

  <p><b>Old password:</b><br><i>Please enter your old password below for verification.</i><br>
  <input type="password" name="oldpass" size="25"></p>

  <p><b>New password:</b><br><i>Please enter your desired new password below.</i><br>
  <input type="password" name="newpass" size="25"></p>

  <p><input type="submit" name="submit" value="Submit"></p>
  </form>
  <?php
}

/******************************************************************************/

/* Manage Data Files */
/* Displays all data files, # of links in each, and allows adding and deleting of data files */
if ($DO == 'files')
{
  $type = $_GET['type'];
  title('Manage Data Files');
  // If $type isn't set, link to new data file and default setting screens and link to all data files
  if (empty($type))
  { ?>
    <p><a href="<?=$SELF?>?do=files&type=new">New Data File</a> // <a href="<?=$SELF?>?do=files&type=opt">Set Options</a></p>

    <form name="IDs" method="post" action="<?=$SELF?>?do=files&type=del">
    <input type="hidden" name="id" value="<?=$file_id?>">
  
    <p><input type="button" value="Clear All" onClick="check_boxes('delIDs[]',0)"> <input type="button" value="Select All" onClick="check_boxes('delIDs[]',1)"></p>
    
    <p><table cellspacing="1" cellpadding="5" bgcolor="#000000" width="100%">
    <tr>
    <td width="5%">&nbsp;</td>
    <td align="center"><b>File Name</b></td>
    <td width="5%" align="center"><b>Links</b></td>
    </tr>
    <?php
    // Loop through all data files
    for ($i = 1; $i <= $num_files; $i++)
    { 
      if (file_exists($ABS_PATH.$DAT_FILE.$i.$DAT_EXT))
      { ?>
        <tr>
        <td><input type="checkbox" name="delIDs[]" value="<?=$i?>"></td>
        <td><a href="<?=$SELF?>?do=main&id=<?=$i?>"><?=$DAT_FILE.$i.$DAT_EXT?></a></td>
        <td align="center"><?=numLinks($i)?></td>
        </tr>
        <?php
      }
    }
    echo '</table>';
    echo '</p>';
    echo '<input type="submit" value="Delete">';
    echo '</form>';
  }
  // Create new data file
  elseif ($type == 'new')
  {
    $num_files++;
    $body = setCFG($user,$pass,$num_files,$def_file,$full_urls);
    saveFile($body, $CFG_FILE);
    saveFile('', $DAT_FILE.$num_files.$DAT_EXT);
    echo '<p>The new data file has been successfully created.</p>';
  }
  // Delete data file(s)
  elseif ($type == 'del')
  {
    echo '<p>';
    for ($i = 1; $i <= $num_files; $i++)
    {
      // If the data file currently exists && it is in the to be deleted array, delete it
      if (file_exists($ABS_PATH.$DAT_FILE.$i.$DAT_EXT) && in_array($i, $_POST['delIDs']))
      {
        if (unlink($ABS_PATH.$DAT_FILE.$i.$DAT_EXT))
          echo 'Data file #'.$i.' was successfully deleted.<br>';
        else
          echo 'Data file #'.$i.' was not able to be deleted.<br>';
      }
    }
    echo '</p>';
  }
  // Form to set default data file
  elseif ($type == 'opt')
  { ?>
    <p><b>Set Options</b></p>
    
    <p>Note: The <i>default data file</i> is the data file that will be displayed on the main page if there is no id in the query string. It is also the data file to which links will be added if no id is specified in the query string on clix.php.</p>
    
    <form method="post" action="<?=$SELF?>?do=files&type=setopt">
    <p>ID# of the default data file:<br>
    <input type="text" name="default" size="10" value="<?=$def_file?>"></p>
    
    <p>Show full URLs in admin panel?<br><?php
    if ($full_urls == 0)
    {
      echo '<input type="radio" name="full" value="0" checked> No, don\'t show the $SITE_URL part of the URL.<br>';
      echo ' <input type="radio" name="full" value="1"> Yes, show the $SITE_URL part of the URL.';
    }
    else
    {
      echo '<input type="radio" name="full" value="0"> No, don\'t show the $SITE_URL part of the URL<br>';
      echo ' <input type="radio" name="full" value="1" checked> Yes, show the $SITE_URL part of the URL.';
    }
    ?></p>
    
    <p><input type="submit" value="Submit"></p>
    </form>
    <?php
  }
  // Save new default data file ID
  elseif ($type == 'setopt')
  {
    $body = setCFG($user,$pass,$num_files,$_POST['default'],$_POST['full']);
    saveFile($body, $CFG_FILE);
    echo '<p>The default data file has been reset to data file #'.$_POST['default'].'.</p>';
  }
  else
    echo '<p>Invalid subroutine request. Go back to the <a href="'.$SELF.'">main page</a> and try again.</p>';
}

/******************************************************************************/

/* Logout screen */
/* Resets cookies to log the user out */
if ($DO == 'logout')
{
  // reset cookies
  setcookie("scuser", '', time()-5200);
  setcookie("scpass", '', time()-5200);
  // print message
  top();
  echo '<p>You have been logged out successfully.</p>';
  echo '<p><a href="'.$SELF.'">Login again</a></p>';
}

/******************************************************************************/

/* Submit of modify links */
/* Edits the variables to allow for deleting links and editing visits, then saves the data file */
if ($DO == 'modlinks')
{
  $body = '';
  for ($i = 0; $i < $total[$file_id]; $i++)
  {
    // If at least one link is selected to be deleted
    if (isset($_POST['delIDs']))
    {
      // If not to be deleted (else don't write to file)
      if (!in_array($i, $_POST['delIDs']))
      {
        $body .= $clix_urls[$i];
        $body .= '||'.$_POST['visits'][$i];
        $body .= "||\n";
      }
    }
    // If no links are selected to be deleted, simply write to file
    else
    {
      $body .= $clix_urls[$i];
      $body .= '||'.$_POST['visits'][$i];
      $body .= "||\n";
    }
  }
  
  saveFile($body, $d_file);
  echo '<p>Success! All link modifications and deletions have been performed and the data saved to data file #'.$_REQUEST['id'].'.</p>';
  echo '<p><a href="'.$SELF.'?do=main&id='.$_REQUEST['id'].'">Back to the data file</a></p>';
}

/******************************************************************************/

/* Setup */
/* If necessary creates $d_file, then creates $CFG_FILE and writes username and password to it. */
if ($DO == 'setup')
{
  $body = setCFG($_POST['user'],$_POST['pass'],'1','1',$_POST['full']);
  saveFile($body,$CFG_FILE);
  if (!file_exists($ABS_PATH.$d_file))
    saveFile('',$d_file);
  echo '<p>The username and password you have specified have been saved successfully. You may now <a href="'.$SELF.'">login</a> to your StarClix admin panel.</p>';
}

/******************************************************************************/

/* Update login info in $CFG_FILE */
/* Checks to make sure (1) oldpass is correct, (2) newpass != oldpass, (3) oldpass isn't blank, (4) newpass isn't blank and then either outputs the corresponding error messages or queries $tbconfig to update the information. */
if ($DO == 'updatelogin')
{
  // set form values to new variables
  $formuser = addslashes($_POST['user']);
  $oldpass = $_POST['oldpass'];
  $newpass = $_POST['newpass'];
  $success = false;
  // If no username
  if (empty($formuser))
    $msg = "You must enter a username.<br>";
  // If no old pass
  elseif (empty($oldpass))
    $msg = "You must enter your old password.<br>";
  // If no new pass
  elseif (empty($newpass))
    $msg = "You must enter a new password.<br>";
  // if oldpass and the password in db don't match
  elseif ($oldpass != $pass)
    $msg = "Invalid old password.<br>";
  // If new pass is the same as one in db
  elseif ($newpass == $pass)
    $msg = "New password is the same as the old password.<br>";
  // If old pass and pass in db match...success!
  elseif ($oldpass == $pass)
  {
    updateLogin($formuser, $newpass);
    $success = true;
  }
  else
    $msg = "Unknown error.<br>";
  // outputs the error message(s) (if any) or the success message
  if (!$success)
    echo "<b>Error</b><br>".$msg.'</p><p>Please <a href="'.$SELF.'?do=editlogin">try again</a>.';
}

/******************************************************************************/

footer();   // Output footer

?>