$(document).ready(function () {

    //disparadores
    $("#add").click(function () {
        let nombre = $("#nombre").val();
        if (nombre != "") {
            ajaxAdd(nombre);
        } else{
            toast("Completa todos los campos del formulario");
        }
    });
});