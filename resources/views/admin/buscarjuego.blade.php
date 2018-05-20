@include("plantillas.topadmin")
<h5>Buscar Juego</h5>
<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">

            <?php
            if($seleccionado == "cod"){
            ?>
            <option value="nombreJuego">Nombre</option>
            <option value="codJuego" selected>Codigo</option>
            <option value="nombreGenero">Genero</option>
            <?php
            }else if ($seleccionado == "genero"){
            ?>
            <option value="nombreJuego">Nombre</option>
            <option value="codJuego">Codigo</option>
            <option value="nombreGenero" selected>Genero</option>
            <?php
            }else {
            ?>
            <option value="nombreJuego" selected>Nombre</option>
            <option value="codJuego">Codigo</option>
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
                                    <a href="{{url("/admin/juego/filtrar/genero/".$g->nombre)}}" class="white-text">
                                    <div class="chip">
                                        {{$g->nombre}}
                                    </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                        <div class="hide-on-med-and-down col l2 valign-wrapper">
                            <a href="{{url("/admin/usuario/filtrar/juega/".$juego->nombre)}}" class="white-text">{{$juego->cusuarios($juego->cod)}}</a>
                            &nbsp;
                            <a href="{{url("/admin/usuario/filtrar/juega/".$juego->nombre)}}" class="white-text"><i class="material-icons white-text">videogame_asset</i></a>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="valign-wrapper">
                            <a href="{{url("/admin/navegacion/verJuego/".$juego->cod)}}"
                               class="white-text">{{$juego->nombre}}</a>
                            <a href="{{url("/admin/navegacion/verJuego/".$juego->cod)}}" class="white-text"> <i
                                        class="material-icons white-text">pageview</i></a>
                            <a href="{{url("/admin/navegacion/editarJuego/".$juego->cod)}}"><i class="material-icons white-text">create</i></a>
                            <a href="{{url("/admin/juego/delete/".$juego->cod)}}"><i class="material-icons white-text">delete</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{!! $juegos->links("paginacion") !!}


<script src="{{url("/public/js/admin/buscarjuego/ini.js")}}"></script>
@include("plantillas.footadmin")