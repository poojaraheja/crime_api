<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DbConnect.php';
    $user = json_decode(file_get_contents('php://input'));
    $payment_id = $user->payment_id;
    $email = $user->admin_email;
    $sql_crud = "SELECT * FROM crud WHERE email = '$email'";
    $result_crud = mysqli_query($conn, $sql_crud);
    $row_crud = mysqli_fetch_assoc($result_crud);
    $id = $row_crud['id'];


    $sql = "SELECT * FROM payment WHERE id = '$id'";

    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num > 0) {
        echo "<table id='table' class='table table-light table-bordered table-striped my-4'>";
        echo "<thead class='table-primary'>";
        echo "<tr>";
        echo "<th scope='col'>S_No</th>";
        echo "<th scope='col'>Customer Name</th>";
        echo "<th scope='col'>Payment Date</th>";
        echo "<th scope='col'>Payment Mode</th>";
        echo "<th scope='col'>Amount To Pay</th>";
        echo "<th scope='col'>Discount</th>";
        echo "<th scope='col'>Discount Amount</th>";
        echo "<th scope='col'>Paid</th>";
        echo "<th scope='col'>Balance</th>";
        echo "<th scope='col'>Remaining Balance</th>";

        echo "</tr>";
        echo "</thead>";
        $i = 0;
        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>";
            echo "<th scope='row'>" . $i + 1 . "</th>";
            echo "<td colspan='1'>" . $row['customer_name'] . "</td>";
            echo "<td>" . $row['payment_date'] . "</td>";
            echo "<td>" . $row['payment_mode'] . "</td>";
            echo "<td>" . $row['amount_to_pay'] . "</td>";
            echo "<td>" . $row['discount'] . "</td>";
            echo "<td>" . $row['discount_amount'] . "</td>";
            echo "<td>" . $row['paid'] . "</td>";
            echo "<td>" . $row['balance'] . "</td>";
            echo "<td>" . $row['remaining_balance'] . '</td>';
            // echo "<td><div class='dropdown'>
            //     <button class='btn btn-secondary dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
            //       Select
            //     </button>
            //     <ul class='dropdown-menu'>
            //       <li><a class='dropdown-item' name=" . $row['s_no'] . " onclick='payment(this)'>Add Payment</a></li>
            //       <li><a class='dropdown-item' name=" . $row['s_no'] . " onclick='removecustomer(this)' >Delete</a></li>
            //     </ul>
            //   </div></td>";

            echo "</tr>";
            $i++;
        }
        echo "</table>";
    } else {
        echo "No Data Found";
    }


}
?>