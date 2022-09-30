<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

<div class="main-content">
<div class="wrapper">

        <h1>Kategorieverwaltung</h1>
        <br /> <br />

    <?php //Message Display

    require_once (__DIR__ . '/message/categoryManage_message.php');

    ?>
 <br /> <br />


            <!-- Button, um eine Kategorie hinzufügen -->
            <a href="<?php echo URLRACINE; ?>admin/categoryAdd.php" class="btn-primary">Kategorie hinzufügen</a>

<br /> <br /> <br />

    <div class="container mt-5">

        <table class="table table-borderless table-responsive card-1 p-4">
            <thead>
            <tr class="border-bottom">
                <th>
                    <span class="ml-2">Nr.</span>
                </th>
                <th>
                    <span class="ml-2">Kategorie-Name</span>
                </th>
                <th>
                    <span class="ml-2">Bild</span>
                </th>
                <th>
                    <span class="ml-2">Hervorgehoben</span>
                </th>
                <th>
                    <span class="ml-4">Aktiv</span>
                </th>
                <th>
                    <span class="ml-2">Aktionen</span>
                </th>
            </tr>
            </thead>
            <!-- Liste alle Kategorien anzeigen-->

                    <?php 

        //Abfrage, um alle Kategorien aus der Datenbank zu erhalten
        $sql = "SELECT * FROM category";

        //Abfrage ausführen
        $res = mysqli_query($conn, $sql);

        //Zeilen zählen
        $count = mysqli_num_rows($res);

        //Variable Seriennummer erstellen und Wert 1 zuweisen
        $sn=1;

        //Prüfen, ob Daten in der Datenbank vorhanden sind oder nicht
        if($count>0)
        {
    //Wir haben Daten in der Datenbank
    //die Daten abrufen und anzeigen
    while($row=mysqli_fetch_assoc($res))
    {
        $id = $row['id'];
        $title = $row['category_name'];
        $image_name = $row['image_name'];
        $featured = $row['featured'];
        $active = $row['active'];

        ?>

            <tr class="border-bottom">
                <td><div class="p-2 d-block font-weight-bold"><?php echo $sn++; ?>. </div> </td>
                <td class="d-block font-weight-bold"><?php echo $title; ?></td>

                <td>

                    <?php  
                        //Prüfen, ob ein Bild verfügbar ist oder nicht
                        //wenn der Name des Bildes leer ist, dann existiert kein Bild für diese Kategorie. ich hab's so programmiert.
                        if($image_name!="")
                        {
                            //Bild anzeigen
                            ?>
                            
                            <img alt="KategorieImage" class="p-2 d-flex flex-row align-items-center mb-2 rounded-circle" src="<?php echo URLRACINE; ?>assets/images/<?php echo $image_name; ?>" width="100px" >
                            
                            <?php
                        }
                        else
                        {
                            //Nachricht anzeigen.
                            echo "<div class='error'>Kein Bild hinzugefügt</div>";
                        }
                    ?>

                </td>

                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo URLRACINE; ?>admin/categoryUpdate.php?id=<?php echo $id; ?>" class="button1">Kategorie aktualisieren</a>

                    <a href="<?php echo URLRACINE; ?>admin/categoryDelete.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"  class="button2">Kategorie löschen</a>


                </td>
            </tr>

        <?php

    }
}
else
{
    //wir haben keine Daten
    //Wir werden die Nachricht in der Tabelle anzeigen
    ?>

    <tr>
        <td colspan="6"><div class="error">Keine Kategorie hinzugefügt</div></td>
    </tr>

    <?php
}

?>


           

           </table>




</div>
</div>



<?php require_once (__DIR__ . '/partials/footer.php'); ?>   <!-- footer hinzufügen -->