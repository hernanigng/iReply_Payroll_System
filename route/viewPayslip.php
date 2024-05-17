<?php include '../connection/session.php'; ?>
<?php include '../template/header.php'; ?>
<?php include '../template/sidebar.php'; ?>
<?php
include '../connection/database.php';

// Initialize the $data variable
$data = array();

// Check if netPay_id is set in the URL
if (isset($_GET['netPay_id']) && isset($_GET['employee_id'])) {
    // Get the netPay ID from the URL
    $netPay_id = $_GET['netPay_id'];
    $employee_id = $_GET['employee_id'];

    // Prepare the query to fetch the employee based on ID
    $query = "
    SELECT 
        e.firstname, 
        e.lastname,
        e.employee_id,
        e.daily_rate,
        e.client,
        e.position,
        p.*,
        earn.*, -- Selecting all columns from tbl_earnings
        ded.*,   -- Selecting all columns from tbl_deductions
        inc.*   -- Selecting all columns from tbl_deductions
    FROM 
        tbl_payroll_tranx p
    JOIN 
        tbl_employee e ON p.employee_id = e.employee_id
    JOIN 
        tbl_earnings earn ON p.earnings_id = earn.earnings_id -- Join with tbl_earnings
    JOIN 
        tbl_deductions ded ON p.deductions_id = ded.deductions_id -- Join with tbl_deductions
    JOIN 
        tbl_incentives inc ON p.incentives_id = inc.incentives_id -- Join with tbl_incentives
    WHERE 
        p.netPay_id = '$netPay_id'
";

    $result = $conn->query($query);
    
    $data = mysqli_fetch_array($result);
}
?>

<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<style>
    .bordered-table div {
        border: 1px solid #dee2e6;
        padding: 8px;
    }
    .bordered-table .card-body div {
        display: flex;
        justify-content: space-between;
    }
    .bordered-table .card-body div label {
        margin: 0;
    }
    .payslip_head p{
    margin:1px;
    }
