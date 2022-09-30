<?php
require __DIR__ . "/../src/SignService.php";
$sInS = new SignService();

function checkLogin()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: signin.php");
        die();
    }
}

// Check if $_SESSION or $_COOKIE already set
if( isset($_SESSION["user_id"]) ){
    header("Location: ../index.php");
    exit();

}else if( isset($_COOKIE["remember"] )){

    // Decrypt cookie variable value
    $user_id = $sInS->decrypt($_COOKIE["remember"]);

    $sql = "SELECT COUNT(*), id FROM user WHERE id = ?";
    $result = $sInS->loadDataWithParameters($sql, "i", array($user_id),"signin");
    $count = $result["cntUser"];

    if( $count > 0 ){
        $_SESSION["userid"] = $user_id;
        header("Location: ../index.php");
        exit();
    }
}


if(isset($_POST['login-submit'])) {

    $mail_username = $_POST["mail-username"];
    $pwd = $_POST["pwd"];

    if(empty($mail_username) || empty($pwd)){
        header("Location: ../signin.php?error=emptyfields");

    } else {
        $user = $sInS->getUserByNameOrEmail($mail_username,"signin");

        $pwdCheck = password_verify($pwd, $user['password']);

        if(!$pwdCheck){
            header("Location: ../signin.php?error=wrongpwd");

        } else {
            session_start();
            session_regenerate_id(true);

            $user_id = $user['id'];

            if( isset($_POST['remember-me']) ){
                $days = 30;
                $value = $sInS->encrypt($user_id);
                setcookie("remember",$value,time()+ ($days * 24 * 60 * 60 * 1000));
            }

            $_SESSION['user_id'] = $user_id;

            header("Location: ../index.php");
        }
    }
    exit();
}

if(isset($_POST['signout'])){
    session_start();
    session_unset();
    session_destroy();
    // Remove cookie variables
    $days = 30;
    setcookie ("remember","", time() - ($days * 24 * 60 * 60 * 1000));

    header("Location: ../index.php");
    exit();
}

if (!isset($_POST['signup-submit'])) {
    header("Location: ../signup.php");
    exit();

} else {

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_repeat = $_POST['pwd_repeat'];


    if (empty($user_name) || empty($email) || empty($pwd)) {
        header("Location: ../signup.php?error=empty-fields-signup&user_name=" . $user_name . "&email=" . $email);
        exit();

    } else if (!$sInS->checkMailValidation($email)) {
        header("Location: ../signup.php?error=invalid-mail");
        exit();

    } else if (!($pwd == $pwd_repeat)) {
        header("Location: ../signup.php?error=password-wrong");
        exit();

    } else {
        if ($sInS->checkUser($user_name, "signup")) {
            header("Location: ../signup.php?error=usertaken&mail=" . $user_name);
            exit();

        } else {
            $sInS->addUser($user_name, $email, $pwd);
            $user_id = $sInS->getUserIdByName($user_name, "signup");

            header("Location: ../signin.php?signup=success");
            exit();
        }
    }
}

