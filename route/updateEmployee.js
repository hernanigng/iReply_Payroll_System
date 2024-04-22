// UPDATE SCRIPT
$(document).ready(function() {
    // Attach click event listener to the Update button
    $('#updateButton').click(function() {
        // Reset error messages and styles
        $('.form-control').removeClass('border border-danger');
        $('.error-message').text('');

        // Check if all required fields are filled out and pass validation
        if (validateForm() && validateEmail() && validateContactNumber()) {
            // Retrieve the employee ID from the hidden input field
            var employeeId = $('#employeeId').val();

            // Call the updateEmployee function with the employee ID
            updateEmployee(employeeId);
        }
    });

    // Define the validateForm function to check if all required fields are filled out
    function validateForm() {

        var lettersOnly = /^[A-Za-z\s]+$/;
        var numbersOnly = /^[0-9]+$/;

        var isValid = true;

         // Get form inputs
         var firstName = $('#edit_firstname').val();
         var middleName = $('#edit_middlename').val();
         var lastName = $('#edit_lastname').val();
         var contactNum = $('#edit_contactNum').val();

        // Perform validation
        if (!lettersOnly.test(firstName)) {
            $('#edit_firstname').addClass('border border-danger');
            $('#firstNameError').text('Please enter only letters for First Name.');
            isValid = false;
        }
        if (!lettersOnly.test(middleName)) {
            $('#edit_middlename').addClass('border border-danger');
            $('#middleNameError').text('Please enter only letters for Middle Name.');
            isValid = false;
        }
        if (!lettersOnly.test(lastName)) {
            $('#edit_lastname').addClass('border border-danger');
            $('#lastNameError').text('Please enter only letters for Last Name.');
            isValid = false;
        }
        if (!numbersOnly.test(contactNum)) {
            $('#edit_contactNum').addClass('border border-danger');
            $('#contactNumError').text('Please enter only numbers for Contact Number.');
            isValid = false;
        }

        return isValid;
    }

    // Define the validateEmail function to check if the email address is valid
    function validateEmail() {
    var personalEmail = $('#edit_personalEmail').val();
    var workEmail = $('#edit_workEmail').val();
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var personalEmailValid = emailPattern.test(personalEmail);
    var workEmailValid = emailPattern.test(workEmail);

    if (!personalEmailValid) {
        $('#edit_personalEmail').addClass('border border-danger');
        $('#emailError').text('Invalid personal email format.');
    }

    if (!workEmailValid) {
        $('#edit_workEmail').addClass('border border-danger');
        $('#workEmailError').text('Invalid work email format.');
    }

    return personalEmailValid && workEmailValid;
    }

    // Define the validateContactNumber function to check if the contact number is valid
    function validateContactNumber() {
        var contactNumber = $('#edit_contactNum').val();
        // Check if the contact number is exactly 11 digits
        var contactNumberPattern = /^\d{11}$/;
        return contactNumberPattern.test(contactNumber);
    }

    // Define the updateEmployee function here
function updateEmployee(employeeId) {
    // Retrieve the updated data from the form fields
    var firstname = $('#edit_firstname').val();
    var middlename = $('#edit_middlename').val();
    var lastname = $('#edit_lastname').val();
    var address = $('#edit_address').val();
    var birthdate = $('#edit_birthdate').val();
    var contactNum = $('#edit_contactNum').val();
    var civilStatus = $('#edit_civilStatus').val();
    var personalEmail = $('#edit_personalEmail').val();
    var workEmail = $('#edit_workEmail').val();
    var employeeType = $('#edit_employeeType').val();
    var startDate = $('#edit_startDate').val();
    var monthly = $('#edit_monthly').val();
    var accBonus = $('#edit_accBonus').val();
    var client = $('#edit_client').val();
    var position = $('#edit_position').val();
    var employmentStatus = $('#edit_employmentStatus').val();
    var sss = $('#edit_sss').val();
    var pagibig = $('#edit_pagibig').val();
    var philhealth = $('#edit_philhealth').val();
    var tin = $('#edit_tin').val();
    var sssCon = $('#edit_sssCon').val();
    var pagibigCon = $('#edit_pagibigCon').val();
    var philhealthCon = $('#edit_philhealthCon').val();
    var tax = $('#edit_tax').val();

    // Create a JSON object with the updated data
    var updatedData = {
        employee_id: employeeId,
        firstname: firstname,
        middlename: middlename,
        lastname: lastname,
        address: address,
        birthdate: birthdate,
        contact_num: contactNum,
        civilstatus: civilStatus,
        personal_email: personalEmail,
        work_email: workEmail,
        employee_type: employeeType,
        start_date: startDate,
        monthly_salary: monthly,
        account_bonus: accBonus,
        client: client,
        position: position,
        employment_status: employmentStatus,
        sss_num: sss,
        pagibig_num: pagibig,
        philhealth_num: philhealth,
        tin_num: tin,
        sss_con: sssCon,
        pagibig_con: pagibigCon,
        philhealth_con: philhealthCon,
        tax_percentage: tax
        // Add other fields as needed
    };

    // Perform AJAX request to update employee data
    $.ajax({
        url: 'functions/update_employee.php',
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
        error: function(xhr, status, error) {
            // Handle AJAX error
            console.error(xhr.responseText);
        }
    });
}

});
