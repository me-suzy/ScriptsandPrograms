<?php
/*
plugin-name: RCColors
plugin-url: http://www.fluffington.com/
plugin-version: 1.1.1
plugin-description: Color configuration for the RCBlog theme.
author-name: Noah Medling
author-url: http://www.fluffington.com/
*/

/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	class Plugin_RCBlog_Colors{
		function rgb2hsv($r, $g, $b){
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
	
		function hsv2rgb($h, $s, $v){
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
	
		function real2hex($x){
			$x = round($x*255);
			$hex = dechex($x);
			if(strlen($hex)==0) return '00';
			if(strlen($hex)==1) return '0'.$hex;
			return substr($hex, -2);
		}
	
		function rgb2hex($r,$g,$b){
			return Plugin_RCBlog_Colors::real2hex($r).Plugin_RCBlog_Colors::real2hex($g).Plugin_RCBlog_Colors::real2hex($b);
		}
	
		function hsv2hex($h,$s,$v){
			$rgb = Plugin_RCBlog_Colors::hsv2rgb($h,$s,$v);
			return Plugin_RCBlog_Colors::rgb2hex($rgb[0], $rgb[1], $rgb[2]);
		}
	
		function hex2rgb($hex){
			return array(hexdec(substr($hex,0,2))/255, hexdec(substr($hex,2,2))/255, hexdec(substr($hex,4,2))/255);
		}
	
		function getcolors($h, $s, $v){
			return array(
				Plugin_RCBlog_Colors::hsv2hex($h,   $s  , $v           ),
				Plugin_RCBlog_Colors::hsv2hex($h,   $s/2, 1-(1-$v)/2   ),
				Plugin_RCBlog_Colors::hsv2hex($h,   $s/4, 1-(1-$v)/4   ),
				Plugin_RCBlog_Colors::hsv2hex($h, 2*$s/3, 2*$v/3       ),
				Plugin_RCBlog_Colors::hsv2hex($h, 2*$s/3, $v/3         ),
				Plugin_RCBlog_Colors::hsv2hex($h,   $s/2, $v-($v-0.5)/2),
				Plugin_RCBlog_Colors::hsv2hex($h,   $s/4, $v-($v-0.5)/4),
				Plugin_RCBlog_Colors::hsv2hex($h>0.5?$h-0.5:$h+0.5,$s, 3*$v/4)); // opposing link color
		}
		
		function colors_process(){
			if(isset($_POST['sethex'], $_POST['hex'])){
				$rcb_colors = new FLog_config;
				if($rcb_colors->Load('rcb_colors', true)){
					$rgb = Plugin_RCBlog_Colors::hex2rgb($_POST['hex']);
					$hsv = Plugin_RCBlog_Colors::rgb2hsv($rgb[0], $rgb[1], $rgb[2]);
					$colors = Plugin_RCBlog_Colors::getcolors($hsv[0], $hsv[1], $hsv[2]);
					$rcb_colors->SetValue('00', $colors[0]);
					$rcb_colors->SetValue('01', $colors[4]);
					$rcb_colors->SetValue('02', $colors[4]);
					$rcb_colors->SetValue('03', $colors[3]);
					$rcb_colors->SetValue('04', $colors[0]);
					$rcb_colors->SetValue('05', $colors[3]);
					$rcb_colors->SetValue('06', $colors[5]);
					$rcb_colors->SetValue('07', $colors[6]);
					$rcb_colors->SetValue('08', $colors[5]);
					$rcb_colors->SetValue('09', $colors[2]);
					$rcb_colors->SetValue('10', $colors[3]);
					$rcb_colors->SetValue('11', $colors[2]);
					$rcb_colors->SetValue('12', $colors[2]);
					$rcb_colors->SetValue('13', 'ffffff');
					$rcb_colors->SetValue('14', '000000');
					$rcb_colors->SetValue('15', '000000');
					$rcb_colors->SetValue('16', 'ffffff');
					$rcb_colors->SetValue('17', '000000');
					$rcb_colors->SetValue('18', '000000');
					$rcb_colors->SetValue('19', $colors[4]);
					$rcb_colors->SetValue('20', $colors[4]);
					$rcb_colors->SetValue('21', $colors[7]);
					$rcb_colors->SetValue('22', $colors[7]);
					if($rcb_colors->Save()) FLog::Redirect('?+msg=message.success','p');
				}
				$_GET['msg'] = 'error.database';
			}
			elseif(isset($_POST['seteach'])){
				$rcb_colors = new FLog_config;
				if($rcb_colors->Load('rcb_colors', true)){
					$rcb_colors->SetValue('00', @$_POST['color_04']);
					$rcb_colors->SetValue('01', @$_POST['color_01']);
					$rcb_colors->SetValue('02', @$_POST['color_02']);
					$rcb_colors->SetValue('03', @$_POST['color_03']);
					$rcb_colors->SetValue('04', @$_POST['color_04']);
					$rcb_colors->SetValue('05', @$_POST['color_05']);
					$rcb_colors->SetValue('06', @$_POST['color_06']);
					$rcb_colors->SetValue('07', @$_POST['color_07']);
					$rcb_colors->SetValue('08', @$_POST['color_08']);
					$rcb_colors->SetValue('09', @$_POST['color_09']);
					$rcb_colors->SetValue('10', @$_POST['color_10']);
					$rcb_colors->SetValue('11', @$_POST['color_11']);
					$rcb_colors->SetValue('12', @$_POST['color_12']);
					$rcb_colors->SetValue('13', @$_POST['color_13']);
					$rcb_colors->SetValue('14', @$_POST['color_14']);
					$rcb_colors->SetValue('15', @$_POST['color_15']);
					$rcb_colors->SetValue('16', @$_POST['color_16']);
					$rcb_colors->SetValue('17', @$_POST['color_17']);
					$rcb_colors->SetValue('18', @$_POST['color_18']);
					$rcb_colors->SetValue('19', @$_POST['color_19']);
					$rcb_colors->SetValue('20', @$_POST['color_20']);
					$rcb_colors->SetValue('21', @$_POST['color_21']);
					$rcb_colors->SetValue('22', @$_POST['color_22']);
					if($rcb_colors->Save()) FLog::Redirect('?+msg=message.success','p');
				}
				$_GET['msg'] = 'error.database';
			}
		}

		function colors_display(){
			$colors = new FLog_Config;
			$colors->Load('rcb_colors');
			echo '<h1>RCBlog Colors</h1>';
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<p class="error">Database error.</p>'; break;
				case 'message.success': echo '<p class="message">Colors changed.</p>'; break;
			}
			echo '<fieldset><legend>Set Colors Automatically</legend>';
			echo '<form method="post" action="" accept-charset="utf-8">';
			echo '<p><label>Background Color:<br /><input type="text" name="hex" size="40" value="',isset($_POST['hex'])?htmlspecialchars($_POST['hex']):$colors->GetSafe('00'),'" /></label></p>';
			echo '<p><input type="submit" name="sethex" value="Apply" /></p>';			
			echo '</form>';
			echo '</fieldset>';

			$colornames = array(
				'_0' => 'Borders',
				'01' => 'Outer Border',
				'02' => 'Post Border',
				'03' => '[code] and [quote] Border; [hr]',

				'_1' => 'Backgrounds',
				'04' => 'Background Color',
				'05' => 'Header Background',
				'06' => 'Content Area Background',
				'07' => 'Navigation Area Background',
				'08' => 'Footer Background',
				'09' => 'Post Background',
				'10' => 'Post Title Background',
				'11' => 'Post Comment Background',
				'12' => '[code] and [quote] background',

				'_2' => 'Foregrounds',
				'13' => 'Header Text',
				'14' => 'Footer Text',
				'15' => 'Post Text',
				'16' => 'Post Title',
				'17' => 'Post Comment',
				'18' => '[code] and [quote]',
				'19' => 'Link',
				'20' => 'Visited Link',
				'21' => 'Hover Link',
				'22' => 'Active Link',
			);
			echo '<fieldset><legend>Set Colors Individually</legend>';
			echo '<form method="post" action="" accept-charset="utf-8">';
			$i=0;
			foreach($colornames as $key=>$value){
				if(substr($key,0,1)==='_'){
					if($i>0) echo '</p>';
					echo '<p>', $value, '<br />';
				}
				else{
					echo '<label><input type="text" size="40" name="color_',$key,'" value="',isset($_POST['color_'.$key])?htmlspecialchars($_POST['color_'.$key]):$colors->GetSafe($key),'" /> ',$value,'</label><br />';
				}
				++$i;
			}
			echo '</p>';
			echo '<p><input type="submit" name="seteach" value="Apply" /></p>';
			echo '</form>';
			echo '</fieldset>';
		}
	}
	
	FLog::RegisterAdminPage('rcblog.colors', 'RCBlog Colors', array('Plugin_RCBlog_Colors', 'colors_process'), array('Plugin_RCBlog_Colors', 'colors_display'));
	if(!isset($GLOBALS['FLog_strings']['en']['admin.menu.rcblog'])) $GLOBALS['FLog_strings']['en']['admin.menu.rcblog'] = 'RCBlog';
	if(!isset($GLOBALS['FLog_strings']['en']['admin.menu.rcblog.colors'])) $GLOBALS['FLog_strings']['en']['admin.menu.rcblog.colors'] = 'Colors';

?>