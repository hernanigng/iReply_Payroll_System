<?php
// Include necessary files and database connection
include_once '../../connection/database.php';

// Initialize an array to hold the fetched data
$filteredData = array();

// Check if year and month are set in the AJAX request
if (isset($_GET['year']) && isset($_GET['month'])) {
    // Get the selected year and month
    $selectedYear = $_GET['year'];
    $selectedMonth = $_GET['month'];

    // Modify the SQL query to fetch filtered data
    $query = "SELECT 
        e.firstname, 
        e.lastname,
        p.*
        FROM tbl_payroll_tranx p
        JOIN 
            tbl_employee e ON p.employee_id = e.employee_id
        WHERE YEAR(periodcov_from) = ? 
        AND MONTH(periodcov_from) = ?";

    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $selectedYear, $selectedMonth); // 'i' stands for integer
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the filtered data
    while ($row = $result->fetch_assoc()) {
        // Push each row into the array
        $filteredData[] = $row;
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}

// Return the filtered data as JSON
echo json_encode($filteredData);
?>
