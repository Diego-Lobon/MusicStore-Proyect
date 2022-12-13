<?php

    include_once '../includes/user.php';
    include_once '../includes/productos.php';  

    session_start();
    $ip = new Ip();
    $ipUsuario = $_SESSION['usuario'];
    $Usuario = $ip->datosUsuario($ipUsuario);

    foreach($Usuario as $fila) {
        $tipoUsuario = $fila['tipo'];
        $nombre = $fila['nombre'];
        $ip = $fila['ip'];
    }

?>

<?php include_once '../paginas/static/navegador.php' ?>

    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/registrarse.css">

    <div id="contenedorRegistro">
    <div class="container">
        <h1>Crear Cuenta</h1>
        <form class="form_registro" id="formRegistro">
            <div class="inputPrimero">
                <input type="text" placeholder="Nombre" name="nombre">
                <input type="text" placeholder="Apellido" name="apellido">
            </div>
            <div class="inputSegundo">
                <input type="text" placeholder="Correo" name="correo">
                <input type="password" placeholder="Contraseña" name="contraseña">
            </div>
            <div class="form_envia-iniciarSesion">
                <input type="button" class="enviarDatos" value="Enviar" id="enviarRegistro" onclick="crearRegistroUsuario('formRegistro')">
                <span>¿Cliente registrado? <a href="../paginas/iniciarSesion.php">Iniciar Sesion</a></span>
                
            </div>
        </form>
    </div>
    </div>
    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>    

  <script src="/PROYECTO TIENDA DE MUSICA/js/functions.js"></script>

    
</body>
</html>