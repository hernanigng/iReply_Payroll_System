
<?php

$id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");
$query = $conn->query("SELECT * FROM tbl_employee WHERE employee_id = $id");
$data = mysqli_fetch_array($query);

// Now, you just output the fetched data as JSON
echo json_encode($data);
?>

