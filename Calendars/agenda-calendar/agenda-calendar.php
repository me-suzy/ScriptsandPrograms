<?
$Host =           "localhost";
$User =           ""; 
$PassWord =       ""; 
$DataBaseName =   ""; 
$TableName =      "agenda";

mysql_connect($Host, $User, $PassWord);
mysql_select_db($DataBaseName);

//This below will create your table for you if it does not exist.
//Feel free to comment it out once the table is created.
$Tables = mysql_query("show tables like '" . $TableName . "'");

if(mysql_fetch_row($Tables) === false)
  {
  $create = "create table " . $TableName .
            "(" .
            "id int primary key auto_increment, " .
            "text text, " .
            "day int, " .
            "month int, " .
            "year int " .
            ")";
  
  mysql_query($create);
  }
		 
$Entered_UserName = "";
$Entered_PassWord = "";

if(isset($HTTP_COOKIE_VARS["UserName"]) &&
   isset($HTTP_COOKIE_VARS["PassWord"]))
  {
  $Entered_UserName = $HTTP_COOKIE_VARS["UserName"];
  $Entered_PassWord = $HTTP_COOKIE_VARS["PassWord"];
  }

$isLogged = true;
        	
if($Entered_UserName != $User || $Entered_PassWord != $PassWord)                      
   $isLogged = false;
  
//Execute MySQL queries if someone is logged in.
if($isLogged == true)
  {
  if(param("save") != "")   
    {
    for($week_day = 0; $week_day <= 7; $week_day++)
       {
       $day = param("day" . $week_day);
       $month = param("month" . $week_day);
       $year = param("year" . $week_day);
       $text = trim(param("text" . $week_day));
       
       $Select = "select count(id) from " . $TableName . " where day = " . $day .
                 " and month = " . $month .
                 " and year = " . $year;
                 
       $entries = mysql_query($Select);
       $entry = mysql_fetch_array($entries);
       
       if($entry[0] < 1)
         {
         if($text != "")
           {
           $Insert = "insert into " . $TableName . " (text, day, month, year) values ('" . $text . "', " .
                     $day . ", " . $month . ", " . $year . ")";
           //If there is no entry in the table for that day, create it.                     
           mysql_query($Insert);
           }
         }
       else
         {
         if($text != "")
           {
           $Update = "update " . $TableName . " set text ='" . $text . "' where day = " . $day .
                     " and month = " . $month . " and year = " . $year;
                      
           mysql_query($Update);
           }
         else
           {
           $Delete = "delete from " . $TableName . " where day = " . $day .
                     " and month = " . $month . " and year = " . $year;
           //No point in keeping empty records in the table.          
           mysql_query($Delete);
           }
         }       
       }
    }
  }

