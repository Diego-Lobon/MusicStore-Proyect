let nav = document.querySelector('#header_2');
document.querySelector('.boton').addEventListener('click',
function(){
    nav.classList.toggle('active');
});

document.querySelector('.boton_cerrar').addEventListener('click',
function(){
    nav.classList.toggle('active');
});

let buscador = document.querySelector('.header_buscar_responsive_des');
document.querySelector('.boton_activar_buscador').addEventListener('click',
function(){
    buscador.classList.toggle('active');
});

document.querySelector('.header_buscar_responsive_des_cerrar').addEventListener('click',
function(){
    buscador.classList.toggle('active');
});