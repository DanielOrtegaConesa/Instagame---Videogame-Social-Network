@include("plantillas.topadmin")

<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">

            <?php
            if($seleccionado == "cod"){
            ?>
            <option value="nombreGenero">Nombre</option>
            <option value="codGenero" selected>Codigo</option>
            <?php
            }else{
            ?>
            <option value="nombreGenero">Nombre</option>
            <option value="codGenero"g>Codigo</option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="input-field col s12 m6 l8">
        <i class="material-icons prefix">search</i>
        <input id="valor" type="text" value="{{$valor}}" class="autocomplete">
    </div>
</div>

<table class="centered striped">
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Nombre</th>
        <th>Juegos</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($generos as $genero)
        @if($genero->cod != 0)
            <tr>
                <td>{{$genero->cod}}</td>
                <td>{{$genero->nombre}}</td>
                <td><a href="{{url("/admin/juego/filtrar/genero/".$genero->nombre)}}" class="white-text">{{count($genero->juegos)}}</a></td>
                <td>
                    <a href="{{url("/admin/navegacion/editarGenero/".$genero->cod)}}"><i class="material-icons">create</i></a>
                    <a href="{{url("/admin/genero/delete/".$genero->cod)}}"><i class="material-icons">delete</i></a>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

{!! $generos->links("paginacion") !!}

<script src="{{url("/public/js/admin/buscargenero/ini.js")}}"></script>
@include("plantillas.footadmin")