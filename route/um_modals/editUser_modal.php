<script src="um_modals/js/editUser_modal.js"></script>

<!-- EDIT USER MODAL -->
<div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="editUserLabel">User Information</h5>
    </div>
            <div class="modal-body" style="margin-top: -10px;">

<div class="row">
    <div class="col">
        <input type="hidden" name="userId" class="form-control" id="userId">
        
        <label for="firstname" class="col-form-label">First Name</label>
         <input type="" class="form-control" id="edit_firstname">
    </div>
    <div class="col">
        <label for="middleinitial" class="col-form-label">Middle Initial</label>
          <input type="" class="form-control" id="edit_middleinitial">
    </div>
    <div class="col">
        <label for="lastname" class="col-form-label">Last Name</label>
          <input type="" class="form-control" id="edit_lastname">
    </div>
</div>

<div class="row">
    <div class="col">
       <label for="username" class="col-sm-2 col-form-label">Username</label>
          <input type="" class="form-control" id="edit_username">
    </div>
    <div class="col">
       <label for="password" class="col-sm-2 col-form-label">Password</label>
          <input type="" class="form-control" id="edit_password">
    </div>
</div>

<div class="row">
    <div class="col">
       <label for="userRole" class="col-form-label">User Role</label>
       <select class="form-select" name="edit_userRole" aria-label="Position Select" id="edit_userRole">
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
    </div>
    <div class="col">
       <label for="position" class="col-form-label">Position</label>
          <select class="form-select" name="edit_position" aria-label="Position Select" id="edit_position">
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
    </div>
</div>
    </div>
                <div class="modal-footer">
                  <button class="btn btn-danger close" style="float: right; margin-top: 10px;" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="updateButton">Update</button>
                 </div>
            </div>
        </div>
    </div>
