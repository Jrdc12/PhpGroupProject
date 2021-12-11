<?php

//sets session 
session_start();
//unsets the login
unset($_SESSION["login"]);

//destroys session and returns to login page
session_destroy();
header("Location: index.php");
?>