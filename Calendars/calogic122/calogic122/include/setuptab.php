<?php

# this file is used to configure the setup table
# don't mess with this file!!!!

$tmpftxt = "";
$tmpremark = "";

$sutabyn = array();
$sutabyn[0][0] = "0";
$sutabyn[0][1] = "No";
$sutabyn[1][0] = "1";
$sutabyn[1][1] = "Yes";

$minicaloption = array();
$minicaloption[0][0] = "0";
$minicaloption[0][1] = "Left";
$minicaloption[1][0] = "1";
$minicaloption[1][1] = "Right";
$minicaloption[2][0] = "2";
$minicaloption[2][1] = "Both";
$minicaloption[3][0] = "3";
$minicaloption[3][1] = "None";

$functionmenuoption = array();
$functionmenuoption[0][0] = "0";
$functionmenuoption[0][1] = "Sliding";
$functionmenuoption[1][0] = "1";
$functionmenuoption[1][1] = "Menu bar";
$functionmenuoption[2][0] = "2";
$functionmenuoption[2][1] = "Both";

# format[1][X]
# [x 1] = field name
# [x 2] = sql parameters
# [x 3] = field text
# [x 4] = remark
# [x 5] = field type, 0 = input, 1 = select
# [x 6] = array for selects
# [x 7] = 0 = enable, 1 = disable durring first setup, 2 = disable allways
# [x 8] = Standard value
# [x 9] = CaLogic Version Nmber that this field was added in.
#         This number is used to determin if the update script should
#         add this field to the _setup table.
#         What an inginious idea I had....


$fieldcnt = 0;
$setuptab = array();

##################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Site Setup</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "calogic_uid";
$setuptab[$fieldcnt][2] = "varchar(32) NOT NULL";
$setuptab[$fieldcnt][3] = "CaLogic Unique ID";
$setuptab[$fieldcnt][4] = "This is the CaLogic Unique ID. It is used to identify your CaLogic installation and for other admin and security specific functions. You should never change this ID!";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "2";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "includeautomation";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Turn on Automation";
$setuptab[$fieldcnt][4] = "Set this to yes if you intend on using automathin. Read the automating_calogic.txt file in the docs folder to learn about automation.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "siteowner";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "Site Owner";
$setuptab[$fieldcnt][4] = "Enter your full name here";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Your Name";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "email";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "E-Mail Address";
$setuptab[$fieldcnt][4] = "Enter your E-Mail Address here";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "yourname@yourdomain.com";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "sitetitle";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "Site Title";
$setuptab[$fieldcnt][4] = "Enter the Title of your Site here";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "CaLogic Calendars";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "baseurl";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "Base URL";
$setuptab[$fieldcnt][4] = "Enter the base URL of your site here, don't forget the slash at the end!";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "http://"."$wroot";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "progdir";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "Program Folder";
$setuptab[$fieldcnt][4] = "Enter the Program Folder here, without a starting slash, but the end slash is required!<br>The Base URL and the Program Folder together should be equil to the URL of your CaLogic Installation Folder.<br>Leave blank if the Base URL is the root of the program.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "$wprogdir";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "progframe";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default ''";
$setuptab[$fieldcnt][3] = "Frame Name";
$setuptab[$fieldcnt][4] = "If your CaLogic is running in a frame, then you should enter the name of that frame here. Otherwise leave blank.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "_top";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "standardlangid";
$setuptab[$fieldcnt][2] = "int(11) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Standard Language";
$setuptab[$fieldcnt][4] = "Choose the standard Language.";
$setuptab[$fieldcnt][5] = "1";
    $sutablang = array();
    $sutablang[0][0] = "1";
    $sutablang[0][1] = "English";
    $sutablang[1][0] = "2";
    $sutablang[1][1] = "Deutsch";
$setuptab[$fieldcnt][6] = $sutablang;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

/*
$setuptab[$fieldcnt][1] = "standardlangname";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'English'";
$setuptab[$fieldcnt][3] = "No display";
$setuptab[$fieldcnt][4] = "No display";
$setuptab[$fieldcnt][5] = "1";
    $sutablangname = array();
    $sutablangname[0][0] = "1";
    $sutablangname[0][1] = "English";
    $sutablangname[1][0] = "2";
    $sutablangname[1][1] = "Deutsch";
$setuptab[$fieldcnt][6] = $sutablangname;
$setuptab[$fieldcnt][7] = "2";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;
*/

