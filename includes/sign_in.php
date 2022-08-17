<?php
function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        die();
    }

}


if(isset($_POST['login-submit'])) {
    require_once './config/db_connect.php';

    $mail_username = $_POST['mail-username'];
    $password = $_POST['pwd'];

    if(empty($mail_username) || empty($password)){
        header("Location: ../login.php?error=emptyfields");
        exit();

    } else {
        $sql = "SELECT * FROM user WHERE user_name=? OR email =?;";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../login.php?error=sqlerror");
            exit();

        } else {
            mysqli_stmt_bind_param($stmt, "ss", $mail_username, $mail_username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row= mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['pwd']);

                if($pwdCheck == false){
                    header("Location: ../login.php?error=wrongpwd");
                    exit();

                } else {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['user_name'] = $row['user_name'];
                    $_SESSION['email'] = $row['email'];
                    session_regenerate_id(true);

                    $_SESSION['response']="Du bist angemeldet!";
                    $_SESSION['res_type']="success";
                    header("Location: ../index.php?login=success");
                    exit();
                }

            } else {
                header("Location: ../login.php?error=nouser");
                exit();
            }
        }
    }
}
