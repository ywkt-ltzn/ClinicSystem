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
$user->uid = isset($_GET['id']) ? $_GET['id'] : 0;
$user->email = isset($_GET['e']) ? $_GET['e'] : "";
$user->password = isset($_GET['p']) ? $_GET['p'] : "";
 
// read the details of user to be edited
$user->readOne();

// create array
 $user_arr = array(	
    "uid" => $user->uid,
    "name" => $user->name,
    "email" => $user->email,
    "phone" => $user->phone,
    "gender" => $user->gender,
    "dob" => $user->dob,
	"address" => $user->address,
	"role" => $user->role,
	"created" => $user->created,
	"modified" => $user->modified
);


// make it json format
print_r(json_encode($user_arr)); 
?>