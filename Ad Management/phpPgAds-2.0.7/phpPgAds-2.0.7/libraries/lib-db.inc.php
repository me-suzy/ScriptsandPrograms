<?php // $Revision: 2.0.2.10 $

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



// PostgreSQL DB Resource and Result Counters
$phpAds_db_link = '';
$phpPgAds_db_cache = array();
$phpPgAds_last_result = '';



/*********************************************************/
/* Check if the extension is available                   */
/*********************************************************/

function phpAds_dbAvailable()
{
	return (function_exists('pg_connect'));
}


/*********************************************************/
/* Open a connection to the database                     */
/*********************************************************/

function phpAds_dbConnect()
{
	global $phpAds_config;
	global $phpAds_db_link;
	
	if ($phpAds_db_link)
		return $phpAds_db_link;
	
	if (!isset($phpAds_config['dblocal'])) $phpAds_config['dblocal'] = $phpAds_config['dbhost'] == '';
	if (!isset($phpAds_config['dbport'])) $phpAds_config['dbport'] = 5432;
	
	$conn_str = '';
	
	if (!$phpAds_config['dblocal'] && $phpAds_config['dbhost'])
	{
		$conn_str .= 'host='.$phpAds_config['dbhost'].' ';
		if ($phpAds_config['dbport'] != 5432)
			$conn_str .= 'port='.$phpAds_config['dbport'].' ';
	}
	
	$conn_str .= 'dbname='.$phpAds_config['dbname'].' user='.$phpAds_config['dbuser'].
		(empty($phpAds_config['dbpassword']) ? '' : ' password='.$phpAds_config['dbpassword']);
	
	if ($phpAds_config['persistent_connections'])
		$phpAds_db_link = @pg_pconnect($conn_str);
	else
		$phpAds_db_link = @pg_connect($conn_str);
	
	return $phpAds_db_link;
}



/*********************************************************/
/* Close the connection to the database			         */
/*********************************************************/

function phpAds_dbClose()
{
	// Never close the database connection, because
	// it may interfere with other scripts which
	// share the same connection.
}



/*********************************************************/
/* Execute a query                                       */
/*********************************************************/

function phpAds_dbQuery($query, $link = "")
{
    global $phpAds_last_query;
	global $phpAds_db_link;
    global $phpPgAds_last_result;
	
	// Connect to the database, if needed
	if (!$phpAds_db_link &&	!phpAds_dbConnect())
		return false;
	
    $phpAds_last_query = $query;
	
    $res = @pg_exec($phpAds_db_link, $query);
	
	if ($res)
		$GLOBALS['phpPgAds_db_cache'][$res] = 0;
	
	return ($phpPgAds_last_result = $res);
}



/*********************************************************/
/* Execute an asyncronous query                          */
/*********************************************************/

function phpAds_dbAsyncQuery($query, $link = "")
{
    global $phpAds_last_query;
	global $phpAds_db_link;
	
	if (function_exists('pg_send_query'))
		return @pg_send_query($phpAds_db_link, $query);
		
	return phpAds_dbQuery($query);
}



/*********************************************************/
/* Get the number of rows returned                       */
/*********************************************************/

function phpAds_dbNumRows($res)
{
	return @pg_numrows($res);
}



/*********************************************************/
/* Get next row as an array with keys                    */
/*********************************************************/

function phpAds_dbFetchArray($res)
{
	if (isset($GLOBALS['phpPgAds_db_cache'][$res]))
		return @pg_fetch_array($res, $GLOBALS['phpPgAds_db_cache'][$res]++, PGSQL_ASSOC);

	return false;
}



/*********************************************************/
/* Get next row as an array                              */
/*********************************************************/

function phpAds_dbFetchRow($res)
{
	if (isset($GLOBALS['phpPgAds_db_cache'][$res]))
		return @pg_fetch_row($res, $GLOBALS['phpPgAds_db_cache'][$res]++);
	
	return false;
}



