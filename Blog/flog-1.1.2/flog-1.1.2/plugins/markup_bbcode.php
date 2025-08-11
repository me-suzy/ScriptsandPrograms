<?php
/*
plugin-name: BBCode
plugin-url: http://www.fluffington.com/
plugin-version: 1.1.1
plugin-description: BBCode Plugin for FLog
author-name: Noah Medling
author-url: http://www.fluffington.com/
*/

/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	function plugin_bbcode_parse($data){
		static $regex = array(
			'/</'                                             => '&lt;',
			'/>/'                                             => '&gt;',
			'/\[b\](.*?)\[\/b\]/s'                            => '<b>\1</b>',
			'/\[i\](.*?)\[\/i\]/s'                            => '<i>\1</i>',
			'/\[u\](.*?)\[\/u\]/s'                            => '<u>\1</u>',
			'/\[color=([^"<>;\n\r]*?)\](.*?)\[\/color\]/s'    => '<span style="color:\1;">\2</span>',
			'/\[size=([^"<>;\n\r]*?)\](.*?)\[\/size\]/s'      => '<span style="font-size:\1;">\2</span>',
			'/\[font=([^"<>;\n\r]*?)\](.*?)\[\/font\]/s'      => '<span style="font-family:\1;">\2</span>',
			'/\[code\](.*?)\[\/code\]/s'                      => '<div class="bb_code">\1</div>',
			'/\[email\](.*?)\[\/email\]/'                     => '<a href="mailto:\1" class="bb_email">\1</a>',
			'/\[email=([^"<>;\n\r]*?)\](.*?)\[\/email\]/s'    => '<a href="mailto:\1" class="bb_email">\2</a>',
			'/\[url\]([^"<>;\n\r]*?)\[\/url\]/'               => '<a href="\1" class="bb_url">\1</a>',
			'/\[url=([^"<>;\n\r]*?)\](.*?)\[\/url\]/s'        => '<a href="\1" class="bb_url">\2</a>',
			'/\[img\]([^"<>;\n\r]*?)\[\/img\]/s'              => '<img src="\1" />',
			'/\[quote\](.*?)\[\/quote\]/s'                    => '<div class="bb_quote">Quote:<div class="bb_quotebody">\1</div></div>',
			'/\[quote=(&quot;|")?(.*?)\1\](.*?)\[\/quote\]/s' => '<div class="bb_quote">\2 wrote:<div class="bb_quotebody">\3</div></div>',
			'/\[\*\]\s*([^\[]*)/s'                            => '<li class="bb_listitem">\1</li>',
			'/\[list\](.*?)\[\/list\]/s'                      => '<ul class="bb_list">\1</ul>',
			'/\[list=1\](.*?)\[\/list\]/s'                    => '<ol class="bb_list" style="list-style-type:decimal;">\1</ol>',
			'/\[list=i\](.*?)\[\/list\]/s'                    => '<ol class="bb_list" style="list-style-type:lower-roman;">\1</ol>',
			'/\[list=I\](.*?)\[\/list\]/s'                    => '<ol class="bb_list" style="list-style-type:upper-roman;">\1</ol>',
			'/\[list=a\](.*?)\[\/list\]/s'                    => '<ol class="bb_list" style="list-style-type:lower-alpha;">\1</ol>',
			'/\[list=A\](.*?)\[\/list\]/s'                    => '<ol class="bb_list" style="list-style-type:upper-alpha;">\1</ol>',
			'/<ol(.*?)>(?:.*?)<li(.*?)>/s'                    => '<ol\\1><li\\2>',
			'/<ul(.*?)>(?:.*?)<li(.*?)>/s'                    => '<ul\\1><li\\2>',
			'/(?:\r\n|\n|\r)/s'                               => '<br />',
		);
		return preg_replace(array_keys($regex), array_values($regex), $data);
	}

	FLog::RegisterMarkup('bbcode', 'BBCode', 'plugin_bbcode_parse');
	
?>