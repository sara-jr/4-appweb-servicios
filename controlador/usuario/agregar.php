<?php
require_once("../../modelo/producto.php");
@session_start();

$params = array(
    "nombre" => $_POST["nombre"],
    "apellido" => $_POST["apellido"],
    "telefono" => $_POST["telefono"],
    "correo" => $_POST["email"],
    "fechaNacimiento" => $_POST["fechaNacimiento"],
    "usuario" => $_POST["usuario"],
    "password" => md5($_POST["password"]),
    "tipo" => $_POST["tipo"] ?? 0, //ADMIN ES TIPO 1
    "saldo" => 0 
);

// Si las contraseñas no coinciden
if(md5($_POST["passwordConf"]) != $params['password']){ 
    echo "<script>
    alert('Las contraseñas no coinciden');
    window.history.back();
    </script>
    ";
    die();
}
//instancia y conexion bd
$sesion = new ModeloUsuario();

if ( $sesion->agregar( $params ) ){
    echo "<script>alert('Su usuario fue registrado exitosamente');
    window.location.href='../vista/contact.html';
    </script>";
}
else {
    echo "<script>alert('Ocurrió un error al hacer el registro');
    window.location.href='../vista/contact.html';
    </script>";   			
}
die();
?>
