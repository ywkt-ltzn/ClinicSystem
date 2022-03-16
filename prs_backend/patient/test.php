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
$patient->pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
$patient->code = isset($_GET['c']) ? $_GET['c'] : "";

$patient->readOne_patient();

/* $user_arr = array(	
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
	"weitht" => $patient->weitht,
	"height" => $patient->height,
	"created" => $patient->created,
	"modified" => $patient->modified
	); */
	$patient_arr = array("uid" => $patient->id,
	"pid" => $patient->pid,
    "name" => $patient->name,
    "email" => $patient->email,
    "phone" => $patient->phone,
    "gender" => $patient->gender,
    "dob" => $patient->dob,"address" => $patient->address,
	"code" => $patient->code,"bloodtype" => $patient->bloodtype,"weight" => $patient->weight,"height" => $patient->height,
"created" => $patient->created,"modified" => $patient->modified);
print_r(json_encode($patient_arr));
/* echo json_encode(array("uid" => $patient->id,
	"pid" => $patient->pid,
    "name" => $patient->name,
    "email" => $patient->email,
    "phone" => $patient->phone,
    "gender" => $patient->gender,
    "dob" => $patient->dob,"address" => $patient->address,
	"code" => $patient->code,"bloodtype" => $patient->bloodtype,"weight" => $patient->weight,"height" => $patient->height,
"created" => $patient->created,"modified" => $patient->modified));
 */?>