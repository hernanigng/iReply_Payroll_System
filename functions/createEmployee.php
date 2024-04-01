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
