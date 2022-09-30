<?php
include('partials/header.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
?>

<div class="main-content">
    <div class="wrapper">
        <h1>Buchung aktualisieren</h1>
        <br><br>


        <?php 
        
            //Überprüfen, ob die ID festgelegt ist oder nicht
            if(isset($_GET['id']))
            {
                //Alle Infos zur Bestellung holen
                $id=$_GET['id'];

                //Select alle Info basiert auf ID
                //SQL-Abfrage, um die Bestelldetails abzurufen
                $sql = "SELECT * FROM tbl_reservation WHERE id=$id";
                //Abfrage ausführen
                $res = mysqli_query($conn, $sql);
                //Zeilen Zählen
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Bestelltinfos
                    $row=mysqli_fetch_assoc($res);

                    $reservation_nr = $row['reservation_nr'];
                    $reservation_status	 = $row['reservation_status'];
                    $reservation_date = $row['reservation_date'];
                    $reservation_time = $row['reservation_time'];
                    $customer_name = $row['customer_name'];
                    $customer_email = $row['customer_email'];
                    $customer_contact = $row['customer_contact'];
                    $message = $row['message'];
                }
                else
                {
                    //Keine Info gefunden 
                    //gehe zur manage-order Seite
                    header('location:'.URLRACINE.'admin/reservationManage.php');
                }
            }
            else
            {
                //gehe zur manage order Seite
                header('location:'.URLRACINE.'admin/reservationManage.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Kundenname</td>
                    <td><b> <?php echo  $customer_name ; ?> </b></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>
                        <b>  <?php echo $customer_email; ?></b>
                    </td>
                </tr>


                <tr>
                    <td>Kontaktnummer</td>
                    <td>
                        <b>  <?php echo $customer_contact; ?></b>
                    </td>
                </tr>


                <tr>
                    <td>Stand</td>
                    <td>
                        <select name="status">
                            <option <?php if($reservation_status=="on wait"){echo "selected";} ?> value="on wait">gebucht</option>
                            <option <?php if($reservation_status=="done"){echo "selected";} ?> value="done">bestätigt</option>
                            <option <?php if($reservation_status=="cancelled"){echo "selected";} ?> value="cancelled">abbrechen</option>
                        </select>
                    </td>
                </tr>



                <tr>
                    <td>Buchungsnummer: </td>
                    <td>
                        <b> <?php echo $reservation_nr; ?></b>
                    </td>
                </tr>


                <tr>
                    <td>Nachricht des Kunden: </td>
                    <td>
                        <p> <?php echo $message ?></p>
                    </td>
                </tr>


                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Buchung aktualisieren" class="button1">
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
                $reservation_status	 = $_POST['status'];



                //Werte aktualisieren
                $sql2 = "UPDATE tbl_reservation SET 
                    reservation_status = '$reservation_status'
                    WHERE id=$id
                ";

                //SQl-Abfrage ausführen
                $res2 = mysqli_query($conn, $sql2);

                //Überprüfen, ob es aktualisiert wurde oder nicht
                if($res2 and $reservation_status == "done")
                {

                    //Bestellung aktualisieren
                 //   $_SESSION['update'] = "<div class='success'>Buchung wurde erfolgreich aktualisiert</div>";

                  $sql3 = "SELECT * FROM tbl_reservation WHERE id=$id";

                   $res3 = mysqli_query($conn, $sql3);

                    $row=mysqli_fetch_assoc($res3);

                    $customer_email = $row['customer_email'];
                    $customer_contact = $row['customer_contact'];
                    $customer_name = $row['customer_name'];
                    $reservation_date = $row['reservation_date'];
                    $reservation_time = $row['reservation_time'];
                    $reservation_status	= "Bestätigt";
                    $reservation_nr = $row['reservation_nr'];

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
                                       
                          <h1>Vielen Dank f&uuml;r Ihre Reservierung</h1>
                      
                          <p>Ihre reservierung wurde best&auml;tigt, Sie haben folgenden Termin reserviert</p>
                          <table>
                            <tr>
                              <th> Ihr Name </th> <th>Datum</th> <th>Uhrzeit</th>    <th>Status</th>  
                       
                            </tr>
                            <tr>
                              <td>$customer_name</td><td>$reservation_date</td><td>$reservation_time</td><td> best&auml;tig</td>
                            </tr>
                            
                          </table>
                        ";

                    try {
                        $mail->addAddress($customer_email);
                    } catch (Exception $e) {
                    }

                    try {
                        if ($mail->Send()) {
                            $_SESSION['update'] = "<div class='success'>Buchung wurde erfolgreich aktualisiert und der Kunde wurde darüber per Email informiert</div>";
                        } else {
                            echo "es gab einen Fehler" . $mail->ErrorInfo;
                        }
                    } catch (Exception $e) {
                    }

                    $mail ->smtpClose();

                } if($res2 and $reservation_status == "on wait"){

                $sql4 = "SELECT * FROM tbl_reservation WHERE id=$id";

                $res4 = mysqli_query($conn, $sql4);

                $row=mysqli_fetch_assoc($res4);

                $customer_email = $row['customer_email'];
                $customer_contact = $row['customer_contact'];
                $customer_name = $row['customer_name'];
                $reservation_date = $row['reservation_date'];
                $reservation_time = $row['reservation_time'];
                $reservation_status	= "in Bearbeitung";
                $reservation_nr = $row['reservation_nr'];

                $mail = new PHPMailer();

                $mail -> isSMTP();

                $mail -> Host = "smtp.gmail.com";

                $mail -> SMTPAuth = "true";

                $mail -> SMTPSecure = "tls";

                $mail -> Port = "587";

                $mail ->Username = "junioryvan5@gmail.com";

                $mail ->Password = "qtplwxmbnrgndyyy";

                $mail ->Subject = "Ihre Reservierrung wurde aktulisiert ";

                try {
                    $mail->setFrom("junioryvan5@gmail.com");
                } catch (Exception $e) {
                }

                $mail ->isHTML();

                $mail ->Body = "
                                       
                          <h1>Vielen Dank f&uuml;r Ihre Reservierung</h1>
                      
                          <p>Der Stand Ihrer reservierung wurde aktualisiert, Sie haben folgenden Termin reserviert</p>
                          <table>
                            <tr>
                              <th> Ihr Name </th> <th>Datum</th> <th>Uhrzeit</th>    <th>Status</th>  
                       
                            </tr>
                            <tr>
                              <td>$customer_name</td><td>$reservation_date</td><td>$reservation_time</td><td> $reservation_status</td>
                            </tr>
                            <p>Ihre Reservierung ist in Bearbeitung, Sie werden so fr&uuml;h wie m&ouml;glich dar&uuml;ber informiert, sobald den Termin best&auml;tigt wurde</p>
                          </table>
                        ";

                try {
                    if (!empty($customer_email)) {
                        $mail->addAddress($customer_email);
                    }
                } catch (Exception $e) {
                }

                try {
                    if ($mail->Send()) {
                        $_SESSION['update'] = "<div class='success'>Buchung wurde erfolgreich aktualisiert und der Kunde wurde darüber per Email informiert</div>";
                    } else {
                        echo "es gab einen Fehler" . $mail->ErrorInfo;
                    }
                } catch (Exception $e) {
                }

                $mail ->smtpClose();
            }if($res2 and $reservation_status == "cancelled"){

                $sql4 = "SELECT * FROM tbl_reservation WHERE id=$id";

                $res4 = mysqli_query($conn, $sql4);

                $row=mysqli_fetch_assoc($res4);

                $customer_email = $row['customer_email'];
                $customer_contact = $row['customer_contact'];
                $customer_name = $row['customer_name'];
                $reservation_date = $row['reservation_date'];
                $reservation_time = $row['reservation_time'];
                $reservation_status	= "abgebrochen";
                $reservation_nr = $row['reservation_nr'];

                $mail = new PHPMailer();

                $mail -> isSMTP();

                $mail -> Host = "smtp.gmail.com";

                $mail -> SMTPAuth = "true";

                $mail -> SMTPSecure = "tls";

                $mail -> Port = "587";

                $mail ->Username = "junioryvan5@gmail.com";

                $mail ->Password = "qtplwxmbnrgndyyy";

                $mail ->Subject = "Ihre Reservierung wurde storniert";

                try {
                    $mail->setFrom("junioryvan5@gmail.com");
                } catch (Exception $e) {
                }

                $mail ->isHTML();

                $mail ->Body = "
                                       
                          <h1>Ihre Reservierung wurde storniert</h1>
                      
                          <p>Sie haben folgenden Termin reserviert</p>
                          <table>
                            <tr>
                              <th> Ihr Name </th> <th>Datum</th> <th>Uhrzeit</th>    <th>Status</th>  
                       
                            </tr>
                            <tr>
                              <td>$customer_name</td><td>$reservation_date</td><td>$reservation_time</td><td> $reservation_status</td>
                            </tr>
                            
                          </table>
                          
                          <b> Leider haben wir keinen freien Platz mehr f&uuml;r dieses Datum, bitte w&auml;hlen Sie an anderes Datum aus</b>
                        ";

                try {
                    $mail->addAddress($customer_email);
                } catch (Exception $e) {
                }

                try {
                    if ($mail->Send()) {
                        $_SESSION['update'] = "<div class='success'>Buchung wurde erfolgreich aktualisiert und der Kunde wurde darüber per Email informiert</div>";
                    } else {
                        echo "es gab einen Fehler" . $mail->ErrorInfo;
                    }
                } catch (Exception $e) {
                }

                $mail ->smtpClose();
            }
                else
                {
                    //Bestellung wurde nicht aktualisiert
                   // $_SESSION['update'] = "<div class='error'>Buchung wurde nicht aktualisiert</div>";
                }
                header('location:'.URLRACINE.'admin/reservationManage.php');
            }
        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>
