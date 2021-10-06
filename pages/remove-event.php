<?php

//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
$eventid = "";
if (isset ($_GET['event'])) {
    $eventid = $_GET['event'];
}
$eventrecord = readDatabaseRecord ('events', $eventid);
if ($_SERVER ["REQUEST_METHOD"] == "POST" ) { 
   
   if (isset($_POST ['removeflag'])) {
       if ($_POST['removeflag']  === "REMOVE") { 
           //Remove this event from  event array
          
           $dateeventmap = removeFromMap ("data/date-event-map.txt", "", $eventid);
           $weeklyeventmap = removeFromMap ("data/weekly-event-map.txt", "", $eventid);
           $monthlyeventmap = removeFromMap ("data/monthly-event-map.txt", "", $eventid);
           $yearlyeventmap = removeFromMap ("data/yearly-event-map.txt", "", $eventid);
           moveToTrash ("events", $eventid);
                     
      }        
   }
}

?>
<a href = 'index.php?page=home'>&larr; Return</a><br>
<div class = 'content-column'> 
    <?php
    echo "<h2>Remove Event: <span class = 'display-title'>" . $eventrecord['title'] . "</span></h3><br><br>";
    
    if ( file_exists ("data/events/" . $eventid . ".txt")) {
       
        echo "<form method = 'post' action = 'index.php?page=remove-event&event=" . $eventid . "'>";  

            echo "Remove " .   $eventid . " <br><br>";

            echo " NO: <input type = 'radio' name = 'removeflag' value = '' checked /> ";
            echo "YES: <input type = 'radio' name = 'removeflag' value = 'REMOVE' />";
        
            echo "<br><br><input class = 'submitbutton' type = 'submit' name = 'submit' value='Remove'/>";
        
       echo "</form> ";  
    
    }
    else {
        echo "<h3>This event has been removed</h3>";
    }
   
    
    
    ?>

