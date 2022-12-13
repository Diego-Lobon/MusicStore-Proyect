<?php

    include_once '../includes/carrito.php';

    $carrito = new Carrito();

    $idCarrito = $_POST['idCarrito'];
    
    $carrito -> eliminarProducto($idCarrito);
    echo "Eliminando ....";


?>