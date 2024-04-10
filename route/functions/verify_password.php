<?php

include_once '../../connection/database.php';

// Get the username and password sent via POST
$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$query = "SELECT password FROM tbl_user_management WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    // Query execution failed, handle the error
    echo json_encode(array(
        'status' => 'error',
        'message' => 'Error executing query'
    ));
    exit;
}

$data = mysqli_fetch_assoc($result);

if ($data) {
    // Password found, compare it with the provided password
    if ($password === $data['password']) {
        // Password is correct
        echo json_encode(array(
            'status' => 'success',
            'message' => 'Password verified'
        ));
    } else {
        // Incorrect password
        echo json_encode(array(
            'status' => 'error',
            'message' => 'Incorrect password'
        ));
    }
} else {
    // User not found
    echo json_encode(array(
        'status' => 'error',
        'message' => 'User not found'
    ));
}

// Close connection
mysqli_close($conn);
?>
