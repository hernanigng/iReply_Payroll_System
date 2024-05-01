<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    button[type="submit"] {
  z-index: 1000;
}
</style>
<body>

<?php
session_start(); // Initialize the session

// Establish a connection to the database
$conn = mysqli_connect("localhost", "root", "", "ireply_payroll_db");

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

<form action="update_profile.php" method="post">
<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
  <label for="firstname">Firstname:</label>
  <input type="text" id="firstname" name="firstname" value="<?php echo $user_data['firstname'];?>">

  <label for="middleinitial">Middle Initial:</label>
  <input type="text" id="middleinitial" name="middleinitial" value="<?php echo $user_data['middleinitial'];?>">

  <label for="lastname">Lastname:</label>
  <input type="text" id="lastname" name="lastname" value="<?php echo $user_data['lastname'];?>">

  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo $user_data['username'];?>">

  <label for="password">Password:</label>
  <input type="password" id="password" name="password" value="<?php echo $user_data['password'];?>">


  
  <button type="submit">Update Profile</button>
</form>

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
          alert(response);
        }
      });
    });
  });
</script>

</body>
</html>