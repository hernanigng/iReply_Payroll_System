<?php
print_r($_POST); 

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

$query1 = $conn->query("SELECT employee_id FROM tbl_employee ORDER BY employee_id DESC LIMIT 1;");
if (!$query1) {
    echo "Query 1 failed: " . $conn->error;
    exit;
}

$data = mysqli_fetch_array($query1);
$last_id = $data['employee_id'];

//if ($last_id == "") {
  //  $nextId = 'BS00001';

if ($last_id) {
    $lastNumericId = intval(substr($last_id, 2)); // Extract numeric part and convert to integer
    $nextNumericId = $lastNumericId + 1;
} else {
    $nextNumericId = 1;
}


//$nextId = ($last_id !== null) ? $last_id + 1 : 1;
$numberOfDigits = 6; 
$emp_id =str_pad($nextNumericId, $numberOfDigits, '0', STR_PAD_LEFT);

$conn->query("INSERT INTO tbl_employee (firstname, middlename, lastname, address, birthdate, contact_num, civilstatus, personal_email, work_email, employee_type,
start_date, monthly_salary, account_bonus, client, position, employment_status, sss_num, pagibig_num, philhealth_num, tin_num, sss_con, pagibig_con, philhealth_con, tax_percentage)
VALUES ('$firstName', '$midName', '$lastName', '$address', '$birthdate', '$contactNum', '$civilStat', '$persEmail', '$workEmail', '$employeeType', '$startDate',
'$monthlySalary', '$accntBonus', '$client', '$position', '$employmentStatus', '$sss', '$pagibig', '$philhealth', '$tin', '$sssContrib', '$pagibigContrib', '$philhealthContrib', '$taxPercent')");

if (!$conn) {
  $error = mysqli_error($conn);
  echo json_encode(array('error' => $error));
} else {
  $last_id = $conn->insert_id;

  $response = array(
      'last_id' => $last_id,
      'firstname' => $firstName,
      'lastname' => $lastName,
      'message' => '<span class="alert alert-info">Test Message</span>'
  );

  echo json_encode($response);
}
$conn->close();
?>
