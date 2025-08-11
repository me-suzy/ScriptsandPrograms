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
 *	      Web Site: http://www.ledscripts.com
 *	      E-Mail: support@ledscripts.com
 *	      Support: http://www.ledscripts.com/
 *
 *       This program is protected by the U.S. Copyright Law
 *****************************************************************
*/


if(defined('LEDPHPADS_OUTPUT')) {
	return;
} else {
	define('LEDPHPADS_OUTPUT', 1);
}

require_once(dirname(__FILE__) . '/common.inc.php');
$pla_class = new phpLedAdsOutput( $pla );

srand( _extras::make_seed() );

class phpLedAdsOutput
{
	function phpLedAdsOutput( &$pla ) {
		$this->core = &$pla;
		$this->conn = &$this->core->conn;
	}
	
	function random_key( $wanttype = false ) {
		static $total;
		
		if($this->core->config('display_unique')) {
			// reset this so its called each time
			unset($total);
		}
		
		/*
			Note:
				We could have used mysql's rand() function
				to save 1 query here, but that requires mysql version 3.23 or above...
				some people are still using 3.22 or less.
		*/
		
		// cache our count of all ads
		if(!isset($total)) {
			for($i = 0; $i < 2; $i++) {
				$sql = "select count(*) as total from "
						. $this->core->tables['ads'];

				/* have we shown any ads? */
				if($cur = $this->shown( )) {
					$sql .= " where aid not in ($cur)";
				}

				$result = mysql_query($sql, $this->conn)
						or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
				$row = mysql_fetch_object($result);
				mysql_free_result($result);

				if(($total = $row->total) == 0) {
					/* reset this and loop again */
					$this->shown(-1);
					continue;
				} else {
					break;
				}
			}
		}
		
		/* this means we couldn't find any ads */
		if($total == 0) {
			$this->core->croak("No ads found in database!");
		}
		
		$rand = rand(1, $total);
		
		// use mysql's limit atribute to get the random ad key
		$sql = "select aid, type, did from "
				. $this->core->tables['ads']
				/* don't forget to excludes shown ads */
				. ($cur ? " where aid not in ($cur)" : null)
				. " limit " . ($rand - 1) .", "
				. $total;
				
		$result = mysql_query($sql, $this->conn)
				or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		$row = mysql_fetch_object($result);
		mysql_free_result($result);
		
		if($this->core->config('display_unique')) {
			// record the ad
			$this->shown($row->aid);
		}
		
		/* return details or just the ad id? */
		return ($wanttype) ? array($row->aid, $row->type, $row->did) : $row->aid;
	}
	
	/* get the type of ad */
	function get_type( $key ) {
		static $cache;

		$key = intval($key);
		
		// cache it!
		if(isset($cache[$key])) {
			return $cache[$key];
		}
		
		$sql = "select type, did from "
			. $this->core->tables['ads']
			. " where (aid = $key)";
				
		$result = mysql_query($sql, $this->conn)
					or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		$row = mysql_fetch_object($result);
		
		return $cache[$key] = array($row->type, intval($row->did));
	}
	
	function adcode( $key = 0 ) {
		/* get a random key */
		if($key == 0) {
			list($key, $type, $did) = $this->random_key( true );
		}
		
		/* still no key? */
		if(!$key) {
			$this->core->croak("Unable to get a valid key ($key)");
		}
		
		/* if we can't get the type and data id,
		   make another call to get them 
		*/
		if(!$type or !$did) {
			list($type, $did) = $this->get_type( $key )
					or $this->core->croak("Unable to figure out the type of ($key)");
		}
		
		/* update the impression */
		$this->update_impression( $key );
		
		/* return the correct type of code now */
		if($type == 'image') {
			return $this->_image_code( $key );
		} else {
			return $this->_rich_code( $key );
		}
	}
	
	function update_impression( $key ) {
		$key = intval($key);
		$sql = "update "
			. $this->core->tables['impressions']
			. " set displays = displays + 1"
			. " where (impdate = now()) and (aid = $key)";
				
		/* execute the query */
		mysql_query($sql, $this->conn)
				or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		
		/* no rows affected, new day, new row */
		if(mysql_affected_rows($this->conn) <= 0) {
			$sql = "replace into "
				. $this->core->tables['impressions']
				. " (aid, impdate, displays, clicks)"
				. " values ($key, now(), 1, 0)";
			mysql_query($sql, $this->conn)
				or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		}
		
		return true;
	}
	
	function update_click( $key ) {
		$key = intval($key);
		$sql = "update "
			. $this->core->tables['impressions']
			. " set clicks = clicks + 1"
			. " where (impdate = now()) and (aid = $key)";
				
		mysql_query($sql, $this->conn)
				or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		if(mysql_affected_rows($this->conn) <= 0) {
			$sql = "replace into "
				. $this->core->tables['impressions']
				. " (aid, impdate, displays, clicks)"
				. " values ($key, now(), 0, 1)";
			mysql_query($sql, $this->conn) or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		}
		
		return true;
	}
	
