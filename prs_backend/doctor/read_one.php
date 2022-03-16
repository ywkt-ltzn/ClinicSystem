<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/doctor.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$doctor = new Doctor($db);
 
// set ID property of user to be edited
$doctor->did = isset($_GET['id']) ? $_GET['id'] : 0;
$doctor->email = isset($_GET['e']) ? $_GET['e'] : "";
$doctor->password = isset($_GET['p']) ? $_GET['p'] : "";
 
// read the details of user to be edited
$doctor->readOne_doctor();

// create array
 $user_arr = array(	
    "uid" => $doctor->id,
	"did" => $doctor->did,
    "name" => $doctor->name,
    "email" => $doctor->email,
    "phone" => $doctor->phone,
    "gender" => $doctor->gender,
    "dob" => $doctor->dob,
	"address" => $doctor->address,
	"role" => $doctor->role,
	"degree" => $doctor->degree,
	"speciality" => $doctor->speciality,
	"remark" => $doctor->remark,
	"day0" => $doctor->day0,
	"day1" => $doctor->day1,
	"day2" => $doctor->day2,
	"day3" => $doctor->day3,
	"day4" => $doctor->day4,
	"day5" => $doctor->day5,
	"day6" => $doctor->day6,
	"stime" => $doctor->stime,
	"etime" => $doctor->etime,
	"created" => $doctor->created,
	"modified" => $doctor->modified
);


// make it json format
print_r(json_encode($user_arr)); 
?>