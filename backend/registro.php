<?php

include_once('conexion.php');

$correo = $_POST['email'];
$contrasena = $_POST['password'];
$nivel = $_POST['nevel'];
$img = "img.png";

if (preg_match('`[a-z]`', $contrasena)) {
    if (preg_match('`[A-Z]`', $contrasena)) {
        if (preg_match('`[0-9]`', $contrasena)) {
            $registro = $conexion->prepare("INSERT INTO t_usuarios (id_usuario, correo, contrapass, nevel, status, images) VALUES (null, :correo, :pass, :nvl , 1, :imag)");
            $registro->bindParam(':correo', $correo, PDO::PARAM_STR);
            $registro->bindParam(':pass', $contrasena, PDO::PARAM_STR);
            $registro->bindParam(':nvl', $nivel, PDO::PARAM_INT);
            $registro->bindParam(':imag', $img, PDO::PARAM_STR);

            $registro->execute();

            $_SESSION['mensaje'] = 'Usuario registrado';
            $_SESSION['tipo'] = 'success';
            header('Location:../index.php?pagina=1');
        } else {
            $_SESSION['mensaje'] = 'La contraseña no es válida';
            $_SESSION['tipo'] = 'danger';
            header('Location:../index.php?pagina=1');
        }
    } else {
        $_SESSION['mensaje'] = 'La contraseña no es válida';
        $_SESSION['tipo'] = 'danger';
        header('Location:../index.php?pagina=1');
    }
} else {
    $_SESSION['mensaje'] = 'La contraseña no es válida';
    $_SESSION['tipo'] = 'danger';
    header('Location:../index.php?pagina=1');
}
