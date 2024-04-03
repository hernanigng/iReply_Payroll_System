<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];

// Use prepared statement to prevent SQL injection
$query = "SELECT * FROM tbl_user WHERE username = ? LIMIT 1";
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

if ($data && password_verify($password, $data['password'])) {
    // Authentication successful, proceed with session management
    $_SESSION['loginStatus'] = "ok";
    $_SESSION['firstname'] = $data['firstname'];
    $_SESSION['lastname'] = $data['lastname'];
    $_SESSION['role'] = $data['user_role'];

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
            'message' => '<span class="alert alert-danger col-md-12"> Username or password incorrect.</span>'
        )
    );
}

// Close connection
mysqli_close($conn);

?>
