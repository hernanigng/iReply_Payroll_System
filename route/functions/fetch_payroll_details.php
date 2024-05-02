<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

include "../../connection/database.php";

if(isset($_POST['netPay_id'])) {
    $netPayId = $_POST['netPay_id'];
    
    $query = "SELECT earnings_id, deductions_id, incentives_id, total_netPay FROM tbl_payroll_tranx WHERE netPay_id = ?";

    // Prepare the statement
    $statement = $conn->prepare($query);
    
    if (!$statement) {
        $errorMessage = "Prepare Error: " . $conn->error;
        echo $errorMessage;
    } else {
        $statement->bind_param("s", $netPayId);

        $executeSuccess = $statement->execute();

        if (!$executeSuccess) {
            // Handle the execute error
            echo $errorMessage;
        } else {
            // Bind the result variables separately for each column
            $statement->bind_result($earningsId, $deductionsId, $incentivesId, $totalNetPay);
                
            $statement->fetch();

            $statement->close();
        }
    }
}

if ($earningsId && $deductionsId && $incentivesId) {
    // Select data from tbl_earnings
    $query_earnings = "SELECT * FROM tbl_earnings WHERE earnings_id = ?";
    $statement_earnings = $conn->prepare($query_earnings);

    if (!$statement_earnings) {
        $errorMessage = "Prepare Error: " . $conn->error;
        echo $errorMessage;
    } else {
        $statement_earnings->bind_param("i", $earningsId);
        $executeSuccess_earnings = $statement_earnings->execute();

        if (!$executeSuccess_earnings) {
            $errorMessage = "Execute Error: " . $statement_earnings->error;
            echo $errorMessage;
        } else {
            // Fetch data from tbl_earnings
            $result_earnings = $statement_earnings->get_result();
            $row_earnings = $result_earnings->fetch_assoc();

            // Close statement for tbl_earnings
            $statement_earnings->close();

             $query_incentives = "SELECT * FROM tbl_incentives WHERE incentives_id = ?";
                    $statement_incentives = $conn->prepare($query_incentives);

                    if (!$statement_incentives) {
                        $errorMessage = "Prepare Error: " . $conn->error;
                        echo $errorMessage;
                    } else {
                        $statement_incentives->bind_param("i", $incentivesId);
                        $executeSuccess_incentives = $statement_incentives->execute();

                        if (!$executeSuccess_incentives) {
                            $errorMessage = "Execute Error: " . $statement_incentives->error;
                            echo $errorMessage;
                        } else {
                            // Fetch data from tbl_incentives
                            $result_incentives = $statement_incentives->get_result();
                            $row_incentives = $result_incentives->fetch_assoc();
                            // Close statement for tbl_incentives
                            $statement_incentives->close();


            // Select data from tbl_deductions
            $query_deductions = "SELECT * FROM tbl_deductions WHERE deductions_id = ?";
            $statement_deductions = $conn->prepare($query_deductions);

            if (!$statement_deductions) {
                $errorMessage = "Prepare Error: " . $conn->error;
                echo $errorMessage;
            } else {
                $statement_deductions->bind_param("i", $deductionsId);
                $executeSuccess_deductions = $statement_deductions->execute();

                if (!$executeSuccess_deductions) {
                    $errorMessage = "Execute Error: " . $statement_deductions->error;
                    echo $errorMessage;
                } else {
                    $result_deductions = $statement_deductions->get_result();
                    $row_deductions = $result_deductions->fetch_assoc();

                    $statement_deductions->close();

                    $htmlContent = "<!-- Modal Body Content -->";
                    
                $htmlContent .= "<div class='container mt-2 col-12'>";
                $htmlContent .= "<div class='row justify-content-center'>";
                $htmlContent .= "<div class='col-12'>";
                $htmlContent .= "<ul class='nav nav-tabs' id='myTab' role='tablist'>";
                $htmlContent .= "<li class='nav-item'>";
                $htmlContent .= "<a class='nav-link active' id='earnings-tab' data-bs-toggle='tab' href='#earnings' role='tab' aria-controls='earnings' aria-selected='true'>Earnings</a>";
                $htmlContent .= "</li>";
                $htmlContent .= "<li class='nav-item'>";
                $htmlContent .= "<a class='nav-link' id='deductions-tab' data-bs-toggle='tab' href='#deductions' role='tab' aria-controls='deductions' aria-selected='false'>Deductions</a>";
                $htmlContent .= "</li>";
                $htmlContent .= "<li class='nav-item'>";
                $htmlContent .= "<a class='nav-link' id='incentives-tab' data-bs-toggle='tab' href='#incentives' role='tab' aria-controls='incentives' aria-selected='false'>Incentives</a>";
                $htmlContent .= "</li>";
                $htmlContent .= "</ul>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";

                $htmlContent .= "<div class='tab-content' id='myTabContent'>";

                $htmlContent .= "<div class='tab-pane fade show active' id='earnings' role='tabpanel' aria-labelledby='earnings-tab'>";
                $htmlContent .= "<!-- Content for Earnings tab -->";
                $htmlContent .= "<div class='container mt-4 col-10'>";

                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='basicPay' class='form-label'>Basic Pay</label>";
                $htmlContent .= "<input type='text' name='basicPay' class='form-control' id='basicPay' value='{$row_earnings['basic_pay']}' readonly>";
                $htmlContent .= "</div>";
                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='regularHoliday' class='form-label'>Regular Holiday</label>";
                $htmlContent .= "<input type='text' name='regularHoliday' class='form-control' id='regularHoliday' value='{$row_earnings['reg_holiday']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='specialHoliday' class='form-label'>Special Holiday</label>";
                $htmlContent .= "<input type='text' name='specialHoliday' class='form-control' id='specialHoliday' value='{$row_earnings['spl_holiday']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='overtime' class='form-label'>Overtime</label>";
                $htmlContent .= "<input type='text' name='overtime' class='form-control' id='overtime' value='{$row_earnings['overtime']}' readonly>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='nightDifferential' class='form-label'>Night Differential</label>";
                $htmlContent .= "<input type='text' name='nightDifferential' class='form-control' id='nightDifferential' value='{$row_earnings['night_diff']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='regularHolidayNightDiff' class='form-label'>Regular Holiday Night Diff</label>";
                $htmlContent .= "<input type='text' name='regularHolidayNightDiff' class='form-control' id='regularHolidayNightDiff' value='{$row_earnings['reg_holiday_nightdiff']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='specialHolidayNightDiff' class='form-label'>Special Holiday Night Diff</label>";
                $htmlContent .= "<input type='text' name='specialHolidayNightDiff' class='form-control' id='specialHolidayNightDiff' value='{$row_earnings['spl_holiday_nightdiff']}' readonly>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='regHolidayOvertime' class='form-label'>Reg. Holiday Overtime</label>";
                $htmlContent .= "<input type='text' name='regHolidayOvertime' class='form-control' id='regHolidayOvertime' value='{$row_earnings['reg_holiday_ot']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='splHolidayOvertime' class='form-label'>Spl. Holiday Overtime</label>";
                $htmlContent .= "<input type='text' name='splHolidayOvertime' class='form-control' id='splHolidayOvertime' value='{$row_earnings['spl_holiday_ot']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='monthlyBonus' class='form-label'>Monthly Bonus</label>";
                $htmlContent .= "<input type='text' name='monthlyBonus' class='form-control' id='monthlyBonus' value='{$row_earnings['monthly_bonus']}' readonly>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='drd' class='form-label'>DRD</label>";
                $htmlContent .= "<input type='text' name='drd' class='form-control' id='drd' value='{$row_earnings['drd']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='payAdjustments' class='form-label'>Pay Adjustments</label>";
                $htmlContent .= "<input type='text' name='payAdjustments' class='form-control' id='payAdjustments' value='{$row_earnings['pay_adjustments']}' readonly>";
                $htmlContent .= "</div>";
                
                $htmlContent .= "<div class='col-md-4'>";
                $htmlContent .= "<label for='totalEarnings' class='form-label'>Total Earnings</label>";
                $htmlContent .= "<input type='text' name='totalEarnings' class='form-control' id='totalEarnings' value='{$row_earnings['total_earnings']}' readonly>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";

                $htmlContent .= "<!-- Next button -->";
                $htmlContent .= "<div class='row mb-3'>";
                $htmlContent .= "<div class='col-md-9'></div>"; // Placeholder column to align button to the right
                $htmlContent .= "<div class='col-md-3'>";
                $htmlContent .= "<button type='button' class='btn btn-primary w-100' onclick='goToNextTab()'>Next</button>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>";
                $htmlContent .= "</div>"; // Closing tab-pane fade show active div
                $htmlContent .= "</div>"; // Closing tab-content div
                $htmlContent .= "</div>"; // Closing container div

                  $htmlContent .= "<div class='tab-pane fade' id='deductions' role='tabpanel' aria-labelledby='deductions-tab'>";
                    $htmlContent .= "<!-- Content for Deductions tab -->";
                    $htmlContent .= "<div class='container mt-4 col-10'>";
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label for='philHealth' class='form-label'>PhilHealth Contributions</label>";
                    $htmlContent .= "<input type='text' name='philHealth' class='form-control' id='philHealth' value='{$row_deductions['philhealth_con']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label for='pagibig' class='form-label'>Pagibig Contribution</label>";
                    $htmlContent .= "<input type='text' name='pagibig' class='form-control' id='pagibig' value='{$row_deductions['pagibig_con']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label for='sss' class='form-label'>SSS Contribution</label>";
                    $htmlContent .= "<input type='text' name='sss' class='form-control' id='sss' value='{$row_deductions['sss_con']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";

                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label class='form-label'>Withholding Tax</label>";
                    $htmlContent .= "<div class='input-group mb-3'>";
                    $htmlContent .= "<div class='input-group-text'>";
                    $htmlContent .= "<input class='form-check-input mt-0' type='checkbox' value='' id='withholdingTax'  value='{$row_deductions['withholding_tax']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<input type='text' class='form-control' aria-label='Text input with checkbox'>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label for='absent' class='form-label'>Absent</label>";
                    $htmlContent .= "<input type='text' name='absent' class='form-control' id='absent' value='{$row_deductions['absent']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-4'>";
                    $htmlContent .= "<label for='otherDeductions' class='form-label'>CA/Other Deductions</label>";
                    $htmlContent .= "<input type='text' name='otherDeductions' class='form-control' id='otherDeductions' value='{$row_deductions['other_deductions']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-9'></div>";
                    $htmlContent .= "<div class='col-md-3'>";
                    $htmlContent .= "<label for='totalDeductions' class='form-label'>Total Deductions</label>";
                    $htmlContent .= "<input type='text' name='totalDeductions' class='form-control' id='totalDeductions' value='{$row_deductions['total_deductions']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-9'></div>";
                    $htmlContent .= "<div class='col-md-3'>";
                    $htmlContent .= "<div class='row'>";
                    $htmlContent .= "<div class='col-md-6 mb-2'>";
                    $htmlContent .= "<button type='button' class='btn btn-secondary w-100' onclick='goToPreviousTab()'>Back</button>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-6'>";
                    $htmlContent .= "<button type='button' class='btn btn-primary w-100' onclick='goToNextTab1()'>Next</button>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";

                        
                    $htmlContent .= "<div class='tab-pane fade' id='incentives' role='tabpanel' aria-labelledby='incentives-tab'>";
                    $htmlContent .= "<div class='container mt-4 col-10'>";
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-6'>";
                    $htmlContent .= "<label for='philHealth' class='form-label'>Incentives</label>";
                    $htmlContent .= "<input type='text' name='philHealth' class='form-control' id='philHealth' alue='{$row_incentives['incentives']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-6'>";
                    $htmlContent .= "<label for='pagibig' class='form-label'>Others</label>";
                    $htmlContent .= "<input type='text' name='pagibig' class='form-control' id='pagibig' value='{$row_incentives['others']}' readonly>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-9'></div>"; // Placeholder column to align "Total Deductions" to the right
                    $htmlContent .= "<div class='col-md-3'>";
                    
                    $htmlContent .= "<label for='totalIncome' class='form-label'>Total Incentives</label>";
                    $htmlContent .= "<input type='text' name='totalIncome' class='form-control' id='totalIncome_id' placeholder='PHP 0.00' value='{$row_incentives['total_incentives']}' readonly>";
                    $htmlContent .= "</div>";
                    
                    $htmlContent .= "<label for='totalEarnings' class='form-label'>Total Earnings</label>";
                    $htmlContent .= "<input type='text' name='totalEarnings' class='form-control' id='totalEarnings2_id' placeholder='PHP 0.00' value='{$row_earnings['total_earnings']}' readonly>";
                    
                    $htmlContent .= "<label for='totalDeductions' class='form-label'>Total Deductions</label>";
                    $htmlContent .= "<input type='text' name='totalDeductions' class='form-control' id='totalDeductions2_id' placeholder='PHP 0.00' value='{$row_deductions['total_deductions']}' readonly>";
                    
                    $htmlContent .= "<label for='totalNetpay' class='form-label'>Total Netpay</label>";
                    $htmlContent .= "<input type='text' name='totalNetpay' class='form-control' id='totalNetpay_id' placeholder='PHP 0.00' value='{$totalNetPay}' readonly>";


                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    
                    $htmlContent .= "<div class='row mb-3'>";
                    $htmlContent .= "<div class='col-md-9'></div>"; // Placeholder column to align buttons to the right
                    $htmlContent .= "<div class='col-md-3'>";
                    $htmlContent .= "<div class='row'>";
                    $htmlContent .= "<div class='col-md-6 mb-2'>";
                    $htmlContent .= "<button type='button' class='btn btn-secondary w-100' onclick='goToPreviousTab1()'>Back</button>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "<div class='col-md-6'>";
                    $htmlContent .= "<button type='submit' class='btn btn-primary w-100'>Save</button>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>";
                    $htmlContent .= "</div>"; // Closing tab-pane fade show active div
                    $htmlContent .= "</div>"; // Closing tab-content div
                    $htmlContent .= "</div>"; // Closing container div
                    $htmlContent .= "</div>"; // Closing tab-pane div
                    
                    

                    $htmlContent .= "</div>"; // Closing row div
                    $htmlContent .= "</div>"; // Closing container div
                    $htmlContent .= "</div>"; // Closing tab-pane div

        

                        $htmlContent .= "<script>
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
        </script>";
              
            }
            echo $htmlContent;
        }
            } 
        }
    }
    }
} else {
    echo "Earnings ID or Deductions ID is null.";
}



?>