function schedule($date)
         {
         //If no parameter is passed use the current date.
         if($date == null)
            $date = getDate();
            
         $day = $date["mday"];
         $week_day = $date["wday"];
         $month = $date["mon"];
         $month_name = $date["month"];         
         $year = $date["year"];
         
         $today = getDate(mktime(0, 0, 0, $month, $day, $year));
         
         $sunday = $day - $week_day;
         $saturday = $day + (6 - $week_day);
                                                              
         $schedule_html = "<table height=\"100%\" width=\"100%\" cellspacing=\"20\">\n";
         
         $schedule_html .= "<tr><td align=\"right\" valign=\"top\">\n";
         
         global $previous_month;
         global $this_month;
         global $next_month;
         
         $previous_month = getDate(mktime(0, 0, 0, $month - 1, 1, $year));
         $this_month = getDate(mktime(0, 0, 0, $month, 1, $year));
         $next_month = getDate(mktime(0, 0, 0, $month + 1, 1, $year));
         
         $first_week_day = $this_month["wday"];
         $days_in_this_month = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));
                          
         $schedule_html .= "<table>\n";
         
         $schedule_html .= "<tr><td align=\"center\" class=\"calendar_cell\">" .
                           "<a class=\"calendar_date\" " .
                           "href=\"agenda-calendar.php?month=" . $previous_month["mon"] . "&year=" . $previous_month["year"] . "\"><</a></td>\n";
         
         $schedule_html .= "<td colspan=\"5\" align=\"center\" class=\"calendar_cell\">" . 
                           "<font class=\"calendar_month\">" . $month_name . " " . $year . "</font></td>\n";
                           
         $schedule_html .= "<td align=\"center\" class=\"calendar_cell\">" .
                           "<a class=\"calendar_date\" " .
                           "href=\"agenda-calendar.php?month=" . $next_month["mon"] . "&year=" . $next_month["year"] . "\">></a></td></tr>\n";
                           
         $schedule_html .= "<tr>\n";
          
         //Fill the first week of the month with the appropriate number of blanks.       
         for($week_day = 0; $week_day < $first_week_day; $week_day++)
            {
            $schedule_html .= "<td class=\"calendar_cell\">&nbsp;</td>";   
            }
            
         $week_day = $first_week_day;
         for($day_counter = 1; $day_counter <= $days_in_this_month; $day_counter++)
            {
            $week_day %= 7;
            
            if($week_day == 0)
               $schedule_html .= "</tr><tr>\n";
            
            //Do something different for the current day.
            if($day == $day_counter)
               $schedule_html .= "<td class=\"calendar_current_cell\" align=\"center\"><font class=\"calendar_current_date\">" . $day_counter . "</font></td>\n";
            else
               $schedule_html .= "<td align=\"center\" class=\"calendar_cell\">&nbsp;" .
                                 "<a class=\"calendar_date\" href=\"agenda-calendar.php?day=" . $day_counter . "&month=" . $month . "&year=" . $year . "\">" . 
                                 $day_counter . "</a>&nbsp;</td>\n";
            
            $week_day++;
            }
            
         $schedule_html .= "</tr>\n";
         $schedule_html .= "</table>\n";
         
         $schedule_html .= "<br /><br />\n";
         
         //Login.
         global $isLogged;
         
         $schedule_html .= "<table align=\"right\">\n";                  
         
         if($isLogged == true)
           {           
           $schedule_html .= "<tr>";
           $schedule_html .= "<td>";
           $schedule_html .= "<input type=\"hidden\" name=\"save\" value=\"yes\" />";
           $schedule_html .= "<input type=\"button\" value=\"log out\" class=\"calendar_cell\" ";
           $schedule_html .= "onclick=\"clearCookie('UserName');";
           $schedule_html .= "clearCookie('PassWord');";
           $schedule_html .= "document.EmptyForm.submit();\" />";           
           $schedule_html .= "</td>";
           $schedule_html .= "<td width=\"33%\"></td>";           
           $schedule_html .= "<td>";
           $schedule_html .= "<input type=\"button\" value=\"save\" class=\"calendar_cell\" ";
           $schedule_html .= "onclick=\"document.save.submit();\" />";
           $schedule_html .= "</td>";
           $schedule_html .= "</tr>\n";
           }
         else
           {
           $schedule_html .= "<form name=\"login\">";
           $schedule_html .= "<tr>";
           $schedule_html .= "<td align=\"right\">";
           $schedule_html .= "<input type=\"text\" name=\"UserName\" class=\"calendar_cell\" />";
           $schedule_html .= "</td>";
           $schedule_html .= "</tr>";
           $schedule_html .= "<tr>";
           $schedule_html .= "<td align=\"right\">";
           $schedule_html .= "<input type=\"password\" name=\"PassWord\" class=\"calendar_cell\" />";
           $schedule_html .= "</td>";
           $schedule_html .= "</tr>";
           $schedule_html .= "<tr>";
           $schedule_html .= "<td align=\"right\">";
           $schedule_html .= "<input type=\"button\" value=\"log in\" class=\"calendar_cell\" ";
           $schedule_html .= "onclick=\"setCookie('UserName', document.login.UserName.value);";
           $schedule_html .= "setCookie('PassWord', document.login.PassWord.value);";
           $schedule_html .= "document.EmptyForm.submit();\" />";           
           $schedule_html .= "</td>";
           $schedule_html .= "</tr>";
           $schedule_html .= "</form>\n";           
           }
          
         $schedule_html .= "<form name=\"EmptyForm\" method=\"post\">\n";
         $schedule_html .= "</form>\n";
                              
         $schedule_html .= "</table>\n";
         
         $schedule_html .= "</td>\n";
         
         $schedule_html .= "<td valign=\"top\" width=\"100%\"><table width=\"100%\" cellpadding=\"10\">\n";                  
         
         if($isLogged == true)
           {
           $schedule_html .= "<form name=\"save\" method=\"post\">\n";
           $schedule_html .= "<input type=\"hidden\" name=\"save\" value=\"save\">\n";
           }
            
         
         for($index = $sunday; $index <= $saturday; $index++)
            {
            $date = getDate(mktime(0, 0, 0, $month, $index, $year));
            
            $schedule_date = "schedule_date";
            $schedule_entry = "schedule_entry";
            if(($month > $date["mon"] && $year == $date["year"]) || $year > $date["year"])
              {
              $schedule_date = "schedule_date_previous";
              $schedule_entry = "schedule_entry_previous";
              }
            if(($month < $date["mon"] && $year == $date["year"]) || $year < $date["year"])
              {
              $schedule_date = "schedule_date_next";
              $schedule_entry = "schedule_entry_next";
              }
               
            $schedule_html .= "<tr><td align=\"right\" class=\"" . $schedule_date . "\">";                        
            
            $schedule_html .= $date["weekday"] . " " .
                              $date["month"] . " " .
                              $date["mday"] . ", " .
                              $date["year"] . "\n";
            
            $schedule_html .= "</br>\n";
            
            $schedule_text = getSchedule($date["mday"], $date["mon"], $date["year"]);                        
               
            $readonly = "readonly";
            if($isLogged == true)
               $readonly = "";
            
            if($isLogged == true)
              {
              $schedule_html .= "<input type=\"hidden\" name=\"day" . $date["wday"] . "\" value=\"" . $date["mday"] . "\" />\n";
              $schedule_html .= "<input type=\"hidden\" name=\"month" . $date["wday"] . "\" value=\"" . $date["mon"] . "\" />\n";
              $schedule_html .= "<input type=\"hidden\" name=\"year" . $date["wday"] . "\" value=\"" . $date["year"] . "\" />\n";
              }
            
            $schedule_html .= "<textarea wrap=\"off\" name=\"text" . $date["wday"] . "\" class=\"" . 
                              $schedule_entry . "\" style=\"width:100%;overflow:auto;\" rows=\"" . 
                              rows($schedule_text) . "\" " . $readonly . ">\n" . 
                              $schedule_text . "</textarea>\n";
            
            $schedule_html .= "</td></tr>\n";
            }
         
         if($isLogged == true)
            $schedule_html .= "</form>\n";
         
         $schedule_html .= "</table></td></tr>\n";
         
         $schedule_html .= "</table>\n";
                   
         return($schedule_html);
         }
 
