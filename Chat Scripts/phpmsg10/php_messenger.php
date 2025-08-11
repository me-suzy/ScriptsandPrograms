<?php
/***********************************************************************
*                                                                      *
*                                                                      *
*                                                                      *
*                          PHP MESSENGER 1.0                           *
*                                                                      *
*               Messaging tool for PHP developers!                     *
*                                                                      *
*                                                                      *
*                                                                      *
*                PHP MESSENGER supports receiving/sending of the       *
*                                                                      *
*                                "ICQ",                                *
*                      "AOL Instatnt Messenger",                       *
*                     "Windows Instant Messenger",                     *
*                                                                      *
*                    messages and can send SMS via ICQ !!!             *
*                                                                      *
*                                                                      *
*                                                                      *
*               PHP MESSENGER is a shareware product, and              *
*               it must be registered after 30 days usage!             *
*                                                                      *
*                                                                      *
* 	       	Register PHP MESSENGER today !                         *
* 	       	http://www.php-messenger.com/register.php              *
*                                                                      *
*                                                                      *
* 	       	Get free life-time support:                            *
* 	       	http://www.php-messenger.com/support.php               *
*                                                                      *
*                                                                      * 	       
*                 Get free upgrade for all minor                       *
* 	       	versions of PHP MESSENGER!                             *
* 	       	http://www.php-messenger.com/upgrade.php               *
*                                                                      *
*                                                                      *
*                                                                      *
*                                                                      *
*                                                                      *
*           Requirements:                                              *
*                                                                      *
*           1) PHP must be compiled with                               *
*              '--enable-sockets' option                               *
*                                                                      *
*           2) "Windows Instant Messenger" requires                    *
*              '--with-openssl' and '--with-iconv' options             *
*                                                                      *
*           3) Sending SMS in international languages requires         *
*              '--with-iconv' too.                                     *
*                                                                      *
*              You can download "PHP conv" lib                         *
*              http://www.php-messenger.com/files/php_conv.zip         *
*              for iconv change.                                       *
*                                                                      *
*                                                                      *
*                                                                      *
*           Copyright(c) 2004 http://www.php-messenger.com             *
*                                                                      *
***********************************************************************/



$CFG['Debug_Mode']=0;		// 0/1
$CFG['Show_Messages']=1;	// 0/1
$CFG['Show_Errors']=1;		// 0/1
$CFG['HTML_Print']=1;		// 0/1
$CFG['Connect_Wait_Limit']=30;	// sec
$CFG['Connect_Time_Out']=120;	// sec
$CFG['Packet_Loop_Msec']=100;	// msec
$CFG['Reg']=0;			// 0/1
$CFG['ICQ_Login_Server']="login.icq.com";
$CFG['ICQ_Login_Port']=5190;
$CFG['AIM_Login_Server']="ibucp-vip-d.blue.aol.com";
$CFG['AIM_Login_Port']=5190;
$CFG['MSN_Login_Server']="messenger.hotmail.com";
$CFG['MSN_Login_Port']=1863;
$CFG['MSN_Nexus_Login_Server']="nexus.passport.com";
$CFG['MSN_Nexus_Login_Port']=443;
$CFG['MSN_Passport_Login_Server']="login.passport.com";
$CFG['MSN_Passport_Login_Hotmail_Server']="loginnet.passport.com";
$CFG['MSN_Passport_Login_Port']=443;
$CFG['MSN_Passport_Login_URL']="login2.srf";
$CFG['MSN_Time_Switch_Sock']=100; //msec
$CFG['MSN_Msg_Format']="X-MMS-IM-Format: FN=Arial; EF=I; CO=0; CS=0; PF=22";


$doc_root=getenv("DOCUMENT_ROOT"); 
$path_to_php_messenger_script="$doc_root/messenger_engine.php"; // WARNING !!! Check this path!
$path_to_php_conv_script="$doc_root/php_conv/charsets.php";     // WARNING !!! Check if using php_conv
$path_to_php_conv_incl="$doc_root/core/php_conv/incl";		// WARNING !!! Check if using php_conv

require ($path_to_php_messenger_script);  			// Include PHP MESSENGER
if (file_exists($path_to_php_conv_script)) require ($path_to_php_conv_script); // Include php_conv

?>