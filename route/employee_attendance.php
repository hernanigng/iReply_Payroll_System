<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

    <style>
    .toast {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1500; /* Adjust the z-index value as needed */
}

    </style>
<?php
include '../connection/session.php';
include '../template/header.php';
include '../template/sidebar.php';
include '../connection/database.php';

// Initialize the $data variable
$data = array();

// Check if employee_id is set in the URL
if (isset($_GET['employee_id'])) {
    // Get the employee ID from the URL
    $employeeId = $_GET['employee_id'];

    // Prepare the query to fetch the employee based on ID
    $query = "SELECT * FROM tbl_employee WHERE employee_id= '$employeeId' ";
    $result = $conn->query($query);
    
    $data = mysqli_fetch_array($result);
}
?>

<div id="layoutSidenav_content">
    <main>
        <!-- Year and Month Dropdown Filter -->
 



<script>
    function formatDate(dateString) {
    // Convert the PHP date string to JavaScript Date object
    var date = new Date(dateString);

    // Extract date components
    var month = date.toLocaleString('en-US', { month: 'long' });
    var day = date.getDate();
    var year = date.getFullYear();

    // Concatenate and return formatted date
    return month + ' ' + day + ', ' + year;
}

   $(document).ready(function() {
    // Function to apply filter
    function applyFilter(employeeId) {
        var year = $('#yearFilter').val();
        var month = $('#monthFilter').val();
        var employeeId = $('#employeeId').val();

        // AJAX request to fetch filtered data
        $.ajax({
            url: 'functions/filter_data.php',
            method: 'GET',
            data: {
                year: year,
                month: month,
                employee_id: employeeId
            },
            success: function(response) {
                // Parse the JSON response
                var filteredData = JSON.parse(response);

                // Clear the table body
                $('#datatablesSimple tbody').empty();

                // Iterate through the filtered data and append rows to the table
                $.each(filteredData, function(index, row) {
                    var html = "<tr>";
                    html += "<td>" + formatDate(row['date_from']) + " - " + formatDate(row['date_to']) + "</td>";
                    html += "<td>" + row['Total_HrsWork'] + "</td>";
                    html += "<td>" + row['Total_DysWork'] + "</td>";
                    html += "<td>";
                    html += "<button type='button' class='btn btn-primary' onclick='openEditModal(" + row['timekeeping_ID'] + ")' data-bs-toggle='modal' data-bs-target='#edit_modal'><i class='bi bi-pencil'></i></button>";
                    html += "<button type='button' class='btn btn-primary ms-2' onclick='redirectToPayroll(" + row['timekeeping_ID'] + ")'><i class='fa-solid fa-calculator'></i></button>";
                    html += "</td>";

                    html += "</tr>";
                    $('#datatablesSimple tbody').append(html);
                });
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", status, error);
            }
        });
    }

    // Function to retrieve employee ID and apply filter
    function getEmployeeIdAndFilter() {
        var employeeId = "<?php echo $data['employee_id'] ?>";
        applyFilter(employeeId);
    }

    // Apply filter when the year or month select elements change
    $('#yearFilter, #monthFilter').change(function() {
        // Get the employee ID and apply filter
        getEmployeeIdAndFilter();
    });

});
</script>

