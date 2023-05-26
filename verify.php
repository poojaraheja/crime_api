<?php

require 'cors.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendMail($email, $otp)
{

    require('PHPMailer/PHPMailer.php');
    require('PHPMailer/SMTP.php');
    require('PHPMailer/Exception.php');

    $mail = new PHPMailer(true);



    try {
        $mail->isSMTP(); //Send using SMTP
        $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
        $mail->SMTPAuth = true; //Enable SMTP authentication
        $mail->Username = 'loginpage219@gmail.com'; //SMTP username
        $mail->Password = 'pchrphgbbmsgjrfa'; //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
        $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('loginpage219@gmail.com', 'Mag Clouds Solutions');
        $mail->addAddress($email);

        //Content
        $mail->isHTML(true); //Set email format to HTML
        $mail->Subject = 'Email Verification from Mag Clouds Solutions';
        $mail->Body = '<h3>Reset Your Password using the One Time Password</h3>
      </br>
      <h7>Your Verification Code: <Strong>' . $otp . '</strong></h7>';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));

    $email = $user->email;


    $existsql = "SELECT * FROM crud where email='$email'";

    $result = mysqli_query($conn, $existsql);

    $numExistRows = mysqli_num_rows($result);

    if ($numExistRows > 0) {

        $otp = rand(100000, 999999);
        $update = "UPDATE `crud` SET `verification_code` = '$otp' WHERE `email` = '$email';";
        $run = mysqli_query($conn, $update);


        if (sendMail($email, $otp) && $run) {

            $response = '{"exist":1}';
            echo $response;
        }

    } else {
        $response = '{"exist":0}';
        echo $response;

    }
}