
    // EDIT USER SCRIPT
  

    function openEditModal(id) {
        // Show the modal
        $('#editUser').modal('show');
        // Fetch employee details using AJAX
        $.ajax({
            url: 'functions/get_userId.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Update the modal content with the fetched employee details
                // Assuming the response is an object containing the employee details
                $('#userId').val(response.user_id);
                $('#edit_firstname').val(response.firstname);
                $('#edit_middlename').val(response.middlename);
                $('#edit_lastname').val(response.lastname);
                $('#edit_username').val(response.username);
                $('#edit_password').val(response.password);
                $('#edit_userRole').val(response.user_role);
                $('#edit_position').val(response.position);
            }   
        });
    }

    // Function to close the modal
    function closeModal() {
        $('#editUser').modal('hide');
    }

   
