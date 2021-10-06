<?php
if ($eventrecord['schedule-type'] === 'dates') {   
    $datearray = selectMapEntries ($dateeventmap, "", $eventid);
    $currentdate = date ("Y-m-d"); 

    echo "<br><br><b>All  dates: </b>";    
    foreach ($datearray as $id => $item) { 
        $y = intval (substr ($item, 0, 4));
        $month = intval (substr ($item, 5, 2));
        $day = intval(substr ($item, 8, 2));

        $string = date("l F d, Y", mktime(0,0,0,$month, $day, $y));
        echo "<br>&nbsp;&nbsp;  " . $string;   
        if ($id === 0) {
            $startday = $string;
        }
        if ($id === count ($datearray) - 1) {
            $endday = $string;
        }
        $dayofweek  = date("l", mktime(0,0,0,$month, $day, $y));  
    }

    echo "<br><br><b>Upcoming Dates: </b>";
    sort ($datearray);
    $currentdate = date ("Y-m-d");
    foreach ($datearray as $id => $item) {   
        $y = intval (substr ($item, 0, 4));
        $month = intval (substr ($item, 5, 2));
        $day = intval(substr ($item, 8, 2));
        //check that date is not in the past
        if (substr ($item, 0, 10) >=  $currentdate) {   
            $string = date("l F d, Y", mktime(0,0,0,$month, $day, $y));
            echo "<br>&nbsp;&nbsp;  " . $string;   
            if ($id === 0) {
                $startday = $string;
            }
            if ($id === count ($datearray) - 1) {
                $endday = $string;
            }
            $dayofweek  = date("l", mktime(0,0,0,$month, $day, $y));   
        }
    }
}
else if ($eventrecord['schedule-type'] === 'weekly'){
    $datearray = selectMapEntries ($weeklyeventmap, "", $eventid);
    echo "<br><br><b>Scheduled Weekly</b>";  
    foreach ($datearray as $item) {
        if (array_key_exists ($item, $dowarray)) {
            echo "<br>" . $dowarray[$item];
        }
    }
}
else if ($eventrecord['schedule-type'] === 'monthly')  { 

    $dowarray = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')  ;  
    $numarray = array ('First', 'Second', 'Third', 'Fourth');
    $datearray = selectMapEntries ($monthlyeventmap, "", $eventid);

    echo "<br><br><b>Scheduled Monthly</b>"; 
    foreach ($datearray as $item) {
         $d = substr ($item, 0, 1);
         $n = substr ($item, 1,1);
         if (array_key_exists ($d, $dowarray) && array_key_exists ($n, $numarray)) {
             echo "<br>" .  $numarray[$n]  . "  " . $dowarray[$d] ;
         }
    }
}
else if ($eventrecord['schedule-type'] === 'yearly')  {               

    echo "<br><br><b>Scheduled Yearly</b>"; 
    $datearray = selectMapEntries ($yearlyeventmap, "", $eventid);
    echo "<br>"; 
    foreach ($datearray as $item) {
        $m = intval (substr ($item, 0, 2));
        $d = intval (substr ($item, 3,2));

        if (array_key_exists ($m-1, $montharray2)) {
            echo "<br>" . $montharray2 [$m - 1];
        }
        echo " " .$d; 
    }
}
echo "<br><br>";
?>