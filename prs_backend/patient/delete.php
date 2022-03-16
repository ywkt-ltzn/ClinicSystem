<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/patient.php';
 
$database = new Database();
$db = $database->getConnection();
 
$patient = new Patient($db);
$patient->pid = isset($_GET['pid']) ? $_GET['pid'] : die();
$patient->id = isset($_GET['id']) ? $_GET['id'] : die();

if($patient->delete_patient()){
	
     echo json_encode(array("message"=>"success"));
}
else{
    echo json_encode(array("message"=>"fail"));
}
?>