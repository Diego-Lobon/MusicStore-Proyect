<?php
    
    include_once './includes/user.php';
    include_once './includes/user_session.php';
    include_once './includes/productos.php';

    $ipSession = new IpSession();
    $ip = new Ip();
    $producto = new Producto();

    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

    $ipUsuario = get_client_ip();


    
    
    if (isset($_POST['correo']) && isset($_POST['contraseña'])){
        
        echo "Validacion de login";

        $correo = $_POST['correo'];
        $contraseña = $_POST['contraseña'];

        if($ip->validarUsuario($correo, $contraseña)){
            
            $Usuario = $ip->datosUsuarioRegistrado($correo, $contraseña);

            foreach($Usuario as $fila) {
                $nombre = $fila['nombre'];
                $ipUsuario = $fila['ip'];
            }
            echo "IPPP: ".$ipUsuario;
            $ipSession -> iniciarSesion($ipUsuario);
            $productos = $producto -> obtenerProductos();

            $ipUsuario = $_SESSION['usuario'];
            $Usuario = $ip->datosUsuario($ipUsuario);

            foreach($Usuario as $fila) {
                $tipoUsuario = $fila['tipo'];
                $nombre = $fila['nombre'];
                $ip = $fila['ip'];
            }

            include_once './paginas/menuPrincipal.php';
            
        }
        else{

            $errorLogin = "Correo y/o contraseña incorrecto";
            include_once './paginas/iniciarSesion.php';

        }

        

    }


    elseif (isset($_SESSION['usuario'])){

        $ipUsuario = $_SESSION['usuario'];
        $Usuario = $ip->datosUsuario($ipUsuario);
        $productos = $producto -> obtenerProductos();

        foreach($Usuario as $fila) {
            $tipoUsuario = $fila['tipo'];
            $nombre = $fila['nombre'];
            $ip = $fila['ip'];
        }

        include_once './paginas/menuPrincipal.php';

    }



    else {
        
        if($ip -> usuarioIpExiste($ipUsuario)){
            echo "Usuario Existe";
            $ipSession -> iniciarSesion($ipUsuario);
        }
        else{
            echo "Usuario no Existe";
            $ip -> crearUsuario($ipUsuario);
            $ipSession -> iniciarSesion($ipUsuario);
            
        }
        
        $ipUsuario = $_SESSION['usuario'];
        $Usuario = $ip->datosUsuario($ipUsuario);

        foreach($Usuario as $fila) {
            $tipoUsuario = $fila['tipo'];
            $nombre = $fila['nombre'];
            $ip = $fila['ip'];
        }

        $productos = $producto -> obtenerProductos();
        include_once './paginas/menuPrincipal.php';
        
    }
    
?>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>