<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

<TITLE>Landlords</TITLE>
</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(landlordsLayout, 600, 690))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>

<TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=600>
                <FORM ACTION="lregister.php" METHOD=POST>
                    <TABLE ID="Table2" BORDER=0 CELLSPACING=0 CELLPADDING=4 WIDTH="100%">
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
                                            <P ALIGN=LEFT><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>Landlords Area</U></FONT></B></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">This page is for landlords. New landlords wanting to add listings can register using the form below. Existing landlords can follow </FONT><A HREF="/phprentals/landlords/index.php"><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">this link</FONT></A><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"> to access the password protected area where they can administer their listings.</FONT></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">If a landlord has forgotten their password they can </FONT><A HREF="/phprentals/html/lostpwd.php"><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">go here</FONT></A><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"> to reset it.</FONT></P>
                                            <P ALIGN=LEFT><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><U>Landlord Registration</U></FONT></B></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">This is the landlord signup page. The form below will add the landlord to the database, issue a username/password, and allow access to the landlords area.</FONT></P>
                                            <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">It has been disabled for this demo</FONT></P>
                                            <P ALIGN=LEFT>&nbsp;</P>
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
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">First Name</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="fname" VALUE="" SIZE=17 MAXLENGTH=25></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Last Name</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="lname" VALUE="" SIZE=17 MAXLENGTH=35></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Address</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="add" VALUE="" SIZE=17 MAXLENGTH=55></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Address</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="addone" VALUE="" SIZE=17 MAXLENGTH=55></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">City</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="city" VALUE="" SIZE=17 MAXLENGTH=35></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">State</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="state" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Zip Code</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="zip" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Email</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="email" VALUE="" SIZE=17 MAXLENGTH=55></TD>
                        </TR>
                        <TR>
                            <TD WIDTH=157>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Telephone</FONT></P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=TEXT NAME="phone" VALUE="" SIZE=17 MAXLENGTH=17></TD>
                        </TR>
                        <TR>
                            <TD>
                                <P>&nbsp;</P>
                            </TD>
                            <TD WIDTH=427>
                                <P><INPUT TYPE=SUBMIT VALUE="Submit"></TD>
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
<CENTER>

</BODY>
</HTML>
 