<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>INSTAGAME</title>
    <meta name="description" content="Proyecto final para e ciclo de Desarrollo de Aplicaciones Web">
    <meta name="author" content="Dani">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="{{url("/public/librerias/reset.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/general.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/nolog.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/emoji.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/librerias/materializecss/css/materialize.min.css")}}"/>
    <link rel="stylesheet" href="{{url("/public/css/animate.css")}}"/>
    <!-- js -->
    <script src="{{url("/public/librerias/jquery-3.2.1.min.js")}}"></script>
    <script src="{{url("/public/librerias/materializecss/js/materialize.min.js")}}"></script>

    <script src="{{url("/public/js/ads.js")}}"></script>
    <script src="{{url("/public/js/general.js")}}"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="icon" href="{{url("/public/favicon.png")}}" type="image/x-icon">

    <script src='https://www.google.com/recaptcha/api.js'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-8204445335123894",
            enable_page_level_ads: true
        });
    </script>
</head>

<body>
<main>

    <div class="navbar-fixed ">
        <nav>
            <div class="nav-wrapper ">
                <a href="/" class="brand-logo right flex h100"><span class="logo">INSTAGAME</span></a>
                <ul id="nav-mobile" class="left hide-on-med-and-down">
                    <!-- <li><a href="sass.html">Uno</a></li>
                     <li><a href="badges.html">Dos</a></li>
                     <li><a href="collapsible.html">Tres</a></li>-->
                </ul>
            </div>
        </nav>
    </div>
    <div class="container">