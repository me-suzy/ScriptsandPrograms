<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<TITLE>rental-register</TITLE>
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(rentalregisterLayout, 600, 573))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>
    <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=600>
                <FORM ACTION="" METHOD=POST>
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
                                            <P ALIGN=LEFT><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>Renter Signup Page</U></FONT></B></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">This page would be used if you were going to charge visitors to view rental listings. They would fill out the form, their credit card would be billed, and if the transaction was successful they would then have access to the listings.</FONT></P>
                                            <P>&nbsp;</P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Name</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="Forms Edit Field1" TYPE=TEXT NAME="FormsEditField1" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Address</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField2" TYPE=TEXT NAME="FormsEditField2" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Address 2</FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField3" TYPE=TEXT NAME="FormsEditField3" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">City</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField4" TYPE=TEXT NAME="FormsEditField4" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">State</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField5" TYPE=TEXT NAME="FormsEditField5" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Zipcode</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField6" TYPE=TEXT NAME="FormsEditField6" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Email</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="FormsEditField7" TYPE=TEXT NAME="FormsEditField7" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Cardnumber</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="Forms Edit Field8" TYPE=TEXT NAME="FormsEditField8" VALUE="" SIZE=18 MAXLENGTH=18></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Expiration Date</FONT><FONT COLOR="#FF0000" SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B>*</B></FONT></P>
                            </TD>
                            <TD VALIGN=TOP WIDTH=443>
                                <P><INPUT ID="Forms Edit Field9" TYPE=TEXT NAME="FormsEditField9" VALUE="" SIZE=3 MAXLENGTH=10><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">&nbsp;/ <INPUT ID="FormsEditField10" TYPE=TEXT NAME="FormsEditField10" VALUE="" SIZE=3 MAXLENGTH=10></FONT></TD>
                        </TR>
                        <TR>
                            <TD VALIGN=TOP WIDTH=141>
                                <P><INPUT TYPE=SUBMIT VALUE="Submit"></TD>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                    </TABLE>
                </FORM>
            </TD>
        </TR>
    </TABLE>
<BR><BR>
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>

</BODY>
</HTML>
 