$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if($("#valor").val()!="") {
            location.href = "/anuncios/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        }else{
            location.href = "/navegacion/buscarAnuncio/";
        }
    });
    $("#campo").change(function () {
        if($("#valor").val()!=""){
            location.href="/anuncios/filtrar/"+$("#campo").val()+"/"+$("#valor").val();
        }else{

        }
    });

});