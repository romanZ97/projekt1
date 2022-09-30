<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Bestellungen verwalten</h1>

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

            <table class="table table-borderless table-responsive card-1 p-4">
                <thead>
                <tr class="border-bottom">
                    <th>
                        <span class="ml-2">Nr.</span>
                    </th>

                    <th>
                        <span class="ml-2">Bestellungsnummer</span>
                    </th>

                    <th>
                        <span class="ml-2">Preis</span>
                    </th>

                    <th>
                        <span class="ml-2">Anzahl</span>
                    </th>

                    <th>
                        <span class="ml-2">Bestelldatum</span>
                    </th>

                    <th>
                        <span class="ml-4">Status</span>
                    </th>

                    <th>
                        <span class="ml-4">Username</span>
                    </th>

                </tr>
                </thead>

                <?php
                //Alle Bestellungen from DB holen
                $sql = "SELECT * FROM ordering ORDER BY id DESC"; // Den letzten Auftrag als erstes anzeigen
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
                        $order_nr = $row['order_nr']; //nummer
                        $total_price = $row['total_price'];
                        $total_qty = $row['total_qty'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_surname = $row['customer_surname'];


                        ?>

                        <tr>
                            <td><?php echo $sn++; ?>. </td>
                            <td><?php echo $order_nr; ?></td>
                            <td><?php echo $total_price; ?>€</td>
                            <td><?php echo $total_qty; ?></td>
                            <td><?php echo $order_date; ?></td>


                            <td>
                                <?php
                                // Bestellt, In Lieferung, Geliefert, Storniert

                                if($status=="bestellt")
                                {
                                    echo "<label>$status</label>";
                                }
                                elseif($status=="in lieferung")
                                {
                                    echo "<label style='color: orange;'>$status</label>";
                                }
                                elseif($status=="geliefert")
                                {
                                    echo "<label style='color: green;'>$status</label>";
                                }
                                elseif($status=="abgebrochen")
                                {
                                    echo "<label style='color: red;'>$status</label>";
                                }
                                ?>
                            </td>

                            <td><?php echo $customer_surname; ?></td>
                            <td>
                                <a href="<?php echo URLRACINE; ?>admin/orderUpdate.php?id=<?php echo $id; ?>" class="button1">Bestellung aktualisiren</a>
                            </td>
                        </tr>

                        <?php

                    }
                }
                else
                {
                    //Bestellung nicht verfügbar
                    echo "<tr><td colspan='12' class='error'>Keine bestellung vorhanden</td></tr>";
                }
                ?>


            </table>
        </div>

    </div>

    <?php include('partials/footer.php'); ?>
