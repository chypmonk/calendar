<?php
//Copyright (c) 2020, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
     
echo "<div class = 'date-selection-box'>";

if ($eventid !== "" && file_exists ("data/events/" . $eventid . ".txt")) {   
    
    $datearray = selectMapEntries ($dateeventmap, "", $eventid);

    echo "<a class = 'nav-left' href = 'index.php?page=add-update-event&event=" . $eventid . "&year=" . $prevyear . "&flag=2'>&larr;</a>";  

    echo "&nbsp;" . $year . "&nbsp;"; 

    echo "<a class = 'nav-right' href = 'index.php?page=add-update-event&event=" . $eventid . "&year=" . $nextyear . "&flag=2'><img src = 'data/images/rarrow.png' alt = 'right-arrow' /></a>";
    ?>
    <br><br>
    <form method='post' action='index.php?page=add-update-event&event=<?php echo $eventid ;?>&year=<?php echo $year; ?>'> 
    

       <?php
        for ($m = 0; $m <= 11; $m++) {
           
            $month = str_pad($m + 1 ,2,0 , STR_PAD_LEFT); 

            $monthname = $montharray2[$m];
            $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $m+1, $year);

            //Month Block
            echo "<div class = 'half-column '>";

            //MONTH HEADER
            echo "<b>" . $monthname . " " . $year . "</b><br>";

            //WEEKDAY NAME LABELS   
            $dayofweekarray = array ("Sun","Mon" ,"Tue", "Wed", "Thu", "Fri", "Sat");      
            foreach ($dayofweekarray as $item) {   
                echo "<div class = 'date-selection-dow-cell'>" . $item . "</div>";
            }
            //FILL IN BLANK DAYS AT BEGINNING OF MONTH
            echo "<div>";
            $dayofweek =  date("w", mktime(0,0,0,$month,1,$year));              
            for ($i = 0; $i < $dayofweek; $i++) {                
                echo "</div><div class =  'date-selection-day-cell'>&nbsp;&nbsp;&nbsp;";
            }

            $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            for ($x = 1; $x <= $daysinmonth ; $x++) {
                echo "</div><div class = 'date-selection-day-cell'>";  

                $xpadded = str_pad($x,2,0 , STR_PAD_LEFT); 
                $dayofweek =  date("w", mktime(0,0,0,$month,$x,$year)); 

             
                //Check date-event map for this event
                 echo "<label for '" . $xpadded  . "'>" . $x . "</label>";
                if (in_array ($year . "-" . $month . "-" . $xpadded, $datearray)) {
                   
                    echo "<br><input id = '" . $xpadded  . "' type = 'checkbox' name = 'datearray[]' value  = '" .$year . "-" . $month . "-" . $xpadded  .    "' checked  >" ;               
                }
                else {
                    echo "<br><input id = '" . $xpadded  . "' type = 'checkbox' name = 'datearray[]' value  = '" .$year . "-" . $month . "-" . $xpadded  .    "'  >" ;  
                } 
            } 
            //Create emtpy cells at  end of calendar 

            for ($i = $dayofweek; $i < 6; $i++) {  
                 echo "</div><div class = 'date-selection-day-cell '>";   
            }  

            echo "</div><br><br></div>";  
       }
      
        echo "<br><input class = 'submitbutton' type = 'submit' name = 'submit-event-dates' value='Select'/>  ";
    
        echo "<h3> Select day of week in range</h3>";
        echo "<br><label for = 'start-date'>Start Date: &nbsp; </label>";       
        echo "<input id = 'start-date' type = 'date' name = 'start-date' />";
        echo "<br><br><label for = 'end-date'>End Date:</label> &nbsp; &nbsp; ";    
        echo "<input id = 'end-date' type = 'date' name = 'end-date' />";
        echo "<br><br>";   

        for ($x = 0; $x < 7; $x++) {  
            echo   "<input id = '" . $dayofweekarray[$x] . "' type = 'checkbox' name = 'dowarray[]' value = '" . $x . "' />";
            echo "<label for= " . $dayofweekarray[$x] . "'>"  . $dayofweekarray[$x] . "&nbsp;&nbsp;</label>";         
        
        } 
        ?>
        <br><br>
        <input class = 'submitbutton' type = 'submit' name = 'submit-dow-dates' value='Select'/>  

    </form>
    <?php
    
    
} 
echo "</div>";
    ?>
   