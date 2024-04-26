<?php

include "../../connection/database.php";

if(isset($_POST['id'])) {
    $employeeId = mysqli_real_escape_string($conn, $_POST['id']);

    $selectSql = "SELECT * FROM tbl_employee WHERE employee_id = '$employeeId'";

    $result = mysqli_query($conn, $selectSql);

    if($result) {
        $employeeData = mysqli_fetch_assoc($result);


        echo json_encode($employeeData);

        $insertSql = "INSERT INTO tbl_archive_employee (employee_id, firstname, middlename, lastname, address, birthdate, contact_num, civilstatus, personal_email, work_email, employee_type,
                        start_date, daily_rate, account_bonus, client, position, employment_status, sss_num, pagibig_num, philhealth_num, tin_num, sss_con, pagibig_con, philhealth_con, tax_percentage)
                        VALUES ('".$employeeData['employee_id']."', '".$employeeData['firstname']."', '".$employeeData['middlename']."', '".$employeeData['lastname']."', '".$employeeData['address']."', '".$employeeData['birthdate']."', '".$employeeData['contact_num']."', '".$employeeData['civilstatus']."', '".$employeeData['personal_email']."', '".$employeeData['work_email']."', '".$employeeData['employee_type']."',
                        '".$employeeData['start_date']."', '".$employeeData['daily_rate']."', '".$employeeData['account_bonus']."', '".$employeeData['client']."', '".$employeeData['position']."', '".$employeeData['employment_status']."', '".$employeeData['sss_num']."', '".$employeeData['pagibig_num']."', '".$employeeData['philhealth_num']."', '".$employeeData['tin_num']."', '".$employeeData['sss_con']."', '".$employeeData['pagibig_con']."', '".$employeeData['philhealth_con']."', '".$employeeData['tax_percentage']."')";

        $insertResult = mysqli_query($conn, $insertSql);

        if($insertResult) {
            echo json_encode(['success' => 'Data inserted successfully into tbl_archive_employee']);
        } else {
            echo json_encode(['error' => 'Failed to insert data into tbl_archive_employee']);
        }
    } else {
        echo json_encode(['error' => 'Failed to retrieve employee data from tbl_archive_employee']);
    }
} else {
    echo json_encode(['error' => 'Employee ID parameter not provided']);
}

mysqli_close($conn);
?>
