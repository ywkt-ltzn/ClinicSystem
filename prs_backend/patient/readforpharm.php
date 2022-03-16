<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/treatment.php';

$database = new Database();
$db = $database->getConnection();

$treatment = new Treatment($db);
$stime = isset($_GET['stime']) ? $_GET['stime'] : "";
$code = isset($_GET['code']) ? $_GET['code'] : "";
$stmt = $treatment->readforpharm($stime,$code);
 
$num = $stmt->rowCount();

 if($num>0){
    $patients_arr=array();
    $patients_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
        $user_info=array(
			"tid" => $tid,
            "uid" => $uid,
			"pid" => $pid,
            "name" => $name,
            "dob" => $dob,
			"code" => $code,
			"dname" => $dname,
			"treatment" => $treatment,
			"tdate" => $tdate
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