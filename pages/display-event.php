<?php 
 //Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 

$dayofweekarray = array ("Sun","Mon" ,"Tues", "Wed", "Thurs", "Fri", "Sat");  

$eventid =   "";    
if (isset ($_GET["event"])){   
    $eventid = filter_input(INPUT_GET, "event", FILTER_SANITIZE_STRING) ;    
}
$eventrecord = readDatabaseRecord ("events", $eventid); 


echo "<a href = 'index.php'><h4>&larr; Return to Calendar</h4></a>";
echo "<h2>" . ucwords($eventrecord ['title' ]) . "</h2>";
echo "<div class = 'event-box'>";

echo  $eventrecord['description'];
echo "<br>" .   $eventrecord['html-content'] ;
if ($eventrecord['time'] !== ""){
    echo "<br>Time: " . $eventrecord['time'] ;  
}
if ($eventrecord['cost'] !== "") {
    echo "<br>Cost: " . $eventrecord['cost'];
}

include ("inc/display-event-dates.php");

echo "</div>";

echo "<br><a class = 'adminbutton' href = 'index.php?page=add-update-event-events&event=" . $eventid . "'>Edit Event</a>";    
 


     ?>

