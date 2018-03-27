<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\users;

$user = new Users;

if (isset($_GET['token'])) {

	$result = $user->verifyForgotToken();
}
?>

<?php

	if(isset($_POST['reset_password'])){

		$user->changeUserPassword();

	}
?>

<?php if($result):?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Etab Login</title>
		<!-- Template Layout | Bootstrap CSS -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<!-- Template Main CSS -->
		<link rel="stylesheet" href="../../assets/css/style.css">
	</head>
	<body>
		<div class="container">
			<form action="" method="post">
				<h3 class="title"><span>Login Details</span> <a class="forget" href="forgot.php">Forget Password?</a></h3>
		        
		        <div class="form-group row">
		        	<div class="col-sm-4">
		        		<label id="password">Password</label>
		        	</div>
		        	<div class="col-sm-8">
		        		<input type="password" name="password" id="password" class="form-control password" autocomplete="off">
		        	</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-sm-4">
		        		<label id="re_password">Re Password</label>
		        	</div>
		        	<div class="col-sm-8">
		        		<input type="password" name="re_password" id="re_password" class="form-control re_password" autocomplete="off">
		        	</div>
		        </div>
		        <div class="form-group">
		        	<input type="submit" name="reset_password" value="Reset">
		        </div>
			</form>
		</div>
		<script src="../../assets/js/jquery-3.3.1.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
	</body>
	</html>
<?php else:?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Etab Login</title>
		<!-- Template Layout | Bootstrap CSS -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<!-- Template Main CSS -->
		<link rel="stylesheet" href="../../assets/css/style.css">
	</head>
	<body>
		<div class="container">
			<p class="p-3 mb-2 bg-danger text-white">Your Token or Session Expired. Please <a href="../../forgot.php" class="text-white"><strong> Click here for reset password</strong></a></p>
		</div>

		<script src="../../assets/js/jquery-3.3.1.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
	</body>
	</html>
<?php endif;