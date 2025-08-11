<?php
/*
 * SZCalendar :: An advanced Calendar/Planner Version 1.4.1
 * Copyright (C) 2002-2003 Andreas Norman. All rights reserved.
 * 
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
 * IN NO EVENT SHALL THE AUTHOR OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT,
 * INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION)
 * HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT,
 * STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
 * IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 * 
 * This software is FREE FOR NON-COMMERCIAL USE, provided the following 
 * conditions are met:
 * 
 * The user must assume the entire risk of using this program.
 * 
 * You are hereby granted a license to to use and distribute this 
 * program in its original unmodified form and in the original 
 * distribution package. You can make as many copies as you want, 
 * and distribute it via electronic means. There is no fee for
 * any of the above.
 * 
 * You are specifically prohibited from charging, or requesting
 * donations, for any such copies, however made; and from distributing
 * the software and/or documentation with other products (commercial or
 * otherwise) without prior written permission.
 * 
 *
 * * * * * * * * * * * * * * * * * * * * *
 * Requirements: MySQLHandler.class.php  *
 * * * * * * * * * * * * * * * * * * * * *
 */
class SZCalendar {   

/*
 * Do not fiddle with the variables below since they are set and used inside 
 * this code. If you wish to fiddle there IS a config file.
 * Fiddling will alter the code in other words, and that would be pretty daft
 * since then it wouldn't work, and we don't want that, do we?
 */
var $sql;
var $NUMERIC_MONTH;
var $MONTH;
var $DATE;
var $YEAR;
var $PREVIOUS_DATE;
var $PREVIOUS_YEAR;
var $PREVIOUS_NUMERIC_MONTH;
var $NEXT_DATE;
var $NEXT_YEAR;
var $NEXT_NUMERIC_MONTH;
var $TODAY_DATE;
var $TODAY_DAY;
var $TODAY_MONTH;
var $TODAY_YEAR;
var $TODAY_NUMERIC_MONTH;
var $OPTIONS_ADMIN = false;

  function SZCalendar($sql) {
    $this->sql = $sql;
    $this->TODAY_DATE = getdate();
    $this->TODAY_DAY = date('d');
    $this->TODAY_NUMERIC_MONTH = date('n');
    $this->TODAY_MONTH = date('m');
    $this->TODAY_YEAR = date('y');
  }
  
  // This SHOULD work and seems to work between the year 2000 and 2099
  function getWeekNr($year, $month, $day) {
    $now = date("U", mktime(0,0,0,$month,$day+1,$year))*1000;
    $then = date("U", mktime(0,0,0,1,1,$year))*1000;
    
    $compensation = date("w", mktime(0,0,0,1,1,$year));
    
    if ($compensation > 3) {
      $compensation -= 4;
    } else {
      $compensation += 3;
    }
    $weekno = round(((($now-$then)/86400000)+$compensation)/7);
    if ($weekno > 52) 
      $weekno = 1;
    return $weekno;
  }  
  
  function getYearListBox($name, $year = false) {
    $str = '<select name="'.$name.'">'."\n";
    for($i=date('Y');$i<(date('Y')+10);$i++) {
      if ($i == $year) {
        $str .= "  <option value=\"$i\" selected>$i</option>";
      } else {
        $str .= "  <option value=\"$i\">$i</option>";
      }
    }		
    $str .='</select>';
    return $str;
  }
  
  function getMonthListBox($name, $month = false) {
    $str = '<select name="'.$name.'">'."\n";
  	for($i=1;$i<=12;++$i) {
  		$num = ($i<10 ? "0$i" : $i);
      $timestamp = mktime(0,0,0,$num,01,2001);
      $temp_date = getdate($timestamp);
  		if ($num == $month) {
  			$str .= "  <option value=\"$num\" selected>".$temp_date['month']."</option>\n";
  		} else {
  			$str .= "  <option value=\"$num\">".$temp_date['month']."</option>\n";
  		}
  	}		  
    $str .='</select>';
    return $str;
  }
  
  function getDayListBox($name, $day = false) {
    $str = '<select name="'.$name.'">'."\n";
  	for($i=1;$i<=31;++$i) {
  		$num = ($i<10 ? "0$i": $i);
  		if ($i == $day) {
  			$str .= "  <option value=\"$num\" selected>$num</option>\n";
  		} else {
  			$str .= "  <option value=\"$num\">$num</option>\n";
  		}
  	}		
    $str .='</select>';
    return $str;
  }
  
