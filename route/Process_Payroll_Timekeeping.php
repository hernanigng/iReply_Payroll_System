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


                <?php
    include "../connection/database.php";

    $timekeepingId = isset($_GET['timekeeping_ID']) ? $_GET['timekeeping_ID'] : null;

    if ($timekeepingId) {
        // Fetch data based on timekeeping_ID
        $sql = "SELECT date_from, date_to, Total_DysWork, tbl_employee.employee_id, firstname, lastname, account_bonus,
                       daily_rate, sss_con, sss_con_er, pagibig_con, pagibig_con_er, philhealth_con, philhealth_con_er,
                       total_contribution_er, regular_holiday, special_holiday, overtime, 
                       night_differential, regular_holiday_night_diff, special_holiday_night_diff, 
                       regular_holiday_overtime, special_holiday_overtime, drd
                FROM tbl_timekeeping
                JOIN tbl_employee ON tbl_timekeeping.employee_id = tbl_employee.employee_id
                WHERE timekeeping_ID = ?";

        // Check if the query preparation is successful
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $timekeepingId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
        
                // Fetch the first row (assuming there's only one result)
                $data = $result->fetch_assoc();
                
                // Store fetched data in variables
                $dateFrom = $data['date_from'];
                $dateTo = $data['date_to'];
                $employeeId = $data['employee_id'];
                $employeeName = $data['firstname'] . ' ' . $data['lastname'];
                $totalDaysWork = (float)$data['Total_DysWork'];
                $accBonus = $data['account_bonus'];
                $dailyRate = (float)str_replace('PHP ', '', str_replace(',', '', $data['daily_rate']));
                $sss = $data['sss_con'];
                $pagibig = $data['pagibig_con'];
                $philhealth = $data['philhealth_con'];
                $sssER = $data['sss_con_er'];
                $pagibigER = $data['pagibig_con_er'];
                $philhealthER = $data['philhealth_con_er'];
                $totalER = $data['total_contribution_er'];
                
                $regularHoliday = (float)$data['regular_holiday'];
                $specialHoliday = (float)$data['special_holiday'];
                $overtime = (float)$data['overtime'];
                $nightDifferential = (float)$data['night_differential'];
                $regularHolidayNightDiff = (float)$data['regular_holiday_night_diff'];
                $specialHolidayNightDiff = (float)$data['special_holiday_night_diff'];
                $regularHolidayOvertime = (float)$data['regular_holiday_overtime'];
                $specialHolidayOvertime = (float)$data['special_holiday_overtime'];
                $drd = (float)$data['drd'];

                 // Perform calculations (example calculations, adjust as necessary)
                 $calculatedRegularHoliday = $dailyRate * $regularHoliday;

                 $splHolidayValue = $dailyRate * 0.30;
                 $calculatedSpecialHoliday = $splHolidayValue * $specialHoliday;
                 
                 $hourlyRate = $dailyRate / 8;
                 $otFee = $hourlyRate * 1.25;
                 $calculatedOvertime = $otFee * $overtime;

                 $nightDiffFee = $hourlyRate * 0.1;
                 $calculatedNightDifferential = $nightDiffFee * $nightDifferential; 
                 
                 $HourlyRegHolidayNightDiffFee = $calculatedRegularHoliday / 8;
                 $RegHolidayNightDiffValue = $HourlyRegHolidayNightDiffFee * 0.1;
                 $calculatedRegularHolidayNightDiff = $RegHolidayNightDiffValue * $regularHolidayNightDiff;

                 $splHolidayFee = $dailyRate * 1.30; 
                 $HourlySplHolidayNightDiffFee = $splHolidayFee / 8;
                 $SplHolidayNightDiffValue =  $HourlySplHolidayNightDiffFee * 0.1;
                 $calculatedSpecialHolidayNightDiff = $SplHolidayNightDiffValue * $specialHolidayNightDiff;

                 $regHolidayFee = $dailyRate * 2;
                 $HourlyRegHolidayFee = $regHolidayFee / 8;
                 $RegHolidayOvertimeValue = $HourlyRegHolidayFee * 1.30;                  
                 $calculatedRegularHolidayOvertime = $RegHolidayOvertimeValue * $regularHolidayOvertime; 
                 
                 $HourlySplHolidayFee = $splHolidayFee / 8;
                 $SplHolidayOvertimeValue = $HourlySplHolidayFee * 0.30;  
                 $calculatedSpecialHolidayOvertime = $SplHolidayOvertimeValue * $specialHolidayOvertime;

                 $DrdValue = $dailyRate * 1.30;
                 $calculatedDrd = $DrdValue * $drd;

                 //formulas
                 $formulaRegularHoliday = "Daily Rate = " . $dailyRate . " x Number of Days Worked = " .  $regularHoliday;
                 $formulaSpecialHoliday = "Special Holiday Value (Daily Rate " . $dailyRate . " x 0.30) = " . $splHolidayValue . " x Number of Days Worked = " . $specialHoliday;
                 $formulaOvertime = "OT Fee = [Hourly Rate(Daily Rate " .  $dailyRate . " / 8 = " . $hourlyRate . ") x 1.25] x Number of Hours Worked = " . $overtime;
                 $formulaNightDiff = "Night Diff Fee(Hourly Rate = " . $dailyRate . " / 8 x 0.1 =" . $nightDiffFee . ") x Number of Hours Worked = " . $nightDifferential;
                 $formulaRegHolidayNightDiff = "Regular Night Diff Value = [Hourly Regular Holiday Night Diff Fee(Regular Holiday Fee " . $calculatedRegularHoliday . " / 8) x 0.1 = " . $RegHolidayNightDiffValue . "] x Number of Hours Worked = " . $regularHolidayNightDiff;
                 $formulaSplHolidayNightDiff = "Special Holiday Night Diff Value = [Hourly Special Holiday Night Diff Fee(Special Holiday Fee(Daily Rate " . $dailyRate . " x 1.30 = " . $splHolidayFee . ") / 8) x 0.1 = " . $SplHolidayNightDiffValue . "] x Number of Hours Worked = " . $specialHolidayNightDiff;
                 $formulaRegHolidayOvertime = "Regular Holiday Overtime Value = [Hourly Regular Holiday Fee( Regular Holiday Fee " . $regHolidayFee . " / 8) x 0.1] x Number of Hours Worked = " . $regularHolidayOvertime;
                 $formulaSplHolidayOvertime = "Special Holiday Overtime Value = [Hourly Special Holiday Fee( Special Holiday Fee(Daily Rate " . $dailyRate . " x 1.30 = " . $splHolidayFee . ") / 8) x 0.30 = " . $SplHolidayOvertimeValue . "] x Number of Hours Worked = " . $specialHolidayOvertime;
                 $formulaDrd = " DRD Value(Daily Rate" . $dailyRate . " x 1.30) x Number of Days Worked = " . $drd;
                 
              
                // Display or process the fetched data as needed
                // echo "Timekeeping ID: " . $timekeepingId;

            } else {
                echo "No data found for timekeeping_ID: " . $timekeepingId;
            }

            $stmt->close();
        } else {
            // Output SQL error if preparation failed
            echo "Error preparing SQL statement: " . $conn->error;
        }
    } else {
        echo "No timekeeping ID provided.";
    }
    $conn->close();
