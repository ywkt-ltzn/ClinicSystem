<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);
 
// set ID property of user to be edited
$user->id = isset($_GET['id']) ? $_GET['id'] : 0;
$user->email = isset($_GET['e']) ? $_GET['e'] : "";
$user->password = isset($_GET['p']) ? md5($_GET['p']) : "";
 
// read the details of user to be edited
$user->readOne();
$user_arr = array(
		"status" => "success",
		"id" => $user->id,
		"name" => $user->name,
		"role" => $user->role,
		"role_name" => $user->role_name,
		"email" => $user->email
	);
// make it json format
print_r(json_encode($user_arr));
?>