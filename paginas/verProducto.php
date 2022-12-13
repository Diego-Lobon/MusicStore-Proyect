

<?php

    include_once '../includes/user.php';
    include_once '../includes/productos.php';
    include_once '../includes/carrito.php';

    $carrito = new Carrito();
    $producto = new Producto();
    $ip = new Ip();

    session_start();

    $ipUsuario = $_SESSION["usuario"];   
    $Usuario = $ip->datosUsuario($ipUsuario);
    
    foreach($Usuario as $fila) {
        $tipoUsuario = $fila['tipo'];
        $nombre = $fila['nombre'];
        $ip = $fila['ip'];
    }

    $nombreProducto = $_GET['producto'];

    $productos = $producto -> obtenerDatosProducto($nombreProducto);
    
?>

<?php 

    include_once '../paginas/static/navegador.php' 
    
?>  
    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/verProducto.css">

    <div class="container">

        <?php foreach($productos as $fila) {
               
        ?>

        <div class="producto_info">
            <div class="img_producto">
                <img src="../img/productos/<?php echo $fila['nombre'] ?>.png" alt="">
            </div>
            <div class="info_producto">
                <div class="info_producto_1">
                    <div class="nombre_producto">
                        <h1><?php echo $fila['nombre'] ?></h1>
                        <span class="por">por</span>
                        <span class="marca"><?php echo $fila['marca'] ?></span>
                    </div>
                    
                    <span class="info_producto_1_precio">S/.<?php echo $fila['precio'] ?></span>
                </div>
                <div class="info_producto_2">
                    <h5>Descripción</h5>
                    <p>
                        <?php echo $fila['descripcion'] ?>
                    </p>
                </div>
                
                
            </div>
            <div class="botones_producto">
                <form id="enviarProducto">
                    <input type="hidden" name="nombreProducto" value="<?php echo $fila['nombre'] ?>">
                    <div class="cantidad">
                        <span>Cantidad</span>
                        <select name="cantidadProducto" id="">
                            
                            <?php
                                for ($i = 1; $i <= $fila['cantidad']; $i++) {
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>

                        </select>
                    </div>
                    <button id="enviarProduct" type="button" class="boton_añadir">Añadir al carrito</button>
                    <a href="./pagoInformacion.php"><button id="comprarAhora" type="button" class="boton_comprar">Comprar Ahora</button></a>
                </form>
                
                
            </div>
        </div>

        <?php } ?>

    </div>

    

    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <!-- <script src="main.js"></script> -->
    <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>   
  <script src="/PROYECTO TIENDA DE MUSICA/js/functions.js"></script>

    

</body>
</html>