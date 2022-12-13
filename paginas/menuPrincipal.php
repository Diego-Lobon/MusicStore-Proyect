<?php include_once './paginas/static/navegador.php' ?>

    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/menuPrincipal.css">

    <div class="container">

        <div class="logo_home">
            <a href="/PROYECTO TIENDA DE MUSICA/paginas/carritoCompras.php">
                <img src="./img/Logo-home.png" alt="Logo-Home">
            </a>
        </div>
        
        
        <div class="text_promocion">
            <h2>EMPIEZAN NUESTRA REBAJAS DE BLACK & WHITE</h2>
            <h4>Envíos a todo el Perú</h4>
        </div>
        <div class="text_seccion">
            <h4>PRODUCTOS</h4>
        </div>
        <hr>
        <ul class="productos">
            
            <?php foreach($productos as $fila){
                   
            ?>

            

            
                <li class="productos_lista">
                    
                    <form class="producto" action="./paginas/verProducto.php" method="GET">

                        

                    
                        <input class="input_producto" name="producto" type="text" value="<?php echo $fila['nombre'] ?>">
                        <button href="./verProducto.php" class="producto_img">
                            <img src="./img/productos/<?php echo $fila['nombre'];?>.png" alt="Bateria">
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
    
  
    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="main.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="/PROYECTO TIENDA DE MUSICA/js/functions.js"></script>
    
    
    
</body>
</html>
