<?php

session_start();
    unset($_SESSION['user_id']); //Frees all login session variables 
    unset($_SESSION['user_name']); //Frees all login session variables
    header( "location: ../index.php" );

?>