/*********************************************************/
/* Get a specific row and column                         */
/*********************************************************/

function phpAds_dbResult($res, $row, $column)
{
	return @pg_result($res, $row, $column);
}



/*********************************************************/
/* Free the result from memory                           */
/*********************************************************/

function phpAds_dbFreeResult($res)
{
	if (isset($GLOBALS['phpPgAds_db_cache'][$res]))
		unset($GLOBALS['phpPgAds_db_cache'][$res]);

	return @pg_freeresult($res);
}



/*********************************************************/
/* Return the number of affected rows                    */
/*********************************************************/

function phpAds_dbAffectedRows()
{
	global $phpPgAds_last_result;
	
	return @pg_cmdtuples($phpPgAds_last_result);
}



/*********************************************************/
/* Go to the specified row                               */
/*********************************************************/

function phpAds_dbSeekRow($res, $row)
{
	if (isset($GLOBALS['phpPgAds_db_cache'][$res]))
	{
		$GLOBALS['phpPgAds_db_cache'][$res] = $row;
		return true;
	}
	
	return false;
}



/*********************************************************/
/* Get the ID of the last inserted row                   */
/*********************************************************/

function phpAds_dbInsertID($seq_name)
{
	return phpAds_dbResult(phpAds_dbQuery("SELECT currval('".substr($seq_name, 0, 31)."')"), 0, 0);
}



/*********************************************************/
/* Get the error message if something went wrong         */
/*********************************************************/

function phpAds_dbError ()
{
	global $phpAds_db_link;
	
	return @pg_errormessage($phpAds_db_link);
}

function phpAds_dbErrorNo ()
{
	return phpAds_dbError();
}



/*********************************************************/
/* Return a large object - phpPgAds only                 */
/*********************************************************/

function phpPgAds_lo_read($oid, $transaction = true)
{
	global $phpAds_db_link;
	
	// Fix by Raymond Burgess
	settype($oid,'double'); 
	
	if ($transaction)
		phpAds_dbQuery("BEGIN");
	
	$res = '';
	if ($lo = @pg_loopen($phpAds_db_link, $oid, "r"))
	{
		while ($buf = @pg_loread($lo, 65536))
			$res .= $buf;
		@pg_loclose($lo);

		if ($transaction)
			phpAds_dbQuery("COMMIT");
	}
	elseif ($transaction)
		phpAds_dbQuery("ROLLBACK");
	
	return $res;
}



/*********************************************************/
/* Create a large object - phpPgAds only                 */
/*********************************************************/

function phpPgAds_lo_create($contents, $transaction = true)
{
	global $phpAds_db_link;
	
	if ($transaction)
		phpAds_dbQuery("BEGIN");
	
	if ($oid = @pg_locreate($phpAds_db_link))
	{
		if ($fd = @pg_loopen($phpAds_db_link, $oid, "wb"))
		{
			if (pg_lowrite($fd, $contents))
			{
				@pg_loclose($fd);
				
				if ($transaction)
					phpAds_dbQuery("COMMIT");
					
				return $oid;
			}
		}
	}
	
	if ($transaction)
		phpAds_dbQuery("ROLLBACK");
	
	return false;
}



/*********************************************************/
/* Delete a large object - phpPgAds only                 */
/*********************************************************/

function phpPgAds_lo_unlink($oid, $transaction = true)
{
	global $phpAds_db_link;
	
	if (!$oid)
		return false;
	
	// Fix by Raymond Burgess
	settype($oid,'double'); 
	
	if ($transaction)
		phpAds_dbQuery("BEGIN");
	
	if (@pg_lounlink($phpAds_db_link, $oid))
	{
		if ($transaction)
			phpAds_dbQuery("COMMIT");
	
		return true;
	}
	
	if ($transaction)
		phpAds_dbQuery("ROLLBACK");
	
	return false;
}

?>
