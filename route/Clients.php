<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


<script>
// Function to show the modal for adding/editing clients
function showModal(id = 0, companyName = '', contactName = '', website = '', contactNumber = '', contractDate = '', contactEmail = '') {
    $('#clientId').val(id);
    $('#companyName').val(companyName);
    $('#contactName').val(contactName);
    $('#website').val(website);
    $('#contactNumber').val(contactNumber);
    $('#contractDate').val(contractDate);
    $('#contactEmail').val(contactEmail);
    $('#itemModal').modal('show');
}

function closeModal(){
    $('#itemModal').modal('hide');
}

// Function to delete a client via AJAX
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this client?')) {
        $.ajax({
            type: "POST",
            url: "functions/delete_Client.php",
            data: { id: id },
            success: function(data){
                location.reload();
            }
        });
    }
}

// Function to submit the form via AJAX
function saveItem() {
    var id = $('#clientId').val();
    var companyName = $('#companyName').val();
    var contactName = $('#contactName').val();
    var website = $('#website').val();
    var contactNumber = $('#contactNumber').val();
    var contractDate = $('#contractDate').val();
    var contactEmail = $('#contactEmail').val();

if (companyName === ""){
    $('#companyName').addClass("is-invalid");
    return false;
}


    $.ajax({
        type: "POST",
        url: "functions/add_Client.php",
        data: { id: id, companyName: companyName, contactName: contactName, website: website, contactNumber: contactNumber, contractDate: contractDate, contactEmail: contactEmail },
        success: function(data){
            $('#itemModal').modal('hide');
            location.reload();
        }
    });
}

$(document).ready(function(){
    $('#itemForm').submit(function(event){
        event.preventDefault();
        saveItem();
    });
});



// No need to initialize DataTable since you're using Simple DataTables
</script>



<div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Clients</h3>
  
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="button" onclick="showModal()">Add New</button>
                        </div>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Clients
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Contact Name</th>
                                            <th>Website</th>
                                            <th>Contact Number</th>
                                            <th>Contract Date</th>
                                            <th>Contact Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    // Include database connection file
                    include_once '../connection/database.php';

                    // Fetch clients from database
                    $result = mysqli_query($conn, "SELECT * FROM tbl_client");

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<input type='hidden' class='clientId' value='{$row['Client_ID']}'>";
                        echo "<td>{$row['Company_Name']}</td>";
                        echo "<td>{$row['Contact_Name']}</td>";
                        echo "<td>{$row['Website']}</td>";
                        echo "<td>{$row['Contact_Number']}</td>";
                        echo "<td>{$row['Contract_Date']}</td>";
                        echo "<td>{$row['Contact_Email']}</td>";
                        echo "<button class='btn btn-sm btn-primary' onclick='showModal({$row['Client_ID']},\"{$row['Company_Name']}\", \"{$row['Contact_Name']}\", \"{$row['Website']}\", \"{$row['Contact_Number']}\", \"{$row['Contract_Date']}\", \"{$row['Contact_Email']}\")'><i class='fas fa-edit'></i></button>";
                        echo "<button class='btn btn-sm btn-danger' onclick='deleteItem({$row['Client_ID']})'><i class='fas fa-trash-alt'></i></button>";
                        
                        echo "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
    

            <!-- Modal -->
<div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add | Edit Client</h5>
                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="itemForm" novalidate>
            <div class="modal-body">

                <input type="hidden" id="clientId">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="companyName" placeholder="" required>
                    <label for="companyName">Company Name</label>
                    <div class="invalid-feedback"> Required field. </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="contactName" placeholder="">
                    <label for="contactName">Contact Name</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="website" placeholder="">
                    <label for="website">Website</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="contactNumber" placeholder="">
                    <label for="contactNumber">Contact Number</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="contractDate" placeholder="">
                    <label for="contractDate">Contract Date</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="contactEmail" placeholder="">
                    <label for="contactEmail">Contact Email</label>
                </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveItem()">Save changes</button>
            </div>

            </form>
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