$setuptab[$fieldcnt][1] = "sitetype";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Site Type<br>(not yet implemented)";
$setuptab[$fieldcnt][4] = "There are 3 types of sites to choose from. <br><b>Open</b> An Open site allows anyone to register for a calendar.<br><b>Public</b> A Public site allows anyone to register for a calendar, but the reigistration must first be aproved by the site owner.<br><b>Private</b> A Private site allows no one to register. Only the site admin can add users or create calendars.<br>(not yet implemented i.e. open is standard)";
$setuptab[$fieldcnt][5] = "1";
    $sutabsitetype = array();
    $sutabsitetype[0][0] = "0";
    $sutabsitetype[0][1] = "Open";
    $sutabsitetype[1][0] = "1";
    $sutabsitetype[1][1] = "Public";
    $sutabsitetype[2][0] = "2";
    $sutabsitetype[2][1] = "Private";
$setuptab[$fieldcnt][6] = $sutabsitetype;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "publicview";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Public View";
$setuptab[$fieldcnt][4] = "If you allow \"Public View\", then a \"Guest\" account and a \"Public\" Calendar will be created. Also, surfers will be taken directly to this \"Public\" Calendar upon entering the site.<br>The \"Guest\" user cannot add/edit/delte events, contacts or categories, nor can it enter the Calendar config. If however you turn on demo mode below, these rules no longer apply to the \"Public\" Calendar.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "userreg";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow user registration";
$setuptab[$fieldcnt][4] = "Turn on or off user registration. If turned off then no one can register. You will then have to create users manually.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "minpwlen";
$setuptab[$fieldcnt][2] = "INT DEFAULT '3' NOT NULL";
$setuptab[$fieldcnt][3] = "Min Password Length";
$setuptab[$fieldcnt][4] = "Enter the minimal Password Length.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "3";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "maxpwdays";
$setuptab[$fieldcnt][2] = "INT DEFAULT '0' NOT NULL";
$setuptab[$fieldcnt][3] = "Max Password Days";
$setuptab[$fieldcnt][4] = "Enter the number of days a users password is good. After this number of days, a user must change thier password after logging on. <b>Enter 0 to deactivate, i.e. with an entry of 0, the user never has to change thier password.<br>NOTE: Activating this option for the first time will cause all users to change thier password.</b>";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "maxpwinterval";
$setuptab[$fieldcnt][2] = "INT DEFAULT '0' NOT NULL";
$setuptab[$fieldcnt][3] = "Max Password Reuse";
$setuptab[$fieldcnt][4] = "Enter the number of times a user must change thier password before they can reuse a previous password. <b>Enter 0 to deactivate, i.e. with an entry of 0, the user can use the same password over and over again.</b>";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "badpwlock";
$setuptab[$fieldcnt][2] = "INT DEFAULT '3' NOT NULL";
$setuptab[$fieldcnt][3] = "Failed Logon Lockout";
$setuptab[$fieldcnt][4] = "Enter the number of times a user can enter a wrong password before the users account gets locked. <b>Enter 0 to deactivate, i.e. with an entry of 0, the users account will never be locked.<br>Only an admin can unlock the account.</b>";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "3";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "usercustom";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "User can Customise";
$setuptab[$fieldcnt][4] = "If set to yes, then users will be able to customise thier own Calendars in the calendar config area.<br><b>This will automatically be turned off if you turn on the Standard Default Calendar Option below.</b><br>In addition to this setting, you can greater control exactly what a user can customise on thier calendar by setting the options lower down on this form.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
if ($GLOBALS["forcedefaultcal"]==1) {
    $setuptab[$fieldcnt][7] = "1";
    $setuptab[$fieldcnt][4] .= "<br>Option disabled because Standard Default Calendar Option is on";
} else {
    $setuptab[$fieldcnt][7] = "0";
}
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "forcedefaultcal";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Default Calendar Option<br><input type='button' disabled value='Select Default Calendar' name='selectdefaultcalendar' id='selectdefaultcalendar' language='javascript' onclick='getdefaultcal()'>";
$setuptab[$fieldcnt][4] = "If this is set to yes, then new users will not have the option to create a calendar, but instead will automatically be assigned the calendar you specify.<br>If you use this, it would be wise to turn off User can Customise above.<br><b>This option is disabled during first setup, because there are no calendars created yet</b>.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "1";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "defaultcalid";
$setuptab[$fieldcnt][2] = "varchar(32) NULL default ''";
$setuptab[$fieldcnt][3] = "Standard Default Calendar ID";
$setuptab[$fieldcnt][4] = "This is the standard default calendar ID. Use the button above to select a default calendar";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "2";
$setuptab[$fieldcnt][8] = "";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "defaultcalname";
$setuptab[$fieldcnt][2] = "varchar(50) NULL default ''";
$setuptab[$fieldcnt][3] = "Standard Default Calendar name";
$setuptab[$fieldcnt][4] = "This is the standard default calendar name. Use the button above to select a default calendar";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "2";
$setuptab[$fieldcnt][8] = "";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allowmakeextf";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Extenden Field Create";
$setuptab[$fieldcnt][4] = "Select Yes to allow normal users to create Extended Event Fields for thier own Calendars.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allowaddextf";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Extenden Field Add";
$setuptab[$fieldcnt][4] = "Select Yes to allow normal users to add already created Extended Event Fields to events for thier own Calendars.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allowopen";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Open Calendars";
$setuptab[$fieldcnt][4] = "Open Calendars are free for all Calendars.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allowpublic";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Public Calendars";
$setuptab[$fieldcnt][4] = "Public Calendars are free for all to see, but can only be added to, changed or subscribed to from those users who have registered for the public calendar.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allowprivate";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Private Calendars";
$setuptab[$fieldcnt][4] = "Private Calendars are designed for single person use. However in later versions, the Calendar owner may allow certain users to view, add to or subscribe to, if desired.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Program configuration</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "servertzos";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Server Time Zone Offset";
$setuptab[$fieldcnt][4] = "This is the Time Zone Offset of your Web Server to GMT. You shouln't need to change this. (It is automatically derived, and displayed here only as a verification)";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "1";
$setuptab[$fieldcnt][8] = "$servertzos";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "formtype";
$setuptab[$fieldcnt][2] = "varchar(4) NOT NULL default 'post'";
$setuptab[$fieldcnt][3] = "Form Submitting method";
$setuptab[$fieldcnt][4] = "The POST method is the recommended method. It allows for the most security and compatibility. The one draw back of the POST method is, you cannot use your browsers forward and backward buttons to navigate in CaLogic. However, I have gone to great lengths to ensure that you don't need to use the forward/back browser buttons.<br><br>If you use the GET method, all form input will be appended to the URL, and it will be visible in the browser address field. THIS IS NOT RECOMMENDED. For one reason, the URL field is limited in length, and some of CaLogic's forms are quite long. I do not support the GET method and do not vouch for its safety or garantee that it will even work.";
$setuptab[$fieldcnt][5] = "1";
    $sutabemsfmt = array();
    $sutabfmfmt[0][0] = "post";
    $sutabfmfmt[0][1] = "Use the POST Method";
    $sutabfmfmt[1][0] = "get";
    $sutabfmfmt[1][1] = "Use the GET Method";
