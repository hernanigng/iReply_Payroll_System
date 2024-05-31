<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" href="../assets/css/employee_style.css?<?=time()?>" media="all">

<style> 
.error-tab {
    color: red; /* Red text color */
    border-bottom: 2px solid red; /* Red bottom border */
}

</style>
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
                    <h5 class="mt-4 mb-3 hc fw-bold"><i class="fa-solid fa-users me-2"></i>Employee Masterlist</h5>
  
                        <button type="button" class="btn btn-primary offset-10" data-bs-toggle="modal" data-bs-target="#exampleModal"><span><i class="fa-solid fa-square-plus me-2"></i></span>Add Employee</button>

                                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="exampleModalLabel">Create New Employee</h5>    
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link employee-personal" style="color: gray;
pointer-events: none;" >Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link employment-details"style="color: gray;
pointer-events: none;" >Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link benefit-details" style="color: gray;
pointer-events: none;">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancel"></button>
            </div>

        <div class="modal-body" id="personalInformationContent">
            
            <form id="employmentListForm" method="POST">
                 <span class="notif"></span>
            
                 <div id="insertEmployee" class="container mt-4">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="createFirstName" class="form-control input-error" id="createFirstName_id" placeholder="Enter First Name">
                            <p id="inputErrorFirstName" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="middleName" class="form-label">Middle Name</label>
                            <input type="text" name="createMiddleName" class="form-control" id="createMiddleName_id" placeholder="Enter Middle Name">
                          
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="createLastName" class="form-control" id="createLastName_id" placeholder="Enter Last Name">
                            <p id="inputErrorLastName" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="completeAddress" class="form-label">Complete Address</label>
                            <input type="text" name="createAddress" class="form-control" id="createAddress_id" placeholder="Enter Complete Address">
                            <p id="inputErrorAddress" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="birthDate" class="form-label">Birthdate</label>
                            <input type="date" name="createBirthdate" class="form-control" id="createBirthdate_id">
                             <p id="birthError" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="contactNum" class="form-label">Contact Number</label>
                            <input type="text" name="createContactNum" class="form-control number-error" id="contactNumber_id" maxlength="11" placeholder="Enter Contact Number" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            <i class="fas fa-times input-icon" style="display: none;"></i>
                            <p id="NumError" class="error-message" style="display: none;">Contact number should be 11 digits.</p>
                            <p id="contactError" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="civilStatus" class="form-label">Civil Status</label>
                            <select class="form-select" name="createCivilStatus" aria-label="Civil Status Select">
                            <option selected disabled> Select Civil Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                              <p id="civilError" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="personalEmail" class="form-label">Personal Email</label>
                            <input type="text" name="createPersEmail" class="form-control email-error" id="createPersEmail_id" placeholder="Enter Personal Email">
                            <p id="emailError1" class="error-message" style="display: none;">Input a Valid Email.</p>
                              <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="workEmail" class="form-label">Work Email</label>
                            <input type="text" name="createWorkEmail" class="form-control email-error" id="createWorkEmail_id" placeholder="Enter Work Email">
                            <p id="emailError2" class="error-message" style="display: none;">Input a Valid Email.</p>
                              <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="employeeType" class="form-label">Employee Type</label>
                            <select class="form-select" name="createEmployeeType" aria-label="Employee Type Select">
                            <option selected disabled>Select Employee type</option>
                                <option value="Onsite">Work From Home</option>
                                <option value="Home">Work Onsite</option>
                            </select>
                              <p id="typeError" class="error-message" style="display: none;">Please fill out this required field.</p>
                        </div>
                    </div>

                    <div class="modal-footer mt-3">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button> -->
                        <a href="#employmentDetailsContent.php" class="btn btn-primary" id="showEmploymentForm">Next</a>
                    </div>
                </div>

           
                <div id="employmentDetailsContent" style="display: none;">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="startDate" class="form-label">Start Date</label>
                                <input type="date" name="createStartDate" class="form-control createStartDate" id="createStartDate_id">
                                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="monthSalary" class="form-label">Daily Rate</label>
                                <input type="text" name="createMonthlySalary" class="form-control" id="createMonthlySalary_id" placeholder="PHP 0.00">
                                <div id="error" style="color: red;"></div>
                                   <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="accountBonus" class="form-label">Account Bonus</label>
                                <input type="text" name="createAccountBonus" class="form-control" id="createBonus_id" placeholder="PHP 0.00">
                                <div id="error" style="color: red;"></div>
                                   <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                        </div>



                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="client" class="form-label">Client</label>
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
                                   <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $selectedClientId = $_POST['createClient'];
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label for="position" class="form-label">Position</label>
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
                                   <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                                <?php
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $selectedPositionID = $_POST['createPosition'];
                                    }
                                ?>
                            </div>
                            <div class="col-md-4">
                                <label for="employmentStatus" class="form-label">Employment Status</label>
                                <select class="form-select" name="createEmploymentStatus" aria-label="Employment Status Select">
                                    <option selected>Select Employment Status</option>
                                    <option value="Part Time">Part-Time</option>
                                    <option value="Full Time">Full-Time</option>
                                </select>
                                   <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-danger" id="returnPersonalForm">Back</button>
                            <a href="#" class="btn btn-primary" id="showBenefitsForm">Next</a>
                        </div>
                    </div>
                </div>

        
                <div id="benefitDetailsContent" style="display: none;">
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="sss" class="form-label">SSS Number</label>
                                <input type="text" name="createSSS" class="form-control number-error" id="createSSS_id" maxlength="10" placeholder="Enter SSS Number">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="sssNumberError" class="error-message" style="display: none;">SSS number should be 10 digits.</p>
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="pagibig" class="form-label">Pag-ibig Number</label>
                                <input type="text" name="createPagibig" class="form-control number-error" id="createPagibig_id" maxlength="12" placeholder="Enter Pag-ibig Number">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="pagibigNumberError" class="error-message" style="display: none;">Pagibig number should be 12 digits.</p>
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="philhealth" class="form-label">Philhealth Number</label>
                                <input type="text" name="createPhilhealth" class="form-control number-error" id="createPhilhealth_id" maxlength="12" placeholder="Enter Philhealth Number">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="philhealthNumberError" class="error-message" style="display: none;">Philhealth number should be 12 digits.</p>
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>

                
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="tin" class="form-label">TIN Number</label>
                                <input type="text" name="createTin" class="form-control number-error" id="createTin_id" maxlength="12" placeholder="Enter Tin Number">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                <p id="tinNumberError" class="error-message" style="display: none;">Tin number should be 9-12 digits.</p>
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="sssContrib" class="form-label">SSS Contribution</label>
                                <input type="text" name="createSSSContrib" class="form-control" id="createSSSContrib_id" placeholder="Enter SSS Contribution">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="pagibigContrib" class="form-label">Pagibig Contribution</label>
                                <input type="text" name="createPagibigContrib" class="form-control" id="createPagibigContrib_id" placeholder="Enter Pagibig Contribution">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                        </div>
                        
 
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="philhealthContrib" class="form-label">Philhealth Contribution</label>
                                <input type="text" name="createPhilhealthContrib" class="form-control" id="createPhilhealthContrib_id" placeholder="Enter Philhealth Contribution">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="SSS_ER" class="form-label">SSS Contribution ER </label>
                                <input type="text" name="createSSS_ER" class="form-control" id="createSSS_ER_id" placeholder="Enter SSS Contribution ER" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="PagibigER" class="form-label"> Pagibig Contribution ER </label>
                                <input type="text" name="createPagibigER" class="form-control number-error" id="createPagibigER_id" maxlength="12" placeholder="Enter  Pagibig Contribution ER">
                                <i class="fas fa-times input-icon" style="display: none;"></i>
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-4">
                                <label for="PhilhealthER" class="form-label">Philhealth Contribution ER</label>
                                <input type="text" name="createPhilhealthER" class="form-control" id="createPhilhealthER_id" placeholder="Enter Philhealth Contribution ER">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                            <div class="col-md-4">
                                <label for="taxPercent" class="form-label">Tax Percentage</label>
                                <input type="text" name="createTaxPercent" class="form-control" id="createTaxPercent_id" placeholder="Enter Tax Percentage" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                    <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
                            </div>
                        </div>

                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-danger" id="returnDetailsForm">Back</button>
                            <button type="submit" class="btn btn-success" id="checkBenefits">Save</button>
                        </div>
                    </div>
                </div>


            </form>
        </div>
            
        </div>
        </div>
        </div>
        

          