  function getTimeListBox($hour = false, $minute = false) {
    $str = '<select name="hour">'."\n";
  	for($i=0;$i<=23;++$i) {
  		$num = ($i<10 ? "0$i": $i);
  		if ($i == $hour) {
  			$str .= "  <option value=\"$num\" selected>$num</option>\n";
  		} else {
  			$str .= "  <option value=\"$num\">$num</option>\n";
  		}
  	}		
    $str .='</select>'."\n";

    $str .= '<select name="minute">'."\n";
  	for($i=0;$i<=59;++$i) {
  		$num = ($i<10 ? "0$i": $i);
  		if ($i == $minute) {
  			$str .= "  <option value=\"$num\" selected>$num</option>\n";
  		} else {
  			$str .= "  <option value=\"$num\">$num</option>\n";
  		}
  	}		
    $str .='</select>'."\n";

    return $str;
  }
  
  function getEventTypes($ID = false) {
    $len = count($this->arrEventTypes);
    $i=0;
    $str = '<select name="event_type">';
    while($i<$len) {
      if ($ID && $ID == $i) {
        $str .= '<option value="'.$i.'" selected>'.$this->arrEventTypes[$i];
      } else {
        $str .= '<option value="'.$i.'">'.$this->arrEventTypes[$i];
      }
      $i++;
    }
    $str .= '</select>';
    return $str;
  }
  
  function deleteEvent($ID) {
    $this->sql->Delete("DELETE FROM $this->DB_TABLE_NAME WHERE id = $ID");
    return true;
  }
  
  function stopEvent($ID, $year, $month, $day) {
    $month = ($month<10 ? "0$month" : $month);
    $day = ($day<10 ? "0$day" : $day);
    $end_date = $year.$month.$day;
    $this->sql->Update("UPDATE $this->DB_TABLE_NAME SET end_date = $end_date WHERE id = $ID");
    return true;
  }
  
  function updateEvent($ID, $year, $month, $day, $hour, $minute, $event_type, $header, $body, $date_year, $date_month, $date_day, $duration) {
    $end_date = $date_year.$date_month.$date_day;
    $weekday = date("w", mktime(0,0,0,$day,$month,$year));
    $this->sql->Update("UPDATE $this->DB_TABLE_NAME SET duration = $duration, weekday = $weekday, year = $year, month = $month, day = $day, hour = $hour, minute = $minute, end_date = $end_date, event_type = $event_type, header = '".addslashes(htmlspecialchars($header))."', body = '".addslashes(htmlspecialchars($body))."' WHERE id = $ID"); // No, I don't break long lines even if they are SQL-statements, it's just plain silly
    return true;
  }
  
  function addEvent($year, $month, $day, $hour, $minute, $event_type, $header, $body, $date_year, $date_month, $date_day, $duration) {
    $end_date = $date_year.$date_month.$date_day;
    $weekday = date("w", mktime(0,0,0,$month,$day,$year));
    if ($this->sql->Insert("INSERT INTO $this->DB_TABLE_NAME (id, year, month, day, hour, minute, end_date, event_type, header, body, weekday, duration) VALUES ('', $year, $month, $day, $hour, $minute, $end_date, $event_type, '".addslashes(htmlspecialchars($header))."', '".addslashes(htmlspecialchars($body))."', $weekday, $duration)")) { // No, I don't break long lines even if they are SQL-statements, it's just plain silly
      return true;
    } else {
      return false;
    }
  }
  
  function action($action = false, $year = false, $numeric_month = false, $day = false) {
    if ($action == "findDate") {
      $this->DATE = getdate(mktime(0,0,0,$numeric_month,1,$year)); 
    } else {
      $this->DATE = getdate();
    }
    $this->NUMERIC_MONTH  = $this->DATE["mon"];      // numeric month (1-12)
    $this->MONTH          = $this->DATE["month"];    // display month january, feb..
    $this->YEAR           = $this->DATE["year"];     // 4 digit year (y2k compliant)
     
    $this->PREVIOUS_DATE          = getdate(mktime (0,0,0,($this->NUMERIC_MONTH-1),1,$this->YEAR));
    $this->PREVIOUS_NUMERIC_MONTH = $this->PREVIOUS_DATE["mon"];     // numeric month (1-12)
    $this->PREVIOUS_YEAR          = $this->PREVIOUS_DATE["year"];   // 4 digit year (y2k compliant)

    $this->NEXT_DATE          = getdate(mktime (0,0,0,($this->NUMERIC_MONTH+1),1,$this->YEAR));
    $this->NEXT_NUMERIC_MONTH = $this->NEXT_DATE["mon"];     // numeric month (1-12)
    $this->NEXT_YEAR          = $this->NEXT_DATE["year"];   // 4 digit year (y2k compliant)
    return $this->show();
  }
  
