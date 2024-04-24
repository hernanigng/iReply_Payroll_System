<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>



<div id="layoutSidenav_content">

<?php
include "../connection/database.php";

// Fetch data from tbl_employee
$query_employee = "SELECT * FROM tbl_employee";
$result_employee = $conn->query($query_employee);

// Fetch data from tbl_earnings
$query_earnings = "SELECT * FROM tbl_earnings";
$result_earnings = $conn->query($query_earnings);
?>

                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Payroll List Page</h3>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Clients
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Employee Name</th>
                                            <th>Earnings</th>
                                            <th>Deductions</th>
                                            <th>Incentives</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       while ($employee = $result_employee->fetch_assoc()) {
                                     echo "<tr>";
                                     //echo "<td>" . $employee['employee_id'] . "</td>";
                                     echo "<td>" . $employee['firstname'] . $employee['firstname'] . "</td>";
                                       }
                                       while ($earnings = $result_earnings->fetch_assoc()) {
                                     echo "<td>" . $earnings['basic_pay'] . "</td>";
                                     echo "<td>" . $earnings['basic_pay'] . "</td>";
                                     echo "<td>" . $earnings['basic_pay'] . "</td>";
                                     echo "<td>
                                     <button class='btn btn-primary'> More Details </button>
                                     </td>";
                                     echo "</tr>";
                                     
                                       }
                                    ?>
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