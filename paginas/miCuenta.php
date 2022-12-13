<?php

    include_once '../includes/user.php';

    $ip = new Ip();

    session_start();

    $ipUsuario = $_SESSION["usuario"];
    $Usuario = $ip->datosUsuario($ipUsuario);

    foreach($Usuario as $fila) {
        $tipoUsuario = $fila['tipo'];
        $nombre = $fila['nombre'];

    }

    $historial = $ip -> historialPedidosUsuario($ipUsuario);
    $datos = $ip -> datosUsuario($ipUsuario);
    $usuario = $ip -> datosUsuario($ipUsuario);
    foreach($usuario as $fila) {
        $nombre = $fila['nombre'];
    }

?>

<?php include_once '../paginas/static/navegador.php' ?>

    <link rel="stylesheet" href="/PROYECTO TIENDA DE MUSICA/estilos/miCuenta.css">

    <div class="container">
        <h1>Mi Cuenta</h1>
        <div class="informacion_cuenta">
            <div class="historial_pedidos">
                <h3>Historial de Pedidos</h3>
                <table>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                    </tr>
                    <?php foreach($historial as $fila){  ?>
                    <tr>
                        <td><?php echo $fila['nombre']; ?></td>
                        <td><?php echo $fila['CantidadProducto']; ?></td>
                        <td><?php echo $fila['total']; ?></td>
                        <td><?php echo $fila['estadoEntrega']; ?></td>
                        <td><?php echo $fila['fecha']; ?></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
            <div class="informacion_datos">
                <h3>Informacion de la Cuenta</h3>
                <?php foreach($datos as $fila){  ?>
                <span class="nombre dato"><span class="subtitulo">Nombre: </span><?php echo $fila['nombre']; ?></span>
                <span class="apellido dato"><span class="subtitulo">Apellido: </span><?php echo $fila['apellido']; ?></span>
                <span class="correo dato"><span class="subtitulo">Correo: </span><?php echo $fila['correo']; ?></span>
                <?php } ?>
            </div>

        </div>
        
    </div>


    <footer>
            @Music Store. Todos los derechos reservados 2022
    </footer>
    <script src="main.js"></script>
</body>
</html>