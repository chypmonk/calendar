<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
?>

<form method='post' action='index.php?page=add-update-event&event=<?php echo $eventid ;?>'>
    
    <?php         
    //Name
    
    if ( $eventid === ""){
       echo "<label for = 'title-textarea'>Event Title: </label><br>";
       echo "<textarea id = 'title-textarea' name = 'title' type = 'textarea'  rows='1' cols='50' >" . $eventrecord['title'] . "</textarea><br>";         
    }
    
    echo "<br><b>Category: </b><br>";      
    if ($eventrecord['category'] === "") {
        $eventrecord['category'] = 'event'; 
    }
    $array1 = readArray ("data/event-categories.txt");    
    foreach ($array1 as $item) {         
        if ($eventrecord ['category'] === $item) {             
            echo "<input id = '". $item . "-id' type = 'radio' name = 'category'  value = '" . $item . "' checked />"; 
        }
        else {              
            echo "<input id = '". $item . "-id'  type = 'radio' name = 'category'  value = '" . $item . "'  />"; 
        }
        echo "<label for = '" . $item . "-id'>" . $item . " &nbsp; </label>";
        
    }
    echo "<br><br><b>Schedule Type: </b><br>";  
    if ($eventrecord['schedule-type'] === "") {
        $eventrecord['schedule-type'] = 'dates'; 
    }
    $array1 = array ('dates', 'weekly', 'monthly', 'yearly');    
    foreach ($array1 as $item) {         
        if ($eventrecord ['schedule-type'] === $item) {             
            echo "<input id = '" . $item  . "' type = 'radio' name = 'schedule-type'  value = '" . $item . "' checked />" ; 
        }
        else {              
            echo "<input  id = '" . $item . "' type = 'radio' name = 'schedule-type'  value = '" . $item . "'  />";
        }
        echo "<label for = '"  . $item . "' >" . ucwords($item) . " &nbsp; </label>";
    }    
    
    //Description for Calendar
    echo "<br><br><label for='brief-description'>Brief Description</label><br>";
    echo " <textarea id = 'brief-description'  name = 'description' type = 'textarea'  rows='1' cols='80' >" . $eventrecord['description'] . "</textarea><br>";    
    
    //Detailed Description
     echo "<br><label for='detailed-description'>Detailed Description</label><br>";    
    echo "<textarea id = 'detailed-description' name = 'md-content' type = 'textarea'  rows='5' cols='80' >" . $eventrecord['md-content'] . "</textarea><br>"; 
    
    //Time
    echo "<br><label for = 'time'>Time</label><br>";
    echo "<input  id = 'time' type = 'text' name = 'time' value = '" . $eventrecord['time'] . "'/><br><br>";

    //Cost
    echo "<br><label for = 'cost'>Cost</label><br>";
    echo "<input type = 'text' name = 'cost' value = '" . $eventrecord['cost'] . "'/><br>";    

    ?>


    <br><input class = 'submitbutton' type = 'submit' name = 'submit-event-info' value='Save'/> 
</form> 
    
<?php
 if ($eventid !== "") {       
       include ("inc/all-dates-for-event.php");   
     
    }   
?>

 

