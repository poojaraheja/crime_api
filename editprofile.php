<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $phone = $user->phone;

    $email = $user->admin_email;


    $existsql = "SELECT * FROM crud where email='$email'";

    $result = mysqli_query($conn, $existsql);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $result_fetch = mysqli_fetch_assoc($result);
            $id = $result_fetch['id'];

            $update = "UPDATE `crud` SET `first_name` = '$first_name', `last_name` = '$last_name', `phone` = '$phone' WHERE `id` = '$id'";
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