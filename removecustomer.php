<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));
    $email = $user->email;
    $sql_admin = "SELECT * from crud where email = '$email'";
    $result_admin = mysqli_query($conn, $sql_admin);
    $row_admin = mysqli_fetch_assoc($result_admin);
    $id_admin = $row_admin['id'];

    $s_no = $user->s_no;
    $sql_delete = "DELETE  FROM customer WHERE s_no=$s_no";
    $result_lead = mysqli_query($conn, $sql_delete);

    $sql_lead = "SELECT * from customer where id = '$id_admin' ORDER BY s_no DESC";

    $result_leads = mysqli_query($conn, $sql_lead);

    $num = mysqli_num_rows($result_leads);
    if ($num > 0) {
        echo "<table id='table' class='table table-light table-bordered table-striped  my-4'>";
        echo "<thead class='table-primary'>";
        echo "<tr>";
        echo "<th scope='col'>S_No</th>";

        echo "<th scope='col'>Name</th>";

        echo "<th scope='col'>Email</th>";
        echo "<th scope='col'>Contact No</th>";
        echo "<th scope='col'>Walking Date</th>";
        echo "<th scope='col'>Created at</th>";
        echo "<th scope='col'>Lead Agent</th>";
        echo "<th scope='col'>Lead Source</th>";
        echo "<th scope='col'></th>";
        echo "</tr>";
        echo "</thead>";
        $i = 0;
        while ($row = mysqli_fetch_assoc($result_leads)) {

            echo "<tr>";
            echo "<th scope='row'>" . $i + 1 . "</th>";
            echo "<td colspan='1'>" . $row['name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['contact_no'] . "</td>";
            echo "<td>" . $row['walking_date'] . "</td>";
            echo "<td>" . $row['created_at'] . "</td>";
            echo "<td>" . $row['lead_source'] . '</td>';
            echo "<td>" . $row['lead_agent'] . '</td>';
            echo "<td> <input type='button' name=" . $row['s_no'] . " class='btn-close' aria-label='Close' onclick='removecustomer(this)' /> </td>";
            echo "</tr>";
            $i++;
        }
        echo "</table>";
    } else {
        echo "No Data Found";
    }

}

?>