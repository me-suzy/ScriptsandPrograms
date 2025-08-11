<?php
session_start();
include "connect.inc";
include "languages/default.php";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
include "index.php";
echo "<br><br>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_ranquotes_label</font></b></center></td></tr>";
echo "<td width='100%' bgcolor=$getprefs3[block_background_color]>";
echo "<img src='../images/information.gif'> To add or remove random quotes embedded in the system, you will need to find the file called 'thequotes.txt' and edit it. The file will be found in the ";
echo "'/randomquotes' directory. <br><br>Open the file using a text editor such as notepad and make any neccessary changes.<br>To delete a quote select ";
echo "both the break statement AND the quote itself. As an example, you would remove both the lines below from the file to remove this quote<br>";
echo " &lt;&lt;BREAK&gt;&gt;<br>Change is inevitable, except from vending machines. - anonymous<br><br>";
echo "Similarly, to add quotes you will need to add a break statement followed by the quote and repeat this process for each random quote you would ";
echo "like to add<br><br>In future versions of Clever Copy it is intended to automate this process through the admin panel";
}else{
  echo $no_login_error;
  include "index.php";
}
?>