<?php
session_start(); // Initialize the session

// Establish a connection to the database
include_once '../connection/database.php';

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Query to retrieve the current user's data, including role_id
$query = "SELECT *, user_role FROM tbl_user_management WHERE user_management_id = '$user_id'";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error in SQL query: " . mysqli_error($conn));
}

// Fetch the user data
$user_data = mysqli_fetch_assoc($result);

// Define the user role
$role_id = $user_data['user_role'];
$query_role = "SELECT user_role FROM tbl_user_role WHERE user_role_id = $role_id";
$result_role = mysqli_query($conn, $query_role);
if (!$result_role) {
    die("Error in SQL query: " . mysqli_error($conn));
}

if (mysqli_num_rows($result_role) > 0) {
    $row_role = mysqli_fetch_assoc($result_role);
    $userRole = $row_role['user_role'];
} else {
    $userRole = "Role not found";
}
?>


<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<style>
.circle-container {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  background-size: cover;
  background-position: center;
  margin: 0 auto 10px auto;
}

.btn-primary {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:hover {
  background-color: #0069d9;
  border-color: #0062cc;
}

.btn-primary:focus, .btn-primary.focus {
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.btn-primary.disabled, .btn-primary:disabled {
  background-color: #007bff;
  border-color: #007bff;
}

.btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active,
.show > .btn-primary.dropdown-toggle {
  background-color: #0062cc;
  border-color: #005cbf;
}

.btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle {
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.form-control.d-none {
  display: none;
}
</style>




<div id="layoutSidenav_content" style="top:40px">

<main>
    <div class="container-fluid px-4 col-lg-10">
    <form id="edit-profile-form" action="update_profile.php" method="post" enctype="multipart/form-data" style="margin-top:5%">
    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">


    <div class="row mb-4">
    <center>
        <div class="col-lg-6">
            <div class="circle-container" id="userImageContainer">
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
                    echo '<div class="circle-image" style="background-image: url(' . $user_image . ');"></div>';
                } else {
                    // Display the default image if no user image is available
                    echo '<div class="circle-image" style="background-image: url(' . $default_image_url . ');"></div>';
                }
                ?>
            </div>
            <label class="btn btn-primary mt-2 fw-bold" for="user_image">Upload Photo</label>
            <input type="file" class="form-control d-none" id="user_image" name="user_image">
        </div>
    </center>
</div>

<script>
    const uploadInput = document.getElementById('user_image');
    const circleContainer = document.getElementById('userImageContainer');

    <?php
    // Display the user's image if available, otherwise display the default image
    if (!empty($user_image)) {
        echo 'circleContainer.style.backgroundImage = \'url("' . $user_image . '")\';';
    } else {
        echo 'circleContainer.style.backgroundImage = \'url("' . $default_image_url . '")\';';
    }
    ?>

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
            };
            reader.readAsDataURL(file);
        }
    });
</script>





            
            <div class="row mb-3">
                <div class="col-lg-4">
                    <label for="firstname" class="form-label fw-bold">Firstname:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_data['firstname'];?>">
                </div>
                <div class="col-lg-4">
                    <label for="middleinitial" class="form-label fw-bold">Middle Initial:</label>
                    <input type="text" class="form-control" id="middleinitial" name="middleinitial" value="<?php echo $user_data['middleinitial'];?>">
                </div>
                <div class="col-lg-4">
                    <label for="lastname" class="form-label fw-bold">Lastname:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user_data['lastname'];?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="username" class="form-label fw-bold">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['username'];?>">
                </div>
                <div class="col-lg-6">
                  <label for="password" class="form-label fw-bold">Password:</label>
                  <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $user_data['password'];?>">
                      <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                          <i class="fas fa-eye"></i>
                      </button>
                  </div>
              </div>
              </div>

              <script>
                  document.getElementById('togglePassword').addEventListener('click', function() {
                      const passwordInput = document.getElementById('password');
                      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                      passwordInput.setAttribute('type', type);
                      this.querySelector('i').classList.toggle('fa-eye');
                      this.querySelector('i').classList.toggle('fa-eye-slash');
                  });
              </script>


          <div class="row">
          <?php
          // Include your database connection file
          include_once '../connection/database.php';

          // Fetch Title based on position_id from tbl_position table
          $role_id = $_SESSION['user_role'];
          $query = "SELECT user_role FROM tbl_user_role WHERE user_role_id = $role_id";
          $result = mysqli_query($conn, $query);
          ?>

          <div class="col-lg-6 mb-4 mt-1">
              <label for="user_role" class="form-label fw-bold">User Role</label>
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
          <div class="col-lg-6 mb-4 mt-1">
              <label for="position" class="form-label fw-bold">Position</label>
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

        <div class="d-flex justify-content-end mt-2">
    <button type="submit" class="btn btn-primary fw-bold">Save Changes</button>
    <button style="margin-left:10px;" type="button" class="btn btn-secondary fw-bold" onclick="window.location.href='index.php';">Close</button>
</div>


        </form>
    </div>
</main>



<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include Bootstrap Bundle (includes Popper.js) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
  $(document).ready(function() {
    $('#edit-profile-form').submit(function(event) {
      event.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        type: 'POST',
        url: 'update_profile.php',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) {
          // Display response message in a toast
          $('.toast-body').text(response);
          $('.toast').toast('show');
        }
      });
    });

    // Reload page when toast close button is clicked
    $('.btn-close').click(function() {
      location.reload();
    });

    // Reload page when Okay button is clicked
    $('.btn-okay').click(function() {
      location.reload();
    });
  });
</script>

<!-- Toast HTML -->

<div class="position-fixed top-50 start-50 translate-middle" style="z-index: 5">
  <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
    <div class="toast-header" style="background-color:#7EA1FF;">
      <img src="../assets/img/ireplyicon.png" class="rounded me-2" alt="..." style="width: 20px; height: 20px;">
      <strong class="me-auto" style="color:#070F2B">Set Profile Page</strong>
      <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="toast-body mt-3 mb-2" style="text-align: center; font-weight: bold;">
  </div>
  <div class="toast-icon d-flex justify-content-center">
      <i class="fa-solid fa-circle-check" style="color: #74C0FC; font-size: 50px;"></i>
    </div>
    <div class="toast-footer d-flex justify-content-center mt-2">
      <button style="margin-bottom: 25px; margin-top:10px;" type="button" class="btn btn-primary btn-okay fw-bold">okay</button>
    </div>
  </div>
</div>






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