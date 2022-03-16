<?php
class Booking{
 
    // database connection and table name
    private $conn;
    private $table_name = "booking";
 
    // object properties
    public $bid;
    public $pid;
    public $did;
    public $bookingtime;
	public $created;
	public $modified;
 
    // constructor with $db ase database connection
    public function __construct($db){
        $this->conn = $db;
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
	
	// read booking
	function readbyphone($phone){
	 
		// select all query
		$query = "SELECT b.bid,b.pid,b.did,p.uid,u1.uname as pname,u1.ugender as pgender, DATE_FORMAT(u1.udob, '%d %M %Y') as pdob,u1.udob as p_dob,
				  u1.uemail as pemail, u1.uphone as pphone, u2.uname as dname, d.degree as ddegree,
				  DATE_FORMAT(b.bookingtime, '%d %M %Y %h:%i %p') as booktime,b.bookingtime, b.message as message ,b.mail as mail, b.phone as phone 
				  FROM booking b 
				  INNER JOIN patient p on p.pid=b.pid 
				  INNER JOIN doctor d on d.did=b.did 
				  INNER JOIN user u1 on u1.uid=p.uid 
				  INNER JOIN user u2 on u2.uid=d.uid WHERE u1.uphone =" . $phone;
	 
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
	
	function create(){
 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					pid=:pid, did=:did, bookingtime=:bookingtime, created=:created, modified=:modified";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->pid = htmlspecialchars(strip_tags($this->pid));
		$this->did = htmlspecialchars(strip_tags($this->did));
		$this->bookingtime = htmlspecialchars(strip_tags($this->bookingtime));
		$this->created = htmlspecialchars(strip_tags($this->created));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
	 
		// bind values
		$stmt->bindParam(":pid", $this->pid);
		$stmt->bindParam(":did", $this->did);
		$stmt->bindParam(":bookingtime", $this->bookingtime);
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
		$query = "UPDATE " . $this->table_name . " SET bid=:id ";
				
	 
		if ($this->bookingtime <> ""){
			$query = $query . " ,bookingtime=:bookingtime ";
		    $this->bookingtime = htmlspecialchars(strip_tags($this->bookingtime));
		}
		
		if ($this->status <> 0){
			$query = $query . " ,status=:status ";
			$this->status = htmlspecialchars(strip_tags($this->status));
		}
		
		if ($this->did <> 0){
			$query = $query . " ,did=:did ";
		    $this->did = htmlspecialchars(strip_tags($this->did));
		}
		
		if ($this->message <> ""){
			$query = $query . " ,message=:message ";
		    $this->message = htmlspecialchars(strip_tags($this->message));
		}
		
		if ($this->phone <> 0){
			$query = $query . " ,phone=:phone ";
		    $this->phone = htmlspecialchars(strip_tags($this->phone));
		}
		
		if ($this->mail <> 0){
			$query = $query . " ,mail=:mail ";
		    $this->mail = htmlspecialchars(strip_tags($this->mail));
		}
		
		$query = $query . " WHERE bid = :id";
		
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->bid = htmlspecialchars(strip_tags($this->bid));
		
			 
		// bind values
		$stmt->bindParam(":id", $this->bid);
		if ($this->bookingtime <> ""){
			$stmt->bindParam(":bookingtime", $this->bookingtime);
		}
		if ($this->status <> 0){
			$stmt->bindParam(":status", $this->status);
		}
		if ($this->did <> 0){
			$stmt->bindParam(":did", $this->did);
		}
		
		if ($this->message <> ""){
			$stmt->bindParam(":message", $this->message);
		}
		if ($this->mail <> 0){
			$stmt->bindParam(":mail", $this->mail);
		}
		if ($this->phone <> 0){
			$stmt->bindParam(":phone", $this->phone);
		}
		
		
		// execute the query
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