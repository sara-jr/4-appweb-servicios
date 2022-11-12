<?php
require_once('../../modelo/producto.php');

$modelo = new ModeloProducto();
$params = array_intersect_key($_POST, array_flip($modelo->fields));

if($modelo->agregar($params)){
    echo "<script>
        alert('Ingresado correctamente');
        </script>";
}
else{
    echo "Error al ingresar un producto: {$modelo->getLastError()}";
}

header('../../vista/index.html')
die();

?>
