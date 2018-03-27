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
	<section class="user-login">
		<div class="container">
			<div class="validation-errors">
				<?php if(!empty($_SESSION['validation'])):?>
					<ul>
						<?php foreach($_SESSION['validation'] as $error):?>
							<li class="p-3 mb-2 bg-danger text-white"><?php echo $error;?></li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
			</div>
			<form action="App/Lib/login.php" method="post">
				<h3 class="title"><span>Login Details</span> <a class="forget" href="forgot.php">Forget Password?</a></h3>

				<div class="form-group row">
		        	<div class="col-sm-4">
		        		<label id="username">Username</label>
		        	</div>
		        	<div class="col-sm-8">
		        		<input type="text" name="username" id="username" class="form-control username" autocomplete="off">
		        	</div>
		        </div>
		        
		        <div class="form-group row">
		        	<div class="col-sm-4">
		        		<label id="password">Password</label>
		        	</div>
		        	<div class="col-sm-8">
		        		<input type="password" name="password" id="password" class="form-control password" autocomplete="off">
		        	</div>
		        </div>
		        <div class="form-group row">
		        	<div class="col-sm-4"></div>
		        	<div class="col-sm-8">
		        		<input type="checkbox" name="remember_me" id="remember_me" class="remember_me" autocomplete="off"> Remember me
		        	</div>
		        </div>
		        <div class="form-group">
		        	<input type="submit" name="login" value="Login">
		        	<a href="signup.php">Create an Account</a>
		        </div>
			</form>
		</div>
	</section>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
<?php 
	Session::delete('validation');
?>