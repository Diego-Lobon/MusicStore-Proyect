<?php 

    include_once '../includes/user.php';
    include_once '../includes/carrito.php';

    $carrito = new Carrito();
    $ip = new Ip();

    session_start();
    $ipUsuario = $_SESSION['usuario'];

    #$origen = ;

    if(isset($_POST['origen'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $direccion = $_POST['direccion'];
        $apartamento = $_POST['apartamento'];
        $distrito = $_POST['distrito'];
        $region = $_POST['region'];
        $correo = $_POST['correo'];
        $celular = $_POST['celular'];
        $dni = $_POST['dni'];
        $ip -> actualizarUsuarioInformacion($nombre, $apellido, $direccion, $apartamento, $distrito, $region, $celular, $correo, $dni, $ipUsuario);
    }

  

    $usuario = $ip -> cargarUsuarioIpInformacion($ipUsuario);

    $carritoProductos = $carrito -> listarCarritoProducto($ipUsuario);
    $subTotal = $carrito -> subTotal($ipUsuario);
    $total = $carrito -> subTotal($ipUsuario);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/pagoEnvio.css">
    <link rel="stylesheet" href="../icons.css">
    <title>Music Store</title>
</head>
<body>
    <div class="container">
            
        <div class="pago_informacion">
            <span class="titulo">Music Store</span>
            <div class="pago_navegacion">
                <ul>
                    <li>
                        <a href="">Carrito</a>
                    </li>
                    <li>
                        <a href="">Información</a>
                    </li>
                    <li>
                        <a href="">Envíos</a>
                    </li>
                    <li>
                        <a href="">Pago</a>
                    </li>
                </ul>
            </div>

            <?php foreach($usuario as $fila) {
                
            ?>

            <form action="./pagoFinal.php" method="POST">
                <input type="hidden" name="origen" value="envio">
                <div class="caja_contacto_envio">
                    <div class="contacto">
                        <div>
                            <span class="contacto_titulo">Contacto</span>
                            <span class="correo"><?php echo $fila['correo'] ?>, <?php echo $fila['celular'] ?></span>
                        </div>
                        <a href="./pagoInformacion.php">Cambiar</a>
                    </div>
                    <hr>
                    <div class="envio">
                        <div>
                            <span class="envio_titulo">Envío</span>
                            <span class="datos"><?php echo $fila['dni'] ?>, <?php echo $fila['direccion'] ?>, <?php echo $fila['apartamento'] ?>, <?php echo $fila['distrito'] ?>, <?php echo $fila['region'] ?></span>
                        </div>
                        <a href="./pagoInformacion.php">Cambiar</a>
                    </div>
                </div>
                <span class="metodo_titulo">Metodo</span>
                <div class="caja_metodo">
                    <input type="radio" name="metodo" value="Envio a domicilio, pago Mercado Pago" checked>
                    <span class="dato_metodo">Envio a domicilio, pago Mercado Pago</span>
                </div>
                <div class="opciones_avance">
                    <a href="./pagoInformacion.php">Volver a información</a>
                    <button>Continuar con envíos</button>
                </div>
            </form>

            <?php } ?>

        </div>
        <div class="pago_producto">
            <?php foreach($carritoProductos as $fila) {
                
            ?>
    
                <div class="producto_info">
                    <img src="../img/productos/<?php echo $fila['nombre'] ?>.png" alt="Imagen-producto">
                    <div class="producto">
                        <h2><?php echo $fila['nombre'] ?></h2>
                        <div>
                            <span>Precio Unitario: </span>
                            <span>S/.<?php echo $fila['precio'] ?></span>
                            <br>
                            <span>Precio Total: </span>
                            <span>S/.<?php echo $fila['total'] ?></span>
                        </div>
                        
                    </div>
                </div>
    
            <?php } ?>
                
                <hr>
                
            <?php foreach($subTotal as $fila) {
                   
            ?>
                
                <div class="subtotal">
                    <span>Subtotal</span>
                    <span class="subtotal_precio">S/.<?php echo $fila['subTotal'] ?></span>
                </div>
                <hr>
                <div class="total">
                    <span>Total</span>
                    <span class="total_precio">S/.<?php echo $fila['subTotal'] ?></span>
                </div>
    
            <?php } ?>
        </div>
        
    </div>
    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="main.js"></script>
</body>
</html>
