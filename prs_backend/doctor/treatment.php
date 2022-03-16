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
$treatment->uid = $data->uid;
$treatment->pid = $data->pid;
$treatment->history = $data->history;
$treatment->treatment = $data->treatment;
$treatment->issuepharm = $data->issuepharm;
$treatment->created = date('Y-m-d H:i:s');
$treatment->modified = date('Y-m-d H:i:s');

$tid = $treatment->create();
if($tid){
		echo json_encode(array("message" => "success"));
	}
	else{
		echo json_encode(array("message" => "fail"));
	}
 /* try { 
	$db->beginTransaction(); 
	//user
	if ($doctor->did == 0){
		$uid = $user->create();
		if(!$uid){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$doctor->uid = $uid;
		$did = $doctor->create();
	}
	else{
		$user->readOne();
		if(!$user){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$uid = $user->update();
		if(!$uid){
			$db->rollback(); 
			echo json_encode(array("status" => "fail"));
			exit;
		}
		$did = $doctor->update();
	}
	
	if($did){
		$db->commit(); 
		echo json_encode(array("status" => "success","did"=>$did));
	}
	else{
		$db->rollback(); 
		echo json_encode(array("status" => "fail"));
	}
	
	
} catch(PDOExecption $e) { 
	$db->rollback(); 
	echo json_encode(
        array("status" => "fail")
    );
} */
?>