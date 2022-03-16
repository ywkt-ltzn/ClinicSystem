<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/treatment.php';
 
$database = new Database();
$db = $database->getConnection();

$treatment = new Treatment($db);

$data = json_decode(file_get_contents("php://input"));

$treatment->tid = $data->tid;

$tid = $treatment->update();
if($tid){
		echo json_encode(array("message" => "success"));
	}
	else{
		echo json_encode(array("message" => "fail"));
	}
?>