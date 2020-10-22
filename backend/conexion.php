<?php
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=usuarios', 'root', '');
        // echo 'conexion exitosa';
        session_start();
    } catch (PDOException $e) {
        echo 'error de conexión'.$e;
    }
?>