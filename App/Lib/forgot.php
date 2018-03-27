<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\users;


if (isset($_POST['forgot'])) {

	$user = new Users;

	$result = $user->forgotPassword($_POST);
}