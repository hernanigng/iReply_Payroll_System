<?php

include "../connection/database.php";

// Check if user is logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Fetch user's first name and last name from the database based on user_id
    $query = "SELECT firstname, lastname FROM tbl_user_management WHERE user_management_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $userData = mysqli_fetch_assoc($result);

    // Check if user data is retrieved successfully
    if($userData) {
        $firstname = $userData['firstname'];
        $lastname = $userData['lastname'];
    } else {
        // If user data is not found, handle it accordingly
        $firstname = '';
        $lastname = '';
    }

    // Fetch user's role from the database or session based on user_id
    $query_role = "SELECT user_role FROM tbl_user_management WHERE user_management_id = ?";
    $stmt_role = mysqli_prepare($conn, $query_role);
    mysqli_stmt_bind_param($stmt_role, "i", $userId);
    mysqli_stmt_execute($stmt_role);
    $result_role = mysqli_stmt_get_result($stmt_role);
    $userData_role = mysqli_fetch_assoc($result_role);

    // Check if user role is retrieved successfully
    if($userData_role) {
        $userRole = $userData_role['user_role'];
    } else {
        // If user role is not found, handle it accordingly
        $userRole = ''; // or any default role you want to assign
    }
} else {
    // If user is not logged in, handle it accordingly
    $firstname = '';
    $lastname = '';
    $userRole = '';
}


$user_id = $_SESSION['user_id'] ?? null; // Retrieve user_id from 

mysqli_close($conn);
?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sb-sidenav-menu .nav-link');

        navLinks.forEach(link => {
            const linkPath = link.getAttribute('href');
            if (linkPath && currentPath.endsWith(linkPath)) {
                link.classList.add('active');

                const parentCollapse = link.closest('.collapse');
                if (parentCollapse) {
                    parentCollapse.classList.add('show');
                }
            }

            // Hide "User Management" link if user role is "Accountant"
            const userRole = '<?php echo $userRole; ?>';
            if (userRole === '2' && linkPath === 'user_management.php') {
                link.style.display = 'none';
            }
        });
    });
</script>

              

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">


        <div class="sb-sidenav-header bg-gradient">
            <div class="profile">
                <?php

                include '../connection/database.php';
                // Display the current user image
                $query_select_image = "SELECT user_image FROM tbl_user_management WHERE user_management_id = '$user_id'";
                $result_select_image = mysqli_query($conn, $query_select_image);
                $row_select_image = mysqli_fetch_assoc($result_select_image);
                $user_image = $row_select_image['user_image'];

                // Define the URL of the default image
                $default_image_url = 'https://i.pinimg.com/564x/4e/c0/b7/4ec0b7eec43ef896c8214aa291cde1f1.jpg';

                if (!empty($user_image)) {
                    echo '<div class="circle-container-sidebar" style="background-image: url(' . $user_image . ');"></div>';
                } else {
                    // Display the default image if no user image is available
                    echo '<div class="circle-container-sidebar" style="background-image: url(' . $default_image_url . ');"></div>';
                }
                ?>
                <h3 class="name"><?php echo $firstname . ' ' . $lastname; ?></h3>
                <a href="../route/Set_Profile.php" class="option">Set Profile</a>
            </div>
        </div>

                    <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Home</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-house"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Management</div>

                        <!-- Integration of the provided code before "Employee Management" menu item -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1" onclick="toggleCollapse('collapseLayouts1')">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Administration
                        <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-circle-chevron-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="viewEmployee.php">Employee Masterlist</a>
                            <a class="nav-link" href="Clients.php">Client</a>
                            <a class="nav-link" href="Position.php">Position</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2" onclick="toggleCollapse('collapseLayouts2')">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-calculator"></i></div>
                        Employee Payroll
                        <div class="sb-sidenav-collapse-arrow"><i class="fa-solid fa-circle-chevron-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="TimeKeeping.php">Time Keeping</a>
                            <a class="nav-link" href="Payroll_List.php">Payroll List</a>
                            <a class="nav-link" href="Payslip.php">Payslip</a>
                        </nav>
                    </div>


                        <a class="nav-link" href="user_management.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-id-card"></i></div>User Management
                        </a>
                        <a class="nav-link" href="test.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                        Activity Logs
                        </a>


                        </div>
                    </div>

                    <div class="sb-sidenav-footer bg-gradient">
                        <a href="../connection/logout.php" class="option">
                            Sign out
                        </a>
                        <?php if ($userRole == '1'): ?>
                            <p class="role">Administrator</p>
                        <?php elseif ($userRole == '2'): ?>
                            <p class="role">Accountant</p>
                        <?php endif; ?>
                    </div>

                    <script>
                        function toggleCollapse(id) {
                            const collapseElement = document.getElementById(id);
                            const isCollapsed = collapseElement.classList.contains('show');
                            if (isCollapsed) {
                                collapseElement.classList.remove('show');
                            } else {
                                collapseElement.classList.add('hide');
                            }
                        }
                    </script>
      
                </nav>
            </div>
            
