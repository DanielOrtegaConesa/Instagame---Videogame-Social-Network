function ajaxEstado(estado, codjuego) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/juego/cambiarEstadoUsuario",
            data: {
                estado: estado,
                codJuego: codjuego
            },

            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            }
        });
}

function ajaxEnviarComentario(comentario, codjuego) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/juego/nuevoComentario",
            data: {
                comentario: comentario,
                codJuego: codjuego
            },
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (e) {
                $("#comentario").val("");
                $("#comentarios").empty();
                inicio = 0;
                ajaxComentarios(codjuego);
               // location.reload(true);
            }
        });
}

function ajaxComentarios(codJuego) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/tojson/comentarios",
            data: {
                codJuego: codJuego,
                desde: inicio,
                take: take
            },
            beforeSend: function () {
                cargando = true;
            },
            error: function (e) {
                console.log(e);
                toast("Ha ocurrido un error inesperado");
                cargando = false;
            },
            success: function (data) {
                callbackComentarios(data);
                inicio += Number(take);
                cargando = false;
            }
        }
    );
}

function ajaxEliminarComentario(codcomentario) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/juego/eliminarComentario/" + codcomentario,
            error: function (e) {
                console.log(e);
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                if (data == "ok") {
                    toast("eliminado");
                } else {
                    toast("No hemos podido eliminar el comentario");
                }
            }
        });
}

function ajaxReportarComentario(codcomentario) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/juego/reportarComentario/" + codcomentario,
            error: function (e) {
                console.log(e);
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                if (data == "ok") {
                    toast("Reportado, le echaremos un vistazo :)");
                } else if (data == "anteriormente") {
                    toast("Ya habias reportado este comentario");
                } else {
                    toast("No hemos podido reportar el comentario");
                }
            }
        });
}

function ajaxCambiarPuntuacion(puntuacion) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/juego/cambiarPuntuacion",
            data: {
                puntuacion: puntuacion,
                codJuego: $("#codjuego").val()
            },
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },

            success: function (e) {
                $("#puntuacion").html(puntuacion);
            }
        });
}