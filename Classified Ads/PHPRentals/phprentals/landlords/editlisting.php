<? include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(editlistingLayout, 600, 1320))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>

<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=600>
                <FORM ACTION="edit.php" enctype="multipart/form-data" METHOD=POST>
                    <TABLE ID="Table1" BORDER=0 CELLSPACING=0 CELLPADDING=4 WIDTH="100%">
                        <TR>
                            <TD COLSPAN=2>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=5 WIDTH=592 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P ALIGN=LEFT><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>Edit A Rental Listing</U></FONT></B></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Landlords, please use the form below to edit your rental listing(s). Fields marked with a red asterisk </FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">, are required fields.</FONT></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Once you have added a rental listing you will be able to edit/delete that listing at any time. Listings will last for 14 days in the database, after that they will be automatically deleted. You may re add the listing if you like.</FONT></P>
                                            <P>&nbsp;</P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 ALIGN=CENTER BGCOLOR="#FFFFCC">
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH=592 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Edit A Rental Listing</FONT></B></P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Property Type<BR>
                                    <SELECT NAME="rtype">
                                        <OPTION VALUE="Home" SELECTED>Home</OPTION>
                                        <OPTION VALUE="Duplex">Duplex</OPTION>
                                        <OPTION VALUE="Apartment">Apartment</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=MIDDLE ALIGN=LEFT>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bedrooms<BR>
                                    <SELECT NAME="bed">
                                        <OPTION VALUE="1" SELECTED>1</OPTION>
                                        <OPTION VALUE="2">2</OPTION>
                                        <OPTION VALUE="3">3</OPTION>
                                        <OPTION VALUE="4">4</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bathrooms<BR>
                                    <SELECT NAME="bath">
                                        <OPTION VALUE="1" SELECTED>1</OPTION>
                                        <OPTION VALUE="2">2</OPTION>
                                        <OPTION VALUE="3">3</OPTION>
                                        <OPTION VALUE="4">4</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Utilities included <BR>
                                    <SELECT NAME="utilities">
                                        <OPTION VALUE="All">All</OPTION>
                                        <OPTION VALUE="Some">Some</OPTION>
                                        <OPTION VALUE="None" SELECTED>None</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Garage <BR>
                                    <SELECT NAME="garage">
                                        <OPTION VALUE="No">No</OPTION>
                                        <OPTION VALUE="Yes" SELECTED>Yes</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Yard <BR>
                                    <SELECT NAME="yard">
                                        <OPTION VALUE="No">No</OPTION>
                                        <OPTION VALUE="Yes" SELECTED>Yes</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rent </FONT></B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">(per month)<BR>
<?php
//does both variables to be sure this landlord is editing their own data, might try to change id number

include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");

$rid=$_GET["id"];

$selectquery = "SELECT * FROM listings LEFT JOIN landlords ON llid=lid WHERE rid = '$rid'";
//echo "$selectquery";   AND llid='$lid'
$result = mysql_query($selectquery)
or die ("Query failed");
while ($row = mysql_fetch_array($result))
{
echo "<input type=hidden name=rid value=\"$rid\">";
?>
						<INPUT TYPE=TEXT NAME="rent" VALUE="<?php echo $row["rent"];?>" SIZE=11 MAXLENGTH=14><BR></FONT></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP HEIGHT=40>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Deposit<BR>
<INPUT TYPE=TEXT NAME="deposit" VALUE="<?php echo $row["deposit"];?>" SIZE=11 MAXLENGTH=14><BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Pets<BR>
                                    <SELECT NAME="pets">
                                        <OPTION VALUE="No" SELECTED>No</OPTION>
                                        <OPTION VALUE="Yes">Yes</OPTION>
                                        <OPTION VALUE="Negotiable">Negotiable</OPTION>
                                    </SELECT>
                                    <BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental Address<BR><INPUT TYPE=TEXT NAME="add" VALUE="<?php echo $row["addone"];?>" SIZE=34 MAXLENGTH=34></FONT></B>

                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental Address<BR><INPUT TYPE=TEXT NAME="addtwo" VALUE="<?php echo $row["addtwo"];?>" SIZE=34 MAXLENGTH=34><BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental City<BR><INPUT TYPE=TEXT NAME="city" VALUE="<?php echo $row["city"];?>" SIZE=21 MAXLENGTH=21><BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental State<BR><INPUT TYPE=TEXT NAME="state" VALUE="<?php echo $row["state"];?>" SIZE=21 MAXLENGTH=21><BR></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Contact Telephone<BR><INPUT TYPE=TEXT NAME="phone" VALUE="<?php echo $row["phone"];?>" SIZE=21 MAXLENGTH=21></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Description<BR><TEXTAREA WRAP=PHYSICAL NAME="descrip" ROWS=6 COLS=35><?php echo $row["descrip"]; }?></TEXTAREA></FONT></B>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">If you upload new pictures, this will replace the current pictures in the database.<BR>&nbsp;</FONT></P>
                            </TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P><INPUT TYPE=file NAME="img1" VALUE="" SIZE=12 MAXLENGTH=12></TD>
                            <TD WIDTH=472>
                                <P></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P><INPUT TYPE=file NAME="img2" VALUE="" SIZE=12 MAXLENGTH=12></TD>
                            <TD WIDTH=472>
                                <P></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P>&nbsp;</P>
                                <P><INPUT TYPE=SUBMIT NAME="" VALUE="Proceed"></TD>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                    </TABLE>
                </FORM>
            </TD>
        </TR>
    </TABLE>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>
<CENTER>

</BODY>
</HTML>
 