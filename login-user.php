
<?php
session_start();
include('config/app.php');
ob_start();


if (!isset($_SESSION['phone'])) {
    if (isset($_POST['login'])) {
        loginUser($_POST);
    }
    if (isset($_POST['register'])) {
       if ( registerUser($_POST) > 0){
			echo "<script>
			alert('Register Berhasil !');
			document.location.href = 'lapangan-tersedia.php';
			</script>";
		 } else {
			echo "<script>
			alert('Register gagal!');
			document.location.href = 'login-user.php';
			</script>";
		 };
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link href="assets/css/signin.css" rel="stylesheet">
	<link rel="icon" href="assets/img/logo.jpg">

	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<title>Login</title>

  </head>

<!------ Include the above in your HEAD tag ---------->

<div class="container" style="margin-top: 12rem;">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6 text-center mx-auto">
                        <a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6 text-center mx-auto">
							   <a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="number" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Phone" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
								
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login" id="login" tabindex="4" class="form-control btn btn-primary" value="Log In">
											</div>
										</div>
									</div>
								
								</form>
								<form id="register-form" action="" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name" required>
									</div>
                           <div class="form-group">
										<input type="number" name="phone" id="phone" tabindex="1" class="form-control" placeholder="Phone" required>
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" required>
									</div>
                           <div class="form-group">
										<input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Address" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register" id="register" tabindex="4" class="form-control btn btn-primary" value="Register Now">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

   <script>
      $(function() {

         $('#login-form-link').click(function(e) {
         $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
         $('#register-form-link').removeClass('active');
         $(this).addClass('active');
         e.preventDefault();
         });
         $('#register-form-link').click(function(e) {
         $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
         $('#login-form-link').removeClass('active');
         $(this).addClass('active');
         e.preventDefault();
         });

      });

   </script>

<?php

} else {
    header("Location: lapangan-tersedia.php");
    exit();
}


?>