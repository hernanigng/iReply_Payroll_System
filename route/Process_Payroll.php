<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>



<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<div id="layoutSidenav_content">
<link rel="stylesheet" href="../assets/css/payroll_style.css?<?=time()?>" media="all">

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Payroll Page</h3>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-10">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="earnings-tab" data-bs-toggle="tab" href="#earnings" role="tab" aria-controls="earnings" aria-selected="true">Earnings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="deductions-tab" data-bs-toggle="tab" href="#deductions" role="tab" aria-controls="deductions" aria-selected="false">Deductions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="incentives-tab" data-bs-toggle="tab" href="#incentives" role="tab" aria-controls="incentives" aria-selected="false">Incentives</a>
                    </li>
                </ul>


        
                <div class="tab-content" id="myTabContent">
           

                    <div class="tab-pane fade show active" id="earnings" role="tabpanel" aria-labelledby="earnings-tab">
                        <!-- Content for Earnings tab -->
                        <div class="container mt-4 col-10"> <!-- Container for the form -->
                        <form id="earningsTab" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="employeeSelect" class="form-label">Employee Name</label>
                        <select class="form-select" id="employeeSelect" name="selectEmployee" aria-label="Employee Select">
                            <option selected disabled>Select an Employee</option>
                            <?php
                            include "../connection/database.php";
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT employee_id, firstname, lastname FROM tbl_employee";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $selected = ($row["employee_id"] == $employeeId) ? "selected" : "";
                                    echo '<option value="' . $row["employee_id"] . '" ' . $selected . '>' . $row["firstname"] . ' ' . $row["lastname"] . '</option>';
                                }
                            }

                            $conn->close();
                            ?>
                        </select>
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>
                    <div class="col-md-6">
                        <label for="periodCovered" class="form-label">Period Covered</label>
                        <div class="input-group">
                            <span class="input-group-text">Start Date</span>
                    <input type="text" id="startDate" name="startDate" class="form-control" style="width: 200px;" value="<?php echo isset($dateFrom) ? $dateFrom : ''; ?>">
                  </div>
                    <div class="input-group">
                    <span class="input-group-text">End Date</span>
                    <input type="text" id="endDate" name="endDate" class="form-control" style="width: 200px;" value="<?php echo isset($dateTo) ? $dateTo : ''; ?>" >
                        </div>
                    </div>
                </div>


                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="daysWorked" class="form-label">No. of Days Worked</label>
                            <input type="text" name="daysWorked" class="form-control" id="daysWorked" value="<?php echo isset($totalDaysWork) ? $totalDaysWork : ''; ?>" disabled>
                        </div>
 
                 

                        <div class="col-md-4">
                            <label for="basicPay" class="form-label">Basic Pay</label>
                            <input type="text" name="basicPay" class="form-control" id="basicPay"  style="width: 150px;" placeholder="PHP 0.00"  value="<?php echo isset($dailyRate) ? $dailyRate : ''; ?>" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="regularHoliday" class="form-label">Regular Holiday</label>
                            <input type="text" name="regularHoliday" class="form-control" id="regularHoliday_id" placeholder="PHP 0.00">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="specialHoliday" class="form-label">Special Holiday</label>
                            <input type="text" name="specialHoliday" class="form-control" id="specialHoliday_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="overtime" class="form-label">Overtime</label>
                            <input type="text" name="overtime" class="form-control" id="overtime_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="nightDifferential" class="form-label">Night Differential</label>
                            <input type="text" name="nightDifferential" class="form-control" id="nightDifferential_id" placeholder="PHP 0.00">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="regularHolidayNightDiff" class="form-label">Regular Holiday Night Diff</label>
                            <input type="text" name="regularHolidayNightDiff" class="form-control" id="regularHolidayNightDiff_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="specialHolidayNightDiff" class="form-label">Special Holiday Night Diff</label>
                            <input type="text" name="specialHolidayNightDiff" class="form-control" id="specialHolidayNightDiff_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="regHolidayOvertime" class="form-label">Reg. Holiday Overtime</label>
                            <input type="text" name="regHolidayOvertime" class="form-control" id="regHolidayOvertime_id" placeholder="PHP 0.00">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="splHolidayOvertime" class="form-label">Spl. Holiday Overtime</label>
                            <input type="text" name="splHolidayOvertime" class="form-control" id="splHolidayOvertime_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="monthlyBonus" class="form-label">Monthly Bonus</label>
                            <input type="text" name="monthlyBonus" class="form-control" id="monthlyBonus_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="drd" class="form-label">DRD</label>
                            <input type="text" name="drd" class="form-control" id="drd_id" placeholder="PHP 0.00">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="payAdjustments" class="form-label">Pay Adjustments</label>
                            <input type="text" name="payAdjustments" class="form-control" id="payAdjustments_id" placeholder="PHP 0.00">
                        </div>
                        <div class="col-md-4">
                            <label for="totalEarnings" class="form-label">Total Earnings</label>
                            <input type="text" name="totalEarnings" class="form-control" id="totalEarnings" placeholder="PHP 0.00" readonly>
                        </div>
                    </div>

                   

            

       <script>
                    
                    $(document).ready(function() {
                        // Function to parse date in YYYY-MM-DD format
                        function parseDate(dateString) {
                            var parts = dateString.split("-");
                            return new Date(parts[0], parts[1] - 1, parts[2]);
                        }

                        // Function to calculate weekdays between two dates
                        function countWeekdays(startDate, endDate) {
                            var count = 0;
                            var currentDate = new Date(startDate);

                            while (currentDate <= endDate) {
                                var dayOfWeek = currentDate.getDay();
                                if (dayOfWeek !== 0 && dayOfWeek !== 6) { // Exclude weekends (Sunday and Saturday)
                                    count++;
                                }
                                currentDate.setDate(currentDate.getDate() + 1);
                            }

                            return count;
                        }

                        // Function to handle date change event
                        function handleDateChange() {
                            var startDateStr = $("#startDate").val();
                            var endDateStr = $("#endDate").val();

                            //console.log("Start Date:", startDateStr);
                            //console.log("End Date:", endDateStr);

                            if (startDateStr && endDateStr) {
                                var startDate = parseDate(startDateStr);
                                var endDate = parseDate(endDateStr);

                                //console.log("Parsed Start Date:", startDate);
                                //console.log("Parsed End Date:", endDate);

                                if (endDate >= startDate) {
                                    var weekdaysCount = countWeekdays(startDate, endDate);
                                    //console.log("Weekdays count:", weekdaysCount);
                                    $("#daysWorked").val(weekdaysCount);

                                      calculateTotalEarnings();
                                } else {
                                    $("#daysWorked").val("");
                                }
                            } else {
                                $("#daysWorked").val("");
                            }
                        }

                        // Attach event listeners
                        $("#startDate").change(handleDateChange);
                        $("#endDate").change(handleDateChange);

                         $('#employeeSelect').change(function() {

                                var employeeId = $(this).val();
                                //console.log("Selected Employee ID:", employeeId);
                                
                                if (employeeId) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'functions/get_daily_rate.php', // Replace with the actual file name to handle the AJAX request
                                        data: { employee_id: employeeId },
                                        cache: false, 
                                        success: function(response) {
                                            $('#basicPay').val(response);
                                            //console.log("Basic Pay after setting:", $('#basicPay').val());
                                              calculateTotalEarnings();
                                            
                                        },
                                        error: function(xhr, status, error) {
                                            console.error("Error:", error);
                                        }
                                    });
                                } else {
                                    $('#basicPay').val('');
                                }
                            });


                            //CALCULATION
                            
                       // Attach event listeners for input fields
