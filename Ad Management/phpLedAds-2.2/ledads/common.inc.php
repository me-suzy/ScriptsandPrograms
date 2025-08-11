<?php
/*
 *****************************************************************
 *			       	phpLedAds 2.x
 *
 * This program is distributed as freeware. We are not
 * responsible for any damages that the program causes	
 * to your system. It may be used and modified free of 
 * charge, as long as the copyright notice
 * in the program that give me credit remain intact.
 * If you find any bugs in this program. Please feel free 
 * to report it to bugs@ledscripts.com.
 * If you have any troubles installing this program. Please feel
 * free to post a message on our Support Forum.
 * Selling this script is absolutely forbidden and illegal.
 *
 *****************************************************************
 *
 *	               COPYRIGHT NOTICE:
 *	
 *	         Copyright 2004 Jon Coulter
 *	
 *	      Author:  Jon Coulter
 *	      Web Site: http://www.ledscripts.com/
 *	      E-Mail: support@ledscripts.com
 *	      Support: http://www.ledscripts.com/
 *
 *       This program is protected by the U.S. Copyright Law
 *****************************************************************
*/

/* stop editing! */
/* Nothing in this file needs changed anymore! */

require_once(dirname(__FILE__) . '/config.inc.php');

// do some checks to make sure everything is ok
$ver = phpversion( );
if(floor($ver) < 4) {
	die("phpLedAds v2.x Requires PHP 4 (or higher)! ".
		"(Your current version is: " . $ver .")");
}

if(defined('LEDPHPADS_CONFIG')) {
	return;
} else {
	define('LEDPHPADS_CONFIG', 1);
}

// pay no attention to this line
$pla = new phpLedAds( $placonfig ); // core stuff

// put most of the stuff in this so that
// it wont interfere with other udf's
class phpLedAds // $pla == phpLedAds
{
	var $version = '2.2';
	var $_config;
	var $errstr;
	var $errno;
	var $_errno;
	var $me;
	var $authed;
	
	function phpLedAds( &$placonfig ) {
		$this->_config = &$placonfig;
		
		// gah, never did end up using many error numbers ;p
		$this->_errno = array(
					'badmkdir'	=> ++$i
				);
								
		$this->me = $_SERVER['PHP_SELF'];
		$this->path = $this->_find_path( );
		$this->webpath = (preg_match('!^https?://.*!i', $this->path) ?
						$this->path :
						'http://' . $_SERVER['HTTP_HOST'] . $this->path
				) . '/';
		$this->setup_tables( );
		
		if(is_resource($this->config('conn_handle'))) {
			$this->conn = &$this->config('conn_handle');
		}
		
		if(!is_resource($this->conn)) {
			$this->db_connect( );
		}
	}
	
	function do_require( $class ) {
		return require_once(
			_extras::catfile($this->config('libdir'), 'class.' . $class . '.php')
		);
	}
	
	function db_connect( ) {
		$this->conn = mysql_connect(
					$this->config('db_host'),
					$this->config('db_user'),
					$this->config('db_pass')
		) or $this->croak("Unable to connect to database: " . mysql_error());
						
		mysql_select_db($this->config('db_db'), $this->conn)
				or $this->croak("Unable to select db: " . mysql_error( ));
	}
	
	// this is web path, not full path!
	function _find_path( ) {
		if($this->config('web_path')) {
			return $this->config('web_path');
		}
	
		//$path = dirname($this->me);
		// we can't use the above incase this is included (so PHP_SELF wouldn't be correct)
		$path = str_replace(
				realpath(_extras::catfile($_SERVER['DOCUMENT_ROOT'])), '',
				realpath(_extras::catfile(dirname(__FILE__)))
			);
		
		return str_replace('\\', '/', $path);
	}
	
	function setup_tables( ) {
		$prefix = $this->config('tbl_prefix');
		if(empty($prefix)) {
			$prefix = 'pla';
		}
		$prefix = preg_replace('/[^a-z0-9_]/i', '', $prefix);
		
		foreach(explode(',', 'ads,impressions,richtext,images') as $table) {
			$this->tables[$table] = $prefix .'_' . $table;
		}
	}
	
	function config( $key, $val = null ) {
		if(isset($val)) {
			$this->_config[$key] = $val;
		}
		
		return $this->_config[$key];
	}
	
	function softerror( $msg = 'Unknown Error', $number = 0 ) {
		$this->errstr = $msg;
		$this->errno = $number;
		
		return false;
	}
	
	function croak( $msg, $number = 0 ) {
		$this->softerror($msg, $number);
		
		echo '<h3>Error</h3>';
		echo( ($this->errno ? '['.$this->errno.'] ' : null) . $this->errstr );
		
		echo $this->bottom( );
		
		exit;
	}

