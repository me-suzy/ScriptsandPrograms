<?php

/*

  Example using PHP Messenger for creating user interfaces
  with ICQ, AIM or MSN messengers. 

  Now this example works with UIN 309386939.
  You can talk to him right now
  
  Copyright(c) 2004 http://www.php-messenger.com

*/


$UIN='ENTER YOUR UIN';
$pass='ENTER YOUR PASSWORD';
$admin_UIN='ADMIN UIN';


ignore_user_abort(1); 
require ("php_messenger.php");
require ("interface.php");

PM_Interface($UIN,$pass,"ICQ",$admin_UIN);
?>
