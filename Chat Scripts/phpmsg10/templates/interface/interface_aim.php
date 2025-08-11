<?php

/*

  Example using PHP Messenger for creating user interfaces
  with ICQ, AIM or MSN messengers. 

  Copyright(c) 2004 http://www.php-messenger.com

*/


$screen_name='ENTER YOUR SCREENNAME';
$pass='ENTER YOUR PASSWORD';
$admin_screen_name='ADMIN SCREENNAME';


ignore_user_abort(1); 
require ("php_messenger.php");
require ("interface.php");

PM_Interface($screen_name,$pass,"AIM",$admin_screen_name);
?>
