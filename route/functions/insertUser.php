<?php

include "../../connection/database.php";

$firstName = $_POST['userFirstName'];
$midInitial = $_POST['userMiddleInitial'];
$lastName = $_POST['userLastName'];
$userName = $_POST['createUsername'];
$password = $_POST['createPassword'];
$userRole = $_POST['createUserRole'];
$position = $_POST['createPosition'];

// Execute the INSERT query
$result = $conn->query("INSERT INTO tbl_user_management (firstname, middleinitial, lastname, username, password, user_role, position)
VALUES ('$firstName', '$midInitial', '$lastName','$userName', '$password', '$userRole', '$position')");

// Check if the INSERT query was successful
if ($result === false) {
    // If insertion failed, construct an error response
    $response = array(
        'status' => 'error',
        'message' => 'Failed to insert record into the database'
    );
} else {
    $positionResult = $conn->query("SELECT Title FROM tbl_position WHERE position_ID = '$position'");
    if ($positionResult === false) {
        $response = array(
            'status' => 'error',
            'message' => 'Failed to fetch position title from the database'
        );
    } else {
        if ($positionResult->num_rows > 0) {
            // Fetch the Title from the result set
            $positionData = $positionResult->fetch_assoc();
            $positionTitle = $positionData['Title'];

            // Fetch the corresponding user role from tbl_user_role
            $userRoleResult = $conn->query("SELECT user_role FROM tbl_user_role WHERE user_role_id = '$userRole'");
            if ($userRoleResult === false) {
                $response = array(
                    'status' => 'error',
                    'message' => 'Failed to fetch user role from the database'
                );
            } else {
                if ($userRoleResult->num_rows > 0) {
                    $userRoleData = $userRoleResult->fetch_assoc();
                    $userRoleName = $userRoleData['user_role'];

                    // Construct the success response including position title and user role
                    $response = array(
                        'status' => 'success',
                        'message' => 'New record inserted successfully!',
                        'firstname' => $firstName,
                        'middleinitial' => $midInitial,
                        'lastname' => $lastName,
                        'username' => $userName,
                        'password' => $password,
                        'user_role' => $userRoleName,
                        'position' => $positionTitle,
                    );
                } else {
                    // No user role found
                    $response = array(
                        'status' => 'error',
                        'message' => 'No user role found for the inserted record'
                    );
                }
            }
        } else {
            // No position title found
            $response = array(
                'status' => 'error',
                'message' => 'No position title found for the inserted record'
            );
        }
    }
}

// Encode the response array into JSON format
$jsonResponse = json_encode($response);

// Set the proper Content-Type header to indicate JSON data
header('Content-Type: application/json');

// Output the JSON response
echo $jsonResponse;

// Close the database connection
$conn->close();
?>
