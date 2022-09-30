<?php

require_once (__DIR__ . '/partials/header.php');
?>   <!-- Header hinzufügen (Inklusiv Verbindung mit der DB) -->

<div class="main-content">
<div class="wrapper">

        <h1>Gerichte verwalten</h1>
        <br /> <br />

    <!--  Gericht hinzufügen-->
    <a href="<?php echo URLRACINE; ?>admin/dishAdd.php" class="btn-primary">Gericht hinzufügen</a>
    <br /> <br /> <br>

            <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>


            <!-- Liste alle Gerichte -->

               <div class="container mt-5">

                   <table class="table table-borderless table-responsive card-1 p-4">
                       <thead>
                       <tr class="border-bottom">
                           <th>
                               <span class="ml-2">Nr.</span>
                           </th>
                           <th>
                               <span class="ml-2">Name des Gerichts</span>
                           </th>
                           <th>
                               <span class="ml-2">Preis</span>
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

            <?php 
                        // SQL-Abfrage, um das gesamte Produkt abzurufen
                        $sql = "SELECT * FROM food";

                        //die Abfrage ausführen
                        $res = mysqli_query($conn, $sql);

                        //Zeilen zeilen, um zu überprüfen, ob wir Lebensmittel haben oder nicht
                        $count = mysqli_num_rows($res);

                        //Seriennummer-Variable erstellen und Standardwert auf 1 setzen
                        $sn=1;

                        if($count>0)
                        {
                            //Wir haben Produkte in der Datenbank
                            //Holen Sie sich die Produkte aus der Datenbank und zeigen Sie sie an
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Holen Sie sich die Werte aus einzelnen Spalten
                                $id = $row['id'];
                                $title = $row['title'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];
                                ?>

                                <tr class="border-bottom">
                                    <td > <div class="p-2"> <span class="d-block font-weight-bold"><?php echo $sn++; ?>. </span></td>
                                    <td ><span class="d-block font-weight-bold"><?php echo $title; ?></span></td>
                                    <td><?php echo $price; ?>€</td>
                                    <td>
                                        <?php  
                                            //Überprüfen, ob wir ein Bild haben oder nicht
                                            if($image_name=="")
                                            {
                                                //wir haben kein Bild, Fehlermeldung anzeigen
                                                echo "<div class='error'>Kein Bild vorhanden</div>";
                                            }
                                            else
                                            {
                                                //wir haben ein Bild, dieses wird angezeigt.
                                                ?>
                                                <img src="<?php echo URLRACINE; ?>./assets/images/<?php echo $image_name; ?>" width="100px" class="rounded-circle" alt="bildkategorie">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $featured; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo URLRACINE; ?>admin/dishUpdate.php?id=<?php echo $id; ?>" class="button1">Gericht aktualisiren</a>
                                        <a href="<?php echo URLRACINE; ?>admin/dishDelete.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="button2">Gerict löschen</a>
                                    </td>

                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Product nicht in Datenbank hinzugefügt
                            echo "<tr> <td colspan='7' class='error'> Kein Gericht vorhanden </td> </tr>";
                        }

                    ?>
           </table>

</div>
</div>
</div>


<?php
require_once (__DIR__ . '/partials/footer.php'); //--> footer hinzufügen
?>