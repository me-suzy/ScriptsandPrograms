
<?php
function DayInMonth($month, $year) {
    $daysInMonth = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
   if ($month != 2) return $daysInMonth[$month - 1];
   return (checkdate($month, 29, $year)) ? 29 : 28;
} 
$month = 2;//date("n"); 
$year = 2004;//date("Y"); 
$day = 12;//date("j");
//echo DayInMonth($month,$year);
$date = DayInMonth($month,$year);
echo'<table width="4%" border="1" cellspacing="0" cellpadding="0">';
echo'   <tr bgcolor="#0099FF"> 
    <td> <div align="center"><font color="#FFFFFF"><strong>Monday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Tuesday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Wednesday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Thursday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Friday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Saturday</strong></font></div></td>
    <td><div align="center"><font color="#FFFFFF"><strong>Sunday</strong></font></div></td>
  </tr>';
  
    for($j = 1; $j < $date + 1; $j++)  {
	   if ($j == $day)
       {
	       echo '<td bgcolor="#FFFFCC">';
	       echo "$j";
	       echo '</td>';
	    }
		else
	
	echo  "<td>$j</td>";
       
	   if($j % 7 == 0) 
	   echo "</tr><tr>"; 
		
	    
        }
   echo  '</tr>';
echo '</table>';
?>


