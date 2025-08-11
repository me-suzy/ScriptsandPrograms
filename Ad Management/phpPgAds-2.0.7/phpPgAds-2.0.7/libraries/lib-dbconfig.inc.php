<?php // $Revision: 2.4.2.30 $

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
define ('LIBDBCONFIG_INCLUDED', true);


// Current phpAds version
$phpAds_version = 200.270;
$phpAds_version_readable = "2.0.7 RC2";
$phpAds_version_development = true;  
$phpAds_productname = "phpPgAds";
$phpAds_producturl = "www.phppgads.com";
$phpAds_dbmsname = "PostgreSQL";

$GLOBALS['phpAds_settings_information'] = array(
	'dblocal' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'db'),
	'dbhost' => 					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'dbport' => 					array ('type' => 'integer', 'sql' => false,	'section' => 'db'),
	'dbuser' => 					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'dbpassword' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'dbname' => 					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_adclicks' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_adviews' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_adstats' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_banners' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_clients' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_session' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_acls' => 					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_zones' => 					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_config' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_affiliates' =>				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_images' =>					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_userlog' =>				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_cache' =>					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'tbl_targetstats' =>			array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'table_prefix' =>				array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
//	'table_type' =>					array ('type' => 'string', 	'sql' => false,	'section' => 'db'),
	'persistent_connections' =>		array ('type' => 'boolean', 'sql' => false,	'section' => 'db'),
