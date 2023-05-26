<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include 'DbConnect.php';
  $user = json_decode(file_get_contents('php://input'));
  // $email = $user->email;
  // $sql_crud = "SELECT * from crime where email = '$email'";
  // $result = mysqli_query($conn, $sql_crud);
  // $row_crud = mysqli_fetch_array($result);


  $sql_customer = "SELECT * from crime_record";
  $result_customer = mysqli_query($conn, $sql_customer);
  $num = mysqli_num_rows($result_customer);

  if ($num > 0) {
    echo "<table id='table' class='table table-light table-bordered table-striped my-4'>";
    echo "<thead class='table-primary'>";
    echo "<tr>";
    echo "<th scope='col'>S_No</th>";

    echo "<th scope='col'>Crime Title</th>";

    echo "<th scope='col'>Crime Address</th>";
    echo "<th scope='col'>Crime Type</th>";
    echo "<th scope='col'>Location Map Latitude</th>";
    echo "<th scope='col'>Location Map Longitude</th>";
    echo "<th scope='col'>Crime Description/th>";

    echo "<th scope='col'></th>";

    echo "</tr>";
    echo "</thead>";
    $i = 0;
    while ($row = mysqli_fetch_assoc($result_customer)) {

      echo "<tr>";
      echo "<td scope='row'>" . $i + 1 . "</td>";
      echo "<td>" . $row['crimetitle'] . "</td>";
      echo "<td>" . $row['crimeaddress'] . "</td>";
      echo "<td>" . $row['crimetype'] . "</td>";
      echo "<td>" . $row['location_map_latitude'] . "</td>";
      echo "<td>" . $row['location_map_longitude'] . "</td>";
      echo "<td>" . $row['crime_desc'] . '</td>';
      echo "<td><div class='dropdown'>
                <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                  Select
                </button>
                <ul class='dropdown-menu'>
                  <li><a class='dropdown-item' name=" . $row['s_no'] . " onclick='payment(this)'>Add Payment</a></li>
                  <li><a class='dropdown-item' name=" . $row['s_no'] . " onclick='removecustomer(this)' >Delete</a></li>
                </ul>
              </div></td>";

      echo "</tr>";
      $i++;
    }
    echo "</table>";
  } else {
    echo "No Data Found";
  }


}
?>