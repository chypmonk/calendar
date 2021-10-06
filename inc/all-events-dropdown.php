<div class = 'dropdownwrap2 '>
    <button class = 'toggle-banner2'  id = 'all-events'  onclick= 'accordionToggle2(this.id)'>All Events &nbsp;&#9662;</button>   
    <div id ='all-events-content' class = 'dropdowncontent'  style =  'display: none;  '  >
       
        <?php
       
        
        $array1 = scandir ("data/events");
        foreach ($array1 as $item) {
            if ($item !== "." && $item !== "..") {
               $id = str_replace (".txt", "", $item);
               $record = readDatabaseRecord ("events", $id);
                
                echo "<a href = 'index.php?page=add-update-event&event=" . $id . "'>" . ucwords (str_replace ("-", " ", $id)) . "</a><br>"; 

            }
        }
        ?>
            
        
    </div>
</div>
