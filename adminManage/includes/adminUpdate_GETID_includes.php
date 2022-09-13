<?php

//1. die ID des ausgewählten Administrators abrufen
$id=$_GET['id'];

// Erstellen, eine SQL-Abfrage, um die Details abzurufen
$sql="SELECT * FROM admin WHERE id=$id";

//  die Abfrage ausführen
$res=mysqli_query($conn, $sql);

//Überprüfen, ob die Abfrage ausgeführt wird oder nicht
if($res)
{
    // Überprüfen, ob die Daten verfügbar sind oder nicht
    $count = mysqli_num_rows($res);
    //Überprüfen, ob wir Admin-Daten haben oder nicht
    if($count==1)
    {
        // hole alle Infos
        $row=mysqli_fetch_assoc($res);

        $full_name = $row['full_name']; //feldernamen in der DB
        $username = $row['username'];  //feldernamen in der DB
        $email = $row['email'];
    }
    else
    {
        //Seite manage-admin
        header('location:'.URLRACINE.'adminManage/index.php');
    }
}

?>   <!-- GETID  -->