<?php
require_once('conexion.php');
class BaseModel{
	private $last_error;
	protected $conn;
	public $table_name;
	public $fields;

	protected function __construct($name, $fields){
		$this->conn = Database::getInstance()->getConnection();
		$this->fields = $fields;
		$this->table_name = $name;
	}
	
	protected function insert_query($values, &$res){
		$field_str = implode(', ', $this->fields);
		$value_str = implode(', ', array_map(fn($x):string=>"'{$x}'", $values));
		$query = "INSERT INTO {$this->table_name}({$field_str}) VALUES({$value_str});";
		if($this->conn->query($query)){
			return true;
		}
		$this->last_error = $this->conn->error;
		return false;
	}

	public function getLastError(){
		return $this->last_error;
	}
}
?>
