<?php

include_once 'conexion.php';

class Ip extends DB{

    private $idUsuario;
    private $nombre;
    private $apellido;
    private $correo;
    private $contraseña;
    private $tipo;
    private $activo;
    private $ip;
    

    public function usuarioExiste($correo, $contraseña){
        //$md5pass = md5($pass);
        $query = $this->connect()->prepare('SELECT * FROM usuarios WHERE correo = :correo AND contraseña = :contraseña');
        $query->execute(['correo' => $correo, 'contraseña' => $contraseña]);

        if ($query->rowCount()) {
            return true;
        }
        else{
            return false;
        }
    }

    public function usuarioIpExiste($ipUsuario){
        
        $query = $this->connect()->prepare('CALL Buscar_Usuario (:ipUsuario)');
        $query->execute(['ipUsuario' => $ipUsuario]);

        if ($query->rowCount()) {
            return true;
            
        }
        else{
            return false;
            
        }
        
    }

    public function usuarioIpExisteInformacion($ipUsuario){
        
        $query = $this->connect()->prepare('CALL Buscar_Usuario_Informacion (:ipUsuario)');
        $query->execute(['ipUsuario' => $ipUsuario]);

        if ($query->rowCount()) {
            return true;
            
        }
        else{
            return false;
            
        }
        
    }

    public function cargarUsuarioIpInformacion($ipUsuario){
        
        $query = $this->connect()->prepare('CALL Buscar_Usuario_Informacion (:ipUsuario)');
        $query->execute(['ipUsuario' => $ipUsuario]);

        return $query;
        
    }

    public function obtenerDatosUsuario($ip){
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
        //echo "<br>NOMBRE=".$this->nombre;
    }

    public function crearUsuario($ip){
        $query = $this->connect()->prepare("CALL Crear_Usuario ('-', '-', '-', '-', 'No Registrado', 'No Activo', :ip)");
        $query->execute(['ip' => $ip]);
        
        
    }

    public function crearUsuarioInformacion($ip){
        $query = $this->connect()->prepare("CALL Crear_Usuario_Informacion ('', '', '', '', '', '', '', '', '', '', :ip)");
        $query->execute(['ip' => $ip]);
 
    }

    public function actualizarUsuarioInformacion($nombre, $apellido, $direccion, $apartamento, $distrito, $region, $celular, $correo, $dni, $ip){
        $query = $this->connect()->prepare("CALL Actualizar_Usuario_Informacion (:nombre, :apellido, :direccion, :apartamento, :distrito, :region, :celular, :correo, :dni, :ip)");
        $query->execute(
            ['nombre' => $nombre,
            'apellido' => $apellido,
            'direccion' => $direccion,
            'apartamento' => $apartamento,
            'distrito' => $distrito,
            'region' => $region,
            'celular' => $celular,
            'correo' => $correo,
            'dni' => $dni,
            'ip' => $ip]
        );
    }

    public function actualizarUsuarioMetodo($metodo, $ip){
        $query = $this->connect()->prepare("CALL Actualizar_Usuario_Metodo (:metodo, :ip)");
        $query->execute(
            ['metodo' => $metodo,
            'ip' => $ip]
        );
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function registrarUsuario($nombre, $apellido, $correo, $contrasena){
        $query = $this->connect()->prepare("CALL `Registrar_Usuario` (:nombre, :apellido, :correo, :contrasena)");
        $query->execute(
            ['nombre' => $nombre,
            'apellido' => $apellido,
            'correo' => $correo,
            'contrasena' => $contrasena]
        );
    }

    public function validarUsuario($correo, $contrasena){
        
        $query = $this->connect()->prepare('CALL Validar_Usuario (:correo, :contrasena)');
        $query->execute(['correo' => $correo, 'contrasena' => $contrasena]);

        if ($query->rowCount()) {
            return true;
            
        }
        else{
            return false;
            
        }
        
    }

    public function datosUsuarioRegistrado($correo, $contrasena){
        
        $query = $this->connect()->prepare('CALL Validar_Usuario (:correo, :contrasena)');
        $query->execute(['correo' => $correo, 'contrasena' => $contrasena]);

        return $query;
        
    }

    public function datosUsuario($ipUsuario){
        
        $query = $this->connect()->prepare('CALL Buscar_Usuario (:ipUsuario)');
        $query->execute(['ipUsuario' => $ipUsuario]);

        return $query;
        
    }

    public function historialPedidosUsuario($ipUsuario){
        
        $query = $this->connect()->prepare('CALL Historial_Pedido_Usuario (:ipUsuario)');
        $query->execute(['ipUsuario' => $ipUsuario]);

        return $query;
        
    }

}

?>