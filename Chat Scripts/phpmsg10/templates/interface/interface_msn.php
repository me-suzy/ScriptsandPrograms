<?php

/*

  Sample using PHP Messenger for creating user interfaces
  with ICQ, AIM or MSN messengers. 

  Copyright(c) 2004 http://www.php-messenger.com

*/



$email='ENTER YOUR EMAIL';
$pass='ENTER YOUR PASSWORD';
$admin_email='ADMIN EMAIL';





ignore_user_abort(1); 
require ("php_messenger.php");
require ("interface.php");

PM_Interface($email,$pass,"MSN",$admin_email);
?>