  function getDayOfWeek($year, $month, $day) {
    return date("w", mktime(0,0,0,$month,$day,$year));
  }
  
  function getWeekdayOfFirst($change_year = 0, $change_month = 0, $change_date = 0) {
    if ($change_year == -1) {
      $change_month = 11;
    }
    $tempDate = getdate(mktime(0,0,0,($this->NUMERIC_MONTH+$change_month),(1+$change_date),($this->YEAR+$change_year)));
    $firstwday= $tempDate["wday"];
    return $firstwday;
  }
  
  function getLastDayOfMonth($change_year = 0, $change_month = 0) {
    $cont = true;
    $tday = 27;
    if ($change_year == -1) {
      $change_month = 11;
    }
    while (($tday <= 32) && ($cont)) {
      $tdate = getdate(mktime(0,0,0,($this->NUMERIC_MONTH+$change_month),$tday,($this->YEAR+$change_year)));
      if ($tdate["mon"] != ($this->NUMERIC_MONTH+$change_month)) {
        $lastday = $tday - 1;
        $cont = false;
      }
      $tday++;
    }
    return $lastday;
  }
  
  function show() {
    if ($this->CALENDAR_TYPE == 'vertical') {
      return $this->displayHeader().$this->displayVericalCalendar().$this->displayFooter();
    } else {
      return $this->displayHeader().$this->displayCalendar().$this->displayFooter();
    }
  }
  
  function displayVericalCalendar() {
    $d = 1; // Star on the first of the month
    $str = '';
    $firstweek = true;
    $lastday = $this->getLastDayOfMonth();
    $firstWeekDay = $this->getWeekdayOfFirst();

    // loop through all the days of the month
    while ($d <= $lastday) {   // set up blank days for first week
      if (($d == $this->TODAY_DAY) && ($this->NUMERIC_MONTH == $this->TODAY_NUMERIC_MONTH)) {
        $str .= '<tr>'.$this->echoDateBlocks('current', $firstWeekDay, $d);
      } else {
        $str .= '<tr>'.$this->echoDateBlocks('every', $firstWeekDay, $d);
      }
      
      if ($firstWeekDay == 0) {
        $str .= '    <td class="redDAY" style="text-align:right; border-right: 1px solid black;">'.$this->WEEK[$this->CALENDAR_TYPE].$this->getWeekNr($this->YEAR, $this->NUMERIC_MONTH, $d).'</td>'."\n";    
      } else {
        if ($firstWeekDay == 6) {
          $str .='<td class="redDAY" style="border-right: 1px solid black;">&nbsp;</td></tr>';
        } else {
          $str .='<td class="everyDAY" style="border-right: 1px solid black;">&nbsp;</td></tr>';
        }
      }
      $firstWeekDay++;
      $firstWeekDay = $firstWeekDay % 7;
      $d++;
    }
    return $str;
  }
  
