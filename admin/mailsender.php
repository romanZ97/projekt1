<?php
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer();

$mail -> isSMTP();

$mail -> Host = "smtp.gmail.com";

$mail -> SMTPAuth = "true";

$mail -> SMTPSecure = "tls";

$mail -> Port = "587";

$mail ->Username = "junioryvan5@gmail.com";

$mail ->Password = "qtplwxmbnrgndyyy";

$mail ->Subject = "test email";

$mail ->setFrom("junioryvan5@gmail.com");

$mail ->Body = "Ihre email Nachricht";

$mail -> addAddress("junioryvan5@gmail.com");

if($mail -> Send()){
    echo "die email wurde verschikt";
}else {
    echo "es gab einen Fehler".$mail -> ErrorInfo;
};

$mail ->smtpClose();
