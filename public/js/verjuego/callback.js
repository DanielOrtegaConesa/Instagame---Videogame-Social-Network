function callbackComentarios(data) {
    data = JSON.parse(data);
    moment.locale("es");
    console.log(data);

    for (let c in data["comentarios"]) {
        let cerrar =
            "  <div class='right-align col s3 tooltipped'  data-tooltip='Reportar' data-position='bottom' >" +
            "     <i id='reportar" + data['comentarios'][c].cod + "'class='waves-effect material-icons red-text'>report_problem</i> " +
            "   </div>";

        if (data["sesion"] == data["comentarios"][c].nick) {
            cerrar =
                "  <div class='right-align col s3'>" +
                "     <i id='eliminar" + data['comentarios'][c].cod + "' class='waves-effect material-icons red-text'>close</i> " +
                "   </div>";
        }


        $("#comentarios").append("" +
            " <div class='card white comentario animated fadeIn'>" +
            "                    <div class='section'>" +
            "                        <div class='card-profile-title'>" +
            "                            <div class='row'>" +
            "                                <div class='col s1'>" +
            "                                    <img src='/storage/app/perfiles/" + data['usuarios'][data["comentarios"][c].nick] + "' alt=''" +
            "                                         class='circle responsive-img valign profile-post-uer-image'>" +
            "                                </div>" +
            "                                <div class='col s11'>" +
            "                                   <div class='col s9'>" +
            "                                        <div><a href='/navegacion/verPerfilAjeno/" + data["comentarios"][c].nick + "'><p class='black-text text-darken-4 margin  light-blue-text  text-darken-4'>" + data["comentarios"][c].nick + "</p></a></div>" +
            "                                        <div class='blue-grey-text text-darken-4'>"+moment(data["comentarios"][c].fecha).fromNow()+"</div>" +
            "                                   </div>" +
            cerrar +
            "                                </div>" +
            "                            </div>" +
            "                            <div class='row'>" +
            "                                <div class='col s12'>" +
            "                                    <p class='black-text'>" + data["comentarios"][c].comentario + "</p>" +
            "                                </div>" +
            "                            </div>" +
            "                        </div>" +
            "                    </div>" +
            "</div>");
        $("#reportar" + data['comentarios'][c].cod).click(function () {
            ajaxReportarComentario(data['comentarios'][c].cod);
        });
        $("#eliminar" + data['comentarios'][c].cod).click(function () {
            ajaxEliminarComentario(data['comentarios'][c].cod);
        });
    }
}