<?php
require_once('conexion.php');
class BaseModel{
	private $last_error;
	private $last_response;
	protected $conn;
	public $table_name;
	public $fields;
	public $key;

	protected function __construct($name, $fields, $key){
		$this->conn = Database::getInstance()->getConnection();
		$this->fields = $fields;
		$this->table_name = $name;
		$this->key = $key;
	}
	
	public function agregar($values){
		$field_str = implode(', ', $this->fields);
		$value_str = implode(', ', array_map(fn($x):string=>"'{$x}'", $values));
		$query = "INSERT INTO {$this->table_name}({$field_str}) VALUES({$value_str});";
		if($this->conn->query($query)){
			return true;
		}
		$this->last_error = $this->conn->error;
		return false;
	}

	public function eliminar($id){
		if($this->conn->query("DELETE FROM {$this->table_name} WHERE {$this->key}={$id};")){
			return true;
		}
		$this->last_error = $this->conn->error;
		return false;
	}

	public function listar(){
		$res = $this->conn->query("SELECT * FROM {$this->table_name} LIMIT 100;");
		if($res == false){ // Res no deberia ser un booleano si ocurrio un error
			$this->last_error = $this->conn->error;
			return null;			
		}
		$rows = array();
		$row = $res->fetch_assoc();
		while($row != null){
			$rows[] = $row;
			$row = $res->fetch_assoc();
		}
		return $rows;
	}

	public function getLastResponse(){
		return $this->last_response;
	}

	public function getLastError(){
		return $this->last_error;
	}
}
?>
