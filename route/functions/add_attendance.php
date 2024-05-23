<?php
include_once '../../connection/database.php';

// Generate a random 8-digit ID
$timekeeping_id = str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT);

// Sanitize and retrieve data from POST
$employee_name = $_POST['employee_name'];
$employee_id = $_POST['employee_id']; // Assuming this is correct, but it seems like it should be 'employee_id'
$date_from = $_POST['dateFrm'];
$date_to = $_POST['dateTo'];
$total_hours = $_POST['totalHrs'];
$total_days = floor($_POST['totalDys']); // Make sure to floor the value in case of any manipulation


$regularHoliday = $_POST['regularHoliday'];
$specialHoliday = $_POST['specialHoliday'];
$overtime = $_POST['overtime'];
$nightDifferential = $_POST['nightDifferential'];
$regularHolidayNightDiff = $_POST['regularHolidayNightDiff'];
$specialHolidayNightDiff = $_POST['specialHolidayNightDiff'];
$regHolidayOvertime = $_POST['regHolidayOvertime'];
$splHolidayOvertime = $_POST['splHolidayOvertime'];
$drd = $_POST['drd'];

// Prepare and execute the SQL statement
$query = "INSERT INTO tbl_timekeeping (timekeeping_ID, employee_name, employee_id, date_from, date_to, Total_HrsWork, Total_DysWork,
         regular_holiday, special_holiday, overtime, night_differential, regular_holiday_night_diff, special_holiday_night_diff, 
         regular_holiday_overtime, special_holiday_overtime, drd) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssssssssss", $timekeeping_id, $employee_name, $employee_id, $date_from, $date_to, $total_hours, $total_days,
                   $regularHoliday, $specialHoliday, $overtime, $nightDifferential, $regularHolidayNightDiff, $specialHolidayNightDiff,
                   $regHolidayOvertime, $splHolidayOvertime, $drd);
$result = $stmt->execute();

// Check if the query was successful
if ($result) {
    // Construct the response array
    $response = array(
        'status' => 'success',
        'timekeeping_id' => $timekeeping_id, // Send back the generated ID
        'employee_name' => $employee_name,
        'employee_id' => $employee_id,
        'date_from' => $date_from,
        'date_to' => $date_to,
        'total_hours' => $total_hours,
        'total_days' => $total_days,

        'regular_holiday' => $regularHoliday,
        'special_holiday' => $specialHoliday,
        'overtime' => $overtime,
        'night_differential' => $nightDifferential,
        'regular_holiday_night_diff' => $regularHolidayNightDiff,
        'special_holiday_night_diff
        ' => $specialHolidayNightDiff,
        'regular_holiday_overtime' => $regHolidayOvertime,
        'special_holiday_overtime' => $splHolidayOvertime,
        'drd' => $drd

    );
} else {
    // If insertion failed, construct an error response
    $response = array(
        'status' => 'error',
        'message' => 'Failed to insert record into the database'
    );
}

// Output the response as JSON
echo json_encode($response);
?>
