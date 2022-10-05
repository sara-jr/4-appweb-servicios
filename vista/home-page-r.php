<?php

    @session_start();

    if (isset($_SESSION['usuario'])) { //Si se ingresa despues de login
        $nombreU = $_SESSION['usuario'];
        $is_admin = ($_SESSION['tipo'] == 1);

        if($is_admin){ // Si es un administrador, mostrar un mensaje de bienvendia y redirigir a la pagina de admins
            echo "<script> 
            alert('Bienvenido, administrador.');
            </script>";
            require('../vista/page-home-admin.html');
        }
        else{ // Si no, redirigir a la pagina home regular
            require('../vista/page-home.html');
        }
    }
    else{ // Si no se inicia despues del login
        session_destroy();
        echo "<script> 
            alert('No has iniciado sesión');
            window.location.href='../vista/page-login.html';
        </script>";
    }


?>