<?php
// Check if email and password are correct
    $conn = mysqli_connect("localhost","root","","ireply_payroll_db");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);


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

$count = mysqli_num_rows($result);

if ($count > 0) {
    // Authentication successful, proceed with session management
    session_start();
    $_SESSION['statusNamon'] = "ok";
    $_SESSION['firstname'] = $data['firstname'];
    $_SESSION['lastname'] = $data['lastname'];
    $_SESSION['password'] = $data['password'];
    $_SESSION['role'] = $data['user_role'];

    echo json_encode(
        array(
            'status' => 'success',
            'role' => $data['user_role'],
            'message' => '<span class="alert alert-success col-md-12"> Successully verified. Please wait... </span>'
        )
    );
} else {
    // Authentication failed
    echo json_encode(
        array(
            'status' => 'fail',
            'message' => '<span class="alert alert-danger col-md-12"> Username or password not exist.</span>'
        )
    );
}

// Close connection
mysqli_close($conn);


?>