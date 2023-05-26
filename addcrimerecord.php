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


    $crimetitle = $user->crimetitle;
    $crimeaddress = $user->crimeaddress;
    $location_map_latitude = $user->location_map_latitude;
    $mode = $user->mode;
    $location_map_longitude = $user->location_map_longitude;
    $crime_description = $user->crime_description;





    $existsql = "INSERT INTO `crime_record` (`s_no`, `crimetitle`, `crimeaddress`, `crimetype`, `location_map_latitude`, `location_map_longitude`, `crime_desc`) VALUES (null, '$crimetitle', '$crimeaddress', '$location_map_latitude', '$mode', '$location_map_longitude', '$crime_description');";

    $result_customer = mysqli_query($conn, $existsql);
    $response = '{"create":1}';
    echo $response;


}
?>