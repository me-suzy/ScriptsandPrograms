<?php
echo "<br><center><form action='results.php' method='post'>";
echo "$search_by_label<br>";
echo "<select name='searchtype'>";
echo "<option value='author'>$author_label</option>";
echo "<option value='introcontent'>$short_text_label</option>";
echo "<option value='maincontent'>$long_text_label</option>";
echo "<option value='newstitle'>$title_label</option><br>";
echo "<option value='category'>$category_label</option></select><br>";
echo "$search_terms_label<br>";
echo "<input name='searchterm' type='text' size='20' class='text'><br><br>";
echo "<input type='submit' value=$search_button_label class='buttons'><br><br></form>";
echo "</font>";
?>