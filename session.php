<?php

require 'cors.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));

    $email = $user->email;

    $sql = "SELECT * from crud where email = '$email'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);

        $response = '{"first_name": "' . $row['first_name'] . '","last_name": "' . $row['last_name'] . '", "token": "' . $row['token'] . '"}';
        echo $response;

    } else {
        $response = '{"error": 1}';
        echo $response;
    }


}

?>