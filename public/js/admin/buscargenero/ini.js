$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/genero/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        } else {
            location.href = "https://danielortegaconesa.com/admin/navegacion/buscarGenero/";
        }
    });
    $("#campo").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/genero/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        } else {
            autocompletar();
        }
    });

});