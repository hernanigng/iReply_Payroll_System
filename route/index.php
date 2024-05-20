<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="row">
                            <h4 class="mt-4 mb-5">Dashboard</h4>
                        </div>


                        
            <div class="row">
            
            

            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4 bg-gradient" style="height: 10rem;">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-users mr-2 iconsize"></i>
                        <span class="icontitle">USERS</span>
                        <span class="text-white ms-auto iconnum" style="font-size: 170%; font-weight: 700;">
                            <?php
                            include '../connection/database.php';

                            // Query to get the total number of users
                            $sql = "SELECT COUNT(user_management_id) as user_count FROM tbl_user_management";
                            $result = $conn->query($sql);

                            // Fetch the user count
                            $user_count = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $user_count = $row['user_count'];
                            }

                            $conn->close();

                            // Display the user count
                            echo $user_count;
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="user_management.php">View Details</a>
                    </div>
                </div>
            </div>





            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4 bg-gradient" style="height: 10rem;">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-briefcase mr-2 iconsize"></i>
                        <span class="icontitle">EMPLOYEES</span>
                        <span class="text-white ms-auto iconnum" style="font-size: 170%; font-weight: 700;">
                            <?php
                            include '../connection/database.php';

                            // Query to get the total number of users
                            $sql = "SELECT COUNT(employee_id) as user_count FROM tbl_employee";
                            $result = $conn->query($sql);

                            // Fetch the user count
                            $user_count = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $user_count = $row['user_count'];
                            }

                            $conn->close();

                            // Display the user count
                            echo $user_count;
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="viewEmployee.php">View Details</a>
                    </div>
                </div>
            </div>
                




            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4 bg-gradient" style="height: 10rem;">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-friends mr-2 iconsize"></i>
                        <span class="icontitle">CLIENTS</span>
                        <span class="text-white ms-auto iconnum" style="font-size: 170%; font-weight: 700;">
                            <?php
                            include '../connection/database.php';

                            // Query to get the total number of users
                            $sql = "SELECT COUNT(Client_id) as user_count FROM tbl_client";
                            $result = $conn->query($sql);

                            // Fetch the user count
                            $user_count = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $user_count = $row['user_count'];
                            }

                            $conn->close();

                            // Display the user count
                            echo $user_count;
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Clients.php">View Details</a>
                    </div>
                </div>
            </div>



            <div class="col-xl-3 col-md-3">
                <div class="card bg-primary text-white mb-4 bg-gradient" style="height: 10rem;">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-user-tie mr-2 iconsize"></i>
                        <span class="icontitle">POSITIONS</span>
                        <span class="text-white ms-auto iconnum" style="font-size: 170%; font-weight: 700;">
                            <?php
                            include '../connection/database.php';

                            // Query to get the total number of users
                            $sql = "SELECT COUNT(Position_id) as user_count FROM tbl_position";
                            $result = $conn->query($sql);

                            // Fetch the user count
                            $user_count = 0;
                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $user_count = $row['user_count'];
                            }

                            $conn->close();

                            // Display the user count
                            echo $user_count;
                            ?>
                        </span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Position.php">View Details</a>
                    </div>
                </div>
            </div>
            
            
                </div>
                    </div>
                    </div>
                    </div>
                </main>

            </div>
        </div>

        <?php include '../template/footer.php' ?>