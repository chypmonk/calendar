<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 

?>
<div class = 'dropdownwrap '>
    <button class = 'toggle-banner2'  id = 'all-events'  onclick= 'accordionToggle2(this.id)'>All  Events &nbsp;&#9662;</button>   
    <div id ='all-events-content' class = 'dropdowncontent'  style =  'display: none;  '  >
        
        <?php
        echo "<form method = 'post' action = 'index.php?page=admin-single-day&year=" . $year . "&month=" . $month . "&day=" . $day ."'>";

        echo "<input type = 'text'  name = 'date-for-events' value = '" . $date . "' />";
        $array1 = scandir ("data/events");
        foreach ($array1 as $item) {
            if ($item !== "." && $item !== "..") {
               $id = str_replace (".txt", "", $item);
               $record = readDatabaseRecord ("events", $id);

               echo "<input type = 'checkbox' name = 'eventarray[]' value = '" . $id . "' />" . $id . "</br>";  
            }
        }
        echo "<br><br>";
        echo "<input type = 'submit' name = 'submit-events-for-day' value = 'Save' />";
        echo " </form>";
        ?>
    </div>
</div>

