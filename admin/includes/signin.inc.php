<?php
require_once __DIR__ . "/../config/db_connect.php";
require __DIR__ . "/../src/SignService.php";
$sInS = new SignService();

// TODO Connect SignService to MAin
$globalpath = "http://localhost:8888/projekt1";

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: views/signin.php");
        die();
    }

}


if(isset($_POST['login-submit'])) {

    $mail_username = $_POST['mail-username'];
    $pwd = $_POST['pwd'];

    if(empty($mail_username) || empty($pwd)){
        header("Location: ../signin.php?error=emptyfields");

    } else {
        $sql = "SELECT * FROM user WHERE user_name=? OR email =?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: $globalpath/views/signin.php?error=sqlerror");

        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mail_username, $mail_username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row= mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($pwd, $row['password']); //TODO -------------------------------------------- Password sofort hashen => MD5 Method

                if($pwdCheck == false){
                    header("Location: $globalpath/views/signin.php?error=wrongpwd");

                } else {
                    session_start();
                    session_regenerate_id(true);
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['email'] = $row['email'];


                    $_SESSION['response']="Du bist angemeldet!";
                    $_SESSION['res_type']="success";
                    header("Location: $globalpath/index.php?login=success");
                    exit();
                }

            } else {
                header("Location: $globalpath/views/signin.php?error=nouser");
            }
        }
    }
    exit();
}