function getSchedule($day, $month, $year)
         {
         global $TableName;
         
         $Select = "select text from " . $TableName . " where " .
                   "day = " . $day . " and " .
                   "month = " . $month . " and " .
                   "year = " . $year;
         
         $Schedule = mysql_query($Select);
         
         if($Text = mysql_fetch_assoc($Schedule))
           {
           return($Text["text"]);
           }
         else
           {
           return("");
           }
         }
         
function rows($text)
         {
         return(substr_count($text, "\n") + 1);
         }
         
function param($Name)
         {
         global $HTTP_GET_VARS;
         global $HTTP_POST_VARS;         

         if(isset($HTTP_GET_VARS[$Name]))
            return($HTTP_GET_VARS[$Name]);

         if(isset($HTTP_POST_VARS[$Name]))
            return($HTTP_POST_VARS[$Name]);
            
         return("");         
         }
         
$day = param("day");
$month = param("month");
$year = param("year");

$date = null;

if($year != "")
  {
  if($day == "")
     $day = 1;
  if($month == "")
     $month = 1;
     
  $date = getDate(mktime(0, 0, 0, $month, $day, $year));
  }

$agenda = schedule($date);
  
$previous_month;
$this_month;
$next_month;

$body = Array
(
"background-color:eeeeff;",
"background-color:ffddee;",
"background-color:dddddd;",
"background-color:9999cc;",
"background-color:ccff99;",
"background-color:ffdd77;",
"background-color:ffee00;",
"background-color:eecc55;",
"background-color:dd9900;",
"background-color:000000;",
"background-color:aa7700;",
"background-color:ddffdd;"
);

