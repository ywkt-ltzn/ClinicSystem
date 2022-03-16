<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
    public $id;
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $dob;
	public $address;
    public $password;
	public $role;
	public $created;
	public $modified;
	public $role_name;
	public $uimage;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
	// read users
	function read(){
	 
		// select all query
		$query = "SELECT * FROM " . $this->table_name . " u INNER JOIN role r ON r.role=u.role";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	
	function create(){
 
		// query to insert record
		$query = "INSERT INTO
					" . $this->table_name . "
				SET
					name=:name, email=:email, phone=:phone, gender=:gender, dob=:dob, password=:password, address=:address, role=:role, created=:created, modified=:modified, uimage=:uimage";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->phone = htmlspecialchars(strip_tags($this->phone));
		$this->gender = htmlspecialchars(strip_tags($this->gender));
		$this->dob = htmlspecialchars(strip_tags($this->dob));
		$this->address = htmlspecialchars(strip_tags($this->address));
		$this->password = htmlspecialchars(strip_tags(md5($this->password)));
		$this->role = htmlspecialchars(strip_tags($this->role));
		$this->created = htmlspecialchars(strip_tags($this->created));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
		$this->uimage = htmlspecialchars(strip_tags($this->uimage));
	 
		// bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":gender", $this->gender);
		$stmt->bindParam(":dob", $this->dob);
		$stmt->bindParam(":address" ,$this->address);
		$stmt->bindParam(":password", $this->password);
		$stmt->bindParam(":role" ,$this->role);
		$stmt->bindParam(":created", $this->created);
		$stmt->bindParam(":modified", $this->modified);
		$stmt->bindParam(":uimage", $this->uimage);
		
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
	
	function readOne(){
		// query to read single record
		$query = "SELECT * FROM " . $this->table_name . " u INNER JOIN role r ON r.role=u.role WHERE u.uid = u.uid";
					
		$query = ($this->id<>0) ? $query ." AND u.uid = :id" : $query;
		$query = ($this->name<>"") ? $query ." AND u.name = :name" : $query;
		$query = ($this->email<>"") ? $query ." AND u.email = :email" : $query;
		$query = ($this->phone<>"") ? $query ." AND u.phone = :phone" : $query;
		$query = ($this->password<>"") ? $query ." AND u.password = :password" : $query;
		$query = $query . "	LIMIT 0,1";
	 
		
	    // prepare query statement
		$stmt = $this->conn->prepare( $query );
	 
		// bind id of user to be updated
		if($this->id<>0) $stmt->bindParam(":id", $this->id);
		if($this->name<>"") $stmt->bindParam(":name", $this->name);
		if($this->email<>"") $stmt->bindParam(":email", $this->email);
		if($this->phone<>"") $stmt->bindParam(":phone", $this->phone);
		if($this->password<>"") $stmt->bindParam(":password", $this->password);
	 
		// execute query
		$stmt->execute();
	 
		// get retrieved row
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		// set values to object properties
		$this->id = $row['uid'];
		$this->name = $row['name'];
		$this->email = $row['email'];
		$this->phone = $row['phone'];
		$this->gender = $row['gender'];
		$this->dob = $row['dob'];
		$this->address = $row['address'];
		$this->role = $row['role'];
		$this->role_name = $row['role_name'];
		$this->password = $row['password'];
		$this->created = $row['created'];
		$this->modified = $row['modified'];
		$this->uimage = $row['uimage'];
	}
	
	// update the user
	function update(){
	 
		// update query
		$query = "UPDATE
					" . $this->table_name . "
				SET
					name=:name, email=:email, phone=:phone, gender=:gender, dob=:dob, address=:address, role=:role, modified=:modified, uimage=:uimage
				WHERE
					uid = :id";
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->email = htmlspecialchars(strip_tags($this->email));
		$this->phone = htmlspecialchars(strip_tags($this->phone));
		$this->gender = htmlspecialchars(strip_tags($this->gender));
		$this->dob = htmlspecialchars(strip_tags($this->dob));
		$this->address = htmlspecialchars(strip_tags($this->address));
		//$this->password = htmlspecialchars(strip_tags(md5($this->password)));
		$this->role = htmlspecialchars(strip_tags($this->role));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->uimage = htmlspecialchars(strip_tags($this->uimage));
	 
		// bind values
		$stmt->bindParam(":name", $this->name);
		$stmt->bindParam(":email", $this->email);
		$stmt->bindParam(":phone", $this->phone);
		$stmt->bindParam(":gender", $this->gender);
		$stmt->bindParam(":dob", $this->dob);
		$stmt->bindParam(":address", $this->address);
		//$stmt->bindParam(":password", $this->password);
		$stmt->bindParam(":role", $this->role);
		$stmt->bindParam(":modified", $this->modified);
		$stmt->bindParam(":id", $this->id);
		$stmt->bindParam(":uimage", $this->uimage);
	 
		// execute the query
		if($stmt->execute()){
			return $this->id;
		}else{
			return 0;
		}
	}
	
	// delete the user
	function delete(){
	 
		// delete query
		$query = "DELETE FROM " . $this->table_name . " WHERE uid = ?";
	 
		// prepare query
		$stmt = $this->conn->prepare($query);
	 
		// sanitize
		$this->id=htmlspecialchars(strip_tags($this->id));
	 
		// bind id of record to delete
		$stmt->bindParam(1, $this->id);
	 
		// execute query
		if($stmt->execute()){
			return true;
		}
	 
		return false;
		 
	}
}
?>