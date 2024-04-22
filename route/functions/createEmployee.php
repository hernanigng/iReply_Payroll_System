<?php
//print_r($_POST); 

$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

$firstName = $_POST['createFirstName'];
$midName = $_POST['createMiddleName'];
$lastName = $_POST['createLastName'];
$address = $_POST['createAddress'];
$birthdate = $_POST['createBirthdate'];
$contactNum = $_POST['createContactNum'];
$civilStat = $_POST['createCivilStatus'];
$persEmail = $_POST['createPersEmail'];
$workEmail = $_POST['createWorkEmail'];
$employeeType = $_POST['createEmployeeType'];

$startDate = $_POST['createStartDate'];
$monthlySalary = $_POST['createMonthlySalary'];
$accntBonus = $_POST['createAccountBonus'];
$client = $_POST['createClient'];
$position = $_POST['createPosition']; 
$employmentStatus = $_POST['createEmploymentStatus'];

$sss = $_POST['createSSS'];
$pagibig = $_POST['createPagibig'];
$philhealth = $_POST['createPhilhealth'];
$tin = $_POST['createTin'];
$sssContrib = $_POST['createSSSContrib'];
$pagibigContrib = $_POST['createPagibigContrib'];
$philhealthContrib = $_POST['createPhilhealthContrib'];
$taxPercent = $_POST['createTaxPercent'];

// Query to get the maximum employee ID currently in the database
$query = $conn->query("SELECT MAX(CAST(SUBSTRING(employee_id, 2) AS UNSIGNED)) AS max_id FROM tbl_employee");

    if (!$query) {
        echo "Query failed: " . $conn->error;
        exit;
    }


    $data = mysqli_fetch_array($query);

    if ($data['max_id'] !== null) {
        // If records exist, increment the maximum ID
        $nextNumericId = $data['max_id'] + 1;
    } else {
        // If no records exist, start with ID '000101'
        $nextNumericId = 101;
    }

    $nextEmployeeId = 'E' . sprintf('%06d', $nextNumericId);
    //echo $nextEmployeeId;


$result = $conn->query("INSERT INTO tbl_employee (employee_id, firstname, middlename, lastname, address, birthdate, contact_num, civilstatus, personal_email, work_email, employee_type,
start_date, daily_rate, account_bonus, client, position, employment_status, sss_num, pagibig_num, philhealth_num, tin_num, sss_con, pagibig_con, philhealth_con, tax_percentage)
VALUES ('$nextEmployeeId','$firstName', '$midName', '$lastName', '$address', '$birthdate', '$contactNum', '$civilStat', '$persEmail', '$workEmail', '$employeeType', '$startDate',
'$monthlySalary', '$accntBonus', '$client', '$position', '$employmentStatus', '$sss', '$pagibig', '$philhealth', '$tin', '$sssContrib', '$pagibigContrib', '$philhealthContrib', '$taxPercent')");


if ($result === false) {
   // echo "Error: " . $conn->error;
} else {
    // Query executed successfully
   // echo "New record inserted successfully!";
}

if ($result) {
    // Construct the response array
    $response = array(
        'status' => 'success',
        'message' => 'New record inserted successfully!',
        'employee_id' => $nextEmployeeId,
        'firstname' => $firstName,
        'lastname' => $lastName,
        'employee_type' => $employeeType
    );
} else {
    // If insertion failed, construct an error response
    $response = array(
        'status' => 'error',
        'message' => 'Failed to insert record into the database'
    );
}

// Encode the response array into JSON format
$jsonResponse = json_encode($response);

// Set the proper Content-Type header to indicate JSON data
header('Content-Type: application/json');

// Output the JSON response
echo $jsonResponse;



$conn->close();
?>
