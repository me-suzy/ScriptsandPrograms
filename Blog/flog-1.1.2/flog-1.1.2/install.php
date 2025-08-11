<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	if(isset($_SERVER['SCRIPT_URL']) && trim($_SERVER['SCRIPT_URL'])!=='') $_SERVER['SCRIPT_NAME'] = $_SERVER['SCRIPT_URL'];
 
	$versionerror = false;
	$v = explode('.', phpversion());
	$r = explode('.', '4.3.0');
	if(count($v) < count($r)) $versionerror = true;
	else{
		foreach($r as $key => $value){
			if((int)$v[$key] < (int)$value){ $versionerror = true; break; }
			elseif((int)$v[$key] > (int)$value) break;
		}
	}
	if($versionerror){
		if(!headers_sent()) header('content-type: text/html');
		echo '<html><head><title>ERROR!</title></head><body>ERROR: FLog requires at least version 4.3.3 of PHP. Your server is running version ', htmlspecialchars(phpversion()), '.</body></html>';
		exit();
	}

	clearstatcache();
	if(get_magic_quotes_gpc()){
		foreach(array_keys($_GET) as $key) $_GET[$key] = stripslashes($_GET[$key]);
		foreach(array_keys($_POST) as $key) $_POST[$key] = stripslashes($_POST[$key]);
		foreach(array_keys($_COOKIE) as $key) $_COOKIE[$key] = stripslashes($_COOKIE[$key]);
	}
	set_magic_quotes_runtime(0);

	if(isset($_POST['step2'])) $step = 2;
	elseif(isset($_POST['step3'])) $step = 3;
	elseif(isset($_POST['step4'])) $step = 4;
	elseif(isset($_POST['step5'])) $step = 5;
	else $step = 1;
	
	$error = '';
	
	if($step == 5){
		if(!@is_dir($_POST['dir_data'])){ $error .= '<p style="color:#f00;">Could not access Data directory.</p>'."\n"; $step = 4; }
		if(!@is_dir($_POST['dir_include'])){ $error .= '<p style="color:#f00;">Could not access Include directory.</p>'."\n"; $step = 4; }
		if(!@is_dir($_POST['dir_plugins'])){ $error .= '<p style="color:#f00;">Could not access Plugins directory.</p>'."\n"; $step = 4; }
		if(!@is_dir($_POST['dir_themes'])){ $errro .= '<p style="color:#f00;">Could not access Themes directory.</p>'."\n"; $step = 4; }
		if(!@is_dir($_POST['dir_files'])){ $error .= '<p style="color:#f00;">Could not access Files directory.</p>'."\n"; $step = 4; }
		if(($rcb = (trim($_POST['dir_rcblog'])!=='')) && !@is_dir($_POST['dir_rcblog'])){ $error .= '<p style="color:#f00;">Could not access RCBlog Data directory.</p>'."\n"; $step = 4; }
		if($step == 5){
			$abort = ignore_user_abort(true);
			$FLog_dir_plugins = $_POST['dir_plugins'];
			$FLog_dir_data    = $_POST['dir_data'];
			$FLog_dir_themes  = $_POST['dir_themes'];
			$FLog_dir_include = $_POST['dir_include'];
			$FLog_dir_files   = $_POST['dir_files'];
			if(!@include_once($FLog_dir_include . 'core.inc.php')){ $error .= '<p style="color:#f00;">Could not read from Data directory.</p>'."\n"; $step = 4; }
			else{
				$configfile = "<?php\n";
				$configfile .= " \$FLog_dir_plugins = '$FLog_dir_plugins';\n";
				$configfile .= " \$FLog_dir_data    = '$FLog_dir_data';\n";
				$configfile .= " \$FLog_dir_themes  = '$FLog_dir_themes';\n";
				$configfile .= " \$FLog_dir_include = '$FLog_dir_include';\n";
				$configfile .= " \$FLog_dir_files   = '$FLog_dir_files';\n";
				$configfile .= " require_once(\$FLog_dir_include.'core.inc.php');\n";
				$configfile .= "?>";
				$configok = FLog::WriteFile('config.php', $configfile);
				
				$users = new FLog_Database;
				$posts = new FLog_Database;
				$comments = new FLog_Database;
				$cats = new FLog_Database;
				$links = new FLog_Database;
				$pages = new FLog_Database;
				$config = new FLog_Config;
				if($users->Load('users', true) && $posts->Load('posts', true) && $comments->Load('comments', true) && $cats->Load('cats', true) && $links->Load('links', true) && $pages->Load('pages', true) && $config->Load('flog', true)){
					foreach(array_keys($users->records) as $key) $users->DeleteRecord($key);
					foreach(array_keys($posts->records) as $key) $posts->DeleteRecord($key);
					foreach(array_keys($comments->records) as $key) $comments->DeleteRecord($key);
					foreach(array_keys($cats->records) as $key) $cats->DeleteRecord($key);
					foreach(array_keys($links->records) as $key) $links->DeleteRecord($key);
					foreach(array_keys($pages->records) as $key) $pages->DeleteRecord($key);
					
					$users->fields = array('username', 'password');
					$user = new FLog_DatabaseRecord();
					$user->SetValue('username', $_POST['user_username']);
					$user->SetValue('password', $_POST['user_password']);
					$user->SetValue('rank', 1);
					$user->SetValue('name', $_POST['user_name']);
					$user->SetValue('email', $_POST['user_email']);
					$user->SetValue('url', $_POST['user_url']);
					$users->InsertRecord($user);
					
					$posts->fields = array('title', 'author', 'time', 'cats', 'comments', 'allowcomments', 'delay', 'draft');
					$post = new FLog_DatabaseRecord();
					$post->SetValue('title', 'Congratulations!');
					$post->SetValue('author', $user->rid);
					$post->SetValue('time', FLog::ServerTime());
					$post->SetValue('cats', '');
					$post->SetValue('comments', 1);
					$post->SetValue('allowcomments', 1);
					$post->SetValue('delay', 0);
					$post->SetValue('draft', 0);
					$post->SetValue('markup', '');
					$post->SetValue('text', '<p>Welcome to FLog. This is your first post. Edit or delete it, then start blogging!</p>');
					$posts->InsertRecord($post);
					
					$comments->fields = array('post', 'time', 'moderated', 'name', 'email', 'ip');
					$comment = new FLog_DatabaseRecord();
					$comment->SetValue('post', $post->rid);
					$comment->SetValue('time', FLog::ServerTime());
					$comment->SetValue('moderated', 0);
					$comment->SetValue('name', $user->GetValue('name'));
					$comment->SetValue('email', $user->GetValue('email'));
					$comment->SetValue('url', $user->GetValue('url'));
					$comment->SetValue('ip', $_SERVER['REMOTE_ADDR']);
					$comment->SetValue('markup', '');
					$comment->SetValue('text', '<p>This is a comment.</p>');
					$comments->InsertRecord($comment);
					
					$pages->fields = array('id', 'title');
					
					$cats->fields = array('name', 'links', 'posts');
					
					$links->fields = array('title', 'author', 'time', 'cats', 'sticky');

					$config->SetValue('blog.name', $_POST['blog_name']);
					$config->SetValue('blog.tagline', $_POST['blog_tagline']);
					$config->SetValue('blog.footer', $_POST['blog_footer']);
					$config->SetValue('blog.language', 'en');
					$config->SetValue('meta.author', $_POST['user_name']);
					$config->SetValue('meta.description', '');
					$config->SetValue('meta.keywords', 'FLog');
					$config->SetValue('time.offset', (float)$_POST['blog_offset']);
					$config->SetValue('time.dateformat', 'Y-m-d');
					$config->SetValue('time.timeformat', 'g:i a');
					$config->SetValue('comments.markup', '?');
					$config->SetValue('comments.staletimeout', 0);
					$config->SetValue('comments.oldtimeout', 90);
					$config->SetValue('comments.anonymous', 1);
					$config->SetValue('comments.blockip', 1);
					$config->SetValue('comments.blockreferrer', 1);
					$config->SetValue('comments.modall', 0);
					$config->SetValue('comments.modrepeat', 1);
					$config->SetValue('comments.emailmod', 1);
					$config->SetValue('comments.emailall', 0);
					$config->SetValue('comments.maxsize', 1024);
					$config->SetValue('display.postsort', 'desc');
					$config->SetValue('display.commentsort', 'asc');
					$config->SetValue('display.linksort', 'desc');
					$config->SetValue('display.linktype', 'all');
					$config->SetValue('display.numposts', 5);
					$config->SetValue('display.feedposts', 5);
					$config->SetValue('display.numlinks', 5);
					$config->SetValue('display.feedlinks', 5);
					$config->SetValue('permissions.plugins', 1);
					$config->SetValue('permissions.themes', 1);
					$config->SetValue('permissions.write.posts', 0);
					$config->SetValue('permissions.write.pages', 0);
					$config->SetValue('permissions.manage.posts', 0);
					$config->SetValue('permissions.manage.pages', 0);
					$config->SetValue('permissions.manage.links', 2);
					$config->SetValue('permissions.manage.comments', 0);
					$config->SetValue('permissions.manage.categories', 2);
					$config->SetValue('permissions.manage.users', 2);
					$config->SetValue('permissions.manage.files', 1);
					$config->SetValue('permissions.config.general', 2);
					$config->SetValue('permissions.config.display', 2);
					$config->SetValue('permissions.config.discussion', 2);
					$config->SetValue('permissions.config.permissions', 1);
					
					$rcbok = true;
					if($rcb){
						$rcbdir = $_POST['dir_rcblog'];
						if(($dir = @opendir($rcbdir))!==false){
							while(($filename = @readdir($dir))!==false){
								if(preg_match('/^(s[0-9]+).txt$/', $filename, $matches)){
									if(($f = FLog::ReadFile($rcbdir.$filename,true))!==false){
										$t = array_splice($f, 0, 1);
										$page = new FLog_DatabaseRecord;
										$page->SetValue('title', $t[0]);
										$page->SetValue('markup', 'rcb_bbcode');
										$page->SetValue('id', $matches[1]);
										$page->SetValue('text', implode("\n", $f));
										$pages->InsertRecord($page);
									}
									else $rcbok = false;
								}
								elseif(preg_match('/^([0-9]+).txt$/', $filename, $matches)){
									if(($f = FLog::ReadFile($rcbdir.$filename,true))!==false){
										$t = array_splice($f, 0, 1);
										$post = new FLog_DatabaseRecord;
										$post->SetValue('title', $t[0]);
										$post->SetValue('markup', 'rcb_bbcode');
										$post->SetValue('text', implode("\n", $f));
										$post->SetValue('time', (int)$matches[1]);
										$post->SetValue('allowcomments', 0);
										$post->SetValue('comments', 0);
										$post->SetValue('draft', 0);
										$post->SetValue('delay', 0);
										$post->SetValue('author', $user->rid);
										$post->SetValue('cats', '');
										$posts->InsertRecord($post);
									}
									else $rcbok = false;
								}
							}
						}
						else $rcbok = false;
						
						if(($f = FLog::ReadFile($rcbdir.'nav.txt',true))!==false){
							$nav = array();
							$max = 0;
							foreach($f as $line){
								if(trim($line)==='') continue;
								$l = explode("\t", $line, 2);
								if(isset($l[1])){
									if(substr($l[1],0,1)==='l') $nav[] = array('id'=>'L'.(string)(++$max), 'type'=>'L', 'title'=>$l[0], 'url'=>substr($l[1],1));
									else $nav[] = array('id'=>(string)$pages->FindRecord('id',$l[1]), 'type'=>'P', 'title'=>$l[0], 'pid'=>$l[1]);
								}
								else $nav[] = array('id'=>'S'.(string)(++$max), 'type'=>'S', 'title'=>$l[0]);
							}
							$pages->records[FLog::EncodePageIndex($pages, $nav)]->SetValue('max', $max);
						}
						else $rcbok = false;
					}
					
					if($users->Save() && $posts->Save() && $comments->Save() && $pages->Save() && $cats->Save() && $links->Save() && $config->Save()){
						ignore_user_abort($abort);
						$url = '?success';
						if(!$rcbok) $url .= '&rcbfail';
						if(!$configok) $url .= '&file='.rawurlencode($configfile);
						FLog::LoadPlugins(array('rcblog_bbcode'));
						FLog::Redirect($url);
					}
				}
				$users->Unlock();
				$posts->Unlock();
				$comments->Unlock();
				$pages->Unlock();
				$cats->Unlock();
				$links->Unlock();
				$config->Unlock();
				if(!$configok) $error .= '<p style="color:#f00;">Could not write to config.php.</p>'."\n";
				$error .= '<p style="color:#f00;">Could not write to data directory.</p>'."\n"; $step = 4;
			}
			ignore_user_abort($abort);
		}
	}

	if(strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')!==false) header('content-type: application/xhtml+xml; charset=utf-8');
	else header('content-type: text/html; charset=utf-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />
<meta name="robots" content="noindex,nofollow" />
<title>FLog - Install</title>
</head>
<body style="background:#fff;color:#000;font: 16px/18px Georgia, 'Times New Roman', Times, serif; text-align:center;margin:0;padding:0;">
<div style="width:35em;max-width:100%;margin:1em auto;text-align:left;">
<div style="margin-bottom:1em;padding: 1em; border-bottom: 1px solid #000;">
<h1 style="font-weight: normal; font-size: 200%; font-variant: small-caps; margin: 0; padding: 0;">FLog Installer</h1>
</div>
<?php
	echo $error;
	if(isset($_GET['success'])){
		$urlbase = htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
		if(substr($urlbase, -1)!=='/') $urlbase .= '/';
		$url1 = $urlbase.'index.php'; $url2 = $urlbase.'admin.php';
		echo '<p>Congratulations! You have successfully installed FLog.</p>',"\n";
		if(isset($_GET['rcbfail'])) echo '<p>The installer encountered an error while reading your RCBlog data. You may want to check your directory name and permissions, and <a href="',htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']),'">try again</a>.</p>',"\n";
		if(isset($_GET['file'])) echo '<p>Before logging into your new blog, you first need to create a file named <kbd>config.php</kbd>, in the same directory as this file, <kbd>index.php</kbd>, and <kbd>admin.php</kbd>. <label>It should contain the following code:<br /><textarea readonly="readonly" rows="8" cols="50">',htmlspecialchars($_GET['file']),'</textarea></label></p>',"\n";
		echo '<p>The front page of your new blog can be found here:<br /><kbd><a href="',$url1,'">',$url1,'</a></kbd></p>',"\n";
		echo '<p>The administration section can be found here:<br /><kbd><a href="',$url2,'">',$url2,'</a></kbd></p>',"\n";
		echo '<p>Be sure to delete this file (<kbd>',htmlspecialchars(basename($_SERVER['SCRIPT_NAME'])),'</kbd>), otherwise someone else might be able to use it to erase your data.</p>',"\n";
	}
	else{
		echo '<form method="post" action="">',"\n";
		HiddenFields($step);
		
		if($step == 1){
			echo '<fieldset style="border:1px solid #bcd;padding:1em;"><legend style="font-variant:small-caps;color:#000;">Step 1: Directories</legend>',"\n";
			echo '<p>Here, you must specify where FLog should look for other files. If you like the defaults, you shouldn&#8217;t have to do anything here. If, however, you would FLog to store its files elsewhere, you may specify the new locations here. Before continuing, be sure that you have included the trailing forward slash (<kbd>/</kbd>), that all of these directories exist, and that the data directory is writable by PHP (<code>chmod 777</code>).</p>',"\n";
			echo '<p><label>Data:<br /><input type="text" size="40" name="dir_data" value="',isset($_POST['dir_data'])?htmlspecialchars($_POST['dir_data']):'data/','" /></label></p>',"\n";
			echo '<p><label>Include:<br /><input type="text" size="40" name="dir_include" value="',isset($_POST['dir_include'])?htmlspecialchars($_POST['dir_include']):'include/','" /></label></p>',"\n";
			echo '<p><label>Plugins:<br /><input type="text" size="40" name="dir_plugins" value="',isset($_POST['dir_plugins'])?htmlspecialchars($_POST['dir_plugins']):'plugins/','" /></label></p>',"\n";
			echo '<p><label>Themes:<br /><input type="text" size="40" name="dir_themes" value="',isset($_POST['dir_themes'])?htmlspecialchars($_POST['dir_themes']):'themes/','" /></label></p>',"\n";
			echo '<p><label>Files:<br /><input type="text" size="40" name="dir_files" value="',isset($_POST['dir_files'])?htmlspecialchars($_POST['dir_files']):'files/','" /></label></p>',"\n";
			echo '<p><label>RCBlog Data Directory (leave this blank to skip importing from RCBlog):<br /><input type="text" size="40" name="dir_rcblog" value="',isset($_POST['dir_rcblog'])?htmlspecialchars($_POST['dir_rcblog']):'','" /></label></p>',"\n";
			echo '</fieldset>',"\n";
			echo '<p style="float:right;text-align:right;"><input type="submit" name="step2" value="Next &#187;" /></p>',"\n";
		}
		elseif($step == 2){
			echo '<fieldset style="border:1px solid #bcd;padding:1em;"><legend style="font-variant:small-caps;color:#000;">Step 2: Default User</legend>',"\n";
			echo '<p>Please enter the information for the default user. This user outranks all others and has access to all areas of FLog. The username must be between 2 and 16 (inclusive) characters long, consisting only of alphanumeric characters (<kbd>a</kbd>&#8211;<kbd>z</kbd>, <kbd>A</kbd>&#8211;<kbd>Z</kbd>, <kbd>0</kbd>&#8211;<kbd>9</kbd>), hyphens(<kbd>-</kbd>), and underscores(<kbd>_</kbd>).</p>',"\n";
			echo '<p><label>Username:<br /><input type="text" size="40" name="user_username" value="',isset($_POST['user_username'])?htmlspecialchars($_POST['user_username']):'admin','" /></label></p>',"\n";
			echo '<p><label>Password (twice):<br /><input type="password" size="40" name="user_password1" value="" /></label><br /><input type="password" size="40" name="user_password2" value="" /></p>',"\n";
			echo '<p><label>Real Name (optional):<br /><input type="text" size="40" name="user_name" value="',isset($_POST['user_name'])?htmlspecialchars($_POST['user_name']):'Administrator','" /></label></p>',"\n";
			echo '<p><label>E-mail (optional):<br /><input type="text" size="40" name="user_email" value="',isset($_POST['user_email'])?htmlspecialchars($_POST['user_email']):htmlspecialchars('admin@'.$_SERVER['HTTP_HOST']),'" /></label></p>',"\n";
			echo '<p><label>URL:<br /><input type="text" size="40" name="user_url" value="',isset($_POST['user_url'])?htmlspecialchars($_POST['user_url']):htmlspecialchars('http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']).'/'),'" /></label></p>',"\n";
			echo '</fieldset>',"\n";
			echo '<p style="float:right;text-align:right;"><input type="submit" name="step3" value="Next &#187;" /></p>',"\n";
			echo '<p style="float:left;text-align:left;"><input type="submit" name="step1" value="&#171; Back" /></p>',"\n";
		}
		elseif($step == 3){
			echo '<fieldset style="border:1px solid #bcd;padding:1em;"><legend style="font-variant:small-caps;color:#000;">Step 3: Blog Settings</legend>',"\n";
			echo '<p>Now for some general settings, such as your timezone and the name of your blog. All of these can be changed later.</p>',"\n";
			echo '<p><label>Blog Name:<br /><input type="text" size="40" name="blog_name" value="',isset($_POST['blog_name'])?htmlspecialchars($_POST['blog_name']):'FLog','" /></label></p>', "\n";
			echo '<p><label>Tagline:<br /><input type="text" size="40" name="blog_tagline" value="',isset($_POST['blog_tagline'])?htmlspecialchars($_POST['blog_tagline']):'Fluffington\'s Weblog','" /></label></p>', "\n";
			echo '<p><label>Footer:<br /><input type="text" size="40" name="blog_footer" value="',isset($_POST['blog_footer'])?htmlspecialchars($_POST['blog_footer']):'&#38;copy;2005 Noah Medling','" /></label></p>', "\n";
			echo '<p><label>Offset from <acronym title="Coordinated Universal Time">UTC</acronym> (in hours, current UTC is ',gmdate('Y-m-d G:i:s'),'):<br /><input type="text" size="40" name="blog_offset" value="',isset($_POST['blog_offset'])?(float)$_POST['blog_offset']:0,'" /></label></p>',"\n";
			echo '</fieldset>',"\n";
			echo '<p style="float:right;text-align:right;"><input type="submit" name="step4" value="Next &#187;" /></p>',"\n";
			echo '<p style="float:left;text-align:left;"><input type="submit" name="step2" value="&#171; Back" /></p>',"\n";
		}
		elseif($step == 4){
			echo '<fieldset style="border:1px solid #bcd;padding:1em;"><legend style="font-variant:small-caps;color:#000;">Step 4: Review</legend>',"\n";
			echo '<p>Here are the settings you provided. Please review them before continuing. If any settings are incorrect, go back and correct them.</p>', "\n";
			echo '<p>Data Directory: <kbd>',htmlspecialchars($_POST['dir_data']),'</kbd></p>', "\n";
			echo '<p>Include Directory: <kbd>',htmlspecialchars($_POST['dir_include']),'</kbd></p>', "\n";
			echo '<p>Plugins Directory: <kbd>',htmlspecialchars($_POST['dir_plugins']),'</kbd></p>', "\n";
			echo '<p>Themes Directory: <kbd>',htmlspecialchars($_POST['dir_themes']),'</kbd></p>', "\n";
			echo '<p>Files Directory: <kbd>',htmlspecialchars($_POST['dir_files']),'</kbd></p>', "\n";
			if(trim($_POST['dir_rcblog']!=='')) echo '<p>RCBlog Data Directory: <kbd>',htmlspecialchars($_POST['dir_rcblog']),'</kbd></p>', "\n";
			echo '<p>Username: <kbd>',htmlspecialchars($_POST['user_username']),'</kbd></p>', "\n";
			echo '<p>Real Name: ', SafeEntities($_POST['user_name']), '</p>', "\n";
			echo '<p>E-mail: <kbd><a href="mailto:', htmlspecialchars($_POST['user_email']), '">', htmlspecialchars($_POST['user_email']), '</a></kbd></p>', "\n";
			echo '<p>URL: <kbd><a href="', htmlspecialchars($_POST['user_url']), '">', htmlspecialchars($_POST['user_url']), '</a></kbd></p>', "\n";
			echo '<p>Blog Name: ', SafeEntities($_POST['blog_name']), '</p>', "\n";
			echo '<p>Tagline: ', SafeEntities($_POST['blog_tagline']), '</p>', "\n";
			echo '<p>Footer: ', SafeEntities($_POST['blog_footer']), '</p>', "\n";
			echo '<p>Time Offset: <kbd>', (float)$_POST['blog_offset'], '</kbd> (current local time is ', gmdate('Y-m-d G:i:s', time()+(float)$_POST['blog_offset']*3600),')</p>', "\n";
			echo '</fieldset>',"\n";
			echo '<p style="float:right;text-align:right;"><input type="submit" name="step5" value="Next &#187;" /></p>',"\n";
			echo '<p style="float:left;text-align:left;"><input type="submit" name="step3" value="&#171; Back" /></p>',"\n";
		}
		echo '</form>',"\n";
	}
