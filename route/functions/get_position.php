<?php
// Include your database connection file
include '../../connection/database.php';

// Check if position_id is set in the POST request
if(isset($_POST['position_id'])) {
    // Sanitize the input to prevent SQL injection
    $position_id = mysqli_real_escape_string($conn, $_POST['position_id']);

    // Query to fetch position name from tbl_position based on position_id
    $sql = "SELECT Title FROM tbl_position WHERE position_ID = '$position_id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if($result) {
        // Fetch the position name from the result
        $row = mysqli_fetch_assoc($result);
        $position_name = $row['Title'];

        // Prepare response as JSON
        $response = array('position_name' => $position_name);
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
