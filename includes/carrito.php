<?php

include_once 'conexion.php';

class Carrito extends DB{

    private $idCarrito;
    private $idUsuario;
    private $idProducto;
    private $cantidadProducto;

    public function listarCarrito(){

        $query = $this->connect()->prepare("CALL Listar_Carrito ()");
        $query->execute();
        return $query;
        
    }

    public function subTotal($ipUsuario){

        $query = $this->connect()->prepare("CALL Sub_Total_Carrito (:ipUsuario)");
        $query->execute(['ipUsuario' => $ipUsuario]);
        return $query;
        
    }

    public function eliminarProducto($idCarrito){

        $query = $this->connect()->prepare("CALL Eliminar_Producto (:idCarrito)");
        $query->execute(['idCarrito' => $idCarrito]);
        return $query;
        
    }

    public function listarCarritoProducto($ipUsuario){

        $query = $this->connect()->prepare("CALL Listar_Carrito_Productos (:ipUsuario)");
        $query->execute(['ipUsuario' => $ipUsuario]);
        return $query;
        
    }

    public function insertarProducto($nombreProducto, $ipUsuario, $cantidadProducto, $totalPrecio){

        $query = $this->connect()->prepare("CALL Insertar_Producto_Carrito (:nombreProducto, :ipUsuario, :cantidadProducto, :totalPrecio)");
        $query->execute(['nombreProducto' => $nombreProducto, 'ipUsuario' => $ipUsuario, 'cantidadProducto' => $cantidadProducto, 'totalPrecio' => $totalPrecio]);
        
    }
    
    public function obtenerDatosCarrito($nombreProducto, $ipUsuario){
        $query = $this->connect()->prepare('CALL Buscar_Carrito (:nombreProducto, :ipUsuario)');
        $query->execute(['nombreProducto' => $nombreProducto, 'ipUsuario' => $ipUsuario]);
        
        foreach($query as $currentCod){
            $this->idCarrito = $currentCod['idCarrito'];
            $this->idUsuario = $currentCod['idUsuario'];
            $this->idProducto = $currentCod['idProducto'];
            $this->cantidadProducto = $currentCod['cantidadProducto'];
            
        }
        //echo "<br>NOMBRE=".$this->nombre;
    }
    
    public function getCantidadProducto(){
        return $this->cantidadProducto;
    }
    
    public function buscarCarrito($nombreProducto, $ipUsuario){

        $query = $this->connect()->prepare("CALL Buscar_Carrito (:nombreProducto, :ipUsuario)");
        $query->execute(['nombreProducto' => $nombreProducto, 'ipUsuario' => $ipUsuario]);
        return $query;

    }
    
    public function cantidadRegistros(){

        $query = $this->connect()->prepare("CALL Cantidad_Registros_Carrito ()");
        $query->execute();
        return $query;

    }
    

}

?>