$setuptab[$fieldcnt][6] = $sutabfmfmt;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "post";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "adsid";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Attach Session ID to Links";
$setuptab[$fieldcnt][4] = "Setting this to yes will cause CaLogic to append the PHP Session ID onto links. Set this to yes only if you find the PHP Sessions not working. You will know they aren't working if you keep landing at the logon screen or, if you have public view turned on, and you keep landing on the Public Calendar even though you have logged on as admin.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "seiyv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show Events in Year View";
$setuptab[$fieldcnt][4] = "If you have lots of events, or you find that the year view takes too long to build, you can turn this off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "demomode";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Demo Mode";
$setuptab[$fieldcnt][4] = "Turn on or off Demo Mode. In demo mode, a notice will be displayed that \"reminders will not be sent from this demo site\". However, if you set up reminders, they will still be sent.<br>Also, demo mode effectively turns your CaLogic siteinto a free for all calendar site.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "sitewidth";
$setuptab[$fieldcnt][2] = "varchar(8) NOT NULL default '98%'";
$setuptab[$fieldcnt][3] = "Calendar width in % or pixel";
$setuptab[$fieldcnt][4] = "Enter the width the CaLogic application should be. If using procent, be sure to add the \"%\" symbol.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "98%";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_functionmenutype";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Type of function menu to use";
$setuptab[$fieldcnt][4] = "Select the type of function menu to use.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $functionmenuoption;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "functionmenutext";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Functions'";
$setuptab[$fieldcnt][3] = "Text shown on the functions menu tab";
$setuptab[$fieldcnt][4] = "Enter the text that will be shown on the functions menu tab.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Functions";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "nonadminfunctionmenu";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show function menu for non admins";
$setuptab[$fieldcnt][4] = "Set this to <b>NO</b> to hide the functions menu for non admin users.<br><b>NOTE:</b> if you set this to <b>NO</b>, there is only one way to get to the logon screen.<br>And that is by using a special URL as follows:<br>http://www.yourweb.com/calogic/index.php?gologinform=1<br>You have to change 'www.yourweb.com/calogic' to point to your CaLogic URL.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


