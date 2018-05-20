$("#add").click(function () {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/amistad/peticion/" + nick,
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function () {
                toast("Peticion enviada");
                $("#add").html("timer");
                $("#add").off();
                $("#add").click(function () {
                    toast("Espera a su respuesta :)");
                });
            }
        });
});

$("#reportuser").click(function () {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/reportesUsuarios/reportar/" + nick,
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function (data) {
                if (data == "existe"){
                    toast("Ya habias reportado a este usuario")
                }else{
                    toast("Gracias, le echaremos un vistazo")
                }
            }
        });
});

$("#reloj").click(function () {
    toast("Espera a su respuesta :)");
});

$("#remove").click(function () {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/amistad/eliminar/" + nick,
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            },
            success: function () {
                toast("Eliminado");
                $("#remove").html("person_add");
                $("#remove").off();
                $("#remove").click(function () {
                    toast("No puedes volver a enviar una peticion tan rapidamente");
                });
            }
        });
});