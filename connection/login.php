<?php
session_start();

include "database.php";

$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM tbl_user_management WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    // Query execution failed, handle the error
    echo json_encode(
        array(
            'status' => 'fail',
            'message' => '<span class="alert alert-danger col-md-12">Error: ' . mysqli_error($conn) . '</span>'
        )
    );
    exit; // Stop further execution
}

$data = mysqli_fetch_array($result);

if ($data && $password === $data['password']) {
    // Authentication successful, proceed with session management
    $_SESSION['loginStatus'] = "ok";
    $_SESSION['username'] = $data['username'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['user_role'] = $data['user_role'];
    $_SESSION['position'] = $data['position'];
    $_SESSION['firstname'] = $data['firstname'];
    $_SESSION['lastname'] = $data['lastname'];
    $_SESSION['middleinitial'] = $data['middleinitial'];
    $_SESSION['user_id'] = $data['user_management_id']; // Add this line

    echo json_encode(
        array(
            'status' => 'success',
            'role' => $data['user_role'],
            'message' => '<span class="alert alert-success col-md-12"> Successfully verified. Please wait... </span>'
        )
    );
} else {
    // Authentication failed
    echo json_encode(
        array(
            'status' => 'fail',
            'message' => '<span class="alert alert-danger col-md-12"> incorrect username or password.</span>'
        )
    );
}

// Close connection
mysqli_close($conn);

?>