?>


                <div class="tab-content" id="myTabContent">
           

                    <div class="tab-pane fade show active" id="earnings" role="tabpanel" aria-labelledby="earnings-tab">
                        <!-- Content for Earnings tab -->
                        <div class="container mt-4 col-10"> <!-- Container for the form -->
                        <form id="earningsTab" method="post">
                <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="employeeSelect" class="form-label">Employee Name</label>
                        <select class="form-select" id="employeeSelect" name="selectEmployee" aria-label="Employee Select" disabled>
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
                           <input type="hidden" name="selectEmployee" value="<?php echo $employeeId; ?>">
                             <input type="hidden" name="timekeeping" value="<?php echo $timekeepingId; ?>">
                <p id="" class="error-message" style="display: none;">Please fill out this required field.</p>
            </div>
                    <div class="col-md-6">
                        <label for="periodCovered" class="form-label">Period Covered</label>
                        <div class="input-group">
                            <span class="input-group-text">Start Date</span>
                    <input type="text" id="startDate" name="startDate" class="form-control" style="width: 200px;" value="<?php echo isset($dateFrom) ? $dateFrom : ''; ?>" disabled>
                    <input type="hidden" name="startDate" value="<?php echo $dateFrom; ?>">
                    </div>
                    <div class="input-group">
                    <span class="input-group-text">End Date</span>
                    <input type="text" id="endDate" name="endDate" class="form-control" style="width: 200px;" value="<?php echo isset($dateTo) ? $dateTo : ''; ?>" disabled>
                    <input type="hidden" name="endDate" value="<?php echo $dateTo; ?>">
                        </div>
                    </div>
                </div>


                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="daysWorked" class="form-label">No. of Days Worked</label>
                            <input type="text" name="daysWorked" class="form-control" id="daysWorked" value="<?php echo isset($totalDaysWork) ? $totalDaysWork : ''; ?>" disabled>
                        </div>
 
                        <div class="col-md-4">
                            <label for="basicPay" class="form-label">Daily Rate</label>
                            <input type="text" name="basicPay" class="form-control" id="basicPay"  style="width: 150px;" placeholder="PHP 0.00"  value="<?php echo isset($dailyRate) ? number_format($dailyRate, 2) : ''; ?>" readonly>
                        </div>

                        <!-- Add a Tooltip to show Formula Information -->
                       <div class="col-md-4">
                           <label for="regularHoliday" class="form-label">Regular Holiday</label>
                         <div class="input-group">
                            <input type="text" name="regularHoliday" class="form-control" id="regularHoliday_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedRegularHoliday) ? number_format($calculatedRegularHoliday, 2) : ''; ?>" readonly>
                            <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaRegularHoliday); ?>')">
                            <i class="bi bi-info-circle"></i>
                            </button>
                         </div>
                       </div>
                    </div>

                    <div class="row mb-3">
                       <div class="col-md-4">
                           <label for="specialHoliday" class="form-label">Special Holiday</label>
                        <div class="input-group">
                           <input type="text" name="specialHoliday" class="form-control" id="specialHoliday_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedSpecialHoliday) ? number_format($calculatedSpecialHoliday, 2) : ''; ?>" readonly>
                           <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaSpecialHoliday); ?>')">
                           <i class="bi bi-info-circle"></i>
                        </button>
                      </div>
                    </div>

