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

      <link rel="stylesheet" href="../assets/css/user_management_style.css">

      <style>
        #datatablesSimple th {

            background-color: #BED7DC;
        }
    </style>


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
                            <button type="button" class="btn btn-primary offset-10 mt-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Add New <i class="bi bi-plus"></i> </button>
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
                                        <th>First Name</th>
                                        <th>Middle Initial</th>
                                        <th>Last Name</th>
                                        <th>Username</th>
                                        <th>User Role</th>
                                        <th>Position</th>
                                        <th> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    include "../connection/database.php";

                                    $sql = "SELECT tbl_user_management.user_management_id,
                                                tbl_user_management.firstname,  
                                                tbl_user_management.middleinitial, 
                                                tbl_user_management.lastname, 
                                                tbl_user_management.username, 
                                                tbl_user_role.user_role, 
                                                tbl_position.Title
                                            FROM tbl_user_management 
                                            INNER JOIN tbl_user_role ON tbl_user_management.user_role = tbl_user_role.user_role_id
                                            INNER JOIN tbl_position ON tbl_user_management.position = tbl_position.position_ID";

                                    $result = mysqli_query($conn, $sql);

                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while ($data = mysqli_fetch_array($result)) { 
                                    ?>
                                        <tr id="<?php echo $data['user_management_id']; ?>">
                                            <td><?php echo $data['firstname']; ?></td>
                                            <td><?php echo $data['middleinitial']; ?></td>
                                            <td><?php echo $data['lastname']; ?></td>
                                            <td><?php echo $data['username']; ?></td>
                                            <td><?php echo $data['user_role']; ?></td>
                                            <td><?php echo $data['Title']; ?></td>
                                            <td>
                                                <center>
                                                <button class="btn btn-primary view" onclick="openModal('<?php echo $data['user_management_id'];?>')"> 
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button class="btn btn-danger del" data-user_management_id="<?php echo $data['user_management_id']; ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                                <button class="btn btn-warning edit" onclick="openPasswordModal('<?php echo $data['user_management_id'];?>')">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                </center>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>No data found</td></tr>";
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

 <!-- Toast Notification Delete -->
        <div class="toast position-fixed top-50 start-50 translate-middle"  role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               User Successfully Deleted
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
              $('.toast').toast('show');

                // Reload the page after a delay to allow the user to see the toast notification
            setTimeout(function() {
            window.location.reload();
            }, 3000); // A
                console.log('User deleted successfully');
                
            },
            error: function(xhr, status, error) {
                console.error('Error deleting user:', error);
            }
        });

     
        $('#confirmDeleteModal').modal('hide');
});

</script>

 

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
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="userFirstName" class="form-control" id="userFirstName_id">
                            <div id="error" style="color: red;"></div>
                        </div>
                        <div class="col-sm-6">
                            <label for="middleName" class="form-label">Middle Initial</label>
                            <input type="text" name="userMiddleInitial" class="form-control" id="userMiddleInitial_id" maxlength="1">
                            <div id="error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="userLastName" class="form-control" id="userLastName_id">
                            <div id="error" style="color: red;"></div>
                        </div>
                        <div class="col-sm-6">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="createUsername" class="form-control" id="createUsername_id">
                            <div id="error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="createPassword" class="form-control" id="createPassword_id">
                                <button type="button" class="btn btn-outline-secondary" id="togglePasswordVisibility">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <div id="error" style="color: red;"></div>
                        </div>
                        <div class="col-sm-6">
                            <label for="userRole" class="form-label">User Role</label>
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
                                }
                            ?>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-sm-6">
                            <label for="position" class="form-label">Position</label>
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
                                }
                            ?>
                        </div>
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
            //alert(response);
            $('#addUserModal').modal('hide');
            $('.toast').toast('show');

               $('.toast').on('hidden.bs.toast', function () {
            
                 $('.modal-backdrop').remove();
                          
                $('body').css('overflow', 'auto');
                        });

            if (response.status === 'success') {
                // Construct the new row for the table
                var newRow = '<tr id="' + response.user_management_id + '">' +
                    '<td>' + response.firstname + '</td>' +
                     '<td>' + response.middleinitial + '</td>' +
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


<!-- VIEW USER MODAL -->
<?php include 'um_modals/viewUser_modal.php'; ?>

<script>
    // EDIT EMPLOYEE SCRIPT

    function openPasswordModal(id) {
    $('#passwordModal').modal('show');

    $('#submitPassword').off('click').on('click', function() {
        var enteredPassword = $('#enteredPassword').val(); // Get the password entered by the user
        var username = "<?php echo $_SESSION['username']; ?>"; // Get the username stored in the session
        
        // Send an AJAX request to verify the password
        $.ajax({
            url: 'functions/verify_password.php',
            type: 'POST',
            data: {
                username: username,
                password: enteredPassword
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Password is correct, proceed with opening the edit modal
                    $('#passwordModal').modal('hide');
                    openEditModal(id);
                } else {
                    // Incorrect password, display error message
                    $('#passwordError').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX errors here
                console.error(xhr.responseText);
            }
        });
    });
}

</script>

<!-- PASSWORD MODAL -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn close" data-bs-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="enteredPassword">
                </div>
                <div id="passwordError" class="text-danger"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="submitPassword">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- EDIT USER MODAL -->
<?php include 'um_modals/editUser_modal.php'; ?>

<!-- User Update Toast Notification -->
<?php include 'um_modals/userUpdate_toast.php'; ?>

<?php include '../template/footer.php' ?>