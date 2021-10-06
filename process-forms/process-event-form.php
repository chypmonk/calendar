 <?php
$error = checkForDelimiters($_POST);
if ($error === false) {
    foreach ($dbtables["events"] as $label) {         
        if (isset ($_POST[$label])) {       
            $eventrecord [$label] =  trim($_POST[$label]);           
        }
    }  

    if (! isset ($_POST['title'])) {
        $error = true;
        echo "<div class = 'error'>Missing Title</div><br>";        
    }
    
    $eventrecord['html-content'] = $eventrecord['md-content'];
    if ($error === false) {

        if ($eventid === "" ) {
            $eventid = createRecordKey ( "events", $eventrecord['title']);
        }  

        if ($eventid !== "") {
             writeDatabaseRecord ("events", $eventrecord, $eventid); 
        }
    }
}

?>
