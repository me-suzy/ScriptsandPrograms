<?php
/* ########################################################################

Copyright (C) 2003 FORTUNE DESIGN
Amazon feed Version 1.0
sales@fortunedesign.co.uk
http://www.fortunedesign.co.uk

######################################################################## */
include('inc/config.php');
include('inc/english.php');
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo TITLE; ?></title>
</head>

<body>
<table width="600"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" class="AmazonTop"><img src="images/amazon-logo.gif" width="153" height="43"></td>
  </tr>
  <tr>
    <td align="center" valign="top" class="AmazonHead">
	
	<table width="200" border="0" align="center" cellpadding="2" cellspacing="2">
      <form action="amazon.php?action=search" method="post"><tr>
        <td align="right" valign="bottom"><img src="images/search.gif" width="140" height="18"></td>
        <td><input name="search"type="text" size="15"></td>
        <td>
		<select name="mode">
          <option value="Blended" ><?php echo AMAZON_ALLPRODUCTS; ?>
		  <option value="Apparel" ><?php echo AMAZON_APPAREL; ?>
          <option value="Books" selected><?php echo AMAZON_BOOKS; ?>
          <option value="Classical" ><?php echo AMAZON_CLASSICAL; ?>
          <option value="DVD" ><?php echo AMAZON_DVD; ?>
          <option value="Electronics" ><?php echo AMAZON_ELECTRONICS; ?>
          <option value="Kitchen" ><?php echo AMAZON_KITCHEN; ?>
          <option value="Music" ><?php echo AMAZON_MUSIC; ?>
          <option value="MusicTracks" ><?php echo AMAZON_MUSIC_TRACKS; ?>
          <option value="OutdoorLiving" ><?php echo AMAZON_OUTDOOR_LIVING; ?>
          <option value="PCHardware" ><?php echo AMAZON_PCHARDWARE; ?>
          <option value="Software" ><?php echo AMAZON_SOFTWARE; ?>
          <option value="VHS" ><?php echo AMAZON_VHS; ?>
          <option value="Video" ><?php echo AMAZON_VIDEO; ?>
          <option value="VideoGames" ><?php echo AMAZON_VIDEO_GAMES; ?>
        </select>
		</td>
        <td width="7%">
		<select name="locale">
          <option value="us" ><?php echo AMAZON_US; ?>
		  <option value="uk" selected><?php echo AMAZON_UK; ?>
          <option value="de" ><?php echo AMAZON_DE; ?>
		  <option value="jp" ><?php echo AMAZON_JP ?>
        </select>
		</td>
        <td width="22%"><input name="submit" type="image" value="Submit" src="images/searchbutton.gif" align="left"><input name="associates_id" value="<?php echo ASSOCIATES_ID; ?>" type="hidden"></td>
      </tr></form>
    </table></td>
  </tr>
  <tr>
    <td><img src="images/ffffff.gif" width="1" height="5"></td>
  </tr>
  <tr>
    <td>
	<?php 
	if($action == "search")
		{
		
/* Start */
if (!$page) {
$page=1;
}

if ($locale=='uk') {
$domain='http://xml-eu.amazon.com'; }
else {
$domain='http://xml.amazon.com'; }

// Search parameters:
$type           ='lite';                 //Don't use this script for the 'heavy' XML!
$show_xml       =false;                  //Change false to true if you want to see the raw XML data (for debugging)
$dev_token      ='barelyreadboo-21'; //Amend to your own developer token. Available from Amazon.
$file           ="$domain/".
			 "onca/xml3?".
			 "locale=$locale".'&'.
			 "dev-t=$dev_token".'&'.
			 "f=xml".'&'.
			 "KeywordSearch=$search".'&'.
			 "mode=$mode".'&'.
			 "page=$page".'&'.
			 "t=$associates_id".'&'.
			 "type=$type".'&';

//Global variables
$totalresults='unknown';

//Get the data from Amazon
function getAmazon($file) {
global $host;
global $show_xml;
global $totalresults;

if ($hf=fopen("$file",'r')) {  //open a file from Amazon
//if ($hf=fopen("http://xml-eu.amazon.com/$file",'r')) {  //open a file from Amazon
if ($show_xml) {                                   //print the raw XML instead of parsing it
  print "<pre>\n";
}
while ($line=fgets($hf,10000)) {                   //handle each line of XML
  if ($show_xml) {                                 //print the raw XML 
	print   htmlentities(rtrim($line))."\n";
  }
  if      (ereg('HTTP/[0-9]\.[0-9] ([13-9].*)$',$line,$Atmp)) {
	if (!$show_xml) print "HTTP error: ".$Atmp[1]."<br>\n";
  }
  else if (eregi('<ProductInfo><ErrorMsg>(.*)</ErrorMsg></ProductInfo>',$line,$Atmp)) {
	if (!$show_xml) print "Amazon search error: ".$Atmp[1]."<br>\n";
  }
  else if (eregi('<TotalResults>(.*)</TotalResults>',$line,$Atmp)) {
	$totalresults=$Atmp[1];
  }
  else if (eregi('<details url="(.*)">',$line,$Atmp)) {
	$E[url]=$Atmp[1];
  }
  else if (eregi("<(.*)>(.*)</.*>",$line,$Ares)) {
	$tag =$Ares[1];
	$data=$Ares[2];
	if ($tag=='Author') {  //there can be multiple authors so put in sub array
	  $E[$tag][]=$data;
	}
	else {
	  $E[$tag]=$data;
	}
  }
  else if (eregi("</details>",$line)) {
	$A[]=$E;
	$E=array();    //empty array again
  }
}
if ($show_xml) {   //print the raw XML instead of parsing it into an array?
  print "</pre>\n";
}
}
else die("Can't open socket for xml.amazon.com.<br>\n");
return $A;
}

//Print the array
function printAmazon($A) {
global $associates_id;
global $totalresults;

//Print_array($A);
echo "<table width=\"468\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">";
echo "<tr>";
echo "<td align=\"left\" valign=\"top\" class=\"AmazonSearchBackground\"><img src=\"images/box_left.gif\" width=\"9\" height=\"19\"></td>";
echo "<td class=\"AmazonSearchBackground\">" . QUANTITY_FOUND ."" . SPACE ."". $totalresults . "</td>";
echo "<td align=\"right\" valign=\"top\" class=\"AmazonSearchBackground\"><img src=\"images/box_right.gif\" width=\"9\" height=\"19\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"3\" class=\"AmazonSearchBackground\">";
echo "<table width=\"468\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">";
echo "<tr>";
echo "<td class=\"AmazonSearchBackground2\">";
echo "<table width=\"468\"  border=\"0\" cellspacing=\"4\" cellpadding=\"4\">";
echo "<tr>";
echo "<td class=\"AmazonSearchBackground2\">";

echo "<table width=\"100%\"  border=\"0\" cellspacing=\"1\" cellpadding=\"1\">"; 
echo "<tr>";
while (list($key,$E)=each($A)) {
//Print out elements
if ($E) {  
echo "<tr align=\"left\">";
echo "<td rowspan=\"6\" valign=\"top\"><a href=\"".$E[url]."\" target=\"_blank\"><img src=\"".$E[ImageUrlSmall]."\" border=0></a></td>";
echo "<td colspan=\"5\" align=\"left\" valign=\"top\" class=\"AmazonTitle\"><a href=\"".$E[url]."\" target=\"_blank\">".$E[ProductName]."</a></td>";
echo "</tr>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"5\" align=\"left\" valign=\"top\" class=\"AmazonAuthor\">";
  if (is_array($E[Author])) {
	while (list($kau,$dau)=each($E[Author])) {
	  if ($kau) echo ', ';
	  echo $dau;
	}
  }
  else echo UNKNOWN;	
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"5\" align=\"left\" valign=\"top\" class=\"AmazonAuthor\">".AVAILABILITY."" . SPACE ."".$E[Availability]."</td>";
echo "</tr>";
$E[ListPrice] = str_replace("Â", "", $E[ListPrice]); 
$E[OurPrice] = str_replace("Â", "", $E[OurPrice]); 
echo "<tr>";
echo "<td align=\"left\" valign=\"top\" class=\"AmazonOurprice\">";
echo "<table width=\"300\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
  echo "<td align=\"left\" valign=\"top\" class=\"AmazonOurprice\">".OURPRICE."</td>";
  echo "<td align=\"left\" valign=\"top\" class=\"AmazonOurpriceCost\">".$E[OurPrice]."</td>";
  echo "<td align=\"left\" valign=\"top\" class=\"AmazonNewused\">".USEDANDNEW."</td>";
  echo "<td align=\"left\" valign=\"top\" class=\"AmazonFrom\">".FROM."</td>";
  echo "<td align=\"left\" valign=\"top\" class=\"AmazonNewusedCost\">".$E[ListPrice]."</td>";
echo "</tr>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"5\" align=\"left\" valign=\"top\"><a href=\"".$E[url]."\" target=\"_blank\"><img src=\"images/simple-add-to-cart.gif\" border=0></a></td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"5\" align=\"left\" valign=\"top\">&nbsp;</td>";
}
}
echo "</table>\n";
echo "</font></div>\n";
}

	if (false) {     //change this to true if you want this debugging info to be shown
	  echo "<hr>";
	  echo "Debugging:<br>\n";
	  echo "Asking Amazon's XML interface for:<br>\n";
	  echo $file."<br>\n";
	  echo "<hr>";
	}

//This is the actual program:
//- it reads the data into an array
//- prints the array
if ($A=getAmazon($file)) {
  printAmazon($A);
}
else {
  if (!$show_xml) {
	echo("No data returned by Amazon.com.");
  }
}

//Print the next and previous page links
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
echo "<tr>";
echo "<td><img src=\"images/000000.gif\" width=\"100%\" height=\"1\"></td>";
echo "</tr>";
echo "<tr>";
echo "<td>&nbsp;</td>";
echo "</tr>";
echo "</table>";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\"><tr><td>";
echo "<tr>";
echo "<td>";
echo "<ul>\n";
  echo "<li><a href='$PHP_SELF?page=".($page+1).
                             "&locale=".($locale).
                             "&mode=".($mode).
                             "&associates_id=".($associates_id).
                             "&search=".($search)."'>".NEXTPAGE."</a></li>\n";
  echo "<li><a href='$PHP_SELF?page=".($page-1).
                             "&locale=".($locale).
                             "&mode=".($mode).
                             "&associates_id=".($associates_id).
                             "&search=".($search)."'>".PREVIOUSPAGE."</a></li>\n";
echo "</ul>\n";
echo "</td>";
echo "<td>"; 
echo "<FORM method=\"get\" action=\"http://www.amazon.co.uk/exec/obidos/external-search\" target=\"_blank\">";
echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#000000\">";
echo "<tr>"; 
echo "<td>"; 
echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
echo "<tr valign=\"top\">"; 
echo "<TD width=\"146\" rowspan=\"2\" bgcolor=\"#000000\"><a href=\"http://www.amazon.co.uk/exec/obidos/redirect-home?tag=barelyreadboo-21&site=amazon\" target=\"_blank\"><img src=\"images/newused.gif\" alt=\"In Association with Amazon.co.uk\" width=\"146\" height=\"33\" hspace=\"0\" vspace=\"0\" border=\"0\"></a></TD>";
echo "<TD width=\"96\" bgcolor=\"#000000\">"; 
echo "<DIV align=\"center\"><FONT face=\"verdana,arial,helvetica\" size=\"-2\"><B><font color=\"#FFFFFF\">Search Now:</FONT></B></FONT></DIV>";
echo "<td>";
echo "<td align=\"center\" bgcolor=\"#000000\"></TD>";
echo "</tr>";
echo "<tr>";
echo "<TD valign=\"top\" bgcolor=\"#000000\">";
echo "<DIV align=\"center\"><FONT face=\"verdana,arial,helvetica\" size=\"-2\">";
echo "<INPUT type=\"text\" name=\"keyword\" size=\"10\" value=\"\">";
echo "</FONT></DIV>";
echo "</td>";
echo "<TD bgcolor=\"#000000\" valign=\"top\" align=\"left\">";
echo "<INPUT type=\"hidden\" name=\"mode\" value=\"blended\">";
echo "<INPUT type=\"hidden\" name=\"tag\" value=\"barelyreadboo-21\">";
echo "<INPUT NAME=\"Go\" TYPE=\"image\" VALUE=\"Go\" src=\"images/searchbutton.gif\" ALIGN=\"absmiddle\" width=\"21\" height=\"21\" BORDER=\"0\">";
echo "</td>";
echo "</tr>";
echo "</TABLE>";
echo "</td>";
echo "</tr>";
echo "</TABLE>";
echo "</FORM>";
echo "</td></tr></table>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
echo "<tr>";
echo "<td align=\"center\"><img src=\"images/000000.gif\" width=\"96%\" height=\"1\"></td>";
echo "</td>";
echo "<tr>";
echo "<td class=\"AmazonCount\">&nbsp;</td>";
echo "</td>";
echo "<tr>";
echo "<td class=\"AmazonCount\" align=\"center\"><a href=\"http://www.fortunedesign.co.uk\" target=\"_blank\">Booklist script by: Fortune Design</a></td>";
echo "</td>";
echo "<tr>";
echo "<td class=\"AmazonCount\">&nbsp;</td>";
echo "</td>";
echo "</td>";
echo "</tr>";
echo "</table>";

/* EOF */
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";
echo "</td>";
echo "</tr>";
echo "</table>";

		
		}
		?>
	</td>
  </tr>
</table>
</body>
</html>