</style>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-9">
            <h3 class="mt-4">Pay Slip</h3>
        </div>
        <div class="col-md-3 text-end">
            <h2 class="mt-4"> <i class="bi bi-printer" id="printButton" style="cursor: pointer;"></i> </h2>
        </div>
    </div>
            <div class="card mb-4 mt-4">
                <div class="card-header payslip_head">
                    <div class="text-center">
                        <p class="fw-bold">iReply Back Office Inc.</p>
                        <p class="fw-bold">Negros First Cyber Center, Lacson-Hernaez Street,</p>
                        <p class="fw-bold">Bacolod City, Negros Occidental, Philippines, 6100</p>
                    </div>
                    <br>
                    <div class="text-center">
                        <p class="fw-bold">Employee Pay Slip</p>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Employee Name:</label>
                            <span><?php echo htmlspecialchars($data['firstname'] . " " . $data['lastname']); ?></span>
                        </div>
                        <div class="col-md-6">
                            <label>Pay Period:</label>
                            <span><?php echo date('F j, Y', strtotime($data['periodcov_to'])); ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Employee Number:</label>
                            <span id="employeeId"><?php echo htmlspecialchars($data['employee_id']); ?></span>
                        </div>
                        <div class="col-md-6">
                            <label>Period Covered:</label>
                            <span><?php echo date('F j, Y', strtotime($data['periodcov_from'])) . "-" . date('F j, Y', strtotime($data['periodcov_to'])); ?></span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label>Department:</label>
                            <span id="client_name"></span>
                        </div>
                        <div class="col-md-6">
                            <label>Position:</label>
                            <span id="position_name"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4 mt-4 bordered-table">
                        <div class="card-header fw-bold" style="background: skyblue;">Earnings</div>
                        <div class="card-body">
                            <div>
                                <label>Basic Pay:</label>
                                <span><?php echo htmlspecialchars($data['daily_rate']); ?></span>
                            </div>
                            <div>
                                <label>Reg. Holiday:</label>
                                <span><?php echo htmlspecialchars($data['reg_holiday']); ?></span>
                            </div>
                            <div>
                                <label>Spl. Holiday:</label>
                                <span><?php echo htmlspecialchars($data['spl_holiday']); ?></span>
                            </div>
                            <div>
                                <label>Overtime:</label>
                                <span><?php echo htmlspecialchars($data['overtime']); ?></span>
                            </div>
                            <div>
                                <label>Night Diff:</label>
                                <span><?php echo htmlspecialchars($data['night_diff']); ?></span>
                            </div>
                            <div>
                                <label>Reg. Holiday Night Diff:</label>
                                <span><?php echo htmlspecialchars($data['reg_holiday_nightdiff']); ?></span>
                            </div>
                            <div>
                                <label>Spl. Holiday Night Diff:</label>
                                <span><?php echo htmlspecialchars($data['spl_holiday_nightdiff']); ?></span>
                            </div>
                            <div>
                                <label>Reg. Holiday Overtime:</label>
                                <span><?php echo htmlspecialchars($data['reg_holiday_ot']); ?></span>
                            </div>
                            <div>
                                <label>Spl. Holiday Overtime:</label>
                                <span><?php echo htmlspecialchars($data['spl_holiday_ot']); ?></span>
                            </div>
                            <div>
                                <label>Monthly Bonus:</label>
                                <span><?php echo htmlspecialchars($data['monthly_bonus']); ?></span>
                            </div>
                            <div>
                                <label>DRD:</label>
                                <span><?php echo htmlspecialchars($data['drd']); ?></span>
                            </div>
                            <div>
                                <label>Pay Adjustments:</label>
                                <span><?php echo htmlspecialchars($data['pay_adjustments']); ?></span>
                            </div>
                            <br>
                            <div style="background: yellow;">
                                <label>Totals Earnings:</label>
                                <span><?php echo htmlspecialchars($data['total_earnings']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card mb-4 mt-4 bordered-table">
                        <div class="card-header fw-bold" style="background: skyblue;">Deductions</div>
                        <div class="card-body">
                            <div>
                                <label>PhilHealth Contribution:</label>
                                <span><?php echo htmlspecialchars($data['philhealth_con']); ?></span>
                            </div>
                            <div>
                                <label>Pag-ibig Contribution:</label>
                                <span><?php echo htmlspecialchars($data['pagibig_con']); ?></span>
                            </div>
                            <div>
                                <label>SSS Contribution:</label>
                                <span><?php echo htmlspecialchars($data['sss_con']); ?></span>
                            </div>
                            <div>
                                <label>Withholding Tax:</label>
                                <span><?php echo htmlspecialchars($data['withholding_tax']); ?></span>
                            </div>
                            <div>
                                <label>Absent:</label>
                                <span><?php echo htmlspecialchars($data['absent']); ?></span>
                            </div>
                            <div>
                                <label>CA/ Other Deductions:</label>
                                <span><?php echo htmlspecialchars($data['other_deductions']); ?></span>
                            </div>
                            <br>
                            <div style="background: yellow;">
                                <label>Total Deductions:</label>
                                <span><?php echo htmlspecialchars($data['total_deductions']); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 mt-4 bordered-table">
                    <div class="card-header fw-bold" style="background: skyblue;">Bonuses/Incentives/Others</div>
                    <div class="card-body">
                        <div>
                            <label>Incentives:</label>
                            <span><?php echo htmlspecialchars($data['incentives']); ?></span>
                        </div>
                        <div>
                            <label>Others:</label>
                            <span><?php echo htmlspecialchars($data['others']); ?></span>
                        </div>
                        <br>
                        <div style="background: yellow;">
                            <label>Total:</label>
                            <span><?php echo htmlspecialchars($data['total_incentives']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 mt-4">
    <div class="row">
        <div class="col-md-10 fw-bold">
            <label>Take Home Pay:</label>
        </div>
        <div class="col-md-2" style="background: yellow;">
            <span><?php echo $data['total_netPay']; ?></span>
        </div>
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
$(document).ready(function() {
    var id = $('#employeeId').text().trim();  // Ensure PHP variable is properly echoed and trimmed

    $.ajax({
        url: 'functions/get_employeeId.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function(response) {
            console.log(response); // Log response for debugging
            
            if (!response.error) {
            
                // AJAX call to get the client details
                $.ajax({
                    url: 'functions/get_client.php',
                    type: 'POST',
                    data: { client_id: response.client },
                    dataType: 'json',
                    success: function(clientResponse) {
                        console.log(clientResponse);
                        $('#client_name').text(clientResponse.client_name);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching client details:', error);
                    }
                });
                
                // AJAX call to get the position details
                $.ajax({
                    url: 'functions/get_position.php',
                    type: 'POST',
                    data: { position_id: response.position },
                    dataType: 'json',
                    success: function(positionResponse) {
                        console.log(positionResponse);
                        $('#position_name').text(positionResponse.position_name);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching position details:', error);
                    }
                });
            } else {
                console.error('Error:', response.error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching employee details:', error);
        }
    });
});


    $(document).ready(function() {
        // Print function when the printer icon is clicked
        $('#printButton').click(function() {
            window.print();
        });
    });

</script>

<?php include '../template/footer.php'; ?>
