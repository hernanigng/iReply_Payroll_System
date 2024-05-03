<?php
// Assume you have a connection to the database
$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the updated data from the form
$firstname = $_POST['firstname'];
$middleinitial = $_POST['middleinitial'];
$lastname = $_POST['lastname'];
$username = $_POST['username'];
$password = $_POST['password'];
$user_id = $_POST['user_id'];

// File upload handling
if ($_FILES['user_image']['error'] != 4) { // Check if a new image is uploaded
    $user_image = $_FILES['user_image']['name']; // Get the name of the uploaded file
    $user_image_tmp = $_FILES['user_image']['tmp_name']; // Get the temporary location of the uploaded file
    $user_image_path = "uploads/" . basename($user_image); // Set the path where the uploaded file will be stored

    // Move the uploaded file to the desired location
    if (move_uploaded_file($user_image_tmp, $user_image_path)) {
        // If the file was uploaded successfully, update the database
        $query = "UPDATE tbl_user_management SET firstname = '$firstname', middleinitial = '$middleinitial', lastname = '$lastname', username = '$username', password = '$password', user_image = '$user_image_path' WHERE user_management_id = '$user_id'";

        if (mysqli_query($conn, $query)) {
            echo "Profile Updated Successfully!";
        } else {
            echo "Error updating profile: " . mysqli_error($conn);
        }
    } else {
        echo "Error uploading file.";
    }
} else {
    // If no new image is uploaded, update the database without changing the user image
    $query = "UPDATE tbl_user_management SET firstname = '$firstname', middleinitial = '$middleinitial', lastname = '$lastname', username = '$username', password = '$password' WHERE user_management_id = '$user_id'";

    if (mysqli_query($conn, $query)) {
        echo "Profile Updated Successfully!";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
