<?php
function fbmdf($strg){
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