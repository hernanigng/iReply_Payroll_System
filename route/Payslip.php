<?php include '../connection/session.php' ?>
<?php include '../template/header.php' ?>
<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<div id="layoutSidenav_content">
   <main>

   <script>
    // Define formatDate function to format date string
    function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long' }; // Formatting options to display year and month
    return date.toLocaleDateString('en-US', options);
}
    $(document).ready(function() {
        // Function to apply filter
        function applyFilter() {
            var year = $('#yearFilter').val();
            var month = $('#monthFilter').val();

            // AJAX request to fetch filtered data
            $.ajax({
                url: 'functions/get_payslipDate.php',
                method: 'GET',
                data: {
                    year: year,
                    month: month
                },
                success: function(response) {
                    console.log(response);
                    try {
                        // Parse the JSON response
                        var filteredData = JSON.parse(response);

                        // Clear the table body
                        $('#datatablesSimple tbody').empty();

                        // Check if data is returned
                        if (filteredData.length > 0) {
                            // Iterate through the filtered data and append rows to the table
                            $.each(filteredData, function(index, row) {
                                var html = "<tr>";
                                html += "<td>" + row['firstname'] + " " + row['lastname'] + "</td>";
                                html += "<td>" + formatDate(row['periodcov_to']) + "</td>";
                                html += "<td><button type='button' class='btn btn-primary view' data-id='" + row['netPay_id'] + "' data-empId='" + row['employee_id'] + "'><i class='bi bi-eye'></i></button></td>";
                                html += "</tr>";
                                $('#datatablesSimple tbody').append(html);
                            });
                        } else {
                            // If no data, show a message or handle accordingly
                            var html = "<tr><td colspan='3'>No data available for the selected period</td></tr>";
                            $('#datatablesSimple tbody').append(html);
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", status, error);
                }
            });
        }

        // Apply filter when the year or month select elements change
        $('#yearFilter, #monthFilter').change(function() {
            applyFilter();
        });

        // Event listener for the view button
        $(document).on('click', '.view', function() {
            var netPay_id = $(this).data('id');
            var employee_id = $(this).data('empid');

            // Redirect to the employee_attendance.php page with the employee ID as a query parameter
            window.location.href = 'viewPayslip.php?netPay_id=' + netPay_id + '&employee_id=' + employee_id;
        });
    });
</script>

<div class="container-fluid px-4">

    <h5 class="mt-4 mb-5 hc fw-bold"><i class="fa-solid fa-file-invoice-dollar me-2"></i>Payslip Page</h5>

        <div class="container mt-4">
            <div class="row">
                <div class="col-md-2">
                    <label> Year </label>
                    <select class="form-select" id="yearFilter">
                        <?php
                        $currentYear = date('Y');
                        for ($year = 2020; $year <= $currentYear; $year++) {
                            echo '<option value="' . $year . '">' . $year . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label> Month </label>
                    <select class="form-select" id="monthFilter">
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
            </div>
        </div>

    <div class="container-fluid px-4">
        <div class="card mb-4 mt-4">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        include "../connection/database.php";
                        $query = "SELECT
                                    e.firstname, 
                                    e.lastname,
                                    p.*
                                  FROM tbl_payroll_tranx p
                                  JOIN 
                                     tbl_employee e ON p.employee_id = e.employee_id
                                  ";
                        $result = $conn->query($query);
                        
                        while ($data = mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $data['firstname']. " ". $data['lastname']; ?></td>
                            <td><?php echo date('F, Y', strtotime($data['periodcov_to'])); ?></td>
                            <td>
                                <center>
                                <button class="btn btn-primary view" data-id="<?php echo $data['netPay_id']; ?>" data-empid="<?php echo $data['employee_id']; ?>"> 
                                    <i class="bi bi-eye"></i> 
                                </button>
                                </center>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
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

<?php include '../template/footer.php' ?>
