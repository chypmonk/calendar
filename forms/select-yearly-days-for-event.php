<div class = 'date-selection-box'>

    <?php
    echo "<form method='post' action='index.php?page=add-update-event&event=" .  $eventid .  "'> ";
  
   $datearray = selectMapEntries ($yearlyeventmap, "", $eventid);   
    
  
   for ($m = 0; $m < 12; $m++) { 
       //echo "<div class = 'half-column'>";
       echo "<br><br><b>" .$montharray2[$m] . "</b><br> ";
       $month = str_pad($m + 1 ,2,0 , STR_PAD_LEFT); 
       //Set year to 2020 to allow for leap year
       $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, '2020');      
      
       
       echo "<div>";
       for ($d = 1; $d <= $daysinmonth; $d++) {  
           $day = str_pad($d ,2,0 , STR_PAD_LEFT);           
           echo "</div><div class = 'yearly-date-cell'>";
           
                          
                   
           if (in_array($month ."-" .  $day, $datearray)  ) {
               echo  "<input  id = '" . $month . "-" . $day . "'  type = 'checkbox' name = 'yearly[]' value = '" . $month . "-" . $day . "'   checked />";
           }
           else {
              echo  "<input  id = '" . $month . "-" . $day . "'  type = 'checkbox' name = 'yearly[]' value = '" . $month . "-" . $day . "'  />";
           }
           echo "<br><label for = '" . $month . "-" . $day . "'>" . $d . "</label>";
          
       }
       echo "</div>";
   }
    
   ?>
<br><br>
   <input class = 'submitbutton' type = 'submit' name  = 'submit-yearly-dates' value = 'Save' />

</form>
</div>
