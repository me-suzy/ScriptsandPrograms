<?php
require('MySQLHandler.class.php');
require('SZCalendar.class.php');
$sql = new MySQLHandler();
$sql->Init();
$cal = new SZCalendar($sql);
include('config.inc.php');
?>