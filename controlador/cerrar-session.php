<?php
    session_start();
    session_destroy();
    header('Location: ../vista/page-login.html ');
?>