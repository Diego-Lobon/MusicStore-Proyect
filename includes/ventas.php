<?php

include_once 'conexion.php';

class Ventas extends DB{

    
    private $idUsuario;
    private $idProducto;
    private $cantidadProducto;

    public function registrarVenta($idVentaMP, $idUsuario, $estado, $tipoPago, $idOrdenComercial, $idProducto, $CantidadProducto, $total, $nombre, $apellido, $direccion, $apartamento, $distrito, $region, $celular, $correo, $ip, $metodo, $dni){

        $query = $this->connect()->prepare("CALL Registrar_Venta (:idVentaMP, :idUsuario, :estado, :tipoPago, :idOrdenComercial, :idProducto, :CantidadProducto, :total, :nombre, :apellido, :direccion, :apartamento, :distrito, :region, :celular, :correo, :ip, :metodo, :dni)");
        $query->execute(
            [
                'idVentaMP' => $idVentaMP,
                'idUsuario' => $idUsuario,
                'estado' => $estado,
                'tipoPago' => $tipoPago,
                'idOrdenComercial' => $idOrdenComercial,
                'idProducto' => $idProducto,
                'CantidadProducto' => $CantidadProducto,
                'total' => $total,
                'nombre' => $nombre,
                'apellido' => $apellido,
                'direccion' => $direccion,
                'apartamento' => $apartamento,
                'distrito' => $distrito,
                'region' => $region,
                'celular' => $celular,
                'correo' => $correo,
                'ip' => $ip,
                'metodo' => $metodo,
                'dni' => $dni,
            ]
        );
    }

    public function limpiarInformacionUsuario($ipUsuario){

        $query = $this->connect()->prepare("CALL Limpiar_Informacion_Usuario (:ipUsuario)");
        $query->execute(['ipUsuario' => $ipUsuario]);
        
        
    }

    public function limpiarCarritoUsuario($ipUsuario){

        $query = $this->connect()->prepare("CALL Limpiar_Carrito_Usuario (:ipUsuario)");
        $query->execute(['ipUsuario' => $ipUsuario]);
        
        
    }
    

    

}

?>