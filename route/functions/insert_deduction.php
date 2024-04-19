<?php
include '../../connection/database.php';

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Generate a random 8-digit number for the deduction ID
    $deduction_id = mt_rand(10000000, 99999999);
    $sss = $_POST["sss"];
    $pagibig = $_POST["pagibig"];
    $philHealth = $_POST["philhealth"];
    $tax = isset($_POST["tax"]) ? $_POST["tax"] : 0; // Set default value if checkbox is not checked
    $absent = $_POST["absent"];
    $other = $_POST["otherDeductions"];
    $total = $_POST["totalDeductions"];

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO tbl_deductions (deductions_id, sss_con, pagibig_con, philhealth_con, withholding_tax, absent, other_deductions, total_deductions) 
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        // Bind parameters
        $stmt->bind_param("issssssd", $deduction_id, $sss, $pagibig, $philHealth, $tax, $absent, $other, $total);

        // Execute the statement
        if ($stmt->execute()) {
            // Return success response
            // Assuming the insertion is successful
         $response = array('success' => true);
         echo json_encode($response);     
        } else {
            // Return error response with details if available
            $errorMessage = $stmt->error;
            $errorCode = $stmt->errno;
            $response = array('success' => false, 'message' => $errorMessage);
            echo json_encode($response);
        }

        // Close statement
        $stmt->close();
    } else {
        // Return error response if the statement preparation failed
        $response = array('success' => false);
        echo json_encode($response);
    }

    // Close connection
    $conn->close();
} else {
    // Return error response if the request method is not POST
    $response = array('success' => false);
    echo json_encode($response);
}
?>
