let inicio = 0;
let take = 5;
let cargando = false;

$(document).ready(function () {
    //disparadores

    $(window).scroll(function () {
        if (!cargando) {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 120) {
                ajaxComentarios($("#codjuego").val());
            }
        }
    });


    ajaxComentarios($("#codjuego").val());
});