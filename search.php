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
    $search = $user->input;
    $date_select = $user->date_select;
    $type_select = $user->type_select;
    $order_by = $user->order_by;
    $date1 = $user->date1;
    $date2 = $user->date2;
    

    if ($type_select != '' && $order_by != '' && $date_select != '' && $search != '' && $date1 != '' && $date2 != '') {
        $sql = "SELECT * from lead where $type_select LIKE '{$search}%' AND id='$id_admin' AND $date_select <= '{$date2}%' AND $date_select >= '{$date1}%'  ORDER BY s_no $order_by ";

    } else {
        if ($type_select != '' && $order_by != '' && $search != '') {
            $sql = "SELECT * from lead where $type_select LIKE '{$search}%' AND id='$id_admin' ORDER BY s_no $order_by ";

        } else if ($type_select != '' && $date_select != '' && $search != '' && $date1 != '' && $date2 != '') {
            $sql = "SELECT * from lead where $type_select LIKE '{$search}%' AND id='$id_admin' AND $date_select <= '{$date2}%' AND $date_select >= '{$date1}%'  ORDER BY s_no DESC";

        } else if ($order_by != '' && $date_select != '' && $date1 != '' && $date2 != '') {
            $sql = "SELECT * from lead where  id='$id_admin' AND $date_select <= '{$date2}%' AND $date_select >= '{$date1}%'  ORDER BY s_no $order_by ";

        } else {
            if ($type_select != '' && $search != '') {
                $sql = "SELECT * from lead where $type_select LIKE '{$search}%' AND id='$id_admin'   ORDER BY s_no DESC";

            } else if ($type_select != '' && $order_by != '') {
                $sql = "SELECT * from lead where  id='$id_admin' ORDER BY s_no $order_by ";
            } else if ($search == '' && $type_select != '') {
                $sql = "SELECT * from lead where id='$id_admin'   ORDER BY s_no DESC";
            } else if ($order_by != '') {
                $sql = "SELECT * from lead where id='$id_admin' ORDER BY s_no $order_by ";

            } else if ($date_select != '' && $date1 != '' && $date2 != '') {
                $sql = "SELECT * from lead where id='$id_admin' AND $date_select <= '{$date2}%' AND $date_select >= '{$date1}%'  ORDER BY s_no DESC ";

            }
        }
    }
    if (isset($sql)) {
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            echo "<table class='table table-light table-bordered table-striped my-4'>";
            echo "<thead class='table-primary'>";
            echo "<tr>";
            echo "<th scope='col'>S_No</th>";

            echo "<th scope='col'>Name</th>";

            echo "<th scope='col'>Email</th>";
            echo "<th scope='col'>Contact No</th>";
            echo "<th scope='col'>walking Date</th>";
            echo "<th scope='col'>Created at</th>";
            echo "<th scope='col'>Lead source</th>";
            echo "<th scope='col'>Lead Agent</th>";
            echo "<th scope='col'></th>";
            echo "</tr>";
            echo "</thead>";
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {

                echo "<tr>";
                echo "<th scope='row'>" . $i + 1 . "</th>";
                echo "<td colspan='1'>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['contact_no'] . "</td>";
                echo "<td>" . $row['walking_date'] . "</td>";
                echo "<td>" . $row['created_at'] . "</td>";
                echo "<td>" . $row['lead_source'] . '</td>';
                echo "<td>" . $row['lead_agent'] . '</td>';
                echo "<td> <input type='button' name=" . $row['s_no'] . " class='btn-close' aria-label='Close' onclick='remove(this)' /> </td>";
                echo "</tr>";
                $i++;
            }
            echo "</table>";
        } else {
            echo "No Data Found";
        }
    } else {
        echo 'Please Select Valid Filter';
    }


}

?>