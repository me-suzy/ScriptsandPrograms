<?php
include "languages/default.php";
include "admin/connect.inc";
$getprefs="SELECT * from CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
echo "<link rel='stylesheet' href='$style' type='text/css'>";
$mth[0]="-";
$mth[1]=$jan_long_label;
$mth[2]=$feb_long_label;
$mth[3]=$mar_long_label;
$mth[4]=$apr_long_label;
$mth[5]=$may_long_label;
$mth[6]=$jun_long_label;
$mth[7]=$jul_long_label;
$mth[8]=$aug_long_label;
$mth[9]=$sep_long_label;
$mth[10]=$oct_long_label;
$mth[11]=$nov_long_label;
$mth[12]=$dec_long_label;
$dy[0]=$sun_long_label;
$dy[1]=$mon_long_label;
$dy[2]=$tue_long_label;
$dy[3]=$wed_long_label;
$dy[4]=$thu_long_label;
$dy[5]=$fri_long_label;
$dy[6]=$sat_long_label;
$setdy=(int)date("w");
$setmth=(int)date("m");
$serveroffset = $getprefs3[time_offset];
$timeadjust = ($serveroffset * 60);
$currenttime = date(" H:i",time() + $timeadjust);
if ($getprefs3[dateset] =="1"){
echo $dy[$setdy];
echo "<br>";
echo date("d")." ".$mth[$setmth]." ".date("Y");
echo"<br>";
echo $currenttime;
echo "<br>";
}else{
echo $dy[$setdy];
echo "<br>";
echo " ".$mth[$setmth]." ".date("d")." ".date("Y");
echo"<br>";
echo $currenttime;
echo "<br>";
}
?>