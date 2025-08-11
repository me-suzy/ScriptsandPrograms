<?

function date_db2ts($db)
{
	$ts=0;
	if ( ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2}) ([0-9]{2}):([0-9]{2}):([0-9]{2})", $db, $regs ) )
		$ts = mktime($regs[4],$regs[5],$regs[6],$regs[2],$regs[3],$regs[1]);
	else if ( ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})", $db, $regs ) )
		$ts = mktime(0,0,0,$regs[2],$regs[3],$regs[1]);
	return $ts;
}

function date_ts2db($ts, $trunc = FALSE)
{
	if ($trunc) return strftime("%Y-%m-%d 00:00:00",$ts);
	return strftime("%Y-%m-%d %H:%M:%S",$ts);
}

function date_db2fr($db)
{
	$fr="";
	if ( ereg( "([0-9]{4})-([0-9]{2})-([0-9]{2})", $db, $regs ) )
		$fr = "$regs[3]/$regs[2]/$regs[1]";
	if($fr=="00/00/0000")$fr="";
	return $fr;
}

function date_fr2db($fr)
{
	if ( ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $fr, $regs ) )
	{
		$a=(int)$regs[3];
		$m=(int)$regs[2];
		$j=(int)$regs[1];
		if ( checkdate($m,$j,$a) ) return sprintf("%04d-%02d-%02d 00:00:00",$a,$m,$j);
	}
	return("0000-00-00 00:00:00"); 
}

function date_checkfr($fr)
{
	if ( ereg( "([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})", $fr, $regs ) )
	{
		$a=(int)$regs[3];
		$m=(int)$regs[2];
		$j=(int)$regs[1];
		if ( checkdate($m,$j,$a) ) return TRUE;
	}
	return FALSE;
}

function heure_db2fr($db)
{
	$fr="";
	if ( ereg( "([0-9]{2}):([0-9]{2})", $db, $regs ) )
		$fr = "$regs[1]:$regs[2]";
	return $fr;
}

function heure_db2s($db)
{
	$s="";
	if ( ereg( "([0-9]{2}):([0-9]{2}):([0-9]{2})", $db, $regs ) )
		$s = $regs[1]*3600+$regs[2]*60+$regs[3];
	return $s;
}

function heure_s2db($s)
{
	return sprintf("%02d:%02d:%02d",$s/3600,($s/60)%60,$s%60);
}

function heure_fr2db($fr)
{
	if ( ereg( "([0-9]{1,2}):([0-9]{1,2})", $fr, $regs ) )
	{
		$h=(int)$regs[1];
		$m=(int)$regs[2];
		if ( $h>=0 && $h<24 && $m>=0 && $m<60 ) return sprintf("%02d:%02d:00",$h,$m);
	}
	return("00:00:00"); 
}

function heure_checkfr($fr)
{
	if ( ereg( "([0-9]{1,2}):([0-9]{1,2})", $fr, $regs ) )
	{
		$h=(int)$regs[1];
		$m=(int)$regs[2];
		if ( $h>=0 && $h<24 && $m>=0 && $m<60 ) return TRUE;
	}
	return FALSE;
}
?>
