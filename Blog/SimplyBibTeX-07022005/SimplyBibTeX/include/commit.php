<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: handles uploading and changing internal settings
// Description		: configuration settings
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id: commit.php,v 1.4 2005/01/18 17:08:50 seichter Exp $
//

require_once('globals.php');

/* check if we have a command posted */
$command = $_POST['command'];
$location = '';

/* check if there is a file comming in */
if ($command == 'upload')
{
	$name = $HTTP_POST_FILES['userfile']['name'];
	$size = $HTTP_POST_FILES['userfile']['size'];
	$tmp  = $HTTP_POST_FILES['userfile']['tmp_name'];
	$type = $HTTP_POST_FILES['userfile']['type'];
	$error= $HTTP_POST_FILES['userfile']['error'];

	global $cfg;

	if ($error == 0)
	{
		move_uploaded_file($tmp,'../' . $cfg['library'] . '/' . $name);
		/* maybe load it directly? */
		$location = '../';

	} else 
	{
		/* some kind of error */
	}
/* refreshing meta information */
} elseif ($command == 'refresh_meta') {
	$fp = fopen('../'.$_POST['db'] . '.meta','w+');
	if ($fp) {
		fwrite($fp,$_POST['meta']);
		fclose($fp);
	};
	$location = '../';

} elseif ($command == 'add_item') {
	
	/* prepend mode (newest first!) */
	$filename = '../'.$_POST['db'];
	$lines = file($filename);

	$fp = fopen('../'.$_POST['db'],'w+');
	if ($fp) {

		fwrite($fp,stripslashes($_POST['item']));
		fwrite($fp,"\r\n\r\n");
		
		foreach ($lines as $line)
		{
			$val = str_replace("\r\n","", $line);
			if (($val != FALSE) || (strlen($val) > 0)) fwrite($fp,"$val\r\n");
		}
		fclose($fp);
	};
	$location = '../?db='.$_POST['db'];
} elseif ($command == 'update_item') {
	
	/* load all lines into an array */
	$filename = '../'.$_POST['db'];
	$lines = file($filename);
	
	/* get the length of the original part */
	$length = $_POST['lineend'] - $_POST['linebegin'];
	
	/* explode the new items into an array */
	$newitem = explode("\r\n",stripslashes($_POST['item']));
	$newlines = array();
	foreach ($newitem as $newline)
		array_push($newlines,$newline . "\r\n");
		
	/* insert the items instead of the old */
	array_splice($lines,$_POST['linebegin']-1,$length,$newlines);
	
	/* open the file */
	$fp = fopen('../'.$_POST['db'],'w+');
	if ($fp) {
		fwrite($fp,implode('',$lines));		
		fclose($fp);
	}
	/* set the location for the reload */
	$location = '../?db='.$_POST['db'];
}

header('Location: '.$location);
?>
