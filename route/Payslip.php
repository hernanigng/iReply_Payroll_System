<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php'?>

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
    var date = new Date(dateString);
    var options = { year: 'numeric', month: 'short', day: 'numeric' };
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
                            html += "<td>" + row['netPay_id'] + "</td>";
                            html += "<td>" + row['periodcov_from'] + " - " + row['periodcov_to'] + "</td>";
                            html += "<td><button type='button' class='btn btn-primary'><i class='bi bi-eye'></i></button></td>";
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
});
</script>


<div class="container-fluid px-4">
                        
    <div class="card mb-4 mt-4">
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
                                        $query = "SELECT * FROM tbl_payroll_tranx";
                                        $result = $conn->query($query);
                                        
                                        while ($data = mysqli_fetch_array($result)) {
                                    
                        ?>
                    <tr>
                        <td><?php echo $data['netPay_id']; ?></td>
                        <td><?php echo $data['periodcov_from'] . " " . $data['periodcov_to']; ?></td>
                        <td>
                        <button class="btn btn-primary"> 
                            <i class="bi bi-eye"></i> </button>
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
        </div>


<?php include '../template/footer.php' ?>



<script>
    $(document).ready(function() {
        // Get all the buttons with class 'more-details-btn'
        $('.more-details-btn').click(function() {
            // Get the employee ID from the data-id attribute
            var employeeId = $(this).data('id');

            // Redirect to the employee_attendance.php page with the employee ID as a query parameter
            window.location.href = 'employee_attendance.php?employee_id=' + employeeId;
        });
    });
</script>