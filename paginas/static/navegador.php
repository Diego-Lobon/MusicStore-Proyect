

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/navegador.css">
    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/icons.css">
    <title>Music Store</title>
    <script src="https://kit.fontawesome.com/e450d1c081.js" crossorigin="anonymous"></script>
    
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
                <a href="/PROYECTO TIENDA DE MUSICA/paginas/carritoCompras.php">
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
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/guitarrasBajos.php">
                            Guitarras y Bajos
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/pianosTeclados.php">
                            Pianos y Teclados
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/baterias.php">
                            Baterias
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/percusion.php">
                            Percusión
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/bandaOrquesta.php">
                            Banda & Orquesta
                        </a>
                    </li>
                    <li>
                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/audioProfesional.php">
                            Audio Profesional
                        </a>
                    </li>
                    <li>

                        <?php if ($tipoUsuario == 'No Registrado') { ?>

                        <a href="/PROYECTO TIENDA DE MUSICA/paginas/iniciarSesion.php">
                            Iniciar Sesión
                        </a>

                        <?php 

                        }
                        else { 
                            
                        ?>

                        <span class="nombre_header">
                            <a href="/PROYECTO TIENDA DE MUSICA/paginas/miCuenta.php"><?php echo $nombre; ?></a>
                        </span>
                        <span class="separador_header"> | </span>
                        <a href="/PROYECTO TIENDA DE MUSICA/includes/logout.php">
                            CerrarSesion
                        </a>

                        <?php 
                        
                        } 
                        
                        ?>
                        
                    </li>
                </ul>
            </div>
        </div> 
    </div>