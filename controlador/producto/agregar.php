<?php
require_once('../../modelo/producto.php');

$modelo = new ModeloProducto();
$params = array_intersect_key($_POST, array_flip($modelo->fields));
$rows = $modelo->agregar($params);

if($rows == 1){
    echo "<script>
        alert('Ingresado correctamente');
        </script>";
}

?>
