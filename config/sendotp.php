<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendotp($email,$name){
    $mail = new PHPMailer(true);

    try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'programmingworld9516@gmail.com';                     //SMTP username
    $mail->Password   = 'pankaj@77';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('programmingworld9516@gmail.com', 'Pankaj Rathor');
    $mail->addAddress($email, $name);     //Add a recipient

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Forget Password';

    //random string and otp
    $randStr = uniqid();
    $otp = rand(1000,9999);
    $uniqArr = array($randStr,$otp);

    $mail->Body    = "Click link for forget password : http://localhost/AdminPanelWithBootstrap/config/verifyotp.php?id=$randStr  <br>You are OTP is : <b>$otp</b>";

    $mail->send();
    return $uniqArr;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}