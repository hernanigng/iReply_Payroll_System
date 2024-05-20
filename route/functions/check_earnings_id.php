<?php

include_once '../../connection/database.php';

if(isset($_POST['timekeeping_ID'])) {
    // Sanitize and retrieve the timekeeping_ID
    $timekeepingId = $_POST['timekeeping_ID'];

    // Prepare and execute the query to check if the earnings_id exists
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM tbl_payroll_tranx WHERE timekeeping_ID = ?");
    if($stmt) {
        $stmt->bind_param("i", $timekeepingId);
        $stmt->execute();
        $result = $stmt->get_result();

        // Fetch the result
        $row = $result->fetch_assoc();
        
        // Convert the count to a boolean value indicating if the earnings_id exists
        $exists = ($row['count'] > 0);

        // Return a JSON response with the result
        echo json_encode(['exists' => $exists]);

        // Close the statement
        $stmt->close();
    } else {
        // If there's an error with the prepared statement
        echo json_encode(['error' => 'Error preparing statement']);
    }

    // Close the database connection
    $conn->close();
} else {
    // If timekeeping_ID is not provided, return an error response
    echo json_encode(['error' => 'Timekeeping ID not provided']);
}
?>