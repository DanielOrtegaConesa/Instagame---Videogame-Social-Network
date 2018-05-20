let inicio = 0;
let take = 5;
let cargando = false;

$(document).ready(function () {
    //disparadores
    $("#estado").change(function () {
        ajaxEstado($("#estado").val(), $("#codjuego").val());
    });
    $("#enviarComentario").click(function () {
        if ($("#comentario").val() != "") {
            ajaxEnviarComentario($("#comentario").val(), $("#codjuego").val());
        }
    });

    $(window).scroll(function () {
        if (!cargando) {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 120) {
                ajaxComentarios($("#codjuego").val());
            }
        }
    });


    ajaxComentarios($("#codjuego").val());
});