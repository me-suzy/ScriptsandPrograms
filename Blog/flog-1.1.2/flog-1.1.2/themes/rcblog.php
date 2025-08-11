<?php
/*
theme-name: RCBlog Theme
theme-url: http://www.fluffington.com/
theme-version: 1.1.1
theme-description: Make your site look like you never upgraded!
author-name: Noah Medling
author-url: http://www.fluffington.com/
*/

/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/
	class Theme_RCBlog{
		function Index(&$db, &$posts, $year=false, $month=false, $day=false, $cat=false, $user=false, $p=1, $n=1){
			Theme_RCBlog::Header($db);
			if($year!==false){
				$yearlink = gmdate('Y', gmmktime(0,0,0,1,1,$year));
				$monthlink = $daylink = '';
				if($month!==false){
					$yearlink = ' <a href="'.htmlspecialchars(FLog::GetURL('?+y='.$year,'cat','user')).'">'.$yearlink.'</a>';
					$monthlink .= __('theme.!default.archive.months.'.gmdate('m', gmmktime(0,0,0,$month,1,$year)));
					if($day!==false){
						$monthlink = ' <a href="'.htmlspecialchars(FLog::GetURL('?y='.$year.'&m='.$month,'cat','user')).'">'.$monthlink.'</a>';
						$daylink .= gmdate(' d',gmmktime(0,0,0,$month, $day, $year));
					}
					else $monthlink = ' '.$monthlink;
				}
				if($cat!==false && isset($db['cats']->records[$cat])){
					echo '<div class="post"><div class="title">',__('theme.!default.archive.message.cat',$yearlink.$monthlink.$daylink,'<a href="'.htmlspecialchars(FLog::GetURL('?+cat='.$cat,'user')).'">'.$db['cats']->records[$cat]->GetEntities('name').'</a>'),"</div>\n";
					echo '<div class="text">',$db['cats']->records[$cat]->GetEntities('description'),"</div></div>\n";
				}
				else{
					echo '<div class="post"><div class="title">',__('theme.!default.archive.message',$yearlink.$monthlink.$daylink),"</div></div>\n";
				}
			}
			elseif($cat!==false && isset($db['cats']->records[$cat])){
				echo '<div class="post"><div class="title">',$db['cats']->records[$cat]->GetEntities('name'),"</div>\n";
				echo '<div class="text">',$db['cats']->records[$cat]->GetEntities('description'),"</div></div>\n";
			}
			foreach(array_keys($posts) as $key) Theme_RCBlog::PostSummary($db, $posts[$key]);
			if($p > 1) echo '<div style="float: left;"><a href="index.php?p=',$p-1,FLog::AppendQuerySafe('','y','m','d','cat','user'),'">',__('theme.!default.index.prev'),'</a></div>',"\n";
			if($p < $n) echo '<div style="float: right;"><a href="index.php?p=',$p+1,FLog::AppendQuerySafe('','y','m','d','cat','user'),'">',__('theme.!default.index.next'),'</a></div>',"\n";
			echo '<div style="clear: both;"></div>',"\n";
			Theme_RCBlog::Footer($db);
		}
		
		function Page(&$db, &$page){
			Theme_RCBlog::Header($db, $page->GetEntities('title'));
			echo '<div class="post">',"\n";
			echo '<div class="title">',$page->GetEntities('title'),"</div>\n";
			echo '<div class="text">',FLog::CallFilter('page', FLog::CallMarkup($page->GetValue('markup'),$page->GetValue('text'))),"</div>\n";
			echo "</div>\n";
			Theme_RCBlog::Footer($db);
		}
		
		function Post(&$db, &$post, &$comments){
			Theme_RCBlog::Header($db, $post->GetEntities('title'));
			echo '<div class="post">',"\n";
			echo '<div class="title">',$post->GetEntities('title'),"</div>\n";
			echo '<div class="date">';
			if(isset($db['users']->records[$uid = (int)$post->GetValue('author')]) && $db['users']->records[$uid]->LoadC('users', $uid)){
				$url = trim($db['users']->records[$uid]->GetSafe('url'));
				if(($name = trim($db['users']->records[$uid]->GetSafe('name')))==='') $name = $db['users']->records[$uid]->GetSafe('username');
				if($url!=='') $name = '<a href="'.$url.'">'.$name.'</a>';
				_e('theme.!default.post.header', $name, FLog::FormatLocalDate((int)$post->GetValue('time')), FLog::FormatLocaltime((int)$post->GetValue('time')));
			}
			else _e('theme.!default.post.header.anon', FLog::FormatLocalDate((int)$post->GetValue('time')), FLog::FormatLocaltime((int)$post->GetValue('time')));
			echo "</div>\n";
			echo '<div class="text">',FLog::CallFilter('post', FLog::CallMarkup($post->GetValue('markup'), $post->GetValue('text'))),"</div>\n";
			echo '<div class="comment">';
			if(($cats = trim($post->GetValue('cats')))!==''){
				$catarray = array();
				foreach(FLog::IntExplode(',',$cats) as $cat){
					if(isset($db['cats']->records[$cat]) && $db['cats']->records[$cat]->LoadC('cats', $cat)){
						$catarray[] = '<a href="index.php?cat='.$cat.FLog::AppendQuerySafe('','y','m','d','user').'">'.$db['cats']->records[$cat]->GetEntities('name').'</a>';
					}
				}
				echo implode(', ', $catarray);
			}
			echo "</div>\n</div>\n";
			foreach(array_keys($comments) as $key) Theme_RCBlog::Comment($db, $comments[$key]);
			if((int)$post->GetValue('allowcomments')===1){
				echo '<div class="post"><div class="title">',__('theme.!default.commentform'),"</div>\n",'<div class="text">',"\n";
				Theme_RCBlog::CommentForm($db, $post);
				echo "</div>\n</div>\n";
			}
			Theme_RCBlog::Footer($db);
		}
		
		function CommentPreview(&$db, &$post, &$comment){
			Theme_RCBlog::Header($db, $post->GetEntities('title'));
			echo '<div class="post"><div class="title">',__('theme.!default.commentform.previewbox'),"</div>\n",'<div class="text">',"\n";
			echo FLog::CallFilter('comment_preview', FLog::CallMarkup($comment->GetValue('markup'), $comment->GetValue('text')));
			echo "\n</div></div>\n";
			echo '<div class="post"><div class="text">';
			Theme_RCBlog::CommentForm($db, $post);
			echo '</div></div>';
			Theme_RCBlog::Footer($db);
		}
		
		function Page404(&$db, $pid){
			Theme_RCBlog::Header($db);
			echo '<div class="post"><div class="title">',__('theme.!default.page404'),'</div>',"\n";
			echo '<div class="text">',__('theme.!default.page404.message'),"</div></div>\n";
			Theme_RCBlog::Footer($db);
		}

		function Post404(&$db, $pid){
			Theme_RCBlog::Header($db);
			echo '<div class="post"><div class="title">',__('theme.!default.post404'),'</div>',"\n";
			echo '<div class="text">',__('theme.!default.post404.message'),"</div></div>\n";
			Theme_RCBlog::Footer($db);
		}
		
		function Comment(&$db, &$comment){
			if((int)$comment->GetValue('moderated')===1) echo '<div class="comment moderated">';
			else echo '<div class="post">';
			echo '<a class="anchor" name="c',$comment->rid,'" style="color:inherit;text-decoration:inherit;">';
			echo "\n",'<div class="date">';
			$url = FLog::SafeURL(trim($comment->GetSafe('url')));
			$name = trim($comment->GetEntities('name'));
			if($name!==''){
				if($url!=='') $name = '<a href="'.$url.'">'.$name.'</a>';
				_e('theme.!default.post.header', $name, FLog::FormatLocalDate((int)$comment->GetValue('time')), FLog::FormatLocalTime((int)$comment->GetValue('time')));
			}
			else _e('theme.!default.post.header.anon', FLog::FormatLocalDate((int)$comment->GetValue('time')), FLog::FormatLocalTime((int)$comment->GetValue('time')));
			echo "</div></a>\n",'<div class="text">',"\n";
			echo FLog::CallFilter('comment',FLog::CallMarkup($comment->GetValue('markup'), $comment->GetValue('text'))),"\n";
			echo "</div>\n</div>\n";
		}
		
		function PostSummary(&$db, &$post){
			echo '<div class="post">',"\n";
			echo '<div class="title">',$post->GetEntities('title'),'</div>',"\n";
			echo '<div class="date">';
			if(isset($db['users']->records[$uid = (int)$post->GetValue('author')]) && $db['users']->records[$uid]->LoadC('users', $uid)){
				$url = trim($db['users']->records[$uid]->GetSafe('url'));
				if(($name = trim($db['users']->records[$uid]->GetSafe('name')))==='') $name = $db['users']->records[$uid]->GetSafe('username');
				if($url!=='') $name = '<a href="'.$url.'">'.$name.'</a>';
				_e('theme.!default.post.header', $name, FLog::FormatLocalDate((int)$post->GetValue('time')), FLog::FormatLocaltime((int)$post->GetValue('time')));
			}
			else _e('theme.!default.post.header.anon', FLog::FormatLocalDate((int)$post->GetValue('time')), FLog::FormatLocaltime((int)$post->GetValue('time')));
			echo "</div>\n";
			echo '<div class="text">',FLog::CallFilter('post', FLog::CallMarkup($post->GetValue('markup'), $post->GetValue('text'), true)), '</div>',"\n";
			echo '<div class="comment">';
			if(($cats = trim($post->GetValue('cats')))!==''){
				$catarray = array();
				foreach(FLog::IntExplode(',',$cats) as $cat){
					if(isset($db['cats']->records[$cat]) && $db['cats']->records[$cat]->LoadC('cats', $cat)){
						$catarray[] = '<a href="index.php?cat='.$cat.FLog::AppendQuerySafe('','y','m','d','user').'">'.$db['cats']->records[$cat]->GetEntities('name').'</a>';
					}
				}
				echo implode(', ', $catarray), ' | ';
			}
			$cmt = (int)$post->GetValue('comments');
			echo '<a href="index.php?post=',$post->rid,'">';
			switch($cmt){
				case 0: _e('theme.!default.post.nocomments'); break;
				case 1: _e('theme.!default.post.onecomment'); break;
				default: _e('theme.!default.post.numcomments', $cmt); break;
			}
			echo "</a></div>\n</div>\n";
		}
		
		function Header(&$db, $title=false){
			global $FLog_config, $FLog_language, $FLog_dir_themes;

			if(!headers_sent()){
				if(strpos($_SERVER['HTTP_ACCEPT'], 'application/xhtml+xml')!==false) header('content-type: application/xhtml+xml; charset=utf-8');
				else header('content-type: text/html; charset=utf-8');
			}
			echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',"\n";
			echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="',$FLog_language,'" lang="',$FLog_language,'">',"\n";
			echo '<head>';
			
			echo '<meta http-equiv="content-type" content="application/xhtml+xml; charset=utf-8" />';
			echo '<meta name="robots" content="all" />';
			echo '<meta name="author" content="',$FLog_config->GetEntities('meta.author'),'" />';
			echo '<meta name="keywords" content="',$FLog_config->GetEntities('meta.keywords'),'" />';
			echo '<meta name="description" content="',$FLog_config->GetEntities('meta.description'),'" />';
			if($title!==false) echo '<title>',$title,' - ',$FLog_config->GetEntities('blog.name'),'</title>';
			else echo '<title>',$FLog_config->GetEntities('blog.name'),'</title>';
			
			echo '<link rel="shortcut icon" href="',htmlspecialchars($FLog_dir_themes),'rcblog/favicon.ico" type="image/x-icon" />',"\n";
			echo '<link rel="stylesheet" type="text/css" href="',htmlspecialchars($FLog_dir_themes),'rcblog/base.css" />',"\n";
			echo '<link rel="alternate" type="application/atom+xml" title="Posts (Atom)" href="feed.php?type=atom" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Posts (RSS 1.0)" href="feed.php?type=rss1" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Posts (RSS 2.0)" href="feed.php?type=rss2" />',"\n";
			echo '<link rel="alternate" type="application/atom+xml" title="Links (Atom)" href="feed.php?links&amp;type=atom" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Links (RSS 1.0)" href="feed.php?links&amp;type=rss1" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Links (RSS 2.0)" href="feed.php?links&amp;type=rss2" />',"\n";
			echo '<link rel="alternate" type="application/atom+xml" title="Comments (Atom)" href="feed.php?comments&amp;type=atom" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Comments (RSS 1.0)" href="feed.php?comments&amp;type=rss1" />',"\n";
			echo '<link rel="alternate" type="application/rss+xml" title="Comments (RSS 2.0)" href="feed.php?comments&amp;type=rss2" />',"\n";
			echo '<link rel="start" href="',htmlspecialchars(FLog::GetURL('index.php')).'" title="Home" />',"\n";
			echo '<script type="text/javascript" src="',htmlspecialchars($FLog_dir_themes),'rcblog/rcb_javascript.js"></script>',"\n";
			echo '<style type="text/css">',"\n";
			$rcb_colors = new FLog_Config; $rcb_colors->load('rcb_colors');
			echo 'body, html{ background-color:#',$rcb_colors->GetValue('04'),'; color:#000000; }',"\n";
			echo '#frame{ border-color:#',$rcb_colors->GetValue('01'),'; }',"\n";
			echo '#header{ border-color:#',$rcb_colors->GetValue('01'),'; background-color:#',$rcb_colors->GetValue('05'),'; color:#',$rcb_colors->GetValue('13'),'; }',"\n";
			echo '#content{ border-color:#',$rcb_colors->GetValue('01'),'; background-color:#',$rcb_colors->GetValue('06'),'; }',"\n";
			echo '#nav{ border-color:#',$rcb_colors->GetValue('01'),'; background-color:#',$rcb_colors->GetValue('07'),'; }',"\n";
			echo '#footer{ border-color:#',$rcb_colors->GetValue('01'),'; background-color:#',$rcb_colors->GetValue('08'),'; color:#',$rcb_colors->GetValue('14'),'; }',"\n";
			echo 'div.post{ border-color:#',$rcb_colors->GetValue('02'),'; background-color:#',$rcb_colors->GetValue('09'),'; color:#',$rcb_colors->GetValue('15'),'; }',"\n";
			echo 'div.post div.title{ border-color:#',$rcb_colors->GetValue('02'),'; background-color:#',$rcb_colors->GetValue('10'),'; color:#',$rcb_colors->GetValue('16'),'; }',"\n";
			echo 'div.post div.navtitle{ border-color:#',$rcb_colors->GetValue('02'),'; background-color:#',$rcb_colors->GetValue('10'),'; color:#',$rcb_colors->GetValue('16'),'; }',"\n";
			echo 'div.post div.comment{ border-color:#',$rcb_colors->GetValue('02'),'; background-color:#',$rcb_colors->GetValue('11'),'; color:#',$rcb_colors->GetValue('17'),'; }',"\n";
			echo 'div.post div.code{ border-color:#',$rcb_colors->GetValue('03'),'; background-color:#',$rcb_colors->GetValue('12'),'; color:#',$rcb_colors->GetValue('18'),'; }',"\n";
			echo 'div.post div.quote{ border-color:#',$rcb_colors->GetValue('03'),'; background-color:#',$rcb_colors->GetValue('12'),'; color:#',$rcb_colors->GetValue('18'),'; }',"\n";
			echo 'hr{ background-color:#',$rcb_colors->GetValue('03'),'; color:#',$rcb_colors->GetValue('03'),'; }',"\n";
			echo 'a:link{ color:#',$rcb_colors->GetValue('19'),'; }',"\n";
			echo 'a:visited{ color:#',$rcb_colors->GetValue('20'),'; }',"\n";
			echo 'a:hover{ color:#',$rcb_colors->GetValue('21'),'; }',"\n";
			echo 'a:active{ color:#',$rcb_colors->GetValue('22'),'; }',"\n";
			echo '</style>',"\n";
			echo "</head>\n";
			echo '<body onload="javascript:rcb_linkout()">',"\n";
			FLog::CallAction('blog.top');
			echo '<table id="frame" cellspacing="0">',"\n";
			echo '<tr><td colspan="2" id="header">',$FLog_config->GetEntities('blog.name'),'<br />',$FLog_config->GetEntities('blog.tagline'),'</td></tr>',"\n";
			echo "<tr>\n";
			echo '<td id="content">',"\n";
			switch((string)@$_GET['msg']){
				case 'error.database': echo '<div class="post"><div class="text">',__('theme.!default.error.database'),"</div></div>\n"; break;
				case 'error.allowcomments': echo '<div class="post"><div class="text">',__('theme.!default.error.allowcomments'),"</div></div>\n"; break;
				case 'error.maxsize': echo '<div class="post"><div class="text">',__('theme.!default.error.maxsize', (int)$FLog_config->GetValue('comments.maxsize')),"</div></div>\n"; break;
				case 'error.anonymous': echo '<div class="post"><div class="text">',__('theme.!default.error.anonymous'),"</div></div>\n"; break;
				case 'error.ip': echo '<div class="post"><div class="text">',__('theme.!default.error.ip'),"</div></div>\n"; break;
				case 'error.referrer': echo '<div class="post"><div class="text">',__('theme.!default.error.referrer'),"</div></div>\n"; break;
				case 'error.nameemail': echo '<div class="post"><div class="text">',__('theme.!default.error.nameemail'),"</div></div>\n"; break;
				case 'message.moderated': echo '<div class="post"><div class="text">',__('theme.!default.message.moderated'),"</div></div>\n"; break;
				case 'message.posted': echo '<div class="post"><div class="text">',__('theme.!default.message.posted'),"</div></div>\n"; break;
			}
			FLog::CallAction('blog.content');
		}

		function Footer(&$db){
			global $FLog_config;

			echo "</td>\n",'<td id="nav">',"\n";

			echo '<div class="post">',"\n",'<div class="navtitle">',__('theme.!default.nav'),'</div>',"\n",'<div class="text">',"\n";
			echo '<a href="./">',__('theme.!default.nav.home'),'</a><br />',"\n";
			$index = FLog::DecodePageIndex($db['pages']);
			foreach($index as $line){
				switch($line['type']){
					case 'S':
						echo '<br />',FLog::SafeEntities($line['title']),"<br />\n";
						break;
					case 'L':
						echo '<a href="',htmlspecialchars($line['url']),'">',FLog::SafeEntities($line['title']),"</a><br />\n";
						break;
					default:
						echo '<a href="index.php?page=',urlencode($line['pid']),'">',FLog::SafeEntities($line['title']),"</a><br />\n";
						break;
				}
			}
			echo "</div>\n</div>\n";

			if(count($db['cats']->records)>0){
				echo '<div class="post">',"\n",'<div class="navtitle">',__('theme.!default.nav.cats'),'</div>',"\n",'<div class="text">',"\n";
				foreach(array_keys($db['cats']->records) as $key){
					if((int)$db['cats']->records[$key]->GetValue('posts') <= 0) continue;
					echo '<a href="index.php?cat=',$key,'">',$db['cats']->records[$key]->GetSafe('name'),'</a> (',(int)$db['cats']->records[$key]->GetValue('posts'),')<br />';
				}
				echo "</div>\n</div>\n";
			}
			$max = (int)$FLog_config->GetValue('display.numlinks');
			if($max>0 && count($db['links']->records)>0){
				echo '<div class="post">',"\n",'<div class="navtitle">',__('theme.!default.nav.links'),'</div>',"\n",'<div class="text">',"\n";
				foreach(array_keys($db['links']->records) as $key){
					if(--$max < 0) break;
					echo '<a href="',$db['links']->records[$key]->GetSafe('url'),'">',$db['links']->records[$key]->GetEntities('title'),"</a><br />\n";
				}
				echo "</div>\n</div>\n";
			}
			echo '<div class="post">',"\n",'<div class="navtitle">',__('theme.!default.nav.archives'),'</div>',"\n",'<div class="text">',"\n";
			echo '<a href="index.php?archive">',__('theme.!default.nav.archives.posts'),'</a><br />';
			echo '<a href="index.php?links">',__('theme.!default.nav.archives.links'),'</a><br />';
			echo "</div>\n</div>\n";
			FLog::CallAction('blog.menu');
			echo '<div style="font-size:9px">',__('theme.!default.linkback'),"</div>\n";
			echo "</td>\n</tr>\n";
			echo '<tr><td colspan="2" id="footer">',$FLog_config->GetEntities('blog.footer'),'</td></tr></table>',"\n";
			FLog::CallAction('blog.bottom');
			echo "</body>\n</html>\n";
		}
		
		function CommentForm(&$db, &$post){
			global $FLog_user, $FLog_config, $FLog_markup;
			
			echo '<form method="post" action="comment.php" accept-charset="utf-8">',"\n";
			echo '<input name="post" type="hidden" value="',$post->rid,'" />',"\n";
			echo '<input name="key" type="hidden" value="',md5(@$_SERVER['REMOTE_ADDR']),'" />',"\n";
			if(FLog::LoggedIn()){
				echo '<p><label>',__('theme.!default.commentform.name'),'<br /><input name="name" type="text" size="40" readonly="readonly" value="',$FLog_user->GetEntities('name'),'" /></label></p>',"\n";
				echo '<p><label>',__('theme.!default.commentform.email'),'<br /><input name="email" type="text" size="40" readonly="readonly" value="',$FLog_user->GetSafe('email'),'" /></label></p>',"\n";
				echo '<p><label>',__('theme.!default.commentform.url'),'<br /><input name="url" type="text" size="40" readonly="readonly" value="',$FLog_user->GetSafe('url'),'" /></label></p>',"\n";
			}
			else{
				echo '<p><label>',__('theme.!default.commentform.name'),'<br /><input name="name" type="text" size="40" value="',isset($_POST['name'])?htmlspecialchars($_POST['name']):'','" /></label></p>',"\n";
				echo '<p><label>',__('theme.!default.commentform.email'),'<br /><input name="email" type="text" size="40" value="',isset($_POST['email'])?htmlspecialchars($_POST['email']):'','" /></label></p>',"\n";
				echo '<p><label>',__('theme.!default.commentform.url'),'<br /><input name="url" type="text" size="40" value="',isset($_POST['url'])?htmlspecialchars($_POST['url']):'','" /></label></p>',"\n";
			}
			if($FLog_config->GetValue('comments.markup') === '?'){
				echo '<p><label>',__('theme.!default.commentform.markup'),'<br /><select name="markup"><option value="">',__('theme.!default.commentform.markup.none'),'</option>';
				foreach(array_keys($FLog_markup) as $key){
					if(isset($_POST['markup'])) $markup = $_POST['markup'];
					elseif(FLog::LoggedIn()) $markup = $FLog_user->GetValue('markup');
					else $markup = '';
					echo '<option value="',htmlspecialchars($key),'"',$markup===$key?' selected="selected"':'','>',$FLog_markup[$key]['name'],'</option>';
				}
				echo "</select></label></p>\n";
			}
			echo '<p><label>';
			if($FLog_config->GetValue('comments.markup') === '?' || !isset($FLog_markup[$FLog_config->GetValue('comments.markup')])){
				_e('theme.!default.commentform.text');
			}
			else{
				_e('theme.!default.commentform.text.markup',$FLog_markup[$FLog_config->GetValue('comments.markup')]['name']);
			}
			echo '<br /><textarea name="text" rows="5" cols="30">',isset($_POST['text'])?htmlspecialchars($_POST['text']):'',"</textarea></label></p>\n";
			echo '<p><input type="submit" name="previewcomment" value="',__('theme.!default.commentform.preview'),'" /> <input type="submit" name="addcomment" value="',__('theme.!default.commentform.submit'),'" /></p>',"\n";
			echo "</form>\n";
		}
		
		function Archive(&$db, &$years, $year=false, $month=false, $day=false){
			global $FLog_config;
			Theme_RCBlog::Header($db);
			echo '<div class="post">';
			echo '<div class="title">',__('theme.!default.archive.posts'),'</div>';
			echo '<div class="text">';
			echo '<ul class="archive">';
			if($FLog_config->GetValue('display.postsort')==='asc') $years = array_reverse($years,true);
			foreach(array_keys($years) as $y){
				echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?y='.$y)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?archive&y='.$y)),'">',$y,'</a> (',$years[$y]['total'],')</div>';
				$months =& $years[$y]['posts'];
				if($FLog_config->GetValue('display.postsort')==='asc') $months = array_reverse($months,true);
				if(count($months)>0){
					echo '<ul>';
					foreach(array_keys($months) as $m){
						echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?y='.$y.'&m='.$m)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?archive&y='.$y.'&m='.$m)),'">',__('theme.!default.archive.months.'.$m),'</a> (',$months[$m]['total'],')</div>';
						$days =& $months[$m]['posts'];
						if($FLog_config->GetValue('display.postsort')==='asc') $days = array_reverse($days,true);
						if(count($days) > 0){
							echo '<ul>';
							foreach(array_keys($days) as $d){
								echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?y='.$y.'&m='.$m.'&d='.$d)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?archive&y='.$y.'&m='.$m.'&d='.$d)),'">',$d,'</a> (',$days[$d]['total'],')</div>';
								$posts =& $days[$d]['posts'];
								if($FLog_config->GetValue('display.postsort')==='asc') $posts = array_reverse($posts,true);
								if(count($posts)>0){
									echo '<ul>';
									foreach(array_keys($posts) as $p){
										echo '<li>(',__('theme.!default.archive.time.display', FLog::FormatLocalDate((int)$posts[$p]->GetValue('time')),FLog::FormatLocalTime((int)$posts[$p]->GetValue('time'))),') <a href="',htmlspecialchars(FLog::GetURL('?post='.$posts[$p]->rid)),'">',$posts[$p]->GetEntities('title'),'</a></li>';
									}
									echo '</ul>';
								}
								echo '</li>';
							}
							echo '</ul>';
						}
						echo '</li>';
					}
					echo '</ul>';
				}
				echo '</li>';
			}
			echo '</ul>';
			echo '</div></div>';
			Theme_RCBlog::Footer($db);
		}
		
		function LinkArchive(&$db, &$years, $year=false, $month=false, $day=false){
			global $FLog_config;
			Theme_RCBlog::Header($db);
			echo '<div class="post">';
			echo '<div class="title">',__('theme.!default.archive.links'),'</div>';
			echo '<div class="text">';
			echo '<ul class="archive">';
			if($FLog_config->GetValue('display.linksort')==='asc') $years = array_reverse($years,true);
			foreach(array_keys($years) as $y){
				echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?links&view&y='.$y)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?links&y='.$y)),'">',$y,'</a> (',$years[$y]['total'],')</div>';
				$months =& $years[$y]['links'];
				if($FLog_config->GetValue('display.linksort')==='asc') $months = array_reverse($months,true);
				if(count($months)>0){
					echo '<ul>';
					foreach(array_keys($months) as $m){
						echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?links&view&y='.$y.'&m='.$m)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?links&y='.$y.'&m='.$m)),'">',__('theme.!default.archive.months.'.$m),'</a> (',$months[$m]['total'],')</div>';
						$days =& $months[$m]['links'];
						if($FLog_config->GetValue('display.linksort')==='asc') $days = array_reverse($days,true);
						if(count($days) > 0){
							echo '<ul>';
							foreach(array_keys($days) as $d){
								echo '<li><div class="viewbox"><a class="viewlink" href="',htmlspecialchars(FLog::GetURL('?links&view&y='.$y.'&m='.$m.'&d='.$d)),'">',__('theme.!default.archive.view'),'</a> <a href="',htmlspecialchars(FLog::GetURL('?links&y='.$y.'&m='.$m.'&d='.$d)),'">',$d,'</a> (',$days[$d]['total'],')</div>';
								$links =& $days[$d]['links'];
								if($FLog_config->GetValue('display.linksort')==='asc') $links = array_reverse($links,true);
								if(count($links)>0){
									echo '<ul>';
									foreach(array_keys($links) as $l){
										echo '<li>(',__('theme.!default.archive.time.display', FLog::FormatLocalDate((int)$links[$l]->GetValue('time')),FLog::FormatLocalTime((int)$links[$l]->GetValue('time'))),') <a href="',$links[$l]->GetSafe('url'),'">',$links[$l]->GetEntities('title'),'</a></li>';
									}
									echo '</ul>';
								}
								echo '</li>';
							}
							echo '</ul>';
						}
						echo '</li>';
					}
					echo '</ul>';
				}
				echo '</li>';
			}
			echo '</ul>';
			echo '</div></div>';
			Theme_RCBlog::Footer($db);
		}

		function LinkCats(&$db, &$cats, $current=false, $showall=false, $year=false, $month=false, $day=false){
			global $FLog_config;
			Theme_RCBlog::Header($db);
			echo '<div class="post">';
			echo '<div class="title">',__('theme.!default.archive.links'),'</div>';
			echo '<div class="text">';
			if($year!==false){
				$yearlink = gmdate('Y', gmmktime(0,0,0,1,1,$year));
				$monthlink = $daylink = '';
				if($month!==false){
					$yearlink = ' <a href="'.htmlspecialchars(FLog::GetURL('?+links&y='.$year,'cat','view')).'">'.$yearlink.'</a>';
					$monthlink .= __('theme.!default.archive.months.'.gmdate('m', gmmktime(0,0,0,$month,1,$year)));
					if($day!==false){
						$monthlink = ' <a href="'.htmlspecialchars(FLog::GetURL('?+links&y='.$year.'&m='.$month,'cat','view')).'">'.$monthlink.'</a>';
						$daylink .= gmdate(' d',gmmktime(0,0,0,$month, $day, $year));
					}
					else $monthlink = ' '.$monthlink;
				}
				echo '<p>',__('theme.!default.archive.message',$yearlink.$monthlink.$daylink),"</p>\n";
			}
			if($year!==false && isset($cats[-1]) && $FLog_config->GetValue('display.linktype')==='archive'){
				echo '<ul class="archive">';
				foreach(array_keys($cats[-1]) as $key){
					echo '<li><a href="',$cats[-1][$key]->GetSafe('url'),'">',$cats[-1][$key]->GetEntities('title'),'</a></li>';
				}
				echo '</ul>';
			}
			if(!$showall && $current===false){
				echo '<ul class="archive">';
				foreach(array_keys($db['cats']->records) as $key){
					if(isset($cats[$key])){
						echo '<li><a href="',htmlspecialchars(FLog::GetURL('?+links&cat='.$key,'view','y','m','d')),'">',$db['cats']->records[$key]->GetEntities('name'),'</a> (',count($cats[$key]),')</li>';
					}
				}
				echo '</ul>';
			}
			else{
				foreach(array_keys($db['cats']->records) as $key){
					if(isset($cats[$key])){
						if($showall || $current===$key){
							echo '<ul class="archive">';
							echo '<li><div class="viewbox">',$db['cats']->records[$key]->GetEntities('name'),'</div>';
							echo '<ul>';
							foreach(array_keys($cats[$key]) as $key2){
								echo '<li><a href="',$cats[$key][$key2]->GetSafe('url'),'">',$cats[$key][$key2]->GetEntities('title'),'</a></li>';
							}
							echo '</ul></li>';
							echo '</ul>';
						}
					}
				}
			}
			echo '</div></div>';
			Theme_RCBlog::Footer($db);
		}
	}

	FLog::RegisterTheme(
		array('Theme_RCBlog', 'Index'),
		array('Theme_RCBlog', 'Post'),
		array('Theme_RCBlog', 'Post404'),
		array('Theme_RCBlog', 'Page'),
		array('Theme_RCBlog', 'Page404'),
		array('Theme_RCBlog', 'CommentPreview'),
		array('Theme_RCBlog', 'Archive'),
		array('Theme_RCBlog', 'LinkArchive'),
		array('Theme_RCBlog', 'LinkCats')
	);
?>