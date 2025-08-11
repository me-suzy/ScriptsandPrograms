<?php
session_start();
////////////////////////////////////////////////////////////////
// Another Calendar ///////////////////////////////////////////
//
// Please visit http://www.blog.snag.se/forum/ 
// and post your thoughts about the script. 
//
// Creative Commons License (creativecommons.org)
// http://creativecommons.org/licenses/by-nc-sa/2.0/
//
////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

// Use as it is or include it in a php page.
// If you're happy with the style of the calendar.
// You don't need to change anything.
// Else you can change the colours below.

// To add events, use this: index.php?act=add
// If you put the calendar in the sub directory "calendar".
// Use: http://www.yoursite.com/calendar/index.php?act=add

// Username and password for adding events.
// Change this.
$username = "user";
$password = "pass";

// Name of the month, in the language you want.
$january = 'jan';
$february = 'feb';
$march = 'mars';
$april = 'apr';
$may = 'maj';
$june = 'juni';
$july = 'juli';
$august = 'aug';
$september = 'sept';
$october = 'okt';
$november = 'nov';
$december = 'dec';

// Name of the days, in the language you want.
$monday = "m";
$tuesday = "t"; 
$wednesday = "o";
$thursday = "t";
$friday = "f";
$saturday = "l";
$sunday = "s";

// If you wish the calendar to start the week with Monday, leave this true.
// Else edit it to "false", to make the week start with Sunday.
$startwithmonday = true;

// Virtual path to event files.
// If the calendar is included in some other file, use this to point
// to the calendar directory from main file.
$path = "./";

// If you want to se weeknumber, else false.
$weeknumber = true;

// Width of the calander. 
$width = "50px";

// Color of the days in current month.
$numberBGColor = "#EEE";
$numberTextColor ="#000";

// Color of the days before and after current month.
$emptyBGColor = "#FFF";
$emptyTextColor ="#FFF";

// The color the "hover" day should change to.
$selBGColor = "#999";
$selTextColor = "#000";

// The colour for today.
$todayBGColor = "#FF9999";
$todayTextColor = "#FFFFFF";

// Colours for the month and day names.
$monthBGColor = "#FFFFFF";
$monthTextColor = "#A7D18D";
$daysBGColor = "#CCCCCC";
$weekBGColor = "#EEEEEE";


$background = "#FFFFFF";

// Colours to toggle between if more then one event.
$event1 = "#EEEEEE";
$event2 = "#CCCCCC";

// If you want space between the days comment out this.
//$spacing = "collapse";


////////////////////////////////////////////////////////////////
// Start of actual code, no need to change ////////////////////
//
if($startwithmonday) {
	$dayName = array($monday, $tuesday, $wednesday, $thursday, $friday, $saturday,$sunday);
} else {
	$dayName = array($sunday, $monday, $tuesday, $wednesday, $thursday, $friday, $saturday);
}

$monthName = array($january, $february, $march, $april, $may, $june, $july, $august, $september, $october,
$november, $december);

if(isset($_GET['act'])){
	$act = $_GET['act'];
} else {
	$act = "";
}
if(isset($_GET['date'])){
	$date = $_GET['date'];
} else {
	$date = date("Y-m-d");
}

////////////////////////////////////////////////////////////////
// CSS for the calender ///////////////////////////////////////
//
echo "<STYLE type=\"text/css\">
<!--
.A {	
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			bold;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	vertical-align: 		middle;
	text-align: 			center;
	color:				$numberTextColor;

}

.sel {	
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			normal;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	text-align: 			center;
	vertical-align: 		middle; 
	cursor: 			default;
	color:				$selTextColor;
	background-color:		$selBGColor;
}
.event {
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			normal;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	cursor: 			default;
	vertical-align: 		middle;
	text-align: 			center;
	color:				$numberTextColor;
	background-color:		$numberBGColor;
}

