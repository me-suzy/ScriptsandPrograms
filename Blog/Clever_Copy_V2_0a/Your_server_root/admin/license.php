<?php
session_start();
include"languages/default.php";
include"../languages/default.php";
include "connect.inc";
?>
<html><head>
<title>Clever Copy - Licensing</title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   echo "<br><br><table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
   echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
   echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$license_label</font></b></center></td></tr>";
   echo "<tr><td width= '100%'>";
   echo "<br><b>Disclaimer</b><br><br>This webscript is distributed 'As is' and without warranty. Neither the authors or anyone invloved with the development of Clever Copy";
   echo " make any representation, or warranty, either express or implied, with respect to this scripts quality, accuracy or fitness for a specific purpose.";
   echo " Therefore, neither the development team or anyone invloved in developing this script shall have any liability to you or any other person or entity";
   echo " with respect to any liability, loss, or damage caused or alleged to have been caused directly or indirectly by this script. This includes, but is not limited to";
   echo " interruption of service, loss of data, loss of profits or consequential damages from the use of this script. Essentially, if you use it you assume all the risks!";
   echo "<br><br><b>License</b><br><br>";
   echo "You are granted a license to both <b>store</b> and <b>use</b> Clever Copy on any number of websites that you directly own and to write the script to any storage medium. Clever Copy and its' authors retain copyright at all times.";
   echo " Clever Copy is NOT subject to the GNU/GPL licensing scheme - it does not reside in the public domain and a license to use Clever Copy is given on the";
   echo " understanding that you, as the site owner, agree to leave our copyright and links in place. Removal of either immediately revokes any license granted.";
   echo " By either storing or using Clever Copy you are agreeing to the terms of this license and should you, or your agents, remove our links or copyright notice you agree ";
   echo "to remove the entire web script from any web site you own and destroy any backup copies,  i.e. If you run Clever Copy on one site or more than one site, your license to use the script";
   echo " is terminated for all sites. Your license to store Clever Copy is also revoked and you must not maintain any backups of the script whether they are printed copies";
   echo " or written to any form of storage media";
   echo "<br><br><b>What you can and cannot do with Clever Copy:</b><br><br>";
   echo "<b>What you can do</b> - On your own site you may do with Clever Copy what you like. You may modify it in any way you see fit. You may add to it or subtract from it, it is";
   echo " entirely up to you. You may make Clever Copy available for download from your site but only if you offer the same distribution file that you downloaded";
   echo " in its' original condition, i.e. unmodified.";
   echo "<br><br><b>What you cannot do</b> - You cannot remove the copyright notice, this license or any link back to Clever Copy. This forms part of the";
   echo " license agreement between you and us. You cannot offer Clever Copy for sale nor can you offer for sale modifications or additional functionality to Clever Copy. You cannot";
   echo " offer Clever Copy as part of a 'script bundle' either given away for no charge, for auction or for sale. You cannot offer to modify Clever Copy";
   echo " for a third party either for a fee or for no charge. Any instance of any of the aforementioned is deemed as a breach of the license and your license to both <b>store</b> and <b>use</b> Clever Copy is terminated.";
   echo "<br><br><b> -- End license</b><br><br>";
}else{
  echo $no_login_error;
  include "index.php";
}
?>