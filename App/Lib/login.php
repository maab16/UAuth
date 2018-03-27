<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\DB;
use Blab\Libs\users;

$db = DB::getDBInstance();

if (isset($_POST['login'])) {

	$user = new Users;

	$result = $user->logInUser($_POST);

	// Users

	

	//header('Location: /entab/login.php');
}