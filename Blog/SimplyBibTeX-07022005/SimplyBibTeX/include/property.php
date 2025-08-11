<?php
// ---------------------------------------------------------------------------
// SimplyBibTeX - simple PHP BibTeX viewer
// ---------------------------------------------------------------------------
// Module			: save and get properties (INI styled files)
// Description		: simple ini files
// Author			: Hartmut Seichter
// License			: GPL
// CVS				: $Id: property.php,v 1.1 2005/01/18 08:58:41 seichter Exp $
// ---------------------------------------------------------------------------


class Property {

	function get($file, $key) {

		/* create if necessary */
		if (!file_exists($file)) touch($file);
		
		/* get all lines */
		$lines = file($file);
		
		/* empty? */
		if (!$lines) return FALSE;
		
		/* loop through all lines of the file */
		foreach($lines as $line) {
			$str = explode('=',trim($line));
			
			if ($str) {
				/* check for a matching key */
				if ($str[0] == $key) {
					/* remove the key and re-glue the string */
					$key = array_shift($str);

					/* write it back */
					return implode("=", $str);
				}
			}
		}		
		return FALSE;
	}

	function set($file, $key, $value) {

		/* create if necessary */
		if (!file_exists($file)) touch($file);

		/* get all lines */
		$lines = file($file);

		/* generate the new line */
		$newline = $key . '=' . $value;

		$i = 0;

		if ($lines) {
		
			/* loop through all lines of the file */
			foreach($lines as $line) {
				$str = explode('=',trim($line));
				if ($str) {
					/* check for a matching key */
					if ($str[0] == $key) {
						/* change a line */
						$lines[$i] = $newline;				
						$fp = fopen($file,'w+');
						if ($fp) {
							fwrite($fp,implode('\r\n',$lines));
							fclose($fp);										
						}
						return TRUE;
					}
				}
				$i++;
			}
			$newline = "\r\n" . $newline;
		}

		/* the key didn't exist in the file */
		$fp = fopen($file,'a+');
		if ($fp) {
			fwrite($fp, $newline);
			fclose($fp);
		}
		
	}

}





?>
