<?php
//Dc-shout2.0 (c)devilcoderz 2004
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

//Dis the use add a shout hummm
if ($submit)
{
if (!$_POST['user'])
{
die('You did not put in a name.<u><a href=javascript:%20history.back(-2)>Back</a></u>.') ;
}
if (!$_POST['message'])
{
die('You did not put in a message.<u><a href=javascript:%20history.back(-2)>Back</a></u>.') ;
}
$post = $_POST[message] ;
if ($word== "y")
{
//lets do some word blocking
$word = mysql_query("select * from dc_word");
while($w=mysql_fetch_array($word))
{
$post = str_replace("$w[word]", "****", $post) ;
}
}
$add = strip_tags($post) ;
$add = mysql_escape_string($add);
$addtwo = strip_tags($_POST[user]) ;
$addtwo = mysql_escape_string($addtwo);
$ip = $REMOTE_ADDR ; //makes the vistors ip store in db all ways on
$result = MYSQL_QUERY("INSERT INTO dc_shoutbox (id, name, text, ip)". "VALUES ('NULL', '$addtwo', '$add', '$ip')"); // inssert done
//show the posts
}



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
?>























