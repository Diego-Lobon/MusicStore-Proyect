<?php

class IpSession{

    public function __construct(){
        session_start();
    }

    public function iniciarSesion($ip){
        $_SESSION['usuario'] = $ip;
    }

    public function getCurrentCod(){
        return $_SESSION['usuario'];
    }

    public function closeSession(){
        session_unset();
        session_destroy();
    }

    public function getAllCursos(){
         
    }



}

?>