##################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Reminders</b><br>If you want to use reminders, you have to set these variables to the same settings you set your scheduler to.<br><b>You must set up some kind of scheduler (cron tab for example) to run the send reminders script regularly. Read the reminders.txt file in docs folder on how to do this.</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "allowreminders";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow Reminders";
$setuptab[$fieldcnt][4] = "If you are able to set up a cron tab (on a Unix Web Server) or some other sort of automatic timer, then you could use reminders if desired.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "rfrequency";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '5'";
$setuptab[$fieldcnt][3] = "Reminder Frequency";
$setuptab[$fieldcnt][4] = "The frequency of the reminder interval at which the reminder script will be called.<br>For example: If you set up your scheduler to call the reminder script every 5 minutes, you would set this field to 5, and the next field to Minutes.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "5";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "rinterval";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Reminder Interval Unit";
$setuptab[$fieldcnt][4] = "Set this to the interval unit at which your scheduler will call the reminder script.";
$setuptab[$fieldcnt][5] = "1";
    $surint = array();
    $surint[0][0] = "1";
    $surint[0][1] = "Minutes";
    $surint[1][0] = "2";
    $surint[1][1] = "Hours";
    $surint[2][0] = "3";
    $surint[2][1] = "Days";
$setuptab[$fieldcnt][6] = $surint;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "rdahead";
$setuptab[$fieldcnt][2] = "int(8) NOT NULL default '30'";
$setuptab[$fieldcnt][3] = "Reminder Days in Advance";
$setuptab[$fieldcnt][4] = "This tells CaLogic how many days into the future to check for events with reminders. Valid ranges are from 1 to 365. A good setting would be 30.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "30";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Email Config</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "mailtype";
$setuptab[$fieldcnt][2] = "varchar(8) NOT NULL default 'sendmail'";
$setuptab[$fieldcnt][3] = "E-Mail server type";
$setuptab[$fieldcnt][4] = "If your CaLogic installation is based on a *nix (Unix / Linux) server then you should use the sendmail program.<br>SMTP is also supported.";
$setuptab[$fieldcnt][5] = "1";
    $sutabems = array();
    $sutabems[0][0] = "sendmail";
    $sutabems[0][1] = "unix sendmail";
    $sutabems[1][0] = "smtp";
    $sutabems[1][1] = "SMTP mail";
#    $sutabems[2][0] = "qmail";
#    $sutabems[2][1] = "qmail program";
$setuptab[$fieldcnt][6] = $sutabems;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "sendmail";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "mailformat";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Standard Mail Format";
$setuptab[$fieldcnt][4] = "Select the standard email format you want to use. Note: a plain text part is also sent with HTML mails. This is to ensure compatibility with non HTML enabled email programs. This is also individually configurable for each user and contact.";
$setuptab[$fieldcnt][5] = "1";
    $sutabemsfmt = array();
    $sutabemsfmt[0][0] = "0";
    $sutabemsfmt[0][1] = "HTML Format";
    $sutabemsfmt[1][0] = "1";
    $sutabemsfmt[1][1] = "Plain Text";
$setuptab[$fieldcnt][6] = $sutabemsfmt;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "anonsmsallow";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow Anonymous Subscriber SMS";
$setuptab[$fieldcnt][4] = "Select Yes to allow anonymous reminder subscribers to be able to select the SMS option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "uniem";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Use Names in E-Mail addresses";
$setuptab[$fieldcnt][4] = "Some E-Mail systems have problems if anything other than the E-Mail Address is in the From or To Fields of an E-Mail. If you have such an E-Mail program, or you find the E-Mails not working, try setting this to No. ";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "sadmmail";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Send Owner E-Mail";
$setuptab[$fieldcnt][4] = "Setting this to yes will cause CaLogic to send you an E-Mail when certain activities happen. Like whenever an event gets added or deleted on any Calendar, or when someone registers or cancels their registration.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

/*
$setuptab[$fieldcnt][1] = "mailpath";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Sendmail or qmail program path";
$setuptab[$fieldcnt][4] = "If you use sendmail or qmail, then enter the path to the program here, otherwise this field can be ignored.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "/usr/sbin/sendmail";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;
*/
###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>SMTP Mail Parameters</b> You must set these parameters if using SMTP to send mail. Otherwise, can be ignored.";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "smtphost";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "SMTP host Server";
$setuptab[$fieldcnt][4] = "The server name that you are sending mails thru.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "localhost";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "smtpport";
$setuptab[$fieldcnt][2] = "varchar(10) NULL default ''";
$setuptab[$fieldcnt][3] = "SMTP host Server Port";
$setuptab[$fieldcnt][4] = "The port number used by the SMTP Server.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "25";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "smtpuser";
$setuptab[$fieldcnt][2] = "varchar(50) NULL default ''";
$setuptab[$fieldcnt][3] = "SMTP Auth user name";
$setuptab[$fieldcnt][4] = "If your SMTP Server uses Auth (Authentication) then you must supply a user name here. Otherwise leave blank.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

