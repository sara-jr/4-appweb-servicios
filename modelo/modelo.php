<?php
class Modelo{
	private $conn;
	function __construct($con){
		$this->conn=$con;
	}
	
	function validarusuario($params){
		$error = "";
		$valor = "";
		$user = $params ["usuario"];
		$pass = $params ["pass"];

		$query = "SELECT * FROM usuarios WHERE usuario = '".$user."' AND password = '".$pass."'; ";
		$resultado = mysqli_query($this->conn, $query);

		if(mysqli_num_rows($resultado)!= 0){
			$valor = "OK";
			session_start();
			$_SESSION["logueado"] = TRUE;
			
			while($row = mysqli_fetch_array($resultado)){
				$_SESSION["id"] = $row['id'];
				$_SESSION["nombre"] = $row['nombre'];
				$_SESSION["usuario"] = $row['usuario'];
				$_SESSION["tipo"] = $row['tipo'];
			}
		}
		$resul[] = $valor;
		$resul[] = $error;
		return $resul;
	}
		
	function actualizaDatos($params){
		$error = "";
		$valor = "";
		$id = $params["id"];
		$nombre = $params["nombre"];
		$ape1 = $params["ape1"];
		$telefono = $params["telefono"];
		$email = $params["email"];
		$edad = $params["edad"];
		$usuario = $params["usuario"];
		$pass = $params["pass"];

		$query = "UPDATE usuarios ";
		$query .= " SET nombre='".$nombre."', apellido='".$ape1."', telefono='".$telefono."', correo='".$email."', edad='".$edad."', usuario='".$usuario."', password='".$pass."'";
		$query .= "WHERE id='$id';";

		if($this->conn->query($query)){	
			$valor = $this->conn->affected_rows;		
		}else{
			$error = '[' . $this->conn->error . ']';
		}
			 
		$resul[] = $valor;
		$resul[] = $error;	
		return $resul;
	}

	function agregaUsuario( $params ){
		$error = "";
		$valor = "";
		$nombre = $params["nombre"];
		$ape1 = $params["ape1"];
		$telefono = $params["telefono"];
		$email = $params["email"];
		$edad = $params["edad"];
		$usuario = $params["usuario"];
		$pass = $params["pass"];
		$tipo = $params["tipo"];
		$sqlValidar = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' OR correo = '".$email."'  ";
		$resultado = mysqli_query($this->conn, $sqlValidar);
		
		
		if(mysqli_num_rows($resultado)!= 0){				
			$error="d";
		}else{
			
			$query = "INSERT INTO usuarios(nombre, apellido, telefono, correo, edad, usuario, password, tipo)";
			$query .= " VALUES ('".$nombre."', '".$ape1."', '".$telefono."', '".$email."', '".$edad."', '".$usuario."', '".$pass."', 0);";

			if($this->conn->query($query)){	
				$valor = $this->conn->affected_rows;		
			}else{
				$error = '[' . $this->conn->error . ']';
			}
								
		}	 
			 
		$resul[] = $valor;
		$resul[] = $error;	
		return $resul;
	}

	function datosPerfil( $id ){
		$query = "SELECT * FROM usuarios WHERE id = ".$id;
		$resultado = mysqli_query($this->conn, $query);
		if(!$resultado){
			$error = 'MySQL Error: '.mysqli_connect_error();

		}
		return $resultado;
	} 
}
?>