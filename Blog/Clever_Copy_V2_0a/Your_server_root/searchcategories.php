<?php
echo "<br><center><form action='categorysearch.php' method='post'>";
echo "$search_by_label<br>";
echo "<select name='category'>";
$getcat="SELECT * from CC_categories";
$getcat2=mysql_query($getcat) or die($no_categories_error);
while($getcat3=mysql_fetch_array($getcat2))
{
        echo "<option value=\"" . $getcat3[ "category" ] . "\">". $getcat3[ "category" ] . "</option>\n";
}
echo "</select><br><br>";
echo "$search_terms_label<br>";
echo "<input name='searchterm' type='text' size='20' class='text'><br><br>";
echo "<input type='submit' value=$search_button_label class='buttons'><br><br></form>";
echo "</font>";
?>