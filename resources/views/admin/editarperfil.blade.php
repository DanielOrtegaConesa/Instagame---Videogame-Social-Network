@include("plantillas.topadmin")
<?php

$semana = $u->perfil->horario;
$fin = $u->perfil->horariofin;

if (isset($_REQUEST["imgsubida"])) {
if($_REQUEST["imgsubida"] == "si"){
?>
<script>
    $(document).ready(function () {
        toast("Imagen Subida");
    });
</script>
<?php
}else if($_REQUEST["imgsubida"] == "invalidsize"){
?>
<script>
    $(document).ready(function () {
        toast("El tamaño excede el permitido");
    });
</script>
<?php
}else{
?>
<script>
    $(document).ready(function () {
        toast("Ha ocurrido un error al subir la imagen");
    });
</script>
<?php
}
}
?>
<input type="hidden" value="{{$u->nick}}" id="usuario">

<br/>
<h5>Editar Perfil</h5>
<div class="row">

    <form method="post" action="{{url("/admin/editarUsuario/actualizarImagen/$u->nick")}}" id="formimagen"
          accept-charset="UTF-8"
          enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="file-field input-field">
            <div class="btn">
                <span>Imagen</span>
                <input type="file" id="img" name="img">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path" type="text"
                       placeholder="Formatos Admitidos : png, jpg, jpeg y gif. Maximo 1MB">
            </div>
        </div>
    </form>

    <form class="col s12">
        <div class="row">
            <div class="input-field col s12">
                <textarea type="text" id="descripcion"
                          class="materialize-textarea white-text">{{$u->perfil->descripcion}}</textarea>
                <label for="descripcion">Presentacion</label>
            </div>

            <div class="input-field col s12">
                <textarea type="text" id="red" class="materialize-textarea white-text">{{$u->perfil->red}}</textarea>
                <label for="red">Enlace</label>
            </div>
        </div>
        <div class="row">
            <h5>Horario entre semana</h5>
            <ul class="collection">
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($semana == "m" || $semana == "mt" || $semana == "mn" || $semana == "todo") {
                                echo "<input type='checkbox' id='sm' checked/>";
                            } else {
                                echo "<input type='checkbox' id='sm'/>";
                            }
                            ?>
                            <span>Mañanas</span>
                        </label>
                    </p>
                </li>
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($semana == "t" || $semana == "mt" || $semana == "tn" || $semana == "todo") {
                                echo "<input type='checkbox' id='st' checked/>";
                            } else {
                                echo "<input type='checkbox' id='st'/>";
                            }
                            ?>
                            <span>Tardes</span>
                        </label>
                    </p>
                </li>
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($semana == "n" || $semana == "tn" || $semana == "mn" || $semana == "todo") {
                                echo "<input type='checkbox' id='sn'checked/>";
                            } else {
                                echo "<input type='checkbox' id='sn'/>";
                            }
                            ?>
                            <span>Noches</span>
                        </label>
                    </p>
                </li>
            </ul>

            <br/><h5>Horario fin de semana</h5><br/>
            <ul class="collection">
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($fin == "m" || $fin == "mt" || $fin == "mn" || $fin == "todo") {
                                echo "<input type='checkbox' id='fm' checked/>";
                            } else {
                                echo "<input type='checkbox' id='fm'/>";
                            }
                            ?>
                            <span>Mañanas</span>
                        </label>
                    </p>
                </li>
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($fin == "t" || $fin == "mt" || $fin == "tn" || $fin == "todo") {
                                echo "<input type='checkbox' id='ft' checked/>";
                            } else {
                                echo "<input type='checkbox' id='ft'/>";
                            }
                            ?>
                            <span>Tardes</span>
                        </label>
                    </p>
                </li>
                <li class="collection-item">
                    <p>
                        <label>
                            <?php
                            if ($fin == "n" || $fin == "tn" || $fin == "mn" || $fin == "todo") {
                                echo "<input type='checkbox' id='fn'checked/>";
                            } else {
                                echo "<input type='checkbox' id='fn'/>";
                            }
                            ?>
                            <span>Noches</span>
                        </label>
                    </p>
                </li>
            </ul>
        </div>
        <div class="row">
            <a id="actualizar" class='col s12 btn btn-large waves-effect'>
                Actualizar
            </a>
        </div>
    </form>
</div>
<script src="{{url("/public/js/admin/editarUsuario/ini.js")}}"></script>
<script src="{{url("/public/js/admin/editarUsuario/ajax.js")}}"></script>
<script src="{{url("/public/js/admin/editarUsuario/callback.js")}}"></script>
@include("plantillas.footadmin")

