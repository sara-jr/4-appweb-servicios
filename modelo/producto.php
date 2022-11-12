<?php
require_once('base.php');

class ModeloProducto extends BaseModel{
	public function __construct(){
		parent::__construct('producto',
			array('nombre', 'descripcion', 'costo', 'cantidad'), 'idProducto');
	}
}

?>
