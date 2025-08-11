<?php
// encoding a message ready for output
function Encode($code){
	// globalise variables
	global $config, $dbprefix, $db;
	
	// should the HTML be stripped?
	if ($config["allowhtml"] == "0"){
		$code = strip_tags($code, "<hr>,<br>,<pre>");
	} elseif ($config["noformatting"] == "1"){
		return $code;
	}
	
	// ok, get the regular links out of the way
	preg_match_all("|\[\[([^\|,\]]+)([\|]?)([^\]]*)\]\]|i", $code, $matches);
	for ($i=0; $i< count($matches[0]); $i++){
		if (!stristr($matches[1][$i], "Image:")){
			// not an image, build the link with recordset
			$sql = "SELECT * FROM " . $dbprefix . "pages WHERE title = '" . dbSecure($matches[1][$i]) . "'";
			$page = $db->execute($sql);
			$extracode = ($page->rows < 1) ? " class=\"nopage\"" : "";
			
			// and work out the code
			if ($matches[2][$i]){
				$nucode = "<a href=\"" . $config["wikipage"] . "?page=" . $matches[1][$i] . "\"" . $extracode . ">" . $matches[3][$i] . "</a>";
			} else {
				$nucode = "<a href=\"" . $config["wikipage"] . "?page=" . $matches[1][$i] . "\"" . $extracode . ">" . $matches[1][$i] . "</a>";
			}
			
			// work out what is to be replaced
			$oldcode = "|" . str_replace("|", "\|", $matches[0][$i]) . "|i";
			$oldcode = str_replace("[", "\[", $oldcode);
			$oldcode = str_replace("]", "\]", $oldcode);
			
			// parse the code in - be careful with this line. Get it wrong and so long server ;)
			$code = preg_replace($oldcode, $nucode, $code);
		}
	}
	
	// begin the encoding
	$patterns = Array(
		"|\[\[Image:([^\]]*?)\|([^\]]*?)\]\]|i",
		"|\[\[Image:([^\]]*?)\]\]|i",
		"|\[([a-z,A-Z]+)://([^\|,\]]+)\|([^\]]*)\]|i",
		"|\[([a-z,A-Z]+)://([^\]]+)\]|i",
		//"|([a-z,A-Z]+)://([^\],\n, ,\r]+)|i", // automatic url encoding
		"|====(.*?)====|i",
		"|===(.*?)===|i",
		"|==(.*?)==|i",
		"|'''(.*?)'''|i",
		"|''(.*?)''|i"
	);
	
	$replacements = Array(
		"<img src=\"$1\" border=\"0\" alt=\"$2\" />",
		"<img src=\"$1\" border=\"0\" />",
		"<a href=\"\$1://\$2\" class=\"outlink\">\$3</a>",
		"<a href=\"\$1://\$2\" class=\"outlink\">\$1://\$2</a>",
		//"<a href=\"\$1://\$2\">\$1://\$2</a>",
		"<h4>$1</h4>",
		"<h3>$1</h3>",
		"<h2 id=\"$1\">$1</h2>",
		"<strong>$1</strong>",
		"<em>$1</em>"
	);
	
    ksort($patterns);
    ksort($replacements);
    $code = preg_replace($patterns, $replacements, $code);
    
    // parse in lists
    $tok2 = split("\n", $code . "\n");
    $inlist = 0; $listtype = 1; $res = "";
    foreach ($tok2 as $tok){
    	// is this line a list line?
    	if ((substr($tok, 0, 1) == "*") || (substr($tok, 0, 1) == "#")){
    		// this is a list item
    		if ($inlist == 0){
    			if (substr($tok, 0, 1) == "*"){
    				$res .= "<ul>\n";
    				$listtype = 1;
    			} else {
    				$res .= "<ol>\n";
    				$listtype = 2;
    			}
    		}
    		
    		// add the line in
    		if (substr($tok, -1) == "\r"){
    			$res .= "\t<li>" . substr(substr($tok, 0, -1), 1) . "</li>\n";
    		} else {
    			$res .= "\t<li>" . substr(substr($tok, 0), 1) . "</li>\n";
    		}
    		$inlist = 1;
    	} else {
    		// not a list item
    		if ($inlist == 1){
    			if ($listtype == 1){
    				$res .= "</ul>\n";
    			} else {
    				$res .= "</ol>\n";
    			}
    		}
    		
    		// add the line in
    		$res .= $tok . "\n";
    		$inlist = 0;
    	}
    }
    $code = $res;
    // end parsinng list items
    
    // adding new paragraphs
    $code = str_replace("\r\n\r\n", "<br /><br />\r\n\r\n", $code);
    
	return $code;
}
?>