<script>

    //LIMIT INPUT TO NUMBER

            document.getElementById('createSSS_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
            event.target.value = inputValue;
        });

        document.getElementById('createPagibig_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
            event.target.value = inputValue;
        });

        document.getElementById('createPhilhealth_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
            event.target.value = inputValue;
        });

           document.getElementById('createTin_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
            event.target.value = inputValue;
        });


    //EMAIL VERIFICATION

        var workEmailInput = document.getElementById('createPersEmail_id');
        var emailError1 = document.getElementById('emailError1');

        // Add event listener for the 'input' event
        workEmailInput.addEventListener('input', function() {
            if (workEmailInput.value.trim() === "" || !isValidEmail(workEmailInput.value)) {
                emailError1.style.display = 'block'; 
            } else {
                emailError1.style.display = 'none'; 
            }
        });

        var workEmailInput2 = document.getElementById('createWorkEmail_id');
        var emailError2 = document.getElementById('emailError2');

        workEmailInput2.addEventListener('input', function() {
            if (workEmailInput2.value.trim() === "" || !isValidEmail(workEmailInput2.value)) {
                emailError2.style.display = 'block'; 
            } else {
                emailError2.style.display = 'none'; 
            }
        });

        // Function to validate email format
        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }


    //CURRENCY
       document.getElementById('createMonthlySalary_id').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

    inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    if (inputValue.includes('.')) {
        let decimalPart = inputValue.split('.')[1];
        if (!decimalPart || decimalPart.length < 2) {
            inputValue += '0';
        }
    }

    event.target.value = 'PHP ' + inputValue;
});

document.getElementById('createBonus_id').addEventListener('input', function(event) {
    let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

    inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

    if (inputValue.includes('.')) {
        let decimalPart = inputValue.split('.')[1];
        if (!decimalPart || decimalPart.length < 2) {
            inputValue += '0';
        }
    }

    event.target.value = 'PHP ' + inputValue;
});


         document.getElementById('createSSSContrib_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            if (inputValue.includes('.')) {
                let decimalPart = inputValue.split('.')[1];
                if (!decimalPart || decimalPart.length < 2) {
                    inputValue += '0';
                }
            }

            event.target.value = 'PHP ' + inputValue;
        });

        document.getElementById('createPagibigContrib_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            if (inputValue.includes('.')) {
                let decimalPart = inputValue.split('.')[1];
                if (!decimalPart || decimalPart.length < 2) {
                    inputValue += '0';
                }
            }

            event.target.value = 'PHP ' + inputValue;
        });

         document.getElementById('createPhilhealthContrib_id').addEventListener('input', function(event) {
            let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

            inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            if (inputValue.includes('.')) {
                let decimalPart = inputValue.split('.')[1];
                if (!decimalPart || decimalPart.length < 2) {
                    inputValue += '0';
                }
            }

            event.target.value = 'PHP ' + inputValue;
        });

        //Limit input to number only

        

        document.getElementById('taxPercentage').addEventListener('input', function(event) {
           let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

    // Format the input value as a percentage
    inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add comma for thousands separator

    // Add '%' at the end if not already present
    if (!inputValue.endsWith('%')) {
        inputValue += '%';
    }

    // Update the input value
    event.target.value = inputValue;
        });

