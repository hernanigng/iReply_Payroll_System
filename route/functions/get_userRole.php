<?php
// Start the session to access session variables
session_start();

// Check if the user role is stored in the session
if(isset($_SESSION['user_role'])) {
    // Retrieve the user role from the session
    $userRole = $_SESSION['user_role'];

    // You can optionally perform any additional processing here

    // Prepare the response as an array
    $response = array('user_role' => $userRole);

    // Send the JSON response
    echo json_encode($response);
} else {
    // If the user role is not set in the session, return an error message
    echo json_encode(array('error' => 'User role not found in session'));
}
?>
