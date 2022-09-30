<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->


    <div class="main-content">
        <div class="wrapper">
            <h1>Gericht hinzufügen</h1>

            <br><br>

            <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Name des Gerichts: </td>
                        <td>

                                <input type="text" name="title" placeholder="Titel">

                        </td>
                    </tr>

                    <tr>
                        <td>Beschreibung: </td>
                        <td>

                                <textarea name="description" cols="30" rows="5" placeholder="beschreibung"></textarea>

                        </td>
                    </tr>

                    <tr>
                        <td>Preis: </td>
                        <td>
                             <input type="text" name="price">

                        </td>
                    </tr>

                    <tr>
                        <td>Bild auswählen: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Kategorie: </td>
                        <td>

                                <select name="category">

                                    <?php
                                    // Kategorien aus der Datenbank anzeigen
                                    //1. SQL-abfrage, um alle aktiven Kategorien aus der Datenbank abzurufen
                                    $sql = "SELECT * FROM category WHERE active='Ja'";

                                    //Abfrage wird ausgeführt
                                    $res = mysqli_query($conn, $sql);

                                    // Zeilen zählen, um zu überprüfen, ob wir Kategorien haben oder nicht
                                    $count = mysqli_num_rows($res);

                                    //Wenn die Anzahl größer als 0 ist, haben wir Kategorien, sonst haben wir keine Kategorien
                                    if($count>0)
                                    {
                                        //wir haben kategorien
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //die Details der Kategorien erhalalten
                                            $id = $row['id'];
                                            $title = $row['category_name'];

                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //wir haben keine Kategorie
                                        ?>
                                        <option value="0">keine Kategorie gefunden</option>
                                        <?php
                                    }


                                    //2. Radiobutton
                                    ?>

                                </select>

                        </td>
                    </tr>




                    <tr>
                        <td>Fleischart: </td>
                        <td>

                                <select name="meat_type_name">

                                    <?php
                                    // Kategorien aus der Datenbank anzeigen
                                    //1. SQL-abfrage, um alle aktiven Kategorien aus der Datenbank abzurufen
                                    $sql = "SELECT * FROM meat_type";

                                    //Abfrage wird ausgeführt
                                    $res = mysqli_query($conn, $sql);

                                    // Zeilen zählen, um zu überprüfen, ob wir Kategorien haben oder nicht
                                    $count = mysqli_num_rows($res);

                                    //Wenn die Anzahl größer als 0 ist, haben wir Kategorien, sonst haben wir keine Kategorien
                                    if($count>0)
                                    {
                                        //wir haben kategorien
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //die Details der Kategorien erhalalten
                                            $id = $row['id'];
                                            $meat_type_name = $row['meat_type_name'];

                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $meat_type_name; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //wir haben keine meat_type gefunden
                                        ?>
                                        <option value="0">keine Fleischart gefunden</option>
                                        <?php
                                    }


                                    //2. Radiobutton
                                    ?>

                                </select>

                        </td>
                    </tr>



                    <tr>
                        <td>Land: </td>
                        <td>

                                <select name="country_name">

                                    <?php
                                    // Kategorien aus der Datenbank anzeigen
                                    //1. SQL-abfrage, um alle aktiven Kategorien aus der Datenbank abzurufen
                                    $sql = "SELECT * FROM country";

                                    //Abfrage wird ausgeführt
                                    $res = mysqli_query($conn, $sql);

                                    // Zeilen zählen, um zu überprüfen, ob wir Kategorien haben oder nicht
                                    $count = mysqli_num_rows($res);

                                    //Wenn die Anzahl größer als 0 ist, haben wir Kategorien, sonst haben wir keine Kategorien
                                    if($count>0)
                                    {
                                        //wir haben kategorien
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                            //die Details der Kategorien erhalalten
                                            $id = $row['id'];
                                            $country_name = $row['country_name'];

                                            ?>

                                            <option value="<?php echo $id; ?>"><?php echo $country_name; ?></option>

                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        //wir haben keine meat_type gefunden
                                        ?>
                                        <option value="0">kein Land gefunden</option>
                                        <?php
                                    }


                                    //2. Radiobutton
                                    ?>

                                </select>

                        </td>
                    </tr>


                    <tr>
                        <td>Portion: </td>
                        <td>

                                <input type="number" name="portion" placeholder="100">

                        </td>
                    </tr>


                    <tr>
                        <td>Portion Unit: </td>
                        <td>

                                <input type="text" name="portion_unit" placeholder="g">

                        </td>
                    </tr>


                    <tr>
                        <td>Hervorheben? </td>
                        <td>

                            <input type="radio" name="featured" value="Ja"> Ja

                            <input type="radio" name="featured" value="Nein"> Nein

                        </td>
                    </tr>

                    <tr>
                        <td>Aktivieren? </td>
                        <td>
                                <input type="radio" name="active" value="Ja"> Ja
                                <input type="radio" name="active" value="Nein"> Nein

                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Gericht hinzufügen" class="button1">
                        </td>
                    </tr>

                </table>

            </form>


            <?php

            //Überprüfen, ob die Schaltfläche angeklickt wurde oder nicht
            if(isset($_POST['submit']))
            {
                //Produkt in der Datenbank hinzufügen

                //1. die Daten aus dem Formular holen
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $meat_type = $_POST['meat_type_name'];
                $country_name = $_POST ['country_name'];
                $portion = $_POST ['portion'];
                $portion_unit = $_POST['portion_unit'];



                //Überprüfen, ob die Radion-button für gekennzeichnet und aktiv aktiviert sind oder nicht
                $featured = $_POST['featured'] ?? "Nein";

                $active = $_POST['active'] ?? "Nein";

                //2. das Bild hochladen, falls ausgewählt
                //Überprüfen, ob das ausgewählte Bild angeklickt wurde oder nicht, und das Bild nur hochladen, wenn das Bild ausgewählt ist
                if(isset($_FILES['image']['name']))
                {
                    //die Details des ausgewählten Bildes abrufen
                    $image_name = $_FILES['image']['name'];

                    //Überprüfen, ob das ausgewählte Bild angeklickt wurde oder nicht, und das Bild nur hochladen, wenn das Bild ausgewählt ist
                    if($image_name!="")
                    {
                        // Bild ausgewählt
                        //das Bild umbenennen
                        //die extension des ausgewählten Bildes nehmen (jpg, png, gif, etc.) "franck-ivan.jpg" Franck Ivan jpg
                        //$ext = end(explode('.', $image_name));
                        $ext = 'png';

                        // Neuen Namen für Bild erstellen
                        $image_name = "DishName-".rand(0000,9999).".".$ext; //Neuer Bildname kann sein "product-Name-198.jpg"

                        //das Bild hochladen
                        //Src-Pfad und Zielpfad ermitteln

                        // Quellpfad ist der aktuelle Speicherort des Bildes
                        $src = $_FILES['image']['tmp_name'];

                        //Zielpfad für das hochzuladende Bild
                        $dst = "../assets/images/".$image_name;

                        //schließlich das Bild des Produktes hochladen
                        $upload = move_uploaded_file($src, $dst);

                        //prüfen, ob das Bild hochgeladen wurde oder nicht
                        if(!$upload)
                        {
                            //Upload des Bildes fehlgeschlagen
                            //Weiterleitung zur Seite ,,Produkt hinzufügen" mit Fehlermeldung
                            $_SESSION['upload'] = "<div class='error'>das Bild wurde nicht hochgeladen</div>";
                            header('location:'.URLRACINE.'admin/dishAdd.php');
                            //den Prozess stoppen
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //Einstellung Standardwert als leer
                }

                //3. Einfügen in die Datenbank

                //Erstellen eine SQL-Abfrage zum Speichern oder Hinzufügen von Produkt
                // Für numerische Werte brauchen wir keine Anführungszeichen '' zu verwenden, aber für String-Werte müssen wir Anführungszeichen hinzufügen ''--> Preise : Int
                $sql2 = "INSERT INTO food SET 
                    title = '$title',
                    description = '$description',
                    price = '$price',
                    image_name = '$image_name',
                    category_id = $category,
                    meat_type_id = $meat_type,
                    country_id = $country_name,
                    food_portion = $portion,
                    food_portion_unit = '$portion_unit',
                    featured = '$featured',
                    active = '$active'
                ";

                //Ausführen der Abfrage
                $res2 = mysqli_query($conn, $sql2);

                //Prüfen, ob Daten eingefügt wurden oder nicht
                //4. Weiterleitung mit Nachricht zur Seite "manage-product"
                if($res2)
                {
                    //Daten erfolgreich eingefügt
                    $_SESSION['add'] = "<div class='success'>Das Gericht wurde erfolgreich hinzugefügt.</div>";
                    echo "<div class='success'>Das Gericht wurde erfolgreich hinzugefügt.</div>";
                }
                else
                {
                    //Daten nicht eingefügt
                    $_SESSION['add'] = "<div class='error'>das Gericht wurde nicht eingefügt.</div>";
                    echo "<div class='error'>das Gericht wurde nicht eingefügt.</div>";

                }


            }

            ?>


        </div>
    </div>



<?php require_once (__DIR__ . '/partials/footer.php'); ?>