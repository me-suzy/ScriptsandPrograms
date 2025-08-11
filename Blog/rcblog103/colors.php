<?php

	// RCBlog - colors.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	require('scripts/rcb_functions.php');
	$loggedin = rcb_loggedin(true);
	
	function rcb_rgb2hsv($r, $g, $b){
		$min = min($r, $g, $b); // maximum rgb
		$max = max($r, $g, $b); // minimum rgb
		$dex = $max - $min;     // delta extremus
		$v = $max;
		if($dex == 0) $h = $s = 0;
		else{
			$s = $dex / $max;
			$dr = (($max-$r)/6 + $dex/2)/$dex;
			$dg = (($max-$g)/6 + $dex/2)/$dex;
			$db = (($max-$b)/6 + $dex/2)/$dex;
			if    ($r == $max) $h = $db - $dg;
			elseif($g == $max) $h = $dr - $db + 1/3;
			else               $h = $dg - $dr + 2/3;
		}
		if($h<0) $h += 1;
		if($h>=1) $h -= 1;
		return array($h, $s, $v);
	}

	function rcb_hsv2rgb($h, $s, $v){
		if($s==0) $r = $g = $b = $v;
		else{
			$h6 = $h*6;
			$i  = floor($h6);
			$v1 = $v*(1 - $s);
			$v2 = $v*(1 - $s*($h6-$i));
			$v3 = $v*(1 - $s*(1-($h6-$i)));
			if    ($i==0){ $r = $v ; $g = $v3; $b = $v1; }
			elseif($i==1){ $r = $v2; $g = $v ; $b = $v1; }
			elseif($i==2){ $r = $v1; $g = $v ; $b = $v3; }
			elseif($i==3){ $r = $v1; $g = $v2; $b = $v ; }
			elseif($i==4){ $r = $v3; $g = $v1; $b = $v ; }
			else         { $r = $v ; $g = $v1; $b = $v2; }
		}
		return array($r,$g,$b);
	}

	function rcb_real2hex($x){
		$x = round($x*255);
		$hex = dechex($x);
		if(strlen($hex)==0) return '00';
		if(strlen($hex)==1) return '0'.$hex;
		return substr($hex, -2);
	}

	function rcb_rgb2hex($r,$g,$b){
		return rcb_real2hex($r).rcb_real2hex($g).rcb_real2hex($b);
	}

	function rcb_hsv2hex($h,$s,$v){
		$rgb = rcb_hsv2rgb($h,$s,$v);
		return rcb_rgb2hex($rgb[0], $rgb[1], $rgb[2]);
	}

	function rcb_hex2rgb($hex){
		return array(hexdec(substr($hex,0,2))/255, hexdec(substr($hex,2,2))/255, hexdec(substr($hex,4,2))/255);
	}

	function rcb_getcolors($h, $s, $v){
		return array(
			rcb_hsv2hex($h,   $s  , $v           ),
			rcb_hsv2hex($h,   $s/2, 1-(1-$v)/2   ),
			rcb_hsv2hex($h,   $s/4, 1-(1-$v)/4   ),
			rcb_hsv2hex($h, 2*$s/3, 2*$v/3       ),
			rcb_hsv2hex($h, 2*$s/3, $v/3         ),
			rcb_hsv2hex($h,   $s/2, $v-($v-0.5)/2),
			rcb_hsv2hex($h,   $s/4, $v-($v-0.5)/4),
			rcb_hsv2hex($h>0.5?$h-0.5:$h+0.5,$s, 3*$v/4)); // opposing link color
	}
	
	function rcb_setcolors($hex){
		global $rcb_colors;
		$rgb = rcb_hex2rgb($hex);
		$hsv = rcb_rgb2hsv($rgb[0], $rgb[1], $rgb[2]);
		$colors = rcb_getcolors($hsv[0], $hsv[1], $hsv[2]);
		$rcb_colors[ 0] = $colors[0];
		$rcb_colors[ 1] = $colors[4];
		$rcb_colors[ 2] = $colors[4];
		$rcb_colors[ 3] = $colors[3];
		$rcb_colors[ 4] = $colors[0];
		$rcb_colors[ 5] = $colors[3];
		$rcb_colors[ 6] = $colors[5];
		$rcb_colors[ 7] = $colors[6];
		$rcb_colors[ 8] = $colors[5];
		$rcb_colors[ 9] = $colors[2];
		$rcb_colors[10] = $colors[3];
		$rcb_colors[11] = $colors[2];
		$rcb_colors[12] = $colors[2];
		$rcb_colors[13] = 'ffffff';
		$rcb_colors[14] = '000000';
		$rcb_colors[15] = '000000';
		$rcb_colors[16] = 'ffffff';
		$rcb_colors[17] = '000000';
		$rcb_colors[18] = '000000';
		$rcb_colors[19] = $colors[4];
		$rcb_colors[20] = $colors[4];
		$rcb_colors[21] = $colors[7];
		$rcb_colors[22] = $colors[7];
	}
	
	function rcb_writecolors(){
		global $rcb_colors;
		if(rcb_writefile('config/colors.css', implode("\n", array(
			"body{ background-color:#$rcb_colors[4]; color:#000000; }",
			"#frame{ border-color:#$rcb_colors[1]; }",
			"#header{ border-color:#$rcb_colors[1]; background-color:#$rcb_colors[5]; color:#$rcb_colors[13]; }",
			"#content{ border-color:#$rcb_colors[1]; background-color:#$rcb_colors[6]; }",
			"#nav{ border-color:#$rcb_colors[1]; background-color:#$rcb_colors[7]; }",
			"#footer{ border-color:#$rcb_colors[1]; background-color:#$rcb_colors[8]; color:#$rcb_colors[14]; }",
			"div.post{ border-color:#$rcb_colors[2]; background-color:#$rcb_colors[9]; color:#$rcb_colors[15]; }",
			"div.post div.title{ border-color:#$rcb_colors[2]; background-color:#$rcb_colors[10]; color:#$rcb_colors[16]; }",
			"div.post div.navtitle{ border-color:#$rcb_colors[2]; background-color:#$rcb_colors[10]; color:#$rcb_colors[16]; }",
			"div.post div.comment{ border-color:#$rcb_colors[2]; background-color:#$rcb_colors[11]; color:#$rcb_colors[17]; }",
			"div.post div.code{ border-color:#$rcb_colors[3]; background-color:#$rcb_colors[12]; color:#$rcb_colors[18]; }",
			"div.post div.quote{ border-color:#$rcb_colors[3]; background-color:#$rcb_colors[12]; color:#$rcb_colors[18]; }",
			"hr{ background-color:#$rcb_colors[3]; color:#$rcb_colors[3]; }",
			"a:link{ color:#$rcb_colors[19]; }",
			"a:visited{ color:#$rcb_colors[20]; }",
			"a:hover{ color:#$rcb_colors[21]; }",
			"a:active{ color:#$rcb_colors[22]; }",
		)))){
			rcb_writeconfig();
			return true;
		}
		return false;
	}

	$msg = '';
	$write = false;
	if(isset($_POST['applyauto'])){
		rcb_setcolors($_POST['color_00']);
		$write=true;
	}
	elseif(isset($_POST['applyeach'])){
		$rcb_colors = array(
		0  => $_POST['color_04'],
		1  => $_POST['color_01'],
		2  => $_POST['color_02'],
		3  => $_POST['color_03'],
		4  => $_POST['color_04'],
		5  => $_POST['color_05'],
		6  => $_POST['color_06'],
		7  => $_POST['color_07'],
		8  => $_POST['color_08'],
		9  => $_POST['color_09'],
		10 => $_POST['color_10'],
		11 => $_POST['color_11'],
		12 => $_POST['color_12'],
		13 => $_POST['color_13'],
		14 => $_POST['color_14'],
		15 => $_POST['color_15'],
		16 => $_POST['color_16'],
		17 => $_POST['color_17'],
		18 => $_POST['color_18'],
		19 => $_POST['color_19'],
		20 => $_POST['color_20'],
		21 => $_POST['color_21'],
		22 => $_POST['color_22']);
		$write=true;
	}

	foreach($rcb_colors as $i => $hex){
		if(strlen($hex)<6) $rcb_colors[$i] .= str_repeat('0', 6-strlen($hex));
		elseif(strlen($hex)>6) $rcb_colors[$i] = substr($hex, 0, 6);
	}

	if($write){
		if(!rcb_writecolors()){
			rcb_redirect('colors.php?msg=nowrite');
		}
		rcb_redirect('colors.php');
	}

	rcb_printheader();
	rcb_printbodystart();
	rcb_printcontentstart();

	if($msg=='nowrite') rcb_printcustompost('Error', 'Could not write to file.');

	for($i=0; $i<=22; $i++){
		if(!isset($rcb_colors[$i])) $rcb_colors[$i] = '';
	}

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Set Colors Automatically</div>\n";
	echo "<div class=\"text\">\n";
	rcb_printformstart('setcolorsauto', 'post', 'colors.php');
	rcb_printforminput('Background Color', 'color_00', 'text', 20, $rcb_colors[0]);
	rcb_printformbutton('Apply', 'applyauto', 'submit');
	rcb_printformend();
	echo "</div></div>\n";

	echo "<div class=\"post\">\n";
	echo "<div class=\"title\">Set Colors Individually</div>\n";
	echo "<div class=\"text\">\n";
	rcb_printformstart('setcolorsind', 'post', 'colors.php');
	
	echo "Borders:<br/>\n";
	rcb_printforminputl('Outer Border' , 'color_01', 'text', 20, $rcb_colors[1]);
	rcb_printforminputl('Post Border'  , 'color_02', 'text', 20, $rcb_colors[2]);
	rcb_printforminputl('[code] and [quote] Border; [hr]', 'color_03', 'text', 20, $rcb_colors[3]);
	
	echo "<br/>Backgrounds:<br/>\n";
	rcb_printforminputl('Background Color'          , 'color_04', 'text', 20, $rcb_colors[ 4]);
	rcb_printforminputl('Header Background'         , 'color_05', 'text', 20, $rcb_colors[ 5]);
	rcb_printforminputl('Content Area Background'   , 'color_06', 'text', 20, $rcb_colors[ 6]);
	rcb_printforminputl('Navigation Area Background', 'color_07', 'text', 20, $rcb_colors[ 7]);
	rcb_printforminputl('Footer Background'         , 'color_08', 'text', 20, $rcb_colors[ 8]);
	rcb_printforminputl('Post Background'           , 'color_09', 'text', 20, $rcb_colors[ 9]);
	rcb_printforminputl('Post Title Background'     , 'color_10', 'text', 20, $rcb_colors[10]);
	rcb_printforminputl('Post Comment Background'   , 'color_11', 'text', 20, $rcb_colors[11]);
	rcb_printforminputl('[code] and [quote] Background'         , 'color_12', 'text', 20, $rcb_colors[12]);
	
	echo "<br/>Foregrounds:<br/>\n";
	rcb_printforminputl('Header Text' , 'color_13', 'text', 20, $rcb_colors[13]);
	rcb_printforminputl('Footer Text' , 'color_14', 'text', 20, $rcb_colors[14]);
	rcb_printforminputl('Post Text'   , 'color_15', 'text', 20, $rcb_colors[15]);
	rcb_printforminputl('Post Title'  , 'color_16', 'text', 20, $rcb_colors[16]);
	rcb_printforminputl('Post Comment', 'color_17', 'text', 20, $rcb_colors[17]);
	rcb_printforminputl('[code] and [quote] Text' , 'color_18', 'text', 20, $rcb_colors[18]);
	rcb_printforminputl('Link'        , 'color_19', 'text', 20, $rcb_colors[19]);
	rcb_printforminputl('Visited Link', 'color_20', 'text', 20, $rcb_colors[20]);
	rcb_printforminputl('Hover Link'  , 'color_21', 'text', 20, $rcb_colors[21]);
	rcb_printforminputl('Active Link' , 'color_22', 'text', 20, $rcb_colors[22]);
	echo "<br/>\n";
	rcb_printformbutton('Apply', 'applyeach', 'submit');
	rcb_printformend();
	echo "</div></div>\n";

	rcb_printcontentend();
	rcb_printnav($loggedin);
	rcb_printbodyend();

?>
