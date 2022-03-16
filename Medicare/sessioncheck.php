
<?php
header('Content-Type: application/json');
    session_start(); 
		if (isset($_SESSION["uname"])){
			$uname=$_SESSION["uname"];
            $uid =$_SESSION["uid"];
            $urid =$_SESSION["urid"];
			$urname = $_SESSION["urname"];
			$email = $_SESSION["email"];
			
			echo json_encode(array("status"=>"success",
			"uname"=>$uname,
			"uid"=>$uid,
			"urid"=>$urid,
			"urname"=>$urname,
			"uemail"=>$email));
		}
		else{
			echo json_encode(array("status"=>"fail"));
		}

?>
