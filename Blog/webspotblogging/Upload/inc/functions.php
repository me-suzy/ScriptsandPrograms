<?php
/**
* WebspotBlogging
* Copyright 2005
*
* Website : http://blogging.webspot.co.uk/
* Licence : http://blogging.webspot.co.uk/eula.php
*
**/
function parse($string){
$string = strip_tags($string);
$string = str_replace("\n", "<BR>", $string);
$patterns[0] = "|\[b\](.*?)\[/b\]|s";
$patterns[1] = "|\[i\](.*?)\[/i\]|s";
$patterns[2] = "|\[u\](.*?)\[/u\]|s";
$patterns[3] = "|\[center\](.*?)\[/center\]|s";
$patterns[4] = "|\[url\](.*?)\[/url\]|s";
$patterns[5] = "|\[url=(.*?)\](.*?)\[/url\]|s";
$patterns[6] = "|\[img\](http://.*?)\[/img\]|s";
$replacements[0] = "<b>\$1</b>";
$replacements[1] = "<i>\$1</i>";
$replacements[2] = "<u>\$1</u>";
$replacements[3] = "<div align=\"center\">\$1</div>";
$replacements[4] = "<a href=\"\$1\" target=\"_blank\">\$1</a>";
$replacements[5] = "<a href=\"\$1\" target=\"_blank\">\$2</a>";
$replacements[6] = "<br /><img src=\"\$1\"><br />";
$string = preg_replace($patterns, $replacements, $string);
return $string;
}
?>