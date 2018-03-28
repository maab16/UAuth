
<?php 
session_start();
include_once 'vendor/autoload.php';
use Blab\Libs\Input;
use Blab\Libs\Session;
use Blab\Libs\Users;
use Blab\Libs\DB;
$users = new Users;
$users->loggedInUser();

if (!Session::exists('user')) {
    
    header('Location: login.php');
}
if(Session::exists('user')):
    $user = $users->getUser(Session::get('user'));
?>
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
<section class="register-section">
	<div class="container">
		<form action="App/Lib/edit.php" method="post" enctype="multipart/form-data" class="regisret-form">
			<div class="validation-errors">
				<?php if(!empty($_SESSION['validation'])):?>
					<ul>
						<?php foreach($_SESSION['validation'] as $error):?>
							<li class="p-3 mb-2 bg-danger text-white"><?php echo $error;?></li>
						<?php endforeach;?>
					</ul>
				<?php endif;?>
			</div>
			<div class="form-head row">
				<div class="col-sm-6">
					<h3>Register an Account</h3>
				</div>
				<div class="col-sm-6 text-right">
					<a href="login.php">Already a member?</a>
				</div>
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
                            		<input type="text" name="first_name" class="first_name form-control " id="first_name" autocomplete="off" value="<?php echo (Session::exists('first_name')) ? Session::get('first_name') : $user->first_name;?>">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="last_name">Last Name</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="last_name" class="last_name form-control " id="last_name" value="<?php echo (Session::exists('last_name')) ? Session::get('last_name') : $user->last_name;?>" autocomplete="off">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="profile_picture">Profile Picture</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="file" name="profile_picture" id="profile_picture" class="profile_picture form-control " autocomplete="off">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="gender">Gender</label>
                            	</div>
                            	<div class="col-sm-8">
                                    <?php 
                                        if(Session::exists('gender')){
                                            $gender = Session::get('gender');
                                        }else {
                                            $gender = $user->gender;
                                        }
                                    ?>
                            		<input type="radio" name="gender" value="male" class="gender" <?php echo ($gender == 'male') ? 'checked' : '';?> >Male
                            		<input type="radio" name="gender" value="female" class="gender " <?php echo ($gender == 'female') ? 'checked' : '';?> >Female
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="home_address">Home Address</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<textarea class="home_address" name="home_address" id="home_address" value="<?php echo (Session::exists('home_address')) ? Session::get('home_address') : $user->home_address;?>"><?php echo (Session::exists('home_address')) ? Session::get('home_address') : $user->home_address;?></textarea>
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="district">District</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<select name="district" id="district" class="district">
                            			<?php if(Session::exists('district') || !empty($user->district)):?>
                            				<option value="<?php echo (Session::exists('district')) ? Session::get('district') : $user->district;?>"><?php echo (Session::exists('district')) ? Session::get('district') : $user->district;?></option>
                            			<?php else:?>
                            				<option value="">Select Your District</option>
                            			<?php endif;?>
                            			<?php 

                                            $db = DB::getDBInstance();

                                            $results = $db->query()
                                                        ->from('districts')
                                                        ->results();
                                            foreach($results as $result):

                                        ?>
                                            <option value="<?php echo $result->name;?>"><?php echo $result->name;?></option>
                                        <?php endforeach;?>
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
                            		<input type="text" name="company_name" id="company_name" class="form-control company_name" placeholder="Your Company Name" value="<?php echo (Session::exists('company_name')) ? Session::get('company_name') : $user->company_name;?>" autocomplete="off">
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="designation">Designation</label>
                            	</div>
                            	<div class="col-sm-8">
                                     <?php 
                                        if(Session::exists('designation')){
                                            $designation = Session::get('designation');
                                        }else {
                                            $designation = $user->designation;
                                        }
                                    ?>
                            		<input type="radio" name="designation" class="designation" value="Managing Director" autocomplete="off" <?php echo ($designation == 'Managing Director') ? 'checked' : '';?> > <span class="designation-text">Managing Director</span>
                            		<input type="radio" name="designation" class="designation" value="Director" autocomplete="off" <?php echo ($designation == 'Director') ? 'checked' : '';?> > <span class="designation-text">Director</span>
                            		<input type="radio" name="designation" class="designation" value="Propritor" autocomplete="off" <?php echo ($designation == 'Propritor') ? 'checked' : '';?> > <span class="designation-text">Propritor</span>
                            	</div>
                            </div>
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="office_address">Office Address</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<textarea class="office_address" name="office_address" id="office_address" value="<?php echo (Session::exists('office_address')) ? Session::get('office_address') : $user->office_address;?>"><?php echo (Session::exists('office_address')) ? Session::get('office_address') : $user->office_address;?></textarea>
                            	</div>
                            </div>
                            
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="verify_id">NID/Passport/Birth Certificte Number</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="verify_id" id="verify_id" class="form-control verify_id" placeholder="NID/Passport/Birth Certificte Number" value="<?php echo (Session::exists('verify_id')) ? Session::get('verify_id') : $user->verify_id;?>" autocomplete="off">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="tin">TIN</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="tin" id="tin" class="form-control tin" placeholder="TIN" value="<?php echo (Session::exists('tin')) ? Session::get('tin') : $user->tin;?>" autocomplete="off">
                            	</div>
                            </div>
                            
                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="trade_no">Trade Licenses No</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="trade_no" id="trade_no" class="form-control trade_no" placeholder="Trade Licenses No" value="<?php echo (Session::exists('trade_no')) ? Session::get('trade_no') : $user->trade_no;?>" autocomplete="off">
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
                		<input type="text" name="mobile" id="mobile" class="form-control mobile" placeholder="Mobile" value="<?php echo (Session::exists('mobile')) ? Session::get('mobile') : $user->mobile;?>" autocomplete="off">
                	</div>
                </div>
                
                <div class="form-group row">
                	<div class="col-sm-4">
                		<label id="phone_no">Phone Number</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="number" name="phone_no" id="phone_no" class="form-control phone_no" value="<?php echo (Session::exists('phone_no')) ? Session::get('phone_no') : $user->phone_no;?>" autocomplete="off">
                	</div>
                </div>

                <div class="form-group row">
                	<div class="col-sm-4">
                		<label id="email">Email Address</label>
                	</div>
                	<div class="col-sm-8">
                		<input type="email" name="email" id="email" class="form-control email" value="<?php echo (Session::exists('email')) ? Session::get('email') : $user->email;?>" autocomplete="off">
                	</div>
                </div>

                <div class="form-group row">
                    <input type="checkbox" name="hide_email" id="hide_email" class="hide_email" autocomplete="off" <?php echo (Session::get('hide_email') == 'on' || $user->hide_email == 1) ? 'checked' : '' ;?>> Hide Email From Public User
                </div>

                <h3 class="title">Login Details</h3>

				<div class="form-group row">
                	<div class="col-sm-4">
                		<label id="username">Username</label>
                	</div>
                	<div class="col-sm-8">
                		<p><?php echo $user->username;?></p>
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
                            		<input type="text" name="facebook" id="facebook" class="form-control facebook" value="<?php echo (Session::exists('facebook')) ? Session::get('facebook') : $user->facebook;?>" autocomplete="off">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="twitter">Twitter</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="twitter" id="twitter" class="form-control twitter" value="<?php echo (Session::exists('twitter')) ? Session::get('twitter') : $user->twitter;?>" autocomplete="off">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="google">Google+</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="google" id="google" class="form-control google" value="<?php echo (Session::exists('google')) ? Session::get('google') : $user->google;?>" autocomplete="off">
                            	</div>
                            </div>

                            <div class="form-group row">
                            	<div class="col-sm-4">
                            		<label id="website">Website Site(URL)</label>
                            	</div>
                            	<div class="col-sm-8">
                            		<input type="text" name="website" id="website" class="form-control website" value="<?php echo (Session::exists('website')) ? Session::get('website') : $user->website;?>" autocomplete="off">
                            	</div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group row">
                	<div class="col-sm-6">
                		<input type="submit" name="edit" value="Edit" id="edit" class="register-btn" autocomplete="off">
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
<?php endif;?>
<?php 

Session::delete('validation');

Session::delete('first_name');
Session::delete('last_name');
Session::delete('username');
Session::delete('gender');
Session::delete('home_address');
Session::delete('district');
Session::delete('facebook');
Session::delete('twitter');
Session::delete('google');
Session::delete('website');
Session::delete('company_name');
Session::delete('designation');
Session::delete('office_address');
Session::delete('verify_id');
Session::delete('tin');
Session::delete('trade_no');
Session::delete('mobile');
Session::delete('phone_no');
Session::delete('email');
Session::delete('hide_email');

?>