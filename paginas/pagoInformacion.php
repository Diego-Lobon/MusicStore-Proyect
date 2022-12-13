
<?php

    include_once '../includes/user.php';
    include_once '../includes/carrito.php';

    $carrito = new Carrito();
    $ip = new Ip();

    session_start();
    $ipUsuario = $_SESSION['usuario'];
    $UsuarioDatos = $ip->datosUsuario($ipUsuario);

    foreach($UsuarioDatos as $fila) {
        $tipoUsuario = $fila['tipo'];
        $nombre = $fila['nombre'];
        $correo = $fila['correo'];
    }

    if($ip -> usuarioIpExisteInformacion($ipUsuario)){
        
    }
    else{
        $ip -> crearUsuarioInformacion($ipUsuario);
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
    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/pagoInformacion.css">
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

            <form action="./pagoEnvio.php" method="POST">
                <input type="hidden" name="origen" value="informacion">
                <div class="pago_informacion_titulo">
                    <span class="titulo_informacion">Información de contacto</span>

                    <?php if($tipoUsuario == 'No Registrado'){ ?>

                    <div>
                        <span class="titulo_cuenta">¿Ya tienes una cuenta?</span>
                        <a href="">Iniciar Sesión</a> 
                    </div>
                    
                    <?php 
                    }
                    else{
                    ?>

                        

                    <?php } ?>

                </div>
                <div class="inputs_pago_informacion_titulo">
                    <div>
                        <span class="place_correo">Correo electronico</span>

                        <?php if($tipoUsuario == 'No Registrado'){ ?>

                        <input type="text" name="correo" value="<?php echo $fila['correo'] ?>">

                        <?php 
                        }
                        else{
                        ?>

                        <input type="text" name="correo" value="<?php echo $correo ?>" tabindex="-1" onfocus="this.blur()">

                        <?php } ?>

                    </div>
                    <div>
                        <span class="place_celular">Nro. de celular</span>
                        <input type="text" name="celular" value="<?php echo $fila['celular'] ?>">
                    </div>
                     
                </div>
                
                <div class="direccion_envio">
                    <span>Dirección de envío</span>
                    <div class="inputs_nombres">
                        <div class="input_pago input_nombre">
                            <span class="place_nombre">Nombres</span>
                            <input type="text" name="nombre" value="<?php echo $fila['nombre'] ?>">
                        </div>
                        <div class="input_pago input_apellido">
                            <span class="place_apellido">Apellidos</span>
                            <input type="text" name="apellido" value="<?php echo $fila['apellido'] ?>">
                        </div>
                    </div>
                    <div class="input_pago input_direccion">
                        <span class="place_direccion">Dirección</span>
                        <input type="text" name="direccion" value="<?php echo $fila['direccion'] ?>">
                    </div>
                    <div class="input_pago input_apartamento">
                        <span class="place_apartamento">Apartamento, localidad, etc.</span>
                        <input type="text" name="apartamento" value="<?php echo $fila['apartamento'] ?>">
                    </div>
                    <div class="inputs_ubicacion">
                        <div class="input_pago input_distrito">
                            <span class="place_distrito">Distrito</span>
                            <input type="text" name="distrito" value="<?php echo $fila['distrito'] ?>">
                        </div>
                        <div class="input_pago input_region">
                            <span class="place_region">Región</span>
                            <input type="text" name="region" value="<?php echo $fila['region'] ?>">
                        </div>
                    </div>
                    <div class="input_pago input_dni">
                        <span class="place_apartamento">DNI.</span>
                        <input type="text" name="dni" value="<?php echo $fila['dni'] ?>">
                    </div>
                </div>
                
                
                <div class="opciones_avance">
                    <a href="./carritoCompras.php">Volver al carrito</a>
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
                    <div class="producto_precios">
                        <div>
                            <span>Precio Unitario: </span>
                            <span>S/.<?php echo $fila['precio'] ?></span>
                        </div>
                        <div>
                            <span>Precio Total: </span>
                            <span>S/.<?php echo $fila['total'] ?></span>
                        </div>
                        
                        
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