<?php
session_start();
include_once '../../vendor/autoload.php';

use Blab\Libs\users;

$user = new Users;

if (isset($_GET['type'],$_GET['value'])) {
	
	$type = strtolower(trim($_GET['type']));
	$value = trim($_GET['value']);

	$json_data['exists'] = false;

	if (in_array($type, ['username','email','password','re_password','alpha_numeric'])) {

		if ($type == 'username' || $type=='email') {
			
			switch ($type) {
				case 'username':
						$check = $user->checkUsername($value);
					break;

				case 'email':
					
					$check = $user->checkUserEmail($value);
					break;
				
			}

			if($check){

				$json_data['exists'] = true;

			}
		}else if ($type=='password') {

			if (!preg_match('/^.(?=.{8,})(?=.[a-z])(?=.[A-Z])(?=.[\d\W]).*$/',$value)) {

					if (!preg_match('/(?=.*[A-Z])/',$value)) {

						$json_data['exists'] = true;

					}else if (!preg_match('/(?=.*[\d])/',$value)) {

						$json_data['exists'] = true;
					}else if (!preg_match('/(?=.*[a-z])/',$value)) {

						$json_data['exists'] = true;
					}else if (!preg_match('/(?=.*[\W])/',$value)) {

						$json_data['exists'] = true;
					}else if (!preg_match('/(?=.{8,})/',$value)) {

						$json_data['exists'] = true;
					}
			}else{

				$json_data['exists'] = false;
			}

			$_SESSION['verify_password']=$value;

		}else if ($type=='re_password') {

			if(isset($_SESSION['verify_password'])){
				$password = $_SESSION['verify_password'];
			}else {
				$password = null;
			}

			if($value === $password){

				$json_data['exists'] = false;
			}else{
				$json_data['exists'] = true;
			}		
		}else if($type == 'alpha_numeric') {
			if (ctype_alnum($value)) {
				$json_data['exists'] = false;
			}else {
				$json_data['exists'] = true;
			}
		}

		
	}

	echo json_encode($json_data);
}