<?php
session_start();
include"languages/default.php";
include "connect.inc";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<html><head>";
echo "<title>$downloads_edit_title</title>";
echo "<link rel='stylesheet' href='$style' type='text/css'>";
?>
<script>
<!-- Begin
function goTodelURL() { window.location = "editdownloads.php?op=link_del"; }
//  End -->
</script>
<script>
<!-- Begin
function goToeditURL() { window.location = "editdownloads.php?op=link_edit"; }
//  End -->
</script>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "editdownloads.php?op=link_rfrsh"; }
//  End -->
</script>
<script>
<!-- Begin
function goToaddURL() { window.location = "editdownloads.php?op=add_link"; }
//  End -->
</script>
</head>
<center>
<?php
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
include "index.php";
$query =  ("SELECT * FROM CC_downloads ORDER By dlid ASC") or die($no_login_error);
$result = mysql_query($query);
echo "<br><br>";
echo "<table border='1' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_downloads_label</font></b></center></td></tr>";
echo "<img src='../images/information.gif'>  $add_dl_warning_message";
echo "<td width='5%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$links_id_label</b>";
echo "<td width='15%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$dloads_url_label</b>";
echo "<td width='40%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$dloads_label</b>";
echo "<td width='5%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$dloads_count_label</b>";
echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$dloads_size_label</b>";
echo "<td width='25%' bgcolor=$getprefs3[block_background_color]>";
echo "<b>$dloads_title_label</b>";
while( $row = mysql_fetch_array( $result ) )
{
        echo "<tr><td width='5%' bgcolor=$getprefs3[block_background_color]>";
        echo  $row[ 'dlid' ] ;
        echo "<td width='15%' bgcolor=$getprefs3[block_background_color]>";
        echo $row[ 'dlurl' ] ;
        echo "<td width='40%' bgcolor=$getprefs3[block_background_color]>";
        echo $row['dldescription'];
        echo "<td width='5%' bgcolor=$getprefs3[block_background_color]>";
        echo $row['dlcount'];
        echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
        echo $row['dlfilesize'];
        echo "<td width='25%' bgcolor=$getprefs3[block_background_color]>";
        echo $row['dltitle'];
}
echo"</tr></td></table>";
echo "<br>";
echo "<p align = 'center'>";
echo "<input type=button value='$add_dl_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
echo "<input type=button value='$edit_dl_button_label'  class = 'buttons' onClick='goToeditURL()'>&nbsp;";
echo "<input type=button value='$delete_dl_button_label' class = 'buttons' onClick='goTodelURL()'>&nbsp;";
echo "<input type=button value='$refresh_dl_button_label'  class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
echo "</p align><br><br>";
switch( $_GET[ 'op' ] )
{

case "link_edit":
 $res = @mysql_query( "SELECT dlid, dlurl FROM CC_downloads" );
 echo "<form action='editdownloads.php?op=link_edit_2nd' method='post'>";
 echo "<p><center><label>$select_link_to_edit_label";
 echo" <select name='dlid'>";



 while( $row = mysql_fetch_array( $res ) )
 {
        echo "<option value=\"" . $row[ 'dlid' ] . "\">" . $row[ 'dlurl' ] . "</option>\n";
 }
echo "</select>";
echo "</label></p>";
echo "<p><center><input type='submit' value='$link_edit_button_label'  class = 'buttons'/></p>";
echo "</form>";
break;

case 'link_edit_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_downloads WHERE dlid = " . $_POST[ 'dlid' ] );
$error_msg = "";
 if( !isset( $_POST['dlid'] ) )
     $error_msg .= "<p>$missing_post_data_error</p>";
     else{
         include "connect.inc";
         $res = @mysql_query( "SELECT * FROM CC_downloads WHERE dlid = " . $_POST[ 'dlid' ] );
         $error_msg .= mysql_error();
         {
         if( $error_msg == "" )
         {
             $row = mysql_fetch_array( $res );
             if( $error_msg == "" )
             {
                 echo "$editing_this_dl_label&nbsp;";
                 echo $_POST['dlid'];
                 $error_msg .= mysql_error();
             }
         }
     }
 }
 if( $error_msg == "" ){
     $error_msg .= "";
     echo "<form method='post' action='editdownloads.php?op=link_edit_3rd'>";
     echo "<p align = 'center'><label>$edit_this_dl_label<br><input type='text' name='dlurl' size ='80' value= '$row[dlurl]'></label></p>";
     echo "<p align = 'center'><label>$edit_this_dl_description_label</label><br>";
     echo"<textarea rows='10' name='dldescription' cols='87'>$row[dldescription]</textarea></p>";
     echo "<p align = 'center'><label>$edit_this_dl_count_label<br><input type='text' name='dlcount'  size = '2' value= '$row[dlcount]'></label></p>";
     echo "<p align = 'center'><label>$edit_this_dl_size_label<br><input type='text' name='dlfilesize'  size = '2' value= '$row[dlfilesize]'></label></p>";
     echo "<p align = 'center'><label>$edit_this_dl_title_label<br><input type='text' name='dltitle'  size = '80' value= '$row[dltitle]'></label></p>";
     echo "<p align = 'center'><label><br><input type='hidden' name='ID' size = '2' value= '$row[dlid]'></label></p>";
     echo "<p><input type='submit' value='$confirm_edit_button_label'  class = 'buttons'></p>";
     echo "</form>";
     echo $error_msg;
 }else{
      echo "<br>$edit_link_problem_error";
}

break;

case "link_edit_3rd":
$error_msg = "";
if( !isset( $_POST['dltitle'] ) && !isset( $_POST['dldescription'] )&& !isset( $_POST['dlfilesize'] )&& !isset( $_POST['ID'] ))
    $error_msg .= "<p>$missing_post_data_error</p>";
else{
        include "connect.inc";
        $dlurl=$_POST['dlurl'];
        $dldescription=$_POST['dldescription'];
        $dlcount=$_POST['dlcount'];
        $dlfilesize=$_POST['dlfilesize'];
        $dltitle=$_POST['dltitle'];
        $ID=$_POST['ID'];
        @mysql_query ("UPDATE CC_downloads SET dltitle='$dltitle', dlfilesize='$dlfilesize',dlcount='$dlcount',dldescription='$dldescription', dlurl='$dlurl' WHERE dlid ='$ID'");
        $error_msg .= mysql_error();
}
if( $error_msg == "" )
$error_msg = "$link_edit_success_label</p>";
echo $error_msg;
echo "<meta http-equiv='refresh' content='0;URL=editdownloads.php'>";
break;

case "link_del":
include "connect.inc";
$res = @mysql_query( "SELECT dlid, dlurl FROM CC_downloads" );
$num_results = mysql_num_rows($res);
echo "<br>$delete_link_warning_label<br>";
echo "<form action='editdownloads.php?op=link_del_2nd' method='post'>";
echo "<p><center>$select_dl_to_delete_label <br>";
echo "<select name='dlid'>";
while( $row = mysql_fetch_array( $res ) )
{
        echo "<option value=\"" . $row[ 'dlid' ] . "\">" . $row[ 'dlurl' ] . "</option>\n";
}
echo "<input type='submit' value=$delete_item_label class = 'buttons' ></p>";
echo "</form>";
break;


case 'link_del_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_downloads WHERE dlid = " . $_POST[ 'dlid' ] );
$error_msg = "";
if( !isset( $_POST['dlid'] ) )
{
 $error_msg .= "<p>$missing_post_data_error</p>";
}else{
       include "connect.inc";
       $res = @mysql_query( "SELECT * FROM CC_downloads WHERE dlid = " . $_POST[ 'dlid' ] );
       $error_msg .= mysql_error();
}
if( $error_msg == "" )
{
     $row = mysql_fetch_array( $res );
     if( $error_msg == "" )
     {
         @mysql_query( "DELETE FROM CC_downloads WHERE dlid = " . $_POST['dlid'] );
         $error_msg .= mysql_error();
     }
}
if( $error_msg == "" )
{
     $error_msg .= "<br><center>$link_delete_success_label";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editdownloads.php'>";
}else {
          echo '<br>$problem_deleting_link_error<br>';
          echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
break;

case "add_link":
echo "<form method='post' action='editdownloads.php?op=add_link2nd'>";
echo " <p align = 'center'><label>$add_dl_address_label<br><input type='text' name='dlurl' value = 'downloads/' size = '50' ></label></p> ";
echo "<p align = 'center'><label>$add_dl_description_label<br><textarea name='dldescription' cols = '50' rows = '4'></textarea></label></p>";
echo "<p align = 'center'><label>$add_dl_title_label<br> <input type='text' name='dltitle' size = '50' ></label> ";
echo "<p align = 'center'><label>$add_this_dload_size_label<br> <input type='text'name='dlfilesize' size = '10' ></label> ";
echo "<p><input type='submit' value=$add_link_button_label  class = 'buttons'></p> ";
echo "</form>";
break;

case 'add_link2nd':
$error_msg = "";
if( !isset( $_POST['dlurl'] ) && !isset( $_POST['dldescription'] ))
$error_msg .= "<p>$missing_post_data_error</p>";
 else{
     include "connect.inc";
     $dlurl=$_POST['dlurl'];
     $dldescription=$_POST['dldescription'];
     $dltitle=$_POST['dltitle'];
     $dlfilesize=$_POST['dlfilesize'];
     @mysql_query( "INSERT INTO CC_downloads( dltitle, dldescription, dlurl, dlfilesize ) VALUES('$dltitle', '$dldescription', '$dlurl', '$dlfilesize')" );
     $error_msg .= mysql_error();
 }
 if($error_msg == "")
     $error_msg = "<p><center>$add_link_link_added_label</p>";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editdownloads.php'>";
break;
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>