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
    
    $producto = new Producto();
    $productos = $producto -> listarPorCategoria('Pianos y Teclados', 'categoria', 'noTipo', 'noMarca', 'Mas vendidos');
    $marca = $producto -> listarMarcas('Pianos y Teclados');
    $tipo = $producto -> listarTipos('Pianos y Teclados');

?>

<?php 

    include_once '../paginas/static/navegador.php' 
    
?>  

    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/paginasMenu.css">
 
    <div class="container">
        <div class="container_filtros">
            <h2>Filtros</h2>
            <h3>Categoria</h3>
            <ul id="listaCheckBox">

                <?php 
                    foreach($tipo as $fila){
                ?>

                <li>
                    
                    <input value="<?php echo $fila['tipo'] ?>" class="tipos" type="checkbox" name="tipo" id="<?php echo $fila['tipo']?>" onClick="marcarCheckBoxTipos('<?php echo $fila['tipo']?>', 'Pianos y Teclados')"><span> <?php echo $fila['tipo'] ?> </span>
                    
                </li>
                
                <?php } ?>

            </ul>
            <h3>Marca</h3>
            <ul>
                
                <?php 
                    foreach($marca as $fila){
                ?>

                <li>
                    
                    <input value="<?php echo $fila['marca'] ?>" class="marcas" type="checkbox" name="marca" id="<?php echo $fila['marca']?>" onClick="marcarCheckBoxMarcas('<?php echo $fila['marca']?>', 'Pianos y Teclados')"><span> <?php echo $fila['marca'] ?> </span>
                    
                </li>
                
                <?php } ?>

            </ul>
            
        </div>
        <div class="container_productos">
            <div class="text_seccion">
                <h4>Pianos y Teclados Menú</h4>
            </div>
            <div class="container_ordenar">
                <span>Ordenar por</span>
                <select name="" id="opcionOrden" onChange="selectFiltro('Pianos y Teclados')">
                    <option value="Mas vendidos">Mas vendidos</option>
                    <option value="Precio, menor a mayor">Precio, menor a mayor</option>
                    <option value="Precio, mayor a menor">Precio, mayor a menor</option>
                </select>
            </div>

            <div id="prueba"></div>

            <ul class="productos" id="productos">
                <?php 

                 foreach($productos as $fila){
                   
                ?> 
                       <li class="productos_lista">
                           
                           <form class="producto" action="../paginas/verProducto.php" method="GET">
       
                               
       
                           
                               <input class="input_producto" name="producto" type="text" value="<?php echo $fila['nombre'] ?>">
                               <button href="./verProducto.php" class="producto_img">
                                   <img src="../img/productos/<?php echo $fila['nombre'];?>.png" alt="Bateria">
                               </button>
                               <div class="producto_info">
                                   <div class="producto_precio">
                                       <span>S/.<?php echo $fila['precio'] ?> </span>
                                   </div>
                                   <p class="producto_titulo">
                                       <a href="#"> <?php echo $fila['nombre'] ?> </a>
                                   </p>
                                   <span class="producto_marca"><?php echo $fila['marca'] ?></span>
                               </div>
                                   
                           
       
                           </form>  
       
                       </li>
                   
                <?php } ?>
            </ul>
        </div>
        
  
      
    </div>
    
    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="../main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/PROYECTO TIENDA DE MUSICA/js/functions.js"></script>
    
</body>
</html>