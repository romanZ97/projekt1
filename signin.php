<!DOCTYPE html>
<?php
require __DIR__ . "/config/globalpath.php";
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: $globalpath/index.php");
}
?>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Link zur OpenSource Bootstrap CSS Datei -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Link zu den Opensource JavaScript Dateien von Bootstrap-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/blog/">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
            integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
            crossorigin="anonymous"></script>


    <title>Login</title>

    <link rel="stylesheet" href="assets/css/sign.css">

</head>


<body class="text-center">
<form class="form-signin" action="includes/sign.inc.php" method="post">
    <img class="mb-4" src="assets/images/logo.png" alt="logo" width="150" height="150">
    <input type="text" id="inputEmail" name="mail-username" class="form-control" placeholder="Username/E-Mail" required
           autofocus>
    <input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Password" required>
    <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Login merken
        </label>
    </div>
    <?php
    if (isset($_GET['error'])) {
        if ($_GET["error"] == "emptyfields") {
            $bold = "Ups! ";
            $message = "Die Felder sind nicht ausgefüllt!";
            echo '                         <div class="container">
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>' . $bold . '</strong> ' . $message . '
                            </div>
                        </div>
      
                        <script type="text/javascript">
                            setTimeout(function() {
                            $(".alert").hide(); 
                            }, 5000);
                        </script>';
        } else if ($_GET["error"] == "sqlerror") {
            $bold = "Ups! ";
            $message = "Benutzername oder E-Mail-Adresse ist falsch!";
            echo '                         <div class="container">
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>' . $bold . '</strong> ' . $message . '
                            </div>
                        </div>
      
                        <script type="text/javascript">
                            setTimeout(function() {
                            $(".alert").hide(); 
                            }, 5000);
                        </script>';
        } else if ($_GET["error"] == "wrongpwd") {
            $bold = "Ups! ";
            $message = "Passwort ist falsch!";
            echo '                         <div class="container">
                            <div class="alert alert-danger" role="alert">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>' . $bold . '</strong> ' . $message . '
                            </div>
                        </div>
      
                        <script type="text/javascript">
                            setTimeout(function() {
                            $(".alert").hide(); 
                            }, 5000);
                        </script>';
        } else if ($_GET['error'] == "nouser") {
            $bold = "Ups! ";
            $message = "User ist nicht gefunden!";
            echo '                            <div class="container">
                                <div class="alert alert-danger" role="alert">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        <strong>' . $bold . '</strong> ' . $message . '
                                </div>
                            </div>
        
                            <script type="text/javascript">
                                setTimeout(function() {
                                $(".alert").hide(); 
                                }, 5000);
                            </script>';
        }
    }
    ?>
    <button class="btn btn-lg btn-primary btn-block mb-5" id="login-submit" name="login-submit" type="submit" style="">
        Sign in
    </button>
    <a class="text-reset" href="signup.php">Noch keinen Account? Jetzt registrieren!</a>
</form>
</body>
</html>