<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/inicioSesion.css">
    <link rel="stylesheet" href="../icons.css">
    <title>Music Store</title>
</head>
<body>
    <div class="header">
        <div class="header_1">
            <div class="header_boton">
                <button class="boton" id="boton">
                    <div class="linea"></div>
                    <div class="linea"></div>
                    <div class="linea"></div>
                </button>
            </div>
            <div class="header_buscador_responsive">
                <button class="boton_activar_buscador">
                    <i class="gg-search"></i>
                </button>
            </div>
            <div class="header_logo">
                <a href="/Proyecto Tienda de Musica/index.php">
                    <img src="/PROYECTO TIENDA DE MUSICA/img/logo.png" alt="Logo-Music-Store">
                </a>
            </div>
            <div class="header_buscar_responsive_des">
                <form action="">
                    <input type="text" placeholder="¿Que estas buscando?">
                </form>    
                <button class="header_buscar_responsive_des_cerrar">Cancelar</button> 
            </div>
            <div class="header_buscar">
                <form action="/PROYECTO TIENDA DE MUSICA/paginas/resultadoBuscador.php" method="GET">
                    <input class="buscador_header_buscar" type="text" id="buscador" name="buscador">
                    <button class="button_header" id="button_header" type="submit">
                        <i class="gg-search"></i>
                    </button>
                </form>
                <!-- buscador -->
                <div class="resultados_buscador" id="resultados_buscador">
                    <ul class="resultados" id="resultados">
                        
                    </ul>
                </div>
               <!-- -->
            </div>
            <div class="header_carrito">
                <a href="/Proyecto Tienda de Musica/paginas/carritoCompras.php">
                    <img src="/PROYECTO TIENDA DE MUSICA/img/icons8-carrito-de-la-compra-cargado.gif" alt="Carrito-compras">
                </a>
            </div>
        </div>
        <div class="header_2" id="header_2">
            <div class="header_menu">
                <ul>
                    <li class="boton_cerrar">
                        <button class="boton_cerrar_menu">X</button>
                    </li>
                    <li>
                        <a href="../paginas/guitarrasBajos.php">
                            Guitarras y Bajos
                        </a>
                    </li>
                    <li>
                        <a href="../paginas/pianosTeclados.php">
                            Pianos y Teclados
                        </a>
                    </li>
                    <li>
                        <a href="../paginas/baterias.php">
                            Baterias
                        </a>
                    </li>
                    <li>
                        <a href="../paginas/percusion.php">
                            Percusión
                        </a>
                    </li>
                    <li>
                        <a href="../paginas/bandaOrquesta.php">
                            Banda & Orquesta
                        </a>
                    </li>
                    <li>
                        <a href="../paginas/audioProfesional.php">
                            Audio Profesional
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/iniciarSesion.php">
                            Iniciar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div> 
    </div>
    <div class="container">
        <h1>Iniciar Sesión</h1>
        <form action="/PROYECTO TIENDA DE MUSICA/index.php" method="POST" class="form_iniciarSesion">
            <input type="text" placeholder="Correo" name="correo">
            <input type="password" placeholder="Contraseña" name="contraseña">
            <div class="form_envia-Registra">
                <input type="submit" class="enviarDatos" value="Iniciar Sesión">
                <span>¿Nuevo cliente? <a href="./registrarse.php">Crear Cuenta</a></span>
                
            </div>
        </form>
    </div>

    <?php

        if(isset($errorLogin)){
            echo '<div class="contenedor_error"><p class="text_error">'.$errorLogin.'</p></div>';
        }

    ?>

    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="main.js"></script>
</body>
</html>