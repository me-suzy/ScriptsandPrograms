<?php
//Dc-shout2.0 (c)devilcoderz 2004
function logout()
{
session_unregister('username'); 
session_unregister('password');
echo "<b>you have been loged out of the Dc shout admin panel</b>";
}
?>