	function do_auth($user, $pass) {
		$_auth = create_function('$this', '
			header("WWW-Authenticate: Basic realm=\\"".$this->config("authname")."\\"");
			header("HTTP/1.0 401 Unauthorized");
			
			echo "Bad Username/Password.\\n";
			exit;
		');
		
		if(!isset($user)) {
			$_auth( $this );
		} else {
			if(!($user == $this->config('user')
				and $pass == $this->config('pass'))
			) {
				$_auth( $this );
			}
		}
		
		return $this->authed = true;
	}

	function top( ) {
		static $top;
		global $html;
		
		if($top++ or !$this->authed)
			return;
		
		$lines = file($this->checkfile('./top.html'));
		
		/* do some checking */
		if(is_object($html)) {
			if($html->param('disable_menu')) {
				$in = false;
				foreach($lines as $line) {
					if(!$in) {
						if(strstr($line, '<!-- MENU_START -->')) {
							$in = true;
						}
					} else {
						if(strstr($line, '<!-- MENU_END -->')) {
							$in = false;
							continue;
						}
					}
					
					if($in)
						continue;
					
					$data .= $line;
				}
			}
		}
		
		if(empty($data))
			$data = implode('', $lines);
		
		return $data;
	}
	
	function bottom( ) {
		static $bottom;
		
		if($bottom++ or !$this->authed)
			return;
		
		$data = implode('', file($this->checkfile('./bottom.html')));
		
		return $data;
	}
	
	function mkpath( $path, $perm = 0700 ) {
		foreach(preg_split("|[/\\\\]|", $path) as $key => $val) {
			$tot = _extras::catfile(array($tot, $val));
			
			if(!is_dir($tot)) {
				@mkdir($tot, $perm)
					or $this->softerror('Unable to make ' . $tot, $this->_errno['badmkdir']);
			}
		}
		
		if($this->errno == $this->_errno['badmkdir']) {
			return false;
		} else {
			return true;
		}
	}
	
	// check the path of a file
	// attempts to make it absolute if its not already
	function checkfile( $file ) {
		if(preg_match("|^\\.?[/\\\\]|", trim($file))) {
			return trim($file);
		} else {
			// assume the data dir
			return _extras::catfile(array($this->config('datadir'),
					_extras::catfile($file)));
			// notice the 2nd call to catfile -- quit cool, eh?
			// nice for writing something as if it's for one os, and have it
			// automatically convert to the current
		}
	}
}

// trying to preserve namespace
class _extras
{
	function addslashes_array ( $array ) {
		while(list($key, $val) = each($array)) {
			if(is_string($array[$key])) {
				$array[$key] = trim(addslashes($array[$key]));
			} else {
				if(is_array($array[$key])) {
					$array[$key] = addslashes_array($array[$key]);
				}
			}
		}

		return $array;
	}

	// get file paths based on our os (and fix paths to match it)
	function catfile( ) {
		static $env;

		if(!isset($env)) {
			$env = preg_match("/^Windows/i", getenv('OS')) ? 'Win32' : getenv('OS');
		}
		
		$items = func_get_args( );
		$count = count($items);
		
		if($count == 0) {
			return;
		} else {
			if($count == 1) {
				$paths = array_shift($items);
			} else {
				$paths = $items;
			}
		}

		if(is_array($paths)) {
			foreach($paths as $key => $val) {
				if(empty($val)) {
					continue;
				} else {
					$use[] = $val;
				}
			}

			$return = implode(($env == 'Win32' ? '\\' : '/'), $use);
		} else {
			$return = str_replace(($env == 'Win32' ? '/' : '\\'), ($env == 'Win32' ? '\\' : '/'), $paths);
		}

		return str_replace(array('//', '\/\/'), array('/', '\/'), $return);
	}
	
	function make_seed() {
		list($usec, $sec) = explode(' ', microtime());
		return (float) $sec + ((float) $usec * 100000);
	}
	
	function handle_upload( $field, $path ) {
		//global $HTTP_POST_FILES;
		
		$name = $_FILES[$field]['name'];
		$type = $_FILES[$field]['type'];
		$tmpname = $_FILES[$field]['tmp_name'];
		//$name = $HTTP_POST_FILES[$field]['name'];
		//$type = $HTTP_POST_FILES[$field]['type'];
		//$tmpname = $HTTP_POST_FILES[$field]['tmp_name'];

		// move the file
		$tmp_file = _extras::catfile(array($path, md5(time())));
		
		if(!is_uploaded_file($tmpname)) {
			return false;
		}
		move_uploaded_file($tmpname, $tmp_file);
		$data = fread(fopen($tmp_file, 'rb'), filesize($tmp_file));
		@unlink($tmp_file);
		
		// need to add step to fix redhat's release of 4.0.4pl1
		// ...
		
		$file = _extras::catfile(array($path, $name));
		if(file_exists($file)) {
			preg_match('/\.([^\.]+)$/', $name, $match);
			$name = time( );
			
			while( file_exists( _extras::catfile(array($path, $name . '.' . $match[1])) ) ) {
					$name++;
			}
			$name = $name . '.' . $match[1];
			$file = _extras::catfile(array($path, $name));
		}
		
		if(!($fp = @fopen($file, 'wb'))) {
			return false;
		}
		fwrite($fp, $data);
		@fclose($fp);
		
		return $name;
	}
	
	function last_insert_id( $conn ) {
		$result = mysql_query("select last_insert_id() as return", $conn);
		return mysql_result($result, 0);
	}
	
	function fix_slashes( ) {
		//global $HTTP_POST_VARS, $HTTP_GET_VARS;
		
		// fix quotes, if needed
		if(!get_magic_quotes_gpc()) {
			// add slashes
			$_POST = _extras::addslashes_array($_POST);
			reset($_POST);

			$_GET = _extras::addslashes_array($_GET);
			reset($_GET);
			//$HTTP_POST_VARS = _extras::addslashes_array($HTTP_POST_VARS);
			//	reset($HTTP_POST_VARS);
			//$HTTP_GET_VARS = _extras::addslashes_array($HTTP_GET_VARS);
			//	reset($HTTP_GET_VARS);
		}
	}
}

?>
