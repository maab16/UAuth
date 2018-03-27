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
		<form action="../../App/Lib/login.php" method="post">
			<h3 class="title">Login Details</h3>

			<div class="form-group row">
	        	<div class="col-sm-4">
	        		<label id="username">Username</label>
	        	</div>
	        	<div class="col-sm-8">
	        		<input type="text" name="username" id="username" class="form-control username">
	        	</div>
	        </div>
	        
	        <div class="form-group row">
	        	<div class="col-sm-4">
	        		<label id="password">Password</label>
	        	</div>
	        	<div class="col-sm-8">
	        		<input type="password" name="password" id="password" class="form-control password" >
	        	</div>
	        </div>
		</form>
	</div>
	<script src="assets/js/jquery-3.3.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>