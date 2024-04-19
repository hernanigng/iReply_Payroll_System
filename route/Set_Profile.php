<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>



<div id="layoutSidenav_content">

<main>
<div class="container-fluid px-4">
            
<div class="row">

<div class="col-md-4">
  <div class="card border-primary mb-3 mt-4">
    <!-- First Card Content -->
    <div class="card-header">Profile Picture</div>
    <div class="card-body text-primary text-center d-flex flex-column justify-content-center align-items-center" style="height: 470px;">
      <!-- Profile Picture Placeholder -->
      <div class="rounded-circle bg-secondary text-white d-flex justify-content-center align-items-center mb-3" style="width: 150px; height: 150px;">
        <span class="fs-2">+</span>
      </div>
      <!-- Change Picture Button -->
      <div class="mb-3">
        <input type="file" class="form-control" id="uploadInput" style="display: none;">
        <button class="btn btn-primary" onclick="document.getElementById('uploadInput').click()">Change Picture</button>
      </div>
    </div>
  </div>
</div>


<script>
  const uploadInput = document.getElementById('uploadInput');

  uploadInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const imageSrc = e.target.result;
        const img = document.createElement('img');
        img.src = imageSrc;
        img.classList.add('img-fluid', 'rounded-circle');
        img.style.width = '150px';
        img.style.height = '150px';
        const placeholder = document.querySelector('.rounded-circle.bg-secondary');
        placeholder.innerHTML = '';
        placeholder.appendChild(img);
      };
      reader.readAsDataURL(file);
    }
  });
</script>


  <div class="col-md-8">
    <div class="card border-primary mb-3 mt-4">
      <!-- Second Card Content -->
      <div class="card-header">Set Information</div>
      <div class="card-body text-primary" style="height: 470px;">
        <!-- Second Card Body Content -->
        <div class="container">
          <div class="row">
            <div class="col-md-4 mb-3 mt-3">
              <label for="firstname" class="form-label">Firstname</label>
              <input type="text" class="form-control" id="firstname" placeholder="" name="firstname">
            </div>
            <div class="col-md-4 mb-3 mt-3">
              <label for="middleInitial" class="form-label">Middle Initial</label>
              <input type="text" class="form-control" id="middleInitial" placeholder="" name="middleInitial">
            </div>
            <div class="col-md-4 mb-3 mt-3">
              <label for="lastname" class="form-label">Lastname</label>
              <input type="text" class="form-control" id="lastname" placeholder="" name="lastname">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3 mt-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" placeholder="" name="username">
            </div>
            <div class="col-md-6 mb-3 mt-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="" name="password">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="userRole" class="form-label">User Role</label>
              <select class="form-select" id="userRole" name="userRole">
                <option selected disabled>Select User Role</option>
                <option value="admin">Admin</option>
                <option value="manager">Manager</option>
                <option value="employee">Employee</option>
              </select>
            </div>
            <div class="col-md-6 mb-3">
              <label for="position" class="form-label">Position</label>
              <select class="form-select" id="position" name="position">
                <option selected disabled>Select Position</option>
                <option value="manager">Manager</option>
                <option value="developer">Developer</option>
                <option value="designer">Designer</option>
              </select>
            </div>
          </div>
          <!-- Buttons -->
          <div class="row mt-5">
            <div class="col-md-3 offset-md-3">
              <button type="button" class="btn btn-primary w-100">Save Changes</button>
            </div>
            <div class="col-md-3">
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