$('#daysWorked, #basicPay, #regularHoliday_id, #specialHoliday_id, #overtime_id, #nightDifferential_id, #regularHolidayNightDiff_id, #specialHolidayNightDiff_id, #regHolidayOvertime_id, #splHolidayOvertime_id, #monthlyBonus_id, #drd_id, #payAdjustments_id').on('input', calculateTotalEarnings);


    // Function to calculate total earnings
    function calculateTotalEarnings() {
    try {
        //console.log("calculateTotalEarnings function called");

        // Retrieve days worked and basic pay
        var daysWorked = parseFloat($('#daysWorked').val()) || 0;
        var basicPayString = $('#basicPay').val(); // Retrieve the value as a string
        var numericPart = basicPayString.replace(/[^\d.]/g, '');
        var basicPay = parseFloat(numericPart) || 0; // Convert the string directly to a number

        // Calculate total earnings
        var totalEarnings = daysWorked * basicPay;

       var inputFields = [
                'regularHoliday_id',
                'specialHoliday_id',
                'overtime_id',
                'nightDifferential_id',
                'regularHolidayNightDiff_id',
                'specialHolidayNightDiff_id',
                'regHolidayOvertime_id',
                'splHolidayOvertime_id',
                'monthlyBonus_id',
                'drd_id',
                'payAdjustments_id'
            ];

        for (var i = 0; i < inputFields.length; i++) {
            var fieldValueString = $('#' + inputFields[i]).val(); // Retrieve the value as a string
                var fieldValue = parseFloat(fieldValueString.replace(/[^\d.-]/g, '')) || 0; // Convert the string directly to a number
                totalEarnings += fieldValue;
        }

        var formattedTotalEarnings = totalEarnings.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");
         
            $('#totalEarnings').val(formattedTotalEarnings.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));
            $('#totalEarnings2_id').val(formattedTotalEarnings.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));

            $('#totalEarnings').trigger('change');
    } catch (error) {
        console.error("Error calculating total earnings:", error.message);
    }
}
            
    calculateTotalEarnings();
     
        $('#totalEarnings').on('change', function() {
            var totalEarningsValue = $(this).val();
            //console.log('Total Earnings Value:', totalEarningsValue);

            $.ajax({
                type: 'POST',
                url: 'functions/calculate_withholding_tax.php',
                data: { totalEarnings: totalEarningsValue },
                success: function(response) {
                    console.log('Withholding Tax:', response);

                    $('#withholdingTax').val(parseFloat(response).toLocaleString('en-US', { style: 'currency', currency: 'PHP' }));

                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });




        document.getElementById("employeeSelect").addEventListener("change", function() {
            var employeeId = this.value;
            if (employeeId) {
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "functions/get_contribution.php?employeeId=" + employeeId, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.responseText);
                            document.getElementById("sss_id").value = response.sss;
                            document.getElementById("pagibig_id").value = response.pagibig;
                            document.getElementById("philhealth_id").value = response.philhealth;
                        } else {
                            console.error("Error fetching contributions: " + xhr.status);
                        }
                    }
                };
                xhr.send();
            }
            });




                            //CURRENCY
                                    document.getElementById('regularHoliday_id').addEventListener('input', function(event) {
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

                                document.getElementById('specialHoliday_id').addEventListener('input', function(event) {
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
                                

                                document.getElementById('overtime_id').addEventListener('input', function(event) {
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

                                document.getElementById('nightDifferential_id').addEventListener('input', function(event) {
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
                                
                                 document.getElementById('regularHolidayNightDiff_id').addEventListener('input', function(event) {
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

                                document.getElementById('specialHolidayNightDiff_id').addEventListener('input', function(event) {
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

                                 document.getElementById('regHolidayOvertime_id').addEventListener('input', function(event) {
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

                                document.getElementById('splHolidayOvertime_id').addEventListener('input', function(event) {
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

                                document.getElementById('monthlyBonus_id').addEventListener('input', function(event) {
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

                                document.getElementById('drd_id').addEventListener('input', function(event) {
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

                                 document.getElementById('payAdjustments_id').addEventListener('input', function(event) {
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


                    });
                    </script>

                        <!-- Next button -->
                        <div class="row mb-3">
                            <div class="col-md-9"></div> <!-- Placeholder column to align button to the right -->
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary w-100" onclick="goToNextTab()">Next</button>
                            </div>
                        </div>
                    </div>
                     </form>
                    </div>

                    <div class="tab-pane fade" id="deductions" role="tabpanel" aria-labelledby="deductions-tab">
                        <!-- Content for Deductions tab -->
                    <form id="deduction" method="post">
                        <div class="container mt-4 col-10">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="sss" class="form-label">SSS Contributions</label>
                                    <input type="text" name="sss" class="form-control" id="sss_id" value="<?php echo isset($sss) ? $sss : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="pagibig" class="form-label">Pagibig Contribution</label>
                                    <input type="text" name="pagibig" class="form-control" id="pagibig_id" value="<?php echo isset($pagibig) ? $pagibig : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="philhealth" class="form-label">PhilHealth Contribution</label>
                                    <input type="text" name="philhealth" class="form-control" id="philhealth_id" value="<?php echo isset($philhealth) ? $philhealth : ''; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Withholding Tax</label>
                                <div class="input-group mb-3">
                                    <input type="text"  name="withholdingTax" id="withholdingTax" class="form-control" aria-label="Text input with checkbox" readonly>
                                </div>
                            </div>

                                <div class="col-md-4">
                                    <label for="absent" class="form-label">Absent</label>
                                    <input type="text" name="absent" class="form-control" id="absent_id" placeholder="PHP 0.00">
                                </div>
                                <div class="col-md-4">
                                    <label for="otherDeductions" class="form-label">CA/Other Deductions</label>
                                    <input type="text" name="otherDeductions" class="form-control" id="otherDeductions_id" placeholder="PHP 0.00">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-9"></div> <!-- Placeholder column to align "Total Deductions" to the right -->
                                <div class="col-md-3">
                                    <label for="totalDeductions" class="form-label">Total Deductions</label>
                                    <input type="text" name="totalDeductions" class="form-control" id="totalDeductions_id" placeholder="PHP 0.00" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                        <div class="col-md-9"></div> <!-- Placeholder column to align buttons to the right -->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button type="button" class="btn btn-secondary w-100" onclick="goToPreviousTab()">Back</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" onclick="goToNextTab1()" class="btn btn-primary w-100">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        </div>
                </form>
            </div>

    <script>
       $(document).ready(function() {


    //CURRENCY
            
            
              document.getElementById('absent_id').addEventListener('input', function(event) {
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

            
              document.getElementById('otherDeductions_id').addEventListener('input', function(event) {
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

            //$('#sss_id, #pagibig_id, #philhealth_id, #absent_id, #otherDeductions_id').on('input', calculateTotalDeductions);

        // Function to calculate total deductions
        function calculateTotalDeductions() {
                var sssValue = $('#sss_id').val();
                var numericPart = sssValue.replace(/[^\d.]/g, '');
                var sss = parseFloat(numericPart) || 0;

                var pagibigValue = $('#pagibig_id').val();
                var numericPart = pagibigValue.replace(/[^\d.]/g, '');
                var pagibig = parseFloat(numericPart) || 0;

                var philhealthValue = $('#philhealth_id').val();
                var numericPart = philhealthValue.replace(/[^\d.]/g, '');
                var philhealth = parseFloat(numericPart) || 0;

                var withholdingTaxValue = $('#withholdingTax').val();
                var numericPart = withholdingTaxValue.replace(/[^\d.]/g, '');
                var withholdingTax = parseFloat(numericPart) || 0;

                var absentValue = $('#absent_id').val();
                var numericPart = absentValue.replace(/[^\d.]/g, '');
                var absent = parseFloat(numericPart) || 0;

                var otherDeductionsValue = $('#otherDeductions_id').val();
                var numericPart = otherDeductionsValue.replace(/[^\d.]/g, '');
                var otherDeductions = parseFloat(numericPart) || 0;


                var totalDeductions = sss + pagibig + philhealth + withholdingTax + absent + otherDeductions;
            

                    // Check if totalDeductions is a number before calling toFixed
                    if (!isNaN(totalDeductions)) {

                    $('#totalDeductions_id').val(totalDeductions.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));
                    $('#totalDeductions2_id').val(totalDeductions.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));
                    } else {
                        // Handle the case where totalDeductions is not a number
                        console.error('Total deductions is not a number:', totalDeductions);
                    }
                }

                // Event listener for input fields within the #deduction form
                $('#deduction input').on('input', function() {
                    calculateTotalDeductions();
                });

                // Initial calculation on page load
                calculateTotalDeductions();

      
                
        });
    </script>

                    <div class="tab-pane fade" id="incentives" role="tabpanel" aria-labelledby="incentives-tab">
                    <form id="incentivesTab" method="POST">
                    <div class="container mt-4 col-10">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="incentives" class="form-label">Incentives</label>
                                    <input type="text" name="incentives" class="form-control" id="incentives_id" placeholder="PHP 0.00">
                                </div>
                                <div class="col-md-6">
                                    <label for="others" class="form-label">Others</label>
                                    <input type="text" name="others" class="form-control" id="others_id" placeholder="PHP 0.00">
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-md-9"></div> <!-- Placeholder column to align "Total Deductions" to the right -->
                                <div class="col-md-3">

                                     <label for="totalIncome" class="form-label">Total Incentives</label>
                                    <input type="text" name="totalIncome" class="form-control" id="totalIncome_id" placeholder="PHP 0.00" readonly>
                
                                </div>

                                  <label for="totalEarnings" class="form-label">Total Earnings</label>
                                     <input type="text" name="totalEarnings" class="form-control" id="totalEarnings2_id" placeholder="PHP 0.00" readonly>

                                     <label for="totalDeductions" class="form-label">Total Deductions</label>
                                     <input type="text" name="totalDeductions" class="form-control" id="totalDeductions2_id" placeholder="PHP 0.00" readonly> 

                                      <label for="totalNetpay" class="form-label">Total Netpay</label>
                                    <input type="text" name="totalNetpay" class="form-control" id="totalNetpay_id" placeholder="PHP 0.00" readonly>

                            </div>
                            <div class="row mb-3">
                        <div class="col-md-9"></div> <!-- Placeholder column to align buttons to the right -->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button type="button" class="btn btn-secondary w-100" onclick="goToPreviousTab1()">Back</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</main>

 <script>
       $(document).ready(function() {

    //CURRENCY
            document.getElementById('incentives_id').addEventListener('input', function(event) {
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

              document.getElementById('others_id').addEventListener('input', function(event) {
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


        function calculateTotalNetPay() {
            var totalEarnings = parseFloat($('#totalEarnings2_id').val().replace(/[^\d.]/g, '')) || 0;
            var totalDeductions = parseFloat($('#totalDeductions2_id').val().replace(/[^\d.]/g, '')) || 0;
            var incentivesValue = parseFloat($('#incentives_id').val().replace(/[^\d.]/g, '')) || 0;
            var othersValue = parseFloat($('#others_id').val().replace(/[^\d.]/g, '')) || 0;

            
            var totalIncentives =  othersValue + incentivesValue;
          
            var totalNetPay = totalEarnings - totalDeductions + othersValue + incentivesValue;
            
            
            $('#totalIncome_id').val(totalIncentives.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));
            $('#totalNetpay_id').val(totalNetPay.toLocaleString('en-US', {style: 'currency', currency: 'PHP'}));
        }

        // Event listener for input fields within the #incentivesTab form
        $('#incentivesTab input').on('input', function() {
            calculateTotalNetPay();
        });

        // Initial calculation on page load
        calculateTotalNetPay();




        });

    </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    function goToNextTab() {
        document.getElementById('deductions-tab').click();
    }

    function goToNextTab1() {
        var absentValue = $('#absent_id').val();
        var otherDeductionsValue = $('#otherDeductions_id').val();

            if (!absentValue) {
                $('#absent_id').addClass('required-field');
            } else {
                $('#absent_id').removeClass('required-field');
            }

            if (!otherDeductionsValue) {
                $('#otherDeductions_id').addClass('required-field');
            } else {
                $('#otherDeductions_id').removeClass('required-field');
            }

            if (!absentValue || !otherDeductionsValue) {
                return;
            }
            $('#incentives-tab').tab('show');
                    //document.getElementById('incentives-tab').click();
            }



    // Function to highlight the specified input fields
    function highlightRequiredFields(fields) {
        $(fields).addClass('required-field');
    }

    function goToPreviousTab() {
        document.getElementById('earnings-tab').click();
    }
    function goToPreviousTab1() {
        document.getElementById('deductions-tab').click();
    }

    document.querySelectorAll('.nav-link').forEach(item => {
        item.addEventListener('click', event => {
            const activeTab = document.querySelector('.nav-link.active');
            activeTab.classList.remove('active');
            event.target.classList.add('active');
        });
    });

    $(function() {
        $("#startDate, #endDate").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    function calculateWorkdays(startDate, endDate) {
        var totalDays = 0;
        var currentDate = new Date(startDate);

        while (currentDate <= endDate) {
            var dayOfWeek = currentDate.getDay();
            if (dayOfWeek !== 0 && dayOfWeek !== 6) { // Exclude Sunday (0) and Saturday (6)
                totalDays++;
            }
            currentDate.setDate(currentDate.getDate() + 1);
        }

        return totalDays;
    }
 

</script>




<style>
    /* Override Bootstrap's default active background color */
    .nav-tabs .nav-link.active {
        background-color: #BED7DC !important;
        color: #222831 !important; /* Set text color to white for better visibility */
        font-weight: bold;
    }
</style>


<!-- Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle" id="insertPayroll" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
    <div class="toast-header">
        <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
        <strong class="me-auto">Notification</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        Payroll Successfully Saved
    </div>
</div>


<script>
$(document).ready(function(){
    $('#incentivesTab').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission

       $('#incentives_id').removeClass('required-field');
        $('#others_id').removeClass('required-field');

        var incentives = $('#incentives_id').val().trim();
        var others = $('#others_id').val().trim();

        var valid = true;
        if (incentives === "") {
            $('#incentives_id').addClass('required-field');
            valid = false;
        }
        if (others === "") {
            $('#others_id').addClass('required-field');
            valid = false;
        }

        if (!valid) {
            return; // Prevent form submission if any field is empty
        }


        var data = $('#earningsTab, #deduction, #incentivesTab').serialize();
        var url = "functions/insertProcessPayroll.php";

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json", // Specify the expected response type
            success: function(response) {
                //console.log("Response received:", response); // Log the entire response object
                //console.log("Success property:", response.success); // Log the value of the success property

                if (response.success) {
                    console.log("Showing the toast..."); // Check if this line is reached
                    $('#insertPayroll').toast('show');

                setTimeout(function() {
                window.location.href = 'Payroll_list.php';
            }, 2000); 
                    console.log('Payroll success');
                }

            },
            error: function(xhr, textStatus, errorThrown) {
                console.log("Error: " + errorThrown);
            }
        });
    });
});



</script>

         
         

<footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; iReply Payroll System</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>


<?php include '../template/footer.php' ?>


