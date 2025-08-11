<?php
//Dc-shout2.0 (c)devilcoderz 2004
include "header.php";
if (!session_is_registered(username)) {
echo "Your not loged in!" ;
}
else
{
include "config.php";
?>
<center><b>Word fillter</b></center>
<br>
<br>
<?php
if ($action=="")
{
print "Words blocked at the moment are:<br>";
$gwords= mysql_query("select * from dc_word");
while ($w=mysql_fetch_array($gwords))
{
print "$w[word] <a href=\"word.php?action=del&id=$w[id]\">Delete</a>";
}
echo"<center><b>Add new word</b></center><br>";
?>
<form action="word.php?action=add" method="POST">
<input type="text" NAME="word" size="11"><br>
<input type="submit" value="Submit" name="submit">
</form>
<?

}
//Delte word
if ($action=="del")
{
$sql = "DELETE FROM dc_word WHERE id='$_GET[id]'"or die ('No Such Word!');
$result = mysql_query($sql);
echo "The word was deleted form the fillter";
}
//addword O.o
if ($action=="add")
{
if (!$_POST['word'])
{
echo "You did not enter a word :(";
}
else
{
$result = MYSQL_QUERY("INSERT INTO dc_word (id, word)". "VALUES ('NULL', '$_POST[word]')"); // inssert done
echo "Badword  added :)";
}
}
}
include "footer.php";
?>






