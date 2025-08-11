<?php include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/accesscontrol.php"); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(addlistingLayout, 616, 910))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>

    <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=616>
                <FORM ACTION="add.php" enctype="multipart/form-data" METHOD=POST>
                    <TABLE ID="Table1" BORDER=0 CELLSPACING=0 CELLPADDING=4 WIDTH="100%">
                        <TR>
                            <TD COLSPAN=3>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3 VALIGN=TOP>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=5 WIDTH=608 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P ALIGN=LEFT><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>Add A Rental Listing</U></FONT></B></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Landlords, please use the form below to add your rental listing(s) to our database. Fields marked with a red asterisk </FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">, are required fields.</FONT></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Once you have added a rental listing you will be able to edit/delete that listing at any time. Listings will last for 14 days in the database, after that they will be automatically deleted. You may re add the listing if you like.</FONT></P>
                                            <P>&nbsp;</P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3 ALIGN=CENTER BGCOLOR="#FFFFCC" HEIGHT=22>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=3 WIDTH=608 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Add Rental Listing</FONT></B></P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3>
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
                            <TD WIDTH=296>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bedrooms<BR>
                                    <SELECT NAME="brooms">
                                        <OPTION VALUE="1" SELECTED>1</OPTION>
                                        <OPTION VALUE="2">2</OPTION>
                                        <OPTION VALUE="3">3</OPTION>
                                        <OPTION VALUE="4">4</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=MIDDLE ALIGN=LEFT>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bathrooms<BR>
                                    <SELECT NAME="bath">
                                        <OPTION VALUE="1" SELECTED>1</OPTION>
                                        <OPTION VALUE="2">2</OPTION>
                                        <OPTION VALUE="3">3</OPTION>
                                        <OPTION VALUE="4">4</OPTION>

                                    </SELECT>
                                    </FONT></B></TD>
                            <TD WIDTH=296>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Utilities included <BR>
                                    <SELECT NAME="utilities">
                                        <OPTION VALUE="All">All</OPTION>
                                        <OPTION VALUE="Some">Some</OPTION>
                                        <OPTION VALUE="None" SELECTED>None</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rent </FONT></B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">(per month)</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*<BR><INPUT TYPE=TEXT NAME="rent" VALUE="" SIZE=11 MAXLENGTH=14></B></FONT></TD>
                            <TD WIDTH=296>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Deposit</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">*<BR><INPUT TYPE=TEXT NAME="deposit" VALUE="" SIZE=11 MAXLENGTH=14></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Pets<BR>
                                    <SELECT NAME="pets">
                                        <OPTION VALUE="No" SELECTED>No</OPTION>
                                        <OPTION VALUE="Yes">Yes</OPTION>
                                        <OPTION VALUE="Negotiable">Negotiable</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Yard<BR>
                                    <SELECT NAME="yard">
                                        <OPTION VALUE="No" SELECTED>No</OPTION>
                                        <OPTION VALUE="Yes">Yes</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Garage<BR>
                                    <SELECT NAME="garage">
                                        <OPTION VALUE="No" SELECTED>No</OPTION>
                                        <OPTION VALUE="Yes">Yes</OPTION>
                                    </SELECT>
                                    </FONT></B></TD>
                            <TD WIDTH=296>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Contact Telephone</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">*<BR><INPUT TYPE=TEXT NAME="phone" VALUE="" SIZE=21 MAXLENGTH=21></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental Address</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">*<BR><INPUT TYPE=TEXT NAME="add" VALUE="" SIZE=34 MAXLENGTH=34></FONT></B>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental Address<BR><INPUT TYPE=TEXT NAME="addtwo" VALUE="" SIZE=34 MAXLENGTH=34></FONT></B></TD>
                            <TD colspan=2 VALIGN=TOP>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental City</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">*<BR><INPUT TYPE=TEXT NAME="city" VALUE="" SIZE=21 MAXLENGTH=21></FONT></B>
								<P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Rental State<BR><INPUT TYPE=TEXT NAME="state" VALUE="" SIZE=12 MAXLENGTH=34></FONT></B></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3 VALIGN=TOP HEIGHT=40>
                                <P><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Description</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">*<BR><TEXTAREA WRAP=PHYSICAL NAME="descrip" ROWS=6 COLS=35></TEXTAREA></FONT></B>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">You may upload 2 pictures of your rental</FONT></P>
                            </TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P><INPUT TYPE=FILE NAME="img1" VALUE="" SIZE=12 MAXLENGTH=12></TD>
                            <TD COLSPAN=2>
                                <P></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P><INPUT TYPE=FILE NAME="img2" VALUE="" SIZE=12 MAXLENGTH=12></TD>
                            <TD COLSPAN=2>
                                <P></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=112>
                                <P>&nbsp;</P>
                                <P><INPUT TYPE=SUBMIT NAME="" VALUE="Proceed"></TD>
                            <TD COLSPAN=2>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                            <TD COLSPAN=2>
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

</BODY>
</HTML>
 