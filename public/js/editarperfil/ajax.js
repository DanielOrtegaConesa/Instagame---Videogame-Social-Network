function ajaxActualizar(desc,red, sm, st, sn, fm, ft, fn) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "https://danielortegaconesa.com/editarPerfil/actualizar",
            data: {
                descripcion:desc,
                red:red,
                sm: sm,
                st: st,
                sn: sn,
                fm: fm,
                ft: ft,
                fn: fn
            },

            success: function (datos) {
                callbackActualizar(datos);
            },

            error: function (e) {
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
                    console.log(e);
                    toast("Ha ocurrido un error inesperado");
                }

            }
        });
}