@include("plantillas.topadmin")
<?php
$i = 0;
$g1 = "";
$g2 = "";
$g3 = "";
foreach ($juego->generos as $g) {
    switch ($i) {
        case 0:
            $g1 = $g->cod;
            break;
        case 1:
            $g2 = $g->cod;
            break;
        case 2:
            $g3 = $g->cod;
            break;
    }
    $i++;
}
?>

<div>
    @foreach ($errors->all() as $error)
        <li>{{ str_replace("year","año",$error) }}</li>
    @endforeach
</div>

<h5>Editar Juego</h5>
<form action="{{url("/admin/juego/update")}}" class='col s12' method="post" accept-charset="UTF-8"
      enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="cod" value="{{$juego->cod}}">
    <div class='row'>
        <div class='input-field col s12 m6'>
            <input id='nombre' name="nombre" type='text' value="{{$juego->nombre}}">
            <label for='nombre'>Nombre</label>
        </div>
        <div class='input-field col s12 m6'>
            <input id='year' name="year" type='number' value="{{$juego->year}}">
            <label for='year'>Año</label>
        </div>
    </div>

    <div class='row'>
        <div class='input-field col s12 m4'>
            <select id="g1" name="g1">
                <option value="1">Genero 1</option>
                @foreach($generos as $key => $genero)
                    @if($key!=0)
                        @if($genero->cod == $g1)
                            <option value="{{$genero->cod}}" selected>{{$genero->nombre}}</option>
                        @else
                            <option value="{{$genero->cod}}">{{$genero->nombre}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
        <div class='input-field col s12 m4'>
            <select id="g2" name="g2">
                <option value="1">Genero 2</option>
                @foreach($generos as $key => $genero)
                    @if($key!=0)
                        @if($genero->cod == $g2)
                            <option value="{{$genero->cod}}" selected>{{$genero->nombre}}</option>
                        @else
                            <option value="{{$genero->cod}}">{{$genero->nombre}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
        <div class='input-field col s12 m4'>
            <select id="g3" name="g3">
                <option value="1">Genero 3</option>
                @foreach($generos as $key => $genero)
                    @if($key!=0)
                        @if($genero->cod == $g3)
                            <option value="{{$genero->cod}}" selected>{{$genero->nombre}}</option>
                        @else
                            <option value="{{$genero->cod}}">{{$genero->nombre}}</option>
                        @endif
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class='row'>
        <div class='col s12'>
            <p>Descripcion</p><br/>
            <textarea id="descripcion" name="descripcion">{{str_replace("<br/>","",$juego->descripcion)}}</textarea>
        </div>
    </div>

    <div class="file-field input-field">
        <div class="btn">
            <span>Caratula</span>
            <input type="file" id="caratula" name="caratula">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path" type="text" placeholder="Formatos Admitidos : png, jpg y jpeg">
        </div>
    </div>
    <div class="file-field input-field">
        <div class="btn">
            <span>Imagen</span>
            <input type="file" id="img" name="img">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path" type="text" placeholder="Formatos Admitidos : png, jpg y jpeg">
        </div>
    </div>

    <div class="row">
        <div class="center">
            <div class="col s12">
                <button type="submit" class="col s12 btn-large waves-effect">Actualizar</button>
            </div>
        </div>
    </div>
</form>

<br/>

@include("plantillas.foot")
