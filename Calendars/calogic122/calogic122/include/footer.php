<?php
// Please do not remove this information
// I worked a lot of long hard hours on this program
// give credit where credit is due.

print "<center><table border=\"0\" width=\"".$GLOBALS["sitewidth"]."\">";
print "<tr>";

if(!$GLOBALS["printfriend"]) {

    if($curcalcfg["gcscoif_footpic"] == "") {

    ?>
    <td width="15%" align="right">
        <A class="gcprevlink" target="_blank" href="http://sourceforge.net ">
        <IMG src="./img/sf_logo.bmp" width="125" height="37" border="0" alt="SourceForge Logo">
        </A>

    </td>

    <td width="15%" align="left">
        &nbsp;
        <a target="_blank" class="gcprevlink" href="http://www.mysql.com ">
        <img border="1" width="125" height="37" src="./img/mysql_logo.png" alt="MySQL Logo">
        </a>
    </td>
    <td width="25%" align="center" nowrap>

        <a title="Visit the Home of CaLogic!" target="_blank" class="gcprevlink" href="http://www.calogic.de ">
        <font size="-1">CaLogic Calendars V<?php print $GLOBALS["calogicversion"]; ?></font>
        </a><br>
        <a title="EMail the author!" target="_blank" class="gcprevlink" href="mailto:philip@calogic.de">
        <font size="-1">&#xA9; Philip Boone</font>
        </a>
    </td>
    <td width="30%" align="right">
        <table border="0" width="100%">
        <tr>
        <td width="33%" align="right">
            <a target="_blank" class="gcprevlink" href="http://www.activestate.com ">
            <img border="1" src="./img/komodo.gif" alt="Komodo Logo">
            </a>
        </td>
        <td width="34%" align="center">
            <a target="_blank" class="gcprevlink" href="http://www.php.net ">
            <img border="1" src="./img/powered_php.gif" alt="PHP Logo">
            </a>
        </td>
        <td width="33%" align="left">
            <a target="_blank" href="http://www.bosrup.com/web/overlib/">
            <img src="./img/overlib.gif" width="88" height="31" alt="Popups by overLIB!" border="1">
            </a>
        </td>
        </table>
    </td>

    <?php
    } else {
        ?>
    <td width="20%" align="center">

        <table border="0" width="100%">
        <tr>
        <td width="50%" align="right">
            <A class="gcprevlink" target="_blank" href="http://sourceforge.net ">
            <IMG src="./img/sf_logo.bmp" width="125" height="37" border="0" alt="SourceForge Logo">
            </A>
        </td>
        <td width="50%" align="left">
            <a target="_blank" class="gcprevlink" href="http://www.mysql.com ">
            <img border="1" width="125" height="37" src="./img/mysql_logo.png" alt="MySQL Logo">
            </a>
        </td>
        </tr>
        <tr>
        <td colspan="2" align="center">
            <a title="Visit the Home of CaLogic!" target="_blank" class="gcprevlink" href="http://www.calogic.de ">
            <font size="-1">CaLogic Calendars V<?php print $GLOBALS["calogicversion"]; ?></font>
            </a>
        </td>
        </tr>
        </table>


    </td>

    <td width="60%" align="center">
        <?php
        if (strlen($curcalcfg["gcscoif_footlink"]) > 0) {
            print "<a title=\"".$curcalcfg["gcscoif_foottext"]."\" href=\"".$curcalcfg["gcscoif_footlink"]."\" target=\"".$curcalcfg["gcscoif_foottarget"]."\">";
        } else {
            print "<div title=\"".$curcalcfg["gcscoif_foottext"]."\">";
        }

         if(strtolower(substr($curcalcfg["gcscoif_footpic"],strrpos($curcalcfg["gcscoif_footpic"],".")))==".swf") {

             print "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0\" width=\"468\" height=\"60\">";
             print "<param name=movie value=\"".$curcalcfg["gcscoif_footpic"]."\">";
             print "<param name=quality value=high>";
             print "<embed src=\"".$curcalcfg["gcscoif_footpic"]."\" quality=high pluginspage=\"http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash\" type=\"application/x-shockwave-flash\" width=\"468\" height=\"60\">";
             print "</embed>";
             print "</object>";

         } else {
             print "<img border=\"0\" src=\"".$curcalcfg["gcscoif_footpic"]."\">";
         }

        if (strlen($curcalcfg["gcscoif_footlink"]) > 0) {
            print "</a>";
        } else {
            print "</div>";
        }
    ?>
    </td>
    <td nowrap width="20%" align="center">

        <table border="0" width="100%">
        <tr>
        <td nowrap width="33%" align="right">
            <a target="_blank" class="gcprevlink" href="http://www.activestate.com ">
            <img border="1" src="./img/komodo.gif" alt="Komodo Logo">
            </a>
        </td>
        <td nowrap width="34%" align="center">
            <a target="_blank" class="gcprevlink" href="http://www.php.net ">
            <img border="1" src="./img/powered_php.gif" alt="PHP Logo">
            </a>
        </td>
        <td nowrap width="33%" align="center">
            <a href="http://www.bosrup.com/web/overlib/">
            <img target="_blank" src="./img/overlib.gif" width="88" height="31" alt="Popups by overLIB!" border="1">
            </a>
        </td>
        </tr>
        <tr>
        <td nowrap colspan="3" align="center">
            <a title="EMail the author!" target="_blank" class="gcprevlink" href="mailto:philip@calogic.de">
            <font size="-1">&#xA9; Philip Boone</font>
            </a>
        </td>
        </tr>
        </table>
    </td>
    <?php
    }
} else {
?>
<table border="0" width="100%">
<tr>

    <td width="100%" align="center" nowrap>

        <a title="Visit the Home of CaLogic!" target="_blank" class="gcprevlink" href="http://www.calogic.de ">
        <font size="-1">CaLogic Calendars V<?php print $GLOBALS["calogicversion"]; ?></font>
        </a><br>
        <a title="EMail the author!" target="_blank" class="gcprevlink" href="mailto:philip@calogic.de">
        <font size="-1">&#xA9; Philip Boone</font>
        </a>
    </td>

</tr>
</table>

<?php
}
    ?>
    </tr>
    </table>
</center>

<script>

var windowwidth;

/* Code to detect dimensions of current window */
/*
if (!ez_NN4) { onresize = function() { location.reload()} }
var height, width;
if (document.all) {
	height = document.body.offsetHeight;
	width = document.body.offsetWidth;
}
else {
	height = window.innerHeight;
	width = window.innerWidth;
}
*/
/* Pass the width of the window to showPermPanelCentered to center the menu */

try {
if (document.all) {
//	height = document.body.offsetHeight;
	windowwidth = document.body.offsetWidth;
}
else {
//	height = window.innerHeight;
	windowwidth = document.body.innerWidth;
}
}catch(e) {
}
if(windowwidth<890) {
    windowwidth=890;
}


</script>
<?php
if(strlen($GLOBALS["bugrep"]) > 0) {
    #print "<br>Bugrep:<br>".$GLOBALS["bugrep"];
}
?>
</body>
</html>
