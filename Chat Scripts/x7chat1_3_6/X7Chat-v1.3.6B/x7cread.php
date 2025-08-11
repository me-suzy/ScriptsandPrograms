<?
	// This is a snippet of code from version 2, since our MySql based
	// live news system is no longer working we decided to include this
	// simple function from version 2.
	
	// If you don't like recieving live news, your server does not allow
	// file(); to open remote files or if your server does not have access
	// to x7chat.com or if we ever go offline, then you can change this
	// variable to 1 to disable the news getter.
	$DISABLE_NEWS_GETTER = 0;
	
	// Returns an multi-dimentional Array.  It is indexed by article number
	// which doesn't matter, and then each element contains an array indexed
	// by strings which contain the actual information.
	function get_news(){
		global $DISABLE_NEWS_GETTER;
		
		if($DISABLE_NEWS_GETTER == 1)
			return "nonews";
		
		$news = @file("http://x7chat.com/rss/x7cu.rss");
		$news = @implode("",$news);
		$news = preg_split("/<news>/",$news);
		@array_shift($news);
		$newsnum = 0;
		$return = array();
		foreach($news as $Key=>$val){
			$i++;
			$val = eregi_replace("_;","&#59",$val);
			$val = explode(";",$val);
			$return[$newsnum]['title'] = $val[0];
			$return[$newsnum]['author'] = $val[1];
			$return[$newsnum]['date'] = $val[2];
			$return[$newsnum]['icon'] = $val[3];
			$return[$newsnum]['body'] = $val[4];
			if($i > 2)
				break;
			$newsnum++;
		}
		if(count($return) == 0)
			$return = "nonews";
		
		return $return;
	}
?> 
