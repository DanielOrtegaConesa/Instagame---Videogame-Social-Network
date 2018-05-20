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
    <!-- js -->
    <script src="{{url("/public/librerias/materializecss/js/materialize.min.js")}}"></script>

    <script src="{{url("/public/js/ads.js")}}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="{{url("/public/favicon.png")}}" type="image/x-icon">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="{{url("/public/Juego/phaser.min.js")}}"></script>
    <script src="{{url("/public/Juego/juego.js")}}"></script>

    <style>
        canvas {
            padding-left: 0;
            padding-right: 0;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }
    </style>
</head>
<body>
<div class="navbar-fixed ">
    <nav>
        <div class="nav-wrapper ">
            <a href="{{url("/")}}" class="brand-logo left flex h100"><span class="logo">INSTAGAME</span></a>
        </div>
    </nav>
</div>
<div class="section center-align">
    <div class="center-align">
        <h5>Pagina no encontrada - 404</h5>
        <p>Algo ha salido mal y nos hemos equivocado al redireccionarte, aqui tienes un minijuego en compensacion :)</p>
    </div>
</div>

<div id='juego'>

</div>

</body>
</html>