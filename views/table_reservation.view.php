<?php
include("./config/db_connect.php");
?>
<body>
<div class="container">
    <div class="container" data-aos="fade-up">
        <div class="row">
            <div class="col-md-8 offset-md-2 text-center">
                <h2 class="text-primary">Reserviere einen Tisch!</h2>
                <p class="mb-5">Wähle einfach Deine gewünschte Zeit sowie die Anzahl der Personen aus, die kommen werden
                    und Du erfährst sofort, ob ein Tisch frei ist.</p>
            </div>
        </div>

        <form action="" method="post" role="form">
            <div class="form-row">
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Dein Name">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Deine E-Mail-Adresse">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="Deine Telefonnummer">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="date" name="date" class="form-control" id="date" placeholder="gewünschtes Datum">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <input type="time" class="form-control" name="time" id="time" placeholder="gewünschte Zeit">
                </div>
                <div class="col-lg-4 col-md-6 form-group">
                    <select name="peaple" class="form-control">

                        <?php
                        // Kategorien aus der Datenbank anzeigen
                        //1.  SQL-abfrage, um alle aktiven Kategorien aus der Datenbank abzurufen
                        $sql = "SELECT * FROM table_reservation ";

                        //Abfrage wird ausgeführt
                        $res = mysqli_query($conn, $sql);

                        // Zeilen zählen, um zu überprüfen, ob wir Kategorien haben oder nicht
                        $count = mysqli_num_rows($res);

                        //Wenn die Anzahl größer als 0 ist, haben wir Kategorien, sonst haben wir keine Kategorien
                        if ($count > 0) {
                            //wir haben kategorien
                            while ($row = mysqli_fetch_assoc($res)) {
                                //die Details der Kategorien erhalalten
                                $id = $row['id'];
                                $table_seat_count = $row['table_seat_count'];

                                ?>

                                <option value="<?php echo $id; ?>"><?php echo $table_seat_count; ?></option>

                                <?php
                            }
                        } else {
                            //wir haben keine Kategorie
                            ?>
                            <option value="0">Keine Tische gefunden</option>
                            <?php
                        }


                        //2. Radiobutton
                        ?>

                    </select>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message"
                          placeholder="Möchtest Du eine Nachricht hinterlassen?"></textarea>
            </div>
            <input type="submit" name="submit" class="btn btn-primary float-right mt-3" value="Termin reservieren!">
        </form>


        <?php

        //Überprüfen, ob der Button „Bestellen“ angeklickt wurde oder nicht
        if (isset($_POST['submit'])) {
            // alle info aus dem Formular nehmen
            // alle info aus dem Formular nehmen
            $reservation_nr = rand(000, 999);
            $status = "on wait";
            $date = $_POST["date"];;
            $time = $_POST["time"];
            $peaple = $_POST['peaple'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $message = $_POST['message'];


            //Speichere die Bestellung in der DB
            //SQL um die Daten zu speichern

            $sql2 = "INSERT INTO tbl_reservation SET 
                        reservation_nr  = '$reservation_nr',
                        reservation_status = '$status',
                        reservation_date = '$date',
                        reservation_time = '$time',
                        table_id  = $peaple,
                        customer_name = '$name',
                        customer_contact = '$phone',
                        customer_email = '$email',
                        message = '$message'
                    ";

            //SQL Ausführen
            $res2 = mysqli_query($conn, $sql2);


            //war das erfolgreich ?
            if ($res2) {
                //Ja
                echo "<div class='success text-center'>Vielen Dank für Ihre Reservierung</div>";
            } else {
                //Nein
                echo "<div class='error text-center'>Ein Fehler ist aufgetretten</div>";

            }

        }

        ?>


    </div>
</div>
</body>