<?php
/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/
	require_once('database.inc.php');
	require_once('config.inc.php');
	
	$FLog_user = false;
	$FLog_actions = array();
	$FLog_filters = array();
	$FLog_markup = array();
	$FLog_basedir = '';
	$FLog_language = 'en';
	$FLog_strings = array();
	$FLog_plugins = array();
	$FLog_adminpages = array();
	$FLog_config = new FLog_Config;
	$FLog_theme = array();
	$FLog_comments = array();
	
	require_once('i18n.inc.php');

	class FLog{
		
		function Version(){
			return '1.1.2';
		}
		
		// urls -----------------------------------------------------------------
		
		function ParseQuery($query){
			$result = array();
			foreach(explode('&', (string)@$_SERVER['QUERY_STRING']) as $arg){
				if(preg_match('/^([^=]+)(?:=(.*))?$/', $arg, $matches)){
					$result[$matches[1]] = (string)@$matches[2];
				}
			}
			return $result;
		}
		
		function LimitQuery($query=''){
			if(strlen($query<=0)) $query = (string)@$_SERVER['QUERY_STRING'];
			$n = func_num_args();
			if($n<=1) return (strlen($query)>0?'?':'').$query;
			$q = FLog::ParseQuery($query);
			$query = '';
			for($i=1;$i<$n;++$i){
				if(isset($q[$a=func_get_arg($i)])) $query .= '&'.$a.'='.$q[$a];
			}
			if(strlen($query)>0) $query{0}='?';
			return $query;
		}
		
		function LimitQuerySafe(){
			$args = func_get_args();
			return htmlspecialchars(call_user_func_array(array('FLog', 'LimitQuery'), $args));
		}
		
		function AppendQuery(){
			$args = func_get_args();
			$q = call_user_func_array(array('FLog', 'LimitQuery'), $args);
			if(substr($q,0,1)==='?') $q{0}='&';
			return $q;
		}
		
		function AppendQuerySafe(){
			$args = func_get_args();
			$q = call_user_func_array(array('FLog', 'LimitQuery'), $args);
			if(substr($q,0,1)==='?') $q{0}='&';
			return htmlspecialchars($q);
		}
		
		function LocalURL($url='',$q=true){
			$protocol = $_SERVER['SERVER_PORT'] === '443' ? 'https' : 'http';
			$server = $_SERVER['HTTP_HOST'];
			$dir = str_replace("\\",'/',dirname($_SERVER['SCRIPT_NAME']));
			if(substr($dir,-1)!=='/') $dir .= '/';
			if(substr($dir,0,1)!=='/') $dir = '/'.$dir;
			if(strlen($url) <= 0){
				$url = basename($_SERVER['SCRIPT_NAME']);
				if($q and isset($_SERVER['QUERY_STRING'])) $url .= '?' . $_SERVER['QUERY_STRING'];
			}
			return $protocol . '://' . $server . $dir . $url;
		}
		
		function GetURL($url=''){
			if(strlen($url)>0 && $url{0} === '?'){
				if(strlen($url)>1 && $url{1} === '+'){
					$args=func_get_args();
					if(count($args)>1){
						array_splice($args,0,1,array(''));
						$q = call_user_func_array(array('FLog', 'LimitQuery'), $args);
						if(substr($q,0,1)==='?') return FLog::LocalURL('',false).$q.'&'.substr($url,2);
						return FLog::LocalURL('',false).'?'.substr($url,2);
					}
					return FLog::LocalURL('',false) . '?' . (isset($_SERVER['QUERY_STRING'])?($_SERVER['QUERY_STRING'].'&'):'') . substr($url,2);
				}
				if($url==='?') return FLog::LocalURL('',false);
				return FLog::LocalURL('',false) . $url;
			}
			elseif(strlen($url)<=0){
				$args=func_get_args();
				if(count($args)>1){
					array_splice($args,0,1,array(''));
					return FLog::LocalURL('',false) . call_user_func_array(array('FLog', 'LimitQuery'), $args);
				}
				return FLog::LocalURL('',false) . (isset($_SERVER['QUERY_STRING'])&&trim($_SERVER['QUERY_STRING'])!==''?('?'.$_SERVER['QUERY_STRING']):'');
			}
			return FLog::LocalURL($url);
		}
		
		function GetURLSafe(){
			$args = func_get_args();
			return htmlspecialchars(call_user_func_array(array('FLog', 'GetURL'), $args));
		}

		function Redirect($url=''){
			$args = func_get_args();
			$newurl = call_user_func_array(array('FLog', 'GetURL'), $args);
			if(headers_sent()){
				echo '<html><body><p>Redirect to <a href="', $newurl, '">', $newurl, '</a></p></body></html>';
			}
			else{
				header('HTTP/1.1 301 Moved Permanently');
				header('Location: ' . $newurl);
			}
			exit();
		}
		
		// filesystem -----------------------------------------------------------
		
		function ReadFile($filename, $split = false){
			$value = false;
			$oldabort = ignore_user_abort(true); 
			if(($f = @fopen($filename, 'rb'))!==false){
				$value = @fread($f, filesize($filename));
				@fclose($f);
			}
			ignore_user_abort($oldabort);
			if($split && $value !== false) return preg_split("/(\r\n|\r|\n)/", $value);
			return $value;
		}
		
		function WriteFile($filename, &$data){
			$value = false;
			$oldabort = ignore_user_abort(true);
			if(($f = @fopen($filename, 'wb'))!==false){
				if(is_array($data)){ if(@fwrite($f, implode("\n", $data))!==false) $value = true; }
				elseif(@fwrite($f, $data)!==false) $value = true;
				@fclose($f);
			}
			ignore_user_abort($oldabort);
			return $value;
		}
		
		function AppendFile($filename, &$data){
			$value = false;
			$oldabort = ignore_user_abort(true);
			if(($f = @fopen($filename, 'ab'))!==false){
				if(@fwrite($f, $data)!==false) $value = true;
				@fclose($f);
			}
			ignore_user_abort($oldabort);
			return $value;
		}
		
		function DeleteFile($filename){
			return @unlink($filename);
		}
		
		function CreateDirectory($dirname, $permissions=0700){
			$oldabort = ignore_user_abort(true);
			$oldmask = umask(0);
			$value = @mkdir($dirname, 0700);
			umask($oldmask);
			ignore_user_abort($oldabort);
			return $value;
		}
		
		function DeleteDirectory($dirname){
			return @rmdir($dirname);
		}
		
		function LockFile($filename){
			$lockfile = "$filename._lock";
			if(is_dir($lockfile)){
				if(time()-filemtime($lockfile)>10) FLog::DeleteDirectory($lockfile);
			}
			for($i=0; $i<20; $i++){
				if(FLog::CreateDirectory($lockfile)) return true;
				usleep(rand(9,999));
			}
			return false;
		}
		
		function UnlockFile($filename){
			return Flog::DeleteDirectory("$filename._lock");
		}
		
		// string ---------------------------------------------------------------
		
		function Newlines($data){
			return preg_replace("/\r\n|\n|\r/s", '<br />', $data);
		}
		
		function SafeURL($url){
			static $protos = array('aim', 'ftp', 'ftps', 'http', 'https', 'irc', 'mailto', 'news', 'nntp', 'telnet', 'xmpp');
			if(in_array(strtolower(substr($url, 0, (int)strpos($url, ':'))), $protos)) return $url;
			return '';
		}
		
		function ValidEmail($email){
			if(preg_match('/[A-Z\!#-\'\*\+\/-9\=\?\^-~]+(?:\.[A-Z\!#-\'\*\+\/-9\=\?\^-~]+)*@[A-Z\!#-\'\*\+\/-9\=\?\^-~]+(?:\.[A-Z\!#-\'\*\+\/-9\=\?\^-~]+)*/is', $email)) return true;
			return false;
		}
		
		function IntExplode($separator, $str){
			$a = explode($separator, $str);
			foreach($a as $key=>$value) $a[$key] = (int)$value;
			return $a;
		}
		
		function Escape($data){
			if(is_array($data)){
				foreach($data as $key=>$value) $data[$key] = FLog::Escape($value);
				return $data;
			}
			return addcslashes($data,"\n\r\t\\");
		}
		
		function Unescape($data){
			if(is_array($data)){
				foreach($data as $key=>$value) $data[$key] = FLog::Unescape($value);
				return $data;
			}
			return stripcslashes($data);
		}
		
		function DataExplode($data){
			$result = array();
			foreach(explode("\n", $data) as $e){
				$i = array_splice($a = FLog::Unescape(explode("\t", $e)),1);
				$result[$i[0]] = $a;
			}
			return $result;
		}
		
		function DataImplode($data){
			$d = array();
			foreach($d as $i=>$a){
				array_unshift($a,$i);
				$d[] = implode("\t", FLog::Escape($a));
			}
			return implode("\n", $d);
		}
			
		
		function ValidUsername($username){
			if(preg_match('/^[a-z0-9\-_]{2,16}$/', $username)) return true;
			return false;
		}
		
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

		function SafeHTML($text, $ignoretags=array(), $killtags=array(), $killatts=array(), $goodprotos=false, $badstyles=array()){
			static $tagregex = '/<(\/)?([a-z0-9_\-:]+)([^>]*?)((?(1)|\/?))>/si';
			static $attregex = '/\s+([a-z0-9_\-:]+)(=\'([^\']*)\'|="([^"]*)"|=([^\s]*))?/si';
			static $commentregex = '/<!--.*?-->/si';
			static $protoatts = array('action', 'background', 'codebase', 'dynsrc', 'href', 'lowsrc', 'src');
			$text = preg_replace($commentregex,'',$text);
			$stack = array(array('#document', '', '', array()));
			while(preg_match($tagregex, $text, $matches, PREG_OFFSET_CAPTURE)){
				if($matches[0][1] > 0) $stack[] = array('#text', 'S', substr($text, 0, $matches[0][1]), array());
				$text = substr($text, $matches[0][1] + strlen($matches[0][0]));
				$tag = array(strtolower($matches[2][0]), $matches[1][0]==='/'?'C':($matches[4][0]==='/'?'S':''), array(), array());
				if(in_array($tag[0], $ignoretags, true)) continue;
				if($tag[1]==='S' && in_array($tag[0], $killtags, true)) continue;
				while(preg_match($attregex, $matches[3][0], $matches2, PREG_OFFSET_CAPTURE)){
					if(in_array($att = strtolower($matches2[1][0]), $killatts, true)) continue;
					if(isset($matches2[2])){
						if((string)@$matches2[3][0]===''){
							if((string)@$matches2[4][0]==='') $tag[2][$att] = (string)@$matches2[5][0];
							else $tag[2][$att] = (string)@$matches2[4][0];
						}
						else $tag[2][$att] = (string)@$matches2[3][0];
					}
					else $tag[2][strtolower($matches2[1][0])] = strtolower($matches2[1][0]);
					$matches[3][0] = substr($matches[3][0], $matches2[0][1] + strlen($matches2[0][0]));
				}
				if(isset($tag[2]['style'])){
					$style = strtolower($tag[2]['style']);
					foreach($badstyles as $s){
						if(strpos($style, $s)!==false){
							unset($tag[2]['style']);
							break;
						}
					}
				}
				if(is_array($goodprotos)){
					foreach($protoatts as $a){
						if(isset($tag[2][$a]) && strpos($tag[2][$a],':')!==false){
							foreach($goodprotos as $p){
								$x = false;
								if(strncasecmp($tag[2][$a], $p.':', strlen($p)+1)===0){
									$x = true;
									break;
								}
							}
							if(!$x) unset($tag[2][$a]);
						}
					}
				}
				if($tag[1]==='C'){
					$stack2 = array();
					for($i=count($stack)-1; $i>=0; --$i){
						if($stack[$i][0]===$tag[0] && $stack[$i][1]===''){
							$stack[$i][3] = array_merge($stack[$i][3], $stack2);
							$stack[$i][1] = 'S';
							array_splice($stack, $i+1);
							break;
						}
						else{
							if($stack[$i][1]===''){
								$t = $stack[$i];
								$t[3] = array_merge($t[3], $stack2);
								$stack2 = array($t);
							}
							else array_unshift($stack2, $stack[$i]);
							$stack2[0][1] = 'S';
							if(in_array($stack2[0][0], $killtags)) array_shift($stack2);
						}
					}
				}
				else $stack[] = $tag;
			}
			
			if($text!=='') $stack[] = array('#text', 'S', $text, array());
			$stack2 = array();
			for($i=count($stack)-1; $i>=0; --$i){
				if($stack[$i][1]===''){
					$t = $stack[$i];
					$t[3] = array_merge($t[3], $stack2);
					$stack2 = array($t);
				}
				else array_unshift($stack2, $stack[$i]);
				$stack2[0][1] = 'S';
				if(in_array($stack2[0][0], $killtags)) array_shift($stack2);
			}
			Flog::SafeHTML_Recurse($stack2[0], $text = '');
			return $text;
		}
		
		function SafeHTML_Recurse(&$stack, &$text){
			static $singletags = array('area', 'base', 'basefont', 'bgsound', 'br', 'col', 'frame', 'hr', 'iframe', 'img', 'input', 'isindex', 'link', 'meta', 'wbr');
			$x = (substr($stack[0], 0, 1)!=='#');
			$s = in_array($stack[0], $singletags);
			if($stack[0]==='#text') $text .= FLog::SafeEntities($stack[2]);
			elseif($x){
				$text .= '<' . $stack[0];
				foreach($stack[2] as $key=>$value){
					$text .= ' ' . $key . '="' . FLog::SafeEntities($value) . '"';
				}
				if($s) $text .= ' />';
				else $text .= '>';
			}
			if(!$s){
				foreach(array_keys($stack[3]) as $key){
					FLog::SafeHTML_Recurse($stack[3][$key], $text);
				}
				if($x) $text .= '</' . $stack[0] . '>';
			}
		}
	
		function DecodePageIndex(&$pages){
			if(($iid = $pages->FindRecord('id', ''))>=0){
				$pages->records[$iid]->Load('pages', $iid);
				$index =& $pages->records[$iid];
			}
			else{
				$index = new FLog_DatabaseRecord;
				$index->SetValue('id', '');
				$index->SetValue('title', '[menu index]');
				$index->SetValue('markup', 0);
				$index->SetValue('text', '');
				$pages->InsertRecord($index);
			}
			$result = array();
			$lines = explode("\n", trim($index->GetValue('text')));
			foreach($lines as $line){
				if(($line = trim($line))==='') continue;
				$l = FLog::Unescape(explode("\t", $line));
				if(substr($l[0],0,1)==='S') $result[] = array('id'=>$l[0], 'type'=>'S', 'title'=>FLog::Unescape((string)@$l[1]));
				elseif(substr($l[0],0,1)==='L') $result[] = array('id'=>$l[0], 'type'=>'L', 'title'=>FLog::Unescape((string)@$l[1]), 'url'=>FLog::Unescape((string)@$l[2]));
				else{
					$p = array('id'=>$l[0], 'type'=>'P', 'title'=>FLog::Unescape((string)@$l[1]), 'pid'=>FLog::Unescape((string)@$l[2]));
					if(isset($pages->records[$pid = (int)$l[0]])){
						$p['title'] = $pages->records[$pid]->GetValue('title');
						$p['pid'] = $pages->records[$pid]->GetValue('id');
					}
					$result[] = $p;
				}
			}
			return $result;
		}
		
		function EncodePageIndex(&$pages, $newindex){
			$text = '';
			foreach($newindex as $line){
				switch($line['type']){
					case 'S': $text .= $line['id'] . "\t" . FLog::Escape($line['title']) . "\n"; break;
					case 'L': $text .= $line['id'] . "\t" . FLog::Escape($line['title']) . "\t" . FLog::Escape($line['url']) . "\n"; break;
					default:
						$text .= $line['id'] . "\t";
						if(isset($pages->records[$pid = (int)$line['id']])){
							$text .= FLog::Escape($pages->records[$pid]->GetValue('title')) . "\t";
							$text .= FLog::Escape($pages->records[$pid]->GetValue('id')) . "\n";
						}
						else{
							$text .= FLog::Escape($line['title']) . "\t";
							$text .= FLog::Escape((string)@$line['pid']) . "\n";
						}
						break;
				}
			}
			if(($iid = $pages->FindRecord('id', ''))>=0){
				$pages->records[$iid]->Load('pages', $iid);
				$pages->records[$iid]->SetValue('text', $text);
				return $iid;
			}
			else{
				$index = new FLog_DatabaseRecord;
				$index->SetValue('id', '');
				$index->SetValue('title', '[menu index]');
				$index->SetValue('markup', 0);
				$index->SetValue('text', $text);
				$pages->InsertRecord($index);
				return $index->rid;
			}
		}
		
		function FilterComment($text){
			static $ignore = array('blink', 'body', 'comment', 'form', 'frameset', 'html', 'ilayer', 'layer', 'listing', 'marquee', 'noframes', 'noscript', 'plaintext', 'xmp');
			static $kill = array('bgsound', 'applet', 'base', 'basefont', 'frame', 'head', 'iframe', 'input', 'isindex', 'link', 'meta', 'object', 'optgroup', 'option', 'param', 'script', 'select', 'style', 'textarea', 'title', 'xml');
			static $atts = array('id', 'class', 'dynsrc', 'name');
			static $protos = array('aim', 'ftp', 'ftps', 'http', 'https', 'irc', 'mailto', 'news', 'nntp', 'telnet', 'xmpp');
			static $styles = array('blink', 'behavior', 'behaviour', 'clear', 'content', 'expression', 'float', 'include-source', 'moz-binding', 'position', 'bottom', 'left', 'right', 'top');
			return FLog::SafeHTML($text, $ignore, $kill, $atts, $protos, $styles);
		}

		function FilterPost($text){
			static $ignore = array('body', 'comment', 'frameset', 'html', 'listing', 'noframes', 'plaintext', 'xmp');
			static $kill = array('base', 'basefont', 'frame', 'head', 'link', 'meta', 'style', 'title', 'xml');
			return FLog::SafeHTML($text, $ignore, $kill);
		}

		// sessions -------------------------------------------------------------
		
		function LogIn($username, $password, $remember){
			global $FLog_user;
			$users = new FLog_Database;
			$sessions = new FLog_Database;
			$abort = ignore_user_abort(true);
			if($sessions->Load('sessions', true) && $users->Load('users')){
				if(($uid = $users->FindRecord('username', $username)) >= 0 && $users->records[$uid]->GetValue('password')===md5($password) && $users->records[$uid]->Load('users', $uid)){
					if(($sid = $sessions->FindRecord('ip', md5($_SERVER['REMOTE_ADDR']))) >= 0){
						$sessions->records[$sid]->SetValue('user', $uid);
						$sessions->records[$sid]->SetValue('time', time());
						$sessions->records[$sid]->SetValue('remember', $remember?1:0);
					}
					else{
						$session = new FLog_DatabaseRecord;
						$session->SetValue('time', time());
						$session->SetValue('ip', md5($_SERVER['REMOTE_ADDR']));
						$session->SetValue('user', $uid);
						$session->SetValue('remember', $remember?1:0);
						$sessions->InsertRecord($session);
						$sid = $session->rid;
					}
					$FLog_user = $users->records[$uid];
					if($sessions->Save()){
						if($remember) setcookie('FLogID'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME'])), (string)$sid, time()+2592000);
						else setcookie('FLogID'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME'])), (string)$sid);
						FLog::CallAction('login.success', $username);
						return true;
					}
				}
			}
			$sessions->Unlock();
			ignore_user_abort($abort);
			FLog::CallAction('login.failure', $username);
			return false;
		}
						

		function LogOut(){
			global $FLog_user;
			$FLog_user = false;
			setcookie('FLogID'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME'])), false);
			$sessions = new FLog_Database();
			$abort = ignore_user_abort(true);
			if($sessions->Load('sessions', true)){
				if(($sid = $sessions->FindRecord('ip', md5($_SERVER['REMOTE_ADDR'])))>=0){
					$sessions->DeleteRecord($sid);
					$sessions->Save();
				}
				$sessions->Unlock();
			}
			ignore_user_abort($abort);
			FLog::CallAction('login.logout');
		}
		
		function LoggedIn(){
			global $FLog_user;
			return $FLog_user !== false;
		}
		
		function CheckSession(){
			global $FLog_user, $FLog_comments;
			
			$c = trim((string)@$_COOKIE['FLogC'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME']))]);
			if($c!=='') $FLog_comments = FLog::IntExplode(',',$c);
			else $FLog_comments = array();
			
			if(trim($id = (string)@$_COOKIE['FLogID'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME']))])==='') return;
			$id = (int)$id;
			
			$sessions = new FLog_Database;
			$users = new FLog_Database;
			$abort = ignore_user_abort(true);
			if($sessions->Load('sessions', true) && $users->Load('users')){
				if(rand()%10==3){
					$t = time() - 3600;
					$t2 = $t - 2588400;
					foreach(array_keys($sessions->records) as $key){
						if((int)$sessions->records[$key]->GetValue('remember')==1){
							if((int)$sessions->records[$key]->GetValue('time') < $t2) $sessions->DeleteRecord($key);
						}
						else{
							if((int)$sessions->records[$key]->GetValue('time') < $t) $sessions->DeleteRecord($key);
						}
					}
				}
				if(isset($sessions->records[$id]) && $sessions->records[$id]->GetValue('ip') === md5($_SERVER['REMOTE_ADDR'])){
					$sessions->records[$id]->SetValue('time', time());
					if(trim($sessions->records[$id]->GetValue('user'))!=='' && isset($users->records[$uid=(int)$sessions->records[$id]->GetValue('user')]) && $users->records[$uid]->Load('users', $uid)){
						$FLog_user = $users->records[$uid];
					}
					else setcookie('FLogID'.md5((string)@$_SERVER['HTTP_HOST'].dirname((string)@$_SERVER['SCRIPT_NAME'])), false);
				}
				$sessions->fields = array('time', 'user', 'ip');
				$sessions->Save();
			}
			$sessions->Unlock();
			ignore_user_abort($abort);
		}
		
		// actions --------------------------------------------------------------
		
		function RegisterAction($action, $func){
			global $FLog_actions;
			if(!isset($FLog_actions[$action])) $FLog_actions[$action] = array($func);
			else $FLog_actions[$action][] = $func;
		}
		
		function CallAction($action){
			global $FLog_actions;
			$args = func_get_args();
			array_splice($args,0,1);
			if(isset($FLog_actions[$action])){
				foreach($FLog_actions[$action] as $func){
					call_user_func_array($func, $args);
				}
			}
		}
		
		// filters --------------------------------------------------------------
		
		function RegisterFilter($filter, $func){
			global $FLog_filters;
			if(!isset($FLog_filters[$filter])) $FLog_filters[$filter] = array($func);
			else $FLog_filters[$filter][] = $func;
		}
		
		function CallFilter($filter, $data){
			global $FLog_filters;
			if(isset($FLog_filters[$filter]) && is_array($FLog_filters[$filter])){
				foreach($FLog_filters[$filter] as $func){
					$data = call_user_func($func, $data);
				}
			}
			return $data;
		}
		
		function MarkupSortCallback(&$a, &$b){
			return strnatcasecmp($a['name'], $b['name']);
		}
		
		function RegisterMarkup($markup, $name, $func){
			global $FLog_markup;
			$FLog_markup[$markup] = array('name'=>$name, 'func'=>$func);
			uasort($FLog_markup, array('FLog', 'MarkupSortCallback'));
		}
		
		function CallMarkup($markup, $data, $summary=false){
			global $FLog_markup;
			if(isset($FLog_markup[$markup])){
				return call_user_func($FLog_markup[$markup]['func'], $data, $summary);
			}
			return $data;
		}
		
		// admin pages ----------------------------------------------------------
		
		function RegisterAdminPage($menu, $title, $processfunc, $displayfunc, $maxrank=-1){
			global $FLog_adminpages, $FLog_user;
			if(!FLog::LoggedIn()) return;
			if((int)$FLog_user->GetValue('rank') > $maxrank && $maxrank > 0) return;
			$m = explode('.', $menu, 2);
			if(isset($m[1])){
				if(!isset($FLog_adminpages[$m[0]])) $FLog_adminpages[$m[0]] = array();
				$FLog_adminpages[$m[0]][$m[1]] = array('title'=>$title, 'process'=>$processfunc, 'display'=>$displayfunc);
			}
		}
		
		// internationalization -------------------------------------------------
		
		function Translate($data, $params=array()){
			global $FLog_language, $FLog_strings;
			$s = false;
			if(isset($FLog_strings[$FLog_language]) && isset($FLog_strings[$FLog_language][$data])) $s = $FLog_strings[$FLog_language][$data];
			elseif(isset($FLog_strings['en']) && isset($FLog_strings['en'][$data])) $s = $FLog_strings['en'][$data];
			if($s!==false){
				$l = strlen($s);
				$c = count($params);
				$s2 = '';
				$j = 0;
				for($i=0; $i<$l; ++$i){
					if($s[$i] === '%'){
						if($i < $l-1){
							$s2 .= substr($s, $j, $i-$j);
							if($s[$i+1] === '%') $s2 .= '%';
							elseif($s[$i+1] === '0' && isset($params[0])) $s2 .= $params[0];
							elseif($s[$i+1] === '1' && isset($params[1])) $s2 .= $params[1];
							elseif($s[$i+1] === '2' && isset($params[2])) $s2 .= $params[2];
							elseif($s[$i+1] === '3' && isset($params[3])) $s2 .= $params[3];
							elseif($s[$i+1] === '4' && isset($params[4])) $s2 .= $params[4];
							elseif($s[$i+1] === '5' && isset($params[5])) $s2 .= $params[5];
							elseif($s[$i+1] === '6' && isset($params[6])) $s2 .= $params[6];
							elseif($s[$i+1] === '7' && isset($params[7])) $s2 .= $params[7];
							elseif($s[$i+1] === '8' && isset($params[8])) $s2 .= $params[8];
							elseif($s[$i+1] === '9' && isset($params[9])) $s2 .= $params[9];
							else{ $j = $i; continue; }
							$j = (++$i) + 1;
						}
					}
				}
				return $s2 . substr($s, $j, $i-$j+1);
			}
			return '{'.$data.'}';
		}
		
		// plugins --------------------------------------------------------------
		
		function ScanPlugins(){
			global $FLog_dir_plugins;
			$result = array();
			if(($dir = @opendir($FLog_dir_plugins))!==false){
				while(($file = readdir($dir))!==false){
					$path = $FLog_dir_plugins.$file;
					if(is_file($path) && preg_match('/^([a-zA-Z0-9_\-]+)\.php$/', $file, $matches)){
						$result[$matches[1]] = array('file'=>$path);
					}
				}
				closedir($dir);
			}
			return $result;
		}
		
		function CheckPlugin($filename){
			if(($file = FLog::ReadFile($filename, true))!==false && count($file)>9){
				$firstlines = $file[0] ."\n". $file[1] ."\n". $file[2] ."\n". $file[3] ."\n". $file[4] ."\n". $file[5] ."\n". $file[6] ."\n". $file[7] ."\n". $file[8];
				if(preg_match("/^\\<\\?php\n\\/\\*\nplugin-name:([^\n]*)\nplugin-url:([^\n]*)\nplugin-version:([^\n]*)\nplugin-description:([^\n]*)\nauthor-name:([^\n]*)\nauthor-url:([^\n]*)\n\\*\\/$/s", $firstlines, $matches)){
					return array('plugin-name'=>trim($matches[1]), 'plugin-url'=>trim($matches[2]), 'plugin-version'=>trim($matches[3]), 'plugin-description'=>trim($matches[4]), 'author-name'=>trim($matches[5]), 'author-url'=>trim($matches[6]));
				}
			}
			return false;
		}
		
		function LoadPlugins($enable=array(), $disable=array()){
			global $FLog_plugins;
			$FLog_plugins = FLog::ScanPlugins();
			$pluginconfig = new FLog_Config;
			$pluginconfig->Load('plugins');
			$newconfig = new FLog_Config;
			$newconfig->cid = 'plugins';
			$rewrite = false;
			if(count($enable)>0 || count($disable)>0){
				$rewrite = true;
				foreach($enable as $key){
					$pluginconfig->SetValue($key, 1);
					FLog::CallAction('plugin.enabled', $key);
				}
				foreach($disable as $key){
					$pluginconfig->RemoveValue($key);
					FLog::CallAction('plugin.disabled', $key);
				}
			}
			foreach(array_keys($FLog_plugins) as $key){
				if(($plugin = FLog::CheckPlugin($FLog_plugins[$key]['file']))!==false){
					$FLog_plugins[$key] = array_merge($FLog_plugins[$key], $plugin);
					if((int)$pluginconfig->GetValue($key)>0){
						$FLog_plugins[$key]['enabled'] = true;
						$newconfig->SetValue($key, 1);
						include($FLog_plugins[$key]['file']);
					}
					else{
						$FLog_plugins[$key]['enabled'] = false;
						$newconfig->SetValue($key, 0);
					}
				}
				else unset($FLog_plugins[$key]);
			}
			if($rewrite){
				$newconfig->Save();
			}
		}
		
		// themes ---------------------------------------------------------------
		
		function RegisterTheme($index, $post, $post404, $page, $page404, $commentpreview, $archive, $linkarchive, $linkcats){
			global $FLog_theme;
			$FLog_theme = array(
				'index' => $index,
				'post' => $post,
				'post404' => $post404,
				'page' => $page,
				'page404' => $page404,
				'commentpreview' => $commentpreview,
				'archive' => $archive,
				'linkarchive' => $linkarchive,
				'linkcats' => $linkcats,
			);
		}

		function CheckTheme($filename){
			if(($file = FLog::ReadFile($filename, true))!==false && count($file)>9){
				$firstlines = $file[0] ."\n". $file[1] ."\n". $file[2] ."\n". $file[3] ."\n". $file[4] ."\n". $file[5] ."\n". $file[6] ."\n". $file[7] ."\n". $file[8];
				if(preg_match("/^\\<\\?php\n\\/\\*\ntheme-name:([^\n]*)\ntheme-url:([^\n]*)\ntheme-version:([^\n]*)\ntheme-description:([^\n]*)\nauthor-name:([^\n]*)\nauthor-url:([^\n]*)\n\\*\\/$/s", $firstlines, $matches)){
					return array('theme-name'=>trim($matches[1]), 'theme-url'=>trim($matches[2]), 'theme-version'=>trim($matches[3]), 'theme-description'=>trim($matches[4]), 'author-name'=>trim($matches[5]), 'author-url'=>trim($matches[6]));
				}
			}
			return false;
		}
		
		function LoadTheme(){
			global $FLog_config, $FLog_dir_themes, $FLog_theme;
			include_once($FLog_dir_themes.'!default.php');
			if(($t = FLog::CheckTheme($f = $FLog_dir_themes.preg_replace('/[^a-zA-Z0-9_\-]/', '', $FLog_config->GetValue('theme')).'.php'))!==false){
				include($f);
				return true;
			}
			return false;
		}
		
		function CallTheme($name){
			global $FLog_theme;
			$args = func_get_args();
			array_splice($args, 0, 1);
			if(isset($FLog_theme[$name])) call_user_func_array($FLog_theme[$name], $args);
			else{
				if(!headers_sent()) header('Content-type: text/html');
				echo '<html><head><title>ERROR!</title></head><body>ERROR: The theme element <em><code>',htmlspecialchars($name),'</code></em> could not be found.</body></html>';
				return false;
			}
			return true;
		}
		
		// date/time ------------------------------------------------------------
		
		function LocalTime($time=false){
			global $FLog_config;
			if($time===false) $time = time();
			return $time + (float)((float)$FLog_config->GetValue('time.offset') * 3600);
		}
		
		function ServerTime($time=false){
			global $FLog_config;
			if($time===false) return time();
			return $time - (float)((float)$FLog_config->GetValue('time.offset') * 3600);
		}
		
		function FormatTime($time=false){
			global $FLog_config;
			$format = $FLog_config->GetValue('time.timeformat')!==''?$FLog_config->GetValue('time.timeformat'):'G:i:s';
			return gmdate($format, $time===false?time():$time);
		}
		
		function FormatDate($time){
			global $FLog_config;
			$format = $FLog_config->GetValue('time.dateformat')!==''?$FLog_config->GetValue('time.dateformat'):'Y-m-d';
			return gmdate($format, $time===false?time():$time);
		}		
		
		function FormatLocalTime($time=false){
			return FLog::FormatTime(FLog::LocalTime($time));
		}
		
		function FormatLocalDate($time=false){
			return FLog::FormatDate(FLog::LocalTime($time));
		}
		
		function FormatServerTime($time=false){
			return FLog::FormatTime(FLog::ServerTime($time));
		}
		
		function FormatServerDate($time=false){
			return FLog::FormatDate(FLog::ServerTime($time));
		}
		
		// statistics -----------------------------------------------------------
		
		function GetBrowser(){
			static $browserlist = array(
				'minimo/([^\s;,\-]*)'    => 'Minimo',
				'firefox/([^\s;,\-]*)'   => 'Firefox',
				'seamonkey/([^\s;,\-]*)' => 'Seamonkey',
				'netscape/([^\s;,\-]*)'  => 'Netscape',
				'omniweb/v?([^\s;,\-]*)' => 'OmniWeb',
				'opera/([^\s;,\-]*)'     => 'Opera',
				'psp \(playstation portable\); ([^\s;,\-]*)' => 'PSP',
				'safari/([^\s;,\-]*)'    => 'Safari',
				'elinks \(([^\s;,\-]*)'  => 'ELinks',
				'links \(([^\s;,\-]*)'   => 'Links',
				'lynx/([^\s;,\-]*)'      => 'Lynx',
				'offbyone'               => 'Off By One',
				'w3m/([^\s;,\-]*)'       => 'w3m',
				'amaya/([^\s;,\-]*)'     => 'Amaya',
				'konqueror/([^\s;,\-]*)' => 'Konqueror',
				'msie ([^\s;,\-]*)'      => 'Explorer',
				'mozilla/([^\s;,\-]*)'   => 'Mozilla',
			);
			
			static $oslist = array(
				'windows nt 6.0' => 'Windows Vista',
				'windows nt 5.2' => 'Windows Server 2003',
				'windows nt 5.1' => 'Windows XP',
				'windows nt 5.0' => 'Windows 2000',
				'windows 2000'   => 'Windows 2000',
				'windows nt'     => 'Windows NT',
				'windows-nt'     => 'Windows NT',
				'windows 98; win 9x 4.90' => 'Windows ME',
				'windows me'     => 'Windows ME',
				'windows 98'     => 'Windows 98',
				'win98'          => 'Windows 98',
				'windows 95'     => 'Windows 95',
				'win95'          => 'Windows 95',
				'windows ce'     => 'Windows CE',
				'windows_ce'     => 'Windows CE',
				'windows'        => 'Windows',
				'win16'          => 'Windows',
				'win9x'          => 'Windows',
				'win32'          => 'Windows',
				'os x'	         => 'Mac OS X',
				'mac_powerpc'    => 'Mac OS X',
				'mac'	         => 'Mac OS',
				'sunos'          => 'Sun OS',
				'linux'          => 'Linux',
				'freebsd'        => 'FreeBSD',
				'openbsd'        => 'OpenBSD',
				'netbsd'         => 'NetBSD',
				'os/2'           => 'OS/2',
				'psp'            => 'PSP',
				'cygwin'         => 'Cygwin',
				'irix'           => 'IRIX',
				'risc'           => 'RISC',
				'amigaos'        => 'Amiga OS',
				'hp-ux'          => 'HP-UX',
				'palmos'         => 'Palm OS',
				'webtv'          => 'Web TV',
				'bsd'            => 'BSD',
				'unix'           => 'Unix',
			);
			
			static $botlist = array(
				'ia_archiver'   => 'Alexa',
				'ask jeeves'    => 'Ask Jeeves/Teoma',
				'teoma'         => 'Ask Jeeves/Teoma',
				'baidu'         => 'Baidu',
				'gamespy'       => 'GameSpy',
				'gigabot'       => 'Gigabot',
				'google'        => 'Googlebot',
				'slurp/si'      => 'Inktomi',
				'msnbot'        => 'MSNbot',
				'yahoo'         => 'Yahoo!',
				'pompos'        => 'Pompos',
				'curl'          => 'cURL',
				'wget'          => 'Wget',
				'grub'          => 'Grub',
				'lwp-trivial'   => 'LWP::Simple',
				'lwp::simple'   => 'LWP::Simple',
				'java'          => 'Java',
				'surveybot'     => 'SurveyBot',
				'bloglines'     => 'Bloglines',
				'w3c_validator' => 'W3C Validator',
				'psbot'         => 'Psbot',
				'becomebot'     => 'BecomeBot',
				'rss-spider'    => 'Feed Seeker Bot',
				'zyborg'        => 'Wise Nut Bot',
			);
		
			$agent = (string)@$_SERVER['HTTP_USER_AGENT'];
			if($agent === '' || $agent === 'Undefined') return array('Unknown', 'Unknown');
			foreach($botlist as $key=>$value){
				if(stristr($agent, $key)!==false) return array('bot', $value);
			}
			foreach($browserlist as $key=>$value){
				if(preg_match('@'.$key.'@si', $agent, $matches)){
					$browser = $value;
					if(($v = trim(@$matches[1]))!=='') $browser .= ' '.strtolower($v);
					foreach($oslist as $key=>$value){
						if(stristr($agent, $key)!==false) return array($value, $browser);
					}
					return array('Unknown', $browser);
				}
			}
			return array('Unknown', 'Unknown');
		}

		function RecordPageHit($type=false, $id=false){
			$stats = new FLog_Database();
			$bos = FLog::GetBrowser();
			$browser = $bos[1];
			$system = $bos[0];
			$ip = $_SERVER['REMOTE_ADDR'];
			$abort = ignore_user_abort(true);
			if($stats->Load('stats', true)){
				$stats->LoadAll();
				if(($u = $stats->FindRecord('id','users'))<0){ $users = new FLog_DatabaseRecord; $users->SetValue('id', 'users'); $stats->InsertRecord($users); $u = $users->rid; }
				if(($y = $stats->FindRecord('id','years'))<0){ $years = new FLog_DatabaseRecord; $years->SetValue('id', 'years'); $stats->InsertRecord($years); $y = $years->rid; }
				if(($m = $stats->FindRecord('id','months'))<0){ $months = new FLog_DatabaseRecord; $months->SetValue('id', 'months'); $stats->InsertRecord($months); $m = $months->rid; }
				if(($d = $stats->FindRecord('id','days'))<0){ $days = new FLog_DatabaseRecord; $days->SetValue('id', 'days'); $stats->InsertRecord($days); $d = $days->rid; }
				if(($h = $stats->FindRecord('id','hours'))<0){ $hours = new FLog_DatabaseRecord; $hours->SetValue('id', 'hours'); $stats->InsertRecord($hours); $h = $hours->rid; }
				if(($b = $stats->FindRecord('id','browsers'))<0){ $browsers = new FLog_DatabaseRecord; $browsers->SetValue('id', 'browsers'); $stats->InsertRecord($browsers); $b = $browsers->rid; }
				if(($o = $stats->FindRecord('id','os'))<0){ $os = new FLog_DatabaseRecord; $os->SetValue('id', 'os'); $stats->InsertRecord($os); $o = $os->rid; }
				if(($p = $stats->FindRecord('id','pages'))<0){ $pages = new FLog_DatabaseRecord; $pages->SetValue('id','pages'); $stats->InsertRecord($pages); $p = $pages->rid; }
				$time = time();
				$unique = false;
				$found = false;
				$del = array();
				$field = md5($ip.@$_SERVER['HTTP_USER_AGENT']);
				$total = -50;
				foreach(array_keys($stats->records[$u]->fields) as $key){
					if($key==='id') continue;
					$values = FLog::Unescape(explode("\t",$stats->records[$u]->GetValue($key)));
					// MD5 -> IP TIME OS BROWSER HITS
					if($key === $field){
						if(@$values[1] < $time - 3600) $unique = true;
						$stats->records[$u]->SetValue($key,implode("\t",FLog::Escape(array($ip, $time, $system, $browser, 1+(int)@$values[4], @$_SERVER['HTTP_USER_AGENT']))));
						$found = true;
					}
					else{
						if((int)@$values[1] < $time-3600) $del[$key] = (int)@$values[1];
					}
					++$total;
				}
				asort($del);
				foreach($del as $key=>$value){
					if(--$total<0) break;
					$stats->records[$u]->RemoveValue($key);
				}
				if(!$found){
					$stats->records[$u]->SetValue($field, implode("\t",FLog::Escape(array($ip, $time, $system, $browser, 1, @$_SERVER['HTTP_USER_AGENT']))));
					$found = $unique = true;
				}
				
				$year = gmdate('Y',$time);
				$month = gmdate('m',$time);
				$day = gmdate('d',$time);
				$hour = gmdate('H',$time);
				
				$stats->records[$y]->SetValue($year, 1+(int)$stats->records[$y]->GetValue($year));
				$stats->records[$y]->SetValue('total', 1+(int)$stats->records[$y]->GetValue('total'));
				if(@gmdate('Ym',$time) !== @gmdate('Ym',(int)$stats->records[$m]->GetValue($month.'_t'))){
					foreach(array_keys($stats->records[$m]->fields) as $key){
						$t = substr($key,-2); if($t==='_u' || $t==='_t' || $t==='id') continue;
						$time2 = (int)$stats->records[$m]->GetValue($key.'_t');
						if(((int)$key <= (int)$month && (int)@gmdate('Y',$time2) < (int)@gmdate('Y',$time)) ||  ((int)$key > (int)$day && (int)@gmdate('Y',$time2) < (int)@gmdate('m',strtotime('-1 year',$time)))){
							$stats->records[$m]->SetValue($key,0); $stats->records[$m]->SetValue($key.'_u',0); $stats->records[$m]->SetValue($key.'_t',0);
						}
					}
				}
				if(@gmdate('Ymd',$time) !== @gmdate('Ymd',(int)$stats->records[$d]->GetValue($day.'_t'))){
					foreach(array_keys($stats->records[$d]->fields) as $key){
						$t = substr($key,-2); if($t==='_u' || $t==='_t' || $t==='id') continue;
						$time2 = (int)$stats->records[$d]->GetValue($key.'_t');
						if(((int)$key <= (int)$day && (int)@gmdate('Ym',$time2) < (int)@gmdate('Ym',$time)) || ((int)$key > (int)$day && (int)@gmdate('Ym',$time2) < (int)@gmdate('Ym',strtotime('-1 month',$time)))){
							$stats->records[$d]->SetValue($key,0); $stats->records[$d]->SetValue($key.'_u',0); $stats->records[$d]->SetValue($key.'_t',0);
						}
					}
				}
				if(@gmdate('YmdH',$time) !== @gmdate('YmdH',(int)$stats->records[$h]->GetValue($hour.'_t'))){
					foreach(array_keys($stats->records[$h]->fields) as $key){
						$t = substr($key,-2); if($t==='_u' || $t==='_t' || $t==='id') continue;
						$time2 = (int)$stats->records[$h]->GetValue($key.'_t');
						if(((int)$key <= (int)$hour && (int)@gmdate('Ymd',$time2) < (int)@gmdate('Ymd',$time)) || ((int)$key > (int)$day && (int)@gmdate('Ymd',$time2) < (int)@gmdate('Ymd',strtotime('-1 month',$time)))){
							$stats->records[$h]->SetValue($key,0); $stats->records[$h]->SetValue($key.'_u',0); $stats->records[$h]->SetValue($key.'_t',0);
						}
					}
				}

				$stats->records[$m]->SetValue($month, 1+(int)$stats->records[$m]->GetValue($month));
				$stats->records[$d]->SetValue($day, 1+(int)$stats->records[$d]->GetValue($day));
				$stats->records[$h]->SetValue($hour, 1+(int)$stats->records[$h]->GetValue($hour));
				$stats->records[$y]->SetValue($year.'_t', $time);
				$stats->records[$m]->SetValue($month.'_t', $time);
				$stats->records[$d]->SetValue($day.'_t', $time);
				$stats->records[$h]->SetValue($hour.'_t', $time);
				if($unique){
					$stats->records[$b]->SetValue($browser, 1+(int)$stats->records[$b]->GetValue($browser));
					$stats->records[$o]->SetValue($system, 1+(int)$stats->records[$o]->GetValue($system));
					$stats->records[$y]->SetValue($year.'_u', 1+(int)$stats->records[$y]->GetValue($year.'_u'));
					$stats->records[$y]->SetValue('total_u', 1+(int)$stats->records[$y]->GetValue('total_u'));
					$stats->records[$m]->SetValue($month.'_u', 1+(int)$stats->records[$m]->GetValue($month.'_u'));
					$stats->records[$d]->SetValue($day.'_u', 1+(int)$stats->records[$d]->GetValue($day.'_u'));
					$stats->records[$h]->SetValue($hour.'_u', 1+(int)$stats->records[$h]->GetValue($hour.'_u'));
				}

				if($type!==false){
					$field = $type.(int)$id;
					$stats->records[$p]->SetValue($field, 1+(int)$stats->records[$p]->GetValue($field));
				}
				$stats->fields = array('id');
				$stats->Save();
			}
			ignore_user_abort($abort);
		}
		
		// misc -----------------------------------------------------------------
		
		// assumes to has been passed through FLog::ValidEmail,
		//  subject doesn't contain any illegal characters (like newlines),
		//  and message is HTML formatted.
		function SendMail($to, $subject, $message){
			if(!function_exists('mail')) return false;
			$headers = array(
				'From: FLog Mailer <FLogMailer@'.$_SERVER['HTTP_HOST'].'>',
				'X-Priority: 3',
				'X-MSMail-Priority: Normal',
				'X-Sender: FLogMailer@'.$_SERVER['HTTP_HOST'],
				'X-Mailer: FLog v'.FLog::Version(),
				'MIME-Version: 1.0',
				'Content-Type: text/html; charset=utf-8'
			);
			return @mail($to, $subject, $message, implode("\n", $headers));
		}
		
		// compare function for sorting links by status
		function LinkSort(&$a, &$b){
			$s = ((int)$a->GetValue('sticky')===1?1:0) - ((int)$b->GetValue('sticky')===1?1:0);
			if($s===0) return (int)$a->GetValue('time') - (int)$b->GetValue('time');
			return $s;
		}

	}
	
	function __($s){
		$p = array(); $n = func_num_args();
		for($i=1; $i<$n; ++$i) $p[] = func_get_arg($i);
		return FLog::Translate($s,$p);
	}
	function _e($s){
		$p = array(); $n = func_num_args();
		for($i=1; $i<$n; ++$i) $p[] = func_get_arg($i);
		echo FLog::Translate($s,$p);
	}

	if(isset($_SERVER['SCRIPT_URL']) && trim($_SERVER['SCRIPT_URL'])!=='') $_SERVER['SCRIPT_NAME'] = $_SERVER['SCRIPT_URL'];
	
	clearstatcache();
	if(get_magic_quotes_gpc()){
		foreach(array_keys($_GET) as $key) $_GET[$key] = stripslashes($_GET[$key]);
		foreach(array_keys($_POST) as $key){
			if(is_array($_POST[$key])){
				foreach(array_keys($_POST[$key]) as $key2) $_POST[$key][$key2] = stripslashes($_POST[$key][$key2]);
			}
			else $_POST[$key] = stripslashes($_POST[$key]);
		}
		foreach(array_keys($_COOKIE) as $key) $_COOKIE[$key] = stripslashes($_COOKIE[$key]);
	}
	set_magic_quotes_runtime(0);
	
	FLog::RegisterFilter('comment', array('FLog', 'FilterComment'));
	FLog::RegisterFilter('post', array('FLog', 'FilterPost'));
	FLog::RegisterFilter('page', array('FLog', 'FilterPost'));

	FLog::RegisterFilter('comment_preview', array('FLog', 'FilterComment'));
	FLog::RegisterFilter('post_preview', array('FLog', 'FilterPost'));
	FLog::RegisterFilter('page_preview', array('FLog', 'FilterPost'));
	
	FLog::RegisterMarkup('nl2br', '(X)HTML + Newlines', array('FLog', 'Newlines'));
		
	if(!headers_sent()){
		if(extension_loaded('zlib')){
			ini_set('zlib.output_compression', '1');
			ini_set('zlib.output_compression_level', '1');
		}
		else{
			@ob_start('ob_gzhandler');
		}
	}

	$FLog_config->Load('flog');
	$FLog_language = trim($FLog_config->GetValue('blog.language'));
	if($FLog_language==='') $FLog_language = 'en';
	
	
?>