  function displayCalendar() {
    if ($this->NUMERIC_MONTH == 1) {
      $change_year = -1;
    } else {
      $change_year = 0;
    }
    $firstWeekDay = $this->getWeekdayOfFirst();
    $lastday = $this->getLastDayOfMonth();
    $prev_lastday = $this->getLastDayOfMonth($change_year, -1);
    $d = 1; // Star on the first of the month
    $str = '';
    $firstweek = true;

    // loop through all the days of the month
    $prev_lastday = ($prev_lastday - ($firstWeekDay - 1));
    $prev_lastWeekDay = $this->getWeekdayOfFirst($change_year, -1, $prev_lastday-1);
    while ($d <= $lastday) {   // set up blank days for first week
      if ($firstweek) {
        if ($firstWeekDay != 0) {
          $str .= "  <tr>\n";
          $str .= '    <td class="everyDAY" style="text-align:center;">'.$this->getWeekNr($this->YEAR, $this->NUMERIC_MONTH, 1).'</td>'."\n";
        }
        for ($i=1; $i<=$firstWeekDay; $i++) {
          $str .= $this->echoDateBlocks('previous', $prev_lastWeekDay, $prev_lastday);
          $prev_lastday++;
          $prev_lastWeekDay++;
        }
        $firstweek = false;
      }
    
      if ($firstWeekDay==0) { // Sunday start week with <tr>
        $str .= "  <tr>\n";
        $str .= '    <td class="everyDAY" style="text-align:center;">'.$this->getWeekNr($this->YEAR, $this->NUMERIC_MONTH, $d).'</td>'."\n";
      }
      if (($d == $this->TODAY_DAY) && ($this->NUMERIC_MONTH == $this->TODAY_NUMERIC_MONTH)) {
        $str .= $this->echoDateBlocks('current', $firstWeekDay, $d);
      } else {
        $str .= $this->echoDateBlocks('every', $firstWeekDay, $d);
      }
    
      if ($firstWeekDay==6) { // Saturday end week with </tr>
        $str .= "  </tr>\n";
      }
      $firstWeekDay++;
      $firstWeekDay = $firstWeekDay % 7;
      $d++;
    }
    
    if ($firstWeekDay != 0) {
      $k=1;
      $j=$firstWeekDay;
      while ($j<7) {
        $str .= $this->echoDateBlocks('previous', $j, $k);
        $j++;
        $k++;
      }
      if ($j == 7) {
        $str .= "  </tr>\n";
      }
    }
    return $str;
  }
  
  function echoDateBlocks($dayType, $WeekDay, $d) {
    if ($dayType == 'current') {
      $span = ' class="today"';
      $dayTypeCSS = '';
    } else if ($dayType == 'previous') {
      $dayTypeCSS = 'prevDAY';
      $span = '';
    } else if ($dayType == 'every') {
      $dayTypeCSS = 'everyDAY';
      $span = '';
    }

    if (($dayType != 'previous')) {
      if ($this->arrRedDays[$WeekDay]) {
        $dayTypeCSS = 'redDAY';
      }
      if ((in_array(($this->NUMERIC_MONTH.'/'.$d), $this->arrRedDates, false))) {
        $dayTypeCSS = 'holiDAY';
      }
    }
    if ($this->CALENDAR_TYPE == 'mini') {
      $str = $this->miniCalendar($dayTypeCSS, $d, $span);
    } else if ($this->CALENDAR_TYPE == 'vertical') {
      $str = $this->verticalCalendar($dayTypeCSS, $d, $WeekDay, $span);
    }
    return $str;
  }
  
  function miniCalendar($dayTypeCSS, $d, $span) {
    $link = $this->PATH_PAGE_SHOW_EVENTS.'?year='.$this->YEAR.'&month='.$this->NUMERIC_MONTH.'&day='.$d;
    if ($this->EVENT_POPUP) {
      $href = 'javascript:showEventWindow(\''.$link.'\');';
    } else {
      $href = $link;
    }
    $str = '<td style="text-align: '.$this->DATEBOX_TEXTALIGN.'" class="'.$dayTypeCSS.'"><span'.$span.'><a target="'.$this->EVENT_TARGET.'" href="'.$href.'">'.$d.'</a></span></td>'."\n";
    return $str;
  }
  
