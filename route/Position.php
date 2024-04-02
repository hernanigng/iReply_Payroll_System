
<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>


<!-- Custom Script -->
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>


<script>
// Function to show the modal for adding/editing clients
function showModal(id = 0, title = '', description = '') {
    $('#positionId').val(id);
    $('#title').val(title);
    $('#description').val(description);
    $('#itemModal').modal('show');
}

// Function to submit the form via AJAX
function saveItem() {
    var id = $('#positionId').val();
    var title = $('#title').val();
    var description = $('#description').val();


    $.ajax({
        type: "POST",
        url: "functions/add_Position.php",
        data: { id: id, title: title, description: description },
        success: function(data){
            $('#itemModal').modal('hide');
            location.reload();
        }
    });
}

// Function to delete a client via AJAX
function deleteItem(id) {
    if (confirm('Are you sure you want to delete this position?')) {
        $.ajax({
            type: "POST",
            url: "functions/delete_Position.php",
            data: { id: id },
            success: function(data){
                location.reload();
            }
        });
    }
}

// No need to initialize DataTable since you're using Simple DataTables
</script>



<div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                        <h3 class="mt-4">Positions</h3>
  
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="button" onclick="showModal()">Add New</button>
                        </div>

                        <div class="card mb-4 mt-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                List of Positions
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    // Include database connection file
                    include_once '../connection/database.php';

                    // Fetch clients from database
                    $result = mysqli_query($conn, "SELECT * FROM tbl_position");

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<input type='hidden' class='positionId' value='{$row['position_ID']}'>";
                        echo "<td>{$row['Title']}</td>";
                        echo "<td>{$row['Description']}</td>";
                        echo "<td>";
                        echo "<button class='btn btn-sm btn-primary' onclick='showModal({$row['position_ID']},\"{$row['Title']}\", \"{$row['Description']}\")'>Edit</button>";
                        echo "<button class='btn btn-sm btn-danger' onclick='deleteItem({$row['position_ID']})'>Delete</button>";
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
                <h5 class="modal-title" id="exampleModalLabel">Add | Edit Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="positionId">

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="title" placeholder="">
                    <label for="title">Title</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" placeholder="Leave a comment here" id="description"></textarea>
                    <label for="description">Description</label>
                </div>


                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveItem()">Save changes</button>
            </div>
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
