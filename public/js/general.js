let recargar = true;

setTimeout(function () {
    if (recargar) {
        window.stop();
        location.reload(true);
    }
}, 8000);

$(document).ready(function () {
    recargar = false;
    M.AutoInit();

    //bloqueador de publi casero
    if (typeof(adblockActivado) == "undefined" || adblockActivado == true) {
        $("body").append(
            " <div id='msj' class='modal'>" +
            "<div class='modal-content'>" +
            "      <h4>Desactiva tu bloqueador de anuncios en esta pagina</h4>" +
            "       <h6>Esta pagina no utiliza ningun tipo de publicidad molesta ni excesiva.</h6><h6>Al utilizar un Bloqueador de anuncios nos quitas nuestro unico medio de ganar dinero (y esta pagina no se mantiene sola <i class=\"em em-money_with_wings\"></i> )</h6>" +
            "       <h6>¡Nosotros tambien queremos poder tomarnos una cervecilla con los colegas! <i class='em em-beers'></i></h6>" +
            "</div>" +
            "</div>"
        );


        var elem = document.querySelector('#msj');
        var options = {dismissible: false}
        var instance = M.Modal.init(elem, options);
        instance.open();
    }
    var elem = document.querySelector('.fixed-action-btn');
    var instance = M.FloatingActionButton.init(elem, {
        direction: 'left'
    });

});



function toast(texto) {
    M.toast({html: texto})
}

function modalerrores(errores) {
    errores = errores.errors;
    console.log(errores);

    let mensajes = "";
    for (let i in errores) {
        mensajes += "<p>";
        mensajes += String(errores[i]);
        mensajes += "</p>";
    }

    toast()


    $('#msjerror').modal();
    $('#msjerror').modal('open');
}

function autocompletar() {
    $('#valor').autocomplete({
        data: ""
    });

    switch ($("#campo").val()) {
        case "nombreJuego":
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "https://danielortegaconesa.com/tojson/juegos",
                    success: function (datos) {
                        console.log(datos);
                        datos = JSON.parse(datos);
                        $('#valor').autocomplete({
                            data: datos
                        });
                    }
                });
            break;
        case "nombreGenero":
            $.ajax(
                {
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    url: "https://danielortegaconesa.com/tojson/generos",
                    success: function (datos) {
                        datos = JSON.parse(datos);
                        $('#valor').autocomplete({
                            data: datos
                        });
                    }
                });
            break;
    }
}