  function verticalCalendar($dayTypeCSS, $d, $WeekDay, $span) {
    if ($this->OPTIONS_ADMIN == true) {
      $str = '<td style="text-align: '.$this->DATEBOX_TEXTALIGN.'" class="'.$dayTypeCSS.'"><span'.$span.'><a class="'.$dayTypeCSS.'" href="'.$this->PATH_PAGE_EVENT.'?action=edit&year='.$this->YEAR.'&numeric_month='.$this->NUMERIC_MONTH.'&day='.$d.'"><span class="numbers">'.$d.'</span> '.$this->arrDay[$this->WEEKDAYNAMES][$WeekDay].'</a></span>';
    } else {
      $str = '<td style="text-align: '.$this->DATEBOX_TEXTALIGN.'" class="'.$dayTypeCSS.'"><span'.$span.'><span class="numbers">'.$d.'</span> '.$this->arrDay[$this->WEEKDAYNAMES][$WeekDay].'</span>';
    }
    $test_month = ($this->NUMERIC_MONTH<10 ? "0".$this->NUMERIC_MONTH : $this->NUMERIC_MONTH);
    $test_day = ($d<10 ? "0$d" : $d);
    if ($data = $this->sql->Select("SELECT * FROM $this->DB_TABLE_NAME WHERE (event_type = 0 AND year = $this->YEAR AND month = $this->NUMERIC_MONTH AND day = $d) OR (((event_type = 1 AND month = $this->NUMERIC_MONTH AND day = $d AND CONCAT(year, month)  <= ".$this->YEAR.$this->NUMERIC_MONTH.") OR (event_type = 2 AND day = $d AND CONCAT(year, month)  <= ".$this->YEAR.$this->NUMERIC_MONTH.") OR (event_type = 3 AND weekday = $WeekDay AND CONCAT(year, month)  <= ".$this->YEAR.$this->NUMERIC_MONTH.") OR (event_type = 4 AND CONCAT(year, month, day)  <= ".$this->YEAR.$this->NUMERIC_MONTH.$d.")) AND (end_date >= ".$this->YEAR.$test_month.$test_day.")) ORDER BY hour, minute")) { // No, I don't break long lines even if they are SQL-statements, it's just plain silly
      $len = count($data);
      $i=0;
      $str .='<table cellpadding="0" cellspacing="0" style="border: 0px">';
      while($i<$len) {
        $data[$i]["minute"] = ($data[$i]["minute"]<10 ? '0'.$data[$i]['minute']: $data[$i]["minute"]);
        $data[$i]["hour"] = ($data[$i]["hour"]<10 ? '0'.$data[$i]['hour']: $data[$i]["hour"]);
        $link = $this->PATH_PAGE_SHOW_EVENTS.'?year='.$this->YEAR.'&month='.$this->NUMERIC_MONTH.'&day='.$d.'#'.$data[$i]["header"];
        if ($this->EVENT_POPUP) {
          $href = 'javascript:showEventWindow(\''.$link.'\');';
        } else {
          $href = $link;
        }
        $str .='
            <tr>
              <td class="clean" width="80"></td>
              <td class="clean"><span class="header"><a target="'.$this->EVENT_TARGET.'" href="'.$href.'">'.$data[$i]["header"].' - ('.$data[$i]["hour"].':'.$data[$i]["minute"].' - '.($data[$i]["hour"]+$data[$i]["duration"]).':'.$data[$i]["minute"].')</a></span></td>
          ';
          if ($this->OPTIONS_ADMIN == true) {
            $str .= '
              <td width="5" class="clean"></td>
              <td class="clean"><a href="'.$this->PATH_PAGE_EVENT.'?ID='.$data[$i]["id"].'&year='.$this->YEAR.'&numeric_month='.$this->NUMERIC_MONTH.'&day='.$d.'">edit</a></td>
              <td width="5" class="clean"></td>
              <td class="clean"><a href="'.$this->PATH_PAGE_DELETE.'?ID='.$data[$i]["id"].'&month='.$this->NUMERIC_MONTH.'&year='.$this->YEAR.'">remove</a></td>
            ';
            if ($data[$i]["event_type"] != 0) {
            $str .= '
              <td width="5" class="clean"></td>
              <td class="clean"><a href="'.$this->PATH_PAGE_STOP.'?ID='.$data[$i]["id"].'&year='.$this->YEAR.'&month='.$this->NUMERIC_MONTH.'&day='.$d.'">stop</a></td>
            ';
            }
          }
          $str .= '
          </tr>
          ';
        $i++;
      }
      $str .='</table>';
    }
    $str .='</td>'."\n";
    return $str;
  }
  
