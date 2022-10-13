<?php
require_once("../modelo/conexion.php");
require_once("../modelo/modelo.php");
@session_start();

$params = array(
    "id" => $_POST["id"],
    "nombre" => $_POST["nombre"],
    "ape1" => $_POST["ape1"],
    "telefono" => $_POST["telefono"],
    "email" => $_POST["email"],
    "edad" => $_POST["edad"],
    "usuario" => $_POST["usuario"],
    "pass" => $_POST["pass"],
);

//instancia y conexion bd
$db = Database::getInstance();
$conn = $db->getConnection();
$sesion = new Modelo($conn);

// Validar que no ingrese datos duplicados
$datos = perfil($id);
if($datos['correo'] != $params['email']){ // Si el correo nuevo y el correo viejo son diferentes
    if($sesion->correoUnico($datos['email'])){// Si el correo nuevo no existe en la base de datos
        alert('Correo electronico duplicado');
    }
}

//llamar a la funcion 'agregausuario'
list ($valor, $error) = $sesion->actualizaDatos( $params );
if ( empty( $valor ) ){
    
    if($error == "d" || $error == "i"){
        echo "<script>alert('Datos duplicados o invalidos, vuelva a intentar');
        history.go(-1);
        </script>"; 
        
    }else{
        echo "<script>alert('Ocurrió un error al hacer el registro');
        window.location.href='../vista/home-page-r.php';
        </script>";   			
    }
                   
} else {
    echo "<script>alert('Datos modificados con exito');
    window.location.href='../vista/home-page-r.php';
    </script>";
}
?>