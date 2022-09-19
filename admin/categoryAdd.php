<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

<div class="main-content">
    <div class="wrapper">
        <h1>Kategorie hinzufügen</h1>

        <br><br>

        <?php //message anzeigen
        require_once (__DIR__ . '/message/categoryAdd_message.php');
        ?>

        <br><br>

<!-- Formular fängt hier an --> 
<form action="" method="POST" enctype="multipart/form-data"> 

<table class="tbl-30">
    <tr>
        <td>Kategoriename: </td>
        <td>

            <label>
                <input type="text" name="title" placeholder="Name der Kategorie">
            </label>

        </td>
    </tr>

    <tr>
        <td>Bild auswählen: </td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>

    <tr>
        <td>Hervoheben? </td>
        <td>
            <label>
                <input type="radio" name="featured" value="Ja">
            </label> Ja
            <label>
                <input type="radio" name="featured" value="Nein">
            </label> Nein
        </td>
    </tr>

    <tr>
        <td>Aktivieren? </td>
        <td>
            <label>
                <input type="radio" name="active" value="Ja">
            </label> Ja
            <label>
                <input type="radio" name="active" value="Nein">
            </label> Nein
        </td>
    </tr>

    <tr>
        <td>Icon: </td>
        <td>
            <label>
                <select name="icon_name">

                    <?php
                    // Kategorien aus der Datenbank anzeigen
                    //1. SQL-abfrage, um alle aktiven Kategorien aus der Datenbank abzurufen
                    $sql = "SELECT * FROM meat_type ";

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
                            $icon_name = $row['icon_name'];

                            ?>

                            <option value="<?php echo $icon_name; ?>"><?php echo $icon_name; ?></option>

                            <?php
                        }
                    }
                    else
                    {
                        //wir haben keine Kategorie
                        ?>
                        <option value="0">Kein Icon gefunden</option>
                        <?php
                    }


                    ?>

                </select>
            </label>
        </td>
    </tr>



    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Kategorie hinzufügen" class="button1">
        </td>
    </tr>

</table>

</form>
<!-- Formular endet hier -->

</div>

</div>
<?php
require_once (__DIR__ . '/includes/categoryAdd_includes.php'); //funktion zum Hinzufügen einer Kategory
require_once (__DIR__ . '/partials/footer.php'); // footer hinzufügen
?>

