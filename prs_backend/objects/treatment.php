<?php
class Treatment{
 
    // database connection and table name
    private $conn;
    private $table_name = "treatment";
 
    // object properties
	public $tid;
    public $pid;
    public $uid;
    public $history;
	public $treatment;
	public $issuepharm;
	public $created;
	public $modified;
 
    // constructor with $db ase database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	function create(){
 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					pid=:pid, uid=:uid, history=:history, treatment=:treatment, issuepharm=:issuepharm, created=:created, modified=:modified";
	 
		
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->pid = htmlspecialchars(strip_tags($this->pid));
		$this->uid = htmlspecialchars(strip_tags($this->uid));
		$this->history = htmlspecialchars(strip_tags($this->history));
		$this->treatment = htmlspecialchars(strip_tags($this->treatment));
		$this->issuepharm = htmlspecialchars(strip_tags($this->issuepharm));
		$this->created = htmlspecialchars(strip_tags($this->created));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
		
		// bind values
		$stmt->bindParam(":pid", $this->pid);
		$stmt->bindParam(":uid", $this->uid);
		$stmt->bindParam(":history", $this->history);
		$stmt->bindParam(":treatment", $this->treatment);
		$stmt->bindParam(":issuepharm", $this->issuepharm);
		$stmt->bindParam(":created", $this->created);
		$stmt->bindParam(":modified", $this->modified);
		
		
		try { 
			//$this->conn->beginTransaction(); 
			$stmt->execute(); 
			$result = $this->conn->lastInsertId(); 
			//$this->conn->commit(); 
			return $result;
		} catch(PDOExecption $e) { 
			$this->conn->rollback(); 
			print "Error!: " . $e->getMessage() . "</br>"; 
		} 
	}
	
	function update(){
		$query = "UPDATE " . $this->table_name . " SET issuepharm=1 Where tid=:tid";
	
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->tid = htmlspecialchars(strip_tags($this->tid));
		// bind values
		$stmt->bindParam(":tid", $this->tid);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}	
	}
	
	function readforpharm($stime,$code){
		$query = "Select t.tid,t.pid,t.uid,u1.name,u1.dob,p.code,u2.name as dname,t.treatment,DATE_FORMAT(t.created, '%Y-%m-%d') tdate From treatment t 
					Inner Join patient p on p.pid=t.pid
					Inner Join user u1 on u1.uid=p.uid
					Inner Join user u2 on u2.uid=t.uid
					Where DATE_FORMAT(t.created, '%Y-%m-%d') ='" . $stime . "' AND t.issuepharm=0";
				  
		if ($code <> 0){$query = $query . " AND p.code=" .$code;}
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	function patientrecord(){
		$query = "Select t.tid,p.pid,d.did,DATE_FORMAT(t.created,'%Y-%m-%d') tdate,p.code,u1.name,u1.dob,u1.gender,u1.address,u1.phone,p.bloodtype,p.weight,p.height,
					u2.name as dname,d.degree,d.speciality,t.history,t.treatment From treatment t
					Inner Join patient p on p.pid=t.pid
					Inner Join doctor d on d.uid = t.uid
					Inner Join user u1 on u1.uid=p.uid
					Inner Join user u2 on u2.uid=d.uid
					Where t.pid =:pid
					Order By t.created";
				  
		$stmt = $this->conn->prepare($query);
		if($this->pid<>0) $stmt->bindParam(":pid", $this->pid);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	// read booking
	function read($stime,$uid){
	 
		// select all query
		$query = "Select u.uid,d.did,p.pid,b.bid,DATE_FORMAT(b.bookingtime, '%Y-%m-%d')bookingtime,u.name,u.dob,u.gender,u.address,u.phone,p.code from booking b 
					Inner Join patient p on p.pid=b.pid
					Inner Join doctor d on d.did = b.did
					Inner Join user u on u.uid=p.uid
					Inner Join user u1 on u1.uid=d.uid Where DATE_FORMAT(b.bookingtime, '%Y-%m-%d')='" . $stime . "'";
				  
		if ($this->did <> 0){$query = $query . " AND d.did=" .$this->did;}
		if ($uid <> 0){$query = $query . " AND d.uid=" .$uid;}
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	
	function read_one(){
	 
		// select all query
		$query = "SELECT b.bid,b.pid,b.did,p.uid,u1.uname as pname,u1.ugender as pgender, DATE_FORMAT(u1.udob, '%d %M %Y') as pdob,u1.udob as p_dob,
				  u1.uemail as pemail, u1.uphone as pphone, u2.uname as dname, d.degree as ddegree,
				  DATE_FORMAT(b.bookingtime, '%d %M %Y %h:%i %p') as booktime,b.bookingtime, b.message as message ,b.mail as mail, b.phone as phone 
				  FROM booking b 
				  INNER JOIN patient p on p.pid=b.pid 
				  INNER JOIN doctor d on d.did=b.did 
				  INNER JOIN user u1 on u1.uid=p.uid 
				  INNER JOIN user u2 on u2.uid=d.uid Where b.bid=" . $this->bid;
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	function deletebooking(){
		$query = "DELETE FROM " . $this->table_name . " WHERE bid=" . $this->bid;
		$stmt = $this->conn->prepare($query);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}	
	}
	
	
	

	function readOne(){
		// query to read single record
		$query = "SELECT * FROM " . $this->table_name . " WHERE bookingtime =:bookingtime LIMIT 0,1";
	 
		
	    // prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of user to be updated
		if($this->bookingtime<>'') $stmt->bindParam(":bookingtime", $this->bookingtime);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->bid= $row['bid'];
	    $this->pid= $row['pid'];
	    $this->did= $row['did'];
	    $this->bookingtime= $row['bookingtime'];
	    $this->message= $row['message'];
		$this->mail= $row['mail'];
		$this->phone= $row['phone'];
		$this->created= $row['created'];
		$this->modified= $row['modified'];
	}
}
?>