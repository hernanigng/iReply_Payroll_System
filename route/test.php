<?php include '../connection/session.php' ?>

<?php include '../template/header.php' ?>

<?php include '../template/sidebar.php' ?>

<style>
        #datatablesSimple th {
            text-align: center;
            background-color: #BED7DC;
        }
    </style>
<!-- Custom Script -->

<!-- Custom Script -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">


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

    // Remove existing invalid classes
    $('#companyName, #contactName, #website, #contactNumber, #contractDate, #contactEmail').removeClass("is-invalid");

    if (companyName === ""){
        $('#companyName').addClass("is-invalid");
        return false;
    }
    if (contactName === ""){
        $('#contactName').addClass("is-invalid");
        return false;
    }
    if (website === ""){
        $('#website').addClass("is-invalid");
        return false;
    }
    if (contactNumber === ""){
        $('#contactNumber').addClass("is-invalid");
        return false;
    }
    if (contractDate === ""){
        $('#contractDate').addClass("is-invalid");
        return false;
    }
    if (contactEmail === ""){
        $('#contactEmail').addClass("is-invalid");
        return false;
    }

    // Email format validation using jQuery
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(contactEmail)) {
        $('#contactEmail').addClass("is-invalid");
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

    // Remove invalid class on input change
    $('#contactEmail').on('input', function() {
        if ($(this).val().trim() !== "") {
            $(this).removeClass("is-invalid");
        }
    });
});
</script>



<div id="layoutSidenav_content">

 





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
