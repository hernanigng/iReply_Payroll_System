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
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($employee = $result_employee->fetch_assoc()) {
                            // Fetch corresponding earnings for the current employee
                            $earnings = $result_earnings->fetch_assoc();
                            echo "<tr>";
                            echo "<td>" . $employee['firstname'] . "</td>"; // Display employee name
                            // Check if earnings data is available
                            if ($earnings !== null) {
                                // Display earnings, deductions, and incentives
                                echo "<td>" . $earnings['basic_pay'] . "</td>"; // Adjust this according to your database structure
                                echo "<td>" . $earnings['basic_pay'] . "</td>"; // Adjust this according to your database structure
                                echo "<td>" . $earnings['basic_pay'] . "</td>"; // Adjust this according to your database structure
                            } else {
                                // If no earnings data available, display empty cells
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td></td>";
                            }
                            echo "<td><center><button class='btn btn-primary'>More Details</button></center></td>"; // Button for more details
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