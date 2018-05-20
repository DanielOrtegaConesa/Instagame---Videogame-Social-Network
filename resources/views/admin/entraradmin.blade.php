@include("plantillas.top")
<h4>Iniciar Sesion</h4>
<form class='col s12'>
    <div class='row'>
        <div class='input-field col s12'>
            <input id='nick' type='text'>
            <label for='nick'>Nick</label>
        </div>
        <div class='input-field col s12'>
            <input id='password' type='password'>
            <label for='password'>Contraseña</label>
        </div>
    </div>
</form>
<div class="row ovweflow-x">
    <div class="g-recaptcha" data-sitekey="6LdFuEgUAAAAAJDO5ZL28eNRdEbydYvmIYYuDUdR"></div>
</div>
<div class="row">
    <div id="loader" class="preloader-wrapper active">
        <div class="spinner-layer spinner-blue-only">
            <div class="circle-clipper left">
                <div class="circle"></div>
            </div>
            <div class="gap-patch">
                <div class="circle"></div>
            </div>
            <div class="circle-clipper right">
                <div class="circle"></div>
            </div>
        </div>
    </div>
</div>
<br/><br/><br/>
<div class="row">
    <div class="center">
        <div class="col s12">
            <a id="entrar" class='col s12 btn-large waves-effect'>
                Entrar
            </a>
        </div>
    </div>
</div>
<script src="{{url("/public/js/admin/entraradmin/ini.js")}}"></script>
<script src="{{url("/public/js/admin/entraradmin/ajax.js")}}"></script>
<script src="{{url("/public/js/admin/entraradmin/callback.js")}}"></script>
@include("plantillas.foot")
