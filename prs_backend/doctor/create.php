<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/doctor.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();

$doctor = new Doctor($db);

$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

$doctor->did = $data->did;
$doctor->id = $data->id;
$doctor->uid = $data->id;
$doctor->degree = $data->degree;
$doctor->speciality = $data->speciality;
$doctor->remark = $data->remark;
$doctor->day0 = $data->day0;
$doctor->day1 = $data->day1;
$doctor->day2 = $data->day2;
$doctor->day3 = $data->day3;
$doctor->day4 = $data->day4;
$doctor->day5 = $data->day5;
$doctor->day6 = $data->day6;
$doctor->stime = $data->stime;
$doctor->etime = $data->etime;
$doctor->created = date('Y-m-d H:i:s');
$doctor->modified = date('Y-m-d H:i:s');

$doctor->name = $data->name;
$doctor->email = $data->email;
$doctor->phone = $data->phone;
$doctor->gender = $data->gender;
$doctor->dob = $data->dob;
$doctor->address = $data->address;
$doctor->password = $data->password;
$doctor->role = $data->role;

if ($doctor->did == 0){
	$did = $doctor->create_doctor();
}
else{
 	$did = $doctor->update_doctor();
}

//echo json_encode(array("message" => $did)); 
if($did){
		echo json_encode(array("message" => "success"));
	}
	else{
		echo json_encode(array("message" => "fail"));
	}
 /* try { 
	$db->beginTransaction(); 
	//user
	if ($doctor->did == 0){
		$uid = $user->create();
		if(!$uid){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$doctor->uid = $uid;
		$did = $doctor->create();
	}
	else{
		$user->readOne();
		if(!$user){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$uid = $user->update();
		if(!$uid){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$did = $doctor->update();
	}
	
	if($did){
		$db->commit(); 
		echo json_encode(array("status" => "success","did"=>$did));
	}
	else{
		$db->rollback(); 
		echo json_encode(array("status" => "fail"));
	}
	
	
} catch(PDOExecption $e) { 
	$db->rollback(); 
	echo json_encode(
        array("status" => "fail")
    );
} */
?>