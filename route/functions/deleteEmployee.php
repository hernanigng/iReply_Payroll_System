<?php

include_once '../../connection/database.php';


if(isset($_POST['id'])) {
    $employeeId = $_POST['id'];
    $sql = "DELETE FROM tbl_employee WHERE employee_id = ?";

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("s", $employeeId); // Assuming employee_id is a string, change "s" to "i" if it's an integer

    if ($stmt->execute()) {
        echo "Employee deleted successfully";
    } else {
        echo "Error deleting employee: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Employee ID not provided";
}

$conn->close();

?>
