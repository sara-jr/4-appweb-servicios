<?php
require_once('../modelo/producto.php');

function productos(){
    $modelo = new ModeloProducto();
    $foo = '';
    $datos = $modelo->listar($foo);
    $tblmain = "";
    foreach ($datos as $filas) {
        $tblmain .= "<tr class='text-center'>\n";
        $tblmain .= "<td>". $filas['nombre'] . "</td>\n";
        $tblmain .= "<td class='text-center'><img src='../vista/imagenes/mody.png'></td>\n";
        $tblmain .= "<td class='text-center'><img src='../vista/imagenes/elim.png'></td>\n";
        $tblmain .= "</tr>";
    }

    return $tblmain;
}


?>
