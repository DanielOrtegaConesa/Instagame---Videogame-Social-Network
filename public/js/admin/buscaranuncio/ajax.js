function ajaxEliminarAnuncio(cod) {
    $.ajax(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: "POST",
            url: "/admin/anuncios/eliminar/"+cod,
            success : function(e){
                toast("Eliminado");
                $("#"+cod).remove();
            },
            error: function (e) {
                console.log(e)
                toast("Ha ocurrido un error inesperado");
            }
        });
}