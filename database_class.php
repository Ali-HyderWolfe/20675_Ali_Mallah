<?php 
	
	require_once('Require/database_setting.php');
	require_once('Require/database_driver.php');
	

	class Database implements DatabaseDriver{
		public $hostname;
		public $username;
		public $password;
		public $database;
		public $connection;
		public $query;
		public $result;

		public function __construct($hostname,$username,$password,$database){
			$this->hostname = $hostname;
			$this->username = $username;
			$this->password = $password;
			$this->database = $database;

			mysqli_report(False);
			$this->connection =  mysqli_connect($this->hostname,$this->username,$this->password,$this->database);

			if(mysqli_connect_errno()){
				die("<p style='color:red'>Connection Problem: ErrorNo: ".mysqli_connect_errno()." Error Message: ".mysqli_connect_error()."</p>");
			}

		}
		public function get_connection(){
			return $this->connection;
		}

		public function execute_query($query){
			$this->query = $query;
			
			return $this->result = mysqli_query($this->connection,$this->query);
		}

		public function __destruct(){
			mysqli_close($this->connection);
		}
	}

	