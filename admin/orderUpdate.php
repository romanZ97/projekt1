<?php include('partials/header.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Bestellung aktualisieren</h1>
        <br><br>


        <?php 
        
            //Überprüfen, ob die ID festgelegt ist oder nicht
            if(isset($_GET['id']))
            {
                //Alle Infos zur Bestellung holen
                $id=$_GET['id'];

                //Select alle Info basiert auf ID
                //SQL-Abfrage, um die Bestelldetails abzurufen
                $sql = "SELECT * FROM ordering WHERE id=$id";
                //Abfrage ausführen
                $res = mysqli_query($conn, $sql);
                //Zeilen Zählen
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Bestelltinfos
                    $row=mysqli_fetch_assoc($res);

                    $dish_name = $row['dish_name'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address= $row['customer_address'];
                }
                else
                {
                    //Keine Info gefunden 
                    //gehe zur manage-order Seite
                    header('location:'.URLRACINE.'admin/orderManage.php');
                }
            }
            else
            {
                //gehe zur manage order Seite
                header('location:'.URLRACINE.'admin/orderManage.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Produktname</td>
                    <td><b> <?php echo $dish_name; ?> </b></td>
                </tr>

                <tr>
                    <td>Preis</td>
                    <td>
                        <b>  <?php echo $price; ?>€</b>
                    </td>
                </tr>

                <tr>
                    <td>Quantität</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="bestellt"){echo "selected";} ?> value="bestellt">Bestellt</option>
                            <option <?php if($status=="in lieferung"){echo "selected";} ?> value="in lieferung">In Lieferung</option>
                            <option <?php if($status=="geliefert"){echo "selected";} ?> value="geliefert">Geliefert</option>
                            <option <?php if($status=="abgebrochen"){echo "selected";} ?> value="abgebrochen">Abgebrochen</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Kundenname: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kundenkontakt: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kundenemail: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Kundenadress: </td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Bestellung aktualisieren" class="btn-secondary">
                    </td>
                </tr>
            </table>
        
        </form>


        <?php 
            //Überprüfen, ob der Button update angeklickt wurde oder nicht
            if(isset($_POST['submit']))
            {
                //infos holen
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;

                $status = $_POST['status'];

                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];

                //Werte aktualisieren
                $sql2 = "UPDATE ordering SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    WHERE id=$id
                ";

                //SQl-Abfrage ausführen
                $res2 = mysqli_query($conn, $sql2);

                //Überprüfen, ob es aktualisiert wurde oder nicht
                if($res2)
                {
                    //Bestellung aktualisieren
                    $_SESSION['update'] = "<div class='success'>Bestellung wurde erfolgreich aktualisiert</div>";
                }
                else
                {
                    //Bestellung wurde nicht aktualisiert
                    $_SESSION['update'] = "<div class='error'>Bestellung wurde nicht aktualisiert</div>";
                }
                header('location:'.URLRACINE.'admin/orderManage.php');
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
