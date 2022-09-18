<?php 
    //Verbindung zur DB
    include('config/constants.php');


    if(isset($_GET['id']) && isset($_GET['image_name'])) //hier kann man entweder '&&' oder 'AND' verwenden
    {
        //Prozess zum Löschen

        // ID und Bildnamen abrufen
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //das Bild entfernen, falls verfügbar
        //Überprüfen, ob das Bild verfügbar ist oder nicht, und Sie es nur löschen, wenn es verfügbar ist
        if($image_name != "")
        {
            // das Product hat ein Bild und es muss aus dem Ordner entfernen
            //der Ort, wo das Bild zu finden ist
            $path = "../assets/images/".$image_name;

            //Bilddatei aus Ordner entfernen
            $remove = unlink($path);

            //Überprüfen, ob das Bild entfernt wurde oder nicht
            if(!$remove)
            {
                //Bild konnte nicht entfernt werden
                $_SESSION['upload'] = "<div class='error'>das Bild konnte nicht entfernt werden</div>";
                //gehe zu manage-dish_name
                header('location:'.URLRACINE.'admin/dishManage.php');
                //Der Prozess stoppen 
                die();
            }

        }

        // Produkt aus Datenbank löschen
        $sql = "DELETE FROM food WHERE id=$id";
        //die Abfrage ausführen
        $res = mysqli_query($conn, $sql);

        //Überprüfen, ob die Abfrage ausgeführt wurde oder nicht, und setzen die Sitzungsnachricht entsprechend
        if($res)
        {
            //das Produkt wurde gelöscht
            $_SESSION['delete'] = "<div class='success'>Das Gericht wurde erfolgreich gelöscht</div>";
        }
        else
        {
            //das Produkt wurde nicht gelöscht
            $_SESSION['delete'] = "<div class='error'>Ein Fehler ist aufgetreten, das Produkt wurde nicht gelöscht.</div>";
        }


    }
    else
    {
        //gehe zur Seite manage-dish_name
        $_SESSION['unauthorize'] = "<div class='error'>Unautorisierter Zugriff</div>";
    }
header('location:'.URLRACINE.'admin/dishManage.php');

