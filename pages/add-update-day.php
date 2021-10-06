<?php
if (! file_exists ('data/calendar/' . $year)) {
    mkdir ('data/calendar/' . $year);
}
if (! file_exists ('data/calendar/' . $year . "/" . $month)) {           
     mkdir ("data/calendar/" . $year . "/" . $month);  
}

    
$filename = "data/calendar/" . $year . "/" . $month . "/" . $day . ".txt";
$dayrecord = readDatabaseRecordFile ("days", $filename);

if ($_SERVER ["REQUEST_METHOD"] == "POST" ) { 
    $error = checkForDelimiters($_POST);
    if ($error === false) {
    
         if (isset ($_POST['scheduletext'])) {
            //Update day record
            $dayrecord['schedule-md'] = $_POST['scheduletext'];

             writeDatabaseRecordFile ($dayrecord, $filename);  
        }    

        //Remove selected events from date-event map
        if (isset ($_POST['events-to-remove'])) {          
            $eventarray = $_POST['events-to-remove'];
            foreach ($eventarray as $item) {
                $dateeventmap = removeFromMap ("data/date-event-map.txt", $date, $item) ;
            }
        }

        //Create new date-event-map entries for selected events       
        if (isset ($_POST['events-to-add'])) {       
            $eventarray = $_POST['events-to-add'];    
            foreach ($eventarray as $item) { 
                $dateeventmap = addMapEntry ("data/date-event-map.txt", $date, $item) ; 
            }  
        } 
        echo "<h3>Journal has been updated</h3>";   
    }
}

echo "<h3>Edit: " . date("l", mktime(0,0,0, $month , $day, $year)) ;
echo "   " . $monthname2 . "  " . $day . ",   " . $year . "</h3>";

?>
<div class = 'two-thirds-column'>
   
   <?php  
    echo "<form method = 'post' action = 'index.php?page=add-update-day&year=" . $year . "&month=" . $month . "&day=" . $day . "&dow=" . $dow . "&count=" . $count . "'>";

    echo "<h3>Schedule</h3>";
    echo "<textarea name = 'scheduletext' rows = '5'  cols = '80' >" . $dayrecord['schedule-md'] . "</textarea><br><br>"; 
    
    echo "<h2>Events</h2>";
    include ("inc/all-events-for-day.php");
    echo "<br>";
    //Display each event with a checkbox for remove
    foreach ($eventarray as $eventid) {
      
        $eventrecord = readDatabaseRecord ("events", $eventid);
        
        echo "<div class = 'event-cell' >";   
        echo "<div class = 'half-column'>";
        if ($eventrecord['schedule-type'] === 'dates') {
            echo "<input type = 'checkbox' name = 'events-to-remove[]' value = '" . $eventid . "' />Remove<br>";
        }
        
        echo "<a href = 'index.php?page=single-event-page&event="  . $eventid . "'>" . $eventrecord['title'] . "</br>"; 

        if ($eventrecord['image'] !== "") {
            echo "<img src = '" . $eventrecord['image'] . "' alt = '" . $eventrecord['title'] ."' /><br>";
        }  

        if ($eventrecord ['description'] !== "" ) {        
            echo  $eventrecord['description'] . "<br>";           
            echo  $eventrecord['time']  . "<br>";
            echo  $eventrecord['cost'] . "<br>";

       }
        echo "</div><div class = 'half-column'>"; 
        include ("inc/all-dates-for-event.php");
        echo "</a></div></div>";
    }
    
    echo "<input class = 'submitbutton' type = 'submit' value='Update'>";
    echo "</form>";
    ?>
    
<br><br>
</div><div class = 'third-column centered'> 
    
    
    <?php
    echo "<a class = 'adminbutton' href = 'index.php?page=home'>&larr; Return</a><br>";
     echo "<a class = 'adminbutton'  href = 'index.php?page=single-day-page&year=" .$year . "&month=" . $month . "&day=" . $day . "&dow=" . $dow . "&count=" . $count . "'>View Day</a><br>";
    ?>
       

    <div class = 'dropdownwrap2 '>
        <button class = 'toggle-banner2'  id = 'all-events'  onclick= 'accordionToggle2(this.id)'>Select  Events &nbsp;&#9662;</button>   
        <div id ='all-events-content' class = 'dropdowncontent2'  style =  'display: none;  '  >

            <?php
            echo "<form method = 'post' action = 'index.php?page=add-update-day&year=" . $year . "&month=" . $month . "&day=" . $day . "&dow=" . $dow . "&count=" . $count ."'>";


            $array1 = scandir ("data/events");
            foreach ($array1 as $item) {
                if ($item !== "." && $item !== "..") {
                   $id = str_replace (".txt", "", $item);
                   $record = readDatabaseRecord ("events", $id);   
                   if ($record['schedule-type'] === 'dates') {
                        $entryfoundflag = checkForEntry($dateeventmap, $date, $id);      
                      
                        if ($entryfoundflag === true) {
                            echo "<input type = 'checkbox' name = 'events-to-add[]' value = '" . $id . "' checked/><a href = 'index.php?page=add-update-event&event=" . $id . "'>" . $record['title'] . "</a></br><br>";  
                        }
                        else {
                            echo "<input type = 'checkbox' name = 'events-to-add[]' value = '" . $id . "' /><a href = 'index.php?page=add-update-event&event=" . $id . "'>" . $record['title'] .  "</a></br><br>";  
                        }
                   }
                    else {
                        echo "<a href = 'index.php?page=add-update-event&event=" . $id . "'>" . $record['title'] . "(" . $record['schedule-type'] .  ")</a><br><br>";
                    }
                }
            }
            echo "<br><br>";
            echo "<input class = 'submitbutton' type = 'submit' name = 'submit-events-for-day' value = 'Update' /><br>";
            echo " </form>";
            ?>
        </div>
    </div>
</div>

       




