<?php //include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(protectedLayout, 600, 237))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>

    <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=600>
                <TABLE ID="Table1" BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
                    <TR>
                        <TD WIDTH=594>
                            <P>&nbsp;</P>
                        </TD>
                    </TR>
                    <TR>
                        <TD WIDTH=594>
                            <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>User Admin Area</U></FONT></B></P>
                            <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">This is the user administration area, and the overall listings admin area.</FONT></P>
                            <P>&nbsp;</P>
                        </TD>
                    </TR>
                    <TR>
                        <TD WIDTH=594 BGCOLOR="#FFFFCC">
                            <P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Current Landlords</FONT></B></P>
                        </TD>
                    </TR>
                    <TR>
<table width="600" border=0 cellpadding=2 cellspacing=0>
<TR bgcolor="#cccccc"><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Name</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Address</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>City</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Email</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Delete</TD></TR>
<?php

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");
$_SESSION['uid'] = $uid; 
$_SESSION['pwd'] = $pwd;

$rst=mysql_query("SELECT * FROM users WHERE llid > '0'");
while ($row = mysql_fetch_array($rst))
	{

echo "<TR><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo " ".$row["fname"]." ".$row["lname"]."";
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["addone"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["city"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\"><a href=\"mailto:".$row["email"]."\">".$row["email"]."</a></TD>";
echo "<TD valign=\"middle\"><form action=\"deleteconfirm.php\" method=POST><input type=hidden name=llid value=\"".$row["llid"]."\"><input type=submit value=Delete></TD>";
echo "</TR>";
}

?>
</form>
                        <TD>
                            <P>&nbsp;</P>
                        </TD>
                    </TR>
                    <TR>
<table width="600" border=0 cellpadding=2 cellspacing=0>
<TR bgcolor="#ffffcc"><TD colspan="7"><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><center><B>Current Rental Listings</TD></TR>
<TR bgcolor="#cccccc"><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Rental Type</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Address</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Address</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>City</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Edit</TD><TD><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>Delete</TD></TR>
<?php

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");
$_SESSION['uid'] = $uid; 
$_SESSION['pwd'] = $pwd;


$query=mysql_query("SELECT * FROM listings");
while ($row = mysql_fetch_array($query))
{
echo "<TR><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["rtype"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["addone"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["addtwo"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\">";
echo $row["city"];
echo "</TD><TD><FONT SIZE=\"-1\" FACE=\"Arial,Helvetica,Geneva,Sans-serif,sans-serif\"><a href=\"/phprentals/landlords/editlisting.php?id=".$row["rid"]."\">Edit Listing</a></TD>";
echo "<TD valign=\"middle\"><form action=\"/phprentals/landlords/deleteconfirm.php\" method=POST><input type=hidden name=rid value=\"".$row["rid"]."\"><input type=submit value=Delete></TD>";
echo "</TR>";
}

?>
</form>
                        <TD>
                            <P>&nbsp;</P>
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
 