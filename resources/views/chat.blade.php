@include("plantillas.toplog")
<h5>Chat</h5>

<div class="row">
    <div class="col s12 l3" id="contenedorChatListadoAmigos">
        <ul id="chatListadoAmigos" class="collection white">

        </ul>
    </div>

    <form class="col s12 l9">

            <ul class="collection white" id="chatListadoMensajes">
                <!-- AQUI SE INSERTARAN LOS MENSAJES -->
            </ul>

            <form class="col s12">
                <div class="input-field col s12 card white  black-text">
                    <i class="mdi-editor-mode-edit prefix"></i>
                    <textarea id="mensaje" name="mensaje" class="materialize-textarea black-text" placeholder="Escribe tu mensaje aqui"></textarea>
                    <span> <i id="microfono" class="material-icons right waves-effect">mic_none</i></span>
                    <span> <i id="enviarMensaje" class="material-icons right waves-effect">send</i></span>
                </div>
            </form>
    </form>
</div>
<script src="{{url("/public/js/chat/chat.js")}}"></script>

<script src="{{url("/public/librerias/artyom.window.min.js")}}"></script>
<script>
    var idMostrarResultado = "mensaje";
</script>
<script src="{{url("/public/js/dictado.js")}}"></script>

@include("plantillas.footlog")