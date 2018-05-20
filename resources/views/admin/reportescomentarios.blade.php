@include("plantillas.topadmin")

<div class="section row">
    <div class="input-field col s12 m6 l4">
        <select id="campo">
            <option value="comentario">Texto</option>
        </select>
    </div>
    <div class="input-field col s12 m6 l8">
        <i class="material-icons prefix">search</i>
        <input id="valor" type="text" value="{{$valor}}">
    </div>
</div>

<table class="centered striped">
    <thead>
    <tr>
        <th>Reportador</th>
        <th>Reportado</th>
        <th>Comentario</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($r as $reporte)
        <?php
                $reportado = \App\Comentario::where("cod",$reporte->comentario->cod)->first()->nick;
                $nickReportado = \App\Comentario::where("cod",$reporte->comentario->cod)->first()->nick;
        ?>
        <tr>
            <td><a href="/admin/navegacion/verPerfilAjeno/{{$reporte->reportador}}" class="waves-effect white-text"> {{$reporte->reportador}}</a></td>
            <td><a href="/admin/navegacion/verPerfilAjeno/{{$nickReportado}}" class="waves-effect white-text">{{$nickReportado}}</a></td>
            <td>{{$reporte->comentario->comentario}}</td>
            <td>
                <a href="{{url("/admin/reportesComentarios/eliminar/".$reporte->codComentario)}}"><i class="material-icons">delete</i></a>
                <a href="{{url("/admin/reportesComentarios/permitir/".$reporte->codComentario)}}"><i class="material-icons">done</i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{!! $r->links("paginacion") !!}

<script src="{{url("/public/js/admin/reportescomentarios/ini.js")}}"></script>
@include("plantillas.footadmin")