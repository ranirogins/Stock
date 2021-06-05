<?php
	//error_reporting( E_ALL );
	date_default_timezone_set('Asia/Kolkata');
	ini_set("display_errors","off");
	define("DB_HOST", "localhost");
	define("DB_USER", "admin");
	define("DB_PASS", "admin");
	define("DB_NAME", "stock");
	
	class Database
	{
		private $host = DB_HOST;
		private $user = DB_USER;
		private $pass = DB_PASS;
		private $dbname = DB_NAME;
		
		private $dbh;
    	private $error;
 		private $stmt;
		
    	public function __construct()
		{
			// Set DSN
			$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
			// Set options
			$options = array(
				PDO::ATTR_PERSISTENT    => true,
				PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
			);
			// Create a new PDO instanace
			try
			{
				$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			}
			// Catch any errors
			catch(PDOException $e)
			{
				$this->error = $e->getMessage();
			}
    	}
		public function query($query)
		{
    		$this->stmt = $this->dbh->prepare($query);
		}
		public function bind($param, $value, $type = null)
		{
			if (is_null($type)) {
				switch (true) {
					case is_int($value):
						$type = PDO::PARAM_INT;
						break;
					case is_bool($value):
						$type = PDO::PARAM_BOOL;
						break;
					case is_null($value):
						$type = PDO::PARAM_NULL;
						break;
					default:
						$type = PDO::PARAM_STR;
				}
			}
			$this->stmt->bindValue($param, $value, $type);
		}
		public function dbclose()
		{
			$this->dbh=null;
		}
		public function execute()
		{
			return $this->stmt->execute();
		}
		public function resultset()
		{
			$this->execute();
			return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		public function single()
		{
			$this->execute();
			return $this->stmt->fetch(PDO::FETCH_ASSOC);
		}
		public function rowCount()
		{
			return $this->stmt->rowCount();
		}
		public function lastInsertId()
		{
			return $this->dbh->lastInsertId();
		}
		public function beginTransaction()
		{
			return $this->dbh->beginTransaction();
		}
		public function endTransaction()
		{
			return $this->dbh->commit();
		}
		public function cancelTransaction()
		{
			return $this->dbh->rollBack();
		}
		public function debugDumpParams()
		{
    		return $this->stmt->debugDumpParams();
		}
		
public function updatedata($tablename,$toUpdate = array(), $cid){
	
		if( is_array($toUpdate) && !isset($toUpdate['c_id']) && $cid!=''){
			$columns = "";
			foreach($toUpdate as $k => $v){
				$columns .= "$k = :$k, ";
			}
			$condition = "";
			foreach($cid as $k => $v){
				$condition .= "$k = :$k, ";
			}
			$columns = substr($columns, 0, -2); // Remove last ","
			$condition = substr($condition, 0, -2); // Remove last ","
			
		
			$sql = $this->dbh->prepare("UPDATE `{$tablename}` SET {$columns} WHERE {$condition}");
			
			foreach($cid as $k => $v){
				$sql->bindValue(":$k", $v);
				
			}
			foreach($toUpdate as $k => $v){
				$sql->bindValue(":$k", $v);
			}
			$sql->execute();
			return true;
			}else{
			return false;
		}
	}
	// assign tender
	public function insertdata($tablename,$other = array())
	{
		if(count($other) > 0)
		{
			$keys 	= array_keys($other);
			$columns = implode(",", $keys);
			$colVals = implode(",:", $keys);
			$sql=$this->dbh->prepare("INSERT INTO `{$tablename}` ( $columns) VALUES( :$colVals)");
			foreach($other as $k=>$v)
			{
				$sql->bindValue(":$k", $v);
			}
			$sql->execute();
			$this->dbh=null;
			return true;
		}
	}
 public function deletedata($tablename,$toUpdate = array()){
	 
		if( is_array($toUpdate) && !isset($toUpdate['c_id'])){
			$columns = "";
			foreach($toUpdate as $k => $v){
				$columns .= "$k = :$k, ";
			}
			$columns = substr($columns, 0, -2); // Remove last ","
		
			$sql = $this->dbh->prepare("delete from {$tablename} WHERE {$columns}");
			foreach($toUpdate as $k => $v){
				$sql->bindValue(":$k", $v);
			}
			$sql->execute();
			return true;
		}else{
			return false;
		}
	}

	}
	
?>