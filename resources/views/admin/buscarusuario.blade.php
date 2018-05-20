@include("plantillas.topadmin")
<h5>Buscar Usuario</h5>
<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">

            @if($seleccionado == "nick" || $seleccionado=="")
                <option value="nick">Nick</option>
                <option value="nombreJuego">Juega A</option>
            @elseif ($seleccionado == "juega")
                <option value="nick">Nick</option>
                <option value="nombreJuego" selected>Juega A</option>
            @endif

        </select>
    </div>
    <div class="input-field col s12 m6 l8">
        <i class="material-icons prefix">search</i>
        <input id="valor" type="text" value="{{$valor}}" class="autocomplete">
    </div>
</div>

<div class="row">
    @foreach($usuarios as $usuario)
        <div class="col s12">
            <div class="card horizontal light-blue darken-4">
                <div class="card-image">
                    <img src="{{url('/storage/app/perfiles/'.$usuario->perfil->img)}}" class="caratula">
                </div>
                <div class="card-stacked">
                    <div class="card-content">
                        <div class="col s12 l10">
                            <span class="truncate">{{$usuario->perfil->descripcion}}</span>
                        </div>
                        <div class="hide-on-med-and-down col l2 valign-wrapper">
                            {{$usuario->cjuegos($usuario->nick)}}&nbsp;<i class="material-icons white-text">videogame_asset</i>
                        </div>
                    </div>
                    <div class="card-action">
                        <div class="valign-wrapper">
                            @if($usuario->baneado)
                                <a href="{{url("/admin/navegacion/verPerfilAjeno/".$usuario->nick)}}"
                                   class="red-text">{{$usuario->nick}}</a>
                            @else
                                <a href="{{url("/admin/navegacion/verPerfilAjeno/".$usuario->nick)}}"
                                   class="white-text">{{$usuario->nick}}</a>
                            @endif
                                <a href="{{url("/admin/navegacion/verPerfilAjeno/".$usuario->nick)}}" class="white-text"> <i
                                            class="material-icons white-text">pageview</i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{!! $usuarios->links("paginacion") !!}


<script src="{{url("/public/js/admin/buscarusuario/ini.js")}}"></script>
@include("plantillas.footadmin")