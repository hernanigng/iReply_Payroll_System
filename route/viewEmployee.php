<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/employee_style.css">

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
  
                        <button type="button" class="btn btn-primary offset-10" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee</button>

                                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="exampleModalLabel">Create New Employee</h5>    
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active employee-personal" aria-current="page" href="#">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link employment-details" href="#">Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link benefit-details" href="#">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
            </div>

        <div class="modal-body" id="personalInformationContent">
            
            <form id="employmentListForm" method="POST">
                 <span class="notif"></span>
            
                <div id="insertEmployee">
                    
                    <div class="mb-3 row">
                        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                        <input type="text" name="createFirstName" class="form-control" id="createFirstName_id">
                        
                        <label for="middleName" class="col-sm-2 col-form-label">Middle Name</label>
                        <input type="text" name="createMiddleName" class="form-control" id="createMiddleName_id">

                        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                        <input type="text" name="createLastName" class="form-control" id="createLastName_id">

                        <label for="completeAddress" class="col-sm-2 col-form-label">Complete Address</label>
                        <input type="text" name="createAddress" class="form-control" id="createAddress_id">

                        <label for="birthDate" class="col-sm-2 col-form-label">Birthdate</label>
                        <input type="date" name="createBirthdate" class="form-control" id="createBirthdate_id">

                        <label for="contactNum" class="col-sm-2 col-form-label">Contact Number </label>
                            <input type="text" name="createContactNum" class="form-control number-error" id="contactNumber_id">
                            <i class="fas fa-times input-icon" style="display: none;"></i>
                            <p id="NumError" class="error-message" style="display: none;"> Contact number should be 11 digits.</p>

                        <label for="civilStatus" class="col-sm-2 col-form-label">Civil Status</label>
                        <select class="form-select" name="createCivilStatus" aria-label="Civil Status Select">
                            <option selected>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        
                        <label for="personalEmail" class="col-sm-2 col-form-label">Personal Email</label>
                        <input type="text" name="createPersEmail" class="form-control" id="createPersEmail_id">

                        <label for="workEmail" class="col-sm-2 col-form-label">Work Email</label>
                        <input type="text" name="createWorkEmail" class="form-control" id="createWorkEmail_id">

                        <label for="employeeType" class="col-sm-2 col-form-label"> Employee Type </label>
                        <select class="form-select" name="createEmployeeType" aria-label="Employee Type Select">
                            <option selected>Select Employee Type</option>
                            <option value="Onsite">Work From Home</option>
                            <option value="Home">Work Onsite</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                 <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button> -->
                 <a href="#employmentDetailsContent.php" class="btn btn-primary" id="showEmploymentForm">Next</a>
                    </div>
                </div>
           
                <div id="employmentDetailsContent" style="display: none;">
    
                            <div class="mb-3 row">
                                <label for="startDate" class="col-sm-3 col-form-label">Start Date</label>
                                <input type="date" name="createStartDate" class="form-control createStartDate" id="createStartDate_id">

                                <label for="monthSalary" class="col-sm-3 col-form-label">Monthly Salary</label>
                                <input type="number" name="createMonthlySalary" class="form-control" id="createMonthlySalary_id" placeholder="PHP 0.00">
                                <div id="error" style="color: red;"></div>

                                <label for="accountBonus" class="col-sm-3 col-form-label">Account Bonus</label>
                                <input type="number" name="createAccountBonus" class="form-control" id="createBonus_id" placeholder="PHP 0.00">
                                <div id="error" style="color: red;"></div>

                                 <label for="client" class="col-sm-2 col-form-label">Client</label>
                                <select class="form-select" name="createClient" aria-label="Client Select">
                                    <option selected disabled>Choose a client</option>
                                    <?php
                                        include "../connection/database.php";
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT Client_ID, Company_Name FROM tbl_client";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["Client_ID"] . '">' . $row["Company_Name"] . '</option>';
                                            }
                                        }

                                        $conn->close();
                                        ?>
                                </select>

                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $selectedClientId = $_POST['createClient'];
                                        //echo "Selected Client ID: " . $selectedClientId;
                                    }
                                ?>
                                
                                <label for="position" class="col-sm-2 col-form-label">Position</label>
                                <select class="form-select" name="createPosition" aria-label="Position Select">
                                <option selected disabled>Choose a position</option>
                                    <?php
                                        include "../connection/database.php";
                                        if ($conn->connect_error) {
                                            die("Connection failed: " . $conn->connect_error);
                                        }

                                        $sql = "SELECT position_ID, Title FROM tbl_position";
                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . $row["position_ID"] . '">' . $row["Title"] . '</option>';
                                            }
                                        }

                                        $conn->close();
                                        ?>
                                </select>

                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $selectedPositionID = $_POST['createPosition'];
                                        //echo "Selected Position: " . $selectedPositionID;
                                    }
                                ?>

                                <label for="employmentStatus" class="col-sm-2 col-form-label">Employment Status</label>
                                <select class="form-select" name="createEmploymentStatus" aria-label="Employment Status Select">
                                    <option selected>Select Employment Status</option>
                                    <option value="Part Time">Part-Time</option>
                                    <option value="Full Time">Full-Time</option>
                                </select>
            
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="returnPersonalForm">Back</button>
                                <a href="#" class="btn btn-primary" id="showBenefitsForm">Next</a>
                            </div>
                            
                </div>
        
                <div id="benefitDetailsContent" style="display: none;">

                            <div class="mb-3 row">
                                <label for="sss" class="col-sm-3 col-form-label">SSS Number</label>
                                <input type="number" name="createSSS" class="form-control number-error" id="createSSS_id">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="sssNumberError" class="error-message" style="display: none;"> SSS number should be 10 digits.</p>

                                <label for="pagibig" class="col-sm-3 col-form-label">Pag-ibig Number</label>
                                <input type="number" name="createPagibig" class="form-control number-error" id="createPagibig_id">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="pagibigNumberError" class="error-message" style="display: none;"> Pagibig number should be 12 digits.</p>

                                <label for="philhealth" class="col-sm-3 col-form-label">Philhealth Number</label>
                                <input type="number" name="createPhilhealth" class="form-control number-error" id="createPhilhealth_id">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="philhealthNumberError" class="error-message" style="display: none;"> Philhealth number should be 12 digits.</p>

                                <label for="tin" class="col-sm-3 col-form-label">TIN Number</label>
                                <input type="number" name="createTin" class="form-control number-error" id="createTin_id">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="tinNumberError" class="error-message" style="display: none;"> Tin number should be 9-12 digits.</p>

                                <label for="sssContrib" class="col-sm-3 col-form-label">SSS Contribution</label>
                                <input type="number" name="createSSSContrib" class="form-control" id="createSSSContrib_id">

                                <label for="pagibigContrib" class="col-sm-3 col-form-label">Pagibig Contribution </label>
                                <input type="number" name="createPagibigContrib" class="form-control" id="createPagibigContrib_id">

                                <label for="philhealthContrib" class="col-sm-3 col-form-label">Philhealth Contribution</label>
                                <input type="number" name="createPhilhealthContrib" class="form-control" id="createPhilhealthContrib_id">

                                <label for="taxPercent" class="col-sm-3 col-form-label">Tax Percentage </label>
                                <input type="number" name="createTaxPercent" class="form-control" id="createTaxPercent_id">
            
                            </div>

                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-danger" id="returnDetailsForm">Back</button>
                        <button type="submit" class="btn btn-success" id="checkBenefits">Save</button>
                    </div>

                </div>

            </form>
        </div>
            
        </div>
        </div>
        </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        
        //Add currency 
        const currencyInput = document.getElementById('createMonthlySalary_id');
        const errorDiv = document.getElementById('error');

        currencyInput.addEventListener('input', function(event) {
            const value = event.target.value;
            
            // Clear previous error message
            errorDiv.textContent = '';

            // Remove non-numeric characters and format as currency
            const formattedValue = parseFloat(value.replace(/[^0-9.]/g, '')).toFixed(2);
            
            // Check if value is valids
            if (isNaN(formattedValue)) {
                errorDiv.textContent = 'Invalid currency format';
                return;
            }

            // Update input field with formatted value
            currencyInput.value = formattedValue;
        });

        //Contact Number Error Message
        document.getElementById('contactNumber_id').addEventListener('input', function() {
            var contactNumInput = this;
            var error = document.getElementById('NumError');

            // Check if the contact number input field value has exactly 11 digits
            if (contactNumInput.value.trim().length === 11) {
                contactNumInput.classList.remove('highlight');
                error.style.display = 'none';
            } else {
                // If it doesn't have exactly 11 digits, ensure the highlight and error message are displayed
                contactNumInput.classList.add('highlight');
                error.style.display = 'block';
            }
        });


        var employmentTab = document.querySelector('.employment-details');
        var employmentPersonal = document.querySelector('.employee-personal');
        var modalBody = document.querySelector('#personalInformationContent');
        var personalInfoForm = document.getElementById('insertEmployee');
        var modalBody2 = document.querySelector('#employmentDetailsContent');

        <!-- Employment Details -->
         document.getElementById('showEmploymentForm').addEventListener('click', function(event) {
            event.preventDefault();

             document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the Employment Details nav-link
            document.querySelector('.employment-details').classList.add('active');
            var inputFields = document.querySelectorAll('#insertEmployee input[type="text"], #insertEmployee input[type="date"], #insertEmployee select');

            inputFields.forEach(function(inputField) {
                inputField.classList.remove('highlight');
            });

            // Check if any input field is blank
            var anyBlank = false;
            inputFields.forEach(function(inputField) {
                if (inputField.tagName.toLowerCase() === 'select') {
                // For select elements, check if the selected option is the default one
                    if (inputField.selectedIndex === 0) {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                    }
                } else {
                    // For other input elements, check if the value is blank
                    if (inputField.value.trim() === "") {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                }  
                     else if (inputField.id === "contactNumber_id" && inputField.value.length !== 11) {
                    // For the contact number input, check if it exceeds 11 digits
                    inputField.classList.add('highlight');
                    anyBlank = true;
                    document.getElementById('NumError').style.display = 'block'; // Display error message
        }
            }
            });

            // If any input field is blank, prevent further action
            if (anyBlank) {
                return;
            }

            personalInfoForm.style.display = 'none';
            modalBody2.style.display = 'block';
        });

        <!-- Back to Personal Information Form -->
        employmentPersonal.addEventListener('click', function(event) {
            event.preventDefault();

            modalBody2.style.display = 'none';
            personalInfoForm.style.display = 'block';
            
        });

         document.getElementById('returnPersonalForm').addEventListener('click', function(event) {
            event.preventDefault();

            modalBody2.style.display = 'none';
            personalInfoForm.style.display = 'block';
        });

        <!-- Benefits Form -->
        var benefitTab = document.querySelector('.benefit-details');
        var modalBody3 = document.querySelector('#benefitDetailsContent');

         document.getElementById('showBenefitsForm').addEventListener('click', function(event) {
            event.preventDefault();

            document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });

            // Add active class to the Employment Details nav-link
            document.querySelector('.benefit-details').classList.add('active');

            var inputFields = document.querySelectorAll('#employmentDetailsContent input[type="number"], #employmentDetailsContent input[type="date"], #employmentDetailsContent select');

            inputFields.forEach(function(inputField) {
                inputField.classList.remove('highlight');
            });

            // Check if any input field is blank
            var anyBlank = false;
            inputFields.forEach(function(inputField) {
                if (inputField.tagName.toLowerCase() === 'select') {
                // For select elements, check if the selected option is the default one
                    if (inputField.selectedIndex === 0) {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                    }
                } else {
                    // For other input elements, check if the value is blank
                    if (inputField.value.trim() === "") {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                    }
            }
            });
            // If any input field is blank, prevent further action
            if (anyBlank) {
                return;
            }

            modalBody2.style.display = 'none';
            modalBody3.style.display = 'block';
        });

        <!-- Back to Employment Details Form -->

        employmentTab.addEventListener('click', function(event) {
            event.preventDefault();

            modalBody3.style.display = 'none';
            modalBody2.style.display = 'block';
        });

         document.getElementById('returnDetailsForm').addEventListener('click', function(event) {
            event.preventDefault();

            modalBody3.style.display = 'none';
            modalBody2.style.display = 'block';
        });

        <!-- Benefits Tab to Personal Information-->

        employmentPersonal.addEventListener('click', function(event) {
            event.preventDefault();

            modalBody3.style.display = 'none';
            modalBody.style.display = 'block';
        });

    <!-- Benefits Form error message -->

        document.getElementById('createSSS_id').addEventListener('input', function() {
            var sssInput = this;
            var error = document.getElementById('sssNumberError');

            if (sssInput.value.trim().length === 10) {
                sssInput.classList.remove('highlight');
                error.style.display = 'none';
            } else {
                sssInput.classList.add('highlight');
                error.style.display = 'block';
            }
        });

        document.getElementById('createPagibig_id').addEventListener('input', function() {
            var pagibigInput = this;
            var error = document.getElementById('pagibigNumberError');

            if (pagibigInput.value.trim().length === 12) {
                pagibigInput.classList.remove('highlight');
                error.style.display = 'none';
            } else {
                pagibigInput.classList.add('highlight');
                error.style.display = 'block';
            }
        });

         document.getElementById('createPhilhealth_id').addEventListener('input', function() {
            var philhealthInput = this;
            var error = document.getElementById('philhealthNumberError');

            if (philhealthInput.value.trim().length === 12) {
                philhealthInput.classList.remove('highlight');
                error.style.display = 'none';
            } else {
                philhealthInput.classList.add('highlight');
                error.style.display = 'block';
            }
        });

        document.getElementById('createTin_id').addEventListener('input', function() {
            var tinInput = this;
            var error = document.getElementById('tinNumberError');

            var tinLength = tinInput.value.trim().length;
            if (tinLength >= 9 && tinLength <= 12) {
                tinInput.classList.remove('highlight');
                error.style.display = 'none';
            } else {
                tinInput.classList.add('highlight');
                error.style.display = 'block';
            }
        });


    <!-- Error Before Saving -->
        document.getElementById('checkBenefits').addEventListener('click', function(event) {
            event.preventDefault();

            var inputFields = document.querySelectorAll('#benefitDetailsContent input[type="number"]');

            inputFields.forEach(function(inputField) {
                inputField.classList.remove('highlight');
            });

            // Check if any input field is blank
            var anyBlank = false;
            inputFields.forEach(function(inputField) {

                if (inputField.value.trim() === "") {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                } else if (inputField.id === "createSSS_id" && inputField.value.length !== 10) {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                    document.getElementById('sssNumberError').style.display = 'block'; // Display SSS error message
                } else if (inputField.id === "createPagibig_id" && inputField.value.length !== 12) {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                    document.getElementById('pagibigNumberError').style.display = 'block'; // Display Pag-ibig error message
                } else if (inputField.id === "createPhilhealth_id" && inputField.value.length !== 12) {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                    document.getElementById('philhealthNumberError').style.display = 'block'; // Display Philhealth error message
                } else if (inputField.id === "createTin_id" && (inputField.value.length < 9 || inputField.value.length > 12)) {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                    document.getElementById('tinNumberError').style.display = 'block'; // Display TIN error message
                }
            });

            // If any input field is blank, prevent further action
            if (anyBlank) {
                return;
            }

           var data = $('#employmentListForm').serialize();
                var url = "functions/createEmployee.php";

              $.post(url, data, function(response) {
                    console.log("Server Response:", response);
                        $('#exampleModal').modal('hide');
                        $('.toast').toast('show');  

                        $('.toast').on('hidden.bs.toast', function () {
                            // Remove the dark overlay
                            $('.modal-backdrop').remove();
                            // Enable navigation
                            $('body').css('overflow', 'auto');
                        });

                    if (response.status === 'success') {
                        // Construct the new row for the table
                        var newRow = '<tr id="' + response.employee_id + '">' +
                            '<td>' + response.employee_id + '</td>' +
                            '<td>' + response.firstname + ' ' + response.lastname + '</td>' +
                            '<td>' + response.employee_type + '</td>' +
                            '<td>' +
                            '<button class="btn btn-primary view" onclick="openModal(\'' + response.employee_id + '\')"> <i class="bi bi-eye"></i> </button>' +
                           '<button class="btn btn-danger del" data-employee_id="' + response.employee_id + '"> <i class="bi bi-trash"></i> </button>' +
                            '<button class="btn btn-warning edit" id="' + response.employee_id + '"> <i class="bi bi-pencil"></i> </button>' +
                            '</td>' +
                            '</tr>';


                        $('#datatablesSimple tbody').prepend(newRow);
                    } else {
                        // Handle error if insertion was not successful
                        console.log("Error:", response.message);
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log("AJAX Error:", textStatus, errorThrown);
                });

        });
    });