<div class="col-md-4">
    <label for="overtime" class="form-label">Overtime</label>
    <div class="input-group">
        <input type="text" name="overtime" class="form-control" id="overtime_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedOvertime) ? number_format($calculatedOvertime, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaOvertime); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>

<div class="col-md-4">
    <label for="nightDifferential" class="form-label">Night Differential</label>
    <div class="input-group">
        <input type="text" name="nightDifferential" class="form-control" id="nightDifferential_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedNightDifferential) ? number_format($calculatedNightDifferential, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaNightDiff); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>
</div>

                    <div class="row mb-3">

                    <div class="col-md-4">
    <label for="regularHolidayNightDiff" class="form-label">Regular Holiday Night Differential</label>
    <div class="input-group">
        <input type="text" name="regularHolidayNightDiff" class="form-control" id="regularHolidayNightDiff_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedRegularHolidayNightDiff) ? number_format($calculatedRegularHolidayNightDiff, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaRegHolidayNightDiff); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>

<div class="col-md-4">
    <label for="specialHolidayNightDiff" class="form-label">Special Holiday Night Differential</label>
    <div class="input-group">
        <input type="text" name="specialHolidayNightDiff" class="form-control" id="specialHolidayNightDiff_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedSpecialHolidayNightDiff) ? number_format($calculatedSpecialHolidayNightDiff, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaSplHolidayNightDiff); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>

<div class="col-md-4">
    <label for="regHolidayOvertime" class="form-label">Regular Holiday Overtime</label>
    <div class="input-group">
        <input type="text" name="regHolidayOvertime" class="form-control" id="regHolidayOvertime_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedRegularHolidayOvertime) ? number_format($calculatedRegularHolidayOvertime, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaRegHolidayOvertime); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>
                    </div>

                    <div class="row mb-3">

                    <div class="col-md-4">
    <label for="splHolidayOvertime" class="form-label">Special Holiday Overtime</label>
    <div class="input-group">
        <input type="text" name="splHolidayOvertime" class="form-control" id="splHolidayOvertime_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedSpecialHolidayOvertime) ? number_format($calculatedSpecialHolidayOvertime, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaSplHolidayOvertime); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
</div>

                        <div class="col-md-4">
                            <label for="monthlyBonus" class="form-label">Monthly Bonus</label>
                            <input type="text" name="monthlyBonus" class="form-control" id="monthlyBonus_id" placeholder="PHP 0.00" value="<?php echo isset($accBonus) ? $accBonus : ''; ?>" readonly>
                        </div>

                        <div class="col-md-4">
    <label for="drd" class="form-label">DRD</label>
    <div class="input-group">
        <input type="text" name="drd" class="form-control" id="drd_id" style="width: 150px;" placeholder="PHP 0.00" value="<?php echo isset($calculatedDrd) ? number_format($calculatedDrd, 2) : ''; ?>" readonly>
        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#editFormulaModal" onclick="showFormula('<?php echo htmlspecialchars($formulaDrd); ?>')">
            <i class="bi bi-info-circle"></i>
        </button>
    </div>
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
    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltips = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltips.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>

