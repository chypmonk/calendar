<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 

$day = "";
if (isset ($_GET['day'])) {
    $day = $_GET['day'];    
}
$daypadded = str_pad($day,2,0 , STR_PAD_LEFT); 

$year = "";
if (isset ($_GET['year'])) {
    $year = $_GET['year'];
}

$month = "";
if (isset ($_GET['month'])) {
    $month = $_GET['month'];
}
$selecteddate = $year . "-" . $month . "-" . $daypadded;

$itemarray = selectMapEntries ($dateeventmap, $selecteddate, "");

if ($_SERVER ["REQUEST_METHOD"] == "POST" ) { 
    
    $dateeventmap =  removeFromMap ("data/maps/date-event-map.txt", $selecteddate, "");
    
    if (isset ($_POST['selecteditems'])) {       
        $selecteditems = $_POST['selecteditems'];      
        foreach ($selecteditems as $item) {            
           $dateeventmap =  addMapEntry ("data/maps/date-event-map.txt", $selecteddate, $item);            
        }
    }
    $itemarray = selectMapEntries ($map, $selecteddate, "");
}



?>
<div class = 'admin-content-column'>
    <h3>Select an Event, Class or Announcement</h3>
    <h3>Date: <?php echo $year . "-" . $month . "-" . $day; ?></h3>
    <br><br>
    <form method = 'post' action = 'admin.php?adminpage=add-update-eventselect-events&year=<?php echo $year; ?>&month=<?php echo $month;?>&day=<?php echo $daypadded; ?>' >
    
    <?php
  
    $array1 = scandir ("data/events");
    foreach ($array1 as $item1) {

        if ($item1 !== "." && $item1 !== "..") {
           $eventid = str_replace (".txt", "", $item1);  

           $eventrecord = readDatabaseRecord ("events", $eventid);
           if (in_array ($eventid, $itemarray)) {
            
               echo "<input type = 'checkbox' name = 'selecteditems[]' value = '" . $eventid . "' checked />";
           }
            else {
               
               echo "<input type = 'checkbox' name = 'selecteditems[]' value = '" . $eventid . "' />";
            }
           echo $eventrecord['title'] . "<br>" ;             
          
        }
    }
    ?>
        <input class = 'submitbutton' type = 'submit' name = 'submit' value = 'Submit' />
    </form>

</div><div class = 'admin-sidebar-column'>
    <br><a class = 'adminbutton' href = 'index.php?page=calendar-dashboard&event=<?php echo $eventid; ?>'> Control Panel</a>   
   
</div>
