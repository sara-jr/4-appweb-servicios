<?php
require_once('../../modelo/producto.php');

$modelo = new ModeloProducto();
$params = array_values(array_intersect_key($_POST, array_flip($modelo->fields)));
$id = $_POST['id'];

if($modelo->actualizar($params, $id)){
    echo "<script>
        alert('Datos actualizados');
        </script>";
}
else{
    echo "Error al actualizar: {$modelo->getLastError()}";
}

header('Location: ../../vista/productos.php');
die();

?>
