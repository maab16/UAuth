<?php 
session_start();

include_once 'vendor/autoload.php';

use Blab\Libs\Session;
if(Session::exists('user')){
	header('Location: profile.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Etab Login</title>
	<!-- Template Layout | Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Template Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<div class="container">
		<form action="App/Lib/forgot.php" method="post">
			<h3 class="title"><span>Reset Password</span> <a class="forget" href="login.php">Beck to Login?</a></h3>

			<div class="form-group row">
	        	<div class="col-sm-4">
	        		<label id="email_username">Email or Username</label>
	        	</div>
	        	<div class="col-sm-8">
	        		<input type="text" name="email_username" id="email_username" class="form-control email_username" autocomplete="off">
	        	</div>
	        </div>
	        
	        <div class="form-group">
	        	<input type="submit" name="forgot" value="Submit">
	        </div>
		</form>
	</div>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php session_destroy();?>