.empty {
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			normal;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	cursor:				default;
	vertical-align: 		middle;
	text-align: 			center;
	color:				$emptyTextColor;
	background-color:		$emptyBGColor;
}
.today {
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			normal;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	cursor: 			default;
	vertical-align: 		middle;
	text-align: 			center;
	color:				$todayTextColor;
	background-color:		$todayBGColor;
}";

if($act == "event") {

echo "table {
	width:				250px; 
	border-style: 			none;
	padding:			0px;
	margin:				0px;
	vertical-align: 		middle;
}

td {	
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size:        		10;
	font-weight:      		normal;
	font-style:       		normal;
	text-align: 			center;
	vertical-align: 		middle;
	padding:			2 2 2 2;
	text-align:			left;
	vertical-align: 		top;
	vertical-align: 		middle;
}\n";
} else {
echo ".table {
	border-style: 			none;


 	border-collapse: 		$spacing;
	empty-cells: 			hide;
}

.td {	
	font-family: 			Verdana, Arial, Helvetica, sans-serif;
	font-size: 			10px;
	font-style: 			normal;
	line-height: 			normal;
	font-weight: 			normal;
	font-variant: 			normal;
	text-transform: 		none;
	text-decoration: 		none;
	text-align: 			center;
	vertical-align: 		middle; 
}";
}
echo "-->\n</STYLE>\n\n";
// End of CSS
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for creating the current month ////////////////////
//
function createMonth($date) {
	
	global $startwithmonday;
	
	$date = split("\-", $date);
	$year = $date[0];
	$month = $date[1];
	
	// Dates
	
	$this_month_date = makeDate($year, $month, 1);
	$last_month_date = makeDate($year, $month - 1, 1);
	$next_month_date = makeDate($year, $month + 1, 1);
	// Numbers
	$this_month_first_day = trim(date("w", $this_month_date));
	
	$this_month_days = trim(date("t", $this_month_date));
	$last_month_days = trim(date("t", $last_month_date));
	
	$this_month_number = trim(date("n", $this_month_date));
	$last_month_number = trim(date("n", $last_month_date));
	$next_month_number = trim(date("n", $next_month_date));
	
	$this_month_year = trim(date("Y", $this_month_date));
	$last_month_year = trim(date("Y", $last_month_date));
	$next_month_year = trim(date("Y", $next_month_date));
	
	if($startwithmonday) {
		if($this_month_first_day == 0) {
			$this_month_first_day = 7;
		}
	} else {
		$this_month_first_day++;
	}
	
		
	// Förra
	for($I = 1; $I < $this_month_first_day; $I++) {
		$temp = $last_month_days - $this_month_first_day + $I + 1;
		$monthArray["$last_month_year-$last_month_number-$temp"] = array(0, "$last_month_year-$last_month_number-$temp");
	}
	// Månad.
	for($I = 1; $I <= $this_month_days; $I++) {
		$monthArray["$this_month_year-$this_month_number-$I"] = array(1, "$this_month_year-$this_month_number-$I");
	}
	// Nästa
	for($I = 1; $I <= 43 - $this_month_days - $this_month_first_day; $I++) {
		$monthArray["$next_month_year-$next_month_number-$I"] = array(0, "$next_month_year-$next_month_number-$I");
	}
return $monthArray;	
};

