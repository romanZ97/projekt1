<?php
if (!isset($_POST['signup-submit'])) {
    header("Location: ../signup.php");
    exit();

} else {
    require_once __DIR__ . "/../config/db_connect.php";
    require __DIR__ . "/../src/SignService.php";
    $SignupService = new SignService();

    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $pwd_repeat = $_POST['pwd_repeat'];


    if (empty($user_name) || empty($email) || empty($pwd)) {
        header("Location: ../signup.php?error=empty-fields-signup&user_name=" . $user_name . "&email=" . $email);
        exit();

    } else if (!$SignupService->checkMailValidation($email) && !$SignupService->checkUserNameValidation($user_name)) {
        header("Location: ../signup.php?error=invalid-mail&user_name");
        exit();

    } else if (!$SignupService->checkMailValidation($email)) {
        header("Location: ../signup.php?error=invalid-mail");
        exit();

    } else if (!$SignupService->checkUserNameValidation($user_name)) {
        header("Location: ../signup.php?error=invalid-user_name&mail=" . $email);
        exit();

    } else if (!$SignupService->checkPassword($pwd, $pwd_repeat)) {
        header("Location: ../signup.php?error=password-wrong");
        exit();

    } else {
        if ($SignupService->checkUser($user_name)) {
            header("Location: ../signup.php?error=usertaken&mail=" . $user_name);
            exit();

        } else {
            $SignupService->addUser($user_name, $email, $pwd);
            $user_id = $SignupService->getUserIdByName($user_name);

            header("Location: $this->globalpath/index.php?signup=success");
            exit();
        }
    }
}