<?php
foreach ($eventarray as $item) {
    $eventid = $item;
    $eventrecord = readDatabaseRecord ("events", $eventid);

    echo "<div class = 'event-box' >";   
    echo "<div class = 'half-column'>";
    echo "<a href = 'event/"  . $eventid . "'>" . $eventrecord['title'] . "</a>" ; 

    
    if ($eventrecord ['description'] !== "" ) {        
        echo "<br>" .  $eventrecord['description'] ;           
        echo  $eventrecord['time']  . "<br>";
        echo  $eventrecord['cost'] . "<br>";

   }
    echo "</div><div class = 'half-column'>"; 
    include ("inc/all-dates-for-event.php");
    echo "</div></div>";
} 
?>
