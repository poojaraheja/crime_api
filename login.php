<?php


require 'cors.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));

    $email = $user->email;
    $password = $user->password;

    $sql = "SELECT * from crime where username = '$email'";

    $result = mysqli_query($conn, $sql);

    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);



        $result = mysqli_query($conn, $sql);
        if ($result) {
            session_start();

            $response = '{"logged": 1, "email": "' . $email . '"}';
            echo $response;
        }



    } else {
        $response = '{"register": 0}';
        echo $response;

    }


}

?>