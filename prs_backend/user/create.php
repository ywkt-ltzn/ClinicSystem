<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate user object
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();

 $user = new User($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set user property values
$user->id = $data->id;
$user->name = $data->name;
$user->email = $data->email;
$user->phone = $data->phone;
$user->gender = $data->gender;
$user->dob = $data->dob;
$user->address = $data->address;
$user->password = $data->password;
$user->role = $data->role;
$user->uimage = $data->uimage;
$user->created = date('Y-m-d H:i:s');
$user->modified = date('Y-m-d H:i:s');

if ($user->id == 0){
	$uid = $user->create();
}
else{
	$uid = $user->update();
}

echo json_encode(array("message"=>$user->uimage));
// if($uid){
//     echo json_encode(array("message"=>"success","uid"=>$uid));
// }
// else{
//     echo json_encode(array("message"=>"fail"));
// }
?>