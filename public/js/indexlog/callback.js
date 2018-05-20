function callbackSolicitudes(data) {
    data = JSON.parse(data);
    $("#coleccionsolicitudes").remove();
    if(data[0] != null) {
        $("#solicitudes").append(
            "<div class='collection' id='coleccionsolicitudes'>" +
            "</div>"
        );
    }
    for (let c in data) {
        $("#coleccionsolicitudes").append("" +
            "<a id='elemento" + data[c]['nick1'] + "' class='collection-item light-blue-text text-darken-4 '>" +
            "<span id='enlace" + data[c]['nick1'] + "' class='waves-effect'>" +
            "   <span>" + data[c]['nick1'] + "</span>" +
            "</span>" +

            "<span class='secondary-content '>" +
            "<i id='aceptar" + data[c]['nick1'] + "' class='material-icons waves-effect'>done</i>" +
            "<i id='rechazar" + data[c]['nick1'] + "' class='material-icons waves-effect red-text'>close</i>" +
            "</span>" +

            "</a>" +
            "");

        $("#enlace" + data[c]['nick1']).click(function () {
            location.href = "/navegacion/verPerfilAjeno/" + data[c]['nick1'];
        });

        $("#aceptar" + data[c]['nick1']).click(function () {
            ajaxAceptarSolicitud(data[c]['nick1']);
        });

        $("#rechazar" + data[c]['nick1']).click(function () {
            ajaxRechazarSolicitud(data[c]['nick1']);
        });


    }
}

function callbackAmistades(data) {
    data = JSON.parse(data);
    console.log(data);
    for (let c in data) {
        $("#amigos").append(
            "<div class='col s2 tooltipped waves-effect' data-tooltip='"+data[c].amigo+"'  id='"+data[c].amigo+"' data-position='bottom'>" +
            "<div class='card-image'>" +
             "<img src='/storage/app/perfiles/" + data[c].img + "' class='indexavatar'>" +
            "</div>" +

            "</div>"
        );

        $("#" + data[c].amigo).click(function () {
            location.href = "/navegacion/verPerfilAjeno/" + data[c].amigo;
        });
    }
    $(document).ready(function(){
        $('.tooltipped').tooltip();
    });
}

function callbackNovedades(data) {
    data = JSON.parse(data);
    moment.locale('es');

    for(let c in data["novedades"]){
        let novedad = data["novedades"][c];
        $("#novedades").append(

            "<div id='"+novedad.cod+"' class='card white novedad animated fadeIn'>"+
            "                    <div class='section'>" +
            "                        <div class='card-profile-title'>" +
            "                            <div class='row'>" +
            "                                <div class='col s1'>" +
            "                                    <img src='/storage/app/perfiles/" + data['usuarios'][novedad.nick] + "' alt=''" +
            "                                         class='circle responsive-img valign profile-post-uer-image'>" +
            "                                </div>" +
            "                                <div class='col s11'>" +
            "                                   <div class='col s9'>" +
            "                                        <div><a href='/navegacion/verPerfilAjeno/" + novedad.nick + "'><p class='black-text text-darken-4 margin  light-blue-text  text-darken-4'>" + novedad.nick + "</p></a></div>" +
            "                                        <div class='blue-grey-text text-darken-4'>"+moment(novedad.fecha).fromNow()+"</div>" +
            "                                   </div>" +
            "                                </div>" +
            "                            </div>" +
            "                            <div class='row'>" +
            "                                <div class='col s12'>" +
            "                                    <p class='black-text'>" + novedad.texto + "</p>" +
            "                                </div>" +
            "                            </div>" +
            "                        </div>" +
            "                    </div>" +

            "</div>"
        );
    }


}