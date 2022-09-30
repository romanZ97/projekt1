<?php include('../admin/config/constants.php'); ?>

<html lang="de">
    <head>
        <title>Login - Administratoren </title>
        <link rel="stylesheet" href="/admin/assets/css/admin.css">
        <link rel="stylesheet" href="/admin/assets/css/admin2.css">
    </head>

    <body>
    <?php
    if(isset($_SESSION['login']))
    {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }


    if(isset($_SESSION['no-login-message']))
    {
        echo $_SESSION['no-login-message'];
        unset($_SESSION['no-login-message']);
    }
    ?>
        <div class="login">
            <h1 class="text-centerLogin">Login als Admin</h1>

            <!-- Das Loginformular beginn hier  -->
            <form class="box" action="" method="POST">

                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Passwort" required>
                <input type="submit" name="submit">

            </form>
            <!-- Das Loginformular endet hier  -->



        </div>

    </body>
</html>


<?php 

    //Überprüfen, ob auf die Schaltfläche „Login“ geklickt wurde oder nicht
    if(isset($_POST['submit']))
    {
        //Prozess für die Anmeldung
        //Daten aus dem Formuar holen.
        $username = mysqli_real_escape_string($conn, $_POST['username']); //diese Funktion erlaubt keine SQL-Injection
        
        $raw_password = md5($_POST['password']); //--> md5 verschlüssung OWASP TOP 10
        $password = mysqli_real_escape_string($conn, $raw_password);

        // SQL-Abfrage, um zu prüfen, ob der Benutzer mit Benutzername und Passwort existiert oder nicht
        $sql = "SELECT * FROM admin_manage WHERE username='$username' AND password='$password'";

        // die Abfrage ausführen
        $res = mysqli_query($conn, $sql);

        // Zeilen zählen, um zu prüfen, ob der Benutzer existiert oder nicht
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Benutzer verfügbar und Anmeldung erfolgreich
            $_SESSION['login'] = "<div class='success'>Sie haben sich erfolgreich eingeloggt</div>";
            $_SESSION['user'] = $username; //Um zu überprüfen, ob der Benutzer angemeldet ist oder nicht, und durch Abmelden wird es deaktiviert

            //Gehe zur Dashbord
            header('location:'.URLRACINE.'adminManage/index.php');
        }
        else
        {
            //Benutzer nicht verfügbar und Anmeldung fehlgeschlagen
            $_SESSION['login'] = "<div class='error text-center'>Der Benutzername oder das Passwort ist falsch</div>";
            //gehe zur Dashboard
            header('location:'.URLRACINE.'adminManage/login.php');
        }


    }

?>