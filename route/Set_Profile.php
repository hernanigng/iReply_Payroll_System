

<?php
session_start(); // Initialize the session

// Establish a connection to the database
include_once '../connection/database.php';

// Check connection
if (!$conn) {
  die("Connection failed: ". mysqli_connect_error());
}

// Retrieve the current user's ID from the session
$user_id = $_SESSION['user_id'];

// Query to retrieve the current user's data
$query = "SELECT * FROM tbl_user_management WHERE user_management_id = '$user_id'";
$result = mysqli_query($conn, $query);
$user_data = mysqli_fetch_assoc($result);

// display the current user's data in input fields
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
  margin: 0 auto 20px auto;
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




<div id="layoutSidenav_content">

<main>
    <div class="container-fluid px-4 col-lg-10">
<form id="edit-profile-form" action="update_profile.php" method="post" enctype="multipart/form-data">
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
                echo '<div class="circle-container" style="background-image: url(' . $user_image . ');"></div>';
            } else {
                // Display the default image if no user image is available
                echo '<div class="circle-container" style="background-image: url(' . $default_image_url . ');"></div>';
            }
            ?>
        </div>
        <label class="btn btn-primary mt-2" for="user_image">Upload Photo</label>
        <input type="file" class="form-control d-none" id="user_image" name="user_image" onchange="previewImage(event)">
    </div>
    </center>
</div>


            
            <div class="row mb-3">
                <div class="col-lg-4">
                    <label for="firstname" class="form-label">Firstname:</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_data['firstname'];?>">
                </div>
                <div class="col-lg-4">
                    <label for="middleinitial" class="form-label">Middle Initial:</label>
                    <input type="text" class="form-control" id="middleinitial" name="middleinitial" value="<?php echo $user_data['middleinitial'];?>">
                </div>
                <div class="col-lg-4">
                    <label for="lastname" class="form-label">Lastname:</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user_data['lastname'];?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-lg-6">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $user_data['username'];?>">
                </div>
                <div class="col-lg-6">
                  <label for="password" class="form-label">Password:</label>
                  <div class="input-group">
                      <input type="password" class="form-control" id="password" name="password" value="<?php echo $user_data['password'];?>">
                      <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                          <i class="fas fa-eye"></i>
                      </button>
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

            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
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
  });
</script>

<!-- Toast HTML -->
<div class="position-fixed top-50 start-50 translate-middle" style="z-index: 5">
  <div id="myToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
    <div class="toast-header" style="background-color:#FF9800;">
      <img src="../assets/img/ireplyicon.png" class="rounded me-2" alt="..." style="width: 20px; height: 20px;">
      <strong class="me-auto" style="color:#070F2B">Set Profile Page</strong>
      <button type="button" class="btn-close" aria-label="Close"></button>
    </div>
    <div class="toast-body"></div>
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