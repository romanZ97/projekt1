<?php 
    
    session_start();
     // Konstanten erstellen, damit die Werte die mehrmal vorkommen nicht verderholt werden müssen.
     define('URLRACINE', 'http://localhost:8888/projekt1/');
     define('LOCALHOST', 'localhost');
     define('DB_USERNAME', 'root');
     define('DB_PASSWORD', 'root');
     define('DB_NAME', 'GastroApp'); //Name der Datenbank

     $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(("Keine Verbindung mit der Datenbank möglich: " . $mysqli->connect_error)); //Verbindung mit der DB
     $db_select = mysqli_select_db($conn, DB_NAME) or die("Keine Datenbank gefunden: " . $mysqli->connect_error); //Auswahl der DB 


?> 