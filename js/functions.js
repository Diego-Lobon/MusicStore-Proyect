document.addEventListener('keyup', e=>{

    if (e.target.matches('#buscador')){
        e.target.matches('#buscador')
        
        var input = document.getElementById('buscador')
        var button = document.getElementById('button_header')
        var productoBuscar = document.getElementById('buscador').value

        if (document.querySelector("#buscador.buscador_header_buscar_activate")) {
            console.log("Esto solo se ejecuta si el elemento con id 'nombre' tiene la clase 'clase2'")
            
        } else {
            console.log("Se ejecuta si no la tiene")
            input.className += " buscador_header_buscar_activate";
            button.className += " button_header_activate";
            input.classList.remove("buscador_header_buscar");
            button.classList.remove("button_header");
        }

        console.log(productoBuscar)

        if (productoBuscar != '') {
            console.log("hay")
            

            $.ajax({
                url: '/PROYECTO TIENDA DE MUSICA/includes/buscador.php',
                type: 'POST',
                data: {
                    producto : productoBuscar,
                },
        
                success:function(vs) {
                    
                    if (vs != ''){

                        var js = JSON.parse(vs);
        
                        let ul = "";
        
                        console.log(js)
                                    
                        for(var i=0; i < js.length; i++){
                                        
                                    
                            ul+='<li> <form method="GET" action="/PROYECTO TIENDA DE MUSICA/paginas/verProducto.php"> <input name="producto" type="hidden" value="'+js[i].nombre+'"> <button class="informacion_buscador"> <div class="resultado_1"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="producto"> </div> <div class="resultado_2"> <span class="titulo_buscador">'+js[i].nombre+'</span>  <span class="precio_buscador">S/.'+js[i].precio+'</span> </div> </button> </form> </li>';
                                    
                        }
        
                        $('#resultados').html(ul);
                        
                    }
                    else {

                        let ul = "";
           
                        ul+='<li> <div class="resultado_nohay"><span class="error_1">No hay productos para "'+productoBuscar+'".</span> <span class="error_2">Disculpa, no encontramos coincidencias.</span></div>   </li>';
                                    
                        $('#resultados').html(ul);

                    }
                    
                    
                }
        
            })

        }
        else {

            console.log("no hay")
            input.classList.remove("buscador_header_buscar_activate");
            button.classList.remove("button_header_activate");
            input.className += " buscador_header_buscar";
            button.className += " button_header";
            let ul = "";
            ul+='';
            $('#resultados').html(ul);


        }

        

    }
    
})


function eliminarProducto(idForm){
    var recolec = $('#'+idForm).serialize();
    console.log(recolec);

    $.ajax({
        url: '../includes/eliminarDatosCarrito.php',
        type: 'POST',
        data: recolec,

        success:function(vs) {
            alert(vs);
            $('#contenedorCarrito').load('../paginas/carritoCompras.php #contenedorCarrito')
        }

    })

}

function crearRegistroUsuario(idForm){
    
    var recolec = $('#'+idForm).serialize();
    console.log(recolec);

    $.ajax({
        url: '/PROYECTO TIENDA DE MUSICA/includes/crearRegistros.php',
        type: 'POST',
        data: recolec,

        success:function(vs) {
            alert(vs);
            $('#contenedorRegistro').load('../paginas/registrarse.php #contenedorRegistro')
        }

    })

}



$('#enviarProduct').click(function() {
    
    var recolec = $('#enviarProducto').serialize();
    
    $.ajax({
        url: '../includes/datosCarritoProducto.php',
        type: 'POST',
        data: recolec,

        success:function(vs) {
            alert(vs);
        }

    })
});

$('#comprarAhora').click(function() {
    
    var recolec = $('#enviarProducto').serialize();
    
    $.ajax({
        url: '../includes/datosCarritoProducto.php',
        type: 'POST',
        data: recolec,

        success:function(vs) {
            
        }

    })

});



function cambiarCantidad(idForm) {

    var recolec = $('#'+idForm).serialize();
    console.log(recolec)

    $.ajax({
        url: '../includes/cambiarDatosCarrito.php',
        type: 'POST',
        data: recolec,

        success:function(vs) {
            alert(vs);
            $('#contenedorCarrito').load('../paginas/carritoCompras.php #contenedorCarrito')
        }

    })

}

function marcarCheckBoxTipos(idCheckBox, categoriaN) {
    
    

    var checkSelect = document.getElementById(idCheckBox);
    var checksTipo = document.querySelectorAll(".tipos");
    var checksMarca = document.querySelectorAll(".marcas");
    var select = document.getElementById("opcionOrden");
    var marcaN = "noMarca";

    checksMarca.forEach((e)=>{
        if(e.checked == true){
            marcaN =  e.value;
        }
    })

    
    
    checksTipo.forEach((e)=>{
        if (e.value == checkSelect.value) {

            if(e.checked){

                $.ajax({
                    url: '../includes/listarPorFiltroProductos.php',
                    type: 'POST',
                    data: {
                        tipo : checkSelect.value,
                        categoria : categoriaN,
                        marca : marcaN,
                        opcion : 'tipo',
                        orden : select.value,
                    },
    
                    success:function(vs) {

                        if (vs == "No hay Registros" ) {
                            
                            let ul = "<h2>No hay productos que concuerden con tu búsqueda</h2>";
                            $('#productos').html(ul);

                        } else {

                            var js = JSON.parse(vs);
    
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);

                        }
                        
                        
                        
                    }
    
                })

            }
            else {          
                
                
                
                if(marcaN != 'noMarca'){

                    var checkSelectMarca = document.getElementById(marcaN);
                    
                    $.ajax({
                        url: '../includes/listarPorFiltroProductos.php',
                        type: 'POST',
                        data: {
                            tipo : 'noTipo',
                            categoria : categoriaN,
                            marca : checkSelectMarca.value,
                            opcion : 'marca',
                            orden : select.value,
                        },
        
                        success:function(vs) {
                            
                            var js = JSON.parse(vs);
        
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);
                                                 
                        }
        
                    })

                }
                else {
                    $.ajax({
                        url: '../includes/listarPorFiltroProductos.php',
                        type: 'POST',
                        data: {
                            tipo : 'noTipo',
                            categoria : categoriaN,
                            marca : 'noMarca',
                            opcion : 'categoria',
                            orden : select.value,
                        },
        
                        success:function(vs) {
                            
                            var js = JSON.parse(vs);
        
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);
                                                 
                        }
        
                    })
                }

                

            }            

        } else {

            e.checked = false

        }
    })
    
}

