<?php
include "../../connection/database.php";

$year = $_GET['year'];
$month = $_GET['month'];
$query_tranx = "
    SELECT * FROM tbl_payroll_tranx 
    WHERE 
        (YEAR(periodcov_from) = '$year' AND MONTH(periodcov_from) = '$month') 
        OR 
        (YEAR(periodcov_to) = '$year' AND MONTH(periodcov_to) = '$month')
";
$result_tranx = $conn->query($query_tranx);


if ($result_tranx->num_rows > 0) {

      echo "<thead>";
    echo "<tr>";
    echo "<th>Employee Name</th>";
    echo "<th>Employee Status</th>";
    echo "<th>Earnings</th>";
    echo "<th>Deductions</th>";
    echo "<th>Incentives</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

        
    while ($row = $result_tranx->fetch_assoc()) {
        $employee_id = $row['employee_id'];
        $earnings_id = $row['earnings_id'];
        $incentives_id = $row['incentives_id'];
        $deductions_id = $row['deductions_id'];
        $netPay_id = $row['netPay_id'];

        // Fetch employee name
        $query_employee = "SELECT firstname, lastname, employment_status FROM tbl_employee WHERE employee_id = '$employee_id'";
        $result_employee = $conn->query($query_employee);
        $employee_name = '';
        if ($result_employee && $result_employee->num_rows > 0) {
            $employee_row = $result_employee->fetch_assoc();
            $employee_name = $employee_row['firstname'] . ' ' . $employee_row['lastname'];
            $employee_status = $employee_row['employment_status'];
        }

        // Fetch total earnings
        $query_earnings = "SELECT total_earnings FROM tbl_earnings WHERE earnings_id = '$earnings_id'";
        $result_earnings = $conn->query($query_earnings);
        $total_earnings = $result_earnings && $result_earnings->num_rows > 0 ? $result_earnings->fetch_assoc()['total_earnings'] : 'N/A';

        // Fetch total deductions
        $query_deductions = "SELECT total_deductions FROM tbl_deductions WHERE deductions_id = '$deductions_id'";
        $result_deductions = $conn->query($query_deductions);
        $total_deductions = $result_deductions && $result_deductions->num_rows > 0 ? $result_deductions->fetch_assoc()['total_deductions'] : 'N/A';

        // Fetch total incentives
        $query_incentives = "SELECT total_incentives FROM tbl_incentives WHERE incentives_id = '$incentives_id'";
        $result_incentives = $conn->query($query_incentives);
        $total_incentives = $result_incentives && $result_incentives->num_rows > 0 ? $result_incentives->fetch_assoc()['total_incentives'] : 'N/A';

        // Output the table row
        echo "<tr>";
        echo "<td>$employee_name</td>";
        echo "<td>$employee_status</td>";
        echo "<td>$total_earnings</td>";
        echo "<td>$total_deductions</td>";
        echo "<td>$total_incentives</td>";
        echo "<td><center><button class='btn btn-primary' data-netPay_id='$netPay_id'>More Details</button></center></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No data available</td></tr>";
}
?>
