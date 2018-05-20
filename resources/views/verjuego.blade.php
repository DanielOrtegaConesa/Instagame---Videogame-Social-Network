@include("plantillas.toplog")
<script>
    $(document).ready(function () {

        $("#rateYo").rateYo({
            rating: {{$juego->puntuacion($juego->cod)}},
            multiColor: {

                "startColor": "#f44336", //RED
                "endColor"  : "#ffeb3b"
            }
        });

        $("#rateYo").rateYo().on("rateyo.set", function (e, data) {
            ajaxCambiarPuntuacion(data.rating);
        });

    });
</script>

<script src="{{url("/public/librerias/jquery.rateyo.min.js")}}"></script>

<link rel="stylesheet" href="{{url("/public/librerias/jquery.rateyo.min.css")}}"/>
<input type="hidden" id="codjuego" value="{{$juego->cod}}">

<div class="row">
    <div class="col s12">
        <img class="imgjuego" src="{{url('/storage/app/juegos/'.$juego->img)}}">
    </div>
</div>

<div class="row">

    <div class="col s12 l3">

        <div class="card hide-on-med-and-down">
            <div class="card-image">
                <img src="{{url('/storage/app/juegos/'.$juego->caratula)}}">
            </div>
        </div>

        <div class="card-panel light-blue darken-4">
            <p class="titulojuego">{{$juego->nombre}}</p>
            <div class="section">
                <div id="rateYo">&nbsp;</div>
                <br/>
                <p>Tu: <span id="puntuacion">{{session("usuario")->puntuacionJuego($juego->cod)}}</span> </p>
            </div>
            @foreach($juego->generos as $g)
                @if($g->nombre != "Sin")
                    <a href="{{url("/juego/filtrarUsu/genero/".$g->nombre)}}" class="white-text">
                        <div class="chip">
                            {{$g->nombre}}
                        </div>
                    </a>
                @endif
            @endforeach

            @switch($estado)
                @case("jugando")
                <select id="estado">
                    <option value="sinlistar">Sin Lista</option>
                    <option value="jugando" selected>Jugando</option>
                    <option value="dejado">Dejado</option>
                </select>
                @break
                @case("dejado")
                <select id="estado">
                    <option value="sinlistar">Sin Lista</option>
                    <option value="jugando">Jugando</option>
                    <option value="dejado" selected>Dejado</option>
                </select>
                @break
                @default
                <select id="estado">
                    <option value="sinlistar">Sin Lista</option>
                    <option value="jugando">Jugando</option>
                    <option value="dejado">Dejado</option>
                </select>
                @break
            @endswitch
        </div>
    </div>

    <div class="col s12 l9">
        <div class="card-panel white">
            <p class="black-text"> DESCRIPCION </p><br/>
            <p class="black-text juegodesctext"><?=$juego->descripcion;?></p>
        </div>
    </div>
    <div class="col s12 l9">
        <div class="card-panel white">
            <div class="section">
                <textarea id="comentario" name="comentario" class="materialize-textarea black-text"
                          placeholder="Escribe tu comentario..."></textarea>
                <span> <i id="enviarComentario" class="material-icons right waves-effect">send</i></span>
                <span> <i id="microfono" class="material-icons right waves-effect">mic_none</i></span>
            </div>
        </div>
    </div>
    <div class="col s12">


        <div class="section">
            <p> COMENTARIOS </p>
            <div id="comentarios">
                <!-- Se insertaran aqui por ajax-->
            </div>
        </div>

    </div>

</div>

<script src="{{url("/public/js/verjuego/ini.js")}}"></script>
<script src="{{url("/public/js/verjuego/ajax.js")}}"></script>
<script src="{{url("/public/js/verjuego/callback.js")}}"></script>

<script src="{{url("/public/librerias/artyom.window.min.js")}}"></script>

<script>
    var idMostrarResultado = "comentario";
</script>
<script src="{{url("/public/js/dictado.js")}}"></script>
@include("plantillas.footlog")

