<?php
require_once('../modelo/producto.php');

function listar(){
    $model = new ModeloCategoria();
    $output = '';
    foreach($model->listar() as $fila){
        $output .= "
        <option value='{$fila['idCategoria']}'>{$fila['nombre']}</opcion>
        ";
    }
    return $output;
}

?>