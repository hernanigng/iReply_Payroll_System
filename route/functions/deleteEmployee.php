<?php

include_once '../../connection/database.php';

if(isset($_POST['id'])) {
    $employeeId = $_POST['id'];

    // Start a transaction
    $conn->begin_transaction();

    // Delete records from tbl_payroll_tranx
    $sql_delete_payroll_tranx = "DELETE FROM tbl_payroll_tranx WHERE employee_id = ?";
    $stmt_payroll_tranx = $conn->prepare($sql_delete_payroll_tranx);
    $stmt_payroll_tranx->bind_param("s", $employeeId);

    // Delete records from tbl_employee
    $sql_delete_employee = "DELETE FROM tbl_employee WHERE employee_id = ?";
    $stmt_employee = $conn->prepare($sql_delete_employee);
    $stmt_employee->bind_param("s", $employeeId);

    // Execute both DELETE statements
    $delete_payroll_tranx_success = $stmt_payroll_tranx->execute();
    $delete_employee_success = $stmt_employee->execute();

    // Check if both DELETE statements were successful
    if ($delete_payroll_tranx_success && $delete_employee_success) {
        // Commit the transaction if both DELETE statements were successful
        $conn->commit();
        echo "Employee and related payroll transactions deleted successfully";
    } else {
        // Rollback the transaction if any DELETE statement failed
        $conn->rollback();
        echo "Error deleting employee or related payroll transactions";
    }

    // Close prepared statements
    $stmt_payroll_tranx->close();
    $stmt_employee->close();
} else {
    echo "Employee ID not provided";
}

// Close the database connection
$conn->close();

?>
