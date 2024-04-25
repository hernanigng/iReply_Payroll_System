<?php
include "../../connection/database.php";

if(isset($_POST['employee_id'])) {
    $employeeId = $_POST['employee_id'];
    //echo $employeeId;

    $sql = "SELECT daily_rate FROM tbl_employee WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $employeeId); // Use "s" for string parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $dailyRate = $row['daily_rate'];

        echo $dailyRate;
    } else {
        echo "Employee not found";
    }
} else {
    echo "Employee ID not provided";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
