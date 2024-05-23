<?php
include '../../connection/database.php';

if (!isset($_POST['timekeeping_ID']) || empty($_POST['timekeeping_ID'])) {
    $response = array('success' => false, 'message' => 'Timekeeping ID is required');
    echo json_encode($response);
    exit; // Stop execution
}
// Sanitize and retrieve data from POST
$timekeeping_id = $_POST['timekeeping_ID'];
$employee_name = $_POST['employee_name'];
$employee_id = $_POST['employee_id']; // Check if this is correct in your schema
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$total_hours = $_POST['Total_HrsWork']; // Corrected assignment
$total_days = $_POST['Total_DysWork']; // Corrected assignment

$regular_holiday = $_POST['regular_holiday'];
$special_holiday = $_POST['special_holiday'];
$overtime = $_POST['overtime'];
$night_differential = $_POST['night_differential'];
$regular_holiday_night_diff = $_POST['regular_holiday_night_diff'];
$special_holiday_night_diff = $_POST['special_holiday_night_diff'];
$regular_holiday_overtime = $_POST['regular_holiday_overtime'];
$special_holiday_overtime = $_POST['special_holiday_overtime'];
$drd = $_POST['drd'];
// Prepare and execute the SQL statement
$query = "UPDATE tbl_timekeeping 
          SET employee_name = ?, employee_id = ?, date_from = ?, date_to = ?, Total_HrsWork = ?, Total_DysWork = ?,
          regular_holiday = ?, special_holiday = ?, overtime = ?, night_differential = ?, regular_holiday_night_diff = ?, 
          special_holiday_night_diff = ?, regular_holiday_overtime = ?, special_holiday_overtime = ?, drd = ?
          WHERE timekeeping_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssssssssssssssss", $employee_name, $employee_id, $date_from, $date_to, $total_hours, $total_days, $regular_holiday,
                   $special_holiday,  $overtime, $night_differential, $regular_holiday_night_diff , $special_holiday_night_diff, 
                   $regular_holiday_overtime, $special_holiday_overtime, $drd, $timekeeping_id);
$result = $stmt->execute();

// Check if the query was successful
if ($result) {
    // Construct the response array
    $response = array(
        'status' => 'success',
        'timekeeping_ID' => $timekeeping_id,
        'employee_name' => $employee_name,
        'employee_id' => $employee_id,
        'date_from' => $date_from,
        'date_to' => $date_to,
        'Total_HrsWork' => $total_hours,
        'Total_DysWork' => $total_days,

        'regular_holiday' => $regular_holiday,
        'special_holiday' => $special_holiday,
        'overtime' => $overtime,
        'night_differential' => $night_differential,
        'regular_holiday_night_diff' => $regular_holiday_night_diff,
        'special_holiday_night_diff' => $special_holiday_night_diff,
        'regular_holiday_overtime' => $regular_holiday_overtime,
        'special_holiday_overtime' => $special_holiday_overtime,
        'drd' => $drd,
        
    );
} else {
    // If update failed, construct an error response
    $response = array(
        'status' => 'error',
        'message' => 'Failed to update record in the database'
    );
}

// Output the response as JSON
echo json_encode($response);
?>
