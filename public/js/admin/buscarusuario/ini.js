$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/usuario/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        } else {
            location.href = "https://danielortegaconesa.com/admin/navegacion/buscarUsuario/";
        }
    });
    $("#campo").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/usuario/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        } else {
            autocompletar();
        }
    });

});