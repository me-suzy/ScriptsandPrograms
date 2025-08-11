<?php
/***************************************************************************
 *   blog_resize.php
 *
 *   copyright © 2004 Axel Achten / e-motionalis.net
 *   contact: thefiddler@e-motionalis.net
 *   this file is a part of the " e-moBLOG " weblog engine
 *
 *   This program is a free software. You can modify it as you wish, though
 *   we would just appreciate if you could keep the copyright notice on the
 *   pages (including the engine version and link)  even if you should feel
 *   free to add your own copyright if you modified and enhanced the code.
 *
 *   Please note though that, this software being copyrighted means that the
 *   whole code (or part of it) is.  You should thus not sell any version of
 *   this program, neither any modified version of it using part of the fol-
 *   lowing code. Moreover, please do not use it for commercial purposes.
 *
 ***************************************************************************/

// used to resize images on-the-fly --- ATTENTION: uses GD library and JPEG linux/unix lib
// receives a string such as "http://e-motionalis.net/influence/influence.jpg" into the $img variable

	// check if language option has already been loaded
	if (!defined("BLANG")) {
		require ("./includes/db.php");
		require ("./includes/functions.php");

		if (!$connection) {
			$connection = connect(NAME, PASSWD, BASE, SERVER);
		}

		$result = execRequest("SELECT language FROM blogconfig", $connection);
		while ($lan = nextLine($result)) {
			define (BLANG, "$lan->language");
		}
	}

	require ("./language/" . BLANG . ".php");
	require ("./constants.php");

	// sets the maximum width the image will be resized to
	if (!$rwidth || $rwidth == "" || $rwidth == 0) {
    	$maxwidth = (MAX_WIDTH - 10);
	} else {
		$maxwidth = $rwidth;
	}

	$ftype = substr($img, -3, 3);
	
	if ($ftype == "jpg" || $ftype == "JPG") {
 		$src = imageCreateFromJpeg($img);
	} else if ($ftype == "png" ||$ftype == "PNG") {
		$src = imageCreateFromPng($img);
	} else {
		$ftype = "err";
		$src   = imageCreate(220, 15);
		$bg_color  = imageColorAllocate($src, 0, 0, 0);
		$fg_color1 = imageColorAllocate($src, 255, 255, 255);
		$fg_color2 = imageColorAllocate($src, 255, 0, 0);
		imageString($src, 3, 6, 1, $lang['error'], $fg_color2);
		imageString($src, 3, 55, 1, $lang['pic_format'], $fg_color1);
	}
	   
 	$width = imageSX($src);
 	$height = imageSY($src);
	$aratio = ($width/$height);

	if ($width <= $maxwidth) {
 	    $new_w = $width;
 	   	$new_h = $height;
  	} else {
  	   	$new_w = $maxwidth;
		if ($width != $height) {
			$new_h = ($new_w/$aratio);
		} else if ($width = $height) {
			$new_h = $new_w;
		}
 	}

	// actually create the image and output it
 	$imgf = imageCreateTrueColor($new_w, $new_h); 
	imageCopyReSampled($imgf, $src, 0, 0, 0, 0, $new_w, $new_h, $width, $height); 
	
	if ($ftype == "jpg" || $ftype == "JPG") {
		imageJpeg($imgf, '', 70);
	} else if ($ftype == "png" || $ftype == "PNG") {
		ImagePng($imgf);
	} else if ($ftype == "err") {
		ImagePng($imgf);
	}

	// free the memory that was used to create the image
	imageDestroy($imgf);
	imageDestroy($src);
	
?>