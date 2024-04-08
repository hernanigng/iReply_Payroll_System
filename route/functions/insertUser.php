<?php

include "../../connection/database.php";

$firstName = $_POST['userFirstName'];
$midInitial = $_POST['userMiddleInitial'];
$lastName = $_POST['userLastName'];
$userName = $_POST['createUsername'];
$password = $_POST['createPassword'];
$userRole = $_POST['createUserRole'];
$position = $_POST['createPosition'];

$result = $conn->query("INSERT INTO tbl_user_management (firstname, middleinitial, lastname, username, password, user_role, position)
VALUES ('$firstName', '$midInitial', '$lastName','$userName', '$password', '$userRole', '$position')");

if ($result === false) {
    // If insertion failed, construct an error response
    $response = array(
        'status' => 'error',
        'message' => 'Failed to insert record into the database'
    );
} else {
    // Query executed successfully
    // Construct the response array
    $response = array(
        'status' => 'success',
        'message' => 'New record inserted successfully!',
        'firstname' => $firstName,
        'lastname' => $lastName,
        'username' => $userName,
        'password' => $password,
        'user_role' => $userRole,
        'position' => $position
    );
}

// Encode the response array into JSON format
$jsonResponse = json_encode($response);

// Set the proper Content-Type header to indicate JSON data
header('Content-Type: application/json');

// Output the JSON response
echo $jsonResponse;

$conn->close();
?>
