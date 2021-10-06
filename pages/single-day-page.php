<?php


echo "<div class = 'content-column'>";
$searchterm = "";
if (isset ($_GET['term'] )) {    
    $searchterm = $_GET['term'];
}

$filename = "data/calendar/" . $year . "/" . $month . "/" . $day . ".txt";
$dayrecord = readDatabaseRecordFile ("days", $filename);


echo "<h3>" . date("l", mktime(0,0,0, $month , $day, $year)) ;
echo "   " . $monthname2 . "  " . $day . ",   " . $year . "</h3>";

//Show dayrecord schedule for day
echo "<h3>Schedule</h3>";
echo "<div class = 'event-box'>";

$text = $dayrecord ['schedule-md'];  ;
$text = str_replace ($searchterm, "<span class = 'highlight'>" . $searchterm  . "</span>", $text );
echo $text;
echo "</div>";

echo "<br>";


//SHow events for day
echo "<h3>Events</h3>";
include ("inc/all-events-for-day.php");
include ("inc/display-events.php");

echo "</div><div class = 'sidebar-column'>";

echo "<a class = 'adminbutton' href = 'index.php?page=home'>&larr; Return</a><br>";
echo "<a class = 'adminbutton'  href = 'index.php?page=add-update-day&year=" .$year . "&month=" . $month . "&day=" . $day . "&dow=" . $dow . "&count=" . $count . "'>Edit Day</a><br>";
    


echo "</div>";


?>