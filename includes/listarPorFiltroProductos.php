<?php

    include_once '../includes/productos.php';    
    $producto = new Producto();

    $tipo = $_POST['tipo'];
    $categoria = $_POST['categoria'];
    $marca = $_POST['marca'];
    $opcion = $_POST['opcion'];
    $orden = $_POST['orden'];

    $productos = $producto -> listarPorCategoria($categoria, $opcion, $tipo, $marca, $orden);

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