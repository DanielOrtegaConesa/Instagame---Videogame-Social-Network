@include("plantillas.topadmin")

<table class="centered striped">
    <thead>
    <tr>
        <th>Reportador</th>
        <th>Reportado</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($r as $reporte)
        <tr>
            <td><a href="/admin/navegacion/verPerfilAjeno/{{$reporte->reportador}}" class="waves-effect white-text"> {{$reporte->reportador}}</a></td>
            <td><a href="/admin/navegacion/verPerfilAjeno/{{$reporte->reportado}}" class="waves-effect white-text">{{$reporte->reportado}}</a></td>
            <td>
                <a href="{{url("/admin/reportesUsuarios/eliminar/".$reporte->reportado)}}"><i class="material-icons">delete</i></a>
                <a href="{{url("/admin/reportesUsuarios/permitir/".$reporte->reportado)}}"><i class="material-icons">done</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $r->links("paginacion") !!}

<script src="{{url("/public/js/admin/reportescomentarios/ini.js")}}"></script>
@include("plantillas.footadmin")