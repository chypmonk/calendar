<?php
$username = file_get_contents ("data/username.txt");
$password = file_get_contents ("data/password.txt");
if ($_SERVER ["REQUEST_METHOD"] == "POST" ) {  
  
    if (isset ($_POST['newcategory'])) {
        $newcategory = trim (FILTER_INPUT (INPUT_POST, "newcategory", FILTER_SANITIZE_STRING ));      
    
        $categoryarray = readArray("data/event-categories.txt");  

        $error = false;
        checkForDelimiters($_POST);

        if ($error === false) {
            $newkey = createKey ($newcategory);
             if ($newkey !== "") {
                 if (in_array($newkey, $categoryarray)) {
                     echo "<div class = 'error'>This category already exists</div>";           
                 }
                 else {
                     array_push ($categoryarray, $newkey); 
                     writeArray ("data/event-categories.txt", $categoryarray);                                          
                 }
             }    
        }
    }
    else if (isset ($_POST['removearray'])) {
        $removearray = $_POST['removearray'];
        foreach ($removearray as $item) {    
            removeNameFromArray ("data/event-categories.txt", $item);
        }
    } 
    else if (isset ($_POST['submit-credentials'])) { 
        if (isset ($_POST['username'])) {
            file_put_contents ("data/username.txt", $_POST['username']);
        }
        if (isset ($_POST['password'])) {
            file_put_contents ("data/password.txt", $_POST['password']);
        }
    }
    
}
?>
<a href = 'index.php?page=home'>&larr; Return</a><br>
<h3>Manage Calendar</h3>
<div class = 'third-column'>
    
    <a class = 'adminbutton' href = 'index.php?page=add-update-event'>Add Event</a><br>
    
    <h4>All Events</h4>
    <?php
     $array1 = scandir ("data/events");
        foreach ($array1 as $item) {
            if ($item !== "." && $item !== "..") {
               $id = str_replace (".txt", "", $item);
               $record = readDatabaseRecord ("events", $id);                
               echo "<a href = 'index.php?page=display-event&event=" . $id . "'>" . ucwords (str_replace ("-", " ", $id)) . "</a><br>";
            }
        }
    ?>
    
</div><div class = 'third-column'>
      <h4>Add Category</h4>
    <form method = 'post' action = 'index.php?page=manage'>    
       
        <input id = 'newcategory' type = 'text' name = 'newcategory' />
        <input  class = 'submitbutton' name = 'submit-new' type = 'submit' value='Update'> 
    </form> 
    <h4>Current Categories</h4>
    <?php
    $array1 = readArray ("data/event-categories.txt") ;
    foreach ($array1 as $item) {
        echo  ucwords(str_replace ("-", " ", $item)) . "<br>";
    }
    ?>  
    <form method = 'post' action = 'index.php?page=manage'>         
    <h4>Remove Category</h4>
    <?php
    $array1 = readArray("data/event-categories.txt");
    foreach ($array1 as $item) {
        echo "<input type = 'checkbox' name = 'removearray[]' value = '" . $item . "' />" . $item. "<br>";       
    }  
    ?>
     <input  class = 'submitbutton' name = 'submit-remove' type = 'submit' value='Submit'> 
</form> 
    
</div><div class = 'third-column'> 
 
    <h4>Update Login</h4>
    <form method = 'post' action = 'index.php?page=home' >  
        <label for = 'username' >Username</label><br>
        <input id = 'username'  type = 'text' name = 'username'  value = '<?php echo $username; ?>' />
        <br><br><label for = 'password'>Password</label><br>
        <input id = 'password' type = 'text' name = 'password' value = '<?php echo $password; ?>'/> 
        <br><br><input class = 'submitbutton' type = 'submit' name = 'submit-credentials' value = 'Submit' /> 
    </form>
</div>
