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
    $query = "SELECT * FROM tbl_employee WHERE employee_id= ?";
    
    // Prepare and execute the query
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $employeeId);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the employee data
    $data = $result->fetch_array(MYSQLI_ASSOC);

    // Close statement
    $stmt->close();
}
?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">


<div id="layoutSidenav_content">
    <main>
        <!-- Year and Month Dropdown Filter -->
<div class="container mt-4">
    <div class="row">
        <div class="col-md-4">
            <select class="form-select" id="yearFilter">
                <option value="">Select Year</option>
                <!-- Populate options dynamically with PHP -->
                <?php
                // Assuming you want to populate years from 2020 to current year
                $currentYear = date('Y');
                for ($year = 2020; $year <= $currentYear; $year++) {
                    echo '<option value="' . $year . '">' . $year . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <select class="form-select" id="monthFilter">
                <option value="">Select Month</option>
                <!-- Populate options dynamically with PHP -->
                <?php
                $months = array(
                    '01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April',
                    '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August',
                    '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'
                );
                foreach ($months as $monthNumber => $monthName) {
                    echo '<option value="' . $monthNumber . '">' . $monthName . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="col-md-4">
            <button type="button" class="btn btn-primary" id="filterButton">Apply Filter</button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Function to fetch and update data based on selected filters
    function applyFilter() {
        var year = $('#yearFilter').val();
        var month = $('#monthFilter').val();

        // AJAX request to fetch filtered data
        $.ajax({
            url: 'filter_data.php', // Update with your PHP file to handle AJAX request
            method: 'GET',
            data: {
                year: year,
                month: month
            },
            success: function(response) {
                // Update the table with filtered data
                $('#datatablesSimple tbody').html(response);
            }
        });
    }

    // Apply filter when the button is clicked
    $('#applyFilter').click(function() {
        applyFilter();
    });
});
</script>


<div>                                   
    <button type="button" class="btn btn-primary offset-10 mt-5" data-bs-toggle="modal" data-bs-target="#addAttendance" data-firstname="<?php echo $data['firstname']; ?>" data-lastname="<?php echo $data['lastname']; ?>">Add Attendance <i class="bi bi-plus"></i> </button>
 </div>
        <div class="container-fluid px-4">
            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    <?php echo isset($data['firstname']) && isset($data['lastname']) ? $data['firstname'] . " " . $data['lastname'] : 'Employee Details'; ?>
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
                            <tr>
                                <td> April 01, 2024 - April 15, 2024 </td>
                                <td> 80 </td>
                                <td> 15 </td>
                                <td>
                                    <button class="btn btn-primary"><i class="bi bi-pencil"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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


<!-- ADD ATTENDANCE MODAL --> 
<div class="modal fade" id="addAttendance" tabindex="-1" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">Add Attendance</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">
  <form id="insertAttendance" method="POST">
    <div class="container mt-4">

        <div class="row">
            <div class="col">
                <label for="employee_name" class="form-label">Employee Name:</label>
                <input type="text" name="employee_name" class="form-control" id="employee_name" readonly>
                </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="dateFrm" class="form-label">Date:</label>
                <input type="date" name="dateFrm" class="form-control" id="dateFrm">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>

            <div class="col-md-6">
                <label for="dateFrm" class="form-label"> </label>
                <input type="date" name="dateTo" class="form-control" id="dateTo">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>

            <div class="col-md-4">
                <label for="totalHrs" class="form-label">Total Hours Worked:</label>
                <input type="number" name="totalHrs" class="form-control" id="totalHrs">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>

            <div class="col-md-4">
                <label for="totalDys" class="form-label">Total Days Worked:</label>
                <input type="number" name="totalDys" class="form-control" id="totalDys">
                <div class="error" style="color: red;"></div>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $('#addAttendance').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var firstname = button.data('firstname'); // Extract firstname from data attribute
        var lastname = button.data('lastname'); // Extract lastname from data attribute
        
        // Update input fields in the modal with firstname and lastname
        $('#employee_name').val(firstname + ' ' + lastname);
    });
});
</script>

<?php include '../template/footer.php'; ?>
