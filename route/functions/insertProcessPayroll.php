<?php

include_once '../../connection/database.php';

$basicPay = isset($_POST['basicPay']) ? $_POST['basicPay'] : '';
$regularHoliday = isset($_POST['regularHoliday']) ? $_POST['regularHoliday'] : '';
$specialHoliday = isset($_POST['specialHoliday']) ? $_POST['specialHoliday'] : '';
$overtime = isset($_POST['overtime']) ? $_POST['overtime'] : '';
$nightDifferential = isset($_POST['nightDifferential']) ? $_POST['nightDifferential'] : '';
$regularHolidayNightDiff = isset($_POST['regularHolidayNightDiff']) ? $_POST['regularHolidayNightDiff'] : '';
$specialHolidayNightDiff = isset($_POST['specialHolidayNightDiff']) ? $_POST['specialHolidayNightDiff'] : '';
$regHolidayOvertime = isset($_POST['regHolidayOvertime']) ? $_POST['regHolidayOvertime'] : '';
$splHolidayOvertime = isset($_POST['splHolidayOvertime']) ? $_POST['splHolidayOvertime'] : '';
$monthlyBonus = isset($_POST['monthlyBonus']) ? $_POST['monthlyBonus'] : '';

$drd = isset($_POST['drd']) ? $_POST['drd'] : '';
$payAdjustments = isset($_POST['payAdjustments']) ? $_POST['payAdjustments'] : '';
$totalEarnings = isset($_POST['totalEarnings']) ? $_POST['totalEarnings'] : '';

// Initialize response variable
$response = array();

$result = $conn->query("INSERT INTO tbl_earnings (basic_pay, reg_holiday, spl_holiday, overtime, night_diff, reg_holiday_nightdiff, spl_holiday_nightdiff, reg_holiday_ot, spl_holiday_ot, monthly_bonus, drd, pay_adjustments, total_earnings)
VALUES ('$basicPay','$regularHoliday', '$specialHoliday', '$overtime', '$nightDifferential', '$regularHolidayNightDiff', '$specialHolidayNightDiff', '$regHolidayOvertime', '$splHolidayOvertime', '$monthlyBonus', '$drd', '$payAdjustments', '$totalEarnings')");

if ($result === false) {
    $response = array("success" => false, "message" => "Failed to insert data into tbl_earnings: " . $conn->error);
    echo json_encode($response);
    exit(); // Exit the script to prevent further execution
}

$lastEarningsId = $conn->insert_id;

//DEDUCTIONS

$sss = isset($_POST['sss']) ? $_POST['sss'] : 0;
$pagibig = isset($_POST['pagibig']) ? $_POST['pagibig'] : 0;
$philhealth = isset($_POST['philhealth']) ? $_POST['philhealth'] : 0;
$overtime = isset($_POST['overtime']) ? $_POST['overtime'] : 0;
$withholdingTax = isset($_POST['withholdingTax']) ? $_POST['withholdingTax'] : 0;
$absent = isset($_POST['absent']) ? $_POST['absent'] : 0;
$otherDeductions = isset($_POST['otherDeductions']) ? $_POST['otherDeductions'] : 0;
$totalDeductions = isset($_POST['totalDeductions']) ? $_POST['totalDeductions'] : 0;

$result2 = $conn->query("INSERT INTO tbl_deductions (sss_con, pagibig_con, philhealth_con, withholding_tax, absent, other_deductions, total_deductions)
VALUES ('$sss','$pagibig', '$philhealth', '$withholdingTax', '$absent', '$otherDeductions', '$totalDeductions')");

if ($result2 === false) {
    $response = array("success" => false, "message" => "Failed to insert data into tbl_deductions: " . $conn->error);
    echo json_encode($response);
    exit(); // Exit the script to prevent further execution
}

$lastDeductionsId = $conn->insert_id;

$incentives = isset($_POST['incentives']) ? $_POST['incentives'] : 0;
$others = isset($_POST['others']) ? $_POST['others'] : 0;
$totalIncome = isset($_POST['totalIncome']) ? $_POST['totalIncome'] : 0;

$result3 = $conn->query("INSERT INTO tbl_incentives (incentives, others, total_incentives)
VALUES ('$incentives','$others', '$totalIncome')");

if ($result3 === false) {
    $response = array("success" => false, "message" => "Failed to insert data into tbl_incentives: " . $conn->error);
    echo json_encode($response);
    exit(); // Exit the script to prevent further execution
}

$lastIncentivesId = $conn->insert_id;

//Payroll Tranx

$selectEmployee = isset($_POST['selectEmployee']) ? $_POST['selectEmployee'] : 0;
$startDate = isset($_POST['startDate']) ? $_POST['startDate'] : 0;
$endDate = isset($_POST['endDate']) ? $_POST['endDate'] : 0;
$totalNetpay = isset($_POST['totalNetpay']) ? $_POST['totalNetpay'] : 0;


$result4 = $conn->query("INSERT INTO tbl_payroll_tranx (periodcov_from, periodcov_to, employee_id, earnings_id, incentives_id, deductions_id, total_netPay)
VALUES ('$startDate','$endDate', '$selectEmployee', '$lastEarningsId', '$lastIncentivesId', '$lastDeductionsId', '$totalNetpay')");

if ($result4 === false) {
    $response = array("success" => false, "message" => "Failed to insert data into tbl_payroll_tranx: " . $conn->error);
    echo json_encode($response);
    exit(); // Exit the script to
}

// Return success response if all operations were successful
$response = array("success" => true, "message" => "Payroll successfully processed");
echo json_encode($response);

?>