  function displayEvents($year, $month, $day) {
    $test_month = ($month<10 ? "0".$month : $month);
    $test_day = ($day<10 ? "0$day" : $day);
    $WeekDay = $this->getDayOfWeek($year, $month, $day);
    $str = $this->getStyleSheet();
    if ($data = $this->sql->Select("SELECT * FROM $this->DB_TABLE_NAME WHERE (event_type = 0 AND year = $year AND month = $month AND day = $day) OR (((event_type = 1 AND month = $month AND day = $day AND CONCAT(year, month)  <= ".$year.$month.") OR (event_type = 2 AND day = $day AND CONCAT(year, month)  <= ".$this->YEAR.$month.") OR (event_type = 3 AND weekday = $WeekDay AND CONCAT(year, month)  <= ".$year.$month.") OR (event_type = 4 AND CONCAT(year, month, day)  <= ".$year.$month.$day.")) AND (end_date >= ".$year.$test_month.$test_day.")) ORDER BY hour, minute")) { // No, I don't break long lines even if they are SQL-statements, it's just plain silly
      $len = count($data);
      $i=0;
      $str .='<table cellpadding="0" cellspacing="0" border="0">';
      while($i<$len) {
        $data[$i]["minute"] = ($data[$i]["minute"]<10 ? '0'.$data[$i]['minute']: $data[$i]["minute"]);
        $data[$i]["hour"] = ($data[$i]["hour"]<10 ? '0'.$data[$i]['hour']: $data[$i]["hour"]);
        $str .='
            <tr>
              <td class="clean" width="10"></td>
              <td class="clean">
                <span class="boldheader"><a name="'.$data[$i]["header"].'">'.$data[$i]["header"].'</a> - ('.$data[$i]["hour"].':'.$data[$i]["minute"].' - '.($data[$i]["hour"]+$data[$i]["duration"]).':'.$data[$i]["minute"].')</span><br>
                <span class="bodytext">
                '.nl2br($data[$i]["body"]).'
                </span>
             </td>
          </tr>
          ';
        $i++;
      }
      $str .='
      <tr>
        <td height="20"></td>
      </tr>
      <tr>
        <td width="5" class="clean"></td>
        <td colspan="7" class="clean" bgcolor="Black" height="1"></td>
      </tr>
      <tr>
        <td width="5" class="clean"></td>
        <td colspan="7" class="clean">
        ';
        if ($this->OPTIONS_ADMIN == true) {
          $str .= '<a href="'.$this->PATH_PAGE_EVENT.'?action=edit&year='.$year.'&numeric_month='.$test_month.'&day='.$day.'">Add Event</a>';
        }
        $str .= '
        </td>
      </tr>
      ';
      $str .='</table>';
    }
    return $str;
  }
  
  function getStyleSheet() {
    return '
    <style>
    @import "'.$this->CSS[$this->CALENDAR_TYPE].'";
    @import "'.$this->CSS_COMMON.'";
    </style>
    ';
  }
  
  function durationSelectBox($duration = false) {
    $i=1;
    $str = '<select name="duration">';
    while($i < 25) {
      if ($duration && $duration == $i) {
        $str .= '<option value="'.$i.'" selected>'.$i.' '.$this->arrStrings[0];
      } else {
        $str .= '<option value="'.$i.'">'.$i.' '.$this->arrStrings[0];
      }
      $i++;
    }
    $str .= '</select>';
    return $str;  
  }
  
  function displayEditForm($year, $numeric_month, $day, $ID = false) {
    if ($ID) {
      $data = $this->sql->Select("SELECT * FROM $this->DB_TABLE_NAME WHERE id = $ID");
      return '
      '.$this->getStyleSheet().'
      <form action="'.$this->PATH_PAGE_UPDATE.'" method="post">
      <input type="Hidden" name="ID" value="'.$ID.'">
      <table style="border:0px">
        <tr>
          <td class="clean" ><span class="boldheader">Event Date:</span></td>
          <td class="clean" >'.$this->getYearListBox('year', $data[0]['year']).$this->getMonthListBox('month', $data[0]['month']).$this->getDayListBox('day', $data[0]['day']).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Time of Event:</span></td>
          <td class="clean" >'.$this->getTimeListBox($data[0]['hour'],$data[0]['minute']).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Duration:</span></td>
          <td class="clean" >'.$this->durationSelectBox($data[0]['duration']).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Type of Event:</span></td>
          <td class="clean" >'.$this->getEventTypes($data[0]['event_type']).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Event End Date:</span></td>
          <td class="clean" >'.$this->getYearListBox('date_year', substr($data[0]['end_date'],0,4)).$this->getMonthListBox('date_month', substr($data[0]['end_date'],4,2)).$this->getDayListBox('date_day', substr($data[0]['end_date'],6,2)).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Header:</span></td>
          <td class="clean" ><input name="header" value="'.$data[0]['header'].'"></td>
        </tr>
        <tr>
          <td class="clean"  colspan="2"><span class="boldheader">Information:</span><br>
          <textarea name="body" rows="10" cols="32">'.$data[0]['body'].'</textarea>
          </td>
        </tr>
        <tr>
          <td class="clean" colspan="2" align="right"><input type="Submit" value="Update"></td>
        </tr>
      </table>
      </form>';
    } else {
      return '
      '.$this->getStyleSheet().'
      <form action="'.$this->PATH_PAGE_ADD.'" method="post">
      <input type="Hidden" name="year" value="'.$year.'">
      <input type="Hidden" name="month" value="'.$numeric_month.'">
      <input type="Hidden" name="day" value="'.$day.'">
      <table style="border:0px">
        <tr>
          <td class="clean" ><span class="boldheader">Time of Event:</span></td>
          <td class="clean" >'.$this->getTimeListBox(12,0).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Duration:</span></td>
          <td class="clean" >'.$this->durationSelectBox().'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Type of Event:</span></td>
          <td class="clean" >'.$this->getEventTypes().'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Event End Date:</span></td>
          <td class="clean" >'.$this->getYearListBox('date_year', $year).$this->getMonthListBox('date_month', $numeric_month).$this->getDayListBox('date_day', $day).'</td>
        </tr>
        <tr>
          <td class="clean" ><span class="boldheader">Header:</span></td>
          <td class="clean" ><input name="header"></td>
        </tr>
        <tr>
          <td class="clean"  colspan="2"><span class="boldheader">Information:</span><br>
          <textarea name="body" rows="10" cols="32"></textarea>
          </td>
        </tr>
        <tr>
          <td class="clean" colspan="2" align="right"><input type="Submit" value="Add"></td>
        </tr>
      </table>
      </form>';
    }
  }
  