$calendar_month = Array
(
"color:000000; font-weight:bold;",
"color:ff0000; font-weight:bold;",
"color:00ff00; font-weight:bold;",
"color:000099; font-weight:bold;",
"color:000000; font-weight:bold;",
"color:ff8800; font-weight:bold;",
"color:6666ff; font-weight:bold;",
"color:ff6600; font-weight:bold;",
"color:000000; font-weight:bold;",
"color:9900ee; font-weight:bold;",
"color:884400; font-weight:bold;",
"color:55dd55; font-weight:bold;"
);
  
$calendar_cell = Array
(
"background-color:ffffff; border:1; border-style:solid; border-color:000000; color:000000;",
"background-color:eeeeff; border:1; border-style:solid; border-color:0000ff; color:ff0000;",
"background-color:999999; border:1; border-style:solid; border-color:550000; color:ffffff;",
"background-color:9999ff; border:1; border-style:solid; border-color:550000; color:0000dd;",
"background-color:ffdd77; border:1; border-style:solid; border-color:550000; color:000000;",
"background-color:99ff99; border:2; border-style:solid; border-color:ff8800; color:ff8800;",
"background-color:ffcccc; border:2; border-style:solid; border-color:6666ff; color:6666ff;",
"background-color:eecc55; border:2; border-style:solid; border-color:ee9900; color:ff6600;",
"background-color:ffcc00; border:2; border-style:solid; border-color:00aa00; color:000000;",
"background-color:dd9900; border:2; border-style:solid; border-color:9900ee; color:9900ee;",
"background-color:ffffff; border:2; border-style:solid; border-color:884400; color:884400;",
"background-color:dd5555; border:2; border-style:solid; border-color:dd5555; color:55dd55;"
);

$calendar_current_cell = Array
(
"background-color:eeeeff; border:1; border-style:solid; border-color:0000ff;",
"background-color:000000;",
"background-color:dddddd; border:2; border-style:solid; border-color:009900;",
"background-color:9999ff; border:1; border-style:solid; border-color:000000;",
"background-color:ffff00; border:1; border-style:solid; border-color:000000;",
"background-color:ffdd77;",
"background-color:6666ff; border:2; border-style:solid; border-color:ffcccc;",
"background-color:eecc55;",
"background-color:dd9900;",
"background-color:000000; border:2; border-style:solid; border-color:dd9900;",
"background-color:884400; border:2; border-style:solid; border-color:884400;",
"background-color:ddffdd; border:2; border-style:solid; border-color:dd5555;"
);

$calendar_date = Array
(
"background-color:ffffff; color:000000; text-decoration:none;",
"background-color:eeeeff; color:ff0000; text-decoration:none;",
"background-color:999999; color:ffffff; text-decoration:none;",
"background-color:9999ff; color:0000dd; text-decoration:none;",
"background-color:ffdd77; color:000000; text-decoration:none;",
"background-color:99ff99; color:ff8800; text-decoration:none;",
"background-color:ffcccc; color:6666ff; text-decoration:none;",
"background-color:eecc55; color:ff6600; text-decoration:none;",
"background-color:ffcc00; color:000000; text-decoration:none;",
"background-color:dd9900; color:6600ee; text-decoration:none;",
"background-color:ffffff; color:884400; text-decoration:none;",
"background-color:dd5555; color:55dd55; text-decoration:none;"
);

$calendar_current_date = Array
(
"background-color:eeeeff; color:000000; text-decoration:none; font-weight:bold;",
"background-color:000000; color:ffeeee; text-decoration:none; font-weight:bold;",
"background-color:dddddd; color:000000; text-decoration:none; font-weight:bold;",
"background-color:9999ff; color:000099; text-decoration:none; font-weight:bold;",
"background-color:ffff00; color:000000; text-decoration:none; font-weight:bold;",
"background-color:ffdd77; color:ff8800; text-decoration:none; font-weight:bold;",
"background-color:6666ff; color:ffcccc; text-decoration:none; font-weight:bold;",
"background-color:eecc55; color:ff6600; text-decoration:none; font-weight:bold;",
"background-color:dd9900; color:000000; text-decoration:none; font-weight:bold;",
"background-color:000000; color:dd9900; text-decoration:none; font-weight:bold;",
"background-color:884400; color:ffffff; text-decoration:none; font-weight:bold;",
"background-color:ddffdd; color:dd5555; text-decoration:none; font-weight:bold;"
);

