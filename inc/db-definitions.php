<?php
/*Copyright (c) 2019, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
This code is part of the LilaWorks Content Management System
*/

//delimeters for records
//$dl1 = "###";
//$dl2 = "%#%";
$dl1 = "%%%";
$dl2 = "%#%";

//Maps used to show events on calendar
$dateeventmap = array ();
if (file_exists ("data/date-event-map.txt")) {
    $string = file_get_contents ("data/date-event-map.txt");
    $dateeventmap = explode ($dl1, $string);
}
$monthlyeventmap = array();
if (file_exists ("data/monthly-event-map.txt")) {
    $string = file_get_contents ("data/monthly-event-map.txt");
    $monthlyeventmap = explode ($dl1, $string);
}

$weeklyeventmap = array ();
if (file_exists ("data/weekly-event-map.txt")) {
    $string = file_get_contents ("data/weekly-event-map.txt");
    $weeklyeventmap = explode ($dl1, $string);
}
$yearlyeventmap = array ();
if (file_exists ("data/yearly-event-map.txt")) {
    $string = file_get_contents ("data/yearly-event-map.txt");
    $yearlyeventmap = explode ($dl1, $string);
}

$dbtables = array (     
  
     "days" => array( "schedule-md"  )  ,   
    
    "events" => array ("title",  "html-content", "md-content",  "image", "time", "description", "category", "dates", "background-color", "cost",  "location", "bgcolor", "schedule-type")
     );

$montharray = array("Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept", "Oct", "Nov", "Dec"); 
$montharray2 = array ("January", "February",  "March",  "April",  "May",  "June",  "July", "August",  "September",  "October", "November",  "December"); 

$dayofweekarray = array ("Sun","Mon" ,"Tues", "Wed", "Thurs", "Fri", "Sat");  
$dowarray = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday')  ; 


