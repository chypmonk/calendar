<?php

$month = date ("m");
$day = date ("d");
$year = date ("Y");
$dow = $count = "";

if (isset ($_GET["year"])){        
    $year =   filter_input(INPUT_GET, "year", FILTER_SANITIZE_STRING) ;  
} 

if (isset ($_GET["month"])){   
    $month = filter_input(INPUT_GET, "month", FILTER_SANITIZE_STRING) ;  
} 

if (isset ($_GET["day"])){   
    $day = filter_input(INPUT_GET, "day", FILTER_SANITIZE_STRING) ;  
} 

if (isset( $_GET['dow']) ) {
     $dow = filter_input(INPUT_GET, "dow", FILTER_SANITIZE_STRING) ;  
}

if (isset( $_GET['count']) ) {
     $count = filter_input(INPUT_GET, "count", FILTER_SANITIZE_STRING) ;  
}

$date = $year . "-" . $month . "-" . $day;


//Find next and previous years
$yearnum = intval ($year);

$prevyearnum = ($yearnum - 1);
$prevyear = strval ($prevyearnum);

$nextyearnum = ($yearnum + 1);
$nextyear = strval ($nextyearnum);

//Find next and previous months
$monthnum = intval ($month);

$prevmonth = $nextmonth = "";

if ($month === "01") {  
    $prevmonth = "12";     
}
else {    
    $prevmonthnum = $monthnum - 1;
    $prevmonth = str_pad ($prevmonthnum ,2,0 , STR_PAD_LEFT); 
}

if ($month === "12") {
    $nextmonth = "01";     
}
else {
    $nextmonthnum = $monthnum + 1;
    $nextmonth = str_pad($nextmonthnum,2,0 , STR_PAD_LEFT); 
   
}
$monthname = $monthname2 = "";
if (array_key_exists ($monthnum - 1, $montharray)) {
    $monthname = $montharray[$monthnum - 1];
}
if (array_key_exists ($monthnum - 1, $montharray2)) {
    $monthname2 = $montharray2[$monthnum - 1];
}

?>