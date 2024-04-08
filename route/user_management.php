<?php include '../connection/database.php'; ?>

<?php include '../template/header.php'; ?>

<?php include '../template/sidebar.php'; ?>

<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<div id="layoutSidenav_content">

            <main>
                <?php include "../connection/database.php";
                    
                    $query = "SELECT * FROM tbl_user_management";

                     $result = mysqli_query($conn, $query);

            // Check if the query executed successfully
                     if (!$result) {
            // Query execution failed, handle the error
                     echo "Error: " . mysqli_error($conn);
                    exit; // Stop further execution
             }

                    ?>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Users</h3>

                        <div>
                            <button id="addUser" class="btn btn-primary offset-10">Add User</button>
                        </div>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Users
                            </div>
                    
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Firstname</th>
                                            <th>Lastname</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>User Role</th>
                                            <th>Position</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while ($data = mysqli_fetch_array($result)) { ?>
                                        <tr id="<?php echo $data['user_id']; ?>">
                                            <td><?php echo $data['firstname']; ?></td>
                                            <td><?php echo $data['lastname']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['password']; ?></td>
                                            <td><?php echo $data['user_role']; ?></td>
                                            <td><?php echo $data['position']; ?></td>
                                            <td>
                                            <button class="btn btn-primary view" onclick="openModal('<?php echo $data['user_id'];?>')"> 
                                              <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-danger del">
                                              <i class="bi bi-trash"></i>
                                            </button>
                                            <button class="btn btn-warning edit" onclick="openEditModal('<?php echo $data['user_id'];?>')">
                                              <i class="bi bi-pencil"></i>
                                            </button>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
>>>>>>> Stashed changes
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


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h3 class="mt-4">Users</h3>
            <div>
                <button id="addUser" class="btn btn-primary offset-10">Add User</button>
            </div>
            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    List of Users
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Middle Initial</th>
                                <th>Lastname</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>User Role</th>
                                <th>Position</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Populate table rows with PHP -->
                            <?php
                            $query = "SELECT * FROM tbl_user_management";
                            $result = mysqli_query($conn, $query);
                            if (!$result) {
                                echo "Error: " . mysqli_error($conn);
                                exit;
                            }
                            while ($data = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $data['firstname'] . "</td>";
                                echo "<td>" . $data['middleinitial'] . "</td>";
                                echo "<td>" . $data['lastname'] . "</td>";
                                echo "<td>" . $data['username'] . "</td>";
                                echo "<td>" . $data['password'] . "</td>";
                                echo "<td>" . $data['user_role'] . "</td>";
                                echo "<td>" . $data['position'] . "</td>";
                                echo "<td>";
                                echo '<button class="btn btn-primary view" onclick="openModal(\'' . $data['user_management_id'] . '\')"> <i class="bi bi-eye"></i></button>';
                                echo '<button class="btn btn-danger del" data-user_management_id="<?php echo $data['user_management_id']; ?>">
                                                <i class="bi bi-trash"></i>
                                            </button>';
                                echo '<button class="btn btn-warning edit" onclick="openEditModal(\'' . $data['user_management_id'] . '\')"><i class="bi bi-pencil"></i></button>';
                                echo "</td>";
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


        <!-- Delete User Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete the user?
            </div>
            <div class="modal-footer">   
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
  $(document).on('click', '.del', function() {
        $('#confirmDeleteModal').modal('show');
        var userId = $(this).data('user_management_id'); // Retrieve employee_id using data() method
        console.log('userId');

        $('#confirmDeleteButton').data('user_management_id', userId);
    });

    $('#confirmDeleteButton').click(function() {
        var userId = $(this).data('user_management_id'); // Retrieve employeeId from data attribute
        
    var formData = $('#insertUser').serialize();
    
    formData += '&id=' + userId;
    
     $.ajax({
         type: 'POST',
         url: 'functions/getUserData.php',
         data: { id: userId },
         success: function(response) {
             console.log('Data inserted into tbl_archive');
             alert(response);
         },
         error: function(xhr, status, error) {
             console.error('Error inserting data into tbl_archive_user:', error);
         }
     });

        $.ajax({
            type: 'POST',
            url: 'functions/deleteUser.php',
            data: { id: userId },
            success: function(response) {
                alert(response);
                console.log('User deleted successfully');
                 window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Error deleting user:', error);
            }
        });

     
        $('#confirmDeleteModal').modal('hide');
});

</script>


<button type="button" class="btn btn-primary offset-10 mt-5" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New <i class="bi bi-plus"></i> </button>

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
                    <div id="error" style="color: red;"></div>
                    
                    <label for="middleName" class="col-sm-2 col-form-label">Middle Initial</label>
                    <input type="text" name="userMiddleInitial" class="form-control" id="userMiddleInitial_id">
                    <div id="error" style="color: red;"></div>

                    <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                    <input type="text" name="userLastName" class="form-control" id="userLastName_id">
                    <div id="error" style="color: red;"></div>

                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <input type="text" name="createUsername" class="form-control" id="createUsername_id">
                    <div id="error" style="color: red;"></div>

                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="input-group">
                        <input type="password" name="createPassword" class="form-control" id="createPassword_id">
                        <button type="button" class="btn btn-outline-secondary" id="togglePasswordVisibility">
                            <i class="bi bi-eye"></i> <!-- Icon for show/hide password -->
                        </button>
                    </div>                   
                    <div id="error" style="color: red;"></div>
                    
                    <label for="userRole" class="col-sm-2 col-form-label">User Role</label>
                    <div id="error" style="color: red;"></div>
                     <select class="form-select" name="createUserRole" aria-label="User Role Select">
                                <option selected disabled>Choose a Role</option>
                                <?php
                                    include "../connection/database.php";
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "SELECT user_role_id, user_role FROM tbl_user_role";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["user_role_id"] . '">' . $row["user_role"] . '</option>';
                                        }
                                    }

                                    $conn->close();
                                    ?>
                            </select>

                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $selectedRole = $_POST['createUserRole'];
                                    //echo "Selected Client ID: " . $selectedClientId;
                                }
                            ?>

                    <label for="position" class="col-sm-2 col-form-label">Position</label>
                    <div id="error" style="color: red;"></div> 
                    <select class="form-select" name="createPosition" aria-label="Position Select">
                            <option selected disabled>Choose a position</option>
                                <?php
                                    include "../connection/database.php";
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    $sql = "SELECT position_ID, Title FROM tbl_position";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row["position_ID"] . '">' . $row["Title"] . '</option>';
                                        }
                                    }

                                    $conn->close();
                                    ?>
                            </select>

                            <?php
                                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                    $selectedPositionID = $_POST['createPosition'];
                                    //echo "Selected Position: " . $selectedPositionID;
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


