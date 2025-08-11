<?php

$user_agent = $_SERVER['HTTP_USER_AGENT'];

function get_mozilla_operating_system( $user_agent )
{
	if( stristr( $user_agent, "Linux" ) )
		return "Linux/*NIX";
	if( stristr( $user_agent, "Windows NT 5.0" ) )
		return "Windows 2000";
	if( stristr( $user_agent, "Windows 2000 5.0" ) )
		return "Windows 2000";
	if( stristr( $user_agent, "Windows NT 5.1" ) )
		return "Windows XP";
	if( stristr( $user_agent, "WinNT4.0" ) )
		return "Windows NT 4.0";
	if( stristr( $user_agent, "Windows NT" ) )
		return "Windows NT 4.0";
	if( stristr( $user_agent, "Windows 98" ) )
		return "Windows 98";
	if( stristr( $user_agent, "Windows 98SE" ) )
		return "Windows 98";
	if( stristr( $user_agent, "Win98" ) )
		return "Windows 98";
	if( stristr( $user_agent, "Windows 95" ) )
		return "Windows 95";
	if( stristr( $user_agent, "Windows CE" ) )
		return "Windows CE";
	if( stristr( $user_agent, "Mac OS X" ) )
		return "Mac OS X";
	if( stristr( $user_agent, "Mac_PowerPC" ) )
		return "Macintosh";
	if( stristr( $user_agent, "FreeBSD" ) )
		return "FreeBSD";
	if( stristr( $user_agent, "SunOS" ) )
		return "Solaris";
	if( stristr( $user_agent, "X11" ) )
		return "Linux/*NIX";
	if( stristr( $user_agent, "Unix" ) )
		return "Linux/*NIX";
	if( stristr( $user_agent, "RISC OS" ) )
		return "RISC OS";
	if( stristr( $user_agent, "PalmOS" ) )
		return "PalmOS";
		
	// Some strange Netscape version
	if( stristr( $user_agent, "(WinNT; I)" ) )
		return "Windows 2000";
		
	return "Unknown";
}

if( preg_match( "/(A|a)maya\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Amaya ".$matches[2];
	$operating_system = "Unknown";
}

else if( preg_match( "/(B|b)luefish ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Bluefish ".$matches[2]." HTML Editor";
	$operating_system = "Unknown";
}

else if( preg_match( "/Camino\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Camino ".$matches[1];
	$operating_system = "MAC OS X";
}

else if( preg_match( "/Chimera\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Chimera ".$matches[1];
	$operating_system = "MAC OS X";
}

else if( preg_match( "/curl\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*) \(([A-Za-z0-9-+])\)/", $user_agent, $matches ) )
{
	$web_browser = "cURL ".$matches[1];
	if( stristr( $matches[2], "apple" ) )
		$operating_system = "MAC OS X";
	else if( stristr( $matches[2], "linux" ) )
		$operating_system = "Linux";
	if( stristr( $matches[2], "bsd" ) )
		$operating_system = "BSD";
}

else if( preg_match( "/Dillo\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Dillo ".$matches[1];
	$operating_system = "Unknown";
}

else if( preg_match( "/DocZilla\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "DocZilla ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Epiphany\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Epiphany ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Firefox\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Firefox ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Firebird\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Firebird ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Phoenix\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Phoenix ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}


else if( preg_match( "/Galeon\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Galeon ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/IBrowse\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "IBrowse ".$matches[1];

	$operating_system = "AmigaOS";
}

else if( preg_match( "/iCab\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "iCab ".$matches[1];

	if( stristr( $user_agent, "Mac OS X" ) )
		$operating_system = "Mac OS X";
	else
		$operating_system = "Macintosh";
}

else if( preg_match( "/ICE Browser\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "ICE Browser ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/K-Meleon\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "K-Meleon ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Konqueror\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Konqueror ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Links ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Links ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Lynx\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Links ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Mosaic\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Mosaic ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Netscape[6]?\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Netscape Navigator ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/OmniWeb\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "OmniWeb ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Opera\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Opera ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Opera ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Opera ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/Oregano ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Oregano ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( stristr( $user_agent, "PalmSource" ) )
{
	$web_browser = "PalmSource";

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else if( preg_match( "/HP Web PrintSmart [a-zA-Z0-9]* ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "HP Web PrintSmart ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/Safari\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Safari build ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/W3CLineMode\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "W3C Line Mode ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/WebTV\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "WebTV ".$matches[1];

	$operating_system = "WebTV";
}

else if( preg_match( "/w3m\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "w3m ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/Wget\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Wget ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/AvantGo ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "AvantGo ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/NetFront\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "NetFront ".$matches[1];

	$operating_system = "Unknown";
}

else if( preg_match( "/Xiino\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Xiino ".$matches[1];

	$operating_system = "PalmOS";
}

else if( preg_match( "/BlackBerry[0-9]*\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "BlackBerry ".$matches[1];

	$operating_system = "Telephone";
}

else if( preg_match( "/Nokia([0-9A-Za-z]*)\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Nokia Browser ".$matches[2];

	$operating_system = "Nokia ".$matches[1];
}

//-------------------------------------------------------------------------------------------------
// Check for some Netscape stuff
else if( preg_match( "/(N|n)etscape/", $user_agent, $matches ) )
{
	$web_browser = "Netscape Navigator";

	$operating_system = get_mozilla_operating_system( $user_agent );
}

//-------------------------------------------------------------------------------------------------
// Is AOL a specialised Microsoft browser?
else if( preg_match( "/AOL ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "AOL ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

//-------------------------------------------------------------------------------------------------
// Some wanna pretend to be MSIE so we move it down the list
else if( preg_match( "/MSIE ([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Internet Explorer ".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

//-------------------------------------------------------------------------------------------------
// All other browsers which could be Mozilla compatible go here
else if( preg_match( "/Mozilla\/([0-9]*\.[0-9A-Za-z+-]*\.?[0-9A-Za-z+.]*)/", $user_agent, $matches ) )
{
	$web_browser = "Mozilla Compatible v".$matches[1];

	$operating_system = get_mozilla_operating_system( $user_agent );
}

else
{
	$web_browser = "Unknown (not Mozilla compatible)";
	$operating_system = "Unknown";
}

$is_search = false;

$file = fopen( 'search_engines.txt', 'r' );
while( $line = fgets( $file ) )
{
	$line = str_replace( array( "\r", "\n" ), array( "", "" ), $line );

	$pieces = explode( '|', $line );
	
	$pieces[ 1 ] = str_replace( ".", "\\.", $pieces[ 1 ] );
	$pieces[ 1 ] = str_replace( "/", "\\/", $pieces[ 1 ] );
	$pieces[ 1 ] = str_replace( "*", ".*", $pieces[ 1 ] );
	
	if( isset( $_GET['referrer'] ) && ereg( $pieces[ 1 ], $_GET['referrer'] ) )
	{
		$is_search = true;
		$search_site = $pieces[ 0 ];
		$search_q = strstr( $_GET['referrer'], $pieces[ 2 ] );
		
		if( $search_q == false )
			$search_q = "Unknown";
			
		break;
	}
}
fclose( $file );

?>