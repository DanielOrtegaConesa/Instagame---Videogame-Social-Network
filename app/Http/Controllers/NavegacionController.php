<?php

namespace App\Http\Controllers;

use App\Anuncio;
use App\Comentario;
use App\PeticionesAmistad;
use Illuminate\Http\Request;
use App\Juego;
use App\Genero;
use App\Usuario;

class NavegacionController extends Controller
{
    public function index()
    {
        return view("indexlog");
    }

    public function verPerfil()
    {
        return view("verperfil")->with("u", session("usuario"));
    }

    public function editarPerfil()
    {
        return view("editarperfil");
    }

    public function buscarJuego()
    {
        return view("buscarjuego")->with("juegos", Juego::paginate(10))
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function verJuego($id)
    {
        return view("verjuego")->with("juego", Juego::where("cod", $id)->first())->with("estado", Usuario::estadoJuego(session("usuario")->nick, $id));
    }

    public function buscarUsuario()
    {
        return view("buscarusuario")->with("usuarios", Usuario::where("validado", 1)->where("baneado", 0)->paginate(10))->with("seleccionado", "")->with("valor", "");
    }

    public function verComentario($id){
        return view("vercomentario")->with("comentario",Comentario::where("cod",$id)->first());
    }
    public function verperfilajeno($nick)
    {
        return view("verperfilajeno")->with("u", Usuario::where("nick", $nick)->first());
    }

    public function chat()
    {
        return view("chat");
    }

    public function buscarAnuncio()
    {
        return view("buscaranuncio")->with("anuncios", Anuncio::orderBy("fecha", "desc")->join('usuarios', 'anuncios.nick', '=', 'usuarios.nick')
            ->where("baneado",0)->paginate(10))->with("value", "")
            ->with("seleccionado", "")
            ->with("valor", "");
    }

    public function nuevoAnuncio()
    {
        return view("nuevoanuncio");
    }

    public function editarAnuncio($cod)
    {
        return view("editaranuncio")->with("anuncio", Anuncio::where("cod", $cod)->first());
    }

    public function CerrarSesion()
    {
        session()->flush();
        return redirect('/');
    }
}
