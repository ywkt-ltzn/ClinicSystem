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
			"did" => $did,
            "name" => $name,
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