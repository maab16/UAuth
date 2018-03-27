
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Entab Register Form</title>
	<!-- Template Layout | Bootstrap CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- Template Main CSS -->
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<section class="register">
	<div class="container">
		<form action="App/Lib/action.php" method="post" enctype="multipart/form-data" class="regisret-form">
			<div class="form-head">
				<h3>Register an Account</h3>
				<a href="login.php">Already a member?</a>
			</div>
			<div id="accordion" role="tablist" aria-multiselectable="true">
                <div class="card accordion-panel">
                    <div class="card-block accordion-heading" role="tab" id="headingOne">
                      <h3 class="card-title accordion-title title ">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Profile Details
                        </a>
                      </h3>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingOne">
                        <div class="accordion-content">
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="first_name">First Name</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="first_name" class="first_name form-control " id="first_name">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="last_name">Last Name</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="last_name" class="last_name form-control " id="last_name">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="profile_picture">Profile Picture</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="file" name="profile_picture" id="profile_picture" class="profile_picture form-control ">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="gender">Gender</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="radio" name="gender" value="male" id="gender" class="gender form-control ">Male
                            		<input type="radio" name="gender" value="female" id="gender" class="gender form-control ">Female
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="home_address">Home Address</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<textarea class="home_address" name="home_address" id="home_address"></textarea>
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="district">District</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<select name="district" id="district" class="district">
                            			<option value="">Select Your District</option>
                            			<option value="Bagerhat">Bagerhat</option>
                            			<option value="Bandarban">Bandarban</option>
                            			<option value="Barguna">Barguna</option>
                            			<option value="Barisal">Barisal</option>
                            			<option value="Bhola">Bhola</option>
                            			<option value="Bogra">Bogra</option>
                            			<option value="Chandpur">Chandpur</option>
                            			<option value="Chandpur">Chandpur</option>
                            		</select>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card accordion-panel">
                    <div class="card-block accordion-heading" role="tab" id="headingTwo">
                      <h3 class="card-title accordion-title title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Account Details
                        </a>
                      </h3>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in show" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="accordion-content">
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="company_name">Company Name</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="company_name" id="company_name" class="form-control company_name" placeholder="Your Company Name">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="designation">Designation</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="radio" name="designation" class="form-control designation" value="Managing Director">Managing Director
                            		<input type="radio" name="designation" class="form-control designation" value="Director">Director
                            		<input type="radio" name="designation" class="form-control designation" value="Propritor">Propritor
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="office_address">Office Address</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<textarea class="office_address" name="office_address" id="office_address"></textarea>
                            	</div>
                            </div>
                            
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="verify_id">NID/Passport/Birth Certificte Number</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="verify_id" id="verify_id" class="form-control verify_id" placeholder="NID/Passport/Birth Certificte Number">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="tin">TIN</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="tin" id="tin" class="form-control tin" placeholder="TIN">
                            	</div>
                            </div>
                            
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="trade_no">Trade Licenses No</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="trade_no" id="trade_no" class="form-control trade_no" placeholder="Trade Licenses No">
                            	</div>
                            </div>


                        </div>
                    </div>
                </div>

                <h3 class="title">Contact Details</h3>

				<div class="form-group row">
                	<div class="col-sm-4">
                		<label id="mobile">Mobile</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="text" name="mobile" id="mobile" class="form-control mobile" placeholder="Mobile">
                	</div>
                </div>
                
                <div class="form-group row">
                	<div class="col-sm-4">
                		<label id="phone_no">Phone Number</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="number" name="phone_no" id="phone_no" class="form-control phone_no" >
                	</div>
                </div>

                <div class="form-group row">
                	<div class="col-sm-4">
                		<label id="email">Email Address</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="email" name="email" id="email" class="form-control email" required>
                	</div>
                </div>

                <div class="form-group row">
                    <input type="checkbox" name="hide_email" id="hide_email" class="hide_email"> MAKE THIS FIELD HIDDEN FROM PUBLIC
                </div>

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

                <div class="form-group row">
                	<div class="col-sm-4">
                		<label id="re-password">Confirm Password</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="password" name="re-password" id="re-password" class="form-control re-password">
                	</div>
                </div>

				<div class="card accordion-panel">
                    <div class="card-block accordion-heading" role="tab" id="headingTwo">
                      <h3 class="card-title accordion-title title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Social Profiles
                        </a>
                      </h3>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="accordion-content">
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="facebook">Facebook Page</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="facebook" id="facebook" class="form-control facebook" >
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="twitter">Twitter</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="twitter" id="twitter" class="form-control twitter">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="google">Google+</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="google" id="google" class="form-control google" >
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="website">Website Site(URL)</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="website" id="website" class="form-control website">
                            	</div>
                            </div>

                        </div>
                    </div>
                </div>

                <input type="checkbox" name="terms_n_conditions"> To complete registration, you must read and agree to our <strong>terms and conditions</strong>. This text can be custom.

                <div class="form-group row">
                	<div class="col-sm-6">
                		<input type="submit" name="register" value="Register" id="register" class="register-btn">
                	</div>
                	<div class="col-sm-6">
                		<a href="login.php" id="login" class="login-btn">Login</a>
                	</div>
                </div>

            </div>
		</form>
	</div>
</section>
<script src="assets/js/jquery-3.3.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>