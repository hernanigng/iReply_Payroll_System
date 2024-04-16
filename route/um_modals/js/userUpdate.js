// UPDATE USER SCRIPT


$(document).ready(function() {
    // Attach click event listener to the Update button
    $(document).on('click', '#updateButton', function() {
        var userId = $('#userId').val();

        if (userId === '') {
            console.error('User ID is missing.');
            return;
        }

        updateUser(userId);
    });

    // Define the updateEmployee function here
    function updateUser(userId) {
        var firstname = $('#edit_firstname').val();
        var middleinitial = $('#edit_middleinitial').val();
        var lastname = $('#edit_lastname').val();
        var username = $('#edit_username').val();
        var password = $('#edit_password').val();
        var userRole = $('#edit_userRole').val();
        var position = $('#edit_position').val();


        // Create a JSON object with the updated data
        var updatedData = {
            user_management_id: userId,
            firstname: firstname,
            middleinitial: middleinitial,
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
                    console.log(response);

                    // Construct the new row for the table
                var newRow = '<tr id="' + response.user_management_id + '">' +
                '<td>' + response.user_management_id + '</td>' +
                '<td>' + response.firstname + '</td>' +
                '<td>' + response.middleinitial + '</td>' +
                '<td>' + response.lastname + '</td>' +
                '<td>' + response.username + '</td>' +
                '<td>' + response.password + '</td>' +
                '<td>' + response.user_role + '</td>' +
                '<td>' + response.Title + '</td>' +
                '<td>' +
                    '<button class="btn btn-primary view" onclick="openModal(\'' + response.user_management_id + '\')"> <i class="bi bi-eye"></i> </button> ' +
                    '<button class="btn btn-danger del" data-employee_id="' + response.user_management_id + '"> <i class="bi bi-trash"></i> </button> ' +
                     '<button class="btn btn-warning edit" id="' + response.user_management_id + '" onclick="openPasswordModal(\'' + response.user_management_id + '\')"> <i class="bi bi-pencil"></i> </button>'
                '</td>' +
                '</tr>';


                    $('#datatablesSimple tbody').prepend(newRow);
                    
                    // Display toast notification
                    var userUpdate_toast = new bootstrap.Toast($('#user_updateToast'));
                    userUpdate_toast.show();

                    
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
