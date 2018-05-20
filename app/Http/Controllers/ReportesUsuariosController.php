<?php

namespace App\Http\Controllers;

use App\ReportesUsuarios;
use App\Usuario;
use Illuminate\Http\Request;

class ReportesUsuariosController extends Controller
{
    public function reportar($nick)
    {
        $nsesion = session("usuario")->nick;
        $reporte = ReportesUsuarios::where("reportador", $nsesion)->where("reportado", $nick)->first();
        if (!$reporte) {
            $reporte = new ReportesUsuarios();
            $reporte->reportador = $nsesion;
            $reporte->reportado = $nick;
            $reporte->save();
        }else {
            echo "existe";
        }
    }

    public function eliminar($nick)
    {
        foreach (ReportesUsuarios::where("reportado", $nick)->get() as $r) {
            $r->delete();
        }
        $u = Usuario::where("nick", $nick)->first();
        $u->baneado = true;
        $u->save();

        return redirect("/admin/navegacion/reportesUsuarios");
    }

    public function banear($nick)
    {
        foreach (ReportesUsuarios::where("reportado", $nick)->get() as $r) {
            $r->delete();
        }
        $u = Usuario::where("nick", $nick)->first();
        $u->baneado = true;
        $u->save();
        return redirect("/admin/navegacion/verPerfilAjeno/$nick");
    }
    public function desbanear($nick)
    {
        foreach (ReportesUsuarios::where("reportado", $nick)->get() as $r) {
            $r->delete();
        }
        $u = Usuario::where("nick", $nick)->first();
        $u->baneado = false;
        $u->save();
        return redirect("/admin/navegacion/verPerfilAjeno/$nick");
    }

    public function permitir($nick)
    {

        foreach (ReportesUsuarios::where("reportado", $nick)->get() as $r) {
            $r->delete();
        }
        return redirect("/admin/navegacion/reportesUsuarios");
    }
}
