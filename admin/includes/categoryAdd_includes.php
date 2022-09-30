
<?php

//Prüfen, ob die Schaltfläche "Senden" angeklickt wurde oder nicht
if(isset($_POST['submit']))
{

    // Den Wert aus dem CAtegory-Formular abrufen
    $title = $_POST['title'];
    $icon_name = $_POST['icon_name'];

    //Bei der Radio-button müssen wir prüfen, ob die Schaltfläche ausgewählt ist oder nicht
    if(isset($_POST['featured']))
    {
        // Abrufen des Wertes aus dem Formular
        $featured = $_POST['featured'];
    }
    else
    {
        //den Standardwert setzen
        $featured = "Nein";
    }

    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }
    else
    {
        $active = "Nein";
    }

    //Prüfen, ob das Bild ausgewählt ist oder nicht und setzen Sie den Wert für den Bildnamen entsprechend

    if(isset($_FILES['image']['name']))
    {
        //Hochladen des Bildes
        //Zum Hochladen eines Bildes benötigen wir den Bildnamen, den Quell- und den Zielpfad
        $image_name = $_FILES['image']['name'];

        // Hochladen des Bildes nur, wenn Bild ausgewählt ist
        if($image_name != "")
        {

            //Unser Bild automatisch umbenennen
            //Holen Sie sich die Erweiterung unseres Bildes (jpg, png, gif, etc) e.g. "produkt1.jpg"
            $array = explode('.', $image_name);
            $ext = end($array);

            //Rename the Image
            $image_name = "SpeiseKategorie_".rand(000, 999).'.'.$ext; // Beispiel SpeiseKategorie_834.jpg


            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../assets/images/".$image_name;

            //Zum Schluss das Bild hochladen //Funktion zum Hochladen des Bildes
            $upload = move_uploaded_file($source_path, $destination_path);

            //Prüfen, ob das Bild hochgeladen wurde oder nicht
            //Und wenn das Bild nicht hochgeladen wird, wird der Prozess angehalten und mit einer Fehlermeldung weitergeleitet
            if(!$upload)
            {

                $_SESSION['upload'] = "<div class='error'>das Bild wurde nicht hochgeladen </div>";

                header('location:'.URLRACINE.'admin/categoryAdd.php');
                //den Prozess stoppen
                die();
            }

        }
    }
    else
    {
        //Kein Bild hochladen und den Wert image_name auf leer setzen
        $image_name="";
    }

    //2. SQL-Abfrage zum Einfügen der Kategorie in die Datenbank erstellen
    $sql = "INSERT INTO category SET 
                category_name='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active',
                icon_name='$icon_name'
            ";

    //3. Ausführen der Abfrage und Speichern in der Datenbank
    $res = mysqli_query($conn, $sql);

    //4. Prüfen, ob die Abfrage ausgeführt wurde oder nicht und ob Daten hinzugefügt wurden oder nicht
    if($res)
    {
        //Abfrage ausgeführt und Kategorie hinzugefügt
        $_SESSION['add'] = "<div class='success'>Die Kategorie wurde erfolgreich eingefügt</div>";

        header('location:'.URLRACINE.'admin/categoryManage.php');
    }
    else
    {
        //Die Kategorie wurde nicht eingefügt<
        $_SESSION['add'] = "<div class='error'>Die Kategorie wurde nicht eingefügt</div>";

        header('location:'.URLRACINE.'admin/categoryAdd.php');
    }
}


