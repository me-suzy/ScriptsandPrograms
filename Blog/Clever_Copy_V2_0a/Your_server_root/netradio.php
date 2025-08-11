<?php
// This block is supplied with some 'standard' radio stations from the UK & US as standard. You might want to customise
// the available choice of stations by adding your own. To do this perform a search on Google for 'radio feeds'. You
// might want to check out http://www.live-radio.net for a good feed source.
// It is then a case of simply copying the feed addresses into the database table CC_radio. Be careful though! You will
// need to use the same station names in the option drop down list below as you do in the table. If you use a slightly
// different name, the link won't work!
// Here's an example: You find a feed on this address - http://somefeed-somewhere.com/feed.asx. The name of the radio station
// is MYradio FM. In the database table you would add the feed link and the name of the station. If you call the station
// Myradio in the database table, you must use Myradio in the options list below. MYRADio would be different and break the link.
// - Magus Perde,  Jan 2005
include "admin/connect.inc";
include "languages/default.php";
$getprefs="SELECT * FROM CC_prefs";
$getprefs2=mysql_query($getprefs) or die($no_preferences_error);
$getprefs3=mysql_fetch_array($getprefs2);
$style = $getprefs3[personality];
$query =  ("SELECT * FROM CC_radio ORDER By id ASC") or die ($no_login_error);
$result = mysql_query($query);
?>
<html><head><title><?php echo $getprefs3[title]; ?></title>
<link rel="stylesheet" href="<?php echo $style; ?>" type="text/css">
</head>
<base target="_blank">
<?php
if(isset($_POST['submit']))
{
  $station=$_POST['station'];
  while($row = mysql_fetch_array($result))
  {
     if ($station == $row[station])
        {
           $link = $row[link];
        }
  }
echo "<meta http-equiv='refresh' content='0;URL=$link'>";
}else{
?>
<form action='netradio.php' method='post'>
<select name='station'>
<option><?php echo $ukstations_radio_label; ?></option>
<option></option>
<option value = "2CR FM">2CR FM</option>
<option value = "2-Ten FM">2-Ten FM</option>
<option value = "Gemini FM">Gemini FM</option>
<option value = "GWR Bath FM">GWR Bath FM</option>
<option value = "GWR Bristol FM<">GWR Bristol FM</option>
<option value = "GWR Wiltshire FM">GWR Wiltshire FM</option>
<option value = "HertBeat">HertBeat</option>
<option value = "Lantern FM">Lantern FM</option>
<option value = "Mercury FM">Mercury FM</option>
<option value = "NonStopPlay.com">NonStopPlay.com</option>
<option value = "Orchard FM">Orchard FM</option>
<option value = "Plymouth Sound">Plymouth Sound</option>
<option value = "Ram FM">Ram FM</option>
<option value = "The Mix FM">The Mix FM</option>
<option></option>
<option><?php echo $usstations_radio_label; ?></option>
<option></option>
<option value = "MetroMix Radio">MetroMix Radio</option>
<option value = "WBAB.com">WBAB.com</option>
<option value = "WITR">WITR</option>
<option value = "WNYC">WNYC</option>
<option value = "KBCS">KBCS</option>
<option value = "KEXP">KEXP</option>
<option value = "NWPR">NWPR</option>
<option value = "KBAQ">KBAQ</option>
</select>
<br><br><input type='submit' name='submit'  value='<?php echo $radio_listen_button_label; ?>' class = 'buttons'></form>
<?php
}
?>