// End of createMonth function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for adding events to month ////////////////////////
//
function appendEvent($date, $monthArray) {
	
	global $path, $act;
	
	$date = split("\-", $date);
	$year = $date[0];
	$month = $date[1];

	$date = makeDate($year, $month, 1);
	$date = date("Y-m", $date);

	
	
	if($act == "event") {
		$fp = @fopen("$date.txt", "r");
	} else {
		$fp = @fopen("$path$date.txt", "r");
	}
	
	if($fp) {
		while (!feof($fp))  { 
			$line = fgets($fp);
			if($line != "") {
				$data = split("\#", $line);
				$date = split("\|", $data[0]);
				$monthArray["$date[0]"][0] = 2;
				$monthArray["$date[0]"][1] = "$date[0]";
				$monthArray["$date[0]"][2][] = array("$date[1]", "$data[1]");
			}
		}
	}
	return $monthArray;
};
// End of appendEvent function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for adding the current day ////////////////////////
//
function addToday($date, $monthArray) {
	$date = split("\-", $date);
	$year = $date[0];
	$month = $date[1];
	$this_year = date("Y");
	$this_month = date("n");
	
	if($year == $this_year && $month == $this_month) {
		$monthArray[date("Y-n-j")][0] +=2;
	}
	return $monthArray;
};
// End of appendEvent function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for displaying the current month //////////////////
//
function displayMonth($date, $monthArray) {
	
	global $path, $weekBGColor, $weeknumber, $width, $monthName, $dayName, $monthBGColor, $monthTextColor, $daysBGColor;

	$date = split("\-", $date);
	$year = $date[0];
	$month = $date[1];
	
	$this_month = mktime(0, 0, 0, $month, 1,  $year);
	$last_month = mktime(0, 0, 0, $month - 1, 1,  $year);
	$next_month = mktime(0, 0, 0, $month + 1, 1,  $year);



	////////////////////////////////////////////////////////
	// Javascript for popup window. ///////////////////////
	//
	echo "<script type=\"text/javascript\">
	<!--
	
	function event(location){
	
	win=window.open(\"\",\"\",\"height=400,width=280, scrollbars=0, resizable=1, location=0, menubar=0, toolbar=0, status=0\")
	//win.moveTo(0,0)
	//win.resizeTo(heigh,width)
	win.location=location
	}
	//-->
	</script>\n\n";
	//
	////////////////////////////////////////////////////////


echo "<TABLE class=\"table\" cellspacing=\"0\" cellpadding=\"0\" width=\"$width\">\n<TR>\n";
echo "<TD class=\"td\" color=\"$monthTextColor\" bgcolor=\"$monthBGColor\" onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='td'\" >\n<A class=\"A\" HREF=\"?date=";
echo date("Y-m-j", $last_month);
echo "\">&laquo;</A>\n</TD>\n<TD class=\"td\" color=\"$monthTextColor\"  bgcolor=\"$monthBGColor\">\n";
echo $monthName[$month-1];
echo date(" Y", $this_month);
echo "\n</TD>\n<TD class=\"td\" color=\"$monthTextColor\"  bgcolor=\"$monthBGColor\" onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='td'\" >\n<A class=\"A\" HREF=\"?date=";
echo date("Y-m-j", $next_month);
echo "\">&raquo;</A>\n</TD>\n</TR>\n<TR>\n";
	
echo "<TD class=\"td\" colspan=\"3\">\n	<TABLE class=\"table\" width=\"100%\">\n<TR>\n";

foreach ($dayName as $key) {
	echo "<TD class=\"td\"  bgcolor=\"$daysBGColor\">$key</TD>\n";
}
if($weeknumber) {
	echo "<TD class=\"td\"  bgcolor=\"$daysBGColor\">v.</TD>\n";
}

echo "</TR>\n\n<TR>\n";


	////////////////////////////////////////////////////////
	// Prints the days. ///////////////////////////////////
	//
	$day = 0;
	
	if($weeknumber) {
		$week = date("W", $this_month);
	}
		
	
	foreach ($monthArray as $key) {
		$date = split("\-", $key[1]);
	
		if($key[0] == 0) {
		        echo "<TD class=\"empty\">$date[2]</TD>\n";
		} else if($key[0] == 1) {
			echo "<TD onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='event'\" class=\"event\">$date[2]</TD>\n";
		} else if($key[0] == 2) {
			echo "<TD onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='event'\" class=\"event\"><A class=\"A\" HREF=\"javascript:event('$path?act=event&date=" . $key[1] . "')\">$date[2]</A></TD>\n";
		} else if ($key[0] == 3) {
			echo "<TD onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='today'\" class=\"today\">$date[2]</TD>\n";
		} else if ($key[0] == 4) {
			echo "<TD onMouseOver=\"this.className='sel'\" onMouseOut=\"this.className='today'\" class=\"today\"><A class=\"A\" HREF=\"javascript:event('$path?act=event&date=" . $key[1] . "')\"><B>$date[2]</B></A></TD>\n";
		}
	$day++;
	if($day >= 7) {
		if($weeknumber) {
			echo "<TD bgcolor=\"$weekBGColor\" class=\"event\">$week</TD>\n";
			if($week >= 53) {
				$week = 0;
			}
			$week++;
		}
		echo "</TR>\n<TR>\n";
		$day = 0;
	}
	//
	////////////////////////////////////////////////////////
}
echo "</TR>\n</TABLE>\n</TD></TR></TABLE>\n";



};

// End of displayMonth function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for diplay of an event. ///////////////////////////
//
function displayEvent($date, $monthArray) {
	
	global $event1, $event2 , $monthName;
	
	$date = split("\-", $date);
	$year = $date[0];
	$month = $date[1];
	$day = $date[2];
	$event = $monthArray["$year-$month-$day"][2];

	echo "<TABLE>\n";
	echo "<TR>\n<TD bgcolor=\"$event2\"colspan=\"2\">\n";
	echo $day . " " . $monthName[$month-1] . ", " . $year;
	echo "\n</TD>\n</TR>\n\n";
	foreach ($event as $key) {
		echo "<TR>\n";
		echo "<TD width=\"90px\" bgcolor=\"$event1\">\n";
		
		$time = split("\-",$key[0]);
		echo "$time[0]";
		if($time[1] != ":") {
			echo "-$time[1]";
		}
		
		echo "\n</TD>\n";
		echo "<TD bgcolor=\"$event1\" width=\"210px\">\n";
		echo $key[1];
		echo "\n<TD>\n</TR>\n\n";
	$temp = $event1;
	$event1 = $event2;
	$event2 = $temp;
	}
	echo "</TABLE>\n";
};
// End of displayEvent function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for adding event. /////////////////////////////////
//
function login() {
	global $username, $password;
	
	if (isset($_POST['calender_username']) && isset($_POST['calender_password'])) {
		if ($_POST['calender_username'] == $username && $_POST['calender_password'] == $password) {
			$_SESSION['calender_login'] = 1;
		}
		
	}
	
	if(isset($_SESSION['calender_login']) && $_SESSION['calender_login'] == 1) {
	?>

<form action='./?act=addEvent' method='post' enctype='multipart/form-data' name='login'>
  <table width="200" border="0" cellpadding="0" cellspacing="0">
    <tr> 
      <td>Year:</td>
      <td> 
        <select name="calender_year">
        <option value="2005">2005</option>
        <option value="2006">2006</option>
        <option value="2007">2007</option>
        <option value="2008">2008</option>

      </select></td></tr><tr>
      <td>Month:</td><td>
        <select name="calender_month">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>

        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>

        <option value="11">11</option>
        <option value="12">12</option>
      </select> </td></tr><tr>
      <td>Day:</td><td>
        <select name="calender_day">
        <option value="1">1</option>
        <option value="2">2</option>

        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>

        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
        <option value="13">13</option>
        <option value="14">14</option>

        <option value="15">15</option>
        <option value="16">16</option>
        <option value="17">17</option>
        <option value="18">18</option>
        <option value="19">19</option>
        <option value="20">20</option>

        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
        <option value="24">24</option>
        <option value="25">25</option>
        <option value="26">26</option>

        <option value="27">27</option>
        <option value="28">28</option>
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select> </td>

  </tr>
  <tr> 
      <td>start</td>
    
      <td> 
        <input name='calender_shour' type='text' value='' size='2' maxlength='2' />
        :
<input name='calender_sminut' type='text' value='' size='2' maxlength='2' />
      </td>

  </tr>
  <tr> 
      <td>end</td>
    
      <td> 
        <input name='calender_ehour' type='text' value='' size='2' maxlength='2' />
        :
<input name='calender_eminut' type='text' value='' size='2' maxlength='2' />
      </td>

  </tr>
  <tr> 
    <td colspan="3">
	<textarea name="calender_event" cols="20" rows="3"></textarea>
	</td>
  </tr>
  <tr>
    <td><a class="A" href="javascript:document.login.submit()">Submit</a></td>
    <td colspan="2"><a class="A" href="javascript:document.login.reset()">Reset</A></td>

  </tr>
</table>
</form>

	<?php	
		} else {

	?>
	<form action='./?act=add' method='post' enctype='multipart/form-data' name='login'>
	Användarnamn:<BR />
	<input name='calender_username' type='text' 
	value='' size='13' maxlength='20' /><BR />
	Lösenord:<BR />
	<input name='calender_password' type='password' value='' 
	size='13' maxlength='20' /><BR />
	<a class="A" href="javascript:document.login.submit()">Login</a>
	<a class="A" href="javascript:document.login.reset()">Reset</A>
	</form>
	<?php }

};
// End of login function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for adding event. /////////////////////////////////
//
function addEvent() {
	if(isset($_POST['calender_year']) && isset($_POST['calender_month']) &&isset($_POST['calender_day'])) {

		$year = $_POST['calender_year'];
		$month = $_POST['calender_month'];
		$day = $_POST['calender_day'];
		$date = "$year-$month-$day";
		$eventArray = array();
		$eventArray = appendEvent($date, $eventArray);
		
		$shour = $_POST['calender_shour'];
		$sminut = $_POST['calender_sminut'];
		$ehour = $_POST['calender_ehour'];
		$eminut = $_POST['calender_eminut'];
		$event = $_POST['calender_event'];
		
		
		$eventArray["$year-$month-$day"][0] = 2;
		$eventArray["$year-$month-$day"][1] = "$year-$month-$day";
		$eventArray["$year-$month-$day"][2][] = array("$shour:$sminut-$ehour:$eminut", $event);
		
		echo "Event added!<BR/>";
		echo "<A class=\"A\" HREF=\"./?act=add\">Add new</A>  ";
		echo "<A class=\"A\" HREF=\"./\">Return to calender</A>";
		
		return $eventArray;
	}
	
};
// End of addEvent function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Function for saving events. /////////////////////////////////
//
function saveEvents($eventArray) {
	
	global $path;
	
		$year = $_POST['calender_year'];
		$month = $_POST['calender_month'];
		$day = $_POST['calender_day'];
		$date = makeDate($year, $month, 1);
		$date = date("Y-m", $date);
		
		foreach ($eventArray as $day) {
			foreach($day[2] as $key) {
			$data[] = trim("$day[1]|$key[0]#$key[1]");
			}
		}
		
		sort($data);
		
		$fp = fopen("$path$date.txt","w");
			if($fp) {
				foreach($data as $key) {
					fwrite($fp, $key . "\n");
				}
			}
		fclose($fp);
};
// End of saveEvents function
////////////////////////////////////////////////////////////////
	
	
////////////////////////////////////////////////////////////////
// Function for creating a date. //////////////////////////////
//		

function makeDate($year, $month, $day) {
	return mktime(0, 0, 0, $month, $day,  $year);
};

// End of makeDate function
////////////////////////////////////////////////////////////////


////////////////////////////////////////////////////////////////
// Switch for action. /////////////////////////////////////////
//		
switch($act) {

	case "":
		$monthArray = createMonth($date);
		$monthArray = appendEvent($date, $monthArray);
		$monthArray = addToday($date, $monthArray);
		displayMonth($date, $monthArray);
		break;
		
	case "add":
		login();
		break;
			
	case "addEvent":
		$eventArray = addEvent();
		saveEvents($eventArray);
		break;
	
	case "event":
		$monthArray = createMonth($date);
		$monthArray = appendEvent($date, $monthArray);
		displayEvent($date, $monthArray);
		break;
		
	default:
		$monthArray = createMonth($date);
		$monthArray = appendEvent($date, $monthArray);
		$monthArray = addToday($date, $monthArray);
		displayMonth($date, $monthArray);
		break;
}
//
////////////////////////////////////////////////////////////////
?>