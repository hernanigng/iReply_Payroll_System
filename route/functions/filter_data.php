<?php
// Include necessary files and database connection
include '../connection/session.php';
include '../connection/database.php';

// Check if year and month are set in the AJAX request
if (isset($_GET['year']) && isset($_GET['month'])) {
    // Get the selected year and month
    $selectedYear = $_GET['year'];
    $selectedMonth = $_GET['month'];

    // Modify the SQL query to fetch filtered data
    $query = "SELECT * FROM tbl_employee WHERE YEAR(date_column) = ? AND MONTH(date_column) = ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $selectedYear, $selectedMonth);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the filtered data and return as HTML
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['date_column'] . "</td>";
        echo "<td>" . $row['total_hours_worked'] . "</td>";
        echo "<td>" . $row['total_days_worked'] . "</td>";
        echo "<td><button class='btn btn-primary'><i class='bi bi-pencil'></i></button></td>";
        echo "</tr>";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
}
?>
