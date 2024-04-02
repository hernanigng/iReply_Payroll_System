<?php
// Include database connection file
include_once '../../connection/database.php';

// Check if ID parameter is set
if (isset($_POST['id'])) {
    // Sanitize the ID to prevent SQL injection
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    // Perform the delete operation
    $query = "DELETE FROM tbl_client WHERE Client_ID = '$id'";
    $result = mysqli_query($conn, $query);

    // Check if delete operation was successful
    if ($result) {
        echo "Client deleted successfully";
    } else {
        // If delete operation failed, output the MySQL error message
        echo "Error deleting client: " . mysqli_error($conn);
    }
} else {
    // If ID parameter is not set, output an error message
    echo "Client ID not provided";
}
?>
