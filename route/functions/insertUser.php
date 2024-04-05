<?php

include "../../connection/database.php";


$firstName = $_POST['userFirstName'];
$midInitial = $_POST['userMiddleInitial'];
$lastName = $_POST['userLastName'];
$userName = $_POST['createUsername'];
$password = $_POST['createPassword'];
$userRole = $_POST['createUserRole'];
$position = $_POST['createPosition'];



$result = $conn->query("INSERT INTO tbl_user_management (firstname, middleinitial, lastname, username, password, user_role, position)
VALUES ('$firstName', '$midInitial', '$lastName','$userName', '$password', '$userRole', '$position')");

echo "INSERT INTO tbl_user_management (firstname, middleinitial, lastname, username, password, user_role, position)
VALUES ('$firstName', '$midInitial', '$lastName','$userName', '$password', '$userRole', '$position')";

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Query executed successfully
   echo "New record inserted successfully!";
}
?>