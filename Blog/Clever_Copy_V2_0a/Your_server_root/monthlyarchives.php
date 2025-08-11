<?php
echo "<form action='archive.php' method='post'>";
echo "<br><center>";
echo "$month_label - <select name='month'>";
echo "<option value='1'>$jan_label</option>";
echo "<option value='2'>$feb_label</option>";
echo "<option value='3'>$mar_label</option>";
echo "<Option value='4'>$apr_label</option>";
echo "<option value='5'>$may_label</option>";
echo "<option value='6'>$jun_label</option>";
echo "<option value='7'>$jul_label</option>";
echo "<option value='8'>$aug_label</option>";
echo "<option value='9'>$sep_label</option>";
echo "<option value='10'>$oct_label</option>";
echo "<Option value='11'>$nov_label</option>";
echo "<option value='12'>$dec_label</option></select>";
echo "<br>";
echo "$year_label - &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
echo "<input type='text' name='year' size='4'  value=$set_archive_year_label><br><br>";
echo "<input type='submit' name='submit' value=$get_archives_button_label class= 'buttons'><br><br></form>";
?>