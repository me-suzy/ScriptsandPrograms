<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(baseresultsLayout, 600, 165))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>
<BR><BR>
<TABLE BORDER=0 CELLPADDING=0 CELLSPACING=0 WIDTH="75%">
        <TR>
          <TD COLSPAN=6 BGCOLOR="#FFFFFF">
            <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Below are the base search results. To see more information on any of our listings please click on the info link. For those wanting to charge for listings, these results would be free to view, however, the detailed results on the next page would require registration. This type of setup, allows the new visitor to get a "taste" of your listings, but for the full listing they must register.</FONT></P>
            <P>&nbsp;</P>
          </TD>
        </TR>
</TABLE>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=600 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD HEIGHT=165 WIDTH=600>
                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=600 bgcolor="#999999" NOF="LayoutRegion1">
                    <TR ALIGN=LEFT VALIGN=TOP>
                        <TD>
                            <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF="LayoutRegion1">
                                <TR VALIGN=TOP ALIGN=LEFT>
                                    <TD WIDTH=600>
                                        <TABLE ID="Table2" BORDER=0 CELLSPACING=1 CELLPADDING=4 WIDTH="100%">
                                            <TR>
                                                <TD WIDTH=196 BGCOLOR="#FFFFCC">
                                                    <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental City</FONT></B></P>
                                                </TD>
                                                <TD WIDTH=86 BGCOLOR="#FFFFCC">
                                                    <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bedrooms</FONT></B></P>
                                                </TD>
                                                <TD WIDTH=89 BGCOLOR="#FFFFCC">
                                                    <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bathrooms</FONT></B></P>
                                                </TD>
                                                <TD WIDTH=57 BGCOLOR="#FFFFCC">
                                                    <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rent</FONT></B></P>
                                                </TD>
                                                <TD WIDTH=59 BGCOLOR="#FFFFCC">
                                                    <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Deposit</FONT></B></P>
                                                </TD>
                                                <TD WIDTH=58 BGCOLOR="#FFFFCC">
                                                    <P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Info</FONT></B></P>
                                                </TD>
                                            </TR>
<? 
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$city=addslashes($_POST["city"]);
$rtype=addslashes($_POST["rtype"]);
$broom=addslashes($_POST["brooms"]);
$bath=addslashes($_POST["bath"]);


$selectquery = "SELECT * FROM listings WHERE city = '$city' AND rtype = '$rtype' AND bed >= '$broom' AND bath >= '$bath' ";
//echo "$selectquery";
$result = mysql_query($selectquery)
or die ("Query failed");
while ($row = mysql_fetch_array($result))
{
$bgcolor="#FFFFcc";
if (is_int($i/2)) {
$bgcolor="#FFFFFF";
}
$variable1=$row["rid"];
echo "<TR><TD WIDTH=195 BGCOLOR=\"#FFFFFF\"><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["city"];
echo "</FONT></P></TD><TD WIDTH=84 BGCOLOR=\"#FFFFFF\"><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["bed"];
echo "</FONT></P></TD><TD WIDTH=87 BGCOLOR=\"#FFFFFF\"><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["bath"];
echo "</FONT></P></TD><TD WIDTH=56 BGCOLOR=\"#FFFFFF\"><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">$";
echo $row["rent"];
echo "</FONT></P></TD><TD WIDTH=58 BGCOLOR=\"#FFFFFF\"><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">$";
echo $row["deposit"];
echo "</FONT></P></TD><TD WIDTH=57 BGCOLOR=\"#FFFFFF\"><P ALIGN=CENTER><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo "<a href=\"/phprentals/members/details.php?rid=".$row["rid"]."\">Details</a>";
echo "</FONT></P></TD></TR>";

$i++;
}
if (!$variable1)
{
echo "<TR><TD WIDTH=100% BGCOLOR=\"#FFFFFF\" colspan=\"6\"><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">Sorry No Rentals Matched Your Search. For more results try a broader search <a href=\"/phprentals/index.php\">Click here</a> to try again.</TD></TR>";
}
	?>
                                        </TABLE>
                                    </TD>
                                </TR>
                            </TABLE>
                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>
    </TABLE>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>
</BODY>
</HTML>
 