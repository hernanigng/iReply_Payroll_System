<?php
// Assuming you have already connected to your database
include "../../connection/database.php";

// Validate if the 'employee_id' key exists and is not empty
if (!isset($_POST['employee_id']) || empty($_POST['employee_id'])) {
    $response = array('success' => false, 'message' => 'Employee ID is required');
    echo json_encode($response);
    exit; // Stop execution
}

// Retrieve the updated employee data from the POST request
$employeeId = $_POST['employee_id'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$address = $_POST['address'];
$birthdate = $_POST['birthdate'];
$contactNum = $_POST['contact_num'];
$civilStatus = $_POST['civilstatus'];
$personalEmail = $_POST['personal_email'];
$workEmail = $_POST['work_email'];
$employeeType = $_POST['employee_type'];
$startDate = $_POST['start_date'];
$monthly = $_POST['monthly_salary'];
$accBonus = $_POST['account_bonus'];
$client = $_POST['client'];
$position = $_POST['position'];
$employmentStatus = $_POST['employment_status'];
$sss = $_POST['sss_num'];
$pagibig = $_POST['pagibig_num'];
$philhealth = $_POST['philhealth_num'];
$tin = $_POST['tin_num'];
$sssCon = $_POST['sss_con'];
$pagibigCon = $_POST['pagibig_con'];
$philhealthCon = $_POST['philhealth_con'];
$tax = $_POST['tax_percentage'];

// Validate other fields as needed...

// Update the employee record in the database
$query = "UPDATE tbl_employee SET 
firstname=?, 
middlename=?, 
lastname=?, 
address=?, 
birthdate=?, 
contact_num=?, 
civilstatus=?, 
personal_email=?, 
work_email=?, 
employee_type=?, 
start_date=?, 
monthly_salary=?, 
account_bonus=?,
client=?, 
position=?, 
employment_status=?, 
sss_num=?, 
pagibig_num=?, 
philhealth_num=?, 
tin_num=?, 
sss_con=?, 
pagibig_con=?, 
philhealth_con=?, 
tax_percentage=? 
WHERE employee_id=?";

$stmt = $conn->prepare($query);
if (!$stmt) {
    // Check for errors in the prepare statement
    $errorMessage = mysqli_error($conn);
    $errorCode = mysqli_errno($conn);
    $response = array('success' => false, 'message' => "Error preparing statement: $errorMessage (Error Code: $errorCode)");
    echo json_encode($response);
    exit;
}

// Bind parameters and execute
$stmt->bind_param('sssssssssssssssssssssssss', 
$firstname, 
$middlename,
$lastname, 
$address, 
$birthdate, 
$contactNum, 
$civilStatus, 
$personalEmail, 
$workEmail, 
$employeeType, 
$startDate, 
$monthly, 
$accBonus, 
$client, 
$position, 
$employmentStatus, 
$sss, 
$pagibig, 
$philhealth, 
$tin, 
$sssCon, 
$pagibigCon, 
$philhealthCon, 
$tax, 
$employeeId);


$result = $stmt->execute();

if ($result) {
    // Return success response
    $response = array('success' => true, 'message' => '<span class="alert alert-success col-md-12"> Successully Updated </span>');
    echo json_encode($response);

} else {
    // Return error response with details if available
    $errorMessage = mysqli_error($conn);
    $errorCode = mysqli_errno($conn);
    $response = array('success' => false, 'message' => '<span class="alert alert-danger col-md-12"> Update Failed. </span>');
    echo json_encode($response);
}
?>
