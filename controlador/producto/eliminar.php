<?php
require_once('../../modelo/producto.php');
$id = $_GET['id'];

$model = new ModeloProducto();

echo "
<script>
    if(!window.confirm('¿Eliminar este producto?')){
        window.history.back();
    }
</script>
";

if($model->eliminar($id)){
    echo "Eliminado correctamente";
}
else{
    echo "Error: {$model->getLastError()}";
}

header('Location: ../../vista/index.html');
die();
?>
