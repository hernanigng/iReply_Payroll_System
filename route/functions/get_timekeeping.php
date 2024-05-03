<?php
// // Include necessary files and database connection
include_once '../../connection/database.php';

if(isset($_POST["id"])) {
    $id = $_POST["id"];

    if($conn) {
        // Prepare SQL query
        $query = "SELECT * FROM tbl_timekeeping WHERE timekeeping_ID ='$id'";

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
                echo "No data found for the given employee ID.";
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