/*
$setuptab[$fieldcnt][1] = "smtprealm";
$setuptab[$fieldcnt][2] = "varchar(50) NULL default ''";
$setuptab[$fieldcnt][3] = "SMTP Auth realm";
$setuptab[$fieldcnt][4] = "If your SMTP Server uses Auth (Authentication) then you must supply a realm here if needed. Otherwise leave blank.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;
*/

$setuptab[$fieldcnt][1] = "smtppass";
$setuptab[$fieldcnt][2] = "varchar(50) NULL default ''";
$setuptab[$fieldcnt][3] = "SMTP Auth Password";
$setuptab[$fieldcnt][4] = "If your SMTP Server uses Auth (Authentication) then you must supply a password here. Otherwise leave blank.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Menu and Popup Configuration options</b> These are the default values. Setting an 'Allow Owner Config' option to 'Yes' will allow Calendar Owners to be able to change that setting for thier own calendar in the calendar config area.";
$fieldcnt++;
##################################################

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;<b>Function and Navigation Menu configuration</b>";
$fieldcnt++;
##################################################

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;&nbsp;<b>Horizontal Menu Bar Configuration</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "pu_MenuBarColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Burlywood'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Color";
$setuptab[$fieldcnt][4] = "This is the color of the Horizontal Menu Bar.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Burlywood";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuBarFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Font";
$setuptab[$fieldcnt][4] = "This is the font of the Horizontal Menu Bar.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuBarFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#000000'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Horizontal Menu Bar.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#000000";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;



$setuptab[$fieldcnt][1] = "pu_MenuBarFontSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '12'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Horizontal Menu Bar in points.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "12";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuBarHighlightColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Saddlebrown'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Highlight color";
$setuptab[$fieldcnt][4] = "This is the highlight color of the Horizontal Menu Bar.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Saddlebrown";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_MenuBarHighlightFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Highlight Font";
$setuptab[$fieldcnt][4] = "This is the font of the Horizontal Menu Bar when Highlighted.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_MenuBarHighlightFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FFFFFF'";
$setuptab[$fieldcnt][3] = "Horizontal Menu Bar Highlight Font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Horizontal Menu Bar when Highlighted.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FFFFFF";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;&nbsp;<b>Vertical Menu Item Configuration</b>";
$fieldcnt++;
##################################################


$setuptab[$fieldcnt][1] = "pu_MenuItemBorderColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Saddlebrown'";
$setuptab[$fieldcnt][3] = "Vertical Menu Border Color";
$setuptab[$fieldcnt][4] = "This is the border color of the Vertical Menu items.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Saddlebrown";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuItemColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Wheat'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Color";
$setuptab[$fieldcnt][4] = "This is the color of the Vertical Menu Items.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Wheat";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuItemFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Font";
$setuptab[$fieldcnt][4] = "This is the font of the Vertical Menu Items.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuItemFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Black'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Vertical Menu Items.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Black";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuItemFontSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '11'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Vertical Menu Items in points.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "11";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_MenuItemHighlightColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Peru'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Highlight color";
$setuptab[$fieldcnt][4] = "This is the highlight color of the Vertical Menu Items.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Peru";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_MenuItemHighlightFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Highlight Font";
$setuptab[$fieldcnt][4] = "This is the font of the Vertical Menu Items when Highlighted.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_MenuItemHighlightFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'White'";
$setuptab[$fieldcnt][3] = "Vertical Menu Item Highlight Font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Vertical Menu Items when Highlighted.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "White";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;&nbsp;<b>Mouse over Popup Configuration</b>";
$fieldcnt++;
##################################################


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Events of the day popup</b>";
$fieldcnt++;
##################################################

#$pu_PopupDayBorderColor = "#009933";

$setuptab[$fieldcnt][1] = "pu_PopupDayCaptionColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#009933'";
$setuptab[$fieldcnt][3] = "Day Event Popup caption color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup caption for the days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#009933";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupDayCaptionFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Day Event Popup Caption Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Caption Text for the Days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupDayCaptionFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FFFFFF'";
$setuptab[$fieldcnt][3] = "Day Event Popup caption font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup caption text for the days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FFFFFF";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;



