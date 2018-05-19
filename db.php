<?php
// ini_set('display_errors',1);
// error_reporting(E_ALL);


class database {
	public $conn;
	public $radhey;
	//$radhey  = &$this;
	public function __construct() {
		$this->conn = mysqli_connect('localhost','root','mohit@12345','core_test');
	}
}

$dbobj = new database;

?>