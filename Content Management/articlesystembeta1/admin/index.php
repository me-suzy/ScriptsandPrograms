<?php
ob_start ("ob_gzhandler");
if ( ( !isset( $_SERVER['PHP_AUTH_USER'] )) || (!isset($_SERVER['PHP_AUTH_PW']))
|| ( $_SERVER['PHP_AUTH_USER'] != 'admin' ) || ( $_SERVER['PHP_AUTH_PW'] != 'admin' ) ) {

	header( 'WWW-Authenticate: Basic realm="Admin Area"' );
	header( 'HTTP/1.0 401 Unauthorized' );
	echo '<p>Wrong user/pass!</p>';
	exit;

}

include ("admin_header.php");

switch (@$_GET['func']){

	case 'addcat':
	include ("addcat.php");
	break;

	case 'addarticle':
	include ("addarticle.php");
	break;

	case 'settings':
	include ("settings.php");
	break;

	case 'manage':
	include ("manage.php");
	break;

	case 'css':
	include ("css.php");
	break;

	case 'glossary':
	include ("glossary.php");
	break;

	case 'links':
	include ("links.php");
	break;

	case 'templates':
	include ("templates.php");
	break;

		case 'managecats':
	include ("managecats.php");
	break;
	
	default:
	include ("home.php");
	break;
}

include ("admin_footer.php");

ob_end_flush();

?>
