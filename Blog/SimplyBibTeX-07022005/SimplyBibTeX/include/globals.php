<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: global settings for the core system
// Description		: configuration settings
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id: globals.php,v 1.11 2005/02/07 14:39:08 seichter Exp $
// 

/* credits and internal versioning */
$cfg['major'] 					= '0';
$cfg['minor'] 					= '1';
$cfg['build'] 					= '4b';

/* version */
$cfg['version'] 				= "$cfg[major].$cfg[minor].$cfg[build]";
$cfg['url'] 					= 'http://www.technotecture.com/software/SimplyBibTeX/';
$cfg['helpfile']				= 'docs/help.inc';


/* default data forlder settings */
$cfg['library']		= "data";
$cfg['cache']		= "$cfg[library]";
$cfg['templates']	= "templates";
$cfg['config']		= "$cfg[library]/index.meta";


/* change that if you do not want to include uploaded libaries */
$cfg['libraries'] = "$cfg[library]";


?>
