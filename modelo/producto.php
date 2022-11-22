<?php
require_once('base.php');

class ModeloCategoria extends BaseModel{
	public function __construct(){
		parent::__construct('categoria',
			array('nombre', 'descripcion'), 'idCategoria');
	}
}

class ModeloProducto extends BaseModel{
	public function __construct(){
		parent::__construct('producto',
			array('idCategoria', 'nombre', 'descripcion', 'costo', 'cantidad'), 'idProducto');
	}
}

class ModeloUbicacion extends BaseModel{
	public function __construct(){
		parent::__construct('estado',
			array('codigoPostal', 'calle', 'numeroExterior', 'numeroInterior'), 
			'domicilio');
	}
}

class ModeloUsuario extends BaseModel{
	public function __construct(){
		parent::__construct('usuarios',
			array( 
				'nombre',
				'apellido',
				'telefono',
				'correo',
				'fechaDeNacimiento',
				'usuario',
				'password',
				'tipo',
				'saldo'),
			'idUsuario');
	}

	public function unique($username, $email){
		$result = $this->conn->query(
			'SELECT correo, usuario FROM {$this->table_name} WHERE correo={$email} OR usuario={$username};');
		return $result->num_rows == 0;
	}
	
	public function valid_credentials($username, $pwhash){
		$result = $this->conn->query(
			'SELECT password, usuario FROM {$this->table_name} WHERE usuario={$username} AND pasword={$pwhash};');
		return $result->num_rows == 1;
	}
}

class ModeloOrden extends BaseModel{
	public function __construct(){
		parent::__construct(
			'orden', array('idUsuario', 'domicilio', 'fecha'),
			'idOrden');
	}
}

class ModeloDevolucion extends BaseModel{
	public function __construct(){
		parent::__construct(
			'devolucion', array('idOrden', 'motivo'),
			'idDevolucion');
	}
}
?>
