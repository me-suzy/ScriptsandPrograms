<?php
session_start();
include "admin/connect.inc";
include "languages/default.php";
include "admin/languages/default.php";
include "banned.php";
include "antihack.php";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$getblocks="SELECT * from CC_block_names";
$getblocks2=mysql_query($getblocks) or die($no_blocks_error);
$getblocks3=mysql_fetch_array($getblocks2);
$style = $getprefs3[personality];
$siteaddress = $getprefs3[siteaddress];
$sitetitle = $getprefs3[title];
$ex_link_text_label = $getprefs3[linkex_text];
$adminemail_address = registre($getprefs3[siteemail]);
?>
<head><title><?php echo $getprefs3[title]; ?></title>
<script language = "Javascript">
/**
* DHTML textbox character counter (IE4+) script. Courtesy of SmartWebby.com (http://www.smartwebby.com/dhtml/)
*/
function taLimit() {
        var taObj=event.srcElement;
        if (taObj.value.length==taObj.maxLength*1) return false;
}
function taCount(visCnt) {
        var taObj=event.srcElement;
        if (taObj.value.length>taObj.maxLength*1) taObj.value=taObj.value.substring(0,taObj.maxLength*1);
        if (visCnt) visCnt.innerText=taObj.maxLength-taObj.value.length;
}
</script>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css"></head>
<?php
include "layout.php";
include "header.php";
echo "<table border='0' width=100%>";
echo "<tr><td valign='top' width = '181'>";
echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
$query =  ("SELECT * FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
$result = mysql_query($query);
if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
while($row = mysql_fetch_array($result)){
       $theblock = $row["block_file"];
       if (isset($_SESSION['cuser'])){
          if ((($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
          }
       }
       elseif (isset($_SESSION['cadmin'])){
               if ((($row["side"]=="0")&& ($row["view"]=="2")) || (($row["side"]=="0") && ($row["view"]=="1")) || (($row["side"]=="0") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
        if (($row["side"]=="0") && ($row["view"]=="0")){
             if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
        }
   }
}
echo "<td valign='top' ><center>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td height=$getprefs3[block_heading_height] colspan = '3'>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>&nbsp;<b>$new_link_exchange_label</b></font></b></center></td></tr>";
echo "<tr><td colspan = '3'><br><p align = 'justify'>$weblink_exchange_terms_label<br><hr><br>";
echo "<form action='addtoweblinks.php?op=new_exlink' method='post'>";
echo "<tr><td width = '25%' valign = 'top'>$new_realname_label";
echo "<td width = '75%' valign = 'top'><input type='text' name='name' size='40'><br><br>";
echo "<tr><td width = '25%' valign = 'top'>$new_user_email_label";
echo "<td width = '75%' valign = 'top'><input type='text' name='emailaddress' size='40'><br><br>";
echo "<tr><td width = '25%' valign = 'top'>$ex_link_url_label<br><br>";
echo "<td width = '75%' valign = 'top'><input type='text' name='link_url' value = 'http://' size='60'><br><br>";
echo "<tr><td width = '25%' valign = 'top'>$ex_link_wording_label<br><br>";
echo "<td width = '75%' valign = 'top'><input type='text' onkeypress='return taLimit()' onkeyup='return taCount(thisCounter)'name=link_desc  wrap=physical  maxLength='29' size='60'>";
echo "<br><b><span id=thisCounter>29</span></b> $characters_remaining_label<br><br></font><br>";
echo "<tr><td width = '25%' valign = 'top'>$ex_the_alt_text_label";
echo "<td width = '75%' valign = 'top'><textarea onkeypress='return taLimit()' onkeyup='return taCount(myCounter)'name=alttext rows=2 wrap=physical cols=60 maxLength='100'></textarea>";
echo "<br><b><span id=myCounter>100</span></b> $characters_remaining_label<br><br></font>";
echo "<tr><td width = '25%' valign = 'top'>$ex_recip_url_label";
echo "<td width = '75%' valign = 'top'><input type='text' name='recip'  value = 'http://' size='60'><br><br>";
echo "<input type='submit' name='submit' value='$add_my_link_button_label'class = 'buttons'>";
echo "</form></center>";

switch($_GET["op"])
{

 case "new_exlink":
 include "admin/languages/default.php";
 include "languages/default.php";
 include "admin/connect.inc";
 $emailaddress=antihax($_POST["emailaddress"]);
 $name=antihax($_POST["name"]);
 $link_url=antihaxmnr($_POST["link_url"]);
 $link_url = "http://$link_url";
 $link_desc=antihax($_POST["link_desc"]);
 $alttext=antihax($_POST["alttext"]);
 $recip=antihaxmnr($_POST["recip"]);
 $recip="http://$recip";
 if (($recip == "")||($link_desc == "") || ($link_url == "") || ($emailaddress == ""))
 {
   $error_msg .= "<p>$missing_post_data_error</p>";
   echo "<b>$error_msg</b>";
   exit;
 }
 $emailaddress = sesson($emailaddress);
 @mysql_query("INSERT INTO CC_weblinksposted(name,emailaddress,link_url,link_desc,alttext,recip) VALUES('$name','$emailaddress','$link_url','$link_desc', '$alttext', '$recip')" );
 $error_msg .= mysql_error();
 if($error_msg == "")
     {
     $error_msg = "<tr><td colspan = '2'><center><b>$new_exlink_successfully_added_label<br>$recip<br>";
     echo $error_msg;
     echo "<br>$ex_link_get_code_label</center></b><br>";
     $ex_code_value="<a href='$siteaddress' target='_new'>$ex_link_text_label</a>";
     echo "<tr><td colspan = '2'><center><textarea  cols='40' rows='5'>$ex_code_value</textarea></center><br><br>";
     mail("$adminemail_address","$linkex_mail_invoice_subject","$linkex_mail_body_to_admin_label\n$sitetitle","FROM: $adminemail_address");
 }
 break;
}
echo "</td></tr></table>";
echo "</center></td>";
if($getprefs3[showrightblocks]==1){
    echo "<td valign='top' width='181'>";
    echo "<img src=images/seperator.gif border='0' width='181' height='1'>";
    $query =  ("SELECT *, side FROM CC_blocks ORDER By blockposition ASC") or die($no_blocks_found_error);
    $result = mysql_query($query);
    if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
         if (isset($_SESSION['cuser'])){
             if ((($row["side"]=="1") && ($row["view"]=="1")) || (($row["side"]=="1") && ($row["view"]=="0"))){
                  include "$theblock";
                  echo "<br>";
             }
         }
         elseif (isset($_SESSION['cadmin'])){
             if (($row["side"]=="1")){
                  include "$theblock";
                  echo "<br>";
             }
         }
    }
}
else{
    while($row = mysql_fetch_array($result)){
        $theblock = $row["block_file"];
        if (($row["side"]=="1") && ($row["view"]=="0")){
             if ($row["block_file"] == "loginblock.php")
                  {
                  echo "";
             }else{
                   include "$theblock";
                   echo "<br>";
             }
        }
   }
}
}
include "endlayout.php";
?>