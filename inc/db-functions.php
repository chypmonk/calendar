<?php

function checkForDelimiters ($array) {
    $error = false;
    global $dl1, $dl2;    
    foreach ($array as $item) {
        if (! is_array($item)) {
            if (strpos ($item, $dl1) !== false || strpos($item, $dl2) !== false) {
                echo "<div class = 'error'>Invalid Characters - cannot include " . $dl1 . " or " . $dl2  . "</div>";
                $error = true;
            }
        }
    }
    return $error;
}

function createRecordKey ($table, $newname) {
   
   $newkey = "";

    if ($newname === '') {
        echo "<div class = 'error'>Missing  Name</div>";  
    }
    else {
        if (strlen ($newname) > 50) {
           echo "<div class = 'error'>Title must be less than 50 characters</div>";
        }
        else {   
            $newkey  = str_replace(" ", "-", $newname);  
            $newkey = strtolower ($newkey);
            $newkey = html_entity_decode($newkey, ENT_QUOTES); 
            $newkey = preg_replace('/[^A-Za-z0-9-]/', '', $newkey); 
            $newkey = preg_replace('/-+/', '-', $newkey);
            if ($newkey === "") {
                echo "<div class = 'error'>Invalid Record Name</div>";  
            }    
            else {  
                // CHECK THAT THIS RECORD DOESN'T ALREADY EXIST   
                $filename = "data/" . $table . "/" . $newkey . ".txt";  
                if (file_exists ($filename)) {
                    echo "<div class = 'error'>'" . $table . "' record with this name already exists</div>";
                    $newkey = "";
                }            
            }
        }
    }   
    return $newkey;
}

function  createKey ($name) {
    $newname = "";
    if ($name !== "") {            
        $newname = str_replace (" " , "-", $name);
        $newname = html_entity_decode($newname, ENT_QUOTES);        
        $newname = strtolower ($newname);
        $newname = preg_replace('/[^A-Za-z0-9-]/', '', $newname); 
        $newname = preg_replace('/-+/', '-', $newname);
        if ($newname === "") {
            echo "<div class = 'error'>Invalid name</div>";
        } 
    }    
    return $newname;        
}
function initializeRecord($table) {
    //read a record in a multi-record table
    global $dbtables;
    global $dl1, $dl2;
  
    //INITIALIZE TABLE TO EMPTY
    $record = array();
    foreach ($dbtables[$table] as $label) {
       $record[$label] = "";
    } 
    return $record;
}

 function readDatabaseRecord($table, $recordid) {
   //read a record in a multi-record table
    global $dbtables;
    global $dl1, $dl2;
  
    //INITIALIZE TABLE TO EMPTY
    $record = array();
    foreach ($dbtables[$table] as $label) {
       $record[$label] = "";
    }   
     
    $filename = "data/" . $table . "/" . $recordid . ".txt";    
  
    if (file_exists($filename)) {  

        $string = file_get_contents ($filename);   
        $array1= explode ($dl1, $string);
        foreach ($dbtables[$table] as $id => $label) {
            $record[$label] = "";  
            if (array_key_exists ($id, $array1)) {
                $record [$label] = $array1[$id]; 
            }          
        }       
    } 
    
     return $record;
} 

function readDatabaseRecordFile($table, $filename) {
   //read a record in a multi-record table
    global $dbtables;
    global $dl1, $dl2;
  
    //INITIALIZE TABLE TO EMPTY
    $record = array();
    foreach ($dbtables[$table] as $label) {
       $record[$label] = "";
    } 
    
    if (file_exists($filename)) {  

        $string = file_get_contents ($filename);   
       
        $array1= explode ($dl1, $string);
        foreach ($dbtables[$table] as $id => $label) {
            $record[$label] = "";  
            if (array_key_exists ($id, $array1)) {
                $record [$label] = $array1[$id]; 
            }          
        }       
    } 
     return $record;
}   

function writeDatabaseRecord ($table, $record, $recordid) { 
   
    global $dl1, $dl2;
    $filename = "";          
    $filename = "data/" . $table . "/" . $recordid . ".txt";   
    $newstring = implode ($dl1, $record);     
    file_put_contents ($filename, $newstring);      
}

function writeDatabaseRecordFile ($record, $filename) {  
   
    global $dl1, $dl2;    
    $newstring = implode ($dl1, $record);     
    file_put_contents ($filename, $newstring);      
}


