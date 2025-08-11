<?php // $Revision: 2.0.2.9 $

/************************************************************************/
/* phpPgAds                                                             */
/* ========                                                             */
/*                                                                      */
/* Copyright (c) 2001-2005 by the phpPgAds developers                   */
/* For more information visit: http://phppgads.sourceforge.net          */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/


// Set define to prevent duplicate include
define ('LIBVIEWCACHE_INCLUDED', true);



function phpAds_cacheFetch ($name)
{
	global $phpAds_config;
	
	// Fetch the large object in a transaction
	phpAds_dbQuery("BEGIN");
	$res = phpAds_dbQuery("SELECT * FROM ".$phpAds_config['tbl_cache']." WHERE cacheid = '".$name."'");
	
	if ($row = phpAds_dbFetchArray($res))
	{
		$ret = unserialize(phpPgAds_lo_read($row['content'], false));
		phpAds_dbQuery("COMMIT");
		
		return $ret;
	}

	phpAds_dbQuery("ROLLBACK");
	return false;
}

function phpAds_cacheStore ($name, $cache)
{
	global $phpAds_config;
	
	$cache = serialize($cache);
	$cachesize = strlen($cache);

	phpAds_dbQuery("BEGIN");
	
	// Create new large object
	if (!($oid = phpPgAds_lo_create($cache, false)))
	{
		phpAds_dbQuery("ROLLBACK");
		return false;
	}

	// Lock table to prevent concurrent inserts
	if (!phpAds_dbQuery("LOCK ".$phpAds_config['tbl_cache']." IN ACCESS EXCLUSIVE MODE"))
	{
		phpAds_dbQuery("ROLLBACK");
		return false;
	}
		
	$res = phpAds_dbQuery("SELECT * FROM ".$phpAds_config['tbl_cache']." WHERE cacheid = '".$name."'");
	
	if ($row = phpAds_dbFetchArray($res))
	{
		$res = phpAds_dbQuery("
			UPDATE
				".$phpAds_config['tbl_cache']."
			SET
				content=".$oid.",
				contentsize=".$cachesize."
			WHERE
				cacheid='".$name."'");
		
		if ($res)
		{
			phpAds_dbQuery("COMMIT");
			phpPgAds_lo_unlink($row['content']);
		}
		else
		{
			phpAds_dbQuery("ROLLBACK");
			return false;
		}
	}
	else
	{
		$res = phpAds_dbQuery("
			INSERT INTO ".$phpAds_config['tbl_cache']."
				(cacheid, content, contentsize)
			VALUES
				('".$name."',".$oid.",".$cachesize.")"
			);
		
		if ($res)
			phpAds_dbQuery("COMMIT");
		else
		{
			phpAds_dbQuery("ROLLBACK");
			return false;
		}
	}

	return true;
}

function phpAds_cacheDelete ($name='')
{
	global $phpAds_config;
	
	if ($name == '')
	{
		// Empty the whole table, locking it entirely
		phpAds_dbQuery("BEGIN");
		phpAds_dbQuery("LOCK ".$phpAds_config['tbl_cache']." IN ACCESS EXCLUSIVE MODE");

		// Cache lo oids to delete them later
		$res = phpAds_dbQuery("SELECT content FROM ".$phpAds_config['tbl_cache']);

		$oids = array();
		while ($row = phpAds_dbFetchArray($res))
			$oids[] = $row['content'];
		
		if (count($oids))
		{
			phpAds_dbQuery("DELETE FROM ".$phpAds_config['tbl_cache']);
			phpAds_dbQuery("COMMIT");
			
			// Delete large objects
			foreach ($oids as $oid)
				phpPgAds_lo_unlink($oid);
		}
		else
			phpAds_dbQuery("ROLLBACK");
	}
	else
	{
		// First remove the table row, locking it
		phpAds_dbQuery("BEGIN");

		$res = phpAds_dbQuery("SELECT content FROM ".$phpAds_config['tbl_cache']." WHERE cacheid = '".$name."' FOR UPDATE");
		if ($row = phpAds_dbFetchArray($res))
			phpAds_dbQuery("DELETE FROM ".$phpAds_config['tbl_cache']." WHERE cacheid = '".$name."'");

		phpAds_dbQuery("COMMIT");
		
			
		// Then, delete old lo, if any
		if ($row)
			phpPgAds_lo_unlink($row['content']);
	}

	return true;
}


function phpAds_cacheInfo ()
{
	global $phpAds_config;
	
	$result = array();
	
	$cacheres = phpAds_dbQuery("SELECT * FROM ".$phpAds_config['tbl_cache']);
	
	while ($cacherow = phpAds_dbFetchArray($cacheres))
		$result[$cacherow['cacheid']] = $cacherow['contentsize'];
	
	return ($result);
}

?>