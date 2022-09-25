<?php
require_once __DIR__ . "/../config/db_connect.php"; //TODO make with Main
require __DIR__ . "/../src/SignService.php";
$sInS = new SignService();

$globalpath = "http://localhost:8888/projekt1";

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: signin.php");
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

    $sql = "SELECT COUNT(*), id FROM user WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: $globalpath/signin.php?error=sqlerror");

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
        header("Location: ../signin.php?error=emptyfields");

    } else {


        // TODO - Set path for Message by Main
//        if(!mysqli_stmt_prepare($stmt, $sql)){
//            header("Location: $globalpath/views/signin.php?error=sqlerror");

                $user = $sInS->getUserByNameOrEmail($mail_username);

                $pwdCheck = password_verify($pwd, $user['password']);

                if($pwdCheck == false){
                    header("Location: $globalpath/signin.php?error=wrongpwd");

                } else {
                    session_start();
                    session_regenerate_id(true);

                    $user_id = $user['id'];

                    if( isset($_POST['remember-me']) ){
                        $days = 30;
                        $value = $sInS->encrypt($user_id);
                        setcookie("remember",$value,time()+ ($days * 24 * 60 * 60 * 1000));
                    }
//                    $_SESSION['user_id'] = $sInS->encrypt($user_id);
                    $_SESSION['user_id'] = $user_id;

                    header("Location: $globalpath/index.php?login=success");
                    exit();
                }

                // TODO - Set Path for Message bei Main
//            } else {
//                header("Location: $globalpath/signin.php?error=nouser");
//            }
//        }
    }
    exit();
}

