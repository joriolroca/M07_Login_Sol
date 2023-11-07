<?php

   // Start the session
   session_start(); 

   if(!isset($_SESSION["loggedIn"])){
        $_SESSION["loggedIn"] = false; 
    }

   session_destroy();

    header("Location: login.html");

?>