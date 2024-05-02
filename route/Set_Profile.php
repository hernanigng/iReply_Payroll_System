

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


<div id="layoutSidenav_content">

<main>
    <div class="container-fluid px-4 col-lg-10">
        <form id="edit-profile-form" action="update_profile.php" method="post" >
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

            
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
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $user_data['password'];?>">
                </div>
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