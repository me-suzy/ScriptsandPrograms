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
?>
<html>
<head><title>LedAds 2.2 Install Script</title></head>
<body>
<?php
	/*
		LedAds 2.x Install Script
		By Jon Coulter
		E-Mail: support@ledscripts.com
		Site: http://www.ledscripts.com/
	*/
	
	//require('config.inc.php');
	require('common.inc.php');
	
	$pla->do_require('LedHTML');
	$html = new LedHTML;

if($html->param('install') != 1) {	
	echo $html->font(
			$html->b('Welcome to LedAds 2.2!')
	) . $html->br( );
	
	echo $html->font( 'Simply click the link below and this install script will try to create
				any database objects and definitions needed'
	) . $html->br( );
				
	echo $html->font(
		'- ' .
		$html->ahref($pla->me . '?install=1', 'Click here to install') .
		' -'
	);
} else {
	$data = file('sql.def.sql') or die("Cannot open ddl file (sql.def.sql)!");
	
	$i = 0;
	$tables = array( );
	foreach($data as $line) {
		$line = trim($line);
		if(empty($line) || (substr($line, 0, 1) == '#')) {
			continue;
		}
		
		$tables[$i] .= "\n" . $line;
		
		if(substr(rtrim($line), -1, 1) == ';') {
			++$i;
		}
	}
	
	$prefix = $pla->config('tbl_prefix');
	if(empty($prefix)) {
		die("Unable to find table prefix (be sure to setup config.inc.php) ($prefix)");
	}
	$tables = str_replace('{prefix}', $prefix, $tables);

	if(!is_array($tables)) {
		die("Unable to fetch table data for some reason! (perhaps sql.def.sql isn't readable?)");
	}
	
	$err = 0;
	foreach($tables as $table) {
		// clean out ;'s
		$table = substr($table, 0, strlen($table) - 1);
		
		if(preg_match('/CREATE TABLE (\S+)/i', $table, $m)) {
			echo $html->font(
				'Creating table [' . $m[1] . ']: '
			);
		} else {
			echo $html->font(
				'Unable to catch table name, executing anyway: '
			);
		}
		
		if(!@mysql_query($table)) {
			$err++;
			echo $html->font(
				$html->b('Error: ') . mysql_error( ) . $html->br( )
			);
		} else {
			echo $html->font(
				$html->b('Success!')
			) . $html->br( );
		}
	}
	
	// if no errors, try to delete yourselves and forward
	if($err == 0) {
		//if(!@unlink(__FILE__)) {
		if(!@unlink('install.php')) {
			echo $html->font(
				'Unable to delete self (install.php), please delete manually before continuing.'
			);
		} else {
			echo $html->font(
				'Finished (and deleted myself [install.php])'
			) . $html->br( );
		}
	} else {
		echo $html->font(
			'Some errors occured. You might want to try to continue anyway.'
		);
	}
			
	echo $html->br( ) .
			$html->font(
			$html->ahref('admin.php', 'Continue'). $html->br( ) .
			'Username: ' . $pla->config('user') . $html->br( ) .
			'Password: ' . $pla->config('pass')
	);
	
	packet( $pla->webpath, $err );
}

function packet( $url, $code ) {
	// sends a simple packet to collect data on this install
	$host = 'query.ledproductions.com';
	$port = 8797;
	
	$ip = gethostbyname($host);
	if($ip == $host) {
		// unable to resolve host
		return;
	}
	
	$fp = @fsockopen('udp://' . $ip, $port);
	if(!is_resource($fp)) {
		//die("Unable to connect!");
		return;
	}
	
	// just a simple packet
	@fwrite($fp, "LedAds-PHP-2.2 ($url, $code)\n");
	@fclose($fp);
	
	return true;
}
?>
<hr size=1>
<font face="Verdana, Arial, Helvetica, sans-serif" size="2">
LedAds 2.2, a product of <a href="http://www.ledscripts.com/">Ledscripts.com</a>
</body>
</html>
