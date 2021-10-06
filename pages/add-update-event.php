<?php

//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
$eventid =  "";
if (isset ($_GET["event"])){   
    $eventid = filter_input(INPUT_GET, "event", FILTER_SANITIZE_STRING) ;
}
$eventrecord = readDatabaseRecord("events", $eventid);
include ("inc/retrieve-dates.php");

//Proecess any forms sumbitted on this page
if ($_SERVER ["REQUEST_METHOD"] == "POST" ) {    
   
    if (isset ($_POST['submit-event-info'])) {
        include ("process-forms/process-event-form.php");
    }
    else {
        include ("process-forms/process-date-selection.php"); 
    }
}
echo "<a href = 'index.php?page=home'>&larr; Return</a><br>";

if ($eventid === "") {
    echo "<h2>Add Event</h2>";
}
else {
    echo "<h2>Edit Event: <span class = 'display-title'>" . $eventrecord['title'] . "</span></h2>";
}
?>    

<div class = 'half-column ' >
    <?php  
   
    include ("forms/event-form.php"); 
    echo "<a class = 'adminbutton' href = 'index.php?page=single-event-page&event=" . $eventid . "'>View Event </a><br>";  
    echo "<a class = 'adminbutton' href = 'index.php?page=remove-event&event=" . $eventid . "'>Remove Event </a><br>";
    
    ?>
</div><div class = 'half-column centered'>
    <?php 
    if ($eventid !== "" && file_exists ("data/events/" . $eventid . ".txt")) {
        if ($eventrecord['schedule-type'] === 'dates') {    
            include ("forms/select-dates-for-event.php");   
        }
        else if ($eventrecord['schedule-type'] === 'weekly') {
            include ("forms/select-weekdays-for-event.php"); 
        }
        else if ($eventrecord['schedule-type'] === 'monthly') {
            include ("forms/select-monthlydays-for-event.php");
        }
        else if ($eventrecord['schedule-type'] === 'yearly') {      
            include ("forms/select-yearly-days-for-event.php");
        }
    }
    ?> 
</div>  
  