<?php
include_once '../../connection/database.php';

$id = $_POST['id'];
$firstname = $_POST['firstname'];
$middleinitial = $_POST['middleinitial'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];


if ($id == 0) {
    // Insert client into database
    mysqli_query($conn, "INSERT INTO tbl_user_management (firstname, middleinitial, lastname, username, password) VALUES ('$firstname', '$middleinitial', '$lastname', '$username', '$password')");
} else {
    // Update client in database
    mysqli_query($conn, "UPDATE tbl_user_management SET firstname='$firstname', middleinitial ='$middleinitial', lastname ='$lastname', username ='$username', password ='$password' WHERE user_management_id =$id");
}
?>
