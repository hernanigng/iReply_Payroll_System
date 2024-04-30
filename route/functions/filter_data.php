<?php
// Include necessary files and database connection
include_once '../../connection/database.php';

// Check if year, month, and employee_id are set in the AJAX request
if (isset($_GET['year']) && isset($_GET['month']) && isset($_GET['employee_id'])) {
    // Get the selected year, month, and employee ID
    $selectedYear = $_GET['year'];
    $selectedMonth = $_GET['month'];
    $employeeId = $_GET['employee_id'];

    // Modify the SQL query to fetch filtered data for the specific employee
    $query = "SELECT * FROM tbl_timekeeping WHERE YEAR(date_from) = ? AND MONTH(date_from) = ? AND employee_id = ?";

    //Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iss", $selectedYear, $selectedMonth, $employeeId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Initialize an array to hold the fetched data
    $filteredData = array();

    // Fetch the filtered data
    while ($row = $result->fetch_assoc()) {
        // Push each row into the array
        $filteredData[] = $row;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();

    // Return the filtered data as JSON
    echo json_encode($filteredData);
}
?>
