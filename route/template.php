
<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<script>
  // JavaScript code to show alert when button is clicked
  $(document).ready(function(){
    $("#myButton").click(function(){
      alert("Ambot Semo");
    });
  });
</script>

<?php
include "../connection/database.php";
$query = $conn->query("SELECT * FROM tbl_employee");
?>

<div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Clients</h3>
  
                        <button id="myButton" class="btn btn-primary offset-11">Click Me</button>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Clients
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Employee ID</th>
                                            <th>Name</th>
                                            <th>Employee Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($data = mysqli_fetch_array($query)) { ?>
                                        <tr id="<?php echo $data['employee_id']; ?>">
                                          <td><?php echo $data['employee_id']; ?></td>
                                          <td><?php echo $data['firstname'] . " " . $data['lastname']; ?></td>
                                          <td><?php echo $data['employee_type']; ?></td>
                                          <td>
                                            <button class="btn btn-primary view" onclick="openModal('<?php echo $data['employee_id'];?>')"> 
                                              <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-danger del" id="<?php echo $data['employee_id']; ?>">
                                              <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn btn-warning edit" id="<?php echo $data['employee_id']; ?>">
                                              <i class="bi bi-pencil"></i>
                                            </button>
                                            </td>
                                        </tr>
                                     <?php } ?>
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
        </div>

