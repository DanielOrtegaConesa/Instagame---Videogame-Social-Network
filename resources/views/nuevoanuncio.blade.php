@include("plantillas.toplog")
@if(isset($_REQUEST["error"]))
    @if($_REQUEST["error"] == "img")
        <script>
            toast("Publicado sin imagen");
        </script>
    @endif
@endif

<div>
    @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
    @endforeach
</div>

<h4>Nuevo Anuncio</h4>
<form action="{{url("/anuncios/nuevoAnuncio")}}" class='col s12' method="post" accept-charset="UTF-8"
      enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class='row'>
        <div class='input-field col s8'>
            <input id='titulo' name="titulo" type='text'>
            <label for='titulo'>Titulo</label>
        </div>

        <div class="input-field col s12 m4">
            <label for='precio'>Precio</label>
            <input id="precio" name="precio" type="number">
        </div>

    </div>

    <div class="input-field col s12">
        <label for='texto'>Texto</label>
        <textarea id="texto" name="texto" class="materialize-textarea white-text"></textarea>
    </div>

    <div class="file-field input-field">
        <div class="btn">
            <span>Imagen</span>
            <input type="file" id="img" name="img">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path" type="text" placeholder="Formatos Admitidos : png, jpg y jpeg, Maximo 1MB">
        </div>
    </div>

    <div class="row">
        <div class="center">
            <div class="col s12">
                <button type="submit" class="col s12 btn-large waves-effect">Publicar</button>
            </div>
        </div>
    </div>
</form>

<br/>

@include("plantillas.footlog")
