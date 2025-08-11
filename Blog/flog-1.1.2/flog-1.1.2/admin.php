<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/
	require_once('config.php');
	FLog::CheckSession();
	require_once($FLog_dir_include . 'admin.inc.php');
	
	class FLog_Admin{
		function PrintHeader($title=false, $menu=false){
			global $FLog_language, $FLog_adminpages, $FLog_user, $FLog_config, $FLog_dir_themes;
			
			FLog::CallAction('admin.begin');
			
			if(!headers_sent()){
				if(strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')!==false) header('content-type: application/xhtml+xml; charset=utf-8');
				else header('content-type: text/html; charset=utf-8');
			}
			
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',"\n";
			echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="',$FLog_language,'" lang="',$FLog_language,'">',"\n";
			echo '<head>',"\n";
			
			echo '<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />',"\n";
			echo '<meta name="robots" content="noindex,nofollow" />',"\n";
			echo '<meta name="author" content="Noah Medling" />',"\n";
			echo '<meta name="keywords" content="" />',"\n";
			echo '<meta name="description" content="FLog administration area." />',"\n";
			
			echo '<title>';
			if($title !== false) echo $title, ' - ';
			echo $FLog_config->GetEntities('blog.name');
			echo '</title>',"\n";
			
			echo '<link rel="shortcut icon" href="',htmlspecialchars($FLog_dir_themes),'!default/favicon.ico" type="image/x-icon" />',"\n";
			echo '<link rel="stylesheet" type="text/css" href="',htmlspecialchars($FLog_dir_themes),'!default/admin/style.css" />',"\n";
			echo '<script src="',htmlspecialchars($FLog_dir_themes),'!default/admin/script.js" type="text/javascript"></script>',"\n";
			FLog::CallAction('admin.head');
			echo '</head>',"\n";
			echo '<body onload="javascript:focusfirst();">',"\n";
			FLog::CallAction('admin.top');
			echo '<div id="root">',"\n";
			
			echo '<div id="header">',"\n";
			echo '<h1>',$FLog_config->GetEntities('blog.name'),'</h1>',"\n";
			echo '<p>',$FLog_config->GetEntities('blog.tagline'),'</p>',"\n";
			echo '</div>';
			
			echo '<div id="infobar">';
			if(FLog::LoggedIn()){
				echo '<p>', __('admin.logintext', $FLog_user->GetValue('username'), 'admin.php?logout', 'index.php'), '</p>';
			}
			echo '</div>';
			
			if($menu !== false){
				$m = explode('.', $menu, 2);
				echo '<div id="navigation">',"\n";
				echo '<ul class="level1">';
				echo '<li><a href="admin.php"',((!isset($m[1])&&$m[0]==='_h')?' class="selected"':''),'>',__('admin.menu.home'),'</a></li>';
				
				
				if((int)$FLog_user->GetValue('rank') <= (int)$FLog_config->GetValue('permissions.plugins') || (int)$FLog_config->GetValue('permissions.plugins') <= 0){
					echo '<li><a href="admin.php?plugins"',((!isset($m[1])&&$m[0]==='_p')?' class="selected"':''),'>',__('admin.menu.plugins'),'</a></li>';
				}
				if((int)$FLog_user->GetValue('rank') <= (int)$FLog_config->GetValue('permissions.themes') || (int)$FLog_config->GetValue('permissions.themes') <= 0){
					echo '<li><a href="admin.php?themes"',((!isset($m[1])&&$m[0]==='_t')?' class="selected"':''),'>',__('admin.menu.themes'),'</a></li>';
				}
				echo '</ul>';
				
				if(!isset($m[1])) $m[1]=false;
				echo '<ul class="level1">';
				foreach(array_keys($FLog_adminpages) as $l1){
					$s1 = ($l1===$m[0]);
					$p = false;
					foreach(array_keys($FLog_adminpages[$l1]) as $l2){
						$s2 = ($l2===$m[1]);
						if(!$p){
							echo '<li><a href="admin.php?p=',$l1,'"',($s1?' class="selected"':''),'>',__('admin.menu.'.$l1),'</a>';
							if($s1) echo '<ul class="level2">';
							$p = true;
						}
						if($s1) echo '<li',($s2?' class="current"':''),'><a href="admin.php?p=',$l1,'.',$l2,'">',__('admin.menu.'.$l1.'.'.$l2),'</a></li>';
					}
					if($p){
						if($s1) echo '</ul>';
						echo '</li>';
					}
				}
				echo '</ul>';
				FLog::CallAction('admin.menu');
				echo '</div>';
			}
			echo '<div id="content">',"\n";
			FLog::CallAction('admin.content');
		}
		
		function PrintFooter(){
			echo '</div><div id="footer"><p><a href="http://www.fluffington.com/">FLog</a> &copy;2005 Noah Medling</p></div></div>';
			FLog::CallAction('admin.bottom');
			echo '</body></html>';
			FLog::CallAction('admin.end');
		}
	}
	
	if(isset($_GET['logout'])){
		FLog::LogOut();
		FLog::Redirect('admin.php');
		exit();
	}
	
	if(!FLog::LoggedIn()){
		FLog::LoadPlugins();
		if(isset($_POST['username'], $_POST['password'])){
			if(FLog::LogIn($_POST['username'], $_POST['password'], isset($_POST['remember']))) FLog::Redirect('');
			$message = '<p class="error">'.__('admin.login.fail').'</p>';
		}
		else $message = '';
		FLog_Admin::PrintHeader(__('admin.login'));
		echo '<h1>', __('admin.login'), '</h1>', $message;
		echo '<form method="post" action="admin.php',FLog::LimitQuerySafe(''),'">';
		echo '<p><label>',__('admin.login.username'),'<br /><input name="username" type="text" value="" /></label></p>';
		echo '<p><label>',__('admin.login.password'),'<br /><input name="password" type="password" value="" /></label></p>';
		echo '<p><label><input type="checkbox" name="remember" /> ',__('admin.login.remember'),'</label></p>';
		echo '<p><input name="submit" type="submit" value="',__('admin.login.submit'),'" /> <input name="reset" type="reset" value="',__('admin.login.reset'),'" /></p>';
		echo '</form>';
		FLog_Admin::PrintFooter();
		exit();
	}
	
	if(isset($_GET['plugins']) && ((int)$FLog_user->GetValue('rank') <= (int)$FLog_config->GetValue('permissions.plugins') || (int)$FLog_config->GetValue('permissions.plugins') <= 0)){
		$enable = isset($_POST['enable'])?array($_POST['enable']):array();
		$disable = isset($_POST['disable'])?array($_POST['disable']):array();
		FLog::LoadPlugins($enable, $disable);

		FLog_Admin::PrintHeader(__('admin.plugins'),'_p');
		echo '<h1>',__('admin.plugins'),'</h1><table class="admintable">';
		echo '<colgroup><col class="oddcol" style="width:20%;" /><col class="evencol" style="width:15%;" /><col class="oddcol" style="width:10%;" /><col class="evencol" style="width:35%;" /><col class="oddcol" style="width:20%;" /></colgroup>';
		echo '<thead><tr><td>',__('admin.plugins.name'),'</td><td>',__('admin.plugins.author'),'</td><td>',__('admin.plugins.version'),'</td><td>',__('admin.plugins.description'),'</td><td>',__('admin.plugins.action'),'</td></tr></thead><tbody>';
		$i=0;
		foreach(array_keys($FLog_plugins) as $key){
			if($FLog_plugins[$key]['enabled']) echo ((++$i) % 2 == 1)?'<tr class="oddrow current">':'<tr class="evenrow current">';
			else echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
			echo '<td><a href="', htmlspecialchars($FLog_plugins[$key]['plugin-url']), '">', FLog::SafeEntities($FLog_plugins[$key]['plugin-name']), '</a></td>';
			echo '<td><a href="', htmlspecialchars($FLog_plugins[$key]['author-url']), '">', FLog::SafeEntities($FLog_plugins[$key]['author-name']), '</a></td>';
			echo '<td>', FLog::SafeEntities($FLog_plugins[$key]['plugin-version']), '</td>';
			echo '<td>', $FLog_plugins[$key]['plugin-description'], '</td>';
			echo '<td><form method="post" action="admin.php?plugins">';
			if($FLog_plugins[$key]['enabled']){
				echo '<input type="hidden" name="disable" value="', htmlspecialchars($key), '" />';
				echo '<input type="submit" value="', __('admin.plugins.disable'), '" />';
			}
			else{
				echo '<input type="hidden" name="enable" value="', htmlspecialchars($key), '" />';
				echo '<input type="submit" value="', __('admin.plugins.enable'), '" />';
			}
			echo '</form></td></tr>';
		}
		echo '</tbody></table>';
		FLog_Admin::PrintFooter();
		exit();
	}
	
	if(isset($_GET['themes']) && ((int)$FLog_user->GetValue('rank') <= (int)$FLog_config->GetValue('permissions.themes') || (int)$FLog_config->GetValue('permissions.themes') <= 0)){
		FLog::LoadPlugins();
		if(isset($_POST['select'])){
			$config = new FLog_Config;
			$abort = ignore_user_abort(true);
			if($config->Load('flog', true)){
				$config->SetValue('theme', $_POST['select']);
				if($config->Save()){
					FLog::CallAction('theme.changed', $_POST['select']);
					FLog::Redirect('admin.php?themes');
				}
				$config->Unlock();
			}
			ignore_user_abort($abort);
			$FLog_config->Load('flog');
		}
		FLog_Admin::PrintHeader(__('admin.themes'), '_t');
		echo '<h1>', __('admin.themes'), '</h1><table class="admintable">';
		echo '<colgroup><col class="oddcol" style="width:20%;" /><col class="evencol" style="width:15%;" /><col class="oddcol" style="width:10%;" /><col class="evencol" style="width:35%;" /><col class="oddcol" style="width:20%;" /></colgroup>';
		echo '<thead><tr><td>',__('admin.themes.name'),'</td><td>',__('admin.themes.author'),'</td><td>',__('admin.themes.version'),'</td><td>',__('admin.themes.description'),'</td><td>',__('admin.themes.action'),'</td></tr></thead><tbody>';
		echo ($FLog_config->GetValue('theme')!=='')?'<tr class="oddrow">':'<tr class="oddrow current">';
		echo '<td>',__('admin.themes.default.name'),'</td><td></td><td></td><td>',__('admin.themes.default.description'),'</td><td>';
		if($FLog_config->GetValue('theme')!=='') echo '<form method="post" action="admin.php?themes"><input name="select" type="hidden" value="" /><input type="submit" value="',__('admin.themes.select'),'" /></form>';
		echo '</td></tr>';
		$i=1;
		if(($dir = @opendir($FLog_dir_themes))!==false){
			while(($file = readdir($dir))!==false){
				if(!is_file($FLog_dir_themes.$file)) continue;
				if(!preg_match('/^([a-zA-Z0-9_\-]+)\.php$/',$file,$matches)) continue;
				if(($t = FLog::CheckTheme($FLog_dir_themes.$file))===false) continue;
				$key = $matches[1];
				if($s = ($key===$FLog_config->GetValue('theme'))) echo ((++$i) % 2 == 1)?'<tr class="oddrow current">':'<tr class="evenrow current">';
				else echo ((++$i) % 2 == 1)?'<tr class="oddrow">':'<tr class="evenrow">';
				echo '<td><a href="',htmlspecialchars($t['theme-url']),'">',FLog::SafeEntities($t['theme-name']),'</a></td>';
				echo '<td><a href="',htmlspecialchars($t['author-url']),'">',FLog::SafeEntities($t['author-name']),'</a></td>';
				echo '<td>',FLog::SafeEntities($t['theme-version']),'</td><td>',$t['theme-description'],'</td><td>';
				if(!$s){
					echo '<form method="post" action="admin.php?themes">';
					echo '<input type="hidden" name="select" value="',htmlspecialchars($key),'" />';
					echo '<input type="submit" value="',__('admin.themes.select'),'" />';
					echo '</form>';
				}
				echo '</td></tr>';
			}
		}
		echo '</tbody></table>';
		FLog_Admin::PrintFooter();
		exit();
	}
	
	if(isset($_GET['p'])){
		FLog::LoadPlugins();
		$m = explode('.',$_GET['p']);
		if(!isset($m[1])){
			if(isset($FLog_adminpages[$m[0]])){
				$keys = array_keys($FLog_adminpages[$m[0]]);
				$m[1] = $keys[0];
			}
			else $m[1] = '';
		}
		if(!isset($FLog_adminpages[$m[0]]) || !isset($FLog_adminpages[$m[0]][$m[1]])) FLog::Redirect('admin.php');
		$oldabort = ignore_user_abort(true);
		call_user_func($FLog_adminpages[$m[0]][$m[1]]['process']);
		ignore_user_abort($oldabort);
		FLog_Admin::PrintHeader($FLog_adminpages[$m[0]][$m[1]]['title'], $m[0].'.'.$m[1]);
		call_user_func($FLog_adminpages[$m[0]][$m[1]]['display']);
		FLog_Admin::PrintFooter();
		exit();
	}
	
	FLog::LoadPlugins();
	FLog_Admin::PrintHeader(__('admin.home'), '_h');
	echo '<h1>', __('admin.home'), '</h1>';
	echo '<p>',__('admin.home.version', FLog::Version()),'</p>', "\n";
	$db = new FLog_Database; $db->Load('posts'); echo '<p>',__('admin.home.posts', count($db->records)),'</p>', "\n";
	$db = new FLog_Database; $db->Load('pages'); echo '<p>',__('admin.home.pages', count($db->records)),'</p>', "\n";
	$db = new FLog_Database; $db->Load('comments'); echo '<p>',__('admin.home.comments', count($db->records)),'</p>', "\n";
	$db = new FLog_Database; $db->Load('links'); echo '<p>',__('admin.home.links', count($db->records)),'</p>', "\n";
	$db = new FLog_Database; $db->Load('cats'); echo '<p>',__('admin.home.cats', count($db->records)),'</p>', "\n";
	$db = new FLog_Database; $db->Load('users'); echo '<p>',__('admin.home.users', count($db->records)),'</p>', "\n";
	FLog_Admin::PrintFooter();
?>