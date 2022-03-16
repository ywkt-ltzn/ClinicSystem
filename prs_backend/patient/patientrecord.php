<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/treatment.php';

$database = new Database();
$db = $database->getConnection();

$treatment = new Treatment($db);
$treatment->pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
$stmt = $treatment->patientrecord();
 
$num = $stmt->rowCount();

 if($num>0){
    $patients_arr=array();
    $patients_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
        $user_info=array(
			"tid" => $tid,
            "did" => $did,
			"pid" => $pid,
			"pid" => $pid,
			"code" => $code,
            "name" => $name,
            "dob" => $dob,
			"gender" => $gender,
			"address" => $address,
			"phone" => $phone,
			"bloodtype" => $bloodtype,
			"weight" => $weight,
			"height" => $height,
			"dname" => $dname,
			"degree" => $degree,
			"speciality" => $speciality,
			"history" => $history,
			"treatment" => $treatment,
			"tdate" => $tdate,
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