<?php

    include_once '../includes/user.php';
    include_once '../includes/carrito.php';
    require  '../vendor/autoload.php';

    $carrito = new Carrito();
    $ip = new Ip();

    session_start();
    $ipUsuario = $_SESSION['usuario'];

    

    if(isset($_POST['origen'])){
        $metodo = $_POST['metodo'];

        $ip -> actualizarUsuarioMetodo($metodo, $ipUsuario);
    }

    

    $usuario = $ip -> cargarUsuarioIpInformacion($ipUsuario);

    $usuarioInformacion = $ip -> datosUsuario($ipUsuario);

    $carritoProductos = $carrito -> listarCarritoProducto($ipUsuario);
    $subTotal = $carrito -> subTotal($ipUsuario);
    $total = $carrito -> subTotal($ipUsuario);

?>

<?php

    foreach($usuarioInformacion as $fila) {
        $idUsuario = $fila['idUsuario'];

    }

    foreach($total as $fila) {
        $totalMP = $fila['subTotal'];
        
    }

    

    MercadoPago\SDK::setAccessToken('TEST-2540885682950246-110922-bb5401fcf1354474376dfc9d13f06153-391253763');

    $preference = new MercadoPago\Preference();

    $item = new MercadoPago\Item();
    $item->id = '0001';
    $item->title = 'Music Store #'.$idUsuario;
    $item->quantity = 1;
    $item->unit_price = $totalMP;
    $item->currency_id = "PE";
   
    $preference->back_urls = array(
        "success" => "http://localhost:8080/Proyecto%20Tienda%20de%20Musica/paginas/PagoFinalizado.php",
        "failure" => "http://localhost:8080/Proyecto%20Tienda%20de%20Musica/paginas/PagoFallido.php",
    );
    
    $preference->auto_return = "approved";
    $preference->binary_mode = true;

    $preference->items = array($item);
    
    $preference->save();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/pagoFinal.css">
    <link rel="stylesheet" href="../icons.css">
    <title>Music Store</title>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
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

            <form action="">
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
                    <hr>
                    <div class="metodo">
                        <span class="metodo_titulo">Metodo</span>
                        <span class="metodo_dato"><?php echo $fila['metodo'] ?></span>
                    </div>
                </div>
                
                
                

               
            </form>

            <?php } ?>

            <!-- BOTON MERCADO PAGO -->
            <div class="checkout-btn"></div>
                
                <script>

                    const mp = new MercadoPago('TEST-e7d444e2-2717-49ae-ac3d-455a5a9c3db8', {
                        locale: 'es-PE'
                    });

                    mp.checkout({
                        preference: {
                            id: '<?php echo $preference->id; ?>'
                        },
                        render: {
                            container: '.checkout-btn',
                            label: 'Pagar con Mercado Pago',
                        }
                    });

                    
                </script>
            <br>
            <br>
            <div class="opciones_avance">
                <a href="./pagoEnvio.php">Volver a envíos</a>
            </div>

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
    
    
</body>
</html>