$schedule_date = Array
(
"color:000000; font-weight:bold; background-color:ffffff; border:1; border-style:solid; border-color:000000;",
"color:0000ff; font-weight:bold; background-color:ffffff; border:2; border-style:solid; border-color:ff0000;",
"color:ffffff; font-weight:bold; background-color:999999; border:1; border-style:solid; border-color:000000;",
"color:000099; font-weight:bold; background-color:9999ff; border:1; border-style:solid; border-color:550000;",
"color:000000; font-weight:bold; background-color:ffdddd; border:1; border-style:solid; border-color:550000;",
"color:ff8800; font-weight:bold; background-color:99ff99; border:2; border-style:solid; border-color:ff8800;",
"color:6666ff; font-weight:bold; background-color:ffcccc; border:2; border-style:solid; border-color:6666ff;",
"color:ff6600; font-weight:bold; background-color:eecc55; border:2; border-style:solid; border-color:ee9900;",
"color:000000; font-weight:bold; background-color:00aa00; border:2; border-style:solid; border-color:ffcc00;",
"color:dd9900; font-weight:bold; background-color:000000; border:2; border-style:solid; border-color:9900ee;",
"color:884400; font-weight:bold; background-color:ffffff; border:2; border-style:solid; border-color:884400;",
"color:dd5555; font-weight:bold; background-color:ddffdd; border:2; border-style:solid; border-color:55dd55;"
);

$schedule_entry = Array
(
"color:000000; background-color:ffffff; border-style:none;",
"color:000000; background-color:ffffff; border-style:none;",
"color:ffffff; background-color:999999; border-style:none;",
"color:000099; background-color:9999ff; border-style:none;",
"color:000000; background-color:ffdddd; border-style:none;",
"color:ff8800; background-color:99ff99; border-style:none;",
"color:6666ff; background-color:ffcccc; border-style:none;",
"color:ff6600; background-color:eecc55; border-style:none;",
"color:000000; background-color:00aa00; border-style:none;",
"color:dd9900; background-color:000000; border-style:none;",
"color:884400; background-color:ffffff; border-style:none;",
"color:dd5555; background-color:ddffdd; border-style:none;"
);
?>

<html>
<head>
<title>agenda calendar</title>

<style>
body
{
<?= $body[$this_month["mon"] - 1] ?>
}

.calendar_month
{
<?= $calendar_month[$this_month["mon"] - 1] ?>
}

.calendar_cell
{
<?= $calendar_cell[$this_month["mon"] - 1] ?>
}

.calendar_current_cell
{
<?= $calendar_current_cell[$this_month["mon"] - 1] ?>
}

.calendar_date
{
<?= $calendar_date[$this_month["mon"] - 1] ?>
}

.calendar_current_date
{
<?= $calendar_current_date[$this_month["mon"] - 1] ?>
}

.schedule_date_previous
{
<?= $schedule_date[$previous_month["mon"] - 1] ?>
}

.schedule_date
{
<?= $schedule_date[$this_month["mon"] - 1] ?>
}

.schedule_date_next
{
<?= $schedule_date[$next_month["mon"] - 1] ?>
}

.schedule_entry_previous
{
<?= $schedule_entry[$previous_month["mon"] - 1] ?>
}

.schedule_entry
{
<?= $schedule_entry[$this_month["mon"] - 1] ?>
}

.schedule_entry_next
{
<?= $schedule_entry[$next_month["mon"] - 1] ?>
}
</style>

<script>
function setCookie(name, value)
         {
         //If name is the empty string, it places a ; at the beginning
         //of document.cookie, causing clearCookies() to malfunction.
         if(name != '')
            document.cookie = name + '=' + value;
         }
         
function clearCookie(name)
         {
         expires = new Date();
         expires.setYear(expires.getYear() - 1);

         document.cookie = name + '=null' + '; expires=' + expires;
         }

</script>
</head>

<body>
<?= $agenda ?>
</body>
</html>
