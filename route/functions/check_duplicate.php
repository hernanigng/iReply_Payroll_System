<?php
// functions/check_duplicate.php

include_once '../../connection/database.php';

$dateFrm = $_POST['dateFrm'];
$dateTo = $_POST['dateTo'];

if ($conn === false) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

$query = "SELECT * FROM tbl_timekeeping WHERE date_from = ? AND date_to = ? ";
$stmt = $conn->prepare($query);

if ($stmt === false) {
    die(json_encode(['status' => 'error', 'message' => 'Failed to prepare statement: ' . $conn->error]));
}

$stmt->bind_param("ss", $dateFrm, $dateTo);
$stmt->execute();
$result = $stmt->get_result();

if ($result === false) {
    echo json_encode(['status' => 'error', 'message' => 'Query execution failed: ' . $stmt->error]);
} else {
    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['status' => 'duplicate']);
    } else {
        echo json_encode(['status' => 'success']);
    }
}

$stmt->close();
mysqli_close($conn);
?>
