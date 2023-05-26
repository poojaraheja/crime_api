<?php

require 'cors.php';

include 'DbConnect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));


    $email = $user->email;
    $pass = $user->pass;
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $query = "SELECT * FROM `crud` WHERE `email`='$email';";

    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            $update = "UPDATE `crud` SET `password` = '$hash' WHERE `email` = '$email';";
            $run = mysqli_query($conn, $update);

            if ($run) {
                $response = '{"updated":1}';
                echo $response;
            } else {
                $response = '{"updated":0}';
                echo $response;

            }

        }

    } else {
        $response = '{"failed":1}';
        echo $response;
    }
}
?>