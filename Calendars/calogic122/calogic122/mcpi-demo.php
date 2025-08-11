<?php
/*

INSTRUCTIONS FOR USE

CaLogic must be installed and operational for this to work.

The html document name that you plug the mini cal into MUST end in .php
For example, you want to plug the mini cal into your index.html file. No Problem.
Make a copy of the index.html file and name the copy index.php
Modify the index.php file as outlined in this document.
point your links to index.php instead of index.html and thats it!
You can also have index.html automatically relocate to index.php, that way
no one will notice the change. Except for the new really cool mini cal plug in
your page now has!


1. Set the variable $GLOBALS["CLURL"] to the url of calogic, no ending slash.

You can find out the path and url to CaLogic by following the
"CaLogic Config" link from the CaLogic functions menu.

2. Change the 2 Variables:

    $GLOBALS["MCPI_USER"] = "Guest";
    $GLOBALS["MCPI_PASS"] = "Guest";

from "Guest" to "what ever user you want". This use must exist, and have a calendar configured.

i.e. this is the user that will be used. A valid CaLogic user must be specified.
If you have public view turned on, then leave them the way they are, unless
you want the mini cal from a different calendar to be displayed.

In order to use the Guest User, the Public View option must be turned on.


4.  Set the "aimcal" variable to 1 (thats the number one)
to enable the links in the mini cal. When the
links are clicked, CaLogic will open.
Setting it to 0 (Thats a zero) will disable
the links.

5. Set the "MCLINKRES" variable to 1 to have CaLogic open in a new window,
or set it to 0 (zero) to have CaLogic open in the same window.
This setting only has an effect if the variable aimcal is set to 1.

# NOTE!!!
# Be carefull when turning links on. If you turn links on,
# and a surfer clicks on one, they will be taken directly
# to the CaLogic calendar of the user you specify. The surfer
# will not be challenged for a user name or password and will be logged on as
# the user you specify in the variables.


6. change the path in the include statement to reflect the path to yourt calogic folder


7. insert the code BLOCKS as explained below into your html document that will display
the mini cal.


if you have any problems, or need help please let me know

Philip@CaLogic.de


*/

?>
<!-- Set Variables and load the Mini Cal Pre loader file -->
<?php

# set variables here

# url to CaLogic
$GLOBALS["CLURL"] = "http://www.myweb.com/calogic";


# User and password
$GLOBALS["MCPI_USER"] = "Guest";
$GLOBALS["MCPI_PASS"] = "Guest";

# enable / disable mini cal links
$GLOBALS["aimcal"] = 1;


# if you activate the mini cal linking, then stipulate here if you want
# the link to be opened in a new window/frame or not ( 1 = new window/frame, 0 = same window/frame)
$GLOBALS["MCLINKRES"] = 1;

# change path/to/calogic to reflect the physical path to your calogic folder
include("path/to/calogic/clmcpreload.php");


?>

<!-- BLOCK 0               insert everything above this line into the top of your HTML Document    -->
<?php
print $GLOBALS["htmldoctype"];
?>
<html>
<HEAD>
<title>CaLogic Mini Cal Plug-In Demo</title>

<!--                       BEGIN BLOCK 1       Insert block 1 between your HTML document <HEAD> tags.  -->
<!--  Mini Cal Style file -->
<?php
include($GLOBALS["CLPATH"]."/include/style.php");
?>
<!--                       END  BLOCK 1       Insert block 1 between your HTML document header tags.  -->

</HEAD>

<body>
<!--                       BEGIN BLOCK 2       Insert block 2 just after the document BODY tag.  -->
<!--  Pop up Java Script code -->
<?php
print "<div id=\"overDiv\" style=\"position:absolute; visibility:hidden; z-index:1000;\"></div>\n";
print "<script language=\"JavaScript\" src=\"".$GLOBALS["CLPATH"]."/include/overlib_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
print "<script language=\"JavaScript\" src=\"".$GLOBALS["CLPATH"]."/include/overlib_anchor_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
print "<script language=\"JavaScript\" src=\"".$GLOBALS["CLPATH"]."/include/overlib_exclusive_mini.js\"><!-- overLIB (c) Erik Bosrup --></script>\n";
?>
<!--                       END   BLOCK 2       Insert block 2 wherever you want the mini cal displayed.  -->

<h3>CaLogic Mini-Cal Plugin Demo</h3><br>


<!-- YOUR HTML CODE GOES HERE! -->


<!--                       BEGIN BLOCK 3       Insert block 3 wherever you want the mini cal displayed.  -->
<!--  Mini Cal Main file -->
<?php

# if you want to display some other month other than the current month
# then remove the double # sign from the three lines below
# then change the 1 in the second line below, to the number of months in the future
# that you want to display. If you want to display past months, use a negative number.
# for example:
# to display the next month use this:
# $mcmonth = dateadd("m",1,time());
#
# to display the previous month use:
# $mcmonth = dateadd("m",-1,time());

##    $mcmonth = time();
##    $mcmonth = dateadd("m",1,time());
##    $mcpiviewdate = strftime("%Y",$mcmonth).strftime("%m",$mcmonth)."01";

    include($GLOBALS["CLPATH"]."/cl_minical.php");

?>
<!--                       END   BLOCK 3       Insert block 3 wherever you want the mini cal displayed.  -->




</body>
</html>

<!-- END DOCUMENT  -->
