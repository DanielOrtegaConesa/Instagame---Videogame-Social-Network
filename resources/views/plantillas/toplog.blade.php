<!DOCTYPE html>
<html>
<head>
    <script src="{{url("/public/librerias/jquery-3.2.1.min.js")}}"></script>
    <script src="{{url("/public/js/general.js")}}"></script>

    <meta charset="utf-8">
    <title>INSTAGAME</title>
    <meta name="description" content="Proyecto final para e ciclo de Desarrollo de Aplicaciones Web">
    <meta name="author" content="Dani">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="{{url("/public/librerias/reset.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/general.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/librerias/materializecss/css/materialize.min.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/animate.css")}}"/>
    <!-- js -->
    <script src="{{url("/public/librerias/materializecss/js/materialize.min.js")}}"></script>
    <script src="{{url("/public/librerias/moment.js")}}"></script>

    <script src="{{url("/public/js/ads.js")}}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="{{url("/public/favicon.png")}}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<main>


    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="{{url("")}}" class="brand-logo">&nbsp;INSTAGAME</a>
                <a href="#" data-target="menumovil" class="sidenav-trigger"><i
                            class="material-icons black-text">menu</i></a>
                <ul class="right hide-on-med-and-down">

                    <li><a href="{{url("/navegacion/buscarJuego")}}">Juegos</a></li>
                    <li><a href="{{url("/navegacion/buscarUsuario")}}">Usuarios</a></li>

                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown1">Anuncios<i
                                    class="material-icons right">arrow_drop_down</i></a>
                    </li>
                    <ul id='dropdown1' class='dropdown-content'>
                        <li><a href="{{url("/navegacion/buscarAnuncio")}}">Ver</a></li>
                        <li><a href="{{url("/navegacion/misAnuncios")}}">Tus anuncios</a></li>
                        <li><a href="{{url("/navegacion/nuevoAnuncio")}}">Publicar</a></li>
                    </ul>

                    <li>
                        <a class="dropdown-trigger" href="#!" data-target="dropdown2">Mi Perfil<i
                                    class="material-icons right">arrow_drop_down</i></a>
                    </li>
                    <ul id='dropdown2' class='dropdown-content'>
                        <li><a href="{{url("/navegacion/verPerfil")}}">Ver</a></li>
                        <li><a href="{{url("/navegacion/editarPerfil")}}">Editar</a></li>
                        <li class="divider" tabindex="-1"></li>
                        <li><a href="{{url("/navegacion/cerrar")}}">Salir</a></li>
                    </ul>

                </ul>
            </div>
        </nav>
    </div>

    <ul class="sidenav" id="menumovil">
        <li>
            <a href="{{url("/")}}">
                <i class="material-icons white-text">home</i>Inicio
            </a>
        </li>

        <li>
            <a href="{{url("/navegacion/buscarJuego")}}">
                <i class="material-icons white-text">videogame_asset</i> Juegos
            </a>
        </li>

        <li>
            <a href="{{url("/navegacion/buscarUsuario")}}">
                <i class="material-icons white-text">face</i>Usuarios
            </a>
        </li>

        <li>
            <a href="{{url("/navegacion/verPerfil")}}">
                <i class="material-icons white-text">visibility</i>Tu Perfil
            </a>
        </li>

        <li>
            <a href="{{url("/navegacion/editarPerfil")}}">
                <i class="material-icons white-text">mode_edit</i>Editar Perfil
            </a>
        </li>


        <li>
            <a href="{{url("/navegacion/buscarAnuncio")}}">
                <i class="material-icons white-text">search</i>Anuncios
            </a>
        </li>
        <li>
            <a href="{{url("/navegacion/misAnuncios")}}">
                <i class="material-icons white-text">pageview</i>Tus anuncios
            </a>
        </li>
        <li>
            <a href="{{url("/navegacion/nuevoAnuncio")}}">
                <i class="material-icons white-text">create</i>Publicar Anunio
            </a>
        </li>

        <li>
            <a href="{{url("/navegacion/cerrar")}}">
                <i class="material-icons white-text">power_settings_new</i>Salir
            </a>
        </li>
    </ul>

    <div class="container animated fadeIn">

    @if(\App\Chat::where("para",session("usuario")->nick)->where("leido",0)->first() == null)
        <!-- CHAT -->
            <div id="chat" class="fixed-action-btn modal-trigger">
                <a class="btn-floating btn-large light-blue darken-4" href="/navegacion/chat">
                    <i class="large material-icons white-text">chat_bubble</i>
                </a>
            </div>
    @else
        <!-- CHAT -->
            <div id="chat" class="fixed-action-btn modal-trigger">
                <a class="btn-floating btn-large light-blue darken-4 pulse" href="/navegacion/chat">
                    <i class="large material-icons white-text">chat_bubble</i>
                </a>
            </div>
@endif