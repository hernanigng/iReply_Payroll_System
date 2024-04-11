<!-- VIEW USER MODAL -->
<div class="modal fade" id="viewUser" tabindex="-1" aria-labelledby="viewUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-5" id="viewUserLabel">User Information</h5>
    </div>
            <div class="modal-body" style="margin-top: -10px;">

  <div class="row">
    <div class="col">
       <label for="firstname" class="col-form-label">First Name</label>
         <span class="form-control" id="firstname"> </span>
    </div>
    <div class="col">
       <label for="middleinitial" class="col-form-label">Middle Initial</label>
         <span class="form-control" id="middleinitial"> </span>
    </div>
    <div class="col">
       <label for="lastname" class="col-form-label">Last Name</label>
          <span class="form-control" id="lastname"> </span>
    </div>
</div>

<div class="row">
    <div class="col">
       <label for="username" class="col-form-label">Username</label>
         <span class="form-control" id="username"> </span>
    </div>
    <div class="col">
        <label for="password" class="col-form-label">Password</label>
          <span class="form-control" id="password"> </span>
    </div>
</div>

<div class="row">
    <div class="col">
       <label for="userrole" class="col-form-label">User Role</label>
          <span class="form-control" id="userrole"> </span>
    </div>
    <div class="col">
       <label for="position" class="col-form-label">Position</label>
          <span class="form-control" id="position"> </span>
    </div>
</div>
                </div>

                <div class="modal-footer">
                  <button class="btn btn-danger close" style="float: right; margin-top: 10px;" data-bs-dismiss="modal">Close</button>
                  <button class="btn btn-primary" style="float: right; margin-top: 10px;" id="addButton">Create</button>
                 </div>
            </div>
        </div>
    </div>

    <script src="um_modals/js/viewUser_modal.js"></script>