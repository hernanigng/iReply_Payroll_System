
// VIEW USER SCRIPT


function openModal(id) {
   //console.log();
       // Show the modal
       $('#viewUser').modal('show');
       // Switch to the default tab (personal) when opening the modal
       // Fetch employee details using AJAX
       $.ajax({
           url: 'functions/get_userId.php',
           type: 'POST',
           data: { id: id },
           dataType: 'json', // Specify JSON as the expected data type
           success: function(response) {
            console.log(response);
               // Update the modal content with the fetched employee details
               // Assuming the response is an object containing the employee details
               $('#firstname').text(response.firstname);
               $("#middleinitial").text(response.middleinitial);
               $('#lastname').text(response.lastname);
               $('#username').text(response.username);
               $('#password').text(response.password);
               $('#userrole').text(response.user_role);
               $('#position').text(response.position);
           }
       });
   }

   // Function to close the modal
   function closeModal() {
       $('#viewUser').modal('hide');
   }

