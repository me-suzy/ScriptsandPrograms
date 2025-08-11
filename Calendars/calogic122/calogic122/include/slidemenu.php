// Begin static menu

//old version

//Static Slide Menu 6.5 Copyright MaXimuS 2000-2001, All Rights Reserved.
//Site: http://www.absolutegb.com/maximus
//E-mail: maximus@nsimail.com
//Script featured on Dynamic Drive (http://www.dynamicdrive.com)

NS6 = (document.getElementById&&!document.all)
IE = (document.all)
NS = (navigator.appName=="Netscape" && navigator.appVersion.charAt(0)=="4")

tempBar='';barBuilt=0;ssmItems=new Array();

moving=setTimeout('null',1)
function moveOut() {
    if ((NS6||NS)&&parseInt(ssm.left)<0 || IE && ssm.pixelLeft<0)
    {
        clearTimeout(moving);
        moving = setTimeout('moveOut()', slideSpeed);
        slideMenu(10);
    } else {
        clearTimeout(moving);
        moving=setTimeout('null',1);
    }
}
function moveBack() {
    clearTimeout(moving);
    moving = setTimeout('moveBack1()', waitTime);
}

function moveBack1() {
    if ((NS6||NS) && parseInt(ssm.left)>(-menuWidth) || IE && ssm.pixelLeft>(-menuWidth)) {
        clearTimeout(moving);
        moving = setTimeout('moveBack1()', slideSpeed);
        slideMenu(-10);
    } else {
        clearTimeout(moving);
        moving=setTimeout('null',1);
    }
}
function slideMenu(num){
    if (IE) {ssm.pixelLeft += num;}
    if (NS||NS6) {ssm.left = parseInt(ssm.left)+num;}
    if (NS) {bssm.clip.right+=num;bssm2.clip.right+=num;}
}

/*
function makeStatic() {
    if (NS||NS6) {winY = window.pageYOffset;}
    if (IE) {winY = document.body.scrollTop;}
    if (NS6||IE||NS) {
        if (winY!=lastY && winY > YOffset-staticYOffset) {
        smooth = .2 * (winY - lastY - YOffset + staticYOffset);

    } else if (YOffset-staticYOffset+lastY > YOffset-staticYOffset) {
//        smooth = .2 * (winY - lastY - (YOffset-(YOffset-winY)));
        smooth = .2 * (winY - lastY - (YOffset-(YOffset-winY)));
    } else {smooth=0}

    if(smooth > 0) smooth = Math.ceil(smooth);
    else smooth = Math.floor(smooth);

    if (IE) bssm.pixelTop += smooth;
    if (NS6||NS) bssm.top=parseInt(bssm.top)+smooth
    lastY = lastY+smooth;
    setTimeout('makeStatic()', 1);
    }
}

*/

function makeStatic() {
try {
	winY=(IE)?document.body.scrollTop:window.pageYOffset;
	sHow=(NS6)?0.4:0.2;
	if(winY!=lastY&&winY>YOffset-staticYOffset)smooth=sHow*(winY-lastY-YOffset+staticYOffset);
	else if(YOffset-staticYOffset+lastY>YOffset-staticYOffset&&winY<=YOffset-staticYOffset)smooth=sHow*(winY-lastY-(YOffset-(YOffset-winY)));
	else smooth=0;
	if(smooth>0)smooth=Math.ceil(smooth);
	else smooth=Math.floor(smooth);
	bssm.top=parseInt(bssm.top)+smooth;
	lastY=lastY+smooth;
	setTimeout('makeStatic()',1);
} catch(e) {
alert("error 0");
}
}


function buildBar() {
try {
if(barText.indexOf('<IMG')>-1) {tempBar=barText}
else{for (b=0;b<barText.length;b++) {tempBar+=barText.charAt(b)+"<BR>"}}
document.write('<td align="center" rowspan="100" width="'+barWidth+'" bgcolor="'+barBGColor+'" valign="'+barVAlign+'"><p align="center"><font face="'+barFontFamily+'" Size="'+barFontSize+'" COLOR="'+barFontColor+'"><B>'+tempBar+'</B></font></p></TD>')
} catch(e) {

}

}

function initSlide() {
if (NS6){ssm=document.getElementById("thessm").style;bssm=document.getElementById("basessm").style;
bssm.clip="rect(0 "+document.getElementById("thessm").offsetWidth+" "+document.getElementById("thessm").offsetHeight+" 0)";ssm.visibility="visible";}
else if (IE) {ssm=document.all("thessm").style;bssm=document.all("basessm").style
bssm.clip="rect(0 "+thessm.offsetWidth+" "+thessm.offsetHeight+" 0)";bssm.visibility = "visible";}
else if (NS) {bssm=document.layers["basessm1"];
bssm2=bssm.document.layers["basessm2"];ssm=bssm2.document.layers["thessm"];
bssm2.clip.left=0;ssm.visibility = "show";}
if (menuIsStatic=="yes") makeStatic();}

