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


//llamar a la funcion 'agregausuario'
list ($valor, $error) = $sesion->actualizaDatos( $params );
if ( empty( $valor ) ){
    
    if($error == "d"){
        echo "<script>alert('Usuario duplicado, vuelva a intentar');
        history.go(-1);
        </script>"; 
        
    }else{
        echo "<script>alert('Ocurrió un error al hacer el registro');
        window.location.href='../vista/contact.html';
        </script>";   			
    }
                   
} else {
    echo "<script>alert('Su usuario fue registrado exitosamente');
    window.location.href='../vista/contact.html';
    </script>";
}
?>