	function redirect( $key ) {
		$key = intval($key);
		
		list($type, $did) = $this->get_type($key);
		
		$sql = "select url from "
			. $this->core->tables['images']
			. " where (did = $did)";
				
		$result = mysql_query($sql, $this->conn) or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		$row = mysql_fetch_object($result);
		
		/* redirect them */
		return $this->location( $row->url );
	}
	
	function location( $url ) {
		header("Location: " . $url);
		exit;
	}
	
	function _image_code( $key ) {
		$aid = intval($key);
		list($type, $key) = $this->get_type($aid);
		$sql = "select * from "
				. $this->core->tables['images']
				. " where (did = $key)";
				
		$result = mysql_query($sql, $this->conn)
						or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
		
		if(mysql_num_rows($result) <= 0) {
			$this->core->croak("No rows returned for image (from images table)!");
		} else {
			$row = mysql_fetch_object($result);
			
			$path = $this->core->config('usefullpath') ?
						$this->core->webpath :
						$this->core->path .'/';
			
			$click = $path . 'click.php';
			return $this->_head( ) .
					'<a href="' . $click . '?key=' . $aid . '" target="' . $row->target .'">'
					. '<img src="' 
					. $row->image_url . '"'
					. ' width="' . $row->width . '"'
					. ' height="' . $row->height . '"'
					. ' alt="' . htmlentities($row->alt_text) . '"'
					. ' border="0"></a>'
					. $this->_foot( );
		}
	}
	
	function _rich_code( $key ) {
		$rkey = $key;
		list($type, $key) = $this->get_type(intval($key));
		$sql = "select * from "
			. $this->core->tables['richtext']
			. " where (did = " . $key  . ")";
		
		$result = mysql_query($sql, $this->conn)
						or $this->core->croak("Mysql Error: ($sql) " . mysql_error());
						
		if(mysql_num_rows($result) <= 0) {
			$this->core->croak("No Rows returend for rich text ad (from rich text table)! (ID: $key)");
		} else {
			$row = mysql_fetch_object($result);
			
			return $this->_head( ) .
				str_replace(array('[random]', '[key]'),
					array(
						preg_replace('/[^0-9]/', '', uniqid(rand(1, (getrandmax() - 100)))),
						$rkey
					), $row->data)
				. $this->_foot( );
		}
	}
	
	/* our stuff */ 
	function _head( ) {
		return sprintf(
			'<!-- Generated by LedAds V%s -- http://www.ledscripts.com -->',
			$this->core->version
		);
	}
	
	function _foot( ) {
		return $this->_head( );
	}
	
	// added for 2nd release to track which ads have displayed
	function shown( $key = null ) {
		$note = 'ledads_shownkeys';
		
		if(isset($key)) {
			if($key == -1) {
				// reset
				return $this->note($note, '');
			} else {
				$cur = $this->note($note);
				
				if($cur) $cur .= ',';
				$cur .= $key;
				
				$this->note($note, $cur);
				
				return $cur;
			}
		} else {
			return $this->note($note);
		}
	}
	
	// added for 2nd release
	// wrapper around apache_note
	function note( $key, $val = null ) {
		if($this->core->config('extern_unique')) {
			// boo
			// store it on the file system
			return $this->fnote( $key, $val );
		}
		if(function_exists("apache_note")) {
			$ret = apache_note($key);
			
			if(isset($val)) {
				apache_note($key, $val);
			}
			
			return $ret;
		} else {
			// internal work around
			$ret = $this->_notes[$key];
			
			if(isset($val)) {
				$this->_notes[$key] = $val;
			}
			
			return $ret;
		}
	}
	
	// overhead city
	function fnote( $key, $val ) {
		$dir = $this->core->config('datadir');
		$life = intval( $this->core->config('unique_life') );
		$prefix = 'exterm_unique-';
		$time = time( );
		
		/* set a default life if none set */
		if($life <= 0) {
			$life = 10;
		}
		
		// nada
		if(!is_dir($dir)) return;
		
		$timer = _extras::catfile(array($dir, $prefix.'timer'));
		
		// clean how every 5 min
		/* this doesn't even try to execute except every 5 mintues
		   so this will save a tiny bit of overhead
		*/
		if($t = @filemtime($timer)) {
			// give 'expired' cache's a 5 min life
			if($t < ($time - 900)) {
				// clean out stuff
				if($fp = opendir($dir)) {
					while($f = readdir($fp)) {
						if(substr($f, 0, strlen($prefix)) == $prefix) {
							$file = _extras::catfile(array($dir, $f));
							if(filemtime($file) < ($time - $life)) {
								@unlink($file);
							}
						}
					}
				
					closedir($fp);
				}
				
				touch($timer) or die("Could not modify timer: $timer");
			}
		} else {
			/* create the timer */
			touch($timer) or die("Could not modify timer ($timer)");
		}
		
		$file = _extras::catfile(array(
				$dir,
				$prefix . str_replace('.', '-', getenv('REMOTE_ADDR'))
			)
		);
		
		if(file_exists($file)) {
			// give it a '$life'-second life
			if(filemtime($file) < ($time - $life)) {
				@unlink($file);
			}
		}
		
		/* get/set values now */
		$ret = @implode('', @file($file));

		if(isset($val)) {
			fwrite(fopen($file, 'w'), $val);
		}

		return $ret;
	}
}

?>
