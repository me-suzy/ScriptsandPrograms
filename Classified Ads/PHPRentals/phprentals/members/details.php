<!--<? //include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php");?>-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(fullresultsLayout, 607, 180))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>   
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?> 	
<BR><BR><CENTER>	
	<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=607 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=607>
                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 bgcolor="#999999" NOF="LayoutRegion1">
                    <TR ALIGN=LEFT VALIGN=TOP>
                        <TD>
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");				

$rid=$_GET["rid"];

$selectquery = "SELECT * FROM listings LEFT JOIN landlords ON landlords.lid = listings.llid WHERE rid = '$rid'";
//echo "$selectquery";
$result = mysql_query($selectquery)
or die ("Query failed");
while ($row = mysql_fetch_array($result))
{
$variable1=$row["rid"];
$picone=$row["img1"];
$pictwo=$row["img2"];
?>

<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=600 bgcolor="#999999"><TR ALIGN=LEFT VALIGN=TOP><TD><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0><TR VALIGN=TOP ALIGN=LEFT><TD WIDTH=600><TABLE BORDER=0 CELLSPACING=1 CELLPADDING=3 WIDTH=600><TR><TD COLSPAN=8 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">

<B>Contact Name -- </B><?php echo $row['name']; ?> &nbsp;&nbsp;&nbsp;<B>Rental City -- </B><?php echo $row['city']; echo ", "; echo $row['state']; ?>

</B></FONT><B></B></P></TD></TR><TR><TD COLSPAN=8 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["descrip"]; ?>

</FONT></P></TD></TR><TR><TD WIDTH=77 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Bedrooms
</B></FONT><B></B></P></TD><TD WIDTH=91 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Bathrooms
</B></FONT><B></B></P></TD><TD WIDTH=91 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Utilities
</B></FONT><B></B></P></TD><TD WIDTH=91 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Rent
</B></FONT><B></B></P></TD><TD WIDTH=94 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Deposit
</B></FONT><B></B></P></TD><TD WIDTH=94 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Pets
</B></FONT><B></B></P></TD><TD WIDTH=94 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Yard
</B></FONT><B></B></P></TD><TD WIDTH=94 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Garage
</B></FONT><B></B></P></TD></TR><TR><TD WIDTH=77 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">

<?php echo $row["bed"];?>
</FONT></P></TD><TD WIDTH=91 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["bath"];?>
</FONT></P></TD><TD WIDTH=91 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["utilities"];?>
</FONT></P></TD><TD WIDTH=91 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">$<?php echo $row["rent"];?>
</FONT></P></TD><TD WIDTH=94 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">$<?php echo $row["deposit"];?>
</FONT></P></TD><TD WIDTH=94 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["pets"];?>
</FONT></P></TD><TD WIDTH=94 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["yard"];?>
</FONT></P></TD><TD WIDTH=94 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["garage"];?>

</FONT></P></TD></TR><TR><TD COLSPAN=4 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Address
</B></FONT><B></B></P></TD><TD COLSPAN=2 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Telephone
</B></FONT><B></B></P></TD><TD COLSPAN=2 BGCOLOR="#FFFFCC"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif"><B>Listing Date
</B></FONT><B></B></P></TD></TR><TR><TD COLSPAN=4 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">

<?php echo $row["addone"]; echo " "; echo $row["addtwo"]; ?>

</FONT></P></TD><TD COLSPAN=2 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["phone"];?>
</FONT></P></TD><TD COLSPAN=2 BGCOLOR="#FFFFFF"><P><FONT SIZE="-1" FACE="Verdana,Tahoma,Arial,Helvetica,sans-serif">
<?php echo $row["listdate"];?>
</FONT></P></TD></TR><TR><TD COLSPAN=4 BGCOLOR="#FFFFFF" HEIGHT=16>

<?php if (!$picone) {
    echo "<center><img src=\"/phprentals/images/nopic.gif\">";
}
else {
echo "<center><img src=\"/phprentals/images/".$row['img1']."\">";
}
echo "</FONT></P></TD><TD COLSPAN=4 BGCOLOR=\"#FFFFFF\">";
if (!$pictwo) {
    echo "<center><img src=\"/phprentals/images/nopic.gif\">";
}
else {
echo "<center><img src=\"/phprentals/images/".$row['img2']."\">";
}
echo "</FONT></P></TD></TR></TABLE></TD></TR></TABLE></TD></TR></TABLE>";

}
if (!$variable1)
{
	echo "No results matched. Please click your back button and try again.";
}
?>

                        </TD>
                    </TR>
                </TABLE>
            </TD>
        </TR>
    </TABLE>
<BR><BR>
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>

</BODY>
</HTML>
 