  function displayHeader() {
    $str = $this->getStyleSheet().'
    <script language="JavaScript1.2" type="text/javascript">
      function showEventWindow(url) {
        window.open(url,\'eventwindow\',\'toolbar=0,location=0,directories=0,menuBar=0,scrollbars=0,resizable=1,width=300,height=400\');
      }
    </script>
    <table align="center" width="'.$this->TABLE_SIZE[$this->CALENDAR_TYPE].'" cellspacing="0" cellpadding="0" border="0">
      <tr>
        <td colspan="8" class="center" style="border-right: 1px solid black;">
          <span class="bold">'.$this->arrMonth[$this->MONTHNAMES][$this->NUMERIC_MONTH].' '.$this->YEAR.'</span>
        </td>
      </tr>  
      ';
      if ($this->DISPLAY_WEEKDAY_NAMES_ON_COLUMN) {
      $str .= '
      <tr>
        <td class="TOPday">'.$this->WEEK[$this->CALENDAR_TYPE].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][0].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][1].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][2].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][3].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][4].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][5].'</td>
        <td class="TOPday">'.$this->arrDay[$this->WEEKDAYNAMES][6].'</td>
      </tr>
      ';
      }  
    return $str;
  }

  /*
   * Q: what the heck is this HTML doin' here? It should be separated more 
   *    from the code! n00b!
   *
   * A: I could do that, but then you wouldn't feel that rush of superiority
   *    that you feel right now when discovering something that you feel is wrong 
   *    and have read about in The Webprogrammers Digest as a big no-no.
   *    So instead I think you should be most thankful and maybe concider that
   *    separating HTML from code isn't such a big deal, u don't get laid by
   *    doing it and you sertainly don't make friends or get a huge raise.
   *
   *    Simply put: Do I look like someone who cares?
   * 
   */
  function displayFooter() {
    $str = '
      <tr>
        <td colspan="8" style="border:0px">
          <table style="border: 0px" width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td class="left">
                <form method="'.$this->FORM_METHOD.'" action="'.$this->PATH_PAGE_CALENDAR.'" style="display: inline;">
                  <input type="HIDDEN" name="action" value="findDate">
                  <input type="HIDDEN" name="numeric_month" value="'.$this->PREVIOUS_NUMERIC_MONTH.'">
                  <input type="HIDDEN" name="year" value="'.$this->PREVIOUS_YEAR.'">
                  <button type="submit" class="buttons">'.$this->FORM_PREV_BUTTON.'</button>
                </form>
              </td>
              <td class="right" style="border-right: 1px solid black;">
                <form method="'.$this->FORM_METHOD.'" action="'.$this->PATH_PAGE_CALENDAR.'" style="display: inline;">
                  <input type="HIDDEN" name="action" value="findDate">
                  <input type="HIDDEN" name="numeric_month" value="'.$this->NEXT_NUMERIC_MONTH.'">
                  <input type="HIDDEN" name="year" value="'.$this->NEXT_YEAR.'">
                  <button type="submit" class="buttons">'.$this->FORM_NEXT_BUTTON.'</button>
                </form>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    ';
    return $str;
  }
}
?>