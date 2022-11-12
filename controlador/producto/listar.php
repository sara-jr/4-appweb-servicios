<?php
require_once('../modelo/producto.php');

function productos(){
    $modelo = new ModeloProducto();
    $datos = $modelo->listar();
    $tblmain = "";
    foreach ($datos as $filas) {
        $tblmain .= "<tr class='text-center'>\n
        <td> {$filas['nombre']}</td>\n
        <td> {$filas['descripcion']}</td>\n
        <td> $ {$filas['costo']}</td>\n
        <td> {$filas['cantidad']}</td>\n
        <td><a href='../vista/producto.php?id={$filas['idProducto']}'>Editar</a></td>\n
        <td><a href='../controlador/producto/eliminar.php?id={$filas['idProducto']}'>Elimnar</a></td>\n
        </tr>";
    }

    return $tblmain;
}


?>
