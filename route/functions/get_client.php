<?php
// Include your database connection file
include '../../connection/database.php';

// Check if position_id is set in the POST request
if(isset($_POST['client_id'])) {
    // Sanitize the input to prevent SQL injection
    $client_id = mysqli_real_escape_string($conn, $_POST['client_id']);

    // Query to fetch position name from tbl_position based on position_id
    $sql = "SELECT Company_Name FROM tbl_client WHERE Client_ID = '$client_id'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if query executed successfully
    if($result) {
        // Fetch the position name from the result
        $row = mysqli_fetch_assoc($result);
        $company = $row['Company_Name'];

        // Prepare response as JSON
        $response = array('client_name' => $company);
        echo json_encode($response);
    } else {
        // Error handling if query fails
        echo json_encode(array('error' => 'Unable to fetch Client Name'));
    }
} else {
    // Error handling if position_id is not set
    echo json_encode(array('error' => 'Client ID not provided'));
}
?>
