@include("plantillas.topadmin")

<h5>Nuevo Genero</h5>
<form class='col s12'>
    <div class='row'>
        <div class='input-field col s12'>
            <input id='nombre' type='text'>
            <label for='nombre'>Nombre</label>
        </div>
    </div>
</form>
<div class="row">
    <div class="center">
        <div class="col s12">
            <a id="add" class='col s12 btn-large waves-effect'>
                Añadir
            </a>
        </div>
    </div>
</div>

<script src="{{url("/public/js/admin/nuevogenero/ini.js")}}"></script>
<script src="{{url("/public/js/admin/nuevogenero/ajax.js")}}"></script>
<script src="{{url("/public/js/admin/nuevogenero/callback.js")}}"></script>

@include("plantillas.footadmin")
