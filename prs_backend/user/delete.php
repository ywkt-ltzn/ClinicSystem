<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/user.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
$user->id = isset($_GET['id']) ? $_GET['id'] : die();
 
if($user->delete()){
     echo json_encode(array("message"=>"success"));
}
else{
    echo json_encode(array("message"=>"fail"));
}
?>