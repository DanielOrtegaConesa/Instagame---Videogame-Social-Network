$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if($("#valor").val()!="") {
            location.href = "https://danielortegaconesa.com/juego/filtrarUsu/" + $("#campo").val() + "/" + $("#valor").val();
        }else{
            location.href = "https://danielortegaconesa.com/navegacion/buscarJuego/";
        }
    });
    $("#campo").change(function () {
        if($("#valor").val()!=""){
            location.href="https://danielortegaconesa.com/juego/filtrarUsu/"+$("#campo").val()+"/"+$("#valor").val();
        }else{
            autocompletar();
        }
    });

});