<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Novedad;
use App\ReportesComentarios;
use Illuminate\Http\Request;

class ReportesComentariosController extends Controller
{
    public function filtrar($campo = "nombre", $valor = ""){

            session()->put("v", $valor);
            return view("admin.reportescomentarios")
                ->with("r",
                    ReportesComentarios::whereHas('comentario', function ($q) {
                        $q->where('comentario', 'like', "%" . session()->get("v") . "%");
                    })->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
            session()->forget("v");
    }

    public function eliminar($codComentario){
        $rep = ReportesComentarios::where("codComentario", $codComentario)->get();
        foreach ($rep as $r) $r->delete();

        $comentario = Comentario::where("cod", $rep->first()->codComentario)->first();
        $comentario->delete();
        $n = Novedad::where("nick",$comentario->nick)->where("tipo", "comentario")->where("asociado", $rep->first()->codComentario)->first();
        if ($n != null) $n->delete();

        return redirect("/admin/navegacion/reportesComentarios");
    }
    public function permitir($codComentario){
        $rep = ReportesComentarios::where("codComentario", $codComentario)->get();
        foreach ($rep as $r) $r->delete();

        return redirect("/admin/navegacion/reportesComentarios");
    }
}
