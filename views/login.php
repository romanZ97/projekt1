<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login.css">
    <?php
            if(isset($_GET['error'])){
                if($_GET["error"] == "emptyfields"){
                    $bold = "Ups! ";
                    $message = "Die Felder sind nicht ausgefüllt!";
                    echo ' <br>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
      </div>
    </div>

    <script type="text/javascript">
      setTimeout(function() {
        $(".alert").hide();
      }, 5000);
    </script>';
    }
    else if($_GET["error"] == "sqlerror"){
    $bold = "Ups! ";
    $message = "Benutzername oder E-Mail-Adresse ist falsch!";
    echo ' <br>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
      </div>
    </div>

    <script type="text/javascript">
      setTimeout(function() {
        $(".alert").hide();
      }, 5000);
    </script>';
    }
    else if($_GET["error"] == "wrongpwd"){
    $bold = "Ups! ";
    $message = "Passwort ist falsch!";
    echo ' <br>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
      </div>
    </div>

    <script type="text/javascript">
      setTimeout(function() {
        $(".alert").hide();
      }, 5000);
    </script>';
    }
    else if($_GET['error'] == "nouser") {
    $bold = "Ups! ";
    $message = "User ist nicht gefunden!";
    echo ' <br>
    <div class="container">
      <div class="alert alert-danger" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
      </div>
    </div>

    <script type="text/javascript">
      setTimeout(function() {
        $(".alert").hide();
      }, 5000);
    </script>';
    }
    else if($_GET['error'] == "mailsuccess") {
    $bold = "Yes! ";
    $message = "E-Mail ist gesendet!";
    echo ' <br>
    <div class="container">
      <div class="alert alert-success" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
      </div>
    </div>

    <script type="text/javascript">
      setTimeout(function() {
        $(".alert").hide();
      }, 5000);
    </script>';
    }
    else if($_GET['error'] == "passwordupdated") {
    $bold = "Yes! ";
    $message = "Dein Passwort ist aktualisiert!";
    echo ' <br>
    <div class="container">
      <div class="alert alert-success" role="alert">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>'.$bold.'</strong> '.$message.'
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
  </head>

  <body>
    <form class="box" action="/includes/sign_in.php" method="post">
      <h1>Go_Tasty!</h1>
      <h2>Lege jetzt dein Konto an!</h2>
      <input type="text" name="mail-username" placeholder="Username/E-mail" required>
      <input type="password" name="pwd" placeholder="Passwort" required>
      <input id="login-submit" name="login-submit" type="submit">
      <a href="register.html">Noch keinen Account? Jetzt registrieren!</a>
    </form>
  </body>
</html>
