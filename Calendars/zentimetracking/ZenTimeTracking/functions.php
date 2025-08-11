<?php 
function whereorand($i)
{
    $strwhere = "";
    if ($i == 0)  
        $strwhere = " where ";
    else if ($i > 0) 
        $strwhere = " and ";
    return $strwhere;       
}
function date_diff($str_start, $str_end) 
{ 
    if(($str_start=='NULL')&&($str_end=='NULL'))
    {
    }
    else
    {
        
    $str_start = strtotime($str_start); // The start date becomes a timestamp 
    $str_end = strtotime($str_end); // The end date becomes a timestamp 
    $nseconds = $str_end - $str_start; // Number of seconds between the two dates 
    $ndays = round($nseconds / 86400); // One day has 86400 seconds 
    $nseconds = $nseconds % 86400; // The remainder from the operation 
    $nhours = round($nseconds / 3600); // One hour has 3600 seconds 
    $nseconds = $nseconds % 3600; 
    $nminutes = round($nseconds / 60); // One minute has 60 seconds, duh! 
    $nseconds = $nseconds % 60; 
    }   
    return($ndays." days, ".$nhours." hours, ".$nminutes." minutes, ".$nseconds." seconds"); 
        
} 
?>


