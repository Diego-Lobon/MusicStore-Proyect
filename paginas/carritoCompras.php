
<?php
    include_once '../includes/carrito.php';
    include_once '../includes/user.php';

    $carrito = new Carrito();
    $ip = new Ip();

    session_start();

    $ipUsuario = $_SESSION["usuario"];   
    $Usuario = $ip->datosUsuario($ipUsuario); 

    foreach($Usuario as $fila) {
        $tipoUsuario = $fila['tipo'];
        $nombre = $fila['nombre'];
        $ip = $fila['ip'];
    }
    

    $carritoProductos = $carrito -> listarCarritoProducto($ipUsuario);
    $subTotal = $carrito -> subTotal($ipUsuario);
    $total = $carrito -> subTotal($ipUsuario);

?>

<?php 

    include_once '../paginas/static/navegador.php' 
    
?>  

    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/carritoCompras.css">

    <div id="contenedorCarrito">
    <div class="container" >
        

            <?php foreach($subTotal as $fila) {
               
            ?>

            <div class="seccion">
                <h1>Tu carrito</h1>
                <div class="seccion_compra">
                    <div class="seccion_precio">
                        <span class="span1">SubTotal</span>  
                        <span class="span2">S/.<?php echo $fila['subTotal'] ?></span> 
                    </div>      
                    <a href="./pagoInformacion.php"><button>Revisa tu compra</button></a>
                </div>
            </div>

            <?php } ?>

            <?php foreach($carritoProductos as $fila) {
                
            ?>
            <form id="<?php echo $fila['idCarrito'] ?>" class="form_producto_carrito">
                <div class="carrito_productos">
                    <div class="carrito_productos_1">
                        <img src="../img/productos/<?php echo $fila['nombre']?>.png" alt="foto-producto">
                        <div class="carrito_productos_descripcion">
                            <h2>
                                <input type="hidden" value="<?php echo $fila['nombre'] ?>" name="nombreProducto">
                                <a href=""><?php echo $fila['nombre'] ?></a>
                            </h2>
                            <span class="carrito_productos_1_precio">Precio: </span>
                            <span class="carrito_productos_1_precioSoles">S/.<?php echo $fila['precio'] ?></span>
                        </div>
                    </div>
                    <div class="carrito_productos_2">
                        <div class="carrito_cantidad">
                            <span>Cantidad</span>
                            <select name="cantidadProducto" id="cantidadProducto" onChange="cambiarCantidad('<?php echo $fila['idCarrito'] ?>');">
                                <option value="<?php echo $fila['cantidadProducto'] ?>" selected disabled hidden><?php echo $fila['cantidadProducto'] ?></option>
                                <?php
                                    for ($i = 1; $i <= $fila['cantidad']; $i++) {
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" value="<?php echo $fila['idCarrito'] ?>" name="idCarrito">
                        <span class="carrito_productos_2_precio">S/.<?php echo $fila['total'] ?></span>
                        
                        <button onClick="eliminarProducto('<?php echo $fila['idCarrito'] ?>');" type="button">X</button>
                    </div>
                </div>
            </form>
            <?php } ?>

            <hr>

            <?php foreach($total as $fila) {
               
            ?>

            <div class="carrito_total_botones">
                <div class="carrito_total_botones_info">
                    <div class="carrito_precio_final">
                        <span class="subTotal">SubTotal</span>
                        <span class="envio">Envío e impuestos calculados</span>
                    </div>
                    <span class="precio">S/.<?php echo $fila['subTotal'] ?></span>
                </div>
                
                <div class="carrito_total_botones_compra">
                    
                    <a href="./pagoInformacion.php" class="boton_a"><button>Revisa tu compra</button></a>
                    <a href="/Proyecto Tienda de Musica/index.php">Seguir comprando</a>
                </div>
                
            </div>

            <?php } ?>

        
    </div>
    </div>
    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="main.js"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.1.min.js"
  integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
  crossorigin="anonymous"></script>
    <script src="../js/functions.js"></script>
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>

</body>
</html>