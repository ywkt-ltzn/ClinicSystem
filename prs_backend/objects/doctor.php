<?php
include_once 'user.php';
class Doctor extends User{
    private $conn;
    private $table_name = "doctor";
 
    // object properties
    public $did;
    //public $uid;
	public $dcode;
    public $degree;
	public $speciality;
    public $remark;
	public $day0;
	public $day1;
	public $day2;
	public $day3;
	public $day4;
	public $day5;
	public $day6;
	public $stime;
	public $etime;
	//public $created;
	//public $modified;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
		parent::__construct($db);
    }
	
	function create_doctor(){
		try{
			$this->conn->beginTransaction();
			$uid = $this->create();
			if($uid){
				$query = "INSERT INTO
							" . $this->table_name . "
						SET
							uid=:uid, degree=:degree, speciality=:speciality, remark=:remark,day0=:day0,day1=:day1,day2=:day2,day3=:day3,day4=:day4,day5=:day5,day6=:day6,
							stime=:stime,etime=:etime,created=:created, modified=:modified";
				$stmt = $this->conn->prepare($query);
			 
				$this->id = htmlspecialchars(strip_tags($uid));
				$this->degree = htmlspecialchars(strip_tags($this->degree));
				$this->speciality = htmlspecialchars(strip_tags($this->speciality));
				$this->remark = htmlspecialchars(strip_tags($this->remark));
				$this->day0 = htmlspecialchars(strip_tags($this->day0));
				$this->day1 = htmlspecialchars(strip_tags($this->day1));
				$this->day2 = htmlspecialchars(strip_tags($this->day2));
				$this->day3 = htmlspecialchars(strip_tags($this->day3));
				$this->day4 = htmlspecialchars(strip_tags($this->day4));
				$this->day5 = htmlspecialchars(strip_tags($this->day5));
				$this->day6 = htmlspecialchars(strip_tags($this->day6));
				$this->stime = htmlspecialchars(strip_tags($this->stime));
				$this->etime = htmlspecialchars(strip_tags($this->etime));
				$this->created = htmlspecialchars(strip_tags($this->created));
				$this->modified = htmlspecialchars(strip_tags($this->modified));
				
				$stmt->bindParam(":uid", $this->id);
				$stmt->bindParam(":degree", $this->degree);
				$stmt->bindParam(":speciality", $this->speciality);
				$stmt->bindParam(":remark", $this->remark);
				$stmt->bindParam(":day0", $this->day0);
				$stmt->bindParam(":day1", $this->day1);
				$stmt->bindParam(":day2", $this->day2);
				$stmt->bindParam(":day3", $this->day3);
				$stmt->bindParam(":day4", $this->day4);
				$stmt->bindParam(":day5", $this->day5);
				$stmt->bindParam(":day6", $this->day6);
				$stmt->bindParam(":stime", $this->stime);
				$stmt->bindParam(":etime", $this->etime);
				$stmt->bindParam(":created", $this->created);
				$stmt->bindParam(":modified", $this->modified);
				
				$stmt->execute(); 
				$result = $this->conn->lastInsertId(); 
				$this->conn->commit();
				return $result;
			}
			else{
				$this->conn->rollback(); 
				print "Error!: " . $e->getMessage() . "</br>"; 
			}
		}catch(PDOExecption $e) { 
			$this->conn->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 
	}
	
	function update_doctor(){
	 
		// update query
		$query = "UPDATE doctor SET
					degree=:degree, speciality=:speciality, remark=:remark,day0=:day0,day1=:day1,day2=:day2,day3=:day3,day4=:day4,day5=:day5,day6=:day6,
					stime=:stime,etime=:etime, modified=:modified
				WHERE did = :did";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->did = htmlspecialchars(strip_tags($this->did));
		$this->degree = htmlspecialchars(strip_tags($this->degree));
		$this->speciality = htmlspecialchars(strip_tags($this->speciality));
		$this->remark = htmlspecialchars(strip_tags($this->remark));
		$this->day0 = htmlspecialchars(strip_tags($this->day0));
		$this->day1 = htmlspecialchars(strip_tags($this->day1));
		$this->day2 = htmlspecialchars(strip_tags($this->day2));
		$this->day3 = htmlspecialchars(strip_tags($this->day3));
		$this->day4 = htmlspecialchars(strip_tags($this->day4));
		$this->day5 = htmlspecialchars(strip_tags($this->day5));
		$this->day6 = htmlspecialchars(strip_tags($this->day6));
		$this->stime = htmlspecialchars(strip_tags($this->stime));
		$this->etime = htmlspecialchars(strip_tags($this->etime));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
				
		$stmt->bindParam(":did", $this->did);
		$stmt->bindParam(":degree", $this->degree);
		$stmt->bindParam(":speciality", $this->speciality);
		$stmt->bindParam(":remark", $this->remark);
		$stmt->bindParam(":day0", $this->day0);
		$stmt->bindParam(":day1", $this->day1);
		$stmt->bindParam(":day2", $this->day2);
		$stmt->bindParam(":day3", $this->day3);
		$stmt->bindParam(":day4", $this->day4);
		$stmt->bindParam(":day5", $this->day5);
		$stmt->bindParam(":day6", $this->day6);
		$stmt->bindParam(":stime", $this->stime);
		$stmt->bindParam(":etime", $this->etime);
		$stmt->bindParam(":modified", $this->modified);
	 
		try{
			$this->conn->beginTransaction();
			if($stmt->execute()){
				if($this->update()){
					$this->conn->commit();
					return $this->did;
				}
				else{
					$this->conn->rollback();
					return 0;
				}
			}else{
				$this->conn->rollback();
				return 0;
			}
		}catch(PDOExecption $e) { 
			$this->conn->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		}
		
	}
	
	
	function delete_doctor(){
		$query = "DELETE FROM doctor WHERE did = ?";
		$stmt = $this->conn->prepare($query);
		$this->did=htmlspecialchars(strip_tags($this->did));
		$stmt->bindParam(1, $this->did);
		
		try{
			$this->conn->beginTransaction();
			if($stmt->execute()){
				if($this->delete()){
					$this->conn->commit();
					return true;
				}
				else{
					$this->conn->rollback(); 
					return false;
				}	
			}
			else{
				$this->conn->rollback(); 
				return false;
			}
		}catch(PDOExecption $e) { 
			$this->conn->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		}
	}
	
	function readOne_doctor(){
		// query to read single record
		$query = "SELECT * FROM doctor d INNER JOIN user u ON u.uid=d.uid WHERE d.did=d.did";
					
		$query = ($this->did<>0) ? $query ." AND d.did = :id" : $query;
		$query = ($this->name<>"") ? $query ." AND u.name = :name" : $query;
		$query = ($this->email<>"") ? $query ." AND u.email = :email" : $query;
		$query = ($this->phone<>"") ? $query ." AND u.phone = :phone" : $query;
		$query = ($this->password<>"") ? $query ." AND u.password = :password" : $query;
		$query = ($this->degree<>"") ? $query ." AND d.degree = :degree" : $query;
		$query = ($this->speciality<>"") ? $query ." AND d.speciality = :speciality" : $query;
		
		$query = $query . "	LIMIT 0,1";
	 
		
	    // prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of user to be updated
		if($this->did<>0) $stmt->bindParam(":id", $this->did);
		if($this->name<>"") $stmt->bindParam(":name", $this->name);
		if($this->email<>"") $stmt->bindParam(":email", $this->email);
		if($this->phone<>"") $stmt->bindParam(":phone", $this->phone);
		if($this->password<>"") $stmt->bindParam(":password", md5($this->password));
		if($this->degree<>"") $stmt->bindParam(":degree", $this->degree);
		if($this->speciality<>"") $stmt->bindParam(":speciality", $this->speciality);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->id = $row['uid'];
		$this->did = $row['did'];
		$this->name = $row['name'];
		$this->email = $row['email'];
		$this->phone = $row['phone'];
		$this->gender = $row['gender'];
		$this->dob = $row['dob'];
		$this->address = $row['address'];
		$this->role = $row['role'];
		$this->password = $row['password'];
		$this->degree = $row['degree'];
		$this->speciality = $row['speciality'];
		$this->remark = $row['remark'];
		$this->day0 = $row['day0'];
		$this->day1 = $row['day1'];
		$this->day2 = $row['day2'];
		$this->day3 = $row['day3'];
		$this->day4 = $row['day4'];
		$this->day5 = $row['day5'];
		$this->day6 = $row['day6'];
		$this->stime = $row['stime'];
		$this->etime = $row['etime'];
		$this->created = $row['created'];
		$this->modified = $row['modified'];
	}
	
	function read_doctor(){
		$query = "SELECT d.did,u.uid,u.name,u.email,u.phone,u.gender,u.dob,u.address,d.degree,d.speciality,d.remark,d.day0,d.day1,d.day2,d.day3,d.day4,d.day5,d.day6,
		              d.stime,d.etime,d.created,d.modified 
				FROM doctor d Inner Join user u on u.uid=d.uid";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	 
		return $stmt;
	}
}
/* {"id":18,"did":11,"name":"Prof. Htoo Han","email":"htoohan@gmail.com","phone":"222333444","gender":0,"dob":"1984-09-11","address":"Yangon","password":"htoohan","role":2,
"degree":"M.B.,B.S , M.R.C.P(Surgery),FRCS(Edin)","speciality":"Paediatric Surgeons","remark":"","day0":0,"day1":1,"day2":1,"day3":1,"day4":1,"day5":1,"day6":0,
"stime":"11:30:00","etime":"13:00:00"} */
?>