$setuptab[$fieldcnt][1] = "pu_PopupDayCaptionSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Day Event Popup Caption Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup caption Text for the Days events in HTML size.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupDayColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#99ff99'";
$setuptab[$fieldcnt][3] = "Day Event Popup color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup box for the Days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#99ff99";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupDayFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Day Event Popup Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Text for the Days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupDayFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#000000'";
$setuptab[$fieldcnt][3] = "Day Event Popup Font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup Text for the Days events.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#000000";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupDayFontSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Day Event Popup Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup Text for the Days events in HTML size (1 to 7).";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;&nbsp;<b>Event description Popup</b>";
$fieldcnt++;
##################################################

#$pu_PopupDayBorderColor = "#009933";

$setuptab[$fieldcnt][1] = "pu_PopupEventCaptionColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#333399'";
$setuptab[$fieldcnt][3] = "Event description Popup caption color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup caption for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#333399";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupEventCaptionFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Event description Popup Caption Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Caption Text for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupEventCaptionFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FFFFFF'";
$setuptab[$fieldcnt][3] = "Event description Popup caption font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup caption text for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FFFFFF";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;



$setuptab[$fieldcnt][1] = "pu_PopupEventCaptionSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Event description Popup Caption Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup caption Text for an event description in HTML size.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupEventColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#CCCCFF'";
$setuptab[$fieldcnt][3] = "Event description Popup color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup box for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#CCCCFF";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupEventFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Event description Popup Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Text for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupEventFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#000000'";
$setuptab[$fieldcnt][3] = "Event description Popup Font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup Text for an event description.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#000000";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupEventFontSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Event description Popup Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup Text for an event description in HTML size (1 to 7).";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "&nbsp;&nbsp;<b>Event Creator Popup</b>";
$fieldcnt++;
##################################################

#$pu_PopupDayBorderColor = "#009933";

$setuptab[$fieldcnt][1] = "pu_PopupCreatorCaptionColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FF6633'";
$setuptab[$fieldcnt][3] = "Event Creator Popup caption color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup caption for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FF6633";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupCreatorCaptionFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Event Creator Popup Caption Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Caption Text for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupCreatorCaptionFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FFFFFF'";
$setuptab[$fieldcnt][3] = "Event Creator Popup caption font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup caption text for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FFFFFF";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;