<div class="container-fluid px-4 mt-4">
    <div class="row align-items-center">
        <input type="hidden" id="employeeId" value="<?php echo $data['employee_id']; ?>"> </input>
        <div class="col-md-2">
            <label> Year </label>
            <select class="form-select" id="yearFilter">
                <!-- Populate options dynamically with PHP -->
                <?php
                $currentYear = date('Y');
                for ($year = 2020; $year <= $currentYear; $year++) {
                    echo '<option value="' . $year . '"' . ($year == $currentYear ? ' selected' : '') . '>' . $year . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-2">
            <label> Month </label>
            <select class="form-select" id="monthFilter">
                <!-- Populate options dynamically with PHP -->
                <?php
                $months = array(
                    '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                    '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                    '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                );
                $currentMonth = date('m');
                foreach ($months as $monthNumber => $monthName) {
                    echo '<option value="' . $monthNumber . '"' . ($monthNumber == $currentMonth ? ' selected' : '') . '>' . $monthName . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-8 text-end">
            <button type="button" class="btn btn-primary add" data-bs-toggle="modal" data-bs-target="#add_modal" data-firstname="<?php echo $data['firstname']; ?>" data-lastname="<?php echo $data['lastname']; ?>"><i class="fa-solid fa-square-plus me-2"></i>Add Attendance</button>
        </div>
    </div>
</div>


<div class="container-fluid px-4">
    <div class="card mb-4 mt-4">
        <div class="card-header">
            <span><i class="fa-solid fa-user"></i></span>
            <b class="ms-2"> <?php echo $data['firstname'] . " " . $data['lastname']; ?> </b>
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Total Hours Worked</th>
                        <th>Total Days Worked</th>
                        <th></th>
                    </tr>
                </thead>
          
                <tbody>
                <?php
                            $query1 = "SELECT * FROM tbl_timekeeping WHERE employee_id= '$employeeId' ORDER BY date_to DESC";
                            $result1 = $conn->query($query1);

                            while ($data1 = mysqli_fetch_array($result1)) {
                            ?>
                                <tr>
                                <td> <?php echo date('F j, Y', strtotime($data1['date_from'])) . " - " . date('F j, Y', strtotime($data1['date_to'])); ?> </td>
                                <td> <?php echo $data1['Total_HrsWork']; ?> </td>
                                    <td> <?php echo $data1['Total_DysWork']; ?> </td>
                                    <td>
                                    <!-- <button type="button" class="btn btn-primary editAttendanceBtn" data-timekeeping_id="<?php echo $data1['timekeeping_ID']; ?>">
                                      <i class="bi bi-pencil"></i> 
                                   </button> -->
                                  <button type="button" class="btn btn-primary" onclick="openEditModal('<?php echo $data1['timekeeping_ID']; ?>')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                   
                                   <button type="button" class="btn btn-primary" onclick="redirectToPayroll('<?php echo $data1['timekeeping_ID']; ?>')">
                                        <i class="fa-solid fa-calculator"></i>
                                    </button>

                                    </td>
                                </tr>
                            <?php } ?>
                </tbody>
             
            </table>
        </div>
    </div>
    <div class="container">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary" id="backBtn">Back</button>
    </div>
    </div>
</div>
</main>
<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; iReply Payroll System</div>
        </div>
    </div>
</footer>
</div>


<script>
    // Function to handle back button click
    document.getElementById('backBtn').addEventListener('click', function() {
        // Go back to the previous page
        window.history.back();
    });

//     function redirectToPayroll(timekeepingId) {
//     window.location.href = 'Process_Payroll_Timekeeping.php?timekeeping_ID=' + timekeepingId;
// }

function redirectToPayroll(timekeepingId) {
    // AJAX request to check if earnings_id exists
    $.ajax({
        url: 'functions/check_earnings_id.php', // Update the URL with the appropriate path
        method: 'POST',
        data: {
            timekeeping_ID: timekeepingId
        },
        dataType: 'json',
        success: function(response) {
            if (response.exists) {
                // Earnings_id exists, display a message or perform any other action
                alert('The payroll has already been processed. Direct to the Payslip Tab to view the Payroll.');
                 html += "<td><button type='button' class='btn btn-primary view' data-id='" + row['netPay_id'] + "' data-empId='" + row['employee_id'] + "'><i class='bi bi-eye'></i></button></td>";
            } else {
                // Earnings_id does not exist, redirect to the desired location
                window.location.href = 'Process_Payroll_Timekeeping.php?timekeeping_ID=' + timekeepingId;
            }
        },
        error: function(xhr, status, error) {
            // Show error message if AJAX request fails
            console.error('An error occurred while processing your request.');
            console.error(xhr.responseText);
        }
    });
}


$(document).ready(function() {

// Function to calculate total days based on total hours
function calculateTotalDays() {
    var totalHours = parseFloat($('#totalHrs').val());
    var totalDays = Math.floor(totalHours / 8); // Assuming 8 hours per day
    $('#totalDys').val(totalDays);
}

// Function to check for duplicate attendance
function checkForDuplicate(formData, callback) {
    $.ajax({
        url: 'functions/check_duplicate.php', // Endpoint to check for duplicates
        method: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            callback(response);
        },
        error: function(xhr, status, error) {
            alert('An error occurred while checking for duplicates.');
            console.error(xhr.responseText);
            callback({status: 'error'});
        }
    });
}

// Handle form submission for adding attendance
$('#insert_Attendance').submit(function(event) {
    // Prevent default form submission
    event.preventDefault();

    // Serialize form data
    var formData = $(this).serialize();

    // Check for duplicates before submitting
    checkForDuplicate(formData, function(response) {
        if (response.status === 'duplicate') {
            alert('Duplicate attendance record found. Please check your input.');
        } else if (response.status === 'success') {
            // AJAX request to add attendance
            $.ajax({
                url: 'functions/add_attendance.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Check the status of the response
                    if (response.status === 'success') {
                        // Clear form fields
                        $('#dateFrm').val('');
                        $('#dateTo').val('');
                        $('#totalHrs').val('');
                        $('#totalDys').val('');

                        $('#regularHoliday_id').val('');
                        $('#specialHoliday_id').val('');
                        $('#overtime_id').val('');
                        $('#nightDifferential_id').val('');
                        $('#regularHolidayNightDiff_id').val('');
                        $('#specialHolidayNightDiff_id').val('');
                        $('#regHolidayOvertime_id').val('');
                        $('#splHolidayOvertime_id').val('');
                        $('#drd_id').val('');

                        // Show the toast after a short delay
                        var insertToast = new bootstrap.Toast($('#insertAttendanceToast')[0]); // Retrieve the DOM element
                        insertToast.show(); // Explicitly show the toast

                        $('#add_modal').modal('hide');

                        setTimeout(function() {
                            window.location.reload();
                        }, 3000);
                    } else {
                        // Show error message
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Show error message if AJAX request fails
                    alert('An error occurred while processing your request.');
                    console.error(xhr.responseText);
                }
            });
        } else {
            alert('An error occurred. Please try again.');
        }
    });
});

// Show add modal and populate fields
$('#add_modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var firstname = button.data('firstname'); // Extract firstname from data attribute
    var lastname = button.data('lastname'); // Extract lastname from data attribute
    
    // Update input fields in the modal with firstname and lastname
    $('#employee_name').val(firstname + ' ' + lastname);
});

// Calculate total days when total hours are changed
$('#totalHrs').on('input', calculateTotalDays);

});

</script>


  <!-- Timekeeping Insert Success Toast Notification -->
  <div class="toast position-fixed top-10 start-10 translate-middle" id="insertAttendanceToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Attendance Successfully Added.
            </div>
     </div>

<!-- ADD ATTENDANCE MODAL --> 
<div class="modal fade" id="add_modal" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Add Attendance</h5>
 </div>

 <div class="modal-body">
    <form id="insert_Attendance" method="POST">
        <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <input type="hidden" name="employee_id" class="form-control" id="employee_id" value="<?php echo $data['employee_id']; ?>">
                    <label for="employee_name" class="form-label">Employee Name:</label>
                    <input type="text" name="employee_name" class="form-control" id="employee_name" readonly>
                </div>
            </div>
 <br>
            <div class="row">
                <div class="col-md-3">
                    <label for="dateFrm" class="form-label">Date From:</label>
                    <input type="date" name="dateFrm" class="form-control" id="dateFrm">
                </div>
                <div class="col-md-3">
                    <label for="dateTo" class="form-label">Date To:</label>
                    <input type="date" name="dateTo" class="form-control" id="dateTo">
                </div>
                <div class="col-md-3">
                    <label for="totalHrs" class="form-label">Total Hours Worked:</label>
                    <input type="number" name="totalHrs" class="form-control" id="totalHrs">
                </div>
                <div class="col-md-3">
                    <label for="totalDys" class="form-label">Total Days Worked:</label>
                    <input type="number" name="totalDys" class="form-control" id="totalDys" readonly>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <label for="regularHoliday" class="form-label">Regular Holiday (Day) </label>
                    <input type="number" name="regularHoliday" class="form-control" id="regularHoliday" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="specialHoliday" class="form-label">Special Holiday (Day) </label>
                    <input type="text" name="specialHoliday" class="form-control" id="specialHoliday" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="overtime" class="form-label">Overtime (Hours) </label>
                    <input type="number" name="overtime" class="form-control" id="overtime" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="nightDifferential" class="form-label">Night Differential (Hours)</label>
                    <input type="number" name="nightDifferential" class="form-control" id="nightDifferential" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="regularHolidayNightDiff" class="form-label">Regular Holiday Night Diff (Hours)</label>
                    <input type="number" name="regularHolidayNightDiff" class="form-control" id="regularHolidayNightDiff" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="specialHolidayNightDiff" class="form-label">Special Holiday Night Diff (Hours)</label>
                    <input type="number" name="specialHolidayNightDiff" class="form-control" id="specialHolidayNightDiff" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="regHolidayOvertime" class="form-label">Reg. Holiday Overtime (Hours)</label>
                    <input type="number" name="regHolidayOvertime" class="form-control" id="regHolidayOvertime" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="splHolidayOvertime" class="form-label">Spl. Holiday Overtime (Hours)</label>
                    <input type="number" name="splHolidayOvertime" class="form-control" id="splHolidayOvertime" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="drd" class="form-label">DRD (Day) </label>
                    <input type="number" name="drd" class="form-control" id="drd" step="0.01">
                </div>
            </div>
        </div>

        <div class="modal-footer mt-3">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
</div>
</div>
</div>


<!-- EDIT ATTENDANCE MODAL --> 
<div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="edit_modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Edit Attendance</h5>
 </div>

  <div class="modal-body">
  <form id="updateAttendance" method="POST">
    <div class="container mt-4">

        <div class="row">
           <input type="hidden" class="form-control" id="timekeeping_id">
            <div class="col">
                <label for="edit_employee_name" class="form-label">Employee Name:</label>
                <input type="text" name="edit_employee_name" class="form-control" id="edit_employee_name" readonly>
                </div>
                <input type="hidden" name="edit_employee_id" class="form-control" id="edit_employee_id" readonly>         
        </div>
<br>
        <div class="row">
            <div class="col-md-3">
                <label for="edit_dateFrm" class="form-label">Date From:</label>
                <input type="date" class="form-control" id="edit_dateFrm">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>

            <div class="col-md-3">
                <label for="edit_dateTo" class="form-label"> Date To:</label>
                <input type="date" class="form-control" id="edit_dateTo">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>
            <div class="col-md-3">
                <label for="edit_totalHrs" class="form-label">Total Hours Worked:</label>
                <input type="number" class="form-control" id="edit_totalHrs">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>

            <div class="col-md-3">
                <label for="edit_totalDys" class="form-label">Total Days Worked:</label>
                <input type="number" class="form-control" id="edit_totalDys">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>
        </div>
 <br>
        <div class="row">
                <div class="col-md-4">
                    <label for="regularHoliday" class="form-label">Regular Holiday</label>
                    <input type="number" name="regularHoliday" class="form-control" id="edit_regularHoliday" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="specialHoliday" class="form-label">Special Holiday</label>
                    <input type="number" name="specialHoliday" class="form-control" id="edit_specialHoliday" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="overtime" class="form-label">Overtime</label>
                    <input type="number" name="overtime" class="form-control" id="edit_overtime" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="nightDifferential" class="form-label">Night Differential</label>
                    <input type="number" name="nightDifferential" class="form-control" id="edit_nightDifferential" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="regularHolidayNightDiff" class="form-label">Regular Holiday Night Diff</label>
                    <input type="number" name="regularHolidayNightDiff" class="form-control" id="edit_regularHolidayNightDiff" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="specialHolidayNightDiff" class="form-label">Special Holiday Night Diff</label>
                    <input type="number" name="specialHolidayNightDiff" class="form-control" id="edit_specialHolidayNightDiff" step="0.01">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label for="regHolidayOvertime" class="form-label">Reg. Holiday Overtime</label>
                    <input type="number" name="regHolidayOvertime" class="form-control" id="edit_regHolidayOvertime" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="splHolidayOvertime" class="form-label">Spl. Holiday Overtime</label>
                    <input type="number" name="splHolidayOvertime" class="form-control" id="edit_splHolidayOvertime" step="0.01">
                </div>
                <div class="col-md-4">
                    <label for="drd" class="form-label">DRD</label>
                    <input type="number" name="drd" class="form-control" id="edit_drd" step="0.01">
                </div>
            </div>

            <div class="modal-footer mt-3">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> Close </button>
                <button type="submit" class="btn btn-primary" id="updateAttendance">Update</button>
            </div>
    </div>
</form>
  </div>
</div>
</div>
<!-- Timekeeping Update Success Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle" id="updateAttendanceToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000" style="z-index: 10000;">
          <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Attendance Successfully Updated.
            </div>
     </div>
</div>


<script>
     function calculateTotalDaysEdit() {
        var totalHours = parseFloat($('#edit_totalHrs').val());
        var totalDays = Math.floor(totalHours / 8);
        $('#edit_totalDys').val(totalDays);
    }


    function openEditModal(timekeepingId) {
    // Send an AJAX request to check if the earnings_id exists
    $.ajax({
        url: 'functions/check_earnings_id.php',
        method: 'POST',
        data: { timekeeping_ID: timekeepingId },
        dataType: 'json',
        success: function(response) {
            // Check if the earnings_id exists
            if (response.exists) {
                // Earnings_id exists, display a message or perform any other action
                alert('The payroll has already been processed. Cannot edit.');
            } else {
                // Earnings_id does not exist, open the edit modal
                $('#edit_modal').modal('show');

                // AJAX call to fetch data
                $.ajax({
                    url: 'functions/get_timekeeping.php',
                    type: 'POST',
                    data: { id: timekeepingId },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response); // Debugging message

                        // Populate the edit modal directly
                        $('#timekeeping_id').val(response.timekeeping_ID);
                        $('#edit_employee_name').val(response.employee_name);
                        $('#edit_employee_id').val(response.employee_id);
                        $('#edit_dateFrm').val(response.date_from);
                        $('#edit_dateTo').val(response.date_to);
                        $('#edit_totalHrs').val(response.Total_HrsWork);
                        $('#edit_totalDys').val(response.Total_DysWork);
                        $('#edit_regularHoliday').val(response.regular_holiday);
                        $('#edit_specialHoliday').val(response.special_holiday);
                        $('#edit_overtime').val(response.overtime);
                        $('#edit_nightDifferential').val(response.night_differential);
                        $('#edit_regularHolidayNightDiff').val(response.regular_holiday_night_diff);
                        $('#edit_specialHolidayNightDiff').val(response.special_holiday_night_diff);
                        $('#edit_regHolidayOvertime').val(response.regular_holiday_overtime);
                        $('#edit_splHolidayOvertime').val(response.special_holiday_overtime);
                        $('#edit_drd').val(response.drd);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", status, error);
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            // If there's an error with the AJAX request
            console.error("Error:", error);
        }
    });
}

// Calculate total days when total hours are changed in edit modal
$('#edit_totalHrs').on('input', calculateTotalDaysEdit);

$(document).ready(function() {
    // Bind the updateAttendance function to the form submission event
    $('#updateAttendance').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Call the updateAttendance function with the timekeeping ID as an argument
        updateAttendance($('#timekeeping_id').val());
    });
});

function updateAttendance(timekeeping_ID) {
    var timekeeping_ID = $('#timekeeping_id').val();
    var employee_name = $('#edit_employee_name').val();
    var employee_id = $('#edit_employee_id').val();
    var date_from = $('#edit_dateFrm').val();
    var date_to = $('#edit_dateTo').val();
    var Total_HrsWork = $('#edit_totalHrs').val();
    var Total_DysWork = $('#edit_totalDys').val();

    var regularHoliday = $('#edit_regularHoliday').val();
    var specialHoliday = $('#edit_specialHoliday').val();
    var overtime = $('#edit_overtime').val();
    var nightDifferential = $('#edit_nightDifferential').val();
    var regularHolidayNightDiff = $('#edit_regularHolidayNightDiff').val();
    var specialHolidayNightDiff = $('#edit_specialHolidayNightDiff').val();
    var regularHolidayOvertime = $('#edit_regHolidayOvertime').val();
    var specialHolidayOvertime = $('#edit_splHolidayOvertime').val();
    var drd = $('#edit_drd').val();

    var updatedData = {
        timekeeping_ID: timekeeping_ID,
        employee_name: employee_name,
        employee_id: employee_id,
        date_from: date_from,
        date_to: date_to,
        Total_HrsWork: Total_HrsWork,
        Total_DysWork: Total_DysWork,

        regular_holiday: regularHoliday,
        special_holiday: specialHoliday,
        overtime: overtime,
        night_differential: nightDifferential,
        regular_holiday_night_diff: regularHolidayNightDiff,
        special_holiday_night_diff: specialHolidayNightDiff,
        regular_holiday_overtime: regularHolidayOvertime,
        special_holiday_overtime: specialHolidayOvertime,
        drd: drd
    };
    console.log("Data sent in AJAX request:", updatedData);
    // AJAX request to update attendance
    $.ajax({
        url: 'functions/update_timekeeping.php',
        method: 'POST',
        data: updatedData,
        dataType: 'json',
        success: function(response) {
    console.log("Update successful"); // Debugging message
    // Check the status of the response
    if (response.status === 'success') {

         // Clear form fields
            $('#edit_dateFrm').val('');
            $('#edit_dateTo').val('');
            $('#edit_totalHrs').val('');
            $('#edit_totalDys').val('');
            $('#edit_regularHoliday').val(''); 
            $('#edit_specialHoliday').val('');
            $('#edit_overtime').val('');
            $('#edit_nightDifferential').val('');
            $('#edit_regularHolidayNightDiff').val('');
            $('#edit_specialHolidayNightDiff').val('');
            $('#edit_regHolidayOvertime').val('');
            $('#edit_splHolidayOvertime').val('');
            $('#edit_drd').val('');


     // Show the toast after a short delay
      var updateAttendance = new bootstrap.Toast($('#updateAttendanceToast')[0]); // Retrieve the DOM element
     updateAttendance.show(); // Explicitly show the toast

     setTimeout(function() {
        location.reload(); // Refresh the page
    }, 2000); // 2000 milliseconds = 2 seconds

    } else {
        // Show error message
        console.error(response.message);
    }
},
        error: function(xhr, status, error) {
            // Show error message if AJAX request fails
            alert('An error occurred while processing your request.');
            console.error(xhr.responseText);
        }
    });
}
    
</script>


<?php include '../template/footer.php'; ?>


