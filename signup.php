<!DOCTYPE html>
<?php require __DIR__ . "/config/globalpath.php"; ?>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Link zur OpenSource Bootstrap CSS Datei -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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

    <title>Account erstellen</title>

    <link rel="stylesheet" href="assets/css/register.css">
</head>
<body>

<div class="container">
    <div class="wrapper-main">
        <h1 id="signuptitle"> Registrierung </h1>
        <?php
        if (isset($_GET['error'])) {
            if ($_GET["error"] == "emptyfieldssignup") {
                $bold = "Ups! ";
                $message = "Die Felder sind nicht ausgefüllt!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET["error"] == "invalidusernamemail") {
                $bold = "Ups! ";
                $message = "Benutzername und E-Mail-Adresse sind falsch!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET["error"] == "invalidusername") {
                $bold = "Ups! ";
                $message = "Benutzername ist falsch!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET["error"] == "invalidmail") {
                $bold = "Ups! ";
                $message = "E-Mail-Adresse ist falsch!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET["error"] == "passwordCheck") {
                $bold = "Ups! ";
                $message = "Passwörter stimmen nicht überein!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET["error"] == "usertaken") {
                $bold = "Ups! ";
                $message = "Benutzername ist bereits vergeben!";
                echo ' <br>
                            <div class="container">
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
            } else if ($_GET['error'] == "success") {
                $bold = "Yes! ";
                $message = "User ist gespeichert!";
                echo ' <br>
                            <div class="container">
                                <div class="alert alert-success" role="alert">
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
        <form class="form-signup" action="includes/sign.inc.php" method="post">
            <div class="form-group">
                <label for="user_name">Benutzername</label>
                <input class="form-control" id="user_name" type="text" name="user_name" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="mail"> E-Mail-Adresse</label>
                <input class="form-control" id="email" type="text" name="email" placeholder="E-mail">
            </div>
            <div class="form-group">
                <label for="password"> Passwort </label>
                <input class="form-control" id="password" type="password" name="pwd" placeholder="Passwort">
            </div>
            <div class="form-group">
                <label for="passwordrepeat"> Passwort wiederholen </label>
                <input class="form-control" id="password-repeat" type="password" name="pwd_repeat"
                       placeholder="Passwort wiederholen">
            </div>
            <div class="form-group">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="signup-submit" name="signup-submit">
                    Registrieren
                </button>
            </div>
            <div class="container" style="text-align: center">
                <a class="text-reset" href="signin.php" style=>Hast du einen Account? Hier zu Anmelden!</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
