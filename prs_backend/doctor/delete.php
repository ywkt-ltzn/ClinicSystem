<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/doctor.php';
 
$database = new Database();
$db = $database->getConnection();
 
$doctor = new Doctor($db);
$doctor->did = isset($_GET['did']) ? $_GET['did'] : die();
$doctor->id = isset($_GET['uid']) ? $_GET['uid'] : die();

if($doctor->delete_doctor()){
	
     echo json_encode(array("message"=>"success"));
}
else{
    echo json_encode(array("message"=>"fail"));
}
?>