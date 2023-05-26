<?php

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));

    $admin_email = $user->admin_email;
    $sql = "SELECT * from crud where email = '$admin_email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];


    $name = $user->name;
    $email = $user->email;
    $address = $user->address;
    $phone = $user->number;
    $date = $user->date;
    $customeragent = $user->customeragent;

    $existsql = "INSERT INTO `customer` (`s_no`, `name`, `email`, `phone`, `address`, `customer_agent`, `signup_date`, `id`) VALUES (null, '$name', '$email', '$phone', '$address', '$customeragent', '$date', '$id')";
    $result_customer = mysqli_query($conn, $existsql);
    $response = '{"create":1}';
    echo $response;



}

?>