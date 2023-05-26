<?php


header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));
    $email = $user->email;
    $sql = "SELECT * FROM crime WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);


    $name = $user->name;
    $number = $user->number;
    $crimescenetitle = $user->crimescenetitle;
    $mode = $user->mode;
    $lattitude = $user->lattitude;
    $longitude = $user->$longitude;
    $desc = $user->description;

    $existsql = "INSERT INTO `crime_issue` (`s_no`, `name`, `number`, `crimescenetitle`, `mode`, `lattitude`, `longitude`, `desc`) VALUES (null, '$name', '$number', '$crimescenetitle', '$mode', '$lattitude', '$longitude', '$desc');";

    $result_customer = mysqli_query($conn, $existsql);
    $response = '{"create":1}';
    echo $response;


}
?>