<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>
<style>
        #datatablesSimple th {

            background-color: #BED7DC;
        }
    </style>

<!-- Custom Script -->
<!-- jQuery -->





<script>
    // Function to show the modal for adding/editing positions
    function showModal(id = 0, title = '', description = '') {
        $('#positionId').val(id);
        $('#title').val(title);
        $('#description').val(description);
        $('#itemModal').modal('show');
    }

    // Function to dismiss the modal
    function closeModal() {
        $('#itemModal').modal('hide');
    }

    // Function to delete a position via AJAX
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

    // Function to submit the form via AJAX
    function saveItem() {
        var title = $('#title').val().trim();
        var description = $('#description').val().trim();

        // Custom validation
        if (title === "") {
            $('#title').addClass("is-invalid");
            return false; // Return false to indicate validation failure
        }
        if (description === "") {
            $('#description').addClass("is-invalid");
            return false; // Return false to indicate validation failure
        }

        // Perform AJAX request if validation passes
        var id = $('#positionId').val();
        $.ajax({
            type: "POST",
            url: "functions/add_Position.php",
            data: { id: id, title: title, description: description },
            success: function(data){
                closeModal(); // Close the modal after successful submission
                location.reload();
            }
        });
    }

    $(document).ready(function() {
        // Event listener for form submission
        $('#itemForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission
            saveItem(); // Call saveItem function
        });
    });
</script>






<div id="layoutSidenav_content">

                <main>
                    <div class="container-fluid px-4">
                    <h5 class="mt-4 mb-1 hc fw-bold"><i class="fa-solid fa-briefcase me-2"></i>Positions</h5>
  
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary" type="button" onclick="showModal()"><span><i class="fa-solid fa-square-plus me-2"></i></span>Add New</button>
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
                    include '../connection/database.php';

                    // Fetch clients from database
                    $result = mysqli_query($conn, "SELECT * FROM tbl_position ORDER BY position_ID DESC");

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<input type='hidden' class='positionId' value='{$row['position_ID']}'>";
                        echo "<td>{$row['Title']}</td>";
                        echo "<td>{$row['Description']}</td>";
                        echo "<td>";
                        echo "<center><button class='btn btn-sm btn-primary' onclick='showModal({$row['position_ID']},\"{$row['Title']}\", \"{$row['Description']}\")'><i class='fas fa-edit'></i></button>";
                        echo "<button class='btn btn-sm btn-danger' onclick='deleteItem({$row['position_ID']})'><i class='fas fa-trash-alt'></i></button></center>";
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
                <button type="button" class="close" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form id="itemForm" novalidate>
                <div class="modal-body">
                    <input type="hidden" id="positionId">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="title" placeholder="" required>
                        <label for="title">Title</label>
                        <div class="invalid-feedback">
                            Please provide a title for this entry.
                        </div>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="description"></textarea>
                        <label for="description">Description</label>
                        <div class="invalid-feedback">
                            Please provide a description for this entry.
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal" onclick="closeModal()">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
