<?php
require_once __DIR__ . "/../config/db_connect.php";
require __DIR__ . "/../src/SignService.php";
$sInS = new SignService();

$globalpath = "/Projekt1";

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: views/signin.view.php");
        die();
    }
}

// Check if $_SESSION or $_COOKIE already set
if( isset($_SESSION["user_id"]) ){
    header("Location: $globalpath/index.php");
    exit();

}else if( isset($_COOKIE["remember"] )){

    // Decrypt cookie variable value
    $user_id = $sInS->decrypt($_COOKIE["remember"]);

    $sql = "SELECT COUNT(*), user_id FROM user WHERE user_id = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: $globalpath/views/signin.view.php?error=sqlerror");

    } else {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
        $count = $result["cntUser"];

        if( $count > 0 ){
            $_SESSION["userid"] = $user_id;
            header("Location: $globalpath/index.php");
            exit();
        }
    }
}


if(isset($_POST['login-submit'])) {

    $mail_username = mysqli_real_escape_string($conn, $_POST['mail-username']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    if(empty($mail_username) || empty($pwd)){
        header("Location: ../signin.view.php?error=emptyfields");

    } else {
        $sql = "SELECT * FROM user WHERE user_name=? OR email =?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: $globalpath/views/signin.view.php?error=sqlerror");

        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mail_username, $mail_username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row= mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($pwd, $row['password']);

                if($pwdCheck == false){
                    header("Location: $globalpath/views/signin.view.php?error=wrongpwd");

                } else {
                    session_start();
                    session_regenerate_id(true);

                    $user_id = $row['user_id'];

                    if( isset($_POST['remember-me']) ){
                        $days = 30;
                        $value = $sInS->encrypt($user_id);
                        setcookie("remember",$value,time()+ ($days * 24 * 60 * 60 * 1000));
                    }
//                    $_SESSION['user_id'] = $sInS->encrypt($user_id);
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['response']="Du bist angemeldet!";
                    $_SESSION['res_type']="success";

                    header("Location: $globalpath/index.php?login=success");
                    exit();
                }

            } else {
                header("Location: $globalpath/views/signin.view.php?error=nouser");
            }
        }
    }
    exit();
}