function addMapEntry ($file, $key1, $key2) {
    global $dl1,  $dl2;      
    
    $string = file_get_contents ($file);
    $array1 = explode ($dl1, $string);
    
    $newentry = $key1 . $dl2 . $key2 . $dl2 . "\n";
    array_push ($array1, $newentry);
    $array1 =  array_unique ($array1);       
    sort ($array1);
    $string = implode ($dl1, $array1);
    file_put_contents ($file, $string);
    
    return $array1;
}
function removeFromMap ($map, $key0, $key1) {
  
    global $dl1,  $dl2;   
    $array1 = array();
    $mapstring = file_get_contents ($map);   
  
    if ($key0 === "" && $key1 === "") {
        file_put_contents ($map, "");
    }
    else {    
        $array1 = explode ($dl1, $mapstring);
        foreach ($array1 as $id => $item1) {
            $array2 = explode ($dl2, $item1);          
            if (array_key_exists (0, $array2) && array_key_exists (1, $array2)) {               
            
                if ($key0 !== "" && $key1 !== "") {
                    if ( $array2[0] === $key0  && $array2[1] === $key1 ) { 
                       
                        unset ($array1 [$id]);
                    }
                 }
                else if ($key0 === "" && $key1 !== "") {
                    if ($array2[1] === $key1) {
                        unset ($array1 [$id]);
                    }
                }
                else if ($key0 !== "" && $key1 === "") {
                    if ($array2[0] === $key0) {
                         unset ($array1 [$id]);
                    }
                }
            }
        }
   
        $mapstring = implode ($dl1, $array1);
        file_put_contents ($map, $mapstring);
    }
    return $array1;
}

function removeEventFromMapByYear ($map, $date, $event, $year) {
    global $dl1,  $dl2;   
  
    $mapstring = file_get_contents ($map);    
    //Remove events for selected year
    $array1 = explode ($dl1, $mapstring);
    foreach ($array1 as $id => $item1) {
        $array2 = explode ($dl2, $item1);          
        if (array_key_exists (0, $array2) && array_key_exists (1, $array2)) { 
            //Check to make sure this is the year being edited
           if (substr ($array2[0], 0, 4) === $year) {
                if ($array2[1] === $event) {
                    unset ($array1 [$id]);
                }
           }                
        }
    }

    $mapstring = implode ($dl1, $array1);
    file_put_contents ($map, $mapstring); 
    return $array1;
}


    
function selectMapEntries ($maparray, $key0, $key1) {
    
    //returns an array with selected key
    global $dl1,  $dl2;
    $selectedarray = array();    
    
    foreach ($maparray as $item1) {
    
        $array2 = explode ($dl2, $item1);
       
        if (array_key_exists (0, $array2) && array_key_exists (1, $array2)) {
          
            if ($key0 !== "" && $key1 === "") {
               
                if ($array2[0] === $key0 ){           
                    array_push ($selectedarray, $array2[1]);
                }
            }           
      
            else if ($key0 === "" && $key1 !== "") {
                if ($array2[1] === $key1) {
                     array_push ($selectedarray, $array2[0]);
                }
            }
            
        }
    }
    
    return $selectedarray;    
}
function checkForMapEntry ($maparray, $key0, $key1) {
    
    //returns an array with selected key
    global $dl1,  $dl2;
    $entryfoundflag  = false;    
    
    foreach ($maparray as $item1) {
    
        $array2 = explode ($dl2, $item1);
       
        if (array_key_exists (0, $array2) && array_key_exists (1, $array2)) {
          
           if ($key0 !== "" && $key1 !== "") {
                if ($array2[0] === $key0 && $array2[1] === $key1) {
                    $entryfoundflag = true; 
                }
            }
        }
    }
    
    return $entryfoundflag; 
}




function moveToTrash ($table, $recordid) {
    
    $oldfilename = "data/" . $table . "/" . $recordid  . ".txt";
    $newfilename = "data/trash/" .   $table . "----" . $recordid.  ".txt";
    if (file_exists ($oldfilename)) {
        rename ($oldfilename, $newfilename);         
    }
}

function readArray ($filename){
  
    global $dl1;
    $array = array();
    if (file_exists($filename)) { 
      
        $string = file_get_contents ($filename);
        if ($string !== "") {
            $array = explode ($dl1, $string); 
        }
    }  
    return $array;    
}

 function writeArray ($filename, $array){
     
     global $dl1; 
     
    $string = implode ($dl1, $array); 
     $string = trim ($string, $dl1);
    file_put_contents ($filename, $string);          
}   
function removeNameFromArray ($filename, $name) {  
  
    global $dl1;
      
    if (file_exists($filename)) {  

        $string = file_get_contents ($filename);
        $array = explode ($dl1, $string);       
        foreach ($array as $id => $item) {
            if ($item ===  $name) {
                unset ($array [$id]);
            }
        }
        array_values ($array);
        $string = implode ($dl1, $array);
        file_put_contents ($filename, $string);
    }
}

function extractFromMap($map, $key) {
    //returns a new array of either the the first or second elements
    global $dl1,  $dl2;
    
    $mapstring = file_get_contents ($map);    
    $array1 = explode ($dl1, $mapstring);
   
    $selectedarray = array();  
     
    foreach ($array1 as  $item1) {
       
        $array2 = explode ($dl2, $item1);       
        if ($key == 0)  {  
            if (array_key_exists (0, $array2)) {
                array_push ($selectedarray, $array2[0]); 
            }
        }
        else if ($key == 1) {   
            if (array_key_exists (1, $array2)) {
                array_push ($selectedarray, $array2[1]);                 
            }
        }       
    }    
    return $selectedarray;    
}


?>

