<?php

// Check if 'id' parameter is set
if(isset($_POST["id"])) {
    $id = $_POST["id"];

    // Establish database connection
    include_once '../../connection/database.php';

    // Check if connection is successful
    if($conn) {
        // Prepare SQL query
        $query = "SELECT firstname, middleinitial, lastname, username, password, 
            tbl_user_role.user_role AS user_role, tbl_position.Title AS position 
          FROM tbl_user_management
          INNER JOIN tbl_position ON tbl_user_management.position = tbl_position.position_ID
          INNER JOIN tbl_user_role ON tbl_user_management.user_role = tbl_user_role.user_role_id
          WHERE user_management_id = '$id'";

        // Execute query
        $result = mysqli_query($conn, $query);

        // Check if query was successful
        if($result) {
            // Fetch data
            $data = mysqli_fetch_assoc($result);

            // Check if data was fetched successfully
            if($data) {
                // Output fetched data as JSON
                echo json_encode($data);
            } else {
                echo "No data found for the given user ID.";
            }
        } else {
            // Query failed, handle error
            echo "Error executing query: " . mysqli_error($conn);
        }

        // Close connection
        mysqli_close($conn);
    } else {
        echo "Failed to connect to database.";
    }
} else {
    echo "No 'id' parameter provided.";
}

?>