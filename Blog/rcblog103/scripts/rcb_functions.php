<?php

	// RCBlog - scripts/rcb_functions.php
	// ------------------------------------------------
	// Created by Noah Medling <noah.medling@gmail.com>

	// CONFIG VARS -------------------------------------------------------------

	$rcb_sitetitle   = 'RCBlog';
	$rcb_title       = 'RCBlog';
	$rcb_description = 'A free blog script';
	$rcb_keywords    = 'blog, rcblog, rcb, rc, rabidcow, free';
	$rcb_footer      = '&copy; Noah Medling';
	$rcb_recent      = '3';
	$rcb_dateformat  = '%Y-%m-%d @ %H:%M:%S';
	$rcb_menuformat  = '%Y-%m-%d';
	$rcb_offset      = '0';
	$rcb_colors      = array(0 => "ddcc88");
	$rcb_showmenu    = 'yes';

	// FILE I/O ----------------------------------------------------------------

	function rcb_readfile($filename){
		ignore_user_abort(1);
		$result = false;
		clearstatcache();
		if(file_exists($filename)){
			if($file = @fopen($filename, 'r')){
				$result = @fread($file, filesize($filename));
				@fclose($file);
			}
		}
		ignore_user_abort(0);
		return $result;
	}

	function rcb_readlock($filename){
		ignore_user_abort(1);
		$lockfile = $filename . '.lock';
		$result = false;
		
		if(file_exists($lockfile)){
			if(time()-filemtime($lockfile)>5) unlink($lockfile);
		}
		
		$lock_ex = @fopen($lockfile, 'x');
		for($i=0; $lock_ex === false && $i<20; $i++){
			clearstatcache();
			usleep(rand(9, 999));
			$lock_ex = @fopen($lockfile, 'x');
		}
		
		if(file_exists($filename)){
			if($file = @fopen($filename, 'r')){
				$result = @fread($file, filesize($filename));
				@fclose($file);
				fclose($lock_ex);
				unlink($lockfile);
			}
		}
		
		ignore_user_abort(0);
		return $result;
	}

	function rcb_writefile($filename, $data){
		ignore_user_abort(1);
		$lockfile = $filename . '.lock';
		if(file_exists($lockfile)){
			if(time()-filemtime($lockfile)>5) unlink($lockfile);
		}
		$lock_ex = @fopen($lockfile, 'x');
		for($i=0; $lock_ex === false && $i<20; $i++){
			clearstatcache();
			usleep(rand(9, 999));
			$lock_ex = @fopen($lockfile, 'x');
		}
		$success = false;
		if($lock_ex !== false){
			$fp = @fopen($filename, 'w');
			if (@fwrite($fp, $data)) $success = true;
			@fclose($fp);
			fclose($lock_ex);
			unlink($lockfile);
		}
		ignore_user_abort(0);
		return $success;
	}

	function rcb_appendfile($filename, $data){
		ignore_user_abort(1);
		$lockfile = $filename . '.lock';
		if(file_exists($lockfile)){
			if(time()-filemtime($lockfile)>5) unlink($lockfile);
		}
		$lock_ex = @fopen($lockfile, 'x');
		for($i=0; $lock_ex === false && $i<20; $i++){
			clearstatcache();
			usleep(rand(9, 999));
			$lock_ex = @fopen($lockfile, 'x');
		}
		$success = false;
		if($lock_ex !== false){
			$fp = @fopen($filename, 'a');
			if (@fwrite($fp, $data)) $success = true;
			@fclose($fp);
			fclose($lock_ex);
			unlink($lockfile);
		}
		ignore_user_abort(0);
		return $success;
	}

	// returns a list of all files that in the
	// specified directory that match the pattern
	function rcb_dirlist($dirname, $pattern='/./'){
		$result = array();
		clearstatcache();
		if (is_dir($dirname)){
			if($dir = opendir($dirname)){
				while($filename = readdir($dir)){
					if(is_file($dirname . $filename)){
						if(preg_match($pattern, $filename)) $result[] = $filename;
					}
				}
				closedir($dir);
			}
		}
		natsort($result);
		return array_values($result);
	}

	// returns the number of files in a directory
	function rcb_countfiles($dirname){
		$result = 0;
		clearstatcache();
		if(is_dir($dirname)){
			if(($dir = @opendir($dirname))!==false){
				while($filename = readdir($dir)){
					if($filename != '..' && $filename != '.') $result++;
				}
				@closedir($dir);
			}
		}
		else $result = -1;
		return $result;
	}
	
	function rcb_formatsize($size){
		if($size<1024) return $size . ' B';
		$size /= 1024; if($size<1024) return number_format($size, 1, '.', ',') . ' KB';
		$size /= 1024; if($size<1024) return number_format($size, 1, '.', ',') . ' MB';
		$size /= 1024; return number_format($size, 1, '.', ',') . ' GB';
	}
	
	
	// pretty-print a filesize
	function rcb_filesize($filename){
		if(($size = filesize($filename))===false) return '?b';
		return rcb_formatsize($size);
	}


	function rcb_rmfile($filename){
		$result = NULL;
		if(file_exists($filename)){
			$result = unlink($filename);
		}
		return($result);
	}

	function sb_rmdir($dirname){
		$result = NULL;
		if(is_dir($dirname)){
			$result = rmdir($dirname);
		}
		return($result);
	}

	// UTILITY -----------------------------------------------------------------

	function rcb_convdate($date){
		global $rcb_menuformat, $rcb_offset;
		return strftime($rcb_menuformat, $date+(3600*$rcb_offset));
	}

	function rcb_convtime($time){
		global $rcb_dateformat, $rcb_offset;
		return strftime($rcb_dateformat, $time+(3600*$rcb_offset));
	}

	function rcb_striphtml($data){
		$patterns = array('/</', '/>/', '/"/');
		$replace = array('&lt;', '&gt;', '&quot;');
		return preg_replace($patterns, $replace, $data);
	}

	function rcb_stripall($data){
		return htmlspecialchars($data, ENT_NOQUOTES, 'UTF-8');
	}
	
	function rcb_blog2html($data){
		$patterns = array(
			"@(\r\n|\r|\n)?\\[\\*\\](\r\n|\r|\n)?(.*?)(?=(\\[\\*\\])|(\\[/list\\]))@s",
			
			// [b][/b], [i][/i], [u][/u], [mono][/mono]
			"@\\[b\\](.*?)\\[/b\\]@si",
			"@\\[i\\](.*?)\\[/i\\]@si",
			"@\\[u\\](.*?)\\[/u\\]@si",
			"@\\[mono\\](.*?)\\[/mono\\]@si",
			
			// [color=][/color], [size=][/size]
			"@\\[color=([^\\]\r\n]*)\\](.*?)\\[/color\\]@si",
			"@\\[size=([0-9]+)\\](.*?)\\[/size\\]@si",
			
			// [quote=][/quote], [quote][/quote], [code][/code]
			"@\\[quote=&quot;([^\r\n]*)&quot;\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/quote\\](\r\n|\r|\n)?@si",
			"@\\[quote\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/quote\\](\r\n|\r|\n)?@si",
			"@\\[code\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/code\\](\r\n|\r|\n)?@si",
			
			// [center][/center], [right][/right], [justify][/justify]
			"@\\[center\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/center\\](\r\n|\r|\n)?@si",
			"@\\[right\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/right\\](\r\n|\r|\n)?@si",
			"@\\[justify\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/justify\\](\r\n|\r|\n)?@si",
			
			// [list][*][/list], [list=][*][/list]
			"@\\[list\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=1\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)a)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)A)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)i)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)I)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
//			"@(\r\n|\r|\n)?\\[\\*\\](\r\n|\r|\n)?([^\\[]*)@s",
			
			// [url=][/url], [url][/url], [email][/email]
			"@\\[url=([^\\]\r\n]+)\\](.*?)\\[/url\\]@si",
			"@\\[url\\](.*?)\\[/url\\]@si",
			"@\\[urls=([^\\]\r\n]+)\\](.*?)\\[/urls\\]@si",
			"@\\[urls\\](.*?)\\[/urls\\]@si",
			"@\\[email\\](.*?)\\[/email\\]@si",
			"@\\[a=([^\\]\r\n]+)\\]@si",
			
			// [img][/img], [img=][/img], [clear]
			"@\\[img\\](.*?)\\[/img\\](\r\n|\r|\n)?@si",
			"@\\[imgl\\](.*?)\\[/imgl\\](\r\n|\r|\n)?@si",
			"@\\[imgr\\](.*?)\\[/imgr\\](\r\n|\r|\n)?@si",
			"@\\[img=([^\\]\r\n]+)\\](.*?)\\[/img\\](\r\n|\r|\n)?@si",
			"@\\[imgl=([^\\]\r\n]+)\\](.*?)\\[/imgl\\](\r\n|\r|\n)?@si",
			"@\\[imgr=([^\\]\r\n]+)\\](.*?)\\[/imgr\\](\r\n|\r|\n)?@si",
			"@\\[clear\\](\r\n|\r|\n)?@si",
			
			// [hr], \n
			"@\\[hr\\](\r\n|\r|\n)?@si",
			"@(\r\n|\r|\n)@si");
		
		$replace  = array(
			'<li>$3</li>',
			
		// [b][/b], [i][/i], [u][/u], [mono][/mono]
			'<b>$1</b>',
			'<i>$1</i>',
			'<span style="text-decoration:underline">$1</span>',
			'<span class="mono">$1</span>',
		
			// [color=][/color], [size=][/size]
			'<span style="color:$1">$2</span>',
			'<span style="font-size:$1px">$2</span>',

			// [quote][/quote], [code][/code]
			'<div class="quote"><span style="font-size:0.9em;font-style:italic">$1 wrote:<br /><br /></span>$3</div>',
			'<div class="quote">$2</div>',
			'<div class="code">$2</div>',
			
			// [center][/center], [right][/right], [justify][/justify]
			'<div style="text-align:center">$2</div>',
			'<div style="text-align:right">$2</div>',
			'<div style="text-align:justify">$2</div>',
			
			// [list][*][/list], [list=][*][/list]
			'<ul>$2</ul>',
			'<ol style="list-style-type:decimal">$2</ol>',
			'<ol style="list-style-type:lower-alpha">$2</ol>',
			'<ol style="list-style-type:upper-alpha">$2</ol>',
			'<ol style="list-style-type:lower-roman">$2</ol>',
			'<ol style="list-style-type:upper-roman">$2</ol>',
//			'<li />',
			
			// [url=][/url], [url][/url], [email][/email]
			'<a href="$1" rel="external">$2</a>',
			'<a href="$1" rel="external">$1</a>',
			'<a href="$1">$2</a>',
			'<a href="$1">$1</a>',
			'<a href="mailto:$1">$1</a>',
			'<a name="$1"></a>',
			
			// [img][/img], [img=][/img], [clear]
			'<img src="$1" alt="$1" />',
			'<img class="left" src="$1" alt="$1" />',
			'<img class="right" src="$1" alt="$1" />',
			'<img src="$1" alt="$2" title="$2" />',
			'<img class="left" src="$1" alt="$2" title="$2" />',
			'<img class="right" src="$1" alt="$2" title="$2" />',
			'<div style="clear:both"></div>',
			
			// [hr], \n
			'<hr />',
			'<br />');
		return preg_replace($patterns, $replace, rcb_striphtml($data));
	}

	function rcb_getip(){
		if(isset($_SERVER)){
			if(isSet($_SERVER['HTTP_X_FORWARDED_FOR'])) return $_SERVER['HTTP_X_FORWARDED_FOR'];
			elseif(isSet($_SERVER['HTTP_CLIENT_IP'])) return $_SERVER['HTTP_CLIENT_IP'];
			else return $_SERVER['REMOTE_ADDR'];
		}
		else{
			if(getenv('HTTP_X_FORWARDED_FOR')) return getenv('HTTP_X_FORWARDED_FOR');
			elseif(getenv('HTTP_CLIENT_IP')) return getenv('HTTP_CLIENT_IP');
			else return getenv('REMOTE_ADDR');
		}
	}

	// SESSION/LOGIN -----------------------------------------------------------
	
	function rcb_localurl($page){
		$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
		$c = substr($url, -1);
		if($c == '/' || $c == '\\') $url .= $page;
		else $url .= "/$page";
		return str_replace('\\', '/', $url);
	}

	function rcb_redirect($page){
		header("Location: ".rcb_localurl($page));
		exit;
	}

	function rcb_setlogin($user, $pass){
		return rcb_writefile('config/password.txt', md5($user)."\t".md5($pass));
	}

	function rcb_loggedin($redir){
		$id = '';
		if(isset($_COOKIE['rcb_id'])) $id = $_COOKIE['rcb_id'];
		if(($data = rcb_readfile('config/password.txt')) !== false){
			$parts = explode("\t", $data);
			$user = $parts[0]; $pass = $parts[1];
		}
		else{
			$user = md5('RCBlog'); $pass = md5('RCBlog');
			rcb_writefile('config/password.txt', "$user\t$pass");
		}
		$ip = md5(rcb_getip());
		$dir = md5(dirname($_SERVER['PHP_SELF']));
		if($id == $dir.$ip.$user.$pass) return true;
		if($redir){
			rcb_redirect('login.php?msg=mustlogin');
		}
		return false;
	}

	function rcb_login($username, $password){
		if(($data = rcb_readfile('config/password.txt')) !== false){
			$parts = explode("\t", $data);
			$user = $parts[0]; $pass = $parts[1];
		}
		else{
			$user = md5('RCBlog'); $pass = md5('RCBlog');
			rcb_writefile('config/password.txt', "$user\t$pass");
		}
		$ip = md5(rcb_getip());
		$dir = md5(dirname($_SERVER['PHP_SELF']));
		if(md5($username)==$user && md5($password)==$pass){
			setcookie('rcb_id', $dir.$ip.$user.$pass);
			return true;
		}
		return false;
	}

	function rcb_logout(){
		setcookie('rcb_id', '', time()-86400);
	}

	// NAVIGATION --------------------------------------------------------------

	function rcb_updatenav($post, $title){
		if(!file_exists('data/nav.txt')) return rcb_writefile('data/nav.txt', "$title\t$post\n");
		if($file=rcb_readfile('data/nav.txt')){
			$lines = preg_split("/(\r\n|\r|\n)/", $file);
			for($i=0; $i<count($lines); $i++){
				$parts=explode("\t", $lines[$i], 2);
				if(count($parts)<2) continue;
				if($parts[1]==$post) $lines[$i]="$title\t$post";
			}
			return rcb_writefile('data/nav.txt', implode("\n", $lines));
		}
		return false;
	}

	function rcb_removenav($post){
		if(!file_exists('data/nav.txt')) return true;
		if($file=rcb_readfile('data/nav.txt')){
			$lines = preg_split("/(\r\n|\r|\n)/", $file);
			for($i=0; $i<count($lines); $i++){
				$parts=explode("\t", $lines[$i], 2);
				if($parts[1]==$post){ array_splice($lines, $i, 1); $i--; }
			}
			return rcb_writefile('data/nav.txt', implode("\n", $lines));
		}
		return false;
	}

	function rcb_printnavstart(){
		echo "<td id=\"nav\">\n";
	}

	function rcb_printnavend(){
		echo "</td>\n";
	}

	function rcb_printnavigation(){
		echo "<div class=\"post\">\n";
		echo "<div class=\"navtitle\">Navigation</div>\n";
		echo "<div class=\"text\">";
		echo "<a href=\"index.php\">Home</a><br/>";
		if(($file = rcb_readfile('data/nav.txt'))!==false){
			$nav = preg_split("/(\r\n|\r|\n)/", $file);
			foreach($nav as $line){
				$line = rcb_striphtml(trim($line));
				if(strlen($line)<=0) continue;
				$pieces = explode("\t", $line, 2);
				if(count($pieces)==1) echo "<br/>$pieces[0]<br/>";
				else if($pieces[1]{0} == 'l'){
					echo "<a href=\"".substr($pieces[1],1)."\" rel=\"external\">$pieces[0]</a><br />";
				}
				else echo "<a href=\"index.php?post=$pieces[1]\">$pieces[0]</a><br/>";
			}
		}
		echo "</div>\n</div>\n";
	}

	function rcb_printmenu($loggedin){
		global $rcb_showmenu;
		if($loggedin){
			echo "<div class=\"post\">\n";
			echo "<div class=\"navtitle\">Menu</div>\n";
			echo "<div class=\"text\">";
			echo "<a href=\"login.php?action=logout\">Logout</a><br/>";
			echo "<br/>";
			echo "<a href=\"notes.php\">Notes</a><br/>";
			echo "<a href=\"files.php\">File Manager</a><br />";
			echo "<br/>";
			echo "<a href=\"post.php\">Add Blog Post</a><br/>";
			echo "<a href=\"post.php?type=static\">Add Static Post</a><br/>";
			echo "<a href=\"static.php\">Manage Static Posts</a><br/>";
			echo "<br/>";
			echo "<a href=\"config.php\">Configuration</a><br/>";
			echo "<a href=\"colors.php\">Set Colors</a><br/>";
			echo "<a href=\"newlogin.php\">Change Login</a><br/>";
			echo "</div>\n</div>\n";
		}
		elseif($rcb_showmenu && $rcb_showmenu != 'no'){
			echo "<div class=\"post\">\n";
			echo "<div class=\"navtitle\">Menu</div>\n";
			echo "<div class=\"text\">";
			echo "<a href=\"login.php\">Login</a><br/>";
			echo "</div>\n</div>\n";
		}
	}

	function rcb_printnavarchive($y=0, $m=0, $d=0){
		$posts = array_reverse(rcb_dirlist('data/', '/^[0-9]+\.txt$/'));
		if(count($posts)<1) return;

		echo "<div class=\"post\">\n";
		echo "<div class=\"navtitle\">Archive</div>\n";
		echo "<div class=\"text\">";

		$months=array("January", "February", "March", "April", "May", "June",
			"July", "August", "September", "October", "November", "December");

		$year = $month = $day = $count = 0;
		$days = array();
		foreach($posts as $post){
			$parts = explode('.', $post);
			$date  = getdate($parts[0]);
			if(($year != $date['year'] || $month != $date['mon']) && $count>0){
				echo "<a href=\"index.php?y=$year&amp;m=$month\">".$months[$month-1]."</a> ($count)<br/>";
				if(count($days)>0){
					foreach($days as $pday => $pcount){
						echo "&nbsp; &nbsp; &nbsp; ";
						if($d == $pday){
							echo "> ".rcb_striphtml(rcb_convdate(mktime(0,0,0,$month, $pday, $year)));
						}
						else{
							echo "<a href=\"index.php?y=$year&amp;m=$month&amp;d=$pday\">";
							echo rcb_striphtml(rcb_convdate(mktime(0,0,0,$month, $pday, $year)))."</a>";
						}
						echo " ($pcount)<br/>";
					}
				}
				$count=0;
				$days=array();
			}
			if($year != $date['year']) echo ($month==0?'':'<br/>'), "$date[year]<br/>";
			$year=$date['year']; $month=$date['mon']; $day=$date['mday'];
			$count++;
			if($year==$y && $month==$m){
				if(isset($days[$day])) $days[$day]++;
				else $days[$day] = 1;
			}
		}
		if($count>0){
			echo "<a href=\"index.php?y=$year&amp;m=$month\">".$months[$month-1]."</a> ($count)<br/>";
			if(count($days)>0){
				foreach($days as $pday => $pcount){
					echo "&nbsp; &nbsp; &nbsp; ";
					if($d == $pday){
						echo "> ".rcb_striphtml(rcb_convdate(mktime(0,0,0,$month, $pday, $year)));
					}
					else{
						echo "<a href=\"index.php?y=$year&amp;m=$month&amp;d=$pday\">";
						echo rcb_striphtml(rcb_convdate(mktime(0,0,0,$month, $pday, $year)))."</a>";
					}
					echo " ($pcount)<br/>";
				}
			}
		}
		echo "</div>\n</div>\n";
	}

	function rcb_printnavbanners($loggedin){
		echo "<div class=\"post\">\n";
		echo "<div class=\"text\" style=\"text-align:center\">\n";
		if($loggedin) echo "<div class=\"date\">[<a href=\"banners.php\">edit</a>]</div>\n";
		if($banners = rcb_readfile("data/banners.txt")) echo $banners;
		echo "<div style=\"font-size:9px\">";
		echo "powered by <a href=\"http://www.fluffington.com/\">RCBlog</a>";
		echo "</div>\n";
		echo "</div></div>\n";
	}
	
	function rcb_printnav($loggedin, $y=0, $m=0, $d=0){
		rcb_printnavstart();
		rcb_printnavigation();
		rcb_printnavarchive($y,$m,$d);
		rcb_printmenu($loggedin);
		rcb_printnavbanners($loggedin);
		rcb_printnavend();
	}

	// CONFIG ------------------------------------------------------------------

	function rcb_readconfig(){
		global $rcb_sitetitle, $rcb_title, $rcb_footer, $rcb_recent, $rcb_dateformat, $rcb_menuformat, $rcb_offset, $rcb_colors, $rcb_showmenu, $rcb_description, $rcb_keywords;
		if($file=rcb_readfile('config/config.txt')){
			$lines = preg_split("/(\r\n|\r|\n)/", $file);
			foreach($lines as $line){
				if($line[0]=='#') continue;
				$parts=explode("\t", $line, 2);
				switch($parts[0]){
					case 'sitetitle':   $rcb_sitetitle   = $parts[1]; break;
					case 'blogtitle':   $rcb_title       = $parts[1]; break;
					case 'footer':      $rcb_footer      = $parts[1]; break;
					case 'recentposts': $rcb_recent      = $parts[1]; break;
					case 'dateformat':  $rcb_dateformat  = $parts[1]; break;
					case 'menuformat':  $rcb_menuformat  = $parts[1]; break;
					case 'offset':      $rcb_offset      = $parts[1]; break;
					case 'color':
						$rcb_colors = explode("\t", $parts[1]);
					case 'showmenu':    $rcb_showmenu    = $parts[1]; break;
					case 'description': $rcb_description = $parts[1]; break;
					case 'keywords':    $rcb_keywords    = $parts[1]; break;
				}
			}
		}
	}

	function rcb_writeconfig(){
		global $rcb_sitetitle, $rcb_title, $rcb_footer, $rcb_recent, $rcb_dateformat, $rcb_menuformat, $rcb_offset, $rcb_colors, $rcb_showmenu, $rcb_description, $rcb_keywords;
		$lines = array(
			"sitetitle\t$rcb_sitetitle",
			"blogtitle\t$rcb_title",
			"footer\t$rcb_footer",
			"recentposts\t$rcb_recent",
			"dateformat\t$rcb_dateformat",
			"menuformat\t$rcb_menuformat",
			"offset\t$rcb_offset",
			"color\t" . implode("\t", $rcb_colors),
			"showmenu\t$rcb_showmenu",
			"description\t$rcb_description",
			"keywords\t$rcb_keywords"
			);
		return rcb_writefile('config/config.txt', implode("\n", $lines));
	}

	// HTML --------------------------------------------------------------------

	function rcb_printheader(){
		global $rcb_sitetitle, $rcb_title, $rcb_description, $rcb_keywords;
		header("Content-Type: text/html; charset=UTF-8");
		echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">\n";
		echo "<html>\n<head>\n";
		echo "<meta http-equiv=\"content-type\" content=\"text/html; charset=UTF-8\" />\n";
		echo "<meta name=\"description\" content=\"".rcb_striphtml($rcb_description)."\" />\n";
		echo "<meta name=\"keywords\" content=\"".rcb_striphtml($rcb_keywords)."\" />\n";
		echo "<title>".rcb_striphtml($rcb_sitetitle)."</title>\n";
		echo "<link rel=\"stylesheet\" href=\"css/base.css\" type=\"text/css\"/>\n";
		if($style = rcb_readfile("config/colors.css")){
			echo "<style type=\"text/css\">\n$style\n</style>\n";
		}
		else{
			echo "<link rel=\"stylesheet\" href=\"config/colors.css\" type=\"text/css\"/>\n";
		}
		echo "<link rel=\"shortcut icon\" href=\"favicon.ico\" type=\"image/x-icon\" />\n";
		echo "<script type=\"text/javascript\" src=\"scripts/rcb_javascript.js\"></script>\n";
		echo "</head>\n";
	}

	function rcb_printbodystart($focus=''){
		global $rcb_title;
		if(strlen($focus)>0) echo "<body onload=\"javascript:rcb_linkout();document.$focus.focus()\">\n";
		else echo "<body onload=\"javascript:rcb_linkout()\">\n";
		echo "<table id=\"frame\" cellspacing=\"0\">\n";
		echo "<tr><td colspan=\"2\" id=\"header\">".rcb_blog2html($rcb_title)."</td></tr>\n";
		echo "<tr>\n";
	}

	function rcb_printcontentstart(){
		echo "<td id=\"content\">\n";
	}

	function rcb_printcontentend(){
		echo "</td>\n";
	}

	function rcb_printbodyend(){
		global $rcb_footer;
		echo "</tr>\n";
		echo "<tr><td colspan=\"2\" id=\"footer\">".rcb_blog2html($rcb_footer)."</td></tr>\n</table>\n";
		echo "</body>\n</html>\n";
	}

	// POSTS -------------------------------------------------------------------

	function rcb_printcustompost($title, $content, $date=0){
		echo "<div class=\"post\">\n";
		echo "<div class=\"title\">".rcb_blog2html($title)."</div>\n";
		if($date>0) echo "<div class=\"date\">" . rcb_blog2html(rcb_convtime($date)) . "</div>\n";
		echo "<div class=\"text\">".rcb_blog2html($content)."</div>\n";
		echo "</div>\n";
	}

	function rcb_printpost($date, $admin){
		if(($post = rcb_readfile("data/$date.txt"))!==false){
			$parts = preg_split("/(\r\n|\r|\n)/", $post, 2);
			echo "<div class=\"post\">\n";
			echo "<div class=\"title\">" . rcb_blog2html($parts[0]) . "</div>\n";
			if($date[0]!='s') echo "<div class=\"date\">" . rcb_blog2html(rcb_convtime($date)) . "</div>\n";
			if($admin){
				echo "<div class=\"date\"><a href=\"edit.php?post=$date\">edit</a>";
				echo " | <a href=\"delete.php?post=$date\">delete</a></div>\n";
			}
			echo "<div class=\"text\">" . rcb_blog2html($parts[1]) . "</div>\n";
			echo "</div>\n";
			return true;
		}
		return false;
	}

	function rcb_printarchive($admin, $year=0, $month=0, $day=0){
		global $rcb_recent;
		$posts = array_reverse(rcb_dirlist('data/', '/^[0-9]+\.txt$/'));
		$count = 0;
		for($i=0; $i<count($posts) && ($count<$rcb_recent || $day>0); $i++){
			$parts = explode('.', $posts[$i], 2);
			$date = getdate($parts[0]);
			if(($year<1 || $date['year']==$year) &&
			($month<1 || $date['mon']==$month) &&
			($day<1 || $date['mday']==$day)){
				rcb_printpost($parts[0], $admin);
				$count++;
			}
		}
		if($count>0) return true;
		return false;
	}

	// FORMS -------------------------------------------------------------------

	function rcb_printformstart($name, $method, $action, $enctype=''){
		echo "<form id=\"$name\" method=\"$method\" accept-charset=\"UTF-8\" action=\"".rcb_localurl($action)."\"";
		if(strlen($enctype)>0) echo " enctype=\"$enctype\""; echo "><div>\n";
	}

	function rcb_printformhidden($name, $value=''){
		echo "<input name=\"$name\" type=\"hidden\" value=\"";
		echo rcb_stripall($value);
		echo "\"/>\n";
	}
	
	function rcb_printforminput($title, $name, $type, $size=20, $value=''){
		if(strlen($title)>0) echo "$title:<br/>";
		echo "<input name=\"$name\" size=\"$size\" type=\"$type\" value=\"";
		echo rcb_stripall($value);
		echo "\"/><br/><br/>\n";
	}

	function rcb_printforminputl($title, $name, $type, $size=20, $value=''){
		echo "<input name=\"$name\" size=\"$size\" type=\"$type\" value=\"";
		echo rcb_stripall($value);
		echo "\"/>";
		if(strlen($title)>0) echo " $title";
		echo "<br/>\n";
	}

	function rcb_printformtextarea($title, $name, $value=''){
		if(strlen($title)>0) echo "$title:<br/>";
		echo "<textarea name=\"$name\" cols=\"48\" rows=\"16\" wrap=\"soft\">";
		echo rcb_stripall($value);
		echo "</textarea><br/><br/>\n";
	}

	function rcb_printformbutton($title, $name, $type, $click=''){
		echo "<input name=\"$name\" type=\"$type\" value=\"$title\"";
		if(strlen($click)>0) echo " onclick=\"javascript:$click\""; echo "/>\n";
	}

	function rcb_printformend(){
		echo "</div></form>\n";
	}

	// STARTUP -----------------------------------------------------------------

	// antimagic_quotes
	if(get_magic_quotes_gpc()){ 
		foreach($_POST as $key => $val) $_POST[$key]=stripslashes($val);
		foreach($_GET as $key => $val) $_GET[$key]=stripslashes($val);
	//	foreach($_COOKIE as $key => $val) $_COOKIE[$key]=stripslashes($val);
	}

	rcb_readconfig();

?>
