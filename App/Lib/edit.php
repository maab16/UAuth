<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\DB;
use Blab\Libs\users;

if (isset($_POST['edit'])) {

	$user = new Users;

	$result = $user->updateUser($_POST);

}