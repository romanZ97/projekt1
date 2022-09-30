<?php 
    //Verbindung zur DB
    include('config/constants.php');
    // Session löshen
    session_destroy(); 

    //Gehe zur Loginseite
    header('location:'.URLRACINE.'admin/login.php');

