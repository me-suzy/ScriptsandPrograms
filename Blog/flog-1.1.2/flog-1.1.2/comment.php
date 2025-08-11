<?
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
	
	$db = array(
		'pages' => new FLog_Database,
		'users' => new FLog_Database,
		'cats' => new FLog_Database,
		'posts' => new FLog_Database,
		'comments' => new FLog_Database,
	);
	
	function FLog_SendCommentMail($email, &$comment, &$post){
		if((int)$comment->GetValue('moderated')==1){
			FLog::SendMail($email, __('comment.email.moderated.subject'),
				__('comment.email.moderated',
					FLog::SafeEntities($comment->GetValue('name')),
					htmlspecialchars($comment->GetValue('url')),
					htmlspecialchars($comment->GetValue('email')),
					FLog::GetURL('index.php?post='.$post->rid),
					FLog::SafeEntities($post->GetValue('title')),
					FLog::GetURL('admin.php?p=manage.comments&approve='.$comment->rid),
					FLog::GetURL('admin.php?p=manage.comments&edit='.$comment->rid),
					FLog::GetURL('admin.php?p=manage.comments&delete='.$comment->rid),
					FLog::CallFilter('comment', FLog::CallMarkup($comment->GetValue('markup'), $comment->GetValue('text')))
				)
			);
		}
		else{
			FLog::SendMail($email, __('comment.email.approved.subject'),
				__('comment.email.approved',
					FLog::SafeEntities($comment->GetValue('name')),
					htmlspecialchars($comment->GetValue('url')),
					htmlspecialchars($comment->GetValue('email')),
					FLog::GetURL('index.php?post='.$post->rid),
					FLog::SafeEntities($post->GetValue('title')),
					FLog::GetURL('admin.php?p=manage.comments&approve='.$comment->rid),
					FLog::GetURL('admin.php?p=manage.comments&edit='.$comment->rid),
					FLog::GetURL('admin.php?p=manage.comments&delete='.$comment->rid),
					FLog::CallFilter('comment', FLog::CallMarkup($comment->GetValue('markup'), $comment->GetValue('text')))
				)
			);
		}
	}
	
	$db['pages']->Load('pages');
	$db['cats']->Load('cats');
	
	if(FLog::LoggedIn() && isset($_POST['addcomment'], $_POST['post'], $_POST['text'])){
		$comment = new FLog_DatabaseRecord();
		$comment->SetValue('post', (int)$_POST['post']);
		$comment->SetValue('name', $FLog_user->GetValue('name'));
		$comment->SetValue('email', $FLog_user->GetValue('email'));
		$comment->SetValue('url', $FLog_user->GetValue('url'));
		$comment->SetValue('markup', $FLog_config->GetValue('comments.markup')==='?'?(string)@$_POST['markup']:$FLog_config->GetValue('comments.markup'));
		$comment->SetValue('text', $_POST['text']);
		$comment->SetValue('time', FLog::ServerTime());
		$comment->SetValue('ip', $_SERVER['REMOTE_ADDR']);
		$comment->SetValue('moderated', 0);
		$_GET['msg'] = 'error.database';
		if($db['posts']->Load('posts', true) && $db['users']->Load('users', true) && $db['comments']->Load('comments', true) && isset($db['posts']->records[$pid = (int)$_POST['post']]) && $db['posts']->records[$pid]->Load('posts', $pid)){
			$db['comments']->Sort('time', SORT_DESC, 'strnatcmp');
			$post =& $db['posts']->records[$pid];
			
			if((int)$post->GetValue('draft')===1 || ((int)$post->GetValue('delay')===1 && (int)$post->GetValue('time') > FLog::ServerTime())){
				$db['comments']->Unlock();
				$db['users']->Unlock();
				$db['posts']->Unlock();
				FLog::Redirect('index.php');
			}

			$pt = $ct = (int)$post->GetValue('time');
			if(($cid = $db['comments']->FindRecord('post', $pid))>=0) $ct = max($ct, (int)$db['comments']->records[$cid]->GetValue('time'));
			if(($to = (int)$FLog_config->GetValue('comments.oldtimeout'))>0){
				if(FLog::ServerTime() - $pt >= $to * 86400) $post->SetValue('allowcomments', 0);
			}
			if(($to = (int)$FLog_config->GetValue('comments.staletimeout'))>0){
				if(FLog::ServerTime() - $ct >= $to * 86400) $post->SetValue('allowcomments', 0);
			}
			if((int)$post->GetValue('allowcomments')!==1){
				$db['comments']->Unlock();
				$db['users']->Unlock();
				$db['posts']->Unlock();
				FLog::Redirect('index.php?post='.$pid.'&msg=error.allowcomments');
			}
			elseif((int)$FLog_config->GetValue('comments.maxsize')>0 && strlen($_POST['text']) > (int)$FLog_config->GetValue('comments.maxsize')) $_GET['msg'] = 'error.maxsize';
			else{
				if((int)$FLog_config->GetValue('comments.modall')==1) $comment->SetValue('moderated', 1);
				FLog::CallAction('comment.check', &$comment);
				$db['comments']->InsertRecord($comment);
				if($db['comments']->Save()){
					if((int)$comment->GetValue('moderated')!=1){
						$post->SetValue('comments', 1+(int)$post->GetValue('comments'));
						$db['posts']->Save();
					}
					$db['posts']->Unlock();
					$db['users']->Unlock();
					
					$FLog_comments[] = $comment->rid;
					setcookie('FLogC', implode(',', $FLog_comments));

					if((int)$FLog_config->GetValue('comments.emailall')===1 || ((int)$FLog_config->GetValue('comments.emailmod')===1 && (int)$comment->GetValue('moderated')===1)){
						if(isset($db['users']->records[$uid = (int)$post->GetValue('author')]) && $db['users']->records[$uid]->Load('users', $uid) && FLog::ValidEmail($email = trim($db['users']->records[$uid]->GetValue('email')))){
							FLog_SendCommentMail($email, $comment, $post);
						}
					}
					if((int)$comment->GetValue('moderated')===1) FLog::CallAction('comment.moderated', &$comment);
					else FLog::CallAction('comment.added',&$comment);
					FLog::Redirect('index.php?post='.$pid.'&msg=message.'.((int)$comment->GetValue('moderated')==1?'moderated':'posted').'#c'.$comment->rid);
				}
			}
		}
		$db['posts']->Unlock();
		$db['users']->Unlock();
		$db['comments']->Unlock();
		FLog::CallAction('blog.begin');
		FLog::CallTheme('commentpreview', &$db, &$post, &$comment);
		FLog::CallAction('blog.end');
	}
	elseif(!FLog::LoggedIn() && isset($_POST['post'], $_POST['key'], $_POST['name'], $_POST['email'], $_POST['url'], $_POST['text'], $_POST['addcomment'])){
		$_POST['name'] = trim($_POST['name']);
		$_POST['email'] = trim($_POST['email']);
		$_POST['url'] = trim($_POST['url']);
		$comment = new FLog_DatabaseRecord();
		$comment->SetValue('post', (int)$_POST['post']);
		$comment->SetValue('name', $_POST['name']);
		$comment->SetValue('email', $_POST['email']);
		$comment->SetValue('url', $_POST['url']);
		$comment->SetValue('markup', $FLog_config->GetValue('comments.markup')==='?'?(string)@$_POST['markup']:$FLog_config->GetValue('comments.markup'));
		$comment->SetValue('text', $_POST['text']);
		$comment->SetValue('time', FLog::ServerTime());
		$comment->SetValue('ip', $_SERVER['REMOTE_ADDR']);
		$comment->SetValue('moderated', 0);
		$_GET['msg'] = 'error.database';
		if((int)$FLog_config->GetValue('comments.anonymous')!==1) FLog::Redirect('index.php?post='.(int)$_POST['post'].'&msg=error.anonymous');
		elseif((int)$FLog_config->GetValue('comments.blockip')==1 && $_POST['key'] !== md5($_SERVER['REMOTE_ADDR'])) FLog::Redirect('index.php?post='.(int)$_POST['post'].'&msg=error.ip');
		elseif((int)$FLog_config->GetValue('comments.blockreferrer')==1){
			if(!isset($_SERVER['HTTP_REFERER'])) FLog::Redirect('index.php?post='.(int)$_POST['post'].'&msg=error.referrer');
			$url = parse_url($_SERVER['HTTP_REFERER']);
			if($url['host'].dirname($url['path']) !== $_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME'])) FLog::Redirect('index.php?post='.(int)$_POST['post'].'&msg=error.referrer');
		}
		if($db['posts']->Load('posts', true) && $db['users']->Load('users', true) && $db['comments']->Load('comments', true) && isset($db['posts']->records[$pid = (int)$_POST['post']]) && $db['posts']->records[$pid]->Load('posts', $pid)){
			$db['comments']->Sort('time', SORT_DESC, 'strnatcmp');
			$post =& $db['posts']->records[$pid];

			if((int)$post->GetValue('draft')===1 || ((int)$post->GetValue('delay')===1 && (int)$post->GetValue('time') > FLog::ServerTime())){
				$db['comments']->Unlock();
				$db['users']->Unlock();
				$db['posts']->Unlock();
				FLog::Redirect('index.php');
			}

			$pt = $ct = (int)$post->GetValue('time');
			if(($cid = $db['comments']->FindRecord('post', $pid))>=0) $ct = max($ct, (int)$db['comments']->records[$cid]->GetValue('time'));
			if(($to = (int)$FLog_config->GetValue('comments.oldtimeout'))>0){
				if(FLog::ServerTime() - $pt >= $to * 86400) $post->SetValue('allowcomments', 0);
			}
			if(($to = (int)$FLog_config->GetValue('comments.staletimeout'))>0){
				if(FLog::ServerTime() - $ct >= $to * 86400) $post->SetValue('allowcomments', 0);
			}
			if((int)$post->GetValue('allowcomments')!==1){
				$db['posts']->Unlock();
				$db['comments']->Unlock();
				$db['users']->Unlock();
				FLog::Redirect('index.php?post='.$pid.'&msg=error.allowcomments');
			}
			elseif($_POST['name']==='' || !FLog::ValidEmail($_POST['email'])) $_GET['msg'] = 'error.nameemail';
			elseif((int)$FLog_config->GetValue('comments.maxsize')>0 && strlen($_POST['text']) > (int)$FLog_config->GetValue('comments.maxsize')) $_GET['msg'] = 'error.maxsize';
			else{
				if((int)$FLog_config->GetValue('comments.modall')==1) $comment->SetValue('moderated', 1);
				elseif((int)$FLog_config->GetValue('comments.modrepeat')===1){
					$comment->SetValue('moderated', 1);
					foreach(array_keys($db['comments']->records) as $key){
						if($db['comments']->records[$key]->GetValue('name') === $_POST['name'] && $db['comments']->records[$key]->GetValue('email') === $_POST['email'] && (int)$db['comments']->records[$key]->GetValue('moderated')!==1){
							$comment->SetValue('moderated', 0);
							break;
						}
					}
				}
				FLog::CallAction('comment.check', &$comment);
				$db['comments']->InsertRecord($comment);
				if($db['comments']->Save()){
					if((int)$comment->GetValue('moderated')!=1){
						$post->SetValue('comments', 1+(int)$post->GetValue('comments'));
						$db['posts']->Save();
					}
					$db['posts']->Unlock();
					$db['users']->Unlock();

					$FLog_comments[] = $comment->rid;
					setcookie('FLogC', implode(',', $FLog_comments));
					
					if((int)$FLog_config->GetValue('comments.emailall')===1 || ((int)$FLog_config->GetValue('comments.emailmod')===1 && (int)$comment->GetValue('moderated')===1)){
						if(isset($db['users']->records[$uid = (int)$post->GetValue('author')]) && $db['users']->records[$uid]->Load('users', $uid) && FLog::ValidEmail($email = trim($db['users']->records[$uid]->GetValue('email')))){
							FLog_SendCommentMail($email, $comment, $post);
						}
					}
					if((int)$comment->GetValue('moderated')===1) FLog::CallAction('comment.moderated', &$comment);
					FLog::CallAction('comment.added', &$comment);
					FLog::Redirect('index.php?post='.$pid.'&msg=message.'.((int)$comment->GetValue('moderated')==1?'moderated':'posted').'#c'.$comment->rid);
				}
			}
		}
		$db['posts']->Unlock();
		$db['users']->Unlock();
		$db['comments']->Unlock();
		FLog::CallAction('blog.begin');
		FLog::CallTheme('commentpreview', &$db, &$post, &$comment);
		FLog::CallAction('blog.end');
	}
	else{
		$db['posts']->Load('posts');
		$db['users']->Load('users');
		$db['comments']->Load('comments');
		
		if(isset($_POST['previewcomment'], $_POST['post'], $_POST['text']) && isset($db['posts']->records[$pid = (int)$_POST['post']]) && $db['posts']->records[$pid]->Load('posts', $pid)){
			$comment = new FLog_DatabaseRecord();
			$comment->SetValue('post', $pid);
			if(FLog::LoggedIn()){
				$comment->SetValue('name', $FLog_user->GetValue('name'));
				$comment->SetValue('email', $FLog_user->GetValue('email'));
				$comment->SetValue('url', $FLog_user->GetValue('url'));
			}
			else{
				$comment->SetValue('name', trim($_POST['name']));
				$comment->SetValue('email', trim($_POST['email']));
				$comment->SetValue('url', trim($_POST['url']));
			}
			$comment->SetValue('markup', $FLog_config->GetValue('comments.markup')==='?'?(string)@$_POST['markup']:$FLog_config->GetValue('comments.markup'));
			$comment->SetValue('text', $_POST['text']);
			$comment->SetValue('time', FLog::ServerTime());
			$comment->SetValue('ip', $_SERVER['REMOTE_ADDR']);
			$comment->SetValue('moderated', 0);
			FLog::CallAction('blog.begin');
			FLog::CallTheme('commentpreview', &$db, &$db['posts']->records[$pid], &$comment);
			FLog::CallAction('blog.end');
		}
		elseif(isset($_POST['post'])) FLog::Redirect('index.php?post='.(int)$_POST['post']);
		else FLog::Redirect('index.php');
	}

?>