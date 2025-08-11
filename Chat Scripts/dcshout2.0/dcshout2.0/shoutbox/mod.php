<?
//Dc-shout2.0 (c)devilcoderz 2004
if ($show== "")
{

//dc shout 2.0 bata codez.darkdevils.co.uk
include "admin/config.php";
include "template/$theme/top.htm" ;
include "inc/functions.php";



//start codes
$setstart = mysql_query("select * from dc_setings WHERE id='1'");
$settings=mysql_fetch_array($setstart);



//just makeing it making it more tidy
$box = $settings[shout] ;
$bc =  $settings[bbcode] ;
$word =  $settings[word] ;
if ($box== "y")  // is the shoutbox on ?
{
//lets show these nice people there shouts
$result = mysql_query("select * from dc_shoutbox order by id desc limit 10 ");
while($r=mysql_fetch_array($result))
{
$bb = $r[text] ;//starts off the bb thing
if ($bc == "y") //if on y it should be on
{
$bb = str_replace("DD", "<b>Darkdevils</b>", $bb);
$bb = str_replace("<f red>", "<font color=red>", $bb);
$bb = str_replace("<f green>", "<font color=green>", $bb);
$bb = str_replace("<f blue>", "<font color=blue>", $bb);
$bb = str_replace("<f gray>", "<font color=gray>", $bb);
$bb = str_replace("<f gold>", "<font color=gold>", $bb);
$bb = str_replace("</f>", "</font>", $bb);
}
$loop_template = @implode("", @file("template/$theme/post.htm"));
$template = str_replace("{name}", $r['name'], $loop_template);
$template = str_replace("{mess}", $bb, $template);
echo $template ;
}
}
if ($box== "n")//hope the shoutbox is not off lol
{
echo "Shoutbox offline :(";
}
}

















if ($show== "bb")
{
print"
<center><b>::BB codes::</b></center>
<br>
<br>
Red text = &lt;f red&gt;text here&lt;/f&gt;
<br>
Green text = &lt;f green&gt;text here&lt;/f&gt;
<br>
Blue text = &lt;f blue&gt;text here&lt;/f&gt;
<br>
Gray text = &lt;f gray&gt;text here&lt;/f&gt;
<br>
Gold text = &lt;f gold&gt;text here&lt;/f&gt;
<br>
Drakdevils = DD
<br>
<br>
<br>
";
}
?>








