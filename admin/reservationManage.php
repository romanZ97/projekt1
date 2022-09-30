<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Buchungsverwaltung</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                ?>
                <br><br>

        <div class="container mt-5">

            <table class="table table-fit-content table-borderless table-responsive card-1 p-4">
                <thead>
                <tr class="border-bottom">
                    <th>
                        <span class="ml-2">Nr.</span>
                    </th>
                    <th>
                        <span class="ml-2">Kundenname</span>
                    </th>
                    <th>
                        <span class="ml-2">Email</span>
                    </th>
                    <th>
                        <span class="ml-2">Kontaktnummer</span>
                    </th>
                    <th>
                        <span class="ml-2">Datum</span>
                    </th>
                    <th>
                        <span class="ml-4">Uhrzeit</span>
                    </th>
                    <th>
                        <span class="ml-2">Buchungsnummer</span>
                    </th>
                    <th>
                        <span class="ml-2">Stand</span>
                    </th>
                    <th>
                        <span class="ml-2">Aktion</span>
                    </th>

                </tr>
                </thead>

                    <?php 
                        //Alle Bestellungen from DB holen
                        $sql = "SELECT * FROM tbl_reservation ORDER BY id DESC"; // Den letzten Auftrag als erstes anzeigen
                        //Abfrage ausführen
                        $res = mysqli_query($conn, $sql);
                        //die Zeilen zählen
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Erstellen, eine Seriennummer und deren Initialwert auf 1 setzen

                        if($count>0)
                        {
                            //Es gibt eine Bestellung
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Alle Einzelheiten der Bestellung abrufen
                                $id = $row['id'];
                                $reservation_nr = $row['reservation_nr'];
                                $reservation_status	 = $row['reservation_status'];
                                $reservation_date = $row['reservation_date'];
                                $reservation_time = $row['reservation_time'];
                                $customer_name = $row['customer_name'];
                                $customer_email = $row['customer_email'];
                                $customer_contact = $row['customer_contact'];
                                $message = $row['message'];

                                
                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $reservation_date; ?></td>
                                        <td><?php echo $reservation_time; ?></td>
                                        <td><?php echo $reservation_nr; ?></td>


                                        <td>
                                            <?php 
                                                // on wait, bestätigt, Geliefert, Storniert

                                                if($reservation_status=="on wait")
                                                {
                                                    echo "<label style='color: #0986e0;'>gebucht</label>";
                                                }
                                                elseif($reservation_status=="done")
                                                {
                                                    echo "<label style='color: green;'>bestätigt</label>";
                                                }

                                                elseif($reservation_status=="cancelled")
                                                {
                                                    echo "<label style='color: red;'>abgebrochen</label>";
                                                }
                                            ?>
                                        </td>

                                        <td>
                                            <a href="<?php echo URLRACINE; ?>admin/reservationUpdate.php?id=<?php echo $id; ?>" class="button1">Buchung bestätigen</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Bestellung nicht verfügbar
                            echo "<tr><td colspan='12' class='error'>Keine Tische reserviert</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>