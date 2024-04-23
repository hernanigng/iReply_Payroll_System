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
                    <div class="container-fluid px-4">
                        
                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Employee Name
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th> </th>
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


