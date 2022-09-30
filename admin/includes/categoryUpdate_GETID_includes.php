<?php

//Überprüfen, ob die ID festgelegt ist oder nicht
if(isset($_GET['id']))
{
    //die ID und alle anderen Details holen
    $id = $_GET['id'];
    //SQL-Abfrage, um alle anderen Details zu erhalten
    $sql = "SELECT * FROM category WHERE id=$id";

    //Abfrage ausführen
    $res = mysqli_query($conn, $sql);

    //Zeilen zählen, um zu prüfen, ob die ID gültig ist oder nicht
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //alle Daten aus der Datenbank holen
        $row = mysqli_fetch_assoc($res);
        $title = $row['category_name'];
        $current_image = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];
        $icon_name = $row['icon_name'];
    }
    else
    {
        //Fehlermeldung anzeigen
        $_SESSION['no-category-found'] = "<div class='error'>Keine Kategorie gefunden</div>";
        header('location:'.URLRACINE.'admin/categoryManage.php');
    }

}
else
{
    //gehe zur Seite manage-category
    header('location:'.URLRACINE.'admin/categoryManage.php');
}
