
<?php

//Überprüfen, ob der Submit-Button angeklickt oder nicht ist
if(isset($_POST['submit']))
{

    //alle Werte aus dem Formular holen
    $id=$_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //Überprüfen, ob der Benutzer mit der aktuellen ID und dem aktuellen Passwort existiert oder nicht
    $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";

    //SQL-Abfrage ausführen
    $res = mysqli_query($conn, $sql);

    if($res) //wenn alles richtig geläufen ist.
    {
        //Überprüfen, ob Daten verfügbar sind oder nicht
        $count=mysqli_num_rows($res);

        if($count==1) //wenn der user existiert
        {
            //Benutzer existiert und Passwort kann geändert werden

            //Überprüfen, ob das neue Passwort und die Bestätigung übereinstimmen oder nicht
            if($new_password==$confirm_password)
            {
                //Passwort aktualisieren
                $sql2 = "UPDATE admin SET 
                                password='$new_password' 
                                WHERE id=$id
                            ";

                //SQl-Abfrage ausführen
                $res2 = mysqli_query($conn, $sql2);

                //Überprüfen, ob die Abfrage ausgeführt wurde oder nicht
                switch ($res2) {
                    case true:
                        //Erfolgsmeldung anzeigen
                        $_SESSION['change-pwd'] = "<div class='success'>Das Passwort wurde erfolgreich geändert </div>";
                        header('location:' . URLRACINE . 'admin/index.php');
                        break;
                    default:
                        //Fehlermeldung anzeigen
                        $_SESSION['change-pwd'] = "<div class='error'>Passwort konnte nicht geändert werden. </div>";
                        //Gehe zur Seite manage.admin.php
                        header('location:' . URLRACINE . 'admin/index.php');
                        break;
                }
            }
            else
            {
                //Fehlermeldung anzeigen
                $_SESSION['pwd-not-match'] = "<div class='error'>das Passwort überstimmt nicht ein </div>";
                //gehe zur Seite index.php
                header('location:'.URLRACINE.'admin/index.php');

            }
        }
        else
        {
            //Benutzer existiert nicht.
            $_SESSION['user-not-found'] = "<div class='error'>Dieses Passwort ist keinem User zugeoerdnet. </div>";
            //gehe zur Seite index.php
            header('location:'.URLRACINE.'admin/index.php');
        }
    }

}


