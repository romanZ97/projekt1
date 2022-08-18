<!DOCTYPE html>
<?php $globalpath = "/Projekt1"; ?>
<html lang="de" >
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
            integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"
            integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s"
            crossorigin="anonymous"></script>

    <title>Login</title>

    <link rel="stylesheet" href="<?php echo $globalpath ?>/assets/css/sign.css">

</head>


<body class="text-center">
<form class="form-signin" action="<?php echo $globalpath ?>/includes/signin.inc.php" method="post">
    <img class="mb-4" src="<?php echo $globalpath ?>/assets/images/logo.png" alt="logo" width="150" height="150">
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
        } else if ($_GET['error'] == "mailsuccess") {
            $bold = "Yes! ";
            $message = "E-Mail ist gesendet!";
            echo '                             <div class="container">
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
        } else if ($_GET['error'] == "passwordupdated") {
            $bold = "Yes! ";
            $message = "Dein Passwort ist aktualisiert!";
            echo '                             <div class="container">
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
    <button class="btn btn-lg btn-primary btn-block mb-5" id="login-submit" name="login-submit" type="submit" style="">Sign in
    </button>
    <a class="text-reset" href="signup.view.php">Noch keinen Account? Jetzt registrieren!</a>
</form>
</body>
</html>