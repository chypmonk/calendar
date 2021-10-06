<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 

if ($eventid !== "" && file_exists ("data/events/" . $eventid . ".txt")) {
    $datearray = selectMapEntries ($weeklyeventmap, "", $eventid);   

  
    echo "<form method='post' action='index.php?page=add-update-event&event=" .  $eventid .  "'>"; 
    for ($d = 0; $d < 7; $d++) {
        
         if (in_array($d,  $datearray)  ) {
              echo "<input id = '" .$d . "' type = 'checkbox' name = 'weekly[]' value = '" . $d . "'   checked />";
         }
         else {
            echo "<input  id = '" .$d . "' type = 'checkbox' name = 'weekly[]' value = '" . $d  . "'/>";
         } 
         if (array_key_exists ($d, $dayofweekarray)) {
             echo "<label for='" . $d . "'>" . $dayofweekarray[$d] . "</label>";
         }
        echo " &nbsp; ";         
     } 
    echo "<br><input type = 'submit' class = 'submitbutton' name = 'submit-weekly-dates' value = 'Save' />";
    echo "</form>";
  
}
?>
  
      