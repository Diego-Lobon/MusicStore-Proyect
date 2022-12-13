<?php

    include_once '../includes/user.php';
    include_once '../includes/carrito.php';
    include_once '../includes/ventas.php';

    $carrito = new Carrito();
    $ip = new Ip();
    $venta = new Ventas();

    session_start();
    $ipUsuario = $_SESSION['usuario'];

    $idVentaMP = $_GET['payment_id'];
    $estado = $_GET['status'];
    $tipoPago = $_GET['payment_type'];
    $idOrdenComercial = $_GET['merchant_order_id'];

    $cantidadRegistrosLlamar = $carrito -> cantidadRegistros();
    $carritoProductos = $carrito -> listarCarritoProducto($ipUsuario);

    $usuario = $ip -> cargarUsuarioIpInformacion($ipUsuario);

    #$total = $carrito -> subTotal($ipUsuario);

    #foreach ($total as $fila) {
    #    $totalVenta = ['subTotal'];
    #}

    foreach($usuario as $fila) {

        $nombre = $fila['nombre'];
        $apellido = $fila['apellido'];
        $direccion = $fila['direccion'];
        $apartamento = $fila['apartamento'];
        $distrito = $fila['distrito'];
        $region = $fila['region'];
        $celular = $fila['celular'];
        $correo = $fila['correo'];
        $ip = $fila['ip'];
        $metodo = $fila['metodo'];
        $dni = $fila['dni'];

    }

    foreach($carritoProductos as $fila) {

        $idUsuario = $fila['idUsuario'];
        $idProducto = $fila['idProducto'];
        $CantidadProducto = $fila['cantidadProducto'];
        $total = $fila['total'];

        $venta -> registrarVenta($idVentaMP, $idUsuario, $estado, $tipoPago, $idOrdenComercial, $idProducto, $CantidadProducto, $total, $nombre, $apellido, $direccion, $apartamento, $distrito, $region, $celular, $correo, $ip, $metodo, $dni);

    }

    $venta -> limpiarInformacionUsuario($ipUsuario);
    $venta -> limpiarCarritoUsuario($ipUsuario);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Store</title>
    <link rel="stylesheet" href="../estilos/pago.css">
    <script src="https://kit.fontawesome.com/e450d1c081.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="card">
        <div class="mensajePago">
            <i class="fa-solid fa-credit-card"></i>
            <h2>Pago exitoso!</h2> 
        </div>
        <hr>
        <div class="mensajePago2">
            <p>Su pago fue procesado exitosamente.</p>
            <a href="../index.php"><button>Volver al Menú Principal</button></a>  
        </div>
    </div>
</body>
</html>
