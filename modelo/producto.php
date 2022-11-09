<?php
require_once('base.php');

class ModeloProducto extends BaseModel{
	public function __construct(){
		parent::__construct('producto',
			array('nombre', 'descripcion', 'costo', 'cantidad'));
	}

	public function agregar($params){
		$res = null;
		$rows = $this->insert_query(array_intersect_key($params, array_flip($this->fields))
			, $res);
		return $rows;
	}

}

?>
