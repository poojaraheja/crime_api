<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));

    $admin_email = $user->admin_email;


    $email = $user->email;
    $password = $user->password;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $existsql = "SELECT * FROM crud where email='$admin_email'";
    $result = mysqli_query($conn, $existsql);

    $numExistRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    if ($result) {
        $sql = "INSERT INTO `crud` (`id`,  `email`, `password`, `status`, `admin`) VALUES (null,'$email', '$hash', '1','$id');";
        $result_subadmin = mysqli_query($conn, $sql);
        if ($result_subadmin) {
            $response = '{"create":1}';
            echo $response;
        } else {
            $response = '{"error":1}';
            echo $response;
        }
    } else {
        $response = '{"error":0}';
        echo $response;
    }





}
?>