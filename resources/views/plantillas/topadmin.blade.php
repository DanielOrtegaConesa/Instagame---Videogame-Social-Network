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
    @if(session()->has("mensaje"))
        <script>
            toast("{{session("mensaje")}}");
            {{session()->forget("mensaje")}}
        </script>
    @endif
</head>

<body>
<main>

    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <a href="{{url("")}}" class="brand-logo">&nbsp;INSTAGAME<span class=" blue-grey-text text-darken-4">ADMIN</span></a>
                <a href="#" data-target="menumovil" class="sidenav-trigger"><i
                            class="material-icons black-text">menu</i></a>

                <ul class="right hide-on-med-and-down">

                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Buscar<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    <ul id='dropdown1' class='dropdown-content'>
                        <li><a href="{{url("/admin/navegacion/buscarGenero")}}">Genero</a></li>
                        <li><a href="{{url("/admin/navegacion/buscarJuego")}}">Juego</a></li>
                        <li><a href="{{url("/admin/navegacion/buscarUsuario")}}">Usuarios</a></li>
                    </ul>

                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown2">Crear<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    <ul id='dropdown2' class='dropdown-content'>
                        <li><a href="{{url("/admin/navegacion/nuevoGenero")}}">Genero</a></li>
                        <li><a href="{{url("/admin/navegacion/nuevoJuego")}}">Juego</a></li>
                    </ul>

                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown3">Reportes<i
                                    class="material-icons right">arrow_drop_down</i></a></li>
                    <ul id='dropdown3' class='dropdown-content'>
                        <li><a href="{{url("/admin/navegacion/reportesComentarios")}}">Comentarios</a></li>
                        <li><a href="{{url("/admin/navegacion/reportesUsuarios")}}">Usuarios</a></li>
                    </ul>

                    <li><a href="{{url("/admin/navegacion/buscarAnuncio")}}">Anuncios</a></li>


                    <li><a href="{{url("/navegacion/cerrar")}}">Salir</a></li>
                </ul>

            </div>
        </nav>
    </div>

    <ul class="sidenav" id="menumovil">
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">Buscar</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{url("/admin/navegacion/buscarGenero")}}">Genero</a></li>
                        <li><a href="{{url("/admin/navegacion/buscarJuego")}}">Juego</a></li>
                        <li><a href="{{url("/admin/navegacion/buscarUsuario")}}">Usuarios</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">Crear</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{url("/admin/navegacion/nuevoGenero")}}">Genero</a></li>
                        <li><a href="{{url("/admin/navegacion/nuevoJuego")}}">Juego</a></li>
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header">Reportes</div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{url("/admin/navegacion/reportesComentarios")}}">Comentarios</a></li>
                        <li><a href="{{url("/admin/navegacion/reportesUsuarios")}}">Usuarios</a></li>
                    </ul>
                </div>
            </li>

            <a href="{{url("/admin/navegacion/buscarAnuncio")}}">
                <li>
                    <div class="collapsible-header">Anuncios</div>
                </li>
            </a>
            <a href="{{url("/navegacion/cerrar")}}">
                <li>
                    <div class="collapsible-header">Salir</div>
                </li>
            </a>
        </ul>

    </ul>

    <div class="container animated fadeIn">
