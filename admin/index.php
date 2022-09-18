<?php

require_once (__DIR__ . '/partials/header.php');


?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->


        
        <!-- Main Content Section Start-->
         <div class="main-content">
            <div class="wrapper">
            <h1>Dashboard</h1>
            <br> <br>

            <!-- Nachricht anzeigen ,,Login war erfolgreich" -->
            <?php
            if(isset($_SESSION['login']))
             {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
            }
            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            ?>

                <br> <br>
        <div class="item text-center">

            <!-- Anzahl der verfügbaren Kategorien anzeigen -->

                        <?php
            //Sql Abfrage
            $sql = "SELECT * FROM category";
            //Abfrage ausführen
            $res = mysqli_query($conn, $sql);
            //Anzahl der Zeilen zählen (Gib's Daten in der DB ?)
            $count = mysqli_num_rows($res);
                         ?>

                <h1><?php echo $count; ?></h1>
                <br />
            Kategorie
            </div>

                <!-- Anzahl von den verfügbaren Gerichten anzeigen -->
                        <br>
                        <div class="item text-center">

                        <?php
                //zweite Sql Abfrage
                $sql2 = "SELECT * FROM food";
                //Abfrage Ausführen
                $res2 = mysqli_query($conn, $sql2);
                //Anzahl der Zeilen zählen
                $count2 = mysqli_num_rows($res2);
                        ?>

            <h1><?php echo $count2; ?></h1>
            <br />
            Gerichte
            </div>
                <br>
                <!-- Anzahl der Bestellungen anzeigen -->
                <div class="item text-center">

                <?php
                    // dritte Sql Abfrage --> Anzahl der Bestellungen
                    $sql3 = "SELECT * FROM ordering";
                    //SQl Abfrage ausführen
                    $res3 = mysqli_query($conn, $sql3);
                    //Anzahl der Zeilen ermitteln
                    $count3 = mysqli_num_rows($res3);
                ?>

                <h1><?php echo $count3; ?></h1>
                <br />
                Anzahl der Bestellungen
                </div>

                <br>


                <!-- Anzahl der Tische anzeigen -->
                <div class="item text-center">

                    <?php
                    // dritte Sql Abfrage --> Anzahl der Bestellungen
                    $sql5 = "SELECT * FROM tbl_reservation where reservation_status = 'on wait'";
                    //SQl Abfrage ausführen
                    $res5 = mysqli_query($conn, $sql5);
                    //Anzahl der Zeilen ermitteln
                    $count5 = mysqli_num_rows($res5);

                    if ($count5>0){
                    ?>
                       <h1> <?php echo $count5; ?> </h1>;
                    <?php     }
                    else{
                        echo '<div class="error">Keine Buchung zu bearbeiten </div>';
                    }

                    ?>

                    <br />
                  Offene Buchung
                </div>

                <br>
                <!-- Gesamter Umsatz anzeigen -->
            <div class="item text-center">

            <?php
                // SQL-Abfrage, um den generierten Gesamtumsatz zu erhalten
                //Vierte SQL-Abfrage
                $sql4 = "SELECT SUM(total_price) AS Total FROM ordering WHERE status='geliefert'";

                //Abfrage ausführen
                $res4 = mysqli_query($conn, $sql4);

                //Wert holen
                $row4 = mysqli_fetch_assoc($res4);

                //gesamtumstazt holen
                $total_revenue = $row4['Total'];

            ?>

                <br>
            <h1><?php echo $total_revenue; ?>€</h1>
            <br />
            Gesamter Umsatz
            </div>

                <br>

                <div class="item text-center">

                    <?php
                    //Abfrage zum Abrufen aller Admin
                    $sql7 = "SELECT * FROM admin";
                    //die Abfrage ausgeführt
                    $res7 = mysqli_query($conn, $sql7);

                    //es wird überprüft, ob die Abfrage ausgeführt wird oder nicht
                    if($res7) {
                        // Zeilen zählen, um zu prüfen, ob Daten in der Datenbank vorhanden sind oder nicht
                        $count = mysqli_num_rows($res7); // Funktion zum Abrufen aller Zeilen in der Datenbank

                        $sn = 1; //Eine Variable erstellen und den Wert zuweisen

                        //die Anzahl der Zeilen prüfen
                        if ($count > 0) {
                            //Wir haben Daten in der Datenbank
                            while ($rows = mysqli_fetch_assoc($res7)) {
                                //die While-Schleife wird wervendet, um alle Daten aus der Datenbank zu erhalten.
                                //die while-Schleife läuft so lange, wie Daten in der Datenbank vorhanden sind

                                //Einzelne Daten abrufen
                                $id = $rows['id'];

                                //Anzeige der Werte in unserer Tabelle
                            }
                        }
                    }
                    ?> <!-- PHP beenden-->

                    <a href="<?php echo URLRACINE; ?>admin/adminPasswordUpdate.php?id=<?php echo $id; ?>" class="button2">Password ändern</a>
                    </div>


</div>
</div>
<!-- Session endet hier -->


<?php require_once (__DIR__ . '/partials/footer.php'); ?>   <!-- footer hinzufügen -->