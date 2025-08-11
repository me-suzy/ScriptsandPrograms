<?php
session_start();
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<head><title></title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
$address = $getprefs3[donation_email_address];
$address = regst($address);
echo "<center>";
echo "<br>$my_donation_message_label";
echo "<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>";
echo "<input type='hidden' name='cmd' value='_xclick'>";
echo "<input type='hidden' name='business' value= '$address'>";
echo "<input type='hidden' name='item_name' value='paypal donation'>";
echo "<input type='hidden' name='item_number' value='donation to me'>";
echo "<input type='hidden' name='no_note' value='1'>";
echo "<input type='hidden' name='currency_code' value=$getprefs3[donation_currency]>";
echo "<input type='hidden' name='tax' value='0'>";
echo "<input type='image' src=$getprefs3[donation_image_path] border='0' name='submit' alt='Make payments with PayPal - its fast, free and secure!'>";
echo "</form>";

function regst($strg){
$alpha_array = array('Y','D','U','R','P','S','B','M','A','T','H');
$reg = base64_decode($strg);
list($reg,$letter) = split("\+",$reg);
for($i=0;$i<count($alpha_array);$i++)
   {
   if($alpha_array[$i] == $letter)
   break;
}
for($x=1;$x<=$i;$x++)
   {
   $reg=base64_decode($reg);
}
$reg = stripslashes($reg);
return $reg;
}
?>