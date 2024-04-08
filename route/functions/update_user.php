<?php
// Assuming you have already connected to your database
//include "../connection/database.php";

include_once '../../connection/database.php';

// Validate if the 'employee_id' key exists and is not empty
if (!isset($_POST['user_id']) || empty($_POST['user_id'])) {
    $response = array('success' => false, 'message' => 'User ID is required');
    echo json_encode($response);
    exit; // Stop execution
}

// Retrieve the updated user data from the POST request
$userId = $_POST['user_id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$userRole = $_POST['user_role'];
$position = $_POST['position'];


// Update the employee record in the database
$query = "UPDATE tbl_user_management SET firstname=?, middlename=?, lastname=?, username=?,
password=?, user_role=?, position=? WHERE user_id=?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    // Check for errors in the prepare statement
    $errorMessage = mysqli_error($conn);
    $errorCode = mysqli_errno($conn);
    $response = array('success' => false, 'message' => "Error preparing statement: $errorMessage (Error Code: $errorCode)");
    echo json_encode($response);
    exit;
}

// Bind parameters and execute
$stmt->bind_param('ssssssss', 
$firstname, $middlename, $lastname, $username, $password, $userRole, $position, $userId);

$result = $stmt->execute();

if ($result) {
    // Return success response
    $response = array('success' => true, 'message' => 'Successully Updated');
    echo json_encode($response);

} else {
    // Return error response with details if available
    $errorMessage = mysqli_error($conn);
    $errorCode = mysqli_errno($conn);
    $response = array('success' => false, 'message' => 'Update Failed');
    echo json_encode($response);
}
?>
