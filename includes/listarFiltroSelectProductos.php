<?php

    include_once '../includes/productos.php';    
    $producto = new Producto();

    $categoria = $_POST['categoria'];
    $orden = $_POST['orden'];
    $tipo = $_POST['tipo'];
    $marca = $_POST['marca'];

    $productos = $producto -> listarProductoOrden($categoria, $orden, $tipo, $marca);

    foreach($productos as $fila){
        $arr[] = $fila;
    }

    if(isset($arr)){
        echo json_encode($arr);
    }
    else {
        echo "No hay Registros";
    }

    

?>