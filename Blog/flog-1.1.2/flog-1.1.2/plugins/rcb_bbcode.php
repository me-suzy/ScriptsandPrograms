<?php
/*
plugin-name: RCBBCode
plugin-url: http://www.fluffington.com/
plugin-version: 1.03
plugin-description: RCBlog's implementation of BBCode. This is necessary to display posts and pages imported from RCBlog.
author-name: Noah Medling
author-url: http://www.fluffington.com/
*/

/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

	function rcb_blog2html($data){
		$patterns = array(
			'/</', '/>/',
			
			"@(\r\n|\r|\n)?\\[\\*\\](\r\n|\r|\n)?(.*?)(?=(\\[\\*\\])|(\\[/list\\]))@s",
			
			// [b][/b], [i][/i], [u][/u], [mono][/mono]
			"@\\[b\\](.*?)\\[/b\\]@si",
			"@\\[i\\](.*?)\\[/i\\]@si",
			"@\\[u\\](.*?)\\[/u\\]@si",
			"@\\[mono\\](.*?)\\[/mono\\]@si",
			
			// [color=][/color], [size=][/size]
			"@\\[color=([^\\]\r\n]*)\\](.*?)\\[/color\\]@si",
			"@\\[size=([0-9]+)\\](.*?)\\[/size\\]@si",
			
			// [quote=][/quote], [quote][/quote], [code][/code]
			"@\\[quote=&quot;([^\r\n]*)&quot;\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/quote\\](\r\n|\r|\n)?@si",
			"@\\[quote\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/quote\\](\r\n|\r|\n)?@si",
			"@\\[code\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/code\\](\r\n|\r|\n)?@si",
			
			// [center][/center], [right][/right], [justify][/justify]
			"@\\[center\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/center\\](\r\n|\r|\n)?@si",
			"@\\[right\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/right\\](\r\n|\r|\n)?@si",
			"@\\[justify\\](\r\n|\r|\n)?(.*?)(\r\n|\r|\n)?\\[/justify\\](\r\n|\r|\n)?@si",
			
			// [list][*][/list], [list=][*][/list]
			"@\\[list\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=1\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)a)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)A)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)i)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
			"@\\[list=(?:(?-i)I)\\](\r\n|\r|\n)*(.*?)(\r\n|\r|\n)*\\[/list\\](\r\n|\r|\n)?@si",
//			"@(\r\n|\r|\n)?\\[\\*\\](\r\n|\r|\n)?([^\\[]*)@s",
			
			// [url=][/url], [url][/url], [email][/email]
			"@\\[url=([^\\]\r\n]+)\\](.*?)\\[/url\\]@si",
			"@\\[url\\](.*?)\\[/url\\]@si",
			"@\\[urls=([^\\]\r\n]+)\\](.*?)\\[/urls\\]@si",
			"@\\[urls\\](.*?)\\[/urls\\]@si",
			"@\\[email\\](.*?)\\[/email\\]@si",
			"@\\[a=([^\\]\r\n]+)\\]@si",
			
			// [img][/img], [img=][/img], [clear]
			"@\\[img\\](.*?)\\[/img\\](\r\n|\r|\n)?@si",
			"@\\[imgl\\](.*?)\\[/imgl\\](\r\n|\r|\n)?@si",
			"@\\[imgr\\](.*?)\\[/imgr\\](\r\n|\r|\n)?@si",
			"@\\[img=([^\\]\r\n]+)\\](.*?)\\[/img\\](\r\n|\r|\n)?@si",
			"@\\[imgl=([^\\]\r\n]+)\\](.*?)\\[/imgl\\](\r\n|\r|\n)?@si",
			"@\\[imgr=([^\\]\r\n]+)\\](.*?)\\[/imgr\\](\r\n|\r|\n)?@si",
			"@\\[clear\\](\r\n|\r|\n)?@si",
			
			// [hr], \n
			"@\\[hr\\](\r\n|\r|\n)?@si",
			"@(\r\n|\r|\n)@si");
		
		$replace  = array(
			'&lt;', '&gt;',
		
			'<li>$3</li>',
			
		// [b][/b], [i][/i], [u][/u], [mono][/mono]
			'<b>$1</b>',
			'<i>$1</i>',
			'<span style="text-decoration:underline">$1</span>',
			'<span class="mono">$1</span>',
		
			// [color=][/color], [size=][/size]
			'<span style="color:$1">$2</span>',
			'<span style="font-size:$1px">$2</span>',

			// [quote][/quote], [code][/code]
			'<div class="quote"><span style="font-size:0.9em;font-style:italic">$1 wrote:<br /><br /></span>$3</div>',
			'<div class="quote">$2</div>',
			'<div class="code">$2</div>',
			
			// [center][/center], [right][/right], [justify][/justify]
			'<div style="text-align:center">$2</div>',
			'<div style="text-align:right">$2</div>',
			'<div style="text-align:justify">$2</div>',
			
			// [list][*][/list], [list=][*][/list]
			'<ul>$2</ul>',
			'<ol style="list-style-type:decimal">$2</ol>',
			'<ol style="list-style-type:lower-alpha">$2</ol>',
			'<ol style="list-style-type:upper-alpha">$2</ol>',
			'<ol style="list-style-type:lower-roman">$2</ol>',
			'<ol style="list-style-type:upper-roman">$2</ol>',
//			'<li />',
			
			// [url=][/url], [url][/url], [email][/email]
			'<a href="$1" rel="external">$2</a>',
			'<a href="$1" rel="external">$1</a>',
			'<a href="$1">$2</a>',
			'<a href="$1">$1</a>',
			'<a href="mailto:$1">$1</a>',
			'<a name="$1"></a>',
			
			// [img][/img], [img=][/img], [clear]
			'<img src="$1" alt="$1" />',
			'<img class="left" src="$1" alt="$1" />',
			'<img class="right" src="$1" alt="$1" />',
			'<img src="$1" alt="$2" title="$2" />',
			'<img class="left" src="$1" alt="$2" title="$2" />',
			'<img class="right" src="$1" alt="$2" title="$2" />',
			'<div style="clear:both"></div>',
			
			// [hr], \n
			'<hr />',
			'<br />');
		return preg_replace($patterns, $replace, $data);
	}
	
	FLog::RegisterMarkup('rcb_bbcode', 'RCBBCode', 'rcb_blog2html');

?>