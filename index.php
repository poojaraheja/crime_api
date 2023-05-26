<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

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
        $mail->Body = '<h3>Thank You for Registration</h3>
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

    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $phone = $user->phone;

    $email = $user->email;
    $password = $user->password;



    $existsql = "SELECT * FROM crud where email='$email'";

    $result = mysqli_query($conn, $existsql);

    $numExistRows = mysqli_num_rows($result);

    if ($result) {
        if ($numExistRows > 0) {
            $response = '{"exist":1}';
            echo $response;

        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $otp = rand(100000, 999999);


            if (sendMail($email, $otp)) {

                $sql = "INSERT INTO `crud` (`id`, `first_name`, `last_name`, `phone`, `email`, `password`, `date`, `verification_code`, `status`, `token`, `admin`) VALUES (null, '$first_name', '$last_name','$phone', '$email', '$hash', current_timestamp(), '$otp', '0', '0','1');";

                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $response = '{"create":1}';
                    echo $response;
                } else {
                    $response = '{"error":1}';
                    echo $response;
                }


            } else {
                $response = '{"create":0}';
                echo $response;
            }
        }
    } else {
        $response = '{"error":1}';
        echo $response;
    }

}