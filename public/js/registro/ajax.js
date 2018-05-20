function ajaxRegistrar(nick, pass, email) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/registro/registrar",
            data: {
                nick: nick,
                password: pass,
                email: email,
                'response': grecaptcha.getResponse()
            },

            success: function (datos) {
                callbackRegistrar(datos);
            },

            error: function (e) {

                grecaptcha.reset();
                if (e.status == 422) {
                    let errores = e.responseText;
                    errores = JSON.parse(errores);
                    errores = errores.errors;
                    let c = 0;
                    for (let i in errores) {
                        if (c != 0) break;
                        toast(errores[i]);
                        c++;
                    }
                } else {
                    toast("Ha ocurrido un error inesperado");
                }
            }
        });
}