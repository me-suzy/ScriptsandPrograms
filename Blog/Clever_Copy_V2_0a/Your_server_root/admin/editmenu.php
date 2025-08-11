<?php
session_start();
include"languages/default.php";
include"../languages/default.php";
include "connect.inc";
?>
<html><head>
<title><?php echo $menu_edit_title; ?></title>
<script>
<!-- Begin
function goTodelURL() { window.location = "editmenu.php?op=link_del"; }
//  End -->
</script>
<script>
<!-- Begin
function goToeditURL() { window.location = "editmenu.php?op=link_edit"; }
//  End -->
</script>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "editmenu.php?op=link_rfrsh"; }
//  End -->
</script>
<script>
<!-- Begin
function goToaddURL() { window.location = "editmenu.php?op=add_link"; }
//  End -->
</script>
<script>
<!-- Begin
function goTosortURL() { window.location = "editmenu.php?op=sort"; }
//  End -->
</script>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head> ";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3){
include "index.php";
$query =  ("SELECT * FROM CC_menu ORDER By weighting ASC") or die($no_menu_error);
$result = mysql_query($query);
echo "<br><br>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_menu_label</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color] colspan = '6'>";
echo "<br><img src = '../images/information.gif'> $external_links_label<br><br>";
echo "<tr><td width='2%' valign = 'top'>";
echo "<b>$links_id_label</b>";
echo "<td width='20%' valign = 'top'>";
echo "<b>$links_label</b>";
echo "<td width='20%' valign = 'top'>";
echo "<b>$links_description_label</b>";
echo "<td width='30%' valign = 'top'>";
echo "<b>$links_title_label</b>";
echo "<td width='13%' valign = 'top'>";
echo "<b>$links_target_label</b>";
echo "<td width='15%' valign = 'top'>";
echo "<b>$block_view_show_label</b>";
while( $row = mysql_fetch_array($result))
{
        echo "<tr><td width='2%'>";
        echo $row['menuid'] ;
        echo "<td width='20%'>";
        echo $row['menuurl'] ;
        echo "<td width='20%'>";
        echo $row['menuname'];
        echo "<td width='35%'>";
        echo $row['menualt'];
        echo "<td width='13%'>";
        if ($row['target']=='_new') {
             $iftarget = $yes_label;
        }else{
             $iftarget = $no_label;
        }
        echo $iftarget;
        echo "<td width='15%'>";
        if($row[view]=="0")
        {
           echo "$view_by_all_label";
        }
        elseif($row[view]=="1")
        {
                echo "$view_by_members_label";
        }
        elseif($row[view]=="2")
        {
                echo "$view_by_admin_label";
        }
        elseif($row[view]=="5")
        {
                echo "$link_is_off_label";
        }
}
echo"</tr></td></table>";
echo "<br>";
echo "<p align = 'center'>";
echo "<input type=button value='$add_menu_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
echo "<input type=button value='$edit_menu_button_label' class = 'buttons' onClick='goToeditURL()'>&nbsp;";
echo "<input type=button value='$delete_menu_button_label' class = 'buttons' onClick='goTodelURL()'>&nbsp;";
echo "<input type=button value='$sort_menu_button_label' class = 'buttons' onClick='goTosortURL()'>&nbsp;";
echo "<input type=button value='$refresh_menu_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
echo "</p align><br><br>";
switch( $_GET[ 'op' ] )
{


case "sort":
$thisquery =  ("SELECT * FROM CC_menu ORDER By weighting ASC") or die($no_menu_error);
$thisresult = mysql_query($thisquery);
echo "<br><br>";
echo "<table border='1' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_menu_sort_label</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color] colspan = '3'>";
while( $thisrow = mysql_fetch_array($thisresult))
{
  echo "<form action='editmenu.php?op=sortsecond' method='post'>";
  echo "<tr><td width='10%'  valign = 'top'>";
  echo "$thisrow[menuname]";
  echo "<td width='8%'  valign = 'top'>";
  echo "<input type ='text'  name='weighting' size='3' value='$thisrow[weighting]'>";
  echo "<input type ='hidden'  name='menuid' value='$thisrow[menuid]'>";
  echo "<td  width ='82%' valign = 'top'><input type='submit' name='submit'  value='$save_button_label' class = 'buttons'></form>";
}
break;

case "sortsecond":
$weighting = $_POST['weighting'];
$menuid = $_POST['menuid'];
@mysql_query ("UPDATE CC_menu SET weighting='$weighting' WHERE menuid ='$menuid'");
$error_msg .= mysql_error();
if($error_msg == "" )
{
   $error_msg = "$link_edit_success_label</p>";
   echo $error_msg;
   echo "<meta http-equiv='refresh' content='0;URL=editmenu.php?op=sort'>";
}else{
   echo "Problem";
}
break;

case "link_edit":
$res = @mysql_query( "SELECT menuid, menuurl FROM CC_menu" );
echo "<form action='editmenu.php?op=link_edit_2nd' method='post'>";
echo "<p><center><label>$select_link_to_edit_label";
echo" <select name='menuid'>";
while( $row = mysql_fetch_array( $res ) )
{
        echo "<option value=\"" . $row[ 'menuid' ] . "\">" . $row[ 'menuurl' ] . "</option>\n";
}
echo "</select>";
echo "</label></p>";
echo "<p><center><input type='submit' value='$link_edit_button_label' class = 'buttons'/></p>";
echo "</form>";
break;

case 'link_edit_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_menu WHERE menuid = " . $_POST[ 'menuid' ] );
$error_msg = "";
 if( !isset( $_POST['menuid'] ) )
     $error_msg .= "<p>$missing_post_data_error</p>";
     else
     {
         include "connect.inc";
         $res = @mysql_query( "SELECT * FROM CC_menu WHERE menuid = " . $_POST[ 'menuid' ] );
         $error_msg .= mysql_error();
         {
         if( $error_msg == "" )
         {
             $row = mysql_fetch_array( $res );
             if( $error_msg == "" )
             {
                 echo "$editing_this_link_label&nbsp;";
                 echo $_POST['menuid'];
                 $error_msg .= mysql_error();
             }
         }
     }
 }
 if( $error_msg == "" ){
     $error_msg .= "";
     echo "<form method='post' action='editmenu.php?op=link_edit_3rd'>";
     echo "<p align = 'center'><label>$edit_this_link_label<br><input type='text' name='menuurl' value= '$row[menuurl]' size = '40'></label></p>";
     echo "<p align = 'center'><label>$edit_this_description_label<br><input type='text' name='menuname' value=  '$row[menuname]' size = '40'></label></p>";
     echo "<p align = 'center'><label>$edit_this_hover_label<br><input type='text' name='menualt' size = '60' value= '$row[menualt]'></label></p>";
     echo "<p align = 'center'><label>$where_open_link_label<br> </label> ";
     echo "<select size='1' name='target'>";
     if  ($row[target]=='_new'){
          echo "<option value='_new'>$new_page_label</option>";
          echo "<option value=''>$same_page_label</option>";
     }else{
           echo "<option value=''>$same_page_label</option>";
           echo "<option value='_new'>$new_page_label</option>";
     }
     echo "</select>";
     echo "<p align = 'center'><label><br><input type='hidden' name='ID' size = '40' value= '$row[menuid]'></label></p>";
     echo "$block_view_show_label<br>";
     echo "<select name='view'>";
     if($row[view]=="0")
     {
           echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option>";
           echo "<option value='1'>$view_by_members_label</option>";
           echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
           echo "<option value='5' style='color: #000000'>$link_is_off_label</option></select>";
     }
     elseif($row[view]=="1")
     {
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option>";
                echo "<option value='5' style='color: #000000'>$link_is_off_label</option>";
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option></select>";
     }
     elseif($row[view]=="2")
     {
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='5' style='color: #000000'>$link_is_off_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option></select>";
     }
     elseif($row[view]=="5")
     {
                echo "<option value='5' style='color: #000000'>$link_is_off_label</option>";
                echo "<option value='1'>$view_by_members_label</option>";
                echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
                echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option></select>";
     }
     echo "<p><input type='submit' value='$confirm_edit_button_label'class = 'buttons'></p>";
     echo "</form>";
     echo $error_msg;
 }
 else {
      echo "<br>$edit_link_problem_error";
}

break;

case "link_edit_3rd":
$error_msg = "";
if( !isset( $_POST['menualt'] ) && !isset( $_POST['menuurl'] )&& !isset( $_POST['menuname'] )&& !isset( $_POST['ID'] ))
    $error_msg .= "<p>$missing_post_data_error</p>";
    else
    {
        include "connect.inc";
        $menualt=$_POST['menualt'];
        $view=$_POST['view'];
        $menuurl=$_POST['menuurl'];
        $menuname=$_POST['menuname'];
        $target=$_POST['target'];
        $ID=$_POST['ID'];
        @mysql_query ("UPDATE CC_menu SET view='$view',target='$target',menualt='$menualt', menuname='$menuname', menuurl='$menuurl' WHERE menuid ='$ID'");
        $error_msg .= mysql_error();
    }
    if($error_msg == "" )
        $error_msg = "$link_edit_success_label</p>";
        echo $error_msg;
        echo "<meta http-equiv='refresh' content='0;URL=editmenu.php'>";
break;

case "link_del":
include "connect.inc";
$res = @mysql_query( "SELECT menuid, menuurl FROM CC_menu" );
$num_results = mysql_num_rows($res);
echo "<br>$delete_link_warning_label<br>";
echo "<form action='editmenu.php?op=link_del_2nd' method='post'>";
echo "<p><label><center>$select_link_to_delete_label";
echo "<select name='menuid'>";
while( $row = mysql_fetch_array( $res ) )
{
   echo "<option value=\"" . $row[ 'menuid' ] . "\">" . $row[ 'menuurl' ] . "</option>\n";
}
echo "<p><input type='submit' value='Delete' class = 'buttons'></p>";
echo "</form>";
break;


case 'link_del_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_menu WHERE menuid = " . $_POST[ 'menuid' ] );
$error_msg = "";
if( !isset( $_POST['menuid'] ) )
{
 $error_msg .= "<p>$missing_post_data_error</p>";
}else{
       include "connect.inc";
       $res = @mysql_query( "SELECT * FROM CC_menu WHERE menuid = " . $_POST[ 'menuid' ] );
       $error_msg .= mysql_error();
}
if( $error_msg == "" )
{
     $row = mysql_fetch_array( $res );
     if( $error_msg == "" )
     {
         @mysql_query( "DELETE FROM CC_menu WHERE menuid = " . $_POST['menuid'] );
         $error_msg .= mysql_error();
     }
}
if( $error_msg == "" )
{
     $error_msg .= "<br><center>$link_delete_success_label";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editmenu.php'>";
}
else {
          echo '<br>$problem_deleting_link_error<br>';
          echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
break;

case "add_link":
echo "<form method='post' action='editmenu.php?op=add_link2nd'>";
echo "<p align = 'center'><label>$add_menu_address_label<br><input type='text' name='menuurl' size = '40'></label></p> ";
echo "<p align = 'center'><label>$add_menuname_label<br><input type='text' name='menuname' size = '40'></label></p>";
echo "<p align = 'center'><label>$add_link_hover_label<br> <input type='text' name='menualt' size = '60'></label> ";
echo "<p align = 'center'><label>$where_open_link_label<br> </label> ";
echo "<select size='1' name='target'>";
echo "<option value=''>$same_page_label</option>";
echo "<option value='_new'>$new_page_label</option></select>";
echo "<p align = 'center'>$block_view_show_label<br>";
echo "<select name='view'>";
echo "<option value='0' style='color: #FFFFFF'>$view_by_all_label</option>";
echo "<option value='1'>$view_by_members_label</option>";
echo "<option value='2' style='color: #FF6D01'>$view_by_admin_label</option>";
echo "<option value='5' style='color: #000000'>$link_is_off_label</option></select><br>";
echo "<p><input type='submit' value=$add_link_button_label class = 'buttons'></p> ";
echo "</form>";
break;

case 'add_link2nd':
$error_msg = "";
if( !isset( $_POST['menuurl'] ) && !isset( $_POST['menuname'] ))
$error_msg .= "<p>$missing_post_data_error</p>";
else
{
     include "connect.inc";
     $menuurl=$_POST['menuurl'];
     $view=$_POST['view'];
     $menuname=$_POST['menuname'];
     $menualt=$_POST['menualt'];
     $target=$_POST['target'];
     @mysql_query( "INSERT INTO CC_menu(view, target, menualt, menuname, menuurl ) VALUES('$view','$target','$menualt', '$menuname', '$menuurl')" );
     $error_msg .= mysql_error();
}
if( $error_msg == "" )
     $error_msg = "<p><center>$add_link_link_added_label</p>";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editmenu.php'>";
break;
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>