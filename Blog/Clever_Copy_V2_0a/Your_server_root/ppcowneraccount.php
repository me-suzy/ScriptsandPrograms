<?php
session_start();
include "admin/connect.inc";
include "admin/languages/default.php";
include "languages/default.php";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
?>
<head><title><?php echo $ppc_account_title; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css"></head>
<?php
echo "Pay Per Click is not yet available on this site";
?>