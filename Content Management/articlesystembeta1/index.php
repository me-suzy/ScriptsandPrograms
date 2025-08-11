<?php
error_reporting(E_ALL);

ob_start ("ob_gzhandler");

include_once ('db.php');
include_once ('header.php');


switch (@$_GET['func']){

	case 'cat':
	include_once ('cat.php');
	break;


	case 'article':
	include_once ('article.php');
	break;

	//case 'contact':
	//include_once ("contact.php");
	//break;

	case 'stats':
	include_once ('stats.php');
	break;

	case 'glossary':
	include_once ('glossary.php');
	break;

	case 'rules':
	include_once ('rules.php');
	break;

	default:
	include_once ('home.php');
	break;
}

include_once ('footer.php');

?>