function marcarCheckBoxMarcas(idCheckBox, categoriaN) {
    
    var checkSelect = document.getElementById(idCheckBox);
    var checksMarca = document.querySelectorAll(".marcas");
    var checksTipo = document.querySelectorAll(".tipos");
    var select = document.getElementById("opcionOrden");
    var tipoN = "noTipo";

    checksTipo.forEach((e)=>{
        if(e.checked == true){
            tipoN =  e.value;
        }
    })
    
    checksMarca.forEach((e)=>{
        if (e.value == checkSelect.value) {

            if(e.checked){

                $.ajax({
                    url: '../includes/listarPorFiltroProductos.php',
                    type: 'POST',
                    data: {
                        tipo : tipoN,
                        categoria : categoriaN,
                        marca : checkSelect.value,
                        opcion : 'marca',
                        orden : select.value,
                    },
    
                    success:function(vs) {
                        
                        if (vs == "No hay Registros" ) {
                            
                            let ul = "<h2>No hay productos que concuerden con tu búsqueda</h2>";
                            $('#productos').html(ul);

                        } else {

                            var js = JSON.parse(vs);
                        
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);
                            
                        }

                        
                        
                    }
    
                })

            }
            else{
                
                
                
                if(tipoN != 'noTipo'){

                    var checkSelectTipo = document.getElementById(tipoN);
                    $.ajax({
                        url: '../includes/listarPorFiltroProductos.php',
                        type: 'POST',
                        data: {
                            tipo : checkSelectTipo.value,
                            categoria : categoriaN,
                            marca : 'noMarca',
                            opcion : 'tipo',
                            orden : select.value,
                        },
        
                        success:function(vs) {
                            
                            var js = JSON.parse(vs);
        
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);
                                                 
                        }
        
                    })

                }
                else{

                    $.ajax({
                        url: '../includes/listarPorFiltroProductos.php',
                        type: 'POST',
                        data: {
                            tipo : 'noTipo',
                            categoria : categoriaN,
                            marca : 'noMarca',
                            opcion : 'categoria',
                            orden : select.value,
                        },
        
                        success:function(vs) {
                            
                            var js = JSON.parse(vs);
        
                            let ul = "";
                            
                            for(var i=0; i < js.length; i++){
                                
                                
                                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                                
                            }
                            $('#productos').html(ul);
                                                 
                        }
        
                    })

                }

            }  
            
        } else {
            e.checked = false
        }
    })
    
}

function selectFiltro(categoriaN){

    var select = document.getElementById("opcionOrden");
    var checksMarca = document.querySelectorAll(".marcas");
    var checksTipo = document.querySelectorAll(".tipos");

    var tipoN = "noTipo";
    var marcaN = "noMarca";

    checksTipo.forEach((e)=>{
        if(e.checked == true){
            tipoN =  e.value;
        }
    })

    checksMarca.forEach((e)=>{
        if(e.checked == true){
            marcaN =  e.value;
        }
    })

    

    $.ajax({
        url: '../includes/listarFiltroSelectProductos.php',
        type: 'POST',
        data: {
            categoria : categoriaN,
            orden : select.value,
            tipo : tipoN,
            marca : marcaN,
        },

        success:function(vs) {
            
            var js = JSON.parse(vs);

            let ul = "";
            
            for(var i=0; i < js.length; i++){
                
                
                ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                
            }
            $('#productos').html(ul);
                                 
        }

    })

/*
    if(tipoN != "noTipo" && marcaN != "noMarca"){

    }
    else if(tipoN != "noTipo"){
        
    }
    else if(marcaN != "noMarca"){
        
    }
    else {

        $.ajax({
            url: '../includes/listarFiltroSelectProductos.php',
            type: 'POST',
            data: {
                categoria : categoriaN,
                orden : select.value,
                tipo : tipoN,
                marca : marcaN,
            },

            success:function(vs) {
                
                var js = JSON.parse(vs);

                let ul = "";
                
                for(var i=0; i < js.length; i++){
                    
                    
                    ul+='<li class="productos_lista"> <form class="producto" action="../paginas/verProducto.php" method="GET"> <input class="input_producto" name="producto" type="text" value="'+js[i].nombre+'"> <button href="./verProducto.php" class="producto_img"> <img src="/PROYECTO TIENDA DE MUSICA/img/productos/'+js[i].nombre+'.png" alt="Bateria"></button> <div class="producto_info"> <div class="producto_precio"> <span>S/.'+js[i].precio+'</span></div> <p class="producto_titulo"><a href="#">'+js[i].nombre+'</a></p> <span class="producto_marca">'+js[i].marca+'</span></div></form></li>';
                    
                }
                $('#productos').html(ul);
                                     
            }

        })
        
    }

*/


}