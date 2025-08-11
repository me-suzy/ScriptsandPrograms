<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/
	require_once('config.php');
	FLog::LoadPlugins();
	
	$user = isset($_GET['user'])?(int)$_GET['user']:false;
	$cat = isset($_GET['cat'])?(int)$_GET['cat']:false;

	if($cat!==false && isset($db['cats']->records[$cat])) $db['cats']->records[$cat]->Load('cats', $cat);
	else $cat = false;
	
	if($user!==false && isset($db['users']->records[$user])) $db['users']->records[$user]->Load('users', $user);
	else $user = false;
	
	$db = array(
		'posts' => new FLog_Database,
		'users' => new FLog_Database,
		'cats' => new FLog_Database,
		'links' => new FLog_Database,
		'comments' => new FLog_Database,
	);
	
	$db['users']->Load('users');
	$db['cats']->Load('cats');
	
	$entries = array();
	$lastupdate = 0;
	
	if(isset($_GET['links'])){
		$title = ' - Links';
		$db['links']->Load('links');
		$db['links']->SortRecords(SORT_DESC, array('FLog', 'LinkSort'));

		$max = max(1,(int)$FLog_config->GetValue('display.feedlinks'));

		foreach(array_keys($db['links']->records) as $key){
			if($cat!==false){
				$cats = trim($db['links']->records[$key]->GetValue('cats'));
				if($cats === '') continue;
				elseif(!in_array($cat, FLog::IntExplode(',',$cats))) continue;
			}
			if($user!==false && $user!==(int)$db['links']->records[$key]->GetValue('author')) continue;
			if($max<=0) break;
			--$max;
			
			$db['links']->records[$key]->Load('links', $key);
			$url = $db['links']->records[$key]->GetValue('url');
			$entry = array(
				'title' => $db['links']->records[$key]->GetValue('title'),
				'url'   => $url,
				'text'  => '<a href="'.htmlspecialchars($url).'">'.htmlspecialchars($url).'</a>',
				'time'  => (int)$db['links']->records[$key]->GetValue('time')
			);
			if(isset($db['users']->records[$uid = (int)$db['links']->records[$key]->GetValue('author')]) && $db['users']->records[$uid]->Load('users', $uid)){
				$name = trim($db['users']->records[$uid]->GetValue('name'));
				$entry['author'] = $name!==''?$name:$db['users']->records[$uid]->GetValue('username');
			}
			$lastupdate = max($entry['time'], $lastupdate);
			$entries[] = $entry;
		}
	}
	elseif(isset($_GET['comments'])){
		$title = ' - Comments';
		$db['posts']->Load('posts');
		$db['comments']->Load('comments');
		$db['comments']->Sort('time', SORT_DESC, 'strnatcmp');

		$max = max(1,(int)$FLog_config->GetValue('display.feedcomments'));

		foreach(array_keys($db['comments']->records) as $key){
			if((int)$db['comments']->records[$key]->GetValue('moderated')===1) continue;
			if(!isset($db['posts']->records[$pid = (int)$db['comments']->records[$key]->GetValue('post')])) continue;
			if($cat!==false){
				$cats = trim($db['posts']->records[$pid]->GetValue('cats'));
				if($cats === '') continue;
				elseif(!in_array($cat, FLog::IntExplode(',',$cats))) continue;
			}
			if($user!==false && $user!==(int)$db['posts']->records[$pid]->GetValue('author')) continue;
			if($max<=0) break;
			--$max;
			
			$db['comments']->records[$key]->Load('comments', $key);
			$url = FLog::GetURL('index.php?post='.$pid.'#c'.$key);
			$entry = array(
				'title' => $db['posts']->records[$pid]->GetValue('title'),
				'url'   => $url,
				'text'  => FLog::CallFilter('comment', FLog::CallMarkup($db['comments']->records[$key]->GetValue('markup'), $db['comments']->records[$key]->GetValue('text'))),
				'time'  => (int)$db['comments']->records[$key]->GetValue('time'),
				'author' => $db['comments']->records[$key]->GetValue('name')
			);
			$lastupdate = max($entry['time'], $lastupdate);
			$entries[] = $entry;
		}
	}
	else{
		$title = '';
		$db['posts']->Load('posts');
		$db['posts']->Sort('time', SORT_DESC, 'strnatcmp');

		$max = max(1,(int)$FLog_config->GetValue('display.feedposts'));

		foreach(array_keys($db['posts']->records) as $key){
			if((int)$db['posts']->records[$key]->GetValue('delay')===1 && (int)$db['posts']->records[$key]->GetValue('time') > FLog::ServerTime()) continue;
			if((int)$db['posts']->records[$key]->GetValue('draft')===1) continue;
			if($cat!==false){
				$cats = trim($db['posts']->records[$key]->GetValue('cats'));
				if($cats === '') continue;
				elseif(!in_array($cat, FLog::IntExplode(',',$cats))) continue;
			}
			if($user!==false && $user!==(int)$db['posts']->records[$key]->GetValue('author')) continue;
			if($max<=0) break;
			--$max;
			
			$db['posts']->records[$key]->Load('posts', $key);
			$url = FLog::GetURL('index.php?post='.$key);
			$entry = array(
				'title' => $db['posts']->records[$key]->GetValue('title'),
				'url'   => $url,
				'text'  => FLog::CallFilter('post', FLog::CallMarkup($db['posts']->records[$key]->GetValue('markup'), $db['posts']->records[$key]->GetValue('text'))),
				'time'  => (int)$db['posts']->records[$key]->GetValue('time')
			);
			if(isset($db['users']->records[$uid = (int)$db['posts']->records[$key]->GetValue('author')]) && $db['users']->records[$uid]->Load('users', $uid)){
				$name = trim($db['users']->records[$uid]->GetValue('name'));
				$entry['author'] = $name!==''?$name:$db['users']->records[$uid]->GetValue('username');
			}
			$lastupdate = max($entry['time'], $lastupdate);
			$entries[] = $entry;
		}
	}
		
	switch((string)@$_GET['type']){
		case 'rss1': case 'rss1.0': FLog_Feeds::RSS1($entries, $title); break;
		case 'rss': case 'rss2': case 'rss2.0': FLog_Feeds::RSS2($entries, $title); break;
		case 'atom': case 'atom1': case 'atom1.0': FLog_Feeds::Atom($entries, $lastupdate, $title); break;
		default: FLog_Feeds::Atom($entries, $lastupdate, $title); break;
	}
	
	class FLog_Feeds{
		function Atom($entries, $lastupdate, $title){
			global $FLog_config;
			header('Content-type: text/xml; charset=utf-8');
			echo '<?xml version="1.0" encoding="UTF-8"?',">\n";
			echo '<feed xmlns="http://www.w3.org/2005/Atom">',"\n";
			echo '<title>',$FLog_config->GetSafe('blog.name'),$title,'</title>',"\n";
			echo '<link rel="alternate" href="',htmlspecialchars(FLog::GetURL('index.php')),'" />',"\n";
			echo '<link rel="self" href="',htmlspecialchars(FLog::GetURL('')),'" />',"\n";
			echo '<subtitle type="html">',htmlspecialchars($FLog_config->GetEntities('blog.tagline')),'</subtitle>',"\n";
			echo '<id>',htmlspecialchars(FLog::GetURL()),'</id>',"\n";
			echo '<updated>',gmdate('Y-m-d\TH:i:s\Z', $lastupdate),'</updated>',"\n";
			foreach($entries as $entry){
				echo '<entry>',"\n";
				echo '<id>',htmlspecialchars($entry['url']),'</id>',"\n";
				echo '<title>',htmlspecialchars($entry['title']),'</title>',"\n";
				echo '<link rel="alternate" href="',htmlspecialchars($entry['url']),'" />',"\n";
				echo '<content type="html">',htmlspecialchars($entry['text']),'</content>',"\n";
				if(isset($entry['author'])){
					echo '<author><name>',htmlspecialchars($entry['author']),'</name></author>',"\n";
				}
				echo '<updated>',gmdate('Y-m-d\TH:i:s\Z', $entry['time']),'</updated>',"\n";
				echo '</entry>';
			}
			echo '</feed>';
		}
		function RSS2($entries, $title){
			global $FLog_config;
			header('Content-type: text/xml; charset=utf-8');
			echo '<?xml version="1.0" encoding="UTF-8"?',">\n";
			echo '<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">',"\n";
			echo '<channel>',"\n";
			echo '<title>',$FLog_config->getSafe('blog.name'),$title,'</title>',"\n";
			echo '<link>',htmlspecialchars(FLog::GetURL('index.php')),'</link>',"\n";
			echo '<description>',$FLog_config->getSafe('blog.tagline'),'</description>',"\n";
			foreach($entries as $entry){
				echo '<item>',"\n";
				echo '<title>',htmlspecialchars($entry['title']),'</title>',"\n";
				echo '<link>',htmlspecialchars($entry['url']),'</link>',"\n";
				echo '<description>',htmlspecialchars($entry['text']),'</description>',"\n";
				if(isset($entry['author'])){
					echo '<dc:creator>',htmlspecialchars($entry['author']),'</dc:creator>',"\n";
				}
				echo '<dc:date>',gmdate('Y-m-d\TH:i:s\Z', $entry['time']),'</dc:date>',"\n";
				echo '</item>',"\n";
			}
			echo '</channel>',"\n";
			echo '</rss>';
		}
		
		function RSS1($entries, $title){
			global $FLog_config;
			header('Content-type: text/xml; charset=utf-8');
			echo '<?xml version="1.0" encoding="UTF-8"?',">\n";
			echo '<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns="http://purl.org/rss/1.0/" xmlns:dc="http://purl.org/dc/elements/1.1/">',"\n";
			echo '<channel rdf:about="'.htmlspecialchars(FLog::GetURL('')).'">',"\n";
			echo '<title>',$FLog_config->GetSafe('blog.name'),$title,'</title>',"\n";
			echo '<link>',htmlspecialchars(FLog::GetURL('index.php')).'</link>',"\n";
			echo '<description>',$FLog_config->GetSafe('blog.tagline'),'</description>',"\n";
			echo '<items>',"\n";
			echo '<rdf:Seq>',"\n";
			foreach($entries as $entry){
				echo '<rdf:li rdf:resource="',htmlspecialchars($entry['url']),'" />',"\n";
			}
			echo '</rdf:Seq>',"\n";
			echo '</items>',"\n";
			echo '</channel>',"\n";
			foreach($entries as $entry){
				echo '<item rdf:about="',htmlspecialchars($entry['url']),'">',"\n";
				echo '<title>',htmlspecialchars($entry['title']),'</title>',"\n";
				echo '<link>',htmlspecialchars($entry['url']),'</link>',"\n";
				echo '<description>',htmlspecialchars($entry['text']),'</description>',"\n";
				if(isset($entry['author'])){
					echo '<dc:creator>',$entry['author'],'</dc:creator>',"\n";
				}
				echo '<dc:date>',gmdate('Y-m-d\TH:i:s\Z', $entry['time']),'</dc:date>',"\n";
				echo '</item>',"\n";
			}
			echo '</rdf:RDF>';
		}
	}
	
?>