<?php
require_once('conexion.php');
class BaseModel{
	protected $conn;
	function __construct(){
		$this->conn = Database::getInstance()->getConnection();
	}

}
?>
