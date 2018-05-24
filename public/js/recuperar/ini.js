$(document).ready(function () {

    //disparadores
    $("#solicitar").click(function () {
        let email = $("#email").val();
        if (email != "") {
            ajaxRecuperar(email);
        } else{
            toast("Completa todos los campos del formulario");
        }
    });
});