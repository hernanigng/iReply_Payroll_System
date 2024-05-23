<?php
// functions/check_duplicate.php

include_once '../../connection/database.php'; // Ensure this path is correct

$dateFrm = $_POST['dateFrm'];
$dateTo = $_POST['dateTo'];
$employeeName = $_POST['employee_name']; // Adjust this line according to your form data

if ($conn === false) {
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed']);
    exit();
}

$query = "SELECT * FROM tbl_timekeeping WHERE date_from = ? AND date_to = ? AND employee_name = ?";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sss", $dateFrm, $dateTo, $employeeName);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    echo json_encode(['status' => 'error', 'message' => 'Query execution failed: ' . $stmt->error]);
} else {
    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'duplicate']);
    } else {
        echo json_encode(['status' => 'success']);
    }
}

$stmt->close();
$conn->close();
?>
