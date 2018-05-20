$(document).ready(function () {
    $("#valor").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/reportesComentarios/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        } else {
            location.href = "https://danielortegaconesa.com/admin/navegacion/reportesComentarios/";
        }
    });
    $("#campo").change(function () {
        if ($("#valor").val() != "") {
            location.href = "https://danielortegaconesa.com/admin/reportesComentarios/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        }
    });

});
