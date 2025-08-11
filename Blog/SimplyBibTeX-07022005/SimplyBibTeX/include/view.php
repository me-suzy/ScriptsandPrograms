<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module		: viewer class
// Description	: wrapps the rendering and templating
// Author		: Hartmut Seichter
// License		: GPL
// CVS			: $Id: view.php,v 1.14 2005/01/24 06:28:45 seichter Exp $
// ---------------------------------------------------------------------------

require_once('bibtex.php');
require_once('template.php');

class View {

	function View() {}


	function get_html($title, $database, $templates, $id, $search)
	{
	
		if ($templates['viewer']->is_cached()) return $templates['viewer']->fetch();
	
		$trans = get_html_translation_table(HTML_ENTITIES);

		$encode = TRUE;

		$fallbacks = array('url'=> NULL
		);

		if (!$search)
		{
			$content = ($id == -1) ? $database->render_all($templates['content'],$encode,NULL,$trans) : 
				$database->render_id($templates['content'],$encode,$id,$trans);
		} else {
			$content = $database->render_search($templates['content'],$encode,$trans,$search);
		}

		$templates['viewer']->set("content",$content);
		$templates['viewer']->set("title",$title);

		return $templates['viewer']->fetch();
	}

	function get_rss($title, $database, $templates, $link)
	{
		if ($templates['viewer']->is_cached()) return $templates['viewer']->fetch();
		
		$fallbacks = array('url'=>$link
		);

		$encode = TRUE;
		
		$trans = get_html_translation_table(HTML_ENTITIES);

		$content = $database->render_all($templates['content'],$encode,
			$fallbacks,
			$trans);

		$templates['viewer']->set("content",$content);
		$templates['viewer']->set("title",$title);
		$templates['viewer']->set("link",$link);	

		return $templates['viewer']->fetch();
	}
}

?>
