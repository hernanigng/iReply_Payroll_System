<?php include '../connection/database.php'; ?>

<?php include '../template/header.php'; ?>

<?php include '../template/sidebar.php'; ?>

<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

<button type="button" class="btn btn-primary offset-10 mt-5" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New <i class="bi bi-plus"></i></button>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="insertUser" method="POST">
                    <div class="mb-3 row">
                        <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                        <input type="text" name="userFirstName" class="form-control" id="userFirstName_id">
                        <div class="error" style="color: red;"></div>

                        <!-- Middle Name Field -->
                        <label for="middleName" class="col-sm-2 col-form-label">Middle Initial</label>
                        <input type="text" name="userMiddleInitial" class="form-control" id="userMiddleInitial_id">
                        <div class="error" style="color: red;"></div>

                        <!-- Last Name Field -->
                        <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                        <input type="text" name="userLastName" class="form-control" id="userLastName_id">
                        <div class="error" style="color: red;"></div>

                        <!-- Username Field -->
                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <input type="text" name="createUsername" class="form-control" id="createUsername_id">
                        <div class="error" style="color: red;"></div>

                        <!-- Password Field -->
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="createPassword" class="form-control" id="createPassword_id">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordVisibility">
                                <i class="bi bi-eye"></i> <!-- Icon for show/hide password -->
                            </button>
                        </div>
                        <div class="error" style="color: red;"></div>

                        <!-- User Role Field -->
                        <label for="userRole" class="col-sm-2 col-form-label">User Role</label>
                        <div class="error" style="color: red;"></div>
                        <select class="form-select" name="createUserRole" aria-label="User Role Select">
                            <option selected disabled>Choose a Role</option>
                            <?php
                            // Fetch user roles from database
                            $sql = "SELECT user_role_id, user_role FROM tbl_user_role";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["user_role_id"] . '">' . $row["user_role"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $selectedRole = $_POST['createUserRole'];
                        }
                        ?>

                        <!-- Position Field -->
                        <label for="position" class="col-sm-2 col-form-label">Position</label>
                        <div class="error" style="color: red;"></div>
                        <select class="form-select" name="createPosition" aria-label="Position Select">
                            <option selected disabled>Choose a position</option>
                            <?php
                            // Fetch positions from database
                            $sql = "SELECT position_ID, Title FROM tbl_position";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row["position_ID"] . '">' . $row["Title"] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $selectedPositionID = $_POST['createPosition'];
                        }
                        ?>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="save" id="submitUser" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
    <div class="toast-header">
        <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
        <strong class="me-auto">Notification</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        New User Successfully Saved
    </div>
</div>

<!-- VIEW USER MODAL -->
<?php include 'um_modals/viewUser_modal.php'; ?>

<!-- EDIT USER MODAL -->
<?php include 'um_modals/editUser_modal.php'; ?>

<!-- User Update Toast Notification -->
<?php include 'um_modals/userUpdate_toast.php'; ?>

<?php include '../template/footer.php'; ?>
