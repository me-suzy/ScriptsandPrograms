<?php
session_start();
include"languages/default.php";
include"../languages/default.php";
include "connect.inc";
?>
<html><head>
<title><?php echo $category_edit_title; ?></title>
<script>
<!-- Begin
function goTodelURL() { window.location = "editcategories.php?op=link_del"; }
//  End -->
</script>
<script>
<!-- Begin
function goToeditURL() { window.location = "editcategories.php?op=link_edit"; }
//  End -->
</script>
<script>
<!-- Begin
function goTorefreshURL() { window.location = "editcategories.php?op=link_rfrsh"; }
//  End -->
</script>
<script>
<!-- Begin
function goToaddURL() { window.location = "editcategories.php?op=add_link"; }
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
$query =  ("SELECT * FROM CC_categories ORDER By category ASC") or die($no_menu_error);
$result = mysql_query($query);
echo "<br><br>";
echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='6'><left>";
echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_categories_label</font></b></center></td></tr>";
echo "<tr><td bgcolor=$getprefs3[block_background_color] colspan = '6'>";
echo "<br><img src = '../images/information.gif'> $category_exp_label<br><br>";
echo "<tr><td width='10%' valign = 'top'>";
echo "<b>$category_label</b>";
echo "<td width='20%' valign = 'top'>";
echo "<b>$category_image_path_label</b>";
echo "<td width='20%' valign = 'top'>";
echo "<b>$category_image_label</b>";
echo "<td width='50%' valign = 'top'>";
echo "<b>$category_describe_label</b>";
while( $row = mysql_fetch_array($result))
{
        echo "<tr><td width='10%'>";
        echo $row['category'] ;
        echo "<td width='20%'>";
        $imagepath = $row['image'];
        echo $imagepath;
        echo "<td width='20%'>";
        $image = "$siteaddress/$imagepath";
        echo "<img src = '$image'>";
        echo "<td width='50%'>";
        echo $row['description'];
}
echo"</tr></td></table>";
echo "<br>";
echo "<p align = 'center'>";
echo "<input type=button value='$add_category_button_label' class = 'buttons' onClick='goToaddURL()'>&nbsp;";
echo "<input type=button value='$edit_category_button_label' class = 'buttons' onClick='goToeditURL()'>&nbsp;";
echo "<input type=button value='$delete_category_button_label' class = 'buttons' onClick='goTodelURL()'>&nbsp;";
echo "<input type=button value='$refresh_button_label' class = 'buttons' onClick='goTorefreshURL()'>&nbsp;";
echo "</p align><br><br>";
switch( $_GET[ 'op' ] )
{

case "link_edit":
$res = @mysql_query( "SELECT id, category FROM CC_categories" );
echo "<form action='editcategories.php?op=link_edit_2nd' method='post'>";
echo "<p><center><label>$select_link_to_edit_label";
echo" <select name='menuid'>";
while( $row = mysql_fetch_array( $res ) )
{
        echo "<option value=\"" . $row[ 'id' ] . "\">" . $row[ 'category' ] . "</option>\n";
}
echo "</select>";
echo "</label></p>";
echo "<p><center><input type='submit' value='$edit_category_button_label' class = 'buttons'/></p>";
echo "</form>";
break;

case 'link_edit_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_categories WHERE id = " . $_POST[ 'menuid' ] );
$error_msg = "";
 if( !isset( $_POST['menuid'] ) )
     $error_msg .= "<p>$missing_post_data_error</p>";
     else
     {
         $res = @mysql_query( "SELECT * FROM CC_categories WHERE id = " . $_POST[ 'menuid' ] );
         $error_msg .= mysql_error();
         {
         if( $error_msg == "" )
         {
             $row = mysql_fetch_array( $res );
             if( $error_msg == "" )
             {
                 echo "$editing_this_category_label&nbsp;";
                 echo $row['category'];
                 $error_msg .= mysql_error();
             }
         }
     }
 }
 if( $error_msg == "" ){
     $error_msg .= "";
     echo "<form method='post' action='editcategories.php?op=link_edit_3rd'>";
     echo "<p align = 'center'><label>$edit_this_category_label<br><input type='text' name='category' value= '$row[category]' size = '40'></label></p>";
     echo "<p align = 'center'><label>$edit_category_description_label<br><input type='text' name='description' value=  '$row[description]' size = '40'></label></p>";
     echo "<p align = 'center'><label>$edit_category_image_label<br><input type='text' name='image' size = '60' value= '$row[image]'></label></p>";
     echo "<p align = 'center'><label><br><input type='hidden' name='ID' size = '40' value= '$row[id]'></label></p>";
     echo "<p><input type='submit' value='$confirm_edit_button_label'class = 'buttons'></p>";
     echo "</form>";
     echo $error_msg;
 }
 else {
      echo "<br>$edit_category_problem_error";
}

break;

case "link_edit_3rd":
$error_msg = "";
if( !isset( $_POST['category'] ) && !isset( $_POST['description'] )&& !isset( $_POST['image'] )&& !isset( $_POST['ID'] ))
    $error_msg .= "<p>$missing_post_data_error</p>";
    else
    {
        include "connect.inc";
        $category=$_POST['category'];
        $image=$_POST['image'];
        $description=$_POST['description'];
        $ID=$_POST['ID'];
        @mysql_query ("UPDATE CC_categories SET category='$category',image='$image',description='$description' WHERE id ='$ID'");
        $error_msg .= mysql_error();
    }
    if($error_msg == "" )
        $error_msg = "$category_edit_success_label</p>";
        echo $error_msg;
        echo "<meta http-equiv='refresh' content='0;URL=editcategories.php'>";
break;

case "link_del":
include "connect.inc";
$res = @mysql_query( "SELECT id, category FROM CC_categories" );
$num_results = mysql_num_rows($res);
echo "<br>$delete_category_warning_label<br>";
echo "<form action='editcategories.php?op=link_del_2nd' method='post'>";
echo "<p><label><center>$select_category_to_delete_label<br><br>";
echo "<select name='menuid'><br>";
while( $row = mysql_fetch_array( $res ) )
{
   echo "<option value=\"" . $row[ 'id' ] . "\">" . $row[ 'category' ] . "</option>\n";

}
echo "</select>";
echo "<br><br><input type='submit' value='Delete' class = 'buttons'></form>";
break;


case 'link_del_2nd':
include "connect.inc";
$res = @mysql_query( "SELECT * FROM CC_categories WHERE id = " . $_POST[ 'menuid' ] );
$error_msg = "";
if( !isset( $_POST['menuid'] ) )
{
 $error_msg .= "<p>$missing_post_data_error</p>";
}else{
       include "connect.inc";
       $res = @mysql_query( "SELECT * FROM CC_categories WHERE id = " . $_POST[ 'menuid' ] );
       $error_msg .= mysql_error();
}
if( $error_msg == "" )
{
     $row = mysql_fetch_array( $res );
     if( $error_msg == "" )
     {
         @mysql_query( "DELETE FROM CC_categories WHERE id = " . $_POST['menuid'] );
         $error_msg .= mysql_error();
     }
}
if( $error_msg == "" )
{
     $error_msg .= "<br><center>$category_delete_success_label";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editcategories.php'>";
}
else {
          echo '<br>$problem_deleting_category_error<br>';
          echo "$error_message_was_label<font color = 'red'> $error_msg </font>";
}
break;

case "add_link":
echo "<form method='post' action='editcategories.php?op=add_link2nd'>";
echo "<p align = 'center'><label>$add_category_name_label<br><input type='text' name='category' size = '60'></label></p> ";
echo "<p align = 'center'><label>$add_category_image_label<br><input type='text' name='image' size = '60' value  = '/images/'></label></p>";
echo "<p align = 'center'><label>$add_category_description_label<br> <input type='text' name='description' size = '60'></label> ";
echo "<p><input type='submit' value=$add_category_button_label class = 'buttons'></p> ";
echo "</form>";
break;

case 'add_link2nd':
$error_msg = "";
if( !isset( $_POST['category'] ) && !isset( $_POST['description'] ))
$error_msg .= "<p>$missing_post_data_error</p>";
else
{
     include "connect.inc";
     $category=$_POST['category'];
     $description=$_POST['description'];
     $image=$_POST['image'];
     @mysql_query( "INSERT INTO CC_categories(category, description, image) VALUES('$category','$description','$image')" );
     $error_msg .= mysql_error();
}
if( $error_msg == "" )
     $error_msg = "<p><center>$category_added_success_label</p>";
     echo $error_msg;
     echo "<meta http-equiv='refresh' content='0;URL=editcategories.php'>";
break;
}
}else{
  echo $no_login_error;
  include "index.php";
}
?>