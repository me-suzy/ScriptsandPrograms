<?php

# StarClix 1.0
# Copyright 2003-2004 Tara, http://gurukitty.com/star. All rights reserved.
# Released August 5, 2004

# StarClix 1.0 is linkware and can be used and modified as long all notes on the StarClix 1.0 files remain intact, unaltered, and a link is placed on all pages used by the StarClix 1.0 script to http://gurukitty.com/star so others can find out about this script as well. You may modify this script to suit your wishes, so long as you do not distribute or sell it.

# All I ask of you is the above and to not sell, distribute, or install for a fee StarClix 1.0 without my permission.
# All risks of using StarClix 1.0 are the user's responsibility, not the creator of the script.
# For further information and updates, visit the StarClix 1.0 site at http://gurukitty.com/star.
# Thank you for downloading StarClix 1.0!

/*********INCLUDES*********/
$SELF = "clix.php";
require_once('clix_common.inc.php');

/*********VARIABLES*********/
$QUERY = $_SERVER['QUERY_STRING'];
$URL = preg_replace("/id=".$file_id."&url=/", "", $QUERY);

/******************************************************************************/

// If the data file does not exist
if (!file_exists($ABS_PATH.$d_file))
  echo 'The file '.$d_file.' does not exist. Upload it and then try again.';

// If the data file isn't writable
elseif (!is_writable($ABS_PATH.$d_file))
  echo 'The file '.$d_file.' is not writable. CHMOD it to 766 or 666 and then try again.';
  
// If there is no query string
elseif (empty($URL))
  echo 'Invalid URL: There is no URL to redirect to.';

// If valid loop through file contents
else
{
  // If there is no http://
  if (!preg_match("/http:/", $URL))
    $URL = $SITE_URL.$URL;

  $file_a = file($ABS_PATH.$d_file);  
  $found = false;
  // Check to see if a URL in file matches query URL
  while (list ($n, $line) = each ($file_a))
  {
    if (!empty($line))
    {
      $data = explode("||", $line);  // $data[0]: URL || $data[1]: count
      if ($URL == $data[0])
      {
        $data[1]++;
        $file_a[$n] = $data[0].'||'.$data[1].'||'."\n";
        $found = true;
      }
    }
  }
  
  $file = join("", $file_a);

  // If URL not found above, add the URL to file
  if (!$found)
    $file .= $URL."||1||\n";

  // Write to file
  saveFile($file,$d_file);

  // Redirect to URL
  header("Location: ".$URL);
}

?>