<?php
include_once '../../connection/database.php';

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];

if ($id == 0) {
    // Insert client into database
    mysqli_query($conn, "INSERT INTO tbl_position (Title, Description) VALUES ('$title', '$description')");
} else {
    // Update client in database
    mysqli_query($conn, "UPDATE tbl_position SET Title='$title', Description ='$description' WHERE position_ID=$id");
}
?>
