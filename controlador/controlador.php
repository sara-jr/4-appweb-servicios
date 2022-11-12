<?php
    require_once("../modelo/modelo.php");
    class ModelSingleton{
        private ModeloProducto $producto;

        private function __construct(){
        }

        public function getProductoInstance(){
            return producto;
        }

    }


    function instancia (){
        $db=Database::getInstance();
        $conn = $db->getConnection();
        $MySQL = new Modelo ($conn);
        return $MySQL;
    }

    function perfil($id){
        $MySQL = instancia();
        $query = $MySQL->datosPerfil($id);
        
        $nombre = $ape1 = $telefono = $correo = $edad = $usuario = $password = null;

        foreach ($query as $filas) {
            //var_dump($filas);
            $nombre = $filas['nombre'];
            $ape1 = $filas['apellido'];
            $telefono = $filas['telefono'];
            $correo = $filas['correo'];
            $edad = $filas['edad'];
            $usuario = $filas['usuario'];
            $password = $filas['password'];
        }

        $result[] = $nombre;
        $result[] = $ape1;
        $result[] = $telefono;
        $result[] = $correo;
        $result[] = $edad;
        $result[] = $usuario;
        $result[] = $password;
        
        return $result;
    }

    function alert($msg){
        echo "
        <script>
            alert($msg);
        </script>
        ";
    }


?>