<script>
    // VIEW EMPLOYEE SCRIPT
     function openModal(employeeId) {
        // Show the modal
        $('#viewEmployee').modal('show');
        // Switch to the default tab (personal) when opening the modal
        openTab('personal');
        // Fetch employee details using AJAX
        $.ajax({
            url: '../functions/get_employeeId.php',
            type: 'POST',
            data: { id: employeeId },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#firstname').val(response.firstname);
                $('#middlename').val(response.middlename);
                $('#lastname').val(response.lastname);
                $('#address').val(response.address);
                $('#birthdate').val(response.birthdate);
                $('#contactNum').val(response.contact_num);
                $('#civilStatus').val(response.civilstatus);
                $('#personalEmail').val(response.personal_email);
                $('#workEmail').val(response.work_email);
                $('#employeeType').val(response.employee_type);
                $('#startDate').val(response.start_date);
                $('#monthly').val(response.monthly_salary);
                $('#accBonus').val(response.account_bonus);
                $('#client').val(response.client);
                $('#position').val(response.position);
                $('#employmentStatus').val(response.employment_status);
                $('#sss').val(response.sss_num);
                $('#pagibig').val(response.pagibig_num);
                $('#philhealth').val(response.philhealth_num);
                $('#tin').val(response.tin_num);
                $('#sssCon').val(response.sss_con);
                $('#pagibigCon').val(response.pagibig_con);
                $('#philhealthCon').val(response.philhealth_con);
                $('#tax').val(response.tax_percentage);
            }
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#viewEmployee').modal('hide');
    }

    // Function to switch tabs
    function openTab(tabName) {
        // Hide all tabs
        $('.tab').hide();
        // Show the selected tab
        $('#' + tabName).show();

        // Remove active class from all tab links
        $('.nav-tabs .nav-link').removeClass('active');

        // Add active class to the clicked tab link
        $('.nav-tabs a[href="#' + tabName + '"]').addClass('active');
    }

    // Event listener to open modal for each employee
    $(document).ready(function () {
        // Attach click event listeners to tab links
        $('.nav-tabs a').click(function () {
            var tabName = $(this).attr('href').substr(1);
            openTab(tabName);
        });
    });

    $(document).ready(function () {
        var currentTab = 0;
        var totalTabs = $('.nav-tabs a').length;

        // Function to switch to the next tab
        function goToNextTab() {
            currentTab++;
            if (currentTab < totalTabs) {
                var nextTabName = $('.nav-tabs a').eq(currentTab).attr('href').substr(1);
                openTab(nextTabName);
            } else {
                // If all tabs have been visited, close the modal or perform any other action
                closeModal();
            }
        }

        // Attach click event listener to the Next button
        $('#nextButton').click(goToNextTab);
    });

</script>

<!-- VIEW EMPLOYEE MODAL -->
<div class="modal fade" id="viewEmployee" tabindex="-1" aria-labelledby="viewEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="viewEmployeeLabel">Employee Information</h5>

                <!-- Tab links -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#personal">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#employment">Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#benefit">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>

            <!-- Tab content -->
            <div class="modal-body">
                <!-- Personal Information tab -->
                <div id="personal" class="tab">
                    <!-- Your personal information fields here -->
                    <!-- Placeholder for data -->

                    <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                    <input type="" name="firstname" class="form-control" id="firstname" value="<?php echo $data['firstname'];?>">

                    <label for="middleName" class="col-sm-2 col-form-label">Middle Name</label>
                        <input type="" name="middlename" class="form-control" id="middlename" value="<?php echo $data['middlename'];?>">

                        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                        <input type="" name="lastname" class="form-control" id="lastname" value="<?php echo $data['lastname'];?>">

                        <label for="completeAddress" class="col-sm-2 col-form-label">Complete Address</label>
                        <input type="" name="address" class="form-control" id="address" value="<?php echo $data['address'];?>">

                        <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                        <input type="date" name="birthdate" class="form-control" id="birthdate" value="<?php echo $data['birthdate'];?>">

                        <label for="contactNum" class="col-sm-2 col-form-label">Contact Number </label>
                        <input type="" name="contactNum" class="form-control" id="contactNum" value="<?php echo $data['contact_num'];?>">

                        <label for="civilStatus" class="col-sm-2 col-form-label">Civil Status</label>
                        <input type="" name="civilStatus" class="form-control" id="civilStatus" value="<?php echo $data['civilstatus'];?>">

                        <!-- <select class="form-select" name="createCivilStatus" aria-label="Civil Status Select">
                            <option selected>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select> -->

                        <label for="personalEmail" class="col-sm-2 col-form-label">Personal Email</label>
                        <input type="" name="personalEmail" class="form-control" id="personalEmail" value="<?php echo $data['personal_email'];?>">

                        <label for="workEmail" class="col-sm-2 col-form-label">Work Email</label>
                        <input type="" name="workEmail" class="form-control" id="workEmail" value="<?php echo $data['work_email'];?>">

                        <label for="employeeType" class="col-sm-2 col-form-label"> Employee Type </label>
                        <input type="" name="employeeType" class="form-control" id="employeeType" value="<?php echo $data['employee_type'];?>">
                        <!-- <select class="form-select" name="createEmployeeType" aria-label="Employee Type Select">
                            <option selected>Select Employee Type</option>
                            <option value="Onsite">Work From Home</option>
                            <option value="Home">Work Onsite</option>
                            <option value="3">3</option>
                        </select> -->
                </div>


                <!-- Employment Details tab -->
                <div id="employment" class="tab">
                    <!-- Your employment details fields here -->
                    <!-- Placeholder for data -->
                    <label for="startDate" class="col-sm-2 col-form-label">Start Date</label>
                    <input type="" name="startDate" class="form-control" id="startDate" value="<?php echo $data['start_date'];?>">

                    <label for="monthly" class="col-sm-2 col-form-label">Monthly Salary</label>
                    <input type="" name="monthly" class="form-control" id="monthly" value="<?php echo $data['monthly_salary'];?>">

                    <label for="accBonus" class="col-sm-2 col-form-label">Account Bonus</label>
                    <input type="" name="accBonus" class="form-control" id="accBonus" value="<?php echo $data['account_bonus'];?>">

                    <label for="client" class="col-sm-2 col-form-label">Client</label>
                    <input type="" name="client" class="form-control" id="client" value="<?php echo $data['client'];?>">

                    <label for="position" class="col-sm-2 col-form-label">Position</label>
                    <input type="" name="position" class="form-control" id="position" value="<?php echo $data['position'];?>">

                    <label for="employmentStatus" class="col-sm-2 col-form-label">Employment Status</label>
                    <input type="" name="employmentStatus" class="form-control" id="employmentStatus" value="<?php echo $data['employment_status'];?>">

                </div>

                <!-- Benefit Details tab -->
                <div id="benefit" class="tab">
                    <!-- Your benefit details fields here -->
                    <!-- Placeholder for data -->
                    <label for="sss" class="col-sm-2 col-form-label">SSS Number:</label>
                    <input type="" name="sss" class="form-control" id="sss" value="<?php echo $data['sss_num'];?>">

                    <label for="pagibig" class="col-sm-2 col-form-label">Pag-ibig Number:</label>
                    <input type="" name="pagibig" class="form-control" id="pagibig" value="<?php echo $data['pagibig_num'];?>">

                    <label for="philhealth" class="col-sm-2 col-form-label">Philhealth Number:</label>
                    <input type="" name="philhealth" class="form-control" id="philhealth" value="<?php echo $data['philhealth_num'];?>">

                    <label for="tin" class="col-sm-2 col-form-label">Tin Number:</label>
                    <input type="" name="tin" class="form-control" id="tin" value="<?php echo $data['tin_num'];?>">

                    <label for="sssCon" class="col-sm-2 col-form-label">SSS Contribution:</label>
                    <input type="" name="sssCon" class="form-control" id="sssCon" value="<?php echo $data['sss_con'];?>">

                    <label for="pagibigCon" class="col-sm-2 col-form-label">Pag-ibig Contribution:</label>
                    <input type="" name="pagibigCon" class="form-control" id="pagibigCon" value="<?php echo $data['pagibig_con'];?>">

                    <label for="philhealthCon" class="col-sm-2 col-form-label">Philhealth Contribution:</label>
                    <input type="" name="philhealthCon" class="form-control" id="philhealthCon" value="<?php echo $data['philhealth_con'];?>">

                    <label for="tax" class="col-sm-2 col-form-label">Tax Percentage:</label>
                    <input type="" name="tax" class="form-control" id="tax" value="<?php echo $data['tax_percentage'];?>">

                </div>
                 <div class="modal-footer">
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="nextButton">Next</button>
                 </div>
            </div>
        </div>
    </div>
</div>


<?php include '../template/footer.php' ?>