<!-- View Formula Modal -->
<div class="modal fade" id="editFormulaModal" tabindex="-1" aria-labelledby="editFormulaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFormulaModalLabel">View Formula</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFormulaForm">
                    <div class="mb-3">
                        <textarea class="form-control" id="basicPayFormula" readonly rows="4"><?php echo isset($calculatedRegularHoliday) ? $calculatedRegularHoliday : ''; ?></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
        function showFormula(formula) {
            document.getElementById('basicPayFormula').value = formula;
        }

        function saveFormula() {
            const formula = document.getElementById('basicPayFormula').value;

            $.ajax({
                type: 'POST',
                url: 'functions/save_formula.php',
                data: { basicPayFormula: formula },
                success: function(response) {
                    alert('Formula saved successfully!');
                    // Optionally, you can refresh the page or close the modal
                    $('#editFormulaModal').modal('hide');

                setTimeout(function() {
                window.location.href = 'Process_Payroll_Timekeeping.php';
                 }, 2000); 

                },
                error: function() {
                    alert('An error occurred while saving the formula.');
                }
            });
        }
    </script>


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


                      
         function calculateTotalDeductions() {
        var sssValue = $('#sss_id').val();
        var sss = parseFloat(sssValue.replace(/[^\d.]/g, '')) || 0;

        var pagibigValue = $('#pagibig_id').val();
        var pagibig = parseFloat(pagibigValue.replace(/[^\d.]/g, '')) || 0;

        var philhealthValue = $('#philhealth_id').val();
        var philhealth = parseFloat(philhealthValue.replace(/[^\d.]/g, '')) || 0;

        var withholdingTaxValue = $('#withholdingTax').val();
        var withholdingTax = parseFloat(withholdingTaxValue.replace(/[^\d.]/g, '')) || 0;

        var absentValue = $('#absent_id').val();
        var absent = parseFloat(absentValue.replace(/[^\d.]/g, '')) || 0;

        var otherDeductionsValue = $('#otherDeductions_id').val();
        var otherDeductions = parseFloat(otherDeductionsValue.replace(/[^\d.]/g, '')) || 0;

        var totalDeductions = sss + pagibig + philhealth + withholdingTax + absent + otherDeductions;

        if (!isNaN(totalDeductions)) {
            $('#totalDeductions_id').val(totalDeductions.toFixed(2));
            $('#totalDeductions2_id').val(totalDeductions.toFixed(2));
            console.log($('#totalDeductions2_id').val());

             $('#totalDeductions2_id').val(totalDeductions.toFixed(2)).promise().done(function() {
                calculateTotalNetPay();
            });

        } else {
            console.error('Total deductions is not a number:', totalDeductions);
        }
    }

    function calculateWithholdingTax(totalEarningsValue) {
        $.ajax({
            type: 'POST',
            url: 'functions/calculate_withholding_tax.php',
            data: { totalEarnings: totalEarningsValue },
            success: function(response) {
                console.log('Withholding Tax:', response);
                $('#withholdingTax').val(parseFloat(response));
                calculateTotalDeductions(); // Call total deductions calculation after withholding tax is fetched
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function calculateTotalEarnings() {
        try {
            var daysWorked = parseFloat($('#daysWorked').val()) || 0;
            var basicPayString = $('#basicPay').val();
            var numericPart = basicPayString.replace(/[^\d.]/g, '');
            var basicPay = parseFloat(numericPart) || 0;

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
                var fieldValueString = $('#' + inputFields[i]).val();
                var fieldValue = parseFloat(fieldValueString.replace(/[^\d.-]/g, '')) || 0;
                totalEarnings += fieldValue;
            }

            var formattedTotalEarnings = totalEarnings.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",");

            $('#totalEarnings').val(formattedTotalEarnings);
            $('#totalEarnings2_id').val(formattedTotalEarnings);

            $('#totalEarnings').trigger('change');
        } catch (error) {
            console.error("Error calculating total earnings:", error.message);
        }
    }

    function checkAndCalculate() {
        var totalEarningsValue = $('#totalEarnings').val().replace(/,/g, '');
        if (totalEarningsValue) {
            calculateWithholdingTax(totalEarningsValue);
        }
    }
$('#payAdjustments_id').on('input', function() {
    calculateTotalEarnings();
});
   
   


    function calculateTotalNetPay() {
        var totalEarnings = parseFloat($('#totalEarnings2_id').val().replace(/[^\d.]/g, '')) || 0;
      var totalDeductions = parseFloat($('#totalDeductions2_id').val()) || 0;
        var incentivesValue = parseFloat($('#incentives_id').val().replace(/[^\d.]/g, '')) || 0;
        var othersValue = parseFloat($('#others_id').val().replace(/[^\d.]/g, '')) || 0;

        var totalIncentives = othersValue + incentivesValue;


       var totalNetPay = totalEarnings - totalDeductions;
    if (incentivesValue || othersValue) {
        totalNetPay += totalIncentives;
    }

        $('#totalIncome_id').val(totalIncentives.toLocaleString('en-US', { style: 'currency', currency: 'PHP' }));
        $('#totalNetpay_id').val(totalNetPay.toLocaleString('en-US', { style: 'currency', currency: 'PHP' }));
    }


    function goToNextTab() {
        calculateTotalDeductions();
    }

    function goToNextTab1() {
        calculateTotalNetPay();
    }

    $(document).ready(function() {
        calculateTotalEarnings();
        checkAndCalculate();

        // Event listener for input fields within the #deduction form
        $('#deduction input').on('input', function() {
            calculateTotalDeductions();
        });

        // Event listener for input fields within the #incentivesTab form
        $('#incentivesTab input').on('input', function() {
            calculateTotalNetPay();
        });

        // Initial calculation on page load
        calculateTotalNetPay();
    });

    // Format input fields and trigger calculation on change
    $('#absent_id, #otherDeductions_id').on('input', function(event) {
        let inputValue = event.target.value.replace(/[^\d.]/g, ''); // Remove non-numeric characters except '.'
        inputValue = inputValue.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Add commas for thousands

        if (inputValue.includes('.')) {
            let decimalPart = inputValue.split('.')[1];
            if (!decimalPart || decimalPart.length < 2) {
                inputValue += '0';
            }
        }

        event.target.value = inputValue; // Set the formatted value without 'PHP'

        calculateTotalDeductions(); // Recalculate total deductions
    

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
                                    <label for="sss" class="form-label">SSS Contribution EE</label>
                                    <input type="text" name="sss" class="form-control" id="sss_id" value="<?php echo isset($sss) ? $sss : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="pagibig" class="form-label">Pagibig Contribution EE</label>
                                    <input type="text" name="pagibig" class="form-control" id="pagibig_id" value="<?php echo isset($pagibig) ? $pagibig : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="philhealth" class="form-label">PhilHealth Contribution EE</label>
                                    <input type="text" name="philhealth" class="form-control" id="philhealth_id" value="<?php echo isset($philhealth) ? $philhealth : ''; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="sssER" class="form-label">SSS Contribution ER</label>
                                    <input type="text" name="sssER" class="form-control" id="sssER_id" value="<?php echo isset($sssER) ? $sssER : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="pagibigER" class="form-label">Pagibig Contribution ER</label>
                                    <input type="text" name="pagibigER" class="form-control" id="pagibigER_id" value="<?php echo isset($pagibigER) ? $pagibigER : ''; ?>" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="philhealthER" class="form-label">PhilHealth Contribution ER</label>
                                    <input type="text" name="philhealthER" class="form-control" id="philhealthER_id" value="<?php echo isset($philhealthER) ? $philhealthER : ''; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="totalER" class="form-label">Total Contribution ER</label>
                                    <input type="text" name="totalER" class="form-control" id="totalER_id" value="<?php echo isset($totalER) ? $totalER : ''; ?>" readonly>
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



        var data = $('#earningsTab, #deduction, #incentivesTab').serialize();
        var url = "functions/insertProcessPayroll_Timekeeping.php";

        $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: "json", // Specify the expected response type
            success: function(response) {
                console.log("Response received:", response); // Log the entire response object
                console.log("Success property:", response.success); // Log the value of the success property

                if (response.success) {
                    console.log("Showing the toast..."); // Check if this line is reached
                    $('#insertPayroll').toast('show');

                setTimeout(function() {
                window.location.href = 'Payslip.php';
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


