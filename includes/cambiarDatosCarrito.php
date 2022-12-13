<?php

    include_once '../includes/productos.php';
    include_once '../includes/carrito.php';

    $carrito = new Carrito();
    $producto = new Producto();

    $cantidad = $_POST['cantidadProducto']; #CANTIDAD DEL SELEC PARA PRODUCTO
    $nombreProducto = $_POST['nombreProducto'];
    
    session_start();
    $ipUsuario = $_SESSION['usuario'];

    #PRECIO DEL PRODUCTO
    $productosSeleccionado = $producto -> obtenerDatosProducto($nombreProducto);
    foreach($productosSeleccionado as $fila) {
        $precio = $fila['precio'];
    }

    $pagoTotal = $cantidad * $precio;

    $carrito -> insertarProducto($nombreProducto, $ipUsuario, $cantidad, $pagoTotal);
    echo "Agregando ....";

?>