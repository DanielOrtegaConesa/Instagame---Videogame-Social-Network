@include("plantillas.toplog")
<?php
$u = \App\Usuario::where("nick", $comentario->nick)->first();
?>
<h4>Comentario</h4>
<div class='card white comentario animated fadeIn'>
    <div class='section'>
        <div class='card-profile-title'>
            <div class='row'>
                <div class='col s1'>
                    <img src='/storage/app/perfiles/{{$u->perfil->img}}' alt=''
                         class='circle responsive-img valign profile-post-uer-image'>
                </div>
                <div class='col s11'>
                    <div class='col s9'>
                        <div>
                            <a href='/navegacion/verPerfilAjeno/{{$comentario->nick}}'>
                                <p class='black-text text-darken-4 margin  light-blue-text  text-darken-4'>
                                    {{$comentario->nick}}
                                </p>
                            </a>
                        </div>
                        <div class='blue-grey-text text-darken-4'>
                            <script>moment({{$comentario->fecha}}).fromNow()</script>
                        </div>
                    </div>
                    @if(session("usuario")->nick == $u->nick)
                        <div class='right-align col s3'>
                            <i id='eliminar' class='waves-effect material-icons red-text'>close</i>
                        </div>;
                    @else
                        <div class='right-align col s3 tooltipped' data-tooltip='Reportar' data-position='bottom'>
                            <i id='reportar' class='waves-effect material-icons red-text'>report_problem</i>
                        </div>";
                    @endif
                </div>
            </div>
            <div class='row'>
                <div class='col s12'>
                    <p class='black-text'> {{$comentario->comentario}} </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{url("/public/js/verjuego/ini.js")}}"></script>
<script src="{{url("/public/js/verjuego/ajax.js")}}"></script>
<script src="{{url("/public/js/verjuego/callback.js")}}"></script>
<script>
    $("#reportar").click(function () {
        ajaxReportarComentario({{$comentario->cod}});
    });
    $("#eliminar").click(function () {
        ajaxEliminarComentario({{$comentario->cod}});
        window.location.replace("/");
    })
</script>
@include("plantillas.footlog")


