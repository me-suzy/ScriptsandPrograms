function go(url)
{
	location.href=url;
	return true;
}

function goc(url,msg)
{
	if(confirm(msg))
	{
		location.href=url;
		return true;
	}
	return false;
}


