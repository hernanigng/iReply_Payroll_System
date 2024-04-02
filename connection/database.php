<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
