<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function filtrar($campo = "nick", $valor = "")
    {
        if ($campo == "nombreJuego") {
            $campo = "juega";
        }

        if ($campo == "juega") {
            session()->put("v", $valor);
            return view("admin.buscarusuario")
                ->with("usuarios",
                    Usuario::whereHas('juegos', function ($q) {
                        $q->where('nombre', 'like', "%" . session()->get("v") . "%")->where("validado",1);
                    })->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
            session()->forget("v");
        } else {
            return view("admin.buscarusuario")->with("usuarios",
                Usuario::where($campo, "LIKE", "%" . $valor . "%")->where("validado",1)->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
        }
    }
    public function filtrarusu($campo = "nick", $valor = "")
    {
        if ($campo == "nombreJuego") {
            $campo = "juega";
        }

        if ($campo == "juega") {
            session()->put("v", $valor);
            return view("buscarusuario")
                ->with("usuarios",
                    Usuario::whereHas('juegos', function ($q) {
                        $q->where('nombre', 'like', "%" . session()->get("v") . "%")->where("baneado",0)->where("validado",1);
                    })->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
            session()->forget("v");
        } else {
            return view("buscarusuario")->with("usuarios",
                Usuario::where($campo, "LIKE", "%" . $valor . "%")->where("baneado",0)->where("validado",1)->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
        }
    }
}
