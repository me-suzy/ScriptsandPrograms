<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<TITLE>Base Results</TITLE>
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(baseresultsLayout))" BGCOLOR="#FFFFFF" TEXT="#000000" LINK="#0033CC" VLINK="#990099" ALINK="#FF0000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<BR><CENTER>
<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=591 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=11><IMG SRC="../assets/images/autogen/clearpixel.gif" WIDTH=11 HEIGHT=1 BORDER=0></TD>
            <TD WIDTH=580>
                <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B><U>PHPRentals Demo</u></b><p>This is the demo for our property management/phprentals listing software. Use the links or the form below to search the listings database.</FONT></P>
           <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Landlords have a password protected area where they can Add/Edit/Delete their listings. Follow the links above to visit the landlords area. You can login with <B>user:</B> guest <B>pass:</B> guest . The ability to edit the current listings has been disabled. The location dropdown box below is database driven, so when a new city is added, it will appear in the box.</FONT></P>
            </TD>
        </TR>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD COLSPAN=2 HEIGHT=12></TD>
        </TR>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD HEIGHT=47></TD>
            <TD WIDTH=580>
                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=580 bgcolor="#999999" NOF="LayoutRegion1">
                    <TR ALIGN=LEFT VALIGN=TOP>
                        <TD>
                            <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF="LayoutRegion1">
                                <TR VALIGN=TOP ALIGN=LEFT>
                                    <TD WIDTH=580>
                                        <TABLE ID="Table2" BORDER=0 CELLSPACING=1 CELLPADDING=3 WIDTH=580>
                                            <TR>
                                                <TD WIDTH=195 BGCOLOR="#FFFFCC">
                                                    <P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Rental City</B></FONT><B></B></P>
                                                </TD>
                                                <TD WIDTH=84 BGCOLOR="#FFFFCC">
                                                    <P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Bedrooms</B></FONT><B></B></P>
                                                </TD>
                                                <TD WIDTH=87 BGCOLOR="#FFFFCC">
                                                    <P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Bathrooms</B></FONT><B></B></P>
                                                </TD>
                                                <TD WIDTH=56 BGCOLOR="#FFFFCC">
                                                    <P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Rent</B></FONT><B></B></P>
                                                </TD>
                                                <TD WIDTH=58 BGCOLOR="#FFFFCC">
                                                    <P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Deposit</B></FONT><B></B></P>
                                                </TD>
                                                <TD WIDTH=57 BGCOLOR="#FFFFCC">
                                                    <P ALIGN=CENTER><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Info</B></FONT><B></B></P>
                                                </TD>
                                            </TR>

<? 
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");
$city=addslashes($_GET['city']);

$selectquery = "SELECT * FROM listings WHERE city = '$city'";
//print ($selectquery);
$result = mysql_query($selectquery)
or die ("Query failed");
while ($row = mysql_fetch_array($result))
{
$bgcolor="#E5E5E5";
if (is_int($i/2)) {
$bgcolor="#FFFFFF";
}
$variable1=$row["rid"];
echo "<TR BGCOLOR=\"$bgcolor\"><TD WIDTH=195><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["city"];
echo "</FONT></P></TD><TD WIDTH=84><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["bed"];
echo "</FONT></P></TD><TD WIDTH=87><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo $row["bath"];
echo "</FONT></P></TD><TD WIDTH=56><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">$";
echo $row["rent"];
echo "</FONT></P></TD><TD WIDTH=58><P><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">$";
echo $row["deposit"];
echo "</FONT></P></TD><TD WIDTH=57><P ALIGN=CENTER><FONT SIZE=\"-1\" FACE=\"Verdana,Tahoma,Arial,Helvetica,sans-serif\">";
echo "<a href=\"/phprentals/members/details.php?rid=".$row["rid"]."\">Details</a>";
echo "</FONT></P></TD></TR>";

$i++;
}
if (!$variable1){
echo "<TR><TD WIDTH=100% BGCOLOR=\"#FFFFFF\" colspan=\"6\">Sorry there were no rentals in $city</TD></TR>";
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
    </TABLE><BR>
	
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>
</BODY>
</HTML>
 