<?php

namespace App\Http\Controllers;

use App\PeticionesAmistad;
use App\Usuario;
use App\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;


class IndexController extends Controller
{
    public function index()
    {
        if (session()->has('usuario')) {
            return view("indexlog");
        } else if(session()->has('admin')) {
            return view("admin.index");
        }else{
            return view('index');
        }
    }

    public function indexAdmin()
    {
        if (session()->has('admin')) {
            return view("admin.index");
        } else {
            return view('admin.entraradmin');
        }
    }

    public function entrar(UsuarioRequest $request)
    {
        $nick = $request->input("nick");
        $pass = $request->input("password");
        $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $_REQUEST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));

        if ($captcha->success) {
            $estado = "mal";
            $existe = DB::table('usuarios')->where('nick', $nick)->where("password", $pass)->exists();
            if ($existe) {
                $u = Usuario::where('nick', $nick)->where("password", $pass)->first();
                $estado = "bien";
                if ($u->validado) {
                    if($u->baneado==0){
                        session()->put("usuario", $u);
                    }else{
                        $estado = "baneado";
                    }
                } else {
                    $estado = "novalidado";
                }
            }
        } else {
            $estado = "robot";
        }
        $retornar["estado"] = $estado;
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

    public function entrarAdmin(UsuarioRequest $request)
    {
        $nick = $request->input("nick");
        $pass = $request->input("password");
        $captcha = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdFuEgUAAAAAO3okzrEhTJCkr6HYk3kfFqNPPwb&response=" . $_REQUEST['response'] . "&remoteip=" . $_SERVER['REMOTE_ADDR']));

        if ($captcha->success) {
            $estado = "mal";
            $existe = DB::table('admins')->where('nick', $nick)->where("password", $pass)->exists();
            if ($existe) {
                $a = Admin::where('nick', $nick)->where("password", $pass)->first();
                $estado = "bien";
                session()->put("admin", $a);
            }
        } else {
            $estado = "robot";
        }

        $retornar["estado"] = $estado;
        echo json_encode($retornar, JSON_UNESCAPED_UNICODE);
    }

}
