<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>

<style>
        #datatablesSimple th {
            background-color: #BED7DC;
            text-align: center;
        }
        #datatablesSimple .action{
            width: 10px;
        }
</style>



<!-- Custom Script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

<div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                    <h5 class="mt-4 mb-4">Time Keeping</h5>       

                        <div class="card col-md-10 offset-1 mb-4 mt-4">

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th class="action">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        include "../connection/database.php";
                                        $query = "SELECT * FROM tbl_employee";
                                        $result = $conn->query($query);
                                        
                                        while ($data = mysqli_fetch_array($result)) {
                                    
                                        ?>
                                        <tr>
                                            <td><?php echo $data['firstname'] . " " . $data['lastname']; ?></td>
                                            <td>
                                            <button class="btn btn-primary more-details-btn" data-id="<?php echo $data['employee_id']; ?>"> 
                                            <i class="bi bi-eye"></i> </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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


