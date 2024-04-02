<?php
include_once '../../connection/database.php';

$id = $_POST['id'];
$companyName = $_POST['companyName'];
$contactName = $_POST['contactName'];
$website = $_POST['website'];
$contactNumber = $_POST['contactNumber'];
$contractDate = $_POST['contractDate'];
$contactEmail = $_POST['contactEmail'];

if ($id == 0) {
    // Insert client into database
    mysqli_query($conn, "INSERT INTO tbl_client (Company_Name, Contact_Name, Website, Contact_Number, Contract_Date, Contact_Email) VALUES ('$companyName', '$contactName', '$website', '$contactNumber', '$contractDate', '$contactEmail')");
} else {
    // Update client in database
    mysqli_query($conn, "UPDATE tbl_client SET Company_Name='$companyName', Contact_Name='$contactName', 
    Website='$website', 
    Contact_Number='$contactNumber', Contract_Date='$contractDate', Contact_Email='$contactEmail' WHERE Client_ID=$id");
}
?>
