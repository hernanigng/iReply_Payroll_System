<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


<div id="layoutSidenav_content">

            <main>
                <?php include "../connection/database.php";
                    
                    $query = "SELECT * FROM tbl_user";

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



<!-- VIEW USER MODAL -->
<div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="viewUserLabel">User Information</h5>
    </div>
            <div class="modal-body" style="margin-top: -10px;">
        
                  <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                    <span class="form-control" id="firstname"> </span>

                  <label for="middlename" class="col-sm-2 col-form-label">Middle Name</label>
                    <span class="form-control" id="middlename"> </span>

                  <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                    <span class="form-control" id="lastname"> </span>

                  <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <span class="form-control" id="username"> </span>

                  <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <span class="form-control" id="password"> </span>

                  <label for="userrole" class="col-sm-2 col-form-label">User Role</label>
                    <span class="form-control" id="userrole"> </span>

                  <label for="position" class="col-sm-2 col-form-label">Position</label>
                    <span class="form-control" id="position"> </span>

                </div>
                <div class="modal-footer">
                  <button class="btn btn-danger close" style="float: right; margin-top: 10px;" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="addButton">Create</button>
                 </div>
            </div>
        </div>
    </div>

    <script> 
 // VIEW USER SCRIPT

 function openModal(id) {
    //console.log();
        // Show the modal
        $('#viewUser').modal('show');
        // Switch to the default tab (personal) when opening the modal
        // Fetch employee details using AJAX
        $.ajax({
            url: 'functions/get_userId.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#firstname').text(response.firstname);
                $('#middlename').text(response.middlename);
                $('#lastname').text(response.lastname);
                $('#username').text(response.username);
                $('#password').text(response.password);
                $('#userrole').text(response.user_role);
                $('#position').text(response.position);
            }
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#viewUser').modal('hide');
    }

</script>



<script>
    // EDIT USER SCRIPT
    function openEditModal(id) {
        // Show the modal
        $('#editUser').modal('show');
        // Fetch employee details using AJAX
        $.ajax({
            url: 'functions/get_userId.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#userId').val(response.user_id);
                $('#edit_firstname').val(response.firstname);
                $('#edit_middlename').val(response.middlename);
                $('#edit_lastname').val(response.lastname);
                $('#edit_username').val(response.username);
                $('#edit_password').val(response.password);
                $('#edit_userRole').val(response.user_role);
                $('#edit_position').val(response.position);
            }   
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#editUser').modal('hide');
    }

   
</script>


<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="editUserLabel">User Information</h5>
    </div>
            <div class="modal-body" style="margin-top: -10px;">

                        <input type="hidden" name="userId" class="form-control" id="userId">
        
                        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                        <input type="" class="form-control" id="edit_firstname">
                        
                        <label for="middlename" class="col-sm-2 col-form-label">Middle Name</label>
                        <input type="" class="form-control" id="edit_middlename">

                        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <input type="" class="form-control" id="edit_lastname">

                        <label for="username" class="col-sm-2 col-form-label">Username</label>
                        <input type="" class="form-control" id="edit_username">

                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                         <input type="" class="form-control" id="edit_password">

                        <label for="userRole" class="col-sm-2 col-form-label">User Role</label>
                        <input type="" class="form-control" id="edit_userRole">

                        <label for="position" class="col-sm-2 col-form-label">Position</label>
                        <input type="" class="form-control" id="edit_position">

                </div>
                <div class="modal-footer">
                  <button class="btn btn-danger close" style="float: right; margin-top: 10px;" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="updateButton">Update</button>
                 </div>
            </div>
        </div>
    </div>


    <script>
    // UPDATE USER SCRIPT
$(document).ready(function() {
    // Attach click event listener to the Update button
    $('#updateButton').click(function() {
        // Retrieve the employee ID from the hidden input field
        var userId = $('#userId').val();

        // Check if employee ID is empty or not
        if (userId === '') {
            console.error('User ID is missing.');
            return; // Stop execution if employee ID is missing
        }

        // Call the updateEmployee function with the employee ID
        updateUser(userId);
    });

    // Define the updateEmployee function here
    function updateUser(userId) {
        // Your existing updateEmployee function code goes here
        // Retrieve the updated data from the form fields
        var userId = $('#userId').val();
        var firstname = $('#edit_firstname').val();
        var middlename = $('#edit_middlename').val();
        var lastname = $('#edit_lastname').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        var userRole = $('#edit_userRole').val();
        var position = $('#edit_position').val();


        // Create a JSON object with the updated data
        var updatedData = {
            user_id: userId,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            username: username,
            password: password,
            user_role: userRole,
            position: position
            
        };

        // Perform AJAX request to update employee data
        $.ajax({
            url: 'functions/update_user.php',
            type: 'POST',
            data: updatedData,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                if (response.success) {
                    // Display toast notification
                    var updateToast = new bootstrap.Toast($('#updateToast'));
                    updateToast.show();
                    
                    // Optionally hide the modal
                    closeModal();
                } else {
                    // If update failed, display error message
                    console.error(response.message);
                }
            },
        });
    }
});
</script>

<!-- User Update Toast Notification -->
<div class="toast position-fixed top-50 start-50 translate-middle" id="updateToast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
            <div class="toast-header">
                <img src="../assets/img/ireplyicon.png" class="" alt="..." width="30" height="30">
                <strong class="me-auto">Notification</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
               User Successfully Updated
            </div>
        </div>
        <div class="modal-footer"> </div>

<?php include '../template/footer.php' ?>