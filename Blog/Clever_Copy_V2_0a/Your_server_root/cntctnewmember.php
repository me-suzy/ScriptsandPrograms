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
<head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
echo "<body bgcolor=$getprefs3[block_background_color]>";
$siteemail = antihax($getprefs3['siteemail']);
$siteemail=registre($siteemail);
$destination_email = antihax($_POST[destination_email]);
$username = antihax($_POST[username]);
$usercheck = antihax($_POST[usercheck]);
$password = antihax($_POST[password]);
$welcome_email_label = antihax($_POST[welcome_email_label]);
$welcome_email_label_cont = $_POST[welcome_email_label_cont];
$sendurl = antihax($_POST[sendurl]);
$new_member_subject = antihax ($_POST[new_member_email_subject]);
if($HTTP_POST_VARS)
        {
        mail("$destination_email","$new_member_confirmation_email_subject","$username$welcome_email_label\n  $password_label $password $username_label $username\n  $welcome_email_label_cont","FROM: $siteemail");
        echo "<center><b>$email_sent_label</b>";
        echo "<center><b>$email_sent_check_inbox_label</b>";
        echo "<center>$if_you_see_label <a href='register.php'>$click_here_label</a></center>";
        echo "<meta http-equiv='refresh' content='2;URL=register.php'>";
    }
    else
    {
    echo "<center><b>$missing_post_data_error</b>";
    echo "<center>$if_you_see_label <a href='register.php'>$click_here_label</a></center>";
    echo "<meta http-equiv='refresh' content='2;URL=register.php'>";
}

?>