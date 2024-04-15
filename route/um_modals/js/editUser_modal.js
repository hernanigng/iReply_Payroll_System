
    // EDIT USER SCRIPT
  

    function openEditModal(id) {
        // Show the modal
        $('#editUser').modal('show');
        // Fetch user details using AJAX
        $.ajax({
            url: 'functions/get_userId.php',
            type: 'POST',
            data: { id: id },
            dataType: 'json', // Specify JSON as the expected data type
            success: function(response) {
                // Debugging: Log the response to check its contents
                // Update the modal content with the fetched user details
                // Assuming the response is an object containing the user details
                $('#userId').val(response.user_management_id); // Check if 'user_management_id' is the correct property for user ID
                $('#edit_firstname').val(response.firstname);
                $('#edit_middleinitial').val(response.middleinitial);
                $('#edit_lastname').val(response.lastname);
                $('#edit_username').val(response.username);
                $('#edit_password').val(response.password);
                //$('#edit_userRole').val(response.user_role);
                //$('#edit_position').val(response.position);
                $.ajax({
                    url: 'functions/get_userRole.php',
                    type: 'POST',
                    data: { user_role_id: response.user_role },
                    dataType: 'json',
                    success: function(user_roleResponse) {
                        console.log(user_roleResponse);
                        $('#edit_userRole').val(response.user_role);
                    }
                });

                $.ajax({
                    url: 'functions/get_position.php',
                    type: 'POST',
                    data: { position_id: response.position },
                    dataType: 'json',
                    success: function(positionResponse) {
                        console.log(positionResponse);
                        $('#edit_position').val(response.position);
                    }
                });
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log any errors for debugging
            }
        });
    }
    
    // Function to close the modal
    function closeModal() {
        $('#editUser').modal('hide');
    }

   