$setuptab[$fieldcnt][1] = "pu_PopupCreatorCaptionSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Event Creator Popup Caption Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup caption Text for an event Creator in HTML size.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupCreatorColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#FEF3E0'";
$setuptab[$fieldcnt][3] = "Event Creator Popup color";
$setuptab[$fieldcnt][4] = "This is the color of the Popup box for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#FEF3E0";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupCreatorFont";
$setuptab[$fieldcnt][2] = "varchar(100) NOT NULL default 'Verdana,Arial,Helvetica'";
$setuptab[$fieldcnt][3] = "Event Creator Popup Font";
$setuptab[$fieldcnt][4] = "This is the font of the Popup Text for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Verdana,Arial,Helvetica";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "pu_PopupCreatorFontColor";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '#000000'";
$setuptab[$fieldcnt][3] = "Event Creator Popup Font color";
$setuptab[$fieldcnt][4] = "This is the font color of the Popup Text for an event Creator.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "#000000";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "pu_PopupCreatorFontSize";
$setuptab[$fieldcnt][2] = "varchar(10) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Event Creator Popup Font size";
$setuptab[$fieldcnt][4] = "This is the font size of the Popup Text for an event Creator in HTML size (1 to 7).";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Calendar Look and Feel</b> These are the default values. Setting an 'Allow Owner Config' option to 'Yes' will allow Calendar Owners to be able to change that setting for thier own calendar in the calendar config area.";
$fieldcnt++;
##################################################

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Global</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "subtitletxt";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default 'Sub Title:'";
$setuptab[$fieldcnt][3] = "Event Sub Title Descriptor";
$setuptab[$fieldcnt][4] = "This is a freely definable event field. Enter the text that names the field. 'Location' for example.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Sub Title:";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "standardbgimg";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default './img/stonbk.jpg'";
$setuptab[$fieldcnt][3] = "Standard Background image";
$setuptab[$fieldcnt][4] = "Enter a URL for the background image of your CaLogic site, or leave it blank for none.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "./img/stonbk.jpg";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "standardbgcolor";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default 'white'";
$setuptab[$fieldcnt][3] = "Standard Background color";
$setuptab[$fieldcnt][4] = "Enter the color name or hex number (#ff0000 for example) for the background color of your CaLogic site, or leave it blank for none.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "white";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "btxtcolor";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default 'black'";
$setuptab[$fieldcnt][3] = "Standard Text color";
$setuptab[$fieldcnt][4] = "Enter the color name or hex number (#ff0000 for example) for the text used on the site (This does not include the calendar itself, which is configured using the calendar config pages.)";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "black";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "btxtfont";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default 'Times New Roman'";
$setuptab[$fieldcnt][3] = "Standard Text Font";
$setuptab[$fieldcnt][4] = "Enter the Font Name exactly as it appears in your font list. This font will be used in all Calendar Views. <br><b>Remember, not all fonts are available on all computers. If a user does not have the font you choose, <br> then the default font for thier computer will be used.</b>";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "Times New Roman";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "btxtsize";
$setuptab[$fieldcnt][2] = "varchar(20) NOT NULL default '11'";
$setuptab[$fieldcnt][3] = "Standard Text Font Size in points";
$setuptab[$fieldcnt][4] = "Enter the font size in points.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "11";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "headpic";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Header Banner Pic URL";
$setuptab[$fieldcnt][4] = "Enter the URL for the Header Banner. All standard graphic files are supported, as well as Shockwave Flash Files.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "headtext";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Header Banner Picture text";
$setuptab[$fieldcnt][4] = "Text shows up when the mouse hovers over the picture";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "headlink";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Header Banner Link";
$setuptab[$fieldcnt][4] = "If you would like the Header Picture to be linked, enter the URL to link to here. Shockwave Flash Files cannot be linked.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "headtarget";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default '_blank'";
$setuptab[$fieldcnt][3] = "Header Banner Link Target";
$setuptab[$fieldcnt][4] = "Enter where you would like the link to be opened.<br>Here are some tips:<br>_blank = new browser<br>_top = current browser<br>If you are useing frames, you can also enter a frame name here.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "_blank";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "footpic";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Footer Banner Pic URL";
$setuptab[$fieldcnt][4] = "Enter the URL for the Footer Banner. All standard graphic files are supported, as well as Shockwave Flash Files.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "foottext";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Footer Banner Picture text";
$setuptab[$fieldcnt][4] = "Text shows up when the mouse hovers over the picture";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "footlink";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default ''";
$setuptab[$fieldcnt][3] = "Footer Banner Link";
$setuptab[$fieldcnt][4] = "If you would like the Footer Picture to be linked, enter the URL to link to here.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "foottarget";
$setuptab[$fieldcnt][2] = "varchar(100) NULL default '_blank'";
$setuptab[$fieldcnt][3] = "Footer Banner Link Target";
$setuptab[$fieldcnt][4] = "Enter where you would like the link to be opened.<br>Here are some tips:<br>_blank = new browser<br>_top = current browser<br>If you are useing frames, you can also enter a frame name here.";
$setuptab[$fieldcnt][5] = "0";
$setuptab[$fieldcnt][6] = "";
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "_blank";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "dispcnpd";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Display Calendar Selection Menu";
$setuptab[$fieldcnt][4] = "Turn on or off the displaying of Calendar Selection box in the Calendar Header.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
if ($GLOBALS["forcedefaultcal"]==1) {
    $setuptab[$fieldcnt][7] = "1";
    $setuptab[$fieldcnt][4] .= "<br>Option disabled because Standard Default Calendar Option is on";
} else {
    $setuptab[$fieldcnt][7] = "0";
}
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "showomd";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show Out of Month Day Numbers";
$setuptab[$fieldcnt][4] = "Turn on or off the showing of day numbers and events in out of month cells (days that are not in the currently viewd month.)";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Day View</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "allowdv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Enable Day View";
$setuptab[$fieldcnt][4] = "Turn the Day View on or off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "showdvtime";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show the time column in Day View<br>(not yet implemented)";
$setuptab[$fieldcnt][4] = "Turn on or off the showing of time cells in the Day View<br>(not yet implemented).";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "mcdv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Day View mini calendar option";
$setuptab[$fieldcnt][4] = "The mini calendar is a small representation of a month. It is very usefull in that it can show you an overview of the previous, next or current month depending on how you set it to display.<br>Turning on either the left or right mini calendar will display the actual month. Turning on both will show you the previous and next month.<br>You can click on a day number on the mini cal to show the day view of the day clicked. Click on the month name in the mini cal title bar to jump to the month view.<br>While holding the mouse over a day number, you will be presented with a popup of the events on that day. The mini calendar days are also color coded acording to the first event scheduled for that day.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $minicaloption;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Week View</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "allowwv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Enable Week View";
$setuptab[$fieldcnt][4] = "Turn the Week View on or off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "dispwvpd";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Display Week Selection Menu";
$setuptab[$fieldcnt][4] = "Turn on or off the displaying of Week View Selection box in the Calendar Header.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "showwvtime";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show the time column in Week View<br>(not yet implemented)";
$setuptab[$fieldcnt][4] = "Turn on or off the showing of time cells in the Week View<br>(not yet implemented).";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "mcwv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Week View mini calendar option";
$setuptab[$fieldcnt][4] = "The mini calendar is a small representation of a month. It is very usefull in that it can show you an overview of the previous, next or current month depending on how you set it to display.<br>Turning on either the left or right mini calendar will display the actual month. Turning on both will show you the previous and next month.<br>You can click on a day number on the mini cal to show the day view of the day clicked. Click on the month name in the mini cal title bar to jump to the month view.<br>While holding the mouse over a day number, you will be presented with a popup of the events on that day. The mini calendar days are also color coded acording to the first event scheduled for that day.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $minicaloption;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Month View</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "allowmv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Enable Month View";
$setuptab[$fieldcnt][4] = "Turn the Month View on or off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "dispmvpd";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Display Month Selection Menu";
$setuptab[$fieldcnt][4] = "Turn on or off the displaying of Month View Selection box in the Calendar Header.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "mcmv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '2'";
$setuptab[$fieldcnt][3] = "Month View mini calendar option";
$setuptab[$fieldcnt][4] = "The mini calendar is a small representation of a month. It is very usefull in that it can show you an overview of the previous, next or current month depending on how you set it to display.<br>Turning on either the left or right mini calendar will display the actual month. Turning on both will show you the previous and next month.<br>You can click on a day number on the mini cal to show the day view of the day clicked. Click on the month name in the mini cal title bar to jump to the month view.<br>While holding the mouse over a day number, you will be presented with a popup of the events on that day. The mini calendar days are also color coded acording to the first event scheduled for that day.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $minicaloption;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "2";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;

