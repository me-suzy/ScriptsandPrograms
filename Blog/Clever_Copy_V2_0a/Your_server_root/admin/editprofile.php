<?php
session_start();
include "languages/default.php";
?>
<head><title><?php echo $profile_edit_title; ?></title>
<?php
echo "<link rel='stylesheet' href='$style' type='text/css'></head>";
include "connect.inc";
$cadmin=$_SESSION['cadmin'];
$getadmin="SELECT * from CC_admin where username='$cadmin'";
$getadmin2=mysql_query($getadmin) or die($no_admin_error);
$getadmin3=mysql_fetch_array($getadmin2);
if($getadmin3['status']==3)
{
   include "index.php";
   if(isset($_POST['submit']))
   {
      $name=$_POST['name'];
      $gender=$_POST['gender'];
      $birthdate=$_POST['birthdate'];
      $location=$_POST['location'];
      $hobbies=$_POST['hobbies'];
      $job=$_POST['job'];
      $quote=$_POST['quote'];
      $mail=$_POST['mail'];
      $editprof="update CC_profile set email='$email',quote='$quote',job='$job',hobbies='$hobbies',location='$location',birthdate='$birthdate',name='$name',gender='$gender'";
      mysql_query($editprof) or die($unable_to_save_preferences_error);
      echo $preferences_saved_label;
      echo "<meta http-equiv='refresh' content='0;URL=editprofile.php'>";
   }else{
       $getprof="SELECT * from CC_profile";
       $getprof2=mysql_query($getprof) or die($no_profile_error);
       $getprof3=mysql_fetch_array($getprof2);
       echo "<br><br>";
       $textsize= $getprefs3[text_font_size];
       $textsize = ($textsize+9);
       echo "<table border='0' cellspacing='3' width='100%' style='border-collapse: collapse; border: 1px solid $getprefs3[blockbordercolor]'>";
       echo "<tr bgcolor=$getprefs3[block_heading_background_color]><td colspan='4'><left>";
       echo "<font face=$getprefs3[block_heading_font_face] size=$getprefs3[block_heading_font_size] color=$getprefs3[block_heading_font_color]><$getprefs3[block_heading_font_decoration]>$edit_profile_label</font></b></center></td></tr>";
       echo "<td  bgcolor=$getprefs3[block_background_color] colspan = '4'>";
       echo "<br><img src='../images/information.gif'>  $edit_profile_warning_message<br><br>";
       echo "<td width='10%' bgcolor=$getprefs3[block_background_color]>";
       echo "<tr><td width= '20%'>";
       echo "<b>$item_label</b>";
       echo "<td width= '80%'>";
       echo "<b>$current_settings_label</b>";
       echo "<tr><td width= '20%'>";
       echo "<form action='editprofile.php' method='post'>";
       echo $prof_name_label;
       echo "<td width= '80%'>";
       echo "<input type ='text'  name='name' size='20' value='$getprof3[name]'>";
       echo "<tr><td width= '20%'>";
       echo $prof_birthdate_label;
       echo "<td width= '80%'>";
       echo "<input type='text' name='birthdate' size='20' value='$getprof3[birthdate]'>";
       echo "<tr><td width= '20%'>";
       echo $prof_location_label;
       echo "<td width= '80%'>";
       echo "<input type='text' name='location' size='20' value='$getprof3[location]'>";
       echo "<tr><td width= '20%'>";
       echo $prof_job_label;
       echo "<td width= '80%'>";
       echo "<input type='text' name='job' size='20' value='$getprof3[job]'>";
       echo "<tr><td width= '20%'>";
       echo $prof_gender_label;
       echo "<td width= '80%'>";
       echo "<select name='gender'>";
       if($getprof3[gender]=="Male")
       {
           echo "<option value='Male'>$male_label</option>";
           echo "<option value='Female'>$female_label</option>";
           echo "<option value='Undisclosed'>$prof_undisclosed_label</option>";
           echo "<option value=''>$blank_label</option>";
       }
       elseif ($getprof3[gender]=="Female")
       {
                echo "<option value='Female'>$female_label</option>";
                echo "<option value='Male'>$male_label</option>";
                echo "<option value='Undisclosed'>$prof_undisclosed_label</option>";
                echo "<option value=''>$blank_label</option>";
       }
       elseif ($getprof3[gender]=="")
       {
                echo "<option value=''>$blank_label</option>";
                echo "<option value='Male'>$male_label</option>";
                echo "<option value='Undisclosed'>$prof_undisclosed_label</option>";
                echo "<option value='Female'>$female_label</option>";
       }else{
                echo "<option value='Undisclosed'>$prof_undisclosed_label</option>";
                echo "<option value='Male'>$male_label</option>";
                echo "<option value='Female'>$female_label</option>";
                echo "<option value=''>$blank_label</option></select>";
      }
      echo "<tr><td width= '20%'>";
      echo $prof_hobbies_label;
      echo "<td width= '80%'>";
      echo "<input type='text' name='hobbies' size='80' value='$getprof3[hobbies]'>";
      echo "<tr><td width= '20%'>";
      echo $prof_quote_label;
      echo "<td width= '80%'>";
      echo "<input type='text' name='quote' size='80' value='$getprof3[quote]'>";
      echo "<tr><td width= '20%'>";
      echo $prof_email_label;
      echo "<td width= '80%'>";
      echo "<input type='text' name='mail' size='20' value='$getprof3[email]'>";
      echo "<tr><td width= '20%'>";
      echo "<td width= '80%'>";
      echo "<br><input type='submit' name='submit' value='$save_button_label' class = 'buttons'></form>";
   }
}else{
  echo $no_login_error;
  include "index.php";
}
?>