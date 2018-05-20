@include("plantillas.toplog")

<h5>Hola, {{session("usuario")->nick}}</h5>
<div class="row">

    <div class="col s12">

        <div id="solicitudes" class="col s12 m6">
            <div class="center">
                <h5>Solicitudes</h5>
            </div>
            <hr class="style14">
        </div>

        <div class="col s12 m6">
            <div class="center">
                <h5>Amigos</h5>
            </div>
            <hr class="style14">
            <div id="amgioscontenedor">
                <div id="amigos">
                    <!-- Aqui se insertan los amigos via ajax -->
                </div>
            </div>
        </div>

    </div>

    <div class="col s12">
        <div class="center">
            <h5>Novedades</h5>
        </div>
        <hr class="style14">
        <div id="novedades">
            <!-- Aqui se insertan las novedades via ajax -->
        </div>
    </div>

</div>

<script src="{{url("/public/js/indexlog/ini.js")}}"></script>
<script src="{{url("/public/js/indexlog/ajax.js")}}"></script>
<script src="{{url("/public/js/indexlog/callback.js")}}"></script>
@include("plantillas.footlog")
