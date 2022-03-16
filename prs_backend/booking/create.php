<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';

include_once '../objects/booking.php';
 
$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);

$data = json_decode(file_get_contents("php://input"));

$booking->did = $data->did;
$booking->pid = $data->pid;
$booking->bookingtime = $data->bookingtime;
//$booking->bookingtime = date('Y-m-d H:i:s');
$booking->created = date('Y-m-d H:i:s');
$booking->modified = date('Y-m-d H:i:s');

$bid = $booking->create();
if($bid){
		echo json_encode(array("message" => "success"));
	}
	else{
		echo json_encode(array("message" => "fail"));
	}
?>