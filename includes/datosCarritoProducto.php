<?php
    
    include_once '../includes/productos.php';
    include_once '../includes/carrito.php';

    $carrito = new Carrito();
    $producto = new Producto();
    
    session_start();
    $ipUsuario = $_SESSION['usuario'];
    $cantidad = $_POST['cantidadProducto']; #CANTIDAD DEL SELEC PARA PRODUCTO
    $nombreProducto = $_POST['nombreProducto'];

    #CANTIDAD DEL PRODUCTO
    $productosSeleccionado = $producto -> obtenerDatosProducto($nombreProducto);
    foreach($productosSeleccionado as $fila) {
        $cantidadActual = $fila['cantidad'];
        $precio = $fila['precio'];
    }

    $productosCarrito = $carrito -> buscarCarrito($nombreProducto, $ipUsuario);
    foreach($productosCarrito as $fila) {
        $cantidadCarrito = $fila['cantidadProducto'];
    }

    if(!isset($cantidadCarrito)){
        $cantidadCarrito = 0;
    }

    $carrito -> obtenerDatosCarrito($nombreProducto, $ipUsuario);
    $cantidadInsertar = $cantidad + $cantidadCarrito; #CANTIDAD A INSERTAR
    
    if ($cantidadInsertar > $cantidadActual) {
        echo "Supera el limite de cantidad, revise su carrito e ingrese otra cantidad";

    }
    else {
        $pagoTotal = $cantidadInsertar * $precio;
        $carrito -> insertarProducto($nombreProducto, $ipUsuario, $cantidadInsertar, $pagoTotal);
        echo "Agregando ....";
    }
    
    
?>
