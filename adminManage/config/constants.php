<?php 
    
    session_start();
const URLRACINE = 'http://localhost:8888/projekt1/';
const LOCALHOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'GastroApp'; //Name der Datenbank

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(("Keine Verbindung mit der Datenbank möglich: " . $conn->connect_error)); //Verbindung mit der DB
$db_select = mysqli_select_db($conn, DB_NAME) or die("Keine Datenbank gefunden: " . $conn->connect_error); //Auswahl der DB


?> 