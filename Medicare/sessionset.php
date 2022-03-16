
<?php
    session_start(); 
		if (isset($_SESSION["uname"])){
			$uname=$_SESSION["uname"];
            $uid =$_SESSION["uid"];
            $urid =$_SESSION["urid"];
			$urname = $_SESSION["urname"];
			$email = $_SESSION["email"];
		}
		else{
			$uname=$_GET['uname']; 			
            $uid  =$_GET['uid'];
            $urid  =$_GET['urid'];
			$urname = $_GET["urname"];
			$email = $_GET["email"];
			
			$_SESSION["uname"] = $uname; 
            $_SESSION["uid"] = $uid;
            $_SESSION["urid"] = $urid;
			$_SESSION["urname"] = $urname;
			$_SESSION["email"] = $email;
		}

        $sessions = array();

        $sessions['uname'] = $_SESSION['uname'];
        $sessions['uid'] = $_SESSION['uid'];
        $sessions['urid'] = $_SESSION['urid'];
		$sessions['urname'] = $_SESSION["urname"];
		$sessions['email'] = $_SESSION["email"];

        header('Content-Type: application/json');
        echo json_encode($sessions);

	
?>