?>
<div style="clear:both;margin-top:1em;padding:1em;border-top:1px solid #000;text-align:center;"><a href="http://www.fluffington.com/">FLog</a> &#169;2005 Noah Medling</div>
</div>
</body>
</html>
<?php
	function SafeEntities($data, $quote_style=ENT_COMPAT){
		static $entities = array(
			'nbsp', 'iexcl', 'cent', 'pound', 'curren', 'yen', 'brvbar', 'sect', 'uml', 'copy', 'ordf', 'laquo', 'not', 'shy', 'reg', 'macr', 'deg', 'plusmn', 'sup2', 'sup3', 'acute', 'micro', 'para', 'middot',
			'cedil', 'sup1', 'ordm', 'raquo', 'frac14', 'frac12', 'frac34', 'iquest', 'Agrave', 'Aacute', 'Acirc', 'Atilde', 'Auml', 'Aring', 'AElig', 'Ccedil', 'Egrave', 'Eacute', 'Ecirc', 'Euml', 'Igrave', 'Iacute', 'Icirc', 'Iuml',
			'ETH', 'Ntilde', 'Ograve', 'Oacute', 'Ocirc', 'Otilde', 'Ouml', 'times', 'Oslash', 'Ugrave', 'Uacute', 'Ucirc', 'Uuml', 'Yacute', 'THORN', 'szlig', 'agrave', 'aacute', 'acirc', 'atilde', 'auml', 'aring', 'aelig', 'ccedil',
			'egrave', 'eacute', 'ecirc', 'euml', 'igrave', 'iacute', 'icirc', 'iuml', 'eth', 'ntilde', 'ograve', 'oacute', 'ocirc', 'otilde', 'ouml', 'divide', 'oslash', 'ugrave', 'uacute', 'ucirc', 'uuml', 'yacute', 'thorn', 'yuml',
			'quot', 'amp', 'lt', 'gt', 'apos', 'OElig', 'oelig', 'Scaron', 'scaron', 'Yuml', 'circ', 'tilde', 'ensp', 'emsp', 'thinsp', 'zwnj', 'zwj', 'lrm', 'rlm', 'ndash', 'mdash', 'lsquo', 'rsquo', 'sbquo',
			'ldquo', 'rdquo', 'bdquo', 'dagger', 'Dagger', 'permil', 'lsaquo', 'rsaquo', 'euro', 'fnof', 'Alpha', 'Beta', 'Gamma', 'Delta', 'Epsilon', 'Zeta', 'Eta', 'Theta', 'Iota', 'Kappa', 'Lambda', 'Mu', 'Nu', 'Omicron',
			'Pi', 'Rho', 'Sigma', 'Tau', 'Upsilon', 'Phi', 'Chi', 'Psi', 'Omega', 'alpha', 'beta', 'gamma', 'delta', 'epsilon', 'zeta', 'eta', 'theta', 'iota', 'kappa', 'lambda', 'mu', 'nu', 'omicron', 'pi',
			'rho', 'sigmaf', 'sigma', 'tau', 'upsilon', 'phi', 'chi', 'psi', 'omega', 'thetasym', 'upsih', 'piv', 'bull', 'hellip', 'prime', 'Prime', 'oline', 'frasl', 'weierp', 'image', 'real', 'trade', 'alefsym', 'larr',
			'uarr', 'rarr', 'darr', 'harr', 'crarr', 'lArr', 'uArr', 'rArr', 'dArr', 'hArr', 'forall', 'part', 'exist', 'empty', 'nabla', 'isin', 'notin', 'ni', 'prod', 'sum', 'minus', 'lowast', 'radic', 'prop',
			'infin', 'ang', 'and', 'or', 'cap', 'cup', 'int', 'there4', 'sim', 'cong', 'asymp', 'ne', 'equiv', 'le', 'ge', 'sub', 'sup', 'nsub', 'sube', 'supe', 'oplus', 'otimes', 'perp', 'sdot',
			'lceil', 'rceil', 'lfloor', 'rfloor', 'lang', 'rang', 'loz', 'spades', 'clubs', 'hearts', 'diams',
		);
		$offset = 0;
		$result = '';
		while(($apos = strpos($data, '&', $offset))!==false){
			if(($spos = strpos($data, ';', $apos + 1))!==false){
				$entity = (string)@substr($data, $apos + 1, $spos - $apos - 1);
				$ok = true;
				if(substr($entity, 0, 1) === '#'){
					if(substr($entity, 0, 2) === '#x'){
						$num = hexdec(@substr($entity, 2));
						if($num < 32 || $num > 65533) $ok = false;
					}
					else{
						$num = (int)@substr($entity, 1);
						if($num < 32 || $num > 65533) $ok = false;
					}
				}
				elseif(!in_array($entity, $entities)) $ok = false;
				if($ok) $result .= htmlspecialchars(substr($data, $offset, $apos - $offset), $quote_style) . '&' . $entity . ';';
				else $result .= htmlspecialchars(substr($data, $offset, $spos - $offset + 1), $quote_style);
				$offset = $spos + 1;
			}
			else break;
		}
		$result .= htmlspecialchars(substr($data, $offset), $quote_style);
		return $result;
	}
	
	function HiddenFields(&$step){
		if(isset($_POST['user_username'], $_POST['user_password1'], $_POST['user_password2'])){
			if(!preg_match('/^[a-z0-9\-_]{2,16}$/', $_POST['user_username'])){ echo '<p style="color:#f00;">Invalid username.</p>',"\n"; $step = 2; }
			if($_POST['user_password1'] === ''){ echo '<p style="color:#f00;">You must enter a password.</p>',"\n"; $step = 2; }
			elseif($_POST['user_password1'] !== $_POST['user_password2']){ echo '<p style="color:#f00;">Passwords do not match.</p>',"\n"; $step = 2; }
			else $_POST['user_password'] = md5($_POST['user_password1']);
		}
		if($step != 1){
			if(isset($_POST['dir_data'])) echo '<input type="hidden" name="dir_data" value="',htmlspecialchars($_POST['dir_data']),'" />',"\n";
			if(isset($_POST['dir_include'])) echo '<input type="hidden" name="dir_include" value="',htmlspecialchars($_POST['dir_include']),'" />',"\n";
			if(isset($_POST['dir_plugins'])) echo '<input type="hidden" name="dir_plugins" value="',htmlspecialchars($_POST['dir_plugins']),'" />',"\n";
			if(isset($_POST['dir_themes'])) echo '<input type="hidden" name="dir_themes" value="',htmlspecialchars($_POST['dir_themes']),'" />',"\n";
			if(isset($_POST['dir_files'])) echo '<input type="hidden" name="dir_files" value="',htmlspecialchars($_POST['dir_files']),'" />',"\n";
			if(isset($_POST['dir_rcblog'])) echo '<input type="hidden" name="dir_rcblog" value="',htmlspecialchars($_POST['dir_rcblog']),'" />',"\n";
		}
		if($step != 2){
			if(isset($_POST['user_username'])) echo '<input type="hidden" name="user_username" value="',htmlspecialchars($_POST['user_username']),'" />',"\n";
			if(isset($_POST['user_password'])) echo '<input type="hidden" name="user_password" value="',htmlspecialchars($_POST['user_password']),'" />',"\n";
			if(isset($_POST['user_name'])) echo '<input type="hidden" name="user_name" value="',htmlspecialchars($_POST['user_name']),'" />',"\n";
			if(isset($_POST['user_email'])) echo '<input type="hidden" name="user_email" value="',htmlspecialchars($_POST['user_email']),'" />',"\n";
			if(isset($_POST['user_url'])) echo '<input type="hidden" name="user_url" value="',htmlspecialchars($_POST['user_url']),'" />',"\n";
		}
		if($step != 3){
			if(isset($_POST['blog_name'])) echo '<input type="hidden" name="blog_name" value="', htmlspecialchars($_POST['blog_name']), '" />', "\n";
			if(isset($_POST['blog_tagline'])) echo '<input type="hidden" name="blog_tagline" value="', htmlspecialchars($_POST['blog_tagline']), '" />', "\n";
			if(isset($_POST['blog_footer'])) echo '<input type="hidden" name="blog_footer" value="', htmlspecialchars($_POST['blog_footer']), '" />', "\n";
			if(isset($_POST['blog_offset'])) echo '<input type="hidden" name="blog_offset" value="', (float)$_POST['blog_offset'], '" />', "\n";
		}
	}
?>