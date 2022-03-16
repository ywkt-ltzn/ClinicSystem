<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/patient.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$patient = new Patient($db);
 
// set ID property of user to be edited
$patient->pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
$patient->code = isset($_GET['c']) ? $_GET['c'] : "";

// read the details of user to be edited
$patient->readOne_patient();

 $user_arr = array(	
    "uid" => $patient->id,
	"pid" => $patient->pid,
    "name" => $patient->name,
    "email" => $patient->email,
    "phone" => $patient->phone,
    "gender" => $patient->gender,
    "dob" => $patient->dob,
	"address" => $patient->address,
	"code" => $patient->code,
	"bloodtype" => $patient->bloodtype,
	"weight" => $patient->weight,
	"height" => $patient->height,
	"created" => $patient->created,
	"modified" => $patient->modified
);


// make it json format
print_r(json_encode($user_arr)); 
?>