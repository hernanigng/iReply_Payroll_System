<?php
// Include your database connection file
include "../../connection/database.php";

// Check if the employee ID is provided and valid
if(isset($_GET['employeeId']) && !empty($_GET['employeeId'])) {
    // Sanitize the input to prevent SQL injection
    $employeeId = $conn->real_escape_string($_GET['employeeId']);

    // Query to fetch the SSS, Pagibig, and PhilHealth contributions based on the employee ID
    $sql = "SELECT sss_con, pagibig_con, philhealth_con FROM tbl_employee WHERE employee_id = '$employeeId'";

    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            // Fetch the contributions
            $row = $result->fetch_assoc();
            $sssContribution = $row['sss_con'];
            $pagibigContribution = $row['pagibig_con'];
            $philhealthContribution = $row['philhealth_con'];
            // Output the contributions as JSON
            echo json_encode(array(
                'sss' => $sssContribution,
                'pagibig' => $pagibigContribution,
                'philhealth' => $philhealthContribution
            ));
        } else {
            // If no result found, output an error message
            echo "Contributions not found for the selected employee.";
        }
    } else {
        // If query failed, output database error message
        echo "Error: " . $conn->error;
    }
} else {
    // If employee ID is not provided, output an error message
    echo "Employee ID not provided.";
}

// Close the database connection
$conn->close();
?>
