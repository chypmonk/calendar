<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
?>

 
<div class = 'content-column'> 
    
<?php    
    
if (isset ($_GET['event'])) {
    $eventid = $_GET['event'];
}

echo "Remove all dates for: <b>" . $eventid . "</b><br><br>";
    
if ($_SERVER ["REQUEST_METHOD"] == "POST" ) { 
   
   if (isset($_POST ['removeflag'])) {
       if ($_POST['removeflag']  === "REMOVE") { 
           removeFromMap("data/date-event-map.txt", "", $eventid);

           removeFromMap ("data/weekly-event-map.txt", "", $eventid); 

           removeFromMap ("data/monthly-event-map.txt", "", $eventid); 

           removeFromMap ("data/yearly-event-map.txt", "", $eventid); 
                 
           echo "All dates have been removed for this event<br><br>";    
        }        
   }
}
if (file_exists ("data/events/" . $eventid . ".txt")) {   
        
    echo "<form method = 'post' action = 'index.php?page=remove-dates&event=" . $eventid . "'>"; 

        echo " NO: <input type = 'radio' name = 'removeflag' value = '' checked /> ";
        echo "YES: <input type = 'radio' name = 'removeflag' value = 'REMOVE' />";

        echo "<br><br><input class = 'submitbutton' type = 'submit' name = 'submit' value='Remove'/>";

   echo "</form> ";  

}
    ?>
</div><div class = 'sidebar-column'>
    <?php
   echo "<a class = 'adminbutton' href = 'index.php?page=add-update-event&event=" . $eventid . "'>Manage Calendar</a>";
    ?>
</div>
