<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/patient.php';

$database = new Database();
$db = $database->getConnection();

$patient = new Patient($db);

$stmt = $patient->read_patient();
 
$num = $stmt->rowCount();

 if($num>0){
    $patients_arr=array();
    $patients_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
        $user_info=array(
            "uid" => $uid,
			"pid" => $pid,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "dob" => $dob,
			"address" => $address,
			"code" => $code,
			"bloodtype" => $bloodtype,
			"weight" => $weight,
			"height" => $height,
			"created" => $created,
			"modified" => $modified
        );
		
        array_push($patients_arr["records"], $user_info); 
		
    }
	echo json_encode($patients_arr); 	
}
else{
    echo json_encode(
        array("message" => "No doctors found.")
    );
} 
?>