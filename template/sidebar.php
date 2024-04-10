<?php
// Check if both first name, last name, and user role are set in the session
if(isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['role'])) {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $userRole = $_SESSION['role'];
} else {
    // If any of the session variables are not set, set them to empty strings or default values
    $firstname = '';
    $lastname = '';
    $userRole = ''; // You can set a default value here if needed
}
?>


<div id="layoutSidenav">
    <div id="layoutSidenav_nav">

        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">


            <div class="sb-sidenav-header">
                <div class="profile">
                    <img src="../assets/img/sm.jpg" alt="Image" class="img-fluid">
                    <h3 class="name"><?php echo $firstname . ' ' . $lastname; ?></h3>
                    <a href="../route/profile.php" class="option">Set Profile</a>
                </div>
            </div>

                    <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Home</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <div class="sb-sidenav-menu-heading">Management</div>

                        <!-- Integration of the provided code before "Employee Management" menu item -->
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts1" aria-expanded="false" aria-controls="collapseLayouts1" onclick="toggleCollapse('collapseLayouts1')">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i></div>
                        Administration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts1" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="../route/viewEmployee.php">Employee Masterlist</a>
                            <a class="nav-link" href="../route/Clients.php">Client</a>
                            <a class="nav-link" href="../route/Position.php">Position</a>
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts2" aria-expanded="false" aria-controls="collapseLayouts2" onclick="toggleCollapse('collapseLayouts2')">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-calculator"></i></div>
                        Employee Payroll
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="layout-static.html">Payroll</a>
                            <a class="nav-link" href="layout-sidenav-light.html">Payroll</a>
                        </nav>
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

                        <a class="nav-link" href="../route/user_management.php">
                        <div class="sb-nav-link-icon"><i class="fa-regular fa-user"></i></div>
                        User Management
                        </a>
                        <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-chart-line"></i></div>
                        Activity Logs
                        </a>


                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>

                                </nav>
                            </div>
                        </div>
                    </div>

                    <div class="sb-sidenav-footer">
                        <a href="../connection/logout.php" class="option">
                            Sign out
                            <i class="fas fa-cog" style="float: right; margin-top:5px;"></i>
                    <!-- Settings icon -->
                        </a>
                        <?php if ($userRole == '1'): ?>
                            <p class="role">Administrator</p>
                        <?php elseif ($userRole == '2'): ?>
                            <p class="role">Accountant</p>
                        <?php endif; ?>
                    </div>


                    
                </nav>
            </div>
            
