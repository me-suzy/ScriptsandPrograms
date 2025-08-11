<?php
// ----------------------------------------------------------------------
// Fast Click SQL - Advanced Clicks Counter System
// Copyright (c) 2003-2005 by Dmitry Ignatyev (ftrainsoft@mail.ru)
// http://www.ftrain.siteburg.com/
// ----------------------------------------------------------------------
// Original Author of file: Dmitry Ignatyev
// ----------------------------------------------------------------------
// Anti Hack
if(!stristr($_SERVER["PHP_SELF"], "admin.php")) header("Location: admin.php");
?>
<style type="text/css">
<!--
table.c { border: 1px solid Black; background-color: White;}
th.c { background-color: #a5bcc0; color: Black; font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold;}
td.c { background-color: #efefef; color: #696969; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
a.c { color: #434343; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-decoration: none;}
a:hover.c { color: #F37710; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
a:visited.c, a:link.c {color: #434343; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
a.c2 { color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-decoration: none;}
a:visited.c2, a:link.c2 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
a.c2s { color: #c00000; font-family: Arial, Helvetica, sans-serif; font-size: 10px; text-decoration: none;}
a:visited.c2s, a:link.c2s { color: #c00000; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
td.empty { background-color: #efefef; color: #696969; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
td.sunday { background-color: #efefef; color: #FF0000; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
td.today { background-color: #efefef; color: Green; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
td.headdays { background-color: #c5dce0; color: Black; font-family: Arial, Helvetica, sans-serif; font-size: 10px;}
-->
</style>
<?php 

class Calendar  {
    var $day = 0;
    var $month = 0;
    var $year = 0;
    var $url = '';
    var $days_str = Array(); // array for the days names (Mon-Tue-Wed-...)
    var $months_str = Array(); // array for the months names (Jan-Feb-Mar-...)
        
    var $show_arrows = TRUE; // determines whether the display arrows in the calendar-headline
    var $next_month = NULL; // value for the href-param in the <a> Tag :: next-arrow
    var $prev_month = NULL; // value for the href-param in the <a> Tag :: prev-arrow

//---------------------------------------------------------------------------
// Constructor
//---------------------------------------------------------------------------
    function Calendar($url = '', $d = 0, $m = 0, $y = 0) {
      global $CFG;

      $this->day = ($d == 0) ? $this->day = (int)date("d", $CFG['CTIME']) : $this->day = $d;
      $this->month = ($m == 0) ? $this->month = (int)date("m", $CFG['CTIME']) : $this->month = $m;
      $this->year = ($y == 0) ? $this->year = (int)date("Y", $CFG['CTIME']) : $this->year = $y; 
      $this->url = $url;
      $this->days_str = Array("Sunday", "Monday", "Tuesday", "Wednesday",
                              "Thursday", "Friday", "Saturday" );
      $this->months_str = Array("January", "February", "March", "April", "May",
                                "June", "July", "August", "September", 
                                "October", "November", "December" ); 
     }
//---------------------------------------------------------------------------
        
//---------------------------------------------------------------------------
// set the Date
//---------------------------------------------------------------------------
    function set_date($d, $m, $y) {
      $this->day = $d;
      $this->month = $m;
      $this->year = $y; 
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// get Date as Array
//---------------------------------------------------------------------------
    function get_date() {
      return Array($this->day, $this->month, $this->year);
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// set next-Link
//---------------------------------------------------------------------------
    function set_next($val) {
      $this->next_month = $val;
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// set prev-Link
//---------------------------------------------------------------------------
    function set_prev($val) {
      $this->prev_month = $val;
     }
//---------------------------------------------------------------------------
        
//---------------------------------------------------------------------------
// Returns a value from Monday - Sunday in the selected language
//---------------------------------------------------------------------------
    function get_weekday_as_string($d = 0, $m = 0, $y = 0) {
      if($d != 0) $this->day = $d;
      if($m != 0) $this->month = $m;
      if($y != 0) $this->year = $y;
                        
      $tmp = (int)date("w", mktime(0, 0, 0, $this->month, $this->day, $this->year));
      return $this->days_str[$tmp];
     }
//---------------------------------------------------------------------------
        
//---------------------------------------------------------------------------
// Returns a value from 0 - 6
//---------------------------------------------------------------------------
    function get_weekday_as_num($d = 0, $m = 0, $y = 0) {
      if($d != 0) $this->day = $d;
      if($m != 0) $this->month = $m;
      if($y != 0) $this->year = $y;
                        
      $tmp = (int)date("w", mktime(0, 0, 0, $this->month, $this->day, $this->year));
      if($tmp == 0) return 7;
      else return $tmp;
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// Returns a value from January - December in the selected language
//---------------------------------------------------------------------------
    function get_month_as_string($m = 0, $y = 0) {
      if($m != 0) $this->month = $m;
      if($y != 0) $this->year = $y;
                        
      $tmp = (int)date("n", mktime(0, 0, 0, $this->month, 1, $this->year));
      return $this->months_str[$tmp - 1];
     }
//---------------------------------------------------------------------------
        
//---------------------------------------------------------------------------
// returns the last day of the month as integer
//---------------------------------------------------------------------------
    function get_last_day_of_month($m = 0, $y = 0) {
      if($m != 0) $this->month = $m;
      if($y != 0) $this->year = $y;
            
      return (int)date("t", mktime(0, 0, 0, $this->month, 1, $this->year));
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// bool :: determines if a date is todays date :: for internal use
//---------------------------------------------------------------------------
    function is_today() {
      $d_today = (int)date("d", $CFG['CTIME']);
      $m_today = (int)date("m", $CFG['CTIME']);
      $y_today = (int)date("Y", $CFG['CTIME']);

      if($d_today == $this->day && $m_today == $this->month && $y_today == $this->year)
        return TRUE;
      else return FALSE;            
     }
//---------------------------------------------------------------------------

//---------------------------------------------------------------------------
// bool :: determines if a date is todays date :: for internal use
//---------------------------------------------------------------------------
    function is_before() {
      global $CFG;
      if(mktime(0, 0, 0, $this->month, $this->day, $this->year) <= $CFG['dtime'])
        return 1; 
      else return 0;
     }
//---------------------------------------------------------------------------
  
//---------------------------------------------------------------------------
// sets the arrow-nav-variables to std-values :: for internal use
//---------------------------------------------------------------------------
    function mk_nav() {
      if($this->prev_month == NULL) {
        if($this->month == 1) {
          $_m = 12;
          $_y = $this->year - 1;
         }  
        else {
          $_m = $this->month - 1;
          $_y = $this->year;
         }   
        $this->prev_month = $this->url."&m=$_m&y=$_y";
       }
            
      if($this->next_month == NULL) {
        if($this->month == 12) {
          $_m = 1;
          $_y = $this->year + 1;
         }  
        else {
          $_m = $this->month + 1;
          $_y = $this->year;
         }   
        $this->next_month = $this->url."&m=$_m&y=$_y";
       }
     }  
//---------------------------------------------------------------------------        
 
//---------------------------------------------------------------------------
// displays a calendar
//---------------------------------------------------------------------------
    function mk_calendar($m = 0, $y = 0) {
      // write instance values to tmp-var
      $d_tmp = $this->day;
      $m_tmp = $this->month;
      $y_tmp = $this->year;

      if($m != 0) $this->month = $m;
      if($y != 0) $this->year = $y; 

      $this->mk_nav();
            
      // Table-Head
      $head_month = "<table border='0' cellpadding='2' cellspacing='0' class=c>\n<tr>\n";
      if($this->show_arrows == FALSE)
        $head_month .= "<th class='c'>&nbsp;</th>\n";
      else
        $head_month .= "<th class='c'><a class='c' href='".$this->prev_month."'>&lt;&lt;</a></th>\n";
      $head_month .=  "<th class='c' colspan='5'>";
      $head_month .= $this->get_month_as_string($this->month, $this->year); 
      $head_month .= " ".$this->year;
      $head_month .=  "</th>\n";
      if($this->show_arrows == FALSE)
        $head_month .= "<th class='c'>&nbsp;</th>\n";
      else
        $head_month .= "<th class='c'><a class='c' href='".$this->next_month."'>&gt;&gt;</a></th>\n";
      $head_month .= "</tr>\n";
            
      // Table-Subhead --> Weekdays
      $head_weekdays  = "<tr>\n";
      $head_weekdays .= "<td class='headdays'>Mon</td>\n";
      $head_weekdays .= "<td class='headdays'>Tue</td>\n";
      $head_weekdays .= "<td class='headdays'>Wed</td>\n";
      $head_weekdays .= "<td class='headdays'>Thu</td>\n";
      $head_weekdays .= "<td class='headdays'>Fri</td>\n";
      $head_weekdays .= "<td class='headdays'>Sat</td>\n";
      $head_weekdays .= "<td class='headdays'>Sun</td>\n";
      $head_weekdays .= "</tr>\n";     
            
      // Table-Body --> Numbers
      $start_col = $this->get_weekday_as_num(1, $this->month, $this->year);
      $last_day = $this->get_last_day_of_month($this->month, $this->year);
      $end_col = $this->get_weekday_as_num($last_day, $this->month, $this->year);

      $body = "<tr>\n";

      // empty cells before day 1
      for($i = 1; $i < $start_col; $i++)
        $body .= "<td class='empty'>&nbsp;</td>\n";

      // day 1 till last day of month
      $this->day = 1;
      $before = 1;

      while($this->day <= $last_day) {
        if(!$this->is_before()) $before = 0;

        $col = $this->get_weekday_as_num();
        if($col == 1) $body .= "<tr>\n";
                    
        if($col == 7) {
          $body .= "<td align='right' class='sunday'>\n";
          if($before) 
            $body .= "<a class='c2s' href=\"".($this->url)."&s_day=".$this->day."&s_month=".$this->month."&s_year=".$this->year."\">".$this->day."</a>";
          else $body .= $this->day;
          $body .= "</td>\n</tr>\n";
         } 
        else {
          $body .= "<td align='right' class='empty'>\n";
          if($before) 
            $body .= "<a class='c2' href=\"".($this->url)."&s_day=".$this->day."&s_month=".$this->month."&s_year=".$this->year."\">".$this->day."</a>";
          else $body .= $this->day;
          $body .= "</td>\n";
         }

        $this->day++;
       }
            
     // empty cells after last day
     for($i = $end_col; $i < 7; $i++)
       $body .= "<td class='empty'>&nbsp;</td>\n";  
                
     $body .= "</tr>\n";          
            
     $foot = "</table>\n";
            
     // write tmp-values into instance again
     $this->day = $d_tmp;
     $this->month = $m_tmp;
     $this->year = $y_tmp;            
            
     return $head_month.$head_weekdays.$body.$foot;
    }
//---------------------------------------------------------------------------
        
//---------------------------------------------------------------------------
// displays the class-variables
//---------------------------------------------------------------------------
   function show () {
     echo "<p>\n";
     echo "\$day: " . $this->day . "<br>\n";
     echo "\$month: " . $this->month . "<br>\n";
     echo "\$year: " . $this->year . "<br>\n";
            
     echo "\$show_arrows: " . $this->show_arrows . "<br>\n";
     echo "\$next_month: ";
     echo ( $this->next_month == NULL ) ? "NULL" : $this->next_month; 
     echo "<br>\n";
     echo "\$prev_month: ";
     echo ( $this->prev_month == NULL ) ? "NULL" : $this->prev_month; 
     echo "<br>\n";
     echo "</p>\n";
    }
//---------------------------------------------------------------------------
 } 
?>