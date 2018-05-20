@include("plantillas.topadmin")

<h4>Editar Genero</h4>
<form action="{{url("/admin/genero/update")}}" class='col s12'>
    <input type="hidden" id="cod" name="cod" value="{{$genero->cod}}">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class='row'>
        <div class='input-field col s12'>
            <input id='nombre' name="nombre" type='text' value="{{$genero->nombre}}">
            <label for='nombre'>Nombre</label>
        </div>
    </div>

    <div class="row">
        <div class="center">
            <div class="col s12">
                <button type="submit" id="act" class='col s12 btn-large waves-effect'>
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</form>

@include("plantillas.foot")
