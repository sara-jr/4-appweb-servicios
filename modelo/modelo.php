<?php
require_once('base.php');

class Modelo extends BaseModel{
	
	// Esta funcion verifica si el nombre de usuario y correo son unicos, es decir, no existen en la base de datos
	function identificacionUnica($usuario, $email){
		$sqlValidar = "SELECT * FROM usuarios WHERE usuario = '".$usuario."' OR correo = '".$email."'  ";
		$resultado = mysqli_query($this->conn, $sqlValidar);
		return mysqli_num_rows($resultado) == 0; // Si la consulta no regresa ninguna fila, entonces el usuario y la contraseña no existen
	}

	// Esta funcion verifica si el nombre de usuario y correo son unicos, es decir, no existen en la base de datos
	function correoUnico($email){
		$sqlValidar = "SELECT * FROM usuarios WHERE correo = '".$email."'  ";
		$resultado = mysqli_query($this->conn, $sqlValidar);
		return mysqli_num_rows($resultado) == 0; // Si la consulta no regresa ninguna fila, entonces el usuario y la contraseña no existen
	}

	function validarusuario($params){
		$error = "";
		$valor = "";
		$user = $params ["usuario"];
		$pass = $params ["pass"];
		die();

		$query = "SELECT * FROM usuarios WHERE usuario = '".$user."' AND MD5( password ) = '".md5($pass)."'; ";
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
		$query .= " SET nombre='".$nombre."', apellido='".$ape1."', telefono='".$telefono."', correo='".$email."', edad='".$edad."', usuario='".$usuario."', password='".md5($pass)."'";
		$query .= "WHERE id='$id';";

		//$old_email = 

		if($this->correoUnico($email)){ // Si ingreso datos validos
			if($this->conn->query($query)){	 // Si la consulat fue exitosa
				$valor = $this->conn->affected_rows;		
			}else{
				$error = '[' . $this->conn->error . ']';
			}
		}
		else{
			$error = 'i';//Inidcar que el error fue gracias a datos duplicados
		}

			 
		$resul[] = $valor;
		$resul[] = $error;	
		return $resul;
	}

	function agregaUsuario( $params ){
		$error = "";
		$valor = "";
		$nombre = $params["nombre"];
		$ape1 = $params["apellido"];
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
			
			$query = "INSERT INTO usuarios(nombre, apellido, telefono, correo, fechaDeNacimiento, usuario, password, saldo, tipo)";
			$query .= " VALUES ('".$nombre."', '".$ape1."', '".$telefono."', '".$email."', '".$edad."', '".$usuario."', '".md5($pass)."', 0, 0);";

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
