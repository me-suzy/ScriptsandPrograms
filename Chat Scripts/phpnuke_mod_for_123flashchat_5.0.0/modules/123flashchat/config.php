<?php

/************************************************************************/
/* PHP-NUKE: Web Portal System
/* Module for 123 flash chat server software                            */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2001-2005 by TopCMM 					*/
/* Daniel Jiang (support@123flashchat.com)          			*/
/* http://www.topcmm.comt						*/
/* http://www.123flashchat.comt						*/
/*									*/
/* http://phpnuke.org                                                   */
/*                                                                      */
/* Before you start using this module,                                  */
/* please read the Readme.txt carefully                                 */
/* Important: the value of "$chat_data_path" must be replaced with      */
/* <123flashchat installed directory>/data on your server.              */
/************************************************************************/

/**
 * $extend_chat_server
 * if your chat server and post-nuke web server in the diffrent server, 
 * please set $extend_chat_server to true
 * default is "false"
 */
$extend_chat_server = false;

/**
 * $chat_client_root_path
 * if you set $extend_chat_server to true, 
 * please set it the client file url like: http://www.yoursite.com/abc/
 * default is ""
 */
$chat_client_root_path = "";


$swf_file_name = "123flashchat.swf";


/**
 * $chat_data_path
 * you must configure this value if you set $extend_chat_server=false,
 * if you set $extend_chat_server=true, you don't have to configure this value any more.  
 * This value is your <123flashchat installed directory>/server/data/default/ , don't forget the last "/"!
 */
$chat_data_path = "C:/Program Files/123FlashChatServer5.0/server/data/default/";

?>