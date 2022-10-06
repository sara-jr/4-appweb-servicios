<?php
require_once("../modelo/conexion.php");
require_once("../modelo/modelo.php");

@session_start();

$params = array(
    "usuario" => $_POST["usuario"],
    "pass" => $_POST["pass"],
    "admin" => $_POST["admin"]
);

print_r($params); 
//instancia y conexion bd
$db = Database::getInstance();
$conn = $db->getConnection();
$sesion = new Modelo($conn); 


//llamar a la funcion 'agregausuario'
list ($valor, $error) = $sesion->validarusuario( $params );
if ( empty( $valor ) ){
    
    if($error == "d"){// USARIO DUPLICADO
        echo "<script>alert('Usuario duplicado, vuelva a intentar');
        history.go(-1);
        </script>"; 
        
    }else{ // USUARIO O CONTRASEÑA INCORRECTAS
        echo "<script>alert('El usuario o la contraseña son incorrectos');
        window.location.href='../vista/login.html';
        </script>";   			
    }
                   
} else { // LOGIN CORRECTO
    echo "<script>alert('Has iniciado sesion.');
    window.location.href='../vista/home-page-r.php';
    </script>";
}
?>