</script>

       <!-- Toast Notification -->
        <div class="toast position-fixed top-50 start-50 translate-middle"  role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Employee Successfully Inserted
            </div>
        </div>
        <div class="modal-footer"> </div>

<div class="status"> </div>
                    <?php include "../connection/database.php";
                    
                    $query = "SELECT * FROM tbl_employee";

                     $result = mysqli_query($conn, $query);

            // Check if the query executed successfully
                     if (!$result) {
            // Query execution failed, handle the error
                     echo "Error: " . mysqli_error($conn);
                    exit; // Stop further execution
             }

                    ?>

                    
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
                                    <?php while ($data = mysqli_fetch_array($result)) { ?>
                                        <tr id="<?php echo $data['employee_id']; ?>">
                                          <td><?php echo $data['employee_id']; ?></td>
                                          <td><?php echo $data['firstname'] . " " . $data['lastname']; ?></td>
                                          <td><?php echo $data['employee_type']; ?></td>
                                          <td>
                                            <button class="btn btn-primary view" onclick="openModal('<?php echo $data['employee_id'];?>')"> 
                                              <i class="bi bi-eye"></i>
                                            </button>
                                              <button class="btn btn-danger del" data-employee_id="<?php echo $data['employee_id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn btn-warning edit" onclick="openEditModal('<?php echo $data['employee_id'];?>')">
                                              <i class="bi bi-pencil"></i>
                                            </button>
                                            </td>
                                        </tr>
                                     <?php } ?>
                                   </tbody>
                                </table>
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

            
            
    <!-- Delete Employee Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">   
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>

