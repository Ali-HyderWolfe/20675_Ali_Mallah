<?php 

	interface DatabaseDriver{

		public function __construct($hostname,$username,$password,$database);
		public function execute_query($query);
		public function __destruct();
	}



?>