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
    $date = $user->date;

    $email = $user->email;

    $contactnumber = $user->contactnumber;
    $leadsource = $user->leadsource;
    $leadagent = $user->leadagent;

    $existsql = "INSERT INTO `lead` (`s_no`, `name`, `walking_date`, `created_at`, `email`, `contact_no`, `lead_source`, `lead_agent`, `id`) VALUES (null, '$name', '$date',current_timestamp(), '$email', '$contactnumber', '$leadsource', '$leadagent', '$id');";
    $result = mysqli_query($conn, $existsql);
    $response = '{"create":1}';
    echo $response;





}
?>