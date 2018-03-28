<?php
namespace Blab\Libs;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Users extends DB
{
	public function updateUser($source) {
		$input = new Input();

		$email = $this->_db->query()
						->from("users")
						->where(array('username'=> Session::get('user')),'!=')
						->andWhere(array('email'=>Input::get('email')))
						->firstResult();

		if ($email == null) {
			$salt = hash::salt(32);
			try{

				$result = $this->_db->query()
						->into("users")
						->where(array('username'=> Session::get('user')))
						->update([
							'email' => Input::get('email'),
							"updated_at"	=>date("Y-m-d"),
							]
						);

				// Get recent user data
				
				$user = $this->_db->query()
						->from("users")
						->where(array('username'=> Session::get('user')),'=')
						->firstResult();

				// Profile

				$product_image_name = $_FILES['profile_picture']['name'];
				$image_tmp = $_FILES['profile_picture']['tmp_name'];
				if(is_uploaded_file($image_tmp)){
					move_uploaded_file($image_tmp,'../public/assets/images/'.$product_image_name);
					$result = $this->_db->query()
							->into("profiles")
							->where(array('user_id'=> $user->id))
							->update([
								'first_name' => Input::get('first_name'),
								'last_name' => Input::get('last_name'),
								'profile_picture' => $product_image_name,
								'gender' => Input::get('gender'),
								'home_address' => Input::get('home_address'),
								'district' => Input::get('district'),
								'facebook' => Input::get('facebook'),
								'twitter' => Input::get('twitter'),
								'google' => Input::get('google'),
								'website' => Input::get('website'),
								"updated_at"	=>date("Y-m-d"),
							]
						);
				}else{

					$result = $this->_db->query()
							->into("profiles")
							->where(array('user_id'=> $user->id))
							->update([
								'first_name' => Input::get('first_name'),
								'last_name' => Input::get('last_name'),
								'gender' => Input::get('gender'),
								'home_address' => Input::get('home_address'),
								'district' => Input::get('district'),
								'facebook' => Input::get('facebook'),
								'twitter' => Input::get('twitter'),
								'google' => Input::get('google'),
								'website' => Input::get('website'),
								"updated_at"	=>date("Y-m-d"),
							]
						);

				}

				// Account 
				$account = $this->_db->query()
							->into("accounts")
							->where(array('user_id'=>$user->id))
							->update(array(
								'company_name' => Input::get('company_name'),
								'designation' => Input::get('designation'),
								'office_address' => Input::get('office_address'),
								'verify_id' => Input::get('verify_id'),
								'tin' => Input::get('tin'),
								'trade_no' => Input::get('trade_no'),
								"updated_at"	=>date("Y-m-d"),
						));

				// Contact
				$contact = $this->_db->query()
							->into("contacts")
							->where(array('user_id'=>$user->id))
							->update(array(
								'mobile' => Input::get('mobile'),
								'phone_no' => Input::get('phone_no'),
								'hide_email' => (Input::get('hide_email') == 'on') ? 1 : 0,
								"updated_at"	=>date("Y-m-d"),
						));
				header('Location: ../../profile.php');
										
			} catch (Exception $e) {
				die($e->getMessage());
										
			}
		}else{
			Session::set('validation', $validation->errors());

			Session::set('first_name',Input::get('first_name'));
			Session::set('last_name',Input::get('last_name'));
			Session::set('username',Input::get('username'));
			Session::set('gender',Input::get('gender'));
			Session::set('home_address',Input::get('home_address'));
			Session::set('district',Input::get('district'));
			Session::set('facebook',Input::get('facebook'));
			Session::set('twitter',Input::get('twitter'));
			Session::set('google',Input::get('google'));
			Session::set('website',Input::get('website'));
			Session::set('company_name',Input::get('company_name'));
			Session::set('designation',Input::get('designation'));
			Session::set('office_address',Input::get('office_address'));
			Session::set('verify_id',Input::get('verify_id'));
			Session::set('tin',Input::get('tin'));
			Session::set('trade_no',Input::get('trade_no'));
			Session::set('mobile',Input::get('mobile'));
			Session::set('phone_no',Input::get('phone_no'));
			Session::set('email',Input::get('email'));
			Session::set('hide_email',Input::get('hide_email'));

			header('Location: ../../edit.php');
			//return $validation->errors();
		}
	}

