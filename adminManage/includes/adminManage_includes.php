

    <?php

        //Abfrage zum Abrufen aller Admin
        $sql = "SELECT * FROM admin";


        //die Abfrage ausführen
        $res = mysqli_query($conn, $sql);

    //es wird überprüft, ob die Ausführung galaufen ist
    if($res)
    {
        // Zeilen zählen, um zu prüfen, ob Daten in der Datenbank vorhanden sind oder nicht
        $count = mysqli_num_rows($res); // Funktion zum Abrufen aller Zeilen in der Datenbank

        $sn=1; //Eine Variable erstellen und den Wert zuweisen

        //die Anzahl der Zeilen prüfen
        if($count>0)
        {
        //Wir haben Daten in der Datenbank
        while($rows=mysqli_fetch_assoc($res))
        {
            //die While-Schleife wird wervendet, um alle Daten aus der Datenbank zu erhalten.
            //die while-Schleife läuft so lange, wie Daten in der Datenbank vorhanden sind

            //Einzelne Daten abrufen
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];
            $email= $rows['email'];

            //Anzeige der Werte in unserer Tabelle
            ?> <!-- PHP beenden-->

    <tbody>
    <tr class="border-bottom">
        <td>
            <div class="p-2">
                <span class="d-block font-weight-bold"><?php echo $sn++; ?>.</span>

            </div>
        </td>
        <td>

            <span class="d-block font-weight-bold"><?php echo $full_name; ?></span>

        </td>

        <td>
            <span class="d-block font-weight-bold"><?php echo $username; ?></span>

        </td>

        <td>
            <span class="d-block font-weight-bold"><?php echo $email; ?></span>

        </td>


        <td>
            <div class="p-2 d-flex flex-column">

        <td>
            <a href="<?php echo URLRACINE; ?>adminManage/adminUpdate.php?id=<?php echo $id; ?>" class="button1"> Admin aktualisieren</a>
            <a href="<?php echo URLRACINE; ?>adminManage/adminDelete.php?id=<?php echo $id; ?>" onclick="ConfirmDelete()" class="button2">Admin löschen</a>

        </td>

            <?php

        }
    }
    else
    {
        echo "<tr><td colspan='12' class='error'>Kein Admin in der Datenbank</td></tr>";
    }
}

?>

