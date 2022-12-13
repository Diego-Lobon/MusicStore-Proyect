<?php

    include_once '../includes/productos.php';    
    $producto = new Producto();

    $productoBuscar = $_POST['producto'];

    

    $productos = $producto -> buscadorProducto($productoBuscar);

    foreach($productos as $fila){
        $arr[] = $fila;
    }


    
    if(isset($arr)){
        echo json_encode($arr);
    }

?>