	public function getUser($user){
		return $this->_db->query()
					->from("users")
					->where(array('username'=>$user))
					->join('INNER',"profiles","profiles.user_id=users.id")
					->join('INNER',"accounts","accounts.user_id=users.id")
					->join('INNER',"contacts","contacts.user_id=users.id")
					->firstResult();
	}
	public function createUser($source){
		$input = new Input();
		$active_token = Hash::unique();
		$verification_code = mt_rand(100000, 999999);

		$today = date('Y-m-d H:i:s');
		$expiry = date('Y-m-d H:i:s', strtotime("+1 days"));
								
		$validation = $input->check($source,array(
			'first_name' => array(
				'required'	=>true,
					'min'	=>5,
					'max'	=>255,
				),
			'username'=>array(
					'required'	=>true,
					'min'		=>5,
					'max'		=>255,
					'unique'	=>'users'
					),
			'email'=>array(
					'required'	=>true,
					),
			'password'=>array(
					'required'		=>true,
					'min'			=>8,
					'preg_match'	=>array('number','capital_letter','small_letter','special_charecter'),
					),
			're_password'=>array(
					'required'	=>true,
					'matches'	=>'password'
					),							
		));
		if ($validation->passed()) {
			$salt = hash::salt(32);
			try{

				// User
				$result =  $this->_db->query()
						->into("users")
						->insert(array(
								"username"			=>Input::get('username'),
								'email' 			=> Input::get('email'),
								"password"			=> password_hash(Input::get('password'), PASSWORD_DEFAULT),
								"active_token" 		=> $active_token,
								"verification_code" => $verification_code,
								"expiry"			=> $expiry,
								"active"			=>0,
								"grp" 				=> 1,
								"created_at"		=>date("Y-m-d"),
								"updated_at"		=>date("Y-m-d"),
								));

				// Get recent user data
				
				$user = $this->_db->query()
						->from("users")
						->where(array('username'=>Input::get('username')),'=')
						->firstResult();

				// Profile

				$product_image_name = $_FILES['profile_picture']['name'];
				$image_tmp = $_FILES['profile_picture']['tmp_name'];

				if (is_uploaded_file($image_tmp)) {
					
					move_uploaded_file($image_tmp,'../public/assets/images/'.$product_image_name);

					$profile = $this->_db->query()
								->into("profiles")
								->insert(array(
									'user_id'=> $user->id,
									'first_name' => Input::get('first_name'),
									'last_name' => Input::get('last_name'),
									'profile_picture' => $product_image_name,
									'gender' => Input::get('gender'),
									'home_address' => Input::get('home_address'),
									'district' => Input::get('district'),
									'facebook' => Input::get('facebook'),
									'twitter' => Input::get('twitter'),
									'google' => Input::get('google'),
									'website' => Input::get('website'),
									"created_at"	=>date("Y-m-d"),
									"updated_at"	=>date("Y-m-d"),
							));
				}else {
					$profile = $this->_db->query()
								->into("profiles")
								->insert(array(
									'user_id'=> $user->id,
									'first_name' => Input::get('first_name'),
									'last_name' => Input::get('last_name'),
									'gender' => Input::get('gender'),
									'home_address' => Input::get('home_address'),
									'district' => Input::get('district'),
									'facebook' => Input::get('facebook'),
									'twitter' => Input::get('twitter'),
									'google' => Input::get('google'),
									'website' => Input::get('website'),
									"created_at"	=>date("Y-m-d"),
									"updated_at"	=>date("Y-m-d"),
							));
				}
				

				// Account 
				$account = $this->_db->query()
							->into("accounts")
							->insert(array(
								'user_id'=> $user->id,
								'company_name' => Input::get('company_name'),
								'designation' => Input::get('designation'),
								'office_address' => Input::get('office_address'),
								'verify_id' => Input::get('verify_id'),
								'tin' => Input::get('tin'),
								'trade_no' => Input::get('trade_no'),
								"created_at"	=>date("Y-m-d"),
								"updated_at"	=>date("Y-m-d"),
						));

				// Contact
				$contact = $this->_db->query()
							->into("contacts")
							->insert(array(
								'user_id'=> $user->id,
								'mobile' => Input::get('mobile'),
								'phone_no' => Input::get('phone_no'),
								'hide_email' => (Input::get('hide_email') == 'on') ? 1 : 0,
								"created_at"	=>date("Y-m-d"),
								"updated_at"	=>date("Y-m-d"),
						));

				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				    //Server settings
				    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'sg3plcpnl0026.prod.sin3.secureserver.net';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'test@khalilandassociates.com';                 // SMTP username
				    $mail->Password = 'Phpmaster@admin';                           // SMTP password
				    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 465;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom('test@khalilandassociates.com', 'Projukti');
				    $mail->addAddress($user->email, $user->username);     // Add a recipient
				            
				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');


				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Account Activation';
				    $mail->Body    = "hello ".$user->username.", <br> <a href='http://localhost/entab/App/Lib/active_account.php?token=".$active_token."&id=".$user->id."'>Click here for activate your account</a> </br> Verification Code: ".$verification_code;
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    echo 'Message has been sent';
				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}

				header('Location: ../view/signup_success.php');
										
			} catch (Exception $e) {
				die($e->getMessage());
										
			}
		}else{
			Session::set('validation', $validation->errors());

			Session::set('first_name',Input::get('first_name'));
			Session::set('last_name',Input::get('last_name'));
			Session::set('username',Input::get('username'));
			Session::set('gender',Input::get('gender'));
			Session::set('home_address',Input::get('home_address'));
			Session::set('district',Input::get('district'));
			Session::set('facebook',Input::get('facebook'));
			Session::set('twitter',Input::get('twitter'));
			Session::set('google',Input::get('google'));
			Session::set('website',Input::get('website'));
			Session::set('company_name',Input::get('company_name'));
			Session::set('designation',Input::get('designation'));
			Session::set('office_address',Input::get('office_address'));
			Session::set('verify_id',Input::get('verify_id'));
			Session::set('tin',Input::get('tin'));
			Session::set('trade_no',Input::get('trade_no'));
			Session::set('mobile',Input::get('mobile'));
			Session::set('phone_no',Input::get('phone_no'));
			Session::set('email',Input::get('email'));
			Session::set('hide_email',Input::get('hide_email'));

			header('Location: ../../signup.php');
			//return $validation->errors();
		}
	}

	public function logInUser($source){
		$input = new Input();
								
		$validation = $input->check($source,array(
			'username'=>array(
					'required'	=>true,
					'min'		=>5,
					'max'		=>255,
					),
			'password'=>array(
					'required'		=>true,
					'min'			=>8,
					'preg_match'	=>'password'
					),						
		));
		if ($validation->passed()) {
			$salt = hash::salt(32);
			try{

				$remember = (Input::get('remember_me') == 'on') ? true : false;

				$data = $this->_db->query()
						->from('users')
						->where(array('username'=> Input::get('username')))
						->firstResult();

				if(password_verify(Input::get('password'), $data->password) && $data->active==1) {

				    Session::set('user',$data->username);
				    
					if ($remember) {
						
						$hash = Hash::unique();
						$hashChek = $this->_db->query()
									->from('users_session')
									->where(array('user_id'=>$data->id))
									->firstResult();
						if (!$hashChek) {
							
							$this->_db->query()
							->into('users_session')
							->insert(array(
								'user_id'=>$data->id,
								'hash'=>$hash
								));
						}else{
							$hash = $hashChek->hash;
						}
						Cookie::put('user',$hash,3600);
						
					}

					header('Location: ../../profile.php');
				}else{
					Session::set('validation', ['login' => 'Username and Password Combination Incorrect']);
					header('Location: ../../login.php');
				}
										
			} catch (Exception $e) {
				die($e->getMessage());
										
			}
		}else{
			$_SESSION['validation'] = $validation->errors();

			header('Location: ../../login.php');
			//return $validation->errors();
		}
	}

	public function loggedInUser() {

		if (Cookie::exists('user') && !Session::exists('user')) {
			
			$hash = Cookie::get('user');

			$cookie = $this->_db->query()
						->from('users_session')
						->where(array('hash'=> $hash))
						->firstResult();
			if ($cookie) {
				$data = $this->_db->query()
						->from('users')
						->where(array('id'=> $cookie->user_id))
						->firstResult();
				Session::set('user',$data->username);
				return true;
			}
		}
	}

	public function logOutUser(){

		$data = $this->_db->query()
						->from('users')
						->where(array('username'=> Session::get('user')))
						->firstResult();

		$this->_db->query()
				  ->from('users_session')
				  ->where(array(
					'user_id'=>$data->id
				  ))
				  ->delete();
		Session::delete('user');
		Cookie::delete('user');
		header('Location: ../../login.php');
	}

	public function forgotPassword(){

		$token = Hash::unique();

		$fieldValue = Input::get('email_username');

			if (filter_var($fieldValue, FILTER_VALIDATE_EMAIL)) {
				
				$field = 'email';
			}else{

				$field = 'username';
			}

		$user = $this->_db->query()
						->from('users')
						->where(array($field => $fieldValue))
						->firstResult();

		$profile = $this->_db->query()
						->from('profiles')
						->where(array('user_id' => $user->id))
						->firstResult();

		if(!empty($user)){
			$forgot_token = $this->_db->query()
						->from('forgot_password')
						->where(array( 'user_id' => $user->id))
						->firstResult();

			$today = date('Y-m-d H:i:s');
			$expiry = date('Y-m-d H:i:s', strtotime("+1 days"));

			if(!empty($forgot_token)){

				$result = $this->_db->query()
							->into("forgot_password")
							->where(array('user_id'=> $user->id))
							->update([
									'token' => $token,
									'expiry' => $expiry,
									"updated_at" => $today
								]
							);

			}else{
				$result = $this->_db->query()
						  ->into('forgot_password')
						  ->insert(array(
									'user_id'=> $user->id,
									"token" => $token,
									'expiry' => $expiry,
									"created_at"	=> $today,
									"updated_at"	=> $today,
							));
			}
			
			if ($result) {
				// Import PHPMailer classes into the global namespace
				// These must be at the top of your script, not inside a function

				$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
				try {
				    //Server settings
				    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
				    $mail->isSMTP();                                      // Set mailer to use SMTP
				    $mail->Host = 'sg3plcpnl0026.prod.sin3.secureserver.net';  // Specify main and backup SMTP servers
				    $mail->SMTPAuth = true;                               // Enable SMTP authentication
				    $mail->Username = 'test@khalilandassociates.com';                 // SMTP username
				    $mail->Password = 'Phpmaster@admin';                           // SMTP password
				    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
				    $mail->Port = 465;                                    // TCP port to connect to

				    //Recipients
				    $mail->setFrom('test@khalilandassociates.com', 'Projukti');
				    $mail->addAddress($user->email, $profile->first_name." ".$profile->last_name);     // Add a recipient
				            
				    //$mail->addReplyTo('info@example.com', 'Information');
				    //$mail->addCC('cc@example.com');
				    //$mail->addBCC('bcc@example.com');


				    //Content
				    $mail->isHTML(true);                                  // Set email format to HTML
				    $mail->Subject = 'Password Reset';
				    $mail->Body    = "hello ".$profile->first_name." ".$profile->last_name.", <br> <a href='http://localhost/entab/App/Lib/reset_password.php?token=".$token."'>Reset password</a>";
				    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

				    $mail->send();
				    echo 'Message has been sent';
				} catch (Exception $e) {
				    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}
			}
		}

		header('Location: ../../login.php');
	}

	public function verifyForgotToken() {
		$forgot_token = $this->_db->query()
						->from('forgot_password')
						->where(array( 'token' => Input::get('token')))
						->firstResult();


		if($forgot_token && ($forgot_token->expiry > date('Y-m-d H:i:s'))){
			return true;
		}

		return false;
						
	}

	public function changeUserPassword(){
		$forgot_token = $this->_db->query()
						->from('forgot_password')
						->where(array( 'token' => Input::get('token')))
						->firstResult();

		if($forgot_token) {
			$result = $this->_db->query()
						->into("users")
						->where(array('id'=> $forgot_token->user_id))
						->update([
								'password' => password_hash(Input::get('password'), PASSWORD_DEFAULT),
								"updated_at"	=>date("Y-m-d")
							]
						);
			if($result) {
				$this->_db->query()
					  ->from('forgot_password')
					  ->where(array(
						'user_id'=>$forgot_token->user_id
					  ))
					  ->delete();
				header('Location: ../../login.php');
			}
		}
	}

	public function verifyAccount() {
		$user = $this->_db->query()
						->from('users')
						->where(array( 'id' => Input::get('id')))
						->firstResult();


		if($user->active_token == Input::get('token') && ($user->expiry > date('Y-m-d H:i:s'))){
			return true;
		}

		return false;
						
	}

	public function activateAccount(){

		$user = $this->_db->query()
						->from('users')
						->where(array( 'id' => Input::get('id')))
						->firstResult();

		if($user->active_token == Input::get('token') && ($user->verification_code == Input::get('verification_code')) && ($user->expiry > date('Y-m-d H:i:s'))){
			$result = $this->_db->query()
						->into("users")
						->where(array('id'=> Input::get('id')))
						->update([
								'active' => 1,
								"updated_at"	=>date("Y-m-d")
							]
						);
			if($result) {
				$this->_db->query()
					  ->from('users')
					  ->where(array(
						'id'=>$user->id
					  ))
					  ->update([
								'active_token' => null,
								'verification_code' => null,
							]
						);
				header('Location: ../../login.php');
			}
		}
	}

	public function sendMail($email,$subject,$body,$alt_body="Alt Body") {
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'email-smtp.us-east-1.amazonaws.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'AKIAJT7O7HYLLCQXCGSA';                 // SMTP username
		    $mail->Password = 'An61FCGNm1qTkTmpuQwWrvRSzQaRx95cv9lzjI7xWnrV';                           // SMTP password
		    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 465;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom('kasaram.bs1@gmail.com', 'Projukti');
		    $mail->addAddress($email);     // Add a recipient
		            
		    //$mail->addReplyTo('info@example.com', 'Information');
		    //$mail->addCC('cc@example.com');
		    //$mail->addBCC('bcc@example.com');


		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $body;
		    $mail->AltBody = $alt_body;

		    $mail->send();
		    echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}

	/* Check User */

	public function checkUsername($value){
		$result = $this->_db->query()
				  ->from('users')
				  ->where(array('username' => $value))
				  ->firstResult();
		if($result)
		{
			return true;
		}
		return false;
	}
	public function checkUserEmail($value){
		$result = $this->_db->query()
				  ->from('users')
				  ->where(array('email' => $value))
				  ->firstResult();
		if($result)
		{
			return true;
		}
		return false;
	}
}