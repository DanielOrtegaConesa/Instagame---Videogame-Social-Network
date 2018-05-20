<?php

namespace App\Http\Controllers;

use App\Comentario;
use App\Genero;
use App\Http\Requests\nuevoJuegoRequest;
use App\Juego;
use App\Novedad;
use App\Puntuacion;
use App\ReportesComentarios;
use App\Usuario;
use App\estadosJuegos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class JuegoController extends Controller
{
    public function insert(nuevoJuegoRequest $r)
    {
        $nombre = $r->input("nombre");
        $descripcion = $r->input("descripcion");
        $descripcion = str_replace(".", ".<br/>", $descripcion);
        $year = $r->input("year");
        $g1 = $r->input("g1");
        $g2 = $r->input("g2");
        $g3 = $r->input("g3");

        $j = new Juego();
        $j->nombre = $nombre;
        $j->descripcion = $descripcion;
        $j->year = $year;

        $j->save();

        $j = Juego::where("nombre", $j->nombre)->where("descripcion", $j->descripcion)->where("year", $j->year)->first();
        $file = $r->file('img');
        if ($file != "") {
            $nombre = explode(".", $file->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);
            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                \Storage::delete('juegos/' . $j->cod . ".jpg");
                \Storage::delete('juegos/' . $j->cod . ".jpeg");
                \Storage::delete('juegos/' . $j->cod . ".png");

                \Storage::disk('juegos')->put($j->cod . "img." . $extension, \File::get($file));
                $j->img = $j->cod . "img." . $extension;
            }
        }
        $caratula = $r->file('caratula');
        if ($caratula != "") {
            $nombre = explode(".", $caratula->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);
            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                \Storage::delete('juegos/' . $j->cod . "caratula.jpg");
                \Storage::delete('juegos/' . $j->cod . "caratula.jpeg");
                \Storage::delete('juegos/' . $j->cod . "caratula.png");

                \Storage::disk('juegos')->put($j->cod . "caratula." . $extension, \File::get($caratula));
                $j->caratula = $j->cod . "caratula." . $extension;
            }
        }

        $j->generos()->attach([["codGenero" => $g1, "numero" => "1"], ["codGenero" => $g2, "numero" => "2"], ["codGenero" => $g3, "numero" => "3"]]);
        $j->save();

        return redirect("/admin/navegacion/nuevoJuego");
    }

    public function update(nuevoJuegoRequest $r)
    {
        $j = Juego::where("cod", $r->input("cod"))->first();
        $nombre = $r->input("nombre");
        $descripcion = $r->input("descripcion");
        $descripcion = str_replace(".", ".<br/>", $descripcion);
        $year = $r->input("year");
        $g1 = $r->input("g1");
        $g2 = $r->input("g2");
        $g3 = $r->input("g3");

        //
        $j->nombre = $nombre;
        $j->descripcion = $descripcion;
        $j->year = $year;

        $file = $r->file('img');
        if ($file != "") {
            $nombre = explode(".", $file->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);
            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                \Storage::delete('juegos/' . $j->cod . ".jpg");
                \Storage::delete('juegos/' . $j->cod . ".jpeg");
                \Storage::delete('juegos/' . $j->cod . ".png");

                \Storage::disk('juegos')->put($j->cod . "img." . $extension, \File::get($file));
                $j->img = $j->cod . "img." . $extension;
            }
        }
        $caratula = $r->file('caratula');
        if ($caratula != "") {
            $nombre = explode(".", $caratula->getClientOriginalName());
            $extension = end($nombre);
            $extension = strtolower($extension);
            if ($extension == "jpg" || $extension == "jpeg" || $extension == "png") {
                \Storage::delete('juegos/' . $j->cod . "caratula.jpg");
                \Storage::delete('juegos/' . $j->cod . "caratula.jpeg");
                \Storage::delete('juegos/' . $j->cod . "caratula.png");

                \Storage::disk('juegos')->put($j->cod . "caratula." . $extension, \File::get($caratula));
                $j->caratula = $j->cod . "caratula." . $extension;
            }
        }

        $j->generos()->detach();
        $j->generos()->attach([["codGenero" => $g1, "numero" => "1"], ["codGenero" => $g2, "numero" => "2"], ["codGenero" => $g3, "numero" => "3"]]);
        $j->save();
        return redirect("/admin/navegacion/buscarJuego");
    }

    public function delete($cod)
    {
        $j = Juego::where("cod", $cod)->first();
        $j->delete();
        return redirect("/admin/navegacion/buscarJuego");
    }

    public function filtrar($campo = "nombre", $valor = "")
    {
        if ($campo == "nombreJuego") {
            $campo = "nombre";
        } elseif ($campo == "codJuego") {
            $campo = "cod";
        } elseif ($campo == "nombreGenero") {
            $campo = "genero";
        }
        if ($campo == "genero") {
            session()->put("v", $valor);
            return view("admin.buscarjuego")
                ->with("juegos",
                    Juego::whereHas('generos', function ($q) {
                        $q->where('nombre', 'like', "%" . session()->get("v") . "%");
                    })->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
            session()->forget("v");
        } else {
            return view("admin.buscarjuego")->with("juegos",
                Juego::where($campo, "LIKE", "%" . $valor . "%")->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
        }
    }

    public function filtrarUsu($campo = "nombre", $valor = "")
    {
        if ($campo == "nombreJuego") {
            $campo = "nombre";
        } elseif ($campo == "codJuego") {
            $campo = "cod";
        } elseif ($campo == "nombreGenero") {
            $campo = "genero";
        }

        if ($campo == "genero") {
            session()->put("v", $valor);
            return view("buscarjuego")
                ->with("juegos",
                    Juego::whereHas('generos', function ($q) {
                        $q->where('nombre', 'like', "%" . session()->get("v") . "%");
                    })->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
            session()->forget("v");
        } else {
            return view("buscarjuego")->with("juegos",
                Juego::where($campo, "LIKE", "%" . $valor . "%")->paginate(10))
                ->with("seleccionado", $campo)
                ->with("valor", $valor);
        }
    }

    public function cambiarEstadoUsuario(Request $r)
    {
        $codjuego = $r->input("codJuego");
        $nick = session()->get("usuario")->nick;
        $estado = $r->input("estado");

        $registro = estadosJuegos::where("codJuego", $codjuego)->where("nick", $nick)->first();
        if ($registro == NULL) {
            $registro = new estadosJuegos();
            $registro->codJuego = $codjuego;
            $registro->nick = $nick;
            $registro->estado = $estado;
        } else {
            $registro->estado = $estado;
        }
        $registro->save();

        $u = session("usuario");
        $usubd = Usuario::where('nick', $u->nick)->first();
        session()->put("usuario", $usubd);

        $j = Juego::where("cod", $codjuego)->first();

        $n = new Novedad();
        $n->nick = $nick;

        // Esto se hace porque mi servidor va unos segundos adelantado y las notificaciones aparecen en futuro
        $fecha = time();
        $segundos = 3;
        $fecha = $fecha - ($segundos);
        $n->fecha = date("Y-m-d H:i:s", $fecha);

        if ($estado == "jugando") {
            $n->texto =
                "Ha empezado a jugar a  <a href='/navegacion/verJuego/$j->cod'>
                $j->nombre
             </a>";
            $n->save();
        } else if ($estado == "dejado") {
            $n->texto =
                "Ha dejado de jugar a  <a href='/navegacion/verJuego/$j->cod'>
                $j->nombre
             </a>";
            $n->save();
        }

    }

    public function nuevoComentario(Request $r)
    {
        $comentario = $r->input("comentario");
        $codjuego = $r->input("codJuego");

        $c = new Comentario();
        $c->codJuego = $codjuego;
        $c->comentario = $comentario;
        $c->nick = session("usuario")->nick;
        $c->fecha = date("Y-m-d H:i:s");
        $c->save();

        $j = Juego::where("cod", $codjuego)->first();
        $n = new Novedad();
        $n->nick = session("usuario")->nick;
        $n->tipo = "comentario";
        $n->asociado = $c->cod;

        $n->texto = "Ha comentado en <a href='/navegacion/verJuego/$codjuego'>" . $j->nombre . "</a>:<br/>
        <blockquote>" . $comentario . "</blockquote>";

        // Esto se hace porque mi servidor va unos segundos adelantado y las notificaciones aparecen en futuro
        $fecha = time();
        $segundos = 3;
        $fecha = $fecha - ($segundos);
        $n->fecha = date("Y-m-d H:i:s", $fecha);
        $n->save();
    }

    public static function eliminarComentario($cod)
    {
        $comentario = Comentario::where("cod", $cod)->first();
        if ($comentario != NULL && $comentario->nick == session("usuario")->nick) {
            $comentario->delete();
            echo "ok";
        }
        $n = Novedad::where("nick", session("usuario")->nick)->where("tipo", "comentario")->where("asociado", $cod)->first();
        if ($n != null) $n->delete();
    }

    public static function eliminarComentarioAdmin($cod)
    {
        $comentario = Comentario::where("cod", $cod)->first();
        if($comentario != NULL){
            $comentario->delete();
            $n = Novedad::where("nick",$comentario->nick)->where("tipo", "comentario")->where("asociado", $cod)->first();
            if ($n != null) $n->delete();
            echo "ok";
        }

    }

    public function reportarComentario($cod)
    {
        if (ReportesComentarios::where("reportador", session("usuario")->nick)->where("codComentario", $cod)->first() == NULL) {
            $reportecomentario = new ReportesComentarios();
            $reportecomentario->reportador = session("usuario")->nick;
            $reportecomentario->codComentario = $cod;
            $reportecomentario->save();
            echo "ok";
        } else {
            echo "anteriormente";
        }
    }

    public function cambiarPuntuacion(Request $r)
    {
        $codjuego = $r->input("codJuego");
        $puntuacion = Puntuacion::where("codJuego", $codjuego)->where("nick", session("usuario")->nick)->first();
        if ($puntuacion == null) {
            $puntuacion = new Puntuacion();
            $puntuacion->nick = session("usuario")->nick;
            $puntuacion->puntuacion = $r->input("puntuacion");
            $puntuacion->codJuego = $codjuego;
        } else {
            $puntuacion->puntuacion = $r->input("puntuacion");
        }
        $puntuacion->save();

        $j = Juego::where("cod", $codjuego)->first();
        $n = new Novedad();
        $n->nick = session("usuario")->nick;
        $n->tipo = "valoracion";
        $n->asociado = $puntuacion->cod;

        $n->texto = "Ha valorado <a href='/navegacion/verJuego/$codjuego'>" . $j->nombre . "</a> con un " . $r->input("puntuacion");

        // Esto se hace porque mi servidor va unos segundos adelantado y las notificaciones aparecen en futuro
        $fecha = time();
        $segundos = 3;
        $fecha = $fecha - ($segundos);
        $n->fecha = date("Y-m-d H:i:s", $fecha);
        $n->save();

    }

}
