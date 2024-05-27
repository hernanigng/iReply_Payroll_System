<?php include '../connection/session.php' ?>
<?php include '../template/header.php' ?>
<?php include '../template/sidebar.php';

error_reporting(E_ALL);
ini_set('display_errors', 1); ?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    

<div id="layoutSidenav_content">

<main>
    <div class="container-fluid px-4">
    <h5 class="mt-4 mb-5 hc fw-bold"><i class="fa-solid fa-list-ul me-2"></i>Payroll List</h5>

        <div class="card mb-4 mt-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                List of Clients
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <label>Year</label>
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
                <div class="col-md-2 mb-4">
                    <label>Month</label>
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
            </div>
                   <div class="table-responsive">
                <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Employee Status</th>
                            <th>Earnings</th>
                            <th>Deductions</th>
                            <th>Incentives</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
include "../connection/database.php";

$query_tranx = "SELECT * FROM tbl_payroll_tranx";
$result_tranx = $conn->query($query_tranx);

if ($result_tranx->num_rows > 0) {
    while ($row = $result_tranx->fetch_assoc()) {
        // Fetch corresponding employee, earnings, incentives, and deductions data
        $employee_id = $row['employee_id'];
        $earnings_id = $row['earnings_id'];
        $incentives_id = $row['incentives_id'];
        $deductions_id = $row['deductions_id'];
        $netPay_id = $row['netPay_id'];

        // Fetch employee data
        $query_employee = "SELECT firstname, lastname, employment_status FROM tbl_employee WHERE employee_id = '$employee_id'";
        $result_employee = $conn->query($query_employee);
        $employee_name = "N/A";
        $employee_status = "N/A";

        if ($result_employee && $result_employee->num_rows > 0) {
            $employee_row = $result_employee->fetch_assoc();
            $employee_name = htmlspecialchars($employee_row['firstname'] . ' ' . $employee_row['lastname']);
            $employee_status = htmlspecialchars($employee_row['employment_status']);
            // Debugging output
        } else {
            echo "Error fetching employee data: " . $conn->error;
        }
        
        // Fetch earnings data
        $query_earnings = "SELECT total_earnings FROM tbl_earnings WHERE earnings_id = '$earnings_id'";
        $result_earnings = $conn->query($query_earnings);
        $total_earnings = $result_earnings && $result_earnings->num_rows > 0 ? htmlspecialchars($result_earnings->fetch_assoc()['total_earnings']) : "N/A";

        // Fetch deductions data
        $query_deductions = "SELECT total_deductions FROM tbl_deductions WHERE deductions_id = '$deductions_id'";
        $result_deductions = $conn->query($query_deductions);
        $total_deductions = $result_deductions && $result_deductions->num_rows > 0 ? htmlspecialchars($result_deductions->fetch_assoc()['total_deductions']) : "N/A";

        // Fetch incentives data
        $query_incentives = "SELECT total_incentives FROM tbl_incentives WHERE incentives_id = '$incentives_id'";
        $result_incentives = $conn->query($query_incentives);
        $total_incentives = $result_incentives && $result_incentives->num_rows > 0 ? htmlspecialchars($result_incentives->fetch_assoc()['total_incentives']) : "N/A";

        // Output the table row
        echo "<tr>";
        echo "<td>$employee_name</td>";
        echo "<td>$employee_status</td>";
        echo "<td>$total_earnings</td>";
        echo "<td>$total_deductions</td>";
        echo "<td>$total_incentives</td>";
        echo "<td><center><button class='btn btn-primary' data-netPay_id='$netPay_id'>More Details</button></center></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No data available</td></tr>";
}
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</main>

<!-- Modal -->
<div class="modal" id="detailsModal">
  <div class="modal-dialog" style="width: 70%; max-width: none;">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Details</h4>
      </div>
      <!-- Modal Body -->
      <div class="modal-body" id="modalBody">
        <!-- Modal body content here -->
      </div>
    </div>
  </div>
</div>



</main>





      </div>
    </div>
  </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
 <!-- Include DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


<script>
 document.addEventListener('DOMContentLoaded', function() {
    var table = new simpleDatatables.DataTable("#datatablesSimple");

    function fetchFilteredData() {
    var year = document.getElementById('yearFilter').value;
    var month = document.getElementById('monthFilter').value;

   // console.log("Fetching data for Year:", year, "Month:", month);

    fetch('functions/fetch_payroll_data.php?year=' + year + '&month=' + month)
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to fetch data');
            }
            return response.text();
        })
        .then(data => {
            //console.log("Received data from server:", data);
            // Destroy existing DataTable instance
            if (table) {
                table.destroy();
            }
            // Update table rows
            document.getElementById('datatablesSimple').innerHTML = data;
            // Reinitialize DataTable
            table = new simpleDatatables.DataTable("#datatablesSimple");
            //console.log("Table updated with new data");
        })
        .catch(error => {
            //console.error('Error fetching data:', error);
            // Handle error (e.g., display error message)
        });
}

document.getElementById('yearFilter').addEventListener('change', fetchFilteredData);
document.getElementById('monthFilter').addEventListener('change', fetchFilteredData);

fetchFilteredData(); // Initial data fetch



        // Event listener for 'More Details' buttons
        $(document).on('click', '.btn-primary', function() {
            var netPayId = $(this).data('netpay_id');
            $.ajax({
                type: 'POST',
                url: 'functions/fetch_payroll_details.php',
                data: { netPay_id: netPayId },
                success: function(response) {
                    $('#modalBody').html(response);
                    $('#detailsModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error("Error:", error);
                }
            });
        });

        // Show the modal

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





