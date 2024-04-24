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
    $query = "SELECT * FROM tbl_timekeeping WHERE YEAR(date_from) = ? AND MONTH(date_to) = ? AND employee_id = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iii", $selectedYear, $selectedMonth, $employeeId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the filtered data and return as HTML
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['date_from'] . $row['date_to'] . "</td>";
        echo "<td>" . $row['Total_HrsWork'] . "</td>";
        echo "<td>" . $row['Total_DysWork'] . "</td>";
        echo "<td><button class='btn btn-primary'><i class='bi bi-pencil'></i></button></td>";
        echo "</tr>";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>