<script>

$(document).ready(function() {
    $('#addUser').click(function() {
        //console.log("Button clicked!"); // Add this line for debugging
        $('#addUserModal').modal('show');
    });

    $('#togglePasswordVisibility').click(function() {
        var passwordInput = $('#createPassword_id');
        var icon = $(this).find('i');

        // Toggle password visibility
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
            icon.removeClass('bi-eye').addClass('bi-eye-slash'); // Change icon to indicate hiding password
        } else {
            passwordInput.attr('type', 'password');
            icon.removeClass('bi-eye-slash').addClass('bi-eye'); // Change icon to indicate showing password
        }
    });

 
    document.getElementById('submitUser').addEventListener('click', function(event) {
        event.preventDefault();
          console.log("Button clicked"); 

        var inputFields = document.querySelectorAll('#insertUser input[type="text"], #insertUser input[type="date"], #insertUser select, #insertUser input[type="password"]');

        // Remove highlight from all input fields
        inputFields.forEach(function(inputField) {
            inputField.classList.remove('highlight');
        });

        // Check if any input field is blank
        var anyBlank = false;
        inputFields.forEach(function(inputField) {
            if (inputField.tagName.toLowerCase() === 'select') {
                // For select elements, check if the selected option is the default one
                if (inputField.selectedIndex === 0) {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                }
            } else {
                // For other input elements, check if the value is blank
                if (inputField.value.trim() === "") {
                    inputField.classList.add('highlight');
                    anyBlank = true;
                }
            }
        });

        // If any input field is blank, prevent further action
        if (anyBlank) {
            return;
        }

        var data = $('#insertUser').serialize();
        var url = "functions/insertUser.php";

        $.post(url, data, function(response) {
            console.log("Server Response:", response);
            alert(response);
            $('#addUserModal').modal('hide');
            $('.toast').toast('show');

            if (response.status === 'success') {
                // Construct the new row for the table
                var newRow = '<tr id="' + response.user_management_id + '">' +
                    '<td>' + response.firstname + '</td>' +
                    '<td>' + response.lastname + '</td>' +
                    '<td>' + response.username + '</td>' +
                    '<td>' + response.password + '</td>' +
                    '<td>' + response.user_role + '</td>' +
                    '<td>' + response.position + '</td>' +
                    '<td>' +
                    '<button class="btn btn-primary view" onclick="openModal(\'' + response.user_management_id + '\')"><i class="bi bi-eye"></i></button> ' +
                    '<button class="btn btn-danger del" data-user_management_id="' + response.user_management_id + '"><i class="bi bi-trash"></i></button> ' +
                    '<button class="btn btn-warning edit" onclick="openEditModal(\'' + response.user_management_id + '\')"><i class="bi bi-pencil"></i></button> ' +

                    '</td>' +
                    '</tr>';

                $('#datatablesSimple tbody').prepend(newRow);
            } else {
                // Handle error if insertion was not successful
                console.log("Error:", response.message);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.log("AJAX Error:", textStatus, errorThrown);
        });

    });


});

</script>


<!-- Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle"  role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-header">
            <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
            <strong class="me-auto">Notification</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
           New User Successfully Saved
        </div>
    </div>



<?php include '../template/footer.php'; ?>
