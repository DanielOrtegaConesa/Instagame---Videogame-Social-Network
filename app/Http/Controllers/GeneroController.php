<?php

namespace App\Http\Controllers;

use App\Genero;
use App\Http\Requests\GeneroRequest;
use App\Juego;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeneroController extends Controller
{

    public function insert(GeneroRequest $r)
    {
        $nombre = $r->input("nombre");
        $g = new Genero();
        $g->nombre = $nombre;
        $g->save();
    }

    public function update(GeneroRequest $r)
    {
        $cod = $r->input("cod");
        $nombre = $r->input("nombre");
        $g = Genero::where("cod", $cod)->first();
        $g->nombre = $nombre;

        if ($g->save()) {
            if ($nombre != "") {
                session()->put("mensaje", "Actualizado correctamente");
                return redirect("/admin/navegacion/buscarGenero");
            }
        }
    }

    public function delete($cod)
    {
        $g = Genero::where("cod", $cod)->first();
        $g->delete();

        return redirect("/admin/navegacion/buscarGenero");
    }

    public function filtrar($campo = "nombreGenero", $valor = "")
    {
        if ($campo == "nombreGenero") {
            $campo = "nombre";
        } elseif ($campo == "codGenero") {
            $campo = "cod";
        }
        return view("admin.buscargenero")->with("generos",
            Genero::where($campo, "LIKE", "%" . $valor . "%")->paginate(20))
            ->with("seleccionado", $campo)
            ->with("valor", $valor);
    }

}
