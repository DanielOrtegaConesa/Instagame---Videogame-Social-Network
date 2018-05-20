function callbackEntrar(datos) {
    grecaptcha.reset();
    datos = JSON.parse(datos);
    switch (datos.estado) {
        case "bien":
            location.reload(true);
            break;
        case "mal":
            toast("Datos Incorrectos");
            break;
        case "novalidado":
            toast("Verifica primero tus datos con el email que te hemos enviado");
            break;
        case "robot":
            toast("Te hemos detectado como un robot")
            break;
        case "baneado":
            toast("Has sido baneado");
            break;
    }

}