</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {

//     // Disable links
// document.querySelectorAll('.nav-link').forEach(function(link) {
//     link.addEventListener('click', function(event) {
//         event.preventDefault(); // Prevent default link behavior
//     });
// });

// Example: To disable a specific link by adding a class
//document.querySelector('.employment-details').classList.add('disabled');

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

         //Employment Details 
         document.getElementById('showEmploymentForm').addEventListener('click', function(event) {
            event.preventDefault();

             document.querySelectorAll('.nav-link').forEach(function(link) {
                link.classList.remove('active');
            });


         //document.querySelector('.employment-details').classList.add('active');

            var inputFields = document.querySelectorAll('#insertEmployee input[type="text"], #insertEmployee input[type="date"], #insertEmployee select');

            var anyBlank = false;

            inputFields.forEach(function(inputField) {
                inputField.classList.remove('highlight');

                // Skip validation for createMiddleName_id
                if (inputField.id === "createMiddleName_id") {
                    return;
                }

                if (inputField.tagName.toLowerCase() === 'select') {
                    // For select elements, check if the selected option is the default one
                    if (inputField.selectedIndex === 0) {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                    }
                } else {
                    if (inputField.value.trim() === "" && inputField.id !== "createMiddleName_id") {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                    } else if (inputField.id === "contactNumber_id" && inputField.value.length !== 11) {
                        inputField.classList.add('highlight');
                        anyBlank = true;
                        document.getElementById('NumError').style.display = 'block'; // Display error message
                    }
                }
            });


        if (anyBlank) {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'block';
            });
            return;
        } else {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'none';
            });
        }


             personalInfoForm.style.display = 'none';
             modalBody2.style.display = 'block';
        });

        //Back to Personal Information Form 
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

            var inputFields = document.querySelectorAll('#employmentDetailsContent input[type="text"], #employmentDetailsContent input[type="date"], #employmentDetailsContent select');

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

                if (anyBlank) {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'block';
            });
            return;
        } else {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'none';
            });
        }


             modalBody2.style.display = 'none';
             modalBody3.style.display = 'block';
        });

        //Back to Employment Details Form 

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

        // Benefits Tab to Personal Information

         employmentPersonal.addEventListener('click', function(event) {
             event.preventDefault();

             modalBody3.style.display = 'none';
             modalBody.style.display = 'block';
         });

        //Email Validation

        var personalEmailInput = document.getElementById('createPersEmail_id');
        var workEmailInput = document.getElementById('createWorkEmail_id');
        var emailError = document.getElementById('emailError');

        function validateEmail(email) {
            // Regular expression for validating email addresses
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        personalEmailInput.addEventListener('input', function() {
            var email = personalEmailInput.value.trim();
            if (email !== "" && !validateEmail(email)) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = '';
            }
        });

        workEmailInput.addEventListener('input', function() {
            var email = workEmailInput.value.trim();
            if (email !== "" && !validateEmail(email)) {
                emailError.textContent = 'Please enter a valid email address.';
            } else {
                emailError.textContent = '';
            }
        });


    //Benefits Form error message 

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

            var inputFields = document.querySelectorAll('#benefitDetailsContent input[type="text"]');

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

             if (anyBlank) {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'block';
            });
            return;
        } else {
            document.querySelectorAll('.error-message').forEach(function(errorMessage) {
                errorMessage.style.display = 'none';
            });
        }
         

           var data = $('#employmentListForm').serialize();
                var url = "functions/createEmployee.php";

              $.post(url, data, function(response) {
                    console.log("Server Response:", response);
                        //alert(response);
                        $('#exampleModal').modal('hide');
                        $('#insertToast').toast('show');  

                        $('#insertToast').on('hidden.bs.toast', function () {
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
                             '<td style="text-align: center;">' + // Centering the buttons
                             '<div style="display: inline-block;">' + 
                           
                                '<button class="btn btn-primary view" onclick="openModal(\'' + response.employee_id + '\')"> <i class="bi bi-eye"></i> </button> ' +
                                '<button class="btn btn-danger del" data-employee_id="' + response.employee_id + '"> <i class="bi bi-trash"></i> </button> ' +
                                 '<button class="btn btn-warning edit" id="' + response.employee_id + '" onclick="openPasswordModal(\'' + response.employee_id + '\')"> <i class="bi bi-pencil"></i> </button>'
                            '</div>' +
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
        <div class="toast position-fixed top-50 start-50 translate-middle" id="insertToast"   role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Employee Successfully Inserted
            </div>
        </div>
       

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
                                List of Employees
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
                                            <center>
                                            <button class="btn btn-primary view" onclick="openModal('<?php echo $data['employee_id'];?>')"> 
                                              <i class="bi bi-eye"></i>
                                            </button>
                                              <button class="btn btn-danger del" data-employee_id="<?php echo $data['employee_id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn btn-warning edit" onclick="openPasswordModal('<?php echo $data['employee_id'];?>')">
                                              <i class="bi bi-pencil"></i>
                                            </button>
                                            </center>    
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
                Are you sure you want to delete this employee? 
                All transactions related to this employee will be deleted.
            </div>
            <div class="modal-footer">   
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>


  <!-- Toast Notification Delete -->
        <div class="toast position-fixed top-50 start-50 translate-middle" id="deleteToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Employee Successfully Deleted
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
            //alert(response);
        },
        error: function(xhr, status, error) {
            console.error('Error inserting data into tbl_archive:', error);
        }
    });

        $.ajax({
            type: 'POST',
            url: 'functions/deleteEmployee.php',
            data: { id: employeeId },
            success: function(response) {
                //alert(response);
                 $('body').append($('#deleteToast'));
        
                $('#deleteToast').toast('show');

                    setTimeout(function() {
                    window.location.reload();
                    }, 3000); // Adjust the delay as needed
                console.log('Employee deleted successfully');
                
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
        console.log();
            
        // Update the modal content with the fetched employee details
        // Assuming the response is an object containing the employee details
        $('#firstname').text(response.firstname);
        $('#middlename').text(response.middlename);
        $('#lastname').text(response.lastname);
        $('#address').text(response.address);
        //$('#birthdate').text(response.birthdate);

// Assuming you have retrieved the birthdate from the database in yyyy-mm-dd format
var birthdateString = response.birthdate; // Example: '2024-04-09'

// Parse the birthdate string to a Date object
var birthdate = new Date(birthdateString);

// Format the birthdate into month, day, and year
var formattedBirthdate = (birthdate.getMonth() + 1) + '/' + birthdate.getDate() + '/' + birthdate.getFullYear();

// Display the formatted birthdate in the modal
$('#birthdate').text(formattedBirthdate);


        $('#contactNum').text(response.contact_num);
        $('#civilStatus').text(response.civilstatus);
        $('#personalEmail').text(response.personal_email);
        $('#workEmail').text(response.work_email);
        $('#employeeType').text(response.employee_type);
        //$('#startDate').text(response.start_date);

// Assuming you have retrieved the birthdate from the database in yyyy-mm-dd format
var startdateString = response.start_date; // Example: '2024-04-09'

// Parse the birthdate string to a Date object
var startDate = new Date(startdateString);

// Format the birthdate into month, day, and year
var formattedStartdate = (startDate.getMonth() + 1) + '/' + startDate.getDate() + '/' + startDate.getFullYear();

// Display the formatted birthdate in the modal
$('#startDate').text(formattedStartdate);

        $('#monthly').text(response.daily_rate);
        $('#accBonus').text(response.account_bonus);

        // Fetch client name using client ID
        $.ajax({
            url: 'functions/get_client.php',
            type: 'POST',
            data: { client_id: response.client },
            dataType: 'json',
            success: function(clientResponse) {
                $('#client').text(clientResponse.client_name);
            }
        });

        // Fetch position name using position ID
        $.ajax({
            url: 'functions/get_position.php',
            type: 'POST',
            data: { position_id: response.position },
            dataType: 'json',
            success: function(positionResponse) {
                $('#position').text(positionResponse.position_name);
            }
        });

        $('#employmentStatus').text(response.employment_status);
        $('#sss').text(response.sss_num);
        $('#pagibig').text(response.pagibig_num);
        $('#philhealth').text(response.philhealth_num);
        $('#tin').text(response.tin_num);
        $('#sssCon').text(response.sss_con);
        $('#pagibigCon').text(response.pagibig_con);
        $('#philhealthCon').text(response.philhealth_con);
        $('#sssER').text(response.sss_con_er);
        $('#pagibigER').text(response.pagibig_con_er);
        $('#philhealthER').text(response.philhealth_con_er);
        $('#tax').text(response.tax_percentage);

        var employeeId = response.employee_id;
                calculateTotalER(response.sss_con_er, response.pagibig_con_er, response.philhealth_con_er, employeeId);
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
        $('.nav-tabs .nav-link0-edit').removeClass('active');

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

    document.getElementById('monthly').addEventListener('input', function(event) {
        let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

        inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        if (inputValue.includes('.')) {
            let decimalPart = inputValue.split('.')[1];
            if (!decimalPart || decimalPart.length < 2) {
                inputValue += '0';
            }
        }

        event.target.nextElementSibling.textContent = 'PHP ' + inputValue;
    });

    document.getElementById('accBonus').addEventListener('input', function(event) {
        let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'

        inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ',');

        if (inputValue.includes('.')) {
            let decimalPart = inputValue.split('.')[1];
            if (!decimalPart || decimalPart.length < 2) {
                inputValue += '0';
            }
        }

        event.target.nextElementSibling.textContent = 'PHP ' + inputValue;
    });

    function calculateTotalER(sssER, pagibigER, philhealthER, employeeId) {
    // Function to extract numeric value from a string with a prefix
    function extractNumericValue(value) {
        // Remove non-numeric characters (keeping '.' for decimals)
        value = value.replace(/[^\d.]/g, '');
        return parseFloat(value);
    }

    // Ensure that the contribution values are parsed as numbers
    sssER = extractNumericValue(sssER);
    pagibigER = extractNumericValue(pagibigER);
    philhealthER = extractNumericValue(philhealthER);

    // Check if any of the parsed values are NaN (Not a Number)
    if (isNaN(sssER) || isNaN(pagibigER) || isNaN(philhealthER)) {
        console.error("One or more contribution values are not valid numbers.");
        return;
    }

    // Calculate the total employer contributions
    var totalER = sssER + pagibigER + philhealthER;

    // Display the total in the totalER span
    document.getElementById('totalER').innerText = totalER.toFixed(2);

    // Now you can use the employeeId variable as needed
    console.log("Employee ID:", employeeId);
}


</script>

<!-- VIEW EMPLOYEE MODAL -->
<div class="modal fade" id="viewEmployee" tabindex="-1" aria-labelledby="viewEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="viewEmployeeLabel">Employee Information</h5>

                <!-- Tab links -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link-edit active" aria-current="page" href="#personal">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-edit" href="#employment">Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-edit" href="#benefit">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>

            <!-- Tab content -->
            <div class="modal-body">
                <!-- Personal Information tab -->
                <div id="personal" class="tab">
                <div class="container">
                    <!-- Your personal information fields here -->
                    <!-- Placeholder for data -->

                    <div class="row">
    <div class="col">
        <label for="firstName" class="col-form-label"> First Name: </label>
        <span class="form-control" id="firstname"> </span>
    </div>
    <div class="col">
        <label for="middleName" class="col-form-label">Middle Name:</label>
        <span class="form-control" id="middlename"> </span>
    </div>
    <div class="col">
        <label for="lastName" class="col-form-label">Last Name:</label>
        <span class="form-control" id="lastname"> </span>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="completeAddress" class="col-form-label">Complete Address:</label>
        <span class="form-control" id="address"> </span>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="birthdate" class="col-form-label">Birthdate:</label>
        <span class="form-control" id="birthdate"> </span>
    </div>
    <div class="col">
        <label for="contactNum" class="col-form-label">Contact Number:</label>
        <span class="form-control" id="contactNum"> </span>
    </div>
    <div>
        <label for="civilStatus" class="col-form-label">Civil Status:</label>
        <span class="form-control" id="civilStatus">  </span>
    </div>
</div>

<div class="row mb-5">
    <div class="col">
        <label for="personalEmail" class="col-form-label">Personal Email:</label>
        <span class="form-control" id="personalEmail">  </span>
    </div>
    <div class="col">
        <label for="workEmail" class="col-form-label">Work Email:</label>
        <span class="form-control" id="workEmail"> </span>
    </div>
    <div class="col">
        <label for="employeeType" class="col-form-label"> Employee Type: </label>
        <span class="form-control" id="employeeType"> </span>
    </div>
</div>
</div>
     </div>


                <!-- Employment Details tab -->
                <div id="employment" class="tab">
                <div class="container">
                    <!-- Your employment details fields here -->
                    <!-- Placeholder for data -->

<div class="row">
    <div class="col">
        <label for="startDate" class="col-form-label">Start Date:</label>
        <span class="form-control" id="startDate"> </span>
    </div>
    <div class="col">
        <label for="monthly" class="col-form-label">Daily Rate:</label>
        <span class="form-control" id="monthly"> </span>
    </div>
    <div class="col">
        <label for="accBonus" class="col-form-label">Account Bonus:</label>
        <span class="form-control" id="accBonus">  </span>
    </div>
</div>

<div class="row mb-5">
    <div class="col">
        <label for="client" class="col-form-label">Client:</label>
        <span class="form-control" id="client"> </span>
    </div>
    <div class="col">
        <label for="position" class="col-form-label">Position:</label>
        <span class="form-control" id="position"> </span>
    </div>
    <div class="col">
        <label for="employmentStatus" class="col-form-label">Employment Status:</label>
        <span class="form-control" id="employmentStatus"> </span>
    </div>
</div>
</div>
     </div>

                <!-- Benefit Details tab -->
                <div id="benefit" class="tab">
                <div class="container">
                    <!-- Your benefit details fields here -->
                    <!-- Placeholder for data -->

<div class="row">
    <div class="col">
        <label for="sss" class="col-form-label">SSS Number:</label>
        <span class="form-control" id="sss"> </span>
    </div>
    <div class="col">
        <label for="pagibig" class="col-form-label">Pag-ibig Number:</label>
        <span class="form-control" id="pagibig"> </span>
    </div>
    <div class="col">
        <label for="philhealth" class="col-form-label">Philhealth Number:</label>
        <span class="form-control" id="philhealth">  </span>
    </div>
    <div class="col">
        <label for="tin" class="col-form-label">Tin Number:</label>
        <span class="form-control" id="tin"> </span>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="sssCon" class="col-form-label">SSS Contribution EE:</label>
        <span class="form-control" id="sssCon">  </span>
    </div>
    <div class="col">
        <label for="pagibigCon" class="col-form-label">Pag-ibig Contribution EE:</label>
        <span class="form-control" id="pagibigCon">  </span>
    </div>
    <div class="col">
        <label for="philhealthCon" class="col-form-label">Philhealth Contribution EE:</label>
        <span class="form-control" id="philhealthCon"> </span>
    </div>
    <div class="col">
        <label for="tax" class="col-form-label">Tax Percentage:</label>
        <span class="form-control" id="tax"> </span>
    </div>
</div>

<div class="row mb-5">
    <div class="col">
        <label for="sssER" class="col-form-label">SSS Contribution ER:</label>
        <span class="form-control" id="sssER">  </span>
    </div>
    <div class="col">
        <label for="pagibigER" class="col-form-label">Pag-ibig Contribution ER:</label>
        <span class="form-control" id="pagibigER"> </span>
    </div>
    <div class="col">
        <label for="philhealthER" class="col-form-label">Philhealth Contribution ER:</label>
        <span class="form-control" id="philhealthER">  </span>
    </div>
    <div class="col">
        <label for="totalER" class="col-form-label">Total Contributions ER:</label>
        <span class="form-control" id="totalER">
             </span>
    </div>    
</div>
</div>
</div>
</div>
     </div>

                 <div class="modal-footer">
                 </div>
            </div>
        </div>
    </div>
</div>



<script>
    // EDIT EMPLOYEE SCRIPT

    function openPasswordModal(employeeId) {
    $('#passwordModal').modal('show');

    $(document).ready(function() {
    // Function to handle form submission
    function submitPassword() {
        var enteredPassword = $('#password').val(); // Get the password entered by the user
        var username = "<?php echo $_SESSION['username']; ?>"; // Get the username stored in the session
        
        // Send an AJAX request to verify the password
        $.ajax({
            url: 'functions/verify_password.php',
            type: 'POST',
            data: {
                username: username,
                password: enteredPassword
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Password is correct, proceed with opening the edit modal
                    $('#passwordModal').modal('hide');
                    openEditModal(employeeId);
                } else {
                    // Incorrect password, display error message
                    $('#passwordError').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors here
                console.error(xhr.responseText);
            }
        });
    }
    
    // Function to handle keypress event
    function handleKeyPress(event) {
        if (event.which === 13 || event.keyCode === 13) {
            // If Enter key is pressed, submit the form
            submitPassword();
        }
    }

    // Attach event listener for keypress event on the password input field
    $('#password').keypress(handleKeyPress);

    // Attach click event listener to the submit button
    $('#submitPassword').click(submitPassword);
});

}

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
        dataType: 'json',
        success: function(response) {
            console.log(response);
            // Update the modal content with the fetched employee details
            $('#employeeId').val(response.employee_id);
            $('#edit_firstname').val(response.firstname);
            $('#edit_middlename').val(response.middlename);
            $('#edit_lastname').val(response.lastname);
            $('#edit_address').val(response.address);
           
// var edit_birthdateString = response.birthdate;
// var edit_birthdate = new Date(edit_birthdateString);
// var formatted_editBirthdate = (birthdate.getMonth() + 1) + '/' + birthdate.getDate() + '/' + birthdate.getFullYear();

            $('#edit_birthdate').val(response.birthdate);
            $('#edit_contactNum').val(response.contact_num);
            $('#edit_personalEmail').val(response.personal_email);
            $('#edit_workEmail').val(response.work_email);

// var startdateString = response.start_date;
// var startDate = new Date(startdateString);
// var formattedStartdate = (startDate.getMonth() + 1) + '/' + startDate.getDate() + '/' + startDate.getFullYear();

            $('#edit_startDate').val(response.start_date);

            $('#edit_monthly').val(response.daily_rate);
            $('#edit_accBonus').val(response.account_bonus);
            $('#edit_sss').val(response.sss_num);
            $('#edit_pagibig').val(response.pagibig_num);
            $('#edit_philhealth').val(response.philhealth_num);
            $('#edit_tin').val(response.tin_num);
            $('#edit_sssCon').val(response.sss_con);
            $('#edit_pagibigCon').val(response.pagibig_con);
            $('#edit_philhealthCon').val(response.philhealth_con);
            $('#edit_sss_con_er').val(response.sss_con_er);
            $('#edit_pagibig_con_er').val(response.pagibig_con_er);
            $('#edit_philhealth_con_er').val(response.philhealth_con_er);
            $('#edit_total_con_er').val(response.philhealth_con_er);
            $('#edit_tax').val(response.tax_percentage);

            // Set the selected option in the select elements
            $('#edit_civilStatus').val(response.civilstatus);
            $('#edit_employeeType').val(response.employee_type);
            $('#edit_employmentStatus').val(response.employment_status);
            
            // Fetch client name using client ID
            $.ajax({
                url: 'functions/get_client.php',
                type: 'POST',
                data: { client_id: response.client },
                dataType: 'json',
                success: function(clientResponse) {
                    console.log(clientResponse);
                    $('#edit_client').val(response.client);
                }
                
            });

            // Fetch position name using position ID
            $.ajax({
                url: 'functions/get_position.php',
                type: 'POST',
                data: { position_id: response.position },
                dataType: 'json',
                success: function(positionResponse) {
                    console.log(positionResponse);
                    $('#edit_position').val(response.position);
                }
            });
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
        $('.nav-tabs .nav-link-edit').removeClass('active');

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

    $(document).ready(function() {
    // Event listener for edit_monthly
    $('#edit_monthly').on('input', function(event) {
        let inputValue = event.target.value.trim(); // Remove leading/trailing spaces
        // Check if the value starts with "PHP" followed by a space and a number
        if (/^PHP\s\d+(\.\d{0,2})?$/.test(inputValue)) {
            // If valid, keep the input as it is
        } else {
            // If not valid, remove non-numeric characters and prepend "PHP" to the value
            inputValue = 'PHP ' + inputValue.replace(/[^0-9,.]/g, '');
            $(this).val(inputValue);
        }
    });

    // Event listener for edit_accBonus
    $('#edit_accBonus').on('input', function(event) {
        let inputValue = event.target.value.trim(); // Remove leading/trailing spaces
        // Check if the value starts with "PHP" followed by a space and a number
        if (/^PHP\s\d+(\.\d{0,2})?$/.test(inputValue)) {
            // If valid, keep the input as it is
        } else {
            // If not valid, remove non-numeric characters and prepend "PHP" to the value
            inputValue = 'PHP ' + inputValue.replace(/[^0-9,.]/g, '');
            $(this).val(inputValue);
        }
    });

    // Event listener for edit_sssCon
    $('#edit_sssCon').on('input', function(event) {
        let inputValue = event.target.value.trim(); // Remove leading/trailing spaces
        // Check if the value starts with "PHP" followed by a space and a number
        if (/^PHP\s\d+(\.\d{0,2})?$/.test(inputValue)) {
            // If valid, keep the input as it is
        } else {
            // If not valid, remove non-numeric characters and prepend "PHP" to the value
            inputValue = 'PHP ' + inputValue.replace(/[^0-9,.]/g, '');
            $(this).val(inputValue);
        }
    });
    // Event listener for edit_pagibigCon
    $('#edit_pagibigCon').on('input', function(event) {
        let inputValue = event.target.value.trim(); // Remove leading/trailing spaces
        // Check if the value starts with "PHP" followed by a space and a number
        if (/^PHP\s\d+(\.\d{0,2})?$/.test(inputValue)) {
            // If valid, keep the input as it is
        } else {
            // If not valid, remove non-numeric characters and prepend "PHP" to the value
            inputValue = 'PHP ' + inputValue.replace(/[^0-9,.]/g, '');
            $(this).val(inputValue);
        }
    });
    // Event listener for edit_philhealthCon
    $('#edit_philhealthCon').on('input', function(event) {
        let inputValue = event.target.value.trim(); // Remove leading/trailing spaces
        // Check if the value starts with "PHP" followed by a space and a number
        if (/^PHP\s\d+(\.\d{0,2})?$/.test(inputValue)) {
            // If valid, keep the input as it is
        } else {
            // If not valid, remove non-numeric characters and prepend "PHP" to the value
            inputValue = 'PHP ' + inputValue.replace(/[^0-9,.]/g, '');
            $(this).val(inputValue);
        }
    });
});



</script>




<!-- EDIT EMPLOYEE MODAL -->
<div class="modal fade" id="editEmployee" tabindex="-1" aria-labelledby="editEmployeeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="editEmployeeLabel">Employee Information</h5>

                <!-- Tab links -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link-edit active" aria-current="page" href="#personalEdit">Personal Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-edit" href="#employmentEdit">Employment Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link-edit" href="#benefitEdit">Benefit Details</a>
                    </li>
                </ul>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>

            <!-- Tab content -->
            <div class="modal-body">
                <!-- Personal Information tab -->
                <div id="personalEdit" class="tab">
                <div class="container">
                    <!-- Your personal information fields here -->
                    <!-- Placeholder for data -->


    <form id="editFrm" method="post">
<input type="hidden" name="employeeId" class="form-control" id="employeeId">

<div class="row">
    <div class="col">
        <label for="firstName" class="col-form-label">First Name</label>
        <input type="text" name="edit_firstname" class="form-control" id="edit_firstname">
        <div id="firstNameError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="middleName" class="col-form-label">Middle Name</label>
        <input type="text" name="edit_middlename" class="form-control" id="edit_middlename">
        <div id="middleNameError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="lastName" class="col-form-label">Last Name</label>
        <input type="text" name="edit_lastname" class="form-control" id="edit_lastname">
        <div id="lastNameError" class="text-danger"></div> <!-- Error message container -->
    </div>
</div>

     
<div class="row">
    <div class="col">                    
         <label for="completeAddress" class="col-form-label">Complete Address</label>
         <input type="text" name="edit_address" class="form-control" id="edit_address">
         <div id="completeAddressError" class="text-danger"></div> <!-- Error message container -->
    </div>
</div>

<div class="row">
    <div class="col">
         <label for="birthDate" class="col-form-label">Birthdate</label>
         <input type="date" name="edit_birthdate" class="form-control" id="edit_birthdate">
    </div>
    <div class="col">
        <label for="contactNum" class="col-form-label">Contact Number </label>
        <input type="number" name="edit_contactNum" class="form-control" id="edit_contactNum">
        <div id="contactNumError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
         <label for="civilStatus" class="col-form-label">Civil Status</label>
            <select class="form-select" name="edit_civilStatus" aria-label="Civil Status Select" id="edit_civilStatus">
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Widowed">Widowed</option>
            </select>
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="personalEmail" class="col-form-label">Personal Email</label>
        <input type="email" name="edit_personalEmail" class="form-control" id="edit_personalEmail">
        <div id="personalEmailError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="workEmail" class="col-form-label">Work Email</label>
        <input type="email" name="edit_workEmail" class="form-control" id="edit_workEmail">
         <div id="workEmailError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="employeeType" class="col-form-label"> Employee Type </label>
            <select class="form-select" name="edit_employeeType" aria-label="Employee Type Select" id="edit_employeeType">
                <option value="Home">Work From Home</option>
                <option value="Onsite">Work Onsite</option>
            </select>        
    </div>
</div>
</div>
    </div>

                <!-- Employment Details tab -->
                <div id="employmentEdit" class="tab">
                <div class="container">
                    <!-- Your employment details fields here -->
                    <!-- Placeholder for data -->

<div class="row">
    <div class="col">
        <label for="startDate" class="col-form-label">Start Date</label>
        <input type="date" name="edit_startDate" class="form-control createStartDate" id="edit_startDate">
    </div>
    <div class="col">
        <label for="monthSalary" class="col-form-label">Daily Rate</label>
        <div class="input-group">
            <input type="text" name="edit_monthly" class="form-control" id="edit_monthly" placeholder="0.00" >
        </div>
    </div>
    <div class="col">
        <label for="accountBonus" class="col-form-label">Account Bonus</label>
        <div class="input-group">
            <input type="text" name="edit_accBonus" class="form-control" id="edit_accBonus" placeholder="0.00" >
        </div>
    </div>
</div>



<div class="row">
    <div class="col">
        <label for="client" class="col-form-label">Client</label>
        <select class="form-select" name="edit_client" aria-label="Client Select" id="edit_client">
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
    </div>
<div class="col">
        <label for="position" class="col-form-label">Position</label>
        <select class="form-select" name="edit_position" aria-label="Position Select" id="edit_position">
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
    </div>
<div class="col">
    <label for="employmentStatus" class="col-form-label">Employment Status</label>
        <select class="form-select" name="edit_employmentStatus" aria-label="Employment Status Select" id="edit_employmentStatus">
            <option value="Part Time">Part-Time</option>
            <option value="Full Time">Full-Time</option>
        </select>    
    </div>
</div>
</div>
     </div>

                <!-- Benefit Details tab -->
                <div id="benefitEdit" class="tab">
                <div class="container">
                    <!-- Your benefit details fields here -->
                    <!-- Placeholder for data -->

<div class="row">
    <div class="col">
        <label for="sss" class="col-form-label">SSS Number</label>
        <input type="number" name="edit_sss" class="form-control" id="edit_sss">
        <div id="sssError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="pagibig" class="col-form-label">Pag-ibig Number</label>
        <input type="number" name="edit_pagibig" class="form-control" id="edit_pagibig">
        <div id="pagibigError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="philhealth" class="col-form-label">Philhealth Number</label>
        <input type="number" name="edit_philhealth" class="form-control" id="edit_philhealth">
        <div id="philhealthError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="tin" class="col-form-label">TIN Number</label>
        <input type="number" name="edit_tin" class="form-control" id="edit_tin">
        <div id="tinError" class="text-danger"></div> <!-- Error message container -->
    </div>
</div>

<div class="row">
    <div class="col">
        <label for="sssContrib" class=" col-form-label">SSS Contribution EE</label>
        <input type="text" name="edit_sssCon" class="form-control" id="edit_sssCon" placeholder="0.00">
        <div id="sssConError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="pagibigContrib" class="col-form-label">Pagibig Contribution EE</label>
        <input type="text" name="edit_pagibigCon" class="form-control" id="edit_pagibigCon" placeholder="0.00">
        <div id="pagibigConError" class="text-danger"></div> <!-- Error message container -->
    </div>
    <div class="col">
        <label for="philhealthContrib" class="col-form-label">Philhealth Contribution EE</label>
        <input type="text" name="edit_philhealthCon" class="form-control" id="edit_philhealthCon" placeholder="0.00">
        <div id="philhealthConError" class="text-danger"></div> <!-- Error message container -->

    </div>
    <div class="col">
        <label for="taxPercent" class="col-form-label">Tax Percentage </label>
        <input type="number" name="edit_tax" class="form-control" id="edit_tax">
    </div>
</div>
<div class="row">
    <div class="col">
        <label for="sssER" class="col-form-label">SSS Contribution ER:</label>
        <input type="number" name="edit_sss_con_er" class="form-control" id="edit_sss_con_er">
    </div>
    <div class="col">
        <label for="pagibigER" class="col-form-label">Pag-ibig Contribution ER:</label>
        <input type="number" name="edit_pagibig_con_er" class="form-control" id="edit_pagibig_con_er">
    </div>
    <div class="col">
        <label for="philhealthER" class="col-form-label">Philhealth Contribution ER:</label>
        <input type="number" name="edit_philhealth_con_er" class="form-control" id="edit_philhealth_con_er">
    </div>
    <div class="col">
        <label for="totalER" class="col-form-label">Total Contributions ER:</label>
        <input type="number" name="edit_total_con_er" class="form-control" id="edit_total_con_er">
    </div>    
</div>
</div>
    </div>
    </form>
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


 <!-- PASSWORD MODAL -->
 <div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <div id="passwordError" class="text-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="submitPassword">Submit</button>
            </div>
        </div>
    </div>
</div>


<script>
// UPDATE SCRIPT
$(document).ready(function() {
    // Attach click event listener to the Update button
    $('#updateButton').click(function() {
        // Reset error messages and styles
        $('.form-control').removeClass('border border-danger');
        $('.error-message').text('');

        // Check if all required fields are filled out and pass validation
        if (validatePersonalInfo() && validateContactNumber() && validateEmail() && validateNumbers() && validateBenefits()) {
            // Retrieve the employee ID from the hidden input field
            var employeeId = $('#employeeId').val();

            // Call the updateEmployee function with the employee ID
            updateEmployee(employeeId);
        }
    });

    function validatePersonalInfo() {
        var lettersOnly = /^[A-Za-z\s]+$/;
        var isValid = true;

        // Get form inputs
        var firstName = $('#edit_firstname').val();
        var middleName = $('#edit_middlename').val();
        var lastName = $('#edit_lastname').val();

        // Perform validation
        if (!lettersOnly.test(firstName)) {
            $('#edit_firstname').addClass('border border-danger');
            $('#firstNameError').text('Please enter only letters for First Name.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }
        if (!lettersOnly.test(middleName)) {
            $('#edit_middlename').addClass('border border-danger');
            $('#middleNameError').text('Please enter only letters for Middle Name.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }
        if (!lettersOnly.test(lastName)) {
            $('#edit_lastname').addClass('border border-danger');
            $('#lastNameError').text('Please enter only letters for Last Name.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }

        return isValid;
    }

    // Define the validateContactNumber function to check if the contact number is valid
    function validateContactNumber() {
        var contactNumber = $('#edit_contactNum').val();
        // Check if the contact number is exactly 11 digits
        var contactNumberPattern = /^\d{11}$/;
        var contactNumberValid = contactNumberPattern.test(contactNumber);

        if (!contactNumberValid) {
            $('#edit_contactNum').addClass('border border-danger');
            $('#contactNumError').text('Enter 11 numbers only.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        return contactNumberValid;
    }

    // Define the validateEmail function to check if the email address is valid
    function validateEmail() {
        var personalEmail = $('#edit_personalEmail').val();
        var workEmail = $('#edit_workEmail').val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        var personalEmailValid = emailPattern.test(personalEmail);
        var workEmailValid = emailPattern.test(workEmail);

        if (!personalEmailValid) {
            $('#edit_personalEmail').addClass('border border-danger');
            $('#emailError').text('Invalid personal email format.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        if (!workEmailValid) {
            $('#edit_workEmail').addClass('border border-danger');
            $('#workEmailError').text('Invalid work email format.');
            $('.nav-link-edit[href="#personalEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        return personalEmailValid && workEmailValid;
    }

    // Define the validateForm function to check if all required fields are filled out
    function validateNumbers() {
        var numbersOnly = /^[0-9]+$/;
        var isValid = true;

        // Reset error messages and styles
        $('.form-control').removeClass('border border-danger');
        $('.error-message').text('');

        var sssNum = $('#edit_sss').val();
        var pagibigNum = $('#edit_pagibig').val();
        var philhealthNum = $('#edit_philhealth').val();
        var tinNum = $('#edit_tin').val();

        if (!numbersOnly.test(sssNum)) {
            $('#edit_sss').addClass('border border-danger');
            $('#sssError').text('Please enter only 10 numbers for SSS Number.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }

        if (!numbersOnly.test(pagibigNum)) {
            $('#edit_pagibig').addClass('border border-danger');
            $('#pagibigError').text('Please enter only 12 numbers for Pag-IBIG Number.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }

        if (!numbersOnly.test(philhealthNum)) {
            $('#edit_philhealth').addClass('border border-danger');
            $('#philhealthError').text('Please enter only 12 numbers for PhilHealth Number.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }

        if (!numbersOnly.test(tinNum) || tinNum.length < 9 || tinNum.length > 12) {
            $('#edit_tin').addClass('border border-danger');
            $('#tinError').text('Please enter 9 to 12 numbers for TIN Number.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
            isValid = false;
        }

        return isValid;
    }

    function validateBenefits() {
        var sssNum = $('#edit_sss').val();
        var sssNumPattern = /^\d{10}$/;
        var pagibigNum = $('#edit_pagibig').val();
        var philhealthNum = $('#edit_philhealth').val();
        var tinNum = $('#edit_tin').val();
        var pagibigAndPhilhealthPattern = /^\d{12}$/;
        var tinPattern = /^\d{9,12}$/;

        var sssNumValid = sssNumPattern.test(sssNum);
        var pagibigNumValid = pagibigAndPhilhealthPattern.test(pagibigNum);
        var philhealthNumValid = pagibigAndPhilhealthPattern.test(philhealthNum);
        var tinNumValid = tinPattern.test(tinNum);

        if (!sssNumValid) {
            $('#edit_sss').addClass('border border-danger');
            $('#sssError').text('Enter 10 numbers only.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        if (!pagibigNumValid) {
            $('#edit_pagibig').addClass('border border-danger');
            $('#pagibigError').text('Enter 12 numbers only.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        if (!philhealthNumValid) {
            $('#edit_philhealth').addClass('border border-danger');
            $('#philhealthError').text('Enter 12 numbers only.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        if (!tinNumValid) {
            $('#edit_tin').addClass('border border-danger');
            $('#tinError').text('Enter 9 to 12 numbers only.');
            $('.nav-link-edit[href="#benefitEdit"]').addClass('error-tab'); // Add class to highlight tab link
        }

        return sssNumValid && pagibigNumValid && philhealthNumValid && tinNumValid;
    }

    // Remove error class from tab links when a tab is clicked
    $('.nav-link-edit').click(function() {
        $('.nav-link-edit').removeClass('error-tab');
    });

    // Define the updateEmployee function here
    function updateEmployee(employeeId) {
        // Retrieve the updated data from the form fields
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
        var sssER = $('#edit_sss_con_er').val();
        var pagibigER = $('#edit_pagibig_con_er').val();
        var philhealthER = $('#edit_philhealth_con_er').val();
        var tax = $('#edit_tax').val();

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
            daily_rate: monthly,
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
            sss_con_er: sssER,
            pagibig_con_er: pagibigER,
            philhealth_con_er: philhealthER,
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
                    // Display toast notification
                    var updateToast = new bootstrap.Toast($('#updateToast'));
                    updateToast.show();

                    // Optionally hide the modal
                    closeModal();

                    // Reload the page after a short delay (e.g., 2 seconds)
                    setTimeout(function() {
                        location.reload(true); // Reload the page with clearing cache
                    }, 2000); // Adjust the delay time as needed
                } else {
                    // If update failed, display error message
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error(xhr.responseText);
            }
        });
    }
});
</script>

<!-- User Update Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle" id="updateToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               Employee Successfully Updated
            </div>
        </div>
        <div class="modal-footer"> </div>
    
    

<?php include '../template/footer.php' ?>