function buildMenu() {
if (IE||NS6) {document.write('<DIV ID="basessm" style="visibility:hidden;Position : Absolute ;Left : '+XOffset+' ;Top : '+YOffset+' ;Z-Index : 20;width:'+(menuWidth+barWidth+10)+'"><DIV ID="thessm" style="Position : Absolute ;Left : '+(-menuWidth)+' ;Top : 0 ;Z-Index : 20;" onmouseover="moveOut()" onmouseout="moveBack()">')}
if (NS) {document.write('<LAYER name="basessm1" top="'+YOffset+'" LEFT='+XOffset+' visibility="show"><ILAYER name="basessm2"><LAYER visibility="hide" name="thessm" bgcolor="'+menuBGColor+'" left="'+(-menuWidth)+'" onmouseover="moveOut()" onmouseout="moveBack()">')}
if (NS6){document.write('<table border="0" cellpadding="0" cellspacing="0" width="'+(menuWidth+barWidth+2)+'" bgcolor="'+menuBGColor+'"><TR><TD>')}
document.write('<table border="0" cellpadding="0" cellspacing="1" width="'+(menuWidth+barWidth+2)+'" bgcolor="'+menuBGColor+'">');
for(i=0;i<ssmItems.length;i++) {
if(!ssmItems[i][3]){ssmItems[i][3]=menuCols;ssmItems[i][5]=menuWidth-1}
else if(ssmItems[i][3]!=menuCols)ssmItems[i][5]=Math.round(menuWidth*(ssmItems[i][3]/menuCols)-1);
if(ssmItems[i-1]&&ssmItems[i-1][4]!="no"){document.write('<TR>')}
if(!ssmItems[i][1]){
document.write('<td bgcolor="'+hdrBGColor+'" HEIGHT="'+hdrHeight+'" ALIGN="'+hdrAlign+'" VALIGN="'+hdrVAlign+'" WIDTH="'+ssmItems[i][5]+'" COLSPAN="'+ssmItems[i][3]+'">&nbsp;<font face="'+hdrFontFamily+'" Size="'+hdrFontSize+'" COLOR="'+hdrFontColor+'"><b>'+ssmItems[i][0]+'</b></font></td>')}
else {if(!ssmItems[i][2])ssmItems[i][2]=linkTarget;
document.write('<TD BGCOLOR="'+linkBGColor+'" onmouseover="bgColor=\''+linkOverBGColor+'\'" onmouseout="bgColor=\''+linkBGColor+'\'" WIDTH="'+ssmItems[i][5]+'" COLSPAN="'+ssmItems[i][3]+'"><ILAYER><LAYER onmouseover="bgColor=\''+linkOverBGColor+'\'" onmouseout="bgColor=\''+linkBGColor+'\'" WIDTH="100%" ALIGN="'+linkAlign+'"><DIV  ALIGN="'+linkAlign+'"><FONT face="'+linkFontFamily+'" Size="'+linkFontSize+'">&nbsp;<A HREF="'+ssmItems[i][1]+'" target="'+ssmItems[i][2]+'" CLASS="ssmItems">'+ssmItems[i][0]+'</DIV></LAYER></ILAYER></TD>')}
if(ssmItems[i][4]!="no"&&barBuilt==0){buildBar();barBuilt=1}
if(ssmItems[i][4]!="no"){document.write('</TR>')}}
document.write('</table>')
if (NS6){document.write('</TD></TR></TABLE>')}
if (IE||NS6) {document.write('</DIV></DIV>')}
if (NS) {document.write('</LAYER></ILAYER></LAYER>')}
theleft=-menuWidth;lastY=0;setTimeout('initSlide();', 1)}


/*

old menu config

Configure menu styles below
NOTE: To edit the link colors, go to the STYLE tags and edit the ssm2Items colors
*/


YOffset=10; // no quotes!!
XOffset=0;
staticYOffset=30; // no quotes!!
slideSpeed=20 // no quotes!!
waitTime=100; // no quotes!! this sets the time the menu stays out for after the mouse goes off it.
menuBGColor="black";
menuIsStatic="yes"; //this sets whether menu should stay static on the screen
menuWidth=250; // Must be a multiple of 10! no quotes!!
menuCols=2;
hdrFontFamily="verdana";
hdrFontSize="2";
hdrFontColor="white";
hdrBGColor="#170088";
hdrAlign="left";
hdrVAlign="center";
hdrHeight="15";
linkFontFamily="Verdana";
linkFontSize="2";
linkBGColor="white";
linkOverBGColor="#FFFF99";
linkTarget="";
linkAlign="Left";
barBGColor="#444444";
barFontFamily="Verdana";
barFontSize="2";
barFontColor="white";
barVAlign="center";
barWidth=20; // no quotes!!
barText="<?php echo $GLOBALS["functionmenutext"]; ?>"; // <IMG> tag supported. Put exact html for an image to show.


