function ajaxSolicitudes() {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/tojson/solicitudesUsuario",
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                callbackSolicitudes(data);
            }
        });
}

function ajaxAceptarSolicitud(nick) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/amistad/aceptar/"+nick,
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                ajaxSolicitudes();
                ajaxAmistades();
                inicio = 0;
                take = 5;
                ajaxNovedades();
                toast("Aceptado");
            }
        });
}

function ajaxRechazarSolicitud(nick) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/amistad/rechazar/"+nick,
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                ajaxSolicitudes();
                toast("Rechazado");
            }
        });
}

function ajaxAmistades() {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/tojson/amistadesUsuario",
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                callbackAmistades(data);
            }
        });
}

function ajaxNovedades() {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/tojson/novedadesUsuario/"+inicio+"/"+take,
            beforeSend: function () {
                cargando = true;
            },
            error: function (e) {
                console.log(e);
                toast("Ha ocurrido un error inesperado");
                cargando = false;
            },
            success: function (data) {
                callbackNovedades(data);
                inicio += Number(take);
                cargando = false;
            }
        }
    );
}