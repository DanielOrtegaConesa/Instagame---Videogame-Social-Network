$(document).ready(function () {
    autocompletar();
    $("#valor").change(function () {
        if($("#valor").val()!="") {
            location.href = "/admin/anuncios/filtrar/" + $("#campo").val() + "/" + $("#valor").val();
        }else{
            location.href = "/admin/navegacion/buscarAnuncio/";
        }
    });
    $("#campo").change(function () {
        if($("#valor").val()!=""){
            location.href="/admin/anuncios/filtrar/"+$("#campo").val()+"/"+$("#valor").val();
        }else{

        }
    });

});