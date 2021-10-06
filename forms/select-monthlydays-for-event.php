<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
 

if ($eventid !== "" && file_exists ("data/events/" . $eventid . ".txt")) {
    $datearray = selectMapEntries ($monthlyeventmap, "", $eventid);
    $numarray = array ('1st', '2nd', '3rd', '4th');
    $dowarray = array ('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat')  ;        
  
    echo "<form method='post' action='index.php?page=add-update-event&event=" .  $eventid .  "'>"; 
    
    echo "<div class = 'box'>";
    //List 1st, 2nd, 3rd, 4th labels
    echo " &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 1st &nbsp;  2nd &nbsp;  3rd  &nbsp;4th";
    
    
    foreach ($dowarray as $id1 => $item1) {
         // Show day of week followed by 4 check boxes
         echo "<br><div class = 'dow-cell'>" . $dowarray[$id1] . ":  </div>";
         foreach ($numarray as $id2 => $item2) {
             
             if (in_array($id1 . $id2, $datearray)  ) {
                  echo "<input  type = 'checkbox' name = 'monthly[]' value = '" . $id1 . $id2 . "'   checked />";
             }
             else {
                echo "<input    type = 'checkbox' name = 'monthly[]' value = '" . $id1 . $id2 . "'/>";
             }
             echo "&nbsp; &nbsp;";

         }
     } 
    echo "</div>";
    echo "<br>";
    echo "<input class = 'submitbutton' type = 'submit' name = 'submit-monthly-dates' value='Select'/>  ";

    echo "</form>";
    echo "</div>";
}

?>

