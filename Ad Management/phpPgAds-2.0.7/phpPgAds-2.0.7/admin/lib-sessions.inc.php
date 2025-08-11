<?php // $Revision: 2.0.2.8 $

/************************************************************************/
/* phpPgAds                                                             */
/* ========                                                             */
/*                                                                      */
/* Copyright (c) 2001 by Matteo Beccati			                        */
/* http://sourceforge.net/projects/phppgads                             */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



/*********************************************************/
/* Fetch sessiondata from the database                   */
/*********************************************************/

function phpAds_SessionDataFetch()
{
	global $phpAds_config;
	global $HTTP_COOKIE_VARS, $Session;
	
	if (isset($HTTP_COOKIE_VARS['sessionID']) && preg_match('/^[0-9a-f]+$/D', $HTTP_COOKIE_VARS['sessionID']))
	{
		phpAds_dbQuery("BEGIN");
		
		$result = phpAds_dbQuery("SELECT sessiondata FROM ".$phpAds_config['tbl_session']." WHERE sessionid='".addslashes($HTTP_COOKIE_VARS['sessionID'])."'" .
					 	         " AND lastused > NOW() - '01:00'::interval");
		
		if ($row = phpAds_dbFetchArray($result))
		{
			$Session = unserialize($row['sessiondata']);
			
			// Reset LastUsed, prevent from timing out
			phpAds_dbQuery("UPDATE ".$phpAds_config['tbl_session']." SET lastused = NOW() WHERE sessionid = '".addslashes($HTTP_COOKIE_VARS['sessionID'])."'");

			phpAds_dbQuery("COMMIT");
		}
		else
			phpAds_dbQuery("ROLLBACK");
	}
	else
	{
		$HTTP_COOKIE_VARS['sessionID'] = '';
		return (False);
	}
}



/*********************************************************/
/* Create a new sessionid                                */
/*********************************************************/

function phpAds_SessionStart()
{
	global $HTTP_COOKIE_VARS, $Session;
	
	if (!isset($HTTP_COOKIE_VARS['sessionID']) || !preg_match('/^[0-9a-f]+$/D', $HTTP_COOKIE_VARS['sessionID']))
	{
		// Start a new session
		$Session = array();
		$HTTP_COOKIE_VARS['sessionID'] = md5(uniqid('phpads', 1));
		
		phpAds_setCookie ('sessionID', $HTTP_COOKIE_VARS['sessionID']);
		phpAds_flushCookie ();
	}
	
	return $HTTP_COOKIE_VARS['sessionID'];
}



/*********************************************************/
/* Register the data in the session array                */
/*********************************************************/

function phpAds_SessionDataRegister($key, $value='')
{
	global $Session;
	
	if (!defined('phpAds_installing'))
		phpAds_SessionStart();
	
	if (is_array($key) && $value=='')
	{
		foreach (array_keys($key) as $name)
		{
			$Session[$name] = $key[$name];
		}
	}
	else
		$Session[$key] = $value;
	
	phpAds_SessionDataStore();
	
	// This function has been disabled because of incompatibility
	// problem with ZendOptimizer 1.00. Call sessionDataStore
	// manually if have modified the session array.
	// register_shutdown_function("phpAds_SessionDataStore");
}



/*********************************************************/
/* Store the session array in the database               */
/*********************************************************/

function phpAds_SessionDataStore()
{
	global $phpAds_config;
	global $HTTP_COOKIE_VARS, $Session;
	
	if (isset($HTTP_COOKIE_VARS['sessionID']) && preg_match('/^[0-9a-f]+$/D', $HTTP_COOKIE_VARS['sessionID']))
	{
		$sessiondata = addslashes(serialize($Session));
		
		$res = phpAds_dbQuery("
			UPDATE
				".$phpAds_config['tbl_session']."
			SET
				sessiondata = '".$sessiondata."',
				lastused = NOW()
			WHERE
				sessionid = '".addslashes($HTTP_COOKIE_VARS['sessionID'])."'
		");
		
		if (!phpAds_dbAffectedRows())
			phpAds_dbQuery("INSERT INTO ".$phpAds_config['tbl_session']." VALUES ('".addslashes($HTTP_COOKIE_VARS['sessionID'])."', '".
				   $sessiondata."', NOW())");
	}
		
	// Randomly purge old sessions
	srand((double)microtime()*1000000);
	if(rand(1, 100) == 42)	
		phpAds_dbQuery("DELETE FROM ".$phpAds_config['tbl_session']." WHERE lastused < NOW() - '12:00'::interval");
}



/*********************************************************/
/* Destroy the current session                           */
/*********************************************************/

function phpAds_SessionDataDestroy()
{
	global $phpAds_config;
	global $HTTP_COOKIE_VARS, $Session;
	
	if (isset($HTTP_COOKIE_VARS['sessionID']) && preg_match('/^[0-9a-f]+$/D', $HTTP_COOKIE_VARS['sessionID']))
	{
		// Remove the session data from the database
		phpAds_dbQuery("DELETE FROM ".$phpAds_config['tbl_session']." WHERE sessionid='".addslashes($HTTP_COOKIE_VARS['sessionID'])."'");
	}
	
	// Kill the cookie containing the session ID
	phpAds_setCookie ('sessionID', '');
	phpAds_flushCookie ();
	
	// Clear all local session data and the session ID
	$Session = "";
	unset($Session);
	
	$HTTP_COOKIE_VARS['sessionID'] = "";
	unset($HTTP_COOKIE_VARS['sessionID']);
}

?>
