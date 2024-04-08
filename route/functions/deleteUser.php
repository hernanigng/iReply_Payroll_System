<?php
include "../../connection/database.php";

if(isset($_POST['id'])) {
    $userId = $_POST['id'];
    $sql = "DELETE FROM tbl_user_management WHERE user_management_id = ?";

    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("s", $userId); // Assuming employee_id is a string, change "s" to "i" if it's an integer

    if ($stmt->execute()) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "User ID not provided";
}

$conn->close();

?>
