<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/doctor.php';

$database = new Database();
$db = $database->getConnection();

$doctor = new Doctor($db);

$stmt = $doctor->read_doctor();
 
$num = $stmt->rowCount();

 if($num>0){
    $doctors_arr=array();
    $doctors_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
        $user_info=array(
            "uid" => $uid,
			"did" => $did,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "dob" => $dob,
			"address" => $address,
			"degree" => $degree,
			"speciality" => $speciality,
			"remark" => $remark,
			"day0" => $day0,
			"day1" => $day1,
			"day2" => $day2,
			"day3" => $day3,
			"day4" => $day4,
			"day5" => $day5,
			"day6" => $day6,
			"stime" => $stime,
			"etime" => $etime,
			"created" => $created,
			"modified" => $modified
        );
		
        array_push($doctors_arr["records"], $user_info); 
		
    }
	echo json_encode($doctors_arr); 	
}
else{
    echo json_encode(
        array("message" => "No doctors found.")
    );
} 
?>