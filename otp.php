<?php

require 'cors.php';

include 'DbConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));


    $email = $user->email;
    $otp = $user->otp;

    $query = "SELECT * FROM `crud` WHERE `email`='$email';";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);

            if ($result_fetch['verification_code'] == $otp) {
                $update = "UPDATE `crud` SET `status` = '1' WHERE `email` = '$email';";
                $run = mysqli_query($conn, $update);
                if ($run) {
                    $response = '{"verified":1}';
                    echo $response;
                }
            } else {
                if ($result_fetch['status'] == '1') {
                    $response = '{"verified_already":1}';
                    echo $response;
                } else if ($result_fetch['verification_code'] != $otp) {
                    $response = '{"incorrect":1}';
                    echo $response;

                }

            }

        }

    } else {
        $response = '{"failed":1}';
        echo $response;
    }
}
?>