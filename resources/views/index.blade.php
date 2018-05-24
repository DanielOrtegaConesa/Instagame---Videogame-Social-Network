@include("plantillas.top")
</div>
<!--Modal de inicio de sesion-->
<div id='modal' class='modal'>
    <div class='modal-content'>
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
        <a href="{{url("recuperar/mostrar")}}">¿Olvidaste la contraseña?</a>
        <br/><br/><br/><br/>

        <div class="row">
            <div class="center">
                <div class="col s6">
                    <a id="entrar" class='col s12 btn-large waves-effect'>
                        Entrar
                    </a>
                </div>
                <div class="col s6">
                    <a href="{{url("registro/mostrar")}}" id="registrarse" class='col s12 btn-large waves-effect'>
                        Registro
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="index-banner" class="parallax-container">
    <div class="section no-pad-bot">
        <div class="container">
            <br><br>
            <h1 class="header center light-blue-text text-darken-4">INSTAGAME</h1>
            <div class="row center">
                <h5 class="header col s12 light">Una moderna alternativa web para encontrar gente con la que jugar a tus
                    videojuegos preferidos.</h5>
            </div>
            <div class="row center">
                <a id="acceder" href="#modal" class="btn-large waves-effect waves-light modal-trigger animated zoomInDown">Acceder</a>
            </div>
            <br><br>
        </div>
    </div>
    <div class="parallax"><img src="{{url("/public/img/paginas/inicio/gamepad2.jpg")}}" alt="Imagen de un gamepad"></div>
</div>


<div class="container">
    <div class="section  animated bounceInLeft">
        <div class="row">
            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center brown-text"><i class="material-icons medium">group</i></h2>
                    <h5 class="center">Encuentra Jugadores</h5>
                    <p class="light">¿Cuantas veces has recorrido foros buscando gente con la que echar una partida?, Yo
                        muchas, Sin embargo no he encontrado ninguna web adecuada para realizar esto, por ello, la cree
                        yo mismo.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center brown-text"><i class="material-icons medium">text_format</i></h2>
                    <h5 class="center">Material Design</h5>

                    <p class="light">Utilizando elementos y principios del Material Design nos aseguramos de crear una
                        experiencia agradable e intuitiva para el usuario, Adaptada a cualquier dispositivo web con el
                        que conecte.</p>
                </div>
            </div>

            <div class="col s12 m4">
                <div class="icon-block">
                    <h2 class="center brown-text"><i class="material-icons medium">payment</i></h2>
                    <h5 class="center">Totalmente Gratuita</h5>
                    <p class="light">¡El ocio deberia ser un derecho y no un capricho!. Empieza registrandote y
                        configurando tu perfil, posteriormente incorpora juegos a tu lista, Busca jugadores o, incluso
                        nuevos juegos a los que empezar a jugar.</p>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container">
            <div class="row center">
                <h5 class="header col s12 light">¿A que estas esperando? Una comunidad de miles de usuarios te
                    espera.</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="{{url("/public/img/paginas/inicio/recreativo.jpg")}}" alt="Imagen de un salon recreativo"></div>
</div>

<div class="container">
    <div class="section  animated bounceInLeft">
        <div class="row">
            <div class="col s12 center">
                <h3><i class="mdi-content-send brown-text"></i></h3>
                <h4>¿Quieres Contribuir?</h4>
                <p class="left-align light">
                    Ayuda al crecimiento de esta comunidad incorporando videojuegos a la base de datos, moderando
                    usuarios o realizando testeos a la apliacion, si estas interesado contacta conmigo enviandome un
                    email a admin@danielortegaconesa.com
                </p>
            </div>
        </div>

    </div>
</div>

<div class="parallax-container valign-wrapper">
    <div class="parallax"><img src="{{url("/public/img/paginas/inicio/gamingteclado.jpeg")}}" alt="Imagen de un teclado gaming">
    </div>
</div>

<script src="{{url("/public/js/index/ini.js")}}"></script>
<script src="{{url("/public/js/index/ajax.js")}}"></script>
<script src="{{url("/public/js/index/callback.js")}}"></script>
<div>
@include("plantillas.foot")
