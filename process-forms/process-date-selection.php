<?php
 
if (isset ($_POST['submit-event-dates'])) {    
    $weeklyeventmap = removeFromMap ("data/weekly-event-map.txt", "", $eventid); 
    $monthlyeventmap = removeFromMap ("data/monthly-event-map.txt", "", $eventid); 
    $yearlyeventmap = removeFromMap ("data/yearly-event-map.txt", "", $eventid); 
    $dateeventmap = removeEventFromMapByYear ("data/date-event-map.txt", "", $eventid , $year);   
    if (isset ($_POST['datearray'])) {   
        $datearray = $_POST['datearray'];    
        foreach ($datearray as $item) { 
            $dateeventmap = addMapEntry ("data/date-event-map.txt", $item, $eventid) ; 
        }  
    }
}


else if (isset ($_POST['submit-dow-dates'])) {
     include ("inc/remove-all-dates.php");
     if (isset ($_POST['start-date']) && isset ($_POST['end-date']) && isset ($_POST['dowarray'])) {
       
        //Process day of week with start and end dates - uses date event map
        $dowarray = $_POST['dowarray']; 
         
        $startdate = $_POST['start-date'];
        $enddate = $_POST['end-date'];
     
        $starty = intval(substr ($_POST['start-date'], 0, 4));
        $endy = intval (substr ($_POST['end-date'], 0, 4));

        //Dates as numbers
        $startdatenum = intval(str_replace ("-", "", $startdate));
        $enddatenum = intval(str_replace ("-", "", $enddate));

        for ($y = $starty; $y <= $endy; $y++) {

            for ($m = 1; $m <= 12; $m++) {
                $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);

                for ($x = 1; $x <= $daysinmonth ; $x++) {
                     $xpadded = str_pad($x,2,0 , STR_PAD_LEFT);
                     $mpadded = str_pad($m,2,0 , STR_PAD_LEFT);
                     $currentdate = $y . "-" . $mpadded . "-" .$xpadded;                          
                     if ($currentdate >= $startdate && $currentdate <= $enddate) {                        
                         $dayofweek =  date("w", mktime(0,0,0,$m,$x,$y)); 

                         if (in_array ($dayofweek, $dowarray)) {                        

                            $dateeventmap = addMapEntry ("data/date-event-map.txt", $currentdate, $eventid);
                         }
                    }
                }
            }
         }
    }
}

//Process Weekly Dates
else if (isset ($_POST['submit-weekly-dates'])) {
     include ("inc/remove-all-dates.php");
     if (isset ($_POST['weekly'])) {
        $weekly = $_POST['weekly']; 
        foreach ($weekly as $item) { 
            $weeklyeventmap = addMapEntry ("data/weekly-event-map.txt",  $item, $eventid);   
        }  
    }
}

//PRocess Monthly Dates
else if (isset ($_POST['submit-monthly-dates'])) {            
    include ("inc/remove-all-dates.php");
    $monthly = array();
     if (isset ($_POST['monthly'])) {
         $monthly = $_POST['monthly']; 
        foreach ($monthly as $item) {        
            $monthlyeventmap = addMapEntry ("data/monthly-event-map.txt", $item, $eventid);  
        }  
    }
}

//Process yearly dates
else if (isset ($_POST['submit-yearly-dates'])) {  
    include ("inc/remove-all-dates.php");
    if (isset ($_POST['yearly']))  {        
         $yearly = $_POST['yearly'];   
         foreach ($yearly as $item) {
             $yearlyeventmap = addMapEntry ("data/yearly-event-map.txt", $item, $eventid);
         }
     }
}

?>