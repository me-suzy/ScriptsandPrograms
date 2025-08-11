<?php
session_start();
include "connect.inc";
include "../languages/default.php";
include "languages/default.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
?>
<head><link rel="stylesheet" href="<?php echo $style; ?>" type="text/css"></head>
<!-- Start Avanti Web Stats tracking code - copyright (c) 2004 Liquid Frog Software - www.liquidfrog.com -->
<script src="<?$siteaddress?>/stats/script.js" language="JavaScript"></script>
<noscript><img src="<?$siteaddress?>/stats/script.php?image=1&javascript=false"></noscript>
</html>
<?php
@mysql_query("UPDATE CC_prefs SET counter=counter+1");
//End of Avanti Web Stats tracking code-->
session_unregister( 'cadmin' );
session_unregister( 'cuser' );
session_unregister( 'buser' );
session_unregister( 'puser' );
echo "<div align='center'>";
echo "<center>";
echo "<table border='1' cellspacing='1' style='border-collapse: collapse' width='70%>";
echo "<center><tr><td><center>$logout_label</center></td></tr>";
echo "<tr><td width='100%'>";
echo "<p align = 'center'>$if_you_see_label <a href='../index.php'> $click_here_label</a></p>";
echo "<meta http-equiv='refresh' content='0;URL=../index.php'>";
echo "</tr></td></table>";
?>