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
                        <h3 class="mt-4"><i class="fa-solid fa-money-bill"></i> Withholding Tax Page</h3>
  

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
