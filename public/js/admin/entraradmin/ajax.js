function ajaxEntrar(nick, pass) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/index/entrarAdmin",
            data: {
                nick: nick,
                password: pass,
                'response': grecaptcha.getResponse()
            },

            success: function (datos) {
                callbackEntrar(datos);
                $("#loader").css("display", "none");
            },

            error: function (e) {
                grecaptcha.reset();
                if (e.status == 422) {
                    let errores = e.responseText;
                    errores = JSON.parse(errores);
                    errores = errores.errors;
                    let c=0;
                    for (let i in errores) {
                        if(c!=0) break;
                        toast(errores[i]);
                        c++;
                    }
                } else {
                    console.log(e);
                    toast("Ha ocurrido un error inesperado");
                }
                $("#loader").css("display", "none");
            },

            beforeSend: function () {
                $("#loader").css("display", "block");
            }
        });
}