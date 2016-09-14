<?php
/*
* Mysql database class - only one connection alowed
*/
class Database {
	private $_connection;
	private static $_instance; //The single instance
	private $_database = 'mysql:dbname=testdb;host=127.0.0.1';
	private $_username = "username";
	private $_password = "password";

	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		try{
			$this->_connection = new PDO($this->_database, 
				$this->_username,  $this->_password);
		}catch (PDOException $e) {
			//TODO: log this in some good manner
    		echo 'Connection failed: ' . $e->getMessage();
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}
?>
