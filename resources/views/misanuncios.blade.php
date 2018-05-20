@include("plantillas.toplog")
<h5>Tus Anuncios</h5>
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
                <div class="card-action">
                    <a href="/navegacion/editarAnuncio/{{$anuncio->cod}}">Editar</a>
                    <a id="{{$anuncio->cod}}" href="#" id="eliminarAnuncio">Eliminar</a>
                </div>
                <script>
                    $("#{{$anuncio->cod}}").click(function () {
                        ajaxEliminarAnuncio({{$anuncio->cod}});
                    });
                </script>
            </div>
        </div>
    @endforeach
</div>

{!! $anuncios->links("paginacion") !!}

<script>
    $('.materialboxed').materialbox();
</script>
<script src="{{url("/public/js/misanuncios/ajax.js")}}"></script>
@include("plantillas.footadmin")