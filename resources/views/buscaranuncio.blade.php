@include("plantillas.toplog")
<h5>Buscar Anuncios</h5>
<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">
            @if($seleccionado == "")
                <option value="titulo" selected>Titulo</option>
                <option value="texto">Descipcion</option>
                <option value="precioi">Precio Inferior</option>
                <option value="precios">Precio Superior</option>
            @elseif($seleccionado == "titulo")
                <option value="titulo" selected>Titulo</option>
                <option value="texto">Descipcion</option>
                <option value="precioi">Precio Inferior</option>
                <option value="precios">Precio Superior</option>
            @elseif($seleccionado == "texto")
                <option value="titulo">Titulo</option>
                <option value="texto" selected>Descipcion</option>
                <option value="precioi">Precio Inferior</option>
                <option value="precios">Precio Superior</option>
            @elseif($seleccionado == "precioi")
                <option value="titulo">Titulo</option>
                <option value="texto">Descipcion</option>
                <option value="precioi" selected>Precio Inferior</option>
                <option value="precios">Precio Superior</option>
            @else
                <option value="titulo">Titulo</option>
                <option value="texto">Descipcion</option>
                <option value="precioi">Precio Inferior</option>
                <option value="precios" selected>Precio Superior</option>
            @endif
        </select>
    </div>
    <div class="input-field col s12 m6 l8">
        <i class="material-icons prefix">search</i>
        <input id="valor" type="text" value="{{$valor}}" class="autocomplete">
    </div>
</div>

<div class="row">
    @foreach($anuncios as $anuncio)
        <div class="col s12 m6">
            <div class="card">
                <div class="card-image waves-effect waves-block waves-light">
                    <img class="anuncio activator" src="{{url('/storage/app/anuncios/'.$anuncio->img)}}">
                </div>
                <div class="card-content">
                    <span class="card-title activator black-text ">{{$anuncio->titulo}}<i class="material-icons right">more_vert</i>
                        -
                        {{$anuncio->precio}}&euro;
                    </span>

                    <p><a href="/navegacion/verPerfilAjeno/{{$anuncio->nick}}"
                          class=" light-blue-text text-darken-4">{{$anuncio->nick}}</a></p>
                </div>
                <div class="card-reveal">
                    <span class="card-title black-text">{{$anuncio->titulo}}<i
                                class="material-icons right">close</i></span>
                    <p class="black-text">{{$anuncio->texto}}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>

{!! $anuncios->links("paginacion") !!}

<script src="{{url("/public/js/buscaranuncio/ini.js")}}"></script>
@include("plantillas.footlog")