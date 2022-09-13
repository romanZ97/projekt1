<?php 
    //Verbindung zur DB
    include('config/constants.php');

   
    //Überprüfen, ob die Werte für id und image_name gesetzt sind oder nicht
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //den Wert holen und löschen.
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Entferne das Bild für die Kategorie aus der Datein 
        if($image_name != "")
        {
            //Ort wo das Bild zu finden ist. --> assets/images
            $path = "../assets/images/".$image_name;
            //Das Bild ist verfügbar entferne es.
            $remove = unlink($path);

            //Wenn das Bild nicht entfernt werden konnte, eine Fehlermeldung wird eingefügt und der Vorgang wird gestoppt
            if(!$remove)
            {
                //Fehlermeldung erscheint
                $_SESSION['remove'] = "<div class='error'>Das Bild wurde nicht aus der Datein entfernt.</div>";
                //gehe zur Seite categoryManage.php
                header('location:'.URLRACINE.'admin/categoryManage.php');
                //Stoppt der Vorgang
                die();
            }
        }

        //Daten aus Datenbank löschen
        //SQL-Abfrage zum Löschen von Daten aus der Datenbank
        $sql = "DELETE FROM category WHERE id=$id";

        //Abfrage ausführen
        $res = mysqli_query($conn, $sql);

        //Überprüfen, ob die Daten aus der Datenbank gelöscht wurden oder nicht
        if($res)
        {
            //Meldung enzeigen
            $_SESSION['delete'] = "<div class='success'>Kategorie wurde erfolgreich gelöscht.</div>";
            //gehe zu categoryManage.php
        }
        else
        {
            //Ein Fehler ist aufgetreten
            $_SESSION['delete'] = "<div class='error'>Kategorie konnte nicht gelöscht werden</div>";
            //gehe zur Seite manage-kategory.php
        }


    }
header('location:'.URLRACINE.'admin/categoryManage.php');
