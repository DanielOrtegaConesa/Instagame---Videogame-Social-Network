<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Genero;
use App\Juego;
use App\ReportesComentarios;
use App\ReportesUsuarios;
use App\Usuario;
use Illuminate\Http\Request;

class NavegacionAdminController extends Controller
{
    public function index()
    {
        return view("admin.index");
    }

    public function nuevoGenero()
    {
        return view("admin.nuevogenero");
    }

    public function buscarGenero()
    {
        return view("admin.buscargenero")->with("generos", Genero::paginate(10))
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function editarGenero($id)
    {
        return view("admin.editargenero")->with("genero", Genero::where("cod", $id)->first());
    }

    public function nuevoJuego()
    {
        return view("admin.nuevojuego")->with("generos", Genero::all()->sortBy("nombre"));
    }

    public function buscarJuego()
    {
        return view("admin.buscarjuego")->with("juegos", Juego::paginate(10))
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function editarJuego($id)
    {
        return view("admin.editarjuego")->with("juego", Juego::where("cod", $id)->first())->with("generos", Genero::all()->sortBy("nombre"));
    }

    public function verJuego($id)
    {
        return view("admin.verjuego")->with("juego", Juego::where("cod", $id)->first());
    }

    public function buscarUsuario()
    {
        return view("admin.buscarusuario")->with("usuarios", Usuario::where("validado", 1)->where("baneado", 0)->paginate(10))->with("seleccionado", "")->with("valor", "");
    }

    public function editarPerfil($u)
    {
        return view("admin.editarperfil")->with("u", Usuario::where("nick", $u)->first());
    }

    public function verPerfilAjeno($nick)
    {
        return view("admin.verperfil")->with("u", Usuario::where("nick", $nick)->first());
    }

    public function reportesComentarios()
    {
        return view("admin.reportescomentarios")->with("r", ReportesComentarios::paginate(10))
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function reportesUsuarios()
    {
        return view("admin.reportesusuarios")->with("r", ReportesUsuarios::paginate(10))
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function buscarAnuncio()
    {
        return view("admin.buscaranuncio")->with("anuncios", Anuncio::orderBy("fecha", "desc")->paginate(10))->with("value", "")
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function editarAnuncio($cod)
    {
        return view("admin.editaranuncio")->with("anuncio", Anuncio::where("cod", $cod)->first());
    }


}
