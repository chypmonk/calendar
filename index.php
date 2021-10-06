<?php
session_start(); 

$loggedin = false;
if (isset ($_SESSION['admin']) ){
    if ($_SESSION['admin'] === true) {
        $loggedin = true;
    }
}

$pageid = "home";
if (isset ($_GET["page"])){   
    $pageid = filter_input(INPUT_GET, "page", FILTER_SANITIZE_STRING) ;     
}

include ("inc/header.php");

if ($_SERVER ["REQUEST_METHOD"] === "POST" ) { 
    if (isset ($_POST['submit-login'])) {
        if (isset ($_POST['username'])) {
            if (isset ($_POST['password']) ){
                $username = file_get_contents ('data/username.txt');
                $password = file_get_contents ('data/password.txt');                
                if ($username === $_POST['username'] && $password === $_POST['password']) {
                    $_SESSION['admin'] = true; 
                    $loggedin = true;
                }               
            }
        }
    }
}
if  ($loggedin === true) {

    include ("inc/db-definitions.php");
    include ("inc/db-functions.php");
    include ("inc/retrieve-dates.php");

    
    if (!file_exists ("pages/". $pageid . ".php") ){                 
       echo "This page does not exist";
    }
    else {
        echo "<main>";        
          
        include ("pages/" . $pageid . ".php");
        echo "</main>";  
    }        
}
else {
    ?> 
<h3>Log In</h3>
       <form method = "post" action= 'index.php'>
           <b>Username</b>
           <input   type="text"  name="username" value = ""><br><br>
           <b>Password</b>
           <input   type="password"  name="password" value = "" ><br>        
           <input class =   'submitbutton' type= "submit" value = "Enter" name = 'submit-login'>
       </form>
<?php     
}
    
include ("inc/footer.php");
        
?>

