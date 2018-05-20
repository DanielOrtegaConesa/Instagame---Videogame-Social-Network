@include("plantillas.top")
<br/>
<form  class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input id="nick" type="text" >
            <label for="nick">Nick</label>
        </div>
        <div class="input-field col s12">
            <input id="password" type="password">
            <label for="password">Contraseña</label>
        </div>
        <div class="input-field col s12">
            <input id="email" type="email"  class="validate">
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row ovweflow-x">
        <div class="g-recaptcha" data-sitekey="6LdFuEgUAAAAAJDO5ZL28eNRdEbydYvmIYYuDUdR"></div>
    </div>
    <div class="row">
        <div class="center">
            <div class="col s6">
                <a href="{{url("/")}}" id="registrarse" class='col s12 btn-large waves-effect'>
                    Inicio
                </a>
            </div>
            <div class="col s6">
                <a id="registrar" class='col s12 btn-large waves-effect'>Registrarse</a>
            </div>
        </div>
    </div>
</form>
</div>

<script src="{{url("/public/js/registro/ini.js")}}"></script>
<script src="{{url("/public/js/registro/ajax.js")}}"></script>
<script src="{{url("/public/js/registro/callback.js")}}"></script>

@include("plantillas.foot")
