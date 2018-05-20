@include("plantillas.toplog")
<h5>Buscar Juego</h5>
<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">

            <?php
            if($seleccionado == "cod"){
            ?>
            <option value="nombreJuego">Nombre</option>
            <option value="nombreGenero">Genero</option>
            <?php
            }else if ($seleccionado == "genero"){
            ?>
            <option value="nombreJuego">Nombre</option>
            <option value="nombreGenero" selected>Genero</option>
            <?php
            }else {
            ?>
            <option value="nombreJuego" selected>Nombre</option>
            <option value="nombreGenero">Genero</option>

            <?php
            }
            ?>
        </select>
    </div>
    <div class="input-field col s12 m6 l8">
        <i class="material-icons prefix">search</i>
        <input id="valor" type="text" value="{{$valor}}" class="autocomplete">
    </div>
</div>

<div class="row">
    @foreach($juegos as $juego)
        <div class="col s12">
            <div class="card horizontal light-blue darken-4">
                <div class="card-image">
                    <img src="{{url('/storage/app/juegos/'.$juego->caratula)}}" class="caratula">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="col s12 l10">
                            @foreach($juego->generos as $g)
                                @if($g->nombre != "Sin")
                                    <a href="{{url("/juego/filtrarUsu/genero/".$g->nombre)}}" class="white-text">
                                    <div class="chip">
                                        {{$g->nombre}}
                                    </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="hide-on-med-and-down col l2 valign-wrapper">
                            <a href="{{url("/usuario/filtrarUsu/juega/".$juego->nombre)}}" class="white-text">{{$juego->cusuarios($juego->cod)}}</a>
                            &nbsp;
                            <a href="{{url("/usuario/filtrarUsu/juega/".$juego->nombre)}}" class="white-text"><i class="material-icons white-text">videogame_asset</i></a>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="valign-wrapper">
                            <a href="{{url("/navegacion/verJuego/".$juego->cod)}}"
                               class="white-text">{{$juego->nombre}}</a>
                            <a href="{{url("/navegacion/verJuego/".$juego->cod)}}" class="white-text"> <i
                                        class="material-icons white-text">pageview</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{!! $juegos->links("paginacion") !!}


<script src="{{url("/public/js/buscarjuego/ini.js")}}"></script>
@include("plantillas.footadmin")