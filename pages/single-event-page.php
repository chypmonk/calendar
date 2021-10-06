<?php 
 //Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 

$eventid =   "";    
if (isset ($_GET["event"])){   
    $eventid = filter_input(INPUT_GET, "event", FILTER_SANITIZE_STRING) ;    
}
$eventrecord = readDatabaseRecord ("events", $eventid); 
echo "<a href = 'index.php?page=home'>&larr; Return</a><br>";
echo "<div class = 'event-box content-column'>";
echo "<h2>Event: <span class = 'display-title'>" .  ucwords($eventrecord ['title' ]) . "</span></h2>";

echo "<div class = 'half-column'>";
if ($eventrecord['image'] !== "") {
    echo "<br><img src = '"  . $eventrecord['image'] . "'  alt = '" . $eventrecord['title'] . "'  />";
}

echo  "<br><br>" . $eventrecord['description'];
echo "<br><br>" .   $eventrecord['html-content'] ;
if ($eventrecord['time'] !== ""){
    echo "<br>Time: " . $eventrecord['time'] ;  
}
if ($eventrecord['cost'] !== "") {
    echo "<br>Cost: " . $eventrecord['cost'];
}
echo "</div><div class = 'half-column'>";


$datearray = selectMapEntries ($dateeventmap, "", $eventid);
 sort ($datearray);

$currentdate = date ("Y-m-d");
include ("inc/all-dates-for-event.php");  
echo "</div>";
echo "</div><div class = 'sidebar-column'>";
echo "<a class = 'adminbutton' href = 'index.php?page=add-update-event&event=" . $eventid . "' >Edit Event</a><br>";
 echo "<a class = 'adminbutton' href = 'index.php?page=remove-event&event=" . $eventid . "'>Remove Event </a><br>";
    
echo "</div>";
    


     ?>

