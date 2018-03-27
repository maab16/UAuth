<?php 
session_start();

include_once 'vendor/autoload.php';

use Blab\Libs\Users;
use Blab\Libs\Session;
$users = new Users;

$users->loggedInUser();

if(!Session::exists('user')){
    header('Location: login.php');
}

$user = $users->getUser(Session::get('user'));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <!-- Template Layout | Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Template Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <!-- Brand/logo -->
      <a class="navbar-brand" href="#">Logo</a>
      
      <!-- Links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="App/Lib/logout.php">Log out</a>
        </li>
      </ul>
    </nav>
    <section class="content">
        <div class="container">
            <div class="row">
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
                                <?php if(!empty($user->first_name)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="first_name">First Name</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->first_name;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->last_name)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="last_name">Last Name</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->last_name;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->profile_picture)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="profile_picture">Profile Picture</label>
                                    </div>
                                    <div class="col-sm-8 profile-image">
                                        <?php

                                            if(!empty($user->profile_picture)){
                                                $file = 'App/public/assets/images/'.$user->profile_picture;

                                                if(file_exists($file)){
                                                    $link = $file;
                                                }else{
                                                    $link = 'App/public/assets/images.avator.jpg';
                                                }
                                            }else{
                                                $link = 'App/public/assets/images.avator.jpg';
                                            }
                                        ?>
                                        <figure class="profile-image-container">
                                            <img src="<?php echo $link;?>" alt="user image">
                                        </figure>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->gender)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="gender">Gender</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="radio" name="gender" value="male" class="gender" <?php echo ($user->gender == 'male') ? 'checked' : '';?> >Male
                                        <input type="radio" name="gender" value="female" class="gender" <?php echo ($user->gender == 'female') ? 'checked' : '';?> >Female
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->home_address)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="home_address">Home Address</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->home_address;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->district)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="district">District</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->district;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
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
                                <?php if(!empty($user->company_name)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="company_name">Company Name</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->company_name;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->designation)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="designation">Designation</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="radio" name="designation" class="designation" value="Managing Director" autocomplete="off" <?php echo ($user->designation == 'Managing Director') ? 'checked' : '';?>> <span class="designation-text">Managing Director</span>
                                        <input type="radio" name="designation" class="designation" value="Director" autocomplete="off" <?php echo ($user->designation == 'Director') ? 'checked' : '';?>> <span class="designation-text">Director</span>
                                        <input type="radio" name="designation" class="designation" value="Propritor" autocomplete="off" <?php echo ($user->designation == 'Propritor') ? 'checked' : '';?>> <span class="designation-text">Propritor</span>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->office_address)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="office_address">Office Address</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->office_address;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->verify_id)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="verify_id">NID/Passport/Birth Certificte Number</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->verify_id;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->tin)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="tin">TIN</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->tin;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->trade_no)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="trade_no">Trade Licenses No</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->trade_no;?></p>
                                    </div>
                                </div>
                                <?php endif;?>

                            </div>
                        </div>
                    </div>

                    <h3 class="title">Contact Details</h3>
                    <?php if(!empty($user->mobile)):?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="mobile">Mobile</label>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $user->mobile;?></p>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(!empty($user->phone_no)):?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="phone_no">Phone Number</label>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $user->phone_no;?></p>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(!empty($user->email)):?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="email">Email Address</label>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $user->email;?></p>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if(!empty($user->hide_email)):?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="email">Hide Email</label>
                        </div>
                        <div class="col-sm-8">
                            <?php if($user->hide_email == true):?>
                                <p>Yes</p>
                            <?php else:?>
                                <p>No</p>
                            <?php endif;?>
                        </div>
                    </div>
                    <?php endif;?>
                    <h3 class="title">Login Details</h3>
                    <?php if(!empty($user->username)):?>
                    <div class="form-group row">
                        <div class="col-sm-4">
                            <label id="username">Username</label>
                        </div>
                        <div class="col-sm-8">
                            <p><?php echo $user->username;?></p>
                        </div>
                    </div>
                    <?php endif;?>
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
                                <?php if(!empty($user->facebook)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="facebook">Facebook Page</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->facebook;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->twitter)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="twitter">Twitter</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->twitter;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->google)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="google">Google+</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->google;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                                <?php if(!empty($user->website)):?>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <label id="website">Website Site(URL)</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <p><?php echo $user->website;?></p>
                                    </div>
                                </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>