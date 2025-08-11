<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">

</HEAD>
<BODY NOF="(MB=(DefaultMasterBorder, 0, 0, 0, 0), L=(HomeLayout, 600, 671))" BGCOLOR="#FFFFFF" TEXT="#000000" TOPMARGIN=0 LEFTMARGIN=0 MARGINWIDTH=0 MARGINHEIGHT=0>

<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/header.php");
?>
<CENTER>



    <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 NOF=LY>
        <TR VALIGN=TOP ALIGN=LEFT>
            <TD WIDTH=600>
                <FORM ACTION="/phprentals/html/baseresults.php" METHOD=POST>
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
           <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif"><B><U>PHPRentals Demo</u></b><p>This is the demo for our property management/phprentals listing software. Use the links or the form below to search the listings database.</FONT></P>
           <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Landlords have a password protected area where they can Add/Edit/Delete their listings. Follow the links above to visit the landlords area. You can login with <B>user:</B> guest <B>pass:</B> guest . The ability to edit the current listings has been disabled. The location dropdown box below is database driven, so when a new city is added, it will appear in the box.</FONT></P>
		   <P ALIGN=LEFT><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">There is also a website owner admin area to let you administer the landlords, view/edit all listings
           </FONT></B></P>
         </TD>
      </TR>
</TABLE>
                            </TD>
                        </TR>
						<TR BGCOLOR="#FFFFCC"><TD colspan=2><P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">View all listings in an area</TD></TR>
                        <TR>
<TD COLSPAN=2 VALIGN=TOP><P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/config.php");
$selectquery = "SELECT DISTINCT city FROM listings";
//echo "$selectquery";
$result = mysql_query($selectquery)
or die ("Query failed");

while ($row = mysql_fetch_array($result))
{
$city=urlencode($row["city"]);
echo "<a href=\"/phprentals/html/link.php?city=$city\">".$row["city"]."</a><BR>";
}
?></FONT></P><BR>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP ALIGN=CENTER BGCOLOR="#FFFFCC">
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=592 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P ALIGN=CENTER><B><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Search Form</FONT></B></P>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD WIDTH=172>
                                <P>&nbsp;</P>
                            </TD>
                            <TD WIDTH=412>
                                <P>&nbsp;</P>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Location</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
<SELECT NAME="city">
<?php
$selectquery = "SELECT DISTINCT city FROM listings";
//echo "$selectquery";
$result = mysql_query($selectquery)
or die ("Query failed");

while ($row = mysql_fetch_array($result))
{
echo "<OPTION VALUE=\"".$row["city"]."\" SELECTED>".$row["city"]."</OPTION>";
}
?>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Home or Apartment</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="rtype">
                                                    <OPTION VALUE="Home" SELECTED>Home</OPTION>
                                                    <OPTION VALUE="Apartment">Apartment</OPTION>
													<OPTION VALUE="Apartment">Duplex</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172 HEIGHT=16>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bedrooms</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="brooms">
                                                    <OPTION VALUE="1" SELECTED>1</OPTION>
                                                    <OPTION VALUE="2">2</OPTION>
                                                    <OPTION VALUE="3">3</OPTION>
                                                    <OPTION VALUE="4">4</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Bathrooms</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="bath">
                                                    <OPTION VALUE="1" SELECTED>1</OPTION>
                                                    <OPTION VALUE="2">2</OPTION>
                                                    <OPTION VALUE="3">3</OPTION>
                                                    <OPTION VALUE="4">4</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <!--<TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Pets</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="pets">
                                                    <OPTION VALUE="%" SELECTED>Not Important</OPTION>
                                                    <OPTION VALUE="Yes">Yes</OPTION>
                                                    <OPTION VALUE="No">No</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Garage</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="gar">
                                                    <OPTION VALUE="%" SELECTED>Not Important</OPTION>
                                                    <OPTION VALUE="Yes">Yes</OPTION>
                                                    <OPTION VALUE="No">No</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD VALIGN=MIDDLE WIDTH=172>
                                <P><FONT SIZE="-1" FACE="Arial,Helvetica,Geneva,Sans-serif,sans-serif">Yard</FONT></P>
                            </TD>
                            <TD VALIGN=MIDDLE WIDTH=412>
                                <TABLE BORDER=0 CELLSPACING=0 CELLPADDING=2 WIDTH=412 NOF=TI>
                                    <TR>
                                        <TD>
                                            <P>
                                                <SELECT NAME="yd">
                                                    <OPTION VALUE="%" SELECTED>Not Important</OPTION>
                                                    <OPTION VALUE="Yes">Yes</OPTION>
                                                    <OPTION VALUE="No">No</OPTION>
                                                </SELECT>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>-->
                        <TR>
                            <TD COLSPAN=2 VALIGN=TOP>
                                <P><BR><INPUT TYPE=SUBMIT VALUE="Search"></TD>
                        </TR>
                    </TABLE>
                </FORM>
            </TD>
        </TR>
    </TABLE><BR><BR>
<?
include ("".$_SERVER['DOCUMENT_ROOT']."/phprentals/includes/footer.php");
?>
</BODY>
</HTML>
 