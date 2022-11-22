<?php
require_once('../../modelo/producto.php');

$modelo = new ModeloProducto();
print_r($_POST);
$params = array(
    'idCategoria'   => $_POST['idCategoria'],
    'nombre'        => $_POST['nombre'],
    'descripcion'   => $_POST['descripcion'],
    'costo'         => $_POST['costo'],
    'cantidad'      => $_POST['cantidad']
);

if($modelo->agregar($params)){
    echo "<script>
        alert('Ingresado correctamente');
        </script>";
}
else{
    echo "Error al ingresar un producto: {$modelo->getLastError()}";
}

header('Location: ../../vista/productos.php');
die();

?>
