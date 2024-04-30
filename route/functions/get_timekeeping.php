<?php
// Include necessary files and database connection
include_once '../../connection/database.php';

// Check if employee_id is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //$attendanceNo = $_GET['timekeeping_ID'];

    // Prepare and execute the query to fetch timekeeping data for the specified employee
    $query = "SELECT * FROM tbl_timekeeping WHERE timekeeping_ID = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();

    // Fetch the data as an associative array
    $timekeepingData = array();
    while ($row = $result->fetch_assoc()) {
        $timekeepingData[] = $row;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Return the data as JSON
    echo json_encode($timekeepingData);
}
?>
