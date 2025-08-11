<?php
session_start();
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$aquery =  ("SELECT * FROM CC_menu ORDER By weighting ASC") or die($no_menu_error);
$aresult = mysql_query($aquery);
if ((isset($_SESSION['cuser'])) || (isset($_SESSION['cadmin']))){
  while($arow = mysql_fetch_array($aresult)){
       if (isset($_SESSION['cuser'])){
          if (($arow[view]=='1') || ($arow[view]=='0')){
                  echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title='$arow[menualt]' target = '$arow[target]' href='$arow[menuurl]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>&#9702; $arow[menuname]</a></font>";
                  echo "<br>";
          }
       }
       if (isset($_SESSION['cadmin'])){
               if ($arow[view]=='2'){
                  echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title='$arow[menualt]' target = '$arow[target]' href='$arow[menuurl]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>&#9702; $arow[menuname]</a></font>";
                  echo "<br>";
               }
       }
  }
}
else{
    while($arow = mysql_fetch_array($aresult)){
        if ($arow[view]=='0'){
             echo "<font face=$getprefs3[link_fontface] size=$getprefs3[link_fontface_size]><a title='$arow[menualt]' target = '$arow[target]' href='$arow[menuurl]'style='text-decoration: none'><font color=$getprefs3[linkfont_color]>&#9702; $arow[menuname]</a></font>";
             echo "<br>";
        }
   }
}
?>