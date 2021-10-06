<?php 
if ($_SERVER ["REQUEST_METHOD"] == "POST" ) { 
   if (isset ($_POST['username'])) {
       file_put_contents ("data/username.txt", $_POST['username']);
   }
   if (isset ($_POST['password'])) {
       file_put_contents ("data/password.txt", $_POST['password']);
   }
}
$dayofweek = 0;   
$monthnamearray = array_flip ($montharray);

$monthlycounts = array();
for ($c = 0; $c <= 6; $c++) {
    $monthlycounts[$c] = 0;
}
?>

<div class = 'full-column'>   

    <?php
    //Show current month and year with left and right arrows

    echo "<div class = 'monthyear'>";

    if ($month === '01') {
        echo "<a class = 'nav-left' href = 'index.php?page=home&year=" . $prevyear . "&month=" . $prevmonth . "'>&larr;</a>"; 
    }
    else {
         echo "<a class = 'nav-left' href = 'index.php?page=home&year=" . $year . "&month=" . $prevmonth . "'>&larr;</a>";    
    }

    if (array_key_exists ($monthnum - 1, $montharray2)) {
        echo  "<div class = 'monthyearinner'>" . $montharray2[$monthnum -1] . " " . $year . "</div>" ;
    }

    if ($month === '12') {
        echo "<a class = 'nav-right' href = 'index.php?page=home&year=" . $nextyear . "&month=" . $nextmonth . "'>&rarr;</a>"; 
    }
    else {
        echo "<a class = 'nav-right' href = 'index.php?page=home&year=" . $year . "&month=" . $nextmonth . "'>&rarr;</a>";
    }
    //Closes 'month-year'
    echo "</div><br>";

    //Create grid of cells for each day of month      
    echo "<div class = 'calendar-grid'>";     


    //Day-of-week headings
    $dowarray = array ("Sun", "Mon", "Tues", "Wed", "Thurs", "Fri", "Sat");    
    foreach ($dowarray as $item) {       
        echo "<div class = 'dow-cell'>" . $item . "</div>";
    }
   

    //Determine number of days in month 
    $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    //Fill in blank days at beginning of month
    $firstdow =  date("w", mktime(0,0,0,$month,1,$year));          

    echo "<br><div>";   
    for ($i = 0; $i < $firstdow; $i++) {        
        echo "</div><div class = 'calendar-cell '>";  
    }   

    //FILL IN REST OF CALENDAR   
    for ($x = 1; $x <= $daysinmonth ; $x++) {

        $day = str_pad($x,2,0 , STR_PAD_LEFT);  
        $dow =  date("w", mktime(0,0,0,$month,$x,$year));          
        $count = $monthlycounts[$dow];

        //Create a cell for each day with current day hightlighted              
        if ($x == date("d") && $month == date("m") && $year == date("Y")) {       
            echo "</div><div class = 'calendar-cell highlight'>";
        }
        else {     
            echo "</div><div class = 'calendar-cell '>";  
        }

        //Show day of month number and link to single day page  
        echo "<a class = 'day-number' href = 'index.php?page=single-day-page&year=" .$year . "&month=" . $month . "&day=" . $day . "&dow=" . $dow . "&count=" . $count . "'>" .  $x . "</a>";


        //Show schedule for this date  
        $filename = "data/calendar/" . $year . "/" . $month . "/" . $day . ".txt";
        $dayrecord = readDatabaseRecordFile ("days", $filename);


        if ($dayrecord ['schedule-md'] !== "") {
            echo "<div class = 'event-cell'>";
            echo  $dayrecord['schedule-md'] ; 
            echo "</div>";
        }  

        //collect all events for this day
        include ("inc/all-events-for-day.php");

        foreach ($eventarray as $item) {
            $eventid = $item;
            $eventrecord = readDatabaseRecord ("events", $eventid);

            echo "<div class = 'event-cell' >";   
            echo "<a href = 'index.php?page=single-event-page&event=" . $eventid . "'>" . $eventrecord['title'] ;        
            echo "</a></div>";
        }
        //Increment a counter for each  day of week
         $monthlycounts [$dow] ++;
    }

    //Fill in remaining cells
    for ($i = $dow; $i < 6; $i++) {  
         echo "</div><div class = 'calendar-cell '>";   
    }    

    //Closes 'calendar-cell' div and calendar grid
    echo "</div></div>";
    ?> 
</div><br>
<a class =  'adminbutton' href = 'index.php?page=manage'>Manage</a>
 
       