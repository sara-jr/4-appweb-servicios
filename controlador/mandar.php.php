<?php
require_once("../modelo/conexion.php");
require_once("../modelo/modelo.php");
@session_start();

$params = array(
    
    "usuario" => $_POST["usuario"],
    "pass" => $_POST["pass"]
);

print_r($params); die();

?>