//	'insert_delayed' => 			array ('type' => 'boolean', 'sql' => false,	'section' => 'db'),
//	'compatibility_mode' => 		array ('type' => 'boolean', 'sql' => false,	'section' => 'db'),
	'url_prefix' => 				array ('type' => 'string', 	'sql' => false,	'section' => 'misc'),
	'p3p_policies' => 				array ('type' => 'boolean', 'sql' => false,	'section' => 'invocation'),
	'p3p_compact_policy' => 		array ('type' => 'string', 	'sql' => false,	'section' => 'invocation'),
	'p3p_policy_location' => 		array ('type' => 'string', 	'sql' => false,	'section' => 'invocation'),
	'default_banner_url' => 		array ('type' => 'string', 	'sql' => false,	'section' => 'banner'),
	'default_banner_target' =>		array ('type' => 'string', 	'sql' => false,	'section' => 'banner'),
	'delivery_caching' =>			array ('type' => 'string', 	'sql' => false,	'section' => 'invocation'),
	'type_html_auto' => 			array ('type' => 'boolean', 'sql' => false,	'section' => 'banner'),
	'type_html_php' => 				array ('type' => 'boolean', 'sql' => false,	'section' => 'banner'),
	'con_key' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'invocation'),
	'mult_key' =>	 				array ('type' => 'boolean', 'sql' => false,	'section' => 'invocation'),
	'acl' =>  						array ('type' => 'boolean', 'sql' => false,	'section' => 'invocation'),
	'geotracking_type' => 			array ('type' => 'string',	'sql' => false,	'section' => 'host'),
	'geotracking_location' => 		array ('type' => 'string',  'sql' => false,	'section' => 'host'),
	'geotracking_stats' =>			array ('type' => 'boolean', 'sql' => false,	'section' => 'host'),
	'geotracking_cookie' =>			array ('type' => 'boolean', 'sql' => false,	'section' => 'host'),
	'geotracking_conf' =>			array ('type' => 'string',	'sql' => false,	'section' => 'host'),
	'compact_stats' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'log_beacon' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'log_adviews' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'block_adviews' =>				array ('type' => 'integer', 'sql' => false,	'section' => 'stats'),
	'log_adclicks' => 				array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'block_adclicks' =>				array ('type' => 'integer', 'sql' => false,	'section' => 'stats'),
	'reverse_lookup' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'host'),
	'ignore_hosts' => 				array ('type' => 'array',	'sql' => false,	'section' => 'stats'),
	'warn_admin' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'warn_client' => 				array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'warn_limit' =>					array ('type' => 'integer', 'sql' => false,	'section' => 'stats'),
	'proxy_lookup' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'host'),
	'ui_enabled' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'misc'),
	'ui_forcessl' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'misc'),
	'log_source' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'log_hostname' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'log_iponly' =>					array ('type' => 'boolean', 'sql' => false,	'section' => 'stats'),
	'pack_cookies' =>				array ('type' => 'boolean', 'sql' => false,	'section' => 'invocation'),
	
	'my_header' =>					array ('type' => 'string', 'sql' => true,	'section' => 'interface'),
	'my_footer' =>					array ('type' => 'string', 'sql' => true,	'section' => 'interface'),
	'language' =>					array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'name' =>						array ('type' => 'string', 'sql' => true,	'section' => 'interface'),
	'company_name' =>				array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'override_gd_imageformat' =>	array ('type' => 'string', 'sql' => true,	'section' => 'misc'),
	'begin_of_week' =>				array ('type' => 'integer', 'sql' => true,	'section' => 'defaults'),
	'percentage_decimals' =>		array ('type' => 'integer', 'sql' => true,	'section' => 'defaults'),
	'default_banner_weight' =>		array ('type' => 'integer', 'sql' => true,	'section' => 'defaults'),
	'default_campaign_weight' =>	array ('type' => 'integer', 'sql' => true,	'section' => 'defaults'),
	'type_sql_allow' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'banner'),
	'type_web_allow' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'banner'),
	'type_url_allow' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'banner'),
	'type_html_allow' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'banner'),
	'type_txt_allow' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'banner'),
	'type_web_mode' =>				array ('type' => 'integer', 'sql' => true,	'section' => 'banner'),
	'type_web_dir' =>				array ('type' => 'string', 'sql' => true,	'section' => 'banner'),
	'type_web_ftp' =>				array ('type' => 'string', 'sql' => true,	'section' => 'banner'),
	'type_web_url' =>				array ('type' => 'string', 'sql' => true,	'section' => 'banner'),
	'admin' =>						array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'admin_pw' =>					array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'admin_fullname' =>				array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'admin_email' =>				array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'admin_email_headers' =>		array ('type' => 'string', 'sql' => true,	'section' => 'admin'),
	'admin_novice' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'admin'),
	'client_welcome' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'interface'),
	'client_welcome_msg' =>			array ('type' => 'string', 'sql' => true,	'section' => 'interface'),
	'content_gzip_compression' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'interface'),
	'userlog_email' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'admin'),
	'userlog_priority' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'admin'),
	'userlog_autoclean' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'admin'),
	'gui_show_campaign_info' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_campaign_preview' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_banner_info' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_banner_preview' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_banner_html' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_matching' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_show_parents' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_hide_inactive' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'defaults'),
	'gui_link_compact_limit' =>		array ('type' => 'integer', 'sql' => true,	'section' => 'defaults'),
	'qmail_patch' =>				array ('type' => 'boolean', 'sql' => true,	'section' => 'stats'),
	'updates_frequency' =>			array ('type' => 'integer', 'sql' => true,	'section' => 'admin'),
	'updates_last_seen' =>			array ('type' => 'string', 'sql' => true,	'section' => 'misc'),
	'updates_timestamp' =>			array ('type' => 'integer', 'sql' => true,	'section' => 'misc'),
	'updates_dev_builds' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'admin'),
	'allow_invocation_plain' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_js' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_frame' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_xmlrpc' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_local' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_interstitial' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'allow_invocation_popup' =>		array ('type' => 'boolean', 'sql' => true,	'section' => 'invocation'),
	'auto_clean_tables' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'stats'),
	'auto_clean_tables_interval' =>	array ('type' => 'integer', 'sql' => true,	'section' => 'stats'),
	'auto_clean_tables_vacuum' =>	array ('type' => 'boolean', 'sql' => true,	'section' => 'stats'),
	'auto_clean_userlog' =>			array ('type' => 'boolean', 'sql' => true,	'section' => 'stats'),
	'auto_clean_userlog_interval' =>  array ('type' => 'integer', 'sql' => true,	'section' => 'stats'),
	'autotarget_factor' =>			array ('type' => 'double', 'sql' => true,	'section' => 'misc'),
	'config_version' =>				array ('type' => 'string', 'sql' => true,	'section' => 'misc'),
	'maintenance_timestamp' =>		array ('type' => 'integer', 'sql' => true,	'section' => 'misc')
);



/*********************************************************/
/* Load configuration from database                      */
/*********************************************************/

function phpAds_LoadDbConfig()
{
	global $phpAds_config, $phpAds_settings_information;
	
	if ((!empty($GLOBALS['phpAds_db_link']) || phpAds_dbConnect(true)) && isset($phpAds_config['tbl_config']))
	{
		if ($res = phpAds_dbQuery("SELECT * FROM ".$phpAds_config['tbl_config']." WHERE configid = 0"))
		{
			if ($row = phpAds_dbFetchArray($res, 0))
			{
				while (list($k, $v) = each($phpAds_settings_information))
				{
					if (!$v['sql'] || !isset($row[$k]))
						continue;
					
					switch($v['type'])
					{
						case 'boolean': $row[$k] = $row[$k] == 't'; break;
						case 'integer': $row[$k] = (int)$row[$k]; break;
						case 'array': $row[$k] = unserialize($row[$k]); break;
						case 'float': $row[$k] = (float)$row[$k]; break;
					}
					
					$phpAds_config[$k] = $row[$k];
				}
				
				reset($phpAds_settings_information);
				
				return true;
			}
		}
	}

	return false;
}

?>
