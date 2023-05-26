<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));
    $payment_id = $user->payment_id;
    $sql = "SELECT * from customer where s_no = '$payment_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {

        $response = '{"name": "' . $row['name'] . '"}';
        echo $response;
    } else {
        $response = '{"error": 1}';
        echo $response;
    }



}
?>