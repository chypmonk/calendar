<?php

$eventarray = array();
$array1 = selectMapEntries($dateeventmap, $year . "-" . $month . "-" . $day, "");
$eventarray = array_merge ($eventarray, $array1); 
 
$array1 = selectMapEntries($weeklyeventmap, $dow, "");  
$eventarray = array_merge ($eventarray, $array1); 
    
$array1 = selectMapEntries($monthlyeventmap, $dow . $count , "");
$eventarray = array_merge ($eventarray, $array1);       
            
$array1 = selectMapEntries($yearlyeventmap, $month . "-" . $day , "");
$eventarray = array_merge ($eventarray, $array1); 


?>
