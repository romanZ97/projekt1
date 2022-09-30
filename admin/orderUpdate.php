<?php
include('partials/header.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
?>

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

                $order_nr = $row['order_nr'];
                $total_price  = $row['total_price'];
                $total_qty = $row['total_qty'];
                $status = $row['status'];
                $customer_surname = $row['customer_surname'];


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
                    <td>Gericht_Nr</td>
                    <td><b> <?php echo $order_nr; ?> </b></td>
                </tr>

                <tr>
                    <td>Preis</td>
                    <td>
                        <b>  <?php echo $total_price; ?>€</b>
                    </td>
                </tr>

                <tr>
                    <td>Quantität</td>
                    <td>
                        <input type="number" name="total_qty" value="<?php echo $total_qty; ?>">
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
                        <input type="text" name="customer_surname" value="<?php echo $customer_surname; ?>">
                    </td>
                </tr>


                <tr>
                    <td clospan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Bestellung aktualisieren" class="button1">
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

            $total_qty = $_POST['total_qty'];

            $status = $_POST['status'];

            $customer_surname = $_POST['customer_surname'];


            //Werte aktualisieren
            $sql2 = "UPDATE ordering SET 
                    total_qty = $total_qty,
                    status = '$status',
                    customer_surname = '$customer_surname'
                    WHERE id=$id
                ";

            //SQl-Abfrage ausführen
            $res2 = mysqli_query($conn, $sql2);

            //Überprüfen, ob es aktualisiert wurde oder nicht
            if($res2)
            {
                $sql3 = "SELECT * FROM ordering WHERE id=$id";

                $res3 = mysqli_query($conn, $sql3);

                $row=mysqli_fetch_assoc($res3);

                $total_qty = $row['total_qty'];

                $status = $row['status'];

                $customer_surname = $row['customer_surname'];

                $order_date = $row['order_date'];

                $customer_email = $row['customer_email']; // mail des empfänger

                $order_nr = $row['order_nr'];



                  $mail = new PHPMailer();

                    $mail -> isSMTP();

                    $mail -> Host = "smtp.gmail.com";

                    $mail -> SMTPAuth = "true";

                    $mail -> SMTPSecure = "tls";

                    $mail -> Port = "587";

                    $mail ->Username = "junioryvan5@gmail.com";

                    $mail ->Password = "qtplwxmbnrgndyyy";

                    $mail ->Subject = "Der Stand Ihre Reservierrung wurde aktulisiert ";

                    try {
                        $mail->setFrom("junioryvan5@gmail.com");
                    } catch (Exception $e) {
                    }

                    $mail ->isHTML();

                    $mail ->Body = "
                                       
                          <h1>Vielen Dank f&uuml;r Ihre Bestellung</h1>
                      
                          <p>der Stand Ihrer Bestellung wurde geändert</p>
                          <table>
                            <tr>
                            <th> Bestellungsnummer </th>  <th> Ihr Name </th> <th>Bestelldatum</th> <th>Status</th>  
                       
                            </tr>
                            <tr>
                              <td>$order_nr</td><td>$customer_surname</td><td>$order_date</td> <td>$status</td>
                            </tr>
                            
                          </table>
                        ";

                    try {
                        $mail->addAddress($customer_email);
                    } catch (Exception $e) {
                    }

                    try {
                        if ($mail->Send()) {
                            $_SESSION['update'] = "<div class='success'>Bestellung wurde erfolgreich aktualisiert und der Kunde wurde darüber per Email informiert</div>";
                        } else {
                            echo "es gab einen Fehler" . $mail->ErrorInfo;
                        }
                    } catch (Exception $e) {
                    }

                    $mail ->smtpClose();

                //Bestellung aktualisieren
               // $_SESSION['update'] = "<div class='success'>Bestellung wurde erfolgreich aktualisiert</div>";
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
