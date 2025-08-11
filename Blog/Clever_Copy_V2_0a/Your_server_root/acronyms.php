<?php
include "languages/default.php";
include "admin/connect.inc";
include "admin/languages/default.php";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<?php
echo "<center>$acronym_example_label</center>";
echo "<form action='acronyms.php?op=search' method='post'>";
echo "<center><input type='text' name='acronym'>";
echo "<br><center><input type='submit' value='$search_button_label' class = 'buttons'>";
echo "</form>";
switch($_GET['op'])
{
case "search":
$searchterm = $_POST['acronym'];
$acroquery = ("SELECT * FROM CC_acronyms WHERE acronym LIKE '%".$searchterm."%' ORDER by meaning") or die ($no_acronyms_error);
$acroresult = mysql_query($acroquery);
$acronum_results = mysql_num_rows($acroresult);
echo "<table width = '100%' border = '0'><tr><td>";
echo "<center><b>$acronum_results</b> $matches_label</center>";
echo "<center><tr><td>";
for ($i=0; $i <$acronum_results; $i++)
{
   $acrorow = mysql_fetch_array($acroresult);
   if ($i >= '1'){
        echo "$or_label<br>";
   }
   echo "<center>$searchterm (<b>$acrorow[acronym]</b>) </b> $means_label<b><br>$acrorow[meaning]</b><br>";
}
echo "</table></center></font>";
break;
}
?>