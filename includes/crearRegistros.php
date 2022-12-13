<?php

    include_once '../includes/user.php';

    $ip = new Ip();

    session_start();
    $ipUsuario = $_SESSION['usuario'];

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];

    $ip -> registrarUsuario($nombre, $apellido, $correo, $contraseña);
    echo "Usuario Registrado";

?>