<?php
    $xpsid = "";
    if($GLOBALS["adsid"] == true) {
        $xpsid = "&".SID;
    }

?>
// ssmItems[...]=[name, link, target, colspan, endrow?, URL Parameters starting with & for PHP] - leave 'link' and 'target' blank to make a header

// old method

var lstcnt;
lstcnt=0;
ssmItems[lstcnt]=["<?php echo $GLOBALS["functionmenutext"]; ?>"] //create header
lstcnt++;
ssmItems[lstcnt]=["Printer Friendly View", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=printfriend&printfriend=1".$xpsid."&trash="; ?>", "_blank"]
//lstcnt++;
//ssmItems[lstcnt]=["Event Search and List", "<?php #echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=evsearch&evsearch=1".$xpsid."&trash="; ?>", ""]
<?php
if($user->gsv("uname")!="Guest" || ($user->gsv("uname")=="Guest" && $GLOBALS["demomode"]==true)) {
?>
    lstcnt++;
    ssmItems[lstcnt]=["Contacts", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=contacts&contacts=1".$xpsid."&trash="; ?>"]
    lstcnt++;
    ssmItems[lstcnt]=["Categories", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=categories&categories=1".$xpsid."&trash="; ?>"]
    lstcnt++;
    ssmItems[lstcnt]=["User Settings", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=usersettings&usersettings=1".$xpsid."&trash="; ?>"]
    <?php
    if(($GLOBALS["allowmakeextf"]==1) || ($user->gsv("isadmin")==1) || ($GLOBALS["demomode"]==true)){
    ?>
        lstcnt++;
        ssmItems[lstcnt]=["Extended Fields", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=extfldmgr&extfldmgr=1".$xpsid."&trash="; ?>"]
    <?php
    }
    ?>
    <?php
    if($GLOBALS["usercustom"]==1 || $user->gsv("isadmin")==1 || ($GLOBALS["demomode"]==true)){
    ?>
        lstcnt++;
        ssmItems[lstcnt]=["Configure Calendar", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=goprefs&goprefs=1".$xpsid."&trash="; ?>"]
    <?php
    }
}
if($user->gsv("uname")!="Guest") {
?>
    lstcnt++;
    ssmItems[lstcnt]=["Log off", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=endsess&endsess=1".$xpsid."&trash="; ?>"]
<?php
} else {
    ?>
    lstcnt++;
    <?php
    if($GLOBALS["userreg"]==1) {
        $ttxt = "Log on / Register";
    } else {
        $ttxt = "Log on";
    }
    ?>
    ssmItems[lstcnt]=["<?php print $ttxt; ?>", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=endsess&endsess=1".$xpsid."&trash="; ?>"]
    <?php
}
?>
lstcnt++;
ssmItems[lstcnt]=["Navigation"] //create header
lstcnt++;
ssmItems[lstcnt]=["<?php echo $langcfg["prev"]."&nbsp;".$GLOBALS["xptxt"]; ?>", "<?php echo $GLOBALS["idxfile"]."?viewdate=".$GLOBALS["xplnk"]."&viewtype=".$GLOBALS["xptxt"].$xpsid."&trash="; ?>", "", 1, "no"] //create two column row
lstcnt++;
ssmItems[lstcnt]=["<?php echo $langcfg["next"]."&nbsp;".$GLOBALS["xntxt"]; ?>", "<?php echo $GLOBALS["idxfile"]."?viewdate=".$GLOBALS["xnlnk"]."&viewtype=".$GLOBALS["xntxt"].$xpsid."&trash="; ?>", "",1]
<?php

if($user->gsv("isadmin") == 1 || $GLOBALS["demomode"] == true) {
?>
    lstcnt++;
    ssmItems[lstcnt]=["Admin"] //create header"
    lstcnt++;
    ssmItems[lstcnt]=["CaLogic Config", "reconfig.php?gosfuncs=1<?php echo $xpsid; ?>&trash=","_blank"]
    lstcnt++;
    ssmItems[lstcnt]=["History Log", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=histlog&histlog=1&record=0".$xpsid."&trash="; ?>"]
    lstcnt++;
    ssmItems[lstcnt]=["Database Maintenance", "<?php echo $GLOBALS["idxfile"]."?gosfuncs=1&qjump=databasemaint&databasemaint=1".$xpsid."&trash="; ?>"]
    lstcnt++;
    ssmItems[lstcnt]=["Check for Updates", "<?php echo "http://www.demo.calogic.de/?version=".$GLOBALS["calogicversion"]; ?>","_blank"]
<?php
}
if($GLOBALS["nonadminfunctionmenu"] == 1 || $user->gsv("isadmin") == 1 || $GLOBALS["demomode"] == true) {
?>
    buildMenu();
<?php
}
?>

