<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Usuario;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function contactos()
    {
        $unick = session("usuario")->nick; //DANI
        $amistades = \App\Amistades::where("nick2", $unick)->orWhere("nick1", $unick)->get();

        $ret = [];
        foreach ($amistades as $i => $amistad) {

            if ($amistad->nick1 != $unick) {
                $amigo = Usuario::where("nick", $amistad->nick1)->first();
                if(!$amigo->baneado) {
                    $ret[$i]["amigo"] = $amistad->nick1;
                    $ret[$i]["img"] = $amigo->perfil->img;
                    $ret[$i]["cmens"] = \App\Chat::where("para", session("usuario")->nick)->where("de", $amistad->nick1)->where("leido", 0)->count();
                }
            } else {
                $amigo = Usuario::where("nick", $amistad->nick2)->first();
                if(!$amigo->baneado) {
                    $ret[$i]["amigo"] = $amistad->nick2;
                    $ret[$i]["img"] = $amigo->perfil->img;
                    $ret[$i]["cmens"] = \App\Chat::where("para", session("usuario")->nick)->where("de", $amistad->nick2)->where("leido", 0)->count();
                }
            }

        }
        $ret = $this->orderMultiDimensionalArray($ret, "cmens", true);

        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
    }

    function nuevoMensaje(Request $r)
    {
        $m = new Chat();
        $m->de = session("usuario")->nick;
        $m->texto = $r->input("mensaje");
        $m->para = $r->input("para");

        // Esto se hace porque mi servidor va unos segundos adelantado y las notificaciones aparecen en futuro
        $fecha = time();
        $segundos = 3;
        $fecha = $fecha - ($segundos);
        $m->fecha = date("Y-m-d H:i:s", $fecha);

        $m->leido = 0;
        $m->save();
    }

    public function chatUsuario($usuario, $inicio, $take)
    {
        $usesion = session("usuario")->nick;

        $chats = Chat::where("de", $usesion)->where("para", $usuario)
            ->orWhere("de", $usuario)->where("para", $usesion)
            ->orderBy("fecha", "asc")
            //->skip($inicio)
            //->take($take)
            ->get();

        foreach ($chats as $mensaje) {
            $retornar["usuarios"][$mensaje->de] = Usuario::where("nick", $mensaje->de)->first()->perfil->img;
            if ($mensaje->de != $usesion) {
                $retornar["usuarios"][$mensaje->de] = Usuario::where("nick", $mensaje->de)->first()->perfil->img;
                $mensaje->leido = 1;
                $mensaje->save();
            }
        }
        $retornar["chats"] = $chats->toJson();
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function nuevosMensajesUsuario($usuario, $inicio, $take)
    {
        $usesion = session("usuario")->nick;

        $chats = Chat::where("de", $usesion)->where("para", $usuario)->where("leido", 0)
            ->orWhere("de", $usuario)->where("para", $usesion)->where("leido", 0)
            ->orderBy("fecha", "asc")
            //->skip($inicio)
            //->take($take)
            ->get();

        foreach ($chats as $mensaje) {
            if ($mensaje->de != $usesion) {
                $retornar["usuarios"][$mensaje->de] = Usuario::where("nick", $mensaje->de)->first()->perfil->img;
                $mensaje->leido = 1;
                $mensaje->save();
            }
        }
        $retornar["chats"] = $chats->toJson();
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function orderMultiDimensionalArray($toOrderArray, $field, $inverse = false)
    {
        $position = array();
        $newRow = array();
        foreach ($toOrderArray as $key => $row) {
            $position[$key] = $row[$field];
            $newRow[$key] = $row;
        }
        if ($inverse) {
            arsort($position);
        } else {
            asort($position);
        }
        $returnArray = array();
        foreach ($position as $key => $pos) {
            $returnArray[] = $newRow[$key];
        }
        return $returnArray;
    }

}
