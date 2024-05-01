<?php
// assume you have a connection to the database
$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

// check connection
if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}

// retrieve the updated data from the form
$firstname = $_POST['firstname'];
$middleinitial = $_POST['middleinitial'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$user_id = $_POST['user_id'];

$query = "UPDATE tbl_user_management SET firstname = '$firstname', middleinitial = '$middleinitial', lastname = '$lastname', username = '$username', password = '$password' WHERE user_management_id = '$user_id'";

if (mysqli_query($conn, $query)) {
  echo "Profile updated successfully!";
} else {
  echo "Error updating profile: ". mysqli_error($conn);
}

mysqli_close($conn);
?>