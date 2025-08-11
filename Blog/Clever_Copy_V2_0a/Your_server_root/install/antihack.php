<?php
function antihax($text) {
$text = str_replace("http://","",$text);
$text = str_replace("\"","&quot;",$text);
$text = str_replace("/","",$text);
$text = str_replace(chr(10),"",$text);
$text = strip_tags ($text, "");
$text = str_replace(chr(13), "<br>", $text);
$text = str_replace("'","&#39;",$text);
return($text);
}

function antihaxmnr($text) {
$text = str_replace("http://","",$text);
$text = str_replace("\"","&quot;",$text);
$text = str_replace(chr(10),"",$text);
$text = strip_tags ($text, "");
$text = str_replace(chr(13), "<br>", $text);
$text = str_replace("'","&#39;",$text);
return($text);
}

function truncatetext($text,$limit)
{
  if( strlen($text)>$limit ){
    $text = substr( $text,0,$limit );
    $text = substr( $text,0,-(strlen(strrchr($text,' '))) );
  }
return $text;
}

function backlinkCheck($siteurl,$recip)
{
   $arrText = file($siteurl);
   for ($i=0; $i<count($arrText);$i++)
   {
      $text = $text . $arrText[$i];
   }
   if (eregi($recip,$text)) {
       return true;
   }else{
       return false;
   }
}

function sesson($ses){
$reg = $ses;
$num = mt_rand(3,9);
for($i=1;$i<=$num;$i++)
  {
  $reg =
  base64_encode($reg);
}
$alpha_array = array('Y','D','U','R','P','S','B','M','A','T','H');
$reg = $reg."+".$alpha_array[$num];
$reg = base64_encode($reg);
return $reg;
}



function registre($strg){
$alpha_array = array('Y','D','U','R','P','S','B','M','A','T','H');
$reg = base64_decode($strg);
list($reg,$letter) = split("\+",$reg);
for($i=0;$i<count($alpha_array);$i++)
   {
   if($alpha_array[$i] == $letter)
   break;
}
for($x=1;$x<=$i;$x++)
   {
   $reg=base64_decode($reg);
}
$reg = stripslashes($reg);
return $reg;
}
?>