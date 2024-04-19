<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>



<div id="layoutSidenav_content">

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
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employeeName" class="form-label">Employee Name</label>
                        <input type="text" name="employeeName" class="form-control" id="employeeName">
                    </div>
                    <div class="col-md-6">
                        <label for="periodCovered" class="form-label">Period Covered</label>
                        <div class="input-group">
                            <span class="input-group-text">Start Date</span>
                            <input type="text" id="startDate" name="startDate" class="form-control">
                            <span class="input-group-text">End Date</span>
                            <input type="text" id="endDate" name="endDate" class="form-control">
                        </div>
                    </div>
                </div>


                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="daysWorked" class="form-label">No. of Days Worked</label>
                            <input type="text" name="daysWorked" class="form-control" id="daysWorked">
                        </div>
                        <div class="col-md-4">
                            <label for="basicPay" class="form-label">Basic Pay</label>
                            <input type="text" name="basicPay" class="form-control" id="basicPay">
                        </div>
                        <div class="col-md-4">
                            <label for="regularHoliday" class="form-label">Regular Holiday</label>
                            <input type="text" name="regularHoliday" class="form-control" id="regularHoliday">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="specialHoliday" class="form-label">Special Holiday</label>
                            <input type="text" name="specialHoliday" class="form-control" id="specialHoliday">
                        </div>
                        <div class="col-md-4">
                            <label for="overtime" class="form-label">Overtime</label>
                            <input type="text" name="overtime" class="form-control" id="overtime">
                        </div>
                        <div class="col-md-4">
                            <label for="nightDifferential" class="form-label">Night Differential</label>
                            <input type="text" name="nightDifferential" class="form-control" id="nightDifferential">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="regularHolidayNightDiff" class="form-label">Regular Holiday Night Diff</label>
                            <input type="text" name="regularHolidayNightDiff" class="form-control" id="regularHolidayNightDiff">
                        </div>
                        <div class="col-md-4">
                            <label for="specialHolidayNightDiff" class="form-label">Special Holiday Night Diff</label>
                            <input type="text" name="specialHolidayNightDiff" class="form-control" id="specialHolidayNightDiff">
                        </div>
                        <div class="col-md-4">
                            <label for="regHolidayOvertime" class="form-label">Reg. Holiday Overtime</label>
                            <input type="text" name="regHolidayOvertime" class="form-control" id="regHolidayOvertime">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="splHolidayOvertime" class="form-label">Spl. Holiday Overtime</label>
                            <input type="text" name="splHolidayOvertime" class="form-control" id="splHolidayOvertime">
                        </div>
                        <div class="col-md-4">
                            <label for="monthlyBonus" class="form-label">Monthly Bonus</label>
                            <input type="text" name="monthlyBonus" class="form-control" id="monthlyBonus">
                        </div>
                        <div class="col-md-4">
                            <label for="drd" class="form-label">DRD</label>
                            <input type="text" name="drd" class="form-control" id="drd">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="payAdjustments" class="form-label">Pay Adjustments</label>
                            <input type="text" name="payAdjustments" class="form-control" id="payAdjustments">
                        </div>
                        <div class="col-md-4">
                            <label for="totalEarnings" class="form-label">Total Earnings</label>
                            <input type="text" name="totalEarnings" class="form-control" id="totalEarnings">
                        </div>
                    </div>
                    
                        <!-- Next button -->
                        <div class="row mb-3">
                            <div class="col-md-9"></div> <!-- Placeholder column to align button to the right -->
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary w-100" onclick="goToNextTab()">Next</button>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="tab-pane fade" id="deductions" role="tabpanel" aria-labelledby="deductions-tab">
                        <!-- Content for Earnings tab -->
                        <div class="container mt-4 col-10">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="philHealth" class="form-label">PhilHealth Contributions</label>
                                    <input type="text" name="philHealth" class="form-control" id="philHealth">
                                </div>
                                <div class="col-md-4">
                                    <label for="pagibig" class="form-label">Pagibig Contribution</label>
                                    <input type="text" name="pagibig" class="form-control" id="pagibig">
                                </div>
                                <div class="col-md-4">
                                    <label for="sss" class="form-label">SSS Contribution</label>
                                    <input type="text" name="sss" class="form-control" id="sss">
                                </div>
                            </div>

                            <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Withholding Tax</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" type="checkbox" value="" id="withholdingTax">
                                    </div>
                                    <input type="text" class="form-control" aria-label="Text input with checkbox">
                                </div>
                            </div>

                                <div class="col-md-4">
                                    <label for="absent" class="form-label">Absent</label>
                                    <input type="text" name="absent" class="form-control" id="absent">
                                </div>
                                <div class="col-md-4">
                                    <label for="otherDeductions" class="form-label">CA/Other Deductions</label>
                                    <input type="text" name="otherDeductions" class="form-control" id="otherDeductions">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-9"></div> <!-- Placeholder column to align "Total Deductions" to the right -->
                                <div class="col-md-3">
                                    <label for="totalDeductions" class="form-label">Total Deductions</label>
                                    <input type="text" name="totalDeductions" class="form-control" id="totalDeductions">
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
                                    <button type="button" class="btn btn-primary w-100" onclick="goToNextTab1()">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
               </div>

                    <div class="tab-pane fade" id="incentives" role="tabpanel" aria-labelledby="incentives-tab">
                    <div class="container mt-4 col-10">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="philHealth" class="form-label">Incentives</label>
                                    <input type="text" name="philHealth" class="form-control" id="philHealth">
                                </div>
                                <div class="col-md-6">
                                    <label for="pagibig" class="form-label">Others</label>
                                    <input type="text" name="pagibig" class="form-control" id="pagibig">
                                </div>
                            </div>



                            <div class="row mb-3">
                                <div class="col-md-9"></div> <!-- Placeholder column to align "Total Deductions" to the right -->
                                <div class="col-md-3">
                                    <label for="totalDeductions" class="form-label">Total Income</label>
                                    <input type="text" name="totalDeductions" class="form-control" id="totalDeductions">
                                </div>
                            </div>
                            <div class="row mb-3">
                        <div class="col-md-9"></div> <!-- Placeholder column to align buttons to the right -->
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <button type="button" class="btn btn-secondary w-100" onclick="goToPreviousTab1()">Back</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary w-100">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script>
    function goToNextTab() {
        document.getElementById('deductions-tab').click();
    }
    function goToNextTab1() {
        document.getElementById('incentives-tab').click();
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


