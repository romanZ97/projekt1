<?php

if(isset($_POST['submit']))
{

    // Werte aus dem Formular holen
    $id = $_POST['id'];
    $title = $_POST['title'];
    $current_image = $_POST['current_image'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];

    // Neues Bild aktualisieren, falls ausgewählt
    //Überprüfen, ob das Bild ausgewählt ist oder nicht
    if(isset($_FILES['image']['name']))
    {
        // Bilddetails holen
        $image_name = $_FILES['image']['name'];

        //Überprüfen, ob das Bild verfügbar ist oder nicht
        if($image_name != "")
        {
            //Bild Verfügbar

            // neues Bild hochladen

            //Bild umbenennen
            $array = explode('.', $image_name);
            $ext = end($array);

            //Bild umbenennen
            $image_name = "SpeiseKategorie_".rand(000, 999).'.'.$ext; //beispeil:  SpeiseKategorie_834.jpg


            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../assets/images/".$image_name;

            //das Bild hochladen
            $upload = move_uploaded_file($source_path, $destination_path);

            //Überprüfen, ob das Bild hochgeladen wurde oder nicht
            //Wenn das Bild nicht hochgeladen wird, stoppen wir den Vorgang und leiten mit einer Fehlermeldung weiter
            if(!$upload)
            {
                //Fehlermeldung erscheint
                $_SESSION['upload'] = "<div class='error'>Das Bild wurde nicht hochgeladen </div>";
                //gehe zur Seite categoryManage.php
                header('location:'.URLRACINE.'admin/categoryManage.php');
                //Stopp den Vorgang
                die();
            }

            // Entfernen Sie das aktuelle Bild, falls verfügbar
            if($current_image!="")
            {
                $remove_path = "../assets/images/".$current_image;

                $remove = unlink($remove_path);

                //Überprüfen, ob das Bild entfernt wurde oder nicht
                //Wenn das Entfernen fehlschlägt, zeigen Sie eine Meldung an und stoppen Sie die Prozesse
                if(!$remove)
                {
                    //Fehlermeldung anzeigen
                    $_SESSION['failed-remove'] = "<div class='error'>Aktuelles Bild konnte nicht entfernt werden</div>";
                    header('location:'.URLRACINE.'admin/categoryManage.php');
                    die();//Stop den Vorgang
                }
            }


        }
        else
        {
            $image_name = $current_image;
        }
    }
    else
    {
        $image_name = $current_image;
    }

    // daten in der db aktualisieren
    $sql2 = "UPDATE category SET 
                    category_name = '$title',
                    image_name = '$image_name',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id=$id
                ";

    //SQL-Abfrage ausführen
    $res2 = mysqli_query($conn, $sql2);

    //Prüfen, ob ausgeführt oder nicht
    switch ($res2) {
        case true:
            //Kategorie aktualisiert
            $_SESSION['update'] = "<div class='success'>Kategorie erfolgreich aktualisiert</div>";
            break;
        default:
            //Kategorie konnte nicht aktualisiert werden
            $_SESSION['update'] = "<div class='error'>Kategorie konnte nicht aktualisiert werden</div>";
            break;
    }
    header('location:' . URLRACINE . 'admin/categoryManage.php');

}
