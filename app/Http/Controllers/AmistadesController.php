<?php

namespace App\Http\Controllers;

use App\Amistades;
use App\Novedad;
use App\PeticionesAmistad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmistadesController extends Controller
{
    public function peticion($nick)
    {

        $pet = new PeticionesAmistad();
        $pet->nick1 = session("usuario")->nick;
        $pet->nick2 = $nick;
        $pet->save();

    }

    public function aceptar($nick)
    {
        DB::beginTransaction();
        $solicitud = \App\PeticionesAmistad::where("nick1", $nick)->where("nick2", session("usuario")->nick)->first();

        $amistad = new Amistades();
        $amistad->nick1 = session("usuario")->nick;
        $amistad->nick2 = $nick;

        if ($solicitud->delete() && $amistad->save()) DB::commit();

        $n = new Novedad();
        $n->nick = $nick;
        // Esto se hace porque mi servidor va unos segundos adelantado y las notificaciones aparecen en futuro
        $fecha = time();
        $segundos = 3;
        $fecha = $fecha - ($segundos);
        $n->fecha = date("Y-m-d H:i:s", $fecha);
        $n->texto =
            "Es amigo de <a href='/navegacion/verPerfilAjeno/$amistad->nick1'>
                $amistad->nick1
             </a>";
        $n->save();

        $no = new Novedad();
        $no->nick = $amistad->nick1;
        $no->fecha = date("Y-m-d H:i:s", $fecha);
        $no->texto =
            "Es amigo de <a class='light-blue-text text-darken-4 ' href='/navegacion/verPerfilAjeno/$nick'>
                $nick
             </a>";
        $no->save();
    }

    public function rechazar($nick)
    {
        $solicitud = \App\PeticionesAmistad::where("nick1", $nick)->where("nick2", session("usuario")->nick)->first();
        $solicitud->delete();
    }

    public function eliminar($nick)
    {
        $a = \App\Amistades::where("nick1", $nick)->where("nick2", session("usuario")->nick)->first();
        if ($a != null) {
            $a->delete();
        }
        $a2 = \App\Amistades::where("nick1", session("usuario")->nick)->where("nick2", $nick)->first();
        if ($a2 != null) {
            $a2->delete();
        }
    }
}
