<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\users;
use Blab\Libs\input;

$user = new Users;

if (isset($_GET['token'])) {

	$result = $user->verifyAccount();
}
?>

<?php

	if(isset($_POST['activate_account'])){

		$user->activateAccount();

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
		        
		        <div class="form-group row">
		        	<div class="col-sm-4">
		        		<label id="verification_code">Enter Verification Code</label>
		        	</div>
		        	<div class="col-sm-8">
		        		<input type="number" name="verification_code" id="verification_code" class="form-control verification_code" autocomplete="off">
		        	</div>
		        </div>
		        <div class="form-group">
		        	<input type="hidden" name="token" value="<?php echo Input::get('token')?>">
		        	<input type="hidden" name="id" value="<?php echo Input::get('id')?>">
		        	<input type="submit" name="activate_account" value="Activate">
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
		<title>Resend Entab Registration Activation Code</title>
		<!-- Template Layout | Bootstrap CSS -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<!-- Template Main CSS -->
		<link rel="stylesheet" href="../../assets/css/style.css">
	</head>
	<body>
		<div class="container">
			<p class="p-3 mb-2 bg-danger text-white">Your Token or Session Expired. Please <a href="../../resend_activation_code.php" class="text-white"><strong> Click here for resend email</strong></a></p>
		</div>

		<script src="../../assets/js/jquery-3.3.1.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>
	</body>
	</html>
<?php endif;