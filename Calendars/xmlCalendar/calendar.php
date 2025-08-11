<?

////////////////////////////////////////////////////////////
//
// xmlCalendar v1.1 - an events calendar
//
////////////////////////////////////////////////////////////
//
// This script allows you to post events on a calendar.
//
// See readme.txt for more information.
//
// Author: Jon Thomas <http://www.fromthedesk.com/code>
// Last Modified: 11/08/2005
//
// You may freely use, modify, and distribute this script.
//
////////////////////////////////////////////////////////////

//
// SET VARIABLES
//

// name of XML file which contains your event data
$xmlFile = "calendar.xml";


//
// GET CALENDAR DATA
//

// get the year if one not provided
if (!isset($_GET['year'])) {
	$year = date(Y);
}

// otherwise, save this POST data under a simpler variable name
else {
	$year = $_GET['year'];
}

// get the month number (1-12) if one not provided
if (!isset($_GET['monthNo'])) {
	$monthNo = date(n);
}

// otherwise, save this POST data under a simpler variable name
else {
	$monthNo = $_GET['monthNo'];
}

// get current month name
$monthName = date(F, mktime(0, 0, 0, $monthNo, 1, $year));

// get the number of days in this month
$daysInMonth = date(t, mktime(0, 0, 0, $monthNo, 1, $year));


//
// GET XML DATA
//

// get XML data
$data = implode("", file($xmlFile));

// create XML parser
$parser = xml_parser_create();

// set parser options
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);

// parse XML data into arrays
xml_parse_into_struct($parser, $data, $values, $tags);

// free parser
xml_parser_free($parser);

// set variables for cycling through parsed XML data
$i = 0; // set the array counter variable
$lookForMonth = 0; // set default to false
$getDays = 0; // set default to false

// cycle through parsed XML data
while ($i < count($values)) {
	// if close tag of current month and year, stop cycle
	if ($getDays && $values[$i][tag] == $monthName) {
		break;
	}

	// if open tag of current year, start looking for current month 
	if ($values[$i][tag] == "Y$year" && $values[$i][type] == "open") {
		$lookForMonth = 1;
	}

	// get days
	if ($getDays) {
		// get day number from tag name
		$day = $values[$i][tag];

		// cut "D" off tag name
		$day = substr($day, 1);

		// put day number as key and event description as value in new array
		$event[$day] = $values[$i][value];
	}

	// if tag of current month, start getting days
	if ($lookForMonth && $values[$i][tag] == $monthName) {
		$getDays = 1;
	}

	// increment counter
	$i++;
}


//
// PRINT CALENDAR
//

// print the HTML document header
echo "<html>\n\n";
echo "<head>\n";
echo "<title>Calendar</title>\n";
echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"calendar.css\">\n";
echo "</head>\n\n";
echo "<body>\n";

// print the calendar table head
echo "<table align=\"center\">\n";
echo "<caption>$monthName $year</caption>\n";
echo "<tr>\n";
echo "\t<th>Sunday</th>\n";
echo "\t<th>Monday</th>\n";
echo "\t<th>Tuesday</th>\n";
echo "\t<th>Wednesday</th>\n";
echo "\t<th>Thursday</th>\n";
echo "\t<th>Friday</th>\n";
echo "\t<th>Saturday</th>\n";
echo "</tr>\n";

// for each day of the month
for ($dayNo = 1; $dayNo <= $daysInMonth; $dayNo++) {
	// get the day name
	$dayName = date(D, mktime(0, 0, 0, $monthNo, $dayNo, $year));

	// if the first day of the month is not Sunday
	if ($dayNo == 1 && $dayName != "Sun") {
		// start a new row
		echo "<tr>\n";

		// get the day of the week number (0-6)
		$dayOfWeek = date(w, mktime(0, 0, 0, $monthNo, $dayNo, $year));

		// print empty table cells until we reach the first day of the month
		for ($i = 0; $i < $dayOfWeek; $i++) {
			echo "\t<td></td>\n";
		}
	}

	// if Sunday, start a new row
	if ($dayName == "Sun") {
		echo "<tr>\n";
	}

	// if event exists for this day, print day cell with event
	if (isset($event[$dayNo])) {
		echo "\t<td class=\"event\"><b>$dayNo</b> $event[$dayNo]</td>\n";
	}

	// otherwise, print day cell without event
	else {
		echo "\t<td><b>$dayNo</b></td>\n";
	}

	// if Saturday, close this row
	if ($dayName == "Sat") {
		echo "</tr>\n";
	}

	// if the last day of the month is not Saturday
	if ($dayNo == $daysInMonth && $dayName != "Sat") {
		// get the day of the week number (0-6)
		$dayOfWeek = date(w, mktime(0, 0, 0, $monthNo, $dayNo, $year));

		// print empty table cells until we reach Saturday
		for ($i = 6; $i > $dayOfWeek; $i--) {
			echo "\t<td></td>\n";
		}

		// close this row
		echo "</tr>\n";
	}
}

// close the table
echo "</table>\n";
echo "<br>\n";

//
// PRINT NAVIGATION MENU
//

// calculate previous month
$prevMonth = $monthNo - 1;

// if previous month number is 0, reset to 12 and decrement year
if ($prevMonth == 0) {
	$prevMonth = 12;
	$prevYear = $year - 1;
}

// otherwise, keep same year
else {
	$prevYear = $year;
}

// calculate next month
$nextMonth = $monthNo + 1;

// if next month number is 13, reset to 1 and increment year
if ($nextMonth == 13) {
	$nextMonth = 1;
	$nextYear = $year + 1;
}

// otherwise, keep same year
else {
	$nextYear = $year;
}

// get previous month name
$prevMonthName = date(F, mktime(0, 0, 0, $prevMonth, 1, $prevYear));

// get next month name
$nextMonthName = date(F, mktime(0, 0, 0, $nextMonth, 1, $nextYear));

// print links for previous and next months
echo "<p align=\"center\">[ <a href=\"?year=$prevYear&monthNo=$prevMonth\"><< $prevMonthName</a> | <a href=\"?year=$nextYear&monthNo=$nextMonth\">$nextMonthName >></a> ]</p>\n";

// print the HTML document footer
echo "</body>\n\n";
echo "</html>";

?>