<?php
/*Copyright (c) 2019, Susan V. Rodgers, Lila Avenue, LLC,  lilaavenue@gmail.com 
This code is part of the LilaWorks Content Management System
*/
session_start(); 
include ("inc/db-definitions.php");
include ("inc/db-functions.php");

session_unset();
session_destroy();
include ("inc/header.php");
echo "<h3>You are now logged out </h3><br><br>";
echo "<a href = 'index.php'><h5>Log In</h5></a>";

include ("inc/footer.php");
?>