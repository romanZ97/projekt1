<?php include('partials/header.php'); ?>

<?php
//Überprüfen, ob die ID festgelegt ist oder nicht
if(isset($_GET['id']))
{
    //Alle Infos holen
    $id = $_GET['id'];

    //SQL-Abfrage zum Abrufen des ausgewählten Produkts
    $sql2 = "SELECT * FROM food WHERE id=$id";
    //Abfrage ausführen
    $res2 = mysqli_query($conn, $sql2);

    //den Wert basierend auf der ausgeführten Abfrage abrufen
    $row2 = mysqli_fetch_assoc($res2);

    //Werte vom Produkt holen
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category_id'];
    $current_country_id = $row2 ['country_id'];
    $current_meat_type = $row2['meat_type_id'];
    $food_portion = $row2 ['food_portion'];
    $food_portion_unit = $row2['food_portion_unit'];
    $featured = $row2['featured'];
    $active = $row2['active'];

}
else
{
    //gehe zur Seite manage-dish_name.php
    header('location:'.URLRACINE.'admin/dishManage.php');
}
?>


    <div class="main-content">
        <div class="wrapper">
            <h1>Gericht aktualisieren</h1>
            <br><br>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">

                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Beschreibung: </td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Preis: </td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Aktuelles Bild: </td>
                        <td>
                            <?php
                            if($current_image == "")
                            {
                                //Kein Bild vorhanden
                                echo "<div class='error'>Kein Bild vorhanden</div>";
                            }
                            else
                            {
                                //Bild vorhanden
                                ?>
                                <img src="<?php echo URLRACINE; ?>assets/images/<?php echo $current_image; ?>" width="150px">
                                <?php
                            }
                            ?>
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
                                //Abfrage zum Abrufen aktiver Kategorien
                                $sql = "SELECT * FROM category";
                                //Abfrage ausführen
                                $res = mysqli_query($conn, $sql);
                                //Anzahl der Zeilen
                                $count = mysqli_num_rows($res);

                                //Überprüfen, ob die Kategorie verfügbar ist oder nicht
                                if($count>0)
                                {
                                    //die Kategorie ist verfügbar
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title = $row['category_name'];
                                        $category_id = $row['id'];

                                        ?>
                                        <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    //Kategorie nicht verfügbar
                                    echo "<option value='0'>Kategorie nicht verfügbar</option>";
                                }

                                ?>

                            </select>
                        </td>
                    </tr>



                    <tr>
                        <td>Fleischart: </td>
                        <td>
                            <label>
                                <select name="meat_type_id">

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
                                            $meat_type_id = $row['id'];
                                            $meat_type_name = $row['meat_type_name'];

                                            ?>

                                            <option <?php if($current_meat_type==$meat_type_id) {echo "selected";} ?>  value="<?php echo $meat_type_id; ?>"><?php echo $meat_type_name; ?></option>
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
                            </label>
                        </td>
                    </tr>


                    <tr>
                        <td>Land: </td>
                        <td>
                            <label>
                                <select name="country_id">

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
                                            $country_id = $row['id'];
                                            $country_name = $row['country_name'];

                                            ?>

                                            <option <?php if($current_country_id==$country_id) {echo "selected";} ?>  value="<?php echo $country_id; ?>"><?php echo $country_name; ?></option>

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
                            </label>
                        </td>
                    </tr>


                    <tr>
                        <td>Portion: </td>
                        <td>
                            <label>
                                <input type="number" name="food_portion" value="<?php echo $food_portion; ?>">
                            </label>
                        </td>
                    </tr>


                    <tr>
                        <td>Portion Unit: </td>
                        <td>
                            <label>
                                <input type="text" name="food_portion_unit" value="<?php echo $food_portion_unit; ?>">
                            </label>
                        </td>
                    </tr>






                    <tr>
                        <td>Hervorgehoben? </td>
                        <td>
                            <input <?php if($featured=="Ja") {echo "checked";} ?> type="radio" name="featured" value="Ja"> Ja
                            <input <?php if($featured=="Nein") {echo "checked";} ?> type="radio" name="featured" value="Nein"> Nein
                        </td>
                    </tr>

                    <tr>
                        <td>Aktivieren? </td>
                        <td>
                            <input <?php if($active=="Ja") {echo "checked";} ?> type="radio" name="active" value="Ja"> Ja
                            <input <?php if($active=="Nein") {echo "checked";} ?> type="radio" name="active" value="Nein"> Nein
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                            <input type="submit" name="submit" value="Gericht aktualisieren" class="button1">
                        </td>
                    </tr>

                </table>

            </form>

            <?php

            if(isset($_POST['submit']))
            {

                //Alle Infos Vom Formular holen
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $meat_type_id = $_POST['meat_type_id'];
                $country_id =  $_POST['country_id'];
                $food_portion = $_POST['food_portion'];
                $food_portion_unit = $_POST['food_portion_unit'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //das Bild nur laden, wenn es ausgewählen wird

                //Überprüfen, ob der Button angeklickt wurde oder nicht
                if(isset($_FILES['image']['name']))
                {
                    //Button wurde angekligt
                    $image_name = $_FILES['image']['name'];

                    //Überprüfen, ob die Datei verfügbar ist oder nicht
                    if($image_name!="")
                    {
                        //Bild Verfügbar
                        //Neues Bild

                        //Bild umbenennen
                        $ext = end(explode('.', $image_name)); //Extention Vom Bild holen

                        $image_name = "Product-Name-".rand(0000, 9999).'.'.$ext; //Das Bild wird umbenannt Beispeil: Product-Name-98

                        // den Quellpfad und den Zielpfad abrufen
                        $src_path = $_FILES['image']['tmp_name']; //Quellpfad
                        $dest_path = "../assets/images/".$image_name; //Weg zum Ziel, wo das Bild gespeichert wird

                        //Bild wird hochgeladen
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// Überprüfen, ob das Bild hochgeladen wurde oder nicht
                        if(!$upload)
                        {
                            //Das Bild wurde nicht hochgeladen
                            $_SESSION['upload'] = "<div class='error'>Das Bild wurde nicht hochgeladen</div>";
                            //gehe zur Seite manage-product.php
                            header('location:'.SITEURL.'admin/manage-product.php');
                            //Prozess stoppen
                            die();
                        }
                        // Aktuelles Bild entfernen, falls verfügbar
                        if($current_image!="")
                        {
                            //Aktuelles Bild ist verfügbar
                            //Entfernen des Bildes
                            $remove_path = "../assets/images/".$current_image;

                            $remove = unlink($remove_path);

                            //Überprüfen, ob das Bild entfernt wurde oder nicht
                            if(!$remove)
                            {
                                //Aktuelles Bild konnte nicht entfernt werden
                                $_SESSION['remove-failed'] = "<div class='error'>Aktuelles Bild konnte nicht entfernt werden</div>";
                                //gehe zur Seite manage-product.php
                                header('location:'.SITEURL.'admin/manage-product.php');
                                //Prozess beenden
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Standardbild bleibt, wenn ein neues Bild nicht ausgewählt ist
                    }
                }
                else
                {
                    $image_name = $current_image; //Standardbild bleibt, wenn der button nicht angeklickt wird
                }



                //4. Produkt in der DB aktualisieren
                $sql3 = "UPDATE food SET 
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    meat_type_id = $meat_type_id,
                    country_id = $country_id,
                    food_portion = $food_portion,
                    food_portion_unit = '$food_portion_unit',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";

                //SQL abfrage ausführen
                $res3 = mysqli_query($conn, $sql3);

                //Prüfen, ob die Abfrage ausgeführt wird oder nicht
                if($res3)
                {
                    //Abfrage ausgeführt und das Produkt wurde aktualisiert
                    $_SESSION['update'] = "<div class='success'>Produkt erfolgreich aktualisiert</div>";
                    echo  "<div class='success'>Produkt erfolgreich aktualisiert</div>";
                }
                else
                {
                    //Produkt konnte nicht aktualisiert werden
                    $_SESSION['update'] = "<div class='error'>Produkt konnte nicht aktualisiert werden</div>";
                    echo   "<div class='error'>Produkt konnte nicht aktualisiert werden</div>";
                }



            }

            ?>

        </div>
    </div>

<?php include('partials/footer.php'); ?>