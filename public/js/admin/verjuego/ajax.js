function ajaxComentarios(codJuego) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/tojson/comentariosAdmin",
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
            url: "/admin/juego/eliminarComentario/" + codcomentario,
            error: function (e) {
                console.log(e);
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                if (data == "ok") {
                    toast("Eliminado, actualiza para  ver los cambios");
                } else {
                    toast("No hemos podido eliminar el comentario");
                }
            }
        });

}