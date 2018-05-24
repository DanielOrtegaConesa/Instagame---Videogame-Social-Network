@include("plantillas.top")

<br/>
<form  class="col s12">
    <div class="row">
        <div class="input-field col s12">
            <input id="email" type="email" >
            <label for="email">Email</label>
        </div>
    </div>
    <div class="row ovweflow-x">
        <div class="g-recaptcha" data-sitekey="6LdFuEgUAAAAAJDO5ZL28eNRdEbydYvmIYYuDUdR"></div>
    </div>
    <div class="row">
        <div class="center">
            <div class="col s12">
                <a id="solicitar" class='col s12 btn-large waves-effect'>Solicitar</a>
            </div>
        </div>
    </div>
</form>


<script src="{{url("/public/js/recuperar/ini.js")}}"></script>
<script src="{{url("/public/js/recuperar/ajax.js")}}"></script>
<script src="{{url("/public/js/recuperar/callback.js")}}"></script>

@include("plantillas.foot")
