// UPDATE USER SCRIPT


$(document).ready(function() {
    // Attach click event listener to the Update button
    $('#updateButton').click(function() {
        // Retrieve the employee ID from the hidden input field
        var userId = $('#userId').val();

        // Check if employee ID is empty or not
        if (userId === '') {
            console.error('User ID is missing.');
            return; // Stop execution if employee ID is missing
        }

        // Call the updateEmployee function with the employee ID
        updateUser(userId);
    });

    // Define the updateEmployee function here
    function updateUser(userId) {
        // Your existing updateEmployee function code goes here
        // Retrieve the updated data from the form fields
        var userId = $('#userId').val();
        var firstname = $('#edit_firstname').val();
        var middlename = $('#edit_middlename').val();
        var lastname = $('#edit_lastname').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        var userRole = $('#edit_userRole').val();
        var position = $('#edit_position').val();


        // Create a JSON object with the updated data
        var updatedData = {
            user_id: userId,
            firstname: firstname,
            middlename: middlename,
            lastname: lastname,
            username: username,
            password: password,
            user_role: userRole,
            position: position
            
        };

        // Perform AJAX request to update employee data
        $.ajax({
            url: 'functions/update_user.php',
            type: 'POST',
            data: updatedData,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                if (response.success) {
                    // Display toast notification
                    var updateToast = new bootstrap.Toast($('#updateToast'));
                    updateToast.show();
                    
                    // Optionally hide the modal
                    closeModal();
                } else {
                    // If update failed, display error message
                    console.error(response.message);
                }
            },
        });
    }
});