<script>
  $(document).on('click', '.del', function() {
        $('#confirmDeleteModal').modal('show');
        var employeeId = $(this).data('employee_id'); // Retrieve employee_id using data() method
        
        $('#confirmDeleteButton').data('employeeId', employeeId);
    });

    $('#confirmDeleteButton').click(function() {
        var employeeId = $(this).data('employeeId'); // Retrieve employeeId from data attribute
        console.log*('employeeId');
        
    var formData = $('#employmentListForm').serialize();
    
    formData += '&id=' + employeeId;
    
    $.ajax({
        type: 'POST',
        url: 'functions/getEmployeeData.php',
        data: { id: employeeId },
        success: function(response) {
            console.log('Data inserted into tbl_archive');
            alert(response);
        },
        error: function(xhr, status, error) {
            console.error('Error inserting data into tbl_archive:', error);
        }
    });

        $.ajax({
            type: 'POST',
            url: '../functions/deleteEmployee.php',
            data: { id: employeeId },
            success: function(response) {
                //alert(response);
                console.log('Employee deleted successfully');
                 window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error deleting employee:', error);
            }
        });  
    
        $('#confirmDeleteModal').modal('hide');
});

</script>
            
<script> 
 // VIEW EMPLOYEE SCRIPT

 function openModal(id) {
    //console.log();
        // Show the modal
        $('#viewEmployee').modal('show');
        // Switch to the default tab (personal) when opening the modal
        openTab('personal');
        // Fetch employee details using AJAX
        $.ajax({
            url: 'functions/get_employeeId.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#firstname').text(response.firstname);
                $('#middlename').text(response.middlename);
                $('#lastname').text(response.lastname);
                $('#address').text(response.address);
                $('#birthdate').text(response.birthdate);
                $('#contactNum').text(response.contact_num);
                $('#civilStatus').text(response.civilstatus);
                $('#personalEmail').text(response.personal_email);
                $('#workEmail').text(response.work_email);
                $('#employeeType').text(response.employee_type);
                $('#startDate').text(response.start_date);
                $('#monthly').text(response.monthly_salary);
                $('#accBonus').text(response.account_bonus);
                $('#client').text(response.client);
                $('#position').text(response.position);
                $('#employmentStatus').text(response.employment_status);
                $('#sss').text(response.sss_num);
                $('#pagibig').text(response.pagibig_num);
                $('#philhealth').text(response.philhealth_num);
                $('#tin').text(response.tin_num);
                $('#sssCon').text(response.sss_con);
                $('#pagibigCon').text(response.pagibig_con);
                $('#philhealthCon').text(response.philhealth_con);
                $('#tax').text(response.tax_percentage);
            }
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#viewEmployee').modal('hide');
    }

    // Function to switch tabs
    function openTab(personal) {
        // Hide all tabs
        $('.tab').hide();
        // Show the selected tab
        $('#' + personal).show();

        // Remove active class from all tab links
        $('.nav-tabs .nav-link').removeClass('active');

        // Add active class to the clicked tab link
        $('.nav-tabs a[href="#' + personal + '"]').addClass('active');
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
                    <span class="form-control" id="firstname"> </span>

                    <label for="middleName" class="col-sm-2 col-form-label">Middle Name</label>
                    <span class="form-control" id="middlename"> </span>

                    <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                    <span class="form-control" id="lastname"> </span>

                    <label for="completeAddress" class="col-sm-2 col-form-label">Complete Address</label>
                    <span class="form-control" id="address"> </span>
                        
                    <label for="birthdate" class="col-sm-2 col-form-label">Birthdate</label>
                    <span class="form-control" id="birthdate"> </span>

                    <label for="contactNum" class="col-sm-2 col-form-label">Contact Number </label>
                    <span class="form-control" id="contactNum"> </span>

                    <label for="civilStatus" class="col-sm-2 col-form-label">Civil Status</label>
                    <span class="form-control" id="civilStatus">  </span>

                    <label for="personalEmail" class="col-sm-2 col-form-label">Personal Email</label>
                    <span class="form-control" id="personalEmail">  </span>

                    <label for="workEmail" class="col-sm-2 col-form-label">Work Email</label>
                    <span class="form-control" id="workEmail"> </span>

                    <label for="employeeType" class="col-sm-2 col-form-label"> Employee Type </label>
                    <span class="form-control" id="employeeType"> </span>
                </div>


                <!-- Employment Details tab -->
                <div id="employment" class="tab">
                    <!-- Your employment details fields here -->
                    <!-- Placeholder for data -->
                    <label for="startDate" class="col-sm-2 col-form-label">Start Date</label>
                    <span class="form-control" id="startDate"> </span>

                    <label for="monthly" class="col-sm-2 col-form-label">Monthly Salary</label>
                    <span class="form-control" id="monthly"> </span>

                    <label for="accBonus" class="col-sm-2 col-form-label">Account Bonus</label>
                    <span class="form-control" id="accBonus">  </span>

                    <label for="client" class="col-sm-2 col-form-label">Client</label>
                    <span class="form-control" id="client"> </span>

                    <label for="position" class="col-sm-2 col-form-label">Position</label>
                    <span class="form-control" id="position"> </span>

                    <label for="employmentStatus" class="col-sm-2 col-form-label">Employment Status</label>
                    <span class="form-control" id="employmentStatus"> </span>

                </div>

                <!-- Benefit Details tab -->
                <div id="benefit" class="tab">
                    <!-- Your benefit details fields here -->
                    <!-- Placeholder for data -->
                    <label for="sss" class="col-sm-2 col-form-label">SSS Number:</label>
                    <span class="form-control" id="sss"> </span>

                    <label for="pagibig" class="col-sm-2 col-form-label">Pag-ibig Number:</label>
                    <span class="form-control" id="pagibig"> </span>

                    <label for="philhealth" class="col-sm-2 col-form-label">Philhealth Number:</label>
                    <span class="form-control" id="philhealth">  </span>

                    <label for="tin" class="col-sm-2 col-form-label">Tin Number:</label>
                    <span class="form-control" id="tin"> </span>

                    <label for="sssCon" class="col-sm-2 col-form-label">SSS Contribution:</label>
                    <span class="form-control" id="sssCon">  </span>

                    <label for="pagibigCon" class="col-sm-2 col-form-label">Pag-ibig Contribution:</label>
                    <span class="form-control" id="pagibigCon">  </span>

                    <label for="philhealthCon" class="col-sm-2 col-form-label">Philhealth Contribution:</label>
                    <span class="form-control" id="philhealthCon"> </span>

                    <label for="tax" class="col-sm-2 col-form-label">Tax Percentage:</label>
                    <span class="form-control" id="tax"> </span>

                </div>
                 <div class="modal-footer">
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="nextButton">Next</button>
                 </div>
            </div>
        </div>
    </div>
</div>



<script>
    // EDIT EMPLOYEE SCRIPT
    function openEditModal(employeeId) {
        // Show the modal
        $('#editEmployee').modal('show');
        // Switch to the default tab (personal) when opening the modal
        openEditTab('personalEdit');
        // Fetch employee details using AJAX
        $.ajax({
            url: 'functions/get_employeeId.php',
            type: 'POST',
            data: { id: employeeId },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#employeeId').val(response.employee_id);
                $('#edit_firstname').val(response.firstname);
                $('#edit_middlename').val(response.middlename);
                $('#edit_lastname').val(response.lastname);
                $('#edit_address').val(response.address);
                $('#edit_birthdate').val(response.birthdate);
                $('#edit_contactNum').val(response.contact_num);
                //$('#edit_civilStatus').val(response.civilstatus);
                $('#edit_personalEmail').val(response.personal_email);
                $('#edit_workEmail').val(response.work_email);
                //$('#edit_employeeType').val(response.employee_type);
                $('#edit_startDate').val(response.start_date);
                $('#edit_monthly').val(response.monthly_salary);
                $('#edit_accBonus').val(response.account_bonus);
                //$('#edit_client').val(response.client);
                //$('#edit_position').val(response.position);
                //$('#edit_employmentStatus').val(response.employment_status);
                $('#edit_sss').val(response.sss_num);
                $('#edit_pagibig').val(response.pagibig_num);
                $('#edit_philhealth').val(response.philhealth_num);
                $('#edit_tin').val(response.tin_num);
                $('#edit_sssCon').val(response.sss_con);
                $('#edit_pagibigCon').val(response.pagibig_con);
                $('#edit_philhealthCon').val(response.philhealth_con);
                $('#edit_tax').val(response.tax_percentage);

    // Set the selected option in the select element
    $('#edit_civilStatus').val(response.civilstatus);
    $('#edit_employeeType').val(response.employee_type);
    $('#edit_client').val(response.client);
    $('#edit_position').val(response.position);
    $('#edit_employmentStatus').val(response.employment_status);
            }
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#editEmployee').modal('hide');
    }

    // Function to switch tabs
    function openEditTab(personalEdit) {
        // Hide all tabs
        $('.tab').hide();
        // Show the selected tab
        $('#' + personalEdit).show();

        // Remove active class from all tab links
        $('.nav-tabs .nav-link').removeClass('active');

        // Add active class to the clicked tab link
        $('.nav-tabs a[href="#' + personalEdit + '"]').addClass('active');
    }

    // Event listener to open modal for each employee
    $(document).ready(function () {
        // Attach click event listeners to tab links
        $('.nav-tabs a').click(function () {
            var tabName = $(this).attr('href').substr(1);
            openEditTab(tabName);
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
                openEditTab(nextTabName);
            } else {
                // If all tabs have been visited, close the modal or perform any other action
                closeModal();
            }
        }

        // Attach click event listener to the Next button
        $('#nextEditButton').click(goToNextTab);
    });


   
</script>
<!-- EDIT EMPLOYEE MODAL -->
<div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="editEmployeeLabel">Employee Information</h5>

                <!-- Tab links -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#personalEdit">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#employmentEdit">Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#benefitEdit">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>

            <!-- Tab content -->
            <div class="modal-body">
                <!-- Personal Information tab -->
                <div id="personalEdit" class="tab">
                    <!-- Your personal information fields here -->
                    <!-- Placeholder for data -->

                        <input type="hidden" name="employeeId" class="form-control" id="employeeId">

                        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                        <input type="" name="edit_firstname" class="form-control" id="edit_firstname">
                        
                        <label for="middleName" class="col-sm-2 col-form-label">Middle Name</label>
                        <input type="" name="edit_middlename" class="form-control" id="edit_middlename">

                        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                        <input type="" name="edit_lastname" class="form-control" id="edit_lastname">

                        <label for="completeAddress" class="col-sm-2 col-form-label">Complete Address</label>
                        <input type="" name="edit_address" class="form-control" id="edit_address">

                        <label for="birthDate" class="col-sm-2 col-form-label">Birthdate</label>
                        <input type="date" name="edit_birthdate" class="form-control" id="edit_birthdate">

                        <label for="contactNum" class="col-sm-2 col-form-label">Contact Number </label>
                        <input type="" name="edit_contactNum" class="form-control" id="edit_contactNum">

                        <label for="civilStatus" class="col-sm-2 col-form-label">Civil Status</label>
                        <select class="form-select" name="edit_civilStatus" aria-label="Civil Status Select" id="edit_civilStatus">
                            <option selected>Select Civil Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                        
                        <label for="personalEmail" class="col-sm-2 col-form-label">Personal Email</label>
                        <input type="" name="edit_personalEmail" class="form-control" id="edit_personalEmail">

                        <label for="workEmail" class="col-sm-2 col-form-label">Work Email</label>
                        <input type="" name="edit_workEmail" class="form-control" id="edit_workEmail">

                        <label for="employeeType" class="col-sm-2 col-form-label"> Employee Type </label>
                        <select class="form-select" name="edit_employeeType" aria-label="Employee Type Select" id="edit_employeeType">
                            <option selected>Select Employee Type</option>
                            <option value="Home">Work From Home</option>
                            <option value="Onsite">Work Onsite</option>
                        </select>
                    
                    </div>

                <!-- Employment Details tab -->
                <div id="employmentEdit" class="tab">
                    <!-- Your employment details fields here -->
                    <!-- Placeholder for data -->

                               <label for="startDate" class="col-sm-3 col-form-label">Start Date</label>
                               <input type="date" name="edit_startDate" class="form-control createStartDate" id="edit_startDate">

                                <label for="monthSalary" class="col-sm-3 col-form-label">Monthly Salary</label>
                                <input type="number" name="edit_monthly" class="form-control" id="edit_monthly">

                                <label for="accountBonus" class="col-sm-3 col-form-label">Account Bonus</label>
                                <input type="number" name="edit_accBonus" class="form-control" id="edit_accBonus">

                                <label for="client" class="col-sm-2 col-form-label">Client</label>
                                <select class="form-select" name="edit_client" aria-label="Client Select" id="edit_client">
                                    <option selected>Select Client</option>
                                    <option value="VOXRUSH">VOXRUSH</option>
                                    <option value="Telepath">Telepath</option>
                                    <option value="Netsapiens">Netsapiens</option>
                                </select>
                                
                                <label for="position" class="col-sm-2 col-form-label">Position</label>
                                <select class="form-select" name="edit_position" aria-label="Position Select" id="edit_position">
                                    <option selected>Select Position</option>
                                    <option value="QA">QA</option>
                                    <option value="NOC">NOC</option>
                                    <option value="Accountant">Accountant</option>
                                </select>

                                <label for="employmentStatus" class="col-sm-2 col-form-label">Employment Status</label>
                                <select class="form-select" name="edit_employmentStatus" aria-label="Employment Status Select" id="edit_employmentStatus">
                                    <option selected>Select Employment Status</option>
                                    <option value="Part Time">Part-Time</option>
                                    <option value="Full Time">Full-Time</option>
                                </select>
            

                </div>

                <!-- Benefit Details tab -->
                <div id="benefitEdit" class="tab">
                    <!-- Your benefit details fields here -->
                    <!-- Placeholder for data -->

                               <label for="sss" class="col-sm-3 col-form-label">SSS Number</label>
                               <input type="text" name="edit_sss" class="form-control" id="edit_sss">

                                <label for="pagibig" class="col-sm-3 col-form-label">Pag-ibig Number</label>
                                <input type="text" name="edit_pagibig" class="form-control" id="edit_pagibig">

                                <label for="philhealth" class="col-sm-3 col-form-label">Philhealth Number</label>
                                <input type="text" name="edit_philhealth" class="form-control" id="edit_philhealth">

                                <label for="tin" class="col-sm-3 col-form-label">TIN Number</label>
                                <input type="text" name="edit_tin" class="form-control" id="edit_tin">

                                <label for="sssContrib" class="col-sm-3 col-form-label">SSS Contribution</label>
                                <input type="text" name="edit_sssCon" class="form-control" id="edit_sssCon">

                                <label for="pagibigContrib" class="col-sm-3 col-form-label">Pagibig Contribution </label>
                                <input type="number" name="edit_pagibigCon" class="form-control" id="edit_pagibigCon">

                                <label for="philhealthContrib" class="col-sm-3 col-form-label">Philhealth Contribution</label>
                                <input type="number" name="edit_philhealthCon" class="form-control" id="edit_philhealthCon">

                                <label for="taxPercent" class="col-sm-3 col-form-label">Tax Percentage </label>
                                <input type="number" name="edit_tax" class="form-control" id="edit_tax">
                                

                </div>
                <!-- <div class="modal-footer">
                    <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="nextEditButton">Next</button>
                </div> -->
                <div class="modal-footer">
                      <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="updateButton">Update</button>
                    </div>
            </div>
        </div>
    </div>
</div>



<script>
    // UPDATE SCRIPT
$(document).ready(function() {
    // Attach click event listener to the Update button
    $('#updateButton').click(function() {
        // Retrieve the employee ID from the hidden input field
        var employeeId = $('#employeeId').val();

        // Check if employee ID is empty or not
        if (employeeId === '') {
            console.error('Employee ID is missing.');
            return; // Stop execution if employee ID is missing
        }

        // Call the updateEmployee function with the employee ID
        updateEmployee(employeeId);
    });

    // Define the updateEmployee function here
    function updateEmployee(employeeId) {
        // Your existing updateEmployee function code goes here
        // Retrieve the updated data from the form fields
        var employeeId = $('#employeeId').val();
        var firstname = $('#edit_firstname').val();
        var middlename = $('#edit_middlename').val();
        var lastname = $('#edit_lastname').val();
        var address = $('#edit_address').val();
        var birthdate = $('#edit_birthdate').val();
        var contactNum = $('#edit_contactNum').val();
        var civilStatus = $('#edit_civilStatus').val();
        var personalEmail = $('#edit_personalEmail').val();
        var workEmail = $('#edit_workEmail').val();
        var employeeType = $('#edit_employeeType').val();
        var startDate = $('#edit_startDate').val();
        var monthly = $('#edit_monthly').val();
        var accBonus = $('#edit_accBonus').val();
        var client = $('#edit_client').val();
        var position = $('#edit_position').val();
        var employmentStatus = $('#edit_employmentStatus').val();
        var sss = $('#edit_sss').val();
        var pagibig = $('#edit_pagibig').val();
        var philhealth = $('#edit_philhealth').val();
        var tin = $('#edit_tin').val();
        var sssCon = $('#edit_sssCon').val();
        var pagibigCon = $('#edit_pagibigCon').val();
        var philhealthCon = $('#edit_philhealthCon').val();
        var tax = $('#edit_tax').val();
        // Add other fields as needed

        // Create a JSON object with the updated data
        var updatedData = {
            employee_id: employeeId,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            address: address,
            birthdate: birthdate,
            contact_num: contactNum,
            civilstatus: civilStatus,
            personal_email: personalEmail,
            work_email: workEmail,
            employee_type: employeeType,
            start_date: startDate,
            monthly_salary: monthly,
            account_bonus: accBonus,
            client: client,
            position: position,
            employment_status: employmentStatus,
            sss_num: sss,
            pagibig_num: pagibig,
            philhealth_num: philhealth,
            tin_num: tin,
            sss_con: sssCon,
            pagibig_con: pagibigCon,
            philhealth_con: philhealthCon,
            tax_percentage: tax
            // Add other fields as needed
        };

        // Perform AJAX request to update employee data
        $.ajax({
            url: 'functions/update_employee.php',
            type: 'POST',
            data: updatedData,
            dataType: 'json',
            success: function(response) {
    // Handle success response
    if (response.success) {
        $(".status").html(response.message);
        // If update was successful, display success message
        console.log(response.message);
        closeModal();
        
        // Remove the success message after 3 seconds
        setTimeout(function() {
            $(".status").html(""); // Remove the message from the DOM
        }, 2000); // 3000 milliseconds = 3 seconds
    } else {
        // If update failed, display error message
        console.error(response.message);
    }
},
        });
    }
});
</script>


<?php include '../template/footer.php' ?>
