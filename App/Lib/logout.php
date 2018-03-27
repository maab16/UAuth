<?php

session_start();

include_once '../../vendor/autoload.php';

use Blab\Libs\DB;
use Blab\Libs\users;

$db = DB::getDBInstance();


$user = new Users;

$user->logOutUser($_POST);
