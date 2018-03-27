<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\DB;
use Blab\Libs\users;

$db = DB::getDBInstance();

if (isset($_POST['register'])) {

	if ( !isset($_POST['terms']) || $_POST['terms'] != 'on') {

		$_SESSION['validation'] = array('terms' => "Must be agree with terms and condition");

		header('Location: ../../index.php');
		return;
	}
	
	$user = new Users;

	$result = $user->createUser($_POST);

}