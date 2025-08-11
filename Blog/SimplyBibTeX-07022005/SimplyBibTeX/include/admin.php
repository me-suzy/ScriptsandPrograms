<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: admin system
// Description		: implements core installation
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id: admin.php,v 1.4 2005/01/20 04:14:09 seichter Exp $
// ---------------------------------------------------------------------------

require_once('globals.php');
require_once('template.php');
require_once('property.php');

class Admin {

	function Admin()
	{		
	}

	function isInstalled() {

		global $cfg;

		/* first check if the library folder exists */
		if (file_exists($cfg['library'])) {
			/* check if index.meta exists */
			if (file_exists($cfg['config'])) {
				return TRUE;				
			}
		}
		return FALSE;
	}

	function doInstall() {

		global $cfg;

		$template = new Template($cfg['templates'].'/install.tpl');

		$output = "";		

		/* try to create a data folder */
		if (!file_exists($cfg['library'])) {
			$output .= '<b>Fresh install</b>';
			$old_umask = umask(2);
			if (!@mkdir($cfg['library'])) {
				$output .= '<br />Error: could not create '.$cfg['library'];
			} else {
				$output .= '<br />Success: created '.$cfg['library'];
			}
		} else {
			$output .= '<b>Update</b>';
		}

		/* try to create a data folder */
		if (!@touch($cfg['config'])) {
			$output .= '<br />Error: could not create '.$cfg['config'];
			
		} else {
			$output .= '<br />Success: created '.$cfg['config'];
			Property::set($cfg['config'],"default","$cfg[library]/default.bib");
		}

		/* try to create an initial database */
		if (!@touch($cfg['library'].'/default.bib')) {
			$output .= '<br />Error: could not create default bibtex file';			
		} else {
			$output .= '<br />Success: created default bibtex file';
		}

		/* next step, create a index.meta file in the folder */
		$template->set('content',$output);
		$template->run();

	}
}
?>
