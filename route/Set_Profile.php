<?php
// Check if both first name, last name, and user role are set in the session
if(isset($_SESSION['firstname']) && isset($_SESSION['lastname']) && isset($_SESSION['middleinitial']) && isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['role']) && isset($_SESSION['position'])) {
    $firstname = $_SESSION['firstname'];
    $lastname = $_SESSION['lastname'];
    $middleinitial = $_SESSION['middleinitial'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $userRole = $_SESSION['role'];
    $position = $_SESSION['position'];

} else {
    // If any of the session variables are not set, set them to empty strings or default values
    $firstname = '';
    $lastname = '';
    $middleinitial = '';
    $username = '';
    $password = '';
    $userRole = ''; 
    $position = '';
}
?>
<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>

<script>
    // Function to delete a user via AJAX
    function deleteUser(id) {
        if (confirm('Are you sure you want to delete this user?')) {
            $.ajax({
                type: "POST",
                url: "functions/delete_user.php",
                data: { id: id },
                success: function(data){
                    location.reload();
                }
            });
        }
    }

    // Function to submit the form via AJAX
    function updateUser() {
        var firstname = $('#firstname').val().trim();
        var middleinitial = $('#middleinitial').val().trim();
        var lastname = $('#lastname').val().trim();
        var username = $('#username').val().trim();
        var password = $('#password').val().trim();

        // Custom validation
        if (firstname === "") {
            $('#firstname').addClass("is-invalid");
            return false; // Return false to indicate validation failure
        }
        // You can add similar validation for other fields if needed

        // Perform AJAX request if validation passes
        var id = <?php echo $_SESSION['user_management_id']; ?>; // Assuming this is the user ID
        $.ajax({
            type: "POST",
            url: "update_user.php",
            data: { id: id, firstname: firstname, middleinitial: middleinitial, lastname: lastname, username: username, password: password },
            success: function(data){
                alert("User updated successfully!");
                location.reload();
            }
        });
    }

    $(document).ready(function() {
        // Event listener for form submission
        $('#updateUserForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            updateUser(); // Call updateUser function
        });
    });
</script>


<div id="layoutSidenav_content">

<main>
<div class="container-fluid px-4">
            




        <!-- Second Card Body Content -->
        <div class="container col-10 mt-4">



        <div class="row justify-content-center align-items-center">
    <!-- Circle -->
    <div id="circleContainer" class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center mb-3" style="width: 100px; height: 100px;">
        <span class="fs-2" id="plusSymbol">+</span>
    </div>
    <!-- Change Picture Button -->
    <div class="mb-3 d-flex justify-content-center align-items-center">
    <input type="file" class="form-control" id="uploadInput" style="display: none;">
    <button class="btn btn-primary btn-sm" onclick="document.getElementById('uploadInput').click()">Change Picture</button>
</div>

</div>

<script>
    const uploadInput = document.getElementById('uploadInput');
    const circleContainer = document.getElementById('circleContainer');
    const plusSymbol = document.getElementById('plusSymbol');

    uploadInput.addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const imageSrc = e.target.result;
                circleContainer.style.backgroundImage = `url(${imageSrc})`;
                circleContainer.style.backgroundSize = 'cover';
                circleContainer.style.backgroundPosition = 'center';
                circleContainer.style.backgroundRepeat = 'no-repeat';
                // Hide the plus symbol
                plusSymbol.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    });
</script>

          <div class="row">
            <div class="col-md-4 mb-2 mt-2">
              <label for="firstname" class="form-label">Firstname</label>
              <input type="text" class="form-control" id="firstname" placeholder="" name="firstname" value="<?php echo $_SESSION['firstname']; ?>">
            </div>
            <div class="col-md-4 mb-2 mt-2">
              <label for="middleInitial" class="form-label">Middle Initial</label>
              <input type="text" class="form-control" id="middleinitial" placeholder="" name="middleinitial" value="<?php echo $_SESSION['middleinitial']; ?>">
            </div>
            <div class="col-md-4 mb-2 mt-2">
              <label for="lastname" class="form-label">Lastname</label>
              <input type="text" class="form-control" id="lastname" placeholder="" name="lastname" value="<?php echo $_SESSION['lastname']; ?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-1 mt-1">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" placeholder="" name="username" value="<?php echo $_SESSION['username']; ?>">
            </div>
            <div class="col-md-6 mb-1 mt-1">
              <label for="text" class="form-label">Password</label>
              <input type="text" class="form-control" id="password" placeholder="" name="password" value="<?php echo $_SESSION['password']; ?>">
            </div>
          </div>
          <div class="row">
          <?php
          // Include your database connection file
          include_once '../connection/database.php';

          // Fetch Title based on position_id from tbl_position table
          $role_id = $_SESSION['role'];
          $query = "SELECT user_role FROM tbl_user_role WHERE user_role_id = $role_id";
          $result = mysqli_query($conn, $query);
          ?>
          <div class="col-md-6 mb-1">
              <label for="user_role" class="form-label">User Role</label>
              <?php
              if ($result && mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $userRole = $row['user_role'];
                  // Display the position value in an input field
                  echo '<input type="text" class="form-control" id="user_role" placeholder="" name="user_role" value="' . $userRole . '" disabled>';
              } else {
                  // If no result found or query fails
                  echo '<input type="text" class="form-control" id="user_role" placeholder="" name="user_role" value="Role not found" disabled>';
              }
              ?>
          </div>

          <?php
          // Include your database connection file
          include_once '../connection/database.php';

          // Fetch Title based on position_id from tbl_position table
          $position_id = $_SESSION['position'];
          $query = "SELECT Title FROM tbl_position WHERE position_ID = $position_id";
          $result = mysqli_query($conn, $query);
          ?>
          <div class="col-md-6 mb-1">
              <label for="position" class="form-label">Position</label>
              <?php
              if ($result && mysqli_num_rows($result) > 0) {
                  $row = mysqli_fetch_assoc($result);
                  $position_title = $row['Title'];
                  // Display the position value in an input field
                  echo '<input type="text" class="form-control" id="position" placeholder="" name="position" value="' . $position_title . '" disabled>';
              } else {
                  // If no result found or query fails
                  echo '<input type="text" class="form-control" id="position" placeholder="" name="position" value="Position not found" disabled>';
              }
              ?>
          </div>



        </div>

          <!-- Buttons -->
          <div class="row mt-4">
            <div class="col-md-2 offset-md-4">
              <button type="button" class="btn btn-primary w-100">Save Changes</button>
            </div>
            <div class="col-md-2">
            <button type="button" class="btn btn-secondary w-100" onclick="redirectToIndex()">Close</button>

<script>
  function redirectToIndex() {
    window.location.href = 'index.php'; // Redirect to index.php
  }
</script>
            </div>
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
