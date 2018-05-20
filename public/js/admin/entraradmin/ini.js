$(document).ready(function () {

    //disparadores
    $("#entrar").click(function () {
        let nick = $("#nick").val();
        let pass = $("#password").val();
        if (nick != "" && pass != "") {
            ajaxEntrar(nick, pass);
        } else{
            toast("Completa todos los campos del formulario");
        }
    });
});