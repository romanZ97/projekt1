<?php

//Überprüfen , ob der Submit-Button angeklickt wurde oder nicht
if(isset($_POST['submit']))
{
    //alle Werte vom Formular holen um es aktualisieren
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    // SQL-Abfrage, um den Administrator zu aktualisieren
    $sql = "UPDATE admin SET
        full_name = '$full_name',
        username = '$username',
        email = '$email'
        WHERE id='$id'
        ";

    //die Abfrage ausführen
    $res = mysqli_query($conn, $sql);

    //Überprüfen, ob die Abfrage erfolgreich ausgeführt wurde oder nicht
    switch ($res) {
        case true:
            //Abfrage ausgeführt und Admin wurde aktualisiert
            $_SESSION['update'] = "<div class='success'>Admin wurde erfolgreich aktualisiert</div>";
            //gehe zu index.php
            break;
        default:
            //Der Admin wurde nicht aktualisiert
            $_SESSION['update'] = "<div class='error'>Der Admin wurde nicht aktualisiert</div>";
            //gehe zur Adminseite
            break;
    }
    header('location:' . URLRACINE . 'adminManage/index.php');
}

