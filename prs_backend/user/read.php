<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new user($db);

$stmt = $user->read();
 
$num = $stmt->rowCount();

 if($num>0){
	
     $users_arr=array();
    $users_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		
          extract($row);
		
       $user_info=array(
            "id" => $uid,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "gender" => $gender,
            "dob" => $dob,
			"password" => $password,
			"address" => $address,
			"role" => $role,
			"role_name" => $role_name,
			"created" => $created,
			"modified" => $modified
        );
		
        array_push($users_arr["records"], $user_info); 
    }
 
    echo json_encode($users_arr); 
	
}
 
else{
    echo json_encode(
        array("message" => "No products found.")
    );
} 
?>