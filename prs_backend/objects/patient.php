<?php
include_once 'user.php';
class Patient extends User{
 
    private $conn;
    private $table_name = "patient";
 
    public $pid;
    public $uid;
	public $code;
	public $bloodtype;
	public $weight;
	public $height;
	public $created;
	public $modified;
 
    public function __construct($db){
        $this->conn = $db;
		parent::__construct($db);
    }
	
	function create_patient(){
		try{
			$this->conn->beginTransaction();
			$uid = $this->create();
			if($uid){
				$query = "INSERT INTO
							" . $this->table_name . "
						SET
							uid=:uid, code=:code,bloodtype=:bloodtype,weight=:weight,height=:height,created=:created, modified=:modified";
				$stmt = $this->conn->prepare($query);
				$lastcode = $this->generatepatiencode();
				$this->uid = htmlspecialchars(strip_tags($uid));
				$this->code = htmlspecialchars(strip_tags($lastcode));
				$this->bloodtype = htmlspecialchars(strip_tags($this->bloodtype));
				$this->weight = htmlspecialchars(strip_tags($this->weight));
				$this->height = htmlspecialchars(strip_tags($this->height));
				$this->created = htmlspecialchars(strip_tags($this->created));
				$this->modified = htmlspecialchars(strip_tags($this->modified));
				
				$stmt->bindParam(":uid", $this->uid);
				$stmt->bindParam(":code", $this->code);
				$stmt->bindParam(":bloodtype", $this->bloodtype);
				$stmt->bindParam(":weight", $this->weight);
				$stmt->bindParam(":height", $this->height);
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
	
	function update_patient(){
	 
		// update query
		$query = "UPDATE patient SET
					bloodtype=:bloodtype,weight=:weight,height=:height, modified=:modified
				WHERE pid = :pid";
	 
		$stmt = $this->conn->prepare($query);
	 
		$this->pid = htmlspecialchars(strip_tags($this->pid));
		$this->bloodtype = htmlspecialchars(strip_tags($this->bloodtype));
		$this->weight = htmlspecialchars(strip_tags($this->weight));
		$this->height = htmlspecialchars(strip_tags($this->height));
		$this->modified = htmlspecialchars(strip_tags($this->modified));
				
		$stmt->bindParam(":pid", $this->pid);
		$stmt->bindParam(":bloodtype", $this->bloodtype);
		$stmt->bindParam(":weight", $this->weight);
		$stmt->bindParam(":height", $this->height);
		$stmt->bindParam(":modified", $this->modified);
	 
		try{
			$this->conn->beginTransaction();
			if($stmt->execute()){
				if($this->update()){
					$this->conn->commit();
					return $this->pid;
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
	
	function generatepatiencode(){
		$query = "SELECT * From patient Order By code DESC";
		$stmt = $this->conn->prepare( $query );
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
	 
		$lastcode = $row['code'];
		//$random=mt_rand(1, 9);
		$random=str_pad(ltrim($lastcode, '0') + 1, 8, '0', STR_PAD_LEFT);
		return $random;
	}
	
	function read_patient(){
		$query = "SELECT p.pid,u.uid,u.name,u.email,u.phone,u.gender,u.dob,u.address,p.code,p.bloodtype,p.weight,p.height,p.created,p.modified 
				FROM patient p Inner Join user u on u.uid=p.uid";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
	 
		return $stmt;
	}
	
	function readOne_patient(){
		$query = "SELECT * FROM patient p INNER JOIN user u ON u.uid=p.uid WHERE p.pid=p.pid";
					
		$query = ($this->pid<>0) ? $query ." AND p.pid = :id" : $query;
		$query = ($this->code<>"") ? $query ." AND p.code = :code" : $query;
		$query = $query . "	LIMIT 0,1";
		
		$stmt = $this->conn->prepare( $query );
	 
		if($this->pid<>0) $stmt->bindParam(":id", $this->pid);
		if($this->code<>"") $stmt->bindParam(":code", $this->code);
		
		$stmt->execute();
	 
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['uid'];
		$this->pid = $row['pid'];
		$this->name = $row['name'];
		$this->email = $row['email'];
		$this->phone = $row['phone'];
		$this->gender = $row['gender'];
		$this->dob = $row['dob'];
		$this->address = $row['address'];
		$this->code = $row['code'];
		$this->bloodtype = $row['bloodtype'];
		$this->weight = $row['weight'];
		$this->height = $row['height'];
		$this->created = $row['created'];
		$this->modified = $row['modified']; 
		//return $this->name . '-' . $this->address;
	}
	
	function delete_patient(){
		$query = "DELETE FROM patient WHERE pid = ?";
		$stmt = $this->conn->prepare($query);
		$this->pid=htmlspecialchars(strip_tags($this->pid));
		$stmt->bindParam(1, $this->pid);
		
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
}
/* {"id":0,"pid":0,"name":"Daw Win Win","email":"","phone":"9998887776","gender":1,"dob":"1984-09-11","address":"Hlaing","password":"","role":6,
"bloodtype":"O","weight":"230","height":"150"} */
?>