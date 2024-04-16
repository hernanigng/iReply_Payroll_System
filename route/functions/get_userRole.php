<?php
// Include your database connection file
include '../../connection/database.php';

// Check if user_role_id is set in the POST request
if(isset($_POST['user_role_id'])) {
    // Sanitize the input to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['user_role_id']);

    // Query to fetch position name from tbl_position based on position_id
    $sql = "SELECT user_role FROM tbl_user_role WHERE user_role_id = '$id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if($result) {
        // Fetch the position name from the result
        $row = mysqli_fetch_assoc($result);
        $user_role = $row['user_role'];

        // Prepare response as JSON
        $response = array('user_role' => $user_role);
        echo json_encode($response);
    } else {
        // Error handling if query fails
        echo json_encode(array('error' => 'Unable to fetch position name'));
    }
} else {
    // Error handling if position_id is not set
    echo json_encode(array('error' => 'Position ID not provided'));
}
?>
