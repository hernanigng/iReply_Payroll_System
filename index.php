<!DOCTYPE html>
<html>

<head>
    <title>Payroll System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/login_style.css?=<?=time()?>" media="all">

    <link rel="icon" type="image/x-icon" href="assets/img/ireplyicon.png" sizes="16x16">

    <?php
		session_start();

        if( isset( $_SESSION['loginStatus'] ) ) {
            if( $_SESSION['loginStatus'] == "ok" ) {
                header("Location: route/index.php");
            }
        }

		

	?>
    <!-- <script>
        $(document).ready(function () {
            $('.login_btn').click(function () {
                var username = $('.input_user').val();
                var password = $('.input_pass').val();

                // Check if username and password are empty
                if (username.trim() === '' || password.trim() === '') {
                    $('#inputWarningModal').modal('show');
                    return;
                }

                $.ajax({
                    url: 'login.php',
                    type: 'post',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function (response) {
                        $(".status").html(response.message);
                        if (response == 'success') {
                            window.location.href = 'dashboard.php';
                        } else {
                            $('#errorModal').modal('show');
                        }
                    }
                });
            });
        });
    </script> -->

    <!-- script ni angel -->
    <script> 
     $(document).ready( function() {
        $("#login").submit( function(e){
            e.preventDefault();
            var data = $(this).serialize();
			var url = "connection/login.php";
        $(".status").html('<img src="<?php define('IMAGE', 'assets/img/loading.gif'); ?>" width="50px" class="center-block" />')
        $.post(url, data, function(response) {
            setTimeout(function() {
                $(".status").html(response.message);

                if(response.status == 'success') {
                    if( response.role == '1' ) {
								
								setTimeout( function() {
									window.location.href = 'route/index.php';
								},1000);
								
							} else if(response.role == '2' ) {
								
								setTimeout( function() {
									window.location.href = 'route/index.php';
								},1000);
								
							}
                }
            },1000);
        },"json");


        });

        });

    </script>
</head> 

<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card col-md-5">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="assets/img/ireply_logo.png" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class="d-flex justify-content-center form_container">


			<form id="login">
            <div class="status" style="margin-bottom:20px;"> </div>
                <h5 class="mb-4 d-flex justify-content-center">iReply Payroll System</h5>
			    <div class="input-group mb-3">
			        <div class="input-group-append">
			            <span class="input-group-text"><i class="fas fa-user"></i></span>
			        </div>
			        <input type="text" name="username" class="form-control input_user" value=""
			            placeholder="username" required>
			    </div>
			    <div class="input-group mb-2">
			        <div class="input-group-append">
			            <span class="input-group-text"><i class="fas fa-key"></i></span>
			        </div>
			        <input type="password" name="password" class="form-control input_pass" value=""
			            placeholder="password" required>
			    </div>
			    <div class="form-group">
			        <div class="custom-control custom-checkbox">
			            <input type="checkbox" class="custom-control-input" id="customControlInline">
			            <label class="custom-control-label" for="customControlInline">Remember me</label>
			        </div>
			    </div>
			    <div class="d-flex justify-content-center mt-3 login_container">
			        <button type="submit" name="button" class="btn login_btn">Login</button>
			    </div>
			</form>

                </div>

            </div>
        </div>
    </div>

    <!-- Error Modal 
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="errorModalLabel"><i class="fas fa-exclamation-triangle"></i> Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>username and password are incorrect.</h5>
                </div>
            </div>
        </div>
    </div>
     End Error Modal -->

    <!-- Input Warning Modal 
    <div class="modal fade" id="inputWarningModal" tabindex="-1" role="dialog" aria-labelledby="inputWarningModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="inputWarningModalLabel"><i class="fas fa-exclamation-triangle"></i> Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>input username and password.</h5>
                </div>
            </div>
        </div>
    </div>
     End Input Warning Modal -->



</body>

</html>
