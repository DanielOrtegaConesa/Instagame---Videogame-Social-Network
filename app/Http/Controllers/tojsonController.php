<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Comentario;
use App\Usuario;
use Illuminate\Http\Request;
use App\Juego;
use App\Genero;
use Illuminate\Support\Facades\DB;

class tojsonController extends Controller
{
    public function juegos()
    {
        $datosjuegos = Juego::all();
        $juegosjson = "{ ";
        foreach ($datosjuegos as $juego) {
            $juegosjson .= "\"$juego->nombre\": null, ";
        }
        $juegosjson = substr($juegosjson, 0, strlen($juegosjson) - 2);
        $juegosjson .= "}";
        echo $juegosjson;
    }

    public function generos()
    {
        $datosgeneros = Genero::all();
        $generosjson = "{ ";
        foreach ($datosgeneros as $genero) {
            $generosjson .= "\"$genero->nombre\": null, ";
        }
        $generosjson = substr($generosjson, 0, strlen($generosjson) - 2);
        $generosjson .= "}";
        echo $generosjson;
    }

    public function comentarios(Request $r)
    {
        $cod = $r->input("codJuego");
        $desde = $r->input("desde");
        $take = $r->input("take");

        $comentarios = Comentario::where("codJuego", $cod)->orderBy("fecha", "desc")->skip($desde)->take($take)->get();

        $datos["comentarios"] = $comentarios;
        $datos["sesion"] = session("usuario")->nick;
        foreach ($comentarios as $comentario) {
            $datos["usuarios"][$comentario->nick] = Usuario::where("nick", $comentario->nick)->first()->perfil->img;
        }

        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }
    public function comentariosAdmin(Request $r)
    {
        $cod = $r->input("codJuego");
        $desde = $r->input("desde");
        $take = $r->input("take");

        $comentarios = Comentario::where("codJuego", $cod)->orderBy("fecha", "desc")->skip($desde)->take($take)->get();

        $datos["comentarios"] = $comentarios;
        foreach ($comentarios as $comentario) {
            $datos["usuarios"][$comentario->nick] = Usuario::where("nick", $comentario->nick)->first()->perfil->img;
        }

        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }

    public function solicitudesUsuario()
    {
        $solicitudes = \App\PeticionesAmistad::where("nick2", session("usuario")->nick)->get();
        echo $solicitudes->toJson();
    }

    public function amistadesUsuario()
    {
        $unick = session("usuario")->nick;
        $amistades = \App\Amistades::where("nick2", $unick)->orWhere("nick1", $unick)->inRandomOrder()->get();

        $ret = [];
        foreach ($amistades as $i => $amistad) {
            if ($amistad->nick1 != $unick) {
                $amigo = Usuario::where("nick", $amistad->nick1)->first();
                if(!$amigo->baneado) {
                    $ret[$i]["amigo"] = $amistad->nick1;
                    $ret[$i]["img"] = $amigo->perfil->img;
                }
            } else {
                $amigo = Usuario::where("nick", $amistad->nick2)->first();
                if(!$amigo->baneado) {
                    $ret[$i]["amigo"] = $amistad->nick2;
                    $ret[$i]["img"] = $amigo->perfil->img;
                }
            }

        }

        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    public function novedadesUsuario($desde, $take)
    {
        $u = session("usuario");
        $datos = [];
        $amistades = [];
        $amistadesBD = \App\Amistades::where("nick1", $u->nick)->orWhere("nick2", $u->nick)->get();
        $amistades[] = $u->nick;
        $datos["usuarios"][$u->nick] = Usuario::where("nick", $u->nick)->first()->perfil->img;

        foreach ($amistadesBD as $i => $amistad) {
            if ($amistad->nick1 != $u->nick) {
                $amistades[] = $amistad->nick1;
                $datos["usuarios"][$amistad->nick1] = Usuario::where("nick", $amistad->nick1)->first()->perfil->img;
            } else {
                $amistades[] = $amistad->nick2;
                $datos["usuarios"][$amistad->nick2] = Usuario::where("nick", $amistad->nick2)->first()->perfil->img;
            }
        }
        $novedades = DB::table('novedades')
            ->whereIn('nick', $amistades)
            ->orderBy("fecha", "desc")
            ->skip($desde)
            ->take($take)
            ->get();
        $datos["novedades"] = $novedades;
        echo json_encode($datos, JSON_UNESCAPED_UNICODE);
    }

}
