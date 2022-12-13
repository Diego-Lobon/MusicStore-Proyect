<?php

include_once 'conexion.php';

class Producto extends DB{

    private $idProducto;
    private $nombre;
    private $descripcion;
    private $precio;
    private $marca;
    private $modelo;
    private $cantidad;
    private $categoria;
    private $tipo;

    public function obtenerProductos(){

        $query = $this->connect()->prepare("CALL Listar_Productos()");
        $query->execute();
        //$cursos = array();
        return $query;
        
    }
    

    public function obtenerDatosProducto($producto){

        $query = $this->connect()->prepare("CALL Buscar_Producto (:producto)");
        $query->execute(['producto' => $producto]);

        return $query;
        
    }

    public function obtenerDatosProductoPorId($id){

        $query = $this->connect()->prepare("CALL Buscar_Producto_ID (:id)");
        $query->execute(['id' => $id]);

        return $query;
        
    }

    public function getCantidad(){
        return $this->cantidad;
    }

    public function getNombreProducto(){
        return $this->nombre;
    }

    public function cargarProducto($ip){
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE ip = :ip');
        $query->execute(['ip' => $ip]);
        
        foreach($query as $currentCod){
            $this->idUsuario = $currentCod['idUsuario'];
            $this->nombre = $currentCod['nombre'];
            $this->apellido = $currentCod['apellido'];
            $this->correo = $currentCod['correo'];
            $this->contraseña = $currentCod['contraseña'];
            $this->tipo = $currentCod['tipo'];
            $this->activo = $currentCod['activo'];
            $this->ip = $currentCod['ip'];
            
        }
        
    }

    public function listarPorCategoria($categoria, $opcion, $tipo, $marca, $orden){

        if ($opcion == 'categoria') {

            if($orden == 'Mas vendidos'){
                $query = $this->connect()->prepare("CALL Listar_Por_Categoria (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
            elseif($orden == 'Precio, menor a mayor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
            elseif($orden == 'Precio, mayor a menor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
 
        } 
        elseif ($opcion == 'tipo' && $marca == 'noMarca') {

            if($orden == 'Mas vendidos'){
                $query = $this->connect()->prepare("CALL Listar_Tipo_Producto (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            elseif($orden == 'Precio, menor a mayor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Tipo (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            elseif($orden == 'Precio, mayor a menor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Tipo (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            
        }
        elseif ($opcion == 'marca' && $tipo == 'noTipo') {

            if($orden == 'Mas vendidos'){
                $query = $this->connect()->prepare("CALL Listar_Marca_Producto (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }
            elseif($orden == 'Precio, menor a mayor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Marca (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }
            elseif($orden == 'Precio, mayor a menor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Marca (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }          

        }
        elseif ($tipo != 'marca' && $marca != 'noTipo') {

            if($orden == 'Mas vendidos'){
                $query = $this->connect()->prepare("CALL Listar_Marca_Tipo_Producto (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }
            elseif($orden == 'Precio, menor a mayor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Tipo_Marca (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }
            elseif($orden == 'Precio, mayor a menor'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Tipo_Marca (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }          
        
        }
        else {
            # code...
        }
        

        
        
    }

    public function listarTipos($categoria){

        $query = $this->connect()->prepare("CALL Listar_Tipos (:categoria)");
        $query->execute(['categoria' => $categoria]);
        return $query;
        
    }

    public function listarMarcas($categoria){

        $query = $this->connect()->prepare("CALL Listar_Marcas (:categoria)");
        $query->execute(['categoria' => $categoria]);
        return $query;
        
    }

    public function listarProductoOrden($categoria, $orden, $tipo, $marca){

        if($orden == 'Mas vendidos'){

            if($tipo != 'noTipo' && $marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Marca_Tipo_Producto (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }
            elseif($tipo != 'noTipo'){
                $query = $this->connect()->prepare("CALL Listar_Tipo_Producto (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            elseif($marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Marca_Producto (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }
            else{
                $query = $this->connect()->prepare("CALL Listar_Por_Categoria (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
            
        }
        elseif($orden == 'Precio, menor a mayor'){ #ASC

            if($tipo != 'noTipo' && $marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Tipo_Marca (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }
            elseif($tipo != 'noTipo'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Tipo (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            elseif($marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente_Marca (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }
            else{
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Ascendente (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
            
        }
        elseif($orden == 'Precio, mayor a menor'){ #DESC

            if($tipo != 'noTipo' && $marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Tipo_Marca (:categoria, :tipo, :marca)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo, 'marca' => $marca]);
                return $query;
            }
            elseif($tipo != 'noTipo'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Tipo (:categoria, :tipo)");
                $query->execute(['categoria' => $categoria, 'tipo' => $tipo]);
                return $query;
            }
            elseif($marca != 'noMarca'){
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente_Marca (:categoria, :marca)");
                $query->execute(['categoria' => $categoria, 'marca' => $marca]);
                return $query;
            }
            else{
                $query = $this->connect()->prepare("CALL Listar_Producto_Orden_Descendente (:categoria)");
                $query->execute(['categoria' => $categoria]);
                return $query;
            }
            
        }

        
        
    }

    

    public function buscadorProducto($producto){

        $query = $this->connect()->prepare("CALL Buscador_Producto (:producto)");
        $query->execute(['producto' => $producto]);

        return $query;
        
    }
    

}

?>