###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Year View</b>";
$fieldcnt++;
##################################################

$setuptab[$fieldcnt][1] = "allowyv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Enable Year View";
$setuptab[$fieldcnt][4] = "Turn the Year View on or off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "dispyvpd";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Display Year Selection Menu";
$setuptab[$fieldcnt][4] = "Turn on or off the displaying of Year View Selection box in the Calendar Header.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "mcyv";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '3'";
$setuptab[$fieldcnt][3] = "Year View mini calendar option";
$setuptab[$fieldcnt][4] = "The mini calendar is a small representation of a month. It is very usefull in that it can show you an overview of the previous, next or current month depending on how you set it to display.<br>Turning on either the left or right mini calendar will display the actual month. Turning on both will show you the previous and next month.<br>You can click on a day number on the mini cal to show the day view of the day clicked. Click on the month name in the mini cal title bar to jump to the month view.<br>While holding the mouse over a day number, you will be presented with a popup of the events on that day. The mini calendar days are also color coded acording to the first event scheduled for that day.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $minicaloption;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "3";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";
$setuptab[$fieldcnt][9] = "122";
$fieldcnt++;


###################################################
$setuptab[$fieldcnt][1] = "tabhead";
$setuptab[$fieldcnt][2] = "<b>Event Display</b>";
$fieldcnt++;
##################################################


$setuptab[$fieldcnt][1] = "dispevcr";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Display Event Creator Name";
$setuptab[$fieldcnt][4] = "Turn on or off the displaying of Event Creator Name above the event.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "withesb";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show Month View Event Scroll Box";
$setuptab[$fieldcnt][4] = "Turn on or off the Event Scroll Box in the Month View. This option when turned on, keeps the monh view tidy.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;


$setuptab[$fieldcnt][1] = "withwvesb";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '1'";
$setuptab[$fieldcnt][3] = "Show Week View Event Scroll Box";
$setuptab[$fieldcnt][4] = "Turn on or off the Event Scroll Box in the Week View. This option when turned on, keeps the week view tidy.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "1";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "withdvesb";
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Show Day View Event Scroll Box";
$setuptab[$fieldcnt][4] = "Turn on or off the Event Scroll Box in the Day View. The day view is so roomy, you should keep this option turned off.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";

$tmpftxt = $setuptab[$fieldcnt][1];
$tmpremark = $setuptab[$fieldcnt][3];
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;

$setuptab[$fieldcnt][1] = "allow_".$tmpftxt;
$setuptab[$fieldcnt][2] = "tinyint(4) NOT NULL default '0'";
$setuptab[$fieldcnt][3] = "Allow ".$tmpremark." customization.";
$setuptab[$fieldcnt][4] = "Selecting 'Yes' will allow calendar owners to customize this option.";
$setuptab[$fieldcnt][5] = "1";
$setuptab[$fieldcnt][6] = $sutabyn;
$setuptab[$fieldcnt][7] = "0";
$setuptab[$fieldcnt][8] = "0";
$setuptab[$fieldcnt][9] = "100";
$fieldcnt++;




###################################################
# hidden fields start here
###################################################


?>

