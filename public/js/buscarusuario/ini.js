$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if($("#valor").val()!="") {
            location.href = "https://danielortegaconesa.com/usuario/filtrarUsu/" + $("#campo").val() + "/" + $("#valor").val();
        }else{
            location.href = "https://danielortegaconesa.com/navegacion/buscarUsuario/";
        }
    });
    $("#campo").change(function () {
        if($("#valor").val()!=""){
            location.href="https://danielortegaconesa.com/usuario/filtrarUsu/"+$("#campo").val()+"/"+$("#valor").val();
        }else{
            autocompletar();
        }
    });

});