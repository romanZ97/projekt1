<?php

//die Werte aus dem Formular holen und die in der DB Speichern
//wir überprüfen ob der button ,,submit" angeklickt wurde.

    if(isset($_POST['submit']))
    {
    // Button wurde angeklickt

    //1. wir rufen die Daten aus dem Formular auf
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //TODO Passwort hasching
    $email = $_POST['email'];

    //2. SQL-Abfrage zum Speichern der Daten in der Datenbank
    $sql = "INSERT INTO admin SET 
            full_name='$full_name',
            username='$username',
            password='$password',
            email = '$email'
        ";

    //die Abfrage ausführen
    $res = mysqli_query($conn, $sql);

    //4. wir prüfen, ob die Daten eingefügt wurden
    if($res)
    {

        //eine Sessionvariable zur Anzeige der Nachricht erstelen
        $_SESSION['add'] = "<div class='success'>Admin wurde erfolgreich eingefügt</div>";
        //gehe zur Seite manage admin
        header('location:'.URLRACINE.'adminManage/index.php');

    }
    else //-->die Daten wurden nicht engefügt
    {

        //eine Sessionvariable zur Anzeige der Nachricht erstelen
        $_SESSION['add'] = "<div class='error'>Admin wurde nicht eingefüft</div>";
        //gehe zu ,,Add Admin"
        header('location:'.URLRACINE.'adminManage/adminAdd.php');
    }



}



