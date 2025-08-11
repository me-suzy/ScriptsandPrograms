<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	require_once('config.php');
	FLog::CheckSession();
	FLog::LoadPlugins();
	FLog::LoadTheme();
		
	FLog::CallAction('blog.begin');
	
	$db = array(
		'pages' => new FLog_Database,
		'users' => new FLog_Database,
		'cats' => new FLog_Database,
		'posts' => new FLog_Database,
		'comments' => new FLog_Database,
		'links' => new FLog_Database,
	);
	
	$db['pages']->Load('pages');
	$db['users']->Load('users');
	$db['cats']->Load('cats');
	$db['posts']->Load('posts');
	$db['comments']->Load('comments');
	$db['links']->Load('links');

	$db['cats']->LoadAll();	
	$db['cats']->Sort('name', SORT_ASC, 'strnatcasecmp');
	
	$db['links']->SortRecords(SORT_DESC, array('FLog', 'LinkSort'));
	$i=$max=(int)$FLog_config->GetValue('display.numlinks');
	foreach(array_keys($db['links']->records) as $key){
		if(--$max<0) break;
		$db['links']->records[$key]->Load('links', $key);
	}
	if($FLog_config->GetValue('linksort')==='asc' && $i>1){
		array_splice($db['links']->records, 0, 0, array_reverse(array_splice($db['links']->records, 0, $i), true));
	}
	
	if(isset($_GET['post']) && trim($_GET['post'])!==''){
		if(isset($db['posts']->records[$pid = (int)$_GET['post']]) && $db['posts']->records[$pid]->Load('posts', $pid) && (int)$db['posts']->records[$pid]->GetValue('draft')!==1 && ((int)$db['posts']->records[$pid]->GetValue('time')<=FLog::ServerTime() || (int)$db['posts']->records[$pid]->GetValue('delay')!==1)){
			FLog::RecordPageHit('post', $pid);
			$pt = $ct = (int)$db['posts']->records[$pid]->GetValue('time');
			$cmt = array();
			$db['comments']->Sort('time', SORT_ASC, 'strnatcmp');
			foreach(array_keys($db['comments']->records) as $key){
				$ct = max((int)$db['comments']->records[$key]->GetValue('time'), $ct);
				if((int)$db['comments']->records[$key]->GetValue('post') === $pid){
					if((int)$db['comments']->records[$key]->GetValue('moderated')===1 && !in_array($key, $FLog_comments)) continue;
					if($db['comments']->records[$key]->Load('comments', $key)) $cmt[] =& $db['comments']->records[$key];
				}
			}
			if(!FLog::LoggedIn() && (int)$FLog_config->GetValue('comments.anonymous')!=1) $db['posts']->records[$pid]->SetValue('allowcomments', 0);
			if(($to = (int)$FLog_config->GetValue('comments.oldtimeout'))>0){
				if(FLog::ServerTime() - $pt >= $to * 86400) $db['posts']->records[$pid]->SetValue('allowcomments', 0);
			}
			if(($to = (int)$FLog_config->GetValue('comments.staletimeout'))>0){
				if(FLog::ServerTime() - $ct >= $to * 86400) $db['posts']->records[$pid]->SetValue('allowcomments', 0);
			}
			if($FLog_config->GetValue('display.commentsort')==='desc') $cmt = array_reverse($cmt);
			FLog::CallTheme('post', &$db, &$db['posts']->records[$pid], &$cmt);
		}
		else{
			FLog::RecordPageHit();
			FLog::CallAction('blog.post404', $pid);
			FLog::CallTheme('post404', &$db, $pid);
		}
	}
	
	elseif(isset($_GET['page']) && trim($_GET['page'])!==''){
		if(($pid = $db['pages']->FindRecord('id', $_GET['page']))>=0 && $db['pages']->records[$pid]->Load('pages', $pid)){
			FLog::RecordPageHit('page',$pid);
			FLog::CallTheme('page', &$db, &$db['pages']->records[$pid]);
		}
		else{
			FLog::RecordPageHit();
			FLog::CallAction('blog.page404', $_GET['page']);
			FLog::CallTheme('page404', &$db, $_GET['page']);
		}
	}
	
	elseif(isset($_GET['archive'])){
		FLog::RecordPageHit();
		$year = isset($_GET['y'])?(int)$_GET['y']:false;
		$month = isset($_GET['m'])?(int)$_GET['m']:false;
		$day = isset($_GET['d'])?(int)$_GET['d']:false;
		$user = isset($_GET['user'])?(int)$_GET['user']:false;
		$cat = isset($_GET['cat'])?(int)$_GET['cat']:false;
		$page = isset($_GET['p'])?max(1,(int)$_GET['p']):1;

		$db['posts']->Sort('time', SORT_DESC, 'strnatcmp');
		
		$years = array();
		foreach(array_keys($db['posts']->records) as $key){
			$p =& $db['posts']->records[$key];
			$t = FLog::LocalTime((int)$p->GetValue('time'));
			if($year===false) $year = (int)gmdate('Y',$t);
			if(!isset($years[$y = gmdate('Y',$t)])) $years[$y] = array('total'=>0,'posts'=>array());
			++$years[$y]['total'];
			if($year === (int)$y){
				if($month===false) $month = (int)gmdate('m',$t);
				$months =& $years[$y]['posts'];
				if(!isset($months[$m = gmdate('m',$t)])) $months[$m] = array('total'=>0,'posts'=>array());
				++$months[$m]['total'];
				if($month === (int)$m){
					if($day===false) $day = (int)gmdate('d',$t);
					$days =& $months[$m]['posts'];
					if(!isset($days[$d = gmdate('d',$t)])) $days[$d] = array('total'=>0,'posts'=>array());
					++$days[$d]['total'];
					if($day === (int)$d) $days[$d]['posts'][] = $p;
				}
			}
		}
		
		FLog::CallTheme('archive', &$db, &$years, $year, $month, $day);
	}
	elseif(isset($_GET['links'])){
		FLog::RecordPageHit();

		$year = isset($_GET['y'])?(int)$_GET['y']:false;
		$month = isset($_GET['m'])?(int)$_GET['m']:false;
		$day = isset($_GET['d'])?(int)$_GET['d']:false;
		$cat = isset($_GET['cat'])?(int)$_GET['cat']:false;

		$links = $db['links']; // preserve sort order in $db
		
		if($FLog_config->GetValue('display.linktype')==='archive' && !isset($_GET['view'])){
			$links->Sort('time', SORT_DESC, 'strnatcmp');
			$years = array();
			foreach(array_keys($links->records) as $key){
				$l =& $links->records[$key];
				$t = FLog::LocalTime((int)$l->GetValue('time'));
				if($year===false) $year = (int)gmdate('Y',$t);
				if(!isset($years[$y = gmdate('Y',$t)])) $years[$y] = array('total'=>0,'links'=>array());
				++$years[$y]['total'];
				if($year === (int)$y){
					if($month===false) $month = (int)gmdate('m',$t);
					$months =& $years[$y]['links'];
					if(!isset($months[$m = gmdate('m',$t)])) $months[$m] = array('total'=>0,'links'=>array());
					++$months[$m]['total'];
					if($month === (int)$m){
						if($day===false) $day = (int)gmdate('d',$t);
						$days =& $months[$m]['links'];
						if(!isset($days[$d = gmdate('d',$t)])) $days[$d] = array('total'=>0,'links'=>array());
						++$days[$d]['total'];
						if($day === (int)$d){
							$l->Load('links', $key);
							$days[$d]['links'][] = $l;
						}
					}
				}
			}
			FLog::CallTheme('linkarchive', &$db, &$years, $year, $month, $day);
		}
		else{
			$links->Sort('title', SORT_ASC, 'strnatcasecmp');
			$cats = array();
			foreach(array_keys($links->records) as $key){
				$time = FLog::LocalTime((int)$links->records[$key]->GetValue('time'));
				if($year!==false){
					if($year!==(int)gmdate('Y',$time)) continue;
					if($month!==false){
						if($month!==(int)gmdate('m',$time)) continue;
						if($day!==false && $day!==(int)gmdate('d',$time)) continue;
					}
				}
				if(($c = trim($links->records[$key]->GetValue('cats')))==='') $catarray = array(-1);
				else $catarray = FLog::IntExplode(',',$c);
				if($cat!==false && !in_array($cat, $catarray)) continue;
				$links->records[$key]->Load('links', $key);
				foreach($catarray as $c){
					if($c<0 || isset($db['cats']->records[$c])){
						if(!isset($cats[$c])) $cats[$c] = array();
						$cats[$c][] = $links->records[$key];
					}
				}
			}
			FLog::CallTheme('linkcats', &$db, &$cats, $cat, $FLog_config->GetValue('display.linktype')!=='cats' || ($year!==false), $year, $month, $day);
		}
	}
	else{
		FLog::RecordPageHit();
		$posts = array();
		
		$year = isset($_GET['y'])?(int)$_GET['y']:false;
		$month = isset($_GET['m'])?(int)$_GET['m']:false;
		$day = isset($_GET['d'])?(int)$_GET['d']:false;
		$user = isset($_GET['user'])?(int)$_GET['user']:false;
		$cat = isset($_GET['cat'])?(int)$_GET['cat']:false;
		$page = isset($_GET['p'])?max(1,(int)$_GET['p']):1;
		
		if($cat!==false && isset($db['cats']->records[$cat])) $db['cats']->records[$cat]->Load('cats', $cat);
		else $cat = false;
		
		if($user!==false && isset($db['users']->records[$user])) $db['users']->records[$user]->Load('users', $user);
		else $user = false;
		
		$max = $each = max(1,(int)$FLog_config->GetValue('display.numposts'));
		$skip = ($page - 1) * $each;
		$total = 0;
		
		$db['posts']->Sort('time', SORT_DESC, 'strnatcmp');
		
		foreach(array_keys($db['posts']->records) as $key){
			if((int)$db['posts']->records[$key]->GetValue('delay')===1 && (int)$db['posts']->records[$key]->GetValue('time') > FLog::ServerTime()) continue;
			if((int)$db['posts']->records[$key]->GetValue('draft')===1) continue;
			if($cat!==false){
				$cats = trim($db['posts']->records[$key]->GetValue('cats'));
				if($cats === '') continue;
				elseif(!in_array($cat, FLog::IntExplode(',',$cats))) continue;
			}
			if($user!==false && $user!==(int)$db['posts']->records[$key]->GetValue('author')) continue;
			if($year!==false){
				$time = FLog::LocalTime((int)$db['posts']->records[$key]->GetValue('time'));
				if($year!==(int)gmdate('Y',$time)) continue;
				if($month!==false){
					if($month!==(int)gmdate('m',$time)) continue;
					if($day!==false && $day!==(int)gmdate('d',$time)) continue;
				}
			}
			
			++$total;
			
			if($skip>0){
				--$skip;
				continue;
			}
			if($max<=0) continue;
			--$max;
			
			$db['posts']->records[$key]->Load('posts', $key);
			$posts[] =& $db['posts']->records[$key];
		}
		$numpages = ceil($total / $each);
		if($FLog_config->GetValue('display.postsort')==='asc') $posts = array_reverse($posts);
		FLog::CallTheme('index', &$db, &$posts, $year, $month, $day, $cat, $user, $page, $numpages);
	}
	
	FLog::CallAction('blog.end');
	

?>