<?php 
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: example for the interface
// Description		: implements a very simple viewer interface
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id: index.php,v 1.27 2005/02/07 14:35:46 seichter Exp $
// ---------------------------------------------------------------------------


require_once('include/bibtex.php');
require_once('include/view.php');
require_once('include/globals.php');
require_once('include/admin.php');
require_once('include/functions.php');

$admin = new Admin();

$cache_extension = $_SERVER['REQUEST_URI'];

if (!$admin->isInstalled()) {

	$admin->doInstall();
} else {

/* generates a form to change the BibTeX file */
function get_file_form($current)
{
	global $cfg;

	$menu  = '<form id="filelist" name="filelist" action="'.$_SERVER['PHP_SELF'].'" method="get">';
	$menu .= '<select class="formitem" name="db" size="1" onchange="javascript:document.filelist.submit();">';

	$directory = $cfg['library'];

	foreach (glob_func("$cfg[library]",".bib") as $file) {
	
		$sel_html = ($file == $current) ? 'selected="selected"' : '';				
		$menu .= '<option value="' . $file . '" ' . $sel_html . '>' . $file . '</option>'; 
		
	} // foreach
	
	$menu .= '</select></form>';	
	return $menu;
}

/* generate an upload form */
function get_upload_form()
{
	$form  = '<form action="include/commit.php" method="post" enctype="multipart/form-data">';
	$form .= '<input type="file" name="userfile" size="40" />';
	$form .= '<input type="hidden" name="command" value="upload"/>';
	$form .= '<input type="submit" value="Upload" />';
	$form .= '</form>';
	
	return $form;
}


/* get the meta */
function get_meta($file) {

	$metafile = $file . '.meta';
	$meta = (file_exists($metafile)) ? implode(file($metafile)) : "";
	return $meta;
}

/* generate an meta information form */
function get_meta_form($file)
{
	$form  = '<form action="include/commit.php" method="post">';
	$form .= '<textarea rows="20" cols="60" name="meta">' . get_meta($file) . '</textarea>';
	$form .= '<input type="hidden" name="command" value="add_item"/><br />';
	$form .= '<input type="hidden" name="db" value="' . $file . '"/>';
	$form .= '<input type="submit" value="commit" />';
	$form .= '<input type="reset" value="reset" />';
	$form .= '</form>';
	
	return $form;
}

/* generate an upload form */
function get_item_form($file)
{

	$form  = '<form action="include/commit.php" method="post">';
	$form .= '<textarea rows="20" cols="60" name="item"></textarea>';
	$form .= '<input type="hidden" name="command" value="add_item"/><br />';
	$form .= '<input type="hidden" name="db" value="' . $file . '"/>';
	$form .= '<input type="submit" value="commit" />';
	$form .= '<input type="reset" value="reset" />';
	$form .= '</form>';
	
	return $form;
}



/* return the help file */
function get_help() {

	global $cfg;
	$help = (file_exists($cfg['helpfile'])) ? implode('<br/>',file($cfg['helpfile'])) : "Help not installed!";
	return $help;
}

/* generate an upload form */
function get_bibtex_form()
{
	$meta = "";
	$form  = '<form action="include.php" method="post">';
	$form .= '<textarea rows="20" cols="70">' . $meta . '</textarea>';
	$form .= '<input type="hidden" name="command" value="commit"/><br />';
	$form .= '<input type="submit" value="commit" />';
	$form .= '<input type="reset" value="reset" />';
	$form .= '</form>';
	
	return $form;
}



/* generates the internal help */
function get_search_form($current)
{
	$string = "";
	$form  = '<form action="'.$_SERVER['PHP_SELF'].'" method="get">';
	$form .= '<input type="hidden" name="db" value="'.$current.'"/>';
	$form .= '<input type="text" name="find" size="40" maxlength="200" value="'.$string.'"/>';
	$form .= '<input type="submit" value="Go" />';
	$form .= '</form>';
	
	return $form;	
}

/* generates a link to the RSS feed of the current database */
function get_rss_link($directory,$current)
{
	return $_SERVER['PHP_SELF'].'?feed=rss2&amp;db='.$current;
};

/* generates a link to the Atom feed of the current database */
function get_atom_link($directory,$current)
{	
	return $_SERVER['PHP_SELF'].'?feed=atom&amp;db='.$current;
};

/* generates the current possition of the script on the server */
function get_link($current)
{
	$trans = get_html_translation_table(HTML_ENTITIES);
	$urls = explode('?','http://'.strtr($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'],$trans));

	return $urls[0];
}

/* get the internal configuration */
global $cfg;

/* check if we been asked to render a feed */
$feed = get_get('feed',NULL);

/* check if we been asked to render a PDF */
$pdf = get_get('pdf',NULL);

$templates = array();

$output = '';

$file = get_post('db',NULL);

if (!$file)
	$file = get_get('db',Property::get($cfg['config'],'default'));

/* if the request does not ask for a feed it renders XHTML  */
if (!$feed & !$pdf)
{

	$id = get_get('id',-1);
		
	$file = stripslashes($file);
	
	$search = get_get('find',NULL);
	
	$bib = new BibTeX($file);
	$bib->parse();

	/* load the HTML templates */
	$templates['viewer'] = new Template('templates/viewer.tpl',
		$cfg['cache'],
		$cache_extension);

	$templates['content'] = new Template('templates/simple.tpl',
		$cfg['cache'],
		$cache_extension);


	/* set up internal links */
	$templates['viewer']->set('baselink',get_link($file));
	$templates['content']->set('link',get_link($file));
	$templates['content']->set('db',$file);
	$templates['viewer']->set('file',$file);

	/* time */
	$templates['viewer']->set('time',date("r", time())); 
	$templates['viewer']->set('dbtime',date("r", filemtime($file))); 
	$templates['content']->set('dbtime',date("r", filemtime($file))); 

	$templates['viewer']->set('rss2',get_rss_link('bibs',$file));
	$templates['viewer']->set('atom',get_atom_link('bibs',$file));

	/* set all the forms */
	$templates['viewer']->set('form_select',get_file_form($file));
	$templates['viewer']->set('form_upload',get_upload_form());
	$templates['viewer']->set('form_meta',get_meta_form($file));
	$templates['viewer']->set('form_search',get_search_form($file));
	$templates['viewer']->set('form_additem',get_item_form($file));

	/* set SimplyBibTeX strings */
	$templates['viewer']->set('sbx_version',$cfg['version']);
	// $templates['viewer']->set('sbx_copy',$cfg['copy']);
	$templates['viewer']->set('sbx_help',get_help());


	$viewer = new View();


	$output = $viewer->get_html('BibTeX Viewer '.$file,$bib,$templates,$id, $search);

	

} elseif ($feed && !$pdf) {

	$file = $_GET['db'];

	$bib = new BibTeX($file);
	$bib->parse();

	/* if we send a feed, it is definitly XML encoded */	
	$output .= "<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>\n";
	
	/* check if requested feed is RSS 2.0 */
	if ($feed == 'rss2')
	{
		/* load the RSS templates */
		$templates['viewer'] = new Template('templates/rss_viewer.tpl',
			$cfg['cache'],
			$cache_extension);
		$templates['content'] = new Template('templates/rss_item.tpl',
			$cfg['cache'],
			$cache_extension);
		
		/* RSS needs to be send with a proper HTTP header */
		header('Content-Type: text/xml');

	/* or if it is Atom */
	} elseif ($feed == 'atom') {
		
		/* load the Atom templates */
		$templates['viewer'] = new Template('templates/atom_viewer.tpl',
			$cfg['cache'],
			$cache_extension);
		$templates['content'] = new Template('templates/atom_item.tpl',
			$cfg['cache'],
			$cache_extension);

		/* Atom needs to be send with this content type */
		header('Content-Type: application/xml');
	};

	/* set SimplyBibTeX strings */
	$templates['viewer']->set('sbx_version',$cfg['version']);
	// $templates['viewer']->set('sbx_copy',$cfg['copy']);


	/* set up internal links */
	$templates['viewer']->set('baselink',get_link($file));
	$templates['content']->set('link',get_link($file));
	$templates['content']->set('db',$file);

	/* set up time for the database and the core system */
	$templates['viewer']->set('time',date("r", time())); 
	$templates['viewer']->set('dbtime',date("r", filemtime($file))); 
	$templates['content']->set('dbtime',date("r", filemtime($file))); 

	/* create a viewer */
	$viewer = new View();

	/* generate the feed output through the templates */
	$output .= $viewer->get_rss('BibTeX Viewer '.$file,$bib,$templates,$_SERVER['PHP_SELF']);
	
	/* let the client know how many bytes we gonna send */
	header('Content-Length: ' . strlen($output));
	
} elseif ($pdf == '1')
{
	/* TODO implement that */		
} else
{
	/* TODO: render a error message? HTML is the base */
};

/* output the rendered content */
echo $output;

} // is installed

?>
