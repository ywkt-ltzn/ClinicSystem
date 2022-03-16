<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/booking.php';

$database = new Database();
$db = $database->getConnection();

$booking = new Booking($db);
$booking->did = isset($_GET['did']) ? $_GET['did'] : 0;
$uid = isset($_GET['uid']) ? $_GET['uid'] : 0;
$stime = isset($_GET['stime']) ? $_GET['stime'] : date('Y-m-d');
//$stime =  date('Y-m-d');
$stmt = $booking->read($stime,$uid);
 
$num = $stmt->rowCount();

 if($num>0){
    $app_arr=array();
    $app_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		extract($row);
		
        $user_info=array(
            "uid" => $uid,
			"did" => $did,
			"pid" => $pid,
			"bid" => $bid,
            "bookingtime" => $bookingtime,
			"name" => $name,
            "phone" => $phone,
            "gender" => $gender,
            "dob" => $dob,
			"address" => $address,
			"code" => $code
        );
		
        array_push($app_arr["records"], $user_info); 
		
    }
	echo json_encode($app_arr); 	
}
else{
    echo json_encode(
        array("message" => "No appointment list.")
    );
} 
?>