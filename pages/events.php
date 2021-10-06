<a href = 'index.php?page=home'>&larr; Return</a><br>

<h2>Events</h2>
<div class = 'content-column'>
    <?php   
    if (file_exists ("data/events")) {
        $array1 = scandir ("data/events");           
        foreach ($array1 as $item1) {  
           
             if ($item1 !== '.' &&  $item1 !== "..") {                
                 $eventid = str_replace (".txt", "", $item1); 

                 echo "<a href = 'index.php?page=add-update-event&event=" . $eventid . "'>" . ucwords (str_replace ("-", " ", $eventid)) . "</a><br>"; 
                
             }
        }
    }
    ?>
</div><div class = 'sidebar-column'>
    <a class = 'adminbutton' href = 'index.php?page=add-update-event'>Add Event</a>
    <a class = 'adminbutton' href = 'index.php?page=add-event-category'>New Event Category</a>
</div>
        