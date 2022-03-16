<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/patient.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);
$data = json_decode(file_get_contents("php://input"));

$patient->pid = $data->pid;
$patient->id = $data->id;
$patient->bloodtype = $data->bloodtype;
$patient->weight = $data->weight;
$patient->height = $data->height;
$patient->created = date('Y-m-d H:i:s');
$patient->modified = date('Y-m-d H:i:s');

$patient->name = $data->name;
$patient->email = $data->email;
$patient->phone = $data->phone;
$patient->gender = $data->gender;
$patient->dob = $data->dob;
$patient->address = $data->address;
$patient->password = $data->password;
$patient->role = $data->role;
 
if ($patient->pid == 0){
	$pid = $patient->create_patient();
}
else{
	$pid = $patient->update_patient();
}
if($pid){
		echo json_encode(array("message" => "success","code" => $patient->code));
	}
	else{
		echo json_encode(array("message" => "fail"));
	}
?>