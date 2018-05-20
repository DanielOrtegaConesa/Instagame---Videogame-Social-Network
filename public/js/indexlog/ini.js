let inicio = 0;
let take = 5;
let cargando = false;

$(document).ready(function () {
    ajaxSolicitudes();
    ajaxAmistades();
    ajaxNovedades();

    $(window).scroll(function () {
        if (!cargando) {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 120) {
                ajaxNovedades();
            }
        }
    });
});