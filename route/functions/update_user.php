<?php
// Assuming you have already connected to your database
include_once '../../connection/database.php';

// Validate if the 'user_management_id' key exists and is not empty
if (!isset($_POST['user_management_id']) || empty($_POST['user_management_id'])) {
    $response = array('success' => false, 'message' => 'User ID is required');
    echo json_encode($response);
    exit; // Stop execution
}

// Retrieve the updated user data from the POST request
$userId = $_POST['user_management_id'];
$firstname = $_POST['firstname'];
$middleinitial = $_POST['middleinitial'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$userRole = $_POST['user_role'];
$position = $_POST['position'];

// Update the user record in the database
$query = "UPDATE tbl_user_management SET firstname=?, middleinitial=?, lastname=?, username=?,
password=?, user_role=?, position=? WHERE user_management_id=?";

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
$firstname, $middleinitial, $lastname, $username, $password, $userRole, $position, $userId);

$result = $stmt->execute();

if (!$result) {
    // Return error response with details if available
    $errorMessage = mysqli_error($conn);
    $errorCode = mysqli_errno($conn);
    $response = array('success' => false, 'message' => 'Update Failed: ' . $errorMessage);
    echo json_encode($response);
    exit;
}

// After updating the user data, fetch the position title based on the position ID
$queryPosition = "SELECT Title FROM tbl_position WHERE position_ID = ?";
$stmtPosition = $conn->prepare($queryPosition);
$stmtPosition->bind_param('i', $position);
$stmtPosition->execute();
$resultPosition = $stmtPosition->get_result();

// Check if position exists
if ($resultPosition->num_rows === 1) {
    $rowPosition = $resultPosition->fetch_assoc();
    $positionTitle = $rowPosition['Title'];
} else {
    $positionTitle = "Unknown"; // Handle the case where position does not exist
}

// After updating the user data, fetch the user role based on the user role ID
$queryUserRole = "SELECT user_role FROM tbl_user_role WHERE user_role_id = ?";
$stmtUserRole = $conn->prepare($queryUserRole);
$stmtUserRole->bind_param('i', $userRole);
$stmtUserRole->execute();
$resultUserRole = $stmtUserRole->get_result();

// Check if user role exists
if ($resultUserRole->num_rows === 1) {
    $rowUserRole = $resultUserRole->fetch_assoc(); // Fetch the correct result set
    $userRole = $rowUserRole['user_role'];
} else {
    $userRole = "Unknown"; // Handle the case where user role does not exist
}

// Return success response with updated user data, position title, and user role
$response = array(
    'success' => true,
    'message' => 'Successfully Updated',
    'firstname' => $firstname,
    'middleinitial' => $middleinitial,
    'lastname' => $lastname,
    'username' => $username,
    'password' => $password,
    'user_role' => $userRole, // Correct variable name
    'position' => $positionTitle // Send position title instead of ID
);
echo json_encode($response);
?>
