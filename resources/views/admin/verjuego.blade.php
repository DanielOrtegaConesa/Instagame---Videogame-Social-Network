@include("plantillas.topadmin")
<script>
    $(document).ready(function () {

        $("#rateYo").rateYo({
            rating: {{$juego->puntuacion($juego->cod)}},
            multiColor: {

                "startColor": "#f44336", //RED
                "endColor"  : "#ffeb3b"
            }
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

                <select id="estado">
                    <option value="sinlistar">Sin Lista</option>
                    <option value="jugando" selected>Jugando</option>
                    <option value="dejado">Dejado</option>
                </select>
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


<script src="{{url("/public/js/admin/verjuego/ini.js")}}"></script>
<script src="{{url("/public/js/admin/verjuego/ajax.js")}}"></script>
<script src="{{url("/public/js/admin/verjuego/callback.js")}}"></script>
@include("plantillas.footadmin")

